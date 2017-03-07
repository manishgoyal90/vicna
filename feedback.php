<?php include './config/connect.php';
				
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
		echo '<script>alert("Please Enter Your First Name.");</script>';
	}elseif($surname == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your Last Name.");</script>';
	}
	elseif($phone == "")
	{
		$msg = "Error";
		echo '<script>alert("Please Enter Your phone.");</script>';
	}
	elseif($message == "")
	{
		$msg = "Error";
		echo '<script>alert("Please write message.");</script>';
	}
	
	
	if($msg == ""){
		$insert = mysql_query("INSERT INTO hr_feedback SET 
											name = '".$name."',
											surname = '".$surname."',
											phone = '".$phone."',
											message = '".$message."',
											date = NOW()");
		if($insert)
		{
			echo '<script>alert("Your Feedback Submitted Successfully.");</script>';
			echo '<script>window.location.href="feedback.php";</script>';
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
 <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

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
</style>
</head><body>
<?php include 'header.php'; ?>
<!-- end header -->
<section class="inner-content" style="padding:0px;">
<div class="container">
<div class="row">
      <div class="col-xs-12 margin-bottom">
  <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong></h1>
  </div></div></div></section>
  
<section class="header_banner">
 <!-- <img src="images/banner/feedback.jpg">-->
 <!-- Head tags to include FontAwesome -->


<div class="container-fluid">
  
  <div class='row'>
    <div class=' col-md-12'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
        <!-- Bottom Carousel Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#quote-carousel" data-slide-to="1"></li>
          <li data-target="#quote-carousel" data-slide-to="2"></li>
        </ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        
          <!-- Quote 1 -->
		  <?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '27'";
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
          <div class="item active">
          <div class="row">
                <div class="col-sm-12 ">
           			<img src="<?=$pic?>">
          	 	</div>
           </div>
          </div>
          <!-- Quote 2 -->
	<?php $GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE UPPER(BannerName) = 'FEEDBACK' AND BannerId != '27'";
			$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
			while($rowdest = mysql_fetch_array($GetQuery))
			{
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
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="<?=$pic;?>" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <?=stripslashes($rowdest['BannerText']);?>
                </div>
              </div>
            </blockquote>
          </div>
		<?php }?>
          <!-- Quote 3 -->
          <!--<div class="item">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                  <img class="img-circle" src="images/re.png" style="width: 100px;height:100px;">
                </div>
                <div class="col-sm-9">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum elit in arcu blandit, eget pretium nisl accumsan. Sed ultricies commodo tortor, eu pretium mauris.</p>
                  <small>Care Manager, ACF</small>
                </div>
              </div>
            </blockquote>
          </div>-->
        </div>
        
        <!-- Carousel Buttons Next/Prev -->
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
  </div>
</div>
 <!--***************************testimonial slider****************************-->
  </section>
<section >
  <div class="container" >
    <div class="row">
      <div class="col-xs-12">
      
        <h1></h1>
      </div>
    </div>
  </div>
</section>

<!-- end inner header -->
<section class="inner-content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="left-side">
          <h1 class="title-bottom-line">Feedback<strong>Form</strong> </h1>
          <form id="contact-form" style="padding:0;" class="frm" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
            <input type="text" name="name" id="name" value="<?=$_REQUEST['name'];?>" placeholder="First Name">
            <input type="text" name="surname" id="surname" value="<?=$_REQUEST['surname'];?>"  placeholder="Last Name">
            <input type="text" name="phone" id="phone" value="<?=$_REQUEST['phone'];?>" placeholder="Phone Number">
            <textarea style="width:90%;" name="message" value="<?=$_REQUEST['message'];?>" id="message" placeholder="Feedback"></textarea>
            <input style="font-size:13px;" type="submit" name="submit" value="SEND IT">
          </form>
        </div>
      </div>
      <!-- end left side -->
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="side-bar">
          <h1 class="title-bottom-line"><strong>HEAD</strong> OFFICE</h1>
          <div class="panel-group" >
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title"> <a href="">VIC Nursing Agency</a> </h4>
              </div>
              <div  class="panel-collapse ">
                <div class="panel-body gray-bg">
				<?php
				$cms = mysql_fetch_array(mysql_query("SELECT cms_pagedes FROM hr_cms WHERE id='2'"));
				//print_r($cms);
				?>
				<div role="tabpanel" class="tab-pane" id="map">
				  <address>
				  <?=stripslashes($cms['cms_pagedes']);?>
				  </address>
				 				 
				</div>
                 <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d755.670575004187!2d-73.82493643799931!3d40.74701573236736!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2606ea6fbfbd9%3A0xa3ec5195d0f041ac!2s56-45+Main+St%2C+Flushing%2C+NY+11355%2C+Birle%C5%9Fik+Devletler!5e0!3m2!1str!2s!4v1415186541806" style=" width:100%; height:140px; border:0"></iframe>-->
				  
				<p>  <?php echo strip_tags(stripslashes($cms['cms_pagedes']));?></p>
				
				<?php
				  $phone = mysql_fetch_array(mysql_query("SELECT cms_pagedes FROM hr_cms WHERE id='4'"));
				  ?>
                  <!--<p><strong>VIC Nursing Agency </strong></p>
                  <p>56-45 Main St AAA, NY 11355(Demo address)<br>
                    US</p>-->
                  <h3><?=$phone['cms_pagedes']?></h3>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <!-- end right side --> 
    </div>
    <!-- end row --> 
  </div>
</section>
<!-- end section -->

<!-- end footer-bar -->
<?php include'footer1.php';?>
<!-- end footer --> 
<!--************************************testimonial script***************************************************-->
<script>
// When the DOM is ready, run this function
$(document).ready(function() {
  //Set the carousel options
  $('#quote-carousel').carousel({
    pause: true,
    interval: 4000,
  });
});
</script>
<!--************************************testimonial script***************************************************-->
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
<script>

$(document).ready(function(){

  $("address").each(function(){                         

    var embed ="<iframe width='360' height='243' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";

    $(this).html(embed);
                   

   });

});

</script>
<script type="text/javascript">

// validate contact form
$(function() {
	$("#contact-form1").validate({
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