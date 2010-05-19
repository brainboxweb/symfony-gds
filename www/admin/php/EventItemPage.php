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
    // 17 June 2008 - Adding date-picker

*/

Class EventItemPage extends Page{
        
        var $className;

        function __construct($dbPDO, $basePath){
		
		
                #$this->db=$db;
	        $this->dbPDO=$dbPDO;
                $this->basePath=$basePath;
		
		$this->_initialise();       

        }
        
    
        
       // A function to apply mysql_real_escape_string   //may not need this anymore
       #function escapeValue($value) {
        
        #       return mysql_real_escape_string($value);
        
        #}
       
       
       function _initialise(){
        
        
                //require_once ('Event/Event.php');
                require_once ('Event/Model/NAMevent.php');
                
                $newsModel = new Model_NAMevent($this->dbPDO);
                $newsModel->isActive=false;
                 //Add Item form
                
                
                
                if(isset($_POST['MAX_FILE_SIZE'])  ){
                    
                    $imageDir = $_SERVER['DOCUMENT_ROOT'] . $this->basePath . 'html/images/events/';
                    //Correct the double "//"
                    $imageDir = str_replace('//','/',$imageDir);
                    
                    $newsModel->updateImages($imageDir);//parameter is the folder to which the image is to be stored

                }
        
        
                if(isset($_POST['main'])  ){
                        
                        //print_r($_POST);
                   
                   
						// echo '$_POST["start"]: ' . $_POST["startDate"] . '<br>';
						// echo '$_POST["finish"]: ' . $_POST["endDate"] . '<br>';
						// echo '$_POST["published"]: ' . $_POST["published"] . '<br>';
						// echo '$_POST["depublish"]: ' . $_POST["depublish"];
                   
                        require_once('forms/validation.php');
                        
                        $validator=new FormValidator();
                        
                        
                        
                        
                        $validator->isEmpty('title', 'Please enter a Title for the page');
                        //$validator->isEmpty('filename', 'Please Filename for the page'); NOT REQUIRED FOR THIS TYPE
                        //$validator->isAlphaNumbericAndDash('filename', 'Numbers, letters and dashes only for the filename');
                        
                        $validator->isEmpty('published', 'Please enter a Publish date');
                        #$validator->isEmpty('depublish', 'Please enter an Expiry date');
                        
                        //Path may be blank... but if present must be well-formed.
                        $validator->isAlphaNumbericAndDash('path','Path may be letter, number and dashes only');
                        
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
                        <h3><label for="title">Title*</label></h3>
                        <input name="title" id="title" type="text" value="'.$data['title'].'" class="long checkRequired" />
                        </div>
                        
                        
                        <div class="container">
                        <h3><label for="subtitle">Subtitle</label><span> - delimit with "|" if more than one</span></h3>
                        <input name="subtitle" id="subtitle" type="text" value="'.$data['subtitle'].'"  class="long" />
                        </div>
                        
                        <div class="container">
                        <h3><label for="path">Path</label><span> - will be created automatically if left blank</span></h3>
                        <input name="path" id="path" type="text" value="'.$data['path'].'"  class="long" />
                        </div>
                        
                        <div class="optionalContainer">
                        
							<!-- Hide the Meta info -->
							<span class="hastooltip" >More...</span>
							
							<div class="optional">
								<div class="container">
									<h3><label for="metaTitle">Meta Title</label><span> - will be created from Title if blank</span></h3>
									<input name="metaTitle" id="metaTitle" type="text" value="' . $data['meta_title'] . '" class="long" />
								</div>
								<div class="container">
									<h3><label for="metaDescription">Meta Description </label><span> - will be created from subtitle/body if blank</span></h3>
									<textarea rows="5" cols="80" name="metaDescription" id="metaDescription" class="description">' . $data['meta_description'] . '</textarea>
								</div>
                      		</div>
							
                        </div>
                        
                        
                        
                </td>';
                
                //Prepare the Start/End date info
                
                //Always a start date?
                $startDate = date('d-m-Y',strtotime($data['start_date']));
                
              
                $noEndDateString = '';
                $endDateString = '';
                
                if(strlen($data['end_date']) > 0){
                    $endDate = date('d-m-Y',strtotime($data['end_date']));
                    $endDateString = ' checked="checked" ';
                } else {
                    $endDate = date('d-m-Y',(strtotime($data['start_date']) + 24*60*60)); // Next day
                    $noEndDateString = ' checked="checked" ';
                } 

				
				$this->contentString .= '
                <td>
                    <div class="calender_container startend">
                        <h3><label for="start_date">Event Start Date</label></h3>
                        <input type="text" id="startDate" name="startDate" class="date" value="' . $startDate . '" />
                        
                        <p>&nbsp;</p>
                        <h3>Event End Date</h3>
                        
                        <input type="radio" id="oneday_true" name="oneday"  ' . $noEndDateString . 'value="true" />
                        <label for="oneday_true">One day event</label>
                        
                        <br />
                        
                        <input type="radio" id="oneday_false" name="oneday"  ' . $endDateString . ' value="false" />
                        <label for="oneday_false">
                        <input type="text" id="endDate" name="endDate" class="date"  value="' . $endDate . '" />
                        </label>
                            
                    </div>
                </td>';
                
                
                
                //Prepare for the Publish/ Depublish dates
               
                //Get the status of the item
                $status=Model_Event::status(strtotime($data['published']),strtotime($data['depublish']));
                
                $published = date('d-m-Y',strtotime($data['published'])); //Always a $published?
				
                $expireString = '';
                $neverExpireString = '';
                
                if(strlen($data['depublish']) > 0){
                        $depublish = date('d-m-Y',strtotime($data['depublish']));
                        $expireString = ' checked="checked" ';
                        } else {
                        //If no expiry date stored, provide a default a 31 days ahead of the publish date
                        $depublish = date('d-m-Y',(strtotime($data['published']) + 31*24*60*60)); // 31 days in the future
                        $neverExpireString = ' checked="checked" ';
                }
                
                
                #echo '<hr>' . $data['depublish']; 
                
                $this->contentString .= '<td class="' . $status . '">
				
                	<div class="calender_container">
                                 <h3><label for="published">Publish Date</label></h3>
                                <input type="text" id="published" name="published" class="date" value="' . $published . '" />
                              
                                <p>&nbsp;</p>
                                <h3>Expiry Date</h3>
                               
                                <input type="radio" id="expire_never" name="expire"  ' . $neverExpireString . 'value="never" />
                                <label for="expire_never">Never expire</label>
                                
                                <br />

                                <input type="radio" id="expire_date" name="expire"  ' . $expireString . ' value="date" />
                                <label for="expire_date">
                                <input type="text" id="depublish" name="depublish" class="date"  value="' . $depublish . '" />
                                </label>
                            
                    </div>

		</td>
	</tr>
        
      
        <tr>
		<td colspan="3" class="body">
                
                        <input name="submit1" id="submit1" value="Save" type="submit" style="
						float:right;"/>
               
                        <br />
                        <h3><label for="body">Body</label></h3>
                        
                        
                        
                        <div class="container">
                        <textarea rows="20" cols="80" name="body" id="body" >' . $data['body'] . '</textarea>
                        </div>
      

              
                
                </td>
	</tr>
        <tr>
        <td colspan="3" class="submit" >
          <input name="submit2" value="Save" id="submit2" type="submit" />
        </td>
        </tr>
        </table>

        </form>
        
        
        
        
        <!-- images -->
        <!-- Image names are changed, but there is no image manipulation -->
        
        
        <form action="'.$_SERVER['REQUEST_URI'] . '" method="post" enctype="multipart/form-data" name="addImage" id="addImage">
        
                <input name="id" id="id" type="hidden" value="' . $_GET['id'] . '" />
                <input type=hidden name="MAX_FILE_SIZE" value="1048576" />
				
				<h2>Images</h2>
				
				<table summary="layout" class="images">
					<tr>
						<td class="label"><label for="image[0]">Main</label></td>
						<td class="path"><input type="file" name="image[0]" size="60" /></td>
						
					</tr>
					<tr>
						<td class="label"><label for="image[1]">Thumb</label></td>
						<td class="path"><input type="file" name="image[1]" size="60" /></td>
						
					</tr>
					<tr>
						<td class="label"><label for="image[2]">Featured</label></td>
						<td class="path"><input type="file" name="image[2]" size="60" /></td>
						
					</tr>
					<tr>
						<td class="label"><label for="image[3]">Landing</label></td>
						<td class="path"><input type="file" name="image[3]" size="60" /></td>
						
					</tr>
					<tr>
						<td class="label"><label for="image[4]">Landing</label></td>
						<td class="path"><input type="file" name="image[4]" size="60" /></td>
					</tr>
					<tr>
						<td class="submit" colspan="3"><input type="submit" value="Add/Update Image(s)" /></td>
					</tr>
				</table>
                
        </form>
		
        <p></p>';
                
        
        
      
        
     
        
        
        //SEPARATE FORM FOR CODE... just for me to see.
        

	}
	
	function breadcrumbArray(){

		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'news','title'=>'Events');
		$breadcrumbArray[]=array('fullPath'=>'news?id=' . $_GET['id'] ,'title'=>$this->title );
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
                $jsArray[]='js/validate_form.js';              
                $jsArray[]='js/tooltips.js';
                $jsArray[]='js/jquery.js';
                $jsArray[]='js/ui.datepicker.js';
                $jsArray[]='js/calendar-stuff-event.js'; // set up for the jquery calendar
              
                
                return $jsArray;
        }
       
}