<?php
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

*/

Class NewsListPage extends Page{

        function __construct($dbPDO){
               
                $this->dbPDO=$dbPDO;
                $this->_initialise();
                
        }
       
       
       function _initialise(){
                
                #require_once ('News/News.php');
                require_once ('News/Model/NAMnews.php');
                
                $newsModel = new Model_NAMNews($this->dbPDO);	
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

                
                                $newsModel->addItem($_POST['title']);
                                
                        }
                
                }
               	
                //Assignment of Item to Development(s)
                if(isset($_POST['assign']) ){
                        
                        $newsModel->assignFromPOST();
                        
                        
                }
 
                 
                 
                 
                 
                $newsString = '';
                
                $newsString .=  '<form class="add_form" name="addNew" method="post" action="'.$_SERVER['REQUEST_URI'].'">';
                $newsString .=  '<label for="title">Title</label><input type="text" name="title" value="" style="width: 30em" />';
                $newsString .=  '<input type="submit" value="Add new item" />';
                $newsString .=  '</form>';
                
                
                
                
             
                $newsModel->isActive=false; //Ove-ride the default - the 
                #echo $newsModel->isActive;
                #exit;
                
              
                
                
                
                $newsModel->getItems();
                
                require_once('Development/Model/Development.php');
                $developments= new Model_Development($this->dbPDO);
                $developments->getItems();
                
                $developmentsArray = $developments->fetchAll();
                
                 # $developmentsArray = $newsModel->getDevelopments();
                #print_r($developmentsArray);
                
                
                #$zebra = 1; #Used for the zebra "tables"
                $counter=0;
                $activeCount=0;
                
                $newsString .= '<table id="itemlist">';
                $newsString .= '<thead>';
                $newsString .= '<tr>
                                        <th class="date first">Publish Date</th>
                                        <th class="date">Expiry Date</th>
                                        <th class="title">Title</th>';
                foreach($developmentsArray as $development){
                        
                        $newsString .= '<th class="development">' . $development['name'] . '</th>';
                }
                                        
                                        
                $newsString .= '                       
                                        <th class="actions">&nbsp;</th>
                                        
                                </tr>';
                $newsString .= '</thead>';
                $newsString .= '<tbody>';
                
                while($row=$newsModel->fetch() ){
                
                        #print_r($row);
                        #exit;
                      
                        $status=Model_News::status(strtotime($row['published']),strtotime($row['depublish']));
                        
                       
                        $newsString .= "\n" . '<tr class="' . $status . '">';
                        
                        $newsString .= "\n" . '<td class="date first">'  . date('d M Y',strtotime($row['published'])) . '</td>';
                        
                        #echo $row['depublish'];
                        #exit;
                        if( !$row['depublish'] || $row['depublish'] == '0000-00-00 00:00:00'){
                                
                               $dateString = 'never';
                                
                        } else {
                                  $dateString = date('d M Y',strtotime($row['depublish']));
                                
                        }
                        
                        $newsString .= "\n" . '<td class="date">'  . $dateString . '</td>';
                        $newsString .= '<td><a href="?id=' . $row['id'] . '">' . htmlentities($row['title'],ENT_QUOTES,'UTF-8')  . '</a></td>';
                        
                        
                      
                        #exit;
                        
                        //Development Assignment
                        $assignedDevelopments = $newsModel->getDevelopments($row['id']);
                        
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
                        
                        $newsString .='<form class="assign" name="assign" method="post" action="'.$_SERVER['REQUEST_URI'].'">
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
                                
                                $newsString .='<td class="development">
                                <input type="checkbox" name="development[' . $development['id'] .']" id="" ' . $checkedString . ' />
                                </td>';
                                
                        }
                        
                        
                         $newsString .='<td class="actions">
                           <input type="submit" value="Update" />
                          
                        </td>
                         </form>
                        ';
                        
                        
                        
                        #if($row['notes']){
                        #$newsString .= '<br />' . $row['notes'];
                        #}
                        
                        #echo '<hr>' . $row['lastUpdate'];
                        
                        /*
                        $elapsed = (time() - strtotime($row['lastUpdate']));
                        
                        switch($elapsed){
                        case( $elapsed < (60*60) ):
                        
                        $newsString .= ' -  ' . round($elapsed/60) . ' minutes ago';
                        
                        break;
                        
                        case($elapsed < (60*60*24) ):
                        
                        $newsString .= ' -  ' . round($elapsed/(60*60) ) . ' hours ago';
                        
                        break;
                        
                        default:
                        $newsString .= ' -  ' . round($elapsed/(60*60*24)  ) . ' days ago';
                        
                        }
                        */
                        
                        #if($row['isActive){
                        
                        #     $newsString .= ' - <a href="http://rotslon01/wwwNakheelCom/www/news/news_detail.php?' . str_replace('/','', $row['path) . '">preview</a>';
                        
                        # }
                        
                        
                        
                        $newsString .= "\n" . '</tr>';
                        
                        
                        
                      
                        $counter++;
                
                }
                 $newsString .= '</tbody>';
                 $newsString .= "\n" . '</table>';
                #echo '<p>' . $activeCount .' active out of ' . $counter . ' ('  . round(($activeCount/$counter)*100,1) . '%)';
                
                #echo $newsString;
                
                $this->contentString .= $newsString;


       }
        function breadcrumbArray(){

		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'news','title'=>'News');
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

