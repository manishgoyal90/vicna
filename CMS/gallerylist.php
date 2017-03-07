<?php include"lib/header.php";?>
<?php
	if($_REQUEST['submit']=="Add Gallery") {
				$Insert = "INSERT INTO ".TABLE_PREFIX."gallerylist SET
													uid = '".$_SESSION['admin_id']."',
													gallery_name = '".$_REQUEST['GalleryName']."',
													gallery_date = NOW(),
													status = 'Yes'
													";
				$Res = mysql_query($Insert)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='gallerylist.php?mess=successful';\n";
				echo "</script>";
				exit();
	}
	
		if($_REQUEST['submit']=="Edit Gallery") {
				$Insert = "UPDATE ".TABLE_PREFIX."gallerylist SET
													gallery_name = '".$_REQUEST['GalleryName']."'
													WHERE id = '".$_REQUEST['hide']."'";
				$Res = mysql_query($Insert)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='gallerylist.php?mess=Updatesuccessful';\n";
				echo "</script>";
				exit();
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
						Successfully Gallery Added...
					  </div>
                      <?php }  
					  if($_REQUEST['mess'] == 'Updatesuccessful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Gallery Updated...
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
										<a class="btn blue" data-toggle="modal" href="#responsivepost">Add New <i class="icon-plus"></i></a>
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
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
										<th class="hidden-480">Gallery</th>
										<th class="hidden-480">Name</th>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
							<?php
									$c=1;
									$getdest = "SELECT *  FROM ".TABLE_PREFIX."gallerylist";
											   
									$getdest = mysql_query($getdest) or die(mysql_error());
									while($rowdest = mysql_fetch_array($getdest))
									{
										$getgalpic = "SELECT gallery_image FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$rowdest['id']."' ORDER BY id ASC LIMIT 1";
										$getgalpic = mysql_query($getgalpic) or die(mysql_error());
										$getgalpic = mysql_fetch_array($getgalpic);
										
										$getcnt = "SELECT COUNT(*) AS cnt FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$rowdest['id']."'";
										$getcnt = mysql_query($getcnt) or die(mysql_error());
										$getcnt = mysql_fetch_array($getcnt);
										
										
										// Get picture
										if($getgalpic['gallery_image'] == "")
										{
											$pic = "images/nopic.jpg";
										}
										else if(!is_file("../gallery/bigimg/".$getgalpic['gallery_image']))
										{
											$pic = "images/nopic.jpg";
										}
										else
										{
											$pic = "../gallery/bigimg/".$getgalpic['gallery_image'];
										}
									?>
									
									<tr class="odd gradeX">
										<td><input type="checkbox" class="checkboxes" value="<?=$rowdest['GalleryId']?>" name="gallery[]"/></td>
										<td class="hidden-480">
											<div class="tile image double selected" onclick="location.href='galleryimage.php?id=<?=$rowdest['id']?>'">
												<div class="tile-body">
													<img src="<?=$pic?>" alt="Wait...">												
                                                 </div>
												<div class="tile-object">
													<div class="name">
														Gallery	
                                                    </div>
													<div class="number">
														<?=$getcnt['cnt']?>
													</div>
												</div>
											</div>	
								</td>
										<td class="hidden-480"><?=stripslashes($rowdest['gallery_name'])?></td>
										<td class="hidden-480"><?=date("M jS, Y",strtotime($rowdest['gallery_date']))?></td>
										<td class="hidden-480">
										
											<div class="controls">
											 <select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>On</option>
												<option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>Off</option>
											 </select>
										  </div>										</td>
										<td class="hidden-480"><a class="btn green mini" data-toggle="modal" href="#responsiveedit<?=$c?>"><i class="icon-edit"></i> Edit</a>
                                         <!-- Light Box 2 Start-->
							<div id="responsiveedit<?=$c?>" class="modal hide fade dip" tabindex="-1" data-width="700">		 	
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Edit Gallery</h3>
                                </div>
                                  <form name="form4" id="form4" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return check();">
                                  <input type="hidden" name="hide" value="<?=$rowdest['id']?>">		
                                        <div class="modal-body">
                                            
                                            <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
                                                <div class="row-fluid">
                                                    <div class="span10">
													<div>&nbsp;</div>
													<div>&nbsp;</div>
                                                           <div class="control-group">
                                                              <label class="control-label">Gallery Name <span style="color:#ff0000;">*</span></label>
                                                              <div class="controls">
                                                                 <input type="text" class="span m-wrap" name="GalleryName" id="GalleryName" value="<?=stripslashes($rowdest['gallery_name'])?>" />
                                                              </div>
                                                           </div>
                                                           
                                                           <!--<div class="control-group">
                                                              <label class="control-label">Gallery Description <span style="color:#ff0000;">*</span></label>
                                                              <div class="controls">
                                                                 <textarea class="span" name="GalleryDescriptions" id="GalleryDescriptions" rows="5"><?=stripslashes($rowdest['gallery_description'])?></textarea>
                                                              </div>
                                                           </div>-->
                                                     </div>																
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn">Close</button>
                                            <input type="submit" class="btn blue" name="submit" value="Edit Gallery" />
                                        </div>
                                </form>
                            </div>
                           <!--Light2 Box End-->
                                        </td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?=$rowdest['id']?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
									
									<?php
									$c++;
									}
									?>
								</tbody>
							</table>
							</div>
                            <!-- Light Box 2 Start-->
							<div id="responsivepost" class="modal hide fade dip" tabindex="-1" data-width="700">		 	
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Add Gallery</h3>
                                </div>
                                  <form name="form4" id="form4" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return check();">				
                                        <div class="modal-body">
                                            <div>&nbsp;</div>
                                            <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
                                                <div class="row-fluid">
                                                    <div class="span10">
                                                           <div class="control-group">
                                                              <label class="control-label">Gallery Name <span style="color:#ff0000;">*</span></label>
                                                              <div class="controls">
                                                                 <input type="text" class="span m-wrap" name="GalleryName" id="GalleryName" />
                                                              </div>
                                                           </div>
                                                           
                                                           <!--<div class="control-group">
                                                              <label class="control-label">Gallery Description <span style="color:#ff0000;">*</span></label>
                                                              <div class="controls">
                                                                 <textarea class="span" name="GalleryDescriptions" id="GalleryDescriptions" rows="5"></textarea>
                                                              </div>
                                                           </div>-->
                                                     </div>																
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn">Close</button>
                                            <input type="submit" class="btn blue" name="submit" value="Add Gallery" />
                                        </div>
                                </form>
                            </div>
                           <!--Light2 Box End-->
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
	if(frmValidate('form4','GalleryName',' GalleryName','YES','')==false)
		{
			return false;
		}
	if(frmValidate('form4','GalleryDescriptions',' GalleryDescriptions','YES','')==false)
		{
			return false;
		}
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
			$.post('ajax/deletegallery.php',{ galleryid : id, mode : 'single' },
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
		var gallery = document.getElementsByName('gallery[]');
		
		var ln = gallery.length;
		
		var flag = 0;
		var str = "";
		
		for(i=0;i<ln;i++)
		{
			if(gallery[i].checked)
			{
				str = str + gallery[i].value + ',';
			}
		}
		
		if(str != "")
		{
			var cnf = confirm("Are you sure to delete?");
		
			if(cnf)
			{
				$('.portlet .tools a.reload').click();
				$.post('ajax/deletegallery.php',{ galleryids : str , mode : 'selected' },
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
		$.post('ajax/statusphoto.php',{ stat : stat , id : id });
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>