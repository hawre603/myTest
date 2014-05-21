<?php
	include 'scripts/authentication_script.php';			//script checks if user 
	sec_session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();}
		
	if(!isset($_POST['deletesubmission'])){				//if this page is not navigate to from browse submissions, that means a submission was not chosen
		header("Location: navigationfault.php");			//this condition redirects user when that happens
		}
?>
<!DOCTYPE html>
<html>
   <head>
		<title>Delete Submissions</title>
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
				Delete Submission 		
			</div>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="browseguides.php">Back</a></li>
				<li><<a href="homeExhibit.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
		<div data-role='content' style='text-align:center'>
			
			<div class="DivTwo">
				<div class="DivThree">
			
			
			<?php
				include 'dbCon.php';
				$gTable=$_POST['table'];
				$submission=$_POST['deletesubmission'];

				mysqli_query($dbCon,"DELETE FROM ".$qTable." WHERE submission='".$submission."'");
				$Answer="xmlsubmissions/".$gTable.$submission;
				unlink($Answer);
				mysqli_close($dbCon);
				echo "Record deleted successfully";
					
				?>
			</div>
		</div>
	</div>
</body>
</html>
	