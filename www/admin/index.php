<?PHP
#set_include_path('.' . PATH_SEPARATOR . 'c:\wamp\www\test\master\private\\');



require_once ('../../config/config.php');

define ('SHORT_NAME', 'woodlands');
define ('META_TITLE_LENGTH','66');
define ('META_DESCRIPTION_LENGTH','250');

define ('MENU_LOCATION','path'); //used by Menu.php

//error_reporting(E_ALL);




$basePath = BASE_PATH ;

$adminBasePath=BASE_PATH . 'admin/' ;
#echo "the base URL is: " . $adminBasePath;
#exit;

//include the PathVars class
require_once ('Url/PathVars.php');
require_once ('Url/PathVarsSimple.php');
$pathVars= new PathVarsSimple($adminBasePath);

//print_r($pathVars);



#print_r($config);
$dbName = $config['dbName'];
$dbHost = $config['dbHost'];
$dbUser = $config['dbUser'];
$dbPass = $config['dbPass'];

#echo dbName;
##exit;

//Time for a spot of PDO!!!
try {$dbPDO = new PDO("mysql:dbname=$dbName; host=$dbHost", $dbUser,$dbPass);
}
catch (PDOException $e) {
echo "Failed to connect: "
. $e->getMessage();
}


#echo $server;




// Include Session class
require_once ('Session/Session.php');

// Include Auth class
require_once ('AccessControlPDO/Auth.php');

// Include User class
require_once ('AccessControlPDO/User.php');




//The PARENT class
require_once('webpage/Page.php');


//PASSWORD-PROTECT EVEYTHIGN EXCEPT THE  LOGINPAGE
if($pathVars->fetchByIndex(0)!='login'){
 
   // Instantiate the Authentication class
   $auth= new Auth($dbPDO, $adminBasePath .  'login' ,'supersecret');
   
   //var_dump($auth);
   //exit;
   
   
   if(isset($_GET['action']) && $_GET['action']=='logout'){
      $auth->logout();
   }
   
   // Instantiate the User class
   $user = new User($dbPDO);
      
   $navArray=array();
   $navArray[]=array('title'=>'News',        'path'=>'news');
   
   $navArray[]=array('title'=>'Events',      'path'=>'events');
   $navArray[]=array('title'=>'Structure',  'path'=>'structure');
   $navArray[]=array('title'=>'Navigation',  'path'=>'navigationNEW');
   $navArray[]=array('title'=>'Orphans',     'path'=>'orphans');
   $navArray[]=array('title'=>'Members',     'path'=>'members');
  
   $navArray[]=array('title'=>'Portfolio',      'path'=>'portfolio');
   
  
   
   
   $navArray[]=array('title'=>'Users',       'path'=>'users');
   
   //$topNavString = '<dd><a href="' . $adminBasePath . '">Home</a></dd>';;
  
   $topNavString=''; 
   foreach($navArray as $name=>$value){
        
   if ( $user->checkPermission($value['path'] ) ) {
         
         //echo $pathVars->fetchByIndex(0);
         
         if($pathVars->fetchByIndex(0) == $value['path']){
            $classString='class="current"';
         }
         else{
            $classString='';
         }
         $topNavString .= '<dd><a href="' . $adminBasePath  . $value['path'] . '" ' . $classString .  '>' . $value['title'] . '</a></dd>';
      }
      else{
          //DON'T Show eveyone what they are missing!!!!
          //$topNavString .= '<dd>' . $value['title'] . '</dd>';
      }
   }
  

}

//echo '<hr><hr><hr>' . $pathVars->fetchByIndex(0);

switch($pathVars->fetchByIndex(0)  ){
   
   case('login'):
      
      // echo '<h1>This is the LOGIN page';
      //xit;
      require_once('bb_admin/LoginPage.php');
      //$thePage= new LoginPage($baseURL . 'admin_test/');
      $thePage= new LoginPage($adminBasePath);
      
   break;  
      
    case ('structure'):
                 
      if ( $user->checkPermission('structure') ) {
         
            require_once('bb_admin/StructurePage.php');
            $thePage= new StructurePage($dbPDO,$config['baseFilePath']);
            
      }
      else{
         echo 'NOT ALLOWED!';
      }
      
   break;
   
      
      


 
	
   case ('navigationNEW'):
                 
      if ( $user->checkPermission('navigationNEW') ) {

         if(!$_GET){
            require_once('bb_admin/NavigationPageNEW.php');
            $thePage= new NavigationPage($dbPDO, $basePath);
         }
         else{
         
           require_once('bb_admin/NavItemPage.php');
           $thePage= new NavItemPage($dbPDO, $basePath);
         }
      }
      else{
         
         echo 'NOT ALLOWED!';
         
      }
      
      
   
      
   break;      
   //Simple News   
   case ('news'):
                 
      if ( $user->checkPermission('newsBB') ) {
         if(!$_GET){
            #require_once('bb_admin/NewsListPage.php');
            require_once('bb_admin/NewsListPage.php');
            $thePage= new NewsListPage($dbPDO);
            
         }
         else{
            //echo '<hr>HERER';
            require_once('bb_admin/NewsItemPage.php');
            #require_once('php/NewsItemPage.php');
            $thePage= new NewsItemPage($dbPDO, $basePath);
         }
      }
      else{
         echo 'NOT ALLOWED!';
      }
      
   break;   
      
      
   //Simple Events
   case ('events'):
                 
      if ( $user->checkPermission('eventsBB') ) {
         if(!$_GET){
            require_once('bb_admin/EventListPage.php');
            $thePage= new EventListPage($dbPDO);
         }
         else{
            #require_once('php/EventItemPage.php');
            require_once('bb_admin/EventItemPage.php');
            $thePage= new EventItemPage($dbPDO);
         }
      }
      else{
         echo 'NOT ALLOWED!';
      }
      
   break;
               
    case ('orphans'):
                 
      if ( $user->checkPermission('orphans') ) {

          if(!$_GET){
            require_once('bb_admin/OrphanPage.php');
            $thePage= new OrphanPage($dbPDO, $basePath);
          }
          else{
               require_once('bb_admin/NavOrphanItemPage.php');
               $thePage= new NavOrphanItemPage($dbPDO, $basePath);
         }
      }
      else{
         
         echo 'NOT ALLOWED!';
      }
      break;
   
               
    case ('portfolio'):
                 
      if ( $user->checkPermission('portfolio') ) {

          if(!$_GET){
            require_once('AdminPages/PortfolioListPage.php');
            $thePage= new PortfolioListPage($dbPDO);
          }
          else{
               require_once('AdminPages/PortfolioItemPage.php');
               $thePage= new PortfolioItemPage($dbPDO);
         }
      }
      else{
         
         echo 'NOT ALLOWED!';
      }
      break;
      
   
   
      
      case ('members'):
                 
         if ( $user->checkPermission('members') ) {
   
            if (!isset($_GET['id'])){
                require_once('bb_admin/MemberListPage.php');
                $thePage= new MemberListPage($db, $baseURL, $dbPDO);
            }
            else {
                require_once('bb_admin/MemberItemPage.php');
                $thePage= new MemberItemPage($db, $baseURL, $dbPDO);
            }
        }
        else{
            echo 'NOT ALLOWED!';
        }
      
      
      
    break;

    case ('new-members'):
                 
         if ( $user->checkPermission('members') ) {
   
           
                require_once('bb_admin/NewMemberPage.php');
                $thePage= new NewMemberPage($db, $baseURL, $dbPDO);
          
        }
        else{
            echo 'NOT ALLOWED!';
        }
   break;
      
   case ('users'):
      if ( $user->checkPermission('users') ) { //CHANGE THIS LATER
   
           
                require_once('bb_admin/UserPage.php');
                $thePage= new UserPage($dbPDO, $basePath);
          
        }
        else{
            echo 'NOT ALLOWED!';
        }
      
      
    break;     
		
                
   case ('gallery'):
                 
      if ( $user->checkPermission('gallery') ) {

         if(empty($_GET) ){
            require_once('bb_admin/GalleryListPage.php');
            $thePage= new GalleryListPage($dbPDO, $basePath);
            
            //print_r($thePage);
            //exit;
         }
         else{
         
           require_once('bb_admin/GalleryPage.php');
           $thePage= new GalleryPage($dbPDO, $basePath);
         }
      }
      else{
         
         echo 'NOT ALLOWED!';
         
      }
      break;
      
   default:
      
      require_once('bb_admin/WelcomePage.php');
      $thePage= new WelcomePage($basePath,$user);
       
      
      //require_once('bb_admin/NormalPage.php');
      //$thePage= new NormalPage($db, $location);

}


$contentString= $thePage->contentString; 
$title=			$thePage->title;


//$shortTitle=		$thePage->shortTitle();	
//$titleNote=		$thePage->titleNote();

if (method_exists($thePage,'subMenu' ) ){
    $subMenu=$thePage->subMenu() ;
}


$cssArray=              $thePage->cssArray();
$javaScriptArray=       $thePage->javaScriptArray();


$breadcrumbArray=$thePage->breadcrumbArray();

if($breadcrumbArray){
   $breadcrumbString='<a href="'.$adminBasePath.'">Home</a> &gt; ';
   $count=count($breadcrumbArray);
   $counter=1;
   foreach($breadcrumbArray as $name=>$value){
      if($counter<$count){
         $breadcrumbString .= '<a href="'.$adminBasePath . $value['fullPath'] . '">' . $value['title'] . '</a> &gt; ';
      }
      else{
         $breadcrumbString .= $value['title'];
      }
      $counter++;
      
   }
   //trim ($breadcrumbString,' &gt; ');
  
   //print_r($breadcrumbArray);
}



$metaTitle=$title;



//This is genius!! All the variables are ready to just slot in.
include('template.php');

