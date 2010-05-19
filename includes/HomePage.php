<?php
/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description

  May 2007 - adpated to use the Nakheel news "engine"
  Assumptions:
  
     - No year paging (throw-away website)

*/

require_once('NormalPage.php');




Class HomePage extends NormalPage{
     
     ##protected $newsItem;

     function __construct($dbPDO, $pathVars, $basePath){
          
          $this->dbPDO = $dbPDO;
          $this->basePath = $basePath;
          
          parent::__construct($dbPDO, $pathVars, $basePath);
	  
	  $this->getNextEvents(1);
	  $this->getRecentNews();
	 
	  
     }
     
     
     /**
      *
      *
      */
     
     public function getRecentNews(){
          
          require_once('News/News.php');
	  $this->newsArray = News::getRecentByDays($this->dbPDO, 30);
         
	  if(count($this->newsArray)){
	       
	       $this->renderView('homepagenews');
	       
	  }
	 
     }
     
     
     function getNextEvents(){
	  
	  require_once('Event/Model/Event.php');
	  require_once('Event/Event.php');
	  
	  $eventModel= new Model_Event($this->dbPDO);
	  $eventModel->getFuture(2);
	  #$eventsData=
     
	  $eventArray = array();
	  
	  $counter=0;
	  while($data = $eventModel->fetch() ){
	       
	       $counter++;
	       
	       //Skip the second if it's far away in the future)
	       if($counter==2 && $data['start_date'] > time()+60*60*24*8 ){
		    
		    continue;
	       }
	       
	       $event=new Event;
	       $event->populate($data);
	       $eventArray[] = $event;
        
	  }
	  
	  if(!empty($eventArray)){
	       
	       
	       $this->contentString .= '
	       
	       <div id="homepageevents">
	       
	       <div style="float:right; ; margin-top: 24px; width: 295px; text-align: right">
		    <a href="/calendar.xml"><img src="images/feed.gif" width="16" height="16" alt="Subscribe"></a> <a href="/calendar.xml">Subscribe to our RSS feed</a>
	       </div>
	       <h2>Coming Soon</h2>';
	       
	       ob_start();
		    
		    require 'views/calendar-event-table.php';
		    $this->contentString .= ob_get_contents();
		    
	       ob_end_clean();
	       
	       $this->contentString .= '<p style="margin:0;text-align:right"><a href="/calendar">Full Class schedule and Diary dates</a></p>';
	       
	       $this->contentString .= '</div>';
	  }
	  
	  
	 
          
	
}
     
	  
      
	  
     function renderView($view){
	  
	  ob_start();
	       
	       require 'views/' . $view . '.php';
	       
	       $this->contentString .= ob_get_contents();
	  
	  ob_end_clean();
	  
     }
     
        
     function breadcrumbArray(){
          
          #Invoke the parent's function
          $breadcrumbArray = parent::breadcrumbArray();
          
          $this->breadcrumbArray =  $breadcrumbArray . '';
     
          
     }
   
     function cssArray(){
     
               
     }
     
     
   
     

}