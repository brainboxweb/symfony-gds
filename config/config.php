<?php




$shortName='gds';
$longName='Gary Straughan';

define('BASE_PATH', '/');
define('BRAINBOX_EMAIL_ADDRESS', 'gary.straughan@brainboxweb.co.uk');

#echo $longName;

#Live Site
    $config['dbHost']=          'localhost';
    $config['dbUser']=          'achippp';
    $config['dbPass']=          'carr0t';     
    $config['dbName']=          $shortName;
    $config['basePath']=        '/' ;
    $config['adminBasePath']=   '/admin/';   
    $config['baseFilePath']=    '/';



if(isset( $_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']=='gds.local')  {
    
    $config['dbUser']=          'root';
    $config['dbPass']=          ''; 
    $config['dbName']=          $shortName;
    $config['baseFilePath'] =   'c:/wamp/www/' . $shortName . '/www/';

}


$emailDetails = array();	

$emailDetails['contact']=array( 
	'shortName'=>'contact',
    'subject' => $longName . ' :: Main Contact Form',
	'to' =>  array(BRAINBOX_EMAIL_ADDRESS)
	);			




//Start PDO
$dbName=$config['dbName'];
$host = $config['dbHost']; 
try {$dbPDO = new PDO("mysql:dbname=$shortName; host=$host", $config['dbUser'],$config['dbPass'] );
}
catch (PDOException $e) {
echo "Failed to connect: "
. $e->getMessage();
}
