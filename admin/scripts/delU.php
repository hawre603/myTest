<?php
	function delU($id){
	include 'dbCon.php';
	$check=false;
	if($id=='2')// prevent to delete admin user due to security reason
	{
	?> 
  <script type="text/javascript"> 
    alert("You cannot delete Admin user!!"); 
    history.back(); 
  </script> 
<?php 
	exit();
	}
	$result = mysqli_query($dbCon,"SELECT * FROM members");
		while($row = mysqli_fetch_array($result)){
			if($row['id']==$id){			//check if user exists
				$check=true;				
				}
		}
	if ($check==false){							//if username does not exist redirect to warning
			header("Location: nouser.php");
	}
	
	else{
		//if username exists, delete user
		if(mysqli_query($dbCon,"DELETE FROM members WHERE id='$id'")){
			header("Location: ../admin/actioncomplete.php");	
		}
		else{
			header("Location: ../usermanagementerror.php");
		}
		}
		}
  ?>