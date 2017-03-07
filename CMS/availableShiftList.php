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
				$rn = "SELECT MAX(SUBSTR(RegistrationNo,$ql)) FROM " . TABLE_PREFIX . "user_registration where RegistrationNo like '%$prefix%'";
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
				$CheckEmailSql = "SELECT EmailId FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$email."'";
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

									
						$InsertRegSql="INSERT INTO ".TABLE_PREFIX."user_registration  SET
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
				
									
						$InsertRegSql="UPDATE ".TABLE_PREFIX."user_registration  SET 
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
					  if($_REQUEST['mess'] == 'Successful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Available Shift Inserted...
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
								<div class="table-toolbar">
									 <div class="btn-group">
										<a class="btn blue" data-toggle="modal" href="availableShift.php?mode=add">Add New <i class="icon-plus"></i></a>
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
										<th class="hidden-480">Location</th>
										<th class="hidden-480">Role</th>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Time</th>
                                        <th class="hidden-480">Penalties</th>
                                        <th class="hidden-480">More Info</th>
										<th class="hidden-480">Status</th>
										
                                        <th class="hidden-480">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM staff_available_shift ORDER BY id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/>
                                        </td>
										
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['location']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['role']);?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=date('d M Y', strtotime($rowdest['date']))?><br/><?=date('l', strtotime($rowdest['date']))?></div></td>
                                   
										<td class="hidden-480"><div class="videoWrapper">Start : <?php echo $rowdest['start_time'];?><br/>Finish : <?php echo $rowdest['end_time'];?></div></td>
                                        <td class="hidden-480"><div class="videoWrapper"><?php echo stripslashes($rowdest['penalties']);?></div></td>
                                        <td class="hidden-480"><div class="videoWrapper"><?php echo stripslashes($rowdest['more_info']);?></div></td>
                                         <td class="hidden-480" style="width:100px;">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
									
                                        
                                        <td class="hidden-480">		                                        
                                            <a href="availableShiftView.php?Uid=<?=$rowdest['id']?>" class="btn mini green"><i class="icon-edit"></i> View</a>			
                                            <a onclick="deleteone(<?=$rowdest['id']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
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
			$.post('ajax/delShift.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/delUser2.php',{ feedids : str , mode : 'selected' },
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
		$.post('ajax/statusShift.php',{ stat : stat , id : id });
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>