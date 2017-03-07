<?php
 include 'config/connect.php'; 
 
 ?>
<?php include 'refer_form.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="">
<title>VIC Nursing Agency</title>
<meta name="author" content="Themezinho">
<meta name="description" content="">
<meta name="keywords" content="">
<!-- SOCIAL MEDIA META -->
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:site_name" content="Medicina">
<meta property="og:title" content="Medicina">
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
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php include'header.php';?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '30'";
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
<div class="container">
  <div class="row">
    <div class="col-xs-12 sd">
      <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong> </h1>
    </div>
  </div>
</div>
<section class="header_banner"> <img src="<?=$pic?>">
  <section class="inner-header res_btm">
    <div class="container" >
      <div class="row" >
        <div class="col-xs-6 col-xs-push-6 text-right" >
          <?=$rowdest['BannerText'];?>
        </div>
      </div>
    </div>
  </section>
</section>
<section class="inner-header" style="/*background-image:url(images/banner/rafer.jpg);padding: 130px;*/">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <!--h1>Refer-a-Pal </h1-->
      </div>
    </div>
  </div>
</section>
<!-- end inner header -->
<section class="latest-news"style="margin-top: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        
        <!-- end title-box -->
      </div>
      <!-- end col-12 -->
      <!-- end col-6 -->
      <div class="col-md-12 col-xs-12 ">
        <div >
          
          <h3>Referral Form</h3>
          <hr>
          <div class=" col-sm-offset-3 col-sm-6 col-xs-12">
            <div class="left-side">
            <!--<h1 class="title-bottom-line"><strong>Shift Booking </strong> FORM</h1>-->
            <p style="color: #1875bb;
    font-size: 20px;
    font-weight: 600;">VICNA Employee Details</p>
            <form id="contact-form" style="padding: 0px;" class="frm emp_frm" method="post" action="<?=$_SERVER['PHP_SELF'];?>">
              <div class="row">
                <div class="col-md-12">
                  <input type="text" name="fname" id="fname" value="<?=$_REQUEST['fname'];?>" placeholder="First name*">
                </div>
                <div class="col-md-12">
                  <input type="text" name="lname" id="lname" value="<?=$_REQUEST['lname'];?>"  placeholder="Last name*">
                </div>
                <div class="col-md-12">
                  <!--  <input name="DateOfBirth" type="date"  placeholder="dd/mm/yyyy"style="width: 100%;margin-bottom: 11px;">-->
                  <input type="text" name="email" id="email" value="<?=$_REQUEST['email'];?>" placeholder="Email address*">
                </div>
                <div class="col-md-12">
                  <input type="text" name="phone" id="phone" value="<?=$_REQUEST['phone'];?>" placeholder="Contact phone number">
                </div>
              </div>
              <!--  </form>-->
              </div>
              <p style="color: #1875bb; font-size: 20px; font-weight: 600;"> Referred Applicant Details:</p>
              <div id="contact-form" style="padding: 0px;" class="frm emp_frm">
                <div class="row">
                  <div class="col-md-12 ">
                    <input type="text" name="refer_fname" id="refer_fname" value="<?=$_REQUEST['refer_fname'];?>" placeholder="First name*">
                  </div>
                  <div class="col-md-12">
                    <input type="text" name="refer_lname" id="refer_lname" value="<?=$_REQUEST['refer_lname'];?>"  placeholder="Last name*">
                  </div>
                  <!-- <input name="DateOfBirth" type="date"  placeholder="dd/mm/yyyy"style="width: 100%;margin-bottom: 11px;">-->
                  <div class="col-md-12">
                    <input type="text" name="refer_email" id="refer_email" value="<?=$_REQUEST['refer_email'];?>" placeholder="Email address*">
                  </div>
                  <div class="col-md-12">
                    <input type="text" name="refer_phone" id="refer_phone" value="<?=$_REQUEST['refer_phone'];?>" placeholder="Contact phone number">
                  </div>
                  <div class="col-md-12">
                    <label>Qualification</label>
                    <select onselect="return hideshow(this.value)" onChange="return hideshow(this.value)" name="quali">
                      <option value="RN/Div">RN/Div 1</option>
                      <option value="EN/EEN">EN/EEN</option>
                      <option value="AIN/PCA">AIN/PCA</option>
                      <option value="Dental Assistan">Dental Assistant</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <input style="font-size:13px;" type="submit" name="submit" value="SEND IT">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- end right side -->
        </div>
        <!-- end right -->
      </div>
      <!-- end col-6 -->
    </div>
    <!--  The more nurses you refer, the more rewards you will receive.<br><br>

To register as a referrer, simply e-mail demo@mailid.com<br><br><br><br><br>

 

Happy Referring!-->
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end section -->

<!-- end footer-bar -->
<?php include'footer.php';?>
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
