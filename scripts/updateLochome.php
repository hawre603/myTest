<?php

function updateIndex(){

	//include script that connects to database
	include 'dbCon.php';

	//get all guides stored in the guides table
	$result = mysqli_query($dbCon,"SELECT * FROM tbl_location") or die("Error: ".mysqli_errno);

	//if guide is active, print out a link to the guide
	while($row = mysqli_fetch_array($result))
	{
		$title=str_replace('_',' ',$row['loc_name']);
		if($row['guide_status']==true){
		echo "<ul data-role='listview' data-inset='true'>";
		echo "<li> <a href='locGuides/".$row['loc_name'].".html' rel='external' >".$title."</a></li>";
		echo "</ul>"; }
	}
}

?>