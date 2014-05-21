<?php
        include 'dbCon.php';
		$priv=false;
		$check=false;
		$id=$_POST["userId"];
		$pr=$_POST["priv"];
		if($pr=="Administrator"){						//get privilege
			$priv=true;}
		
		$result = mysqli_query($dbCon,"SELECT * FROM members");
		while($row = mysqli_fetch_array($result)){					//check if user exists
			if($row['id']==$id){
				$check=true;				
			}
		}
		
		if($check==false){										//if user does not exist, redirect to warning
			header("Location: nouser.php");}
			
		
		else{
			$sql = "UPDATE members SET name = '".$_POST["name"]."', username = '".$_POST["usrName"]."', 
			privilage='$priv'
			WHERE id='$id'";
			mysqli_query($dbCon,$sql);									//if user exists, change privilege
			header("Location: ../actioncomplete.php");
		}

?>