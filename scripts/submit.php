<?php
include 'saveAnswers.php';				//script for saving responses
include 'submissionViewer.php';			//script for viewing submission summary
include 'dbCon.php';					//script for database connection
include 'PHPMailer/email1.php';			//PHPMailer library
	$datee= date('H:i d/m/Y');
	
	if((isset($_POST['filename']))&&(isset($_POST['POSTCODE']))&&(isset($_POST['AGE']))){
	$guidename=$_POST['filename'];				//store name of guide
	
	$postcode=$_POST['POSTCODE'];		//store postcode
	$age=$_POST['AGE'];					//store age
	
	if(isset($_POST['EMAIL'])){			//store email if provided
		$email=$_POST['EMAIL'];
		
		$filename=saveSubmission($guidename);			//save submissions as xml and return filename
		if(isset($_POST['saveEmail'])){
		//save filename in database with visitor information
		$sql="INSERT INTO submission (guidename, date, postcode, age, email, submission,guide_type)
		VALUES ('$guidename', '$datee', '$postcode',  '$age', '$email', '$filename','exhibition')";
		$result = mysqli_query($dbCon, $sql);
		}
		
		else{
		$sql="INSERT INTO submission (guide_name, date, postcode, age, submission,guide_type)
		VALUES ('$guidename', '$datee', '$postcode',  '$age', '$filename','exhibition')";
		$result = mysqli_query($dbCon, $sql);}
		//convert submitted xml responses into summary and display
		//return a string containing summary html
		$guideSummary=viewSubmission($filename,$guidename);

		// send submission summary to provided email
		sendEmail($guideSummary, $email);
	}

		else{
			$filename=saveSubmission($guidename);			//save submissions as xml and return filename

			//save filename in database with visitor information
			$sql="INSERT INTO submission (guide_name, date, postcode, age,  submission,guide_type)
		VALUES ('$guidename', '$datee', '$postcode',  '$age', '$filename','exhibition')";
			$result = mysqli_query($dbCon,$sql);
		
			//convert submitted xml responses into summary and display
			//return a string containing summary html
			$guideSummary=viewSubmission($filename,$guidename);}
	}
	print_r($result);
?>