<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();	
		}
	
	
?>

<!DOCTYPE html>
   <head>
		<title>Browse Available Guides</title>
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
	
	<!--this page gets a a list of all the guides stored in the database, with information including date created, 
	the user that created the guide, title of the guide, and a link to the submissions made for the guide all provided
	in a tabular form-->

	
	<body>
		<div  class='DivOne'>
			<div  class='myHeda'>
				Browse Available Guides 		
			</div>
		</div>
		<div data-role="navbar">
			     <ul>
               		 <li><a href="homeLocation.php" data-ajax="false">Back</a></li>
					<li><a href="../Home.php" data-ajax="false">Home</a></li>
					<li><a href="../logout.php" data-ajax="false">Logout</a></li>
				</ul>
		</div>

		<div data-role='content' style='text-align:center'>
			<div class='DivTwo'>
			
			
				<!--php function that will query database and return the result in a structured html table-->
				
				
				<?php
				include '../scripts/dbCon.php';		//script that opens connection to database

				/*Check connection*/
				if (mysqli_connect_errno())
				{
					die("Failed to connect to MySQL");
				}
  
				$result = mysqli_query($dbCon,"SELECT * FROM tbl_location");

				echo "<table class='myTable ' align='center'>
						<tr style='background-color:#09F;'>
						<th>Location Guide</th>
						<th>By</th>						
						<th>Date</th>
						<th>Submissions</th>
						</tr>";
				
				
				/*	this loop prints out the guides available on the database with their respective information
					and alternates the color of the table rows for better readability */
				$i=1;
				while($row = mysqli_fetch_array($result))					
				{																
				
  
  
					if (($i % 2) ==0){$color ='#B3D4FD';}//'#EBE5C5';} 
					else{$color='#FEFFFF';}
					echo "<tr style='background-color:".$color."'>";
					echo "<td><a href='../../locGuides/".$row['loc_name'].".html' target='_blank'>".$row['loc_name']."
					</a>
					</td>";
					echo "<td>" . $row['created_by'] . "</td>";
					echo "<td>" . $row['create_date'] . "</td>";
					
					/*the form below uses a submit button to pass the name of a given guide, so that a list of its
					submissions can be viewed using the 'browsesubmissions.php' script */
					
					echo "<td><form method='POST' action='locBrowsesubm.php' data-ajax='false' >";
					echo "<input type='hidden' name='viewguidesubmissions' value='".$row['loc_name']."'>";
					echo "<input type='submit' value='View'></form></td>";
					echo "</tr>";
					$i++;
				}
				echo "</table>";

			mysqli_close($dbCon);

		?>
        
        
	</div>
	</div>
	</body>
</html>