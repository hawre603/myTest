<?php
//geneHtmlCode("../../xmlpages/LocationGuideXML/Las_Test_UNi.xml");
function geneHtmlCode($fname){
$xml = new DOMDocument();
$xml->load($fname);											//load xml file with xml definition of guide

$Guide= $xml->getElementsByTagName( "locGuide" );				//get guide total pages
foreach ($Guide as $gd) {
    $totalpages= $gd->getAttribute("TotalPages");}
	
$ID = $xml->getElementsByTagName( "locFileName" );			//will be the HTML5 file name
foreach ($ID as $id) {
    $idd= $id->nodeValue;}
	
$Title = $xml->getElementsByTagName( "LocationName" );		//get guide title
foreach ($Title as $title) {
    $titles= $title->nodeValue;}
	
$locAddress = $xml->getElementsByTagName( "LocationAddress" );		//get location guide address
foreach ($locAddress as $locAdd) {
    $Address= $locAdd->nodeValue;}
	
$locLatitude = $xml->getElementsByTagName( "LocationLatitude" );		//get location guide latitude
foreach ($locLatitude as $Latitude) {
    $lat= $Latitude->nodeValue;}
	
$locLongitude = $xml->getElementsByTagName( "LocationLongitude" );		//get location guide longitude
foreach ($locLongitude as $Longitude) {
    $lng= $Longitude->nodeValue;}
	
$locDescription = $xml->getElementsByTagName( "LocationDescription" );		//get location guide description or brif his
foreach ($locDescription as $Description) {
    $desc= $Description->nodeValue;}
	
$locImage = $xml->getElementsByTagName( "LocationImage" );		//get location guide description or brif his
foreach ($locImage as $Image) {
    $imagFile= $Image->nodeValue;}
	
	echo 'I mahere';

/* bodycode is s tring variable that will store html5 generated dor every xml element foun on the file, substitutong with with the righ representation in html*/
$bodycode="";
$bodycode=$bodycode."<!DOCTYPE html>\n<head>\n<title>".$titles."</title>\n<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
$bodycode=$bodycode."<style>
      html, body{
        height: 100%;
        margin: 0px;
        padding: 0px
      }
	  #map-page { width: 100%; height: 100%; padding: 0; }
	  #map-canvas{ width: 100%; height:80%; padding: 0; }
    </style>";
$bodycode=$bodycode."<link rel='stylesheet' href='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css' />
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=geometry'></script>\n
<script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>\n
<script src='http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js'></script>\n
<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false'></script>\n";

$bodycode=$bodycode."<script src='http://jquery.bassistance.de/validate/jquery.validate.js'></script>\n
<script src='http://jquery.bassistance.de/validate/additional-methods.js'></script>\n
<link rel='stylesheet' href='http://jquery.bassistance.de/validate/demo/site-demos.css'/>\n";
$bodycode=$bodycode."<link rel='stylesheet' type='text/css' href='../appStyling.css'/>\n 

<script>
        
     $( document ).on( 'pageinit', '#map-page', function() {
		 
		 var currentLatlng;
		var otherLatlng = new google.maps.LatLng('".$lat."','".$lng."');
		
    if ( navigator.geolocation ) {
        function success(pos) {
			 currentLatlng=new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
		drawMap(currentLatlng);
        }
		function fail(error) {
            drawMap(defaultLatLng);  // Failed to find location, show default map
        }
		
		// Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
        navigator.geolocation.getCurrentPosition(success, fail, 
		{maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
    } else {
        drawMap(defaultLatLng);  // No geolocation support, show default map
    }
    function drawMap(currentLatlng) {
        var myOptions = {
            zoom: 13,
            center: currentLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);
        // Add an overlay to the map of current lat/lng
        var marker = new google.maps.Marker({
            position: currentLatlng,
            map: map,
            title: 'Current Location!'
        });

		
		var imgIcon ='../admin/icons/map-marker.png';
		var marker1 = new google.maps.Marker({
            position: otherLatlng,
            map: map,
			icon : imgIcon,
            title: '".$Address."'
        });
		
		 var contentString1='<div id="."content"."><div id="."siteNotice"."><p>New Walk Museum and Art Gallery</p><p><a href=".$idd.".html#detail-page".">Click for more detail</a></p></div></div>';
		var infowindow1 = new google.maps.InfoWindow({
		content: contentString1
		});
		
		var infowindowCurrent = new google.maps.InfoWindow({
		content: "."'Current Location!'"."
		});
		
		google.maps.event.addListener(marker, 'click', function() {
		infowindowCurrent.open(map,marker);});
		
		google.maps.event.addListener(marker1, 'click', function() {
		infowindow1.open(map,marker1);
		
		});
		
		
		var locBounds = new google.maps.LatLngBounds();
		locBounds.extend(otherLatlng);
		locBounds.extend(currentLatlng);
		//map.setCenter(locBound.getCenter());
   		map.fitBounds(locBounds);
     $('#dist').click(function(){
			var distance = calculateDistance();
			
			if(distance>150)
			{
				alert('You are not arrived the place yet!');
				window.location.href = '".$idd.".html"."';
			}});
			
		//Get the distance between current location and other place
		function calculateDistance()
    	{
        try
        { 
           var dist = google.maps.geometry.spherical.computeDistanceBetween(currentLatlng, otherLatlng);
		   return dist;
        }
        catch (error)
        {
            alert(error);
        }
    }}        
});
          
    </script>







		
		</head> \n";
		$bodycode=$bodycode."<body> \n <form action='scripts/submit.php' id='guide' enctype='multipart/form-data' data-ajax='false' method='POST'>\n <input type='hidden' name='guide' value='".$titles."'> <input type='hidden' name='filename' value='".$idd."'>\n";
		
		$bodycode=$bodycode."<div data-role='page' id='map-page' data-url='map-page'>
		  
			<div data-role='header' data-theme='a'>
			<h1>Location Map Guide</h1>
			</div>
			<div role='main' class='ui-content' id='map-canvas'>
				<!-- map loads here... -->
			</div>
			<div data-role='navbar' style='text-align:center'>\n<ul>\n<li><a href='index.php'> Back</a></li>\n<li><a href ='#detail-page' rel='external'> Next</a> </li>\n</ul>\n</div>
		</div>";
		
		
		$bodycode=$bodycode."
		
		<div data-role='page' id='detail-page'>
		<div data-role='header' data-position='fixed'> <a href='#map-page' data-icon='home'
		data-iconpos='notext' data-rel='back'>Home</a>
		<h1>".$titles." </h1> </div><!-- /header -->
		<div data-role='content'> 
		<div class='ui-corner-all ui-shadow outerDiv'>
		<div class='ui-corner-all ui-shadow innerDiv'> 
		
		<input type='hidden' name='QueimageLocation' value='".$imagFile."'>
		<img src='../admin/uploadedmedia/".$imagFile."' width='100%'>\n<hr class='imgBorder'><br><hr>\n
		<label>".$Address."</label><br><hr>\n
		<input type='hidden' name='address' value='".$Address."'>
		<label>".$desc."</label>\n

		<div data-role='navbar' style='text-align:center'>\n<ul>\n<li><a href='#map-page'> Back</a></li>\n<li>";
		
		$page = $xml->getElementsByTagName( "Page" );
		$numOfpages = sizeof($page);
		echo 'Number of page'.$numOfpages;
		if($numOfpages>1 &&$numOfpages!='')
		{
		$bodycode=$bodycode."<a href ='#page1' rel='external' id='dist'> Next</a> ";
		}
		else{
			$bodycode=$bodycode."<a href ='#infopage' rel='external' id='dist'> Next</a> ";
		}
		
		
		
   $bodycode=$bodycode." </li>\n</ul>\n</div></div></div></div></div><!-- end of detail page -->\n";


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
			$bodycode=$bodycode."<img src='../../uploadedmedia/".$text."' width='100%'>\n<hr class='imgBorder'><hr>\n";
			$xx++;
			}
			
			if($contenttype=="Video"){
			$text=$contents->nodeValue;
			$bodycode=$bodycode."<hr class='imgBorder'>\n<video controls style='max-width: 95%'>\n<source src='../../uploadedmedia/".$text."' type='video/mp4'>\nYour browser does not support the video tag.\n</video>\n<hr class='imgBorder'><hr>\n";
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
			

	if($pagenumber==1 && $pagenumber==$totalpages){
	$bodycode=$bodycode."<div data-role='navbar' style='text-align:center'>\n<ul>\n<li><a href='#detail-page'> Back</a></li>\n";
	$bodycode=$bodycode."<li><a href ='#infopage' rel='external'> Next</a> </li>\n</ul>\n</div>";
				$bodycode=$bodycode."</div></div>\n</div></div>\n";

			}	
	else if($pagenumber==1 && $pagenumber!=$totalpages){
	$bodycode=$bodycode."<div data-role='navbar' style='text-align:center'>\n<ul>\n<li><a href='#detail-page'> Back</a></li>\n";
	$bodycode=$bodycode."<li><a href ='#page".($pagenumber+1)."' rel='external'> Next</a> </li>\n</ul>\n</div>";
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

//write code to file the as HTML file 
$filename="../../../locGuides/".$idd.".html";
$fh = fopen($filename, 'w') or die("can't open file");
fwrite($fh, '');
fwrite($fh, "$bodycode>");
fclose($fh);
return $filename;
}
?>