<?php

/***********************************
Script based on:
PHP File Upload
http://www.w3schools.com/php/php_file_upload.asp
2013
***********************************/

function saveImg($inputName){
$upFile="";
$fileType = $_FILES["$inputName"]['type'];
$fileSize = $_FILES["$inputName"]['size'];
 
 $check=TRUE;							//boolean variable to make sure upload meets requirements
 
 while($check==TRUE){
 
if($fileSize/1024 > '2048') {
	$check=false;
 } //FileSize Checking
 

if($fileType != 'image/png' &&
 $fileType != 'image/gif' &&
 $fileType != 'image/jpg' &&
 $fileType != 'image/jpeg' 
 )     {
	$check=false;
 } //file type checking ends here.
 

 $upFile = '../admin/visitoruploads/'.date('is').$_FILES["$inputName"]['name'];
 
if(is_uploaded_file($_FILES["$inputName"]['tmp_name'])) {
 if(!move_uploaded_file($_FILES["$inputName"]['tmp_name'], $upFile)) {
	$check=FALSE;
 }
 } else {
 $check=FALSE;
 }
 $check=FALSE;
 }
 
 return $upFile;
 } //File upload ends here.
 
 ?>