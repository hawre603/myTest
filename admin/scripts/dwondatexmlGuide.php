	<?php
	//include 'authentication_script.php'; //script checks if user 
	/*session_start(); //is logged into the system
	if (!isset($_SESSION['username'])) { //if not, user is redirected
	header("Location: index.php"); //to login page
	exit();
	}*/
	include 'validate.php'; //script for validating text
	include 'dbCon.php'; //script for database connection
	include 'generateCode.php'; //script that generates html5 code
	include 'addGuide.php'; //script that add guide to database table for guides
	include 'addTable.php'; //script that creates a table for recording guide submissions of database
	 
	
	foreach($_POST as $key=>$value)
	{
	
	if (strpos($key,'QuestionType4') !== false)
	{
	$counta=substr($key,13);
	
	for($i=1; $i<=5; $i++){ //for loop assigns options for multiple choice questions as attributes
	
	}
	}
	}
	
	$valguideTitle= validate($_POST['guideTitle']);
	 
	if($_POST['guideTitle']!=$valguideTitle){ //validate guide title
	header("Location: ../validationerror.php");
	}
	else{
	$result = mysqli_query($dbCon,"SELECT * FROM guides");
	while($row = mysqli_fetch_array($result)){ //check if title exists
	if($row['title']==$_POST['guideTitle']){
	$check=false; 
	}
	}
	if($check==true){
	header("Location: ../guideexists.php");
	}
	else{
	$guideNameval=$_POST['fileName']; //pass the file name to the edit page
	
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$Guide = $dom->createElement('Guide'); //create new element "Guide"
	$guideTitle=$dom->createElement('guideTitle');
	$text = $dom->createTextNode($_POST['guideTitle']);
	$guideTitle->appendChild($text);
	$Guide->appendChild($guideTitle); //add guide title element
	$guideName=$dom->createElement('guideName');
	$text = $dom->createTextNode($guideNameval);
	$guideName->appendChild($text);
	$Guide->appendChild($guideName); //add guide name element
	$pageNum=1;
	foreach ($_POST as $key => $value){
	if (strpos($key,'pageBeginning') !== false){ //for each page, open a page element and set Page number
	$page = $dom->createElement('Page');
	$page->setAttribute("number", $pageNum);
	}
	if (strpos($key,'Statement') !== false){
	$content = $dom->createElement('content'); //set content type for statements and set text
	$content->setAttribute("type", "Statement");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$valtext= validate($text);
	if(($valtext!=$text) ||($valtext=="")){ //validate text input
	header("Location: validationerror.php");
	}
	$content->appendChild($text);
	$page->appendChild($content);}
	}
	if (strpos($key,'Image') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Image"); //set content type for images and set filename
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$content->appendChild($text);
	$page->appendChild($content);}
	}
	if (strpos($key,'Video') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Video"); //set content type for video and set filename
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$content->appendChild($text);
	$page->appendChild($content);}
	}
	if (strpos($key,'QuestionType1') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Question Type1");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$valtext= validate($text);
	if(($valtext!=$text) ||($valtext!="")){ //validate text input
	header("Location: validationerror.php");
	}
	$content->appendChild($text);
	$page->appendChild($content);}
	}
	if (strpos($key,'QuestionType2') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Question Type2");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	if(($valtext!=$text) ||($valtext==""));
	if($valtext!=$text){ //validate text input
	header("Location: validationerror.php");
	}
	$content->appendChild($text);
	$page->appendChild($content);}
	}
	if (strpos($key,'QuestionType3') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Question Type3");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$valtext= validate($text);
	if(($valtext!=$text) ||($valtext!="")){ //validate text input
	header("Location: validationerror.php");
	}
	$content->appendChild($text);
	$page->appendChild($content);}
	}
	if (strpos($key,'QuestionType4') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Question Type4");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$valtext= validate($text);
	if(($valtext!=$text) ||($valtext=="")){ //validate text input
	header("Location: validationerror.php");
	}
	$counta=substr($key,13);
	$content->appendChild($text);
	for($i=1; $i<=5; $i++){ //for loop assigns options for multiple choice questions as attributes
	if (strpos($key,'option'.$i) !== false)
	$valtext= validate($_POST["option".$i."".$counta]);
	if(($valtext!=$_POST["option".$i."".$counta])||($valtext!="")){ //validate text input
	header("Location: validationerror.php");
	} 
	$content->setAttribute('option'.$i, $_POST["option".$i."".$counta]); 
	}
	$page->appendChild($content);}
	}
	if (strpos($key,'QuestionType5') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Question Type5");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$valtext= validate($text);
	if(($valtext!=$text) ||($text=="")){ //validate text input
	header("Location: validationerror.php");
	}
	$counta=substr($key,13);
	$content->appendChild($text);
	for($i=1; $i<=5; $i++){ //for loop assigns options for multiple choice questions as attributes
	$valtext= validate($_POST["option".$i."".$counta]);
	if(($valtext!=$_POST["option".$i."".$counta])||($valtext!="")){ //validate text input
	header("Location: validationerror.php");
	}
	$content->setAttribute('option'.$i, $_POST["option".$i."".$counta]); 
	}
	$page->appendChild($content);}
	}
	if (strpos($key,'QuestionType6') !== false){
	$content = $dom->createElement('content');
	$content->setAttribute("type", "Question Type6");
	$text = $dom->createTextNode($value);
	if($value==""){continue;} //check if content is empty
	else{
	$valtext= validate($text);
	if(($valtext!=$text) ||($valtext=="")){ //validate text input
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
	$xmlfilename="../xmlpages/".$guideNameval.'.xml';
	$dom->save($xmlfilename);
	// generate page in HTML and store in $HTML5File
	generateHTML5($xmlfilename);
	// add guide to guides log table
	echo"  <script type=text/javascript'> 
    alert('You cannot delete Admin user!!'); 
    history.back(); 
  </script> ";
	//header("Location: ..\guidecreated.php");
		updGuide($_SESSION['username'], $valguideTitle, $guideNameval);
	
	//header("Location: ../guidecreated.php");
	}
	}
	 
	?>
