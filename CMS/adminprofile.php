<?php include"lib/header.php";?>
<?php
if(isset($_REQUEST['submit']) == 'Update')
{
					$oldimg = $_REQUEST['oldimg']; 
					$uid = $_REQUEST['oldid'];
			
					if($_FILES['image']['name']!=''){
							
								//Unlink Old ImageBefore Upload New image
								$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."admin_mail WHERE MailId = '".$_REQUEST['oldid']."'";
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

									
						$InsertRegSql="UPDATE ".TABLE_PREFIX."admin_mail SET 
																			UserImage = '".$imagename."' ,  
																			MailAddress = '".$_REQUEST['mail']."'  	
																			WHERE MailId = '".$_REQUEST['oldid']."'
																			";
						mysql_query($InsertRegSql) or mysql_error();
					
						echo '<script language="javascript">';
						echo 'window.location="adminprofile.php?mess=SuccessfulUpdate"';
						echo '</script>';
}


			$ImageId = $_REQUEST['ImageId'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."admin_mail WHERE MailId = '1'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			if($rowdest['UserImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../profileimage/bigimg/".$rowdest['UserImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../profileimage/bigimg/".$rowdest['UserImage'];
			}
?>
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
							 <?=$pagetitle?> <small></small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
							<li class="pull-right no-text-shadow">
								<!-- <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div> -->
							</li>
						</ul>
				<?php
				  if($_REQUEST['mess'] == 'SuccessfulUpdate')
				  {
				  ?>
				  
				  <div class="alert alert-success">
					<button data-dismiss="alert" class="close"></button>
					Successfully Updated...
				  </div>
				  
				  <?php
				  }
				  if($_REQUEST['action']== 'wrongoldpass')
				  {
				  ?>
				  
				  <div class="alert alert-error">
					<button data-dismiss="alert" class="close"></button>
					Failed Wrong old password.... 
				  </div>
				  
				  <?php
				  }
				  ?>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- Statr Page body-->
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
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="<?=$_SERVER['PHP_SELF']?>" class="form-horizontal" name="frmchangepass" method="post"  enctype="multipart/form-data">
					     <input type="hidden" name="oldid" value="<?=$rowdest['MailId']?>">
                         <input type="hidden" name="oldimg" value="<?=$rowdest['UserImage']?>">
                      <div class="control-group">
													  <label class="control-label">Image</label>
													  <div class="controls">
														 <div class="fileupload fileupload-new" data-provides="fileupload">
															<div class="fileupload-new thumbnail" style="width: 200px;">
															   <img src="<?=$pic?>" alt="" />
															</div>
															<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
															<div>
															   <span class="btn btn-file"><span class="fileupload-new">Select Picture</span>
															   <span class="fileupload-exists">Change</span>
															   <input type="file" class="default" name="image" /></span>
															   <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
															</div>
														 </div>
													  </div>
												   </div>
                         <div class="control-group">
						  <label class="control-label">Mail Id</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap" name="mail" id="mail" value="<?=$rowdest['MailAddress']?>"/>
						  </div>
					   </div>
					   <div class="form-actions">
						  <input type="submit" class="btn blue" name="submit" value="Update">
						  <button type="button" class="btn"  id="cancel">Cancel</button>
					   </div>
					</form>
					<!-- END FORM-->           
				 </div>
			  </div>
			  
			  <!-- END SAMPLE FORM PORTLET-->
				<!-- End Page Body-->
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
    	<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>  
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->   
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		});
	</script> 
	<script>
	function passval()
		{
			$("#oldpasserr").html('');
			$("#newpasserr").html('');
			$("#conpasserr").html('');
			
			$("#oldpasserr").hide();
			$("#newpasserr").hide();
			$("#conpasserr").hide();
			
			
			var oldpass = $("#oldpass").val();
			var newpass = $("#newpass").val();
			var conpass = $("#conpass").val();
			
					
			if(oldpass == "")
			{
				$("#oldpasserr").show();
				$("#oldpasserr").html('Enter old password');
			}
			if(newpass == "")
			{
				$("#newpasserr").show();
				$("#newpasserr").html('Enter new password');
			}
			if(conpass == "")
			{
				$("#conpasserr").show();
				$("#conpasserr").html('Confirm your password');
			}
			if(conpass != newpass)
			{
				$("#conpasserr").show();
				$("#conpasserr").html('Passwords mismatch');
			}
			if(oldpass != "" && newpass != "" && conpass == newpass && conpass != "")
			{
				document.frmchangepass.submit();
			}
			else
			{
				return false;
			}
		
		}
</script>

<script>
$('#cancel').click(function(){
	location.href = 'dashboard.php';
});
</script> 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>