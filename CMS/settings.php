<?php include"lib/header.php";?>
<?php
if($_REQUEST['updatesettings'] == 'yes')
{
	foreach($settings as $keyset=>$valset)
	{	
		$updateset = "UPDATE ".TABLE_PREFIX."settings SET config_val = '".$_REQUEST[$keyset]."' WHERE config_type = '".$keyset."'";
		mysql_query($updateset) or die(mysql_error());
	}
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='settings.php?action=updated';\n";
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
                      			  <?php
			  if($_REQUEST['action'] == 'updated')
			  {
			  ?>
			  
			  <div class="alert alert-success">
				<button data-dismiss="alert" class="close"></button>
				<strong>Success!</strong> Settings updated
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
									 <!--<div class="btn-group">
										<a class="btn blue" data-toggle="modal" href="#responsivepost">Add New <i class="icon-plus"></i></a>
									</div>
                                    <div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
									</button>
									<ul class="dropdown-menu">
										<li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
									</ul>
								    </div>-->
								</div>
						<div id="tablesec">
							<form action="<?=$_SERVER['PHP_SELF']?>" class="form-horizontal" name="frmsettings" method="post">
					   <input type="hidden" name="updatesettings" value="yes">
					   <!--<div class="control-group">
						  <label class="control-label">Admin Email</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap" name="admin_email" id="admin_email" value="<?=$settings['admin_email']?>"/>
						  </div>
					   </div>-->
                      <!-- <div class="control-group">
						  <label class="control-label">PayPal Mode</label>
						  <div class="controls">
							 <label class="radio line">
							 <input type="radio" name="paypal_mode" value="sandbox" <?=$settings['paypal_mode'] == 'sandbox' ? 'checked' : ''?>/>
							 Sandbox
							 </label>
							 <label class="radio line">
							 <input type="radio" name="paypal_mode" value="live" <?=$settings['paypal_mode'] == 'live' ? 'checked' : ''?>/>
							 Live
							 </label>  
						  </div>
					   </div>-->
                       
                     
                       
                      
					   <div class="control-group">
						  <label class="control-label">Facebook Link</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="facebook_link" id="facebook_link" value="<?=$settings['facebook_link']?>"/>
						  </div>
					   </div>
					   <div class="control-group">
						  <label class="control-label">Twitter Link</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="twitter_link" id="twitter_link" value="<?=$settings['twitter_link']?>"/>
						  </div>
					   </div>
					   
                       
                       <div class="control-group">
						  <label class="control-label">Google Plus Link</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="googleplus_link" id="googleplus_link" value="<?=$settings['googleplus_link']?>"/>
						  </div>
					   </div>
                       
                      <div class="control-group">
						  <label class="control-label">Instagram Link</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="instagram_link" id="instagram_link" value="<?=$settings['instagram_link']?>"/>
						  </div>
					   </div>
                       
                     <!--   <div class="control-group">
						  <label class="control-label">Pinterest Link</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="pinterest_link" id="pinterest_link" value="<?=$settings['pinterest_link']?>"/>
						  </div>
					   </div>-->
						
					   <!--<div class="control-group">
						  <label class="control-label">PayPal Mode</label>
						  <div class="controls">
							 <label class="radio line">
							 <input type="radio" name="paypal_mode" value="sandbox" <?=$settings['paypal_mode'] == 'sandbox' ? 'checked' : ''?>/>
							 Sandbox
							 </label>
							 <label class="radio line">
							 <input type="radio" name="paypal_mode" value="live" <?=$settings['paypal_mode'] == 'live' ? 'checked' : ''?>/>
							 Live
							 </label>  
						  </div>
					   </div>-->
					   
					   <!--<div class="control-group">
						  <label class="control-label">PayPal Business ID</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="paypal_business_id" id="paypal_business_id" value="<?=$settings['paypal_business_id']?>"/>
						  </div>
					   </div>-->
					   
					  <!-- <div class="control-group">
						  <label class="control-label">Gallery Big Thumb Dimension</label>
						  <div class="controls" style="line-height:34px">
							 <input type="text" class="span6 m-wrap"  name="gallery_bigthmb_width" id="gallery_bigthmb_width" value="<?=$settings['gallery_bigthmb_width']?>" style="width:50px;" readonly/>
							 &nbsp;X&nbsp;
							 <input type="text" class="span6 m-wrap"  name="gallery_bigthmb_height" id="gallery_bigthmb_height" value="<?=$settings['gallery_bigthmb_height']?>" style="width:50px;" readonly/> 
						  </div>
					   </div>
					   
					   <div class="control-group">
						  <label class="control-label">Gallery Small Thumb Dimension</label>
						  <div class="controls" style="line-height:34px">
							 <input type="text" class="span6 m-wrap"  name="gallery_smallthmb_width" id="gallery_smallthmb_width" value="<?=$settings['gallery_smallthmb_width']?>" style="width:50px;" readonly/>
							 &nbsp;X&nbsp;
							 <input type="text" class="span6 m-wrap"  name="gallery_smallthmb_height" id="gallery_smallthmb_height" value="<?=$settings['gallery_smallthmb_height']?>" style="width:50px;" readonly/>
						  </div>
					   </div>-->
					   
					   <!--<div class="control-group">
						  <label class="control-label">Banner Dimension</label>
						  <div class="controls" style="line-height:34px">
							 <input type="text" class="span6 m-wrap"  name="banner_width" id="banner_width" value="<?=$settings['banner_width']?>" style="width:50px;"/>
							 &nbsp;X&nbsp;
							 <input type="text" class="span6 m-wrap"  name="banner_height" id="banner_height" value="<?=$settings['banner_height']?>" style="width:50px;"/>
						  </div>
					   </div>-->
					   
					   <!--<div class="control-group">
						  <label class="control-label">Place Cover Dimension</label>
						  <div class="controls" style="line-height:34px">
							 <input type="text" class="span6 m-wrap"  name="place_cover_width" id="place_cover_width" value="<?=$settings['place_cover_width']?>" style="width:50px;"/>
							 &nbsp;X&nbsp;
							 <input type="text" class="span6 m-wrap"  name="place_cover_height" id="place_cover_height" value="<?=$settings['place_cover_height']?>" style="width:50px;"/>
						  </div>
					   </div>-->
					   
					   <!--<div class="control-group">
						  <label class="control-label">Default Currency</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="default_currency" id="default_currency" value="<?=$settings['default_currency']?>"/>
						  </div>
					   </div>-->
					   
					   <!--<div class="control-group">
						  <label class="control-label">Default Language</label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap"  name="default_lang" id="default_lang" value="<?=$settings['default_lang']?>"/>
						  </div>
					   </div>-->
					   
					   <div class="form-actions">
						  <button type="submit" class="btn blue">Submit</button>
						  <button type="button" class="btn" id="cancel">Cancel</button>
					   </div>
					</form>
							</div>
                            <!-- Light Box 2 Start-->
							
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