<?php
	//include 'scripts/authentication_script.php';			//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();}
	
	if (!isset($_POST['viewguidesubmissions'])) {					//This makes sure user has chosen a guide
		header("Location: ../navigationfault.php");						
		exit();
		}
	
?>
<!DOCTYPE html>
   <head>
		<title>Browse Available Submissions</title>
		 <!--manage web page width to fit device-->
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <!--Include jQuery and jQuery mobile library -->
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/> 
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
        <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script> 

        <!--Include custom CSS style sheets-->
        <link rel='stylesheet' type='text/css' href='../css/cmsStyling.css'/>
		
		<!--Disable ajax on the page-->
		<script type="text/javascript">							
			$(document).bind("mobileinit", function () {				
				$.mobile.ajaxEnabled = false;
					});
		</script>
	</head>
	
		<!-- This page lists all submitted data fro a guide with the respective information of the visitor in a tabular form-->
	<body>
	<div  class='DivOne'>
			<div  class='myHeda'>
				Browse Available Submissions 		
			</div>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="locBrowseguides.php" data-ajax="false">Back</a></li>
				<li><a href="../Home.php" data-ajax="false">Home</a></li>
				<li><a href="../logout.php" data-ajax="false">Logout</a></li>
			</ul>
		</div>
		
		
		<div class="DivTwo">
		
		
		
	<?php
	/*function that takes in a guide name and queries submission and tbl_location table in the database for the
	 particular guide and prints out  a list all*/
			
	function viewAns($gd){
		include '../scripts/dbCon.php';			//script for database connection
	
			$result = mysqli_query($dbCon,"SELECT * FROM tbl_location t,submission s	 WHERE s.guidename = t.loc_name and s.guidename='$gd'"); 		//query table for guide submissionss
			
			
			//print out html table to display data
			echo "<table class='myTable' align='center'>				
				<tr style='background-color:#09F; '>
					<th>Date</th>
					<th>Age</th>
					<th>Postcode</th>
					<th>Email</th>
					<th>View</th>
					<th>Delete</th>
					
					
				</tr>";
			
			
			/*	this loop prints out the submissions available for a particular guide from the database with their
			 respective 
			information and alternates the color of the table rows for better readability */
			$i=1;
			while($row = mysqli_fetch_array($result))
			{
				if (($i % 2) ==0){$color ='#B3D4FD';} 
				else{$color='#FEFFFF';}
				echo "<tr style='background-color:".$color."'>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['age'] . "</td>";
				echo "<td>" . $row['postcode'] . "</td>";
				
				if($row['email']==""){echo "<td> Not Provided </td>";}
				else{echo "<td>" . $row['email'] . "</td>";}
				
				
				/*the form below uses a submit button to pass the filename of a given submission, so that it can be viewed using 
				the 'viewsubmission.php' script */
				echo "<td><form method='POST' target='_blank' data-ajax='false' action='locViewsubmission.php'>";
				echo "<input type='hidden' name='viewSubmission' value='".$row['submission']."'>";
				echo "<input type='hidden' name='guidename' value='".$gd."'>";
				echo "<input type='submit' name='view' value='View Answers'></form></td>";
				
				$yy='"Are you sure you want to perform this action?"';
				
				
				/*the form below uses a submit button to pass the filename of a given submission, so that it can be deleted using 
				the 'deletesubmission.php' script */
				
				echo "<td><form method='POST' data-ajax='false' target='_blank' onsubmit='return confirm(".$yy.");' action='scripts_Locguide/deleteLocsubmission.php'>";
				echo "<input type='hidden' name='table' value='".$gd."'>";
				echo "<input type='hidden' name='deletesubmission' value='".$row['submission']."'>";
				echo "<input type='hidden' name='guidename' value='".$gd."'>";
				echo "<input type='submit' name='delete' value='Delete Answers'></form></td>";
				echo "</tr>";
				$i++;
			}
			echo "</table>";

			mysqli_close($dbCon);

			}
			//echo $_POST['viewguidesubmissions'];
			viewAns($_POST['viewguidesubmissions']);
		?>
		</div>
	</body>
</html>