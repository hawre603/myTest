
<!DOCTYPE html>
    <head>
        <title>New Walk Museum Guides</title>
        
       <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
         <script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>
		<link rel="stylesheet" type="text/css" href="appStyling.css">
       
        
    </head>
    
    
    <body class='outerDiv' data-position="fixed">
		<div data-role='header'>
        <a href="index.php" data-icon="home" data-iconpos="notext" data-rel="back">Home</a>
                <h1 style='font-family:'MS Serif', 'New York', serif, Times, serif; text-align: center'>Location Map Guides</h1>
		</div>
		
        <div data-role='content'>
			<?php
				include 'scripts/updateLochome.php';
				updateIndex();
			?>			
        </div>
    </body>
</html>
