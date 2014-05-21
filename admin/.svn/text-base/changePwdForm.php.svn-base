<?php
			 											//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: index.php");							//to login page
	exit();
	}
?>

<!DOCTYPE html><head>
            <title>Edit User Detail</title>
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
						
			/*this code is based on   http://www.tutscorner.com/javascript-tutorial-password-validation-check-length-and-confirm-password/
			accessed on 1-April-2014	*/	
							
			function val(){
			if(frm.password.value == "")
			{
				alert("Enter the Password.");
				frm.password.focus(); 
				return false;
			}
			if((frm.password.value).length < 4)
			{
				alert("Password should be minimum 4 characters.");
				frm.password.focus();
				return false;
			}
			
			if(frm.confirmpassword.value == "")
			{
				alert("Enter the Confirmation Password.");
				return false;
			}
			if(frm.confirmpassword.value != frm.password.value)
			{
				alert("Password confirmation does not match.");
				return false;
			}
			
			return true;
}
				
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
						<li><a href="homeExhibit.php">Back</a></li>
						<li><a href="homeExhibit.php">Home</a></li>
						<li><a href="scripts/logout.php">Logout</a></li>
					</ul>
				</div>
				
				<div data-role="content">
			<br>
			<br>
			<div class='DivTwo'>
				<div class='DivThree'>
					<div data-role="content">
                    
                    	<?php
				include 'scripts/scripts/dbCon.php';		//script that opens connection to database

				/*Check connection*/
				if (mysqli_connect_errno())
				{
					die("Failed to connect to MySQL");
				}
				//dispay data for users.
				echo "<form method='POST' name='frm' action='scripts/changepwdbyID.php' data-ajax='false' >";
				echo "<label  for='Id'> User ID:  <b>".$_POST['usrId']."</b> </label>";
				echo"<input  type='hidden' name='userId' value='".$_POST['usrId']."'>";
				echo"<br>";
				echo"<label  for='name'> Name: <b>".$_POST['Name']."</b></label><br>"; 
				echo"<label  for='password'> Enter Password: </label><br>";
				echo"<input type='password' name='password' maxlength='20' required>";
				echo"<label  for='confirmpassword'> Confirm Password: </label><br>";
				echo"<input type='password' name='confirmpassword' maxlength='20' required>";
				
			    echo"<input type='submit' value='Edit' onClick='return val();'></form>";
				
			mysqli_close($dbCon);

		?>
		</div>
        </div>
        </div>
        </div>
    </body>
</html>