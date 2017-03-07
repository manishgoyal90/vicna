<?php include"lib/header.php";?>
<?php
/****************************Staff Profile Inormation Update*****************************/
/*if(isset($_REQUEST['Update'])) {	                         
	$uid = $_REQUEST['Uid'];
	$businessName = $_REQUEST['businessName'];
	$tradingName = $_REQUEST['tradingName'];
	$abn = $_REQUEST['abn'];
	$businessAddress = $_REQUEST['businessAddress'];
	$postalAddress = $_REQUEST['postalAddress'];
	$phone = $_REQUEST['phone'];
	$email = $_REQUEST['email'];
	$fax = $_REQUEST['fax'];
	$businessContact = $_REQUEST['businessContact'];
	$invoicesVia = $_REQUEST['invoicesVia'];	
	$dt = $_REQUEST['dt'];
	
	$sql = mysql_query("SELECT * FROM billing_dtls WHERE clientId = '".$_REQUEST['Uid']."'");
	$cnt = mysql_num_rows($sql);
	if($cnt > 0)
	{
		
		$update = mysql_query("UPDATE billing_dtls SET
												businessName = '".$businessName."',
												tradingName = '".$tradingName."',
												abn = '".$abn."',
												businessAddress = '".$businessAddress."',
												postalAddress = '".$postalAddress."',
												phone = '".$phone."',
												email = '".$email."',
												fax = '".$fax."',
												businessContact = '".$businessContact."',
												invoicesVia = '".$invoicesVia."',
												dt = '".$dt."'
												 WHERE clientId = '".$uid."'");
		if($update)
		{
			echo '<script>alert("Update Successfully.");</script>';
			echo '<script>window.location.href="staffinfo.php?Uid='.$uid.'&update=succ";</script>';
			exit();
		}
	}else
	{
		
		$Insert = mysql_query("INSERT INTO billing_dtls SET
												clientId = '".$uid."',
												businessName = '".$businessName."',
												tradingName = '".$tradingName."',
												abn = '".$abn."',
												businessAddress = '".$businessAddress."',
												postalAddress = '".$postalAddress."',
												phone = '".$phone."',
												email = '".$email."',
												fax = '".$fax."',
												businessContact = '".$businessContact."',
												invoicesVia = '".$invoicesVia."',
												dt = '".$dt."'"
												 );
		if($Insert)
		{
			echo '<script>alert("Update Successfully.");</script>';
			echo '<script>window.location.href="staffinfo.php?Uid='.$uid.'&update=succ";</script>';
			exit();
		}	
	}
			
}
*/
if($_REQUEST['submit']=="Update")
			{	
				$uid = $_REQUEST['Uid'];                   
				$fname = $_REQUEST['FirstName'];     
				$lname = $_REQUEST['LastName'];
				$username = mysql_real_escape_string(stripslashes($_REQUEST['UserName']));
				$email = mysql_real_escape_string(stripslashes($_REQUEST['EmailId']));
				//$password = mysql_real_escape_string(stripslashes($_REQUEST['password']));  
				$Gender = $_REQUEST['Gender'];
				$Password = $_REQUEST['Password'];
				$Country = addslashes($_REQUEST['Country']);
				$State = $_REQUEST['State'];
				$Address = $_REQUEST['Address'];	
				$City = $_REQUEST['City'];
				$Phone = addslashes($_REQUEST['Phone']);
				$vicnaEmail = $_REQUEST['vicnaEmail'];
				$dob = date('Y-m-d', strtotime($_REQUEST['dob']));
				$qualification = $_REQUEST['qualification'];
				$Fax = addslashes($_REQUEST['Fax']);
				$ZipCode = addslashes($_REQUEST['ZipCode']);
				$BusinessName = $_REQUEST['BusinessName'];
				$TradingName = $_REQUEST['TradingName'];
				$BusinessAddress = addslashes($_REQUEST['BusinessAddress']);
				$Website = addslashes($_REQUEST['Website']);
				
				
				
				
				/*if($_FILES['image']['name']!=''){
							
								$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_REQUEST['uid']."'";
								$unlink_rs = mysql_query($unlink_sql) or mysql_error();
								$row_unlink = mysql_fetch_array($unlink_rs);
								
								$photo = "../profileImage/".$row_unlink['UserImage'];
								
								if(file_exists($photo))
									{
										@unlink($photo);
									}
								if(file_exists($thumb))
									{
										@unlink($thumb);
									}
								if(file_exists($thumb1))
									{
										@unlink($thumb1);
									}
								if(file_exists($thumb2))
									{
										@unlink($thumb2);
									}
								if(file_exists($thumb3))
									{
										@unlink($thumb3);
									}
							
								//Image uploadin start.
								$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
								$max_file_size = 2000 * 1024; #200kb
								//$nw = $nh = 300; # image with # height
								$imgwidth = 200;
								$imgheight =  200;
								
								$imgwidth2 = 100;
								$imgheight2 =  100;
								
								$imgwidth3 = 300;
								$imgheight3 =  250;
								
								$imgwidth4 = 800;
								$imgheight4 =  600;

									$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
									if (in_array($ext, $valid_exts)) {
											//Upload image path...
											$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
											$path = '../profileimage/bigimg/' . $imagename;
											$path1 = '../profileimage/smallimg/' . $imagename;
											$pathfull = '../profileimage/fullsize/' . $imagename;
											$thumb2 = '../profileimage/medium/'.$imagename;
											$thumb3 = '../profileimage/extbig/'.$imagename;
											$tmp = $_FILES['image']['tmp_name'];
											$size = getimagesize($tmp);
						
											$x = (int) $_POST['x'];
											$y = (int) $_POST['y'];
											$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
											$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
						
											$data = file_get_contents($tmp);
											$vImg = imagecreatefromstring($data);
											
											//Crop code...
											$dstImg = imagecreatetruecolor($imgwidth, $imgheight);
											imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $imgwidth, $imgheight, $w, $h);
											imagejpeg($dstImg, $path);
											
											$dstImg1 = imagecreatetruecolor($imgwidth2, $imgheight2);
											imagecopyresampled($dstImg1, $vImg, 0, 0, $x, $y, $imgwidth2, $imgheight2, $w, $h);
											imagejpeg($dstImg1, $path1);
											
											$dstImg2 = imagecreatetruecolor($imgwidth3, $imgheight3);
											imagecopyresampled($dstImg2, $vImg, 0, 0, $x, $y, $imgwidth3, $imgheight3, $w, $h);
											imagejpeg($dstImg2, $thumb2);
											
											$dstImg3 = imagecreatetruecolor($imgwidth4, $imgheight4);
											imagecopyresampled($dstImg3, $vImg, 0, 0, $x, $y, $imgwidth4, $imgheight4, $w, $h);
											imagejpeg($dstImg3, $thumb3);
											
											//Upload image full size...
											@copy($tmp,$pathfull);
											
											imagedestroy($dstImg);
											imagedestroy($dstImg1);
											imagedestroy($dstImg2);
											imagedestroy($dstImg3);
											
										} else {
											echo 'unknown problem!';
									} 

					
				}  else {
					$imagename = $oldimg;	
				}*/

			echo $InsertRegSql="UPDATE ".TABLE_PREFIX."staff_registration SET                 
														FirstName = '".$fname."' ,
														LastName = '".$lname."' ,
														UserName = '".$fname.'.'.$lname."',
														Gender = '".$Gender."' , 
														Password = '".base64_encode($Password)."' , 
														vicnaEmail = '".$vicnaEmail."',
														country = '".$Country."' ,
														state = '".$State."' ,  
														city = '".$City."' ,
														mobile = '".$Phone."' ,  
														zip = '".$ZipCode."',
														dob = '".$dob."',
														qualification = '".$qualification."' 
														
														where Uid = '".$uid."' 
														";
																				
				mysql_query($InsertRegSql) or mysql_error();
				
						echo '<script>alert("Information Update Successfully.");</script>';
						echo '<script>window.location="staffinfo.php?Uid='.$uid.'&mess=successful"</script>';
						exit();
						
						
			}
			
			
	

/*********************Staff Profile Information Update End ******************************/

/*****************************Tax File Number Add/Edit Start*******************************/
if(isset($_REQUEST['tfn_update']))
{
	$uid = $_REQUEST['Uid'];
	$tax_file_number = $_REQUEST['tax_file_number'];
	$update = mysql_query("UPDATE ".TABLE_PREFIX."staff_registration SET tax_file_number = '".$tax_file_number."' WHERE Uid = '".$uid."'");
	if($update)
	{
		 echo '<script>alert("Tax File Number Add/Edit Successfully.");</script>';
		echo '<script>window.location="staffinfo.php?Uid='.$uid.'&update=succtfn"</script>';
		exit();
	}
}



/**************************Tax File Number Add/Edit End********************************/

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
			echo '<script>window.location.href="staffinfo.php?Uid='.$uid.'&update=succ"</script>';
			exit();
		}
	}else
	{
		$insert = mysql_query("INSERT INTO nsf SET 
										Uid = '".$uid."',
										spin = '".$spin."',
										memberNumber = '".$memberNumber."',
										fundABN = '".$fundABN."',
										fundName = '".$fundName."',
										fundAddress = '".$fundAddress."',
										fundPhoneNumber = '".$fundPhoneNumber."',
										view = 'No'");
		if($insert)
		{
			echo '<script>window.location.href="staffinfo.php?Uid='.$uid.'&update=succ"</script>';
			exit();
		}
	}
}

/******************************** ADD/EDIT NSF End**************************************/
	
/******************************** ACCOUNT INFO ADD/Edit Start**************************************/
if(isset($_REQUEST['add_acc_submit']))
{
	
	$uid = $_REQUEST['Uid'];
	$acc_id = $_REQUEST['acc_id'];
	$acName = $_REQUEST['acName'];
	$bankName = $_REQUEST['bankName'];
	$BSB = $_REQUEST['BSB'];
	$acNo = $_REQUEST['acNo'];
	$percent_salary = $_REQUEST['percent_salary'];
	
	$qry = "INSERT INTO account_details SET 
									Uid = '".$uid."',
									acName = '".$acName."',
									bankName = '".$bankName."',
									BSB = '".$BSB."',
									acNo = '".$acNo."',
									percent_salary = '".$percent_salary."',
									view = 'No'";
	$insert = mysql_query($qry);
	if($insert)
	{
		echo "<script>window.location.href='staffinfo.php?Uid=".$uid."&update=isucc';</script>";
		exit();
	}
}


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
		echo "<script>window.location.href='staffinfo.php?Uid=".$uid."&update=usucc';</script>";
		exit();
	}
}



/******************************** ACCOUNT INFO ADD/Edit End**************************************/

/********************************DELETE BANK ACCOUNT INFO**************************************/

if($_REQUEST['action'])
{
	$feedid = $_REQUEST['id'];
	$uid = $_REQUEST['uid'];
	
	$delsingle = "DELETE FROM account_details WHERE sl = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
	echo "<script>alert(Account information deleted successfully.);</script>";
	echo "<script>window.location.href='staffinfo.php?Uid=".$uid."&update=dsucc';</script>";
	exit();
}

/*************************************************************************************/
/**********************Edit Payslip****************************/
if(isset($_REQUEST['edit_payslip']))
{
	$id = $_REQUEST['id'];
	$uid = $_REQUEST['Uid'];
	$payPeriodEnding = date('Y-m-d', strtotime($_REQUEST['payPeriodEnding']));
	$datePaid = date('Y-m-d', strtotime($_REQUEST['datePaid']));
	$gross = $_REQUEST['gross'];
	$tax = $_REQUEST['tax'];
	$nett = $gross - $tax;
	
	$update = mysql_query("UPDATE pay_slip SET payPeriodEnding = '".$payPeriodEnding."',
												datepaid = '".$datePaid."',
												gross = '".$gross."',
												tax = '".$tax."'
												WHERE id = '".$id."'");
	if($update)
	{
		echo '<script>alert("Update Successfully.");</script>';
		echo '<script>window.location.href="staffinfo.php?payslip=usucc&Uid='.$uid.'";</script>';
		exit();
	}
	
}


/************************Edit Payslip End***************************/

		$getdestsql = "SELECT * FROM ".TABLE_PREFIX."staff_registration WHERE Uid  = '".$_REQUEST['Uid']."'";
		$getdestquery = mysql_query($getdestsql) or die(mysql_error());
		$rowdest7 = mysql_fetch_array($getdestquery);
	
		
			
											
					
					if($rowdest7['UserImage'] == "")
					{
						$proset = "../profileImage/profile_pic.jpg";
					}
					else if(!is_file("../profileImage/".$rowdest7['UserImage']))
					{
						$proset = "../rofileImage/profile_pic.jpg";
					}
					else
					{
						$proset = "../profileImage/".$rowdest7['UserImage'];
					} 	
		
	?>
		<script type="text/javascript">
			// Show Designation info  from department
		   function desigCheck(desig) 
			{ 		
				var xmlhttp; 
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				 	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 document.getElementById("showdesig").innerHTML=xmlhttp.responseText;
				  }
			  }
				xmlhttp.open("GET","desiginfo.php?desig=" + desig,true);
				xmlhttp.send();
			}
	</script>
	<script type="text/javascript">
			// Show Designation info from department
		   function empreporting(id) 
			{ 	
				var xmlhttp; 
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				 	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 document.getElementById("showempid").innerHTML=xmlhttp.responseText;
				  }
			  }
				xmlhttp.open("GET","showempreportedit.php?id=" + id,true);
				xmlhttp.send();
			}
	</script>
	<script type="text/javascript">
			// Show Designation info  from department
		   function empreportingname(id) 
			{ 
				var xmlhttp; 
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				 	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 document.getElementById("showempidname").innerHTML=xmlhttp.responseText;
				  }
			  }
				xmlhttp.open("GET","showprivinfonameedit.php?id=" + id,true);
				xmlhttp.send();
			}
	</script>
	<script language="javascript">
	var id2=1;
	function qq2()
	{
	  if(id2<2)
	  {
		id2=id2+1;
		document.getElementById("qwerty"+id2).style.display="block";
		document.getElementById("ar1").style.display="inline";
	  }	
	}
	function removedd2()
	{
	   document.getElementById("qwerty"+id2).style.display="none";
	   id2=id2-1;
	   if(id2==1 || id2==document.getElementById("previdno").value)
		   {
			 document.getElementById("ar1").style.display="none";
		   }
	}
</script>
<!--<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>-->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
  $(document).ready(function() {
    $("#payPeriodEnding").datepicker({
      dateFormat: 'dd-mm-yy'
	});
	
	$("#datePaid").datepicker({
      dateFormat: 'dd-mm-yy'
	});
	$(".dt_pic").datepicker({
      dateFormat: 'dd-mm-yy'
	});
	$("#dob").datepicker({
      dateFormat: 'dd-mm-yy'
	});
  });
  
</script>
	<style type="text/css">
		#tit2 {
			 display: inline-block;
/*			float: left;*/
			font-size: 18px;
			font-weight: 400;
			margin: 0 0 7px;
			padding: 0;
		}
	</style>
	
<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include"lib/leftbar.php";?>	<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<?php include"lib/themecolor.php";?>
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							<?=$pagetitle?> <small>Description</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashboard.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="staff.php">Staff List</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="">Staff Info</a>
							</li>
							<li class="pull-right no-text-shadow"></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
						<?php
						  if($_REQUEST['action'] == 'added')
						  {
						  ?>				  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! User added
						  </div>						  
						  <?php
						  }
						  if($_REQUEST['update'] == 'usucc')
						  {
						  ?>						  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! Account Information Updated.
						  </div>						  
						  <?php
						  }
						   if($_REQUEST['update'] == 'isucc')
						  {
						  ?>						  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! Account Information Inserted.
						  </div>						  
						  <?php
						  }
						  
						   if($_REQUEST['delete'] == 'successfull')
						  {
						  ?>						  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! Image Deleted
						  </div>						  
						  <?php
						  }
						  ?>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li <?php if(isset($_REQUEST['update']) || isset($_REQUEST['payslip'])){echo 'class=""';}else{echo 'class="active"';}?>><a href="#tab_1_1" data-toggle="tab">Profile</a></li>
								
								<li <?php if(isset($_REQUEST['update'])){echo 'class="active"';}else{echo 'class=""';}?>><a href="#tab_1_2" data-toggle="tab">Payroll Details</a></li>
                                
								<li <?php if(isset($_REQUEST['payslip'])){echo 'class="active"';}else{echo 'class=""';}?>><a href="#tab_1_3" data-toggle="tab">Upload PaySlip</a></li>
								<li><a href="#tab_1_4" data-toggle="tab">Upload Group Certificates</a></li>
                                <li><a href="#tab_1_5" data-toggle="tab">My Preferences</a></li>
								<!--  <li><a href="#tab_1_6" data-toggle="tab">Member Privilege</a></li>-->
								<!--<li><a href="#tab_1_4" data-toggle="tab">Course Reviews</a></li>-->
							</ul>
							<div class="tab-content">
								<div class="tab-pane row-fluid <?php if(isset($_REQUEST['update']) || isset($_REQUEST['payslip'])){echo '';}else{echo 'active';}?>" id="tab_1_1">
									<ul class="unstyled profile-nav span3">
										<li><img src="<?=$proset?>" alt="" border="0" title="<?=stripslashes($rowdest7['emp_name'])?> Image" /></li>
                                        <!-- <li>
											<a href=""><?=$rowdest7['FirstName']?>
										</li>                                                                            
-->
									</ul>
									<div class="span9">
										<div class="row-fluid"  id="view_profile">
											<div class="span7 profile-info">
                                            <h3>Profile Information&nbsp;<button id="profile_btn" onClick="edit_profile();" class="btn mini blue">Edit <i class="icon-edit"></i></button>&nbsp;</h3>	
												<table  width="450px" cellpadding="3" rules="none" border="0">
													<tr>
                                                       <td colspan="3"><h1><?=stripslashes(ucfirst($rowdest7['FirstName']))?>&nbsp;<?=stripslashes(ucfirst($rowdest7['LastName']))?></h1></td>
													</tr>
													<tr>
														<td><p><i class="icon-key"></i>&nbsp;Registration Number</p></td>
														<td><p>:</p></td>
														<td><p><?=stripslashes($rowdest7['RegistrationNo'])?></p></td>
													</tr>
													
													<tr>
														<td width="150px"><p><i class="icon-envelope"></i>&nbsp;Email Address</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=stripslashes($rowdest7['EmailId'])?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-envelope"></i>&nbsp;Vicna Email Address</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=stripslashes($rowdest7['vicnaEmail'])?></p></td>
													</tr>
                                                    
													<?php
														// Password M***u
														/*$pwd=base64_decode($rowdest['user_password']);
														$strlen=strlen($pwd);
														$t1=substr($pwd,0,1);
														$t2=substr($pwd,$strlen-1,1);
														for($i=1;$i<$strlen-1;$i++)
														{
														$replace .='*';
														}
														$secretpwd=$t1.$replace.$t2;*/
													?>
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Password
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=base64_decode($rowdest7['Password'])?></p></td>
													</tr>	
													<tr>
														<td><p><i class="icon-male"></i>&nbsp;Sex</p></td>
														<td><p>:</p></td>
														<td><p><?php if($rowdest7['Gender']!='') { echo $rowdest7['Gender'] ; } else { echo "N/A"; } ?></p></td>
													</tr>												
													
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Date Of Birth
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=date('d/m/Y', strtotime($rowdest7['dob']));?></p></td>
													</tr>
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Qualification
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['qualification']?></p></td>
													</tr>
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Country
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['country']?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;State
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['state']?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;City
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['city']?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Address
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['Address']?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Mobile
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['mobile']?></p></td>
													</tr>
                                                    <!--<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Fax
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['Fax']?></p></td>
													</tr>-->
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;ZipCode
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['zip']?></p></td>
													</tr>
                                                    <!--<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;BusinessName
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['BusinessName']?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;TradingName
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['TradingName']?></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;BusinessAddress
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['BusinessAddress']?></p></td>
													</tr>
                                                    
                                                     <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Website
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=$rowdest7['Website']?></p></td>
													</tr>-->
                                                    
									
												</table>												
											</div>
											<!--end span8-->
											
											<!--end span4-->
										</div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row-fluid"  id="update_profile" style="display:none;">
											<div class="span7 profile-info">
                                            <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid']?>">
												<table  width="450px" cellpadding="3" rules="none" border="0">
													
													<tr>
														<td width="150px"><p><i class="icon-user"></i>&nbsp;First Name</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="FirstName" value="<?=stripslashes($rowdest7['FirstName'])?>"></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-user"></i>&nbsp;Last Name</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="LastName" value="<?=stripslashes($rowdest7['LastName'])?>"></p></td>
													</tr>
                                                  
													<tr>
														<td width="150px"><p><i class="icon-envelope"></i>&nbsp;Email Address</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" readonly  name="Email" value="<?=stripslashes($rowdest7['EmailId'])?>"></p></td>
													</tr>
                                                    
                                                    <tr>
														<td width="150px"><p><i class="icon-envelope"></i>&nbsp;Vicna Email Address</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text"  name="vicnaEmail" value="<?=stripslashes($rowdest7['vicnaEmail'])?>"></p></td>
													</tr>
													
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Password
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="password" name="Password" value="<?=base64_decode($rowdest7['Password'])?>"></p></td>
													</tr>	
													<tr>
														<td><p><i class="icon-male"></i>&nbsp;Gender</p></td>
														<td><p>:</p></td>
														<td><p><label><input type="radio" <?php if($rowdest7['Gender'] == "Male"){echo 'checked';} ?> name="Gender" value="Male">&nbsp;Male</label>&nbsp;<label><input type="radio" name="Gender" <?php if($rowdest7['Gender'] == "Female"){echo 'checked';} ?> value="Female">&nbsp;Female</label></p></td>
													</tr>												
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Date Of Birth
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="dob" id="dob" value="<?=date('d-m-Y', strtotime($rowdest7['dob']))?>"></p></td>
													</tr>
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Qualification
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="qualification" value="<?=$rowdest7['qualification']?>"></p></td>
													</tr>
													<tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Country
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="Country" value="<?=$rowdest7['country']?>"></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;State
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="State" value="<?=$rowdest7['state']?>"></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;City
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="City" value="<?=$rowdest7['city']?>"></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Address
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><textarea name="Address" rows="3"><?=$rowdest7['Address']?></textarea></p></td>
													</tr>
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Mobile
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="Phone" value="<?=$rowdest7['mobile']?>"></p></td>
													</tr>
                                                   
                                                    <tr>
														<td width="150px"><p><i class="icon-lock"></i>&nbsp;Zip Code
															</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><input type="text" name="ZipCode" value="<?=$rowdest7['zip']?>"></p></td>
													</tr>
                                                   
                                                     <tr>
														<td width="150px"><p>
															</p></td>
														<td><p></p></td>
														<td width="220px;"><p><input type="submit" class="btn large yellow" name="submit" value="Update"></p></td>
													</tr>
													
									
												</table>												
											</div>
											<!--end span8-->
											
											<!--end span4-->
										</div>
                                        </form>
                                        
										<!--end row-fluid-->
										
									</div>
									
									<div class="span12">
									
									<h3><?=stripslashes(ucfirst($rowdest7['FirstName']))?>&nbsp;<?=stripslashes(ucfirst($rowdest7['LastName']))?>'s Documents</h3>
										<button data-toggle="collapse" data-target="#add_doc" class="btn mini blue">Add Document <i class="icon-edit"></i></button>
										<div id="add_doc" class="collapse">
											<form action="ajax/adddocuments.php" id="upload_doc" method="post"  enctype="multipart/form-data" >													
												<input type="hidden" name="Uid" value="<?=$_REQUEST['Uid'];?>">
											   
												<table class="table table-striped table-hover">
													<tr>
														
														<th>Document Type</th>
														<th>Select Document</th>
														<th>&nbsp;</th>
														
													   
													</tr>
													
														  <tr>
															<td><select name="title" class="form-control">
																 <option value="AHPRA">AHPRA</option>
																 <option value="BLS">BLS</option>
																 <option value="Police Check">Police Check</option>
																 <option value="WWC">WWC</option>
																 <option value="Reference Letter">Reference Letter</option>
																 <option value="Drivers License">Drivers License</option>
																 <option value="Passport">Passport</option>
																 <option value="Visa">Visa</option>
																 <option value="Citizenship Certificate">Citizenship Certificate</option>
																 <option value="Medicare">Medicare</option>
																 <option value="Record of Immunization">Record of Immunization</option>
																 <option value="Medical Certificate">Medical Certificate</option>
																 <option value="Other">Other</option> 
																 </select></td>
															<td><input style="width:200px" type="file" id="document" name="document"></td>
															<td width="20%"><input type="button" value="Add" name="upload_document" id="upload_document"></td>
															
														  </tr>
														 
											   </table>
										   </form>
										</div>
										<div class="" id="document_table">
                               		
                                    <table class="table table-striped table-hover" >
                                    	<tr>
                                        	<th>Nos.</th>
                                            <th>Title</th>
                                            <th>Document</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                        <?PHP $n=0; 
				
											$GetQuery=mysql_query("SELECT * FROM documents WHERE userId='".$_REQUEST["Uid"]."' ORDER BY id DESC");
											$cnt = mysql_num_rows($GetQuery);
											if($cnt > 0){
												while($row = mysql_fetch_array($GetQuery))
												{ $n++;
												$path=$row['path'];
				  								$title=$row['title'];
													
											?>
											 <tr>
												<td><?=$n;?></td>
												<td><?=$title?></td>
												<td><a href='../download.php?link=<?=$path?>'>
												  <img src='../images/doc.png' title='<?=$title?>' style="height:35px;">
												  </a>
												</td>
												<td><button type="button" onClick="deletedocs(<?=$row['id'];?>, <?=$_REQUEST['Uid'];?>);"><i class="icon-trash"></i> Delete</button></td>
											</tr>
                                               
											 
											  <?php
												}
											}else{?>
											<tr><td colspan="4">Documents Not Added.</td></tr>
											<?php }?>
                                   </table>
                             
                            </div>
									</div>
									
							</div>
							
			<style type="text/css">
			.acfld {
				width:120px;
			}
			</style>				
								<!--end tab-pane-->
            <div class="tab-pane profile-classic <?php if(isset($_REQUEST['update'])){echo 'active';}else{echo '';}?> row-fluid" id="tab_1_2">
                <div class="row-fluid">
                
                    <div class="span profile-info">
                        <h3>Payroll Details&nbsp;<button data-toggle="collapse" data-target="#add_acc_info" class="btn mini blue">Add New Account <i class="icon-edit"></i></button>&nbsp;</h3>	
                        <div class="col-md-12" id="booking_info">
                            <div class="collapse" id="add_acc_info">
                                <form action="<?=$SERVER['PHP_SELF'];?>" method="post" >													
                                    <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                                   
                                    <table class="table table-striped table-hover">
                                    	<tr>
                                                    	<th>Account Holder’s Name</th>
                                                        <th>Bank Name</th>
                                                        <th>BSB</th>
                                                        <th>Account Number</th>
                                                        <th>% of Salary</th>
                                                        <th></th>
                                                       
                                                    </tr>
                                        <tr>
                                            <td><input class="acfld" type="text" name="acName" value=""></td> 
                                            <td><input class="acfld" type="text" name="bankName" value=""></td>
                                            <td><input class="acfld" type="text" name="BSB" value=""></td>
                                            <td><input class="acfld" type="text" name="acNo" value=""></td>
                                            <td><input class="acfld" type="text" name="percent_salary" value=""></td>
                                            <td><input type="submit" name="add_acc_submit" value="Submit"></td><td>&nbsp;</td>
                                        </tr>
                                   </table>
                               </form>
                            </div>
                              
                         <div class="table-responsive">
                              <table class="table table-striped table-hover">		
                                 
                                 <tbody>
                                    <tr>
                                       <td width="20%"><p>ATO Tax File Number :</p></td>
                                       <td><div style="display:block" id="tfn_view"><?=$rowdest7['tax_file_number'];?></div>
                                       		<div style="display:none" id="tfn_edit">
                                            <form action="" method="post">
												<input type="text" style="margin-top:10px;" name="tax_file_number" value="<?=$rowdest7['tax_file_number'];?>">
                                                <input type="submit" name="tfn_update" value="Update">
                                             </form>
                                           </div>
                                       </td>
                                       <td><p><button type="button" id="tfn_edt">Add/Edit</button></p></td>
                                    </tr>
                                    <tr>
                                       <td colspan="3"><p>Nominated Bank Account(s) for Salary Deposit:</p>
                                       	 <div id="tablesec">
                                       		<table class="table table-striped table-hover" style="border-bottom:1px solid #000; border-top:1px solid #000;">	
                                            	
                                                	<tr>
                                                    	<th>Account Holder’s Name</th>
                                                        <th>Bank Name</th>
                                                        <th>BSB</th>
                                                        <th>Account Number</th>
                                                        <th>% of Salary</th>
                                                        <th>User Can Change</th>
                                                        <th>Action</th>
                                                    </tr>
                                               
                                               
                                                 <?php
                                    					$qty = 1;
													$FetchUserSqlp = "SELECT * FROM account_details WHERE Uid  = '".$_REQUEST['Uid']."'";
														$FetchUserQueryp = mysql_query($FetchUserSqlp);
														while($FetchRowsp = mysql_fetch_array($FetchUserQueryp))
														{
														
												   ?>
                                                	<tr>
                                                    	<td><?=$FetchRowsp['acName'];?></td>
                                                        <td><?=$FetchRowsp['bankName'];?></td>
                                                        <td><?=$FetchRowsp['BSB'];?></td>
                                                        <td><?=$FetchRowsp['acNo'];?></td>
                                                        <td><?=$FetchRowsp['percent_salary'];?></td>
                                                        <td><select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['sl']?>" onChange="changePermission(this.value,'<?=$FetchRowsp['sl']?>')">
                                                                <option value="true" <?=$FetchRowsp['view'] == 'Yes' ? 'selected' : ''?>>Active</option>
                                                                <option value="false" <?=$FetchRowsp['view'] == 'No' ? 'selected' : ''?>>InActive</option>
														 </select>
                                                     </td>
                                                     <td>
                                                     	 <button type="button" data-toggle="collapse" data-target="#acc_info<?=$qty;?>" class="btn mini green"><i class="icon-edit"></i> Edit</button>		                                        
                                            			<a onclick="return delAccount(<?=$rowdest['sl']?>, <?=$_REQUEST['Uid']?>)" href="" class="btn mini red"><i class="icon-trash"></i> Delete</a>			
                                                     </td>
                                                    </tr>
                                                    <tr>
                                                    <td colspan="7">
                                                    <div class="collapse" id="acc_info<?=$qty;?>">
                                                    <form action="<?=$SERVER['PHP_SELF'];?>" method="post" id="form<?=$qty;?>">													
                                                    <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                                                    <input type="hidden" name="acc_id" value="<?=$FetchRowsp['sl'];?>">
                                                  	<table class="table table-striped table-hover">
                                                    <tr>
                                                    	<td><input class="acfld" type="text" name="acName" value="<?=$FetchRowsp['acName'];?>"></td> 
                                                        <td><input class="acfld" type="text" name="bankName" value="<?=$FetchRowsp['bankName'];?>"></td>
                                                        <td><input class="acfld" type="text" name="BSB" value="<?=$FetchRowsp['BSB'];?>"></td>
                                                        <td><input class="acfld" type="text" name="acNo" value="<?=$FetchRowsp['acNo'];?>"></td>
                                                        <td><input class="acfld" type="text" name="percent_salary" value="<?=$FetchRowsp['percent_salary'];?>"></td>
                                                        <td><input  type="submit" name="acc_submit" value="Update"></td><td>&nbsp;</td>
                                                    </tr>
                                                   </table>
                                                   </form>
                                                    </div>
                                                    </td></tr>
                                                 <?php  $qty++;}?> 
                                                 
                                                
                                            </table>
                                       	 </div>
                                       </td>
                                      	
                                    </tr>
                                 </tbody>
                               </table> 
                          </div>
                          <div class="table-responsive">  
                               <table class="table table-striped table-hover">		
                                 
                                 <tbody> 
                                    <tr>
                                    	<td colspan="3">Nominated Superannuation Fund: <button style="background-color:#C60;" type="button" id="nsf" class="btn btn-warning">Add/Edit</button><button style="background-color:#C60; display:none;" type="button" id="nsf_back" class="btn btn-warning">Back</button></td>
                                    </tr>
                                    <tr><td>
                                 <?php
								 $GetQuery=mysql_query("select * from nsf where Uid='".$_REQUEST["Uid"]."'");
								 $row = mysql_fetch_array($GetQuery);
								 ?>
               <!----------------------------View NSF Details Start---------------------------------------->              
                                
                                 <table class="table table-striped table-hover" id="view_nsf" style="display:block;">
                                    <tr>
                                       <td width="20%"><p>Superannuation Product Identification Number (SPIN)</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><?=$row['SPIN']?></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Member Number</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><?=$row['memberNumber']?></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund ABN</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><?=$row['fundABN']?></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund Name</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><?=$row['fundName']?></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund Address</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><?=$row['fundAddress']?></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund Phone Number</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><?=$row['fundPhoneNumber']?></p></td>
                                    </tr>
                                   <tr>
                                       <td width="20%"><p>User Can Change</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><select class="span3 chosen" tabindex="1" id="" onChange=" changePermission1(this.value,'<?=$row['sl']?>');">
                                                <option value="true" <?=$row['view'] == 'Yes' ? 'selected' : ''?>>Active</option>
                                                <option value="false" <?=$row['view'] == 'No' ? 'selected' : ''?>>InActive</option>
                                         </select></p></td>
                                    </tr>
                                    </table>
                                 
               <!----------------------------View NSF Details End---------------------------------------->              
              <!----------------------------Add/Edit NSF Details Start---------------------------------------->                    
                                 
                                  <table class="table table-striped table-hover" id="edit_nsf"  style="display:none;">
                                  <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="nsf_id" value="<?=$row['sl']?>">
                                  <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid']?>">
                                    <tr>
                                       <td width="20%"><p>Superannuation Product Identification Number (SPIN)</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><input type="text" name="spin" value="<?=$row['SPIN']?>"></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Member Number</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><input type="text" name="memberNumber" value="<?=$row['memberNumber']?>"></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund ABN</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><input type="text" name="fundABN" value="<?=$row['fundABN']?>"></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund Name</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><input type="text" name="fundName" value="<?=$row['fundName']?>"></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund Address</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><input type="text" name="fundAddress" value="<?=$row['fundAddress']?>"></p></td>
                                    </tr>
                                    <tr>
                                       <td width="20%"><p>Fund Phone Number</p></td>
                                       <td width="5%"><p>:</p></td>
                                       <td><p><input type="text" name="fundPhoneNumber" value="<?=$row['fundPhoneNumber']?>"></p></td>
                                    </tr>
                                   <tr>
                                   <td width="20%"><p></p></td>
                                       <td width="5%"><p></p></td>
                                   	<td><input type="submit" class="btn btn-success" style="background-color:#093;" name="submit_nsf" value="Submit"></td>
                                   </tr>
                                   </form>
                                   </table>
                              
               <!----------------------------Add/Edit NSF Details End---------------------------------------->              
                                 </td></tr>
                                 </tbody>
                                 
                               </table>
                               </div>
                                                                                                        
                        </div>
                           
                        												
                    </div>
                
                </div>
            </div>
								<!--tab_1_2-->
			
            					<!--end tab-pane-->
								<!--tab_1_3-->	
            <div class="tab-pane profile-classic <?php if(isset($_REQUEST['payslip'])){echo 'active';}else{echo '';}?> row-fluid" id="tab_1_3">
                <div class="row-fluid">
                <style type="text/css">
				.pp { width:60px; padding-left:10px;}
				.dp { width:100px; padding-left:10px;}
				</style>
                
                    <div class="span profile-info">
                        <h3>PaySlip Details&nbsp;<button data-toggle="collapse" data-target="#add_payslip" class="btn mini blue">Add New <i class="icon-edit"></i></button>&nbsp;</h3>	
						
                        <div class="col-md-12" id="payslip_details">
                        	<div id="add_payslip" class="collapse">
                            	<form action="ajax/addPaysilp.php" id="upload_payslip" method="post"  enctype="multipart/form-data" >													
                                    <input type="hidden" id="uid" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                                   
                                    <table class="table table-striped table-hover"  id="sample_2">
                                    	<tr>
                                        	
                                            <th>Pay Period Ending</th>
                                            <th>Date Paid</th>
                                            <th>Gross</th>
                                            <th>Tax</th>
                                            <th>Nett</th>
                                            <th>Payslips</th>
                                            <th>&nbsp;</th>
                                           
                                        </tr>
                                        
											  <tr>
												<td><input class="dp"  type="text" id="payPeriodEnding" name="payPeriodEnding"></td>
												<td><input class="dp" type="text" id="datePaid" name="datePaid"></td>
												<td><input class="pp" type="text" id="gross" name="gross"></td>
												<td><input class="pp" type="text" id="tax" name="tax"></td>
												<td><input style="width:200px" type="file" id="payslip" name="payslip"></td>
                                                <td width="20%"><input type="button" value="Add" name="add_payslip" id="add"></td>
												
											  </tr>
											 
                                   </table>
                               </form>
                            </div>
                            <div class="" id="payslip_table">
                               		
                                    <table class="table table-striped table-hover"  id="sample_21">
                                    	<tr>
                                        	<th>Nos.</th>
                                            <th>Pay Period Ending</th>
                                            <th>Date Paid</th>
                                            <th>Gross</th>
                                            <th>Tax</th>
                                            <th>Nett</th>
                                            <th>View/Save Payslips</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                        <?PHP $n=0; 
				
											$GetQuery=mysql_query("SELECT * FROM pay_slip WHERE Uid='".$_REQUEST["Uid"]."' ORDER BY id DESC");
											$cnt = mysql_num_rows($GetQuery);
											if($cnt > 0){
												while($row = mysql_fetch_array($GetQuery))
												{ $n++;
													$g=$row['gross'];$t=$row['tax'];
											?>
											  <tr>
												<td><?=$n?></td>
												<td><?=$row['payPeriodEnding'];?></td>
												<td><?=$row['datePaid'];?></td>
												<td>$
												  <?=$row['gross'];?></td>
												<td>$
												  <?=$row['tax'];?></td>
												<td>$<?php echo ($g - $t) ?></td>
												<td><a href="../download.php?path=payslip&file=<?=$row['payslip']?>" ><img style="height:40px;" src="../images/pdf.png"></a></td>
                                                <td><button type="button" data-toggle="collapse" data-target="#edit_slip<?=$n;?>"><i class="icon-edit"></i> Edit</button> &nbsp;<button type="button" onClick="deletepayslip(<?=$row['id'];?>, <?=$_REQUEST['Uid'];?>);"><i class="icon-trash"></i> Delete</button></td>
												</tr>
                                                <tr>
                                                <td colspan="8">
                                              <div  class="collapse" id="edit_slip<?=$n;?>">
                                              	<form action="ajax/editPaysilp.php" id="edit_upload_payslip<?=$n;?>"  method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid']?>">
                                                <table class="table table-striped table-hover">
                                               <tr>
                                              	<td></td>
												<td><input class="dp dt_pic" type="text" name="payPeriodEnding" value="<?=$row['payPeriodEnding'];?>"></td>
												<td><input class="dp dt_pic" type="text" name="datePaid" value="<?=$row['datePaid'];?>"></td>
												<td>
												  <input class="dp" type="text" name="gross" value="<?=$row['gross'];?>"></td>
												<td>
												  <input class="dp" type="text" name="tax" value="<?=$row['tax'];?>"></td>
												<td></td>
												<td><input style="width:200px" type="file" name="payslip">
													<input type="hidden" name="old_payslip" value="<?=$row['payslip'];?>">
												</td>
                                                <td><input type="button" value="OK"  id="edit_payslip<?=$n?>" name="edit_payslip"></td>
                                                
                                              </tr>
                                              </table>
                                              </form>
                                              </div>
                                              </td></tr>
											  <script type="text/javascript">
											  	$('#edit_payslip<?=$n?>').click(function(){
													$('#edit_upload_payslip<?=$n?>').ajaxForm({
														target:'#payslip_table',
														beforeSubmit:function(e){
															//$('.uploading').show();
														},
														success:function(e){
															//$('.uploading').hide();
															//break 1;
														},
														error:function(e){
														}
													}).submit();
												});
											  </script>
											  <?php
												}
											}?>
                                   </table>
                             
                            </div>
                              
                         
                          
                                                                                                        
                        </div>
                           
                        												
                    </div>
                
                </div>
            </div>
								<!--tab_1_3-->	
								<!--tab_1_4-->					
								
			<div class="tab-pane profile-classic <?php if(isset($_REQUEST['group_certificate'])){echo 'active';}else{echo '';}?> row-fluid" id="tab_1_4">
                <div class="row-fluid">
                <style type="text/css">
				.pp { width:60px; padding-left:10px;}
				.dp { width:150px; padding-left:10px;}
				</style>
                
                    <div class="span profile-info">
                        <h3>Group Certificate&nbsp;<button data-toggle="collapse" data-target="#add_group_payslip" class="btn mini blue">Add New <i class="icon-edit"></i></button>&nbsp;</h3>	
						
                        <div class="col-md-12" id="group_payslip">
                        	<div id="add_group_payslip" class="collapse">
                            	<form action="ajax/addGroupPaysilp.php" id="upload_group_certificate" method="post"  enctype="multipart/form-data" >													
                                    <input type="hidden" id="usrid" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                                   
                                    <table class="table table-striped table-hover"  id="sample_3">
                                    	<tr>
                                        	
                                            <th width="20%">Select Session Yesr</th>
                                            <th width="30%">Group Certificate</th>
                                            <th>&nbsp;</th>
											<th width="40%"></th>
                                           
                                        </tr>
                                        
											  <tr>
												<td><select class="dp" name="session_year">
													<?php 
													$curnt_year = date('Y');
													$prev_year = $curnt_year - 1;
													
													$n = 1;
													while($n <= 20)
													{
														$session = $prev_year.'-'.$curnt_year;
													?>
														<option value="<?=$session;?>"><?=$session;?></option>
													<?php 
														$curnt_year = $curnt_year - 1;
														$prev_year = $prev_year - 1;
														$n++;
													}?>
												
												</select></td>
												<td><input style="width:200px" type="file" id="group_payslip" name="group_payslip"></td>
                                                <td width="20%"><input type="button" value="Add" name="add_group_certificate" id="add_group_certificate"></td>
												<td>&nbsp;</td>
											  </tr>
											 
                                   </table>
                               </form>
                            </div>
                            <div class="" id="group_payslip_table">
                               		
                                    <table class="table table-striped table-hover"  id="sample_211">
                                    	<tr>
                                        	<th>Nos.</th>
                                            <th width="20%">Session Yesr</th>
                                            <th width="30%">View/Save Group Certificate</th>
                                           <th>Action</th>
                                           
                                        </tr>
                                        <?PHP $n=0; 
				
											$GetQuery=mysql_query("SELECT * FROM group_payslip WHERE Uid='".$_REQUEST["Uid"]."' ORDER BY id DESC");
											$cnt = mysql_num_rows($GetQuery);
											if($cnt > 0){
												while($row = mysql_fetch_array($GetQuery))
												{ $n++;
													$g=$row['gross'];$t=$row['tax'];
											?>
											  <tr>
												<td><?=$n?></td>
												<td><?=$row['session_year'];?></td>
												<td><a href="../download.php?path=payslip&file=<?=$row['group_payslip']?>" ><img style="height:40px;" src="../images/pdf.png"></a></td>
                                                <td><button type="button" data-toggle="collapse" data-target="#edit_group_slip<?=$n;?>"><i class="icon-edit"></i> Edit</button> &nbsp;<button type="button" onClick="deleteGroupCrtft(<?=$row['id'];?>, <?=$_REQUEST['Uid'];?>);"><i class="icon-trash"></i> Delete</button></td>
												</tr>
                                                <tr>
                                                <td colspan="8">
                                              <div  class="collapse" id="edit_group_slip<?=$n;?>">
                                              	<form action="ajax/editGroupPaysilp.php" id="edit_group_payslip<?=$n;?>"  method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid']?>">
                                                <table class="table table-striped table-hover">
                                               <tr>
                                              	<td></td>
												<td><select class="dp" name="session_year">
													<?php 
													$curnt_year = date('Y');
													$prev_year = $curnt_year - 1;
													
													$x = 1;
													while($x <= 20)
													{
														$session = $prev_year.'-'.$curnt_year;
													?>
														<option value="<?=$session;?>"><?=$session;?></option>
													<?php 
														$curnt_year = $curnt_year - 1;
														$prev_year = $prev_year - 1;
														$x++;
													}?>
												
												</select></td>
												<td><input style="width:200px" type="file" name="payslip">
													<input type="hidden" name="old_payslip" value="<?=$row['group_payslip'];?>">
												</td>
                                                <td><input type="button" value="OK"  id="group_payslip<?=$n?>" name=""></td>
                                                
                                              </tr>
                                              </table>
                                              </form>
                                              </div>
                                              </td></tr>
											  <script type="text/javascript">
											  	$('#group_payslip<?=$n?>').click(function(){
													$('#edit_group_payslip<?=$n?>').ajaxForm({
														target:'#group_payslip_table',
														beforeSubmit:function(e){
															//$('.uploading').show();
														},
														success:function(e){
															//$('.uploading').hide();
															//break 1;
														},
														error:function(e){
														}
													}).submit();
												});
											  </script>
											  <?php
												}
											}else{?>
											<tr><td colspan="4" style=" text-align:center;"><span style="color:#CC0000; font-size:18px;">No Group Certificate</span></td></tr>
											<?php }?>
                                   </table>
                             
                            </div>
                              
                         
                          
                                                                                                        
                        </div>
                           
                        												
                    </div>
                
                </div>
            </div>
			<!--tab_1_4-->	
			<div class="tab-pane profile-classic row-fluid" id="tab_1_5">
                <div class="row-fluid">
                <style type="text/css">
				 .my_pre { width:80px;}
				</style>
                
                    <div class="span profile-info">
                        <h3>My Preferences&nbsp;</h3>	
				
				<div id="my_pref">
				<?php 
				$SqlUser = "SELECT offerMeNum,offerMeUnit,after10pm,before6am,travel,text_me FROM hr_staff_registration  WHERE Uid = '".$_REQUEST["Uid"]."'";
				$result = mysql_query($SqlUser) or die(mysql_error());;
				
				while($row = mysql_fetch_array($result))
				{$offerMeNum=$row['offerMeNum'];$offerMeUnit=$row['offerMeUnit'];$after10pm=$row['after10pm'];$before6am=$row['before6am'];
				$travel=$row['travel'];$text_me=$row['text_me'];
				}
				?>		
                <form id="edit_preference" action="ajax/mypreference.php" method="post">
				<input type="hidden" name="Uid" value="<?=$_REQUEST["Uid"]?>" />
                Offer me shifts up to
                <select class="my_pre" name="offerMeNum" style="background-color:#D2FDFF;">
                  <option value="<?= $offerMeNum; ?>">
                  <?= $offerMeNum; ?>
                  </option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="70">70</option>
                  <option value="90">90</option>
                </select>
                <select class="my_pre" name="offerMeUnit" style="background-color:#D2FDFF;">
                  <option value="<?= $offerMeUnit ?>">
                  <?= $offerMeUnit ?>
                  </option>
                  <option value="km">KM</option>
                  <option value="minute">Minute</option>
                </select>
                from my residence.</b>
                
                <br>
                <br>
                Allocators can call me after 10pm?</b>
                <select class="my_pre" name="after10pm" style="background-color:#D2FDFF">
                  <option value="<?= $after10pm ?>">
                  <?= $after10pm ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
               
                <br>
                <br>
                Allocators can call me before 6am?</b>
                <select name="before6am" class="my_pre" style="background-color:#D2FDFF;">
                  <option value="<?= $before6am ?>">
                  <?= $before6am ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
                
                <br>
                <br>
                Allocators should text me notifications for shift broadcast?</b>
                <select class="my_pre" name="text_me" style="background-color:#D2FDFF;">
                  <option value="<?= $text_me ?>">
                  <?= $text_me ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
               
                <br>
                <br>
                I am willing to travel to regional places if reimbursed for travel & accommodation?</b>
                <select name="travel" class="my_pre"  style="background-color:#D2FDFF;">
                  <option value="<?= $travel ?>">
                  <?= $travel ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
				<br/>
                <input class="btn btn-info" name="submit_dtl" id="edit_preferences" type="submit" value="save">
              </form>
                          
                </div>        												
              </div>
                
                </div>
            </div>
								
								</div>
								<!--end tab-pane-->
							</div>
						</div>
						<!--END TABS-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<?php include"lib/footer.php";?>
	</div>
    
<!--<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>-->
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#add').click(function(){
		$('#upload_payslip').ajaxForm({
			target:'#payslip_table',
			beforeSubmit:function(e){
				//$('.uploading').show();
			},
			success:function(e){
				//$('.uploading').hide();
			},
			error:function(e){
			}
		}).submit();
	});
	
	$('#upload_document').click(function(){
		$('#upload_doc').ajaxForm({
			target:'#document_table',
			beforeSubmit:function(e){
				//$('.uploading').show();
			},
			success:function(e){
				//$('.uploading').hide();
			},
			error:function(e){
			}
		}).submit();
	});
	
	
	$('#edit_preferences').click(function(){
		
		$('#edit_preference').ajaxForm({
			target:'#my_pref',
			beforeSubmit:function(e){
				//$('.uploading').show();
			},
			success:function(e){
				//$('.uploading').hide();
			},
			error:function(e){
			}
		}).submit();
	});
	
	
	
});
</script>
<script>
$('#add_group_certificate').click(function(){
		$('#upload_group_certificate').ajaxForm({
			target:'#group_payslip_table',
			beforeSubmit:function(e){
				//$('.uploading').show();
			},
			success:function(e){
				//$('.uploading').hide();
			},
			error:function(e){
			}
		}).submit();
	});
/*function add_payslip() {
	
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		  document.getElementById("payslip_table").innerHTML = xhttp.responseText;
		}
	  };
	  xhttp.open("POST", "ajax/addPaysilp.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send("payPeriodEnding="+document.getElementById("payPeriodEnding").value+"&datePaid="+document.getElementById("datePaid").value+"&gross="+document.getElementById("gross").value+"&tax="+document.getElementById("tax").value+"&payslip="+document.getElementById("payslip").value+"&Uid="+document.getElementById("uid").value+"");
	  
	  
}*/
</script>
<script type="text/javascript">

function delAccount(sl,uid)
{
	//window.location.href="payrollStuff.php?slDeleteAc="+sl;
	if(confirm("Are you sure you want to delete this Account Details?"))
	{
		
		location.href="staffinfo.php?action=del&id="+sl+"&Uid="+uid;
		
	}
	else
	{
		return false;
	}
	
}

function edit_profile()
{
	$('#view_profile').css('display', 'none');
	$('#update_profile').css('display', 'block');
	$('#profile_btn').css('display', 'none');
}
function edit_payroll()
{
	$('#edit_booking_info').css('display', 'block');
	$('#booking_info').css('display', 'none');
	$('#update_btn').css('display', 'block');
	$('#edit_btn').css('display', 'none');
}

$('#nsf').click(function(){
	$('#nsf').css('display', 'none');
	$('#view_nsf').css('display', 'none');
	
	$('#nsf_back').css('display', 'block');
	$('#edit_nsf').css('display', 'block');
		
});
$('#nsf_back').click(function(){
	$('#nsf').css('display', 'block');
	$('#view_nsf').css('display', 'block');
	$('#nsf_back').css('display', 'none');
	$('#edit_nsf').css('display', 'none');
		
});

$('#tfn_edt').click(function(){
	$('#tfn_view').css('display', 'none');
	$('#tfn_edit').css('display', 'block');	
});

function changePermission(stat,id)
	{
		$.post('ajax/changePermission.php',{ stat : stat , id : id });
	}

function changePermission1(stat,id)
	{
		
		$.post('ajax/changePermission1.php',{ stat : stat , id : id });
	}
	
/********Delete Payslip**********************/

	function deletepayslip(id, uid)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delpayslip.php',{ feedid : id, mode : 'single', uid : uid},
				function(data)
				{//deletecinematic
					$('#payslip_table').html(data);
					/************************************ Table JS ************************************/
					/*$('#sample_21').dataTable({
						"aLengthMenu": [
							[5, 15, 20, -1],
							[5, 15, 20, "All"]
						],
						// set the initial value
						"iDisplayLength": 15,
						"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
						"sPaginationType": "bootstrap",
						"oLanguage": {
							"sLengthMenu": "_MENU_ records per page",
							"oPaginate": {
								"sPrevious": "Prev",
								"sNext": "Next"
							}
						},
						"aoColumnDefs": [{
							'bSortable': false,
							'aTargets': [0]
						}]
					});*/
					
					/*jQuery('#sample_21 .group-checkable').change(function () {
						var set = jQuery(this).attr("data-set");
						var checked = jQuery(this).is(":checked");
						jQuery(set).each(function () {
							if (checked) {
								$(this).attr("checked", true);
							} else {
								$(this).attr("checked", false);
							}
						});
						jQuery.uniform.update(set);
					});*/
					
					/*var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
					if (test) {
						test.uniform();
					}
					
					$(".chosen").chosen();*/
					
					/************************************ Table JS ************************************/
				}
			);
		}
	}


/*******************DeletePayslip*****************/	
/************************************Delete Group Certificate Delete*************************************/
function deleteGroupCrtft(id, uid)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delGrpCrtft.php',{ feedid : id, mode : 'single', uid : uid},
				function(data)
				{//deletecinematic
					$('#group_payslip_table').html(data);
					
				}
			);
		}
	}
	
	
/************************************Delete Group Certificate*************************************/
/*****************************Document Deleted************************************************/
function deletedocs(id, uid)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/deldocs.php',{ feedid : id, mode : 'single', uid : uid},
				function(data)
				{//deletecinematic
					$('#document_table').html(data);
					
				}
			);
		}
	}

/**************************************************************************/
/********************Delete****************/
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delBankAccount.php',{ feedid : id, mode : 'single' },
				function(data)
				{//deletecinematic
					$('#tablesec').html(data);
					/************************************ Table JS ************************************/
					$('#sample_2').dataTable({
						"aLengthMenu": [
							[5, 15, 20, -1],
							[5, 15, 20, "All"]
						],
						// set the initial value
						"iDisplayLength": 15,
						"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
						"sPaginationType": "bootstrap",
						"oLanguage": {
							"sLengthMenu": "_MENU_ records per page",
							"oPaginate": {
								"sPrevious": "Prev",
								"sNext": "Next"
							}
						},
						"aoColumnDefs": [{
							'bSortable': false,
							'aTargets': [0]
						}]
					});
					
					jQuery('#sample_2 .group-checkable').change(function () {
						var set = jQuery(this).attr("data-set");
						var checked = jQuery(this).is(":checked");
						jQuery(set).each(function () {
							if (checked) {
								$(this).attr("checked", true);
							} else {
								$(this).attr("checked", false);
							}
						});
						jQuery.uniform.update(set);
					});
					
					var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
					if (test) {
						test.uniform();
					}
					
					$(".chosen").chosen();
					
					/************************************ Table JS ************************************/
				}
			);
		}
	}
</script>
<script src="../js/jquery.Jcrop.js"></script>
   <style type="text/css">
   .img_overlay {
  	
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.6);
     border-radius: 6px;
    display: none;
    height: 142px;
    left: 2px;
    position: absolute;
    right: 0;
    text-align: center;
    top: -60px;
    width: 96%;
}
.img_overlay > a {
padding:9px;
color:#fff;
line-height:26px;
}
.thumbs {
position:relative;}
.thumbs:hover .img_overlay {
display:block;}
div#main a:hover:not(.button), a:hover:not(.button), a:focus:not(.button), div#main a:focus:not(.button) {
    color: #0095ff;
}
@media only screen and (max-width:1024px) { 

.tex {
	padding:0 15px !important;
}
.imgtxt2 {
	display:block !important;}
}
</style>
	<!--<script type="text/javascript" src="script.js"></script>-->
<script type="text/javascript">
function showimagepreview(input) {
if (input.files && input.files[0]) {
var filerdr = new FileReader();
filerdr.onload = function(e) {
$('#imgprvw').attr('src', e.target.result);

    $(function(){

    $('#imgprvw').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

}
filerdr.readAsDataURL(input.files[0]);
}
}
  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };
</script>
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
<script> 
$(document).ready(function(){
    $("#intimg3").click(function(){
        $("#intimg2").slideToggle();
    });
});
</script>
   	<script src="assets/scripts/table-managed.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>  
<!--	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>  
	<script src="assets/scripts/ui-modals.js"></script> -->
	<!--<script src="assets/scripts/form-components.js"></script> -->
<!--	<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/plugins/clockface/js/clockface.js"></script>	
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
			<script src="assets/scripts/gallery.js"></script> 
		<script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>  -->
		<script type="text/javascript">
		/*jQuery(document).ready(function() {       
		   App.init();
		   Gallery.init();
		   $('.fancybox-video').fancybox({type: 'iframe'});
		   UIModals.init();
		   FormComponents.init();
		});*/
	// Hide Spouse and no.of childreen
	function marriedCheck() {
   			 if (document.getElementById('marital_status').checked) {
        		document.getElementById('marrid').style.display = 'block';
        		document.getElementById('marrid2').style.display = 'block';
    		}
    		else 
    		{ 
    			document.getElementById('marrid').style.display = 'none';  
    			document.getElementById('marrid2').style.display = 'none';
    		}
		}
	</script> 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>