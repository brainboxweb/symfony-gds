<?php
//header('Expires: Mon, 26 July 1997 05:00:00 GMT' );
//header('Pragma: nocache');

#echo '<pre>';
#print_r($_POST);
#echo '</pre>';

/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description


// Oct 2007 - This WAS the page used for just about everything. Now want to strip it down for the simplest of items: NEWS (may later extend it to other items
*/

Class NewsItemPage extends Page{
        
        var $className;

        function __construct($dbPDO){
		
		
	        $this->dbPDO=$dbPDO;
		
		$this->_initialise();       

        }
        
    
/*
       // A function to apply mysql_real_escape_string   //may not need this anymore
       function escapeValue($value) {
        
               return mysql_real_escape_string($value);
        
        }
*/     
       
       function _initialise(){
        
                                
                #require_once ('News/News.php');
                require_once ('News/Model/NAMnews.php');
                
                $newsModel = new Model_NAMnews($this->dbPDO);
                
                
                if(isset($_POST['title'])) {
                  
                        $newsModel->update($_POST);
                        
                        ##Run the RSS generator
                        #include('RSS/generateNewsRSS.php');
                   
                
                }
                
                if(isset($_POST['image'])){
                   
                   echo 'handle the uploaded image';
                   
                   $newsModel->updateImage($config['basePath']);
                   
                }
                
                #$newsItem=new News;
                
                $newsModel->isActive=false;
                
                #echo $newsModel->isActive;
                #exit;
                
                $data = $newsModel->getById($_GET['id']);
                
                #print_r($data);
                
                $selectedDevelopments=$newsModel->getDevelopments($_GET['id']);
                
                
                
               # echo '<pre>';
                #print_r($selectedDevelopments);
                
                //Also need a master list of developments
                
                #require_once ('News/News.php');
                require_once ('Development/Model/Development.php');
                
                $developmentModel = new Model_Development($this->dbPDO);
                
                $developmentModel->getItems();
                
                $selectString = '<select name="development">';
                $selectString .= '<option value="" >None</option>';
                while($development = $developmentModel->fetch() ){
                        
                        #print_r($development );
                        
                        foreach ($selectedDevelopments as $selectedDevelopment){
                                
                                $selected='';
                                
                                if(array_intersect($development,$selectedDevelopment)){
                                        
                                        $selected= 'selected = "selected" ';
                                }
                        }
                       
                     
                        $selectString .=  '<option value="' . $development['id'] . '" '.$selected.'>'. $development['name'] . '</option>';
                     
                }
                $selectString .=  '</select>';
                
                
                echo $selectString;
                exit;
                
                #$newsItem->populate($row);
                
                        
     
             #print_r($data);
             #exit;
             

             
            
             //Try a hadn-coded form
             $this->contentString .= '
     
             
             
             <form action="'.$_SERVER['REQUEST_URI'] . '" method="post" name="updateflexiItem" id="updateflexiItem">
              <input name="id" id="id" type="hidden" value="'.$_GET['id'].'" />
             <input name="main" id="main" type="hidden" value="1" />
             
             <table class="form" border=0>
           
             
             
             <tr>
                     <td class="col1">';
                        
                        
                       
                        
                                 
                        //echo '<hr>' .  $data['parentID;
                       // exit;
                        

                         //No FILE PATH STUFF thing to do for the Home page
                    
                                
                        $this->contentString .= '<div class="container">
                        <label for="title">Title</label>
                        <input name="title" id="title" type="text" value="'.  $data['title'].'" class="long checkRequired" />
                        </div>
                        
                        
                        <div class="container">
                        <label for="shortTitle">Short (Navigation) Title</label>
                        <input name="shortTitle" id="shortTitle" type="text" value="' . $data['shortTitle'] . '"  class="medium" />
                        </div>
                        
                        <div class="optionalContainer">
							<!-- Hide the Meta info -->
							<span class="hastooltip" >More...</span>
							
							<div class="optional">
							
								<!--  NO NEED FOR A FILENAME FOR THIS KIND OF ITEM
								<div class="container">
								<label for="shortTitle">Filename</label>
								<input name="path" id="filepath" type="hidden" value="' .  $data['filepath'] . '"/>
								<br />' .  $data['filepath'] . '/<input name="filename" id="filename" type="text" value="' .  $data['filename'] . '" class="medium" style="display: inline"/>
								</div>
								-->
						   
								<div class="container">
									<label for="metaTitle">Meta Title</label>
									<input name="metaTitle" id="metaTitle" type="text" value="' .  $data['metaTitle'] . '" class="long" />
								</div>
								<div class="container">
									<label for="metaDescription">Meta Description (or Teaser)</label>
									<textarea rows="5" cols="80" name="metaDescription" id="metaDescription" class="description">' .  $data['metaDescription'] . '</textarea>
								</div>
							</div>
                        </div>
                        
                </td>
                
                <td>
                        <div class="container">
                        <label for="development">Development</label>
                        ' . $selectString . '
                        </div>
                   
                </td>
                
              
                <td class="' .  Model_News::status(strtotime($data['published']),strtotime($data['depublish']) ) . '">';
                      
                     
                        
                        $this->contentString .= '<div class="container">
                        <label for="published">Publish</label> (dd-mm-yyyy)
                        <input name="published" id="published" type="text" value="'. date('d-m-Y',strtotime($data['published'])) .'"  class="short checkRequired" />
                        </div>
                        
                        <div class="container">
                        <label for="depublish">Expire</label> (dd-mm-yyyy) 
                        <input name="depublish"  id="depublish" type="text" value="'. date('d-m-Y',strtotime($data['depublish'])) .'"  class="short checkRequired" />
                        </div>';
                       
                
                 $this->contentString .= '</td>
	</tr>
        
      
        <tr>
		<td colspan="3" class="body">
                
                        <input name="submit" value="Save" type="submit" style="float:right"/>
               

                        <label for="body">Body</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="isHTML"  id="isHTML" type="checkbox" ';
                        
                       
                        
                        
                         $this->contentString .=  ' />
                        <label for="isHTML">is HTML</label>
                        
                        
                        <div class="container">
                        <textarea rows="20" cols="80" name="body" id="body" >' .  $data['body'] . '</textarea>
                        </div>
      

              
                
                </td>
	</tr>
        <tr>
        <td colspan="3" class="submit" >
          <input name="submit" value="Save" type="submit" />
        </td>
        </tr>
        </table>

        </form>
        
        
        <form action="'.$_SERVER['REQUEST_URI'] . '" method="post" name="addImage" id="addImage">
              <input name="id" id="id" type="hidden" value="'.$_GET['id'].'" />
              <input type="file" name="image" id="image" />
              <input type="submit" value="Add/Update Image" />
        </form>
              
        ';
        
       
     
        
        
        //SEPARATE FORM FOR CODE... just for me to see.
        

	}
	
	function breadcrumbArray(){

		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'news','title'=>'News');
		$breadcrumbArray[]=array('fullPath'=>'news?id=' . $_GET['id'] ,'title'=>$this->title );
		return $breadcrumbArray;

        }
       
       
        function cssArray(){
                
              
                $cssArray=array();
                
                $cssArray[]='css/flexi.css'; 
                
		
                return $cssArray;
                

        
        }
        function javaScriptArray(){
                
                $jsArray=array();
                $jsArray[]='js/validate_form.js';              
                $jsArray[]='js/tooltips.js';
                
              
                
                return $jsArray;
        }
       
}

?>

