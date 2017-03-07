<?php include("header.php"); ?>

<!-- END HEADER -->

<style>
.modal-header {
	background-color: #F3F3F3;
	background-image: linear-gradient(#F3F3F3, #E7E7E7 50%);
	border-bottom: 1px solid #C4C4C4;
	border-radius: 6px 6px 0 0;
	clear: both;
	color: #494949;
}

.modal-footer:after {
	clear: both;
}
.modal-footer:before, .modal-footer:after {
	content: "";
	display: table;
	line-height: 0;
}
.modal-footer:after {
	clear: both;
}
.modal-footer {
	border-radius: 0 0 6px 6px;
}
.toggle-button span.info{
	background:-moz-linear-gradient(center bottom , #D84A38, #BB2413) repeat scroll 0 0 #D84A38;
}
.tile.double {
    height: 100px;
    width: 170px !important;
}
</style>

<!-- START MODAL -->

<div id="popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

	<div id="getpopupdata">
	</div>

</div>

<!-- END MODAL -->

<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">
  <!-- BEGIN SIDEBAR -->
  <?php include("leftbar.php"); ?>
  <!-- END SIDEBAR -->
  <!-- BEGIN PAGE -->  
  <div class="page-content">
	 <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	 <div id="portlet-config" class="modal hide">
		<div class="modal-header">
		   <button data-dismiss="modal" class="close" type="button"></button>
		   <h3>portlet Settings</h3>
		</div>
		<div class="modal-body">
		   <p>Here will be a configuration form</p>
		</div>
	 </div>
	 <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	 <!-- BEGIN PAGE CONTAINER-->
	 <div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->   
		<div class="row-fluid">
		   <div class="span12">
			  <!-- BEGIN STYLE CUSTOMIZER -->
			  <div class="color-panel hidden-phone">
				 <div class="color-mode-icons icon-color"></div>
				 <div class="color-mode-icons icon-color-close"></div>
				 <div class="color-mode">
					<p>THEME COLOR</p>
					<ul class="inline">
					   <li class="color-black current color-default" data-style="default"></li>
					   <li class="color-blue" data-style="blue"></li>
					   <li class="color-brown" data-style="brown"></li>
					   <li class="color-purple" data-style="purple"></li>
					   <li class="color-white color-light" data-style="light"></li>
					</ul>
					<label class="hidden-phone">
					<input type="checkbox" class="header" checked value="" />
					<span class="color-mode-label">Fixed Header</span>
					</label>                    
				 </div>
			  </div>
			  <!-- END BEGIN STYLE CUSTOMIZER -->   
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
			  
			  <?php
			  if($_REQUEST['action'] == 'added')
			  {
			  ?>
			  
			  <div class="alert alert-success">
				<button data-dismiss="alert" class="close"></button>
				<strong>Success!</strong> Banner added
			  </div>
			  
			  <?php
			  }
			  if($_REQUEST['action'] == 'updated')
			  {
			  ?>
			  
		     <div class="alert alert-success">
				<button data-dismiss="alert" class="close"></button>
			   <strong>Success!</strong> Banner updated			  </div>
			  
			  <?php
			  }
			  ?>
			  
		   </div>
		</div>
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		
		<div class="row-fluid">
		   <div class="span12">
			  <!-- BEGIN SAMPLE FORM PORTLET-->   
			  <div class="portlet box light-grey">
						<div class="portlet-title">
							<h4><i class="icon-globe"></i><?=$pagetitle?></h4>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>
								<a href="javascript:;" class="remove"></a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="clearfix">
								<div class="btn-group">
									
									<a class="btn mini green" href="managebanner.php?mode=add" >Add New <i class="icon-plus"></i></a>
									
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
							<table class="table table-striped table-bordered table-hover" id="sample_1">
								<thead>
									<tr>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
										<th class="hidden-480" style="width:100px;">Picture</th>
										<th class="hidden-480">Title</th>
										<th class="hidden-480">Link</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
									$getdest = "SELECT * FROM ".TABLE_PREFIX."banners";
									$getdest = mysql_query($getdest) or die(mysql_error());
									while($rowdest = mysql_fetch_array($getdest))
									{
										// Get picture
										if($rowdest['banner_image'] == "")
										{
											$pic = "images/nopic.jpg";
										}
										else if(!is_file($rowdest['banner_image']))
										{
											$pic = "images/nopic.jpg";
										}
										else
										{
											$pic = $rowdest['banner_image'];
										}
									?>
									
									<tr class="odd gradeX">
										<td><input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/></td>
										<td class="hidden-480">
										
											<div class="tile image double selected">
												<div class="tile-body">
													<img src="<?=$pic?>" alt="">												</div>
											</div>										</td>
										<td class="hidden-480"><?=stripslashes($rowdest['banner_title'])?></td>
										<td class="hidden-480"><?=stripslashes($rowdest['banner_link'])?></td>
										<td class="hidden-480">
										
											<div class="controls">
											 <select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>On</option>
												<option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>Off</option>
											 </select>
										  </div>										</td>
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="managebanner.php?mode=edit&id=<?=$rowdest['id']?>"><i class="icon-edit"></i> Edit</a></td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?=$rowdest['id']?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
									
									<?php
									}
									?>
								</tbody>
							</table>
							</div>
						</div>
					</div>
			  <!-- END SAMPLE FORM PORTLET-->
		   </div>
		</div>
		<!-- END PAGE CONTENT-->         
	 </div>
	 <!-- END PAGE CONTAINER-->
  </div>
  <!-- END PAGE -->  
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include("footer.php"); ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<script src="assets/js/jquery-1.8.3.min.js"></script>	
<script src="assets/breakpoints/breakpoints.js"></script>	
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>		
<script src="assets/js/jquery.blockui.js"></script>
<script src="assets/js/jquery.cookie.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="assets/js/excanvas.js"></script>
<script src="assets/js/respond.js"></script>
<![endif]-->	
<script type="text/javascript" src="assets/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
<script type="text/javascript" src="assets/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
<script src="assets/js/app.js"></script>		
<script>
	jQuery(document).ready(function() {			
		// initiate layout and plugins
		App.setPage("table_managed");
		$(".chosen").chosen();
		App.init();
	});
	
	
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/deletebanner.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/deletebanner.php',{ feedids : str , mode : 'selected' },
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
	
	function changestatus(stat,id)
	{
		$.post('ajax/bannerstatus.php',{ stat : stat , id : id });
	}
</script>

<!-- END JAVASCRIPTS -->   
</body>
<!-- END BODY -->
</html>
