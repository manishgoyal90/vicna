<?php include"config/connect.php";?>
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
<style type="text/css">
	.superster p { position: absolute;
   top: 15%;
   left: 0;
   font-size:36px;
   font-weight:bold;
   font-family:"Times New Roman", Times, serif;
   color:#3156a3;
   width: 100%;
   margin: 0 auto;
  height: 50px;}
  
  .superster .superster-image { position: absolute;
   top: 28.2%;
   left: 15%;
   width: 70%;
   margin: 0 auto;
   height:44%;
 }
 
 
	</style>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head><body>
<?php include'header.php';?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '28'";
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
<section class="inner-content">
<div class="container">
<div class="row">
      <div class="col-xs-12 margin-bottom">
  <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong> </h1>
  </div></div></div></section>


<section class="header_banner">
  <img src="<?=$pic?>">
  
  <section class="inner-header" style=/*"background-image:url(images/banner/superstar.jpg);padding: 130px; margin-top:-80px*/">
  
</section>
  </section>




<!-- end inner header -->


<section class="latest-news">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
       <!-- <div class="title-box">
          <h2> Coming Soon</h2>
          <h5>Why Nurses are Choosing <span></h5>
        </div>-->
        <!-- end title-box --> 
	
      <div class="col-sm-6 col-sm-push-3 superster">  
        <img src="images/badge.jpg" class="img-responsive badge-style"/>
		<p>Superster Name</p>
		<img src="profileImage/1469169651.jpg" class="img-responsive superster-image" />
      </div>  
      </div>
      <!-- end col-12 -->
     <div class="title-box">
          <h3> Somthing About Superster</h3>
          <h5>Why we Choose for Superster <span></h5>
        </div> 
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
<!-- form copy***************************************************** -->
 
<!-- ****************************************************************** end -->
</body>


</html>