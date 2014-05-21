
/****************************************************************************************
*    Based on on the tutorial:
*	 Title: Social Network Engineering Training Course
*    Date: 2014
*    Availability: https://github.com/IsaacNeal/backburnr

*****************************************************************************************/
<?php
session_start();
include_once("dbCon.php");// connect to dabase 
$user_is_logged = false;
$log_uname = "";
$log_pass = "";
if(isset($_SESSION['username']) && isset($_SESSION['password'])){

	$log_uname = preg_replace('#[^a-z0-9]#i', '', $_SESSION['username']);
	$log_pass = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	$stmt = $dbCon->prepare("SELECT username FROM members WHERE username=:username");
	$stmt->bindValue(':username',$log_uname,PDO::PARAM_STR);
	try{
		$stmt->execute();
		 if($stmt->rowCount() > 0){
			 $user_is_logged = true;
		 }
	}
	catch(PDOException $e){
		return false;
	}
}else if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
	$_SESSION['username'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['username']);
	$_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['password']);
	$log_uname = $_SESSION['username'];
	$log_pass = $_SESSION['password'];
	$stmt = $dbCon->prepare("SELECT username FROM members WHERE username=:log_uname LIMIT 1");
	$stmt->bindValue(':log_uname',$log_uname,PDO::PARAM_INT);
	try{
		$stmt->execute();
		 if($stmt->rowCount > 0){
			 $user_is_logged = true;
		 }
	}
	catch(PDOException $e){
		return false;
	}
}
?>