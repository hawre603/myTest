<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {				//if not, user is redirected
		header("Location: index.php");					//to login page
		exit();
	}
?>

<!DOCTYPE html>
   <head>
		<title>Wrong Format</title>
		
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
   
  
   <body>
		<div  class='DivOne'>
			<div  class='myHeda'>
				Guide Application Management System	
			</div>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="manageguides.php">Back</a></li>
				<li><a href="homeExhibit.php">Home</a></li> 
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
		<div id="loginDiv1">
			<div id="loginDiv2">
				The file you selected is not supported or too large, please choose a valid file.
			</div>
		</div>
        </body>
        </html>