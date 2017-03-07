<?php session_start();
if($_SESSION["userid"]){}else{header('Location: login.php');exit();}
	include"config/connect.php";
	
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
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<noscript>
<link rel="stylesheet" type="text/css" href="css/styleNoJS.css" />
</noscript>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
        <style type="text/css">

		.pg-normal { 
		color: #000000; 
		font-size: 15px; 
		cursor: pointer; 
		background: #D0B389; 
		padding: 2px 4px 2px 4px; 
		}
		
		.pg-selected { 
		color: #fff; 
		font-size: 15px; 
		background: #000000; 
		padding: 2px 4px 2px 4px; 
		}
		
		table.yui { 
		font-family:arial; 
		border-collapse:collapse; 
		border: solid 3px #7f7f7f; 
		font-size:small; 
		}
		
		table.yui td { 
		padding: 5px; 
		border-right: solid 1px #7f7f7f; 
		}
		
		table.yui .even { 
		background-color: #EEE8AC; 
		}
		
		table.yui .odd { 
		background-color: #F9FAD0; 
		}
		
		table.yui th { 
		border: 1px solid #7f7f7f; 
		padding: 5px; 
		height: auto; 
		background: #D0B389; 
		}
		
		table.yui th a { 
		text-decoration: none; 
		text-align: center; 
		padding-right: 20px; 
		font-weight:bold; 
		white-space:nowrap; 
		}
		
		table.yui tfoot td { 
		border-top: 1px solid #7f7f7f; 
		background-color:#E1ECF9; 
		}
		
		table.yui thead td { 
		vertical-align:middle; 
		background-color:#E1ECF9; 
		border:none; 
		}
		
		table.yui thead .tableHeader { 
		font-size:larger; 
		font-weight:bold; 
		}
		
		table.yui thead .filter { 
		text-align:right; 
		}
		
		table.yui tfoot { 
		background-color:#E1ECF9; 
		text-align:center; 
		}
		
		table.yui .tablesorterPager { 
		padding: 10px 0 10px 0; 
		}
		
		table.yui .tablesorterPager span { 
		padding: 0 5px 0 5px; 
		}
		
		table.yui .tablesorterPager input.prev { 
		width: auto; 
		margin-right: 10px; 
		}
		
		table.yui .tablesorterPager input.next { 
		width: auto; 
		margin-left: 10px; 
		}
		
		table.yui .pagedisplay { 
		font-size:10pt; 
		width: 30px; 
		border: 0px; 
		background-color: #E1ECF9; 
		text-align:center; 
		vertical-align:top; 
		}
		</style>
	<script type="text/javascript">

		function Pager(tableName, itemsPerPage) {
		
		this.tableName = tableName;
		
		this.itemsPerPage = itemsPerPage;
		
		this.currentPage = 1;
		
		this.pages = 0;
		
		this.inited = false;
		
		this.showRecords = function(from, to) {
		
		var rows = document.getElementById(tableName).rows;
		
		// i starts from 1 to skip table header row
		
		for (var i = 1; i < rows.length; i++) {
		
		if (i < from || i > to)
		
		rows[i].style.display = 'none';
		
		else
		
		rows[i].style.display = '';
		
		}
		
		}
		
		this.showPage = function(pageNumber) {
		
		if (! this.inited) {
		
		alert("not inited");
		
		return;
		
		}
		
		var oldPageAnchor = document.getElementById('pg'+this.currentPage);
		
		oldPageAnchor.className = 'pg-normal';
		
		this.currentPage = pageNumber;
		
		var newPageAnchor = document.getElementById('pg'+this.currentPage);
		
		newPageAnchor.className = 'pg-selected';
		
		var from = (pageNumber - 1) * itemsPerPage + 1;
		
		var to = from + itemsPerPage - 1;
		
		this.showRecords(from, to);
		
		}
		
		this.prev = function() {
		
		if (this.currentPage > 1)
		
		this.showPage(this.currentPage - 1);
		
		}
		
		this.next = function() {
		
		if (this.currentPage < this.pages) {
		
		this.showPage(this.currentPage + 1);
		
		}
		
		}
		
		this.init = function() {
		
		var rows = document.getElementById(tableName).rows;
		
		var records = (rows.length - 1);
		
		this.pages = Math.ceil(records / itemsPerPage);
		
		this.inited = true;
		
		}
		
		this.showPageNav = function(pagerName, positionId) {
		
		if (! this.inited) {
		
		alert("not inited");
		
		return;
		
		}
		
		var element = document.getElementById(positionId);
		
		var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal"> « Prev </span> ';
		
		for (var page = 1; page <= this.pages; page++)
		
		pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span> ';
		
		pagerHtml += '<span onclick="'+pagerName+'.next();" class="pg-normal"> Next »</span>';
		
		element.innerHTML = pagerHtml;
		
		}
		
		}
		
		</script>
</head>
<body>
<?php include'headerLoginClient.php';?>
<!-- end header -->
<!-- end inner header -->
<section class="latest-news">
  <div class="container">
    <div class="row">
      <!-- ************************************************************************************************************************************-->
      <div class="col-lg-10 col-sm-10 pull-center col-md-offset-1" >
        <div class="card hovercard"  style="background:url(images/bg.jpg);">
          <div class="card-background"> <img class="card-bkimg" alt="" > </div>
          <div class="useravatar"> <img alt="" src="images/profile_pic.jpg"> </div>
          <div class="card-info"> <span class="card-title"><?php echo $FirstName; ?></span> </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" id="profile" class="btn btn-default" href="#tab1" data-toggle="tab" 
            onclick="location.href = 'clientProfile.php';"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <div class="hidden-xs">Profile</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" id="Booking" class="btn btn-primary" href="#tab2" data-toggle="tab"
            onclick="location.href = 'clientBooking.php';"
            ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <div class="hidden-xs">Booking</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" id="account" class="btn btn-default" href="#tab3" data-toggle="tab"
            onclick="location.href = 'clientBilling.php';"
            ><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            <div class="hidden-xs">Account &amp; billing</div>
            </button>
          </div>
        </div>
        <div class="well">
          <div class="tab-content">
            <h3>Booking</h3>
            <!-- ------------------------------------bgooking------------------------------------------------------------------ -->
            <!-- ____________________________________________________book a nurse_______________________________________________________________-->
            <!-- end inner header -->
            <?php
if(isset($_POST["book_a_nurse"]))
	{
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
'".$thirdShiftDate."', '".$_POST["startTime3"]."', '".$_POST["finishTime3"]."', '".$_POST["word3"]."', '".$_POST["class3"]."', '".$_POST["staffReqstd3"]."', '".$_POST['speciality3']."','Request',

'".$_POST["comment"]."',CURRENT_TIMESTAMP);";
		$result = mysql_query($q) ;
		if($result)	{
			echo '<script>alert("Booking Process Completed Successfully. Thank you.");</script>';
			echo '<script>window.location.href="clientBooking.php";</script>';
			exit();
			//$msgBooking="<font color='green'>Successfully Booking completed.</font>";
		}
		else {
			echo '<script>alert("Sorry! Booking Process Not Completed.");</script>';
			echo '<script>windows.location.href="clientBooking.php";</script>';
			exit();
			//$msgBooking="<font color='red'>Booking unsuccessful.</font>";
		}
	}
	?>
            <?php  		$SqlUser = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_SESSION['userid']."'";
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
              <div class="row"> <?php //echo $msgBooking; ?>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="left-side">
                    <!--<h1 class="title-bottom-line"><strong>Shift Booking </strong> FORM</h1>-->
                    <p>Facility Details.</p>
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
                            <select name="day1" id="day1" onChange="" >
                              <option value="">Select</option>
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
                            <select style="padding-left:2px;" name="month1" id="month1" onChange="">
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
                            <select name="year1" id="year1" onChange="" >
                              <option value="">select</option>
                              <?php for($i = 2016; $i<=2030; $i++)
						{
						?>
                              <option value="<?=$i?>">
                              <?=$i;?>
                              </option>
                              <?php }?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
                    </div>
                    <!-- <input type="text" class="datepicker" data-date-format="mm/dd/yyyy" placeholder="mm/dd/yyyy" maxlength="8">-->
                    <!--<input type="text" name="time" id="time" placeholder="Shift start time">-->
                    <select name="startTime1" id="startTime1">
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
                    <select name="finishTime1" id="finishTime1">
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
                    <input type="text" name="word1" id="area1" placeholder="Ward / area">
                    <input type="text" name="class1" id="class1" placeholder="Class (PCW / AN / EN / RN)">
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
                    Shift 2 </label>
                    <hr />
                    <div id="dvPassport" style="display: none">
                      <!--  Passport Number:
        <input type="text" id="txtPassportNumber" />-->
                      <label>Shift Date</label>
                      <div class="col-md-4">
                        <div class="jv row">
                          <div class="col-md-4">
                            <div class="row">
                              <select name="day2" id="day2" onChange="" >
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
                              <select style="padding-left:2px;" name="month2" id="month2" onChange="">
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
                              <select name="year2" id="year2" onChange="" >
                                <option value="">Select</option>
                                <?php for($i = 2016; $i<=2030; $i++)
                    
						{
						?>
                                <option value="<?=$i?>">
                                <?=$i;?>
                                </option>
                                <?php }?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
                      </div>
                      <!-- <input type="text" name="startTime2" id="time" placeholder="Shift start time">-->
                      <select name="startTime2" id="startTime2">
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
                      <select name="finishTime2" id="finishTime2">
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
                      <input type="text" name="word2" id="area2" placeholder="Ward / area">
                      <input type="text" name="class2" id="class2" placeholder="Class (PCW / AN / EN / RN)">
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
                      Shift 3 </label>
                      <hr />
                      <div id="dvPassport1" style="display: none">
                        <!--  Passport Number:
        <input type="text" id="txtPassportNumber" />-->
                        <label>Shift Date</label>
                        <div class="col-md-4">
                          <div class="jv row">
                            <div class="col-md-4">
                              <div class="row">
                                <select name="day3" id="day3" onChange="" >
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
                                <select style="padding-left:2px;" name="month3" id="month3" onChange="">
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
                                <select name="year3" id="year3" onChange="" >
                                  <option value="">select</option>
                                  <?php for($i = 2016; $i<=2030; $i++)
						{
						?>
                                  <option value="<?=$i?>">
                                  <?=$i;?>
                                  </option>
                                  <?php }?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
                        </div>
                        <!--<input type="text" name="startTime3" id="time" placeholder="Shift start time">-->
                        <select name="startTime3" id="startTime3">
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
                        <select name="finishTime3" id="finishTime3">
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
                        <input type="text" name="word3" id="area3" placeholder="Ward / area">
                        <input type="text" name="class3" id="class3" placeholder="Class (PCW / AN / EN / RN)">
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
                    <input  type="submit" name="book_a_nurse" value="SEND IT" id="sendit" style="font-size:13px;">
                    <div id="success">
                      <p>Your message was sent successfully! We will be in touch as soon as we can.</p>
                    </div>
                    <div id="error">
                      <p>Something went wrong, try refreshing and submitting the form again.</p>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <!-- end row -->
            <!-- ___________________________________________________end book a nurse_________________________________________________________-->
            <!-- __________________________________________________manage booking_________________________________________________________-->
            <br>
            <button data-toggle="collapse" data-target="#demo" style="width:200px; margin:3px;">Manage booking</button>
            <div id="demo" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;"> <font color="#666666" size="+1">Manage booking</font>
              <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                  <tr>
                    <th class="hidden-480">Qualification</th>
                    <th class="hidden-480">Location</th>
                    <th class="hidden-480">Speciality</th>
                    <th class="hidden-480">Date & Day</th>
                    <th class="hidden-480">Time of Shift</th>
                    <th class="hidden-480">VICNA Staff</th>
                    <th class="hidden-480">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
									$ctn = 1;
								$GetUserSql = "SELECT * FROM book_nurse WHERE clientId = '".$_SESSION['userid']."' AND (firstShiftDate > NOW() OR secondShiftDate > NOW() OR thirdShiftDate > NOW()) ORDER BY sl DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
									
									$today = date('Y-m-d');
											
									
				if($rowdest['firstShiftDate'] != "" && $rowdest['firstShiftDate'] > $today && $rowdest['firstShift'] == 'Request'){
				
				$stuffId = mysql_fetch_array(mysql_query("SELECT sl,stuffId,clientResponse FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '1' AND  toDate LIKE '".$rowdest['firstShiftDate']."%'"));
					$clientName = mysql_fetch_array(mysql_query("SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId['stuffId'].""));
				?>
                  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                       <?=$rowdest['speciality1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['firstShiftDate'])).'<br/>'.date('l',strtotime($rowdest['firstShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime1'];?><br/>
					   Finish : <?=$rowdest['finishTime1'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?php if($clientName != ""){echo $clientName['FirstName'].' '.$clientName['LastName'];}
							elseif($rowdest['staffReqstd1'] != ""){echo $rowdest['staffReqstd1'];}else{echo 'N/A';}?>
					</div></td><td><?php if($clientName == ""){?><button type="button" class="glyphicon glyphicon-remove" title="CANCEL" onClick="return bookingCancel(<?=$rowdest['sl']?>, 'firstShift');" style="color:#CC0000;"></button> <?php }?></td>
                  </tr>
			<?php
			}
			 if($rowdest['secondShiftDate'] != "" && $rowdest['secondShiftDate'] > $today && $rowdest['secondShift'] == 'Request'){
			 $stuffId = mysql_fetch_array(mysql_query("SELECT sl,stuffId,clientResponse FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '2' AND  toDate LIKE '".$rowdest['secondShiftDate']."%'"));
					$clientName = mysql_fetch_array(mysql_query("SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId['stuffId'].""));
			 ?>
				  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['speciality2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['secondShiftDate'])).'<br/>'.date('l',strtotime($rowdest['secondShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime2'];?><br/>
					   Finish : <?=$rowdest['finishTime2'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?php  if($clientName != ""){echo $clientName['FirstName'].' '.$clientName['LastName'];}
							elseif($rowdest['staffReqstd2'] != ""){echo $rowdest['staffReqstd2'];}else{echo 'N/A';}?>
					</div></td><td><?php if($clientName == ""){?><button type="button" class="glyphicon glyphicon-remove" title="CANCEL" onClick="return bookingCancel(<?=$rowdest['sl']?>, 'secondShift');" style="color:#CC0000;"></button><?php }?></td>
                  </tr>
			<?php }
			if($rowdest['thirdShiftDate'] != "" && $rowdest['thirdShiftDate'] > $today && $rowdest['thirdShift'] == 'Request'){
			
				$stuffId = mysql_fetch_array(mysql_query("SELECT sl,stuffId,clientResponse FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '3' AND  toDate LIKE '".$rowdest['thirdShiftDate']."%'"));
					$clientName = mysql_fetch_array(mysql_query("SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId['stuffId'].""));
			?>
			
				  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['speciality3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['thirdShiftDate'])).'<br/>'.date('l',strtotime($rowdest['thirdShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime3'];?><br/>
					   Finish : <?=$rowdest['finishTime3'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?php if($clientName != ""){echo $clientName['FirstName'].' '.$clientName['LastName'];}
							elseif($rowdest['staffReqstd3'] != ""){echo $rowdest['staffReqstd3'];}else{echo 'N/A';}?>
					</div></td>
					<td><?php if($clientName == ""){?><button type="button" class="glyphicon glyphicon-remove" title="CANCEL" onClick="return bookingCancel(<?=$rowdest['sl']?>, 'thirdShift');" style="color:#CC0000;"></button><?php }?></td>
                  </tr>
                  <?php 
				  }
				  $ctn++; } ?>
                </tbody>
              </table>
              <!--<a href="#" > Make another booking</a>--> </div>
            <!-- _________________________________________________end_manage booking_________________________________________________________-->
            <!-- __________________________________________________Completed Shifts_________________________________________________________-->
            <br>
            <button data-toggle="collapse" data-target="#demo1" style=" width:200px; margin:3px;">Completed Shifts</button>
            <div id="demo1" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;"> <font color="#666666" size="+1">Completed Shifts</font>
				<table class="table table-striped table-bordered table-hover" id="tablepaging">
                <thead>
                  <tr>
                    <th class="hidden-480">Qualification</th>
                    <th class="hidden-480">Location</th>
                    <th class="hidden-480">Speciality</th>
                    <th class="hidden-480">Date & Day</th>
                    <th class="hidden-480">Time of Shift</th>
                    <th class="hidden-480">VICNA Staff</th>
                    <th class="hidden-480">Action</th>
                  </tr>
                </thead>
				<tbody>
					<?php 
					$ctn = 1;
					$fetSql = mysql_query("SELECT sas.*,sr.FirstName,sr.LastName FROM staff_available_shift as sas INNER JOIN hr_staff_registration as sr ON sas.accept_staffid = sr.Uid AND sas.accept_staffid != '' AND clientId = '".$_SESSION['userid']."' AND sas.shiftEndTime < NOW()");
					while($rowdest = mysql_fetch_array($fetSql))
					{
					
					?>
					<tr>
						<td class="hidden-480"><?=$rowdest['qualification']?></td>
						<td class="hidden-480"><?=$rowdest['location']?></td>
						<td class="hidden-480"><?=$rowdest['role']?></td>
						<td class="hidden-480"><?=date('d M Y', strtotime($rowdest['date'])).'<br/>'.date('l',strtotime($rowdest['date']));?></td>
						<td class="hidden-480"> Start : <?=$rowdest['start_time'];?><br/> Finish : <?=$rowdest['end_time'];?></td>
						<td class="hidden-480"><?=$rowdest['FirstName'].' '.$rowdest['LastName'];?></td>
						<td><a href="##"  data-toggle="collapse" data-target="#div<?= $ctn ?>" style=" width:200px; margin:3px;">feedback</a></td>
						
					</tr>
					<tr>
					 <td colspan="7"><div id="div<?= $ctn ?>" class="collapse"  style="border-radius:5px;border:1px solid #CCC;padding:10px;"> Enter Feedback:
                      <textarea id="msg<?= $ctn ?>" rows='4' required style="width:100%; background-color:#E8FDFF; padding:7px;" name="feedback" ><?=$rowdest['feedback'];?></textarea>
                      <input type="button" onClick="return save_data(document.getElementById('msg<?= $ctn ?>').value,<?=$rowdest['id'];?>,'snd<?= $ctn ?>')" value="save">
                      <div id="snd<?= $ctn ?>"></div>
                    </div></td>
                </tr>
				
				<?php 
				$ctn++;
				}?>
				
				<tbody>
                <!--<tbody>
                  <?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM book_nurse WHERE clientId = '".$_SESSION['userid']."' AND firstShiftDate < NOW() ORDER BY sl DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
									
									$today = date('Y-m-d');
											
									
				if($rowdest['firstShiftDate'] != "" && $rowdest['firstShiftDate'] < $today && $rowdest['firstShift'] == 'Request'){
				//echo "SELECT sl,stuffId,clientResponse FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '1' AND  toDate LIKE '".$rowdest['firstShiftDate']."%'";
					$stuffId = mysql_fetch_array(mysql_query("SELECT sl,stuffId,clientResponse FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '1' AND  toDate LIKE '".$rowdest['firstShiftDate']."%'"));
					$clientName = mysql_fetch_array(mysql_query("SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId['stuffId'].""));
				?>
                  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                       <?=$rowdest['speciality1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['firstShiftDate'])).'<br/>'.date('l',strtotime($rowdest['firstShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime1'];?><br/>
					   Finish : <?=$rowdest['finishTime1'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?=$clientName['FirstName'].' '.$clientName['LastName'];?>
					</div></td>
					<td><a href="##"  data-toggle="collapse" data-target="#div<?= $ctn ?>" style=" width:200px; margin:3px;">feedback</a></td>
                  </tr>
				  <tr>
                  <td colspan="7"><div id="div<?= $ctn ?>" class="collapse"  style="border-radius:5px;border:1px solid #CCC;padding:10px;"> Enter Feedback:
                      <textarea id="msg<?= $ctn ?>" rows='4' required style="width:100%; background-color:#E8FDFF; padding:7px;" name="feedback" ><?=$stuffId['clientResponse'];?></textarea>
                      <input type="button" onClick="return save_data(document.getElementById('msg<?= $ctn ?>').value,<?=$stuffId['sl'];?>,'snd<?= $ctn ?>')" value="save">
                      <div id="snd<?= $ctn ?>"></div>
                    </div></td>
                </tr>
			<?php
			}
			 if($rowdest['secondShiftDate'] != "" && $rowdest['secondShiftDate'] < $today && $rowdest['seconddShift'] == 'Request'){
			 
			 $stuffId = mysql_fetch_array(mysql_query("SELECT sl,stuffId FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '2' AND  toDate LIKE '".$rowdest['secondShiftDate']."%'"));
					$clientName = mysql_fetch_array(mysql_query("SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId['stuffId'].""));
			 ?>
				  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['speciality2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['secondShiftDate'])).'<br/>'.date('l',strtotime($rowdest['secondShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime2'];?><br/>
					   Finish : <?=$rowdest['finishTime2'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?=$clientName['FirstName'].' '.$clientName['LastName'];?>
					</div></td>
					<td><a href="##"  data-toggle="collapse" data-target="#divv<?= $ctn ?>" style=" width:200px; margin:3px;">feedback</a></td>
					 <tr>
                  <td colspan="7"><div id="divv<?= $ctn ?>" class="collapse"  style="border-radius:5px;border:1px solid #CCC;padding:10px;"> Enter Feedback:
                      <textarea id="msgg<?= $ctn ?>" rows='4' required style="width:100%; background-color:#E8FDFF" name="feedback" ><?=$stuffId['clientResponse'];?></textarea>
                      <input type="button" onClick="save_data(document.getElementById('msgg<?= $ctn ?>').value,<?=$stuffId['sl']?>,'sndd<?= $ctn ?>')" value="save">
                      <div id="sndd<?= $ctn ?>"></div>
                    </div></td>
                </tr>
                  </tr>
			<?php }
			if($rowdest['thirdShiftDate'] != ""  && $rowdest['thirdShiftDate'] < $today && $rowdest['thirdShift'] == 'Request'){
			
			$stuffId = mysql_fetch_array(mysql_query("SELECT sl,stuffId FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND shift = '3' AND  toDate LIKE '".$rowdest['thirdShiftDate']."%'"));
					$clientName = mysql_fetch_array(mysql_query("SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId['stuffId'].""));
			?>
			
				  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['speciality3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['thirdShiftDate'])).'<br/>'.date('l',strtotime($rowdest['thirdShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime3'];?><br/>
					   Finish : <?=$rowdest['finishTime3'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?=$clientName['FirstName'].' '.$clientName['LastName'];?>
					</div></td>
					<td><a href="##"  data-toggle="collapse" data-target="#divvv<?= $ctn ?>" style=" width:200px; margin:3px;">feedback</a></td>
					 <tr>
                  <td colspan="7"><div id="divvv<?= $ctn ?>" class="collapse"  style="border-radius:5px;border:1px solid #CCC;padding:10px;"> Enter Feedback:
                      <textarea id="msggg<?= $ctn ?>" rows='4' required style="width:100%; background-color:#E8FDFF" name="feedback" ><?=$stuffId['clientResponse'];?></textarea>
                      <input type="button" onClick="save_data(document.getElementById('msggg<?= $ctn ?>').value,<?=$stuffId['sl']?>,'snddd<?= $ctn ?>')" value="save">
                      <div id="snddd<?= $ctn ?>"></div>
                    </div></td>
                </tr>
                  </tr>
                  <?php 
				  }
				  $ctn++; } ?>
                </tbody>-->
              </table>
			  <div id="pageNavPosition" style="padding-top: 20px" align="center"></div>
			  <script type="text/javascript">
					var pager = new Pager('tablepaging', 20);
					pager.init();
					pager.showPageNav('pager', 'pageNavPosition');
					pager.showPage(1);
					</script>
           <!--<table class="t" border="0" style="background:#FFF; width:100%">
                <thead>
                  <tr>
                    <th> Qualification</th>
                    <th>Location</th>
                    <th>Specialty</th>
                    <th>Date & Day</th>
                    <th>Time of Shift</th>
                    <th>VICNA Staff</th>
                    <th>Feedback</th>
                  </tr>
                </thead>
                
                <?php
          							$ctn = 1;
									
									 $GetUserSql = "SELECT * FROM stuff_booked WHERE clientId = '".$_SESSION['userid']."' AND toDate < NOW() ORDER BY sl DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										$slno=$rowdest['sl'];
									$stuffId=$rowdest['stuffId'];
									$clientId=$rowdest['clientId'];
									$booking_sl=$rowdest['booking_sl'];
									$shift=$rowdest['shift'];
									$formDate=$rowdest['formDate'];
									$toDate=$rowdest['toDate'];
									$clientResponse=$rowdest['clientResponse'];
									$dt=$rowdest['dt'];
																	
									
									
									$GetUserSql55 = "SELECT FirstName,LastName FROM  hr_staff_registration WHERE Uid = ".$stuffId."";
									$GetQuery55 = mysql_query($GetUserSql55) or die(mysql_error());
									while($rowdest55 = mysql_fetch_array($GetQuery55))
									{$name=$rowdest55['FirstName'].' '.$rowdest55['LastName'];}
				
				$GetUserSql66 = "SELECT * FROM book_nurse WHERE sl = '".$booking_sl."'";
									$GetQuery66 = mysql_query($GetUserSql66) or die(mysql_error());
									while($rowdest66 = mysql_fetch_array($GetQuery66))
									{
									/*$sl=$rowdest66['sl'];
				$clientId=$rowdest66['clientId'];*/
				
				$firstShiftDate=$rowdest66['firstShiftDate'];
				$startTime1=$rowdest66['startTime1'];										
				$finishTime1=$rowdest66['finishTime1'];
 				$word1=$rowdest66['word1'];
 				$class1=$rowdest66['class1'];
 				$staffReqstd1=$rowdest66['staffReqstd1'];
				$speciality1 = $rowdest66['speciality1'];
				
 				$secondShiftDate=$rowdest66['secondShiftDate']; 
				$startTime2=$rowdest66['startTime2']; 
 				$finishTime2 =$rowdest66['finishTime2'];
 				$word2=$rowdest66['word2']; 
 				$class2 =$rowdest66['class2'];
 				$staffReqstd2 =$rowdest66['staffReqstd2'];
				$speciality2 = $rowdest66['speciality2'];
				
 				$thirdShiftDate=$rowdest66['thirdShiftDate'];
 				$startTime3 =$rowdest66['startTime3'];
 				$finishTime3 =$rowdest66['finishTime3'];
 				$word3=$rowdest66['word3'];
 				$class3=$rowdest66['class3'];
 				$staffReqstd3=$rowdest66['staffReqstd3'];
				$speciality3 = $rowdest66['speciality3'];
				
 				$comment=$rowdest66['comment'];
 				//$dt=$rowdest66['dt'];
									
									}
									$qualification='';
				$GetUserSql56 = "SELECT * FROM  hr_refer WHERE Uid = '".$stuffId."' ";
									$GetQuery56 = mysql_query($GetUserSql56) or die(mysql_error());
									while($rowdest56 = mysql_fetch_array($GetQuery56))
									{$qualification=$rowdest56['qualification'];}
			
		?>
                <tr>
                  <td><?php echo "$class1<br>$class2<br>$class3"; ?> </td>
                  <td><?php echo "$word1<br>$word2<br>$word3"; ?></td>
                  <td>--</td>
                  <td><?php echo "$firstShiftDate<br>$secondShiftDate<br>$thirdShiftDate"; ?></td>
                  <td><?php 
		  if($startTime1){echo "(1st Shift)<br>Start: $startTime1<br> Finish: $finishTime1<br>";}
		  if($startTime2){echo "(2st Shift)<br>Start: $startTime2<br> Finish: $finishTime2<br>";}
		  if($startTime3){echo "(3st Shift)<br>Start: $startTime3<br> Finish: $finishTime3";}
		  ?>
                  
                  </td>
                  <td><?= $name ?>
                    <br>
                    (
                    <?= $qualification ?>
                    )</td>
                  <td><a href="##"  data-toggle="collapse" data-target="#div<?= $ctn ?>" style=" width:200px; margin:3px;">feedback</a></td>
                </tr>
                <tr>
                  <td colspan="7"><div id="div<?= $ctn ?>" class="collapse"  style="border-radius:5px;border:1px solid #CCC;padding:10px;"> Enter Feedback:
                      <textarea id="msg<?= $ctn ?>" rows='5' style="width:100%; background-color:#E8FDFF" name="feedback" >
                      <?=$clientResponse?>
                      </textarea>
                      <input type="button" onClick="save_data(document.getElementById('msg<?= $ctn ?>').value,<?=$slno?>,'d<?= $ctn ?>')" value="save">
                      <div id="d<?= $ctn ?>"></div>
                    </div></td>
                </tr>
                <tr>
                  <td colspan="7"><hr></td>
                </tr>
                <?php $ctn++;	} ?>
              </table>-->
              <?php //echo "++++++++++++++".$_SESSION['userid']; ?>
            </div>
            <!-- __________________________________________________Completed Shifts_________________________________________________________-->
            <!-- _________________________________________________do not send_____________________________________________________-->
            <br>
            <button data-toggle="collapse" data-target="#demo2" style="width:200px; margin:3px;">Do Not Send </button>
            <div id="demo2" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;">
              <iframe src="doNotSend.php" height="350" width="100%" frameborder="0"></iframe>
            </div>
            <!-- --------------------------------------end do not send---------------------------------------------------------------- -->
          </div>
        </div>
      </div>
    </div>
    <script>
function save_data(str,slno,d) {
	
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(d).innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "save_feedback.php?str=" + str + "&slno=" + slno, true);
        xmlhttp.send();
    }

</script>
    <!-- ***************************css***********************************-->
    <style>
        /* USER PROFILE PAGE */
 /* USER PROFILE PAGE */
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}



</style>
    <!--********************************Js**********************************************-->
    <script>
$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});
</script>
    <!-- *****************************************************************************************************************************-->
  </div>
  <!-- end container -->
</section>
<!-- end section -->

<!-- end footer-bar -->
<?php include'footer.php';?>
<!-- end footer -->
<!--
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

-->
<!-- form copy***************************************************** -->
<!-- ****************************************************************** end -->
<script type="text/javascript">
$('#sendit').click(function(){
	var day1 = $('#day1').val();
	var month1 = $('#month1').val();
	var year1 = $('#year1').val();
	var startTime1 = $('#startTime1').val();
	var finishTime1 = $('#finishTime1').val();
	var area1 = $('#area1').val();
	var class1 = $('#class1').val();
	if(day1 == ""){
		alert("Please Select Day of First Shift Date");
		return false;
	}else if(month1 == "")
	{
		alert("Please Select Month of First Shift Date");
		return false;
	}else if(year1 == "")
	{
		alert("Please Select Year of First Shift Date");
		return false;
	}else if(startTime1 == "")
	{
		alert("Please Select Start Time of First Shift");
		return false;
	}else if(finishTime1 == "")
	{
		alert("Please Select Finish Time of First Shift");
		return false;
	}else if(area1 == "")
	{
		alert("Please Enter area location of First Shift");
		return false;
	}else if(class1 == "")
	{
		alert("Please mention class of First Shift");
		return false;
	}
	
	if($('#chkPassport').attr('checked'))
	{
		var day2 = $('#day2').val();
		
		var month2 = $('#month2').val();
		var year2 = $('#year2').val();
		var startTime2 = $('#startTime2').val();
		var finishTime2 = $('#finishTime2').val();
		var area2 = $('#area2').val();
		var class2 = $('#class2').val();
		if(day2 == ""){
			alert("Please Select Day of Second Shift Date");
			return false;
		}else if(month2 == "")
		{
			alert("Please Select Month of Second Shift Date");
			return false;
		}else if(year2 == "")
		{
			alert("Please Select Year of Second Shift Date");
			return false;
		}else if(startTime2 == "")
		{
			alert("Please Select Start Time of Second Shift");
			return false;
		}else if(finishTime2 == "")
		{
			alert("Please Select Finish Time of Second Shift");
			return false;
		}else if(area2 == "")
		{
			alert("Please Enter area location of Second Shift");
			return false;
		}else if(class2 == "")
		{
			alert("Please mention class of Second Shift");
			return false;
		}
	}
	
	if($('#chkPassport1').attr('checked'))
	{
		var day3 = $('#day3').val();
		
		var month3 = $('#month3').val();
		var year3 = $('#year3').val();
		var startTime3 = $('#startTime3').val();
		var finishTime3 = $('#finishTime3').val();
		var area3 = $('#area3').val();
		var class3 = $('#class3').val();
		if(day3 == ""){
			alert("Please Select Day of Third Shift Date");
			return false;
		}else if(month3 == "")
		{
			alert("Please Select Month of Third Shift Date");
			return false;
		}else if(year3 == "")
		{
			alert("Please Select Year of Third Shift Date");
			return false;
		}else if(startTime3 == "")
		{
			alert("Please Select Start Time of Third Shift");
			return false;
		}else if(finishTime3 == "")
		{
			alert("Please Select Finish Time of Third Shift");
			return false;
		}else if(area3 == "")
		{
			alert("Please Enter area location of Third Shift");
			return false;
		}else if(class3 == "")
		{
			alert("Please mention class of Third Shift");
			return false;
		}
	}
	
});
</script>
<script type="text/javascript">
function bookingCancel(id, shifting)
{
		
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			
			$.post('ajax/delbooking.php',{ feedid : id, mode : shifting },
				function(data)
				{//deletecinematic
					$('#demo').html(data);
					
				}
			);
		}
	
}

</script>
</body>
</html>
