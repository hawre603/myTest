<?php
															//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: index.php");							//to login page
	exit();
	}
	
	if (!isset($_POST['guideDel'])) {					
	header("Location: ../navigationfault.php");							
	exit();
	}
	
	
	
	include 'dbCon.php';
	$guide = $_POST['guideDel'];
				
	if($guide=="Null"){
		header("Location: ../noguideselected.php");
		}
	else{
		mysqli_query($dbCon,"DELETE FROM guides WHERE name='$guide'");				//delete guide from guides table
		mysqli_query($dbCon,"DROP TABLE $guide");									//drop guide table for submissions
		unlink("../../".$guide.".html");											//delete guide html file
		unlink("../xmlpages/".$guide);												//delete guide xml page record
		rmdir("../xmlsubmissions/".$guide);											//delete guide submissions folder
		header("Location: ../guidedeleted.php");
		}
?>