<?php include"lib/header.php";
		
			
				//Insert User Registration			  
			if($_REQUEST['submit']=="Update")
			{	
				$uid = $_REQUEST['uid'];                         
				$fname = $_REQUEST['firstname'];     
				$lname = $_REQUEST['lastname'];
				$username = mysql_real_escape_string(stripslashes($_REQUEST['UserName']));
				$email = mysql_real_escape_string(stripslashes($_REQUEST['email']));
				//$password = mysql_real_escape_string(stripslashes($_REQUEST['password']));  
				$Gender = $_REQUEST['Gender'];
				$Password = $_REQUEST['LookingForGender'];
				$dateofbirth = explode("/",$_REQUEST['dateofbirth']);
				$bdate = $dateofbirth[2]."-".$dateofbirth[0]."-".$dateofbirth[1];
				$Country = addslashes($_REQUEST['MaritalStatus']);
				$State = $_REQUEST['user_country'];
				$Address = $_REQUEST['user_state'];	
				$City = $_REQUEST['City'];
				$Phone = addslashes($_REQUEST['Occupation']);
				
				$Fax = addslashes($_REQUEST['Ethnicity']);
				$ZipCode = addslashes($_REQUEST['BodyType']);
				$BusinessName = $_REQUEST['EyeColor'];
				$TradingName = $_REQUEST['HairColor'];
				$BusinessAddress = addslashes($_REQUEST['Smoke']);
				$Website = addslashes($_REQUEST['Drink']);
				
				
				
				
				if($_FILES['image']['name']!=''){
							
								$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_REQUEST['uid']."'";
								$unlink_rs = mysql_query($unlink_sql) or mysql_error();
								$row_unlink = mysql_fetch_array($unlink_rs);
								
								$photo = "../profileimage/fullsize/".$row_unlink['UserImage'];
								$thumb = "../profileimage/bigimg/".$row_unlink['UserImage'];
								$thumb1 = "../profileimage/smallimg/".$row_unlink['UserImage'];
								$thumb2 = "../profileimage/medium/".$row_unlink['UserImage'];
								$thumb3 = "../profileimage/extbig/".$row_unlink['UserImage'];
								
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
				}

				$InsertRegSql="UPDATE ".TABLE_PREFIX."user_registration SET                 
																				FirstName = '".$fname."' ,
																				LastName = '".$lname."' ,
																				UserName = '".$username."' , 
																				UserImage = '".$imagename."' ,  
																				Gender = '".$Gender."' , 
																				Password = '".$Password."' , 
																				Country = '".$Country."' ,
																				State = '".$State."' ,  
																				Country = '".$Country."' ,
																				State = '".$State."' , 
																				City = '".$City."' ,
																				Phone = '".$Phone."' ,  
																				Fax = '".$Fax."' ,
																				ZipCode = '".$ZipCode."' ,
																				BusinessName = '".$EyeColor."' ,
																				TradingName = '".$TradingName."' ,
																				BusinessAddress = '".$BusinessAddress."' ,
																				Website = '".$Website."' 
																				where Uid = '".$uid."' 
																				";
																				
				mysql_query($InsertRegSql) or mysql_error();
					

						echo '<script language="javascript">';
						echo 'window.location="userlist.php?mess=successful"';
						echo '</script>';
						
						
			}
			
			//Fetch User Details
			$Uid = $_REQUEST['uid'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."user_registration  WHERE Uid = '".$Uid."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$ArrFetchUser = mysql_fetch_array($FetchUserQuery);
			
			if($ArrFetchUser['UserImage'] == "")
				{
					$pic = "images/nopic.jpg";
				}
				else if(!is_file("../profileimage/bigimg/".$ArrFetchUser['UserImage']))
				{
					$pic = "images/nopic.jpg";
				}
				else
				{
					$pic = "../profileimage/bigimg/".$ArrFetchUser['UserImage'];
				}	
			
?>	
<!-- END LightBox View -->

	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include"lib/leftbar.php";?>	<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- <div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div> -->
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
						</h3>
						<ul class="breadcrumb">
						 <li>
							<i class="icon-home"></i>
							<a href="dashboard.php">Home</a> 
							<span class="icon-angle-right"></span>
						 </li>
						 <li>
							<a href="userlist.php">User List</a> 
							<span class="icon-angle-right"></span>
						 </li>
						 <li>
							<a href="userinfo.php?Uid=<?=$_REQUEST['uid']?>">User Info</a> 
							<span class="icon-angle-right"></span>
						 </li>
						<li><a href="#"><?=$pagetitle?></a></li>
					  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					<?php
					  if($mess!='')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						<?=$mess?>
					  </div>
					  <?php
					  }
					  if($_REQUEST['mess'] == 'successfulupdate')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully User Info Updated...
					  </div>
					  <?php
					  }
					  if($_REQUEST['mess'] == 'unsuccessful')
					  {
					  ?>
					  <div class="alert alert-error">
						<button data-dismiss="alert" class="close"></button>
						E-Mail Address already exists.Please try another one!
					  </div>
					  <?php
					  }
					  ?>
					  
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- Statr Page body-->
				         
			<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i><?=$pagetitle?></div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							
                        <div>&nbsp;</div>
					<!-- BEGIN FORM-->
					<form class="fm_bottom" name="userdetailinfo2" id="userdetailinfo2" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" onsubmit="return check();">	
					<input type="hidden" name="uid" value="<?=$_REQUEST['uid']?>" />
										<div class="row-fluid">
										   <div class="span6">																	
                                            <div class="control-group" style="margin-bottom:0px;">
                                              <label class="control-label">First Name <span style="color:#ff0000;">*</span></label>
                                               <div class="controls">
                                                  <input type="text" class="span m-wrap"  name="firstname" id="firstname" value="<?=$ArrFetchUser['FirstName']?>" />
                                                </div>
                                               </div>
                                               
                                              <div class="control-group" style="margin-bottom:0px;">											  
                                                         <label class="control-label">Email <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="text"  name="email" id="email" class="span m-wrap" value="<?=$ArrFetchUser['EmailId']?>" />
                                                           </div>
                                                    </div>	
                                               
                                             <!--<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Password <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="password" name="password" id="password" class="span m-wrap"  />
                                                           </div>
                                                    </div>-->
													
													 <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">I am</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="Gender" id="Gender">
																<option>--Gender--</option>
																<option <?php if($ArrFetchUser['Gender']=="Male") { echo"selected"; } ?>>Male</option>
																<option <?php if($ArrFetchUser['Gender']=="Female") { echo"selected"; } ?>>Female</option>
															</select>
                                                           </div>
                                                    </div>	
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Country</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="user_country" id="user_country">

                                                              <!--<option value="">Select Country</option>-->
                                                              <?php 
																			$countrysql="select * from ".TABLE_PREFIX."country where fld_id IN('222')";
																			$countrysqlquery=mysql_query($countrysql) or mysql_error();
																			while($countrysqlfetch=mysql_fetch_array($countrysqlquery))
																			{
																			?>
                                                              <option value="<?=$countrysqlfetch['fld_id']?>" <?php if($ArrFetchUser['Country']==$countrysqlfetch['fld_id']) { ?> selected="selected" <?php } ?>>
                                                                <?=$countrysqlfetch['fld_name']?>
                                                              </option>
                                                              <?php } ?>
                                                            </select>
                                                           </div>
                                                    </div>	
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Counties</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="user_state" id="user_state">

																<option value="">Select State</option>
																<?php 
																		$statesql="select * from ".TABLE_PREFIX."state WHERE cntryId IN('222')";
																		$statesqlquery=mysql_query($statesql) or mysql_error();
																		while($statesqlfetch=mysql_fetch_array($statesqlquery))
																		{
																		?>
																<option value="<?=$statesqlfetch['State_id']?>"  <?php if($ArrFetchUser['State']==$statesqlfetch['State_id']) echo "selected";?>>
																<?=$statesqlfetch['State_name']?>
																</option>
																<?php } ?>
															  </select>
                                                           </div>
                                                    </div>	
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Occupation</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="Occupation" id="Occupation">

															<option value="">Select </option>
															<option value="Administrative/Secretarial" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Administrative/Secretarial") { echo "selected"; } ?>> Administrative/Secretarial </option>
															<option value="Artist/Musician/Writer" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Artist/Musician/Writer") { echo "selected"; } ?>> Artist/Musician/Writer </option>
															<option value="Student" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Student") { echo "selected"; } ?>> Student </option>
															<option value="Executive Management" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Executive Management") { echo "selected"; } ?>> Executive Management </option>
															<option value="Finance" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Finance") { echo "selected"; } ?>> Finance </option>
															<option value="Food Services" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Food Services") { echo "selected"; } ?>> Food Services </option>
															<option value="Labor/Construction" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Labor/Construction") { echo "selected"; } ?>> Labor/Construction </option>
															<option value="Legal" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Legal") { echo "selected"; } ?>> Legal </option>
															<option value="Medical/Dental" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Medical/Dental") { echo "selected"; } ?>> Medical/Dental </option>
															<option value="Other" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Other") { echo "selected"; } ?>> Other </option>
															<option value="Political/Government" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Political/Government") { echo "selected"; } ?>> Political/Government </option>
															<option value="Retired" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Retired") { echo "selected"; } ?>> Retired </option>
															<option value="Sales & Marketing" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Sales & Marketing") { echo "selected"; } ?>> Sales & Marketing </option>
															<option value="Self Employed" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Self Employed") { echo "selected"; } ?>> Self Employed </option>
															<option value="Student" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Student") { echo "selected"; } ?>> Student </option>
															<option value="Teacher/Professor" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Teacher/Professor") { echo "selected"; } ?>> Teacher/Professor </option>
															<option value="Technique/Science/Engineering" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Technique/Science/Engineering") { echo "selected"; } ?>> Technique / Science / Engineering </option>
															<option value="Transportation" <?php if(stripslashes($ArrFetchUser['Occupation'])=="Transportation") { echo "selected"; } ?>> Transportation </option>
															</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Eye Color</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="EyeColor" id="EyeColor">
																<option value="Black" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Black") { echo "selected"; } ?>> Black </option>
																<option value="Blue" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Blue") { echo "selected"; } ?>> Blue </option>
																<option value="Brown" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Brown") { echo "selected"; } ?>> Brown </option>
																<option value="Green" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Green") { echo "selected"; } ?>> Green </option>
																<option value="Grey" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Grey") { echo "selected"; } ?>> Grey </option>
																<option value="Hazel" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Hazel") { echo "selected"; } ?>> Hazel </option>
																<option value="Violet" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Violet") { echo "selected"; } ?>> Violet </option>
																<option value="Other" <?php if(stripslashes($ArrFetchUser['EyeColor'])=="Other") { echo "selected"; } ?>> Other </option>
															</select>
                                                           </div>
                                                    </div>
													
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Hair Color</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="HairColor" id="HairColor">
																	<option value="Brown" <?php if(stripslashes($ArrFetchUser['HairColor'])=="Brown") { echo "selected"; } ?>> Brown </option>
																	<option value="Blonde" <?php if(stripslashes($ArrFetchUser['HairColor'])=="Blonde") { echo "selected"; } ?>> Blonde </option>
																	<option value="Black"<?php if(stripslashes($ArrFetchUser['HairColor'])=="Black") { echo "selected"; } ?>> Black </option>
																	<option value="Red" <?php if(stripslashes($ArrFetchUser['HairColor'])=="Red") { echo "selected"; } ?>> Red </option>
																	<option value="Auburn" <?php if(stripslashes($ArrFetchUser['HairColor'])=="Auburn") { echo "selected"; } ?>> Auburn </option>
																	<option value="Grey" <?php if(stripslashes($ArrFetchUser['HairColor'])=="Grey") { echo "selected"; } ?>> Grey </option>
																	<option value="White" <?php if(stripslashes($ArrFetchUser['HairColor'])=="fgWhitedf") { echo "selected"; } ?>> White </option>
																	<option value="Other"<?php if(stripslashes($ArrFetchUser['HairColor'])=="Other") { echo "selected"; } ?>> Other </option>
																	</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Smoke</label> 
                                                        <div class="controls relative"> 
                                                           <select class="span m-wrap" name="Smoke" id="Smoke">
																	<option value="I have never smoked" <?php if(stripslashes($ArrFetchUser['Smoke'])=="I have never smoked") { echo "selected"; } ?>> I have never smoked </option>
																	<option value="I do not smoke" <?php if(stripslashes($ArrFetchUser['Smoke'])=="I do not smoke") { echo "selected"; } ?>> I do not smoke </option>
																	<option value="I smoke socially" <?php if(stripslashes($ArrFetchUser['Smoke'])=="I smoke socially") { echo "selected"; } ?>> I smoke socially  </option>
																	<option value="I smoke regularly" <?php if(stripslashes($ArrFetchUser['Smoke'])=="I smoke regularly") { echo "selected"; } ?>> I smoke regularly </option>
																	<option value="I am a heavy sm" <?php if(stripslashes($ArrFetchUser['Smoke'])=="I am a heavy sm") { echo "selected"; } ?>> I am a heavy sm </option>
																	
																	</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Image <span style="color:#ff0000;">*</span>
                                                      </label>
													  <div class="controls">
														 <div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="fileupload-new thumbnail" style="width: 200px;">
															   <img src="<?=$pic?>" alt="" />
															</div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
															<div>
															   <span class="btn btn-file"><span class="fileupload-new">Select Picture</span>
															   <span class="fileupload-exists">Change</span>
															   <input type="file" class="default" name="image" onchange="checkFile(this)" /></span>
															   <input type="hidden" name="oldimg" value="<?=$ArrFetchUser['UserImage']?>" />
															   <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
														 </div>
													  </div>
                                                      <span style="font-size:12px; margin-bottom:10px;">Format : jpg, jpeg, png</span>
												   </div>		
											</div>
											<div class="span6">
													
													 <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Last Name <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <input type="text" class="span m-wrap" name="lastname"  id="lastname" value="<?=$ArrFetchUser['LastName']?>" />
														</div>
													   </div>
                                                    
													<div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">User Name <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <input type="text" class="span m-wrap" name="UserName" id="UserName" value="<?=$ArrFetchUser['UserName']?>" readonly="" />
														</div>
													   </div>
													
                                                  <!-- <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Confirm Password <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="password"  name="cpassword" id="cpassword" class="span m-wrap" />
                                                           </div>
                                                    </div>-->	
                                                    
                                                    <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Looking for</label> 
                                                        <div class="controls relative"> 
                                                          <select class="span m-wrap" name="LookingForGender" id="LookingForGender">
																<option>--Looking For--</option>
																<option <?php if($ArrFetchUser['LookingForGender']=="Male") { echo"selected"; } ?>>Male</option>
																<option <?php if($ArrFetchUser['LookingForGender']=="Female") { echo"selected"; } ?>>Female</option>
															</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Marital Status</label> 
                                                        <div class="controls relative"> 
                                                          <select  class="span m-wrap" name="MaritalStatus" id="MaritalStatus">
																<option value="">--Choose Marital Status--</option>
																<option value="Single" <?php if($ArrFetchUser['MaritalStatus']=="Single") { echo"selected"; } ?>>Single</option>
																<option value="Living together" <?php if($ArrFetchUser['MaritalStatus']=="Living together") { echo"selected"; } ?>>Living together</option>
																<option value="Married" <?php if($ArrFetchUser['MaritalStatus']=="Married") { echo"selected"; } ?>>Married</option>
																<option value="Separated" <?php if($ArrFetchUser['MaritalStatus']=="Separated") { echo"selected"; } ?>>Separated</option>
																<option value="Divorced" <?php if($ArrFetchUser['MaritalStatus']=="Divorced") { echo"selected"; } ?>>Divorced</option>
																<option value="Widowed" <?php if($ArrFetchUser['MaritalStatus']=="Widowed") { echo"selected"; } ?>>Widowed</option>
																<option value="Prefer not to say" <?php if($ArrFetchUser['MaritalStatus']=="Prefer not to say") { echo"selected"; } ?>>Prefer not to say</option>									
																</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                         <label class="control-label">City</label> 
                                                        <div class="controls relative"> 
                                                            <input type="text"  name="City" id="City" class="span m-wrap" value="<?=$ArrFetchUser['City']?>" />
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Ethnicity</label> 
                                                        <div class="controls relative"> 
                                                          <select  class="span m-wrap" name="Ethnicity" id="Ethnicity">
																	<option value="White/Caucasian" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="White/Caucasian") { echo "selected"; } ?>> White/Caucasian </option>
																	<option value="Latin/Hispanic" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Latin/Hispanic") { echo "selected"; } ?>> Latin/Hispanic </option>
																	<option value="Black/African Descent" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Black/African Descent") { echo "selected"; } ?>> Black/African Descent </option>
																	<option value="Asian" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Asian") { echo "selected"; } ?>> Asian </option>
																	<option value="Middle Eastern" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Middle Eastern") { echo "selected"; } ?>> Middle Eastern </option>
																	<option value="East Indian" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="East Indian") { echo "selected"; } ?>> East Indian </option>
																	<option value="Islander" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Islander") { echo "selected"; } ?>> Islander </option>
																	<option value="Native American" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Native American") { echo "selected"; } ?>> Native American </option>
																	<option value="Other" <?php if(stripslashes($ArrFetchUser['Ethnicity'])=="Other") { echo "selected"; } ?>> Other </option>
																	</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Body Type</label> 
                                                        <div class="controls relative"> 
                                                          <select  class="span m-wrap" name="BodyType" id="BodyType">
															<option value="A few extra pounds" <?php if(stripslashes($ArrFetchUser['BodyType'])=="A few extra pounds") { echo "selected"; } ?>> A few extra pounds </option>
															<option value="Athletic" <?php if(stripslashes($ArrFetchUser['BodyType'])=="Athletic") { echo "selected"; } ?>> Athletic </option>
															<option value="Average" <?php if(stripslashes($ArrFetchUser['BodyType'])=="Average") { echo "selected"; } ?>> Average </option>
															<option value="Curvy" <?php if(stripslashes($ArrFetchUser['BodyType'])=="Curvy") { echo "selected"; } ?>> Curvy </option>
															<option value="Muscular" <?php if(stripslashes($ArrFetchUser['BodyType'])=="Muscular") { echo "selected"; } ?>> Muscular </option>
															<!--<option value="Overweight" <?php if(stripslashes($ArrFetchUser['BodyType'])=="Overweight") { echo "selected"; } ?>> Overweight </option>-->
															<option value="Slim" <?php if(stripslashes($ArrFetchUser['BodyType'])=="Slim") { echo "selected"; } ?>> Slim </option>
															</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Drink</label> 
                                                        <div class="controls relative"> 
                                                          <select  class="span m-wrap" name="Drink" id="Drink">
																	<option value="I never drink" <?php if(stripslashes($ArrFetchUser['Drink'])=="I never drink") { echo "selected"; } ?>> I never drink </option>
																	<option value="I rarely drink" <?php if(stripslashes($ArrFetchUser['Drink'])=="I rarely drink") { echo "selected"; } ?>> I rarely drink </option>
																	<option value="I drink socially" <?php if(stripslashes($ArrFetchUser['Drink'])=="I drink socially") { echo "selected"; } ?>> I drink socially </option>
																	<option value="I drink regularly" <?php if(stripslashes($ArrFetchUser['Drink'])=="I drink regularly") { echo "selected"; } ?>> I drink regularly </option>
																	<option value="I am a heavy drinker" <?php if(stripslashes($ArrFetchUser['Drink'])=="I am a heavy drinker") { echo "selected"; } ?>> I am a heavy drinker </option>
																	<option value="I am trying to quit" <?php if(stripslashes($ArrFetchUser['Drink'])=="Other") { echo "selected"; } ?>> I am trying to quit </option>
																	</select>
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                         <label class="control-label">Date of Birth </label> 
                                                        <div class="controls relative">
														<?php
															$dat = explode("-",$ArrFetchUser['BirthDate']);
															$dt = $dat[1]."/".$dat[2]."/".$dat[0];
														?> 
                                                            <input type="text"  name="dateofbirth" id="dateofbirth" class="span m-wrap m-ctrl-medium date-picker" value="<?=$dt?>" />
                                                           </div>
                                                    </div>
													
													<div class="control-group" style="margin-bottom:0px;">											  
                                                         <label class="control-label">Height (cm)</label> 
                                                        <div class="controls relative"> 
                                                            <input type="text" name="Height" id="Height" value="<?=$ArrFetchUser['Height']?>" class="span m-wrap" />
                                                           </div>
                                                    </div>
													
													
													
                                                     <div class="control-group" style="margin-bottom:0px;">
                                                  <label class="control-label" >Email Verification </label>
                                                    <div class="controls">                                                
                                                       <label class="radio">
                                                       <input type="radio" name="EmailVerification" value="Yes" <?php if($ArrFetchUser['EmailVerification']=="Yes") { ?>checked="checked" <?php } ?> />
                                                       Yes
                                                       </label>
                                                       <label class="radio">
                                                       <input type="radio" name="EmailVerification" value="No" <?php if($ArrFetchUser['EmailVerification']=="No") { ?>checked="checked" <?php } ?> />
                                                       No
                                                       </label>  
                                                    </div>
                                               </div>
                                               
                                               <div class="control-group" style="margin-bottom:0px;">
                                                  <label class="control-label" >User Status</label>
                                                    <div class="controls">                                                
                                                       <label class="radio">
                                                       <input type="radio" name="UserStatus" value="Yes" <?php if($ArrFetchUser['UserStatus']=="Yes") { ?>checked="checked" <?php } ?> />
                                                       Yes
                                                       </label>
                                                       <label class="radio">
                                                       <input type="radio" name="UserStatus" value="No" <?php if($ArrFetchUser['UserStatus']=="No") { ?>checked="checked" <?php } ?> />
                                                       No
                                                       </label>  
                                                    </div>
                                               </div>
               																	
										</div>
											<div class="span12"><label class="control-label" >Hobbies</label>
												<table style="width:100%" border="0">
																<?php
																	$hobbies_array=explode(",",$ArrFetchUser['Hobbies']);
																?>
																  <tr> 
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Art" <?php if(in_array('Art',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Art																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Auto Racing/Motorcross" <?php if(in_array('Auto Racing/Motorcross',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Auto Racing/ Motorcross																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Baseball" <?php if(in_array('Baseball',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Baseball																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Basketball" <?php if(in_array('Basketball',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Basketball																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Billards/Pool" <?php if(in_array('Billards/Pool',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Billards/Pool																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Boating/Sailing" <?php if(in_array('Boating/Sailing',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Boating/Sailing																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Books/Literature" <?php if(in_array('Books/Literature',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Books/Literature																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Bowling" <?php if(in_array('Bowling',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Bowling																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Business/Networking" <?php if(in_array('Business/Networking',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Business/Networking																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Camping/Outdoors" <?php if(in_array('Camping/Outdoors',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Camping/Outdoors																	</td>                                            
																	<td> 
																		<input type="checkbox" name="hobbie[]"  value="Coffee/Conversation"  <?php if(in_array('Coffee/Conversation',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Coffee/Conversation																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Cooking" <?php if(in_array('Cooking',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Cooking																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Cycling" <?php if(in_array('Cycling',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Cycling																	</td>                                            
																	<td>
																		<input  type="checkbox" name="hobbie[]"  value="Dancing" <?php if(in_array('Dancing',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Dancing																	</td>                                            
																	<td>
																		<input  type="checkbox" name="hobbie[]"  value="Dining Out" <?php if(in_array('Dining Out',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Dining Out																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Exercise" <?php if(in_array('Exercise',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Exercise																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Exploring New Places" <?php if(in_array('Exploring New Places',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Exploring New Places																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Fishing/Hunting" <?php if(in_array('Fishing/Hunting',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Fishing/Hunting																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Football" <?php if(in_array('Football',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Football																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Gardening/Landscaping" <?php if(in_array('Gardening/Landscaping',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Gardening/ Landscaping																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Golf" <?php if(in_array('Golf',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Golf																	</td>                                            
																</tr>                                            
																<td>
																		<input type="checkbox" name="hobbie[]"  value="Hockey" <?php if(in_array('Hockey',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Hockey																	</td>                                           
																	 <td>
																		<input type="checkbox" name="hobbie[]"  value="Horticulture" <?php if(in_array('Horticulture',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Horticulture																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Martial Arts" <?php if(in_array('Martial Arts',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Martial Arts																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Movies/Cinema" <?php if(in_array('Movies/Cinema',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Movies/Cinema																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Museums" <?php if(in_array('Museums',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Museums																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Music/Concerts" <?php if(in_array('Music/Concerts',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Music/Concerts																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Nightclubs/Dancing" <?php if(in_array('Nightclubs/Dancing',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Nightclubs/ Dancing																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Performing Arts" <?php if(in_array('Performing Arts',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Performing Arts																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Playing Cards" <?php if(in_array('Playing Cards',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Playing Cards																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Playing Sports" <?php if(in_array('Playing Sports',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Playing Sports																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Political Interests" <?php if(in_array('Political Interests',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Political Interests																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Religion/Spiritual" <?php if(in_array('Religion/Spiritual',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Religion/ Spiritual																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Running" <?php if(in_array('Running',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Running																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Shopping/Antiques" <?php if(in_array('Shopping/Antiques',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Shopping/ Antiques																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Skating" <?php if(in_array('Skating',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Skating																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Skiing" <?php if(in_array('Skiing',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Skiing																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Soccer" <?php if(in_array('Soccer',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Soccer																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Swimming" <?php if(in_array('Swimming',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Swimming																	</td>                                            
																	</tr>                                            
																	<td>
																		<input  type="checkbox" name="hobbie[]"  value="Tennis/Racquet Sport" <?php if(in_array('Tennis/Racquet Sport',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Tennis/ Racquet Sport																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Travel/Sightseeing" <?php if(in_array('Travel/Sightseeing',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Travel / Sightseeing																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Video Games" <?php if(in_array('Video Games',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Video Games																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Volleyball" <?php if(in_array('Volleyball',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Volleyball																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Volunteering/Charities" <?php if(in_array('Volunteering/Charities',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Volunteering/ Charities																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Walking/Hiking" <?php if(in_array('Walking/Hiking',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Walking / Hiking																	</td>                                            
																	</tr>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Watching Sport" <?php if(in_array('Watching Sport',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Watching Sport																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Weights/Machines" <?php if(in_array('Weights/Machines',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Weights/Machines																	</td>                                            
																	<td>
																		<input type="checkbox" name="hobbie[]"  value="Wine Tasting" <?php if(in_array('Wine Tasting',$hobbies_array)) { ?> checked="checked" <?php } ?> />&nbsp;Wine Tasting																	</td>                                            
																</tr> 
																<tr>
																<td colspan="4">
																		<input type="checkbox" name="hobbie[]"  value="Yoga" <?php if(in_array('Yoga',$hobbies_array)) { ?> checked="checked" <?php } ?> style="cursor:pointer;" />&nbsp;Yoga																	</td>  
																</tr>                             
																</table>
											</div>
											
											<div class="span11" style="margin-top:15px;">
														<div class="editfield">
							
															<label for="field_18">Headline</label>
															<textarea  name="Headline" id="Headline"  /><?=stripslashes($ArrFetchUser['Headline'])?> </textarea>
														</div>
												   </div>
											<div class="span11" style="margin-top:15px;">
														<div class="editfield">
							
															<label for="field_18">Description</label>
															<textarea  name="Description" id="Description"  /><?=stripslashes($ArrFetchUser['Description'])?> </textarea>
														</div>
												   </div>
												   
													
											</div>
														
										</div>
																	
									  </div>
									<div class="modal-footer" style="text-align:left;">
										<input type="submit" class="btn blue" name="submit" value="Update" />
									</div>							
						</form>
					<!-- END FORM-->           
				 </div>
							</div>
						</div>
						<!-- END EXAMPLE TABLE PORTLET-->
					</div>
				</div>
				
				<!-- END PAGE CONTENT-->
				<!-- End Page Body-->
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<?php include "lib/footer.php"; ?>
	</div>   
<!--	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>  
	<script src="assets/scripts/ui-modals.js"></script> -->
	<script src="assets/scripts/form-components.js"></script>
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<!--   	<script src="assets/scripts/table-managed.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>--> 
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
     <script  language="javascript" src="../js/frm_validator.js"></script>
	<script type="text/javascript" language="javascript1.2">
    function check()
    { 
		if(frmValidate('userdetailinfo2','firstname','First Name','YES','')==false)
            {
                return false;
            }
		if(frmValidate('userdetailinfo2','lastname','Last Name','YES','')==false)
            {
                return false;
            }
        if(frmValidate('userdetailinfo2','email','Email','YES','')==false)
            {
                return false;
            }
        if(ChkEmail('userdetailinfo2','email')==false)
            {
                return false;
            }
        if(frmValidate('userdetailinfo2','UserName','User Name','YES','')==false)
            {
                return false;
            }
			
		if(frmValidate('userdetailinfo2','password','Password','YES','')==false)
            {
                return false;
            }
		if(frmValidate('userdetailinfo2','cpassword','Confirm Password','YES','')==false)
            {
                return false;
            }
			
		if(document.userdetailinfo2.password.value!=document.userdetailinfo2.cpassword.value)
		{
			alert('Please Check Your Confirm Password');
			document.userdetailinfo2.cpassword.value="";
			document.userdetailinfo2.cpassword.focus();
			focus(document.userdetailinfo2.cpassword.value);
			return false;
		}
	    if(frmValidate('userdetailinfo2','image',' Image','YES','')==false)
            {
                return false;
            }
		//Checkin Image	
		var fieldObj = document.userdetailinfo2.image;
		var FileName  = fieldObj.value;
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
		//Calculate File size.
		var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);

        if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
        {
           var error = "File type : "+ FileExt+"\n\n";
            error += "Size: " + iConvert2 + " MB \n\n";
            error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
            alert(error);
			/*var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
            alert(error);*/
            return false;
        }
        return true;
		//End Checkin image
			
    }
	    function check1()
			{ 
				if(frmValidate('userdetailinfo21','firstname','First Name','YES','')==false)
					{
						return false;
					}
				if(frmValidate('userdetailinfo21','lastname','Last Name','YES','')==false)
					{
						return false;
					}
					
					//Checkin Image	
					var fieldObj = document.userdetailinfo2.image;
					var FileName  = fieldObj.value;
					var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
					var FileSize = fieldObj.files[0].size;
					var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
					//Calculate File size.
					var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
			
					if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
					{
					    var error = "File type : "+ FileExt+"\n\n";
						error += "Size: " + iConvert2 + " MB \n\n";
						error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
						alert(error);
						/*var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
						alert(error);*/
						return false;
					}
					return true;
					//End Checkin image
			}
		   function checkFile(fieldObj)
			{
				var FileName  = fieldObj.value;
				var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
				var FileSize = fieldObj.files[0].size;
				var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
				//Calculate File size.
				var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
		
				if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
				{
				   var error = "File type : "+ FileExt+"\n\n";
					error += "Size: " + iConvert2 + " MB \n\n";
					error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
					alert(error);
					/*var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
					alert(error);*/
					return false;
				}
				return true;
			}
    </script> 
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		  // UIModals.init();
		   //TableManaged.init();
		   tinymce.init({
			selector: "textarea",
			plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   toolbar: "insertfile undo redo | styleselect | bold italic | fontselect | fontsizeselect | sizeselect |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
		   style_formats: [
				{title: 'Bold text', inline: 'b'},
				{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
				{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
				{title: 'Example 1', inline: 'span', classes: 'example1'},
				{title: 'Example 2', inline: 'span', classes: 'example2'},
				{title: 'Table styles'},
				{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			]

		});
		FormComponents.init();
		});
	
	/********************Delete****************/
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delvideo.php',{ feedid : id, mode : 'single' },
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
	function delselected()
	{
		var feed = document.getElementsByName('feed[]');
		
		var ln = feed.length;
		
		var flag = 0;
		var str = "";
		
		for(i=0;i<ln;i++)
		{
			if(feed[i].checked)
			{
				str = str + feed[i].value + ',';
			}
		}
		
		if(str != "")
		{
			var cnf = confirm("Are you sure to delete?");
		
			if(cnf)
			{
				$('.portlet .tools a.reload').click();
				$.post('ajax/delvideo.php',{ feedids : str , mode : 'selected' },
					function(data)
					{
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
		else
		{	
			alert('You must select atleast one item');
		}
	}
		/********************Status****************/
	function changestatus(stat,id)
	{
		$.post('ajax/statusvideo.php',{ stat : stat , id : id });
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>