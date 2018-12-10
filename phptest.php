<?php
define('WEB_PATH', $_SERVER["DOCUMENT_ROOT"].'/mintair');

$file_name ='hello.php';

function findExts($filename) 
 	{ 
 		$dd=strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	 	return  $dd; 
 	}


//echo pathinfo($file_name, PATHINFO_EXTENSION); // outputs html



 

 echo findexts($file_name);

/*$file_ext=strtolower(end(explode('.',$file_name)));
$allowextention = 'php';

if($file_ext != $allowextention){

      			print_r( "Extension not allowed, please choose a  file");
      		}

echo '<pre>';
print_r($file_ext);
echo '<pre/>';*/
