<?php

//SEPT 2007 - REVERTING TO A SINGLE TABLE (in place of menu AND articles)

Class MenuBB{
   
	  

    function MenuBB($dbPDO,$baseURL,$section, $location){
    
        $this->dbPDO = $dbPDO;
	$this->baseURL=$baseURL;
	$this->section=$section;
	$this->location=$location;
	    
        require_once ('UI/Menu.php');
	

    }
    
    function getBreadcrumb(){
				        
        // Include BreadCrumb class
        require_once('UI/BreadCrumb.php');
		
	//echo $this->location;
	
	$isActive=true;
        $crumbs=& new BreadCrumb($this->dbPDO,$this->location,$isActive);
	
	//print_r($crumbs);
	//exit;
        
        //$menuID=$crumbs->getCurrentID();
        
        
        $breadcrumbString='';
        
        // Display the breadcrumbs   
        while ($crumb = $crumbs->fetch()) {
            
	    //echo '<hr>';
	    //print_r($crumb);
	    // echo '<hr>';
	    //echo $crumb->name();
	    //exit;
	    $titleArray =$crumb->name() ;
	    
	    $titleArray = $titleArray . '| '   ;//bit o a hack to make sure the the name can be exploded
	    
	    $titleArray=explode('|',$titleArray);//Title jas three parts: short, long, and "descriptor"
	    
	    
	    if ( ! $crumb->isRoot() ) {
		
		$breadcrumbString .= " > " ;
	    
	    }
	    
	    
	    if ($crumb->location() == $this->location){

		$pageTitleString= $crumb->name();
		$pageTitleString = $pageTitleString . '| '   ;//bit o a hack to make sure the the name can be exploded
		$pageTitleArray=explode('|',$pageTitleString);
		
		$breadcrumbString .=  " <strong>".$titleArray[0] ."</strong>";
	    }
	    else{
		$breadcrumbString .=  '<a href="'.$this->baseURL.$crumb->location().'">'   .$titleArray[0].'</a>' ;
	    }

        		
    }
        
    return $breadcrumbString;
				
    
		}
		
    function getTopNav(){

    
	//SIMPLIFIED
	//echo '<hr>';
	$sql="SELECT id AS article_id, location, short_title, title_note
	FROM articles WHERE parent_id = 1 AND isOrphan ='0'
	AND published <= ". time() ." AND depublish > ". time() ." 	
	
	
	ORDER BY published DESC";
	
	
	//echo '<hr>';
	//echo $sql;
	//echo '<hr>';
	
	$stmnt=$this->dbPDO->prepare($sql);
        $stmnt->execute();
	
	$topNavString='';
	while ( $topNavItem = $stmnt->fetch() ) {
	    
	    //echo '<pre>';
	    //print_r($topNavItem);
	    //echo '</pre>';
	    
	    $topNavString .= '<dd id="' . $topNavItem['location'] . '"><a href="' . $this->baseURL .$topNavItem['location'] . '"';
	    
	    
	    //echo '<hr>comapring ' . $topNavItem->location() .  ' annd ' . $this->section;
	    
	    
	    if(  $topNavItem['location']==$this->section){
	    
		$topNavString .= ' class="current" ';
	    }

	    $topNavString .= '>' . $topNavItem['short_title'] . '</a>';
	    
	    if(isset($topNavItem['title_note']) ){
	    
		$topNavString .= '<span>' . $topNavItem['title_note'] . '</span>';
	    }
	    else{ //needs the span anyway --- or the javaScript Tanks!
	    
		$topNavString .= '<span>&nbsp;</span>';
	    }

	    $topNavString .= '</dd>';

        
        }
        return 	$topNavString;
        //echo '<hr>';

    }
		
    function getNav(){
		    
        // Include CollapsingTree menu
        require_once('UI/CollapsingTree.php');
        
	//echo $this->location;
	//exit;
				
	$isActive=true;
	$menu= new CollapsingTree($this->dbPDO,$this->location, $isActive);
	
	
                
        $navString='';
				$depth=0;
        // Display the collapsing tree menu
        while ( $item = $menu->fetch() ) {
                  
        	//echo '<hr>' . $item->type .'--'. $item->name();
		
	    
	    // If this is the start of a new menu branch, increase the depth
	    if ( $item->isStart() ) {
	    
		$depth++;
		if($depth >1 && $depth <4){	
		//$navString .= "\nSTART\n";				
		$navString .= "\r<ul>\r<li>";
		}
		
		// If this is the end of a menu branch, decrease the depth
	    } else if ( $item->isEnd() ) {
	    
		if($depth >1 && $depth <4){
		//$navString .= "\nEND\n";			
		$navString .= "</li>\r</ul>\r</li>";
		}
		$depth--;
		// Display a menu item
	    } else {
	    
	    
	    
		// Display the menu item with bullets
		if($depth >1 && $depth <4){	
		
		
		    //$navString .="</li>\n";   
		    
		    $navString .=  '<li><a href="'. $this->baseURL.$item->location() .'"';
		    
		    
		    if ($item->location() == $this->location){
			$navString .= ' class="active" ';
		    }
		    
		    $navString .= '>'.$item->name() ."</a>" ;
		    // $navString .= "</li>\n";
		}
	    }

        		      
        		
        		
	}
       
        //Double "<li>"s are also turning up
        $navString = str_replace( "<li><li>", "<li>" , $navString);
        
        //Gets siblings wrong... in a different way to the sitemap!!!
        $navString = str_replace( "</a><li><a", "</a></li>\r<li><a" , $navString);
        
        echo $navString;
        exit;
        
        $navString = str_replace( '</li></li>', "</li>" , $navString);
       
        $navString = trim($navString,'</li>');
        //echo $navString;
        //exit;
        
        //the thing ends in an <li>
      
        return $navString;
	
    
    }



}
?>