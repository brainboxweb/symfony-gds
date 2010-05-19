<?php


/**
 *   EMAIL SETTINGS
 *   
 *   mail.mizu-shotokan-karate-do.org.uk
 *
 *   form123@mizu-shotokan-karate-do.org.uk  /  mizu-form123  /  secure789
 *   info@mizu-shotokan-karate-do.org.uk     /  mizu-info     /  secure123
 *   clint@mizu-shotokan-karate-do.org.uk    /  mizu-clint    /  secure432
 *
 */



$shortName='mizu';
$longName='Mizu Shotokan Karate-Do';

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

#print_r( $requestArray );

#Override for other environments
//$request = $_SERVER['REQUEST_URI'];
//$requestArray = explode('/', $request);
//$environment = $requestArray[1];
#echo '<p>Environ ' . $environment . '<hr>';

//print_r($_SERVER);

$googleMapsKey = 'ABQIAAAA8Hzw9HrwGJ6wQnjbAWCa3hQYl-Q5BS5hr4QdJfHw2k4L-nL18hSS-71a-4IhBG66mzAgPKtHW6abcg';


if(isset( $_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']=='mizu.local')  {
    
    $config['dbUser']=          'root';
    $config['dbPass']=          ''; 
    $config['dbName']=          $shortName;
    //$config['basePath'] =       '/' . $environment . '/' . $shortName . '/www/';
    //$config['adminBasePath'] =  '/' .  $shortName . '/www/admin/';     
    $config['baseFilePath'] =   'c:/wamp/www/' . $shortName . '/www/';
    
    $googleMapsKey = 'ABQIAAAA8Hzw9HrwGJ6wQnjbAWCa3hStyFFKDdj9QutTEm_pDS4pBROGkhQeLnpPbdl1K1fqg_IsHMPCMzLfbA';
    
}


define ('GOOGLE_MAPS_KEY', $googleMapsKey);





$emailDetails = array();	

$emailDetails['contact']=array( 
	'shortName'=>'contact',
    'subject' => $longName . ' :: Main Contact Form',
	'to' =>  array('mizu@fsmail.net, form123@mizu-shotokan-karate-do.org.uk')
	);			


#print_r($config);
#exit;



//Start PDO
$dbName=$config['dbName'];
$host = $config['dbHost']; 
try {$dbPDO = new PDO("mysql:dbname=$shortName; host=$host", $config['dbUser'],$config['dbPass'] );
}
catch (PDOException $e) {
echo "Failed to connect: "
. $e->getMessage();
}
















