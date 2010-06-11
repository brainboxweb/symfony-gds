<?php

/**
 * 27 Apr - Slight change of emphasis: going to make this class more "front-end" oriented: less "raw" database
 * values, more business rules. A consequence is that the Admin site will now talk drectly to the Model
 *
 */



Class Portfolio {
    
    public $id;
    public $title;
    public $description;
 
    public $body;
    public $lastUpdate;        
   
    //Derived 
    public $metaTitle;
    public $metaDescription;
    
        
    

    function __construct(){
        
        
      
    }
    
    
    
    /**
     * Staic function: gets data from the model,
     * creates a bunch of objects
     * returns an array of objects.
     *
     *
     *
     *
     */
    
    public static function getAll($dbPDO){
        
        require_once 'Model/Portfolio.php';
        
        $data = Model_Portfolio::getAll($dbPDO);
        
        
        //var_dump($data);
        
        $portfolioArray = array();
        
        foreach ($data as $item){
            
            $portfolioItem = new self;
            
            $portfolioItem->populate($item);
            
            $portfolioArray[] = $portfolioItem;
            
        }
        
        return $portfolioArray;
        
    }
    
    
    /**
     * Staic function: gets data from the model,
     * creates a bunch of objects
     * returns an array of objects.
     *
     *
     *
     *
     */
    
    public static function getById($dbPDO, $id){
        
        require_once 'Model/Portfolio.php';
        
        $data = Model_Portfolio::getById($dbPDO, $id);
        
            
        
            
        $portfolioItem = new self;
        
        $portfolioItem->populate($data);
            
        // var_dump($portfolioItem);
        //exit;   
            
            
        return $portfolioItem;
        
    }
    
    
    
    
    /**
     * Populates the class with values from the Model
     *
     */
    

    public function populate($data){
        
        //echo '------------------------------ppp<pre>';
        //print_r($data);
        //exit;
        
        
        if(isset($data['id']))
            $this->id = $data['id'];
        
        if(isset($data['title']))
            $this->title = $data['title'];
            
        
        if(isset($data['meta_title']))
            $this->metaTitle = $data['meta_title'];
        
        if(isset($data['meta_description']))
            $this->metaDescription = $data['meta_description'];
            
            
        if(isset($data['body']))
            $this->bodyRaw = $data['body'];
            
            
            //echo $this->body;
            //exit;
        
        
        if(isset($data['is_published']))
            $this->isPublished = $data['is_published'];
            
         
        if(isset($data['last_update']))
            $this->lastUpdate = $data['last_update'];
           
      
        $this->applyBusinessRules();
        
        
        //var_dump($this);
        
        
        
        
    }
    
    /**
     *
     *
     */
    
    protected function applyBusinessRules(){
        
        //Derived parameters
        
    
        
        require_once('Markdown/markdown.php');
        $this->body=Markdown($this->bodyRaw);
    
      
    }
    
    
   
}