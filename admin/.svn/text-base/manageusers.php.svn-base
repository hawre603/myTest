<?php
	include 'scripts/authentication_script.php';			//script checks if user 
	sec_session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
	
	include 'scripts/dbCon.php';
	$username=$_SESSION['username'];
	echo $username;
	$result = mysqli_query($dbCon,"SELECT * FROM members
	WHERE username='$username'");
	$priv=$result->fetch_object()->privilage;
	
	if ($priv==true){?>
		<!DOCTYPE html>
		   <head>
				<title>Manage Users</title>
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
					<div class='myHeda'>
						Manage Users 
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
								<h1>Add User</h1>
								<form name="adduser" style='text-align:left' data-ajax='false' method="POST" onsubmit="return confirm('Are you sure you want to perform this action?');">
									<label  for="name"> Name: </label>
									<input type="text" name="name" style="max-width: 50%">
									<br>
									<label  for="usr"> Username: </label>
									<input type="text" name="usr" style="max-width: 50%">
									<br>
									<label for="pwd">Password: </label>
									<input type="text" name="pwd" style="max-width: 50%">
									<br>
									<select name='priv'>;
										<option value='Administrator'>Administrator</option>
										<option value='Management'>Management</option>
									</select>
									<br>
									<input  type="submit" name="create" value="Create">
								</form>
							</div>

							<div data-role="collapsible">
								<h1>Delete User</h1>
								<form method="POST" style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');" >
									<label  for="usr">Username: </label>
									<input type="text" name="usr" style="max-width: 50%"><br>
									<input  name='delete' type="submit" value="Delete">
								</form>
							</div>

							<div data-role="collapsible">
								<h1>Edit User (Password)</h1>
								<form method="POST" style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');">
									<label  for="usr">Username: </label>
									<input type="text" name="usr" style="max-width: 50%"><br>
									<label for="newpwd">New Password: </label>
									<input type="text" name="newpwd" style="max-width: 50%"><br>								
									<input  type="submit" name='editpwd' value="Edit">
								</form>
							</div>

							<div data-role="collapsible">
								<h1>Edit User (Privilage)</h1>
								<form method="POST" style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');">
									<label  for="usr">Username: </label>
									<input type="text" name="usr" style="max-width: 50%"><br>
									<label for="priv">New Privilage: </label>
									<select name='priv'>;
										<option value='administrator'>Administrator</option>
										<option value='manager'>Manager</option>
									</select>
									<input  type="submit" name='editpriv' value="Edit">
								</form>
							</div>
						</div>
					</div>
				</div>
			</body>
		</html>
	<?php}
		
	//if create user button is clicked
	if(isset($_POST['create'])){
		include 'scripts/addU.php';					//script that adds user
		AddUser($_POST["usr"],$pw=$_POST["pwd"], $nm=$_POST["name"], $pv=$_POST["priv"]);		//add this new user
	}

	//if delete user button is clicked
	if(isset($_POST['delete'])){
		include 'scripts/delU.php';					//script that deletes existing users
		delU($_POST["usr"]);						//delete this user
	}

	//if edit password button is clicked
	if(isset($_POST['editpwd'])){
		include 'scripts/editPwd.php';				//script that edits user password
		editpwd($_POST["usr"],$_POST["newpd"]):	//make edition
		}
			
	//if edit privilage button is clicked
	if(isset($_POST['editpriv'])){
		include 'scripts/editUserDetail.php';				//script that edits user privilage
		editpwd($_POST["usr"],$_POST["priv"]):	//make edition
		}
		
	//if change password button is clicked
	if(isset($_POST['changepassword'])){
		include 'scripts/changePwd.php';				//script that edits user password (for manager privilage)
		editpwd($_POST["pwd"]):							//make edition
		}


?>

   </body>
</html>
		<?php}
	else{header("Location: home.php");}
	


?>

<!DOCTYPE html>
   <head>
		<title>Manage Users</title>
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
			<div class='myHeda'>
				Manage Users 
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
						<h1>Add User</h1>
							<form name="adduser" style='text-align:left' data-ajax='false' method="POST" onsubmit="return confirm('Are you sure you want to perform this action?');">
								<label  for="name"> Name: </label>
								<input type="text" name="name" style="max-width: 50%">
								<br>
								<label  for="usr"> Username: </label>
								<input type="text" name="usr" style="max-width: 50%">
								<br>
								<label for="pwd">Password: </label>
								<input type="text" name="pwd" style="max-width: 50%">
								<br>
								<select name='priv'>;
								<option value='Administrator'>Administrator</option>
								<option value='Management'>Management</option>
						</select>
                   <br>
                   <label for="adpwd">Administrative Password: </label>
                   <input type="text" name="adpwd" style="max-width: 50%">
<br>
                   <input  type="submit" name="create" value="Create">
               </form>
           </div>

           <div data-role="collapsible">
               <h1>Delete User</h1>
               <form method="POST" style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');" >
                   <label  for="usr">Username: </label>
                   <input type="text" name="usr" style="max-width: 50%">
<br>
<label for="adpwd">Administrative Password: </label>
                   <input type="text" name="adpwd" style="max-width: 50%">
<br>
                   <input  name='delete' type="submit" value="Delete">
               </form>
           </div>


           <div data-role="collapsible">
               <h1>Edit User (Password)</h1>
               <form method="POST" style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');">
                   <label  for="usr">Username: </label>
                   <input type="text" name="usr" style="max-width: 50%">
                   <br>
                   <label for="newpwd">New Password: </label>
                   <input type="text" name="newpwd" style="max-width: 50%">
                   <br>
<label for="secpwd">Security Password: </label>
<select name='secpwd'>;
<option value='administrator'>Administrative</option>
<option value='current'>Current Password</option>
</select>
                   <input type="text" name="secpwdtxt" style="max-width: 50%">
                   <br>
                   <input  type="submit" name='edit' value="Edit">
               </form>
           </div>

<div data-role="collapsible">
               <h1>Edit User (Privilage)</h1>
               <form method="POST" style='text-align:left' data-ajax='false' onsubmit="return confirm('Are you sure you want to perform this action?');">
                   <label  for="usr">Username: </label>
                   <input type="text" name="usr" style="max-width: 50%">
                   <br>
<label for="adpwd">Administrative Password: </label>
                   <input type="text" name="adpwd" style="max-width: 50%">
                   <br>
<label for="priv">New Privilage: </label>
<select name='priv'>;
<option value='administrator'>Administrator</option>
<option value='manager'>Manager</option>
</select>
                   <input  type="submit" name='edit' value="Edit">
               </form>
           </div>
       </div>
</div>
</div>


<?php

if($_POST) {
//if create user button is clicked
if(isset($_POST['create'])){
include 'addU.php';
$us=$_POST["usr"];	 //new username
$pw=$_POST["pwd"];	 //password
$nm=$_POST["name"];	 //name
$pv=$_POST["priv"];	 //privilege level

AddUser($us, $pw, $nm, $pv);
}

//if delete user button is clicked
if(isset($_POST['delete'])){
include 'delU.php';
$us=$_POST["usr"];	 //username
delU($us);
}

//if delete user button is clicked
if(isset($_POST['edit'])){
}
}

?>

   </body>
</html>