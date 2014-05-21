<?php
session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();	
		}
 function addImg(){
	include 'dbCon.php';	
	//list all image files that can be used as contents in guides
	$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");			
	while($row = mysqli_fetch_array($result)){
		if($row['type']=="image"){
			echo"<option value='".$row['name']."'>".$row['title']." (".$row['type']." file)</option>";	
			}	
		}
	}
//this function is create a deop down list base on the value of the media with selected the media name that was used in the xml documnet
	function selectedImage($selected,$count){
	include 'dbCon.php';
	
	//list all image files that can be used as contents in guides
	$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia where type='image'");
		//		echo $row['name']."  ".$selected;
$selecteTag;
	
	echo $selected."<br>";
		echo "<select name='Image". $count."'>";		
	while($row = mysqli_fetch_array($result)){
		
			
			$selecteTag = $selecteTag."<option value='".$row['name']."'";
			if($row['name']==$selected.'.jpg'){
				$selecteTag=$selecteTag." selected";
			}
			$selecteTag=$selecteTag.">".$row['title']." (".$row['type']." file)</option>";	
			echo $selecteTag;
			$selecteTag='';
			
				
		}
		echo "</select>";
		echo $selecteTag;
	}
	
	
	function selectedXmlImagr($selected){
	include 'dbCon.php';
	
	//list all image files that can be used as contents in guides
	$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia where type='image'");

	
	echo $selected."<br>";
		echo "<select name='".$selected."'>";		
	while($row = mysqli_fetch_array($result)){
		
			
			$selecteTag = $selecteTag."<option value='".$row['name']."'";
			if($row['name']==$selected.'.jpg'){
				$selecteTag=$selecteTag." selected";
			}
			$selecteTag=$selecteTag.">".$row['title']." (".$row['type']." file)</option>";	
			echo $selecteTag;
			$selecteTag='';
			
				
		}
		echo "</select>";
		echo $selecteTag;
	}
	
	
?>