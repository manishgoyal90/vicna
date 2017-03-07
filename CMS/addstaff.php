<?php include"lib/header.php";
		
		define ("MAX_SIZE","1000000"); 
	function getExtension($str)
	{
		 $i = strrpos($str,".");
		 if (!$i) { return ""; }
		 $l = strlen($str) - $i;
		 $ext = substr($str,$i+1,$l);
		 return $ext;
	}
		
				//Insert User Registration			  
			if($_REQUEST['submit']=="Save")
			{	                         
				$fname = $_REQUEST['firstname'];     
				$lname = $_REQUEST['lastname']; 
				$email = mysql_real_escape_string(stripslashes($_REQUEST['email']));
				$password = mysql_real_escape_string(stripslashes($_REQUEST['password']));  
				$Phone = $_REQUEST['Phone'];
				$Address = addslashes($_REQUEST['Address']);
				
				
				
				
								//Registration No.
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date('d-m-Y g:i:s a');
				$usercreationdate = date('Y-m-d');
				/* unicId */
				$year = date('Y');
				$fetId = mysql_fetch_array(mysql_query("SELECT * FROM staff_cliend_id WHERE id = '1'"));
				if($year == $fetId['year'])
				{
					$RegistrationNo = $fetId['lastId'] + 1;
					$update = mysql_query("UPDATE staff_cliend_id SET lastId = '".$RegistrationNo."' WHERE id = '1'");
				}else{
					$lastId = $year.'000';
					$update = mysql_query("UPDATE staff_cliend_id SET year = '".$year."', lastId = '".$lastId."' WHERE id = '1'");
					$fetId = mysql_fetch_array(mysql_query("SELECT * FROM staff_cliend_id WHERE id = '1'"));
					$RegistrationNo = $fetId['lastId'] + 1;
					$update = mysql_query("UPDATE staff_cliend_id SET lastId = '".$RegistrationNo."' WHERE id = '1'");
					
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
				$CheckEmailSql = "SELECT EmailId FROM ".TABLE_PREFIX."staff_registration WHERE EmailId = '".$email."'";
				$CheckEmailQuery=mysql_query($CheckEmailSql) or mysql_error();
				$CheckEmailRow=mysql_num_rows($CheckEmailQuery);
				$dob = date('Y-m-d', strtotime($_REQUEST['dob']));
				$qualification = $_REQUEST['qualification'];
			
				if($CheckEmailRow=="0")
				{
				
				$image=$_FILES['image']['name'];
				
				if ($image) 
				{
					$filename = stripslashes($_FILES['image']['name']);
					$extension = getExtension($filename);
					$extension = strtolower($extension);
					if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")  
						&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
						&& ($extension != "PNG") && ($extension != "GIF")   ) 
					{
						$msg_upload= 'Unknown extension! Not uploaded.';
						$errors=1;
					}
					else
					{
						$size=filesize($_FILES['image']['tmp_name']);
				 
						if ($size > MAX_SIZE*1024)
						{
							$msg_upload= 'You have exceeded the size limit!';
							$errors=1;
						}
				 
						$image_name=time().'.'.$extension;
						//$image_name="prof-".$_SESSION["userid"].'.'.$extension;
						$newname="../profileImage/".$image_name;
				 
						$copied = copy($_FILES['image']['tmp_name'], $newname);
						if (!$copied) 
						{
							$msg_upload= 'Copy unsuccessfull!';
							$errors=1;
						}
						else 
						{
							//mysql_query("UPDATE hr_staff_registration SET UserImage = '".$image_name."' WHERE Uid='".$_SESSION["userid"]."'");
							//$msg_upload= '<font color="green">uploaded successfull!</font>';
						}
				
					}
				 
					
				}

			$InsertRegSql="INSERT INTO ".TABLE_PREFIX."staff_registration SET                 
																				FirstName = '".$fname."' ,
																				LastName = '".$lname."' ,
																				EmailId = '".$email."' ,
																				RegistrationNo = '".$RegistrationNo."' ,  
																				IpAddress ='" . $ip . "', 
																				UserImage = '".$image_name."' ,  
																				Address = '".$Address."' , 
																				dob = '".$dob."',
																				qualification = '".$qualification."',  
																				mobile = '".$Phone."' , 
																				Password 	= '".base64_encode($password)."' , 
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
													 <a href='$activationlink?email=".base64_encode($email)."&type=staff'><button style='border-radius:10px;height:30px;cursor:pointer;   background-color: #A1D347;'>ACTIVATE ACCOUNT</button></a>
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
										echo 'window.location="staff.php?mess=successful"';
										echo '</script>';
										}
						}

						else
						{
						 $mess = "E-Mail/User Name already exists.Try another one! ";
						}
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
							<a href="staff.php">Staff List</a> 
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
                                              <label class="control-label">First Name <span style="color:#ff0000;">*</span></label>
                                               <div class="controls">
                                                  <input type="text" class="span m-wrap"  name="firstname" id="firstname" value="<?=$_REQUEST['firstname']?>" />
                                                </div>
                                               </div>
                                               
                                              <div class="control-group" style="margin-bottom:0px;">											  
                                                         <label class="control-label">Email <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="text"  name="email" id="email" class="span m-wrap" value="" />
                                                           </div>
                                                    </div>	
                                               
                                             <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Password <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="password" name="password" id="password" class="span m-wrap"  />
                                                           </div>
                                                    </div>
													
											<div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">date of Birth <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="text" name="dob" id="dob" class="span m-wrap" placeholder="dd-mm-yyyy" />
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
														  <input type="text" class="span m-wrap" name="lastname"  id="lastname" value="<?=$_REQUEST['lastname']?>" />
														</div>
													   </div>
                                                     <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Phone <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <input type="text" class="span m-wrap" name="Phone"  id="Phone" value="<?=$_REQUEST['Phone']?>" />
														</div>
													   </div>
													
                                                   <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Confirm Password <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="password"  name="cpassword" id="cpassword" class="span m-wrap" />
                                                           </div>
                                                    </div>	
                                                    
													
													
													   
													    <div class="control-group" style="margin-bottom:0px;">
													  <label class="control-label">Address <span style="color:#ff0000;">*</span></label>
													   <div class="controls">
														  <input type="text" class="span m-wrap" name="Address"  id="Address" value="<?=$_REQUEST['Address1']?>" />
														</div>
													   </div>
													   <div class="control-group" style="margin-bottom:0px;">											  
                                                          <label class="control-label">Qualification <span style="color:#ff0000;">*</span></label> 
                                                        <div class="controls relative"> 
                                                            <input type="text" name="qualification" id="qualification" class="span m-wrap" placeholder="RN/EEN/PCA" />
                                                           </div>
                                                    </div>

													
                                                 <div class="control-group" style="margin-bottom:0px;">
                                                  <label class="control-label" >Email Verification </label>
                                                    <div class="controls">                                                
                                                       <label class="radio">
                                                       <input type="radio" name="EmailVerification" value="Yes" />
                                                       Yes
                                                       </label>
                                                       <label class="radio">
                                                       <input type="radio" name="EmailVerification" value="No" checked="checked" />
                                                       No
                                                       </label> 
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