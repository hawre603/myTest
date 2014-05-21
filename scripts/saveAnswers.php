<?php

function saveSubmission($guide){
	include 'uploadImage.php';
	$Guide=$guide;	
	$dom = new DOMDocument();
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
    $Submission = $dom->createElement('Submission');
	
	foreach ($_POST as $key => $value){
		if (strpos($key,'filename') !== false){
			continue;								//if element is "filename" ig nore its contents
			}
		
	
		if (strpos($key,'image') !== false){
			$content = $dom->createElement($key);
			$text = $dom->createTextNode($value);
			$content->appendChild($text);
			$Submission->appendChild($content);
			
			$reverse = strrev( $key);
			$len=strlen($key);					//if element is 'image' that means a file may have been uploaded, response fields that
			$num0 = $reverse[0];				// take in file uploads fro this kind of questions are named with the format "AnsimageX",
			$num1 = $reverse[1];				//where X is an integer that also identifies the name of the hidden input which stores
			$varr="Ansimage".$num1.$num0;		//its question statement. This block of code gets X and adds it to 'Ansimage' in order
			$imagePath=saveImg($varr);						//to get its attached file name as text
			$content = $dom->createElement($varr);
			$text = $dom->createTextNode($imagePath);
			$content->appendChild($text);
			$Submission->appendChild($content);
			continue;}
			
			if (strpos($key,'EMAIL') !== false){
			continue;}
	
	$content = $dom->createElement($key);
	$text = $dom->createTextNode($value);
	$content->appendChild($text);
	$Submission->appendChild($content);
	}
	
	
	global $filename;
	$filename =$Guide.date('is').rand (1,100);
	$dom->appendChild($Submission );
	$dom->save("../admin/xmlsubmissions/".$Guide."/".$filename);
	
	return $filename;
	}
	
?>