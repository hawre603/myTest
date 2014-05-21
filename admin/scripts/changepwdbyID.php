<?php

	include 'validate.php';						//script for validating text
	include 'dbCon.php';						//script for database connection
    $pwd=$_POST['password'];
	$usrId=validate($_POST['userId']);			//validate user ID
	$valpwd=validate($pwd);						//validate password
	if($valpwd!=$pwd){
		header("Location: validationerror.php");	//if password was changed during validation provide error and abort
	}

	else{
		// encrypt password before updated in the database then update the encrypted password in the database
		 $bcrypt = password_hash($valpwd, PASSWORD_DEFAULT);
		 //updare sql statment for change password
		$sql="UPDATE members SET password='$bcrypt' WHERE id='$usrId'";
		
		$result = mysqli_query($dbCon, $sql);
		
		if($result){
			header("Location: ../usermanagementsuccess.php");		
			}																		
		else{
			header("Location: ../usermanagementerror.php");
			}
		}
	?>