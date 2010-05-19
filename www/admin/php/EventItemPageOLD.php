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

Class EventItemPage extends Page{
        
        var $className;

        function __construct($dbPDO){
		
		
                #$this->db=$db;
	        $this->dbPDO=$dbPDO;
		
		$this->_initialise();       

        }
        
    
        
       // A function to apply mysql_real_escape_string   //may not need this anymore
       #function escapeValue($value) {
        
        #       return mysql_real_escape_string($value);
        
        #}
       
       
       function _initialise(){
        
        
                //require_once ('Event/Event.php');
                require_once ('Event/Model/Event.php');
                
                $newsModel = new Model_Event($this->dbPDO);
                $newsModel->isActive=false;
                 //Add Item form
                
        
        
        
                if(isset($_POST['main'])  ){
                        
                        //print_r($_POST);
                   
                   
                        require_once('forms/validation.php');
                        
                        $validator=new FormValidator();
                        
                        
                        
                        
                        $validator->isEmpty('title', 'Please enter a Title for the page');
                        //$validator->isEmpty('filename', 'Please Filename for the page'); NOT REQUIRED FOR THIS TYPE
                        //$validator->isAlphaNumbericAndDash('filename', 'Numbers, letters and dashes only for the filename');
                        
                        $validator->isEmpty('published', 'Please enter a Publish date');
                        #$validator->isEmpty('depublish', 'Please enter an Expiry date');
                        
                        if($validator->isError() ){
                                
                                 $this->contentString .= '<p class="error">Please correct the following error(s):</p><ul>';
                                 foreach ($validator->getErrorList() as $name=>$value){
                                        
                                        $this->contentString .= '<li>' . $value['msg'] .'</li>';
                                        
                                        
                                 }
                                $this->contentString .= '</ul>';
                                 
                                 
                        }
                        else{
                                
                                $newsModel->updateFromPOST();
                               
                        }
                }
                
                
                $data = $newsModel->getById($_GET['id']);
                
                //print_r($data);
                
                
              
                
                
                //echo $data['code;
                //e//xit;
                
                //Header for the page				 
                if( $data['title'] ){
        
                $this->title .= $data['title'] ;
                
                }
                else{
                        
                          $this->title .= 'Home' ;
                }
                
               
                //Try a hadn-coded form
                $this->contentString .= '
        
                
                
                <form action="'.$_SERVER['REQUEST_URI'] . '" method="post" name="updateflexiItem" id="updateflexiItem">
                <input name="main" id="main" type="hidden" value="1" />
                 <input name="id" id="id" type="hidden" value="' . $_GET['id'] . '" />
                
                <table class="form" border=0>
              
                
                
                <tr>
                        <td class="col1">';
                    
                                
                        $this->contentString .= '<div class="container">
                        <label for="title">Title*</label>
                        <input name="title" id="title" type="text" value="'.$data['title'].'" class="long checkRequired" />
                        </div>
                        
                        
                        <div class="container">
                        <label for="subtitle">Subtitle</label> - delimit with "|" if more than one
                        <input name="subtitle" id="subtitle" type="text" value="'.$data['subtitle'].'"  class="long" />
                        </div>
                        
                        <div class="container">
                        <label for="path">Path</label> - will be created automatically if left blank
                        <input name="path" id="path" type="text" value="'.$data['path'].'"  class="long" />
                        </div>
                        
                        <div class="optionalContainer">
                        
							<!-- Hide the Meta info -->
							<span class="hastooltip" >More...</span>
							
							<div class="optional">
                        
								<div class="container">
									<label for="metaTitle">Meta Title</label> - will be created from Title if blank
									<input name="metaTitle" id="metaTitle" type="text" value="' . $data['meta_title'] . '" class="long" />
								</div>
								<div class="container">
									<label for="metaDescription">Meta Description </label> - will be created from subtitle/body if blank
									<textarea rows="5" cols="80" name="metaDescription" id="metaDescription" class="description">' . $data['meta_description'] . '</textarea>
								</div>
                      		</div>
							
                        </div>
                        
                        
                        
                </td>
                
                <td>
                 
                     
				<div class="container">
				<label for="startDate">Start Date</label> (dd-mm-yyyy)
				<input name="startDate" id="startDate" type="text" value="'. date('d-m-Y',strtotime($data['start_date']) ) .'"  class="short checkRequired" />
				</div>';
				
				
				
				
			//May or may not be an end date
			#echo '<p>' . $data['end_date'];
                        
                       
                        
                        
			if($data['end_date']=='' || $data['end_date']=='0000-00-00 00:00:00'){
				 $endDate = '';
			} else {
                                $endDate=date('d-m-Y',strtotime($data['end_date']) ) ;
                               
                        }
                        
				
				
			$this->contentString .= '<div class="container">
				<label for="endDate">End Date</label> (dd-mm-yyyy)
				<input name="endDate"  id="endDate" type="text" value="'. $endDate .'"  class="short" />
                                Leave <strong>End Date</strong> blank for one-day events
				</div>
			 
			</td>
                 
                </td>';
                
                //print_r($data);
                //Get the status of the item
                $status=Model_Event::status(strtotime($data['published']),strtotime($data['depublish']));
                
                
                #echo '<hr>' . $data['depublish']; 
                
                $this->contentString .= '<td class="' . $status . '">';
                        
                        $this->contentString .= '<div class="container">
                        <label for="published">Publish*</label> (dd-mm-yyyy)
                        <input name="published" id="published" type="text" value="'. date('d-m-Y',strtotime($data['published'])) .'"  class="short checkRequired" />
                        </div>';   
                        
                if($data['depublish']=='' || $data['depublish']=='0000-00-00 00:00:00'){
                        $dateString = '';
                        $checkedString = ' checked="checked"';
                       
                        
                } else {
                         $dateString = date('d-m-Y',strtotime($data['depublish']));
                        $checkedString = '';
                }
                        
                 
                 
                        
                          $this->contentString .= '<div class="container">
                        <label for="depublish">Expire</label> (dd-mm-yyyy) 
                        <input name="depublish"  id="depublish" type="text" value="'.  $dateString .'"  class="short" />
                          Leave <strong>Expire</strong> blank for items that never expire
                        
                        </div>';
                       
                
                 $this->contentString .= '</td>
	</tr>
        
      
        <tr>
		<td colspan="3" class="body">
                
                        <input name="submit" value="Save" type="submit" style="float:right"/>
               
                        <br />
                        <label for="body">Body</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        
                        
                        <div class="container">
                        <textarea rows="20" cols="80" name="body" id="body" >' . $data['body'] . '</textarea>
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
        ';
        
      
        
     
        
        
        //SEPARATE FORM FOR CODE... just for me to see.
        

	}
	
	function breadcrumbArray(){

		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'news','title'=>'Event');
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

