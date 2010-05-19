<?php

require_once('NormalPage.php');

Class GalleryPage extends NormalPage{
	
	
	
	//This class needs to provide the following to the parent class:
	public $contentString	;				
	public $shortTitle ;
	public $titleNote ;
	public $title ;
	public $description;
	
	private $keyImageSize = '160x160';
	
	

	function __construct($dbPDO, $pathVars){
		
		$this->dbPDO=$dbPDO;
		$this->pathVars=$pathVars;
		
		$this->_initialise();
			
	}
       
       
    function _initialise(){
                
		
		
		$this->getTopNav();
		
		//Determine which type of page to render
		if($this->pathVars->fetchByIndex(2)){
			
			$this->renderPhoto($this->pathVars->fetchByIndex(1),$this->pathVars->fetchByIndex(2));
		}
		elseif ($this->pathVars->fetchByIndex(1)){
			
			$this->renderGallery($this->pathVars->fetchByIndex(1));
			
		} else {
			
			$this->renderGalleries();
			
		}
		
		
	}
	
	
	function renderGalleries()
	{
		
		//echo '<h1>Galleries</h1>';
		$this->title = 'Galleries';
		
		
		require_once ('Gallery/Model/Gallery.php');
		require_once ('Gallery/Gallery.php');
		
		$mGallery=new Model_Gallery($this->dbPDO);
		$data = $mGallery->get();
		
		//print_r($data);
		
		$this->contentString .= '<div id="galleries">';
		foreach ($data as $item)
		{
			$gallery = new Gallery($this->dbPDO);
			
			$gallery->populate($item);
			$this->contentString .= '<div>';
			
			$this->contentString .= '<a href="/gallery/'.$gallery->id . '">'; 
			$this->contentString .= '<img src="/galleries/' . $gallery->name . '/' . $this->keyImageSize . '/' . $gallery->keyImage->filename. '" />';
			$this->contentString .= '</a>';
			
			$this->contentString .= '<p><a href="/gallery/'.$gallery->id . '">'; 
			$this->contentString .= $gallery->name;
			$this->contentString .= '</a></p>';
			
			$this->contentString .= '</div>';
		}
		
		$this->contentString .= '<div class="spacer">&nbsp;</div></div>';
		
	}
	
	
	
	function renderGallery($galleryId)
	{
		
		require_once ('Gallery/Model/Gallery.php');
		require_once ('Gallery/Gallery.php');
		
		$mGallery = new Model_Gallery($this->dbPDO);	
		 
		$data = $mGallery->getById($galleryId);		
		
		$gallery = new Gallery($this->dbPDO);
		$gallery->populate($data);
			//print_r($data);
		
		$this->title = $gallery->name;
		
		///Get the images
		require_once ('Gallery/Model/GalleryImage.php');
		
		$mImage = new Model_GalleryImage($this->dbPDO);	
		
		$data = $mImage->getByGalleryId($gallery->id);
		
		
		
		
		
		$this->contentString .= '<p><a href="/gallery" >&lt; Back to galleries </a></p>';
		
		$this->contentString .= '<div id="gallery" >';
		
		
		foreach($data as $item){
			
			$image= new GalleryImage();
			$image->populate($item);
	
			$this->contentString .= '<div>';
			$this->contentString .= '<a href="/gallery/' . $gallery->id . '/' . $image->id . '">';
			$this->contentString .= '<img src="/galleries/' . $gallery->name . '/160x160/' . $image->filename . '" />';
			$this->contentString .= '</a>';
			$this->contentString .= '</div>';
		}
		$this->contentString .= '</div>';

    }
    
	
	
	function renderPhoto($galleryId,$imageId)
	{
		require_once ('Gallery/Model/Gallery.php');
		require_once ('Gallery/Gallery.php');
		$mGallery = new Model_Gallery($this->dbPDO);	
		$galleryData = $mGallery->getById($galleryId);
		$gallery= new Gallery($this->dbPDO);
		$gallery->populate($galleryData);
		
		require_once ('Gallery/Model/GalleryImage.php');
		require_once ('Gallery/GalleryImage.php');
		$mImage = new Model_GalleryImage($this->dbPDO);	
		$imageData = $mImage->getById($imageId);
		$image= new GalleryImage();
		$image->populate($imageData);
		
		
		$this->title = $gallery->name;
		
		$this->contentString = '<p><a href="/gallery/' . $gallery->id . '" >&lt; Back to gallery </a></p>';
		
		$this->contentString .= '<div id="gallery">';
		$this->contentString .= '<img src="/galleries/' . $gallery->name . '/630x630/' . $image->filename . '" />';
		$this->contentString .= '</div>';
		


    }
	
	
	function breadcrumbArray(){

		$breadcrumbArray=array();
		$breadcrumbArray[]=array('fullPath'=>'gallery','title'=>'Gallery');
		return $breadcrumbArray;

    }
       
        function cssArray(){
                
              
                $cssArray=array();
                
                $cssArray[]='css/flexi.css'; 
                
                //$cssArray[]='build/fonts/fonts.css';                    //calendar
                //$cssArray[]='build/reset/reset.css';                    //calendar
                //$cssArray[]='build/calendar/assets/calendar.css';       //calendar
                
                //$cssArray[]='build/fonts/fonts-min.css';                //tabs
                //$cssArray[]='build/tabview/assets/skins/sam/tabview.css';//tabs
		
                return $cssArray;
                

        
        }
        function javaScriptArray(){
                
                $jsArray=array();
                $jsArray[]='js/validate_form.js';              //calendar
                $jsArray[]='js/tooltips.js';
               
                
                return $jsArray;
        }
       
}
