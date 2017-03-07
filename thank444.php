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
</head><body>
<?php include'header.php';?>
<!-- end header -->
<!--<section class="inner-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1>WORKING WITH VICNA</h1>
      </div>
    </div>
  </div>
</section>-->
<!--<section class="appointment">
  <div class="container">
    <form>
      <div class="row" >
        <div class="col-md-6 col-sm-6 col-xs-12" >
          <h3 style="size:19px; color:#FFF" >
            Register Your Expression of Interest
          </h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>First Name</label>
          <input type="text">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>Last Name</label>
          <input type="text">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>Phone Number</label>
          <input type="text" id="phone">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>E-mail</label>
          <input type="text">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 department">
          <label>Qualification</label>
          <select onChange="return hideshow(this.value)" onselect="return hideshow(this.value)" >
            <option value="RN/Div">RN/Div 1</option>
            <option value="EN/EEN">EN/EEN</option>
            <option value="AIN/PCA">AIN/PCA</option>
            <option value="Dental Assistan">Dental Assistant</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 gender">
          <input type="submit" style="float: left;" class="btn btn-success" value="Register">
        </div>
      </div>
      <div id="hidden_div" style="display: none;" class="col-md-4">
        <label>Add Qualification</label>
        <input type="text" id="Qualification" value="Qualification">
      </div>
    </form>
  </div>
</section>-->
<!-- end inner header -->

<section class="inner-content" style="padding-bottom:27px;">
<div class="container">
<div class="row">
      <div class="col-xs-12 margin-bottom">
  <h1 class="title-bottom-line">Apply <strong>NOW</strong> </h1>
  </div></div></div></section>

<section class="inner-header" style="background-image:url(images/banner/1.jpg);padding: 90px; margin-top:-80px">
  <div class="container" >
    <div class="row" >
      <div class="col-xs-6 col-xs-push-6 text-right" >
      <p><i style="    font-size: 24px;
    text-shadow: 0 1px 2px #000;
"></i></p>
      </div>
    </div>
  </div>
</section>
<script>
    function myFunction() {
        var name = document.getElementById("name").value;
       var surname = document.getElementById("surname").value;
       // var email = document.getElementById("mail").value;
         var exampleInputFile = document.getElementById("exampleInputFile").value;
      
      
        if (name=='')
            {
               alert("please enter  Name"); 
               return false;
            }
            
        if (surname=='')
            {
               alert("please enter Last Name"); 
               return false;
            }             
         
           
           if (exampleInputFile=='')
           {
             alert("please Upload CV"); 
              return false;
           } 
          
      
    }
	</script>>
<section>
   <div class="container">
     <div class="col-sm-8 col-sm-push-2">
     <div class="lst">
      <form id="contact-form">
          <?php if($_GET["r"]){ ?>
		   <h2 style="color:rgb(28, 127, 195); margin-bottom:1em; margin-top:0;"> Thank You </h2> 
           <?php } 
		   else {
			   
			   ?>
			   <h2 style="color:rgb(28, 127, 195); margin-bottom:1em; margin-top:0;"> From Not sent, Try again. </h2> 
			   <?php
		   }
            ?>
            
           <!--  <p style="color:#1C7FC3;font-size:18px; margin-top:1.5em;">Once applied, we will get back to you shortly.</p>-->
          </form>
          </div>
   </div>
   </div>
</section>


<section class="footer-bar">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2><i class="ion-iphone"></i> 1-800-555-1234 </h2>
        <ul>
          <li><a href="#"><i class="ion-social-facebook"></i></a></li>
          <li><a href="#"><i class="ion-social-twitter"></i></a></li>
          <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
        </ul>
        <!-- end ul -->
        <h4>Follow us on social media</h4>
      </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
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
<!-- form copy***************************************************** -->
 
<!-- ****************************************************************** end -->
</body>


</html>