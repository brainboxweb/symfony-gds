<?php
/**
 * 
 *
 *
 *
 * Taking the folder name as an input,
 *
 *   * insert/update the Gallery table
 *   * insert/update the Image table
 *
 */


define('BASE_PATH',dirname(dirname(__FILE__) ) );
require_once (BASE_PATH . '/config/config.php');

//echo BASE_PATH;
/*
//Bit of a hack
$_SERVER['HTTP_HOST']='mizu.local';



$basePath=$config['basePath'];

#echo $basePath;

//Connect to the database
$dbName = $config['dbName'];
$dbHost = $config['dbHost'];
$dbUser = $config['dbUser'];
$dbPass = $config['dbPass'];
try {
   $dbPDO = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
   #echo 'connected';
} catch (PDOException $e) {
   print "Error!: " . $e->getMessage() . "<br/>";
   die();
}

*/

require_once(BASE_PATH . '/shared/Gallery/Model/Gallery.php');
require_once(BASE_PATH . '/shared/Gallery/Model/GalleryImage.php');



$gallery = new Model_Gallery($dbPDO);
$gallery->isActive = false;
$image = new Model_GalleryImage($dbPDO);
$image->isActive = false;

$srcdir = BASE_PATH . 	'/www/galleries'; //no trailing slashes please!
 
foreach (new DirectoryIterator($srcdir) as $item){
                
    if($item->isDir() ){
    
        $dirName=$item->getFilename();
        if($dirName=='.' || $dirName=='..'){
                continue;
        }
        fwrite(STDOUT, "\n\nDirectory: $dirName\n-------------------------------------------------------------\n");
        
        $galleryId =  $gallery->addByFilename($dirName);
    
         fwrite(STDOUT, "Galler id is :  $galleryId\n");
        //In case th 32x32 directory isn't there....
        try{ 

            foreach (new DirectoryIterator($srcdir . '/' . $dirName . '/32x32') as $item2){
                
                if($item2->isDir()){
                    
                    continue;
                    
                }
            
                fwrite(STDOUT, "$item2");
                
                if($id = $image->add($galleryId , $item2) ){
                    
                fwrite(STDOUT, " - added with id $id\n");
                    
                } else {
                    
                    fwrite(STDOUT, " - already in database\n");
                }
    
                
            }
            
        }
        catch (Exception $e) {
               fwrite(STDOUT, '#############' . $e->getMessage() . "\n" );
            
            
        }

    }
}

