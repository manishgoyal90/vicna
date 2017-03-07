<?php session_start();
if($_SESSION["userid"]){}else{header('Location: login.php');exit();}
	include"config/connect.php";
	/*,BusineddAddress = '".$_POST["BusinesslAddress"]."',
	Phone  = '".$_POST["Phone"]."',
	Fax = '".$_POST["Fax"]."',
	Email = '".$_POST["Email"]."',	
	TradingName = '".$_POST["TradingName"]."',
	BusinessAddress = '".$_POST["BusinessAddress"]."',
	Website = '".$_POST["Website"]."'*/
	
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
				;
				
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
<?php include'headerLoginClient.php';?>
<!-- end header -->


<!-- end inner header -->


<section class="latest-news">
  <div class="container">
      <div class="row">
      
    
        
   <!-- ************************************************************************************************************************************-->    
        <div class="col-lg-10 col-sm-10 pull-center col-md-offset-1" >
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="http://lorempixel.com/100/100/people/9/">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
            <img alt="" src="http://lorempixel.com/100/100/people/9/">
        </div>
        <div class="card-info"> <span class="card-title"><?php echo $FirstName; ?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="profile" class="btn btn-default" href="profile.php" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Profile</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="Booking" class="btn btn-primary" href="booking.php" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs">Booking</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="account" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
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
		
		//echo "IIIIIII".$_SESSION['userid'];
				$SqlUser = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_SESSION['userid']."'";
				$result = mysql_query($SqlUser);
				;
				
				while($row = mysql_fetch_array($result))
				{
					$FirstName=$row['FirstName'];
					$LastName=$row['LastName'];
					$UserName=$row['UserName'];
					$EmailId=$row['FirstName'];
					$UserImage=$row['UserImage'];
					$Country=$row['FirstName'];
					$State=$row['state'];
					$City=$row['City'];
					$Address=$row['Address'];
					$Phone=$row['Phone'];
					$ZipCode=$row['ZipCode'];
					$RgistDate=$row['RgistDate'];
					$UserStatus=$row['UserStatus'];
					$VisibleStatus=$row['VisibleStatus'];
					$EmailVerification=$row['EmailVerification'];
					$ConfirmCode=$row['ConfirmCode'];
					$BusinessName=$row['BusinessName'];
					$TradingName=$row['TradingName'];
					$BusinessAddress=$row['BusinessAddress'];
					$Address=$row['Address'];
					$Phone=$row['Phone'];
					$Fax=$row['Fax'];
					$EmailId=$row['EmailId'];
					$Website=$row['Website'];
					$ClientId=$row['ClientId'];
					$Password=base64_decode($row['Password']);
					
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
         <div style=" margin:10px;">Book a nurse</div>
         
         	<div style=" margin:10px;">Manage booking</div>				
          <table class="table" style="background:#FFF;">
          <tr><td><b>Qualification</b></td><td><b>Location</b></td><td><b>Specialty</b></td><td><b>Date &amp; Day</b></td><td><b>Time of Shift</b></td><td><b>VICNA Staff</b></td><td><b>Cancel</b></td>
          </tr>
          <tr><td>RN/Div1; EEN/Div2</td><td>Dementia Specific Unit</td><td>Aged Care In-Charge</td> <td>01 June 2016 Sunday</td>
          <td>Start: 21:45 Finish: 07:15</td><td>TBA</td><td><a href="#">Cancel</a></td></tr>
          
          <tr><td>RN/Div1; EEN/Div2</td><td>Flinders Wing</td><td>Aged Care In-Charge</td> <td>01 June 2016 Sunday</td>
          <td>Start: 21:45 Finish: 07:15</td><td>Abc Xyz (RN)</td><td><a href="#">Cancel</a></td></tr>
          </table>
          <a href="#" > Make another booking</a>
          
          
          <div style=" margin:10px;">Completed Shifts</div>	
          
          
          <table class="table" style="background:#FFF;"> <thead><tr><th>
          Qualification</th><th>Location</th><th>Specialty</th><th>Date & Day</th><th>Time of Shift</th><th>VICNA Staff</th><th>Feedback</th></tr></thead>
         <tr><td> RN/Div1; EEN/Div2	</td><td>Flinders Wing</td><td>	Aged Care</td><td>In-Charge	01 June 2016</td><td>Sunday	Start: 21:45 Finish: 07:15</td><td>Abc Xyz (RN)</td><td><a href="#">feedback</a></td></tr>
          <tr><td>
          RN/Div1; EEN/Div2</td><td>Flinders Wing</td><td>Aged Care</td><td>In-Charge	01 June 2016</td><td>Sunday	Start: 21:45 Finish: 07:15</td><td>Abc Xyz (RN)</td><td><a href="#">feedback</a></td></tr>
          </table>
          
          
          <div style=" margin:10px;">Do Not Send </div>
           <table class="table" style="background:#FFF;">
            <thead><tr><th>VICNA Staff</th><th>Date Requested </th></tr></thead>
           <tr><td>Abc Xyz</td><td>21/05/2016</td></tr>
			<tr><td>Abc1 Xyz1</td><td>01/01/2016</td></tr>
            </table>


          <!-- --------------------------------------booking---------------------------------------------------------------- -->
        </div>
        <div class="tab-pane fade in" id="tab3">
          <h3>Account &amp; billing</h3>
          These details are only for billing purposes.
          <!-- ----------------------------------------------------------------------------------------------- -->
          <b>Billing Details :</b>
          <table class="table"><tr><td>

		<tr><td>Business Name:</td><td><input type="text" name="BusinessName" value="<?php echo "$BusinessName"; ?>"></td></tr> 
		<tr><td>Trading Name: </td><td><input type="text" name="TradingName" value="<?php echo "$TradingName"; ?>"></td></tr> 
		<tr><td>ABN: </td><td><input type="text" name="ABN" value="<?php echo "$abn"; ?>"></td></tr> 
		<tr><td>Business Address:</td><td><input type="text" name="BusinessAddress" value="<?php echo "$BusinessAddress"; ?>"></td></tr> 
		<tr><td>Postal Address:</td><td><input type="text" name="Address" value="<?php echo "Address"; ?>"></td></tr> 
		<tr><td>Phone Number: </td><td><input type="text" name="Phone" value="<?php echo "Phone"; ?>"></td></tr>
		<tr><td>Email:</td><td><input type="text" name="EmailID" value="<?php echo "$EmailId"; ?>"></td></tr> 
		<tr><td>Fax:</td><td><input type="text" name="Fax" value="<?php echo "$Fax"; ?>"></td></tr> 
		<tr><td>Business Contact:</td><td><input type="text" name="Fax" value="<?php echo "$Fax"; ?>"></td></tr> 
		<tr><td>Prefer to receive invoices via: </td><td><input type="text" name="PTI" value="<?php echo "$PTI"; ?>"></td></tr>
		</table>

          			 						  
          <b>Invoices</b>				
          <table class="table" style="background:#FFF;"><thead>
          <tr><th>Invoice Number</th><th>Date Invoiced</th><th>Amount Payable</th><th>Due Date</th><th>Status</th><th>View/Save Invoices</th></tr></thead>
          <tr><td>VIC000012</td><td>17/02/2016</td><td>$1000.00</td><td>24/02/2016</td><td><font color='red'>Payment Due</font></td><td><a href="#">download</a></td></tr>
          <tr><td>VIC000011</td><td>10/02/2016</td><td>$1500.00</td><td>17/02/2016</td><td><font color="#00CC00">Paid</font></td><td><a href="#">download</a></td></tr>
         
          </table>
          
          
          <a href="#">View older invoice</a>
          
          
         <br><br> <b>Billing Enquiries</b>
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
			<input type="submit" name="submit_enq" value="Submit">
            </td>
            </tr>
            </table>
            </form>

          <b>Previous Enquiries</b>
          
           <table class="table" style="background:#FFF"><thead><tr><th>Date</th><th>recipt no</th><th>status</th><th>option</th></tr></thead>
		<tr><td>21 May 2016</td><td>VIC00002</td><td>In Progress</td><td>Mark Resoled</td></tr> 
        <tr><td>10 Jan 2016</td><td>VIC0001</td><td>Resolved</td><td>For more options[Click Here]</td></tr>       
            </table>
          
          
        <b>  Payment Options </b>
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