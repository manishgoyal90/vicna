<?php
 include 'config/connect.php'; 
  include 'contact_form.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<title>VIC Nursing Agency</title>
<meta name="author" content="">
<meta name="description" content="">
<meta name="keywords" content="">
<!-- SOCIAL MEDIA META -->
<meta property="">
<meta property="">
<meta property="">
<meta property="">
<meta property="">
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
<style type="text/css">
body {
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
}
@media(max-width:992px){

}
@media(max-width:767px){
.form-inner-div{
display:none
}
.appointment form:after {
    top: 15px;
}
header .top-bar {
display:none
}
.top {
    padding-bottom: 5em;
}
.appointment .gender input[type="submit"] {
    float: left;
    margin-left: 0
}
.toggleform{
cursor:pointer;
    width: 84%;
    display: inline-block;
}
.tcon-plus{
    display: inline-block !important;
}
.book-now-wrapper{
display:none
}
footer ul li a {
    float: initial !important
}
footer ul li {
    text-align: center;
}
footer h4 {
    text-align: center;
    margin-top: 25px;
}
footer h4::after {
    left: 43%;
}
footer .container .row .col-md-3 p{
text-align:center
}

.tcon {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: none;
  cursor: pointer;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-justify-content: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-align-items: center;
  -ms-flex-align: center;
  align-items: center;
  height: 40px;
  transition: 0.3s;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  width: 40px;
  background: transparent;
  outline: none;
  -webkit-tap-highlight-color: transparent;
  -webkit-tap-highlight-color: transparent; }
  .tcon > * {
    display: block; }
  .tcon:hover, .tcon:focus {
    outline: none; }
  .tcon::-moz-focus-inner {
    border: 0; }

.tcon-plus {
  height: 40px;
  position: relative;
  -webkit-transform: scale(0.75);
  transform: scale(0.75);
  width: 40px; }
  .tcon-plus::before, .tcon-plus::after {
    content: "";
    border-radius: 2px;
    display: block;
    width: 85%;
    height: 25%;
    position: absolute;
    top: 37%;
    left: 8%;
    transition: 0.3s;
    background: white; }
  .tcon-plus:after {
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg); }

.tcon-plus--minus.tcon-transform::before {
  -webkit-transform: rotate(180deg) translate(0, 0);
  transform: rotate(180deg) translate(0, 0);
  width: 62%; }

.tcon-plus--minus.tcon-transform::after {
  -webkit-transform: rotate(-180deg) translate(-37.5%, 0);
  transform: rotate(-180deg) translate(-37.5%, 0);
  width: 62%; }

.tcon-visuallyhidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px; }
  .tcon-visuallyhidden:active, .tcon-visuallyhidden:focus {
    clip: auto;
    height: auto;
    margin: 0;
    overflow: visible;
    position: static;
    width: auto; }

</style>
</head><body>
<?php include 'header.php'; ?>
<!-- end header -->
<?php include 'slider.php'; ?>
<!-- end slider -->
<section class="appointment">
  <div class="container">
    <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
      <div class="row" >
        <div class="col-md-6 col-sm-6 col-xs-12" >
          <h3 class="toggleform" style="size:19px; color:#FFF" ><strong>Want to work with VICNA? <br>
            </strong>Register your interest here</h3>
	    <button type="button" class="tcon tcon-plus tcon-plus--minus hidden-lg hidden-md hidden-sm" aria-label="add item">
  <span class="tcon-visuallyhidden">add item</span>
</button>
        </div>
      </div>
      <div class="form-inner-div">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>First Name</label>
          <input type="text" name="fname" value="<?=$_REQUEST['fname'];?>">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>Last Name</label>
          <input type="text" name="lname" value="<?=$_REQUEST['lname'];?>">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>Phone Number</label>
          <input type="text" id="phone" name="phone" value="<?=$_REQUEST['phone'];?>">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label>E-mail</label>
          <input type="text" name="mail" value="<?=$_REQUEST['mail'];?>">
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 department">
          <label>Qualification</label>
          <select onChange="return hideshow(this.value)" onselect="return hideshow(this.value)" name="quali" >
            <option value="RN/Div">RN/Div 1</option>
            <option value="EN/EEN">EN/EEN</option>
            <option value="AIN/PCA">AIN/PCA</option>
            <option value="Dental Assistan">Dental Assistant</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 gender" id="hidden_div" style="display: none;">
          <!-- <input type="submit" style="float: left;" class="btn btn-success" value="Register">-->
          <label>Add Qualification</label>
          <input type="text" id="Qualification" value="<?=$_REQUEST['extra-quali'];?>" name="extra-quali">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12 gender">
          <input type="submit" style="float: left;" class="btn btn-success" value="Request">
        </div>
      </div>
       </div>
      <!-- <div id="hidden_div" style="display: none;" class="col-md-4">
        <label>Add Qualification</label>
        <input type="text" id="Qualification" value="Qualification" name="extra-quali">
      </div>-->
    </form>
    <!-- end form -->
  </div>
  <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end appointment -->
<!-- end home-services -->
<section class="box-content">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-12 no-padding">
        <div class="first-box">
          <div class="icon"><img src="images/icon1.png" alt="Icon"></div>
          <div class="content">
            <?php
			//Fetch About Us Details
			$FetchCmsSql4 = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '5'";
			$FetchCmsQuery4 = mysql_query($FetchCmsSql4);
			$FetchCmsRows4 = mysql_fetch_array($FetchCmsQuery4);
		?>
            <h3>
              <?=stripslashes($FetchCmsRows4['cms_page_heading'])?>
            </h3>
            <p>
              <?=substr(strip_tags(stripslashes($FetchCmsRows4['cms_pagedes'])),0,100);?>
            </p>
            <a href="client.php" class="btn-ghost-md">READ MORE</a> </div>
          <!-- end content -->
        </div>
        <!-- end first-box -->
      </div>
      <!-- end col-4 -->
      <div class="col-md-4 col-sm-4 col-xs-12 no-padding">
        <div class="second-box">
          <div class="icon"><img src="images/icon2.png" alt="Icon"></div>
          <div class="content">
            <?php
			//Fetch About Us Details
			$FetchCmsSql4 = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '6'";
			$FetchCmsQuery4 = mysql_query($FetchCmsSql4);
			$FetchCmsRows4 = mysql_fetch_array($FetchCmsQuery4);
		?>
            <h3>
              <?=stripslashes($FetchCmsRows4['cms_page_heading'])?>
            </h3>
            <p>
              <?=substr(strip_tags(stripslashes($FetchCmsRows4['cms_pagedes'])),0,100)?>
            </p>
            <a href="refer.php" class="btn-ghost-md">READ MORE</a> </div>
          <!-- end content -->
        </div>
        <!-- end second-box -->
      </div>
      <!-- end col-4 -->
      <div class="col-md-4 col-sm-4 col-xs-12 no-padding">
        <div class="third-box">
          <div class="icon"><img src="images/icon3.png" alt="Icon"></div>
          <div class="content">
            <?php
			//Fetch About Us Details
			$FetchCmsSql4 = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '7'";
			$FetchCmsQuery4 = mysql_query($FetchCmsSql4);
			$FetchCmsRows4 = mysql_fetch_array($FetchCmsQuery4);
		?>
            <h3>
              <?=stripslashes($FetchCmsRows4['cms_page_heading'])?>
            </h3>
            <p>
              <?=substr(strip_tags(stripslashes($FetchCmsRows4['cms_pagedes'])),0,100)?>
            </p>
            <a href="work.php" class="btn-ghost-md">READ MORE</a> </div>
          <!-- end content -->
        </div>
        <!-- end third-box -->
      </div>
      <!-- end col-4 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<!-- end logos -->

<!-- end footer-bar -->
<?php include'footer.php';?>
<!-- end footer -->
<script type='text/javascript' src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/wow.js"></script>
<script src="js/jqueryui.js"></script>
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
<script>
!function(n,r){"function"==typeof define&&define.amd?define(r):"object"==typeof exports?module.exports=r():n.transformicons=r()}(this||window,function(){"use strict";var n={},r="tcon-transform",t={transform:["click"],revert:["click"]},e=function(n){return"string"==typeof n?Array.prototype.slice.call(document.querySelectorAll(n)):"undefined"==typeof n||n instanceof Array?n:[n]},o=function(n){return"string"==typeof n?n.toLowerCase().split(" "):n},f=function(n,r,f){var c=(f?"remove":"add")+"EventListener",u=e(n),s=u.length,a={};for(var l in t)a[l]=r&&r[l]?o(r[l]):t[l];for(;s--;)for(var d in a)for(var v=a[d].length;v--;)u[s][c](a[d][v],i)},i=function(r){n.toggle(r.currentTarget)};return n.add=function(r,t){return f(r,t),n},n.remove=function(r,t){return f(r,t,!0),n},n.transform=function(t){return e(t).forEach(function(n){n.classList.add(r)}),n},n.revert=function(t){return e(t).forEach(function(n){n.classList.remove(r)}),n},n.toggle=function(t){return e(t).forEach(function(t){n[t.classList.contains(r)?"revert":"transform"](t)}),n},n});
</script>
<script>
function hideshow(str)
{
if(str=='Other')
{
document.getElementById('hidden_div').style.display = "block";
}
else{
document.getElementById('hidden_div').style.display = "none";
}
}
$(".toggleform,.tcon-plus").click(function(){
$(".form-inner-div").slideToggle();
$(".tcon-plus").toggleClass('tcon-transform');
})
</script>
</body>
</html>
