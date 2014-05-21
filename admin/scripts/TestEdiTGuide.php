<!DOCTYPE html> <html> <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

 <!--Include jQuery and jQuery mobile library      
    <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/>    
   <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile.structure-1.3.1.min.css'/>
              <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script>    
         <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script>   -->
          <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
        <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
         <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>     
<!--Include custom CSS style sheets      -->
        <link href="../css/cmsStyling.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        .DivOne div .tbNav tr td a {
		font-family: Georgia, Times New Roman, Times, serif;
		}
		ul {
			padding: 0;
			list-style-type: none;
		}
        </style>
        <script type="text/javascript">
		 var i=0;

			$(document).ready(function() {
                
            
		 
		 
		 $(".MyDiv").on("click", ".remove", function () {
            $(this).parent('li').remove(); });
			
			
			
			$(".QesPanel").on("click", ".bt1", function () {
            $(this).closest(".pageIn").append("<p>Statement: <input type='text' name='statement'><br><button class='deleteCon'> Delete</button></p>"); i++; });
			
			
			
			$(".QesPanel").on("click", ".bt4", function () {
            $(this).closest(".pageIn").append("<p>Question (Single line text response): <input type='text' name='Question Type1"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt5", function () {
            $(this).closest(".pageIn").append("<p>Question (Multiple line text response): <input type='text' name='Question Type2"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
			
			
			$(".QesPanel").on("click", ".bt6", function () {
            $(this).closest(".pageIn").append("<p>Question (Numeric response): <input type='text' name='Question Type3"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt7", function () {
            $(this).closest(".pageIn").append("<p>Question (Single choice response): <input type='text' name='Question Type4"+ i +"'><br> Option: <input type='text' name='opt1"+ i +"1'><br>Option: <input type='text' name='opt1"+ i +"2'><br>Option: <input type='text' name='opt1"+ i +"3'><br>Option: <input type='text' name='opt1"+ i +"4'><br>Option: <input type='text' name='opt1"+ i +"5'><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt8", function () {
            $(this).closest(".pageIn").append("<p>Question (Multiple choice response): <input type='text' name='Question Type5"+ i +"'><br> Option: <input type='text' name='opt2"+ i +"1'><br>Option: <input type='text' name='opt2"+ i +"2'><br>Option: <input type='text' name='opt2"+ i +"3'><br>Option: <input type='text' name='opt2"+ i +"4'><br>Option: <input type='text' name='opt2"+ i +"5'><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".QesPanel").on("click", ".bt9", function () {
            $(this).closest(".pageIn").append("<p>Question (Image response): <input type='text' name='Question Type6"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
			
			$('.removePage').click(function() {
    $(this).parent('li').remove(); });
			
			
		 });
		
		 		
				 
			</script>  
            
         <title>Edit guide pages</title>
</head> 
         <body bgcolor="#999999"> 
         <div  class='DivOne'>
				<div class='myHeda' >
					Page Creator
				</div>
			
			<div data-role="navbar">
				<table class="tbNav"><tr>
					<td><a href="../homeExhibit.php">Home</a></td>
                    <td><a href='#' id='addP'>Add Page</a></td>
					<td><a href="howto.php" data-ajax='false'>Help</a></td>
					<td><a href="logout.php">Logout</a></td>
				</tr></table>
			</div></div>
         
         <div  data-role='content' style="width:85%; background-color:#FFF; margin:0 auto" >
				<form action='updatexmlGuide.php' method="post">
             
             	<div class='MyDiv'>
				<?php        
		   	   if (file_exists('../xmlpages/hawreGuide2014030516131719.xml')) 
			   {       
			         $xml = simplexml_load_file('../xmlpages/hawreGuide2014030516131719.xml');
				} else {   
				  		exit('Failed to open XML file!'); 	
				} 	
			foreach($xml->children() as $child)    { 
				//echo $child->getName() .": " . $child . "<br>";  
				if($child->getName() == 'guideTitle')
				{
					echo '<br/>'.$child->getName()."<input type='text' name='guideTitle' value='".$child."'>";
				}
				$pageNum = 0;
										 
			if($child->getName() == 'Page')   
			 { 	
				foreach($child->attributes() as $key => $value) 
				 { 	
				  $pageNum = $value;
					echo"<ul><li><fieldset><legend>Page:".$value."</legend>"; 			
					 
		  	     }    
			  }   
			  echo"<ul id='sites'>";
			       foreach($child->children() as $subchild)     
												{ 
														echo"<li>"; 
		      	 
			   
			   foreach($subchild->attributes() as $key => $value) { 	
			if($key =='type') 	
					{  
					//echo  "Statement:<input type='text' value='". $subchild ."' name='". $subchild ."'>"; 

					//echo "Key ".$key." Value ".$value.'<br/>';
					//the following if statments tells the type of the quetion and give a proper output to the users
					if( $value=='Statement'){ 
					echo  "Statement:<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					else if( $value=='Question Type1'){
					echo  "Question With Text Response (Single Line):<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					else if( $value=='Question Type2'){
					echo  "Question With Text Response (Multiple Line):<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					else if( $value=='Question Type3'){
					echo  "Question With Numeric Response:<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					else if( $value=='Question Type4'){
			        echo"Question With Multiple Options (Single Choice):<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					else if( $value=='Question Type5'){
					echo"Question With Multiple Options (Multiple Choice):<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					else if( $value=='Question Type6'){
					echo  "Question With Image Upload Response:<input type='text' value='". $subchild ."' name='". $subchild.$pageNum ."'><br/>"; 
					}
					
				} 	
			else {
				//read the attributes one by one and give them an input text for user to change the cpntent.  
				//echo "Key ".$key." Value<input type='text' name='".$key."' value='". $value ."'> ".$value.'<br/>'; 
				 echo $key."<input type='text' name='".$key."' value='". $value ."'><br/>"; 
				}            
							 }
			echo"<input type='button' class='remove' value='remove'></li>"; 
			
			} 	
		  	 	
			  
			  if($child->getName() == 'Page')
			  {
			  echo "<li><div class='page' style='position:relative;background-color:#FFFFFF;width:98%;height:350px;margin:0 auto;'>\n ";
                 echo "<div style='background-color:#EBE5C5;  width: 100%; margin:0 auto;'>\n ";
                 echo "<h3 style='font-family:cursive; text-align:left'>\n ";
                 echo "Add New Question\n ";
                 echo "</h3>\n ";
                 echo "<input type='hidden' name='pageBeginning'>\n";
                 echo "</div>\n";
                 echo "<div class='pageIn' style='overflow:scroll; overflow-x: hidden ;width:100%; height:81%; margin:0 auto;'>\n";
                 echo "<div class='QesPanel' style='width:43%; float:right;'>\n";
                 echo "<input type='button' class='bt1' value='AddS'>Statement<br>\n";
                 echo "<input type='button' class='bt2' value='Add'>Image<br>\n";
                 echo "<input type='button' class='bt3' value='add'>Video<br>\n";
                 echo "<input type='button' class='bt4' value='Add'>Question With Text Response (Single Line)<br>\n";
                 echo "<input type='button' class='bt5' value='Add'>Question With Text Response (Multiple Line)<br>\n";
                 echo "<input type='button' class='bt6' value='add'>Question With Numeric Response<br>\n";
                 echo "<input type='button' class='bt7' value='add'>Question With Multiple Options (Single Choice)<br>\n";
                 echo "<input type='button' class='bt8' value='add'>Question With Multiple Options (Multiple Choice)<br>\n";
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
                            <input type="submit" name="createGuide" value="Update Guide">
                            <input type="reset" name="cancel" value="Cancel">
                            
                  </form>
			</div>
         </body>
         </html> 
         

