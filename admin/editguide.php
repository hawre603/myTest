<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();	
		}
		if($_SESSION['privlage']!=1){
			echo "<script type='text/javascript'> 
    				alert('permission denied!!'); 
  					history.back(); </script> ";
					
					exit();
		}
	
	
?>

<!DOCTYPE html>
   <head>
		<title>Edit a Guide Page</title>
		 <!--manage web page width to fit device-->
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <!--Include jQuery and jQuery mobile library -->
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/> 
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
        <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script> 


        <!--Include custom CSS style sheets-->
        <link rel='stylesheet' type='text/css' href='css/cmsStyling.css'/>
		
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
				 Select Guide to Edit		
			</div>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="homeExhibit.php">Back</a></li>
				<li><a href="homeExhibit.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>

			<div class='DivTwo'>
			
			
				<!--php function that will query database and return the result in a structured html table-->
				
				
				<?php
				include 'scripts/dbCon.php';		//script that opens connection to database

				/*Check connection*/
				if (mysqli_connect_errno())
				{
					die("Failed to connect to MySQL");
				}
				$result = mysqli_query($dbCon,"SELECT * FROM guides");
//#BBAE3C;
				echo "<table class='myTable ' align='center'>
						<tr style='background-color:#09F;'>
						<th>Guide</th>
						<th>By</th>						
						<th>Date</th>
						<th>Edit</th>
						</tr>";
				/*	this loop prints out the guides available on the database with their respective information
					and alternates the color of the table rows for better readability */
				$i=1;
				while($row = mysqli_fetch_array($result))					
				{																
					if (($i % 2) ==0){$color ='#B3D4FD';}//'#EBE5C5';} 
					else{$color='#FEFFFF';}
					echo "<tr style='background-color:".$color."'>";
					echo "<td><a href='../".$row['name'].".html' target='_blank'>".$row['title']."</a></td>";
					echo "<td>" . $row['created_by'] . "</td>";
					echo "<td>" . $row['date'] . "</td>";
					/*the form below uses a submit button to pass the name of a given guide, so that a the contenr
					 of the xml file can be viewed using the 'scripts/editguideProcess.php' script */
					echo "<td><form method='POST' action='scripts/editguideProcess.php' data-ajax='false' >";
					echo "<input type='hidden' name='editSelectedGuide' value='".$row['name']."'>";
					echo "<input type='submit' value='Edit'></form></td>";
					echo "</tr>";
					$i++;
				}
				echo "</table>";
				mysqli_close($dbCon);

		?>
	</div>
	</body>
</html>