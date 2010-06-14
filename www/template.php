<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>

<?php if($metaTitle): ?>
     <?php echo $metaTitle  ?>
<?php else: ?>
     <?php echo $title . ' | Gary Straughan, PHP Developer' ?>
<?php endif ?>
</title>


<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />
<meta name="description" content="<?php echo $metaDescription ?>" />
<meta name="author" content="Gary Straughan" />

<meta name="google-site-verification" content="RVDyD43J9JXYhcRYLxGTMuGvRFIB_nT2_vHm74XYfzI" />


<link href="/css/s.css" type="text/css" rel="stylesheet"  />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="/css/ie.css" />
<![endif]-->

<?php
if($cssArray){
     foreach ($cssArray as $name=>$value){
          echo '<link href="' . $config['basePath'] . 'css/' . $value  . ' " type="text/css" rel="stylesheet"  />';
     }
}

if(isset($css)){
     echo '<style type="text/css">';
     echo '<!--';
     echo $css;
     echo '-->';
     echo '</style>';
}






?>
<link href="<?php echo $config['basePath'] ?>css/styleprinter.css" type="text/css" rel="stylesheet" media="print"  />


<?php
if($noIndex){
     echo "<meta name=\"robots\" content=\"noindex, follow\" />\n";
}
?>
<link rel="Shortcut Icon" href="/favicon.ico" />
</head>
<body class="<?php echo $section ?>">

<div id="top">
     <div id="header">

          
     <a href="/" id="homelink">Gary Straughan - PHP Developer</a>
      
 
      
      <!--
      <div id="topbox">
           
           <div id="breadcrumb">
                <?php
                if($location && isset($breadcrumbString)){
                     
                     echo  '<ul>' . $breadcrumbString . '</ul>';
                }
                ?>
           </div>
           
          
           
           <div class="spacer">&nbsp;</div>
           
      </div>
      -->
    
 
      <div id="quicklinks" class="noprint">
          <a href="/">Home</a> |
          <!--<a href="/sitemap">Site Map</a> |-->
          <a href="/contact" rel="nofollow">Contact</a>
      </div>
 
 
     <!-- START topnavigation -->
     <div id="menu" class="noprint">
          
          <dl>
               <dd id="skills"><a href="/skills" >Skills</a></dd>
               <dd id="portfolio"><a href="/portfolio" >Portfolio</a></dd>
               <dd id="cv"><a href="/cv" >CV</a></dd>
               <dd id="about"><a href="/about" >About</a></dd>
          </dl>
          
     </div>
          
        
     </div>
</div>

<div id="banner">
     
</div>
    
<div id="main">
    
     <div id="content">
        
          <div id="big">
                    
               <?php
               
               
               
              
               
               if(isset($contentString)){
                    
                    if(strtolower($title) != ''){ 
                    
                         echo '<h1>' . $title. '</h1>';
                    }
                    // echo '<textarea rows=100 cols=100>' . $contentString . '</textarea>';
                    
                    eval('?>' . $contentString);
                    #exit;
               }
               
              
          
               ?>
          



          
          
               <!--
                <div id="bottomlinks">
                    
                    <a href="#">Top</a> | 
                    <a href="<?php echo $config['basePath'] ?>" rel="nofollow">Home</a>
                    
                    | <a href="<?php echo $config['basePath'] ?>sitemap" rel="nofollow">Site Map</a> 
                    
                    | <a href="<?php echo $config['basePath'] ?>contact" rel="nofollow">Contact</a>
                    
                    | <a href="<?php echo $config['basePath'] ?>accessibility" rel="nofollow">Accessibility</a>
                    
               </div>
               -->
              
          </div>   
               
          <div id="small">
            
            
               <?php if(!$section): ?>
            
                    <dl>
                            <dt>Availability</dt>
                            <dd>Available</dd>
                            
                            <dt>Perm / Contract</dt>
                            <dd>Contract</dd>
                            
                            <dt>Really?</dt>
                            <dd>Yes, Contract only</dd>
                            
                            <dt>Location</dt>
                            <dd>West/Central London</dd>
                            
                            <dt>Preferred biz type</dt>
                            <dd>Design Agencies</dd>
                            
                            <dt>Avoid like the plague</dt>
                            <dd>Financial Companies</dd>
                            
                            
                            
                    </dl>
                    
               <?php endif ?>
               
               
               
               
            
               <?php if(  isset($navString) && $navString   != '' ) {
                         
                         echo '<div id="navbox"> ' . $navString . '</div>';
                         
                    }
               ?>
            
            
            
          
          </div>
     </div>
     
</div>
              
<div id="bottom">     
          
          
          <!-- START footer -->
          <div id="footer" >
                    
               <div id="business-card">
                    
                    Gary Straughan<br />
                    
                    07834 003 110<br />
                    
                    81 Oxford Road South<br />
                    <strong>London W4 3DD</strong><br />
                    <br />
                    
                    
               </div>
                    
               <div id="copyrightbox">   
                   
                   Copyright &copy; 2007-<?php echo date('Y') ?> Gary Straughan. All rights reserved. 
               </div>
                  
          </div>
               <!-- END footer -->
     
     
        
    </div>
    
</div>
    
    


<?php
if(isset($jsArray)){
     echo 'here';
     foreach ($jsArray as $name=>$value){
          
          if(strstr($value,'http:') ){
               
               echo '<script type="text/javascript" src="' . $value  . ' "></script>';
          } else {
               echo '<script type="text/javascript" src="' . $config['basePath'] . 'js/' . $value  . ' "></script>';
          }
     }
}

if(isset($js)){
     echo '<script type="text/javascript">
          //<![CDATA[';
     echo $js;
     echo ' //]]>
          </script>';
}

?>
     
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-180453-14");
pageTracker._trackPageview();
</script>
</body>
</html>