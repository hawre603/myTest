
 <?php
     // Get lat and long by address         
        //$address = $dlocation; // Google HQ
		$address = "add"; 

        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
		
		PRINT_R($latitude);
	echo "this lng";
		PRINT_R($longitude);

?>

