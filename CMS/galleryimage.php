<?php include"lib/header.php";?>
<?php
	if($_REQUEST['submit']=="Add Gallery") {
				$Insert = "INSERT INTO ".TABLE_PREFIX."gallerylist SET
													Uid = '".$_SESSION['admin_id']."',
													GalleryName = '".$_REQUEST['GalleryName']."',
													GalleryDescriptions = '".addslashes($_REQUEST['GalleryDescriptions'])."',
													GalleryDate = NOW(),
													GalleryStatus = 'Yes'
													";
				$Res = mysql_query($Insert)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='gallerylist.php?mess=successful';\n";
				echo "</script>";
				exit();
	}
?>
<link rel="stylesheet" type="text/css" href="uploadify/uploadify.css">	
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
                            <a href="gallerylist.php">Gallery</a> 
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
						Successfully Gallery Added...
					  </div>
                      <?php }  
					  if($_REQUEST['mess'] == 'Updatesuccessful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Photo Updated...
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
										<!--<a class="btn blue" data-toggle="modal" href="#responsivepost">Add New <i class="icon-plus"></i></a>-->
                                        <input id="file_upload" type="file" name="file_upload" />
									</div>
                                    <!--<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
									</button>
									<ul class="dropdown-menu">
										<li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
									</ul>
								    </div>-->
								</div>
						<div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
									<tr>
										<th style="width:8px;">SlNo.<!--<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />--></th>
										<th class="hidden-480" style="width:100px;">Picture</th>
										<th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
								$c=1;
								$getdest = "SELECT * FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$_REQUEST['id']."' ORDER BY id DESC";
								$getdest = mysql_query($getdest) or die(mysql_error());
								while($rowdest = mysql_fetch_array($getdest))
								{
									// Get picture
										if($rowdest['gallery_image'] == "")
										{
											$pic = "images/nopic.jpg";
										}
										else if(!is_file("../gallery/bigimg/".$rowdest['gallery_image']))
										{
											$pic = "images/nopic.jpg";
										}
										else
										{
											$pic = "../gallery/bigimg/".$rowdest['gallery_image'];
										}
								?>
								
								<tr class="odd gradeX">
									<td><?=$c?><!--<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="pics[]"/>--></td>
									<td class="hidden-480">
									
									<div class="tile image double selected">
										<div class="tile-body">
											<img src="<?=$pic?>" alt="">
										</div>
									</div>
									
									</td>
									<td ><a class="btn mini red" style="cursor:pointer" onclick="deleteone(<?=$rowdest['id']?>)"><i class="icon-trash"></i> Delete</a></td>
								</tr>
								
								<?php
								$c++;
								}
								?>
									
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
<script type="text/javascript" src="uploadify/swfobject.js"></script>
<script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.js"></script>
   
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		  // UIModals.init();
		   //TableManaged.init();
		   App.init();
		});
	
	/********************Delete****************/
function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/deletepic.php',{ picid : id, mode : 'single', gallery_id : <?=$_REQUEST['id']?> },
				function(data)
				{
					$('#tablesec').html(data);
					
					/************************************ Table JS ************************************/
								
					$('#sample_1').dataTable({
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
					
					jQuery('#sample_1 .group-checkable').change(function () {
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
		var pic = document.getElementsByName('pics[]');
		
		var ln = pic.length;
		
		var flag = 0;
		var str = "";
		
		for(i=0;i<ln;i++)
		{
			if(pic[i].checked)
			{
				str = str + pic[i].value + ',';
			}
		}
		
		if(str != "")
		{
			var cnf = confirm("Are you sure to delete?");
		
			if(cnf)
			{
				$('.portlet .tools a.reload').click();
				$.post('ajax/deletepic.php',{ picids : str , mode : 'selected', gallery_id : <?=$_REQUEST['id']?> },
					function(data)
					{
						$('#tablesec').html(data);
						
						/************************************ Table JS ************************************/
								
						$('#sample_1').dataTable({
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
						
						jQuery('#sample_1 .group-checkable').change(function () {
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

</script>
<script type="text/javascript">

$(document).ready(function() {
  
  $('#file_upload').uploadify({
	'uploader'    : 'uploadify/uploadify.swf',
	'script'      : 'uploadify/uploadify.php',
	'cancelImg'   : 'uploadify/cancel.png',
	'scriptData'  : { 'gallery_id' : <?=$_REQUEST['id']?> },
	'buttonText'  : 'Upload Picture',
	'folder'      : 'uploadify/gallery',
	'multi'		  : true,
	'auto'        : true,
	'onComplete'  : function(event,data) {
						$.post("ajax/getgalleryafterupload.php", { gallery_id : <?=$_REQUEST['id']?> },
							function(data)
							{
								$("#tablesec").html(data);
								
								/************************************ Table JS ************************************/
								
								$('#sample_1').dataTable({
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
								
								jQuery('#sample_1 .group-checkable').change(function () {
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
  });
});
</script> 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>