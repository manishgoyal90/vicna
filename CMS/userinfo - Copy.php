<?php include"lib/header.php";?>
<?php
	if(isset($_REQUEST['Update_x'])) {	                         
				
				$oldimg = $_REQUEST['oldimg']; 
				
					if($_FILES['image']['name']!=''){
						//Crop
						$Imagesfolder = "../profileimage/";//folder path
						$Imagesfullsize = "../profileimage/fullsize/";//folder path
						
						$valid_exts = array('jpeg', 'jpg', 'png', 'gif');

						$pic = $_FILES['image']['name'];
						$temp = $_FILES['image']['tmp_name'];
						
						if($_FILES['image']['name']!='')
						
						$pic = $pic;
						
						$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
						
						if (in_array($ext, $valid_exts)) {
						
						$pic = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
						
						//$upload  = $Imagesfolder.$pic; uniqid() . '.' . $ext; 
						$upload = $Imagesfullsize.$pic;
						@copy($temp,$upload);
						
						$thumbsimage1 = $Imagesfolder."bigimg/".$pic;
						$thumbsimage2 = $Imagesfolder."smallimg/".$pic;
						$thumbsimage3 = $Imagesfolder."medium/".$pic;
						$thumbsimage4 = $Imagesfolder."extbig/".$pic;
						
						$param_width[0] = 200;
						$param_height[1] = 200;
						
						createthumb($pic,$thumbsimage1,$param_width[0],$param_height[1],$Imagesfullsize);
						
						$param_width[0] = 550;
						$param_height[1] = 550;
						
						createthumb($pic,$thumbsimage3,$param_width[0],$param_height[1],$Imagesfullsize);
						
						$param_width[0] = 800;
						$param_height[1] = 800;
						
						createthumb($pic,$thumbsimage4,$param_width[0],$param_height[1],$Imagesfullsize);
						
						$targ_w = $targ_h = 450;
						$jpeg_quality = 90;
					
						$src = $thumbsimage3;
						$img_r = imagecreatefromjpeg($src);
						$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
					
						imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
					
						//header('Content-type: image/jpeg');
						imagejpeg($dst_r,$thumbsimage2,$jpeg_quality);
						
						//exit;
						
							$imageupload = "insert into ".TABLE_PREFIX."user_uploads set 
																uploads_uid='".$_REQUEST['uid']."' , 
																uploads_filename='".$pic."'";
				  			mysql_query($imageupload)or mysql_error();
						
						} else {
							//echo 'unknown problem!';
							echo '<script language="javascript">';
							echo 'window.location="userinfo.php?mess=updatesuccessful&Uid='.$_REQUEST['uid'].'#tab_1_4"';
							echo '</script>';
						} 
					}
					

				echo '<script language="javascript">';
				echo 'window.location="userinfo.php?mess=updatesuccessful&Uid='.$_REQUEST['uid'].'#tab_1_4"';
				echo '</script>';
			}
	

	//Delete Image		
	if($_REQUEST['del']=='delimg' && $_REQUEST['uploads_id']!='')
	{
	
	$DeletePicSql="select * from ".TABLE_PREFIX."user_uploads where uploads_uid='".$_REQUEST['Uid']."' and uploads_id='".$_REQUEST['uploads_id']."'";
	$DeletePicQuery=mysql_query($DeletePicSql) or mysql_error();
	$DeletePicFetch=mysql_fetch_array($DeletePicQuery);
	
		
		$photo="../profileimage/bigimg/".$DeletePicFetch['uploads_filename'];
		$thumb="../profileimage/extbig/".$DeletePicFetch['uploads_filename'];
		$thumb2="../profileimage/fullsize/".$DeletePicFetch['uploads_filename'];
		$thumb3="../profileimage/medium/".$DeletePicFetch['uploads_filename'];
		$thumb4="../profileimage/smallimg/".$DeletePicFetch['uploads_filename'];
		
		if(file_exists($photo)) { @unlink($photo); } // unlink 1st image
		if(file_exists($thumb)) { @unlink($thumb); }// unlink 1st image
		if(file_exists($thumb2)) { @unlink($thumb2); }// unlink 1st image
		if(file_exists($thumb3)) { @unlink($thumb3); }// unlink 1st image
		if(file_exists($thumb4)) { @unlink($thumb4); }// unlink 1st image
		
		$delSql="delete from ".TABLE_PREFIX."user_uploads where uploads_uid = '".$_REQUEST['Uid']."' and uploads_id = '".$_REQUEST['uploads_id']."'";
		
		if(mysql_query($delSql))
		{
			echo '<script language="javascript">';
			echo 'window.location="userinfo.php?mess=updatesuccessful&Uid='.$_REQUEST['Uid'].'#tab_1_4"';
			echo '</script>';
		}
		else
		{
			echo '<script language="javascript">';
			echo 'window.location="userinfo.php?mess=updatesuccessful&Uid='.$_REQUEST['Uid'].'#tab_1_4"';
			echo '</script>';
		}
}

	//Set Profile Image	
	if($_REQUEST['set']=='proimg' && $_REQUEST['uploads_id']!='')
	{
	
	//$UpdateProSql = "UPDATE ".TABLE_PREFIX."user_uploads SET status = '0' where uploads_uid='".$_SESSION['userid']."' and uploads_id='".$_REQUEST['uploads_id']."'";
	$UpdateProSql = "UPDATE ".TABLE_PREFIX."user_uploads SET status = '0' where uploads_uid='".$_REQUEST['Uid']."'";
	$UpdateProQuery = mysql_query($UpdateProSql) or mysql_error();
	
	//Update Profile Status
	$UpdateProSql2 = "UPDATE ".TABLE_PREFIX."user_uploads SET status = '1' where uploads_uid='".$_REQUEST['Uid']."' and uploads_id='".$_REQUEST['uploads_id']."'";
	$UpdateProQuery2 = mysql_query($UpdateProSql2) or mysql_error();
	
		
			/*$photomsg="Profile Picture Set successfully";
			header("location:userinfo.php?image=set");
			exit();*/
			echo '<script language="javascript">';
			echo 'window.location="userinfo.php?mess=updatesuccessful&Uid='.$_REQUEST['Uid'].'#tab_1_4"';
			echo '</script>';

}

	



		$getdestsql = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE Uid  = '".$_REQUEST['Uid']."'";
		$getdestquery = mysql_query($getdestsql) or die(mysql_error());
		$rowdest7 = mysql_fetch_array($getdestquery);
	
		
				$prop_image = "select * from ".TABLE_PREFIX."user_uploads  where uploads_uid = '".$rowdest7['Uid']."' and status = '1'";
				$prop_image_query = mysql_query($prop_image) or mysql_error();
				$prop_image_rows_set = mysql_fetch_array($prop_image_query);
											
					//Big Crop Img
					if($prop_image_rows_set['uploads_filename'] == "")
					{
						$proset = "images/nopic.jpg";
					}
					else if(!is_file("../profileimage/smallimg/".$prop_image_rows_set['uploads_filename']))
					{
						$proset = "images/nopic.jpg";
					}
					else
					{
						$proset = "../profileimage/smallimg/".$prop_image_rows_set['uploads_filename'];
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
								<a href="userlist.php">User List</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="">User Info</a>
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
						  if($_REQUEST['action'] == 'updated')
						  {
						  ?>						  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! User updated
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
								<li class="active"><a href="#tab_1_1" data-toggle="tab">Profile</a></li>
								<li><a href="#tab_1_4" data-toggle="tab">Photo</a></li>
								<li><a href="#tab_1_2" data-toggle="tab">Account</a></li>
								<li><a href="#tab_1_3" data-toggle="tab">Viewers</a></li>
                                 <li><a href="#tab_1_7" data-toggle="tab">My Settings</a></li>
								 <li><a href="#tab_1_6" data-toggle="tab">Member Privilege</a></li>
								<!--<li><a href="#tab_1_4" data-toggle="tab">Course Reviews</a></li>-->
							</ul>
							<div class="tab-content">
								<div class="tab-pane row-fluid active" id="tab_1_1">
									<ul class="unstyled profile-nav span3">
										<li><img src="<?=$proset?>" alt="" border="0" title="<?=stripslashes($rowdest7['emp_name'])?> Image" /></li>
                                        <!-- <li>
											<a href=""><?=$rowdest7['FirstName']?>
										</li>                                                                            
-->
									</ul>
									<div class="span9">
										<div class="row-fluid">
											<div class="span7 profile-info">
												<table  width="450px" cellpadding="3" rules="none" border="0">
													<tr>
                                                       <td colspan="3"><h1><?=stripslashes(ucfirst($rowdest7['FirstName']))?>&nbsp;<?=stripslashes(ucfirst($rowdest7['LastName']))?>&nbsp; &nbsp;<a class="btn blue mini"  href="edituser.php?mode=edit&uid=<?=$rowdest7['Uid']?>">Edit <i class="icon-edit"></i></a></h1></td>
													</tr>
													<tr>
														<td><p><i class="icon-key"></i>&nbsp;Registration Number</p></td>
														<td><p>:</p></td>
														<td><p><?=stripslashes($rowdest7['RegistrationNo'])?></p></td>
													</tr>
													<tr>
														<td width="150px"><p><i class="icon-user"></i>&nbsp;User Name</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=stripslashes($rowdest7['UserName'])?></p></td>
													</tr>
													<tr>
														<td width="150px"><p><i class="icon-envelope"></i>&nbsp;Email Address</p></td>
														<td><p>:</p></td>
														<td width="220px;"><p><?=stripslashes($rowdest7['EmailId'])?></p></td>
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
														<td><p><i class="icon-group"></i>&nbsp;Relationship</p></td>
														<td><p>:</p></td>
														<td><p>
															<?php if($rowdest7['MaritalStatus']!='') {?><?=stripslashes($rowdest7['MaritalStatus'])?><?php } else { echo"N/A";}?></p></td>															
													</tr>
													
													<tr>
														<td><p><i class="icon-calendar"></i>&nbsp;Age</p></td>
														<td><p>:</p></td>
														<td><p>
														<?php
															/*-----------------------------Start Age of user---------------------------------------*/
															$date1 = $rowdest7['BirthDate'];
															$date2 =date("Y-m-d");
															$diff = abs(strtotime($date2) - strtotime($date1));
															$years = floor($diff / (365*60*60*24));
														/*-----------------------------End Age of user---------------------------------------*/
														?>	
															<?php if($rowdest7['BirthDate']!='') {?><?=$years?> yrs<?php } else { echo"N/A";}?></p></td>															
													</tr>
													 <tr>
														<td><p><i class="icon-calendar"></i>&nbsp;Date of Birth</p></td>
														<td><p>:</p></td>
														<td><p><?php 
																	 $dateofbirth = date("jS M, Y",strtotime($rowdest7['BirthDate']));
																		echo $dateofbirth;
																 ?>
															</p>
														</td>
													</tr> 
													
													<tr>
														<td><p><i class="icon-book"></i>&nbsp;Height</p></td>
														<td><p>:</p></td>
														<td><p>
																 <?php if($rowdest7['Height']!='') {?><?=stripslashes($rowdest7['Height'])?><?php } else { echo"N/A";}?>
															</p>
														</td>
													</tr> 
													
													<tr>
														<td><p><i class="icon-book"></i>&nbsp;Body Type</p></td>
														<td><p>:</p></td>
														<td><p>
																 <?php if($rowdest7['BodyType']!='') {?><?=stripslashes($rowdest7['BodyType'])?><?php } else { echo"N/A";}?>
															</p>
														</td>
													</tr>
													
													<tr>
														<td><p><i class="icon-book"></i>&nbsp;Occupation</p></td>
														<td><p>:</p></td>
														<td><p>
																 <?php if($rowdest7['Occupation']!='') {?><?=stripslashes($rowdest7['Occupation'])?><?php } else { echo"N/A";}?>
															</p>
														</td>
													</tr>
									
												</table>												
											</div>
											<!--end span8-->
											<div class="span5">
												<div class="portlet sale-summary">
													<div class="portlet-title">
														<div class="caption">Log Summary</div>
														<div class="tools">
															<a class="reload" href="javascript:;"></a>
														</div>
												
													</div>
													<div class="portlet-body">
														<ul class="unstyled">
															<li>
																<span class="sale-info"><i class="icon-globe"></i>&nbsp;&nbsp;Ip Address</span> 
																<span class="sale-num"><?=$rowdest7['IpAddress']?></span>
															</li>
<!--															<li>
																<span class="sale-info"><i class="icon-signin"></i>&nbsp;&nbsp;Last Login Date</span> 
																<span class="sale-num">
																	<?php
                                                                        $logindate=date("jS M, Y",strtotime($rowdest7['last_log_dt']));
																 	?>
																	<?=$logindate?></span>
															</li>-->
															<!--<li>
																<span class="sale-info"><i class="icon-signin"></i>&nbsp;&nbsp;Last Login Time</span> 
																<span class="sale-num">
																	<?php
                                                                       $logintime=date("g:i:s a",strtotime($rowdest7['last_log_dt']));
																 	?>
																	<?=$logintime?>
																</span>
															</li>-->
															<div class="portlet-title" style="padding-top:15px;">
																<div class="caption" id="tit2">Additional Info.</div>
																<div class="tools">
																	<a class="reload" href="javascript:;"></a>
																</div>
														
															</div>
															<li>
															
																<table  width="450px" cellpadding="3" rules="none" border="0">

																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Ethnicity</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['Ethnicity']!='') {?><?=stripslashes($rowdest7['Ethnicity'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr> 
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Hair Color</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['HairColor']!='') {?><?=stripslashes($rowdest7['HairColor'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr>
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Eye Color</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['EyeColor']!='') {?><?=stripslashes($rowdest7['EyeColor'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr>
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Looking For</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['LookingForGender']!='') {?><?=stripslashes($rowdest7['LookingForGender'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr> 
																	
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Drink</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['Drink']!='') {?><?=stripslashes($rowdest7['Drink'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr> 
																	
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Smoke</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['Smoke']!='') {?><?=stripslashes($rowdest7['Smoke'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr>
																	<?php
																		$countrysql="select * from ".TABLE_PREFIX."country WHERE fld_id = '".$rowdest7['Country']."'";
																		$countrysqlquery=mysql_query($countrysql) or mysql_error();
																		$countrysqlfetch=mysql_fetch_array($countrysqlquery);
																	?> 
																	
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Country</p></td>
																		<td><p>:</p></td>
																		<td><p>
																				 <?php if($rowdest7['Country']!='') {?><?=stripslashes($countrysqlfetch['fld_name'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr> 
																	<tr>
																		<td><p><i class="icon-book"></i>&nbsp;Location</p></td>
																		<td><p>:</p></td>
																		<td><p>
																		<?php
																			$statesql="select * from ".TABLE_PREFIX."state WHERE State_id IN('".$rowdest7['State']."')";
																			$statesqlquery=mysql_query($statesql) or mysql_error();
																			$statesqlfetch=mysql_fetch_array($statesqlquery);
																		?>
																				 <?php if($rowdest7['City']!='') {?><?=stripslashes($rowdest7['City'])?>, <?=stripslashes($statesqlfetch['State_name'])?><?php } else { echo"N/A";}?>
																			</p>
																		</td>
																	</tr>
																										
																</table>
															</li>
														</ul>
													</div>													
												</div>
											</div>
											<!--end span4-->
										</div>
										<!--end row-fluid-->
										
									</div>
									<!--end span9-->
									<div class="row-fluid">
										<div class="tabbable tabbable-custom tabbable-custom-profile span12">
										<p><h3>Describing Myself : </h3><?=$rowdest7['Description']?></p>
										<div class="tabbable tabbable-custom tabbable-custom-profile span12">
										<p><h3>Interest/Hobbies : </h3>
										<?php if($rowdest7['Hobbies']!='') { ?>
										<?php
											$hobb = explode(",",$rowdest7['Hobbies']);
											$k = 1;
											foreach($hobb as $val) {
											if($k%2==0) {
											$k2 = "#ffffff";} else { $k2 = "#eee"; }
										?>
											<span><?=$k."&nbsp;.&nbsp;".$val."<br />"?></span>
											<?php $k++; } ?>
											<?php } else { echo"N/A"; } ?></p>
										<p>&nbsp;</p>
														
											<ul class="nav nav-tabs">
												<li class="active"><a href="#tab_1_22" data-toggle="tab">Member Hotlisted Me</a></li>
											<!--	<li><a href="#tab_1_33" data-toggle="tab">Upload Course</a></li>-->
												<li><a href="#tab_1_44" data-toggle="tab">My Hotlist</a></li>
												<li><a href="#tab_1_33" data-toggle="tab">Notifications</a></li>
												<li><a href="#tab_1_55" data-toggle="tab">Inbox</a></li>
												<li><a href="#tab_1_66" data-toggle="tab">Outbox</a></li>
												<li><a href="#tab_1_77" data-toggle="tab">Blocked User</a></li>
											</ul>
											<div class="tab-content">
											<div class="tab-pane active" id="tab_1_22">
													<div class="portlet-body" style="display: block;">
														<?php
															$p=1;
															$user_id = $_REQUEST['Uid'];
																/*------------------Pegination Start------------------------------*/
															$rows_per_page=30;
																
															if(isset($_REQUEST['page']))
																{
																	$pagenumber=$_REQUEST['page'];
																}
															else
																{
																	$pagenumber=1;
																}
															$offset=($pagenumber-1)*$rows_per_page;
															
															$sqlPage="select * from ".TABLE_PREFIX."user_friend where user_friend_friend_id='".$user_id."' and user_friend_status='accepted' order by user_friend_id DESC";
															$result=mysql_query($sqlPage) or mysql_error();
															$totnumrow=mysql_num_rows($result);
															$totrow=ceil($totnumrow/$rows_per_page);
									
															$friend_request="select * from ".TABLE_PREFIX."user_friend where user_friend_friend_id='".$user_id."' and user_friend_status='accepted'";
															$res_friend_request=mysql_query($friend_request) or mysql_error();
															$num_friend_request=mysql_num_rows($res_friend_request);
														?>
                                                      <h4>Member Hotlisted Me [<?=$num_friend_request?>]</h4>
														<div class="twelve columns">
															<div id="tablesec">
						
																	<?php
																		if($num_friend_request>0) {
																		while($res_friend_fetch_1=mysql_fetch_array($res_friend_request))
																		{  	
																			
																			$friend_name="select * from ".TABLE_PREFIX."user_registration where Uid='".$res_friend_fetch_1['user_friend_user_id']."' ";
																			$res_friend_name=mysql_query($friend_name);
																			$row_friend_name=mysql_fetch_array($res_friend_name);
																			
																			//For User Image
																			if($row_friend_name['UserImage'] == "")
																			{
																				$picusr = "images/nopic.jpg";
																			}
																			else if(!is_file("../profileimage/medium/".$row_friend_name['UserImage']))
																			{
																				$picusr = "images/nopic.jpg";
																			}
																			else
																			{
																				$picusr = "../profileimage/medium/".$row_friend_name['UserImage'];
																			}
																	
																$onlinesqlr="select onlinestatus_user_id from ".TABLE_PREFIX."online_status as os where os.status='Y' and onlinestatus_user_id in(".$row_friend_name['Uid'].") group by onlinestatus_user_id";
																$res_memberssq=mysql_query($onlinesqlr) or mysql_error();
																$members_arr=mysql_num_rows($res_memberssq);
																		
																			
														?>
																	
																<table class="table table-striped table-bordered table-hover" id="sample_2">	
																	<tr>
																		<td width="10%"   align="left" valign="top">
																			  <img src="<?=$picusr?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												  </td>
																	  <td width="90%"><p style="margin-bottom:2px;"><a name="<?php echo $row_friend_name['Uid'];?>" href="userinfo.php?Uid=<?php echo $row_friend_name['Uid'];?>" style="color:#0078a5; font-weight:normal; font-size:16px;"><?=stripslashes($row_friend_name['FirstName']);?>&nbsp;<?=stripslashes($row_friend_name['LastName']);?>&nbsp;(&nbsp;<?php echo $row_friend_name['EmailId'];?>&nbsp;)</a></p>
																	  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
																	  <form name="sam2" action="" method="post">
																	  <p style="margin-bottom:2px;"><?php echo date('F d ,  Y',strtotime($res_friend_fetch_1['user_friend_date']));?></p>
																	  
																	  </form>
																	  </td>
																	</tr>
																</table>
						
																<?php $p++; } } else { ?><p style="color:#ff0000; font-size:16px; padding-left:27px;">No Hotlist Member</p> <?php } ?>
																</div>
									
															  
														</div>
													</div>
												</div>
												
												<!--<div class="tab-pane" id="tab_1_33">
														<div class="portlet-body" style="display: block;">

                                                           <h3 style="color:#ff0000;">No Records Availables!</h3>

													</div>
												</div>-->
											
												
												<div class="tab-pane" id="tab_1_44">
														<div class="portlet-body" style="display: block;">
															<?php
																$p=1;
																$user_id = $_REQUEST['Uid'];
																	/*------------------Pegination Start------------------------------*/
																$rows_per_page=30;
																	
																if(isset($_REQUEST['page']))
																	{
																		$pagenumber=$_REQUEST['page'];
																	}
																else
																	{
																		$pagenumber=1;
																	}
																$offset=($pagenumber-1)*$rows_per_page;
																
																$sqlPage="select * from ".TABLE_PREFIX."user_friend where user_friend_user_id='".$user_id."' and user_friend_status='accepted' order by user_friend_id DESC";
																$result=mysql_query($sqlPage) or mysql_error();
																$totnumrow=mysql_num_rows($result);
																$totrow=ceil($totnumrow/$rows_per_page);
										
																$friend_request="select * from ".TABLE_PREFIX."user_friend where user_friend_user_id ='".$user_id."' and user_friend_status='accepted'";
																$res_friend_request=mysql_query($friend_request) or mysql_error();
																$num_friend_request=mysql_num_rows($res_friend_request);
															?>
                                                           <h3>My Hotlist [<?=$num_friend_request?>]</h3>

														<div class="twelve columns">
															<div id="tablesec">
						
																	<?php
																		if($num_friend_request>0) {
																		while($res_friend_fetch_1=mysql_fetch_array($res_friend_request))
																		{  	
																			
																			$friend_name="select * from ".TABLE_PREFIX."user_registration where Uid='".$res_friend_fetch_1['user_friend_friend_id']."' ";
																			$res_friend_name=mysql_query($friend_name);
																			$row_friend_name=mysql_fetch_array($res_friend_name);
																			
																			//For User Image
																			if($row_friend_name['UserImage'] == "")
																			{
																				$picusr = "images/nopic.jpg";
																			}
																			else if(!is_file("../profileimage/medium/".$row_friend_name['UserImage']))
																			{
																				$picusr = "images/nopic.jpg";
																			}
																			else
																			{
																				$picusr = "../profileimage/medium/".$row_friend_name['UserImage'];
																			}
																			
																$onlinesqlr2="select onlinestatus_user_id from ".TABLE_PREFIX."online_status as os where os.status='Y' and onlinestatus_user_id in(".$row_friend_name['Uid'].") group by onlinestatus_user_id";
																$res_memberssq2=mysql_query($onlinesqlr2) or mysql_error();
																$members_arr2=mysql_num_rows($res_memberssq2);
																		
																			
														?>
																	
																<table class="table table-striped table-bordered table-hover" id="sample_2">
																	<tr>
																		<td width="10%"   align="left" valign="top">
																			  <img src="<?=$picusr?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												  			</td>
																	  <td width="90%"><p style="margin-bottom:2px;"><a name="<?php echo $row_friend_name['Uid'];?>" href="userinfo.php?Uid=<?php echo $row_friend_name['Uid'];?>" style="color:#0078a5; font-weight:normal; font-size:16px;"><?=stripslashes($row_friend_name['FirstName']);?>&nbsp;<?=stripslashes($row_friend_name['LastName']);?>&nbsp;(&nbsp;<?php echo $row_friend_name['EmailId'];?>&nbsp;)</a></p>
																	  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
																	  <form name="sam2" action="" method="get">
																	  <p style="margin-bottom:2px;"><?php echo date('F d ,  Y',strtotime($res_friend_fetch_1['user_friend_date']));?></p>
																	 
																	  </form>
																	  </td>
																	</tr>
																</table>
						
																<?php $p++; } } else { ?><p style="color:#ff0000; font-size:16px; padding-left:27px;">No Hotlist Member</p> <?php } ?>
																<?php if($totnumrow>30) { ?>
																<table width="100%" cellpadding="0" cellspacing="0">			
																	<tr>
																	<td style="text-align:left; width:33%;">
																	<?php
																	if($pagenumber>1)
																	{
																	?>
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=1&perpage=<?=$_REQUEST['perpage']?>">&lt;&lt;</a>&nbsp;&nbsp;
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber-1; ?>&perpage=<?=$_REQUEST['perpage']?>">Prev</a>
																	<?php
																	}
																	?>
																	</td>
																	<td style="text-align:center;width:33%;">
																	<?php
																	for($p=1;$p<=$totrow;$p++)
																	{
																	if($pagenumber==$p)
																	{
																	$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#0186a5;'";
																	}
																	else
																	{
																	$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#0186a5;'";
																	}
																	?>
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $p; ?>" <?php echo $sty ;?>><?php echo $p; ?></a>
																	<?php
																	}
																	?>
																	</td>
																	<td align="right" style="text-align:right;width:33%;" >					
																	<?php
																	if($pagenumber<$totrow)
																	{
																	?>
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber+1; ?>">Next</a>&nbsp;&nbsp;
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $totrow; ?>">&gt;&gt;</a>
																	<?php
																	}
																	?>
																	</td>
																	</tr>
																	</table>
																	<?php } ?>
																</div>
									
															  
														</div>
													</div>
												</div>
												
												<div class="tab-pane" id="tab_1_33">
														<div class="portlet-body" style="display: block;">

														<?php
															/*------------------Pegination Start------------------------------*/
															$rows_per_page=40;
																
															if(isset($_REQUEST['page']))
																{
																	$pagenumber=$_REQUEST['page'];
																}
															else
																{
																	$pagenumber=1;
																}
															$offset=($pagenumber-1)*$rows_per_page;
															
															$sqlPage="select * from  ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and message_receiver_delstatus='0' order by message_id DESC";
															$result=mysql_query($sqlPage) or mysql_error();
															$totnumrow=mysql_num_rows($result);
															$totrow=ceil($totnumrow/$rows_per_page);
															
															/*----------------------------Start Total Notification Message-------------------------------------*/
															$NotificationSqlcount="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and message_receiver_delstatus='0' order by message_id DESC limit $offset,$rows_per_page";
															$NotificationQuerycount=mysql_query($NotificationSqlcount) or mysql_error();
															$Notificationnocount=mysql_num_rows($NotificationQuerycount);
															
															$NotificationSqlcount123="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and message_receiver_delstatus='0' order by message_id DESC";
															$NotificationQuerycount123=mysql_query($NotificationSqlcount123) or mysql_error();
															$Notificationnocount123=mysql_num_rows($NotificationQuerycount123);
														?>
														<!--<h3 style="color:#ff0000;">Sorry No Records Availables!</h3>-->
														
														<div class="twelve columns">
															<div id="tablesec">
																	<?php
																		$p=1;
																		if($Notificationnocount>0)
																		{
																		$l=1; 
																		while($ReciveSqlFetch=mysql_fetch_array($NotificationQuerycount))
																		{
																		$sender_name="select u.* from ".TABLE_PREFIX."user_registration as u where u.Uid='".$ReciveSqlFetch['message_sender_id']."'";
																		$res_sender_name=mysql_query($sender_name);
																		$row_sender_name=mysql_fetch_array($res_sender_name);
						
																		
																		if($row_sender_name['UserImage'] == "")
																		{
																			$upic = "images/nopic.jpg";
																		}
																		else if(!is_file("../profileimage/bigimg/".$row_sender_name['UserImage']))
																		{
																			$upic = "images/nopic.jpg";
																		}
																		else
																		{
																			$upic = "../profileimage/bigimg/".$row_sender_name['UserImage'];
																		}
																	
																		
																			
														?>
																	
																	<table class="table table-striped table-bordered table-hover" id="sample_2">
																	<tr bgcolor="<?php echo $bgcolor;?>">
																		<td width="10%"   align="left" valign="top">
																			  <img src="<?=$upic?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												  </td>
																	  <td width="90%"><p style="margin-bottom:2px;"><a name="<?php echo $ReciveSqlFetch['message_id'];?>" href="userinfo.php?Uid=<?php echo $ReciveSqlFetch['message_sender_id'];?>" style="color:#0078a5; font-weight:normal; font-size:18px;"><?php echo $row_sender_name['FirstName'];?>&nbsp;<?php echo $row_sender_name['LastName'];?>&nbsp;<!--(&nbsp;<?php echo $row_sender_name['UserName'];?>&nbsp;)--></a> <?php if($ReciveSqlFetch['message_read_status']=='u'){?><img src="img/new_mes.png" /><?php }?></p>
																		   <?php 
																				if($ReciveSqlFetch['type']=='msg'){
																				?>
																				has sent you a <a href="view_msg.php?message_id=<?php echo $ReciveSqlFetch['message_id'];?>&message_sender_id=<?php echo $ReciveSqlFetch['message_sender_id'];?>&parent_id=<?php echo $ReciveSqlFetch['parent_id'];?>&Uid=<?=$_REQUEST['Uid']?>" style="color:#0066FF">message</a>
																				<?php }else if($ReciveSqlFetch['type']=='poke'){                               
																				?>
																				has pecked you
																				<?php }else if($ReciveSqlFetch['type']=='FrndReq'){                                
																				?>
																				has sent you a friend request.
																			<?php } ?>
																	  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
																	  <p style="margin-bottom:5px; padding-top:5px;"><?php echo date('F d ,  Y',strtotime($ReciveSqlFetch['message_date']));?></p>
						 
																	  <?php
																		if($ReciveSqlFetch['type']=='msg')
																		{
																		?>
																		<a href="view_msg.php?p=1&message_id=<?php echo $ReciveSqlFetch['message_id'];?>&message_sender_id=<?php echo $ReciveSqlFetch['message_sender_id'];?>&parent_id=<?php echo $ReciveSqlFetch['parent_id'];?>&Uid=<?=$_REQUEST['Uid']?>" style="color:#003399; font-size:12px;"><b>View Message</b></a>
																		<?php
																		}
																		else if($ReciveSqlFetch['type']=='FrndReq')
																		{	
																		if($ReciveSqlFetch['message_read_status']=='u')
																		{
																		?>
																		<a href="home.php?ch=accepted&user_friend_id=<?php echo $ReciveSqlFetch['user_friend_id'];?>">Accept</a></span>&nbsp;/&nbsp;<a href="home.php?ch=rejected&user_friend_id=<?php echo $ReciveSqlFetch['user_friend_id'];?>" style="color:#ff0000;">Reject</a></span>&nbsp;&nbsp;<a href="noti_list.php?Del=del&message_id=<?php echo $ReciveSqlFetch['message_id'];?>&message_receiver_id=<?php echo $ReciveSqlFetch['message_receiver_id'];?>" style="color:#FF0000" onclick="javascript:return confirm('Are you sure you want to delete ?');">Delete</a>
																		<?php
																		}
																		else
																		{
																		?>
																		<a href="noti_list.php?Del=del&message_id=<?php echo $ReciveSqlFetch['message_id'];?>&message_receiver_id=<?php echo $ReciveSqlFetch['message_receiver_id'];?>" style="color:#FF0000" onclick="javascript: return confirm('Are you sure you want to delete?');">Delete</a>
																		<?php
																		}
																		}
																		else if($ReciveSqlFetch['type']=='poke')
																		{
																		?> 
																		<a href="noti_list.php?Del=del&message_id=<?php echo $ReciveSqlFetch['message_id'];?>&message_receiver_id=<?php echo $ReciveSqlFetch['message_receiver_id'];?>" style="color:#FF0000" onclick="javascript: return confirm('Are you sure you want to delete?');">Delete</a>
																		<?php
																		}
																		?> 
																		<div id="div<?=$p?>" style="display:none; padding:10px" class="addTitle">
																		<?=stripslashes(nl2br($ReciveSqlFetch['message_body']))?>
																		</div>   
																	  </td>
																	</tr>
																</table>
																	  
																<?php 
																	$p++; } } 
																?>
																<?php if($totnumrow>40) { ?>
																<table width="100%" cellpadding="0" cellspacing="0">			
																	<tr>
																	<td style="text-align:left; width:33%;">
																	<?php
																	if($pagenumber>1)
																	{
																	?>
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=1&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_33">&lt;&lt;</a>&nbsp;&nbsp;
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber-1; ?>&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_33">Prev</a>
																	<?php
																	}
																	?>
																	</td>
																	<td style="text-align:center;width:33%;">
																	<?php
																	for($p=1;$p<=$totrow;$p++)
																	{
																	if($pagenumber==$p)
																	{
																	$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#0186a5;'";
																	}
																	else
																	{
																	$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#0186a5;'";
																	}
																	?>
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $p; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_33" <?php echo $sty ;?>><?php echo $p; ?></a>
																	<?php
																	}
																	?>
																	</td>
																	<td align="right" style="text-align:right;width:33%;" >					
																	<?php
																	if($pagenumber<$totrow)
																	{
																	?>
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber+1; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_33">Next</a>&nbsp;&nbsp;
																	<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $totrow; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_33">&gt;&gt;</a>
																	<?php
																	}
																	?>
																	</td>
																	</tr>
																	</table>
																	<?php } ?>
																</div>
									
															  
														</div>

													</div>
												</div>
												
												<div class="tab-pane" id="tab_1_55">
												<div class="portlet-body" style="display: block;">

												<?php
											 		 $user_id=$_REQUEST['Uid'];

												/*------------------Pegination Start------------------------------*/
													$rows_per_page=30;
														
													if(isset($_REQUEST['page']))
														{
															$pagenumber=$_REQUEST['page'];
														}
													else
														{
															$pagenumber=1;
														}
													$offset=($pagenumber-1)*$rows_per_page;
													$sqlPage="select * from  ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and type='msg' and message_receiver_delstatus='0' order by message_id DESC";
													$result=mysql_query($sqlPage) or mysql_error();
													$totnumrow=mysql_num_rows($result);
													$totrow=ceil($totnumrow/$rows_per_page);
												
													/*----------------------------Start Total Notification Message-------------------------------------*/
													$NotificationSqlcount="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and message_receiver_delstatus='0'";
													$NotificationQuerycount=mysql_query($NotificationSqlcount) or mysql_error();
													$Notificationnocount=mysql_num_rows($NotificationQuerycount);
													/*-----------------------------Start Total Inbox Message---------------------------------------*/
													$InboxSqlcount="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and type='msg' and message_receiver_delstatus='0' order by message_id DESC limit $offset,$rows_per_page";
													$InboxQuerycount=mysql_query($InboxSqlcount) or mysql_error();
													$Inboxnocount=mysql_num_rows($InboxQuerycount);
													
													$InboxSqlcount123="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and type='msg' and message_receiver_delstatus='0' order by message_id DESC";
													$InboxQuerycount123=mysql_query($InboxSqlcount123) or mysql_error();
													$Inboxnocount123=mysql_num_rows($InboxQuerycount123);
													/*-----------------------------Start Total Send Message---------------------------------------*/		 
													$send_msg="select * from ".TABLE_PREFIX."message where message_sender_id='".$_REQUEST['Uid']."' and message_sender_delstatus='0'";
													$res_send_msg=mysql_query($send_msg) or mysql_error();
													$send_msg_number=mysql_num_rows($res_send_msg);
												/*-----------------------------End Total Recive Message---------------------------------------*/
														?>
														<!--<h3 style="color:#ff0000;">Sorry No Records Availables!</h3>-->
														
													<div class="twelve columns">
														<div id="tablesec">
																<?php
																	$p=1;
																	if($Inboxnocount>0)
																	{
																	while($ReciveSqlFetch=mysql_fetch_array($InboxQuerycount))
																	{
									
																	$sender_name="select u.* from ".TABLE_PREFIX."user_registration as u where u.Uid='".$ReciveSqlFetch['message_sender_id']."'";
																	
																	$res_sender_name=mysql_query($sender_name);
																	$row_sender_name=mysql_fetch_array($res_sender_name);
					
																	
																	if($row_sender_name['UserImage'] == "")
																	{
																		$upic = "images/nopic.jpg";
																	}
																	else if(!is_file("../profileimage/bigimg/".$row_sender_name['UserImage']))
																	{
																		$upic = "images/nopic.jpg";
																	}
																	else
																	{
																		$upic = "../profileimage/bigimg/".$row_sender_name['UserImage'];
																	}
																	
																		
													?>
																
															<table class="table table-striped table-bordered table-hover" id="sample_2">
																<tr>
																	<td width="10%"   align="left" valign="top">
																		  <img src="<?=$upic?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												  </td>
																  <td width="90%"><p style="margin-bottom:2px;"><a name="<?php echo $ReciveSqlFetch['message_id'];?>" href="userinfo.php?Uid=<?php echo $ReciveSqlFetch['message_sender_id'];?>" style="color:#0078a5; font-weight:normal; font-size:16px;"><?php echo $row_sender_name['FirstName'];?>&nbsp;<?php echo $row_sender_name['LastName'];?>&nbsp;<!--(&nbsp;<?php echo $row_sender_name['EmailId'];?>&nbsp;)--></a></p>
																  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
																  <p style="margin-bottom:2px;"><?=stripslashes($ReciveSqlFetch['message_subject'])?></p>
																  <p style="margin-bottom:2px;"><?php echo date('F d ,  Y',strtotime($ReciveSqlFetch['message_date']));?></p>
																  <p style="margin-bottom:2px;"><a href="view_msg.php?p=2&message_id=<?php echo $ReciveSqlFetch['message_id'];?>&message_sender_id=<?php echo $ReciveSqlFetch['message_sender_id'];?>&parent_id=<?php echo $ReciveSqlFetch['parent_id'];?>&Uid=<?=$_REQUEST['Uid']?>" style="color:#FF9900;font-size:12px;"><b>View Message</b></a></p>
																  </td>
																</tr>
															</table>
																  
															<?php 
																$p++; } } 
															?>
															<?php if($totnumrow>30) { ?>
															<table width="100%" cellpadding="0" cellspacing="0">			
																<tr>
																<td style="text-align:left; width:33%;">
																<?php
																if($pagenumber>1)
																{
																?>
																<a href="<?=$_SERVER['PHP_SELF']?>?page=1&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_55">&lt;&lt;</a>&nbsp;&nbsp;
																<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber-1; ?>&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_55">Prev</a>
																<?php
																}
																?>
																</td>
																<td style="text-align:center;width:33%;">
																<?php
																for($p=1;$p<=$totrow;$p++)
																{
																if($pagenumber==$p)
																{
																$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#0186a5;'";
																}
																else
																{
																$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#0186a5;'";
																}
																?>
																<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $p; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_55" <?php echo $sty ;?>><?php echo $p; ?></a>
																<?php
																}
																?>
																</td>
																<td align="right" style="text-align:right;width:33%;" >					
																<?php
																if($pagenumber<$totrow)
																{
																?>
																<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber+1; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_55">Next</a>&nbsp;&nbsp;
																<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $totrow; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_55">&gt;&gt;</a>
																<?php
																}
																?>
																</td>
																</tr>
																</table>
																<?php } ?>
															</div>
								
														  
													</div>

													</div>
												</div>
												
												<div class="tab-pane" id="tab_1_66">
														<div class="portlet-body" style="display: block;">

												<?php
											 		 $user_id=$_REQUEST['Uid'];

												  /*------------------Pegination Start------------------------------*/
													$rows_per_page=40;
														
													if(isset($_REQUEST['page']))
														{
															$pagenumber=$_REQUEST['page'];
														}
													else
														{
															$pagenumber=1;
														}
													$offset=($pagenumber-1)*$rows_per_page;
													
													$sqlPage="select * from  ".TABLE_PREFIX."message where message_sender_id='".$_REQUEST['Uid']."' and message_sender_delstatus='0' order by message_id DESC";
													$result=mysql_query($sqlPage) or mysql_error();
													$totnumrow=mysql_num_rows($result);
													$totrow=ceil($totnumrow/$rows_per_page);
												
													/*----------------------------Start Total Notification Message-------------------------------------*/
													$NotificationSqlcount="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and message_receiver_delstatus='0'";
													$NotificationQuerycount=mysql_query($NotificationSqlcount) or mysql_error();
													$Notificationnocount=mysql_num_rows($NotificationQuerycount);
													/*-----------------------------Start Total Inbox Message---------------------------------------*/
													$InboxSqlcount="select * from ".TABLE_PREFIX."message where message_receiver_id='".$_REQUEST['Uid']."' and type='msg' and message_receiver_delstatus='0'";
													$InboxQuerycount=mysql_query($InboxSqlcount) or mysql_error();
													$Inboxnocount=mysql_num_rows($InboxQuerycount);
													/*-----------------------------Start Total Send Message---------------------------------------*/		 
													$send_msg="select * from ".TABLE_PREFIX."message where message_sender_id='".$_REQUEST['Uid']."' and message_sender_delstatus='0' order by message_id DESC limit $offset,$rows_per_page";
													$res_send_msg=mysql_query($send_msg) or mysql_error();
													$send_msg_number=mysql_num_rows($res_send_msg);
													
													$send_msg123="select * from ".TABLE_PREFIX."message where message_sender_id='".$_REQUEST['Uid']."' and message_sender_delstatus='0' order by message_id DESC";
													$res_send_msg123=mysql_query($send_msg123) or mysql_error();
													$send_msg_number123=mysql_num_rows($res_send_msg123);
														?>
														<!--<h3 style="color:#ff0000;">Sorry No Records Availables!</h3>-->
														
												<div class="twelve columns">
													<div id="tablesec">
															<?php
																$p=1;
																if($send_msg_number>0)
																{
																while($sentSqlFetch=mysql_fetch_array($res_send_msg))
																{
																$sender_name="select u.* from ".TABLE_PREFIX."user_registration as u where u.Uid='".$_REQUEST['Uid']."'";
																$res_sender_name=mysql_query($sender_name);
																$row_sender_name=mysql_fetch_array($res_sender_name);
																
																$reciverNameSql="select * from ".TABLE_PREFIX."user_registration where Uid='".$sentSqlFetch['message_receiver_id']."'";
																$reciverNameSqlQuery=mysql_query($reciverNameSql) or mysql_error();
																$reciverNameSqlFetch=mysql_fetch_array($reciverNameSqlQuery);
				
																
																if($reciverNameSqlFetch['UserImage'] == "")
																{
																	$upic = "images/nopic.jpg";
																}
																else if(!is_file("../profileimage/bigimg/".$reciverNameSqlFetch['UserImage']))
																{
																	$upic = "images/nopic.jpg";
																}
																else
																{
																	$upic = "../profileimage/bigimg/".$reciverNameSqlFetch['UserImage'];
																}

																
																	
												?>
															
														<table class="table table-striped table-bordered table-hover" id="sample_2">
															<tr>
																<td width="10%" align="left" valign="top">
																	  <img src="<?=$upic?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												     </td>
															  <td width="90%">
															  <p style="margin-bottom:2px;">
															   <?php 
																if($sentSqlFetch['type']=='msg'){
																?>
																<a name="<?php echo $sentSqlFetch['message_id'];?>" href="userinfo.php?Uid=<?php echo $sentSqlFetch['message_receiver_id'];?>" style="color:#006600; font-weight:normal; font-size:18px;"><?php echo $reciverNameSqlFetch['FirstName'];?>&nbsp;<?php echo $reciverNameSqlFetch['LastName'];?><!--&nbsp;(&nbsp;<?php echo $reciverNameSqlFetch['UserName'];?>&nbsp;)--></a> 
																<?php }else if($sentSqlFetch['type']=='poke'){                               
																?>
																<a name="<?php echo $sentSqlFetch['message_id'];?>" href="userinfo.php?Uid=<?php echo $sentSqlFetch['message_receiver_id'];?>" style="color:#006600; font-weight:bold"><?php echo $reciverNameSqlFetch['FirstName'];?>&nbsp;<?php echo $reciverNameSqlFetch['LastName'];?>&nbsp;(&nbsp;<?php echo $reciverNameSqlFetch['UserName'];?>&nbsp;)</a><br />
																has received a peck from you.
																<?php }else if($sentSqlFetch['type']=='FrndReq'){                                
																?>
																<a name="<?php echo $sentSqlFetch['message_id'];?>" href="userinfo.php?Uid=<?php echo $sentSqlFetch['message_receiver_id'];?>" style="color:#006600; font-weight:bold"><?php echo $reciverNameSqlFetch['FirstName'];?>&nbsp;<?php echo $reciverNameSqlFetch['LastName'];?>&nbsp;(&nbsp;<?php echo $reciverNameSqlFetch['UserName'];?>&nbsp;)</a> <br />
																<?php } ?> 
																</p>
															  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
															   <p style="margin-bottom:0px;"><?=stripslashes($sentSqlFetch['message_subject'])?></p>
															  <p style="margin-bottom:5px; padding-top:2px;"><?php echo date('F d ,  Y',strtotime($sentSqlFetch['message_date']));?></p>
				 
																		  <?php
																			if($sentSqlFetch['type']=='msg')
																			{
																			?>
																			<a href="view_msg.php?p=3&message_id=<?php echo $sentSqlFetch['message_id'];?>&message_sender_id=<?php echo $sentSqlFetch['message_receiver_id'];?>&parent_id=<?php echo $sentSqlFetch['parent_id'];?>&Uid=<?=$_REQUEST['Uid']?>" style="color:#FF9900;font-size:12px;"><b>View Message</b></a>
																			<?php
																			}
																			else if($sentSqlFetch['type']=='FrndReq')
																			{
																				if($sentSqlFetch['user_friend_status']=='pending')
																				{
																			?>
																			<a href="home.php?ch=accepted&user_friend_id=<?php echo $sentSqlFetch['user_friend_id'];?>">Accept</a></span>&nbsp;/&nbsp;<a href="home.php?ch=rejected&user_friend_id=<?php echo $sentSqlFetch['user_friend_id'];?>" style="color:#ff0000;">Reject</a></span>&nbsp;&nbsp;<a href="msg_list.php?Del=del&message_id=<?php echo $sentSqlFetch['message_id'];?>&message_receiver_id=<?php echo $sentSqlFetch['message_receiver_id'];?>" style="color:#FF0000" onclick="javascript: return confirm('Are you sure you want to delete?');">Delete</a>
																			 <?php
																				}
																				else
																				{
																				?>
																				<a href="msg_list.php?Del=del&message_id=<?php echo $sentSqlFetch['message_id'];?>&message_receiver_id=<?php echo $sentSqlFetch['message_receiver_id'];?>" style="color:#FF0000" onclick="javascript: return confirm('Are you sure you want to delete?');">Delete</a>
																				<?php
																				}
																			 }
																			 else if($sentSqlFetch['type']=='poke')
																			 {
																			 ?> 
																			   <a href="msg_list.php?Del=del&message_id=<?php echo $sentSqlFetch['message_id'];?>&message_receiver_id=<?php echo $sentSqlFetch['message_receiver_id'];?>" style="color:#FF0000" onclick="javascript: return confirm('Are you sure you want to delete?');">Delete</a>
																			 <?php
																			 }
																			 ?> 
															  </td>
															</tr>
														</table>
															  
														<?php 
															$p++; } } else { echo"<p style='color:#ff0000;font-size:18px;'>No Sent Messag Availables!</p>"; }  
														?>
														<?php if($totnumrow>40) { ?>
														<table width="100%" cellpadding="0" cellspacing="0">			
															<tr>
															<td style="text-align:left; width:33%;">
															<?php
															if($pagenumber>1)
															{
															?>
															<a href="<?=$_SERVER['PHP_SELF']?>?page=1&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_66">&lt;&lt;</a>&nbsp;&nbsp;
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber-1; ?>&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_66">Prev</a>
															<?php
															}
															?>
															</td>
															<td style="text-align:center;width:33%;">
															<?php
															for($p=1;$p<=$totrow;$p++)
															{
															if($pagenumber==$p)
															{
															$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#0186a5;'";
															}
															else
															{
															$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#0186a5;'";
															}
															?>
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $p; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_66" <?php echo $sty ;?>><?php echo $p; ?></a>
															<?php
															}
															?>
															</td>
															<td align="right" style="text-align:right;width:33%;" >					
															<?php
															if($pagenumber<$totrow)
															{
															?>
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber+1; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_66">Next</a>&nbsp;&nbsp;
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $totrow; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_66">&gt;&gt;</a>
															<?php
															}
															?>
															</td>
															</tr>
															</table>
															<?php } ?>
														</div>
							
													  
												</div>

													</div>
												</div>
												
												<div class="tab-pane" id="tab_1_77">
														<div class="portlet-body" style="display: block;">

                                                       <?php
														$p=1;
														
														if($_REQUEST['unblock']=='unblock' && $_REQUEST['user_block_friend_id']!='')
														  {
															$unblockSql="delete from ".TABLE_PREFIX."user_block where user_block_friend_id='".$_REQUEST['user_block_friend_id']."' and user_block_user_id='".$_REQUEST['Uid']."'";
															if(mysql_query($unblockSql))
															{
																$_SESSION['msg']="Unblock operation ws successfull!!";
																header("Location:userinfo.php?Uid=".$_REQUEST['Uid']."#tab_1_77");
																exit();
															}
														  }
													
													$selectUnblockuserSql="select * from ".TABLE_PREFIX."user_block,".TABLE_PREFIX."user_registration where Uid=user_block_friend_id and user_block_user_id='".$_REQUEST['Uid']."'";
													$selectUnblockuserQuery=mysql_query($selectUnblockuserSql) or mysql_error();
													$selectUnblockuserNum=mysql_num_rows($selectUnblockuserQuery);
													/*--------------------------------------------------------------------------*/
													$user_id = $_REQUEST['Uid'];
															/*------------------Pegination Start------------------------------*/
														$rows_per_page=30;
															
														if(isset($_REQUEST['page']))
															{
																$pagenumber=$_REQUEST['page'];
															}
														else
															{
																$pagenumber=1;
															}
														$offset=($pagenumber-1)*$rows_per_page;
														
														$sqlPage="SELECT * FROM ".TABLE_PREFIX."recentvisitor WHERE recentvisitor_viewe_id='".$_REQUEST['Uid']."' order by recentvisitor_id DESC";
														$result=mysql_query($sqlPage) or mysql_error();
														$totnumrow=mysql_num_rows($result);
														$totrow=ceil($totnumrow/$rows_per_page);
								
														$friend_request="SELECT * FROM ".TABLE_PREFIX."recentvisitor WHERE recentvisitor_viewe_id='".$_REQUEST['Uid']."' order by recentvisitor_id DESC limit $offset,$rows_per_page";
														$res_friend_request=mysql_query($friend_request) or mysql_error();
														$num_friend_request=mysql_num_rows($res_friend_request);
													?>
												<div class="twelve columns">
													<div id="tablesec">
				
															<?php
																if($selectUnblockuserNum>0)
																	{
																		$sr=0;
																		while($selectUnblockuserFetch=mysql_fetch_array($selectUnblockuserQuery))
																		{	
																	
																	$friend_name="select * from ".TABLE_PREFIX."user_registration where Uid='".$selectUnblockuserFetch['user_block_friend_id']."' ";
																	$res_friend_name=mysql_query($friend_name);
																	$row_friend_name=mysql_fetch_array($res_friend_name);
																	
																	//For User Image
																	if($row_friend_name['UserImage'] == "")
																	{
																		$picusr = "images/nopic.jpg";
																	}
																	else if(!is_file("../profileimage/medium/".$row_friend_name['UserImage']))
																	{
																		$picusr = "images/nopic.jpg";
																	}
																	else
																	{
																		$picusr = "../profileimage/medium/".$row_friend_name['UserImage'];
																	}
																
														$onlinesqlr="select onlinestatus_user_id from ".TABLE_PREFIX."online_status as os where os.status='Y' and onlinestatus_user_id in(".$row_friend_name['Uid'].") group by onlinestatus_user_id";
														$res_memberssq=mysql_query($onlinesqlr) or mysql_error();
														$members_arr=mysql_num_rows($res_memberssq);
																
																	
												?>
															
														<table class="table table-striped table-bordered table-hover" id="sample_2">
															<tr>
																<td width="10%"   align="left" valign="top">
																	  <img src="<?=$picusr?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												  </td>
															  <td width="90%"><p style="margin-bottom:2px;"><a name="<?php echo $row_friend_name['Uid'];?>" href="userinfo.php?Uid=<?php echo $row_friend_name['Uid'];?>" style="color:#0078a5; font-weight:normal; font-size:18px;"><?=stripslashes($row_friend_name['UserName']);?></a></p>
															  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
															  <form name="sam2" action="" method="get">
															  <p style="margin-bottom:2px;"><?php echo date('F d ,  Y',strtotime($res_friend_fetch_1['recentvisitor_date']));?></p>
															  <p style="margin-bottom:2px;"><!--<a href="profile-view.php?view_user_id=<?=$row_friend_name['Uid']?>"  style=" color:#ff6600; height:29px;border:0px;display:inline;">Profile</a>&nbsp;--><a href="userinfo.php?unblock=unblock&user_block_friend_id=<?php echo $selectUnblockuserFetch['user_block_friend_id'];?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_77"><img src="img/umblock.png" alt="Wait..." style="width:30px;" /></a></p>
															  </form>
															  </td>
															</tr>
														</table>
				
														<?php $p++; } } else { ?><p style="color:#ff0000; font-size:16px; padding-left:27px;">No user block yet</p> <?php } ?>
														<?php if($totnumrow>30) { ?>
														<table width="100%" cellpadding="0" cellspacing="0">			
															<tr>
															<td style="text-align:left; width:33%;">
															<?php
															if($pagenumber>1)
															{
															?>
															<a href="<?=$_SERVER['PHP_SELF']?>?page=1&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_77">&lt;&lt;</a>&nbsp;&nbsp;
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber-1; ?>&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_77">Prev</a>
															<?php
															}
															?>
															</td>
															<td style="text-align:center;width:33%;">
															<?php
															for($p=1;$p<=$totrow;$p++)
															{
															if($pagenumber==$p)
															{
															$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#0186a5;'";
															}
															else
															{
															$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#0186a5;'";
															}
															?>
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $p; ?>" <?php echo $sty ;?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_77><?php echo $p; ?></a>
															<?php
															}
															?>
															</td>
															<td align="right" style="text-align:right;width:33%;" >					
															<?php
															if($pagenumber<$totrow)
															{
															?>
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber+1; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_77">Next</a>&nbsp;&nbsp;
															<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $totrow; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_77">&gt;&gt;</a>
															<?php
															}
															?>
															</td>
															</tr>
															</table>
															<?php } ?>
														</div>
							
													  
												</div>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane profile-classic row-fluid" id="tab_1_4">
										<div class="row-fluid">
											<div class="span profile-info">
												<h3>Edit Photo</h3>

								<div class="row">
										
												 <div class="twelve columns" style="display:none; margin-left:50px;" id="intimg2">
												  <table id="sample_2">
													<tr>
													  <td valign="top" style="padding-bottom:20px;">
														<div class="jc-demo-box" style="padding-top:5px;">
														
														  <img id="imgprvw" style="width:550px;"/>
														
														<div>
														
														
														
														  <!-- This is the form that our event handler fills -->
														 <form id="coords" class="coords" method="post" action="<?=$_SERVER['PHP_SELF']?>" onSubmit="return checkCoords();" enctype="multipart/form-data">
														 <input type="hidden" name="uid" value="<?=$_REQUEST['Uid']?>"/>
														 <div class="custom_file_upload" style="margin-left:5px;">
														   <div class="file_upload">
															<input type="file" name="image" id="filUpload" onChange="showimagepreview(this)" />
															</div>
														  </div>
															<div class="inline-labels">
																<input type="hidden" id="x" name="x" />
																<input type="hidden" id="y" name="y" />
																<input type="hidden" id="w" name="w" />
																<input type="hidden" id="h" name="h" />
															</div>
															<!--<input type="submit" name="submit" value="submit">-->
															<div class="submit" style="padding-left:5px;">
										
															<!--<input type="submit" class="button radius pull-right" name="submit" id="signup_submit" value="Update" style="float:left;" />-->
															<input type="image" src="../img/save_new.png"  name="Update" id="signup_submit" style="float:left; width:127px;"  />
														</div>
														  </form>
														
														</div>
														</div>
														<form method="post"  name="imageform" id="imageform" enctype="multipart/form-data" action='ajaximage.php' >
															<input type="hidden" name="oldimg" value="<?=$ArrFetchUser['uploads_filename']?>">
															
														
														<!--<div class="twelve columns" style="padding-top:15px;">
															<div class="editfield">
								
																<label for="field_18" style="font-size:20px; margin-bottom:17px;"><span style="color:#f7814d;">Change </span> Profile Image</label>
																<div class="form-group">
																			<div style="padding-bottom:0px;" id='preview'> 
																				<img id="uploadPreview" src="<?=$picpr?>"  style="width:200px;border:5px #999999 solid; border:moz-border-radius: 10px 10px 10px 10px; border-radius: 5px 5px 5px 5px;" />
																			 </div>
																			<p style=" margin-top:10px;"><span style="color:#f7814d;">Please upload</span>  (jpg, jpeg, gif, png) File Only.</p>
																				<div class="custom_file_upload" style="margin-left:5px;">
																				<div class="file_upload">
																				<input name="photoimg" id="photoimg" type="file" />
																				
																				</div>
																				</div>
																		</div>
								
															</div>				   
													   </div>-->
													   </form>
													  </td>
													</tr>
					
												  </table>
												 </div>
									
													<div style="padding-left:50px;">
													  <table width="100%" cellpadding="0" cellspacing="0" id="sample_2">
														<tr>
														  <td valign="top" style="padding-bottom:20px;">
														<?php
															$imageupload = "SELECT * FROM ".TABLE_PREFIX."user_uploads WHERE uploads_uid = '".$_REQUEST['Uid']."'";
															$res_friend_request = mysql_query($imageupload) or mysql_error();
															$num_friend_request = mysql_num_rows($res_friend_request);
														?>
																				<h5 style=" text-shadow:1px 1px 2px #ccc;"><i class="icon icon-user"></i> Image Gallery &nbsp;<?php if($num_friend_request<3) { ?><a href="#" id="intimg3">Add Image</a><?php } ?></h5>
																				<div class="twelve columns">
																				  <div id="tablesec">
																					<div class="avatar-block">
													
																						<div class="item-avatar" style="border-radius:2%;">
																							<?php 
																								$c=1;
																								while($row_friend_name = mysql_fetch_array($res_friend_request))
																								{  	
																			
																								
																								if($row_friend_name['uploads_filename'] == "")
																								{
																									$newmempic = "img/noimgnew.jpg";
																								}
																								else if(!is_file("../profileimage/smallimg/".$row_friend_name['uploads_filename']))
																								{
																									$newmempic = "img/noimgnew.jpg";
																								}
																								else
																								{
																									$newmempic = "../profileimage/smallimg/".$row_friend_name['uploads_filename'];
																								}
																								?>
																								<div style="display:inline; margin-right:5px;" class="imgtxt2">
																									<!--<a href="profile-view.php?view_user_id=<?=$row_friend_name['Uid']?>">-->
																								<div class="thumbs" style="display:inline;">
																									<img src="<?=$newmempic?>" class="avatar user-16500-avatar avatar- photo" alt="Online Member" style="width:140px;border:5px #ccc solid; border:moz-border-radius: 10px 10px 10px 10px; border-radius: 5px 5px 5px 5px;" />     
																									<div class="img_overlay">
																									  
																									  <?php  if($row_friend_name['status']!=1) { ?>
																									   <a  style="display:block;font-size:13px;" href="userinfo.php?uploads_id=<?=$row_friend_name['uploads_id']?>&set=proimg&Uid=<?=$_REQUEST['Uid']?>">
																										  <i class="icon icon-ban-circle"></i> Set Profile Image
																									  </a>
																									  <?php } else { ?>
																									  <a  style="display:block;font-size:13px; font-weight:bold;" href="#">
																										  <i class="icon icon-user"></i> Profile Image
																									  </a>
																									  <?php } ?>
																									   <a style="display:block;font-size:13px;" onclick="javascript:return confirm('Are you sure to delete image');" href="userinfo.php?uploads_id=<?=$row_friend_name['uploads_id']?>&del=delimg&Uid=<?=$_REQUEST['Uid']?>">
																										  <i class="icon icon-remove"></i> Delete Image
																									  </a>
																									
														</div>
														</div>
																									<!--</a>-->
																								
																								</div>
																								<? } ?>
																						</div>
													 
																					</div>
																				</div>
																				</div>
														  </td>
														</tr>
						
													  </table>
													</div>
					
												
								</div>
				
							</form>
													  </td>
													</tr>
					
												  </table>										
											</div>
										</div>
								</div>
								<!--end tab-pane-->
								<div class="tab-pane profile-classic row-fluid" id="tab_1_2">
										<div class="row-fluid">
											<div class="span profile-info">
												<h3>Subscription Detail</h3>
												<div class="col-md-12">

													   <?php
															//Fetch Subscription Id From order table
															$FetchUserSqlp = "SELECT * FROM ".TABLE_PREFIX."orderdetails WHERE Uid  = '".$_REQUEST['Uid']."' AND RegistrationNo = '".$rowdest7['RegistrationNo']."'";
															$FetchUserQueryp = mysql_query($FetchUserSqlp);
															$FetchRowsp = mysql_fetch_array($FetchUserQueryp);
															//Fetch Subscription
															$FetchUserSubSql = "SELECT * FROM ".TABLE_PREFIX."subscription WHERE subscription_Id = '".$FetchRowsp['subscription_Id']."'";
															$FetchUserSubQuery = mysql_query($FetchUserSubSql);
															$FetchRowsSub = mysql_fetch_array($FetchUserSubQuery);
													   ?>
															 <div class="table-responsive">
																  <table class="table table-striped table-bordered table-hover" id="sample_2">		
																	 <thead>
																	   <tr>
																		 <th colspan="2">Active Subscription <?=stripslashes($FetchRowsSub['subscription_name'])?></th>
																	   </tr>
																	 </thead>
																	 <tbody>
																	   <tr>
																		 <td><?=strip_tags(stripslashes($FetchRowsSub['subscription_description']))?>&nbsp;<a class="btn mini green-stripe" data-toggle="modal" href="#responssend">View <i class="icon-edit"></i></a> 
																		 <div id="responssend" class="modal hide fade dip" tabindex="-1" data-width="750">		 	
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
																			<h3>Subscription Description</h3>
																		</div>		
																			<div class="modal-body">
																				
																				<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
																					<div class="row-fluid">
																						<div class="span10">
																							
																						<div class="controls" style="padding-left:10px;">
																							
																										<div class="col-md-12 col-sm-12"><?=stripslashes($FetchRowsSub['subscription_name'])?>
																										<hr />
																											<?=stripslashes($FetchRowsSub['subscription_description'])?>
																										</div>
																					
											
																								</div>
																												
																						 </div>																
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" data-dismiss="modal" class="btn">Close</button>
																				<!--<input type="submit" class="btn blue" name="submit" value="Send" />-->
																			</div>
																	
																	</div>
																		
																		  </td>
																		 <td>Price : &pound;<?=number_format($FetchRowsSub['subscription_amount'],2)?></td>
																		 <td><!--<img src="../img/upgrade.jpg" style="width:150px;" />-->
																		 <a class="btn">
																			<i class="icon-ok-sign"></i>
																			Upgrade
																			</a>
																		 </td>
																	   </tr>
																	 </tbody>
																   </table>
																   </div>
																   <hr />
																	<h3>Upgrade Subscription</h3> 
																	<hr />
																   <div class="table-responsive">
																    <table class="table table-striped table-bordered table-hover" id="sample_2">
																	 <thead>
																	   <tr>
																		 <th>Subscription</th>
																		 <th>Description</th>
																		 <th>Amount</th>
																		 <th>Upgrade</th>
																	   </tr>
																	 </thead>
																	 <tbody>
																	 <?php
																			//Fetch Subscription
																			$j = 1;
																			$FetchUserSubSql2 = "SELECT * FROM ".TABLE_PREFIX."subscription WHERE subscription_Id NOT IN('".$FetchRowsSub['subscription_Id']."')";
																			$FetchUserSubQuery2 = mysql_query($FetchUserSubSql2);
																			while($FetchRowsSub2 = mysql_fetch_array($FetchUserSubQuery2)) {
																	   ?>
																	   <tr>
																	   <td><?=stripslashes($FetchRowsSub2['subscription_name'])?></td>
																		 <td><?=substr(strip_tags(stripslashes($FetchRowsSub2['subscription_description'])),0,100)?>...
																		 <a class="btn mini green-stripe" data-toggle="modal" href="#responssendk<?=$j?>" title="View full info of Subscription <?=stripslashes($FetchRowsSub2['subscription_name'])?>">View <i class="icon-edit"></i></a> 
																		 <div id="responssendk<?=$j?>" class="modal hide fade dip" tabindex="-1" data-width="750">		 	
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
																			<h3>Subscription Description</h3>
																		</div>		
																			<div class="modal-body">
																				
																				<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
																					<div class="row-fluid">
																						<div class="span10">
																							
																						<div class="controls" style="padding-left:10px;">
																							
																										<div class="col-md-12 col-sm-12"><?=stripslashes($FetchRowsSub2['subscription_name'])?>
																										<hr />
																											<?=stripslashes($FetchRowsSub2['subscription_description'])?>
																										</div>
																					
											
																								</div>
																												
																						 </div>																
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" data-dismiss="modal" class="btn">Close</button>
																				<!--<input type="submit" class="btn blue" name="submit" value="Send" />-->
																			</div>
																	
																	</div>
																		 
																			
																		  </td>
																		 <td>Price : &pound;<?=number_format($FetchRowsSub2['subscription_amount'],2)?></td>
																		 <td>
																		 <?php if($FetchRowsSub2['subscription_Id']%2=="0") { ?>
																		 <a class="btn blue" href="upgrade.php?subscription_Id=<?=$FetchRowsSub2['subscription_Id']?>" title="Upgrade To <?=stripslashes($FetchRowsSub2['subscription_name'])?>" >
																			<i class="icon-plus"></i>
																			Upgrade Now
																			</a>
																		 <?php } else { ?>
																		<a class="btn green" href="upgrade.php?subscription_Id=<?=$FetchRowsSub2['subscription_Id']?>" title="Upgrade To <?=stripslashes($FetchRowsSub2['subscription_name'])?>" >
																			<i class="icon-plus"></i>
																			Upgrade Now
																			</a>
																		 <?php } ?>
																		   </td> 
																		 
																	   </tr>
																	   <?php $j++; } ?>
																	 </tbody>
																   </table>
																   </div>
												   </div>												
											</div>
										</div>
								</div>
								<!--tab_1_2-->
								<div class="tab-pane row-fluid profile-account" id="tab_1_3">
									<div class="row-fluid">
										<div class="span12">
										<?php
											$p=1;
											$user_id = $_REQUEST['Uid'];
												/*------------------Pegination Start------------------------------*/
											$rows_per_page=30;
												
											if(isset($_REQUEST['page']))
												{
													$pagenumber=$_REQUEST['page'];
												}
											else
												{
													$pagenumber=1;
												}
											$offset=($pagenumber-1)*$rows_per_page;
											
											$sqlPage="SELECT * FROM ".TABLE_PREFIX."recentvisitor WHERE recentvisitor_viewe_id='".$_REQUEST['Uid']."' order by recentvisitor_id DESC";
											$result=mysql_query($sqlPage) or mysql_error();
											$totnumrow=mysql_num_rows($result);
											$totrow=ceil($totnumrow/$rows_per_page);
					
											$friend_request="SELECT * FROM ".TABLE_PREFIX."recentvisitor WHERE recentvisitor_viewe_id='".$_REQUEST['Uid']."' order by recentvisitor_id DESC limit $offset,$rows_per_page";
											$res_friend_request=mysql_query($friend_request) or mysql_error();
											$num_friend_request=mysql_num_rows($res_friend_request);
											
											$viewProfSqlCtn="SELECT * FROM ".TABLE_PREFIX."recentvisitor WHERE recentvisitor_viewe_id='".$_REQUEST['Uid']."'";
											$viewProfSqlQueryCtn=mysql_query($viewProfSqlCtn) or mysql_error();
											$numCtnProArr = mysql_num_rows($viewProfSqlQueryCtn);
										?>
										<h3>Who viewed my profile [<?=$numCtnProArr?>]</h3>
										</div>
										
										<div class="twelve columns">
									<div id="tablesec">

											<?php
												if($num_friend_request>0) {
												while($res_friend_fetch_1=mysql_fetch_array($res_friend_request))
												{  	
													
													$friend_name="select * from ".TABLE_PREFIX."user_registration where Uid='".$res_friend_fetch_1['recentvisitor_viewer_id']."' ";
													$res_friend_name=mysql_query($friend_name);
													$row_friend_name=mysql_fetch_array($res_friend_name);
													
													//For User Image
													if($row_friend_name['UserImage'] == "")
													{
														$picusr = "images/nopic.jpg";
													}
													else if(!is_file("../profileimage/medium/".$row_friend_name['UserImage']))
													{
														$picusr = "images/nopic.jpg";
													}
													else
													{
														$picusr = "../profileimage/medium/".$row_friend_name['UserImage'];
													}
										$onlinesqlr="select onlinestatus_user_id from ".TABLE_PREFIX."online_status as os where os.status='Y' and onlinestatus_user_id in(".$row_friend_name['Uid'].") group by onlinestatus_user_id";
										$res_memberssq=mysql_query($onlinesqlr) or mysql_error();
										$members_arr=mysql_num_rows($res_memberssq);
												
													
								?>
											
										   <table class="table table-striped table-bordered table-hover" id="sample_2">
											<tr >
												<td width="10%"   align="left" valign="top">
													  <img src="<?=$picusr?>" class="img_thumb" style="width:85px; margin-top:0px; border:2px solid #999999" border="0"/>												  </td>
											  <td width="90%"><p style="margin-bottom:2px;"><a name="<?php echo $row_friend_name['Uid'];?>" href="userinfo.php?Uid=<?php echo $row_friend_name['Uid'];?>" style="color:#0078a5; font-weight:normal; font-size:18px;"><?=stripslashes($row_friend_name['UserName']);?></a></p>
											  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
											  <form name="sam2" action="" method="get">
											  <p style="margin-bottom:2px;"><?php echo date('F d ,  Y',strtotime($res_friend_fetch_1['recentvisitor_date']));?></p>
											  <!--<p style="margin-bottom:2px;"><a href="" title="Sent Email" data-reveal-id="message_panel<?=$c?>"><img src="../img/emailnew.png" alt="Wait..." style="width:30px;" /></a>&nbsp; &nbsp; <a href="#" title="Chat Now"><img src="../img/chatint.png" alt="Wait..." style="width:30px;" /></a>&nbsp; &nbsp; <a title="Show interest" href="#"><img style="width:24px;border-radius: 0%;display:inline;" src="../img/showint.png">
</a>&nbsp; &nbsp; <a href="profile-view.php?view_user_id=<?=$row_friend_name['Uid']?>" title="View info of <?php echo ucfirst($row_friend_name['FirstName']);?>"><img src="../img/view_new.png" alt="Wait..." style="width:40px;" /></a><?php if($members_arr2>0) { ?>&nbsp; &nbsp; <img alt="Wait..." src="../img/online.png" style="border-radius: 0%;display:inline;" /><?php } else { ?>&nbsp; &nbsp; <img alt="Wait..." src="../img/offline.png" style="border-radius: 0%;display:inline;" /><?php } ?><input name="sender" id="sender" type="hidden" value="<?=$row_friend_name['Uid']?>" />	</p>-->
											  </form>
											  </td>
											</tr>
										</table>

										<?php $p++; } } else { ?><p style="color:#ff0000; font-size:16px; padding-left:27px;">Profile Not Viewed Yet!</p> <?php } ?>
										<?php if($totnumrow>30) { ?>
										   <table class="table table-striped table-bordered table-hover" id="sample_2">		
											<tr>
											<td style="text-align:left; width:33%;">
											<?php
											if($pagenumber>1)
											{
											?>
											<a href="<?=$_SERVER['PHP_SELF']?>?page=1&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_3">&lt;&lt;</a>&nbsp;&nbsp;
											<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber-1; ?>&perpage=<?=$_REQUEST['perpage']?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_3">Prev</a>
											<?php
											}
											?>
											</td>
											<td style="text-align:center;width:33%;">
											<?php
											for($p=1;$p<=$totrow;$p++)
											{
											if($pagenumber==$p)
											{
											$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px; color:#0186a5;'";
											}
											else
											{
											$sty="style='text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#0186a5;'";
											}
											?>
											<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $p; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_3" <?php echo $sty ;?>><?php echo $p; ?></a>
											<?php
											}
											?>
											</td>
											<td align="right" style="text-align:right;width:33%;" >					
											<?php
											if($pagenumber<$totrow)
											{
											?>
											<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $pagenumber+1; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_3">Next</a>&nbsp;&nbsp;
											<a href="<?=$_SERVER['PHP_SELF']?>?page=<?php echo $totrow; ?>&Uid=<?=$_REQUEST['Uid']?>#tab_1_3">&gt;&gt;</a>
											<?php
											}
											?>
											</td>
											</tr>
											</table>
											<?php } ?>
										</div>
			
									  
								</div>
									</div>
								</div>
								<!--end tab-pane-->
                                                                <!--tab_1_2-->
								<div class="tab-pane row-fluid profile-account" id="tab_1_7">
									<div class="row-fluid">
										<div class="span12">
                                            <h3 style="color:#ff0000;">No Records Availables!</h3>                                   
										</div>
									</div>
								</div>
								<!--end tab-pane-->
								
								
								<div class="tab-pane" id="tab_1_6">
									<!--end add-portfolio-->
									<div class="row-fluid portfolio-block">
										<h3 style="color:#ff0000;">No Records Availables!</h3>															
									<!--end row-fluid-->
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
<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
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