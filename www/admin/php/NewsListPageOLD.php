<?php

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
        
    
        
       // A function to apply mysql_real_escape_string   //may not need this anymore
       function escapeValue($value) {
               return mysql_real_escape_string($value);
       }
       
       
       function _initialise(){
                

                
                
                require_once ('News/News.php');
                require_once ('News/Model/NAMnews.php');
                
                $newsModel = new Model_NAMnews($this->dbPDO);	
                $newsModel->isActive=false; //Ove-ride the default - the 
                #echo $newsModel->isActive;
                #exit;
                
                if(isset($_POST['add']) && $_POST['title']){
                
                $newsModel->addItem($_POST['title']);
                
                }
                
                
                
                $newsModel->getItems();
                
                
                
                $zebra = 1; #Used for the zebra "tables"
                $counter=0;
                $activeCount=0;
                while($row=$newsModel->fetch() ){
                
               
                        #print_r($row);
                       # exit;
                        $status=Model_News::status($row['published'],$row['depublish']);
                        #exit;
                        
                        $classString='';
                        $classArray=array();
                        if($zebra%2){
                                $classArray[] = 'even';
                        }
                        if($status=='active'){   
                                $classArray[] = 'active';
                                $activeCount++;
                        }
                        
                        if(count($classArray) ){
                                $classString = implode(' ',$classArray);
                                $classString = 'class = "' . $classString . '" ';
                        }
                        
                        
                        
                        
                        $newsString .= "\n" . '<p ' . $classString . '>'  . $row['the_date'] . ' - <a href="?id=' . $row['id'] . '">' . htmlentities($row['title'],ENT_QUOTES,'UTF-8')  . '</a>';
                        
                        #if($row['notes']){
                        #$newsString .= '<br />' . $row['notes'];
                        #}
                        
                        #echo '<hr>' . $row['lastUpdate'];
                        
                        
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
                        
                        #if($row['isActive){
                        
                        #     $newsString .= ' - <a href="http://rotslon01/wwwNakheelCom/www/news/news_detail.php?' . str_replace('/','', $row['path) . '">preview</a>';
                        
                        # }
                        
                        
                        
                        $newsString .= '</p>';
                        
                        
                        
                        $zebra ++;   
                        $counter++;
                
                }
                #echo '<p>' . $activeCount .' active out of ' . $counter . ' ('  . round(($activeCount/$counter)*100,1) . '%)';
                
                #echo $newsString;
                
                $this->contentString = $newsString;


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

