<?php
include 'dbCon.php';
/*include_once("scripts/check_user.php"); 
if($user_is_logged == true){
	header("location: index.php");
	exit();
}*/


//echo'$username,$password '.$hmac; last copy of my work
			
				//$sql
			/*$stmt = $dbCon->prepare("SELECT username,password FROM members WHERE username=:username LIMIT 1");
			echo"---it read the memeber table<br>";
			$stmt->bindValue(':username',$username,PDO::PARAM_STR);
					echo"---it read the memeber table<br>";
		
			try{
				$stmt->execute();
				$count=$stmt->rowCount;
				echo"---it read the memeber table<br>".$count;
				 if($count > 0)
				 {
					$username = $row['username'];
					$hash = $row['password'];
				 }
				 else
				 {
					 echo'Info not found';
				 }
			}
			catch(PDOException $e){
				echo 'Message: '.$e->getMessage();
				return false;
			}*/



if(isset($_POST['usr']) && trim($_POST['usr']) != ""){
	$username = strip_tags($_POST['usr']);
	$password = $_POST['pwd'];

	$hmac = hash_hmac('sha512', $password, file_get_contents('../icons/MyKey.txt'));
	
	//$result = mysqli_query($dbCon,"SELECT username,password FROM members where username='test'");
	echo"---hiii<br>";
	$stmt = $dbCon->prepare("SELECT username FROM members WHERE username=:username LIMIT 1");
	$stmt->bindValue(':username',$username,PDO::PARAM_STR);
	echo"---thi auth<br>";
	try{
		$stmt->execute();
		echo"---".$stmt->rowCount."<br>";
		 if($stmt->rowCount > 0){
			$username = $row['username'];
		    $hash = $row['password'];
		 }
	}
	catch(PDOException $e){
		echo $e->getMessage();
		return false;
	}
			echo"__".crypt($hmac, $hash)."===<br>".$hash;
		if (crypt($hmac, $hash) === $hash) {
				
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $hash;
				setcookie("username", $username, strtotime( '+30 days' ), "/", "", "", TRUE);
    			setcookie("password", $hash, strtotime( '+30 days' ), "/", "", "", TRUE); 
				 /*echo 'Valid password<br />'.$_SESSION['username'].'<br />'.$_SESSION['password'].' check correct one :)
				<br />';*/
				//require_once('../homeExhibit.php');
				header("location: home.php");
				exit();
			} else {
				
	echo 'Invalid password Press back and try again<br />';
	//include_path='.:/loginerror.php';
	header('Location: /loginerror.php');		 	//redirects to error page if login failes
				
				exit();
			}
		}
		else{
			echo "this username does not exist here";
			header('Location: /loginerror.php');			 	//redirects to error page if login failes
			$dbCon = null;
			exit();
		}







/***************************************************************************************
*    Based on on the tutorial:
*	 Title: How to Create a Secure Login Script in PHP and MySQL
*    Date: 2013
*    Availability: http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
**************************************************************************************

function login($usrd, $password, $dbCon) {
	$check=false;
	$result = mysqli_query($dbCon,"SELECT * FROM members");
	while($row = mysqli_fetch_array($result))	
	{
		if(($usrd==$row['username'])||($password==$row['password'])){
		$check=true;
			}
	}
	return $check;

	if($check==true){
		$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
		$user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
		$_SESSION['user_id'] = $user_id; 
		$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $usrd); // XSS protection as we might print this value
		$_SESSION['username'] = $username;
		$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
		// Login successful.
		return $check;
		}
		
	else{
		// Login unsuccessful.
		return $check;
	}

  }



/*ob_start();
session_start();
 
$username = $_POST['usr'];
$password = $_POST['pwd'];
 
$conn = mysql_connect('localhost', 'root', 'hkaa1');
mysql_select_db('musuemdata ', $conn);
 
$username = mysql_real_escape_string($username);
$query = "SELECT username, password
        FROM member
        WHERE username = '$username';";
 
$result = mysql_query($query);
 
if(mysql_num_rows($result) == 0) // User not found. So, redirect to login_form again.
{
    header('Location: login.html');
}
 
$userData = mysql_fetch_array($result, MYSQL_ASSOC);
$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
 
if($hash != $userData['password']) // Incorrect password. So, redirect to login_form again.
{
    header('Location: ../home.php');
}else{ // Redirect to home page after successful login.
	session_regenerate_id();
	$_SESSION['sess_user_id'] = $userData['id'];
	$_SESSION['sess_username'] = $userData['username'];
	session_write_close();
	header('Location: ../home.php');
}



function sec_session_start() {
	$session_name = 'sec_session_id'; // Set a custom session name
	$secure = false; // Set to true if using https.
	$httponly = true; // This stops javascript being able to access the session id. 

	ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
	$cookieParams = session_get_cookie_params(); // Gets current cookies params.
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
	session_name($session_name); // Sets the session name to the one set above.
	session_start(); // Start the php session
	session_regenerate_id(); // regenerated the session, delete the old one.  
}


function login($usrd, $password, $dbCon) {
	$check=false;
	$result = mysqli_query($dbCon,"SELECT * FROM members");
	while($row = mysqli_fetch_array($result))	
	{
		if(($usrd==$row['username'])||($password==$row['password'])){
		$check=true;
			}
	}
	return $check;

	if($check==true){
		$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
		$user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
		$_SESSION['user_id'] = $user_id; 
		$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $usrd); // XSS protection as we might print this value
		$_SESSION['username'] = $username;
		$_SESSION['login_string'] = hash('sha512', $password.$user_browser);
		// Login successful.
		return $check;
		} 
		
	else{
		// Login unsuccessful.
		return $check;
	}

  }
  
  function login_check($dbCon) {
	// Check if all session variables are set
	if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
		$user_id = $_SESSION['user_id'];
		$login_string = $_SESSION['login_string'];
		$username = $_SESSION['username'];

		$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

		if ($stmt = $dbCon->prepare("SELECT password FROM members WHERE id = ? ")) { 
			$stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
			$stmt->execute(); // Execute the prepared query.
			$stmt->store_result();

			if($stmt->num_rows == 1) { // If the user exists
				$stmt->bind_result($password); // get variables from result.
				$stmt->fetch();
				$login_check = hash('sha512', $password.$user_browser);
				
				if($login_check == $login_string) {
					// Logged In!!!!
					return true;
				} 
				
				else {
					// Not logged in
					return false;
				}
			} 
			
			else {
				// Not logged in
				return false;
			}
		}
		
		else {
			// Not logged in
			return false;
		}
	} 
	
	else {
		// Not logged in
		return false;
	}
}*/
?>