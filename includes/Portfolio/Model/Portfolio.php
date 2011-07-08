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
        
         
        $sql = "SELECT * FROM portfolio ORDER BY sortorder";
                
                
       
        
      
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
    
    public function updateFromPOST($dbPDO){
        
      
        //var_dump($_POST);
       
        
        $sql = "UPDATE portfolio
                
                SET
                title = :title,
                
                
                
                body = :body,
                
                meta_title = :metaTitle,
                meta_description = :metaDescription,
                
                is_published = :isPublished
                
                WHERE id=:id";
        //echo $sql;
        #exit;
        
        $stmnt = $dbPDO->prepare($sql);
        
        
        
        
        
        
        $stmnt->bindParam(':id',        $_POST['id'] );
        
        $stmnt->bindParam(':title',     $_POST['title'] );
        $stmnt->bindParam(':body',      $_POST['body'] );
        
        $stmnt->bindParam(':metaTitle',         $_POST['metaTitle'] );
        $stmnt->bindParam(':metaDescription',   $_POST['metaDescription'] );
        
        
        $isPublished = '0';
        if( $_POST['isPublished'] ){
            $isPublished = '1';
        }
    
        $stmnt->bindParam(':isPublished',   $isPublished );
        
        
    
         
         
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
        
        
        
        //print_r( $stmnt->ErrorInfo() ) ;
        //exit;
        
        
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
    
    
    public function add($dbPDO, $title = '***New Item**'){
        
      
        $sql = "INSERT INTO
        
                portfolio (title )
                
                VALUES
                    ( :title)
                    
                    ";

        echo $sql;

        $stmnt = $dbPDO->prepare($sql);
       
        $stmnt->bindParam(':title', $title);
        
       
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
        
        //print_r($stmnt->errorInfo()) ;
        //exit;
        
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