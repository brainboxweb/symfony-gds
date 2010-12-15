<?php $version = 123 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>
<?php if($metaTitle): ?>
     <?php echo $metaTitle  ?>
<?php else: ?>
     <?php echo $title . ' | Gary Straughan' ?>
<?php endif ?>
</title>


<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Language" content="en" />

<meta name="description" content="<?php echo $metaDescription ?>" />


<link href="/css/s.css?<?php echo $version ?>" type="text/css" rel="stylesheet"  />
<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" media="all" href="/css/ie.css?<?php echo $version ?>" />
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


<?php
if($noIndex){
     echo "<meta name=\"robots\" content=\"noindex, follow\" />\n";
}
?>
<link rel="Shortcut Icon" href="/favicon.ico" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-180453-23']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>




<!-- for hide-on-load -->
<script type="text/javascript">
var elements = document.getElementsByTagName("html");
elements[0].className += " js-enabled";
</script>

</head>
<body class="<?php echo $section?$section:'home' ?>">

<div id="container">
     
     <div id="header">
	  
	  <a href="/"><img src="/images/logo.png" width="347" height="82" alt="Gary Straughan - PHP Developer" /></a>
	  
	  <dl id="topnav">
               
          <dd class="skills"><a href="/skills" >Skills</a></dd>
               <dd class="portfolio"><a href="/portfolio" >Portfolio</a></dd>
               <dd class="cv"><a href="/cv" >CV</a></dd>
               <dd class="about"><a href="/about" >About</a></dd>

	       
	  </dl>
	  
	  
	  <div id="quicklinks">
	       <a href="/">HOME</a>&nbsp; |  &nbsp;<a href="/contact">CONTACT</a>
	  </div>
	  
	    
     </div>
     
     
     <div id="main">
	  
          
	  
	  <div id="content">
               <?php  if( $pathVars->getLocation() ): ?>
                    <h1><?php echo $title ?></h1>
	       <?php endif; ?>
               
               
               
               <?php echo $contentString ?>
          
	  </div>
          
		   
			   
			
         
          
          <div id="navigation">
			   
			   
			   <?php if(!$section): ?>
					<dl id="availability">
							  
							<dt>Availability</dt>
							<dd>Not Available</dd>
							
							<dt>Next Available</dt>
							<dd>Jan 2011</dd>
							
							<dt>Current Project</dt>
							<dd>British Gas</dd>
							
					</dl>
					<!--
					<dl id="availability">
							<dt>Availability</dt>
							<dd>Available</dd>
							
							<dt>Perm / Contract</dt>
							<dd>Contract</dd>
							
							<dt>Really?</dt>
							<dd>Yes, Contract only</dd>
							
							<dt>Location</dt>
							<dd>West/Central London</dd>
							
							<dt>Preferred biz type</dt>
							<dd>New Media</dd>
							
							<dt>Avoid like the plague</dt>
							<dd>Financial Companies</dd>
							
					</dl>
					-->
                    
			    <?php endif ?>
          
			   
                <?php echo $navString ?>
               
               <!--
               <div style="background: #EFC845">
                    
                    [[ A weber opt-in... or a video... or something ]]
                    
               </div>
               -->
                
          </div>
	  
	  
     </div>






</div>


<div id="footer">
	  
     <div>
	  
	  <p>
	       <a href="/">Home</a>&nbsp; |
	       &nbsp;<a href="/contact">Contact</a>&nbsp;<!-- 
	       &nbsp;<a href="/">Terms and conditions</a>&nbsp; | 
	       &nbsp;<a href="/">Privacy policy</a> -->
	  </p>
     
     
            
	  <p>
		  
	       <strong>Gary Straughan - 07834 003 110</strong><br />
	       81 Oxford Road South, Chiswick, London W4&nbsp;3DD<br />
	       Copyright &copy; 2002-<?php echo date('Y') ?> Gary Straughan. All rights reserved.
	  </p>
     
     
     </div>
	  
	  
</div>





<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
 
    
    


<?php
if(isset($jsArray)){
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

</body>
</html>


