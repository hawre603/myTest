<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();}
		
	if(!isset($_POST['deletesubmission'])){				//if this page is not navigate to from browse submissions, that means a submission was not chosen
		header("Location: navigationfault.php");			//this condition redirects user when that happens
		}
	
	include 'dbCon.php';
	$gTable=$_POST['table'];
	$submission=$_POST['deletesubmission'];

	mysqli_query($dbCon,"DELETE FROM ".$gTable." WHERE submission='".$submission."'");		//delete submission record from database
	$Answer="../xmlsubmissions/".$gTable."/".$submission;
	unlink($Answer);																		//delete submission file from server
	
	If(!(mysqli_query($dbCon,"SELECT FROM ".$gTable." WHERE submission='".$submission."'"))){
		header("Location: ../deletesuccessful.php");}	
																							//check submission success
	else{
		header("Location: deletefailed.php");	
	}
					
	?>
			