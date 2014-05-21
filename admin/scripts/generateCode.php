<?php
function generateHTML5($fname){
$xml = new DOMDocument();
$xml->load($fname);											//load xml file with xml definition of guide

$Guide= $xml->getElementsByTagName( "Guide" );				//get guide total pages
foreach ($Guide as $gd) {
    $totalpages= $gd->getAttribute("TotalPages");}
	
$ID = $xml->getElementsByTagName( "guideName" );			//get guide name
foreach ($ID as $id) {
    $idd= $id->nodeValue;}
	
$Title = $xml->getElementsByTagName( "guideTitle" );		//get guide title
foreach ($Title as $title) {
    $titles= $title->nodeValue;}
	
	

/* bodycode is s tring variable that will store html5 generated dor every xml element foun on the file, substitutong with with the righ representation in html*/
$bodycode="";
$bodycode=$bodycode."<!DOCTYPE html>\n<head>\n<title>".$titles."</title>\n<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
$bodycode=$bodycode."<link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />\n
<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>\n
<script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>\n";

$bodycode=$bodycode."<script src='http://jquery.bassistance.de/validate/jquery.validate.js'></script>\n
<script src='http://jquery.bassistance.de/validate/additional-methods.js'></script>\n
<link rel='stylesheet' href='http://jquery.bassistance.de/validate/demo/site-demos.css'/>\n";
$bodycode=$bodycode."<link rel='stylesheet' type='text/css' href='appStyling.css'/>\n </head> \n";
$bodycode=$bodycode."<body> \n <form action='scripts/submit.php' id='guide' enctype='multipart/form-data' data-ajax='false' method='POST'>\n <input type='hidden' name='guide' value='".$titles."'> <input type='hidden' name='filename' value='".$idd."'>\n";

$page = $xml->getElementsByTagName( "Page" );
foreach ($page as $pages)
{
	$pagenumber=$pages->getAttribute("number");																//for every page element encountered create a dive with page data role and start populating with content
	$bodycode=$bodycode."<div data-role='page' id='page".$pagenumber."'>\n <div data-role='content'> \n";
	$content=$pages->getElementsByTagName( "content" );
	$xx=1;
	$bodycode=$bodycode."<div class='ui-corner-all ui-shadow outerDiv'>\n";
	$bodycode=$bodycode."<div class='ui-corner-all ui-shadow innerDiv'>\n";
	foreach ($content as $contents)
	{
			
		//And for each content type found in the xml definition, generate the appropriate html5 code to represent it
			
			$contenttype=$contents->getAttribute("type");
			if($contenttype=="Statement"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Que".$pagenumber.$xx."' value='".$text."'><br><hr>\n";
			$xx++;
			}

			if($contenttype=="Image"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode."<img src='admin/uploadedmedia/".$text."' width='100%'>\n<hr class='imgBorder'><hr>\n";
			$xx++;
			}
			
			if($contenttype=="Video"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode."<hr class='imgBorder'>\n<video controls style='max-width: 95%'>\n<source src='admin/uploadedmedia/".$text."' type='video/mp4'>\nYour browser does not support the video tag.\n</video>\n<hr class='imgBorder'><hr>\n";
			$xx++;
			}
			
			if($contenttype=="Question Type1"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Que".$pagenumber.$xx."' value='".$text."'>\n";
            $bodycode=$bodycode."<input type ='text' placeholder='Short answer' maxlength='50' name ='Ans".$pagenumber.$xx."'><hr>
\n";
			$xx++;
			}
			
			if($contenttype=="Question Type3"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Que".$pagenumber.$xx."' value='".$text."'>\n";
             $bodycode=$bodycode."<input type ='number' name ='Ans".$pagenumber.$xx."'><hr>";
			$xx++;
			}
			
			if($contenttype=="Question Type2"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Que".$pagenumber.$xx."' value='".$text."'>\n";
             $bodycode=$bodycode."<textarea name='Ans".$pagenumber.$xx."' placeholder='Essay type answer'></textarea><hr>";
			$xx++;
			}
			
			if($contenttype=="Question Type4"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Que".$pagenumber.$xx."' value='".$text."'>\n";
			
            for($counta=1; $counta<=5;$counta++){
				$optxt= $contents->getAttribute("option".$counta);
					if($optxt!=""){
						
					$bodycode=$bodycode."<input type='radio' name='Ans".$pagenumber.$xx."' value='".$optxt."'>".$optxt."\n<br>";
				}}
				$xx++;
				$bodycode=$bodycode."<hr>";

				
			}
			
			if($contenttype=="Question Type5"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Que".$pagenumber.$xx."' value='".$text."'>\n<br>\n";
            for($counta=1; $counta<=5;$counta++){
				$optxt= $contents->getAttribute("option".$counta);
					if($optxt!=""){
					$bodycode=$bodycode."<input type='checkbox' name='Ans".$pagenumber.$xx."".$counta."' value='".$optxt."'>".$optxt."<br>";
				}}
				$bodycode=$bodycode."<hr>";

			}
			
			if($contenttype=="Question Type6"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode.$text."\n<input type='hidden' name='Queimage".$pagenumber.$xx."' value='".$text."'>\n";
             $bodycode=$bodycode."<input type ='file' name ='Ansimage".$pagenumber.$xx."'><br><hr>\n";
			$xx++;
			}
			
			}
			

	//navigation bar code for first page		
	if($pagenumber==1){
	$bodycode=$bodycode."<div data-role='navbar' style='text-align:center'>\n<ul>\n<li><a href='index.php'> Back</a></li>\n<li><a href ='#page".($pagenumber+1)."' rel='external'> Next</a> </li>\n</ul>\n</div>";
				$bodycode=$bodycode."</div></div>\n</div></div>\n";

			}
	//navigation bar code for last page
	else if($pagenumber==$totalpages){
	$bodycode=$bodycode."<div data-role='navbar' style='text-align:center'><ul>\n<li><a href='#page".($pagenumber-1)."' rel='external'> Back</a></li>\n<li><a href ='#infopage' > Next</a> </li>\n</ul>\n</div></div></div></div></div>";
	
			}
	//navigation bar code for every other page
	else{
	$bodycode=$bodycode."<div data-role='navbar' style='text-align:center' data-position='fixed'>\n<ul>\n<li><a href='#page".($pagenumber-1)."' rel='external'> Back</a></li>\n<li><a href ='#page".($pagenumber+1)."' rel='external'> Next</a> </li>\n</ul>\n</div></div></div></div></div>";
			}
	//$bodycode=$bodycode."</div>\n";
			}
						//$bodycode=$bodycode."</div></div>\n</div></div>\n";

			
	//code for information collection page added at the end of a guide
	$bodycode=$bodycode."<div data-role='page' id='infopage' >\n<div data-role='content'>\n<div class='ui-corner-all ui-shadow outerDiv'>\n<div  class='ui-corner-all ui-shadow innerDiv'>\nHow old are you? \n";
	
	$bodycode=$bodycode."<ul data-role='listview' data-inset='true'>\n<li><input type ='number'  name ='AGE' id='AGE'></li>\n</ul>\n";
	
    $bodycode=$bodycode."What is your postcode?\n <ul data-role='listview' data-inset='true'> \n<li><input type ='text' maxlength='10' name ='POSTCODE' id='POSTCODE'></li>\n</ul>\n";
	
    $bodycode=$bodycode."If you would like us to email you your completed guide, enter your email below.";
	
    $bodycode=$bodycode."\n<ul data-role='listview' data-inset='true'> \n<li><input type ='email' maxlength='30' id='email' name ='EMAIL'></li>\n </ul><input type='checkbox' name='saveEmail'>\n<p style='padding-left:40px;'>Tick this box if you would like your email to be saved in order to receive e-mails from NewWalk Museum regarding...</p> \n";  
	
	     
	             
    $bodycode=$bodycode."<div data-role='navbar' style='text-align:center' data-position='fixed'>\n <ul>\n <li>\n <a href='#page".($totalpages)."'> Back</a>\n </li> \n<li> <input type='submit' data-corners='false' value ='Finish'>\n";
	$bodycode=$bodycode."</li>\n</ul>\n</div>\n</div>\n</div></div></div>\n</form>\n";
	$bodycode=$bodycode."<script>
$( '#guide' ).validate({
  rules: { AGE: { required: true, min: 4, max: 99 },
	POSTCODE: {required:true,minlength:5},
	email: {required: true,email:true}
}  });
</script></body>\n</html>";

//write code to file
$filename="../../".$idd.".html";
$fh = fopen($filename, 'w') or die("can't open file");
fwrite($fh, '');
fwrite($fh, "$bodycode>");
fclose($fh);

return $filename;
}


?>