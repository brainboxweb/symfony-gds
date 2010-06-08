<?php
/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description

*/

require_once('NormalPage.php');

Class PortfolioPage extends NormalPage{
     
     ##protected $InfoItem;
     
     protected $development;

     function __construct($dbPDO, $pathVars){
          
          //parent::__construct($dbPDO,$pathVars, '/');
         
          $this->dbPDO = $dbPDO;
          $this->pathVars = $pathVars;          
          
          
          $this->initialise();
          
          
     }
     
     function initialise(){
          
          if( $this->pathVars->size() == 1 ){
               
               $this->getList();
               
          } else {
               
               $this->getItem();
               
          }
          
     }
     
     
     function getList(){
          

          $this->title  = 'Portfolio';
          //$this->description
          
          require_once('Portfolio/Portfolio.php');
          
          //Get the portfolio objects
          $this->portfolioArray = Portfolio::getAll($this->dbPDO);
          
          //Render the view;
          $this->renderView('portfolio-list');
          
        
     }
               
     function getItem(){
          
          //echo 'ITEM ' . $this->pathVars->fetchByIndex(1);
          
          require_once('Portfolio/Portfolio.php');
          
          //Get the portfolio objects
          $portfolioItem = Portfolio::getById($this->dbPDO, $this->pathVars->fetchByIndex(1));
          
          //var_dump($portfolioItem);
          
          
          //Render the view;
          //$this->renderView('portfolio-item');
          
          $this->title = $portfolioItem->title;
          $this->contentString = $portfolioItem->body;
          
          
               
     }
     
     
     
      function renderView($view){
	  
	  ob_start();
	       
	       require 'views/' . $view . '.php';
	       
	       $this->contentString .= ob_get_contents();
	  
	  ob_end_clean();
	  
     }
     
     
      
    
}