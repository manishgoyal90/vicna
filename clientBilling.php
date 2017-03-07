<?php session_start();
if($_SESSION["userid"]){}else{header('Location: login.php');exit();}
	include"config/connect.php";
	
	/*********************************Authority Pin Check Start******************************/
	if(isset($_REQUEST['check_pin']))
	{
		$authority_pin = trim($_REQUEST['authority_pin']);
		$uid = $_SESSION['userid'];
		$fetch = mysql_fetch_array(mysql_query("SELECT EmailId FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$uid."'"));
		$email = $fetch['EmailId'];
		
	}
	
	
	/*******************************Authority Pin Check End******************************/
	
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
            <button type="button" id="Booking" class="btn btn-default" href="#tab2" data-toggle="tab"
            onclick="location.href = 'clientBooking.php';"
            ><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <div class="hidden-xs">Booking</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button" id="account" class="btn btn-primary" href="#tab3" data-toggle="tab"
            onclick="location.href = 'clientBilling.php';"
            ><span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            <div class="hidden-xs">Account &amp; billing</div>
            </button>
          </div>
        </div>
        <div class="well">
          <div class="tab-content">
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
		<!--<div style="width:55%; margin:20px auto; border:3px solid #CC6600; padding:20px;">
			<form action="" method="post">
			<table>
				<tr>
					<td style="30%">Authority PIN</td><td style="45%"><input style="margin:5px; height:30px; width:95%;" type="text" name="authority_pin"></td><td style="25%"><input type="submit" name="check_pin" class="btn btn-info" style="height:30px; width:95%;" value="Check Pin"></td>
				</tr>
			</table>
			</form>
		</div>-->
		<div id="client_biiling_info">
            <h3>Account &amp; billing</h3>
            These details are only for billing purposes.
            <!-- ----------------------------------------------------------------------------------------------- -->
            <?php echo $msg11 ; ?> <br>
            <br>
            <b>Billing Details :</b>
            <form name="" action="" method="post">
              <table class="table">
                <tr>
                  <td>
                <tr>
                  <td>Business Name:</td>
                  <td><input type="text" name="businessName" value="<?php echo "$BusinessName"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Trading Name: </td>
                  <td><input type="text" name="tradingName" value="<?php echo "$TradingName"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>ABN: </td>
                  <td><input type="text" name="abn" value="<?php echo "$abn"; ?>"  class="form-control"></td>
                </tr>
                <tr>
                  <td>Business Address:</td>
                  <td><input type="text" name="businessAddress" value="<?php echo "$BusinessAddress"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Postal Address:</td>
                  <td><input type="text" name="postalAddress" value="<?php echo "Address"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Phone Number: </td>
                  <td><input type="text" name="phone" value="<?php echo "Phone"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Email:</td>
                  <td><input type="text" name="email" value="<?php echo "$EmailId"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Fax:</td>
                  <td><input type="text" name="fax" value="<?php echo "$Fax"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Business Contact:</td>
                  <td><input type="text" name="businessContact" value="<?php echo "$Fax"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td>Prefer to receive invoices via: </td>
                  <td><input type="text" name="invoicesVia" value="<?php echo "$PTI"; ?>" class="form-control"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type="submit" class="btn btn-info" name="billing_details" value="Save"></td>
                </tr>
              </table>
            </form>
            <br>
            <button data-toggle="collapse" data-target="#demo4" style=" width:200px; margin:3px;">Invoices</button>
            <div id="demo4" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;"> <font color="#666666" size="+1">Invoices</font>
              <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                  <tr>
                    <th class="hidden-480">Nos.</th>
                    <th class="hidden-480">Invoice Number</th>
                    <th class="hidden-480">Date Invoiced</th>
                    <th class="hidden-480">Amount Payable</th>
                    <th class="hidden-480">Due Date</th>
                    <th class="hidden-480">Status</th>
                    <th class="hidden-480">View/Save Invoices</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."user_invoice WHERE Uid = '".$_SESSION['userid']."' ORDER BY id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
											
									?>
                  <tr class="odd gradeX">
                    <td class="hidden-480"><?=$ctn;?></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['invoiceNo']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['invoiceDate']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['amount']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['dueDate']?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                        <?php  if($rowdest['status'] == 'Yes'){?>
                        <span style="color:#0C0;">Paid</span>
                        <?php }else{?>
                        <span style="color:#F30;">Payment Due</span>
                        <?php }?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> <a href="download.php?path=upload_invoice&file=<?=$rowdest['pdf']?>" class="btn mini red"><img style="height:40px;" src="images/pdf.png"></a></div></td>
                  </tr>
                  <?php $ctn++; } ?>
                </tbody>
              </table>
              <a href="#">View older invoice</a> </div>
            <br>
            <script>
			function saveMe() {
				//alert ("ok");
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (xhttp.readyState == 4 && xhttp.status == 200) {
				  document.getElementById("demo5").innerHTML = xhttp.responseText;
				}
			  };
			  xhttp.open("POST", "billingEnquiries.php", true);
			  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  xhttp.send("enqTitle="+document.getElementById("enqTitle").value+"&enquires="+document.getElementById("enquires").value+"");
			}
			</script>
            <button data-toggle="collapse" data-target="#demo5" style=" width:200px; margin:3px;">Billing Enquiries</button>
            <div id="demo5" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;"> <font color="#666666" size="+1">Billing Enquiries</font>
              <form name="" action="" method="post">
                New Enquiry:
                <table>
                  <tr>
                    <td><font color='red'>*</font>Subject:
                      <input type="text" name="enqTitle"  id="enqTitle" class="form-control">
                    </td>
                  </tr>
                  <tr>
                    <td><font color='red'>*</font>Enquiry:
                      <textarea cols="105" rows="5" name="enquires"  id="enquires" class="form-control"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td><br />
                      <input type="button" class="btn btn-info" name="submit_enq" value="Submit"  onclick="saveMe()">
                    </td>
                  </tr>
                </table>
              </form>
              <font color="#666666" size="+1">Previous Enquiries</font>
              <!--<table class="table" style="background:#E8FDFF;">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Recipt no</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <?php
		   $q=mysql_query("SELECT * FROM billing_enquires WHERE Uid = '".$_SESSION['userid']."' order by sl desc");
		   while($row = mysql_fetch_array($q) )
		   {
			   $sl = $row[sl];
			   $title = $row[title];
			   $detail = $row[detail];
			   $date = $row['date'];
			   $answered = $row['answered'];
			   $answered_date = date('d F Y', strtotime($row['answered_date']));
			   $answer_details = $row['answer_details'];
			   $date1=$date;
			   $date=date_create($date);
			   $date=date_format($date,"d F Y");
			   if($answered){$ans="Resolved";}else{$ans="In Progress";}
			   if($answered){$rr=" <span class='glyphicon glyphicon-ok'></span>";}else{$rr="<span class='glyphicon glyphicon-random'></span>";}
		   ?>
                <tr bgcolor="#C1F4FD">
                  <td><?= $date ?></td>
                  <td><?php echo "VIC$sl"; ?></td>
                  <td><?php echo $ans; ?></td>
                  
                  <td style="text-align:right;"><button  class="btn btn-info" data-toggle="collapse" data-target="#demo_detail<?=$sl;?>" style="margin:3px;">
                    View details
                    </button>
                    <div id="demo55" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;">
                  </td>
                </tr>
                <tr>
                  <td colspan="5"><div id="demo_detail<?=$sl?>" class="collapse" > Date:
                      <?= $date ?>
                      <h4>
                       Title : <?= $title ?>
                      </h4>
                      <h6>
                       Enquery : <?= $detail ?>
                      </h6>
					  <?php if($answer_details != ""){?>
					  <b><?= $answered_date ?></b>
					  <h6>Answered : <?=$answer_details;?></h6>
					  <?php }else{?>
					  <h6>Answered : N/A</h6>
					  <?php }?>
                    
                    </div></td>
                </tr>
                <?php } ?>
              </table>-->
			  <table class="table" style="background:#E8FDFF;">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Recipt no</th>
                      <th>Status</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <?php
		   $q=mysql_query("SELECT * FROM billing_enquires WHERE Uid = '".$_SESSION['userid']."' order by sl desc");
		   while($row = mysql_fetch_array($q) ){
			   $sl = $row[sl];
			   $title = $row[title];
			   $detail = $row[detail];
			   $date = date('d F Y', strtotime($row['date']));
			   $answered = $row['answered'];
			   $receipt_no = $row['receipt_no'];
		   /*$date1=$date;
		   $date=date_create($date);
		   $date=date_format($date,"d F Y");*/
		   if($answered){$ans="Resolved";}else{$ans="In Progress";}
		   if($answered){$rr=" <span class='glyphicon glyphicon-ok'></span>";}else{$rr="<span class='glyphicon glyphicon-random'></span>";}
		   ?>
                  <tr bgcolor="#C1F4FD">
                    <td><?= $date ?></td>
                    <td><?php echo $row['receipt_no']; ?></td>
                    <td><?php echo $ans; ?></td>
                   <!-- <td><?php echo $rr; ?></td>-->
                    <td align="right";><button  class="btn btn-info" data-toggle="collapse"  data-target="#demo_detail<?=$sl?>" style=" width:200px; margin:3px;">View details</button>
                      <div id="demo55" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;"></div></td>
                  </tr>
                  <tr>
                    <td colspan="4"><div id="demo_detail<?=$sl?>" class="collapse" > 
					<div id="<?=$receipt_no?>">	
					<table width="100%" ><tr style="font-size:18px;"><td width="10%">Subject : </td><td><b><?= $title ?></b></td></tr>
 <?php 
 $ql = mysql_query("SELECT * FROM client_enquery WHERE receipt_no = '".$receipt_no."'");
 while($enq = mysql_fetch_array($ql))
 		{
		
		if($enq['reply_by'] == 'client'){
?>
	 <tr><td>Me : </td><td rowspan="2"><?= $enq['reply'] ?><br/><?=date('d F Y H:i:s', strtotime($enq['reply_date']));?></td></tr>
	 <tr><td>&nbsp;</td></tr>
<?php }else{?>
	<tr><td>Admin : </td><td rowspan="2"><?= $enq['reply'] ?><br/><?=date('d F Y H:i:s', strtotime($enq['reply_date']));?></td></tr>
	<tr><td>&nbsp;</td></tr>

<?php 
	}
}?>

 </table>
 </div>
  <?php if($answer == ""){?>
          <form name="" action="" method="post"><b>Reply:</b>
          <table>
        <td valign="top"> 
        <input type="hidden" name="receiptNo" id="receiptNo<?=$receipt_no;?>" class="form-control" value="<?=$receipt_no;?>">
		<input type="hidden" id="enquery_title<?=$receipt_no;?>" value="<?=$title?>">
        <br />
		<textarea cols="100" rows="5" name="client_reply" id="client_reply<?=$receipt_no;?>" class="form-control"></textarea>
        </td>
        </tr>
        <tr>
        <td><br />
			<button type="button" class="btn btn-info" name="" onclick="saveClientMe<?=$receipt_no;?>()" >Reply</button>
			
            </td>
            </tr>
            </table>
            </form>
			
			<script>
function saveClientMe<?=$receipt_no;?>() {
		//var receipt_no = document.getElementById("receiptNo").value;
		
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		  document.getElementById('<?=$receipt_no;?>').innerHTML = xhttp.responseText;
		  document.getElementById("client_reply<?=$receipt_no;?>").value = "";
		}
	  };
	  xhttp.open("POST", "client-payEnquiries.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send("receipt_no="+document.getElementById("receiptNo<?=$receipt_no;?>").value+"&enquires="+document.getElementById("client_reply<?=$receipt_no;?>").value+"&enquery_title="+document.getElementById("enquery_title<?=$receipt_no;?>").value);
}
</script> 

  <?php }?>
				
		 
                        <!--_________________________________________--> 
                      </div></td>
                  </tr>
                  <?php } ?>
                </table>
            </div>
			
	
            <br>
			
			
            <button data-toggle="collapse" data-target="#demo6" style=" width:200px; margin:3px;">Payment Options</button>
            <div id="demo6" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;"> <font color="#666666" size="+1">Payment Options</font>
              <table class="table" align="center"  style="background:#FFF">
                <tr align="center">
                  <td>Payment Mode</td>
                  <td> Instructions</td>
                </tr>
                <tr align="center">
                  <td> Direct Bank Deposit in a Branch or Electronic Funds Transfer (EFT)</td>
                  <td> Pay To
                    Account Holder: JOB IN MINUTES PTY LTD
                    BSB: 062948
                    Account Number: 1372 7633
                    Bank: Commonwealth Bank of Australia (CBA) Reference: Invoice Number </td>
                </tr>
                <tr align="center">
                  <td> Cheque or Bank Cheque	Pay To
                    JOB IN MINUTES PTY LTD</td>
                  <td> Reference/Memo: Invoice Number
                    
                    Post the cheque(s) to:
                    PO BOX 1234
                    Suburb, VIC 3333 </td>
                </tr>
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
