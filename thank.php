<?php
include './config/connect.php';
if($_POST['submit']=="Sign In") {

			$email = mysql_real_escape_string(stripslashes($_POST['email']));
			$password = mysql_real_escape_string(stripslashes($_POST['password']));
			
			
				
					//Checking Email  With Database
					$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$email."' AND Password = '".base64_encode($password)."' AND UserStatus = 'Yes' AND EmailVerification = 'Yes'";
					$FetchUserQuery = mysql_query($FetchUserSql);
					$NumRows = mysql_num_rows($FetchUserQuery);
					
					if($NumRows>0) {
					
					$FetchRows = mysql_fetch_array($FetchUserQuery);
					
					$_SESSION['usertype'] = "Client";
					$_SESSION['userid'] = $FetchRows['Uid'];
					$_SESSION['loggedIn'] = $fetch['email'];
					$_SESSION['useremail'] = $fetch['email'];
					$cookievalue = $_SESSION['userid']."@@".$_SESSION['username'];
		
					if($_REQUEST['rem'] == 'yes')
					{
						setcookie("UserCookie",$cookievalue,time()+30*24*60*60);
					}

					
						
					if($_REQUEST['product_id']=='')
						{				
							echo '<script language="javascript">';
							echo 'window.location="clientProfile.php?login=successful"';
							echo '</script>';
						}
						
								
					
				} else {
					header("location:login.php?login=fail");
					 echo "<p>Login failed, username or password incorrect.</p>";
					  $mess = "E-Mail already exists.Try another one! ";
				}
				
			
		}
?>
 
        
                             <script type="text/javascript">
  function checkForm(form)
  {
    // validation fails if the input is blank
   

    // regular expression to match only alphanumeric characters and spaces
 
	
  if(form.email.value == "") {
      alert("Error:Insert Your Valid Id!");
      form.email.focus();
      return false;
    }

   if(form.password.value == "") {
      alert("Error:Enter Your valid Password !");
      form.password.focus();
      return false;
    }
   
  

   
    // validation was successful
    return true;
  }

</script>

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

</head><body>
<?php include'header.php';?>



<section class="latest-news">
  <div class="container" style="background-image:url(images/homeBG.jpg);width: 100%;">
    <div class="row" >
      <div class="col-xs-12 text-center">
        
        <div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
       <?php if($_REQUEST['mess']=="successful") { ?>
<p style="color:green;">You Registration is successfull. Login Now</p>
<?php } ?>
 <?php
		if($_REQUEST['login']!='') {
	   ?> 
		<p style="color:#ff0000;">Email Id/ Password Invalid!</p>
		<?php } ?>
        
		
		<?php if($_GET["r"]){ ?>
		   <h2 style="color:rgb(28, 127, 195); margin-bottom:1em; margin-top:0;"><br><br> Thank You <br><br></h2> 
           <?php } 
		   else {
			   
			   ?>
			   <h2 style="color:rgb(28, 127, 195); margin-bottom:1em; margin-top:0;"><br><br> From Not sent, Try again. <br><br></h2> 
			   <?php
		   }
            ?>
        
      
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

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
 
<!-- ****************************************************************** end -->
</body>


</html>