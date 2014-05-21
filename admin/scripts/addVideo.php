<?php

session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();	
		}
		
 function addVid(){
	include 'dbCon.php';
	
	//print available videos that can be used as content in guides
	$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");			
	while($row = mysqli_fetch_array($result)){
		if($row['type']=="video"){
			echo"<option value='".$row['name']."'>".$row['title']." (".$row['type']." file)</option>";	
			}	
		}
	}
	//this function is create a deop down list base on the name of the media with selected the media name that was used in the xml documnet
	function selectedVideo($selected,$count){
	include 'dbCon.php';
	
	//list all image files that can be used as contents in guides
	$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");
		//		echo $row['name']."  ".$selected;

	
		echo "<select name='Image". $count."'>";		
	while($row = mysqli_fetch_array($result)){
		if($row['type']=="video"){
			
			$selecteTag = $selecteTag."<option value='".$row['name']."'";
			echo $row['name']."  ".$selected;
			if($selected==$row['name']){
				$selecteTag=$selecteTag." selected";
			}
			$selecteTag=$selecteTag.">".$row['title']." (".$row['type']." file)</option>";	
			echo $selecteTag;
			$selecteTag='';
			}
				
		}
		echo "</select>";
		
	}
?>