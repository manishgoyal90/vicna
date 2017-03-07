<?php include"lib/header.php";
		
		if($_REQUEST['submit']=="Submit") {  
					
					$pageid = $_REQUEST['pageid']; 
					$oldimg = $_REQUEST['oldimg']; 
					
					if($_FILES['cimage']['name']!=''){
				
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT cmsimg FROM ".TABLE_PREFIX."cms WHERE id = '".$pageid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../cmsimage/bigimg/".$row_unlink['cmsimg'];
					$thumb = "../cmsimage/smallimg/".$row_unlink['cmsimg'];
					$thumb1 = "../cmsimage/fullsize/".$row_unlink['cmsimg'];
					$thumb2 = "../cmsimage/medium/".$row_unlink['cmsimg'];
					$thumb3 = "../cmsimage/large/".$row_unlink['cmsimg'];
					
					
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
								
								$path = '../cmsimage/bigimg/' . $imagename;
								$path1 = '../cmsimage/smallimg/' . $imagename;
								$pathfull = '../cmsimage/fullsize/' . $imagename;
								$pathmdm = '../cmsimage/medium/' . $imagename;
								$pathmdm2 = '../cmsimage/large/' . $imagename;
								
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
			
				
				$UpdateSql = "UPDATE ".TABLE_PREFIX."cms SET
														cms_page_heading = '".addslashes($_REQUEST['cms_page_heading'])."',
														meta_keywords = '".addslashes($_REQUEST['meta_keywords'])."',
														meta_description = '".addslashes($_REQUEST['meta_description'])."',
														cmsimg = '".$imagename."' ,
														cms_pagedes = '".addslashes($_REQUEST['cms_pagedes'])."'
														WHERE id = '".$_REQUEST['pageid']."'";
				$Res = mysql_query($UpdateSql)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='cms.php?mess=updatesuccessful';\n";
				echo "</script>";
				exit();
				
			} 
			
			//Fetch User Details
			$pageid = $_REQUEST['pageid'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id = '".$pageid."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			if($rowdest['cmsimg'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../cmsimage/medium/".$rowdest['cmsimg']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../cmsimage/medium/".$rowdest['cmsimg'];
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
							<a href="cms.php">CMS Page List</a> 
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
					<form name="cmspageform" id="cmspageform" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="margin:0; padding:0" enctype="multipart/form-data" onSubmit="return check();">
							<input type="hidden" name="action" value="<?=$_REQUEST['mode']?>">
							<input type="hidden" name="pageid" id="pageid" value="<?=$_REQUEST['pageid']?>">
							 <input type="hidden" name="oldimg" value="<?=$rowdest['cmsimg']?>">
							
							<div class="row-fluid">
                               <div class="span12 ">
                               
                                  <div class="control-group">
                                     <label class="control-label">Page Title</label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="cms_pagetitle" id="cms_pagetitle" value="<?=$rowdest['cms_pagetitle']?>" readonly="" />
									  </div>
                                  </div>
								  
								  <div class="control-group">
                                     <label class="control-label">Heading <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="cms_page_heading" id="cms_page_heading" value="<?=$rowdest['cms_page_heading']?>" />
										 
									  </div>
                                  </div>
								  
								 <!-- <div class="control-group">
                                     <label class="control-label">Sub Heading <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										  <textarea class="span12 ckeditor m-wrap" name="cms_page_subheading" rows="6" id="cms_page_subheading" style="width:66%;"><?=stripslashes($rowdest['cms_page_subheading'])?></textarea>
									  </div>
                                  </div>-->
								  <?php if($_REQUEST['pageid']=="9" || $_REQUEST['pageid']=="10" || $_REQUEST['pageid']=="11" || $_REQUEST['pageid']=="15" || $_REQUEST['pageid']=="16" || $_REQUEST['pageid']=="18") { ?>
								  <div class="control-group">
                                      <label class="control-label">Image</label>
                                      <div class="controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail">
                                               <img src="<?=$pic?>" alt="" style="width:200px;" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select Picture</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="cimage" accept="image/jpeg" /></span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                         </div>
                                         <span style="font-size:12px; margin-bottom:10px;">Format : jpg, jpeg, png</span>
                                      </div>
                                   </div>
								   <?php } ?>
								  
								 <!-- <div class="control-group">
                                     <label class="control-label">Meta Keyword</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="meta_keywords" rows="6" id="meta_keywords" style="width:66%;"><?=stripslashes($rowdest['meta_keywords'])?></textarea>
									  </div>
                                  </div>
								  
								  <div class="control-group">
                                     <label class="control-label">Meta Descriptions</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="meta_description" rows="6" id="meta_description" style="width:66%;"><?=stripslashes($rowdest['meta_description'])?></textarea>
									  </div>
                                  </div>-->
                                  
                                  
                                  <div class="control-group">
                                     <label class="control-label">Descriptions</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes" rows="6" id="cms_pagedes"><?=stripslashes($rowdest['cms_pagedes'])?></textarea>
									  </div>
                                  </div>
                                 
                               </div>
                            </div>
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='cms.php'">Cancel</button>
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
	if(frmValidate('cmspageform','cms_page_heading','Heading','YES','')==false)
		{
			return false;
		}
/*	if(frmValidate('cmspageform','cms_page_subheading','Sub Heading','YES','')==false)
		{
			return false;
		}*/
}

</script>  
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		  // UIModals.init();
		   //TableManaged.init();
		   tinymce.init({
			selector: "#cms_pagedes",
			/*height:500,*/
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