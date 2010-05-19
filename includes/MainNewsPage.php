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


Class MainNewsPage extends Page{

     function __construct($dbPDO, $pathVars){
     
          $this->pathVars=$pathVars;
          
          $this->dbPDO=$dbPDO;
         
          #$this->basePath=$basePath;
	  
	  $this->title='News';
          $this->metaTitle='News';
          
	  $this->_getList();

     }			

	

     
     function _getList($year = null){
          
          #echo 'herere';
          
          //require_once('config.php');
          require_once('News/News.php');
          require_once('News/Model/News.php');
          
          $newsModel= new Model_News($this->dbPDO);
          $newsModel->development=$this->pathVars->section();
          $newsModel->getItems(10);
          
          $contentString = '';
          
          
          while($data = $newsModel->fetch() ){
              #print_r($data);
              #exit;
              $newsItem = new News();
              $newsItem->populate($data);
              
              
              //Fix the ampersands
              #pattern='/&(?!amp;)/';
              #$title = preg_replace($pattern, '&amp;', $newsItem->title);    
              
               $contentString .= '<li><a href="news-and-updates/news/' . $newsItem->path . '">' . $newsItem->title . '</a></li>';
              
          }
          
          #echo $contentString;
          #exit;
          
          $this->contentString = $contentString;
          
          /*
          
	  require_once('articles/Model/News.php');
	  require_once('articles/News.php');
	  
	  $newsModel = new Model_News($this->dbPDO);
	  $newsModel->getItemsByYear($year);
	  
          
          $newsString = $this->linkString;
          $newsString .= '<div class="news">';
          while ( $data =  $newsModel->fetch() ) {
	       
	       $newsItem = new News();
	       $newsItem->populate($data);
	       
	       
               $newsString .= '<div class="item">';
               $newsString .= '<h2><a href="'.$this->basePath.'news-and-events/news/' . $newsItem->id .'">' . $newsItem->title . '</a></h2>';
               $newsString .= '<p class="date">Added: ' . date('j M Y', $newsItem->published ) .'</p>';
               $newsString .= '<p class="teaser"><a href="'.$this->basePath.'news-and-events/news/' . $newsItem->id .'">More&#8230;</a></p>';
               $newsString .= '</div>';
          }
          $newsString .='</div>';
          
          
                      
          //Provide it to the parent class    
          $this->contentString .=$newsString;   
         // $this->code=$item->code();
          */              
     }	
					
							
												
				
     function _getItem(){
		
       
                    
          #require_once('config.php');
          require_once('News/News.php');
          require_once('News/Model/News.php');
          
          #Get the data for the selected news article
          $newsModel=new Model_News($this->dbPDO);
          $newsModel->getByPath( $this->pathVars->fetchByIndex(1) );
          $data=$newsModel->fetch();
          #print_r($data);
         # exit;
          
          $contentString ='';
          if($data){
                  
               #Create the Object
               $newsItem=new News();
               $newsItem->populate($data);
              
                $this->title = $newsItem->title;
               $this->metaTitle = $newsItem->title;
                                                  
               if($newsItem->image){
                    
                    if($newItem->alt){
                        $alt=$newsItem->alt;
                    }  else {
                        $alt=$newsItem->title;
                    }
                    
                    $contentString .= '<img src="../images/news/articles/'  .  $newsItem->image . '" class="module" alt="'  . $newsItem->alt . '" width="' . $newsItem->width . '" height="' . $newsItem->height . '"  />';
               }
                  
                  
                  //Subtitle
                  if($newsItem->subtitleArray){
                  $contentString .= '<ul class="module news_article_subtitle">';
              
                      foreach ($newsItem->subtitleArray as $value) {
                          $contentString .= '<li><strong>' . $value . '</strong></li>';
                      }
                      $contentString .= '</ul>';
                  }
              
                  //Place and Date    
                  $contentString .= '<p class="module">';
                  
                  if($newsItem->place){
                      $contentString .= '<span class="news_article_location">' .  $newsItem->place . '</span>, ';
                  }    
                  
                  $contentString .= date('F jS Y',strtotime($newsItem->theDate) );
                  $contentString .= '</p>';
                  
                  $contentString .= $newsItem->body;
                  
          } else {
              #echo 'OOOPS need to redirect';
              #exit;
              
              
              #$redirectString= 'Refresh: 0; url=http://' . $_SERVER['SERVER_NAME'] .  $config['basePath'] . 'news/';
              #echo $redirectString;
              #header( $redirectString, false, 404);
              header("HTTP/1.0 404 Not Found");
              $contentString .= '<h1>News item not found</h1>';
              $contentString .= '<p>The news item you were looking for has been moved or no longer exists.</p>';
              #$contentString .= '<p>Please click here to return to the main <a href="' . $config['basePath'] . 'news/">News page.</a></p>';
          }
          $this->contentString=$contentString;
         
          

     }
    
     function breadcrumbArray(){
          
          $breadcrumbArray=array();
          $breadcrumbArray[]=array('fullPath'=>'news-and-events','title'=>'News and Events');
          $breadcrumbArray[]=array('fullPath'=>'news-and-events/' . $this->type,'title'=>$this->type );
          if($this->theArticle){
               $breadcrumbArray[]=array('fullPath'=>'news-and-events/' . $this->type,'title'=>'News Item' );
          }
          return $breadcrumbArray;
          
     }
   
     function cssArray(){
               return array('news.css');
          }


}


?>