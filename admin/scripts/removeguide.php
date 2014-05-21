<?php
															//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: index.php");							//to login page
	exit();
	}
	
	if (!isset($_POST['guideRem'])) {					
	header("Location: ../navigationfault.php");							
	exit();
	}
	
	
	
	include 'dbCon.php';
	$guide = $_POST['guideRem'];
				
	if($guide=="Null"){									//if no guide is chosen, redirect to error
		header("Location: ../noguideselected.php");
		}
	else{
		mysqli_query($dbCon,"UPDATE guides SET active=false
		WHERE name='$guide'");							//if guide is chosen update active to false
			header("Location: ../guideremoved.php");
		}
?>