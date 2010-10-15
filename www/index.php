<?php
/**
 *
 *
 * 
 *
 */

define ('MENU_LOCATION','path'); //used by Menu.php


require_once ('config.php');




//include the PathVars class
require_once ('Url/PathVars.php');
require_once ('Url/PathVarsSimple.php');
$pathVars= new PathVarsSimple('/');



$section = $pathVars->section;


//echo $pathVars->getLocation();

//Handle the special cases for News and Events
switch($pathVars->getLocation()){
    
    //Home Page
    case (''):
        
        require_once('HomePage.php');
        $thePage= new HomePage($dbPDO, $pathVars, '/');
        
        break;
    
   
    
    
    case (preg_match('/^portfolio($|\/)/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
  
      
        require_once 'PortfolioPage.php';
        $thePage= new PortfolioPage($dbPDO, $pathVars);        
        break;
    
    
    case 'contact':
      
        require_once 'ContactPage.php';
        $thePage= new ContactPage($dbPDO, $emailDetails['contact']);        
        break;
    
   
 
 
   case 'sitemap':

         require_once('SitemapPage.php');
         $thePage= new SitemapPage($db);
         
         $thePage->setTitle('Site Map');
        
                        
    break;


               
   default:
      require_once('NormalPage.php');
      $thePage= new NormalPage($dbPDO, $pathVars, '/');

}





$contentString=     $thePage->contentString;
$title=		    $thePage->title;

#echo $title;
//exit;
$shortTitle=	    $thePage->shortTitle;	
$metaTitle=	    $thePage->metaTitle;
$metaDescription=   $thePage->metaDescription;

$code=	            $thePage->code;

$noIndex =          $thePage->noIndex; 

$cssArray=          $thePage->cssArray;
$noIndex=           $thePage->noIndex;


$topNavArray =      $thePage->topNavArray;

if(isset($thePage->navigationString)){
   $navString =        $thePage->navigationString;
}
#echo $navString;

$image = $thePage->image;
$width = $thePage->width;
$height = $thePage->height;
$alt = $thePage->image;






$breadcrumbString =        $thePage->breadcrumbString;


$location=$pathVars->getLocation();



//Home Page specfic content

//echo $location;

$hasMap=false;

switch($location){
   
  
}









include('template.php');
