<?php
													//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
	$us=$_POST["usr"];
	$pw=$_POST["pwd"];
	$nm=$_POST["name"];
	$pv=$_POST["priv"];
	
try{
	include 'dbCon.php';
	$priv=false;
		$check=false;
		if($pv=="Administrator"){				//get privilage
			$priv=1;
			}
			else
			{
			$priv=0;
			}
	
		 // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
         // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5
		 
         $bcrypt = password_hash($pw, PASSWORD_DEFAULT);
		 $result = mysqli_query($dbCon,"SELECT * FROM members");
		while($row = mysqli_fetch_array($result)){
			if($row['username']==$us){
				$check=true;					//check if username exists
				
				}
		}
		
		if ($check==true){						//if username exists do not add user
			header("Location: ../userexists.php");}
		else{
  		 $sql="INSERT INTO members (username, password, privilage, name)
					VALUES('$us', '$bcrypt', '$priv', '$nm')";
					mysqli_query($dbCon,$sql);
	          header("Location: actioncomplete.php");	
       }
}
     catch(PDOException $e){
		echo $e->getMessage();
			$dbCon = null;
			header("Location: ../usermanagementerror.php");
			exit();
	}

?>