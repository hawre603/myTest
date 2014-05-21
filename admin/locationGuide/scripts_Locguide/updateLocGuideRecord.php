<?php
session_start();									//is logged into the system
		if (!isset($_SESSION['username'])) {					//if not, user is redirected
			header("Location: index.php");						//to login page
			exit();
		}
function UpdateLocatioGuide($ID,$guideNameval,$status,$user){
	include '../../scripts/dbCon.php';
	$currentDate= date('Y/m/d');
	$sql = "UPDATE tbl_location SET loc_name = '$guideNameval', guide_status = '$statu', 
			create_date='$currentDate',
			created_by='$user'
			WHERE loc_id='$ID'";
			mysqli_query($dbCon,$sql);									//if user exists, change privilege
}
	
?>