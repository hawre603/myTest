<?php
	session_start();														//script checks if user 
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
?>

<!DOCTYPE html>
   <head>
		<title>How To Create Guides</title>
		
		<!--manage web page width to fit device-->
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <!--Include jQuery and jQuery mobile library -->
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/> 
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
        <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script> 

        <!--Include custom CSS style sheets-->
        <link rel='stylesheet' type='text/css' href='css/cmsStyling.css'/>
		
		
	</head>
   
  
   <body>
		<div  class='DivOne'>
			<div  class='myHeda'>
				How To Create New Guides
			</div>
		</div>
		<div data-role="navbar">
			<ul>
				<li><a href="createguides.php">Back</a></li>
				<li><a href="homeExhibit.php">Home</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		
		<div id="loginDiv1">
			<div id="loginDiv2">
				<h3>Step 1</h3>
				<p>
				Start by adding a page to the guide to be created using any of the two  "Add Page" buttons
				</p>
				<h3>Step 2</h3>
				<p>
				Add the required contents using the add content buttons at the right hand side of the added page
				</p>
				<h3>Step 3</h3>
				<p>
				Specify text, contents and media as required in the page
				</p>
				<h3>Step 4</h3>
				<p>
				Add and delete content and pages to fit guide specification
				</p>
				<h3>Step 5</h3>
				<p>
				Declare guide title
				</p>
				<h3>Step 6</h3>
				<p>
				Click "Create" button
				</p>	
				<h3>Note</h3>
				<p>
				A guide must have at least 2 pages.
				</p>
				<p>
				Guide pages  with no content should be deleted before creating guide.
				</p>
			</div>
		</div>
	</body>
</html>