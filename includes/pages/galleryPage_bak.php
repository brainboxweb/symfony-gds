<?php

require_once('Gallery/Model/Gallery.php');
require_once('Gallery/Gallery.php');
require_once('Gallery/Model/GalleryImage.php');
require_once('Gallery/GalleryImage.php');

$mGallery=new Model_Gallery($dbPDO);

$galleryName='CHLOE GREY - RAIN - MAX CARLISLE';
$imageSizeThumb='80x80';
$imageSizeThumb='160x160';
$imageSize='630x630';
$data = $mGallery->getByName($galleryName);
//print_r($data);


$mImage=new Model_GalleryImage($dbPDO);

if(!empty($_GET['id']) ){
   
     $image= $mImage->getById($_GET['id']);

   // print_r($image);

     echo '<img src="galleries/' . $galleryName . '/' . $imageSize . '/' . $image['filename']. '" />';

} else {
     $data = $mImage->getByGalleryId(1);
    // print_r($data);

     foreach($data as $image){


      echo '<a href="?id=' . $image['id'] . '">
<img src="galleries/' . $galleryName . '/' . $imageSizeThumb . '/' . $image['filename']. '" />
</a>';
    }

}
?>