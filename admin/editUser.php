<?php
			 											//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: index.php");							//to login page
	exit();
	}
?>


<!DOCTYPE html>
		   <head>
            <title>Edit User Detail</title>
             <!--manage web page width to fit device-->
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            
            <!--Include jQuery and jQuery mobile library -->
            
            
          <!--  <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
            <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/> 
			<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
            <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script>-->
            
            <link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />
			<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
            <script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>
            
            
            
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
					<div class='myHeda'>
						Manage Guides 
					</div>
				</div>
				<div data-role="navbar">
					<ul>
						<li><a href="homeExhibit.php" rel="external" data-rel="back">Back</a></li>
						<li><a href="homeExhibit.php" rel="external">Home</a></li>
						<li><a href="logout.php" rel="external">Logout</a></li>
					</ul>
				</div>
			<div data-role="content">
			<div class='DivTwo'>
				<div class='DivThree'>
                    
                  <?php
				include 'scripts/dbCon.php';		//script that opens connection to database
				/*Check connection*/
				if (mysqli_connect_errno())
				{
					die("Failed to connect to MySQL");
				}
				//dispay data for users.
				echo "<form method='POST' action='scripts/editUserDetail.php' data-ajax='false' >";
				echo "<label  for='Id'> User ID:".$_POST['usrId']." </label>";
				echo"<input name='userId' type='hidden' value='".$_POST['usrId']."'>";
				echo"<br>";
				echo"<label  for='name'> Name: </label>";
				echo"<input type='text' name='name' value='".$_POST['Name']."' required>";
				echo"<label  for='usr'> Username: </label>";
				echo"<input type='text' name='usrName' maxlength='20' value='".$_POST['usrName']."' required>";
				//Check the privilage of the user to select the right privilage.
				if($_POST['priv']==0)
				{	
					$str='selected';
				}else
				{
					$str1='selected';
				}
				echo"<label for='priv'>Privilage: </label>";
				echo"<select name='priv'>";
			    echo"<option value='Manager' ".$str.">Manager</option>";
			    echo"<option value='Administrator' ".$str1.">Administrator</option>";
			    echo"</select>";
				
			   echo"<input type='submit' value='Edit'></form>";
				
		       mysqli_close($dbCon);

		    	?>
        </div>
        </div>
        </div>
    </body>
</html>