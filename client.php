<?php include './config/connect.php';
function isValidEmail($email){ 
     $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 

     if (eregi($pattern, $email)){ 
        return true; 
     } 
     else { 
        return false; 
     }    
} 
if(isset($_REQUEST['submit']))
{

	$name = mysql_real_escape_string($_REQUEST['name']);
	$surname = mysql_real_escape_string($_REQUEST['surname']);
	$email = mysql_real_escape_string($_REQUEST['email']);
	$phone = mysql_real_escape_string($_REQUEST['phone']);
	$position = mysql_real_escape_string($_REQUEST['position']);
	$organization = mysql_real_escape_string($_REQUEST['organization']);
	$callback = mysql_real_escape_string($_REQUEST['callback']);
	$message = mysql_real_escape_string($_REQUEST['message']);
	$msg = "";
	if($name == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your Name.");</script>';
	}elseif($surname == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your Surname.");</script>';
	}elseif($email == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your email.");</script>';
	}
	elseif($phone == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your phone.");</script>';
	}
	elseif($position == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your position.");</script>';
	}elseif($organization == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your organization.");</script>';
	}
	
	elseif($message == "")
	{
		$msg = "Error";
		echo '<script>alert("Please write message.");</script>';
	}
	
	if(!isValidEmail($email))
	{
		$msg = "Error";
		echo '<script>alert("Please Enter your valid Email.");</script>';
	}
	if($msg == ""){
		$insert = mysql_query("INSERT INTO hr_enquery SET 
											name = '".$name."',
											surname = '".$surname."',
											phone = '".$phone."',
											email = '".$email."',
											position = '".$position."',
											organization = '".$organization."',
											callback = '".$callback."',
											message = '".$message."',
											date = NOW()");
		if($insert)
		{
			echo '<script>alert("Enquery Submitted Successfully.");</script>';
			echo '<script>window.location.href="index.php";</script>';
			exit();
		}
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
<meta property="og:type" content="">
<meta property="og:url" content="">
<!-- TWITTER META -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="">
<meta name="twitter:creator" content="">
<meta name="twitter:title" content="">
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
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>  
.frm input[type="text"] {
    width: 330px !important;
}
@media(max-width:767px){
#contact-form {
    width: 90%;
    float: initial;
    margin: auto;
    padding: 0;
    margin-bottom: 20px;
}
}
@media only screen and (max-width: 480px) and (min-width: 320px)
{
.res_btm {
    bottom: -30px;
}
.header_banner img {
    min-height: 200px;
}
}
</style>
</head><body>
<?php include'header.php';?>
<!-- end header -->
<div class="book-now-wrapper" style="bottom:50%;">
  <p class="toggle"><a style="color:#fff; text-decoration:none;" href="request.php">Request a Nurse</a></p>
</div>
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '33'";
	$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
	$rowdest = mysql_fetch_array($GetQuery);
	
		if($rowdest['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("Banner/fullsize/".$rowdest['BannerImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "Banner/fullsize/".$rowdest['BannerImage'];
			}	
  ?>
<section class="inner-content" style="padding:0px;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 margin-bottom">
        <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong> </h1>
      </div>
    </div>
  </div>
</section>
<section class="header_banner"> <img src="<?=$pic?>">
  <section class="inner-header res_btm">
    <div class="container" >
      <div class="row" >
        <div class="col-xs-6 col" >
          <p class="res_font"><i style=" font-size: 24px; text-shadow: 0 1px 2px #000 !important; color: #000;"> <?=strip_tags(stripslashes($rowdest['BannerText']))?></i></p>
        </div>
      </div>
    </div>
  </section>
</section>
<!-- end frase -->
<section class="boxed-image-feature">
  <div class="container">
    <div class="row">
	<?=$rowdest['BannerDescription']?>
     <!-- <div class="col-xs-12 margin-bottom">
       
        <p> VIC Nursing Agency is run by experienced nurses and know exactly what their clients want from an agency nurse. We understand that there are a lot of agencies out there trying to fill as many shifts as possible, but that's not the business we do. We are known for providing satisfaction and peace of mind to our clients by doing things differently. </p>
      </div>
      <div class="col-xs-12 text-center">
       
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="left-side">
           
            <div class="col-sm-6 text-left">
              <div class="lst" style="min-height:198px;">
                <h3 style="margin-top:0; color:#1C7FC3;">Peace of Mind:</h3>
                <p>Only experienced Aged Care Nurses and PCAs are hired by our agency. We allot extra 15 minutes for first timers (RNs &ENs) to understand the facility specific policies and protocols at no extra cost to the clients.</p>
              </div>
            </div>
            <div class="col-sm-6 text-left">
              <div class="lst">
                <h3 style="margin-top:0; color:#1C7FC3;"> On-Call Assistance:</h3>
                <p> This unique feature of VICNA offers on-call assistance to all VICNA RNs working after hours by experienced care managers. They guide the RNs to do the best clinical and legal practice if they have a doubt on anything. Once again this feature does not cost anything extra to our clients. .</p>
              </div>
            </div>
          </div>
        </div>
      </div>-->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<section class="no-padding">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 no-padding">
        <form id="contact-form" class="frm" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
          <h2 style="color:rgb(28, 127, 195); margin-bottom:1em;">Enquiry Form </h2>
          <input type="text" name="name" id="name" placeholder="First name">
          <input type="text" name="surname" id="surname" placeholder="Last Name">
          <input type="text" name="phone" id="phone" placeholder="Phone">
          <br>
          <input type="text" name="email" id="email" placeholder="E-mail">
          <input type="text" name="position" id="position" placeholder="Position">
          <input type="text" name="organization" id="organization" placeholder="Organization">
          <br>
          <label>Request A Call Back</label>
          <select name="callback" id="vh-reason">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
          <textarea name="message" id="message" placeholder="Your Message"></textarea>
          <br>
          <!--  <input type="checkbox" name="call" value="call"> select request a call back option<br>-->
          <input style="font-size:13px;" type="submit" name="submit" value="SEND IT">
        </form>
        <!--  <a href="call.php">   <button>REQUEST A CALL BACK</button></a>
        -->
      </div>
      <!--<div class="col-md-4 col-sm-4 col-xs-12">
        <div class="side-bar">
          <h1 class="title-bottom-line"><strong>Benefits dot </strong> points</h1>
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
              <p style="color:#CCC;">1.	Peace of Mind: Only experienced Aged Care Nurses and PCAs are hired by our agency. We allot extra 15 minutes for first timers (RNs &ENs) to understand the facility specific policies and protocols at no extra cost to the clients.<br>
2.	On-Call Assistance: This unique feature of VICNA offers on-call assistance to all VICNA RNs working after hours by experienced care managers. They guide the RNs to do the best clinical and legal practice if they have a doubt on anything. Once again this feature does not cost anything extra to our clients. 
</p> 
            
              </div>
              <div id="collapseOne" class="panel-collapse collapse">
               
              </div>
            </div>
            
            
          </div>
        </div>
      </div>-->
      <!-- end col-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end logos -->

<!-- end footer-bar -->
<?php include'footer1.php';?>
<!-- end footer -->
<script type='text/javascript' src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/wow.js"></script>
<script src="js/jquery.stellar.js"></script>
<script src="js/smooth-scroll.js"></script>
<script src="js/queryloader2.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/jquery.maskedinput.js"></script>
<script src="js/jquery.ba-cond.min.js" type="text/javascript" ></script>
<script src="js/jquery.slitslider.js" type="text/javascript" ></script>
<script src="js/slider-settings.js"></script>
<script src="js/medicina.js"></script>
</body>
</html>
