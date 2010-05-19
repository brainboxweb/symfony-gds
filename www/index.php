<?php
/**
 *
 *
 * 
 *
 */
#echo 'Hlloqw world';
#echo ini_get('include_path'), 

#exit;


#define ('SHORT_NAME', 'nam');
#define ('META_TITLE_LENGTH','66');
#define ('META_DESCRIPTION_LENGTH','250');
define ('MENU_LOCATION','path'); //used by Menu.php
//include config file


require_once ('config.php');
$basePath=$config['basePath'];

#echo $basePath;

//Connect to the database
$dbName = $config['dbName'];
$dbHost = $config['dbHost'];
$dbUser = $config['dbUser'];
$dbPass = $config['dbPass'];
try {
   $dbPDO = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
   #echo 'connected';
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}



#print_r($dbPDO);
#exit;





//include the PathVars class
require_once ('Url/PathVars.php');
require_once ('Url/PathVarsSimple.php');
$pathVars= new PathVarsSimple($basePath);

#echo $pathVars->section;


#print_r($pathVars);


/**
 * Section Context
 *
 *   
 */ 




$section = $pathVars->section;


//echo $pathVars->getLocation();

//Handle the special cases for News and Events
switch($pathVars->getLocation()){
    
    //Home Page
    case (''):
        
        require_once('HomePage.php');
        $thePage= new HomePage($dbPDO, $pathVars, $basePath);
        
        break;
    
     //Home Page
    case ('calendar.xml'):
        
        require 'generateRSS.php';
       
        break;
    
    
    
    case (preg_match('/^calendar($|\/)/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
  
        #echo 'got one';
       # exit;
        
        require_once 'CalendarPage.php';
        $thePage= new CalendarPage($dbPDO, $pathVars, $basePath);        
        break;
    
    
    
    
    // Development-specific news
    case (preg_match('/^.+\/news($|\/)/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
  
        #echo 'got one';
       # exit;
        
        require_once('NewsPage.php');
        $thePage= new NewsPage($dbPDO, $pathVars, $basePath, 1 );        
        break;
    
    
    // Development-specific Events
    case (preg_match('/^.+\/events($|\/)/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
  
        #echo 'got one';
       # exit;
        
        require_once('EventPage.php');
        $thePage= new EventPage($dbPDO, $pathVars, $basePath, 1 );
		           
        break;
    
    
    
    #  Main Info page.. or info/item request
    case (preg_match('/(^info$|^info\/item\/)/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
        #echo 'got one';
        require_once('InfoPage.php');
        $thePage= new InfoPage($dbPDO,$pathVars, $basePath, 0  );
        
        break;
    
    
    
    #Info page - Development specific
    case (preg_match('/(\/info$|\/info\/item\/)/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
        #echo 'GOT ONE';
        require_once('InfoPage.php');
        $thePage= new InfoPage($dbPDO,$pathVars, $basePath,1  );
		
                         
        break;
   
 
 
   case 'sitemap':

         require_once('SitemapPage.php');
         $thePage= new SitemapPage($db);
         
         $thePage->setTitle('Site Map');
        
                        
    break;


 
   // Development-specific Events
   case (preg_match('/^gallery/i',$pathVars->getLocation())?$pathVars->getLocation():!$pathVars->getLocation()):
        
      require_once('pages/galleryPage.php');
      $thePage= new GalleryPage($dbPDO, $pathVars);
      
      break;

               
   default:
      require_once('NormalPage.php');
      $thePage= new NormalPage($dbPDO, $pathVars, $basePath);

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
   
    //Home Page 
    case '':

        $recentNewsArray = $thePage->newsArray;
      
        $title='';
        break;
    
    case ( preg_match('/^karate-london\//i',$location) ? $location : !$location  ):
   
        $hasMap = true;
        break;
    
    case ( preg_match('/^karate-surrey\//i',$location) ? $location : !$location  ):
   
        $hasMap = true;
        break;
        
    default:
        //No default
}









include('template.php');
