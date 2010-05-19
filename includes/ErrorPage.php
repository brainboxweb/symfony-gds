<?php
/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description


*/

Class ErrorPage extends Page{


     function __construct(){
		      
	  $this->title .= 'Oh dear...';
          
          $this->contentString .= '<p>Something has gone wrong. The page were looking for has moved or no longer exists.</p>
                                   <p>Please click here to return to the
                                   <a href="/">Home Page</a>, or here to go to the <a href="/sitemap">Site Map</a></p>';
        
          
          
     }			

     function breadcrumbArray(){
          
          $breadcrumbArray=array();
          $breadcrumbArray[]=array('fullPath'=>'error','title'=>'Error');
        
          return $breadcrumbArray;
          
     }
    

}



?>