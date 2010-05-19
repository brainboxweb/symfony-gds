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

Class NewsPage extends NormalPage{
     
     ##protected $newsItem;

     function __construct($dbPDO, $pathVars, $basePath, $index){
          
          
          
          $this->index = $index; //The index of the "news" element in the request array
          
          #print_r($pathVars);
          
          $this->originalPathVars = clone $pathVars; ///Note that it must be a CLONE
          
          #want to run the PARENT... but want to "force" it to ignore the last part of the url (if it's an article)
          $this->adjustedPathVars = $pathVars;
          $this->adjustedPathVars->trimToIndex($this->index+1);
          parent::__construct($dbPDO,$this->adjustedPathVars, $basePath);
     }
     
      protected function getContent(){
          
          //Run the parent to get stuff like metaTitle/metaDescription. (Think about making this an automatic call);
          parent::getContent();
          
          if($this->originalPathVars->fetchByIndex($this->index+1)==''){
	       
	       #echo 'Main page'; 
	       $this->_getList();
	       
	  } else {
	       
               #echo 'An article';
               #exit;
               $this->_getItem();
               
               //In this case, the breadcrumb function will have failed.
               //So adjust 
               #echo '<hr>The breadcrumb array is';
               #print_r($this->breadcrumbArray);
               #exit;
               
	        
	      # }
	  }
          
     }
          
      
      
    
	
     
     /**
      * Two cases: "global" news, and development-specific news
      *
      * Note that the first element is different to the rest
      *
      * <li class="main">
     *					<img src="html/images/news/buildings.jpg" alt="img" width="525" height="247" class="main" />
     *					<h1>LOREM IPSUM DOLOR</h1>
     *					<h3>28th March 2008 </h3>
     *
     *					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim.</p>
     *					<p class="text-right"><a href="#" class="x-link">More information</a></p>
     *				</li>
     *				<li>
     *					<h3>LOREM IPSUM DOLOR</h3>
     *					<img src="html/images/news/img_boat.jpg" class="left" alt="img" />
     *					<h4>28th March 2008 </h4>
     *
     *					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim.</p>
     *					<p class="text-right"><a href="#" class="x-link">More information</a></p>
     *				</li>
      * 
      *
      */
     function _getList($year = null){
          
     
          
          require_once('News/News.php');
          
         # echo $this->originalPathVars->fetchByIndex(0);
          
         # if($this->originalPathVars->fetchByIndex(0)=='news-and-updates'){
               //All news
             # require_once('News/Model/News.php');
             #  $newsModel= new Model_News($this->dbPDO);
               
         # } else {
               //Development-specific news
               require_once('News/Model/NAMnews.php');
               $newsModel= new Model_NAMnews($this->dbPDO);
               $newsModel->development=$this->originalPathVars->fetchByIndex($this->index-1);
          
        #  }
          
          $newsModel->getItemsFullDetails();
          
          
          
          $contentString = '<ul class="articles_list">';
          
          $counter = 0;
          while($data = $newsModel->fetch() ){
               
               #print_r($data);
               #exit;
               $this->newsItem = new News();
               $this->newsItem->populate($data);
               
               
               #echo '---';
               #echo $this->newsItem->title;
              # echo  $this->newsItem->metaDescription;
               #exit;
               
               
               
               if($counter==0){ //Main image
                    
                    $contentString .= '
                         <li class="main">
                        
                         
                         <img src="' . $this->basePath . 'html/images/news/' . $this->newsItem->id . '.jpg" class="main" alt="' . $this->newsItem->title . '" width="523" height="245" />
                         <h1>' . $this->newsItem->title .  '</h1>
                         <h4>' . date('M jS  Y' ,strtotime($this->newsItem->published)) . '</h4>
                         <p>'  . $this->newsItem->metaDescription .   '</p>
                         <p class="text-right">
                         <a class="x-link" href="' . $this->basePath . $this->originalPathVars->getLocation();
                         
                         if($this->index==0){
                              
                              $contentString .=  '/item' ;
                              
                         }
                         
                         
                         
                          $contentString .= '/' . $this->newsItem->path . '">More information</a>
                         </p>
                         </li>
                         
                         ';
                    
                    
               } else {
               
                
                    
                    $contentString .= '
                         <li>
                         <h3>' . $this->newsItem->title .  '</h3>
                         
                         <img src="' . $this->basePath . 'html/images/news/' . $this->newsItem->id . '-thumb.jpg" class="left" alt="' . $this->newsItem->title . '" width="117" height="81" />
                         
                         <h4>' . date('M jS  Y' ,strtotime($this->newsItem->published)) . '</h4>
                         <p>'  . $this->newsItem->metaDescription .   '</p>
                         <p class="text-right">
                         <a class="x-link" href="' . $this->basePath . $this->originalPathVars->getLocation();
                         
                         if($this->index==0){
                              
                              $contentString .=  '/item' ;
                              
                         }
                         
                         
                         
                          $contentString .= '/' . $this->newsItem->path . '">More information</a>
                         </p>
                         </li>
                         
                         ';
               }        
               $counter++;
          }
          $contentString .= '</ul>';
          #echo $contentString;
          #exit;
          
          $this->contentString = $contentString;
          
              
     }	

     function _getItem(){
          
         
          
          #require_once('config.php');
          require_once('News/News.php');
          require_once('News/Model/News.php');
          
          #Get the data for the selected news article
          $newsModel=new Model_News($this->dbPDO);
          
          if($this->originalPathVars->fetchByIndex(0)=='news-and-updates'){
              
              $newsModel->getByPath( $this->originalPathVars->fetchByIndex($this->index+2) );
               
          } else {
               
               $this->noIndex=true; //Search engines not to index the Community-specific news (which are dupes of the main news section). 
               $newsModel->getByPath( $this->originalPathVars->fetchByIndex($this->index+1) );
               
          }
          
          #$newsModel->initialise();
          
          
          
          
          $data=$newsModel->fetch();
          #print_r($data);
          #exit;
          
          $contentString ='';
          if($data){
                  
               #Create the Object
               $this->newsItem=new News();
               $this->newsItem->populate($data);
              
               $this->title = ''; //The H1 appears under the image, so we're adding it it content
               $this->metaTitle = $this->newsItem->title;
                           
               
               ##Assume there is an image for now               
                        
                           
               $contentString .= '<img src="' . $this->basePath . 'html/images/news/' . $this->newsItem->id . '.jpg" alt="' . $this->newsItem->title . '" width="523" height="245" class="main" />';                   
               /*
               if($this->newsItem->image){
                    
                    if($newItem->alt){
                        $alt=$this->newsItem->alt;
                    }  else {
                        $alt=$this->newsItem->title;
                    }
                    
               }
               */
               
                 $contentString .= '<h1>' . $this->newsItem->title . '</h1>';
                  
               //Subtitle
               if($this->newsItem->subtitleArray){
               $contentString .= '<ul class="module news_article_subtitle">';
           
                    foreach ($this->newsItem->subtitleArray as $value) {
                         $contentString .= '<li><strong>' . $value . '</strong></li>';
                    }
                    $contentString .= '</ul>';
               }
           
               //Place and Date    
               $contentString .= '<p class="module">';
               
               if($this->newsItem->place){
                    $contentString .= '<span class="news_article_location">' .  $this->newsItem->place . '</span>, ';
               }    
               ///date('jS F Y' ,strtotime($this->newsItem->published))
               $contentString .= date('F jS Y',strtotime($this->newsItem->published) );
               $contentString .= '</p>';
               
               $contentString .= $this->newsItem->body;
                  
          } else {
              #echo 'OOOPS need to redirect';
           
              header("HTTP/1.0 404 Not Found");
              $contentString .= '<h1>News item not found</h1>';
              $contentString .= '<p>The news item you were looking for has been moved or no longer exists.</p>';
             
          }
          $this->contentString=$contentString;
          
         

     }
     
     /**
      * Run the parent's version... then add to it
      *
      */
     
     
     public function getBreadcrumb(){
          
          //Get the parent's value
          parent::getBreadcrumb();
         
          
          #    exit;
          if( $this->originalPathVars->fetchByIndex($this->index+1) ){
                                                      
               $this->breadcrumbArray[]=array('title'=>$this->newsItem->title, 'path'=>'dummy'); //Path won't be used anyway (last element of the crumb)
               //neeed to render it again
               $this->renderBreadcrumb();
          
          }
         
          
          
     }
     
     
     /**
      * Parent definition needs to be over-ridden, because the news ITEM path does not
      * exist in the list of pages
      *
      */
     /*
     protected function getNavigation(){
		    
          // Include CollapsingTree menu
          require_once('UI/CollapsingTree.php');
        
          $location = $this->pathVars->fragment;
          
          //If it's a news ITEM, trim the path before calling the navigations
          if($this->pathVars->fetchByIndex(2)){
               
               $location = substr($location,0,strrpos($location,'/') );
               
	  }
        
          $isActive=true;
          $this->menu= new CollapsingTree($this->dbPDO,$location, $isActive);
	
	
     }
     */
     
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