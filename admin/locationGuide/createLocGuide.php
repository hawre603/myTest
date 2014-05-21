 <?php
														//script checks if user 
	session_start();									//is logged into the system
	if (!isset($_SESSION['username'])) {					//if not, user is redirected
		header("Location: ../index.php");						//to login page
		exit();
	}
?>
<!DOCTYPE html>
<html>
     <title>Creat Location Guide</title>
		<!--manage web page width to fit device-->
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        
        <!--Include jQuery and jQuery mobile library -->
        <link rel='stylesheet' href='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css'/> 
        <script src='http://code.jquery.com/jquery-1.9.1.min.js'></script> 
        <script src='http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js'></script> 
        <!--Include custom CSS style sheets-->
        <link rel='stylesheet' type='text/css' href='../css/cmsStyling.css'/>
        
        
        
         <script>
		 var i=0;
        $(document).on('pageinit','#index', function(){
			$('#addP').click(function(){
			$.extend(  $.mobile , {
     		 ajaxFormsEnabled: false
 				 });
			<!--This appends a div with buttons that also appends other html content-->
   $('.pageSheet').append("<div class='page' style='position:relative;background-color:#FFFFFF;width:98%;height:350px;margin:0 auto;'>\n "
                 + "<div style='background-color:#EBE5C5;  width: 100%; margin:0 auto;'>\n "
                 + "<h3 style='font-family:cursive; text-align:center'>\n "
                 + "Page Beginning\n "
                 + "</h3>\n "
                 + "<input type='hidden' name='pageBeginning"+ i +"'>\n "
                 + "</div>\n"
                 + "<div class='pageIn' style='overflow:scroll; overflow-x: hidden ;width:100%; height:81%; margin:0 auto;'>\n"
                 + "<div class='pageInner'style='width:43%; float:right;'>\n"
                 + "<button type='button' class='bt1'>Add</button>Statement<br>\n"
                 + "<button type='button' class='bt2'>Add</button>Image<br>\n"
                 + "<button type='button' class='bt3'>Add</button>Video<br>\n"
                 + "<button type='button' class='bt4'>Add</button>Question With Text Response (Single Line)<br>\n"
                 + "<button type='button' class='bt5'>Add</button>Question With Text Response (Multiple Line)<br>\n"
                 + "<button type='button' class='bt6'>Add</button>Question With Numeric Response<br>\n"
                 + "<button type='button' class='bt7'>Add</button>Question With Multiple Options (Single Choice)<br>\n"
                 + "<button type='button' class='bt8'>Add</button>Question With Multiple Options (Multiple Choice)<br>\n"
                 + "<button type='button' class='bt9'>Add</button>Question With Image Upload Response<br>\n"
                 + "</div>\n"
                 + "</div>\n"
                 + "<div  style='background-color:#EBE5C5;  width: 98%; height:43px; position: absolute; bottom: 0px;'>\n"
                 + "<h3 style='font-family:cursive'>\n"
                 + "Page End\n"
                 + "<button class='delete' style='float:right'> Delete Page</button>\n"
                 + "</h3>\n"
                 + "</div>\n"
                 + "<br>\n"
                 + "<div>\n"
                 + "<br>\n"
                 + "</div>\n"
                 + "<input type='hidden' name='pageEnd"+ i +"'>\n"
                 + "</div>");i++});
									   
									   
		  $('#addPE').click(function(){
			<!--This appends a div with buttons that also appends other html content, for addpage button number 2-->
                 $('.pageSheet').append("<div class='page ' style='position:relative;background-color:#FFFFFF;width:98%;height:350px;margin:0 auto;'>\n\
		<div style='background-color:#B3D4FD;  width: 98%; margin:0 auto;'>\n\
			<h3 style='font-family:Arial, Helvetica, sans-serif; text-align:center'>\n\
				Page Beginning\n\
			</h3>\n\
			<input type='hidden' name='pageBeginning"+ i +"'>\n\
		</div>\n\
		<div class='pageIn' style='overflow:scroll; overflow-x: hidden ;width:100%; height:81%; margin:0 auto;'>\n\
		<div class='pageInner'style='width:43%; float:right;'>\n\
			<button type='button' class='bt1'>Add</button>Statement<br>\n\
			<button type='button' class='bt2'>Add</button>Image<br>\n\
			<button type='button' class='bt3'>Add</button>Video<br>\n\
			<button type='button' class='bt4'>Add</button>Question With Text Response (Single Line)<br>\n\
			<button type='button' class='bt5'>Add</button>Question With Text Response (Multiple Line)<br>\n\
			<button type='button' class='bt6'>Add</button>Question With Numeric Response<br>\n\
			<button type='button' class='bt7'>Add</button>Question With Multiple Options (Single Choice)<br>\n\
			<button type='button' class='bt8'>Add</button>Question With Multiple Options (Multiple Choice)<br>\n\
			<button type='button' class='bt9'>Add</button>Question With Image Upload Response<br>\n\
			</div>\n\
		</div>\n\
		<div  style='background-color:#B3D4FD;  width: 98%; height:43px; position: absolute; bottom: 0px;'>\n\
			<h3 style='font-family:Arial, Helvetica, sans-serif'>\n\
				Page End\n\
				<button class='delete' style='float:right'> Delete Page</button>\n\
			</h3>\n\</div>\n\<br>\n\<div>\n\<br>\n\</div>\n\
			<input type='hidden' name='pageEnd"+ i +"'>\n\
			</div>");i++});
									   
		<!-- Removes content appended within paragraph tags within appended pages-->							   
        $(".pageSheet").on("click", ".deleteCon", function () {
            $(this).closest("p").remove(); });
        
		<!-- Removes pages appended-->
        $(".pageSheet").on("click", ".delete", function () {
            $(this).closest(".page").remove(); });
        
         <!-- 9 append functions used to append nine content types-->   
        $(".pageSheet").on("click", ".bt1", function () {
            $(this).closest(".pageIn").append("<p>Statement: <input type='text' name='statement"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++; });
			
			
			var imgs = $.get('scripts_Locguide/Loc_photo.php', function(){
    			  alret('success');
				});
			
        
        $(".pageSheet").on("click", ".bt4", function () {
            $(this).closest(".pageIn").append("<p>Question (Single line text response): <input type='text' name='qtypeone"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".pageSheet").on("click", ".bt5", function () {
            $(this).closest(".pageIn").append("<p>Question (Multiple line text response): <input type='text' name='qtypetwo"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".pageSheet").on("click", ".bt6", function () {
            $(this).closest(".pageIn").append("<p>Question (Numeric response): <input type='text' name='qtypethree"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".pageSheet").on("click", ".bt7", function () {
            $(this).closest(".pageIn").append("<p>Question (Single choice response): <input type='text' name='qtypefour"+ i +"'><br> Option: <input type='text' name='opt1"+ i +"1'><br>Option: <input type='text' name='opt1"+ i +"2'><br>Option: <input type='text' name='opt1"+ i +"3'><br>Option: <input type='text' name='opt1"+ i +"4'><br>Option: <input type='text' name='opt1"+ i +"5'><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".pageSheet").on("click", ".bt8", function () {
            $(this).closest(".pageIn").append("<p>Question (Multiple choice response): <input type='text' name='qtypefive"+ i +"'><br> Option: <input type='text' name='opt2"+ i +"1'><br>Option: <input type='text' name='opt2"+ i +"2'><br>Option: <input type='text' name='opt2"+ i +"3'><br>Option: <input type='text' name='opt2"+ i +"4'><br>Option: <input type='text' name='opt2"+ i +"5'><button class='deleteCon'> Delete</button></p>"); i++;});
        
        $(".pageSheet").on("click", ".bt9", function () {
            $(this).closest(".pageIn").append("<p>Question (Image response): <input type='text' name='qtypesix"+ i +"'><br><button class='deleteCon'> Delete</button></p>"); i++;});
        
        
         
            });

		</script>
		
		 </head>
		<body data-twttr-rendered="true">
        <div data-role='page' id='index'>
			<div  class='DivOne'>
				<div class='myHeda' >
					Page Creator
				</div>
			</div>
			<div data-role="navbar">
				<ul>
               		 <li><a href="homeLocation.php">Back</a></li>
					<li><a href="../Home.php">Home</a></li>
                    <li><a href='#' id='addP'>Add Page</a></li>
					<li><a href="../howto.php" data-ajax='false'>Help</a></li>
					<li><a href="../logout.php">Logout</a></li>
				</ul>
			</div>
			<div data-role='content' style="width:85%; margin:0 auto; background:#EEE" >
          	<form action="scripts_Locguide/genxmLocguide.php" data-ajax="false" method="post" name="locForm">
                
                <label for="LocationName"> Location Name</label>
                <input name="LocationName" type="text" required>
                <label for="LocationAddress"> Location Address</label>
                <input name="LocationAddress" type="text" required>
                <label  for="LocationImage">Location Image:</label>
                <select name='LocationImage'>
				<?php include '../scripts/addImage.php'; addImg(); ?>
                </select>
                <label for="LocationDescription"> Location Description</label>
                <textarea name="LocationDescription" cols="1" rows="3" ></textarea>
                <p>
                  <label>
                    <input type="radio" name="chkStatus" value="1" id="chkStatus_0" checked>
                    Active</label>
                  <br>
                  <label>
                    <input type="radio" name="chkStatus" value="0" id="chkStatus_1">
                    Inactive</label>
                  <br>
                </p>
            <div class='pageSheet'>
            </div>    
            <h4></h4><div data-role='navbar'>
                    <ul>          
                    <li><a href='#' class='easyui-linkbutton' id='addPE'>Add HTML5 Web Page</a></li>
                    </ul>
                </div>
                     
                <input  name='createGuide' type="submit" value="Create Locatio Guide" >				
				</form>
			</div>
            </div>
    </body>
</html>