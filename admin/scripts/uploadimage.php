<?php
														//script checks if user 
	 session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {				//if not, user is redirected
		header("Location: index.php");					//to login page
		exit();
	}
	
	$username=$_SESSION['username'];
/*
* 	   Simple file Upload system with PHP.
* 	   Created By Tech Stream
* 	   Original Source at http://techstream.org/Web-Development/PHP/Single-File-Upload-With-PHP
*      This program is free software; you can redistribute it and/or modify
*      it under the terms of the GNU General Public License as published by
*      the Free Software Foundation; either version 2 of the License, or
*      (at your option) any later version.
*      
*      This program is distributed in the hope that it will be useful,
*      but WITHOUT ANY WARRANTY; without even the implied warranty of
*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*      GNU General Public License for more details.
*     
*/
	include 'dbCon.php';
		$check=true;
		$file_name = $_FILES['image']['name'];
		$file_size =$_FILES['image']['size'];
		$file_tmp =$_FILES['image']['tmp_name'];
		$file_type=$_FILES['image']['type'];
		
		foreach($ar as $_FILES)
		{
		echo $ar;
		}
		
		if($file_type != 'image/png' &&
			$file_type != 'image/gif' &&
			$file_type != 'image/jpg' &&
			$file_type != 'image/jpeg')     
			
			{
				header("Location: ../wrongformatorsize.php");
			 }
		
		else{
		$title=$_POST['title'];
		
		if($file_size > 1024*1024*3){
				header("Location: wrongformatorsize.php");
		}
		
			else{

			$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");
				while($row = mysqli_fetch_array($result))					
				{
					if((($file_name==$row['name'])&&($row['type']=="image"))||($title==$row['title'])){
						header("Location: ../fileexists.php");
						}
					}
					echo $file_tmp;
	
			move_uploaded_file($file_tmp,"../uploadedmedia/".$file_name);
			$sql="INSERT INTO uploadedmedia (title, name, type)
							VALUES('$title', '$file_name', 'image')";
							mysqli_query($dbCon,$sql);
			//header("Location: ../fileuploaded.php");
	}}
?>