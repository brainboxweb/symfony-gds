<?php
/**
 * 
 *
 *
 *
 * Take 3: going to try this:
 *   * PHP script comes up with the filename (full path)
 *   * PHP invokes a bash script to do the actual conversion
 *
 */


$srcdir="/var/www/mizu-svn/uploadedimages"; //no trailing slashes please!

$command = "/usr/sbin/lsof $srcdir"; 

$error = exec($command,$result,$returnCode);
echo $returnCode;
if($returnCode == 0){
	#fwrite(STDERR, "Error: $error\n");
	echo 'Result is: ' ;
	print_r($result);	
	
	foreach ($result as $entry) {
		
		if(stristr($entry,'vsftp')){
			echo 'vsftp found. Stopping';
			exit;
		} 
		if(stristr($entry,'php')){
			echo 'php found. stopping.';
			exit;
		}




	}

} else {
	echo 'Exit code 1. Error... or nothing found. Continue.';
	#$result = implode("\n",$result);
	#fwrite(STDOUT,$result);
	#echo $result;
	#if($result){
	#	echo 'Upen files found. Abort';
	#exit;
	#}
}
echo 'GOT THIS FAR';
#exit;
try
{
	echo 'trying...to process' . $srcdir ;	   
 	foreach (new DirectoryIterator($srcdir) as $item){
		        
         if($item->isDir() ){
            
            	$dirName=$item->getFilename();
            	if($dirName=='.' || $dirName=='..'){
                	continue;
            	}
           	 echo 'DIRECTORY '.  $dirName ;


		#$command =  'lsof "' . $item->getPathname() . '"';
		#echo 'COMMAND:>' . $command . '<';
		#$result = shell_exec($command );
		##fwrite(STDOUT,$result); 
		#echo $result;	
         	#exit;
		#if($result){
	#		echo 'FOLDER BUSY... SKIPPING';
	#		continue;
	#	}   
           	try
            	{
                	foreach (new DirectoryIterator($srcdir . '/' . $dirName) as $item2){
       				 
                    		if($item2->isDir()){
                        		continue;
                        
                    		}
				echo '--Item is ' . $item2;

                    		$command = '/var/www/mizu-svn/bin/uploadscript.sh "' . $item2->getPathname() . '"' ;
                    		echo 'COMMAND>' . $command;
                        	$result = shell_exec($command );
                        	fwrite(STDOUT,$result);
        
                	}

			//hOPEFULLY ALL IS NOW WELL AND THE FORLDER CAN BE REMOVED
                	echo shell_exec('rm -r "' . $item->getPathname() . '"' );
	

            	}
            	catch(Exception $e)
            	{
                	echo $e->getMessage();
            	} 
           
        }     
   }
}
catch(Exception $e)
{
    echo $e->getMessage();
}



