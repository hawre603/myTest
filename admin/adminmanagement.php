<?php
	 session_start(); 									//script checks if user 
															//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
	
	include 'scripts/dbCon.php';
	$username=$_SESSION['username'];
	$result = mysqli_query($dbCon,"SELECT * FROM members
	WHERE username='$username'");
	$priv=$result->fetch_object()->privilage;
	
	if ($priv!=true){
		header("Location: usermanagement.php");
		}
		
	//if create user button is clicked
	if(isset($_POST['create'])){
		include 'scripts/addU.php';					//script that adds user
		AddUser($us=$_POST["usr"],$pw=$_POST["pwd"], $nm=$_POST["name"], $pv=$_POST["priv"]);	//add this new user
	}
	
	//if delete user button is clicked
	if(isset($_POST['delete'])){
		include 'scripts/delU.php';					//script that deletes existing users
		delU($_POST["usrId"]);						//delete this user
	}
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
            
           <!-- <link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />
           <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>
           <script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>-->

            <!--Include custom CSS style sheets-->
            <link rel='stylesheet' type='text/css' href='css/cmsStyling.css'/>
            
            <!--Disable ajax on the page-->
            <script type="text/javascript">	
                $(document).bind("mobileinit", function () {				
                    $.mobile.ajaxEnabled = false;
                        });
            //this functoin used to make confromation to delete user before the action			
            function deletechecked()
            {
                var answer = confirm("Are you sure you want to delete this user?!")
                if (answer){
                    document.messages.submit();
                }
                
                return false;  
            } 
			
        /*this code is based on   http://www.tutscorner.com/javascript-tutorial-password-validation-check-length-and-confirm-password/
            accessed on 1-April-2014	*/	
                            
            function val(){
            if(adduser.pwd.value == "")
            {
                alert("Enter the Password.");
                adduser.pwd.focus(); 
                return false;
            }
            if((adduser.pwd.value).length < 4)
            {
                alert("Password should be minimum 4 characters.");
                adduser.password.focus();
                return false;
            }
            
            if(adduser.confirmpassword.value == "")
            {
                alert("Enter the Confirmation Password.");
                return false;
            }
            if(adduser.confirmpassword.value != adduser.pwd.value)
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
						Manage Users 
					</div>
				</div>
                
				<div data-role="navbar">
					<ul>
					
                <li><a href="homeExhibit.php" data-ajax="false">Exhibition Guides</a></li>
                <li><a href="locationGuide/homeLocation.php" data-ajax="false">Location Guides</a></li>
				<li><a href="QRcode/homeQR.php"data-ajax="false">QR COde</a></li>
                <li><a href="adminmanagement.php" data-ajax="false">User Administration</a></li>
				<li><a href="logout.php" data-ajax="false">Logout</a></li>
	
					</ul>
				</div>
                
				<div data-role="content">
					<div class='DivTwo'>
                    <div class='DivThree'>
							<div data-role="collapsible" id="popupBasic" class="ui-content">
								<h1>Add User</h1>
								<form name="adduser" style='text-align:left' data-ajax'false' method="POST" >
									<label  for="name"> Name: </label>
									<input type="text" name="name" style="max-width: 50%" placeholder="Name" required>
									<label  for="usr"> Username: </label>
									<input type="text" name="usr"  placeholder="User name"   required>
									<label for="pwd">Password: </label>
									<input type="password" name="pwd" pattern=".{4,20}" placeholder="Enter password" required>
                                    <label  for='confirmpassword'> Confirm Password: </label>
									<input type='password' name='confirmpassword' pattern=".{4,20}" placeholder="Enter Confirm password"  required>
									<select name='priv'>
										<option value='Manager'>Manager</option>
										<option value='Administrator'>Administrator</option>
									</select>
									<br>
									<input  type="submit" name="create" value="Create" onClick='return val();'>
								</form>
							</div>
                 <?php
				include 'scripts/dbCon.php';		//script that opens connection to database

				/*Check connection*/
				if (mysqli_connect_errno())
				{
					die("Failed to connect to MySQL");
				}
  
				$result = mysqli_query($dbCon,"SELECT * FROM members");
//#BBAE3C;
					/*echo "<form method='POST' action='scripts/editguideProcess.php' data-ajax='false' >";
					echo "<input type='hidden' name='deleteSelectedUser' value='".$row['name']."'>";
					echo "<input type='submit' value='Add New User'></form>";*/
					
				echo "<table class='myTable' border='1' align='center'>
				
						<tr style='background-color:#09F;'>
						<th>ID</th>
						<th>Name</th>						
						<th>User Name</th>
						<th>Privillage</th>
						<th>Edit</th>
						<th>change password</th>	
						<th>Delete</th>
						</tr>";
				
				
				/*	this loop prints out the user available on the database */
				$i=1;
				while($row = mysqli_fetch_array($result))					
				{																
					if (($i % 2) ==0){$color ='#B3D4FD';}//'#EBE5C5';} 
					else{$color='#FEFFFF';}
  
  
					echo "<tr style='background-color:".$color."'>";
					echo "<td>".$row['id']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "<td>" . $row['username'] . "</td>";
					if( $row['privilage']=='0')
					{
					echo "<td>Manager</td>";
					}
					else
					{
						echo "<td>Administrator</td>";
					}
					/*the form below uses a submit button to pass the name of a given guide, so that a list of its
					submissions can be viewed using the 'browsesubmissions.php' script */
					
					echo "<td><form method='POST' action='editUser.php' data-ajax='false' >";
					echo "<input type='hidden' name='usrId' value='".$row['id']."'>";
					echo "<input type='hidden' name='Name' value='".$row['name']."'>";
					echo "<input type='hidden' name='usrName' value='".$row['username']."'>";
					echo "<input type='hidden' name='priv' value='".$row['privilage']."'>";
					echo "<input type='submit' value='Edit'></form></td>";
					
					echo "<td><form method='POST' action='changePwdForm.php' data-ajax='false' >";
					echo "<input type='hidden' name='usrId' value='".$row['id']."'>";
					echo "<input type='hidden' name='Name' value='".$row['name']."'>";	
					echo "<input type='submit' value='change Password'></form></td>";
					
					echo "<td><form method='POST' data-ajax='false'>";
					echo "<input type='hidden' name='usrId' value='".$row['id']."'>";
					echo "<input type='hidden' name='Name' value='".$row['name']."'>";
					echo "<input type='submit' value='Delete'  name='delete' onClick='return deletechecked();'></form></td>";
					echo "</tr>";
					$i++;
				}
				echo "</table>";

			mysqli_close($dbCon);

		?>
       				

							

							</div>
						</div>
					</div>
				</div>
			</body>
		</html>
	
		
	