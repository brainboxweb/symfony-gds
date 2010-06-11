<?php
/*
echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';
*/

#exit;
/**
 *
 *  This class needs to provide the following to the parent class:
 *   $this->contentString	
 *   $this->shortTitle 
 *   $this->titleNote 
 *   $this->title 
 *   $this->description
 *
 *
 *  May 08 - Changed to use Item MODEL
 *
 * @todo - this is VERY similar tyo NavItemPage
 *  
 */




Class PortfolioItemPage extends Page{

    function __construct($dbPDO, $basePath = '/'){
        
        $this->dbPDO=$dbPDO;
        $this->basePath=$basePath;
        $this->_initialise();
    
    }
    

    /**
     * Initialise now needs to be about CHOOSING the right from for the selected page
     *
     *
     */
    function _initialise(){
                
        $this->handleSession();

        $this->handlePOSTs();
        
        $this->handleErrors();

        $this->getItem();
        
        //var_dump($this->portfolioItem);
        
        
        $this->title .= $this->portfolioItem->title ;
    
        
        //Get images list and form
        require_once 'bb_admin/Model/Image.php';
        
        $image=new Model_Image($this->dbPDO);
        
        $imageArray =  $image->getByArticleId( $_GET['id'], null );
        
        
        $section = '';
        
        ob_start();
                
            require  'views/portfolio-admin-form.php';
            
            $this->contentString .=  ob_get_contents();
                
        ob_end_clean();
           
    }
       
    function getItem(){
      
        require_once('Portfolio/Portfolio.php');
        $this->portfolioItem = Portfolio::getById($this->dbPDO, $_GET['id'] );
       
    }   
    
    
    
    
    
    function handleSession(){
        
        if( !isset($_SERVER['HTTP_REFERER'])  ||
            !strstr($_SERVER['HTTP_REFERER'], $_SERVER['REQUEST_URI']) ||
            (isset($_SESSION['referringTime'])  && time() - $_SESSION['referringTime'] > 30 )
             ) {
            
            unset($_SESSION['errors']);
            unset($_SESSION['formVars']);
            
        }

    }
    
    function handleErrors(){
        
        //Check for errors - held in session.
        
        if(isset($_SESSION['errors']) ){
          
            //Need to pass the posted values back to the form
            $data['title'] =            $_SESSION['formVars']['title'];
            $last =                     $_SESSION['formVars']['filename'];
            $data['status'] =           $_SESSION['formVars']['status'];
            $data['published'] =        $_SESSION['formVars']['published'];
            $data['depublish'] =        $_SESSION['formVars']['depublish'];
            $data['meta_title'] =       $_SESSION['formVars']['metaTitle'];
            $data['meta_description'] = $_SESSION['formVars']['metaDescription'];
            $data['body'] =             $_SESSION['formVars']['body'];
          
        }
    }
    
    
    
    
    function handlePOSTs(){
        
        
        if( !empty($_POST['main'])  ){
            
            $this->handleMainPOST();
        }
        
        
        if(!empty($_POST['addImage'])  && !empty($_FILES)  ){
            
            $this->handleImagePOST();
            
        }
        
        if( !empty($_POST['deleteImage']) ){
                
            $this->handleRemoveImagePOST();
                
        }

       
        //Handle new file
        if(!empty($_POST['addDownload'])  && !empty($_FILES)  ){
        
            $this->handleDownloadPOST();
            
        }
        
        //Handle removal
        if( !empty($_POST['deleteDownload']) ){
               
            $this->handleRemoveDownloadPOST();  
                
        }

    }
    
    
    function handleMainPOST(){
        
        //print_r($_POST);
        require_once('forms/validation.php');
        $validator=new FormValidator();
       
      
        $validator->isEmpty('title', 'Please enter a Title for the page');
        
       
        //$validator->isEmpty('published', 'Please enter a Publish date');
        #  $validator->isEmpty('depublish', 'Please enter an Expiry date');
        
        if($validator->isError() ){
        
            //Store details of the form and its errors in the session
           
            $_SESSION['referringTime'] = time();
            $_SESSION['formVars'] = $_POST;
            $_SESSION['errors'] = $validator->getErrorList();
    
        } else {
            
            require_once('Portfolio/Model/Portfolio.php');
            
            Model_Portfolio::updateFromPOST($this->dbPDO);
            
            // Clear the session 
            if(isset($_SESSION['errors']) ){
                unset($_SESSION['errors']);
            }
            unset($_SESSION['formVars']);
        
        }
        
        //Avoind "reposting" probs by redirecting
        header("Location: ".$_SERVER['REQUEST_URI']);
        die;    
        
        
    }

    
    
    function handleImagePOST(){
        
        require_once 'bb_admin/Model/Image.php';
        $image=new Model_Image($this->dbPDO);
        $image->addFromPOST($_GET['id'],null, BASE_FILE_PATH . '/images/articles');
        
        //Avoid "reposting" probs by redirecting
        header("Location: ".$_SERVER['REQUEST_URI']);
        die;
    
    }
    
    function handleRemoveImagePOST(){
        
        require_once 'bb_admin/Model/Image.php';
        $image=new Model_Image($this->dbPDO);
        $image->deleteFromPOST();
        
        //Avoid "reposting" probs by redirecting
        header("Location: ".$_SERVER['REQUEST_URI']);
        die;
    }
    
    function handleDownloadPOST(){
        
        require_once 'Download/Model/Download.php';
        $download=new Model_Download($this->dbPDO);
        $download->addFromPOST($_GET['id'],null, BASE_FILE_PATH . '/download');
        
        //Avoid "reposting" probs by redirecting
        header("Location: ".$_SERVER['REQUEST_URI']);
        die;
        
    }
    
    
     function handleRemoveDownloadPOST(){
     
        require_once 'Download/Model/Download.php';
        $download=new Model_Download($this->dbPDO);
        $download->delete($_POST['id'],BASE_FILE_PATH . '/download');
        
        //Avoid "reposting" probs by redirecting
        header("Location: ".$_SERVER['REQUEST_URI']);
        die;
        
    }
       
    function breadcrumbArray(){

		$breadcrumbArray=array();
        
        $request = $_SERVER['REDIRECT_URL'];
        $pathArray=explode('/',$request);
        
        $segment = array_pop($pathArray);
        
        #echo $segment;
        if($segment == 'navigation'){
            
            $section = 'Navigation';
            
        } else {
            
            $section = 'Orphans';
        }
        #exit;
        
		$breadcrumbArray[]=array('fullPath'=>$segment, 'title'=>$section);
		$breadcrumbArray[]=array('fullPath'=>'',        'title'=>$this->title );
		return $breadcrumbArray;

    }
   
   
    function cssArray(){
            
        $cssArray=array();
        
        $cssArray[]='css/flexi.css'; 
        $cssArray[]='css/datepicker.css';

        return $cssArray;
    
    }
    
    
    function javaScriptArray(){
            
        $jsArray=array();
        $jsArray[]='js/validate_form.js';              //calendar
        $jsArray[]='js/tooltips.js';
        
        $jsArray[]='js/jquery.js';
        $jsArray[]='js/ui.datepicker.js';
        $jsArray[]='js/calendar-stuff.js'; // set up for the jquery calendar

        return $jsArray;
    }
   
}
