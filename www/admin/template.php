<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title><?php echo $metaTitle  ?> | NAM Administration Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />

<link href="<?php echo $adminBasePath ?>css/s.css" type="text/css" rel="stylesheet" />
<!--
<link href="<?php echo $adminBasePath ?>css/calendar.css" type="text/css" rel="stylesheet" />
-->

<?php 
if(isset($css)){
     echo '<style type="text/css">';
     echo '<!--';
     echo $css;
     echo '-->';
     echo '</style>';
}

if($cssArray){
     foreach ($cssArray as $name=>$value){
          echo '<link href="' . $adminBasePath   .$value  . '" type="text/css" rel="stylesheet"  />';
     }
}
if($javaScriptArray){
     foreach ($javaScriptArray as $name=>$value){
          echo '<script type="text/javascript" src="' . $adminBasePath .$value  . '" ></script>';
     }
}
?>
<link rel="Shortcut Icon" href="<?php echo $basePath ?>favicon.ico" />
</head>
<body>

     <!--
<div id="logo"><img src="images/logo.gif" /></div>

-->
<?php
//Provide a way to logout
if($pathVars->fetchByIndex(0) != 'login'){
     
    
     echo '<div id="logout">
          <a href="' . $adminBasePath . '?action=logout">Logout</a>    
          </div>';
     
     
}

echo '<div id="breadcrumb">';



if(isset($breadcrumbString)){
 echo $breadcrumbString;
}
else{
  echo '&nbsp;';
}
?>
</div>
     


<!-- START topnavigation -->
<dl id="menu">
<?php
if (isset($topNavString)){
     echo $topNavString;
}
 ?>
</dl>


<?php
if (isset($subMenu)){
     //echo '<div id="submenu">';
     echo $subMenu;
     //echo '</div>';
}
?>
<!-- END topnavigation -->









<?php



if( isset($navString) &&  $navString   != '' ){
     echo '<div id="nav">';
   //  echo '<p style="font-size: 80%">In this section:</p>';
     echo $navString;
		 echo '</div>';
} 
?>

<!-- END navigation -->



     







<!-- START centercontent -->
<div id="centercontent">


<?php 
if(isset($contentString)){
     
    if(strtolower($title) != ''){ 
        //echo '<hr>';
        //print_r($pageTitleArray);
        echo '<h1>' . $title. '</h1>';
    }
    // echo '<textarea rows=100 cols=100>' . $contentString . '</textarea>';
    //There's no evaling for the Admin site!
    echo $contentString;
}
?>

<div class="spacer">&nbsp;</div>
<div id="bottomlinks">
<a href="#">Top</a> | 
 <a href="<?php echo $adminBasePath ?>">Home</a> 
 
</div>



<!-- END centercontent -->





<!--start ABOLSUTELY positioned stuff --></div>
<!--END Center Container-->













<!-- START footer -->
<div id="footer">


<div class="spacer">&nbsp;</div>
</div>
<!-- END footer -->



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>  
<script type="text/javascript" src="js/jquery.maxlength.js"></script>   

</body>
</html>

