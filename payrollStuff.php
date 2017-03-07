	<?php
//session_start();
include"config/connect.php";
if($_SESSION["userid"]){}else{header('Location: login1.php');exit();}
	


	
	
	//------------insert bank detais--------------
	if(isset($_REQUEST['submit']))
	{
	$r=mysql_query("INSERT INTO account_details (sl, Uid, acName, acNo, BSB, bankName, dt,view) VALUES (NULL, '".$_SESSION["userid"]."', '".$_POST["acName"]."', '".$_POST["acNo"]."', '".$_POST["BSB"]."', '".$_POST["bankName"]."', now(),'No');") or die ("error: ".mysql_error());
	if($r){$msg="<font color='green'>Successfully inserted.</font>";}
	else{$msg="<font color='red'>Not inserted.</font>";}
	header('Location: payrollStuff.php');
	}
	//=-------------end bank details---------------------
	
	//-----------delete bank account --------------------
	if(isset($_REQUEST["slDeleteAc"]))
	{
		
		
			//r=mysql_query("UPDATE account_details SET view = '0' WHERE sl = '".$_GET["slDeleteAc"]."';") or die ("error: ".mysql_error());
			$r = mysql_query("DELETE FROM account_details WHERE sl = '".$_REQUEST["slDeleteAc"]."'");
	if($r){$msg="<font color='green'>Successfully Deleted.</font>";}
	else{$msg="<font color='red'>Not Deleted.</font>";}
	header('Location: payrollStuff.php');
		
		
	
	}
	
	//------------end delete bank account------------------
	
	
/******************************** ACCOUNT INFO ADD/Edit Start**************************************/
if(isset($_REQUEST['acc_submit']))
{
	$uid = $_REQUEST['Uid'];
	$acc_id = $_REQUEST['acc_id'];
	$acName = $_REQUEST['acName'];
	$bankName = $_REQUEST['bankName'];
	$BSB = $_REQUEST['BSB'];
	$acNo = $_REQUEST['acNo'];
	$percent_salary = $_REQUEST['percent_salary'];
	
	$qry = "UPDATE account_details SET 
									acName = '".$acName."',
									bankName = '".$bankName."',
									BSB = '".$BSB."',
									acNo = '".$acNo."',
									percent_salary = '".$percent_salary."'
									WHERE sl = '".$acc_id."'";
	$update = mysql_query($qry);
	if($update)
	{
		echo "<script>window.location.href='payrollStuff.php?update=usucc';</script>";
		exit();
	}
}



/******************************** ACCOUNT INFO ADD/Edit End**************************************/	
/******************************** ADD/EDIT NSF Start**************************************/

if(isset($_REQUEST['submit_nsf']))
{
	$uid = $_REQUEST['Uid'];
	$nsf_id = $_REQUEST['nsf_id'];
	$spin = $_REQUEST['spin'];
	$memberNumber = $_REQUEST['memberNumber'];
	$fundABN = $_REQUEST['fundABN'];
	$fundName = $_REQUEST['fundName'];
	$fundAddress = $_REQUEST['fundAddress'];
	$fundPhoneNumber = $_REQUEST['fundPhoneNumber'];
	$cnt = mysql_num_rows(mysql_query("SELECT sl FROM nsf WHERE sl = '".$nsf_id."'"));
	if($cnt > 0)
	{
		
		$update = mysql_query("UPDATE nsf SET 
										spin = '".$spin."',
										memberNumber = '".$memberNumber."',
										fundABN = '".$fundABN."',
										fundName = '".$fundName."',
										fundAddress = '".$fundAddress."',
										fundPhoneNumber = '".$fundPhoneNumber."'
										WHERE sl = '".$nsf_id."'");
		if($update)
		{
			echo '<script>window.location.href="payrollStuff.php?u=unsf&#nsf"</script>';
			exit();
		}
	}
}

/******************************** ADD/EDIT NSF End**************************************/	
/**********************Fetch Staff Info********************************************/
$SqlUser = "SELECT * FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result = mysql_query($SqlUser);
			
				
				$row = mysql_fetch_array($result);
				
					$FirstName=$row['FirstName'];
					$LastName=$row['LastName'];
			
				
				
				
				if($row['UserImage'] == "")
				{
					$pic = "profileImage/profile_pic.jpg";
				}
				else if(!is_file("profileImage/".$row['UserImage']))
				{
					$pic = "profileImage/profile_pic.jpg";
				}
				else
				{
					$pic = "profileImage/".$row['UserImage'];
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
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<noscript>
<link rel="stylesheet" type="text/css" href="css/styleNoJS.css" />
</noscript>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<style type="text/css">
.acfld {
	width : 120px;
	height: 25px;
	padding: 3px;
}
</style>
<script>
  $(document).ready(function() {
    $("#dt_from").datepicker({
      dateFormat: 'dd-mm-yy'
	});
	
	$("#dt_to").datepicker({
      dateFormat: 'dd-mm-yy'
	});
  });
  
</script>
</head><body>
<?php include'headerLoginStuff.php';?>
<section class="latest-news">
  <div class="container">
    <div class="row"> 
      
      <!-- ************************************************************************************************************************************-->
      <div class="col-lg-10 col-sm-10 pull-center col-md-offset-1" >
        <div class="card hovercard" style="background:url(images/bg.jpg);">
          <div class="card-background"> <img class="card-bkimg" alt="" src=""> 
            <!-- http://lorempixel.com/850/280/people/9/ --> 
          </div>
          <div class="useravatar"> <img alt="" src="<?=$pic?>"> </div>
          <div class="card-info"> <span class="card-title"><?php echo $FirstName ." ".$LastName; ?></span> </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" id="profile" class="btn btn-default"  onclick="location.href = 'profileStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <div class="hidden-xs">Profile</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'allocationsStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <div class="hidden-xs">Allocations</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button"  class="btn btn-primary"  onclick="location.href = 'payrollStuff.php';"data-toggle="tab"> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            <div class="hidden-xs">Payroll</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'vicnaEmailStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            <div class="hidden-xs">My VICNA Email</div>
            </button>
          </div>
        </div>
        <div class="well">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
              <h3>Payroll</h3>
              <!-- ------------------------------------------------------------------------------------------------------ --> 
              <br>
              <br>
              <b>Payroll Details </b> <br>
              <br>
              <h4 style="font-weight:bold; color:#000;"> ATO Tax File Number (TFN): <span style="color:#F30;">
                <?=$row['tax_file_number'];?>
                </span><br>
                Nominated Bank Account(s) for Salary Deposit:</h4>
              <br>
              <?php echo $msg; if(isset($_REQUEST['update'])){echo '<span style="color:green;">Account Information Update Successfully.</span>';} ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>sl</th>
                    <th>Account Holder’s Name</th>
                    <th>Bank Name</th>
                    <th>BSB</th>
                    <th>Account Number</th>
                    <th>% of Salary</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <?php	
         //--------------show bank details-------------------
	$r=mysql_query("Select * from account_details where Uid = '".$_SESSION['userid']."'");
	if($r){$msg="<font color='green'>Successfully inserted.</font>";}
	else{$msg="<font color='red'>Successfully inserted.</font>";}
	$c=0;
	
				while($row = mysql_fetch_array($r))
				{
					$c++;
					$acName=$row['acName'];
					$acNo=$row['acNo'];
					$BSB=$row['BSB'];
					$bankName=$row['bankName'];
					$percent_salary = $row['percent_salary'];
					$dt=$row['dt'];
					$sl=$row['sl'];
		?>
                <tr>
                  <td><?=$c?></td>
                  <td><?=$acName?></td>
                  <td><?=$bankName?></td>
                  <td><?=$BSB?></td>
                  <td><?=$acNo?></td>
                  <td><?=$percent_salary?>
                    %</td>
                  <td><?php if($row['view'] == 'Yes'){?>
                    <button type="button" data-toggle="collapse" data-target="#acc_info<?=$c;?>" class="btn mini green"> <span class='glyphicon glyphicon-edit' aria-hidden='true' style='color:green;'></span></button>
                    <?php }?></td>
                  <td><?php if($row['view'] == 'Yes'){?>
                    <a onClick='return delAccount($sl);'><span class='glyphicon glyphicon-remove' aria-hidden='true'  style='color:red;'></span></a>
                    <?php }?></td>
                </tr>
                <tr class="collapse" id="acc_info<?=$c;?>">
                  <form action="<?=$SERVER['PHP_SELF'];?>" method="post" id="form<?=$qty;?>">
                    <input type="hidden" name="Uid" value="<?=$_SESSION['userid'];?>">
                    <input type="hidden" name="acc_id" value="<?=$row['sl'];?>">
                    <td>&nbsp;</td>
                    <td><input class="acfld" type="text" name="acName" value="<?=$row['acName'];?>"></td>
                    <td><input class="acfld" type="text" name="bankName" value="<?=$row['bankName'];?>"></td>
                    <td><input class="acfld" type="text" name="BSB" value="<?=$row['BSB'];?>"></td>
                    <td><input class="acfld" type="text" name="acNo" value="<?=$row['acNo'];?>"></td>
                    <td><input class="acfld" type="text" name="percent_salary" value="<?=$row['percent_salary'];?>"></td>
                    <td><input  type="submit" name="acc_submit" value="Update"></td>
                    <td>&nbsp;</td>
                  </form>
                </tr>
                <?php
				}
				
	//-------------end show bank details--------------------
	?>
              </table>
              <?php 
		if($c > 2){}else
         {?>
              <a href="#">Enter Another bank account number</a>
              <form action="" method="post">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Account Holder’s Name</th>
                      <th>Bank Name</th>
                      <th>BSB</th>
                      <th>Account Number</th>
                    </tr>
                  </thead>
                  <tr>
                    <td><input type="text" name="acName"></td>
                      </td>
                    <td><input type="text" name="bankName"></td>
                    <td><input type="text" name="BSB"></td>
                    <td><input type="text" name="acNo"></td>
                  </tr>
                </table>
                <input type="submit" name="submit" value="submit">
              </form>
              <?php   }
	   ?>
              <hr>
              <!----------------Nominated Superannuation Fund Start-------------------------->
              <div id="nsf"></div>
              <div>
                <h4 style="font-weight:bold; color:#000;">Nominated Superannuation Fund:</h4>
                <!--Week Starting 02 June 2016-->
                <?PHP 
			$GetQuery=mysql_query("select * from nsf where Uid=".$_SESSION["userid"]."") or die("Error : ".mysql_error());;
			$row = mysql_fetch_array($GetQuery);
			
				$spin=$row['SPIN'];									
			
			?>
                <?php if(isset($_REQUEST['u']) && $_REQUEST['u'] == 'unsf'){?>
                <h5 style="color:#093; font-weight:bold;">Nominated Superannuation Fund Update Successfully.</h5>
                <?php }
			  if($row['view'] == 'Yes'){
			  ?>
                <button style="float:right; margin-right:20px;" title="Edit Details" type="button" id="fund_vw" class="btn mini green"> <span class='glyphicon glyphicon-edit' aria-hidden='true' style='color:green;'></span></button>
                &nbsp;
                <button style="display:none; float:right; margin-right:20px;" title="View Details" type="button" id="fund_edt" class="btn mini green"> View</button>
                <?php }?>
              </div>
              <!----------------View Nominated Superannuation Fund Start------------------------------>
              <table class="table"  id="fund_view">
                <tr>
                  <td width="50%">Superannuation Product Identification Number (SPIN)</td>
                  <td><?php echo $row['SPIN'] ?></td>
                </tr>
                <tr>
                  <td>Member Number</td>
                  <td><?=$row['memberNumber'] ?></td>
                </tr>
                <tr>
                  <td>Fund ABN</td>
                  <td><?=$row['fundABN'] ?></td>
                </tr>
                <tr>
                  <td>Fund Name</td>
                  <td><?=$row['fundName'] ?></td>
                </tr>
                <tr>
                  <td>Fund Address</td>
                  <td><?=$row['fundAddress'] ?></td>
                </tr>
                <tr>
                  <td>Fund Phone Number</td>
                  <td><?=$row['fundPhoneNumber'] ?></td>
                </tr>
              </table>
              <!------------------- Edit Superannuation Fund Start-------------------------->
              <table class="table" id="fund_edit" style="display:none;">
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="nsf_id" value="<?=$row['sl']?>">
                  <input type="hidden" name="Uid" value="<?=$_SESSION['Uid']?>">
                  <tr>
                    <td><p>Superannuation Product Identification Number (SPIN)</p></td>
                    <td width="5%"><p>:</p></td>
                    <td><p>
                        <input type="text" name="spin" value="<?=$row['SPIN']?>">
                      </p></td>
                  </tr>
                  <tr>
                    <td><p>Member Number</p></td>
                    <td width="5%"><p>:</p></td>
                    <td><p>
                        <input type="text" name="memberNumber" value="<?=$row['memberNumber']?>">
                      </p></td>
                  </tr>
                  <tr>
                    <td><p>Fund ABN</p></td>
                    <td width="5%"><p>:</p></td>
                    <td><p>
                        <input type="text" name="fundABN" value="<?=$row['fundABN']?>">
                      </p></td>
                  </tr>
                  <tr>
                    <td><p>Fund Name</p></td>
                    <td width="5%"><p>:</p></td>
                    <td><p>
                        <input type="text" name="fundName" value="<?=$row['fundName']?>">
                      </p></td>
                  </tr>
                  <tr>
                    <td><p>Fund Address</p></td>
                    <td width="5%"><p>:</p></td>
                    <td><p>
                        <input type="text" name="fundAddress" value="<?=$row['fundAddress']?>">
                      </p></td>
                  </tr>
                  <tr>
                    <td><p>Fund Phone Number</p></td>
                    <td width="5%"><p>:</p></td>
                    <td><p>
                        <input type="text" name="fundPhoneNumber" value="<?=$row['fundPhoneNumber']?>">
                      </p></td>
                  </tr>
                  <tr>
                    <td><p></p></td>
                    <td width="5%"><p></p></td>
                    <td><input type="submit" class="btn btn-success" style="background-color:#093;" name="submit_nsf" value="Submit"></td>
                  </tr>
                </form>
              </table>
              <!---------------------- Nominated Superannuation Fund End-------------------------->
              <?php
	
										

	?>
              <br>
              <br>
  					<!---------------------- Weekly PAYG Summaries Start-------------------------->
                    
              <button data-toggle="collapse" data-target="#demo" style="width:200px; margin-top:3px;">Weekly PAYG Summaries</button>
              <br>
              <div id="demo" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;"> 
              <p>Please enter the pay period ending dates and click [OK] to view your weekly PAYG summaries (Payslips).</p> 
               <p> Payslips for the current Financial Year are displayed by default. To view other Financial Year's payslips, change the Start Date & End Date, and click OK.</p>
               <p> You will need Adobe Acrobat Viewer in order to view  <img src="images/pdf.jpg"> PDF files. Please <a href="https://get.adobe.com/uk/reader/" target="_blank">Install or Upgrade your Adobe Reader</a> to the latest version if you have not previously installed it, or if you have an earlier version already installed on your computer.</p><br>
                <br>
                <div class="row">
                <style type="text/css">
				.date{ width:150px; height:25px; padding-left:5px; background-color:#CC9;}
				</style>
                  <div class="col-sm-6">
                    <table class="table">
                      <tr>
                        <td>Start date :
                          <input type="text" class="date" name="dt_from" id="dt_from"></td>
                        <td>End date :
                          <input type="text" class="date" name="dt_to" id="dt_to"></td>
                        <td valign="middle"><br>
                         <input type="button" class="" name="show_payslip" value="OK"  onclick="show_payslip()"></td>
                      </tr>
                    </table>
                  </div>
                </div>
               
                <b>View/Save Payslips</b>
                <div id="view_payslip">
                <!--<table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Pay Period Ending</th>
                      <th>Date Paid</th>
                      <th>Gross</th>
                      <th>Tax</th>
                      <th>Nett</th>
                      <th>View/Save<br>
                        Payslips</th>
                    </tr>
                  </thead>
                  <?PHP $c=0; 
$GetQuery=mysql_query("select * from pay_slip where Uid=".$_SESSION["userid"]."") or die("Error : ".mysql_error());;
while($row = mysql_fetch_array($GetQuery))
{ $c++;
	$spin=$row['SPIN'];$g=$row['gross'];$t=$row['tax'];
	?>
                  <tr>
                    <td><?=$c?>
                      .</td>
                    <td><?=$row['payPeriodEnding'];?></td>
                    <td><?=$row['datePaid'];?></td>
                    <td>$
                      <?=$row['gross'];?></td>
                    <td>$
                      <?=$row['tax'];?></td>
                    <td>$<?php echo ($g - $t) ?></td>
                    <td><img src="images/pdf.jpg"></td>
                  </tr>
                  <?php
}
?>
                </table>-->
                </div>
                
                <br>
              </div>
<script>
function show_payslip() {
	
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		  document.getElementById("view_payslip").innerHTML = xhttp.responseText;
		}
	  };
	  xhttp.open("POST", "ajax/weeklyPayg.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send("dt_from="+document.getElementById("dt_from").value+"&dt_to="+document.getElementById("dt_to").value+"");
}
</script>     

				<!---------------------- Weekly PAYG Summaries End-------------------------->   
        
 
              <button data-toggle="collapse" data-target="#demo1" style="width:200px; margin-top:3px;">Group Certificates</button>
              <br>
              <div id="demo1" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;"> <b> Group Certificates </b><br>
                <br>
                <br>
                <br>
                Here are your last five EOFY PAYG Summaries from VICNA. 
                
                <table class="table">
                  <tr>
                    <th>Financial Year</th>
				<?php $crnt_year = date('Y');
						$prev_year = $crnt_year - 1;
						$cnt = 1;
						while( $cnt <= 5)
						{
				?>
                    <td><?=$prev_year.'-'.$crnt_year;?></td>
				<?php $cnt++;
					$crnt_year = $crnt_year - 1;
					$prev_year = $crnt_year - 1;
						}
				?>
                   
                  </tr>
                  <tr>
                    <th>View/Save Group Certificate</th>
				<?php 
				$crnt_year = date('Y');
				$prev_year = $crnt_year - 1;
				$cnt = 1;
				while( $cnt <= 5)
				{
					$session_year = $prev_year.'-'.$crnt_year;
					$fetch = mysql_fetch_array(mysql_query("SELECT group_payslip FROM group_payslip WHERE Uid = '".$_SESSION['userid']."' AND session_year = '".$session_year."'"));
				?>
					<td>
						<?php if($fetch['group_payslip'] != ""){?>
						<a href="download.php?path=payslip&file=<?=$fetch['group_payslip']?>" ><img style="height:40px;" src="images/pdf.png"></a>
						<?php }else{echo 'N/A';}?>
					</td>
                <?php  $cnt++;
					$crnt_year = $crnt_year - 1;
					$prev_year = $crnt_year - 1;
				}?>   
                  </tr>
                </table>
                For older group certificates, email payroll at <a href="mailto:payroll@vicna.com.au">payroll@vicna.com.au</a> or use <span style="color:#3399FF; font-weight:bold;">Pay Enquiries</span> feature. <br>
                <br>
              </div>
              <button data-toggle="collapse" data-target="#demo2" style="width:200px; margin-top:3px;" >Pay Enquiries</button>
              <br>
              <div id="demo2" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;">
                <?php
/*if($_POST["subject"] & $_POST["enquery"]){
$r=mysql_query("INSERT INTO payenquiries (sl,Uid, subject, inquery, ansSl, dt) VALUES (NULL, '".$_SESSION["userid"]."','".$_POST["subject"]."', '".$_POST["enquery"]."', '".$_POST["ansSl"]."', now());");
		
		if($r){$upload_msg="<font color='green'>Successfully send.</font><br>";}
		else{$upload_msg="<font color='red'>Not send.</font><br>";}
        
}*/
		?>
                <font color="#666666" size="+1">Pay Enquiries</font>
                <form name="" action="" method="post">
                  <table>
                    <tr>
                      <td><font color='red'>*</font>Subject:
                        <input type="text" name="enqTitle"  id="enqTitle" class="form-control"></td>
                    </tr>
                    <tr>
                      <td><font color='red'>*</font>Enquiry:
                        <textarea cols="105" rows="5" name="enquires"  id="enquires" class="form-control"></textarea></td>
                    </tr>
                    <tr>
                      <td><br />
                        <input type="button" class="btn btn-info" name="submit_enq" value="Submit"  onclick="saveMe()"></td>
                    </tr>
                  </table>
                </form>
                <!-- ------------------------------------------------------------------------------------------------------ -->
<script>
function saveMe() {
	
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		  document.getElementById("demo2").innerHTML = xhttp.responseText;
		}
	  };
	  xhttp.open("POST", "payEnquiries.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send("enqTitle="+document.getElementById("enqTitle").value+"&enquires="+document.getElementById("enquires").value+"");
}
</script> 
                <font color="#666666" size="+1">Previous Enquiries</font>
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
		   $q=mysql_query("SELECT * FROM pay_enquires WHERE Uid = '".$_SESSION['userid']."' order by sl desc");
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
                    <td><?php echo "VIC$sl"; ?></td>
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
 $ql = mysql_query("SELECT * FROM staff_enquery WHERE receipt_no = '".$receipt_no."'");
 while($enq = mysql_fetch_array($ql))
 		{
		
		if($enq['reply_by'] == 'staff'){
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
		<textarea cols="100" rows="5" name="staff_reply" id="staff_reply<?=$receipt_no;?>" class="form-control"></textarea>
        </td>
        </tr>
        <tr>
        <td><br />
			<button type="button" class="btn btn-info" name="" onclick="saveStaffMe<?=$receipt_no;?>()" >Reply</button>
			
            </td>
            </tr>
            </table>
            </form>
<script>
function saveStaffMe<?=$receipt_no;?>() {
		//var receipt_no = document.getElementById("receiptNo").value;
		
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		  document.getElementById('<?=$receipt_no;?>').innerHTML = xhttp.responseText;
		  document.getElementById("staff_reply<?=$receipt_no;?>").value = "";
		}
	  };
	  xhttp.open("POST", "staff-payEnquiries.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send("receipt_no="+document.getElementById("receiptNo<?=$receipt_no;?>").value+"&enquires="+document.getElementById("staff_reply<?=$receipt_no;?>").value+"&enquery_title="+document.getElementById("enquery_title<?=$receipt_no;?>").value+"");
}
</script> 
  <?php }?>
					
					<!--Date:
                        <?= $date ?>
                        <h4>
                          <?= $title ?>
                        </h4>
                        <h6>
                          <?= $detail ?>
                        </h6>-->
                        <?php
		  /* $q2=mysql_query("SELECT * FROM pay_enquires WHERE answered = '".$sl."' order by sl desc");
		   while($row2 = mysql_fetch_array($q2) ){$sl2 = $row2[sl];$title = $row2[title];$detail = $row2[detail];$date = $row2['date'];$answered = $row2['answered'];
		   echo "________________________________________<br>Date:$date<br><h4>$title</h4>";
		   echo "<h6>$detail</h6><br>";
		   
		   }
		*/
		   ?>
                        <!--_________________________________________--> 
                      </div></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
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
    <script type="text/javascript">
$('#fund_vw').click(function(){
	$('#fund_vw').css('display', 'none');
	$('#fund_view').css('display', 'none');
	$('#fund_edt').css('display', 'block');
	$('#fund_edit').css('display', 'block');	
});

$('#fund_edt').click(function(){
	$('#fund_vw').css('display', 'block');
	$('#fund_view').css('display', 'block');
	$('#fund_edt').css('display', 'none');
	$('#fund_edit').css('display', 'none');	
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

<!-- form copy***************************************************** --> 
<script>
function delAccount(sl)
{
	//window.location.href="payrollStuff.php?slDeleteAc="+sl;
	if(confirm("Are you sure you want to delete this Account Details?"))
	{
		
		location.href="payrollStuff.php?slDeleteAc="+sl;
		
	}
	else
	{
		return false;
	}
	
}
/*$("#delete-button").click(function(){
    if(confirm("Are you sure you want to delete this?")){
        $("#delete-button").attr("href", "query.php?ACTION=delete&ID='1'");
    }
    else{
        return false;
    }
});*/
</script> 

<!-- ****************************************************************** end -->
</body>
</html>