<?php

	function changePwd($usr,$pwd){
	include 'validate.php';						//script for validating text
	include 'dbCon.php';						//script for database connection

	$valusr=validate($usr);						//validate username
	$valpwd=validate($pwd);						//validate password

	if(($valusr!=$usr)||($valpwd!=$pwd)){
		header("Location: validationerror.php");			//if username or password was changed during validation provide error and abort
	}

	else{
		$bcrypt = password_hash($valpwd, PASSWORD_DEFAULT);
		
		$sql= "UPDATE members 
		SET password='$bcrypt' 								
		WHERE username='$valusr'";//else change password
		
		$result = mysqli_query($dbCon,$sql);
		
		
		//check wether the password has changed or not.
		if($result){
			header("Location: ../usermanagementsuccess.php");		
			}																		
		else{
			header("Location: ../usermanagementerror.php");
			}
		}
	}
?>