<?php

function sendEmail($guide, $email){
require("class.phpmailer.php");
$mail  = new PHPMailer();   
$mail->IsSMTP();

//GMAIL config
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the server
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "newwalkguides";  // GMAIL username
$mail->Password   = "secureguide";            // GMAIL password
//End Gmail

$mail->From       = "newwalkguides@gmail.com";
$mail->FromName   = "New Walk Guides";
$mail->Subject    = "Your New Walk Musuem & Art Gallery Guide";
$mail->MsgHTML($guide);// guide summery

$mail->AddReplyTo("newwalkguides@gmail.com","New Walk Guides");//they answer here, optional
$mail->AddAddress($email);
$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
} 
}


?>