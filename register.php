
<?php
	include"config/connect.php";
	
	//Registration
	 if($_POST['submit']=="Signup Now") {
		
		
	
						//Registration No.
			   /*$timezone = "Asia/Calcutta";
				if (function_exists('date_default_timezone_set'))
					date_default_timezone_set($timezone);*/
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date('d-m-Y g:i:s a');
				$usercreationdate = date('Y-m-d');
				/* unicId */
				/*$prefix = "USR" . date("y") . date("m");
				$pl = strlen($prefix);
				$ql = $pl + 1;
				$rn = "SELECT MAX(SUBSTR(RegistrationNo,$ql)) FROM " . TABLE_PREFIX . "user_registration where RegistrationNo like '%$prefix%'";
				$res_rn = mysql_query($rn);
				$row_rn = mysql_fetch_array($res_rn);
				$id = $row_rn['0'];
				$id = $id + 1;
				$leadingzeros = '00000';
				$RegistrationNo = $prefix . substr($leadingzeros, 0, (-strlen($id))) . $id;*/
				$year = date('Y');
				$fetId = mysql_fetch_array(mysql_query("SELECT * FROM staff_cliend_id WHERE id = '2'"));
				if($year == $fetId['year'])
				{
					$RegistrationNo = $fetId['lastId'] + 1;
					$update = mysql_query("UPDATE staff_cliend_id SET lastId = '".$RegistrationNo."' WHERE id = '2'");
				}else{
					$lastId = $year.'000';
					$update = mysql_query("UPDATE staff_cliend_id SET year = '".$year."', lastId = '".$lastId."' WHERE id = '2'");
					$fetId = mysql_fetch_array(mysql_query("SELECT * FROM staff_cliend_id WHERE id = '2'"));
					$RegistrationNo = $fetId['lastId'] + 1;
					$update = mysql_query("UPDATE staff_cliend_id SET lastId = '".$RegistrationNo."' WHERE id = '2'");
					
				}
				
				
						           	
				$fname = $_POST['fname'];
				$lname = $_REQUEST['lname'];
				$businessName = addslashes($_REQUEST['business_name']);
				$address=addslashes($_POST['address']);
				$phone = $_REQUEST['phone'];
				$username = $_REQUEST['username'];
				$email =$_POST['mail'];
				$password = $_POST['Password'];
				
				//$phone = $_REQUEST['phone'];
				//$address = addslashes($_REQUEST['address']);
				
				// 13 Digit Random number generate function
				function randomPrefix($length) 
				{ 
				$random= "";
				srand((double)microtime()*1000000);
				
				$data = "AbcDE123IJKLMN67QRSTUVWXYZ"; 
				$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; 
				$data .= "0FGH45OP89";
				
				for($i = 0; $i < $length; $i++) 
				{ 
				$random .= substr($data, (rand()%(strlen($data))), 1); 
				}
				
				return $random; 
				}
				
				randomPrefix(13); 
				$rand=randomPrefix(13);
				$rand; 
				
				//Checking Email Unique//
				$CheckEmailSql = "SELECT EmailId FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$email."'";
				$CheckEmailQuery=mysql_query($CheckEmailSql) or mysql_error();
				$CheckEmailRow=mysql_num_rows($CheckEmailQuery);
			
			
				if($CheckEmailRow=="0")
				{
				
				$InsertRegSql="INSERT INTO ".TABLE_PREFIX."user_registration SET 
																					RegistrationNo = '".mysql_real_escape_string($RegistrationNo)."' ,
																					IpAddress ='" . mysql_real_escape_string($ip) . "',
																					FirstName = '".mysql_real_escape_string($fname)."' ,
																					LastName= '".mysql_real_escape_string($lname)."' ,
																					BusinessName = '".mysql_real_escape_string($businessName)."',
																					Address= '".mysql_real_escape_string($address)."' ,
																					Phone = '".$phone."',
																					EmailId = '".mysql_real_escape_string($email)."' , 
																					UserName = '".mysql_real_escape_string($username)."',
																					Password 	= '".mysql_real_escape_string(base64_encode($password))."' , 
																					RegistDate = NOW() , 
																					EmailVerification = 'No' , 												
																					UserStatus = 'Yes' 
																					";
																				//	exit();
																					
					mysql_query($InsertRegSql) or die(mysql_error());

						require_once('class.phpmailer.php');
							
										$adminMail = mysql_fetch_array(mysql_query("SELECT MailAddress FROM hr_admin_mail WHERE MailId = '1'"));
										$noreply = $adminMail['MailAddress'];

										
										$mail = new PHPMailer(); // defaults to using php "mail()"
										
										//$body             = file_get_contents('contents.html');
										
										$mailbody = "<table align='center' style='width:700px; height:600px;'>
										<tbody><tr>
											<td>
											  <table align='center' background='$siteimg/background.jpg' style='width:650px; text-align:center; height:500px;'>
												<tbody><tr style='height:50px;'>
												 
												<td valign='middle' colspan='2'>
												<img src='$siteimg/logo.png'></td>
												
												</tr>
												
												<tr>
												 <td valign='top' align='right' colspan='2'>
													<table style='height:308px; color:#FFF; width:380px;'>
													 <tbody>
													 <tr height='20%'>
													  <td colspan='3' style='font-size:28px;'>
													 Hello $fname
													  </td>
													  
													 </tr>
													 <tr height='20%'>
													  <td colspan='3' style='font-size:28px;'>
													 Registered Email/Username : ".$email."<br/>
													 Password : ".$password."
													  </td>
													  
													 </tr>
													 <tr height='20%'>
													  
													  <td colspan='3'>Welcome to Vicna. With one click, you can activate your account and using the site.</td>
													 </tr>
													 
													  <tr>
													  <td colspan='3' style='font-size: 14px;'>
													  You <a href='#' style='color:#CCFA00; text-decoration:none;'>MUST</a> click this <a href='#' style='color:#CCFA00; text-decoration:none;cursor:pointer;'>ACTIVATION</a> link to enter the site
													  </td>
													  
													 </tr>
													 
													 <tr>
													 <td>&nbsp;</td>
													  <td colspan='2'>
													 <a href='$activationlink?email=".base64_encode($email)."&type=user'><button style='border-radius:10px;height:30px;cursor:pointer;   background-color: #A1D347;'>ACTIVATE ACCOUNT</button></a>
													  </td>
													  
													 </tr>
													 <tr>
													  <td colspan='3' style='font-size:13px'><br></td>
													  
													 </tr>
													</tbody></table>
												</td>
												
												</tr>
												 
											 </tbody></table>
										</td>
									</tr>
									
									</tbody></table>";
										
										$mail->SetFrom($noreply, "Vicna");
										
										//$address = $email;
										
										$mail->AddAddress($email, "Vicna");
										
										$mail->Subject    = "Welcome to Vicna Account Activation!";
										
										$mail->AltBody    = "Account Activation Mail"; // Alt Body
										
										//$mail->MsgHTML($body);
										
										$mail->Body = $mailbody;
										
										//$mail->AddAttachment("images/logo5.png");      // attachment
		
										
										if(!$mail->Send()) {
										  echo "Mailer Error: " . $mail->ErrorInfo;
										} else {
										  /*echo "A test email sent to your email address '".$email."' Please Check Email and Spam too.";
										  echo '<meta http-equiv="refresh" content="5;url=http://www.computersneaker.com">';*/
										  echo '<script language="javascript">';
										echo 'window.location="register.php?mess=successful"';
										echo '</script>';
										}
						
						}

						else
						{
						 $mess = "E-Mail already exists.Try another one! ";
						  

						}
	
	}
	
	
		
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
<div class="col-xs-12 col-sm-12 col-md-4 well well-sm" align="center" style=" margin-top: 34px;">  
          <legend><a href="http://www.jquery2dotnet.com"></a>Clients Sign up!</legend>
        <form  name="checkoputform" id="checkoputform" method="post" class="form-horizontal"  action="" onSubmit="return myFunction()">
                           <?php if(isset($mess)!=""){ ?>
				<p style="color:#CD3E4F; font-size:18px;"><?=$mess?></p>
		 <?php } else{
			 	if(isset($_REQUEST['mess'])){
			?>
            <p style="color:#090; font-size:18px;">Please Check Your Mailbox and Activate Your Account</p>
            <?php	
				}
			 }?>
       				<div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                    </div>            
			<div class="row">
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="fname" id="fname" placeholder="First Name" type="text" onKeyPress="javascript:return checkName1(event)"
                         />
                         <label id="error_fname" class="red"></label>
                </div>
                <div class="col-xs-6 col-md-6">
                    <input class="form-control" name="lname" id="lname" placeholder="Last Name" type="text" onKeyPress="javascript:return checkName2(event)"  />
                     <label id="error_lname" class="red"></label>
                </div>
            </div>
			<input class="form-control" name="business_name" id="business_name" placeholder="Your Business Name" type="text" />
			 <label id="error_business" class="red"></label>
			
             <input class="form-control" name="address" id="address" placeholder="Your Address" type="text" />
			 <label id="error_address" class="red"></label>
			 
			 <input class="form-control" name="phone" id="phone" pattern="[0-9]{10}" placeholder="Your Phone Number" type="number" />
			 <label id="error_phone" class="red"></label>
			
			
            <input type="mail" class="form-control" name="mail" id="mail" onBlur=" return checkEmail();" placeholder="Email Address" />
             <label id="error_mail" class="red"></label>
			
			<input class="form-control" name="username" id="username" placeholder="Enter Your Username" type="text" />
			 <label id="error_username" class="red"></label>
          
             <input type="password" class="form-control" name="Password" id="password" placeholder="Password" >
                <label id="error_password" class="red"></label>
			
			
             <input class="form-control" type="password" name="confirmpassword" id="password1" placeholder="confirmPassword" onBlur="return passwordCheck()" >
               <label id="error_password1" class="red"></label>
			
            
            <br />
            <br />
            <button class="btn btn-lg btn-primary btn-block" id="btn-signup" value="Signup Now" type="submit" name="submit" >
            
                Sign up</button>
            </form>
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

var business = document.getElementById("business_name").value;
var address = document.getElementById("address").value;
var phone = document.getElementById("phone").value;
var mail = document.getElementById("mail").value;
var username = document.getElementById("username").value;

if(fname.trim().length < 3)
{

document.getElementById("error_fname").innerHTML="Enter First Name Min. 3 char.";
document.getElementById("fname").style.border="2px solid red";
return false;
}
if(lname.trim().length < 3)
{
document.getElementById("error_lname").innerHTML="Enter the Last Name Min. 3 char";
document.getElementById("lname").style.border="2px solid red";
return false;
}




if(business.trim().length == "")
{
document.getElementById("error_business").innerHTML="Enter the valid Business Name";
document.getElementById("business_name").style.border="2px solid red";
return false;
}else{
	document.getElementById("error_business").innerHTML="";
	document.getElementById("business_name").style.border="";
}

if(address.trim().length < 7)
{
document.getElementById("error_address").innerHTML="Enter the valid address";
document.getElementById("address").style.border="2px solid red";
return false;
}
else{
	document.getElementById("error_address").innerHTML="";
	document.getElementById("address").style.border="";
}
/*if(phone.trim().length < 10)
{
	alert('Working');
document.getElementById("error_phone").innerHTML="Enter Valid Phone Number";
document.getElementById("phome").style.border="2px solid red";
document.getElementById("phome").focus();
return false;
}*/
if(mail=='')
{
document.getElementById("error_mail").innerHTML="Enter the Email";
document.getElementById("mail").style.border="2px solid red";
return false;
}else
{
	document.getElementById("error_mail").innerHTML="";
	document.getElementById("mail").style.border="";
}             

if(username.trim().length < 6)
{
document.getElementById("error_username").innerHTML="Username Min. 6 Char ";
document.getElementById("username").style.border="2px solid red";
return false;
}else{
	document.getElementById("error_username").innerHTML="";
	document.getElementById("username").style.border="";
}
 
var password = document.getElementById("password").value;
var password1 = document.getElementById("password1").value;
if(password.trim().length <6)
{

document.getElementById('error_password').innerHTML="Password Must be Min. 6 Character";
document.getElementById("password").style.border="2px solid red";

return false;

}else{
	document.getElementById('error_password').innerHTML="";
	document.getElementById("password").style.border="";
}

if(password.trim() != password1.trim())
	{
		document.getElementById('error_password1').innerHTML="Confirm Password Not Match";
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