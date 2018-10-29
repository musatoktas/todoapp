<?php
include 'veritabani.php';


if($_POST)
{
	$dataset = $_POST["query"];

	$islemcode = $dataset["islem"];
	switch($islemcode)
	{
		case "set":
		
	
		
		$eventid = $dataset["eventid"];

		
		//sql_run
		
		// $sql_query = $db->prepare("UPDATE items SET acik='{$eventid}' WHERE id='$id'");
		$sql_query = $db->prepare("INSERT INTO items (acik) VALUES ('{$eventid}')");
		$sql_run = $sql_query->execute();
		
		
		break;

		case "delItem":
		
		//SAÇMA 
		$id = $dataset["parentid"];
		echo $id;
		// "DELETE from items where id='{$id}'"
		$sql_query = $db->query("DELETE FROM `items` WHERE `items`.`id` = ('{$id}')");
		$sql_run = $sql_query->execute();
		

		
		break;	

		

		
	}
	
}
?>