<?php include"lib/header.php"; ?>	
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
					  if($_REQUEST['mess'] == 'replysend')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Reply Sended...
					  </div>
                      <?php }  
					  if($_REQUEST['mess'] == 'updatesuccessful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Page Updated...
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
										<a class="btn blue" href="Photo.php?mode=add">Add New <i class="icon-plus"></i></a>
									</div>
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
										<th class="hidden-480">Nos.</th>
										<th class="hidden-480">Client Name</th>
										<th class="hidden-480">Shift date and time</th>
										<th>Action</th>
										
										
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM book_nurse order by sl desc";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($row = mysql_fetch_array($GetQuery))
									{ 
										$stuffId11="";
										$stuffId22="";
										$stuffId33="";
										
										$sql11 = "SELECT * FROM stuff_booked where booking_sl='".$row['sl']."'";
										$query11 = mysql_query($sql11) or die("Error2: ".mysql_error());
										while($row11 = mysql_fetch_array($query11))
										{										
											if($row11['shift']==1){$stuffId11=$row11['stuffId'];$shift11=$row11['shift'];}
											if($row11['shift']==2){$stuffId22=$row11['stuffId'];$shift22=$row11['shift'];}
											if($row11['shift']==3){$stuffId33=$row11['stuffId'];$shift33=$row11['shift'];}
										}	
								
									?>
									<tr class="odd gradeX">
										<td><?=$ctn;?></td>
										<!--<td class="hidden-480">
											<div class="videoWrapper"><?=$row['clientId']?></div> 
										</td>-->
										<td class="hidden-480">
										<?php
										$g = "SELECT FirstName,LastName FROM hr_user_registration where Uid='".$row['clientId']."' ";
									$gq = mysql_query($g) or die(mysql_error());
									while($row34 = mysql_fetch_array($gq))
									{ 	echo $row34['FirstName']." ". $row34['LastName'];
									}
										
										?>
										 
										</td>
										
										
										<td class="hidden-480">
											<?php 
											if($row['firstShiftDate']){
												
												
												
											echo "<b>First Shift:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> 
											
											<font color='blue'>Date:".$row['firstShiftDate']."</font> 
											<font color='green'>Time(".$row['startTime1']."-".$row['finishTime1'].")</font> 
											Word/area:".$row['word1']." 
											Class:".$row['class1']." 
											Req:".$row['staffReqstd1'];
											if($stuffId11 != ""){
													$sql_name = "SELECT FirstName,LastName FROM hr_staff_registration where Uid='".$stuffId11."'";
													$q_name = mysql_query($sql_name) or die("Error2: ".mysql_error());
													$r_name = mysql_fetch_array($q_name);
													$stuffFirstName=$r_name['FirstName'];$stuffLastName=$r_name['LastName'];
												
											echo "<font color='green'><b> Booked Stuff Name: $stuffFirstName $stuffLastName </b></font><br>";
											}
											echo "<br/><b>Status : ".$row['firstShift']."ed</b>
											
											<br>";}
											
											if($row['secondShiftDate']){
											echo "<b>Second Shift:</b> 
											
											<font color='blue'>Date:".$row['secondShiftDate']."</font> 
											<font color='green'>Time(".$row['startTime2']."-".$row['finishTime2'].")</font> 
											Word/Area:".$row['word2']." 
											Class:".$row['class2']." 
											Req:".$row['staffReqstd2'];
											if($stuffId22 != ""){
													$sql_name = "SELECT FirstName,LastName FROM hr_staff_registration where Uid='".$stuffId22."'";
													$q_name = mysql_query($sql_name) or die("Error2: ".mysql_error());
													$r_name = mysql_fetch_array($q_name);
													$stuffFirstName=$r_name['FirstName'];$stuffLastName=$r_name['LastName'];
												
											echo "<font color='green'><b> Booked Stuff Name: $stuffFirstName $stuffLastName </b></font><br>";
											}
											echo "<br/><b>Status : ".$row['secondShift']."ed</b>
											<br>";}
											
											if($row['thirdShiftDate']){
											echo "<b>Third Shift:&nbsp;&nbsp;&nbsp;</b> 
											
											<font color='blue'>Date:".$row['thirdShiftDate']."</font> 
											<font color='green'>Time(".$row['startTime3']."-".$row['finishTime3'].")</font> 
											Word/area:".$row['word3']." 
											Class:".$row['class3']." 
											Req:".$row['staffReqstd3'];
											if($stuffId33 != ""){
													$sql_name = "SELECT FirstName,LastName FROM hr_staff_registration where Uid='".$stuffId33."'";
													$q_name = mysql_query($sql_name) or die("Error2: ".mysql_error());
													$r_name = mysql_fetch_array($q_name);
													$stuffFirstName=$r_name['FirstName'];$stuffLastName=$r_name['LastName'];
												
											echo "<font color='green'><b> Booked Stuff Name: $stuffFirstName $stuffLastName </b></font><br>";
											}
											echo "<br/><b>Status : ".$row['thirdShift']."ed</b>
											<br>";}
											
											?>
										</td>
										<!--<td class="hidden-480">
											<div class="videoWrapper"><?=substr(strip_tags(stripslashes($rowdest['cms_page_subheading'])),0,10)?></div> 
										</td>-->
										
										<td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="processBooking.php?sl=<?=$row['sl']?>">Process <i class="icon-edit"></i></a>                            			</td>
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
			$.post('ajax/delphoto.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/delphoto.php',{ feedids : str , mode : 'selected' },
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