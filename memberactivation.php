
<?php
	include"config/connect.php";
	
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<title>VIC Nursing Agency</title>
<meta name="author" content="Themezinho">
<meta name="description" content="">
<meta name="keywords" content="">

<!-- SOCIAL MEDIA META -->
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:site_name" content="">
<meta property="og:title" content="">
<meta property="og:type" content="website">
<meta property="og:url" content="">

<!-- TWITTER META -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@themezinho">
<meta name="twitter:creator" content="@themezinho">
<meta name="twitter:title" content="Medicina">
<meta name="twitter:description" content="">
<meta name="twitter:image" content="">


<!-- FAVICON FILES -->
<link href="ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
<link href="ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
<link href="ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
<link href="ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon-precomposed">
<link href="ico/favicon.png" rel="shortcut icon">
<style>
body { padding-top:30px; }
.form-control { margin-bottom: 10px; }
</style>
<!-- CSS FILES -->
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/jquery.fancybox.css" rel="stylesheet">
<link href="css/owl.carousel.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet" type="text/css"  />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<noscript>
<link rel="stylesheet" type="text/css" href="css/styleNoJS.css" />
</noscript>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head><body>
<?php include'header.php';?>



<section class="latest-news">
  <div class="container" style="background-image:url(images/homeBG.jpg);width: 100%;">
    <div class="row" >
      <div class="col-xs-12 text-center">
        
        <div class="container">
    <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 well well-sm" align="center" style=" margin-top: 34px;">  
		<?php
		if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'staff')
		{
			mysql_query("UPDATE hr_staff_registration SET EmailVerification = 'Yes' WHERE EmailId = '".base64_decode($_REQUEST['email'])."'");
		?>
        <legend>Your account activate successfully. Please <a href="login1.php?email=<?=$_REQUEST['email'];?>">click here</a> and login.</legend>
        <?php
		}elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'user')
		{
			mysql_query("UPDATE hr_user_registration SET EmailVerification = 'Yes' WHERE EmailId = '".base64_decode($_REQUEST['email'])."'");
		?>
        <legend>Your account activate successfully. Please <a href="login.php?email=<?=$_REQUEST['email'];?>">click here</a> and login.</legend>
        <?php
		}
		
		
		?>
          
        
        </div>
    </div>
</div>
        <!-- end title-box --> 
      </div>
      <!-- end col-12 -->
      
      <!-- end col-6 -->
       
      <!-- end col-6 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<!-- end section -->

<!-- end footer-bar -->
<?php include'footer.php';?>
<!-- end footer --> 

<!-- form copy***************************************************** -->
  <!--  ********************************************************validation*******************************************************-->
      <script>
function myFunction() {
var fname = document.getElementById("fname").value;
var lname = document.getElementById("lname").value;
var address = document.getElementById("address").value;
var mail = document.getElementById("mail").value;

if (fname=='')
{
document.getElementById("error_name").innerHTML="Enter the First Name";
document.getElementById("name").style.border="2px solid red";
return false;
}
if (lname=='')
{
document.getElementById("error_lname").innerHTML="Enter the Last Name";
document.getElementById("lname").style.border="2px solid red";
return false;
}
if (address=='')
{
document.getElementById("error_address").innerHTML="Enter the address";
document.getElementById("address").style.border="2px solid red";
return false;
}
if (mail=='')
{
document.getElementById("error_mail").innerHTML="Enter the Email";
document.getElementById("mail").style.border="2px solid red";
return false;
}             


 
var password = document.getElementById("password").value;
var password1 = document.getElementById("password1").value;
if(password=='')
{

document.getElementById('error_password').innerHTML="Mandetory Field";
document.getElementById("password").style.border="2px solid red";
document.getElementById('error_password1').innerHTML="Mandetory Field";
document.getElementById("password1").style.border="2px solid red";
return false;

}



}



function checkEmail()
{
//alert('check');
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if(!filter.test(document.getElementById("mail").value)) {
document.getElementById("mail").value="";
//alert('Please provide a valid email address');
document.getElementById("check").innerHTML="Please provide a valid email address!";
document.getElementById("mail").style.border="1px solid black";
//email.focus;
return false;
}
else{
var mail = document.getElementById('mail').value;
//alert(mail);
	 $.ajax({
          type: 'POST',
          url: 'emailcheck1.php',  async:false,
          data: "mail="+mail,		  
          success: function (response) {			   
         //alert(response);
         if(response !=""){
         $("#mail").val('');
         $("#check").html(response);
         }  
         else if(response ==""){
         //$("#email").val('');
         $("#check").html(response);
         }  
                                        }
    });
return false;    
}
}
/* validation for sidebar reservation form**/



function checkName1(evt)
{
var charCode=(evt.which)?evt.which:event.keyCode
if((charCode<65||charCode>90)&&(charCode<96||charCode>122)&&(charCode!=32)&& charCode!=8)
{
//alert("Only Characters are Allowed");
document.getElementById("error_fname").innerHTML="Only Characters are Allowed!";
document.getElementById("fname").style.border="2px solid red";
return false;
}
else{
document.getElementById("error_fname").innerHTML="";
document.getElementById("fname").style.border="";    
}
}

function checkName2(evt)
{
var charCode=(evt.which)?evt.which:event.keyCode
if((charCode<65||charCode>90)&&(charCode<96||charCode>122)&&(charCode!=32)&& charCode!=8)
{
//alert("Only Characters are Allowed");
document.getElementById("error_lname").innerHTML="Only Characters are Allowed!";
document.getElementById("lastname").style.border="2px solid red";
return false;
}
else{
document.getElementById("error_lname").innerHTML="";
document.getElementById("lname").style.border="";    
}
}




function passwordCheck()
{
var password = document.getElementById("password").value;
var password1 = document.getElementById("password1").value;
if (password != password1) 

{
//  alert("Passwords Do not match");
document.getElementById("password").style.border = "2px solid red";

document.getElementById("password1").style.border = "2px solid red";
document.getElementById("password1").value="";
document.getElementById('error_password1').innerHTML="Password Mismatch";
return false;

}
else{
document.getElementById('error_password1').innerHTML="";

}
}








</script>
<style>
    .red{
        color:red;
        
}
    
</style>
     <!-- ***********************************************************validation ************************************************************-->
<!-- ****************************************************************** end -->
</body>


</html>