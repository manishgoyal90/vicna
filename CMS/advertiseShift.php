<?php include"lib/header.php";
		
		if(isset($_REQUEST['submit']) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'add' ) {  
					
					//$pageid = $_REQUEST['pageid']; 
					
				$date = date('Y-m-d', strtotime($_REQUEST['date']));
				$date = $date.' '.$_REQUEST['end_time'];
				$shiftEndTime = date('Y-m-d H:i:s', strtotime($date));
				
				$sql = mysql_query("SELECT Uid FROM hr_user_registration WHERE RegistrationNo = '".trim($_REQUEST['clientId']."'"));
				$count = mysql_num_rows($sql);
				if($count > 0){
					$fetch = mysql_fetch_array($sql);
					
					$Insert = "INSERT INTO staff_available_shift SET
															location = '".addslashes($_REQUEST['location'])."',
															qualification = '".$_REQUEST['qualification']."',
															role = '".addslashes($_REQUEST['role'])."',
															date = '".date('Y-m-d', strtotime($_REQUEST['date']))."',
															start_time = '".$_REQUEST['start_time']."' ,
															end_time = '".$_REQUEST['end_time']."' ,
															shiftEndTime = '".$shiftEndTime."',
															penalties = '".$_REQUEST['penalties']."' ,
															more_info = '".addslashes($_REQUEST['more_info'])."',
															clientId = '".$fetch['Uid']."',
															status = 'Unprocessed'";
					$Res = mysql_query($Insert)or mysql_error();
						
		
					echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
					echo "window.top.location.href='advertiseShift.php?mess=Successful';\n";
					echo "</script>";
					exit();
				}else{
					echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
					echo "window.top.location.href='advertiseShift.php?mess=clientId';\n";
					echo "</script>";
					exit();
				}
				
			} 
			
			if(isset($_REQUEST['submit']) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ) {  
					
					$id = $_REQUEST['id']; 
					
				$date = date('Y-m-d', strtotime($_REQUEST['date']));
				$date = $date.' '.$_REQUEST['end_time'];
				$shiftEndTime = date('Y-m-d H:i:s', strtotime($date));
				$sql = mysql_query("SELECT Uid FROM hr_user_registration WHERE RegistrationNo = '".trim($_REQUEST['clientId']."'"));
				$count = mysql_num_rows($sql);
				if($count > 0){
					$fetch = mysql_fetch_array($sql);
					$Update = "UPDATE staff_available_shift SET
															location = '".addslashes($_REQUEST['location'])."',
															qualification = '".$_REQUEST['qualification']."',
															role = '".addslashes($_REQUEST['role'])."',
															date = '".date('Y-m-d', strtotime($_REQUEST['date']))."',
															start_time = '".$_REQUEST['start_time']."' ,
															end_time = '".$_REQUEST['end_time']."' ,
															shiftEndTime = '".$shiftEndTime."',
															penalties = '".$_REQUEST['penalties']."' ,
															clientId = '".$fetch['Uid']."',
															more_info = '".addslashes($_REQUEST['more_info'])."'
															WHERE id = '".$id."'";
					$Res = mysql_query($Update)or mysql_error();
						
		
					echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
					echo "window.top.location.href='advertiseShiftView.php?Uid=".$id."&mess=Update';\n";
					echo "</script>";
					exit();
				}else{
					echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
					echo "window.top.location.href='advertiseShift.php?mess=clientId';\n";
					echo "</script>";
					exit();
				}
				
			} 
			
			//Fetch User Details
			$id = $_REQUEST['id'];
			
			$FetchUserSql = "SELECT * FROM staff_available_shift WHERE id = '".$id."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			
			
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
							<a href="advertiseShiftList.php">Advertised Shifts</a> 
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
					  if($_REQUEST['mess'] == 'Update')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Info Updated...
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
					   if($_REQUEST['mess'] == 'clientId')
					  {
					  ?>
					  <div class="alert alert-error">
						<button data-dismiss="alert" class="close"></button>
						Client ID not available!
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
								
						<div class="portlet-body">
                        <div>&nbsp;</div>
					<!-- BEGIN FORM-->
					<form name="cmspageform" id="cmspageform" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="margin:0; padding:0" enctype="multipart/form-data" onSubmit="return check();">
							<input type="hidden" name="action" value="<?=$_REQUEST['mode']?>">
							<input type="hidden" name="id" id="id" value="<?=$_REQUEST['id']?>">
							 <input type="hidden" name="oldimg" value="<?=$rowdest['cmsimg']?>">
							
							<div class="row-fluid">
                               <div class="span12 ">
                               
							   	 <div class="control-group">
                                     <label class="control-label">Client ID</label>
									  <div class="controls">
								<?php $fetch = mysql_fetch_array(mysql_query("SELECT RegistrationNo FROM hr_user_registration WHERE Uid = '".$rowdest['clientId']."'"));?>
										 <input type="text" class="span8 m-wrap" name="clientId" id="clientid" value="<?=$fetch['RegistrationNo']?>" />
									  </div>
                                  </div>
								  
                                  <div class="control-group">
                                     <label class="control-label">Location</label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="location" id="location" value="<?=$rowdest['location']?>" />
									  </div>
                                  </div>
								  
								 
                                  <div class="control-group">
                                     <label class="control-label">Qualification</label>
									  <div class="controls">
									  	<input type="text" class="span8 m-wrap" name="qualification" id="qualification" value="<?=stripslashes($rowdest['qualification'])?>" />
										
									  </div>
                                  </div>
								  <div class="control-group">
                                     <label class="control-label">Speciality</label>
									  <div class="controls">
									  	<input type="text" class="span8 m-wrap" name="role" id="role" value="<?=stripslashes($rowdest['role'])?>" />
										
									  </div>
                                  </div>
                                   <div class="control-group">
                                     <label class="control-label">Date</label>
									  <div class="controls">
										 <input type="date" class="span8 m-wrap" name="date" id="date" value="<?=$rowdest['date']?>" />
									  </div>
                                  </div>
                                   <div class="control-group">
                                     <label class="control-label">Start Time</label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="start_time" id="start_time" value="<?=$rowdest['start_time']?>" />
									  </div>
                                  </div>
                                   <div class="control-group">
                                     <label class="control-label">Finish Time</label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="end_time" id="end_time" value="<?=$rowdest['end_time']?>" />
									  </div>
                                  </div>
                                  <div class="control-group">
                                     <label class="control-label">Penalties</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap description" name="penalties" rows="6" ><?=stripslashes($rowdest['penalties'])?></textarea>
									  </div>
                                  </div>
                                   <div class="control-group">
                                     <label class="control-label">More Information</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap description" name="more_info" rows="6" ><?=stripslashes($rowdest['more_info'])?></textarea>
									  </div>
                                  </div>
                                  
                               </div>
                            </div>
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='availableShiftList.php'">Cancel</button>
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
			selector: ".description",
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