<?php include './config/connect.php';?>
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
<meta name="twitter:card" content="">
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
    width: 247px !important;
}
.twitter-timeline.twitter-timeline-rendered {
    width: 100% !important;
}
.latest-news h3::after {
	content:none;
}
</style>
</head><body>
<?php include 'header.php'; ?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '35'";
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
<section class="header_banner">
  <div class="container">
    <section class="inner-content" style="padding-bottom:0px;">
      <div class="row">
        <div class="col-xs-12 margin-bottom">
          <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong></h1>
        </div>
      </div>
    </section>
  </div>
  <img src="<?=$pic;?>">
  <section class="inner-header" style=/*"background-image:url(images/banner/new.jpg);padding: 120px; margin-top:-80px*/">
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
<section class="inner-content">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="left-side">
          <div class="row">
            <div class="col-sm-12">
              <div class="lst">
                <div class="col-sm-3"> <img src="images/nb.gif" class="img-responsive"/> </div>
                <div class="col-sm-7">
                  <p>Is your registration current? Renew your registration with AHPRA here -<br>
                    <a href="http://www.nursingmidwiferyboard.gov.au/ "  target="_blank"> http://www.nursingmidwiferyboard.gov.au/</a></p>
                </div>
                <div class="col-sm-2"> <img style="height:90px; width:90px;" src="images/aphra.jpg" class="img-responsive img-circle"/> </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12"> <a class="twitter-timeline" data-dnt="true" href="https://twitter.com/anmfbetterhands" data-widget-id="722061483950014466">Tweets by @anmfbetterhands</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
          </div>
        </div>
      </div>
      <!-- end right side -->
    </div>
    <!-- end row -->
  </div>
</section>
<section class="latest-news" >
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div align="center">
          <h3 class="animated pulse">VICNA APP for iOS & Android: Coming Soon!!</h3>
          </dt>
          </dl>
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
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

// validate contact form
$(function() {
	$("#contact-form").validate({
    	rules: {
            name: {
                required: true,
                minlength: 2
            },
			surname: {
                required: true,
                minlength: 2
            },
			phone: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
			city: {
                required: true,
				minlength: 2
            },
			state: {
                required: true,
				minlength: 2
            },
            subject: {
                required: true
            },
			message: {
                required: true
            }
        },
		messages: {
            name: {
                required: "Please type your name",
                minlength: "Please type your name correctly"
            },
			surname: {
                required: "Please type your surname",
                minlength: "Please type your surname correctly"
            },
			phone: {
                required: "Please type your phone number",
                minlength: "Please type your phone number correctly"
            },
            email: {
                required: "Please type your e-mail correctly"
            },
			city: {
                required: "Please type your city",
                minlength: "Please type your city correctly"
            },
			state: {
                required: "Please type your state",
                minlength: "Please type your state correctly"
            },
            subject: {
                required: "Please type about subject",
                minlength: "To short subject"
            },
			 message: {
                required: "Please type your message",
                minlength: "To short message"
            }
        },
		submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"POST",
                data: $(form).serialize(),
                url:"process.php",
                success: function() {
                    $('#contact-form :input').attr('disabled', 'disabled');
                    $('#contact-form').fadeTo( "slow", 0, function() {
                        $(this).find(':input').attr('disabled', 'disabled');
                        $(this).find('label').css('cursor','default');
                        $('#success').fadeIn();
                    });
                },
                error: function() {
                    $('#contact-form').fadeTo( "slow", 0, function() {
                        $('#error').fadeIn();
                    });
                }
            });
        }
    });
});
</script>
</body>
</html>
