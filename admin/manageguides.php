l<?php
			 											//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
	header("Location: index.php");							//to login page
	exit();
	}
?>

<!DOCTYPE html>
<html>
		   <head>
				<title>Manage Guides</title>
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
						Manage Guides 
					</div>
				</div>
				<div data-role="navbar">
					<ul>
						<li><a href="homeExhibit.php">Back</a></li>
						<li><a href="Home.php">Home</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
				
				<div data-role="content">
			<br>
			<br>
			<div class='DivTwo'>
				<div class='DivThree'>
					<div data-role="collapsible">
						<h1>Upload Video</h1>
						<form name="upVid" style='text-align:left' enctype='multipart/form-data' action='scripts/uploadvideo.php' data-ajax='false' method="POST" onsubmit="return confirm('Are you sure you want to perform this action?');">
							<label  for="name">Choose Video:</label>
							<input type="file" id='video' name="video" />
							<br>
							<br>
							<label  for="titlev">Video Title:</label>
							<input type="text"  name="title" required>
							<input type="submit" value='Upload Video'>
						</form> 
					</div>
					
					<div data-role="collapsible">
						<h1>Upload Image</h1>
						<form name="upImg" style='text-align:left' enctype='multipart/form-data' data-ajax='false' action='scripts/uploadimage.php' method="POST" onsubmit="return confirm('Are you sure you want to perform this action?');">
							<label  for="name">Choose Image:</label>
							<input type="file" id='image' name="image" >
							<br>
							<br>
							<label  for="titlei">Image Title:</label>
							<input type="text"  name="title" required>
							<input type="submit" name='submit' value='Upload Image'>
						</form> 
					</div>
					
					<div data-role="collapsible">
						<h1>Delete Uploaded Media</h1>
							<form  style='text-align:left' enctype='multipart/form-data' data-ajax='false' action='scripts/deletemedia.php' method="POST" onsubmit="return confirm('Are you sure you want to perform this action?');">							
							<label  for="name">Choose Media File To Delete:</label>
							<select name='mediafile'>
								<?php
										include 'scripts/dbCon.php';
										$username=$_SESSION['username'];
										$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");

											$result = mysqli_query($dbCon,"SELECT * FROM uploadedmedia");			
											while($row = mysqli_fetch_array($result)){								
												echo"<option value='".$row['name']."'>".$row['title']." (".$row['type']." file)</option>";	
													}	
											?>
									</select>
								<br>
							<input type="submit" value='Delete File'/>
						</form> 
					</div>
					
					<div data-role="collapsible">
						<h1>Add Guide To Application</h1>
						
						<!-- Form for adding guide to application-->
						<form method="POST" style='text-align:left' action='scripts/addguidetoapp.php' data-ajax='false' onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}">
							<select name='guideAdd'>
							<option selected="selected">Null</option>			
							<!-- Script that lists guides in the database that not active on the appliation-->
							<?php
								include 'scripts/dbCon.php';	
								$result = mysqli_query($dbCon,"SELECT * FROM guides");
								while($row = mysqli_fetch_array($result)){
									if($row['active']==false){
									echo"<option value='".$row['name']."''>".$row['title']."</option>";
									}
								}
							?>
							
							</select>
							<br>
							<input  type="submit" name='add' value="Add">
						</form>
					</div>
					
					<div data-role="collapsible">
						<h1>Remove Guide From Application</h1>
						
						<!-- Form for removing guide from application-->
						<form method="POST" style='text-align:left' action='scripts/removeguide.php' data-ajax='false' onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}">
							<select name='guideRem'>
							<option selected="selected">Null</option>
							<!-- Script that lists guides in the database that active on the appliation-->
							<?php
								include 'scripts/dbCon.php';	
								$result = mysqli_query($dbCon,"SELECT * FROM guides");
								while($row = mysqli_fetch_array($result)){
									if($row['active']==true){
									echo"<option value='".$row['name']."''>".$row['title']."</option>";
									}
								}
							?>
							
							<input  type="submit" name='remove' value="Remove">
						</form>
					</div>
					
					<div data-role="collapsible">
						<h1>Delete Guide & All Data</h1>
						
						<!-- Form for deleting guide and all its data including submissions-->
						<form method="POST" style='text-align:left' data-ajax='false' action="scripts/completedelete.php" onsubmit="return confirm('Are you sure you want to perform this action?');">
							<select name='guideDel'>;
							
							<!-- Script that lists all available guides in the database -->
							<?php
								include 'scripts/dbCon.php';
								$username=$_SESSION['username'];
								$result = mysqli_query($dbCon,"SELECT * FROM members
								WHERE username='$username'");
								$priv=$result->fetch_object()->privilage;
								if($priv==true){
									$result1 = mysqli_query($dbCon,"SELECT * FROM guides");
									while($row = mysqli_fetch_array($result1)){
										if($row['active']==true){
										echo"<option value='".$row['name']."''>".$row['title']."</option>";
									}
									}
								}
							?>
							<input  type="submit" name='delete' value="Delete">
						</form>
					</div>
				</div>
           </div>
		</div>
    </body>
</html>