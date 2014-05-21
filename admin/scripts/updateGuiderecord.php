<?php
									       //script checks if user 
		session_start();					 //is logged into the system
		if (!isset($_SESSION['username'])) { //if not, user is redirected
		header("Location: ../index.php");    //to login page
		exit();
		}
//update guide  record in database
function updGuide($usr, $title, $name){
	include 'dbCon.php';
	
	$dt= date('Y/m/d');										//records date
	
	
	$sql = "UPDATE guides SET created_by = '$usr', title = '$title', date='$dt' WHERE name='$name'";
			
			mysqli_query($dbCon,$sql);
	}
?>