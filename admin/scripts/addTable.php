<?php
//add a table that will store submission data for a guide
	function addTable($name){
	include 'dbCon.php';
	

	$sql="CREATE TABLE ".$name."(date VARCHAR(25),age INT(3), postcode VARCHAR(15), email VARCHAR(50), submission VARCHAR(50))";


	mysqli_query($dbCon,$sql);
	
	}

?>