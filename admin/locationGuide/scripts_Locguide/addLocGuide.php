<?php
session_start();									          //is logged into the system
		if (!isset($_SESSION['username'])) {					//if not, user is redirected
			header("Location: index.php");						//to login page
			exit();
		}
function addGuide($guideNameval,$status,$user){
	include '../../scripts/dbCon.php';
	
	
	$currentDate= date('Y/m/d');		//records date


	//	Loc_id will be incremnted automatically, it is seted in the DB
		$sql="INSERT INTO tbl_location (loc_id,loc_name,guide_status,create_date,created_by) VALUES (NULL,'$guideNameval','$status','$currentDate','$user')";
			
	
	mysqli_query($dbCon,$sql);		//execute addition
	}
	
?>