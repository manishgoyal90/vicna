<?php include"lib/header.php";

		if($_REQUEST['action']=="add" && $_REQUEST['BannerId']=='') {   
			
			
			if($_FILES['cimage']['name']!=''){
				
		
			//Image uploadin start.
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size = 2000 * 1024; #200kb
			//$nw = $nh = 300; # image with # height
			$imgwidth = 200;
			$imgheight =  200;
			
			$imgwidth2 = 100;
			$imgheight2 =  100;
			
			$imgwidth3 = 182;
			$imgheight3 =  89;
			
			$imgwidth4 = 1300;
			$imgheight4 =  727;
			
				if ( isset($_FILES['cimage']) ) {
					//if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
						$ext = strtolower(pathinfo($_FILES['cimage']['name'], PATHINFO_EXTENSION));
						if (in_array($ext, $valid_exts)) {
								//Upload image path...
								$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
								$path = '../Banner/bigimg/' . $imagename;
								$path1 = '../Banner/smallimg/' . $imagename;
								$pathfull = '../Banner/fullsize/' . $imagename;
								$pathmdm = '../Banner/medium/' . $imagename;
								$pathmdm2 = '../Banner/extbig/' . $imagename;
								
								$tmp = $_FILES['cimage']['tmp_name'];
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
								imagejpeg($dstImg2, $pathmdm);
								
								$dstImg3 = imagecreatetruecolor($imgwidth4, $imgheight4);
								imagecopyresampled($dstImg3, $vImg, 0, 0, $x, $y, $imgwidth4, $imgheight4, $w, $h);
								imagejpeg($dstImg3, $pathmdm2);
								
								//Upload image full size...
								@copy($tmp,$pathfull);
								
								imagedestroy($dstImg);
								imagedestroy($dstImg1);
								imagedestroy($dstImg2);
								imagedestroy($dstImg3);
								//echo "<img src='$pathfull' />";
								
							} else {
								echo 'unknown problem!';
							} 
					/*} else {
						echo 'file is too small or large';
					}*/
				} else {
					echo 'file not set';    
				}
		 	
				$Insert = "INSERT INTO ".TABLE_PREFIX."banner SET 
														BannerName = '".addslashes($_REQUEST['BannerNmae'])."',
														BannerText = '".addslashes($_REQUEST['BannerText'])."',
														link= '".addslashes($_REQUEST['link'])."',
														BannerDescription = '".addslashes($_REQUEST['BannerDescription'])."',
														BannerImage = '".$imagename."', 
														BannerStatus = 'Yes'
														";
				$Res = mysql_query($Insert)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='BannerList.php?mess=successful';\n";
				echo "</script>";
				exit();
				
			} else {
				//header("location:profilemgmt.php");	
			}
		}
		
		if($_REQUEST['action']=="edit" && $_REQUEST['BannerId']!='') {  
					
					$BannerId = $_REQUEST['BannerId'];    
					$oldimg = $_REQUEST['oldimg']; 
			
			if($_FILES['cimage']['name']!=''){
				
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT BannerImage FROM ".TABLE_PREFIX."banner WHERE BannerId = '".$BannerId."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../Banner/bigimg/".$row_unlink['BannerImage'];
					$thumb = "../Banner/smallimg/".$row_unlink['BannerImage'];
					$thumb1 = "../Banner/fullsize/".$row_unlink['BannerImage'];
					$thumb2 = "../Banner/medium/".$row_unlink['BannerImage'];
					$thumb3 = "../Banner/extbig/".$row_unlink['BannerImage'];
					
					
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
				
				$imgwidth3 = 182;
				$imgheight3 =  89;
				
				$imgwidth4 = 1300;
				$imgheight4 =  727;
			
				if ( isset($_FILES['cimage']) ) {
					//if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
						$ext = strtolower(pathinfo($_FILES['cimage']['name'], PATHINFO_EXTENSION));
						if (in_array($ext, $valid_exts)) {
								//Upload image path...
								$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
								$path = '../Banner/bigimg/' . $imagename;
								$path1 = '../Banner/smallimg/' . $imagename;
								$pathfull = '../Banner/fullsize/' . $imagename;
								$pathmdm = '../Banner/medium/' . $imagename;
								$pathmdm2 = '../Banner/extbig/' . $imagename;
								
								$tmp = $_FILES['cimage']['tmp_name'];
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
								imagejpeg($dstImg2, $pathmdm);
								
								$dstImg3 = imagecreatetruecolor($imgwidth4, $imgheight4);
								imagecopyresampled($dstImg3, $vImg, 0, 0, $x, $y, $imgwidth4, $imgheight4, $w, $h);
								imagejpeg($dstImg3, $pathmdm2);
								
								//Upload image full size...
								@copy($tmp,$pathfull);
								
								imagedestroy($dstImg);
								imagedestroy($dstImg1);
								imagedestroy($dstImg2);
								imagedestroy($dstImg3);
								//echo "<img src='$pathfull' />";
								
							} else {
								echo 'unknown problem!';
							}
					}
					} else {
					$imagename = $oldimg;	
				}
				
				$UpdateSql = "UPDATE ".TABLE_PREFIX."banner SET
														BannerName = '".addslashes($_REQUEST['BannerNmae'])."',
														BannerText = '".addslashes($_REQUEST['BannerText'])."',
															link= '".addslashes($_REQUEST['link'])."',
														BannerDescription = '".addslashes($_REQUEST['BannerDescription'])."',
														BannerImage = '".$imagename."' 
														WHERE BannerId = '".$_REQUEST['BannerId']."'";
				$Res = mysql_query($UpdateSql)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='BannerList.php?mess=Updatesuccessful';\n";
				echo "</script>";
				exit();
			} 
			
			//Fetch User Details
			$BannerId = $_REQUEST['BannerId'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '".$BannerId."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			if($rowdest['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../Banner/bigimg/".$rowdest['BannerImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../Banner/bigimg/".$rowdest['BannerImage'];
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
					<form name="videoform" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="margin:0; padding:0" enctype="multipart/form-data" onSubmit="return check();">
							<input type="hidden" name="action" value="<?=$_REQUEST['mode']?>">
							<input type="hidden" name="BannerId" id="BannerId" value="<?=$_REQUEST['BannerId']?>">
                            <input type="hidden" name="oldimg" value="<?=$rowdest['BannerImage']?>">
							
							<div class="row-fluid">
                               <div class="span12 ">
                               
                             
                               
                               <div class="control-group">
                                      <label class="control-label">Banner Image <span style="color:#ff0000;">*</span></label>
                                      <div class="controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; max-height: 150px; line-height: 20px;">
                                               <img src="<?=$pic?>" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select Picture</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="cimage" accept="image/jpeg" onchange="checkFile(this)" /></span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                         </div>
                                         <span style="font-size:12px; margin-bottom:10px;">Please Upload (1300X727) <br />Format : jpg, jpeg, png</span>
                                      </div>
                                   </div>
                                   
                                  <div class="control-group">
                                     <label class="control-label">Banner Text <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
									  	<textarea class="span12 ckeditor m-wrap" name="BannerText" rows="6" id="BannerText"><?=stripslashes($rowdest['BannerText'])?></textarea>
									  </div>
								 </div>
                                  <!--<div class="control-group">
                                     <label class="control-label">Banner For <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
									  	<select class="span8 m-wrap" name="BannerFor">
											<option value="slider">Home Slider</option>
											<option value="training">Training & Development</option>
											<option value="rewards">Rewards & Supports</option>
											<option value="refer">Refer-e-pal</option>
											<option value="news">News & Events</option>
											<option value="superstar">Superstar of the Month</option>
											<option value="partner">Partner with Vicna</option>
											<option value="request">Request a Nurse</option>
											<option value="feedback">Your Feedback</option>
											<option value="working">Working with Vicna</option>
											<option value="apply">Apply Now</option>
										
										</select>
										 
									  </div>

                                  </div>-->
								  <div class="control-group">
                                     <label class="control-label">Title <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
									  	<input type="text" class="span8 m-wrap" name="BannerNmae" id="BannerNmae" value="<?=$rowdest['BannerName']?>" />
									  </div>
								 </div>
								  
								  
								  <div class="control-group">
                                     <label class="control-label">Link <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="link" id="link" value="<?=$rowdest['link']?>" />
									  </div>
                                  </div>
                                  
                                  <div class="control-group">
                                     <label class="control-label">Descriptions</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="BannerDescription" rows="6" id="BannerDescription"><?=stripslashes($rowdest['BannerDescription'])?></textarea>
									  </div>
                                  </div>
                                  
                               </div>
                            </div>
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='BannerList.php'">Cancel</button>
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
    <script  language="javascript" src="../js/frm_validator.js"></script>
<script type="text/javascript" language="javascript1.2"> 
function check()    
{
	var BannerId = document.getElementById('BannerId').value;
	
	if(frmValidate('videoform','Uid',' User Name','YES','')==false)
		{
			return false;
		}
	if(BannerId.length=='') {
		if(frmValidate('videoform','cimage',' Image','YES','')==false)
			{
				return false;
			}
	}
	if(frmValidate('videoform','cat',' Category Name','YES','')==false)
		{
			return false;
		}
	if(frmValidate('videoform','BannerNmae',' Image Title','YES','')==false)
		{
			return false;
		}
	if(frmValidate('videoform','Author',' Author','YES','')==false)
		{
			return false;
		}
		//Checkin Image	
		var fieldObj = document.videoform.cimage;
		var FileName  = fieldObj.value;
		var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
		var FileSize = fieldObj.files[0].size;
		var FileSizeMB = (FileSize/2097152).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
		//Calculate File size.
		var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);

		if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>2097152)
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
				var FileSizeMB = (FileSize/2097152).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
				//Calculate File size.
				var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
		
				if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>2097152)
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
		});
	
	/********************Delete****************/
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delVideo.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/delVideo.php',{ feedids : str , mode : 'selected' },
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