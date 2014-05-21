<?php
															//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: index.php");							//to login page
	exit();
	}
	
	if (!isset($_POST['guideAdd'])) {					
	header("Location: ../navigationfault.php");							
	exit();
	}
	
	
	
	include 'dbCon.php';
	$guide = $_POST['guideAdd'];
				
	if($guide=="Null"){										//make sure guide is selected
		header("Location: ../noguideselected.php");
		}
	else{
		mysqli_query($dbCon,"UPDATE guides SET active=true
		WHERE name='$guide'");								
			header("Location: ../guideaddedtoapp.php");						//set selected guides active=true
		}
?>