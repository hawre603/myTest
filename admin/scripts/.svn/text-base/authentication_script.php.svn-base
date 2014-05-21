<?php
		session_start();
		//Check if the username and password has been entered is correct or not?!
		function login($username,$password){
		include 'dbCon.php';
		$sql = "SELECT * FROM members where username='".$username."'";
		$result = mysqli_query($dbCon,$sql);
		while($row = mysqli_fetch_array($result))	
		{
			$username = $row['username'];
			$hash = $row['password'];
			$priv=$row['privilage'];
		}
					
		if (password_verify($password, $hash )) {//  decrypt the encrypted password
		// write user data into PHP SESSION and set cookie 
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $hash;
		$_SESSION['privlage']=$priv;
		setcookie("username", $username, strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("password", $hash, strtotime( '+30 days' ), "/", "", "", TRUE); 
		return true;
		exit();
		}
		else
		{
			return false;
			exit();
		}	
}//end of the funtion 
?>