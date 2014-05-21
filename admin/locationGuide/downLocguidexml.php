<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
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
		<title>Download Location Guide xml file</title>
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
					//this functoin used to make confromation to delete user before the action			
            function deletechecked()
            {
                var answer = confirm("Are you sure you want to delete this user?!")
                if (answer){
                    document.messages.submit();
                }
                
                return false;  
            } 
		</script>
	</head>
	
	<body>
		<div  class='DivOne'>
			<div  class='myHeda'>
				 Downlaod location guide XML file		
			</div>
		</div>
              
		<div data-role="navbar">
			<ul>
			  <li><a href="homeLocation.php">Back</a></li>
				<li><a href="../Home.php">Home</a></li>
				<li><a href="../logout.php" data-ajax="false">Logout</a></li>
			</ul>
		</div>

		<div data-role='content' style='text-align:center;'>
			<div class='DivTwo'>				
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
						<th>Guide</th>
						<th>By</th>						
						<th>Date</th>
						<th>Dwonlaod</th>
						</tr>";
				/*	this loop prints out the location guides available on the database with their respective 
				information and alternates the color of the table rows for better readability */
				$i=1;
				while($row = mysqli_fetch_array($result))					
				{																
				if (($i % 2) ==0){$color ='#B3D4FD';}//'#EBE5C5';} 
				else{$color='#FEFFFF';}
				echo "<tr style='background-color:".$color."'>";
				echo "<td><a href='../../locGuides/".$row['loc_name'].".html' target='_blank'>".$row['loc_name']."</a>
				</td>";
				echo "<td>" . $row['created_by'] . "</td>";
				echo "<td>" . $row['create_date'] . "</td>";
				/*the form below uses a submit button to pass the name of a given guide, so that a the contenr
				 of the xml file can be viewed and then edit the content of the xml file 
				 using the 'scripts/editguideProcess.php' script */
				echo "<td><form method='POST' action='scripts_Locguide/xmlfileDownload.php' data-ajax='false' >";
				echo "<input type='hidden' name='donwloadSeleGuide' value='".$row['loc_name']."'>";
				echo "<input type='submit' value='download'></form></td>";
				
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