<?php include"lib/header.php";

			$id = $_REQUEST['id'];
			//Fetch User Details
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."apply WHERE id = '".$id."'"; 
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
							<a href="applicationlist.php">Application List</a> 
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
						Successfully User Created...
					  </div>
					  <?php
					  }
					  if($_REQUEST['mess'] == 'successfulupdate')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully User Info Updated...
					  </div>
					  <?php
					  }
					  if($_REQUEST['mess'] == 'unsuccessful')
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
						<div class="portlet-body form">
                        <div>&nbsp;</div>
					<!-- BEGIN FORM-->
					<form name="videoform" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="margin:0; padding:0" enctype="multipart/form-data" onSubmit="return check();">
							
							<div class="row-fluid">
                               <div class="span12 ">
                               <h3>Applicat Details</h3>
                               <div class="control-group">
                                     <label class="control-label">Full Name : </label>
									  <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['first_name'].' '.$rowdest['last_name']?></label>
									  </div>
                                  </div>
                               		 <div class="control-group">
                                     <label class="control-label">Date of Birth : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=date('d/m-Y', strtotime($rowdest['dob']));?>	</label>
                                     </div>
                                  </div>
                               		<div class="control-group">
                                     <label class="control-label">Email Address : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['email']?>	</label>
                                      </div>
                                  </div>
                                  
                                   
                                  <div class="control-group">
                                     <label class="control-label">Phone Number : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['phone']?>	</label>
                                     </div>
                                  </div>
                                  
                                  <div class="control-group">
                                     <label class="control-label">Street Address : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['street_address']?>	</label>
                                     </div>
                                  </div>
								   <div class="control-group">
                                     <label class="control-label">Country : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['country']?>	</label>
                                     </div>
                                  </div>
								   <div class="control-group">
                                     <label class="control-label">City : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['city']?>	</label>
                                     </div>
                                  </div>
								   <div class="control-group">
                                     <label class="control-label">Post Code: </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['post_code']?>	</label>
                                     </div>
                                  </div>
								   <div class="control-group">
                                     <label class="control-label">Qualification : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['qualification']?>	</label>
                                     </div>
                                  </div>
                                   <div class="control-group">
                                     <label class="control-label">Eligible to work in Australia : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['work_eligibility']?>	</label>
                                     </div>
                                  </div>
								   <div class="control-group">
                                     <label class="control-label">Experience : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['experience']?> Yrs.	</label>
                                     </div>
                                  </div>
								  
								   <div class="control-group">
                                     <label class="control-label">Registered with AHPRA to practice in Australia : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['register_ahpra']?>	</label>
                                     </div>
                                  </div>
								  
								  <div class="control-group">
                                     <label class="control-label">CV Details : </label>
                                     <div class="controls">
									 		<label class="control-label" style="width:87%; text-align:justify; padding-left:100px;">
											<?php if($rowdest['cv'] != ""){?>
									 			<a href='../download.php?path=apply&file=<?=$rowdest['cv']?>'>
												  <img src='../images/doc.png' title='<?=$rowdest['cv']?>' style="height:35px;">
												  </a>
											<?php }else{
												echo "<span style='color:red;'>N/A</span>";
											}
												
											?>
											
											</label>
                                     </div>
                                  </div>
								  
								   <div class="control-group">
                                     <label class="control-label">Comments : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['comments']?>	</label>
                                     </div>
                                  </div>
								  
                                   <div class="control-group">
                                     <label class="control-label">Apply Date : </label>
									  <div class="controls" style="padding-left:100px;">
										 <label class="control-label"><?=date("jS M Y h:i a",strtotime($rowdest['apply_date']))?></label>
									  </div>
                                  </div>
                                  
                                 
                                  
                               </div>
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
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		  // UIModals.init();
		   //TableManaged.init();
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