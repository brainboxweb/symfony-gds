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

Class EventListPage extends Page{

        function __construct($dbPDO){
               
                $this->dbPDO=$dbPDO;
                $this->_initialise();
                
        }
       
       
       function _initialise(){
                
                #require_once ('event/event.php');
                require_once ('Event/Model/Event.php');
                
                $eventModel = new Model_Event($this->dbPDO);	
                 //Add Item form
                 
                if(isset($_POST['title']) ){  
                        
                        #print_r($_POST);
                        #exit;
                   
                        require_once('forms/validation.php');
                        
                        $validator=new FormValidator();
                        
                        
                        
                        
                        $validator->isEmpty('title', 'Please enter a Title');
                        //$validator->isEmpty('filename', 'Please Filename for the page'); NOT REQUIRED FOR THIS TYPE
                        //$validator->isAlphaNumbericAndDash('filename', 'Numbers, letters and dashes only for the filename');
                        
                        
                        if($validator->isError() ){
                                
                                 $this->contentString .= '<p class="error">Please correct the following error(s):</p><ul>';
                                 foreach ($validator->getErrorList() as $name=>$value){
                                        
                                        $this->contentString .= '<li>' . $value['msg'] .'</li>';
                                        
                                        
                                 }
                                $this->contentString .= '</ul>';
                                 
                                 
                        }
                        else{

                
                                $eventModel->addItem($_POST['title']);
                                
                        }
                
                }
               							
                //Assignment of Item to Development(s)
                if(isset($_POST['assign']) ){
                        
                        $eventModel->assignFromPOST();
                        
                        
                }
                 
                 
                 
                 
                $eventString = '';
                
                $eventString .=  '<form class="add_form" name="addNew" method="post" action="'.$_SERVER['REQUEST_URI'].'">';
                $eventString .=  '<label for="title">Title</label><input type="text" name="title" value="" style="width: 30em" />';
                $eventString .=  '<input type="submit" value="Add new item" />';
                $eventString .=  '</form>';
                
                
                
                
             
                $eventModel->isActive=false; //Ove-ride the default - the 
                #echo $eventModel->isActive;
                #exit;
                
              
                
                
                
                $eventModel->getItems();
                
                
               
                require_once('Development/Model/Development.php');
                $developments= new Model_Development($this->dbPDO);
                $developments->getItems();
                
                $developmentsArray = $developments->fetchAll();
                
                
                
                #$zebra = 1; #Used for the zebra "tables"
                $counter=0;
                $activeCount=0;
                
                $eventString .= '<table id="itemlist">';
                $eventString .= '<thead>';
                $eventString .= '<tr>     
                                        <th class="date first">Publish Date</th>
                                        <th class="date">Expiry Date</th>
                                        <th class="date">Event Date</th>
                                        <th class="title">Title</td>';
                                        
                foreach($developmentsArray as $development){
                        
                        $eventString .= '<th class="development">' . $development['name'] . '</th>';
                }
                                        
                                        
                $eventString .= '                       
                                        <th class="actions">&nbsp;</th>
                                        
                                </tr>';
                $eventString .= '</thead>';
                $eventString .= '<tbody>';
                
                while($row=$eventModel->fetch() ){
                
               
                      
                        $status=Model_Event::status(strtotime($row['published']),strtotime($row['depublish']));

                        $eventString .= "\n" . '<tr class="' . $status . '">';
                        
                       
                        
                        $eventString .= "\n" . '<td class="date first">'  . date('d M Y',strtotime($row['published'])) . '</td>';
                        
                        #echo $row['depublish'];
                        #exit;
                        if(!$row['depublish'] || $row['depublish']== '0000-00-00 00:00:00'){
                                
                                 $dateString = 'never';
                               
                                
                        } else {
                                
                                 $dateString = date('d M Y',strtotime($row['depublish']));
                        }
                        
                        $eventString .= "\n" . '<td class="date">'  . $dateString . '</td>';
                        
                        
                        $dateString = date('d M Y',strtotime($row['start_date']) );
                        
                        #echo '<p>' . $row['end_date'];
                        if( !($row['end_date'] =='' ||  $row['end_date'] == '0000-00-00 00:00:00')  ){
                                  $dateString .= ' - ' . date('d M Y',strtotime($row['end_date']) );
                        } 
                        
                        $eventString .= "\n" . '<td class="date">'  . $dateString . '</td>';
                        
                        
                        
                        
                        $eventString .= '<td class="title"><a href="?id=' . $row['id'] . '">' . htmlentities($row['title'],ENT_QUOTES,'UTF-8')  . '</a></td>';
                        
                        
                        
                        
                        
                        
                          //Development Assignment
                        /*
                        //$assignedDevelopments = $eventModel->getDevelopments($row['id']);
                        
                        #Get an array of IDs
                        $assignedDevelopmentsIDarray=array();
                        
                        if($assignedDevelopments){
                                foreach($assignedDevelopments as $development){
                                        $assignedDevelopmentsIDarray[]=$development['id'] ;
                                }
                        }
                        #print_r($assignedDevelopmentsIDarray);
                        #exit;
                        
                        
                        //Development Assignment Form
                        
                        $eventString .='<form class="assign" name="assign" method="post" action="'.$_SERVER['REQUEST_URI'].'">
                                <input type="hidden" name="id" value="' . $row['id'] . '" />
                                <input type="hidden" name="assign" value="true" />';
                          
                        foreach($developmentsArray as $development){
                                 $checkedString = '';
                                if(count($assignedDevelopmentsIDarray)){
                                        
                                        #echo 'dev is is ' . $development['id'];
                                        
                                        if(in_array($development['id'],$assignedDevelopmentsIDarray) ) {
                                               # echo 'A MATCH';
                                               $checkedString = ' checked="checked" ';
                                               #exit;
                                        }
                                } 
                                
                                $eventString .='<td class="development">
                                <input type="checkbox" name="development[' . $development['id'] .']" id="" ' . $checkedString . ' />
                                </td>';
                                
                        }
                        
                        
                         $eventString .='<td class="actions">
                           <input type="submit" value="Update" />
                          
                        </td>
                         </form>
                        ';
                        
                        */
                        
                        
                        
                        #if($row['notes']){
                        #$eventString .= '<br />' . $row['notes'];
                        #}
                        
                        #echo '<hr>' . $row['lastUpdate'];
                        
                        /*
                        $elapsed = (time() - strtotime($row['lastUpdate']));
                        
                        switch($elapsed){
                        case( $elapsed < (60*60) ):
                        
                        $eventString .= ' -  ' . round($elapsed/60) . ' minutes ago';
                        
                        break;
                        
                        case($elapsed < (60*60*24) ):
                        
                        $eventString .= ' -  ' . round($elapsed/(60*60) ) . ' hours ago';
                        
                        break;
                        
                        default:
                        $eventString .= ' -  ' . round($elapsed/(60*60*24)  ) . ' days ago';
                        
                        }
                        */
                        
                        #if($row['isActive){
                        
                        #     $eventString .= ' - <a href="http://rotslon01/wwwNakheelCom/www/event/event_detail.php?' . str_replace('/','', $row['path) . '">preview</a>';
                        
                        # }
                        
                        
                        
                        $eventString .= "\n" . '</tr>';
                        
                        
                        
                      
                        $counter++;
                
                }
                 $eventString .= '</tbody>';
                 $eventString .= "\n" . '</table>';
                #echo '<p>' . $activeCount .' active out of ' . $counter . ' ('  . round(($activeCount/$counter)*100,1) . '%)';
                
                #echo $eventString;
                
                $this->contentString .= $eventString;


       }
        function breadcrumbArray(){

		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'events','title'=>'Events');
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

