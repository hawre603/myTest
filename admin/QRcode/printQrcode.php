<?php
	 session_start(); 									//script checks if user 
															//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();
	}
		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print or Donload QR Code Image</title>
<link rel="stylesheet" media="all" type="text/css" href="fancybox.css" />
<script type="text/javascript" src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.js"></script>
<script type="text/javascript" src="jquery.fancybox-1.2.1.pack.js"></script>
<link rel='stylesheet' type='text/css' href='../css/cmsStyling.css'/>

<style type="text/css">
        .DivOne div .tbNav tr td a {
		font-family: Georgia, Times New Roman, Times, serif;
		}
		ul {
			padding: 0;
			border:#EEE 0;
			list-style-type: none;
		}
        .DivOne div .tbNav tr td a {
	font-family: Arial, Helvetica, sans-serif;
}
        </style>


<script type="text/javascript">
$(document).ready(function(){
	$(".promo").fancybox();
});
</script>
</head>
<body>
<!--<a class='promo' href="img/thatagency-full.jpg"><img src="img/thatagency-tile.jpg" alt="THAT Agency - West Palm Beach" border="0" /></a>-->

<div  class='DivOne'>
					<div class='myHeda'>
						Manage Users 
					</div>
				</div>
                
                <div data-role="navbar">
				<table class="tbNav"><tr>
					<td><a href="homeQR.php" class="tbNav">Back</a></td>
					<td><a href="../Home.php" data-ajax='false'>Home</a></td>
					<td><a href="../logout.php">Logout</a></td>
				</tr></table>
			</div></div>
                
				<div data-role="content">
					<div class='DivTwo'>
                    <div class='DivThree'>
                <?php
				include '../scripts/dbCon.php';		//script that opens connection to database
/*Check connection*/ //#BBAE3C;
if (mysqli_connect_errno())
{
	die("Failed to connect to MySQL");
}
$result = mysqli_query($dbCon,"SELECT g.* FROM generated_qrcode g");
echo "<table class='myTable ' align='center'>
		<tr style='background-color:#09F;'>
		<th>Guide</th>
		<th>By</th>						
		<th>Print</th>
		<th>Download</th>
		</tr>";
/*	this loop prints out the guides available on the database with their respective information
	and alternates the color of the table rows for better readability */
$i=1;
while($row = mysqli_fetch_array($result))					
{																
	if (($i % 2) ==0){$color ='#B3D4FD';}//'#EBE5C5';} 
	else{$color='#FEFFFF';}
	echo "<tr style='background-color:".$color."'>";
	echo "<td>".$row['page_title']."</td>";
	echo "<td>" . $row['generated_by'] . "</td>";
	/*the form below uses a submit button to pass the name of a given guide, in order to generate
	for each of them*/
	echo "<td><a class='promo' href='QRImages//".$row['guide_name'].".png'>
	<img src='QRImages/fancybox/printButton.png' width='40' height='35' alt='print' /></a>
	</td>";
	echo "<td><a href='QRImages//".$row['guide_name'].".png' download>
	<img src='QRImages/fancybox/downloadButton.png' width='60' height='35' alt='download'/></a>
	</td>";
	echo "</tr>";
	$i++;
}
echo "</table>";
mysqli_close($dbCon); //close the database connecction 

		?>
        <script type="text/javascript">
        var win=null;
function printIt(printThis)
{
	win = window.open();
	self.focus();
	win.document.open();
	win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
	win.document.write('body, td { font-family: Verdana; font-size: 10pt;}');
	win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
	win.document.write(printThis);
	win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
	win.document.close();
	win.print();
	win.close();
}
</script>
        </div>
    </div>
    </div>
    </div>


</body>
</html>