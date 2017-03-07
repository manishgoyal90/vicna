<?php include"lib/header.php";

//Add New User
if($_REQUEST['submitdetail']  == 'Save')
{   
				//Registration No.
			   $timezone = "Asia/Calcutta";
				if (function_exists('date_default_timezone_set'))
					date_default_timezone_set($timezone);
				$ip = $_SERVER['REMOTE_ADDR'];
				$date = date('d-m-Y g:i:s a');
				$usercreationdate = date('Y-m-d');
				/* unicId */
				$prefix = "USR" . date("y") . date("m");
				$pl = strlen($prefix);
				$ql = $pl + 1;
				$rn = "SELECT MAX(SUBSTR(RegistrationNo,$ql)) FROM " . TABLE_PREFIX . "staff_registration where RegistrationNo like '%$prefix%'";
				$res_rn = mysql_query($rn);
				$row_rn = mysql_fetch_array($res_rn);
				$id = $row_rn['0'];
				$id = $id + 1;
				$leadingzeros = '00000';
				$RegistrationNo = $prefix . substr($leadingzeros, 0, (-strlen($id))) . $id;
						           	
				$fname = $_REQUEST['fname'];
				$lname = $_REQUEST['lname'];
				$email = $_REQUEST['email'];
				$password = $_REQUEST['password'];
				$phone = $_REQUEST['phone'];
				$zipcode = $_REQUEST['zipcode'];
				$address = addslashes($_REQUEST['address']);
				
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
				
				$fname = $_REQUEST['firstname'];
				$lname = $_REQUEST['lastname'];
				$email = $_REQUEST['email'];
				$password = base64_encode($_REQUEST['password']);
				$phone = $_REQUEST['phnumber'];
				$zipcode = $_REQUEST['zipcode'];
				$address = addslashes($_REQUEST['address']);
				
				//Checking Email Unique//
				$CheckEmailSql = "SELECT EmailId FROM ".TABLE_PREFIX."staff_registration WHERE EmailId = '".$email."'";
				$CheckEmailQuery=mysql_query($CheckEmailSql) or mysql_error();
				$CheckEmailRow=mysql_num_rows($CheckEmailQuery);
			
			
				if($CheckEmailRow=="0")
				{
					if($_FILES['image']['name']!=''){
						
				
					//Image uploadin start.
					$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
					$max_file_size = 2000 * 1024; #200kb
					$imgwidth = 200;
					$imgheight =  200;
					
					$imgwidth2 = 100;
					$imgheight2 =  100;
					
						if (isset($_FILES['image']) ) {
								$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
								if (in_array($ext, $valid_exts)) {
										//Upload image path...
										$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
										
										$path = '../profileimage/bigimg/' . $imagename;
										$path1 = '../profileimage/smallimg/' . $imagename;
										$pathfull = '../profileimage/fullsize/' . $imagename;
										
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
										
										//Upload image full size...
										@copy($tmp,$pathfull);
										
										imagedestroy($dstImg);
										imagedestroy($dstImg1);
										//echo "<img src='$pathfull' />";
										
									} else {
											echo 'unknown problem!';
									}
						}
					}

									
						$InsertRegSql="INSERT INTO ".TABLE_PREFIX."staff_registration  SET
																						RegistrationNo = '".$RegistrationNo."' ,
																						IpAddress ='" . $ip . "', 
																						FirstName = '".$fname."' ,
																						LastName = '".$lname."' , 
																						UserImage = '".$imagename."' , 
																						EmailId = '".$email."' , 
																						Password 	= '".$password."' , 
																						Address1 = '".$address."' , 
																						Zipcode = '".$zipcode."' , 
																						Phone = '".$phone."' , 	
																						RegistDate = NOW() ,
																						ConfirmCode ='".$rand."' , 												
																						EmailVerification = '".$_REQUEST['EmailVerification']."' ,  
																						UserStatus = '".$_REQUEST['UserStatus']."' 
																						";
						mysql_query($InsertRegSql) or mysql_error();
					
						echo '<script language="javascript">';
						echo 'window.location="courseproviderlist.php?mess=Successful"';
						echo '</script>';
				}
				else
			    {
						$mess = "E-Mail Address already exists.Please try another one! ";
					 
						echo '<script language="javascript">';
						echo 'window.location="courseproviderlist.php?mess=UnSuccessful"';
						echo '</script>';
			    }
}
//Update User
if($_REQUEST['submitdetail']  == 'Update')
{      
				$fname = $_REQUEST['firstname'];
				$lname = $_REQUEST['lastname'];
				$phone = $_REQUEST['phnumber'];
				$zipcode = $_REQUEST['zipcode'];
				$address = addslashes($_REQUEST['address']);
				
				//Checking Email Unique//
				$CheckEmailSql = "SELECT EmailId FROM ".TABLE_PREFIX."staff_registration WHERE EmailId = '".$email."'";
				$CheckEmailQuery=mysql_query($CheckEmailSql) or mysql_error();
				$CheckEmailRow=mysql_num_rows($CheckEmailQuery);
			
			
				//if($CheckEmailRow=="0")
				//{
					$oldimg = $_REQUEST['oldimg']; 
					$uid = $_REQUEST['oldid'];
			
					if($_FILES['image']['name']!=''){
							
								//Unlink Old ImageBefore Upload New image
								$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."staff_registration WHERE Uid = '".$_REQUEST['oldid']."'";
								$unlink_rs = mysql_query($unlink_sql) or mysql_error();
								$row_unlink = mysql_fetch_array($unlink_rs);
								
								$photo = "../profileimage/fullsize/".$row_unlink['UserImage'];
								$thumb = "../profileimage/bigimg/".$row_unlink['UserImage'];
								$thumb1 = "../profileimage/smallimg/".$row_unlink['UserImage'];
								
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
							
								//Image uploadin start.
								$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
								$max_file_size = 2000 * 1024; #200kb
								//$nw = $nh = 300; # image with # height
								$imgwidth = 200;
								$imgheight =  200;
								
								$imgwidth2 = 100;
								$imgheight2 =  100;

									$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
									if (in_array($ext, $valid_exts)) {
											//Upload image path...
											$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
											$path = '../profileimage/bigimg/' . $imagename;
											$path1 = '../profileimage/smallimg/' . $imagename;
											$pathfull = '../profileimage/fullsize/' . $imagename;
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
											
											//Upload image full size...
											@copy($tmp,$pathfull);
											
											imagedestroy($dstImg);
											imagedestroy($dstImg1);
											//echo "<img src='$pathfull' />";
											
										} else {
											echo 'unknown problem!';
									} 

					
				}  else {
					$imagename = $oldimg;	
				}

									
						$InsertRegSql="UPDATE ".TABLE_PREFIX."staff_registration  SET 
																					FirstName = '".$fname."' ,
																					LastName = '".$lname."' , 
																					UserImage = '".$imagename."' ,  
																					Address1 = '".$address."' , 
																					Zipcode = '".$zipcode."' , 
																					Phone = '".$phone."' ,															
																					EmailVerification = '".$_REQUEST['EmailVerification']."' ,  
																					UserStatus = '".$_REQUEST['UserStatus']."' 	
																					WHERE Uid = '".$_REQUEST['oldid']."'
																					";
						mysql_query($InsertRegSql) or mysql_error();
					
						echo '<script language="javascript">';
						echo 'window.location="courseproviderlist.php?mess=SuccessfulUpdate"';
						echo '</script>';
				/*}
				else
			    {
						$mess = "E-Mail Address already exists.Please try another one! ";
					 
						echo '<script language="javascript">';
						echo 'window.location="courseproviderlist.php?mess=UnSuccessful"';
						echo '</script>';
			    }*/
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
						<li><a href="#"><?=$pagetitle?></a></li>
					  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					<?php
					  if($_REQUEST['mess'] == 'successful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully User Created...
					  </div>
					  <?php
					  }
					  if($_REQUEST['mess'] == 'SuccessfulUpdate')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully User Info Updated...
					  </div>
					  <?php
					  }
					  if($_REQUEST['mess'] == 'UnSuccessful')
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
				<div class="row-fluid">
					<div class="span12">
						<table width="90%" cellpadding="0" cellspacing="0" border="0" style="text-align:center;" >
							<tr>
								
								<th width="20%;">Employee ID</th>
								<th width="25%;">First Name</th>
								<th width="25%;">Last Name</th>
								<th width="23%;">Qualification</th>
								<th>&nbsp;</th>
								
							</tr>
							<tr>
							<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
								
								<td><input type="text" name="RegNo"/></td>
								<td><input type="text" name="fname"  /></td>
								<td><input type="text" name="lname"  /></td>
								<td><input type="text" name="qualification" /></td>
								<td style="text-align:left; padding-bottom:10px;"><input type="submit" name="search" value="SEARCH" /></td>
								
							</form>
							</tr>
						</table>
					  
					</div>
				</div>         
			<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN EXAMPLE TABLE PORTLET-->
						<div class="portlet box grey">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i><?=$pagetitle?></div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body">
								<div class="table-toolbar">
									 <div class="btn-group">
										<a class="btn blue" data-toggle="modal" href="addstaff.php?mode=add">Add New <i class="icon-plus"></i></a>
									</div>
                                    <div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
									</button>
									<ul class="dropdown-menu">
										<li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
									</ul>
								    </div>
								</div>
						<div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Employee ID</th>
										<th class="hidden-480">Name</th>
										<th class="hidden-480">Username</th>
										<th class="hidden-480">DOB</th>
										
										<th class="hidden-480">Qualification</th>
										<th class="hidden-480">Email</th>
										
                                    
										<th class="hidden-480">Advertise Shifts</th>
										
                                        <th class="hidden-480" style="width:15%;">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									if(isset($_REQUEST['search'])){
										$where ="WHERE 1=1 ";
										if($_REQUEST['RegNo'] != "")
										{
											$where .= "AND RegistrationNo = '".trim($_REQUEST['RegNo'])."'";
										}
										if($_REQUEST['fname'] != "")
										{
											$where .= "AND FirstName LIKE '".trim($_REQUEST['fname'])."%'";
										}
										if($_REQUEST['lname'] != "")
										{
											$where .= "AND FirstName = '".trim($_REQUEST['lname'])."'";
										}
										if($_REQUEST['qualification'] != "")
										{
											$where .= "AND qualification = '".trim($_REQUEST['qualification'])."'";
										}
										$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."staff_registration $where ORDER BY Uid DESC";
									
									}else{
										$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."staff_registration ORDER BY Uid DESC";
									}
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											
												//Big Crop Img
												if($rowdest['UserImage'] == "")
												{
													$proset = "images/nopic.jpg";
												}
												else if(!is_file("../profileImage/".$rowdest['UserImage']))
												{
													$proset = "images/nopic.jpg";
												}
												else
												{
													$proset = "../profileImage/".$rowdest['UserImage'];
												} 	
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['Uid']?>" name="feed[]"/>
                                        </td>
										<td style="width:60px;" >
                                        	
												<div class="tile-body">
                                                <img src="<?=$proset?>" alt="Wait..." title="<?=stripslashes($rowdest['FirstName'])?>">
                                                </div>	
                                            			
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['RegistrationNo']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['FirstName'].' '.$rowdest['LastName'];?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['UserName']?></div></td>
                                   		<td class="hidden-480"><div class="videoWrapper"><?=date('d/m/Y', strtotime($rowdest['dob']));?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['qualification']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['EmailId']?></div></td>
										
								<?php
								$sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = ''");
								
								
								
								?>	
								<td class="hidden-480">
											<div class="controls">
											 <select class="span9" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="alocateShift(this.value,'<?=$rowdest['Uid']?>')">
												 <option value="">Select Shift</option>
											<?php while($fetAdv = mysql_fetch_array($sql))
												 {
												
												?>
												<option value="<?=$fetAdv['id'];?>"><?=$fetAdv['location'].' | '.$fetAdv['role'].' |  '.date('d/m/Y', strtotime($fetAdv['date'])).' | Shift From: '.$fetAdv['start_time'].', To: '.$fetAdv['end_time'];?></option>
											<?php }?>
											 </select>
										  </div>
										</td>
                                        <!-- <td class="hidden-480">
											<div class="controls">
											 <select class="span9" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="changestatus(this.value,'<?=$rowdest['Uid']?>')">
												<option value="true" <?=$rowdest['UserStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['UserStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
									-->
                                        
                                        <td class="hidden-480" style="text-align:center;">
                                        <a href="staffinfo.php?Uid=<?=$rowdest['Uid']?>" class="btn mini green"><i class="icon-edit"></i> View</a>		                                        
                                            <a onclick="deleteone(<?=$rowdest['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
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
	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>  
	<script src="assets/scripts/ui-modals.js"></script> 
	<script src="assets/scripts/form-components.js"></script>
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
	
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   	<script src="assets/scripts/table-managed.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>  
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
            error += "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
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
					var fieldObj = document.userdetailinfo21.image;
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
						error += "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
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
					error += "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
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
		   UIModals.init();
		   TableManaged.init();
		});
	
	/********************Delete****************/
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delStaff.php',{ feedid : id, mode : 'single' },
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
						"iDisplayLength": 5,
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
				$.post('ajax/delStaff.php',{ feedids : str , mode : 'selected' },
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
							"iDisplayLength": 5,
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
		$.post('ajax/statusstaff.php',{ stat : stat , id : id });
	}
	
	function alocateShift(id, uid)
	{
		
		/*var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{*/
			$('.portlet .tools a.reload').click();
			$.post('ajax/alocateAvailableShift.php',{ id : id, uid : uid },
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
		//}
	
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>