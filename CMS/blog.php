<?php include"lib/header.php";

		if($_REQUEST['action']=="add" && $_REQUEST['PostId']=='') {   
			
			
			if($_FILES['cimage']['name']!=''){
				
		
			//Image uploadin start.
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size = 2000 * 1024; #200kb
			//$nw = $nh = 300; # image with # height
			$imgwidth = 200;
			$imgheight =  200;
			
			$imgwidth2 = 100;
			$imgheight2 =  100;
			
			$imgwidth3 = 600;
			$imgheight3 =  450;
			
			$imgwidth4 = 850;
			$imgheight4 =  567;
			
				if ( isset($_FILES['cimage']) ) {
					//if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
						$ext = strtolower(pathinfo($_FILES['cimage']['name'], PATHINFO_EXTENSION));
						if (in_array($ext, $valid_exts)) {
								//Upload image path...
								$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
								
								$path = '../Post/bigimg/' . $imagename;
								$path1 = '../Post/smallimg/' . $imagename;
								$pathfull = '../Post/fullsize/' . $imagename;
								$pathmdm = '../Post/medium/' . $imagename;
								$pathmdm2 = '../Post/large/' . $imagename;
								
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
				
			} else {
				//header("location:profilemgmt.php");	
			}
				
				$Insert = "INSERT INTO ".TABLE_PREFIX."post_details SET
																		PostedBy = 'Admin',
																		PostTitle = '".$_REQUEST['PostTitle']."',
																		MetaKeywords = '".addslashes($_REQUEST['MetaKeywords'])."',
																		MetaDescription = '".addslashes($_REQUEST['MetaDescription'])."',
																		PostDescriptions = '".addslashes($_REQUEST['PostDescriptions'])."',
																		PostImage = '".$imagename."', 
																		PostDate = NOW(),
																		PostStatus = 'Yes'
																		";
				$Res = mysql_query($Insert)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='bloglist.php?mess=successful';\n";
				echo "</script>";
				exit();
				
		}
		
		if($_REQUEST['action']=="edit" && $_REQUEST['PostId']!='') {  
					
					$PostId = $_REQUEST['PostId'];    
					$oldimg = $_REQUEST['oldimg']; 
			
			if($_FILES['cimage']['name']!=''){
				
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT PostImage FROM ".TABLE_PREFIX."post_details WHERE PostId = '".$PostId."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../Post/bigimg/".$row_unlink['PostImage'];
					$thumb = "../Post/smallimg/".$row_unlink['PostImage'];
					$thumb1 = "../Post/fullsize/".$row_unlink['PostImage'];
					$thumb2 = "../Post/medium/".$row_unlink['PostImage'];
					$thumb3 = "../Post/large/".$row_unlink['PostImage'];
					
					
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
				
				$imgwidth3 = 600;
				$imgheight3 =  450;
				
				$imgwidth4 = 850;
				$imgheight4 =  567;
			
					//if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
						$ext = strtolower(pathinfo($_FILES['cimage']['name'], PATHINFO_EXTENSION));
						if (in_array($ext, $valid_exts)) {
								//Upload image path...
								$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
								
								$path = '../Post/bigimg/' . $imagename;
								$path1 = '../Post/smallimg/' . $imagename;
								$pathfull = '../Post/fullsize/' . $imagename;
								$pathmdm = '../Post/medium/' . $imagename;
								$pathmdm2 = '../Post/large/' . $imagename;
								
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
					} else {
					$imagename = $oldimg;	
				}
				
				$UpdateSql = "UPDATE ".TABLE_PREFIX."post_details SET
																	PostTitle = '".$_REQUEST['PostTitle']."',
																	MetaKeywords = '".addslashes($_REQUEST['MetaKeywords'])."',
																	MetaDescription = '".addslashes($_REQUEST['MetaDescription'])."',
																	PostDescriptions = '".addslashes($_REQUEST['PostDescriptions'])."',
																	PostImage = '".$imagename."' 
																	WHERE PostId = '".$_REQUEST['PostId']."'";
				$Res = mysql_query($UpdateSql)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='bloglist.php?mess=updatesuccessful';\n";
				echo "</script>";
				exit();
				
			} 
			
			//Fetch User Details
			$PostId = $_REQUEST['PostId'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."post_details WHERE PostId = '".$PostId."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			if($rowdest['PostImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../Post/bigimg/".$rowdest['PostImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../Post/bigimg/".$rowdest['PostImage'];
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
							<a href="bloglist.php">Blog List</a> 
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
							<input type="hidden" name="PostId" id="PostId" value="<?=$_REQUEST['PostId']?>">
                            <input type="hidden" name="UserId" id="UserId" value="<?=$rowdest['Uid']?>">
                            <input type="hidden" name="oldimg" value="<?=$rowdest['PostImage']?>">
							
							<div class="row-fluid">
                               <div class="span12 ">
                               
                               <!--<div class="control-group">
                                     <label class="control-label">User List <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <select name="Uid" id="Uid" class="span5 chosen">
                                            <option value="">Choose User</option>
                                            <?php
                                                //Fetch Music Cat
                                                $FetchCatSql = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE UserStatus = 'Yes'";
                                                $FetchCatQuery = mysql_query($FetchCatSql);
                                                while($FetchCatRows = mysql_fetch_array($FetchCatQuery)){
                                            ?>
                                           <option value="<?=$FetchCatRows['Uid']?>" <?php if($FetchCatRows['Uid']==$rowdest['Uid']){echo"selected";}?>><?=$FetchCatRows['FirstName']?> <?=$FetchCatRows['LastName']?></option>
                                            <?php } ?>
                                             <option value="<?=$_SESSION['admin_id']?>" <?php if($rowdest['Uid']==$_SESSION['admin_id']){echo"selected";}?>><?=$FetchCatRows['FirstName']?> Admin (Self)</option>
                                         </select>	
									  </div>
                                  </div>-->
                               
                               <div class="control-group">
                                      <label class="control-label">Image</label>
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
                                         <span style="font-size:12px; margin-bottom:10px;">Format : jpg, jpeg, png</span>
                                      </div>
                                   </div>
                                   
                                 <!-- <div class="control-group">
                                     <label class="control-label">Category <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <select name="cat" id="cat" class="span5 chosen">
                                            <option value="">Choose Category</option>
                                            <?php
                                                //Fetch Music Cat
                                                $FetchCatSql = "SELECT * FROM ".TABLE_PREFIX."post_category WHERE CategoryStatus  = 'Yes'";
                                                $FetchCatQuery = mysql_query($FetchCatSql);
                                                while($FetchCatRows = mysql_fetch_array($FetchCatQuery)){
                                            ?>
                                            <option value="<?=$FetchCatRows['PostCatId']?>" <?php if($FetchCatRows['PostCatId']==$rowdest['PostCatId']){echo"selected";}?>><?=$FetchCatRows['CategoryName']?></option>
                                            <?php } ?>
                                         </select>	
									  </div>
                                  </div>-->
                                  
                                  <div class="control-group">
                                     <label class="control-label">Title <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="PostTitle" id="PostTitle" value="<?=$rowdest['PostTitle']?>" />
									  </div>
                                  </div>
                                  
                                  <!--<div class="control-group">
                                     <label class="control-label">Author <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="Author" id="Author" value="<?=$rowdest['Author']?>" />
									  </div>
                                  </div>-->
								  
								 
                                  
                                  <div class="control-group">
                                     <label class="control-label">Descriptions</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="PostDescriptions" rows="6" id="PostDescriptions"><?=stripslashes($rowdest['PostDescriptions'])?></textarea>
									  </div>
                                  </div>
                                  
                               </div>
                            </div>
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='bloglist.php'">Cancel</button>
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
	//var PostId = document.getElementById('PostId').value;
	
/*	if(PostId.length=='') {
		if(frmValidate('videoform','cimage',' Image','YES','')==false)
			{
				return false;
			}
	}*/
	if(frmValidate('videoform','cat',' Category Name','YES','')==false)
		{
			return false;
		}
	if(frmValidate('videoform','PostTitle',' Post Title','YES','')==false)
		{
			return false;
		}
		//Checkin Image	
		var fieldObj = document.videoform.cimage;
		var FileName  = fieldObj.value;
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->

        if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
        {
           /* var error = "File type : "+ FileExt+"\n\n";
            error += "Size: " + FileSizeMB + " MB \n\n";
            error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
            alert(error);*/
			var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
            alert(error);
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
		
				if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
				{
				   /* var error = "File type : "+ FileExt+"\n\n";
					error += "Size: " + FileSizeMB + " MB \n\n";
					error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
					alert(error);*/
					var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
					alert(error);
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
			selector: "#PostDescriptions",
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