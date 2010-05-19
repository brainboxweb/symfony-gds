<?php
/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description


*/

Class NewsAndEventsPage extends Page{


     function __construct($db,$basePath){
		      
	  $this->db=$db;
          $this->basePath=$basePath;
          $this->_initialise();
          
          $this->metaTitle='News and Events';
          
     }			
	  
     function _initialise(){			

         
     ///////NEWS AND EVENTS
     
     require_once('articles/NewsItems.php');
     
     //News can't be any more than one month old.
     
     $params=array('active'=>1 );
     $limit=array('offset'=>0, 'number'=>3); //Three most recent
     $table='news';
     $articles=new NewsItems($this->db,$table,$params,$limit);
     
     //$lastMonth=  time() - ( 1*60*60*24*31 );
     //echo $lastMonth;
     //echo date('d-m-y',$lastMonth) ;
     
    
     $newsString .= '<div class="news">';
     while ( $theArticle=$articles->fetch() ) {
          $newsString .= '<div class="item">';
          $newsString .= '<h2><a href="'.$this->basePath.'news-and-events/news/' . $theArticle->id() .'">' . $theArticle->title . '</a></h2>';
          $newsString .= '<p class="date">Added: ' . date('j M Y', $theArticle->published() ) .'</p>';
          $newsString .= '<p class="teaser">' . $theArticle->teaser(20) . ' <a href="'.$this->basePath.'news-and-events/news/' . $theArticle->id() .'">More&#8230;</a></p>';
          $newsString .= '</div>';
     }
     
     $newsString .='<p class="archive">[<a href="'.$this->basePath.'news-and-events/news">News archive&#8230;</a>]</p>';
     $newsString .='</div>';
     
     
     
     require_once('articles/EventItems3.php');
     
     //Will always be required
     $params=array('dummy' => 'startdate > ' . time()  );
     $articles=new eventItems($this->db,true,$params);//true means active only 
     
     
     
     $eventString='<h1>Forthcoming Events&hellip;</h1>';
     $eventString .= '<div class="events">';
     while ( $theArticle=$articles->fetch() ) {
          $eventString .= '<div class="item">';
          $eventString .= '<h2><a href="'.$this->basePath.'news-and-events/events/' . $theArticle->id() .'">' . $theArticle->daterange()  . ' - ' .  $theArticle->title . '</a></h2>';
          $eventString .=  '<p class="teaser">' . $theArticle->teaser(20). ' <a href="'.$this->basePath.'news-and-events/events/' . $theArticle->id() .'">More&#8230;</a></p>';
          $eventString .= '</div>';
     }
     $eventString .='<p class="archive">[<a href="'.$this->basePath.'news-and-events/events">Event archive&#8230;</a>]</p>';  
     $eventString .='</div>';
     
     
     $this->contentString='';  
     
     
         
     if($newsString != ''){
        
             $this->contentString .=  $newsString;
     
         
     }
     
     if($eventString != ''){
         
            $this->contentString .=  $eventString;
            
     }
     
     $this->title='Latest News...';
     
     
     }
}
?>