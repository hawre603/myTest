<?php
		session_start();
		//check if the user has loged in successfuly 
		if(!isset($_SESSION['username']))
		{
			header('locaiotn: index.php');
			exit(); // exit in the current page.
		}

?>

<!DOCTYPE html>
   <head>
		<title>Guide Application Management System</title>
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
                <li><a href="homeExhibit.php" data-ajax="false">Exhibition Guides</a></li>
                <li><a href="locationGuide/homeLocation.php" data-ajax="false">Location Guides</a></li>
				<li><a href="QRcode/homeQR.php"data-ajax="false">QR COde</a></li>
                <li><a href="adminmanagement.php" data-ajax="false">User Managment</a></li>
				<li><a href="logout.php" data-ajax="false">Logout</a></li>
			</ul>
		</div>
  
       <div data-role="content">
			<div class='DivTwo'>
				<div class='DivThree'>
                <ul  class='mylists' data-role='listview' data-inset='true'>
                <li><a href="homeExhibit.php" data-ajax="false"><img src="icons/museum_icon.jpg" alt='thumbnail'/>
                Exhibition Guides</a></li>
                </ul>
                <ul data-role='listview' data-inset='true'>
                    <li> <a href="locationGuide/homeLocation.php" data-ajax="false"><img src="icons/map_icon.png" alt='Location'/>Location Map Guides</a></li>
                </ul>
                <ul data-role='listview' data-inset='true'>
                <li> <a href="QRcode/homeQR.php"data-ajax="false"><img src="icons/qr_icon.png" alt='thumbnail'/>QR Code Generator</a></li>
                </ul>
                <ul data-role='listview' data-inset='true'>
                <li> <a href="adminmanagement.php" data-ajax="false"><img src="icons/user-management.png" alt='thumbnail'/>User Managment</a></li>
                </ul>
            </div>
        </div>
    </div>
   </body>
</html>