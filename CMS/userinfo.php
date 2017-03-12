<?php include"lib/header.php";?>
<?php
if(isset($_REQUEST['Update'])) {	                         
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
			echo '<script>window.location.href="userinfo.php?Uid='.$uid.'&update=succ";</script>';
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
			echo '<script>window.location.href="userinfo.php?Uid='.$uid.'&update=succ";</script>';
			exit();
		}	
	}
			
}

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

				$InsertRegSql="UPDATE hr_user_registration SET                 
														FirstName = '".$fname."' ,
														LastName = '".$lname."' ,
														Gender = '".$Gender."' , 
														Password = '".base64_encode($Password)."' , 
														Country = '".$Country."' ,
														State = '".$State."' ,  
														Country = '".$Country."' ,
														State = '".$State."' , 
														City = '".$City."' ,
														Phone = '".$Phone."' ,  
														Fax = '".$Fax."' ,
														ZipCode = '".$ZipCode."' ,
														BusinessName = '".$BusinessName."' ,
														TradingName = '".$TradingName."' ,
														BusinessAddress = '".$BusinessAddress."' ,
														Website = '".$Website."' 
														where Uid = '".$uid."' 
														";
																				
				mysql_query($InsertRegSql) or mysql_error();
				
						echo '<script>alert("Information Update Successfully.");</script>';
						echo '<script>window.location="userinfo.php?Uid='.$uid.'&mess=successful"</script>';
						exit();
						
						
			}
	

if(isset($_REQUEST['addInvoice']))
{
	$invoiceNo = $_REQUEST['invoiceNo'];
	$invoiceDate = date('Y-m-d', strtotime($_REQUEST['invoiceDate']));
	$amount = $_REQUEST['amount'];
	$dueDate = date('Y-m-d', strtotime($_REQUEST['dueDate']));
	$status = $_REQUEST['status'];
	$Uid = $_REQUEST['Uid'];
	if($_FILES['pdf']['name'] != "")
	{
        $pdf = rand(1000,100000)."-".$_FILES['pdf']['name'];
		//echo $pic;exit();
        $pic_loc = $_FILES['pdf']['tmp_name'];
		//echo $pic_loc; exit();
        $folder="../upload_invoice/";
        if(move_uploaded_file($pic_loc,$folder.$pdf))
        {
            $insert = mysql_query("INSERT INTO ".TABLE_PREFIX."user_invoice SET Uid = '".$Uid."',
																		invoiceNo = '".$invoiceNo."',
																	   invoiceDate = '".$invoiceDate."',
																	   amount = '".$amount."',
																	   dueDate = '".$dueDate."',
																	   status = '".$status."',
																	   pdf = '".$pdf."'");
			if($insert)
			{
				echo '<script>alert("Invoice Added Successfully");</script>';
				echo '<script>window.location.href="userinfo.php?Uid='.$Uid.'&invoice=invoice";</script>';
				exit();
			}
        }
        else
        {
            
        } 
	}	
	
	/*$path= "upload/".$HTTP_POST_FILES['ufile']['name'];
	if($ufile !=none)
	{
	if(copy($HTTP_POST_FILES['ufile']['tmp_name'], $path))
	{
	echo "Successful<BR/>"; 
	
	//$HTTP_POST_FILES['ufile']['name'] = file name
	//$HTTP_POST_FILES['ufile']['size'] = file size
	//$HTTP_POST_FILES['ufile']['type'] = type of file
	
	echo "File Name :".$HTTP_POST_FILES['ufile']['name']."<BR/>"; 
	echo "File Size :".$HTTP_POST_FILES['ufile']['size']."<BR/>"; 
	echo "File Type :".$HTTP_POST_FILES['ufile']['type']."<BR/>"; 
	echo "<img src=\"$path\" width=\"150\" height=\"150\">";
	}
	else
	{
	echo "Error";
	}
	}*/
}
	



		$getdestsql = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE Uid  = '".$_REQUEST['Uid']."'";
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
<!--<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>



<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>-->
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
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
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
$(".dt_pic").datepicker({
      dateFormat: 'dd-mm-yy'
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
  <?php include"lib/leftbar.php";?>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
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
            <?=$pagetitle?>
            <small>Description</small> </h3>
          <ul class="breadcrumb">
            <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <i class="icon-angle-right"></i> </li>
            <li> <a href="userlist.php">User List</a> <i class="icon-angle-right"></i> </li>
            <li> <a href="">User Info</a> </li>
            <li class="pull-right no-text-shadow"></li>
          </ul>
          <!-- END PAGE TITLE & BREADCRUMB-->
          <?php
						  if($_REQUEST['action'] == 'added')
						  {
						  ?>
          <div class="alert alert-success">
            <button data-dismiss="alert" class="close"></button>
            Success! User added </div>
          <?php
						  }
						  if($_REQUEST['action'] == 'updated')
						  {
						  ?>
          <div class="alert alert-success">
            <button data-dismiss="alert" class="close"></button>
            Success! User updated </div>
          <?php
						  }
						   if($_REQUEST['delete'] == 'successfull')
						  {
						  ?>
          <div class="alert alert-success">
            <button data-dismiss="alert" class="close"></button>
            Success! Image Deleted </div>
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
              <li <?php if(isset($_REQUEST['update']) || isset($_REQUEST['invoice'])){echo 'class=""';}else{echo 'class="active"';}?>><a href="#tab_1_1" data-toggle="tab">Profile</a></li>
              <li <?php if(isset($_REQUEST['update'])){echo 'class="active"';}else{echo 'class=""';}?>><a href="#tab_1_2" data-toggle="tab">Billing Information</a></li>
              <li <?php if(isset($_REQUEST['invoice'])){echo 'class="active"';}else{echo 'class=""';}?>><a href="#tab_1_3" data-toggle="tab">All Invoice</a></li>
              <!-- <li><a href="#tab_1_7" data-toggle="tab">My Settings</a></li>
								 <li><a href="#tab_1_6" data-toggle="tab">Member Privilege</a></li>--> 
              <!--<li><a href="#tab_1_4" data-toggle="tab">Course Reviews</a></li>-->
            </ul>
            <div class="tab-content">
              <div class="tab-pane row-fluid <?php if(isset($_REQUEST['update']) || isset($_REQUEST['invoice'])){echo '';}else{echo 'active';}?>" id="tab_1_1">
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
                      <h3>Booking Information&nbsp;
                        <button id="profile_btn" onClick="edit_profile();" class="btn mini blue">Edit <i class="icon-edit"></i></button>
                        &nbsp;</h3>
                      <table  width="450px" cellpadding="3" rules="none" border="0">
                        <tr>
                          <td colspan="3"><h1>
                              <?=stripslashes(ucfirst($rowdest7['FirstName']))?>
                              &nbsp;
                              <?=stripslashes(ucfirst($rowdest7['LastName']))?>
                            </h1></td>
                        </tr>
                        <tr>
                          <td><p><i class="icon-key"></i>&nbsp;Registration Number</p></td>
                          <td><p>:</p></td>
                          <td><p>
                              <?=stripslashes($rowdest7['RegistrationNo'])?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-envelope"></i>&nbsp;Email Address</p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=stripslashes($rowdest7['EmailId'])?>
                            </p></td>
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
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;Password </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=base64_decode($rowdest7['Password'])?>
                            </p></td>
                        </tr>
                        <!--<tr>
                          <td><p><i class="icon-male"></i>&nbsp;Sex</p></td>
                          <td><p>:</p></td>
                          <td><p>
                              <?php if($rowdest7['Gender']!='') { echo $rowdest7['Gender'] ; } else { echo "N/A"; } ?>
                            </p></td>
                        </tr>-->
<!--                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;Country </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['Country']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;State </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['State']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;City </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['City']?>
                            </p></td>
                        </tr>
-->                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;Address </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['Address']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;Phone </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['Phone']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;Fax </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['Fax']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;ZipCode </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['ZipCode']?>
                            </p></td>
                        </tr>
                        <!--<tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;BusinessName </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['BusinessName']?>
                            </p></td>
                        </tr>-->
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;TradingName </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['TradingName']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;BusinessAddress </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['BusinessAddress']?>
                            </p></td>
                        </tr>
                        <tr>
                          <td width="150px"><p><i class="icon-lock"></i>&nbsp;Website </p></td>
                          <td><p>:</p></td>
                          <td width="220px;"><p>
                              <?=$rowdest7['Website']?>
                            </p></td>
                        </tr>
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
                            <td width="220px;"><p>
                                <input type="text" name="FirstName" value="<?=stripslashes($rowdest7['FirstName'])?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-user"></i>&nbsp;Last Name</p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="LastName" value="<?=stripslashes($rowdest7['LastName'])?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-envelope"></i>&nbsp;Email Address</p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" readonly  name="Email" value="<?=stripslashes($rowdest7['EmailId'])?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;Password </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="password" name="Password" value="<?=base64_decode($rowdest7['Password'])?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td><p><i class="icon-male"></i>&nbsp;Gender</p></td>
                            <td><p>:</p></td>
                            <td><p>
                                <label>
                                  <input type="radio" <?php if($rowdest7['Gender'] == "Male"){echo 'checked';} ?> name="Gender" value="Male">
                                  &nbsp;Male</label>
                                &nbsp;
                                <label>
                                  <input type="radio" name="Gender" <?php if($rowdest7['Gender'] == "Female"){echo 'checked';} ?> value="Female">
                                  &nbsp;Female</label>
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;Country </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="Country" value="<?=$rowdest7['Country']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;State </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="State" value="<?=$rowdest7['State']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;City </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="City" value="<?=$rowdest7['City']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;Address </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <textarea name="Address" rows="3"><?=$rowdest7['Address']?>
</textarea>
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;Phone </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="Phone" value="<?=$rowdest7['Phone']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;Fax </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="Fax" value="<?=$rowdest7['Fax']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;ZipCode </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="ZipCode" value="<?=$rowdest7['ZipCode']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;BusinessName </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="BusinessName" value="<?=$rowdest7['BusinessName']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;TradingName </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="TradingName" value="<?=$rowdest7['TradingName']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;BusinessAddress </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="BusinessAddress" value="<?=$rowdest7['BusinessAddress']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p><i class="icon-lock"></i>&nbsp;Website </p></td>
                            <td><p>:</p></td>
                            <td width="220px;"><p>
                                <input type="text" name="Website" value="<?=$rowdest7['Website']?>">
                              </p></td>
                          </tr>
                          <tr>
                            <td width="150px"><p> </p></td>
                            <td><p></p></td>
                            <td width="220px;"><p>
                                <input type="submit" class="btn large yellow" name="submit" value="Update">
                              </p></td>
                          </tr>
                        </table>
                      </div>
                      <!--end span8--> 
                      
                      <!--end span4--> 
                    </div>
                  </form>
                  
                  <!--end row-fluid--> 
                  
                </div>
              </div>
              
              <!--end tab-pane-->
              <div class="tab-pane profile-classic <?php if(isset($_REQUEST['update'])){echo 'active';}else{echo '';}?> row-fluid" id="tab_1_2">
                <div class="row-fluid">
                  <div class="span profile-info">
                    <h3>Billing Information&nbsp;
                      <button id="edit_btn" onClick="edit_booking();" class="btn mini blue">Edit <i class="icon-edit"></i></button>
                      &nbsp;</h3>
                    <div class="col-md-12" id="booking_info">
                      <?php
															//Fetch Subscription Id From order table
															$FetchUserSqlp = "SELECT * FROM billing_dtls WHERE clientId  = '".$_REQUEST['Uid']."'";
															$FetchUserQueryp = mysql_query($FetchUserSqlp);
															$FetchRowsp = mysql_fetch_array($FetchUserQueryp);
															//Fetch Subscription
															/*$FetchUserSubSql = "SELECT * FROM ".TABLE_PREFIX."subscription WHERE subscription_Id = '".$FetchRowsp['subscription_Id']."'";
															$FetchUserSubQuery = mysql_query($FetchUserSubSql);
															$FetchRowsSub = mysql_fetch_array($FetchUserSubQuery);*/
													   ?>
                      <div class="table-responsive">
                        <table class="table table-striped table-hover" id="sample_2">
                          <tbody>
                            <tr>
                              <td width="20%"><p>Business Name</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['businessName']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Trading Name</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['tradingName']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>ABN</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['abn']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Business Address</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['businessAddress']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Postal Address</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['postalAddress']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Business Phone</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['phone']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Business Email</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['email']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Business Fax</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['fax']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Business Contact</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['businessContact']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Invoice Via</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['invoicesVia']?>
                                </p></td>
                            </tr>
                            <tr>
                              <td width="20%"><p>Date</p></td>
                              <td width="5%"><p>:</p></td>
                              <td><p>
                                  <?=$FetchRowsp['dt']?>
                                </p></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-12" id="edit_booking_info" style="display:none;">
                      <?php
															//Fetch Subscription Id From order table
															$FetchUserSqlp = "SELECT * FROM billing_dtls WHERE clientId  = '".$_REQUEST['Uid']."'";
															$FetchUserQueryp = mysql_query($FetchUserSqlp);
															$FetchRowsp = mysql_fetch_array($FetchUserQueryp);
															//Fetch Subscription
															/*$FetchUserSubSql = "SELECT * FROM ".TABLE_PREFIX."subscription WHERE subscription_Id = '".$FetchRowsp['subscription_Id']."'";
															$FetchUserSubQuery = mysql_query($FetchUserSubSql);
															$FetchRowsSub = mysql_fetch_array($FetchUserSubQuery);*/
													   ?>
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="table-responsive">
                          <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                          <table class="table table-striped table-hover" id="sample_2">
                            <tbody>
                              <tr>
                                <td width="20%"><p>Business Name</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="businessName" value="<?=$FetchRowsp['businessName']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Trading Name</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="tradingName" value="<?=$FetchRowsp['tradingName']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>ABN</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="abn" value="<?=$FetchRowsp['abn']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Business Address</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="businessAddress" value="<?=$FetchRowsp['businessAddress']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Postal Address</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="postalAddress" value="<?=$FetchRowsp['postalAddress']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Business Phone</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="number" name="phone" value="<?=$FetchRowsp['phone']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Business Email</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="email" name="email" value="<?=$FetchRowsp['email']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Business Fax</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="number" name="fax" value="<?=$FetchRowsp['fax']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Business Contact</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="number" name="businessContact" value="<?=$FetchRowsp['businessContact']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Invoice Via</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="invoicesVia" value="<?=$FetchRowsp['invoicesVia']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Date</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="dateTime" name="dt" value="<?=$FetchRowsp['dt']?>">
                                  </p></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="update_btn" style="display:none;" class="btn large yellow" name="Update" value="Update"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--tab_1_2--> 
              
              <!--tab_1_3-->
              
              <div class="tab-pane profile-classic <?php if(isset($_REQUEST['invoice'])){echo 'active';}else{echo '';}?> row-fluid" id="tab_1_3">
                <div class="row-fluid">
                  <div class="span profile-info">
                    <h3>All Invoices&nbsp;
                      <button id="add_new_inv" onClick="add_invoice();" class="btn mini green">Add New <i class="icon-edit"></i></button>
                      <button id="view_inv" onClick="view_invoice();" style="display:none;" class="btn mini green">View All <i class="icon-edit"></i></button>
                      &nbsp;</h3>
                    <div class="col-md-12" id="invoice">
                      <?php
															
													   ?>
                      <div id="tablesec">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                          <thead>
                            <tr>
                              <th class="hidden-480">Nos.</th>
                              <th class="hidden-480">Invoice No</th>
                              <th class="hidden-480">Invoice Date</th>
                              <th class="hidden-480">Amount</th>
                              <th class="hidden-480">Due Date</th>
                              <th class="hidden-480">Payment Status</th>
                              <th class="hidden-480">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."user_invoice WHERE Uid = '".$_REQUEST['Uid']."' ORDER BY id DESC";
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
                                  <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
                                    <option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>Paid</option>
                                    <option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>Payment Due</option>
                                  </select>
                                </div></td>
                             <td class="hidden-480"><div class="controls">
                               <a onclick="deleteone(<?=$rowdest['id']?>, <?=$_REQUEST['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a></div></td>
                            </tr>
                            <?php $ctn++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-12" id="add_invoice" style="display:none;">
                      
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="table-responsive">
                          <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                          <table class="table table-striped table-hover" id="sample_2">
                            <tbody>
                              <tr>
                                <td width="20%"><p>Invoice No.</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" name="invoiceNo" required value="">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Invoice Date</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" class="dt_pic" name="invoiceDate" placeholder="mm/dd/yyyy" required value="">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Amount Payable</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="number" name="amount" required value="">
                                  </p></td>
                              </tr>
                              
                              <tr>
                                <td width="20%"><p>Due Date</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="text" class="dt_pic"  placeholder="mm/dd/yyyy" name="dueDate" value="">
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Status</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                   <select class="span3 chosen" tabindex="1" name="status" id="status">
                                    <option value="Yes">Paid</option>
                                    <option value="No" selected>Payment Due</option>
                                  </select>
                                  </p></td>
                              </tr>
                              <tr>
                                <td width="20%"><p>Upload Invoice</p></td>
                                <td width="5%"><p>:</p></td>
                                <td><p>
                                    <input type="file" required name="pdf">
                                  </p></td>
                              </tr>
                              
                              <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" id="invoice_btn" class="btn large bg-green" name="addInvoice" value="Add Invoice"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--tab_1_3--> 
              
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
<!--<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script> -->
<script type="text/javascript">
function edit_profile()
{
	$('#view_profile').css('display', 'none');
	$('#update_profile').css('display', 'block');
	$('#profile_btn').css('display', 'none');
}
function edit_booking()
{
	$('#edit_booking_info').css('display', 'block');
	$('#booking_info').css('display', 'none');
	$('#update_btn').css('display', 'block');
	$('#edit_btn').css('display', 'none');
}

function add_invoice()
{
	$('#add_invoice').css('display', 'block');
	$('#invoice').css('display', 'none');	
	$('#add_new_inv').css('display', 'none');
	$('#view_inv').css('display', 'block');
}
function add_invoice()
{
	$('#add_invoice').css('display', 'block');
	$('#invoice').css('display', 'none');	
	$('#add_new_inv').css('display', 'none');
	$('#view_inv').css('display', 'block');
}
function view_invoice()
{
	$('#add_invoice').css('display', 'none');
	$('#invoice').css('display', 'block');	
	$('#add_new_inv').css('display', 'block');
	$('#view_inv').css('display', 'none');
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
	

    <!-- <script  language="javascript" src="../js/frm_validator.js"></script>-->
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
		
	function changestatus(stat,id)
	{
		$.post('ajax/statusinvoice.php',{ stat : stat , id : id });
	}
	
	/********************Delete****************/
	function deleteone(id, Uid)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delinvoice.php',{ feedid : id, mode : 'single', Uid : Uid },
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
    
    
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>