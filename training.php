<?php
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

</head><body>
<style>
.gh ul {
    list-style: disc;
    text-align: left;
}
.gh h3 {
    text-align: left;
}
</style>
<?php include 'header.php'; ?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '32'";
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
  <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong></h1>
  </div></div></div></section>
  <section class="header_banner">
  <img src="<?=$pic?>">
  <section class="inner-header res_btm">
  <div class="container" >
  
  </div>
</section>
 


<!--<section class="appointment">
  <div class="container">
    <form>
      <div class="row" >
        <div class="col-md-6 col-sm-6 col-xs-12" >
          <h3 style="size:19px; color:#FFF" >
          Register Your Expression of Interest
          </p>
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
 
  </div>
  
</section>-->
<!-- end inner header -->
<section class="inner-content" style="padding-bottom:27px;">
<div class="container">
<div class="row">
<!--***********************************************************************************-->
 <?php
                    $sql=  mysql_query("select * from hr_training WHERE id= '9' ");
                     $service=mysql_fetch_array($sql);
                    
						 ?>
                           <?=$service['meta_description']?>
                            <?=$service['cms_pagedes']?>
     <!-- <div class="col-xs-12 " >
      <p class="res_font"><i style="  font-size: 24px;
    text-shadow: 0 1px 2px #000; ">"The trained nurse has become one of the great blessings of humanity, taking a place beside the physician and the priest"<br ><br > – Sir William Osler</i></p>
      
      </div>
  
   <div class="col-xs-12 margin-bottom">
       
        <p>At VICNA, where our nurses are known for the quality of nursing care we provide, our Nurse Educators help the nurses with completing compulsory & relevant competencies and maintaining CPD record. At VICNA we encourage and assist our nurses with Further Education Assistance.<br>
The following mandatory competencies have been split into classifications to make it easier for our nurses to complete competencies relevant to their field of work.Email us at <a href="mailto:training@vicna.com.au">training@vicna.com.au</a> to enquire about any of the following:
</p>
      </div>-->
     <!-- <div class="col-md-6 col-sm-6 col-xs-12">
       <div class="gh">
      	<h3 class="training-gh"><strong>Patient services attendant (PSA) competencies:</strong></h3><br>
      	<ul>
        	<li>Basic Life Support</li>
            <li>Manual Handling </li>
            <li>Infection Control </li>
            <li>Fire Safety </li>
            <li>Bullying, Harassment & Discrimination</li>
            <li>Challenging Behaviour</li>
        </ul>
      </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="gh">
      	<h3 class="training-gh"><strong>Personal care worker (PCA) competencies:</strong></h3><br>
      	<ul>
        	<li>Basic Life Support</li>
            <li>Manual Handling </li>
            <li>Infection Control </li>
            <li>Fire Safety </li>
            <li>Bullying, Harassment & Discrimination</li>
            <li>Challenging Behaviour</li>
            <li>Elder Abuse</li>
            <li>Falls Prevention</li>
            <li>Use of AED’s</li>
        </ul>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="gh">
      	<h3 class="training-gh"><strong>Registered nurse (RN) & Enrolled nurse (EN) competencies:</strong></h3><br>
      	<ul>
        	<li>Basic Life Support</li>
            <li>Manual Handling </li>
            <li>Drug Calculations</li>
            <li>Nursing OH&S </li>
            <li>Infection Control </li>
            <li>Fire Safety </li>
            <li>Bullying, Harassment & Discrimination</li>
            <li>Recognising & Responding to Clinical Deterioration</li>
            <li>Advanced Life Support</li>
            <li>Use of AED’s</li>
        </ul>
      </div>
    </div>
       <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="gh">
      	<h3 class="training-gh"><strong>If you would like to work in aged care, you MUST complete these specific competencies:</strong></h3><br>
      	<ul>
            <li>Challenging Behaviour</li>      
            
            <li>Elder Abuse</li>
            <li>Falls Prevention</li>
           
           
        </ul>
        </div>
      </div>
       <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="gh">
      	<h3 class="training-gh"><strong>Additional competencies available:</strong></h3><br>
      	<ul>
        <li>Governance for Safety and Quality</li>
        <li>Partnering with Consumers</li>
       <li> Preventing and Managing Pressure Injuries</li>
       <li>Medication Safety</li>
       <li>Patients Identification and Procedure Matching</li>
      <li> Clinical Handover</li>
       <li>Blood and Blood Products</li>
       <li>Challenging Behaviour</li>      
        <li>Elder Abuse</li>
        <li>Falls Prevention</li>        
         </ul>
         </div>
      </div>-->
      
    </div>
</section>

<!-- end section -->

<!-- end footer-bar -->
<?php include 'footer.php'; ?>
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