<?php
	function addGuide($usr, $title, $name){
	include 'dbCon.php';
	
	$dt= date('Y/m/d');										//records date


//set guide active=true	
	$sql="INSERT INTO `guides`(`by`, `title`, `name`, `date`, `active`) VALUES ('$usr','$title','$name', '$dt', true)";
			//add guide name into guides table, with title, date, creator and active set to true
	
	
	mysqli_query($dbCon,$sql);					//execute addition
	}
?>