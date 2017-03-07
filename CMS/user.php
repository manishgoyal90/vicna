<?php include"lib/header.php";
		
			
				//Insert User Registration			  
			if($_REQUEST['submit']=="Save")
			{	                         
				$fname = $_REQUEST['firstname'];     
				$lname = $_REQUEST['lastname']; 
				$businessName = $_REQUEST['business_name'];
				$username = $_REQUEST['username'];
				$email = mysql_real_escape_string(stripslashes($_REQUEST['email']));
				$password = mysql_real_escape_string(stripslashes($_REQUEST['password']));  
				$Phone = $_REQUEST['Phone'];
				$Address = addslashes($_REQUEST['Address']);
				
				
				$oldimg = $_REQUEST['oldimg']; 
				
								//Registration No.
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date('d-m-Y g:i:s a');
				$usercreationdate = date('Y-m-d');
				/* unicId */
				/*$prefix = "USR" . date("y") . date("m");
				$pl = strlen($prefix);
				$ql = $pl + 1;
				$rn = "SELECT MAX(SUBSTR(RegistrationNo,$ql)) FROM " . TABLE_PREFIX . "user_registration where RegistrationNo like '%$prefix%'";
				$res_rn = mysql_query($rn);
				$row_rn = mysql_fetch_array($res_rn);
				$id = $row_rn['0'];
				$id = $id + 1;
				$leadingzeros = '00000';
				$RegistrationNo = $prefix . substr($leadingzeros, 0, (-strlen($id))) . $id;*/ 
				
				$year = date('Y');
				$fetId = mysql_fetch_array(mysql_query("SELECT * FROM staff_cliend_id WHERE id = '2'"));
				if($year == $fetId['year'])
				{
					$RegistrationNo = $fetId['lastId'] + 1;
					$update = mysql_query("UPDATE staff_cliend_id SET lastId = '".$RegistrationNo."' WHERE id = '2'");
				}else{
					$lastId = $year.'000';
					$update = mysql_query("UPDATE staff_cliend_id SET year = '".$year."', lastId = '".$lastId."' WHERE id = '2'");
					$fetId = mysql_fetch_array(mysql_query("SELECT * FROM staff_cliend_id WHERE id = '2'"));
					$RegistrationNo = $fetId['lastId'] + 1;
					$update = mysql_query("UPDATE staff_cliend_id SET lastId = '".$RegistrationNo."' WHERE id = '2'");
					
				}
				
				// 13 Digit Random number generate function
				function randomPrefix($length) 
				{ 
				$random= "";
				srand((double)microtime()*1000000);
				
				$data = "AbcDE123IJKLMN67QRSTUVWXYZ"; 
				$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; 
				$data .= "0FGH45OP89";
				
				for($i = 0; $i < $length; $i++) 
				{ 
				$random .= substr($data, (rand()%(strlen($data))), 1); 
				}
				
				return $random; 
				}
				
				randomPrefix(13); 
				$rand=randomPrefix(13);
				$rand; 
				
				//Checking Email Unique//
				$CheckEmailSql = "SELECT EmailId FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$email."'";
				$CheckEmailQuery=mysql_query($CheckEmailSql) or mysql_error();
				$CheckEmailRow=mysql_num_rows($CheckEmailQuery);

			
				if($CheckEmailRow=="0")
				{
				
				/*	if($_FILES['image']['name']!=''){
							
							$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."user_registration WHERE Uid = '".$_SESSION['userid']."'";
								$unlink_rs = mysql_query($unlink_sql) or mysql_error();
								$row_unlink = mysql_fetch_array($unlink_rs);
								
								$photo = "profileimage/fullsize/".$row_unlink['UserImage'];
								$thumb = "profileimage/bigimg/".$row_unlink['UserImage'];
								$thumb1 = "profileimage/smallimg/".$row_unlink['UserImage'];
								$thumb2 = "profileimage/medium/".$row_unlink['UserImage'];
								$thumb3 = "profileimage/extbig/".$row_unlink['UserImage'];
								
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
											$path = '../profileimage/' . $imagename;
											
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
											
											
											
											imagedestroy($dstImg);
											
											
										} else {
											echo 'unknown problem!';
									} 

					
				}  else {
					$imagename = $oldimg;	
				}
				*/
			$InsertRegSql="INSERT INTO ".TABLE_PREFIX."user_registration SET                 
																				FirstName = '".$fname."' ,
																				LastName = '".$lname."' ,
																				BusinessName = '".$businessName."',
																				UserName = '".$username."',
																				EmailId = '".$email."' ,
																				RegistrationNo = '".$RegistrationNo."' ,  
																				IpAddress ='" . $ip . "', 
																				UserImage = '".$imagename."' ,  
																				Address = '".$Address."' ,   
																				Phone = '".$Phone."' , 
																				Password = '".base64_encode($password)."',
																				RegistDate = NOW() , 
																				EmailVerification = '".$_REQUEST['EmailVerification']."' ,												
																				UserStatus = '".$_REQUEST['UserStatus']."' 
																				";
																				
				mysql_query($InsertRegSql) or mysql_error();
					
				require_once('../class.phpmailer.php');
							
										$adminMail = mysql_fetch_array(mysql_query("SELECT MailAddress FROM hr_admin_mail WHERE MailId = '1'"));
										$noreply = $adminMail['MailAddress'];

										
										$mail = new PHPMailer(); // defaults to using php "mail()"
										
										//$body             = file_get_contents('contents.html');
										
										$mailbody = "<table align='center' style='width:700px; height:600px;'>
										<tbody><tr>
											<td>
											  <table align='center' background='$siteimg/background.jpg' style='width:650px; text-align:center; height:500px;'>
												<tbody><tr style='height:50px;'>
												 
												<td valign='middle' colspan='2'>
												<img src='$siteimg/logo.png'></td>
												
												</tr>
												
												<tr>
												 <td valign='top' align='center' colspan='2'>
													<table style='height:308px; color:#FFF; width:380px;'>
													 <tbody>
													 <tr height='20%'>
													  <td colspan='3' style='font-size:28px;'>
													 Hello $fname
													  </td>
													  
													 </tr>
													 <tr height='20%'>
													  <td colspan='3' style='font-size:28px;'>
													 Registered Email : ".$email."<br/>
													 Password : ".$password."
													  </td>
													  
													 </tr>
													 <tr height='20%'>
													  
													  <td colspan='3'>Welcome to Vicna. With one click, you can activate your account and using the site.</td>
													 </tr>
													 
													  <tr>
													  <td colspan='3' style='font-size: 14px;'>
													  You <a href='#' style='color:#CCFA00; text-decoration:none;'>MUST</a> click this <a href='#' style='color:#CCFA00; text-decoration:none;cursor:pointer;'>ACTIVATION</a> link to enter the site
													  </td>
													  
													 </tr>
													 
													 <tr>
													 <td>&nbsp;</td>
													  <td colspan='2'>
													 <a href='$activationlink?email=".base64_encode($email)."&type=user'><button style='border-radius:10px;height:30px;cursor:pointer;   background-color: #A1D347;'>ACTIVATE ACCOUNT</button></a>
													  </td>
													  
													 </tr>
													 <tr>
													  <td colspan='3' style='font-size:13px'><br></td>
													  
													 </tr>
													</tbody></table>
												</td>
												
												</tr>
												 
											 </tbody></table>
										</td>
									</tr>
									
									</tbody></table>";
										
										$mail->SetFrom($noreply, "Vicna");
										
										//$address = $email;
										
										$mail->AddAddress($email, "Vicna");
										
										$mail->Subject    = "Welcome to Vicna Account Activation!";
										
										$mail->AltBody    = "Account Activation Mail"; // Alt Body
										
										//$mail->MsgHTML($body);
										
										$mail->Body = $mailbody;
										
										//$mail->AddAttachment("images/logo5.png");      // attachment
		
										
										if(!$mail->Send()) {
										  echo "Mailer Error: " . $mail->ErrorInfo;
										} else {
										  /*echo "A test email sent to your email address '".$email."' Please Check Email and Spam too.";
										  echo '<meta http-equiv="refresh" content="5;url=http://www.computersneaker.com">';*/
										  echo '<script language="javascript">';
										echo 'window.location="userlist.php?mess=successful"';
										echo '</script>';
										}
						
						
						
						
						}

						else
						{
						 $mess = "E-Mail/User Name already exists.Try another one! ";
						}
			}
			
			//Fetch User Details
			$Uid = $_REQUEST['Uid'];
			
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
					   if($_REQUEST['mess'] == 'successful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully User Added...
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
							<div class="portlet-body">
								<!--<div class="table-toolbar">
									 <div class="btn-group">
										<a class="btn blue" href="AddVideo.php">Add New <i class="icon-plus"></i></a>
									</div>
                                    <div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
									</button>
									<ul class="dropdown-menu">
										<li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
									</ul>
								    </div>
								</div>-->
						<div class="portlet-body">
                        <div>&nbsp;</div>
					<!-- BEGIN FORM-->
					<form class="fm_bottom" name="userdetailinfo2" id="userdetailinfo2" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" onsubmit="return check();">	
										<div class="row-fluid">
										   <div class="span6">																	
                                            <div class="control-group" style="margin-bottom:0px;">
                                              <label class="control-label">Company/Trust/Client Name* <span style="color:#ff0000;">*</span></label>
                                               <div class="controls">
                                                  <input type="text" class="span m-wrap"  name="client_name" id="firstname" value="" />
                                                </div>
                                               </div>
											   
											    <div class="control-group" style="margin-bottom:0px;">
                                              <label class="control-label">Trading as <span style="color:#ff0000;">*</span></label>
                                               <div class="controls">
                                                  <input type="text" class="span m-wrap"  name="trading_as" id="trading_as" value="" />
                                                </div>
                                               </div>
                                               
                                              <div class="control-group" style="margin-bottom:0px;">											  
                                                         <label class="control-label">Email <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="text"  name="email" id="email" class="span m-wrap" value="" />
                                                           </div>
                                                    </div>	
													
											  <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Street Address <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <textarea class="span m-wrap" name="street_address"  id="street_address" rows="4" ></textarea>
														</div>
													   </div>
                                                       <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Website <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <textarea class="span m-wrap" name="website"  id="website" rows="4" ></textarea>
														</div>
													   </div>
                                                       <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Upload photo / Logo <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <input type="file" class="span m-wrap" name="client_file"  id="client_file" />
														</div>
													   </div>
                                               
                                            <!-- <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Password <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="password" name="password" id="password" class="span m-wrap"  />
                                                           </div>
                                                    </div>-->

													
													<!--<div class="control-group" style="margin-bottom:0px;">
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
															   <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
														 </div>
													  </div>
                                                      <span style="font-size:12px; margin-bottom:10px;">Format : jpg, jpeg, png</span>
												   </div>-->		
											</div>
											<div class="span6">
													
													 <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">ABN <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <input type="text" class="span m-wrap" name="abn"  id="abn" value="" />
														</div>
													   </div>
                                                    
													
                                                
                                                    
													 <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Contact person(s) <span style="color:#ff0000;">*</span> <a onclick="return contact_person();"> Add New</a></label>
													   <div class="controls">
												 <div id="contact_person_field_reapeater">
    <div id="contact_person_p_1" class="contact_person_class">
    <select name="contact_person[]"  onChange="check_contact_person(this.value);" style="width:55%" >
    	<option value="Manager">Manager</option>
        <option value="Admin">Admin</option>
        <option value="Payroll">Payroll</option>
        <option value="Nurse In-Charge">Nurse In-Charge</option>
        <option value="Other">Other</option>
    </select>
        &nbsp;&nbsp;<div id="other_contact_person1"></div> <input type="email" name="contact_person_email[]" placeholder="Enter Email ID" style="width:50%"   value="" /> <a onclick = "return delete_field(1);" style="cursor:pointer">Delete</a></div> 
  </div>
  <p id="contact_person_limit_msg" style="color:red"></p>		 
														</div>
                                                        <div style="clear:both"></div>
													   </div>
													    <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">postal Address  <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls">
														  <textarea class="span m-wrap" name="postal_address"  id="postal_address" rows="4" ></textarea>
														</div>
                                                    </div> 
													 
													 <div class="control-group" style="margin-bottom:0px;">
                                                      <label class="control-label">Phone Number  <span style="color:#ff0000;">*</span></label> 
                                                 <div id="phone_number_div">
                                                 <button type="button" class="r-btnAdd">Add +</button>
        <div class="r-group">
               <select name="contact_person[]"  onChange="check_contact_person(this.value);" style="width:55%"  >
    	<option value="Manager">Manager</option>
        <option value="Admin">Admin</option>
        <option value="Payroll">Payroll</option>
        <option value="Nurse In-Charge">Nurse In-Charge</option>
        <option value="Other">Other</option>
    </select> <!--<input type="text" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" />-->
                <input type="text" name="vehicle[0][type]" id="vehicle_0_type" data-pattern-name="vehicle[++][type]" data-pattern-id="vehicle_++_type" />
            <p>
                <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                <button type="button" class="r-btnRemove">Remove -</button>
            </p>
        </div>
        
    </div>
                                               </div>  
													  
													
                                                 <div class="control-group" style="margin-bottom:0px;">
                                                  <label class="control-label" >Fax Number(s)</label>
                                                    <div id="fax_number_div">
                                                 <button type="button" class="r-btnAdd">Add +</button>
        <div class="r-group">
               <select name="contact_person[]"  onChange="check_contact_person(this.value);" style="width:55%"  >
    	<option value="Manager">Manager</option>
        <option value="Admin">Admin</option>
        <option value="Payroll">Payroll</option>
        <option value="Nurse In-Charge">Nurse In-Charge</option>
        <option value="Other">Other</option>
    </select> <!--<input type="text" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" />-->
                <input type="text" name="vehicle[0][type]" id="vehicle_0_type" data-pattern-name="vehicle[++][type]" data-pattern-id="vehicle_++_type" />
            <p>
                <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                <button type="button" class="r-btnRemove">Remove -</button>
            </p>
        </div>
        
    </div>
                                               </div>
                                               <div class="control-group" style="margin-bottom:0px;">
                                                  <label class="control-label" >Email(s)</label>
                                                    <div id="email_div">
                                                 <button type="button" class="r-btnAdd">Add +</button>
        <div class="r-group">
               <select name="contact_person[]"  onChange="check_contact_person(this.value);" style="width:55%"  >
    	<option value="Manager">Manager</option>
        <option value="Admin">Admin</option>
        <option value="Payroll">Payroll</option>
        <option value="Nurse In-Charge">Nurse In-Charge</option>
        <option value="Other">Other</option>
    </select> <!--<input type="text" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" />-->
                <input type="text" name="vehicle[0][type]" id="vehicle_0_type" data-pattern-name="vehicle[++][type]" data-pattern-id="vehicle_++_type" />
            <p>
                <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                <button type="button" class="r-btnRemove">Remove -</button>
            </p>
        </div>
        
    </div>
                                               </div>
                                               
                                               <div class="control-group" style="margin-bottom:0px;">
                                                  <label class="control-label" >User Status</label>
                                                    <div class="controls">                                                
                                                       <label class="radio">
                                                       <input type="radio" name="UserStatus" value="Yes" />
                                                       Yes
                                                       </label>
                                                       <label class="radio">
                                                       <input type="radio" name="UserStatus" value="No" checked="checked" />
                                                       No
                                                       </label>  
                                                    </div>
                                               </div>
               																	
										</div>
												   
													
											</div>
														
										</div>
																	
									  </div>
									<div class="modal-footer" style="text-align:left;">
										<input type="submit" class="btn blue" name="submit" value="Save" />
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
			selector: "#textarea",
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

 <script type="text/javascript" language="javascript">

		var field_sr = 1;
	function contact_person(){
			field_sr++;
			var numItems = $('.contact_person_class').length;
			if(numItems <10){
			//var field_html = '<p id="contact_person_p_'+field_sr+'"  class="contact_person_class"><input type="text"   name="organization_position[]"  placeholder="date"  style="width:30%"> <input type="email" name="contact_person_email[]" placeholder="Contact person email id" style="width:50%" /> <a onclick = "return delete_field('+field_sr+');"  style="cursor:pointer">Delete</a></p>';
			
			var field_html = '<div style="clear:both"></div><div id="contact_person_p_'+field_sr+'" class="contact_person_class" style="float:left"><select name="contact_person[]"  onChange="check_contact_person(this.value);" style="width:65%" ><option value="Manager">Manager</option><option value="Admin">Admin</option><option value="Payroll">Payroll</option><option value="Nurse In-Charge">Nurse In-Charge</option><option value="Other">Other</option></select>&nbsp;&nbsp;<div id="other_contact_person1"></div> <input type="email" name="contact_person_email[]" placeholder="Enter Email ID" style="width:50%"   value="" /> <a onclick = "return delete_field('+field_sr+');" style="cursor:pointer">Delete</a></div>';
			$("#contact_person_field_reapeater").append(field_html);
			$("#contact_person_limit_msg").html("");
			}else{
				$("#contact_person_limit_msg").html("Max 9 Contact Number allowed.");
			}
		}
		
	function delete_field(pid){
		$("#contact_person_p_"+pid).remove();
		$("#contact_person_limit_msg").html("");
	}
	

</script>
<script type="text/javascript" src="js/jquery.form-repeater.js"></script>
<script type="text/javascript">
 $(document).removeClass(function() {
  $('#phone_number_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
   $('#fax_number_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
   $('#email_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
  });
  </script>

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>