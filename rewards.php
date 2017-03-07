<?php //session_start();
 include 'config/connect.php'; 
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


<style>
  .latest-news h3::after {
	content:none;
}
</style>	
</head><body>
<?php include'header.php';?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '31'";
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
<section class="inner-content" style="padding:0;">
<div class="container">
<div class="row">
      <div class="col-xs-12 margin-bottom">
  <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong></h1>
  </div></div></div></section>
<section class="header_banner">
  <img src="<?=$pic;?>">
  
  <section class="inner-header" style="/*background-image:url(images/banner/benefits.jpg);padding: 100px; margin-top:-80px*/">
  <div class="container" >
    <div class="row">
      <div class="col-xs-12">
      
        <h1></h1>
      </div>
    </div>
  </div>
</section>
  </section>
<?php 

$fetch = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_PREFIX."cms1 WHERE id='1'"));

?>

<section class="latest-news" style="margin-top: 30px;">
  <div class="container">
    <div class="row">
         <div class="col-sm-4 col-sm-push-4">
            <div class="cr line1" style="width:100%;">
              <p class="cr-hd"><?=stripslashes($fetch['title1']);?></p>
              <p class="cr-text"><?=stripslashes($fetch['text1']);?></p>
              <p style="margin:0;"><a class="cr-btn" href="app.php">CLICK HERE TO FIND</a></p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4">
            <div class="cr line2">
                <p class="cr-hd"><?=stripslashes($fetch['title2']);?></p>
              <p class="cr-text"><?=stripslashes($fetch['text2']);?></p>
              <p style="margin:0;"><a class="cr-btn" href="refer.php">CLICK HERE TO REFER SOMEONE</a></p>
            </div>
         </div>
          <div class="col-sm-4 col-sm-push-4">
            <div class="cr line3">
                <p class="cr-hd"><?=stripslashes($fetch['title3']);?></p>
              <p class="cr-text"><?=stripslashes($fetch['text3']);?></p>
            
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-sm-push-4">
            <div class="cr" style="background:#1C7DC1; width:70%;">
              <h4>Rewards<br> &amp;<br> Support for <br>Nurses at VICNA</h4>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4">
            <div class="cr line4">
              
               <p class="cr-hd"><?=stripslashes($fetch['title4']);?></p>
              <p class="cr-text"><?=stripslashes($fetch['text4']);?></p>
       
            </div>
         </div>
          <div class="col-sm-4 col-sm-push-4">
            <div class="cr line5">
               <p class="cr-hd"><?=stripslashes($fetch['title5']);?></p>
              <p class="cr-text"><?=stripslashes($fetch['text5']);?></p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-sm-push-4">
            <div class="cr line6">
              <p style="margin-top:2em; color:#000; font-size:16px; font-weight:600"><?=stripslashes($fetch['text6']);?></p>
            </div>
         </div>
      </div>
  </div>
</section>














<section class="latest-news" >
 <div class="container">
    <div class="row">
     <div class="col-md-12 col-xs-12">
<div align="center">
 <h3 class="animated pulse">VICNA APP for iOS & Android: Coming Soon!!</h3>
</dt></dl>
</div></div>
</div></div>
</section>

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