<?php 
     session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();
	}  
	
	include '../scripts/dbCon.php';		//script that opens connection to database

	/*Check connection*/
	if (mysqli_connect_errno())
	{
		die("Failed to connect to MySQL");
	} 
	//Set the varuable names
	$guideTitle=$_POST["guideTitle"];
	$qrName=$_POST['guideFileName'];
	$userName=$_POST["username"];
	
	
/*
 * PHP QR Code encoder
 *
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.

 */
        
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'QRImages'.DIRECTORY_SEPARATOR;
    //html PNG location prefix
    $PNG_WEB_DIR = 'QRImages/';
    include "qrlib.php";         //incluse the qrlib which is conatins functions to generate QR code
    if (!file_exists($PNG_TEMP_DIR))      //create temp dir
        mkdir($PNG_TEMP_DIR);
    $filename = $PNG_TEMP_DIR.''.$qrName.'.png';
    $errorCorrectionLevel = 'H';		// this error correction is return %30 damages of the code
	
    $matrixPointSize = 10;				//size of the qr code.
    $url="http://testing.museum.aulp.co.uk/".$_POST['guideFileName'].".html";// the qr will be created for this url
	 if(isset($url)){
     if (trim($url) == '')
            die('<script type="text/javascript">alert("QR Code cannot be generated!."); history.back(); 
			</script>');
        // this will create the QR code and save it in the given path
        QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    } 
	else {    
			header("Location: ../usermanagementerror.php");
		exit();}  
	//insert a record into database
	$check=false; 
	//check if QR code has been added to the database otherwise it can be added
	$result = mysqli_query($dbCon,"SELECT * FROM generated_qrcode WHERE guide_name='$qrName'");
		while($row = mysqli_fetch_array($result)){
			if($row['username']==$us){
				$check=true;}
		} 
		if($check==false){
	$sql="INSERT INTO generated_qrcode (page_title, guide_name, file_path,generated_by)
					VALUES('$guideTitle', '$qrName', '$filename', '$userName')";
					mysqli_query($dbCon,$sql);
		}
		mysqli_close($dbCon);	//close data base connection after finishing the insert.
  	?>    
  <script type="text/javascript"> 
    alert("QR Code generated successfully..."); 
    history.back(); 
  </script> 

    