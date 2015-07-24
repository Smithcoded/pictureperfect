<?php

$pdo_host = 'localhost';
$pdo_user = 'root';
$pdo_pass = '';
$pdo_db = 'pictureperfect';

try{
	$conn= new PDO("mysql:host=$pdo_host; dbname=$pdo_db", $pdo_user, $pdo_pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
}
catch(PDOException $e){
	echo "Connection Failed: ". $e->getmessage();
	

}


?>