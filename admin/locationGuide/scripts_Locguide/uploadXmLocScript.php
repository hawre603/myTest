<?php
															//script checks if user 
	session_start();									    //is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: index.php");						//to login page
		exit();
	}
	
	
	$username=$_SESSION['username'];

	include 'dbCon.php';
	include 'validXmlgenHtml.php';				//script that generates html5 code
	include 'geneHtmlCode.php';
	include 'addLocGuide.php';						
		
	
	    $xmlfilename=$_FILES["file"]["name"] ;
		$file_type=$_FILES["file"]["type"] ;
		$file_size=$_FILES["file"]["size"] ;
		$file_tmp= $_FILES["file"]["tmp_name"] ;
		$file_error= $_FILES["file"]["error"] ;
		
		$check=false;
	
		if($file_type != 'text/xml')     
		  {
			header("Location: ../wrongformatorsize.php");
			exit();
		 }
		 //remove .xml form the fiel name
		 $length= strlen($xmlfilename);
		 $file_name = substr($xmlfilename,$length,$length-4);
		$title=$_POST['title'];
			$result = mysqli_query($dbCon,"SELECT * FROM tbl_location where loc_name='".$file_name."' or loc_name='".$title."'");
			while($row = mysqli_fetch_array($result))					
			{
				if((($file_name==$row['loc_name']))||($title==$row['loc_name'])){
					$check=true;
					}
			}
			
		//file path to be saved		
		$xmlfilePath="../xmlpages/LocationGuideXML/".$xmlfilename;	
		
		move_uploaded_file($file_tmp,$xmlfilePath);
		
		//check if the xml file is exit, update the file on server otherwise create new HTML and insert new record
		// into databse
		if($check==true)
		{
			// Update current guide
			$_SESSION["xmlfile"] = $xmlfilePath; // create session to pass the file name to exit xml content
			printf("<script>location.href='uploadxmlUpdGuide.php'</script>");
		}
		else {
			// generate page in HTML base on the xml file
			geneHtmlCode($xmlfilePath);
			
		   // add guide to guides table
		   addGuide($file_name,1,$_SESSION['username'] );
		   printf("<script>alert('New guide has been added successfully!!');location.href='../../Home.php'</script>");
		}
			
	
?>