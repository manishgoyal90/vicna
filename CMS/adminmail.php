<?php include"lib/header.php";?>
<?php
if(isset($_REQUEST['submit']) == 'Update')
{

		$UpdatePass = "UPDATE ".TABLE_PREFIX."admin_mail SET
					   MailAddress = '".$_REQUEST['MailAddress']."' WHERE MailId = '".$_REQUEST['adid']."'"; 
					   
		mysql_query($UpdatePass) or die();
		
		header('location:adminmail.php?action=update');
}
	$GetSqlPass = "SELECT * FROM ".TABLE_PREFIX."admin_mail WHERE MailId = '1'";
	$GetQueryPass = mysql_query($GetSqlPass) or die(mysql_error());
	$GetFetchPass = mysql_fetch_array($GetQueryPass);
?>
	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include"lib/leftbar.php";?>	
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
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
							 <?=$pagetitle?> <small></small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
							<li class="pull-right no-text-shadow">
								<!-- <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div> -->
							</li>
						</ul>
				<?php
				  if($_REQUEST['action'] == 'update')
				  {
				  ?>
				  
				  <div class="alert alert-success">
					<button data-dismiss="alert" class="close"></button>
					Successfully Mail Address Successfully Updated..... 
				  </div>
				  
				  <?php
				  }
				  if($_REQUEST['action']== 'wrongoldpass')
				  {
				  ?>
				  
				  <div class="alert alert-error">
					<button data-dismiss="alert" class="close"></button>
					Failed Wrong old password.... 
				  </div>
				  
				  <?php
				  }
				  ?>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- Statr Page body-->
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
				<div class="portlet-body form">
					<!-- BEGIN FORM-->
					<form action="<?=$_SERVER['PHP_SELF']?>" class="form-horizontal" name="frmchangepass" method="post" onSubmit="return passval()">
					   <input type="hidden" name="adid" value="<?=$GetFetchPass['MailId']?>">
					   <div class="control-group">
						  <label class="control-label">Mail Address : </label>
						  <div class="controls">
							 <input type="text" class="span6 m-wrap" name="MailAddress" id="MailAddress" value="<?=$GetFetchPass['MailAddress']?>" />
						  </div>
					   </div>
					   <div class="form-actions">
						  <input type="submit" class="btn blue" name="submit" value="Update">
						  <button type="button" class="btn"  id="cancel">Cancel</button>
					   </div>
					</form>
					<!-- END FORM-->           
				 </div>
			  </div>
			  
			  <!-- END SAMPLE FORM PORTLET-->
				<!-- End Page Body-->
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<?php include"lib/footer.php";?>
	</div>   
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->   
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		});
	</script> 

<script>
$('#cancel').click(function(){
	location.href = 'dashboard.php';
});
</script> 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>