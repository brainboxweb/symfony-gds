<?php

require_once('NormalPage.php');

Class SitemapPage extends NormalPage{

     function SitemapPage($db){
            
	  $this->metaTitle='Find your way around the website';	
	
	  
	  $this->db= $db;
	  
	
	  require_once('UIoriginal/Menu.php');
	  
	  // Location is always the Home Page location
	  $location='';
	  
	  require_once('UIoriginal/FullTree.php');
	  
	 // require_once('cms/CMS.php');
	 // $CMS=new CMS($this->db);
	  
	  // Instantiate the FullTree class
	  
	  
	  $isActive=true;//Need to see them regardless of state
	  $includeOrphans=false;
	  $menu=new FullTree($this->db, $isActive, $includeOrphans); 
	  
	  

	  //echo '<pre>';
	  //print_r($menu);
	  //exit;
          
          // Define some bullet for menu items, in this case just spaces
          $bullet='&nbsp;&nbsp;&nbsp;&nbsp;';
          
          // Set the current depth of the menu
          $depth=0;
          
          //$collapse=array();
          
          $sitemapString='';

	  $inEnd=false;

          // Display the collapsing tree menu
	  
	  
          while ( $item = $menu->fetch() ) {
	  
	       //echo '<hr>' . $item->type . '--- ' . $item->location() ;
	       //print_r($menu);
	       $minDepth=1;
	       $maxDepth=100;
	       
	       // If this is the start of a new menu branch, increase the depth
	       if ( $item->isStart() ) {
	       
		    $depth++;
		    if($depth >=$minDepth && $depth <= $maxDepth){	
			 //$sitemapString .= "\nSTART\n";				
			 $sitemapString .= "\r<ul>\r<li>";
		    
		    }

	       // If this is the end of a menu branch, decrease the depth
	       }
	       else if ( $item->isEnd() ) {
			    
		    //$inEnd=true;
		    
		    
		    if($depth >=$minDepth && $depth <=$maxDepth){
		    //$sitemapString .= "\nEND\n";			
			 $sitemapString .= "</li>\r</ul>\r</li>";
		    }
		    $depth--;
		    // Display a menu item
	       }
	       else {
      
		    // Display the menu item with bullets
		    if($depth >= $minDepth && $depth <= $maxDepth){	
			 
			 //$sitemapString .= "\r<li>";
			 
			 $sitemapString .=  '<a href="' . $item->location() .'"';
			 $sitemapString .= '>'.$item->name() ."</a>" ;
			 
		    }
     
	       }
	  }
										
		    //echo $sitemapString ;
										
                    //the string is almost right - just  to fix the transitions
                    
		    //The FullTree class makes the error of inserting a "start+end" between siblings. 
                    $sitemapString = str_replace( "</li>\r</ul>\r</li>\r<ul>\r<li>", "</li>\r<li>" , $sitemapString);
		    
		    //Double "</li>"s are also turning up
		    $sitemapString = str_replace( "</li></li>", "</li>" , $sitemapString);
                    
		    //the thing ends in an <li>
		    
		    $sitemapString = trim($sitemapString,'</li>');
		    
                    //$sitemapString = str_replace( '</li></ul><li>', '</li></ul></li><li>', $sitemapString);
		    
		     //$sitemapString = str_replace( '</li></ul><ul><li>','</li><li>',$sitemapString);
		    
		    //echo "<hr>\n" . $sitemapString . '<hr>';
										
                    
                    $contentString='<div id="sitemap">' . $sitemapString . '</div>';	
							
							$this->contentString=$contentString;
							
							
						
							
							
						}									 
                          

     }
		 		
		




?>