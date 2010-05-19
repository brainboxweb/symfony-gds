<?php
/*
This class needs to provide the following to the parent class:

$this->contentString
$this->title 
$this->shortTitle 
$this->metaTitle
$this->metaDescription

*/


require_once('webpage/Page.php');

Class NormalPage extends Page{

     function __construct($dbPDO, $pathVars, $basePath){
          
          
        #  print_r($pathVars);
          parent::__construct($dbPDO, $pathVars, $basePath);
               
          ///The following may have unintended consequences!!!
          #$this->getContent();
          
     }
     
     
     /**
      * This is likely to be site-specific - can't be implemented at the parent level.
      *
      *
      */
     
     protected function getContent(){          
          
	  
	  
	  
	  require_once('articles/Model/Item.php');
	  
	  $model = new Model_Item($this->dbPDO);
	  
          #echo $this->pathVars->getLocation();
          #exit;
          
	  $model->path = $this->pathVars->getLocation();
	  $model->getItems();
	
	  
          $data=$model->fetch();
          
          #print_r($data);
          #exit;
	  
          if ( $data ){
               
               require_once("articles/Item.php");	 
               $item = new Item();                             
               $item->populate($data);
               #'print_r($data);
               #exit;
               $this->title = $item->title;
              
               $this->shortTitle = $item->shortTitle;
               $this->metaTitle = $item->metaTitle;
               $this->metaDescription=$item->metaDescription;
               
               
               #$this->code=$item->code;
               
              
     
     
     
               $this->image = $item->image;
               $this->width = $item->width;
               $this->height = $item->height;
               $this->alt = $item->alt;
               
               $this->contentString .=  $item->body;
               
               #$this->getBreadcrumbArray();
               
               
          } else {
               
               # Challenge: serving a 404 AND redirecting. Simplest: hard code the inof here.
               
               header("HTTP/1.0 404 Not Found");
               
				
               $this->contentString .= '<h1>Page not found</h1>';
               $this->contentString .= '<p>The page you were looking for has been moved or no longer exists.</p>';
               $this->contentString .= '<p>Please click here to return to the <a href="'.$this->basePath.'">Home Page</a>.</p>';
               
               
          }
          
        
   
     }
     
     
     
          
          
          
     
     /*
     function getBreadcrumbArray(){
	       
          #echo 'HERERERERER';
          // Include BreadCrumb class
          
          require_once('UI/BreadCrumb.php');
          $crumbs = new BreadCrumb($this->dbPDO,$this->location,true);
          
          $breadcrumbArray = array();
          
          // Display the breadcrumbs   
          while ($crumb = $crumbs->fetch()) {
              
               $breadcrumbArray[] = array('title'=>$crumb->item['title'], 'path'=>$crumb->item['location'] );
            
          }
         
          $this->breadcrumbArray = $breadcrumbArray;
      }
     */
     
    public function populateHowToPortlet () {
    	if (!isset($this->development)){
    		$folders =  preg_split("(/)",$this->pathVars->getLocation());
    		$this->development = $folders[0];
    	}
		 switch($this->development){ 
			case('palm-jumeirah'):
				$this->howToHTML = array(
					0 => '<li><a class="x-link" href="'.$this->basePath.'info/item/jumeirah-islands?question=how-do-i-pay-my-service-charges-online">Pay my service charges online</a></li>',
					1 => '<li><a class="x-link" href="'.$this->basePath.'info/item/palm-jumeirah?question=how-do-i-contact-nakheel-asset-management">Contact Nakheel Asset Management</a></li>',
				    2 => '<li><a class="x-link" href="'.$this->basePath.'info/item/palm-jumeirah?question=how-can-i-request-a-vehicle-access-pass">Get a vehicle access pass</a></li>',
					3 => '<li><a class="x-link" href="'.$this->basePath.'info/item/palm-jumeirah?question=how-do-i-connect-my-utilities">Connect my utilities</a></li>',
				    4 => '<li><a class="x-link" href="'.$this->basePath.'info/item/palm-jumeirah?question=can-i-make-modifications-to-my-property">Make modifications to my property</a></li>'	 
				);
			break;

			
			 case('jumeirah-islands'):
				$this->howToHTML =  array(
					'<li><a class="x-link" href="'.$this->basePath.'info/item/jumeirah-islands?question=how-do-i-pay-my-service-charges-online">Pay my service charges online</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/jumeirah-islands?question=how-do-i-contact-nakheel-asset-management">Contact Nakheel Asset Management</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/jumeirah-islands?question=how-do-i-see-photos-and-make-comments-about-my-latest-community-event">View photos of my latest event </a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/jumeirah-islands?question=who-do-i-contact-to-arrange-visitor-access">Arrange visitor access</a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/jumeirah-islands?question=what-do-i-do-in-case-of-emergency">React in case of emergency</a></li>'
				);
			break;

			case('the-gardens'):
				$this->howToHTML =  array(
					'<li><a class="x-link" href="'.$this->basePath.'info/item/the-gardens?question=how-do-i-contact-nakheel-asset-management">Contact Nakheel Asset Management</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/the-gardens?question=how-do-i-request-a-maintenance-service">Request a maintenance service</a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/the-gardens?question=can-i-book-the-park-for-a-function">Book the park for a function</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/the-gardens?question=do-i-have-an-allocated-parking-space">Get my parking space</a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/the-gardens?question=who-do-i-contact-if-i-want-to-renew-my-lease">Renew my lease</a></li>'
				);
			break;

			case('discovery-gardens'):
				$this->howToHTML =  array(
					'<li><a class="x-link" href="'.$this->basePath.'info/item/discovery-gardens?question=how-do-i-pay-my-service-charges-online">Pay my service charges online</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/discovery-gardens?question=how-do-i-contact-nakheel-asset-management">Contact Nakheel Asset Management</a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/discovery-gardens?question=who-do-i-contact-if-i-want-to-renew-my-lease">Renew my lease</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/discovery-gardens?question=how-do-i-make-a-property-modification-application">Make modifications to my property </a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/discovery-gardens?question=how-do-i-connect-my-gas-electricity-and-television">Connect my utilities </a></li>'
				);
			break;

			case('international-city'):
				$this->howToHTML =  array(
					'<li><a class="x-link" href="'.$this->basePath.'info/item/international-city?question=how-do-i-pay-my-service-charges-online">Pay my service charges online</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/international-city?question=how-do-i-contact-nakheel-asset-management">Contact Nakheel Asset Management</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info/item/international-city?question=how-do-i-request-a-maintenance-service">Request a maintenance service</a></li>',
				    '<li><a class="x-link" href="'.$this->basePath.'info/item/international-city?question=what-do-i-do-in-case-of-emergency">React in case of emergency</a></li>',			
					'<li><a class="x-link" href="'.$this->basePath.'info/item/international-city?question=how-do-i-find-out-about-community-events">Find out about community Events</a></li>'	
				);
			break;
			
			default:
			$this->howToHTML =  array(
					
					'<li><a class="x-link" href="'.$this->basePath.'info?question=how-do-i-contact-nam">Contact Nakheel Asset Management</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info?question=can-i-pay-my-service-charges-online">Pay my service charges online</a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info?question=how-do-i-know-who-to-call-for-what">Know who to call for what </a></li>',
					'<li><a class="x-link" href="'.$this->basePath.'info?question=can-i-update-my-contact-details-online">Update my contact details</a></li>'
				);
			break;
		}
    }

}