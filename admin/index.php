<?php
			session_start();
			include	'scripts/validate.php';
			include 'scripts/authentication_script.php';  		//script containing authentication function
			include_once("check_user.php");					//script checks if user 
			if(isset($_POST['login'])) {
			 if($_POST['usr'] !='' && $_POST['pwd']!='')
			 {
				$username = validate($_POST['usr']);			//validating username input
				$password = validate($_POST['pwd']);			//validating password input
					if(login($username,$password)==true)
					{
						header('Location: Home.php');
					}
					else
					{
					 	header('Location: loginerror.php');	 //redirects to error page if login failes
					}
			 }
		} 
?>

<!DOCTYPE html>
   <head>
		<title>Login</title>
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
		
		<div id="loginDiv1">
			<b style="font:Arial, Helvetica, sans-serif; font-weight:100; font-weight:300;">Login</b>
			<br>
			<br>
			<div id="loginDiv2">
				<form method="POST" action="" data-ajax='false'>
					<label for='usr' value='Username:'></label>
					Username:<input type='text' maxlength="20" name='usr' required><br>
					Password:<input type='password' maxlength="20" name='pwd' required><br>
					<input type='submit' name='login' value="Login">
				</form>
			</div>
		</div>
		
		
	</body>
	
</html>