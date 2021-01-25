<?php 
session_start();

define('dbhost', 'brox6kupjd5sesaolxut-mysql.services.clever-cloud.com');
define('dbuser', 'uzvy3wnjpk86nigq');
define('dbpass', 'm5pv3b0Unyr8VRooTAY8');
define('dbname', 'brox6kupjd5sesaolxut');

try {
	$connect = new PDO("mysql:host=".dbhost.";dbname=".dbname,dbuser,dbpass);
	$connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo $e->getMessage();
}
?>