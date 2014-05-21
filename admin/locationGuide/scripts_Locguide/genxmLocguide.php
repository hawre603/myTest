<?php
		//include 'authentication_script.php';			//script checks if user 
		session_start();									//is logged into the system
		if (!isset($_SESSION['username'])) {					//if not, user is redirected
			header("Location: ../../index.php");						//to login page
			exit();
		}
		
		include '../../scripts/validate.php';				//script for validating text
		include '../../scripts/dbCon.php';					//script for database connection
		include 'geneHtmlCode.php';				           //script that generates html5 code
		include 'addLocGuide.php';					      //script that add guide to database table for guides
						
		
		$result = mysqli_query($dbCon,"SELECT * FROM tbl_location where loc_name='"+str_replace(' ','_',$_POST['locName'])+"' limit 1");
		if(mysql_fetch_array($result) === true){
			echo "<script>javascript: alert('This address already exit!')> history.back(); </script>";
	   		exit();
		}
		
		
		
	// Get lat and long by address using geocode.        
	$address = $_POST['LocationAddress']; // address that user inters
	$formatAddr = str_replace(' ','+',$address);
	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$formatAddr.'&sensor=false');
	$output= json_decode($geocode);
	
	$latitude = $output->results[0]->geometry->location->lat;
	$longitude = $output->results[0]->geometry->location->lng;
		
		 print_r($latitude);
		 print_r($longitude);
		 
		 if ($latitude == '') {
	   echo "<script>javascript: alert('Invalid address!')> history.back(); </script>";
	   exit();
   			}
		$valguideTitle= validate($_POST['LocationName']);
		if($_POST['LocationName']!=$valguideTitle){					//validate location guide title
			header("Location: ../../validationerror.php");
			}
		
		else{
		
			$result = mysqli_query($dbCon,"SELECT * FROM tbl_location");
			while($row = mysqli_fetch_array($result)){					//check if title exists
			if($row['loc_name']==$_POST['LocationName']){
				$check=true;	
				}
			}
									

			if($check==true){
				header("Location: ../../guideexists.php");
				exit();
			}
				
			else{
				
		//generate a filename that will also be used for database records
		 $guideNameval=str_replace(' ','_',$_POST['LocationName']); 
			
				
				$dom = new DOMDocument();
				$dom->preserveWhiteSpace = false;
				$dom->formatOutput = true;
				$Guide = $dom->createElement('locGuide');					//create new element "locGuide"
				
				$locGuideName=$dom->createElement('LocationName');
				$text = $dom->createTextNode($_POST['LocationName']);
				$locGuideName->appendChild($text);
				$Guide->appendChild($locGuideName);							//add location guide name element
				
				$locFileName=$dom->createElement('locFileName');
				$text = $dom->createTextNode($guideNameval);
				$locFileName->appendChild($text);
				$Guide->appendChild($locFileName);							//add location guide file name element
				
				$locAddress=$dom->createElement('LocationAddress');
				$text = $dom->createTextNode($_POST['LocationAddress']);
				$locAddress->appendChild($text);
				$Guide->appendChild($locAddress);	   						//add location address guide element

				$locLatitude=$dom->createElement('LocationLatitude');
				$text = $dom->createTextNode($latitude);
				$locLatitude->appendChild($text);
				$Guide->appendChild($locLatitude);							//add location latitude element
				
				$locLongitude=$dom->createElement('LocationLongitude');
				$text = $dom->createTextNode($longitude);
				$locLongitude->appendChild($text);
				$Guide->appendChild($locLongitude);							//add location Logitude element
				
				$locImage=$dom->createElement('LocationImage'); 
				$text = $dom->createTextNode($_POST['LocationImage']);
				$locImage->appendChild($text);
				$Guide->appendChild($locImage);								// add image tage for location
				
				$locDescription=$dom->createElement('LocationDescription');
				$text = $dom->createTextNode($_POST['LocationDescription']);
				$locDescription->appendChild($text);
				$Guide->appendChild($locDescription);						// add location description 
				
				$chkStatus=$dom->createElement('Status');
				$text = $dom->createTextNode($_POST['chkStatus']);
				$chkStatus->appendChild($text);
				$Guide->appendChild($chkStatus);						// add location description 
				
									
				
				$pageNum=1;
			   //for each page, open a page element and set Page number
			
			
			
				foreach ($_POST as $key => $value){
					if (strpos($key,'pageBeginning') !== false){	
							$page = $dom->createElement('Page');
							$page->setAttribute("number", $pageNum);
						}
					
					if (strpos($key,'statement') !== false){
						//set content type for statements and set text
							$content = $dom->createElement('content');		
							$content->setAttribute("type", "Statement");
							$text = $dom->createTextNode($value);
							//check if content is empty
							if($value==""){continue;}						
							else{
								$valtext= validate($text);
								//validate text input
								if(($valtext!=$text) ||($valtext=="")){							
									header("Location: validationerror.php");
									}
							$content->appendChild($text);
							$page->appendChild($content);}
						}
					
					if (strpos($key,'image') !== false){
							$content = $dom->createElement('content');
							//set content type for images and set filename
							$content->setAttribute("type", "Image");		
							$text = $dom->createTextNode($value);
							//check if content is empty
							if($value==""){continue;}						
							else{
								$content->appendChild($text);
								$page->appendChild($content);}
						}
						
					if (strpos($key,'video') !== false){
							$content = $dom->createElement('content');
							$content->setAttribute("type", "Video");	//set content type for video and set filename
							$text = $dom->createTextNode($value);
							if($value==""){continue;}						//check if content is empty
							else{
								$content->appendChild($text);
								$page->appendChild($content);}
						}
					
					if (strpos($key,'qtypeone') !== false){
							$content = $dom->createElement('content');
							$content->setAttribute("type", "Question Type1");
							$text = $dom->createTextNode($value);
							if($value==""){continue;}								//check if content is empty
							else{
								$valtext= validate($text);
								if(($valtext!=$text) ||($valtext!="")){					//validate text input
									header("Location: validationerror.php");
									}
								$content->appendChild($text);
								$page->appendChild($content);}
						}
						
					if (strpos($key,'qtypetwo') !== false){
							$content = $dom->createElement('content');
							$content->setAttribute("type", "Question Type2");
							$text = $dom->createTextNode($value);
							if($value==""){continue;}									//check if content is empty
							else{
								if(($valtext!=$text) ||($valtext==""));
									if($valtext!=$text){										//validate text input
										header("Location: validationerror.php");
										}
								$content->appendChild($text);
								$page->appendChild($content);}
						}
						
					if (strpos($key,'qtypethree') !== false){
							$content = $dom->createElement('content');
							$content->setAttribute("type", "Question Type3");
							$text = $dom->createTextNode($value);
							if($value==""){continue;}								//check if content is empty
							else{
								$valtext= validate($text);
								if(($valtext!=$text) ||($valtext!="")){				//validate text input
									header("Location: validationerror.php");
									}
								$content->appendChild($text);
								$page->appendChild($content);}
						}
						
					if (strpos($key,'qtypefour') !== false){
							$content = $dom->createElement('content');
							$content->setAttribute("type", "Question Type4");
							$text = $dom->createTextNode($value);
							if($value==""){continue;}									//check if content is empty
							else{
								$valtext= validate($text);
								if(($valtext!=$text) ||($valtext=="")){										//validate text input
									header("Location: validationerror.php");
									}
								$counta=substr($key,9);
								$content->appendChild($text);
								for($i=1; $i<=5; $i++){																//for loop assigns options for multiple choice questions as attributes
									$valtext= validate($_POST["opt1".$counta."".$i]);
										if(($valtext!=$_POST["opt1".$counta."".$i])||($valtext!="")){						//validate text input
											header("Location: validationerror.php");
										}		
									$content->setAttribute('option'.$i, $_POST["opt1".$counta."".$i]);					
							}
							$page->appendChild($content);}
					}
					
				if (strpos($key,'qtypefive') !== false){
						$content = $dom->createElement('content');
						$content->setAttribute("type", "Question Type5");
						$text = $dom->createTextNode($value);
						if($value==""){continue;}									//check if content is empty
						else{
							$valtext= validate($text);
								if(($valtext!=$text) ||($text=="")){				//validate text input
									header("Location: validationerror.php");
									}
							$counta=substr($key,9);
							$content->appendChild($text);
							//for loop assigns options for multiple choice questions as attributes
		      				for($i=1; $i<=5; $i++){	 		
			  
								$valtext= validate($_POST["opt2".$counta."".$i]);
								//validate text input
									if(($valtext!=$_POST["opt2".$counta."".$i])||($valtext!="")){						
										header("Location: validationerror.php");
										}
								$content->setAttribute('option'.$i, $_POST["opt2".$counta."".$i]);					
							}
							$page->appendChild($content);}
					}
					
				if (strpos($key,'qtypesix') !== false){
						$content = $dom->createElement('content');
						$content->setAttribute("type", "Question Type6");
						$text = $dom->createTextNode($value);
						if($value==""){continue;}									//check if content is empty
						else{
							$valtext= validate($text);
							if(($valtext!=$text) ||($valtext=="")){					//validate text input
								header("Location: validationerror.php");
								}
							$content->appendChild($text);
							$page->appendChild($content);}
					}
					
				if (strpos($key,'pageEnd') !== false){
						$Guide->appendChild($page);
						$pageNum++;
					}
				}
				$TPages= $pageNum-1;
				$Guide->setAttribute("TotalPages", $TPages);
				$dom->appendChild($Guide );
					
				$xmlfilename="../../xmlpages/LocationGuideXML/".$guideNameval.'.xml';
				//print_r($dom);
				//$dom->save($xmlfilename);
				echo $dom->saveXML();

			   // add location guide to database table
			   addGuide($guideNameval,$locAddress,$_POST['chkStatus'],$_SESSION['username']);
			

				// generate page in HTML and store in $HTML5File
			     geneHtmlCode($xmlfilename);

				
				// create table for recording guide submissions
				//addTable($guideNameval);
				
				//creates a directory for saving guide's submissions
				mkdir ("../../xmlsubmissions/".$guideNameval, 0777);
				header("Location: ../../guidecreated.php");
			
				}
			}
	
?>
