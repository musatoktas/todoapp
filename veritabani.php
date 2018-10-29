<?php

try {
 
	 $db = new PDO("mysql:host=localhost;dbname=fifth;charset=utf8", "root", "",
	 array(
	 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	 ));
} catch ( PDOException $e ){
     print $e->getMessage();
}



?>