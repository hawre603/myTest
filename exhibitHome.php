
<!DOCTYPE html>
    <head>
        <title>New Walk Museum Guides</title>
        
       <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
         <script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>
		<link rel="stylesheet" type="text/css" href="appStyling.css">
       
        
    </head>
    
    
    <body class='outerDiv'>
    
   
		<div data-role='header' data-position="fixed">
           <a href="index.php" data-icon="home" data-iconpos="notext">Home</a>
         <h1 style="font-family:'MS Serif', 'New York', serif; text-align: center; width:auto" >Exhibition Guides</h1>
		</div>
		
        <div data-role='content'>
			<?php
				include 'scripts/updateIndex.php';
				updateIndex();
			?>			
        </div>
    </body>
</html>
