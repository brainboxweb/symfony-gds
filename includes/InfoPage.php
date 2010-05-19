<?php
/*
This class needs to provide the following to the parent class:

$this->contentString					
$this->shortTitle 
$this->titleNote 
$this->title 
$this->description

  May 2007 - adpated to use the Nakheel Info "engine"
  Assumptions:
  
     - No year paging (throw-away website)

*/

require_once('NormalPage.php');

Class InfoPage extends NormalPage{
     
     ##protected $InfoItem;
     
     protected $development;

     function __construct($dbPDO, $pathVars, $basePath, $index){
          
          #echo $index;
          
          #exit;
          $this->basePath=$basePath;
          $this->dbPDO=$dbPDO;
          
          $this->metaTitle='Information Centre';
          
          #echo $this->metaTitle;
          #exit;
          
          
        
          $this->index=$index ; //index of the "info" part of the request string
          
          #print_r($pathVars);
          
          $this->originalPathVars = clone $pathVars; ///Note that it must be a CLONE
          
          #want to run the PARENT... but want to "force" it to ignore the last part of the url (if it's an article)
          $this->adjustedPathVars = $pathVars;
          $this->adjustedPathVars->trimToIndex($this->index+1);
          
          $this->requestedDevelopment=$this->originalPathVars->fetchByIndex($this->index+2);
          
            $this->getTabs();
          
         # echo $this->development;
          
          parent::__construct($dbPDO,$this->adjustedPathVars, $basePath);
          
          
          
     }
     protected function getTabs(){
          
          require_once ('Development/Development.php');
          require_once ('Development/Model/Development.php');
          
          $developmentModel = new Model_Development($this->dbPDO);
          
          $developmentModel->getItems();
          
          #print_r($developmentModel->fetch() );

          
          $tabString = '<ul id="tabs" class="tabs">';
          
          if(!$this->requestedDevelopment){
                    
                    $classString=' class="select" ';
             
          }
          
          $tabString .='<li class="first" id="tab-0"><a '.$classString.'href="' . $this->basePath . $this->adjustedPathVars->getLocation() . '"><img src="' . $this->basePath . 'html/images/tab-nakheel.gif" width="122" height="60" alt="Nakheel" /></a></li>';
              
          $counter=1;
          while ( $data = $developmentModel->fetch() ){
               
               
               #print_r($data);
               #exit;
               
               $development = new Development;
               
               $development->populate($data);
               
               #echo $development->shortName;
               
               
               if($counter==5){
                    
                    $tabClassString=' class="last" ';
               } else {
                     $tabClassString='';
               }
               
               
               if($this->requestedDevelopment == $development->shortName){
                    
                    $classString=' class="select" ';
               } else{
                    
                    $classString='';
                    
               }
               
               $tabString .= '<li' .  $tabClassString . ' id="tab-' . $development->id . '"><a '.$classString.'href="' . $this->basePath . $this->adjustedPathVars->getLocation() . '/item/' . $development->shortName . '"><img src="' . $this->basePath . 'html/images/tab-' . $development->shortName . '.gif" width="122" height="60" alt="' . $development->name . '" /></a></li>';
               $counter++;
               
            
          }
          $tabString .= '</ul>';
          
          $this->tabString=$tabString;
       
        #exit;
         
     }
     
     
     
      protected function getContent(){
          
          //Run the parent to get stuff like metaTitle/metaDescription. (Think about making this an automatic call);
          parent::getContent();
          
          #require_once('config.php');
          require_once('Info/Info.php');
          require_once('Info/Model/Info.php');
          
          #Get the data for the selected Info article
          $InfoModel=new Model_Info($this->dbPDO);
          
          $InfoModel->getByDevelopment( $this->originalPathVars->fetchByIndex($this->index+2) );
          $data=$InfoModel->fetch();
          #print_r($data);
          #exit;
          
          $contentString ='';
          if($data){
                  
                  #print_r($data);
                  #exit;
                  
               #Create the Object
               $this->InfoItem=new Info();
               $this->InfoItem->populate($data);
              
               #$this->title = $this->InfoItem->title;
               #$this->metaTitle = $this->InfoItem->metaTitle;
                
               $contentString = $this->InfoItem->body;
               
              # echo $contentString;
              # exit;
                  
          } else {
              #echo 'OOOPS need to redirect';
           
              header("HTTP/1.0 404 Not Found");
              $contentString .= '<h1>Info item not found</h1>';
              $contentString .= '<p>The Info item you were looking for has been moved or no longer exists.</p>';
             
          }
          $this->contentString=$this->tabString . "<div id='tab_content' class='tab_content'>" . $contentString . "</div>";
          
          #echo $contentString;
          #exit;
          
         # echo $this->contentString;
          
          
     }
          
      
      
    
}