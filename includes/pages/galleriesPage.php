<?php



require_once('Gallery/Model/Gallery.php');
require_once('Gallery/Gallery.php');
require_once('Gallery/Model/GalleryImage.php');
require_once('Gallery/GalleryImage.php');



$imageSizeThumb='80x80';
$imageSizeThumb='160x160';
$imageSize='630x630';
$imageSize='160x160';
//print_r($data);


if( empty($_GET['galleryId']) )
{
     //Galleries page
     echo'galleries page';
     $mGallery=new Model_Gallery($dbPDO);
     $data = $mGallery->get();
     
     foreach ($data as $item)
     {
          $gallery = new Gallery($dbPDO);
          
          $gallery->populate($item);
           
          echo '<img src="/galleries/' . $gallery->name . '/' . $imageSize . '/' . $gallery->keyImage->filename. '" />';
               
     }
     
    
     
}
elseif( empty($_GET['imageId'])  )
{
     
     echo 'gallery page';
     
     
     
}
else
{
     
     echo 'photo page';
     
     
}


 