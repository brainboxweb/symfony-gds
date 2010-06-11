<?php
#print_r($_POST);
/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description

*/

Class PortfolioListPage extends Page{

     function __construct($dbPDO){
            
          $this->dbPDO=$dbPDO;
          $this->_initialise();
             
     }
       
       
     function _initialise(){
                
		
	  $this->handlePOST();
	   
          $this->getItemArray();
	  
	  $this->renderView();
	  
	  


       }
       
     function handlePOST(){
	  
	  //var_dump($_POST);
	  //exit;
	  
	  
	  if( !empty($_POST['action']) && $_POST['action']=='add' ){
	       
	       require_once('Portfolio/Model/Portfolio.php');
	       Model_Portfolio::add($this->dbPDO );
	       //exit;
	       
	  }
	  
     }
       
       
     function getItemArray(){
      
	  require_once('Portfolio/Portfolio.php');
	  $this->portfolioArray =  Portfolio::getAll($this->dbPDO );
	  
	  
	  //var_dump( $this->portfolioArray);
	  //exit;
       
     }
     
     
     function renderView(){
	  
	  
	  ob_start();
                
	       require  'views/admin-portfolio-list.php';
	       
	       $this->contentString .=  ob_get_contents();
                
	  ob_end_clean();
      
	  
     }
	  
	  
       
       
        function breadcrumbArray(){
	  
		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'orphans','title'=>'Orphans');
		return $breadcrumbArray;
	  
        }
       
        function cssArray(){
                
              
                $cssArray=array();
                
                $cssArray[]='css/flexi.css'; 
                
                //$cssArray[]='build/fonts/fonts.css';                    //calendar
                //$cssArray[]='build/reset/reset.css';                    //calendar
                //$cssArray[]='build/calendar/assets/calendar.css';       //calendar
                
                //$cssArray[]='build/fonts/fonts-min.css';                //tabs
                //$cssArray[]='build/tabview/assets/skins/sam/tabview.css';//tabs
		
                return $cssArray;
                

        
        }
        function javaScriptArray(){
                
                $jsArray=array();
                $jsArray[]='js/validate_form.js';              //calendar
                $jsArray[]='js/tooltips.js';
               
                
                return $jsArray;
        }
       
}

?>

