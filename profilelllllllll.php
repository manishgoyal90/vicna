<?php session_start();
if($_SESSION["userid"]){}else{header('Location: login.php');exit();}
	include"config/connect.php";
	
	
		//------------------------------------------------------------------------------------------------------
	if (isset($_POST['submit']))
	{
		$msg="<div style='margin:10px;'>updated.</div>";
	$SqlUpdate = "UPDATE hr_user_registration SET BusinessName = '".$_POST["BusinessName"]."',TradingName= '".$_POST["TradingName"]."',
	BusinessAddress= '".$_POST["BusinessAddress"]."',Address='".$_POST["Address"]."',Phone='".$_POST["Phone"]."',
	Fax='".$_POST["Fax"]."',EmailId='".$_POST["EmailId"]."',Website='".$_POST["Website"]."',Password='".base64_encode($_POST["Password"])."'
	WHERE Uid = '".$_SESSION['userid']."';";
	$result = mysql_query($SqlUpdate) ;
	if($result){$msg="<font color='Green'>Successfully Updated.</font>";}
	else{$msg="<font color='Red'>Not Updated.</font>";}
	}
				
				$SqlUser = "SELECT FirstName,LastName,UserName FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_SESSION['userid']."'";
				$result = mysql_query($SqlUser);
				
				
				while($row = mysql_fetch_array($result))
				{
					$FirstName=$row['FirstName'];
					$LastName=$row['LastName'];
					$UserName=$row['UserName'];		
				}
				
				
				
				//For Cover Image
				if($FetchRows['UserImage'] == "")
				{
					$pic = "images/nopic.png";
				}
				else if(!is_file("profileimage/medium/".$FetchRows['UserImage']))
				{
					$pic = "images/nopic.png";
				}
				else
				{
					$pic = "profileimage/medium/".$FetchRows['UserImage'];
				}
	
	$page = "home";

		//Fetch Home  Details
		$FetchCmsSql = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '1'";
		$FetchCmsQuery = mysql_query($FetchCmsSql);
		$FetchCmsRows = mysql_fetch_array($FetchCmsQuery);
		
		$content_keyword = 	stripslashes($FetchCmsRows['meta_keywords']);
		$meta_description =  stripslashes($FetchCmsRows['meta_description']);

?>
        
                             <script type="text/javascript">
  function checkForm(form)
  {
    // validation fails if the input is blank
   

    // regular expression to match only alphanumeric characters and spaces
 
	
  if(form.email.value == "") {
      alert("Error:Insert Your Valid Id!");
      form.email.focus();
      return false;
    }

   if(form.password.value == "") {
      alert("Error:Enter Your valid Password !");
      form.password.focus();
      return false;
    }
   
  

   
    // validation was successful
    return true;
  }

</script>

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


</head><body>
<?php include'headerLoginClient.php';?>
<!-- end header -->


<!-- end inner header -->


<section class="latest-news">
  <div class="container">
      <div class="row">
      
    
        
   <!-- ************************************************************************************************************************************-->    
        <div class="col-lg-10 col-sm-10 pull-center col-md-offset-1" >
    <div class="card hovercard"  style="background:url(images/bg.jpg);">
        <div class="card-background">
            <img class="card-bkimg" alt="" >
           
        </div>
        <div class="useravatar">
            <img alt="" src="images/profile_pic.jpg">
        </div>
        <div class="card-info"> <span class="card-title"><?php echo $FirstName; ?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="profile" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Profile</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="Booking" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                <div class="hidden-xs">Booking</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="account" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                <div class="hidden-xs">Account &amp; billing</div>
            </button>
        </div>
    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
          <h3>Profile</h3>
		  <!-- ------------------------------------------------------------------------------------------------------ -->
       <?php  echo $msg; ?>
		<?php  
		
		
				$SqlUser = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_SESSION['userid']."'";
				$result = mysql_query($SqlUser);
							
				while($row = mysql_fetch_array($result))
				{
					$FirstName=$row['FirstName'];$LastName=$row['LastName'];$UserName=$row['UserName'];
					$EmailId=$row['FirstName'];$UserImage=$row['UserImage'];$Country=$row['FirstName'];
					$State=$row['state'];$City=$row['City'];$Address=$row['Address'];
					$Phone=$row['Phone'];$ZipCode=$row['ZipCode'];$RgistDate=$row['RgistDate'];
					$UserStatus=$row['UserStatus'];$VisibleStatus=$row['VisibleStatus'];$EmailVerification=$row['EmailVerification'];
					$ConfirmCode=$row['ConfirmCode'];$BusinessName=$row['BusinessName'];$TradingName=$row['TradingName'];
					$BusinessAddress=$row['BusinessAddress'];$Address=$row['Address'];$Phone=$row['Phone'];
					$Fax=$row['Fax'];$EmailId=$row['EmailId'];$Website=$row['Website'];
					$ClientId=$row['ClientId'];$Password=base64_decode($row['Password']);				
					$RegistrationNo=$row['RegistrationNo'];
				}
                ?>
                <form method="post" action="profile.php">
         <table class="table">
         <tr><td>Business Name: </td><td><input type="text" name="BusinessName" class="form-control" value="<?php echo $BusinessName ;?> " required></td></tr>
         <tr><td>Trading Name:</td><td><input type="text" name="TradingName" class="form-control" value="<?php echo $TradingName ;?>"></td></tr>
         <tr><td>Business Address:</td><td><input type="text" class="form-control" name="BusinessAddress" value="<?php echo $BusinessAddress ;?>" required></td></tr>
         <tr><td>Postal Address:</td><td><input type="text"  class="form-control" name="Address" value="<?php echo $Address ;?>"></td></tr>
         <tr><td>Phone:</td><td><input type="tel" name="Phone"  class="form-control" value="<?php echo $Phone ;?>" pattern="[0-9]{10}" placeholder="Enter 10 degin number"></td></tr>
         <tr><td>Fax:</td><td><input type="text" name="Fax"  class="form-control" value="<?php echo $Fax ;?>"></td></tr>
         <tr><td>Email:</td><td><input type="text" name="EmailId"  class="form-control" value="<?php echo $EmailId ;?>" readonly></td></tr>
         <tr><td>Website:</td><td><input type="url"   pattern="https?://.+"  name="Website"  class="form-control" value="<?php echo $Website  ;?>"  placeholder="http://examplesite.com"></td></tr>
         <tr><td>Client Id:</td><td><input type="text" name="ClientId"  class="form-control" value="<?php echo $RegistrationNo ;?>" readonly></td></tr>
         <tr><td>Password:</td><td><input type="password" name="Password" class="form-control"  value="<?php echo $Password ;?>" required></td></tr>
         <tr><td></td><td><input type="submit" name="submit" class="btn btn-info"  value="Submit"></td></tr>
         </table>
         
         
         </form>
        
         
					
          <!-- ------------------------------------------------------------------------------------------------------ -->
          </div>
        <div class="tab-pane fade in" id="tab2">
          <h3>Booking</h3>
          <!-- ------------------------------------bgooking------------------------------------------------------------------ -->
         
        <!-- ____________________________________________________book a nurse_______________________________________________________________-->
         <!-- end inner header -->
         <?php
if(isset($_POST["book_a_nurse"]))
	{
		$firstShiftDate=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["day1"];
		$secondShiftDate=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["day2"];
		$thirdShiftDate=$_POST["year3"]."-".$_POST["month3"]."-".$_POST["day3"];
		$q = "INSERT INTO book_nurse (sl, clientId, 
									  firstShiftDate, startTime1, finishTime1, word1, class1, staffReqstd1,
									  SecondShiftDate, startTime2, finishTime2, word2, class2, staffReqstd2,
									  thirdShiftDate, startTime3, finishTime3, word3, class3, staffReqstd3,
									  comment,
									  dt) 
		VALUES (NULL, '".$_SESSION["userid"]."', 
'".$firstShiftDate."', '".$_POST["startTime1"]."', '".$_POST["finishTime1"]."', '".$_POST["word1"]."', '".$_POST["class1"]."', '".$_POST["staffReqstd1"]."',
'".$secondShiftDate."', '".$_POST["startTime2"]."', '".$_POST["finishTime2"]."', '".$_POST["word2"]."', '".$_POST["class2"]."', '".$_POST["staffReqstd2"]."',
'".$thirdShiftDate."', '".$_POST["startTime3"]."', '".$_POST["finishTime3"]."', '".$_POST["word3"]."', '".$_POST["class3"]."', '".$_POST["staffReqstd3"]."',

'".$_POST["comment"]."',CURRENT_TIMESTAMP);";
		$result = mysql_query($q) or die("error ".mysql_error());
				
	}
	?>
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
    <div class="row">
    
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
                	<select name="day1" id="day" onChange="" >
                        <option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option>
                        <option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option>
                        <option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                        <option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
                        <option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
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
  <option value="3">06:45</option>
    <option value="06:45">07:00</option>
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
          <option value="Shift finish time">Shift finish time</option>
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
  <option value="3">06:45</option>
    <option value="06:45">07:00</option>
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
           <!-- <input type="text" name="startTime2" id="time" placeholder="Shift start time">-->
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
  <option value="3">06:45</option>
    <option value="06:45">07:00</option>
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
  <option value="3">06:45</option>
    <option value="06:45">07:00</option>
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
            <!--<input type="text" name="startTime3" id="time" placeholder="Shift start time">-->
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
  <option value="3">06:45</option>
    <option value="06:45">07:00</option>
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
  <option value="3">06:45</option>
    <option value="06:45">07:00</option>
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
      
    </div>
    </form>
    <!-- end row --> 
  

        <!-- ___________________________________________________end book a nurse_________________________________________________________-->
             <!-- __________________________________________________manage booking_________________________________________________________-->
          <br><button data-toggle="collapse" data-target="#demo" style="width:200px; margin:3px;">Manage booking</button>
<div id="demo" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;">

         	<font color="#666666" size="+1">Manage booking</font>		
          <table class="table" style="background:#FFF;">
          <tr><td><b>Qualification</b></td><td><b>Location</b></td><td><b>Specialty</b></td><td><b>Date &amp; Day</b></td><td><b>Time of Shift</b></td><td><b>VICNA Staff</b></td><td><b>Cancel</b></td>
          </tr>
          <tr><td>RN/Div1; EEN/Div2</td><td>Dementia Specific Unit</td><td>Aged Care In-Charge</td> <td>01 June 2016 Sunday</td>
          <td>Start: 21:45 Finish: 07:15</td><td>TBA</td><td><a href="#">Cancel</a></td></tr>
          
          <tr><td>RN/Div1; EEN/Div2</td><td>Flinders Wing</td><td>Aged Care In-Charge</td> <td>01 June 2016 Sunday</td>
          <td>Start: 21:45 Finish: 07:15</td><td>Abc Xyz (RN)</td><td><a href="#">Cancel</a></td></tr>
          </table>
          <a href="#" > Make another booking</a>
          </div>
          <!-- _________________________________________________end_manage booking_________________________________________________________-->
          <!-- __________________________________________________Completed Shifts_________________________________________________________-->
          <br><button data-toggle="collapse" data-target="#demo1" style=" width:200px; margin:3px;">Completed Shifts</button>
<div id="demo1" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;">
          <font color="#666666" size="+1">Completed Shifts</font>	     
          
          <table class="table" style="background:#FFF;"> <thead><tr><th>
          Qualification</th><th>Location</th><th>Specialty</th><th>Date & Day</th><th>Time of Shift</th><th>VICNA Staff</th><th>Feedback</th></tr></thead>
         <tr><td> RN/Div1; EEN/Div2	</td><td>Flinders Wing</td><td>	Aged Care</td><td>In-Charge	01 June 2016</td><td>Sunday	Start: 21:45 Finish: 07:15</td><td>Abc Xyz (RN)</td><td><a href="#">feedback</a></td></tr>
          <tr><td>
          RN/Div1; EEN/Div2</td><td>Flinders Wing</td><td>Aged Care</td><td>In-Charge	01 June 2016</td><td>Sunday	Start: 21:45 Finish: 07:15</td><td>Abc Xyz (RN)</td><td><a href="#">feedback</a></td></tr>
          </table>
          </div>
         <!-- __________________________________________________Completed Shifts_________________________________________________________-->
  
  		<!-- _________________________________________________do not send_____________________________________________________-->
		 <br><button data-toggle="collapse" data-target="#demo2" style=" width:200px; margin:3px;">Do Not Send </button>
<div id="demo2" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;">

        
          <font color="#666666" size="+1">Do Not Send</font>
          <?php
		  if(isset($_POST["donotsend"])){
		  $q="INSERT INTO do_not_send (sl, stuffName, reason,clientId, dt) VALUES (NULL , '".$_POST["stuffName"]."', '','".$_SESSION['userid']."', CURRENT_TIMESTAMP);";
		  $r=mysql_query($q) or die("error: ".mysql_error());
		  }
		  ?>
		  
          <form action="profile.php" method="post">
          <table class="table" style="background:#FFEFE6;">           
           <tr><td>Enter stuff name: </td><td><input type="text" name="stuffName" value="" placeholder="Do not send" style="background:#FFE6E1;"></td>
           <td><input type="submit" name="donotsend" value="Do not send" class="btn btn-info" ></td></tr>
		</table>
             </form>
            
          <table class="table" style="background:#FFF;">
            <thead><tr><th>Sl.</th><th>VICNA Staff</th><th>Date Requested </th></tr></thead>
          <?php
		  $SqlUser = "SELECT * FROM do_not_send WHERE clientId = '".$_SESSION['userid']."' order by sl desc ";
				$result = mysql_query($SqlUser);
							$c=0;
				while($row = mysql_fetch_array($result))
				{
					$stuffName=$row['stuffName'];
					$dt=$row['dt'];
					$c++;					
					echo "<tr><td>$c.</td><td>$stuffName</td><td>$dt</td></tr>";
				}
			?>           
            </table>
           
			<?php
				if($c){}else{echo "No data found.";}
		  ?>
		</div>

          <!-- --------------------------------------booking---------------------------------------------------------------- -->
        </div>
        
        
        
        
        
        <div class="tab-pane fade in" id="tab3">
        <?php
		if(isset($_POST["billing_details"]))
		{
		
		$clientId=0;
		 $SqlUser = "SELECT clientId FROM billing_dtls WHERE clientId = '".$_SESSION['userid']."' order by sl desc ";
				$result = mysql_query($SqlUser);while($row = mysql_fetch_array($result)){$clientId=$row['clientId'];}
				
		
		
		if($clientId){		
		
		$msg="<div style='margin:10px;'>updated.</div>";
	$SqlUpdate = "UPDATE billing_dtls SET businessName = '".$_POST["businessName"]."',tradingName= '".$_POST["tradingName"]."',abn= '".$_POST["abn"]."',
	businessAddress= '".$_POST["businessAddress"]."',postalAddress='".$_POST["postalAddress"]."',phone='".$_POST["phone"]."',
	email='".$_POST["email"]."',fax='".$_POST["fax"]."',businessContact='".$_POST["businessContact"]."',
	invoicesVia='".$_POST["invoicesVia"]."'		
	WHERE clientId = '".$_SESSION['userid']."';";
	$result = mysql_query($SqlUpdate) ;
	if($result){$msg11="<font color='Green'>Successfully Updated.</font>";}
	else{$msg11="<font color='Red'>Not Updated.</font>";}
		

		}
		
		else
		{
		$q="INSERT INTO billing_dtls (sl, clientId, businessName, tradingName,abn, businessAddress, postalAddress, phone, email, fax, businessContact, invoicesVia, dt) VALUES (NULL, '".$_SESSION['userid']."', '".$_POST["businessName"]."', '".$_POST["tradingName"]."', '".$_POST["abn"]."', '".$_POST["businessAddress"]."', '".$_POST["postalAddress"]."', '".$_POST["phone"]."', '".$_POST["email"]."', '".$_POST["fax"]."', '".$_POST["businessContact"]."', '".$_POST["invoicesVia"]."', CURRENT_TIMESTAMP);";
		
		$result = mysql_query($q) ;
	if($result){$msg11="<font color='Green'>Successfully inserted.</font>";}
	else{$msg11="<font color='Red'>Not inserted.</font>";}
		}
		
		}
		?>
        <?php  
		
		
				$SqlUser = "SELECT * FROM billing_dtls WHERE clientId = '".$_SESSION['userid']."'";
				$result = mysql_query($SqlUser);
							
				while($row = mysql_fetch_array($result))
				{
					
					//$State=$row['state'];$City=$row['city'];$Address=$row['Address'];
					$Phone=$row['Phone'];$ZipCode=$row['ZipCode'];$RgistDate=$row['RgistDate'];
					$UserStatus=$row['UserStatus'];$VisibleStatus=$row['VisibleStatus'];$EmailVerification=$row['EmailVerification'];
					$ConfirmCode=$row['ConfirmCode'];$BusinessName=$row['businessName'];$TradingName=$row['tradingName'];
					$BusinessAddress=$row['businessAddress'];$Address=$row['postalAddress'];$Phone=$row['phone'];
					$Fax=$row['fax'];$EmailId=$row['email'];$abn=$row['abn'];
					$PTI=$row['invoicesVia'];
					
				}
                ?>
          <h3>Account &amp; billing</h3>
          These details are only for billing purposes.
          <!-- ----------------------------------------------------------------------------------------------- -->
          <?php echo $msg11 ; ?>
          <br><br><b>Billing Details :</b>
          <form name="" action="" method="post">
          <table class="table"><tr><td>
		<tr><td>Business Name:</td><td><input type="text" name="businessName" value="<?php echo "$BusinessName"; ?>" class="form-control"></td></tr> 
		<tr><td>Trading Name: </td><td><input type="text" name="tradingName" value="<?php echo "$TradingName"; ?>" class="form-control"></td></tr> 
		<tr><td>ABN: </td><td><input type="text" name="abn" value="<?php echo "$abn"; ?>"  class="form-control"></td></tr> 
		<tr><td>Business Address:</td><td><input type="text" name="businessAddress" value="<?php echo "$BusinessAddress"; ?>" class="form-control"></td></tr> 
		<tr><td>Postal Address:</td><td><input type="text" name="postalAddress" value="<?php echo "Address"; ?>" class="form-control"></td></tr> 
		<tr><td>Phone Number: </td><td><input type="text" name="phone" value="<?php echo "Phone"; ?>" class="form-control"></td></tr>
		<tr><td>Email:</td><td><input type="text" name="email" value="<?php echo "$EmailId"; ?>" class="form-control"></td></tr> 
		<tr><td>Fax:</td><td><input type="text" name="fax" value="<?php echo "$Fax"; ?>" class="form-control"></td></tr> 
		<tr><td>Business Contact:</td><td><input type="text" name="businessContact" value="<?php echo "$Fax"; ?>" class="form-control"></td></tr> 
		<tr><td>Prefer to receive invoices via: </td><td><input type="text" name="invoicesVia" value="<?php echo "$PTI"; ?>" class="form-control"></td></tr>
        <tr><td></td><td><input type="submit" class="btn btn-info" name="billing_details" value="Save"></td></tr>
        
		</table>
        
        </form>

          	<br><button data-toggle="collapse" data-target="#demo4" style=" width:200px; margin:3px;">Invoices</button>
<div id="demo4" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;">		 						  
          <font color="#666666" size="+1">Invoices</font>			
          <table class="table" style="background:#FFF;"><thead>
          <tr><th>Invoice Number</th><th>Date Invoiced</th><th>Amount Payable</th><th>Due Date</th><th>Status</th><th>View/Save Invoices</th></tr></thead>
          <tr><td>VIC000012</td><td>17/02/2016</td><td>$1000.00</td><td>24/02/2016</td><td><font color='red'>Payment Due</font></td><td><a href="#">download</a></td></tr>
          <tr><td>VIC000011</td><td>10/02/2016</td><td>$1500.00</td><td>17/02/2016</td><td><font color="#00CC00">Paid</font></td><td><a href="#">download</a></td></tr>
         
          </table>
          
          
          <a href="#">View older invoice</a>
          </div>
          
          
          
          
          <br>
          
          <button data-toggle="collapse" data-target="#demo5" style=" width:200px; margin:3px;">Billing Enquiries</button>
<div id="demo5" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;">		 						  
          <font color="#666666" size="+1">Billing Enquiries</font>
          <form name="" action="" method="post">New Enquiry:
          <table><tr>
          
          <td>
		Subject:<input type="text" name="enqTitle" class="form-control">
        </td></tr><tr>
        <td> 
		Enquiry: <textarea cols="105" rows="5" name="enquires" class="form-control"></textarea>
        </td>
        </tr>
        <tr>
        <td>
			<input type="submit" class="btn btn-info" name="submit_enq" value="Submit">
            </td>
            </tr>
            </table>
            </form>

          <font color="#666666" size="+1">Previous Enquiries</font>
          
           <table class="table" style="background:#FFF"><thead><tr><th>Date</th><th>recipt no</th><th>status</th><th>option</th></tr></thead>
		<tr><td>21 May 2016</td><td>VIC00002</td><td>In Progress</td><td>Mark Resoled</td></tr> 
        <tr><td>10 Jan 2016</td><td>VIC0001</td><td>Resolved</td><td>For more options[Click Here]</td></tr>       
            </table>
          
        </div>
        
          <br><button data-toggle="collapse" data-target="#demo6" style=" width:200px; margin:3px;">Invoices</button>
<div id="demo6" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;">	
        <font color="#666666" size="+1">Payment Options</font>
        <table class="table" align="center"  style="background:#FFF"><tr align="center">
<td>Payment Mode</td><td>	Instructions</td></tr>
<tr align="center"><td>
Direct Bank Deposit in a Branch or Electronic Funds Transfer (EFT)</td><td>	Pay To
Account Holder: JOB IN MINUTES PTY LTD
BSB: 062948
Account Number: 1372 7633
Bank: Commonwealth Bank of Australia (CBA) Reference: Invoice Number
</td></tr>
<tr align="center">
<td>
Cheque or Bank Cheque	Pay To
JOB IN MINUTES PTY LTD</td><td>
Reference/Memo: Invoice Number

Post the cheque(s) to:
PO BOX 1234
Suburb, VIC 3333
</td></tr>
</table>
</div>
          
          
          <!-- ------------------------------------------------------------------------------------------------ -->
          
          
          
        </div>
      </div>
    </div>
    
    </div>
            
    
    
    </div>
    
  
                     
                        
            
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
</body>


</html>