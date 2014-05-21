<?php
	//include 'scripts/authentication_script.php';			//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
	
	$username=$_SESSION['username'];
		
	//if create user button is clicked
	if(isset($_POST['change'])){
		include 'scripts/changePwd.php';					//script that changes user password
		changePwd($username, $_POST["pwd"]);						//change password
	}

?>
		<!DOCTYPE html>
		   <head>
				<title>Manage My Account</title>
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
							
				/*this code is based on   			  http://www.tutscorner.com/javascript-tutorial-password-validation-check-length-and-confirm-password/
accessed on 1-April-2014	*/	
						function val(){
						if(frm.password.value == "")
						{
							alert("Enter the Password.");
							frm.password.focus(); 
							return false;
						}
						if((frm.pwd.value).length < 4)
						{
							alert("Password should be minimum 4 characters.");
							frm.pwd.focus();
							return false;
						}
						
						if(frm.confirmpassword.value == "")
						{
							alert("Enter the Confirmation Password.");
							return false;
						}
						if(frm.confirmpassword.value != frm.pwd.value)
						{
							alert("Password confirmation does not match.");
							return false;
						}
						
						return true;
						}
				</script>
			</head>
			
			<!-- This page only allows tthe user his/her own account, for users with no administrative privilages-->
			<body>
				<div  class='DivOne'>
					<div class='myHeda'>
						Manage My Account
					</div>
				</div>
				<div data-role="navbar">
					<ul>
						<li><a href="homeExhibit.php">Back</a></li>
						<li><a href="homeExhibit.php">Home</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
 
				<div data-role="content">
					<br>
					<br>
					<div class='DivTwo'>
                    <div class='DivThree'>
                        <div data-role="collapsible">
                            <h1>Change Password</h1>
                <form method="POST" name='frm' style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');" >
                    <label  for="pwd">New Password: </label>
                    <input type="password" name="pwd" maxlength="20" style="max-width: 50%" required><br>
                    <label  for='confirmpassword'> Confirm Password: </label><br>
                    <input type='password' name='confirmpassword' maxlength='20'>
                    <input  name='change' type="submit" value="Change" onClick='return val();'>
                </form>
            </div>
        </div>					
    </div>
</div>
</body>
		</html>
	
		
	