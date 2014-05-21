<?php
													//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
	function editpwd($us, $pwd){
		include 'dbCon.php';

		$check=false;
		         $bcrypt = password_hash($pwd, PASSWORD_DEFAULT);

		$result = mysqli_query($dbCon,"SELECT * FROM members");
		while($row = mysqli_fetch_array($result)){
			if($row['username']==$us){						//check if user exists
				$check=true;				
				}
		}
		
		if($check==false){
			header("Location: nouser.php");				//if user does not exist, redirect to warning
			}
			else{
			mysqli_query($dbCon,"UPDATE members SET name='',username='', privilage=''   password='$bcrypt'
			WHERE username='$us'");							//if user exists, update password
			header("Location: actioncomplete.php");
		}
	}
?>