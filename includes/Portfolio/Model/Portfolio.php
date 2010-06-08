<?php

/**
 * 17 Apr
 *
 *
 *
 */


Class Model_Portfolio{

    
  
  
    
    public function __construct(){
       
      
        
    }
    
    public function getAll($dbPDO){
        
         
        $sql = "SELECT * FROM portfolio";
                
                
       
        
      
        $stmnt = $dbPDO->prepare($sql);
        
        $stmnt->execute();
    
    
    
        $results = $stmnt->fetchAll();
        
        return $results;
        
    }
    
    
     public function getById($dbPDO, $id){
        
         
        $sql = "SELECT * FROM portfolio
                WHERE
                    id = $id";
                

        $stmnt = $dbPDO->prepare($sql);
        
        $stmnt->execute();

        $result = $stmnt->fetch();
        
        return $result;
        
    }
    
    
    
    public function getByPath($path){
        
       # print_r($this->dbPDO);
        
        
        $sql = "SELECT * from news
                WHERE 1 = 1                 
                AND path = '" .  $path . "' ";
                
                
        if($this->isActive){        
            $sql .= "
                    AND published < NOW()
                    AND (depublish > NOW() OR depublish is NULL)";        
        }
        
        $sql .= " LIMIT 1 ";
        
        //echo $sql;
       # exit;
        $this->stmnt = $this->dbPDO->prepare($sql);
        
        $this->stmnt->execute();
    
        
    }
    
    
    
    
    
    /**
     * 27 Apr 08 - changing so that it's updated with POSTED data... not with the News object
     * 19 May 08 - upaded from POST - to make use of filter
     *
     * 17 June 08 - updated so the form doesn't REPLY on javascript. Chabn
     *
     */
    
    public function updateFromPOST(){
        #print_r($data);
        #echo '<h1>News Model class needs to be udated';
       # exit;
        #echo '<p>SUBTITLE IS ' . $newsItem->lastUpdate;
        #exit;
        #echo '<textarea rows=20 cols=100>' . $newsItem->body . '</textarea>';
       # exit;
       
      
        
        $sql = "UPDATE news
                
                SET
                title = :title,
                
                
                
                body = :body,
                
                meta_title = :metaTitle,
                meta_description = :metaDescription,
                
                published = :published,
                depublish = :depublish
                

                WHERE id=:id";
        //echo $sql;
        #exit;
        
        $stmnt = $this->dbPDO->prepare($sql);
        
        $stmnt->bindParam(':id', $id);
        
        $stmnt->bindParam(':title', $title);
        $stmnt->bindParam(':body', $body);
        
        $stmnt->bindParam(':metaTitle', $metaTitle);
        $stmnt->bindParam(':metaDescription', $metaDescription);
        
        $stmnt->bindParam(':published', $published);
        $stmnt->bindParam(':depublish', $depublish);    
        
        
    
       
        
         $id = '';
        $title = ''; 
       // $subtitle = ''; 
        
        $featured = '';
        
        //$metaTitle = ''; 
        $metaDescription = ''; 
        $body = ''; 
        //$path = '';
        $published = NULL;
        $depublish = NULL;
        $expire = NULL;
        
        
        
        $id = $_POST[ 'id'];
        
        $title = $_POST[ 'title']; 
        $teaser = $_POST[ 'teaser']; 
        $body = $_POST[ 'body'];
        
        $metaTitle = $_POST[ 'metaTitle'];
        $metaDescription = $_POST[ 'metaDescription']; 
        

        $published = $_POST[ 'published'];
        $depublish = $_POST[ 'depublish'];
        $expire = $_POST[ 'expire'];
        
        
     
        
        
        #echo $published;
       
        
        $dateArray = explode('-',$published);
        $published = $dateArray[2] . '-' .  $dateArray[1] . '-' .$dateArray[0] ;
        #echo $published;
        #echo '<hr>' . strtotime($published);
        #exit;
        
        
        //New logic for depublish: Expire (the radio control) may may be NEVER or DATE
        
        if($expire=='never'){
            
            $depublish = NULL;
        } else {
            $dateArray = explode('-',$depublish);
            $depublish = $dateArray[2] . '-' .  $dateArray[1] . '-' .$dateArray[0] ;
            
        }
        
        
        
        
        /*
        $image=$data['image'];
        $alt=$data['alt'];
        
        
        if(trim($data['width']) ){
            
            $width=$data['width'];
        } else {
            $width=null;
        }
        
         if(trim($data['height']) ){
            
            $height=$data['height'];
        } else {
            $height=null;
        }
        
        #$width=$data['width;
        #$height=$data['height;
        */
       
        #echo 'setting awkward to ' . $awkward;
        
        
        
         #echo '<hr>';
         
         
         $this->dbPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $stmnt->execute();
        }
        catch (PDOException $e)
        {
            #echo 'hasdasdas here';
            print ("The statement failed.\n");
            print ("getCode: ". $e->getCode() . "\n");
            print ("getMessage: ". $e->getMessage() . "\n");
        }
        #print_r( $stmnt->ErrorInfo() ) ;
        #exit;
        
        
    }
    
    
    /**
     * Assumes that the image will be updated using $_POST and $_FILES data
     *
     */
    
    public function updateImage($imagePath){
        
        
        //Store the image
        #echo '<hr>';
        #print_r($config);
        #echo '<hr>';
        
        //Get image site
        $dims = getimagesize($_FILES['image']['tmp_name']);
        
        $width=$dims[0];
        $height=$dims[1];
        
        
        
        
        
        
        
        
        // Load the source image
        $original = imagecreatefromjpeg($_FILES['image']['tmp_name']);
        // Create a blank thumbnail (note slightly reduced height)
        $thumb = imagecreatetruecolor(303,162);
        //Resize it
        imagecopyresampled( $thumb, $original, 0, 0, 0, 0, 303, 162, $dims[0], $dims[1] );
        //Save the thumbnail
        $path= $imagePath . 'article_' . $_GET['id'] . '.jpg';
        
        //Fix possible double-forward slashes
        $path=str_replace('//','/',$path);
        
        #echo $path;
        #exit;
        imagejpeg($thumb,$path);
       
       
        //Store the main image
        $filename='main-'. $_GET['id'] .'.jpg';
        $path= $imagePath;
          //Fix possible double-forward slashes
        $path=str_replace('//','/',$path);
        
        move_uploaded_file($_FILES['image']['tmp_name'],$path . $filename);

        //tell the database 
       
        
        
        
        
          
        $sql = "UPDATE news
                
                SET
               
                image = :image,
                
                width = :width,
                height = :height
                
           
                WHERE id=:id";
        #echo $sql;
        #exit;
        
        $stmnt = $this->dbPDO->prepare($sql);
        
        $stmnt->bindParam(':id', $id);
      
        $stmnt->bindParam(':image', $image);
       
        $stmnt->bindParam(':width', $width);
        $stmnt->bindParam(':height', $height);
        
        $id = $_POST['id'];
        $image = $filename;
        $width = (int) $dims[0];
        $height = (int) $dims[1];
        
        #echo '<hr>';
        try
        {
            $stmnt->execute ();
        }
        catch (PDOException $e)
        {
          print ("The statement failed.\n");
          print ("getCode: ". $e->getCode () . "\n");
          print ("getMessage: ". $e->getMessage () . "\n");
        }
        
        #print_r($stmnt->errorInfo()) ;
     
        
        
    }
    
    
    
    
    
    
    /**
     * Tricky this here is that the path is a mandatory field... and it must be unique
     *
     * 
     */
    
    
    public function addItem($title = 'New Item'){
        
        /*
        $path = $this->createPathfromTitle($title);
        
        //Check the path is OK
        
        $sql = "SELECT count(*) from news where title = '$path'";
        $stmnt = $this->dbPDO->prepare($sql);
        $stmnt->execute();
        $result = $stmnt->fetch();
        
        //Path already taken? append the date
        if($result['count(*)'] !=0){
            $path = $path . '-' . time();
        }
        */
        // Use "NOW()" rather than an generated date to preserve the order of multiple items added as
        // part of the same session
        
        $sql = "INSERT INTO news (
                    title,
                    published,
                    depublish
                    
                    )
                VALUES (
                    :title,
                   NOW(),
                   :depublish
                

                    );";

        echo $sql;

        $stmnt = $this->dbPDO->prepare($sql);
       
        $stmnt->bindParam(':title', $title);
        
        $stmnt->bindParam(':depublish', $depublish);
        
        //Publish today
        #$published = date('Y') . '-' . date('m'). '-' . date('d');
        //Depublish yesterday
        $depublish = date('Y',mktime(0,0,0,date('m'),date('d')-1,date('y'))) . '-' . date('m',mktime(0,0,0,date('m'),date('d')-1,date('y'))). '-' . date('d',mktime(0,0,0,date('m'),date('d')-1,date('y')));
     

        try
        {
            $stmnt->execute ();
        }
        catch (PDOException $e)
        {
            print ("The statement failed.\n");
            print ("getCode: ". $e->getCode () . "\n");
            print ("getMessage: ". $e->getMessage () . "\n");
        }
        
        #print_r($stmnt->errorInfo()) ;
        
        
    }
    
    /**
     * Usually called STATICALLY for the admin site
     *
     * IMPORTANT: depublish can be NULL
     */
    function status($published, $depublish){
	
        #echo 'pub' . $published;
        #echo 'expi' . $depublish;
        #exit;
        
        $today=time();
	
	if($published > $today){
	    return 'pending';
	}
        
        if($published < $today && ($depublish==null || $depublish > $today)  ){
            
            return 'active';
        }
        
	    return 'expired';
        
    }

}