<?php
	 session_start(); 									//script checks if user 
															//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();
	}
		
?>
		<!DOCTYPE html>
		   <head>
            <title>QR code generator</title>
             <!--manage web page width to fit device-->
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            
            <!--Include jQuery and jQuery mobile library -->
            
            <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
            <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/> 
            <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
            <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script> 
            <!--Include custom CSS style sheets-->
            <link rel='stylesheet' type='text/css' href='../css/cmsStyling.css'/>
                    <link rel="stylesheet" type="text/css" href="../css/menuStyle.css">

            
        </head>
			
			<body>
				<div  class='DivOne'>
					<div class='myHeda'>
						QR Generator 
					</div>
				</div>
             
				<div data-role="navbar">
				<ul>
               		 <li><a href="homeQR.php">Back</a></li>
					<li><a href="../Home.php">Home</a></li>
                    <li><a href="../logout.php">Logout</a></li>
				</ul>
			</div>
                
				<div data-role="content">
					<div class='DivTwo'>
                    <div class='DivThree'>
                <?php
				include '../scripts/dbCon.php';		//script that opens connection to database

				/*Check connection*/
				if (mysqli_connect_errno())
				{
					die("Failed to connect to MySQL");
				}
  
				$result = mysqli_query($dbCon,"SELECT g.* FROM guides g WHERE g.active=1");
//#BBAE3C;
				echo "<table class='myTable ' align='center'>
						<tr style='background-color:#09F;'>
						<th>Guide</th>
						<th>By</th>						
						<th>Date</th>
						<th>QR generator</th>
						</tr>";
				
				
				/*	this loop prints out the guides available on the database with their respective information
					and alternates the color of the table rows for better readability */
				$i=1;
				while($row = mysqli_fetch_array($result))					
				{																
					if (($i % 2) ==0){$color ='#B3D4FD';}//'#EBE5C5';} 
					else{$color='#FEFFFF';}
  
  
					echo "<tr style='background-color:".$color."'>";
					echo "<td><a href='../../".$row['name'].".html' target='_blank'>".$row['title']."</a></td>";
					echo "<td>" . $row['by'] . "</td>";
					echo "<td>" . $row['date'] . "</td>";
					/*the form below uses a submit button to pass the name of a given guide, in order to generate
					for each of them*/
					
					echo "<td><form method='POST' action='qrgenerateProcess.php' data-ajax='false' >";
					echo "<input type='hidden' name='guideTitle' value='".$row['title']."'>";
					echo "<input type='hidden' name='guideFileName' value='".$row['name']."'>";
					echo "<input type='submit' value='Generate QR Code'></form></td>";
					echo "</tr>";
					$i++;
				}
				echo "</table>";

			mysqli_close($dbCon);

		?>
        </div>
    </div>
    </div>
    </div>
    </body>
</html>
	
		
	