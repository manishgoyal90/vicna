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
                              <script type="text/javascript">  
                                function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}
</script>
                                
						<div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
								<tr>
									<th>Nos.</th>
									<th>Staff Name</th>
									<th>Recipt no</th>
									<th style="width:50%;">Enquiry</th>
									<th>Status</th>
									<th>Date of Enquiry</th>
									<th>&nbsp;</th>
								</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM pay_enquires order by sl desc";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($row = mysql_fetch_array($GetQuery))
									{ 	
										$fet = mysql_fetch_array(mysql_query("SELECT FirstName, LastName FROM hr_staff_registration WHERE Uid = '".$row['Uid']."'"));
									?>
									
									<tr class="odd gradeX">
										<td><?=$ctn;?></td>
										<td class="hidden-480">
											<div class="videoWrapper"><?=$fet['FirstName'].' '.$fet['LastName'];?></div> 
										</td>
                                        
                                        <td class="hidden-480">
											<div class="videoWrapper"><?=$row['receipt_no']?></div> 
										</td>
                                        
										<td class="hidden-480">
											<?php 											
											echo $row['title'];											
											?> 
										</td>
										<td class="hidden-480">
											
											<select style="width:100px;" class="span9" id="stat" onChange="changestatus(this.value, <?=$row['sl']?>)">
												<option value="" <?php if($row['answered'] != 't'){echo 'selected';}?>>In Progress</option>
												<option value="t" <?php if($row['answered'] == 't'){echo 'selected';}?>>Resolved</option>
												
											 </select>
											<!--<?php if($row['answered']){echo("Answered");}else{echo "Not Answered";}?></div> -->
										</td>
                                        
                                        <td class="hidden-480">
											<div class="videoWrapper"><?=date('d F Y', strtotime($row['date']));;?></div> 
										</td>
										
										<td class="hidden-480">		
                                            <a onClick="PopupCenter('payEnquiries.php?sl=<?=$row['sl']?>','Billing Enquiries',800,300)" class="btn mini green" data-toggle="modal" href="#">Process <i class="icon-edit"></i></a>                            			</td>
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

	function changestatus(stat,id)
	{
		
		$.post('ajax/statusStaffEnquery.php',{ stat : stat , id : id });
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>