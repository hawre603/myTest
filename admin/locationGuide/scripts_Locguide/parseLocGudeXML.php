
<?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../../index.php");						//to login page
		exit();	
		}
	?>

<!DOCTYPE html> <html> <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

 <!--Include jQuery and jQuery mobile library      
    <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/>    
   <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/>
              <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>    
         <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script>   
         <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script> 
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
                 <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script> -->
         
        
        
           <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
         <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script> 
<!--        <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> 
-->
             
<!--Include custom CSS style sheets      -->
        <link href="../../css/cmsStyling.css" rel="stylesheet" type="text/css">
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
		 var i=0;

			$(document).ready(function() {
                
            
		 
		 
		 $(".MyDiv").on("click", ".remove", function () {
            $(this).parent('li').remove(); });
			
			
			
			$(".QesPanel").on("click", ".bt1", function () {
            $(this).closest(".pageIn").append("<p>Statement: <input type='text' name='statement"+i+"'><br><button class='deleteCon'> Delete</button></p>"); i++; });
			
			
		
			
			
			$(".QesPanel").on("click", ".bt4", function () {
            $(this).closest(".pageIn").append("<p>Question (Single line text response): <input type='text' name='QuestionType1"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt5", function () {
            $(this).closest(".pageIn").append("<p>Question (Multiple line text response): <input type='text' name='QuestionType2"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
			
			
			$(".QesPanel").on("click", ".bt6", function () {
            $(this).closest(".pageIn").append("<p>Question (Numeric response): <input type='text' name='QuestionType3"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt7", function () {
            $(this).closest(".pageIn").append("<p>Question (Single choice response): <input type='text' name='QuestionType4"+ i +"'><br> Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt8", function () {
            $(this).closest(".pageIn").append("<p>Question (Multiple choice response): <input type='text' name='QuestionType5"+ i +"'><br> Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='opt2"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><br>Option: <input type='text' name='option"+ i +"'><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt9", function () {
            $(this).closest(".pageIn").append("<p>Question (Image response): <input type='text' name='QuestionType6"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
			
			$('.removePage').click(function() {
    $(this).parent('li').remove(); });
			
			
		 });
		
		 		
				 
			</script>  
            
         <title>Edit guide pages</title>
</head> 
         <body bgcolor="#B3D4FD"> 
         <div  class='DivOne' style="background-color:#09F">
				<div class='myHeda' >
					Page Creator
				</div>
			
			<div data-role="navbar">
				<table class="tbNav"><tr>
					<td><a href="../home.php" class="tbNav">Home</a></td>
					<td><a href="howto.php" data-ajax='false'>Help</a></td>
					<td><a href="logout.php">Logout</a></td>
				</tr></table>
			</div></div>
            
         <div  data-role='content' style="width:85%; background-color:#FFF; margin:0 auto" >
				<form action='genxmLocguide.php' method="post">
             	<div class='MyDiv'>
				<?php  //updxmLocguide genxmLocguide.php
				// theses two php files used for create dropdwon list for image and video
				include '../../scripts/addImage.php'; 
				include '../../scripts/addVideo.php';
				
				//check if the selected guide is exit or not
				
				
				echo"<input type='hidden' name='fileName' value='".$_POST['editSelectedGuide']."'>";
		   	   if (file_exists('../../xmlpages/LocationGuideXML/'.$_POST['editSelectedGuide'].'.xml')) 
			   {       
			        $xml = simplexml_load_file('../../xmlpages/LocationGuideXML/'.$_POST['editSelectedGuide'].'.xml');
				} else {   
				  		exit('Failed to open XML file!'); 	
				} 	
				 $count=1; 
				 // reteirve the elment name form xml file 
			    foreach($xml->children() as $child)    { 
				if($child->getName() == 'LocationName')
				{
					echo '<br/>'.$child->getName()."<input type='text' name='LocationName' value='".$child."'>";
				}
				
				else if($child->getName() == 'LocationAddress')
				{
					echo '<br/>'.$child->getName()."<input type='text' name='LocationAddress' value='".$child."'>";
				}
				
				else if($child->getName() == 'LocationImage')
				{
					
					echo '<br/>'.$child->getName();
					selectedXmlImagr("'".$child."'");
				}
				else if($child->getName() == 'LocationDescription')
				{
				echo '<br/>'.$child->getName()."<input type='text'  name='LocationDescription' value='".$child."'>";
				//echo '<br/>'.$child->getName()."<textarea name='location' style='width:300px;' cols='1' rows='3'>'".$child."'</textarea>";//"<input type='text' name='LocationImage' value='".$child."'>";
				
				}
				
				else if($child->getName() == 'Status')
				{
					//check the staus if it is active or not and 'checked' the check box one of them.
					if($child==1)
					{
						$checkedActi='checked';
					}
					else{
						$checkedInac='checked';
					}
                  echo '<p><label><input type="radio" name="chkStatus" value="1" id="chkStatus_0" '.$checkedActi.'>
				  Active</label>';
                  echo'<br><label><input type="radio" name="chkStatus" value="0" id="chkStatus_1" '.$checkedInac.'>
				  Inactive</label><br></p>';
				}
				
				
				$pageNum = 0;
										 
			if($child->getName() == 'Page')   
			 { 	
				foreach($child->attributes() as $key => $value) 
				 { 	
				 	 $pageNum = $value;
					 echo"<ul><li><fieldset><legend>Page:".$value."
					 </legend><input type='hidden' name='pageBeginning".$pageNum."'>"; 			
				}    
			  }   
			  echo"<ul id='sites'>";
			       foreach($child->children() as $subchild)     
					{ 
					echo"<li>"; 
		      	 
			   
			   foreach($subchild->attributes() as $key => $value) {
				  	
			   if($key =='type') 	
					{  
					//the following if statments tells the type of the quetion and give a proper output to the users
					if( $value=='Statement'){ 
					echo  "Statement:<input type='text' value='". $subchild ."' name='Statement". $count."'><br/>";
					$count++; 
					}
					else if( $value=='Image'){
					//echo $subchild;
					selectedImage("'".$subchild."'",$count);
					//<input type='text' value='". $subchild ."' name='Image". $count."'><br/>"; 
					$count++;
					}
					else if( $value=='Video'){
						selectedVideo($selected,$count);
					//echo  "Video:<input type='text' value='". $subchild ."' name='Video". $count."'><br/>"; 
					$count++;
					}
					else if( $value=='Question Type1'){
					echo  "Question With Text Response (Single Line):<input type='text' value='". $subchild ."'
					 name='QuestionType1". $count."'><br/>"; 
					$count++;
					}
					else if( $value=='Question Type2'){
					echo  "Question With Text Response (Multiple Line):<input type='text' value='". $subchild ."'
					 name='QuestionType2". $count."'><br/>";
					$count++; 
					}
					else if( $value=='Question Type3'){
					echo  "Question With Numeric Response:<input type='text' value='". $subchild ."' 
					name='QuestionType3". $count."'><br/>"; 
					$count++;
					}
					else if( $value=='Question Type4'){
			        echo"Question With Multiple Options (Single Choice):<input type='text' value='". $subchild ."'
					 name='QuestionType4". $count."'><br/>"; 
					$count++;
					}
					else if( $value=='Question Type5'){
					echo"Question With Multiple Options (Multiple Choice):<input type='text' value='". $subchild ."'
					 name='QuestionType5". $count."'><br/>"; 
					$count++;
					}
					else if( $value=='Question Type6'){
					echo  "Question With Image Upload Response:<input type='text' value='". $subchild ."'
					 name='QuestionType6". $count."'><br/>"; 
					$count++;
					}
					
					
				} 	
			else {
				//read the attributes one by one and give them an input text for user to change the cpntent.  
				//echo "Key ".$key." Value<input type='text' name='".$key."' value='". $value ."'> ".$value.'<br/>';
				$count=$count-1; 
				 echo $key."<input type='text' name='".$key.$count."' value='". $value ."'><br/>"; 
				 $count++;
				}            
							 }
			echo"<input type='button' class='remove' value='remove'></li>"; 
			
			} 	
		  	 	
			  
		  if($child->getName() == 'Page')
		  {
		  echo "<li><div class='page' style='position:relative;background-color:#FFFFFF;width:98%;height:350px;margin:0 auto;'>\n ";
			 echo "<div style='background-color:#B3D4FD;  width: 100%; margin:0 auto;'>\n ";
			 echo "<h3 style='font-family:Arial, Helvetica, sans-serif; text-align:left'>\n ";
			 echo "Add New Question\n ";
			 echo "</h3>\n ";
			 echo "</div>\n";
			 echo "<div class='pageIn' style='overflow:scroll; overflow-x: hidden ;width:100%; height:81%; margin:0 auto;'>\n";
			 echo "<div class='QesPanel' style='width:45%; float:right;'>\n";
			 echo "<input type='button' class='bt1' value='AddS'>Statement<br>\n";
			 echo "<input type='button' class='bt2' value='Add'>Image<br>\n";
			 echo "<input type='button' class='bt3' value='add'>Video<br>\n";
			 echo "<input type='button' class='bt4' value='Add'>Question With Text Response (Single Line)<br>\n";
			 echo "<input type='button' class='bt5' value='Add'>Question With Text Response (Multiple Line)<br>\n";
			 echo "<input type='button' class='bt6' value='add'>Question With Numeric Response<br>\n";
			 echo "<input type='button' class='bt7' value='add'>Question With Multiple Options (Single Choice)<br>\n";
			 echo "<input type='button' class='bt8' value='add'>Question With Multiple Options (Multiple Choice)<br>
			 \n";
			 echo "<input type='button' class='bt9' value='add'>Question With Image Upload Response<br>\n";
			 echo "</div>\n";
			 echo "</div>\n";
			 echo "<br>\n";
			 echo "<div>\n";
			 echo "<br>\n";
			 echo "</div>\n";
			 echo "<input type='hidden' name='pageEnd".$pageNum."'>\n";
			 echo "</div>";
			 echo"</li></ul></fieldset><input type='button' class='removePage' value='remove page'></li></ul><br>";
		  }
		  }
		    ?> 
             </div>	
            
             <input type="submit" name="UpdateGuidebtn" value="Update Guide">
                 
            </form>
            </div>
         </body>
         </html>
         

