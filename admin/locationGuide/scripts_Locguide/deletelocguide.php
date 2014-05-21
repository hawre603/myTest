<?php
	include '../../scripts/dbCon.php';
	
	  														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: ../../index.php");							//to login page
	exit();
	}
	
	$guide = $_POST['guideDel'];
				
	if($guide=="Null"){
		header("Location: ../noguideselected.php");
		}
	else{
		mysqli_query($dbCon,"DELETE FROM tbl_location WHERE loc_name='$guide'");	//delete guide from tbl_location
		mysqli_query($dbCon,"DELETE FROM submission WHERE guidename='$guide'");	  //delete guide table for submissions
		unlink("../../../locGuides/".$guide.".html");							  //delete guide html file
		unlink("../../xmlpages/LocationGuideXML/".$guide.".xml");	              //delete guide xml page record
		rmdir("../../xmlsubmissions/".$guide);									  //delete guide submissions folder
		header("Location: ../../guidedeleted.php");
		}
?>