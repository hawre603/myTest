<?php
															//script checks if user 
		session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();}
		
	if (!isset($_POST['viewSubmission'])) {					//if not, user is redirected
		header("Location: navigationfault.php");						//to login page
		}
	
?>
<!DOCTYPE html>
   <head>
		<title>View Submissions</title>
		 <!--manage web page width to fit device-->
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <!--Include jQuery and jQuery mobile library -->
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/> 
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
        <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script> 

        <!--Include custom CSS style sheets-->
        <link rel='stylesheet' type='text/css' href='../css/cmsStyling.css'/>
		
		<!--Disable ajax on the page-->
		<script type="text/javascript">							
			$(document).bind("mobileinit", function () {				
				$.mobile.ajaxEnabled = false;
					});
		</script>
	</head>
	
	<body>
	<div  class='DivOne'>
			<div  class='myHeda'>
				View Submission 		
			</div>
		</div>
		
		<?php
			viewXML($_POST['viewSubmission'], $_POST['guidename']);
			function viewXML($name, $gd)
			{
			
			
			$fname="../xmlsubmissions/".$gd."/".$name;
			if (!(file_exists($fname))){
				echo'<script type="text/javascript">  alert("Cannot open the file!!");  history.back();</script> ';
			}
			$xml = new XMLReader;
			$xml->open($fname);

			$xml->read();
			echo "<table style='border:1px solid #FEFFFF; width:100%; background-color:#FEFFFF; text-align:center' >";
			while ($xml->read()) {

					if ($xml->nodeType == XMLReader::ELEMENT) {
						if (strpos($xml->name,'Ansimage') !== false) {
							$xml->read();
							if(($xml->value)!=""){
							echo "<tr><td><img src='";print $xml->value; 
								echo"' style='max-width:15%'> </td></tr>";
							continue;}
							}
						
						if (strpos($xml->name,'guide') !== false) {
							echo "<tr><td style='background-color:#06F; color:#FFF; padding:5px; font-family: cursive; text-align:center'>                            Questionaire: ";		
							continue;
							}
							if (strpos($xml->name,'adress') !== false) {
							echo "<tr><td style='background-color:#06F; color:#FFF padding:5px; font-family:'Times New Roman', Times, serif; font-style:oblique; text-align:center'>   Address:";	
							
							continue;
							}
							
							if (strpos($xml->name,'saveEmail') !== false) {
									
							continue;
							}
					
						if (strpos($xml->name,'Que') !== false) {
							$xml->read();
							if(($xml->value)!=""){
							echo "<tr style='background-color:#66CCFF'><td style='padding:5px; font-family: verdana'>";print $xml->value; 
								echo" </td></tr>";
							continue;}
							}

						if (strpos($xml->name,'Ans') !== false) {	
							$xml->read();
							if(($xml->value)!=""){
							echo "<tr><td style='padding:5px; font-family: verdana'>";print $xml->value; 
								echo" </td></tr>";
							continue;}
							}
						
						if (strpos($xml->name,'POSTCODE') !== false) {	
							echo "<tr style='background-color:#06F;'><td style='color:#FFF padding:5px; font-family:'Times New Roman', Times, serif; font-style:oblique; text-align:center'>                            Postcode:";		
							continue;
							}
						
						if (strpos($xml->name,'AGE') !== false) {	
							echo "<tr style='background-color:#06F;'><td style='color:#FFF padding:5px; font-family:'Times New Roman', Times, serif; font-style:oblique; text-align:center'>                            Age:";		
							continue;
							}

					} else if ($xml->nodeType == XMLReader::TEXT) {
								
							print $xml->value;
							echo "</td></tr>";}
					

			}
			echo "</table>";
			
			
}			?>
		</body>
	</html>
		