<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();}
		
	if(!isset($_POST['mediafile'])){				//if this page is not navigate to from browse submissions, that means a submission was not chosen
		header("Location: navigationfault.php");}		//this condition redirects user when that happens
		
				include 'dbCon.php';
				
				$file=$_POST['mediafile'];

				mysqli_query($dbCon,"DELETE FROM uploadedmedia WHERE name='$file'");	//delete file record from database
				$file="../uploadedmedia/".$file;
				unlink($file);															//delete file from web server
				mysqli_close($dbCon);
				
				header("Location: ../actioncompleted.php");	
					
				?>
			