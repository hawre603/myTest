<!DOCTYPE html>
    <head>
        <title>Lost Worlds Trail</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
        <link rel='stylesheet' type='text/css' href='appStyling.css'/>  
        
    </head>
	
    <body>
		<div  data-role="header">
			<a href="../index.php" data-iconpos="notext" data-icon="home"></a>
			<h3 style="font-family:cursive">Your Completed Guide</h3>
		</div>

	
	<div data-role='content'>
<?php

// For every element in the submission xml file, generate the appropriate html code, arranging question and answers in tabular form -->
// store generated code in a string vaiable -->

function viewSubmission($name, $gname)
{
$fname="../admin/xmlsubmissions/".$gname."/".$name;
$guideSummary="";
$xml = new XMLReader;
$xml->open($fname);

$xml->read();
$guideSummary=$guideSummary. "<table align='center' style='border:1px solid #FEFFFF; text-align:center; width:95%' >";
while ($xml->read()) {

        if ($xml->nodeType == XMLReader::ELEMENT) {
			if (strpos($xml->name,'Ansimage') !== false) {
				$xml->read();
				if(($xml->value)!=""){
				$guideSummary=$guideSummary. "<tr><td style='background-color:#FFFFFF; padding:5px'><img src='";
				$guideSummary=$guideSummary. "".$xml->value; 
				$guideSummary=$guideSummary."' style=' max-width:85%'> </td></tr>";
				continue;}
				}
			
			if (strpos($xml->name,'guide') !== false) {
				$guideSummary=$guideSummary. "<tr><td style='background-color:#26262c; padding:5px; font-family: cursive; color:white'> Location Guide Title: ";		
				continue;
				}
				
				if (strpos($xml->name,'address') !== false) {
				$xml->read();
				if(($xml->value)!=""){
				$guideSummary=$guideSummary. "<tr style='background-color:#D0D0D0'><td style='padding:5px; font-family: verdana'>";
				$guideSummary=$guideSummary. "".$xml->value; 
				$guideSummary=$guideSummary." </td></tr>";
				continue;}
				}
		
			if (strpos($xml->name,'Que') !== false) {
				$xml->read();
				if(($xml->value)!=""){
				$guideSummary=$guideSummary. "<tr style='background-color:#D0D0D0'><td style='padding:5px; font-family: verdana'>";
				$guideSummary=$guideSummary. "".$xml->value; 
				$guideSummary=$guideSummary." </td></tr>";
				continue;}
				}

			if (strpos($xml->name,'Ans') !== false) {	
				$xml->read();
				if(($xml->value)!=""){
				$guideSummary=$guideSummary. "<tr><td style='background-color:#FFFFFF; padding:5px; font-family: verdana'>";
				$guideSummary=$guideSummary. "".$xml->value; 
				$guideSummary=$guideSummary." </td></tr>";
				continue;}
				}
			
			if (strpos($xml->name,'POSTCODE') !== false) {	
				$guideSummary=$guideSummary. "<tr style='background-color:#26262c; padding:5px; font-family: cursive; color:white'><td style='padding:5px; font-family: cursive'> Postcode:";		
				continue;
				}
			
			if (strpos($xml->name,'AGE') !== false) {	
				$guideSummary=$guideSummary. "<tr style='background-color:#26262c; padding:5px; font-family: cursive; color:white'><td style='padding:5px; font-family: cursive'> Age:";		
				continue;
				}

        } else if ($xml->nodeType == XMLReader::TEXT) {
				$guideSummary=$guideSummary. "".$xml->value; 
				$guideSummary=$guideSummary. "</td></tr>";}
        

}
$guideSummary=$guideSummary. "</table>";
echo $guideSummary;									//print out submission summary in tabular form
return $guideSummary;								//return submission summary variable to be sent as email
}


?>
</div>
</body>
</html>