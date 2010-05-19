<?php
     /**
     * This class needs to provide the following to the parent class:
     *
     * $this->contentString					
     * $this->shortTitle 
     * $this->titleNote 
     * $this->title 
     * $this->description
     * 
     *   May 2007 - adpated to use the Nakheel news "engine"
     *   Assumptions:
     *   
     *      - No year paging (throw-away website)
     * 
     */




require_once('NormalPage.php');

Class LandingPage extends NormalPage{
     
     ##protected $newsItem;

     function __construct($dbPDO, $pathVars, $basePath){
          
          
          $this->dbPDO = $dbPDO;
          $this->basePath = $basePath;
          $this->pathVars = $pathVars;
     
          $this->development=$pathVars->getLocation();
          
          #Have the parents do their normal thing
          parent::__construct($dbPDO, $pathVars, $basePath);
          
          //Add on the other elements to the contentString
          $this->title = null;
          
          $this->recentFeaturedNews();
          #$this->recentNews();
          # $this->recentEvents();
     }
     
     /**
      *  Aiming for tis:
      *
      *   <div id="Feature_1" class="feature">
      *	        <img src="/NAM/www/html/images/content/img_scroll_content.jpg" alt="img" />
      *         <h3>Featured News Story 1</h3>
      *		<p>Donec commodo pulvinar libero. Mauris porttitor. Aenean accumsan. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In mauris dui, porttitor id, condimentum et, lobortis scelerisque, dui. Vivamus nunc nisi, dapibus id, varius quis, sollicitudin vel, neque. Sed aliquet. Mauris lacinia feugiat dui. Sed at turpis. Praesent dui. Quisque tempor sem. Sed sed diam. Mauris mollis dignissim leo...
      *		<a href="#">Read more</a></p>
      *	  </div>
      */
     
	protected function recentFeaturedNews(){
	
		require_once('News/NAMnews.php');
		require_once('News/Model/NAMnews.php');
	
		$newsModel= new Model_NAMnews($this->dbPDO);
		$newsModel->limit = 5;
		$newsModel->development=$this->development;
		$newsModel->featured = true;
		$newsModel->getItemsFullDetails();
	
		$counter=0;
	
		$recentNewsString  = '<div id="scroll_top" class="narrow"></div>';
		$recentNewsString .= '<div id="scroll_bg" class="narrow">';
		$recentNewsString .= '	<div id="scroll_outer">';
		$recentNewsString .= '		<div id="scroll_inner">';
	
		while($data = $newsModel->fetch() ){
		
			$newsItem = new NAMnews();
			$newsItem->populate($data);
			$newsItemHtmlId = 'Article_' . ($counter +1) . ':_' . str_replace(" ", "_", $newsItem->title); 
			
			$recentNewsString .= '			<div id="' . $newsItemHtmlId . '" class="feature">';
			#$recentNewsString .= '				<img src="' . $this->basePath . 'html/images/content/img_scroll_content.jpg" alt="img" />';
			$recentNewsString .= '				<img src="' . $this->basePath . 'html/images/news/' . $newsItem->id . '-landing.jpg" alt="' . $newsItem->title . '" width="334" height="252" />';                   
			$recentNewsString .= '				<div class="feature_content">';
			$recentNewsString .= '					<a href="#" id="' . $newsItemHtmlId.'_anchor"></a>';
			$recentNewsString .= '					<h3>' . $newsItem->title . '</h3>';
			$recentNewsString .= '					<p><strong>' . $newsItem->metaDescription . '</strong></p>';
			$recentNewsString .= 					$this->word_limiter($newsItem->body, 25);
			$recentNewsString .= '					<a href="' . $this->basePath . $this->development . '/news/' . $newsItem->path .'">Read more</a></p>';
			$recentNewsString .= '				</div>';
			$recentNewsString .= '			</div>';
			
			$counter++;
		}
		
		$recentNewsString .= '		</div>';
		$recentNewsString .= '	</div>';
		$recentNewsString .= '</div>';
	
		#echo $recentNewsString;
		#exit;
	
		$this->contentString = $recentNewsString .    $this->contentString;
	}
     
     /**
      * Trying a new approach: supplying an array of objects to the page.
      *
      *  
      */
     
     public function getNewsObjectArray(){
           
          require_once('News/NAMnews.php');
          require_once('News/Model/NAMnews.php');
          
          
          $newsModel= new Model_NAMnews($this->dbPDO);
          $newsModel->limit = 3;
          $newsModel->development=$this->development;
          #$newsModel->featured = true;
          $newsModel->getItems();
          
          $counter=0;
         
          
          $newsObjectArray=array();
          while($data = $newsModel->fetch() ){
               
              
               $newsItem = new NAMnews();
               
               $newsItem->populate($data);
               
               $newsObjectArray[] = $newsItem;

          }
          
          return $newsObjectArray;
     }
     
     /**
      *  
      */
     public function getEventObjectArray(){
           
          require_once('Event/NAMevent.php');
          require_once('Event/Model/NAMevent.php');
          
          
          $eventModel= new Model_NAMevent($this->dbPDO);
          $eventModel->limit = 2;
          $eventModel->development=$this->development;
          #$eventModel->featured = true;
          $eventModel->getItemsFullDetails();
          
          $eventObjectArray=array();
          
          while($data = $eventModel->fetch() ){
               
              #print_r($data);
              #exit;
               $eventItem = new NAMevent();
               
              
               $eventItem->populate($data);
               #echo '<br />uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu';
               # print_r($eventItem);
               #exit;
               
               
               $eventObjectArray[]=$eventItem;
			

          }
          
          
          return $eventObjectArray;
     }	
     


     
     /*          
     function breadcrumbArray(){
          
          #Invoke the parent's function
          $breadcrumbArray = parent::breadcrumbArray();
          
          $this->breadcrumbArray =  $breadcrumbArray . 'ppppp';
     
          
     }
   
     function cssArray(){
               return array('news.css');
          }
     
     
     
     function getNavString(){
          
          $menu=    new MenuBB($dbPDO,$baseURL, $pathVars->section(), $pathVars->fragment );
          $this->navString =  $menu->getNav();
          
          
     }
     */
    
    
}