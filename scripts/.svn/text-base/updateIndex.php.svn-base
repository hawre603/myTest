<?php

function updateIndex(){

	//include script that connects to database
	include 'dbCon.php';

	//get all guides stored in the guides table
	$result = mysqli_query($dbCon,"SELECT * FROM guides") or die("Error: ".mysqli_errno);

	//if guide is active, print out a link to the guide
	while($row = mysqli_fetch_array($result))
	{
		
		if($row['active']==true){
		echo "<ul data-role='listview' data-inset='true'>";
		echo "<li> <a href='".$row['name'].".html' rel='external' >".$row['title']."</a></li>";
		echo "</ul>"; }
	}
}

?>