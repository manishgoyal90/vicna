<?php include 'config/connect.php';
/*if(isset($_SESSION['userid']) && $_SESSION['userid'] != "" && isset($_SESSION['usertype']) && $_SESSION['usertype'] = "Client")
{
	header("location:clientBooking.php");
}else{
	header("location:login.php");
}*/
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
 <style>
	   .jv {
    background: #fff none repeat scroll 0 0;
    border: 2px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
}
.jv select {
    border: medium none !important;
    margin: 0 !important;
	background-position:110% !important;
	background-size: calc(37%) !important;	
}
@media(max-width:767px){
#contact-form select {
    background-position: 100% 50% !important;
    background-size: 40px !IMPORTANT;
    width: 100% !important;
    border-bottom: 1px solid #CFEFED !important;
}
#contact-form .col-md-4{
MARGIN-BOTTOM: 10px;
}
#contact-form input[type="text"] {
    width: 100% !important;
}
	</style>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head><body>
<?php include 'header.php'; ?>
<!-- end header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '26'";
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
      <div class="col-xs-12 ">
  <h1 class="title-bottom-line" style="padding-top:40px"><strong><?=$rowdest['BannerName'];?></strong></h1>
  </div></div></div></section>
  <section class="header_banner">
  <img src="<?=$pic;?>">
  </section>


<section>
  <div class="container" >
    <div class="row">
      <div class="col-xs-12">
      
        <h1></h1>
      </div>
    </div>
  </div>
</section>
 <?php
if(isset($_POST["book_a_nurse"]))
	{
		if($_SESSION['userid'] != "" && $_SESSION['usertype'] == 'Client'){
	
		if($_POST["year1"] and $_POST["month1"] and $_POST["day1"]){
		$firstShiftDate=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["day1"];}
		if($_POST["year2"] and $_POST["month2"] and $_POST["day2"]){
		$secondShiftDate=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["day2"];}
		if($_POST["year3"] and $_POST["month3"] and $_POST["day3"]){
		$thirdShiftDate=$_POST["year3"]."-".$_POST["month3"]."-".$_POST["day3"];}
		$q = "INSERT INTO book_nurse (sl, clientId, 
									  firstShiftDate, startTime1, finishTime1, word1, class1, staffReqstd1,speciality1,firstShift,
									  SecondShiftDate, startTime2, finishTime2, word2, class2, staffReqstd2,speciality2,secondShift,
									  thirdShiftDate, startTime3, finishTime3, word3, class3, staffReqstd3,speciality3,thirdShift,
									  comment,
									  dt) 
		VALUES (NULL, '".$_SESSION["userid"]."', 
'".$firstShiftDate."', '".$_POST["startTime1"]."', '".$_POST["finishTime1"]."', '".$_POST["word1"]."', '".$_POST["class1"]."', '".$_POST["staffReqstd1"]."', '".$_POST['speciality1']."','Request',
'".$secondShiftDate."', '".$_POST["startTime2"]."', '".$_POST["finishTime2"]."', '".$_POST["word2"]."', '".$_POST["class2"]."', '".$_POST["staffReqstd2"]."', '".$_POST['speciality2']."','Request',
'".$thirdShiftDate."', '".$_POST["startTime3"]."', '".$_POST["finishTime3"]."', '".$_POST["word3"]."', '".$_POST["class3"]."', '".$_POST["staffReqstd3"]."', '".$_POST['speciality3']."','Request','".$_POST["comment"]."',CURRENT_TIMESTAMP);";
		$result = mysql_query($q) ;
		if($result)	{$msgBooking="<font color='green'>Successfully Booking completed.</font>";}
		else {$msgBooking="<font color='red'>Booking unsuccessful.</font>";}
		
		}
		else{
			$msgBooking="<font color='red'>You are not a Registered Client.</font>";
		}
	}
	?>
<!-- end inner header -->
<section class="inner-content">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-8 col-xs-12">
	  <?php echo $msgBooking; ?>
        <div class="left-side">
          <h1 class="title-bottom-line"><strong>Shift Booking </strong> FORM</h1>
          <p>Facility Details.</p>
		  <?php
		  $SqlUser = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_SESSION['userid']."'";
				$result = mysql_query($SqlUser);
							
				while($row = mysql_fetch_array($result))
				{
					$FirstName=$row['FirstName'];
					$BusinessName=$row['BusinessName'];
					$Phone=$row['Phone'];
					$EmailId=$row['EmailId'];
				}
		  ?>
           <form id="contact-form" style="padding:0;" class="frm" action="" method="post">
            <input type="text" name="facilityName" id="name" placeholder="Facility name" value="<?= $BusinessName ?>">
                    <input type="text" name="requestedBy" id="surname"  placeholder="Shift/s requested by" value="<?= $FirstName ?>">
                    <input type="text" name="phone" id="phone" placeholder="Contact phone number" value="<?= $Phone ?>">
                    <input type="text" name="email" id="email" placeholder="Contact email address" value="<?= $EmailId ?>">
            <p>Shift Details</p>
            <hr>
            <label>Shift Date</label>
            <div class="col-md-4">
             
              <div class="jv row">	
            	
            	<div class="col-md-4">
                 <div class="row">
                	<select name="day1" id="day" onChange="" >
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>
                </div>
                <div class="col-md-4">
                <div class="row">
              
                	<select style="padding-left:2px;" name="month1" id="month" onChange="">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                </div>
                <div class="col-md-4">
                 <div class="row">
                	<select name="year1" id="year" onChange="" >
                    	<?php for($i = 2016; $i<=2030; $i++)
						{
						?>
                        <option value="<?=$i?>"><?=$i;?></option>
                        <?php }?>
                    </select>
                </div>
         </div>
           </div> 
            <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
            </div>
            <!-- <input type="text" class="datepicker" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" maxlength="8">-->
            <!--<input type="text" name="time" id="time" placeholder="Shift start time">-->
             
              	<select name="startTime1">
                      <option value="">Shift start time</option>
                      <option value="00:00">00:00</option>
                      <option value="00:15">00:15</option>
                      <option value="00:30">00:30</option>
                      <option value="00:45">00:45</option>
                      <option value="01:00">01:00</option>
                      <option value="01:15">01:15</option>
                      <option value="01:30">01:30</option>
                      <option value="01:45">01:45</option>
                      <option value="02:00">02:00</option>
                      <option value="02:15">02:15</option>
                      <option value="02:30">02:30</option>
                      <option value="02:45">02:45</option>
                      <option value="03:00">03:00</option>
                      <option value="03:15">03:15</option>
                      <option value="03:30">03:30</option>
                      <option value="03:45">03:45</option>
                      <option value="04:00">04:00</option>
                      <option value="04:15">04:15</option>
                      <option value="04:30">04:30</option>
                      <option value="04:45">04:45</option>
                      <option value="05:00">05:00</option>
                      <option value="05:15">05:15</option>
                      <option value="05:30">05:30</option>
                      <option value="05:45">05:45</option>
                      <option value="06:00">06:00</option>
                      <option value="06:15">06:15</option>
                      <option value="06:30">06:30</option>
                      <option value="06:45">06:45</option>
                      <option value="07:00">07:00</option>
                      <option value="07:15">07:15</option>
                      <option value="07:30">07:30</option>
                      <option value="07:45">07:45</option>
                      <option value="08:00">08:00</option>
                      <option value="08:15">08:15</option>
                      <option value="08:30">08:30</option>
                      <option value="08:45">08:45</option>
                      <option value="09:00">09:00</option>
                      <option value="09:15">09:15</option>
                      <option value="09:30">09:30</option>
                      <option value="09:45">09:45</option>
                      <option value="10:00">10:00</option>
                      <option value="10:15">10:15</option>
                      <option value="10:30">10:30</option>
                      <option value="10:45">10:45</option>
                      <option value="11:00">11:00</option>
                      <option value="11:15">11:15</option>
                      <option value="11:30">11:30</option>
                      <option value="11:45">11:45</option>
                      <option value="12:00">12:00</option>
                      <option value="12:15">12:15</option>
                      <option value="12:30">12:30</option>
                      <option value="12:45">12:45</option>
                      <option value="13:00">13:00</option>
                      <option value="13:15">13:15</option>
                      <option value="13:30">13:30</option>
                      <option value="13:45">13:45</option>
                      <option value="14:00">14:00</option>
                      <option value="14:15">14:15</option>
                      <option value="14:30">14:30</option>
                      <option value="14:45">14:45</option>
                      <option value="15:00">15:00</option>
                      <option value="15:15">15:15</option>
                      <option value="15:30">15:30</option>
                      <option value="15:45">15:45</option>
                      <option value="16:00">16:00</option>
                      <option value="16:15">16:15</option>
                      <option value="16:30">16:30</option>
                      <option value="16:45">16:45</option>
                      <option value="17:00">17:00</option>
                      <option value="17:15">17:15</option>
                      <option value="17:30">17:30</option>
                      <option value="17:45">17:45</option>
                      <option value="18:00">18:00</option>
                      <option value="18:15">18:15</option>
                      <option value="18:30">18:30</option>
                      <option value="18:45">18:45</option>
                      <option value="19:00">19:00</option>
                      <option value="19:15">19:15</option>
                      <option value="19:30">19:30</option>
                      <option value="19:45">19:45</option>
                      <option value="20:00">20:00</option>
                      <option value="20:15">20:15</option>
                      <option value="20:30">20:30</option>
                      <option value="20:45">20:45</option>
                      <option value="21:00">21:00</option>
                      <option value="21:15">21:15</option>
                      <option value="21:30">21:30</option>
                      <option value="21:45">21:45</option>
                      <option value="22:00">22:00</option>
                      <option value="22:15">22:15</option>
                      <option value="22:30">22:30</option>
                      <option value="22:45">22:45</option>
                      <option value="23:00">23:00</option>
                      <option value="23:15">23:15</option>
                      <option value="23:30">23:30</option>
                      <option value="23:45">23:45</option>
                    </select>
                    <select name="finishTime1">
                      <option value="">Shift finish time</option>
                      <option value="00:00">00:00</option>
                      <option value="00:15">00:15</option>
                      <option value="00:30">00:30</option>
                      <option value="00:45">00:45</option>
                      <option value="01:00">01:00</option>
                      <option value="01:15">01:15</option>
                      <option value="01:30">01:30</option>
                      <option value="01:45">01:45</option>
                      <option value="02:00">02:00</option>
                      <option value="02:15">02:15</option>
                      <option value="02:30">02:30</option>
                      <option value="02:45">02:45</option>
                      <option value="03:00">03:00</option>
                      <option value="03:15">03:15</option>
                      <option value="03:30">03:30</option>
                      <option value="03:45">03:45</option>
                      <option value="04:00">04:00</option>
                      <option value="04:15">04:15</option>
                      <option value="04:30">04:30</option>
                      <option value="04:45">04:45</option>
                      <option value="05:00">05:00</option>
                      <option value="05:15">05:15</option>
                      <option value="05:30">05:30</option>
                      <option value="05:45">05:45</option>
                      <option value="06:00">06:00</option>
                      <option value="06:15">06:15</option>
                      <option value="06:30">06:30</option>
                      <option value="06:45">06:45</option>
                      <option value="07:00">07:00</option>
                      <option value="07:15">07:15</option>
                      <option value="07:30">07:30</option>
                      <option value="07:45">07:45</option>
                      <option value="08:00">08:00</option>
                      <option value="08:15">08:15</option>
                      <option value="08:30">08:30</option>
                      <option value="08:45">08:45</option>
                      <option value="09:00">09:00</option>
                      <option value="09:15">09:15</option>
                      <option value="09:30">09:30</option>
                      <option value="09:45">09:45</option>
                      <option value="10:00">10:00</option>
                      <option value="10:15">10:15</option>
                      <option value="10:30">10:30</option>
                      <option value="10:45">10:45</option>
                      <option value="11:00">11:00</option>
                      <option value="11:15">11:15</option>
                      <option value="11:30">11:30</option>
                      <option value="11:45">11:45</option>
                      <option value="12:00">12:00</option>
                      <option value="12:15">12:15</option>
                      <option value="12:30">12:30</option>
                      <option value="12:45">12:45</option>
                      <option value="13:00">13:00</option>
                      <option value="13:15">13:15</option>
                      <option value="13:30">13:30</option>
                      <option value="13:45">13:45</option>
                      <option value="14:00">14:00</option>
                      <option value="14:15">14:15</option>
                      <option value="14:30">14:30</option>
                      <option value="14:45">14:45</option>
                      <option value="15:00">15:00</option>
                      <option value="15:15">15:15</option>
                      <option value="15:30">15:30</option>
                      <option value="15:45">15:45</option>
                      <option value="16:00">16:00</option>
                      <option value="16:15">16:15</option>
                      <option value="16:30">16:30</option>
                      <option value="16:45">16:45</option>
                      <option value="17:00">17:00</option>
                      <option value="17:15">17:15</option>
                      <option value="17:30">17:30</option>
                      <option value="17:45">17:45</option>
                      <option value="18:00">18:00</option>
                      <option value="18:15">18:15</option>
                      <option value="18:30">18:30</option>
                      <option value="18:45">18:45</option>
                      <option value="19:00">19:00</option>
                      <option value="19:15">19:15</option>
                      <option value="19:30">19:30</option>
                      <option value="19:45">19:45</option>
                      <option value="20:00">20:00</option>
                      <option value="20:15">20:15</option>
                      <option value="20:30">20:30</option>
                      <option value="20:45">20:45</option>
                      <option value="21:00">21:00</option>
                      <option value="21:15">21:15</option>
                      <option value="21:30">21:30</option>
                      <option value="21:45">21:45</option>
                      <option value="22:00">22:00</option>
                      <option value="22:15">22:15</option>
                      <option value="22:30">22:30</option>
                      <option value="22:45">22:45</option>
                      <option value="23:00">23:00</option>
                      <option value="23:15">23:15</option>
                      <option value="23:30">23:30</option>
                      <option value="23:45">23:45</option>
                    </select>        
					
					<!-- <input type="text" name="f-time" id="f-time" placeholder="Shift finish time">-->
             <input type="text" name="word1" id="area" placeholder="Ward / area">
                    <input type="text" name="class1" id="class" placeholder="Class (PCW / AN / EN / RN)">
                    <input type="text" name="staffReqstd1" id="staff" placeholder="Staff requested (if applicable)">
					<input type="text" name="speciality1" placeholder="Enter Speciality">
            <label>Additional Shift (tick if more shifts required)</label>
      <!--  <input name="Shift" type="checkbox"  value="Shift 2" id="Shift" ><label>Shift 2</label>-->
          <!--***************8888888*****************************************************************************************************************-->
              <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#chkPassport").click(function () {
                if ($(this).is(":checked")) {
                    $("#dvPassport").show();
                } else {
                    $("#dvPassport").hide();
                }
            });
        });
    </script>
    
    <label for="chkPassport">
        <input type="checkbox" id="chkPassport" />
    Shift 2
    </label>
    <hr />
    <div id="dvPassport" style="display: none">
      <!--  Passport Number:
        <input type="text" id="txtPassportNumber" />-->
       <label>Shift Date</label>
           <div class="col-md-4">
             
              <div class="jv row">	
            	
            	<div class="col-md-4">
                 <div class="row">
                	<select name="day2" id="day" onChange="" >
                                <option value="">select</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                </div>
                </div>
                <div class="col-md-4">
                <div class="row">
              
                	<select style="padding-left:2px;" name="month2" id="month" onChange="">
                                <option value="">Select</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                              </select>
                </div>
                </div>
                <div class="col-md-4">
                 <div class="row">
                	<select name="year2" id="year" onChange="" >
                  <?php for($i = 2016; $i<=2030; $i++)
                    
						{
						?>
                        <option value="<?=$i?>"><?=$i;?></option>
                        <?php }?>
                    </select>
                </div>
         </div>
           </div> 
            <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
            </div>
             <select name="startTime2">
                        <option value="">Shift start time</option>
                        <option value="00:00">00:00</option>
                        <option value="00:15">00:15</option>
                        <option value="00:30">00:30</option>
                        <option value="00:45">00:45</option>
                        <option value="01:00">01:00</option>
                        <option value="01:15">01:15</option>
                        <option value="01:30">01:30</option>
                        <option value="01:45">01:45</option>
                        <option value="02:00">02:00</option>
                        <option value="02:15">02:15</option>
                        <option value="02:30">02:30</option>
                        <option value="02:45">02:45</option>
                        <option value="03:00">03:00</option>
                        <option value="03:15">03:15</option>
                        <option value="03:30">03:30</option>
                        <option value="03:45">03:45</option>
                        <option value="04:00">04:00</option>
                        <option value="04:15">04:15</option>
                        <option value="04:30">04:30</option>
                        <option value="04:45">04:45</option>
                        <option value="05:00">05:00</option>
                        <option value="05:15">05:15</option>
                        <option value="05:30">05:30</option>
                        <option value="05:45">05:45</option>
                        <option value="06:00">06:00</option>
                        <option value="06:15">06:15</option>
                        <option value="06:30">06:30</option>
                        <option value="06:45">06:45</option>
                        <option value="07:00">07:00</option>
                        <option value="07:15">07:15</option>
                        <option value="07:30">07:30</option>
                        <option value="07:45">07:45</option>
                        <option value="08:00">08:00</option>
                        <option value="08:15">08:15</option>
                        <option value="08:30">08:30</option>
                        <option value="08:45">08:45</option>
                        <option value="09:00">09:00</option>
                        <option value="09:15">09:15</option>
                        <option value="09:30">09:30</option>
                        <option value="09:45">09:45</option>
                        <option value="10:00">10:00</option>
                        <option value="10:15">10:15</option>
                        <option value="10:30">10:30</option>
                        <option value="10:45">10:45</option>
                        <option value="11:00">11:00</option>
                        <option value="11:15">11:15</option>
                        <option value="11:30">11:30</option>
                        <option value="11:45">11:45</option>
                        <option value="12:00">12:00</option>
                        <option value="12:15">12:15</option>
                        <option value="12:30">12:30</option>
                        <option value="12:45">12:45</option>
                        <option value="13:00">13:00</option>
                        <option value="13:15">13:15</option>
                        <option value="13:30">13:30</option>
                        <option value="13:45">13:45</option>
                        <option value="14:00">14:00</option>
                        <option value="14:15">14:15</option>
                        <option value="14:30">14:30</option>
                        <option value="14:45">14:45</option>
                        <option value="15:00">15:00</option>
                        <option value="15:15">15:15</option>
                        <option value="15:30">15:30</option>
                        <option value="15:45">15:45</option>
                        <option value="16:00">16:00</option>
                        <option value="16:15">16:15</option>
                        <option value="16:30">16:30</option>
                        <option value="16:45">16:45</option>
                        <option value="17:00">17:00</option>
                        <option value="17:15">17:15</option>
                        <option value="17:30">17:30</option>
                        <option value="17:45">17:45</option>
                        <option value="18:00">18:00</option>
                        <option value="18:15">18:15</option>
                        <option value="18:30">18:30</option>
                        <option value="18:45">18:45</option>
                        <option value="19:00">19:00</option>
                        <option value="19:15">19:15</option>
                        <option value="19:30">19:30</option>
                        <option value="19:45">19:45</option>
                        <option value="20:00">20:00</option>
                        <option value="20:15">20:15</option>
                        <option value="20:30">20:30</option>
                        <option value="20:45">20:45</option>
                        <option value="21:00">21:00</option>
                        <option value="21:15">21:15</option>
                        <option value="21:30">21:30</option>
                        <option value="21:45">21:45</option>
                        <option value="22:00">22:00</option>
                        <option value="22:15">22:15</option>
                        <option value="22:30">22:30</option>
                        <option value="22:45">22:45</option>
                        <option value="23:00">23:00</option>
                        <option value="23:15">23:15</option>
                        <option value="23:30">23:30</option>
                        <option value="23:45">23:45</option>
                      </select>
                      <!--<input type="text" name="finishTime2" id="f-time" placeholder="Shift finish time">-->
                      <select name="finishTime2">
                        <option value="">Shift finish time</option>
                        <option value="00:00">00:00</option>
                        <option value="00:15">00:15</option>
                        <option value="00:30">00:30</option>
                        <option value="00:45">00:45</option>
                        <option value="01:00">01:00</option>
                        <option value="01:15">01:15</option>
                        <option value="01:30">01:30</option>
                        <option value="01:45">01:45</option>
                        <option value="02:00">02:00</option>
                        <option value="02:15">02:15</option>
                        <option value="02:30">02:30</option>
                        <option value="02:45">02:45</option>
                        <option value="03:00">03:00</option>
                        <option value="03:15">03:15</option>
                        <option value="03:30">03:30</option>
                        <option value="03:45">03:45</option>
                        <option value="04:00">04:00</option>
                        <option value="04:15">04:15</option>
                        <option value="04:30">04:30</option>
                        <option value="04:45">04:45</option>
                        <option value="05:00">05:00</option>
                        <option value="05:15">05:15</option>
                        <option value="05:30">05:30</option>
                        <option value="05:45">05:45</option>
                        <option value="06:00">06:00</option>
                        <option value="06:15">06:15</option>
                        <option value="06:30">06:30</option>
                        <option value="06:45">06:45</option>
                        <option value="07:00">07:00</option>
                        <option value="07:15">07:15</option>
                        <option value="07:30">07:30</option>
                        <option value="07:45">07:45</option>
                        <option value="08:00">08:00</option>
                        <option value="08:15">08:15</option>
                        <option value="08:30">08:30</option>
                        <option value="08:45">08:45</option>
                        <option value="09:00">09:00</option>
                        <option value="09:15">09:15</option>
                        <option value="09:30">09:30</option>
                        <option value="09:45">09:45</option>
                        <option value="10:00">10:00</option>
                        <option value="10:15">10:15</option>
                        <option value="10:30">10:30</option>
                        <option value="10:45">10:45</option>
                        <option value="11:00">11:00</option>
                        <option value="11:15">11:15</option>
                        <option value="11:30">11:30</option>
                        <option value="11:45">11:45</option>
                        <option value="12:00">12:00</option>
                        <option value="12:15">12:15</option>
                        <option value="12:30">12:30</option>
                        <option value="12:45">12:45</option>
                        <option value="13:00">13:00</option>
                        <option value="13:15">13:15</option>
                        <option value="13:30">13:30</option>
                        <option value="13:45">13:45</option>
                        <option value="14:00">14:00</option>
                        <option value="14:15">14:15</option>
                        <option value="14:30">14:30</option>
                        <option value="14:45">14:45</option>
                        <option value="15:00">15:00</option>
                        <option value="15:15">15:15</option>
                        <option value="15:30">15:30</option>
                        <option value="15:45">15:45</option>
                        <option value="16:00">16:00</option>
                        <option value="16:15">16:15</option>
                        <option value="16:30">16:30</option>
                        <option value="16:45">16:45</option>
                        <option value="17:00">17:00</option>
                        <option value="17:15">17:15</option>
                        <option value="17:30">17:30</option>
                        <option value="17:45">17:45</option>
                        <option value="18:00">18:00</option>
                        <option value="18:15">18:15</option>
                        <option value="18:30">18:30</option>
                        <option value="18:45">18:45</option>
                        <option value="19:00">19:00</option>
                        <option value="19:15">19:15</option>
                        <option value="19:30">19:30</option>
                        <option value="19:45">19:45</option>
                        <option value="20:00">20:00</option>
                        <option value="20:15">20:15</option>
                        <option value="20:30">20:30</option>
                        <option value="20:45">20:45</option>
                        <option value="21:00">21:00</option>
                        <option value="21:15">21:15</option>
                        <option value="21:30">21:30</option>
                        <option value="21:45">21:45</option>
                        <option value="22:00">22:00</option>
                        <option value="22:15">22:15</option>
                        <option value="22:30">22:30</option>
                        <option value="22:45">22:45</option>
                        <option value="23:00">23:00</option>
                        <option value="23:15">23:15</option>
                        <option value="23:30">23:30</option>
                        <option value="23:45">23:45</option>
                      </select>
                      <input type="text" name="word2" id="area" placeholder="Ward / area">
                      <input type="text" name="class2" id="class" placeholder="Class (PCW / AN / EN / RN)">
                      <input type="text" name=" staffReqstd2" id="staff" placeholder="Staff requested (if applicable)">
					  <input type="text" name="speciality2" placeholder="Enter Speciality">
        <!--***************8888888*****************************************************************************************************************-->
           <!--   <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
    <script type="text/javascript">
        $(function () {
            $("#chkPassport1").click(function () {
                if ($(this).is(":checked")) {
                    $("#dvPassport1").show();
                } else {
                    $("#dvPassport1").hide();
                }
            });
        });
    </script>
    
    <label for="chkPassport1">
        <input type="checkbox" id="chkPassport1" />
    Shift 3
    </label>
    <hr />
    <div id="dvPassport1" style="display: none">
      <!--  Passport Number:
        <input type="text" id="txtPassportNumber" />-->
       <label>Shift Date</label>
              <div class="col-md-4">
             
              <div class="jv row">	
            	
            	<div class="col-md-4">
                 <div class="row">
                	<select name="day3" id="day" onChange="" >
                                  <option value="">select</option>
                                  <option value="01">01</option>
                                  <option value="02">02</option>
                                  <option value="03">03</option>
                                  <option value="04">04</option>
                                  <option value="05">05</option>
                                  <option value="06">06</option>
                                  <option value="07">07</option>
                                  <option value="08">08</option>
                                  <option value="09">09</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                                  <option value="26">26</option>
                                  <option value="27">27</option>
                                  <option value="28">28</option>
                                  <option value="29">29</option>
                                  <option value="30">30</option>
                                  <option value="31">31</option>
                                </select>
                </div>
                </div>
                <div class="col-md-4">
                <div class="row">
              
                	<select style="padding-left:2px;" name="month3" id="month" onChange="">
                                  <option value="">select</option>
                                  <option value="01">January</option>
                                  <option value="02">February</option>
                                  <option value="03">March</option>
                                  <option value="04">April</option>
                                  <option value="05">May</option>
                                  <option value="06">June</option>
                                  <option value="07">July</option>
                                  <option value="08">August</option>
                                  <option value="09">September</option>
                                  <option value="10">October</option>
                                  <option value="11">November</option>
                                  <option value="12">December</option>
                                </select>
                </div>
                </div>
                <div class="col-md-4">
                 <div class="row">
                	<select name="year3" id="year" onChange="" >
                    	<?php for($i = 2016; $i<=2030; $i++)
						{
						?>
                        <option value="<?=$i?>"><?=$i;?></option>
                        <?php }?>
                    </select>
                </div>
         </div>
           </div> 
            <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
            </div>
            <select name="startTime3">
                          <option value="">Shift start time</option>
                          <option value="00:00">00:00</option>
                          <option value="00:15">00:15</option>
                          <option value="00:30">00:30</option>
                          <option value="00:45">00:45</option>
                          <option value="01:00">01:00</option>
                          <option value="01:15">01:15</option>
                          <option value="01:30">01:30</option>
                          <option value="01:45">01:45</option>
                          <option value="02:00">02:00</option>
                          <option value="02:15">02:15</option>
                          <option value="02:30">02:30</option>
                          <option value="02:45">02:45</option>
                          <option value="03:00">03:00</option>
                          <option value="03:15">03:15</option>
                          <option value="03:30">03:30</option>
                          <option value="03:45">03:45</option>
                          <option value="04:00">04:00</option>
                          <option value="04:15">04:15</option>
                          <option value="04:30">04:30</option>
                          <option value="04:45">04:45</option>
                          <option value="05:00">05:00</option>
                          <option value="05:15">05:15</option>
                          <option value="05:30">05:30</option>
                          <option value="05:45">05:45</option>
                          <option value="06:00">06:00</option>
                          <option value="06:15">06:15</option>
                          <option value="06:30">06:30</option>
                           <option value="06:45">06:45</option>
                        	<option value="07:00">07:00</option>
                          <option value="07:15">07:15</option>
                          <option value="07:30">07:30</option>
                          <option value="07:45">07:45</option>
                          <option value="08:00">08:00</option>
                          <option value="08:15">08:15</option>
                          <option value="08:30">08:30</option>
                          <option value="08:45">08:45</option>
                          <option value="09:00">09:00</option>
                          <option value="09:15">09:15</option>
                          <option value="09:30">09:30</option>
                          <option value="09:45">09:45</option>
                          <option value="10:00">10:00</option>
                          <option value="10:15">10:15</option>
                          <option value="10:30">10:30</option>
                          <option value="10:45">10:45</option>
                          <option value="11:00">11:00</option>
                          <option value="11:15">11:15</option>
                          <option value="11:30">11:30</option>
                          <option value="11:45">11:45</option>
                          <option value="12:00">12:00</option>
                          <option value="12:15">12:15</option>
                          <option value="12:30">12:30</option>
                          <option value="12:45">12:45</option>
                          <option value="13:00">13:00</option>
                          <option value="13:15">13:15</option>
                          <option value="13:30">13:30</option>
                          <option value="13:45">13:45</option>
                          <option value="14:00">14:00</option>
                          <option value="14:15">14:15</option>
                          <option value="14:30">14:30</option>
                          <option value="14:45">14:45</option>
                          <option value="15:00">15:00</option>
                          <option value="15:15">15:15</option>
                          <option value="15:30">15:30</option>
                          <option value="15:45">15:45</option>
                          <option value="16:00">16:00</option>
                          <option value="16:15">16:15</option>
                          <option value="16:30">16:30</option>
                          <option value="16:45">16:45</option>
                          <option value="17:00">17:00</option>
                          <option value="17:15">17:15</option>
                          <option value="17:30">17:30</option>
                          <option value="17:45">17:45</option>
                          <option value="18:00">18:00</option>
                          <option value="18:15">18:15</option>
                          <option value="18:30">18:30</option>
                          <option value="18:45">18:45</option>
                          <option value="19:00">19:00</option>
                          <option value="19:15">19:15</option>
                          <option value="19:30">19:30</option>
                          <option value="19:45">19:45</option>
                          <option value="20:00">20:00</option>
                          <option value="20:15">20:15</option>
                          <option value="20:30">20:30</option>
                          <option value="20:45">20:45</option>
                          <option value="21:00">21:00</option>
                          <option value="21:15">21:15</option>
                          <option value="21:30">21:30</option>
                          <option value="21:45">21:45</option>
                          <option value="22:00">22:00</option>
                          <option value="22:15">22:15</option>
                          <option value="22:30">22:30</option>
                          <option value="22:45">22:45</option>
                          <option value="23:00">23:00</option>
                          <option value="23:15">23:15</option>
                          <option value="23:30">23:30</option>
                          <option value="23:45">23:45</option>
                        </select>
                        <!-- <input type="text" name="finishTime3" id="f-time" placeholder="Shift finish time">-->
                        <select name="finishTime3">
                          <option value="">Shift finish time</option>
                          <option value="00:00">00:00</option>
                          <option value="00:15">00:15</option>
                          <option value="00:30">00:30</option>
                          <option value="00:45">00:45</option>
                          <option value="01:00">01:00</option>
                          <option value="01:15">01:15</option>
                          <option value="01:30">01:30</option>
                          <option value="01:45">01:45</option>
                          <option value="02:00">02:00</option>
                          <option value="02:15">02:15</option>
                          <option value="02:30">02:30</option>
                          <option value="02:45">02:45</option>
                          <option value="03:00">03:00</option>
                          <option value="03:15">03:15</option>
                          <option value="03:30">03:30</option>
                          <option value="03:45">03:45</option>
                          <option value="04:00">04:00</option>
                          <option value="04:15">04:15</option>
                          <option value="04:30">04:30</option>
                          <option value="04:45">04:45</option>
                          <option value="05:00">05:00</option>
                          <option value="05:15">05:15</option>
                          <option value="05:30">05:30</option>
                          <option value="05:45">05:45</option>
                          <option value="06:00">06:00</option>
                          <option value="06:15">06:15</option>
                          <option value="06:30">06:30</option>
                          <option value="06:45">06:45</option>
                       	  <option value="07:00">07:00</option>
                          <option value="07:15">07:15</option>
                          <option value="07:30">07:30</option>
                          <option value="07:45">07:45</option>
                          <option value="08:00">08:00</option>
                          <option value="08:15">08:15</option>
                          <option value="08:30">08:30</option>
                          <option value="08:45">08:45</option>
                          <option value="09:00">09:00</option>
                          <option value="09:15">09:15</option>
                          <option value="09:30">09:30</option>
                          <option value="09:45">09:45</option>
                          <option value="10:00">10:00</option>
                          <option value="10:15">10:15</option>
                          <option value="10:30">10:30</option>
                          <option value="10:45">10:45</option>
                          <option value="11:00">11:00</option>
                          <option value="11:15">11:15</option>
                          <option value="11:30">11:30</option>
                          <option value="11:45">11:45</option>
                          <option value="12:00">12:00</option>
                          <option value="12:15">12:15</option>
                          <option value="12:30">12:30</option>
                          <option value="12:45">12:45</option>
                          <option value="13:00">13:00</option>
                          <option value="13:15">13:15</option>
                          <option value="13:30">13:30</option>
                          <option value="13:45">13:45</option>
                          <option value="14:00">14:00</option>
                          <option value="14:15">14:15</option>
                          <option value="14:30">14:30</option>
                          <option value="14:45">14:45</option>
                          <option value="15:00">15:00</option>
                          <option value="15:15">15:15</option>
                          <option value="15:30">15:30</option>
                          <option value="15:45">15:45</option>
                          <option value="16:00">16:00</option>
                          <option value="16:15">16:15</option>
                          <option value="16:30">16:30</option>
                          <option value="16:45">16:45</option>
                          <option value="17:00">17:00</option>
                          <option value="17:15">17:15</option>
                          <option value="17:30">17:30</option>
                          <option value="17:45">17:45</option>
                          <option value="18:00">18:00</option>
                          <option value="18:15">18:15</option>
                          <option value="18:30">18:30</option>
                          <option value="18:45">18:45</option>
                          <option value="19:00">19:00</option>
                          <option value="19:15">19:15</option>
                          <option value="19:30">19:30</option>
                          <option value="19:45">19:45</option>
                          <option value="20:00">20:00</option>
                          <option value="20:15">20:15</option>
                          <option value="20:30">20:30</option>
                          <option value="20:45">20:45</option>
                          <option value="21:00">21:00</option>
                          <option value="21:15">21:15</option>
                          <option value="21:30">21:30</option>
                          <option value="21:45">21:45</option>
                          <option value="22:00">22:00</option>
                          <option value="22:15">22:15</option>
                          <option value="22:30">22:30</option>
                          <option value="22:45">22:45</option>
                          <option value="23:00">23:00</option>
                          <option value="23:15">23:15</option>
                          <option value="23:30">23:30</option>
                          <option value="23:45">23:45</option>
                        </select>
                        <input type="text" name="word3" id="area" placeholder="Ward / area">
                        <input type="text" name="class3" id="class" placeholder="Class (PCW / AN / EN / RN)">
                        <input type="text" name="staffReqstd3" id="staff" placeholder="Staff requested (if applicable)">
						<input type="text" name="speciality3" placeholder="Enter Speciality">
    </div>

<!--*******************8888888*********************************************************************************************************-->
    </div>

<!--*******************8888888*********************************************************************************************************-->

           <!-- <input type="text" name="subject" id="subject" placeholder="What is your contact reason" class="subject">-->
           <label>Comments</label>
           <hr>
            <textarea name="comment" id="message" placeholder="Comments / details"></textarea>
                    <input type="hidden" name="send" value="1">
                    <input  type="submit" name="book_a_nurse" value="SEND IT" style="font-size:13px;">
          
          <div id="success">
            <p>Your message was sent successfully! We will be in touch as soon as we can.</p>
          </div>
          <div id="error">
            <p>Something went wrong, try refreshing and submitting the form again.</p>
          </div>
        </div>
      </div>
	  </form>
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
			  <?php
				$cms = mysql_fetch_array(mysql_query("SELECT cms_pagedes FROM hr_cms WHERE id='2'"));
				//print_r($cms);
				?>
                <div class="panel-body gray-bg">
				<div role="tabpanel" class="tab-pane" id="map">
				  <address>
				  <?=stripslashes($cms['cms_pagedes']);?>
				  </address>
				 				 
				</div>
                  <p style="color:#993300;">  <?php echo strip_tags(stripslashes($cms['cms_pagedes']));?></p>	
                 <?php
				  $phone = mysql_fetch_array(mysql_query("SELECT cms_pagedes FROM hr_cms WHERE id='4'"));
				  ?>
               
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
<!--<script src="js/jquery.form.js"></script> -->
<script src="js/jquery.validate.min.js"></script> 
<script>

$(document).ready(function(){

  $("address").each(function(){                         

    var embed ="<iframe width='333' height='243' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&amp;output=embed'></iframe>";

    $(this).html(embed);
                   

   });

});

</script>
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