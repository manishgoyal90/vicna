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

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style>
     .cr {
		 min-height:150px;
		}
		.cr-text {
			color:#000; font-size:16px; font-weight:600;
		}
		.cr-text {
    margin-top: 0.8em;
}
.line1::after {
    height: 120%;
}
.line2::after {
    background: #ccc none repeat scroll 0 0;
    bottom: -61px;
    content: "";
    height: 100%;
    position: absolute;
    right: -57px;
    transform: rotate(-56deg);
    width: 1px;
    z-index: -1;
}
.line3::after {
    background: #ccc none repeat scroll 0 0;
    bottom: -61px;
    content: "";
    height: 100%;
    position: absolute;
    left: -57px;
    transform: rotate(56deg);
    width: 1px;
    z-index: -1;
}
.line4::after {
    background: #ccc none repeat scroll 0 0;
    bottom: 43%;
    content: "";
    height: 100%;
    position: absolute;
    right: -55px;
    transform: rotate(56deg);
    width: 1px;
    z-index: -1;
}
.line5::after {
    background: #ccc none repeat scroll 0 0;
    bottom: 43%;
    content: "";
    height: 100%;
    position: absolute;
    left: -55px;
    transform: rotate(-56deg);
    width: 1px;
    z-index: -1;
}
.linem1::after {
    background: #ccc none repeat scroll 0 0;
    bottom: 0;
    content: "";
    height: 100%;
    position: absolute;
    right: -30px;
    transform: rotate(90deg);
    width: 1px;
    z-index: -1;
}
.linem2::after {
    background: #ccc none repeat scroll 0 0;
    bottom: 0;
    content: "";
    height: 100%;
    position: absolute;
    left: -30px;
    transform: rotate(90deg);
    width: 1px;
    z-index: -1;
}
  </style>
</head><body>
<?php include'header.php';?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '34'";
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
  <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong></h1>
  </div></div></div></section>


<section class="header_banner">
  <img src="<?=$pic;?>">
  
  <section class="inner-header" style="/*background-image:url(images/banner/work.jpg);padding: 130px;  margin-top:-80px;*/">  
  <div class="container" >
    <div class="row">
      <div class="col-xs-12">
      
        <h1></h1>
      </div>
    </div>
  </div>
</section>
  
  </section>









<!-- end inner header -->



<section class="latest-news" style="margin-top: 30px;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
        <div class="title-box">
         <!-- <h2>Why Nurses are Choosing <span>VICNA Healthcare</span></h2>-->
          <!--<h5 style="margin-bottom:0;">Why Nurses are Choosing <span>VICNA Healthcare</span></h5>-->
        </div>
       </div>
      </div>
    </div>
</section>


<!--<section>
   <div class="container">
      <div class="col-sm-10 col-sm-push-1">
        
          <div class="lst"> 
            <div class="col-sm-12">
              <p>Flexible work conditions: (choose when, where and how often you want to work) - </p>
 
            </div>
            </div>
             <div class="lst"> 
            <div class="col-sm-12">
             
 <p>We are a transparent, fair and professional organization</p>
 <p>We treat you like an individual and as part of the family -</p>
 <p>Leave work at work: Have a clear division between your work and home life.</p>
  <p>An extensive network of partner healthcare facilities means a steady stream of available work </p>
   <p>A variety of placements to suit your interests and specialisation.</p>
    <p>Earn above award salary</p>
 <p>Rewards & Support for Nurses at VICNA</p>
 <p><a href="rewards.php">Read More</a></p>
            </div>
            </div>
            <div class="col-sm-12">
            </div>
            
       
      </div>
   </div>
</section>-->

<?php 

$fetch = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_PREFIX."cms2 WHERE id='1'"));

?>


<section class="latest-news" style="margin-top: 30px;">
  <div class="container">
    <div class="row">
         <div class="col-sm-4 col-sm-push-4">
            <div class="cr line1">
              <p class="cr-text"><?=stripslashes($fetch['text1']);?></p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4">
            <div class="cr line2">
                <p class="cr-text"><?=stripslashes($fetch['text2']);?></p>
            </div>
         </div>
          <div class="col-sm-4 col-sm-push-4">
            <div class="cr line3">
                <p class="cr-text"><?=stripslashes($fetch['text3']);?></p>
            
            
            </div>
         </div>
      </div>
      <div class="row">
      <div class="col-sm-4">
            <div class="cr linem1" style=" margin-top: 2em;">
              
             
              <p class="cr-text"><?=stripslashes($fetch['text4']);?></p>
       
            </div>
         </div>
         <div class="col-sm-4">
            <div class="cr" style="background:#1C7DC1; width:70%;">
              <h4>Why Nurses are Choosing VICNA </h4>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="cr linem2"  style=" margin-top: 2em;">
              
              <p class="cr-text"><?=stripslashes($fetch['text5']);?></p>
            </div>
         </div>
      </div>
   
      
      
      <div class="row">
         <div class="col-sm-4">
            <div class="cr line4">
              
                <p class="cr-text"><?=stripslashes($fetch['text6']);?></p>
           
       
            </div>
         </div>
          <div class="col-sm-4 col-sm-push-4">
            <div class="cr line5">
              
              <p class="cr-text"><?=stripslashes($fetch['text7']);?></p>
            </div>
         </div>
      </div>
      
      
      
      <div class="row">
         <div class="col-sm-4 col-sm-push-4">
            <div class="cr line6">
              <p class="cr-text"><?=stripslashes($fetch['text8']);?></p>
              <p style="margin:0;"><a class="cr-btn" href="rewards.php">READ MORE</a></p>
            </div>
         </div>
      </div>
  </div>
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