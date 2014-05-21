<?php
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
	$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");
		//		echo $row['name']."  ".$selected;

	
		echo "<select name='Image". $count."'>";		
	while($row = mysqli_fetch_array($result)){
		if($row['type']=="image"){
			
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