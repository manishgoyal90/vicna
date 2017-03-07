<?php include"lib/header.php";


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
						Successfully Available Shift Inserted...
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
									
                                    <div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
									</button>
									<ul class="dropdown-menu">
										<li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
									</ul>
								    </div>
								</div>-->
						<div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th>Client ID</th>
										<th>Client Name</th>
										<th class="hidden-480">Shift Location</th>
										<th class="hidden-480">Role</th>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Shift Time</th>
                                       	<th class="hidden-480" style="width:17%;">Status</th>
										
                                        <th class="hidden-480" width="15">Time Sheet</th>
										<!--<th class="hidden-480" style="width:8%">Action </th>-->
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									//$date = date('Y-m-d H:i:s', time());
									$GetUserSql = "SELECT sas.*, ur.RegistrationNo, ur.FirstName, ur.LastName FROM staff_available_shift as sas INNER JOIN book_nurse as bn ON sas.shiftid = bn.sl INNER JOIN hr_user_registration as ur ON ur.Uid = bn.clientId AND sas.accept_staffid != '' AND sas.shiftEndTime < NOW() AND sas.timeSheets != '' AND sas.clientStatus = 'Processed' ORDER BY sas.id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/>
                                        </td>
										<td><?=$rowdest['RegistrationNo'];?></td>
										<td><?=strtoupper($rowdest['FirstName'].' '.$rowdest['LastName']);?></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['location']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['role']);?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=date('d M Y', strtotime($rowdest['date']))?><br/><?=date('l', strtotime($rowdest['date']))?></div></td>
                                   
										<td class="hidden-480"><div class="videoWrapper">Start : <?php echo $rowdest['start_time'];?><br/>Finish : <?php echo $rowdest['end_time'];?></div></td>
                                       
                                         <td class="hidden-480" style="width:120px; text-align:center;">
											
												
											 <select class="span9" style="color:#CC3300; background-color:#99e3ff;" tabindex="1" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="Processed" <?=$rowdest['clientStatus'] == 'Processed' ? 'selected' : ''?>>Processed</option>
												<option value="Unprocessed" <?=$rowdest['clientStatus'] == 'Unprocessed' ? 'selected' : ''?>>Unprocessed</option>
											 </select>
										 
										</td>
									
                                        
                                        <td class="hidden-480" style="text-align:center">	
										<a title="Download Timesheet" href="../download.php?path=Timesheet&file=<?=$rowdest['timeSheets'];?>"><img src="../img/time_sheet.png" height="50" />
										</td>
										<!--<td class="hidden-480" style="text-align:center"> 
											<a href="completedShiftView.php?Uid=<?=$rowdest['id']?>" class="btn mini green"><i class="icon-edit"></i> View</a>                                      
                                          </td>-->
                                       </tr>
                                       <?php $ctn++; } ?>
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
     <script  language="javascript" src="../js/frm_validator.js"></script>
	<script type="text/javascript" language="javascript1.2">
    function check()
    { 
		if(frmValidate('userdetailinfo2','firstname','First Name','YES','')==false)
            {
                return false;
            }
		if(frmValidate('userdetailinfo2','lastname','Last Name','YES','')==false)
            {
                return false;
            }
        if(frmValidate('userdetailinfo2','email','Email','YES','')==false)
            {
                return false;
            }
        if(ChkEmail('userdetailinfo2','email')==false)
            {
                return false;
            }
        if(frmValidate('userdetailinfo2','password','Password','YES','')==false)
            {
                return false;
            }
	    if(frmValidate('userdetailinfo2','image',' Image','YES','')==false)
            {
                return false;
            }
		//Checkin Image	
		var fieldObj = document.userdetailinfo2.image;
		var FileName  = fieldObj.value;
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
		//Calculate File size.
		var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);

        if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
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
	    function check1()
			{ 
				if(frmValidate('userdetailinfo21','firstname','First Name','YES','')==false)
					{
						return false;
					}
				if(frmValidate('userdetailinfo21','lastname','Last Name','YES','')==false)
					{
						return false;
					}
					
					//Checkin Image	
					var fieldObj = document.userdetailinfo21.image;
					var FileName  = fieldObj.value;
					var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
					var FileSize = fieldObj.files[0].size;
					var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
					//Calculate File size.
					var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
			
					if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
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
				var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
				//Calculate File size.
				var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
		
				if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
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
			$.post('ajax/delShift.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/delUser2.php',{ feedids : str , mode : 'selected' },
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
	
	function cancelShift(id)
	{	
		var cnf = confirm("Are you sure to cancel?");
		
		if(cnf)
		{
			$.post('ajax/cancelShift.php',{ id : id });
		}
		window.location.reload();
		
	}
	function readvertise(id)
	{	
		var cnf = confirm("Are you sure to Re-Advertise?");
		
		if(cnf)
		{
			$.post('ajax/readvertiseShift.php',{ id : id });
			
		}
		window.location.reload();
		
	}
		/********************Status****************/
	function changestatus(stat,id)
	{
		$.post('ajax/statusCompletedClientShift.php',{ stat : stat , id : id });
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>