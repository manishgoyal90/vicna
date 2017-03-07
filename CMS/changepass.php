<?php include"lib/header.php";?>
<?php
if(isset($_REQUEST['changepass']) == 'yes')
{
	$GetSqlPass = "SELECT * FROM ".TABLE_PREFIX."admin_detail WHERE UserName = '".$_SESSION['admin_username']."'";
	$GetQueryPass = mysql_query($GetSqlPass) or die(mysql_error());
	$GetFetchPass = mysql_fetch_array($GetQueryPass);
	
	$getpass = $GetFetchPass['UserPassword']; 
	$passtocheck = base64_encode($_REQUEST['oldpass']); 
	
	if($passtocheck == $getpass)
	{
		$UpdatePass = "UPDATE ".TABLE_PREFIX."admin_detail SET
					   UserPassword = '".base64_encode($_REQUEST['newpass'])."' WHERE UserName = '".$_SESSION['admin_username']."'"; 
					   
		mysql_query($UpdatePass) or die();
		
		header('location:changepass.php?action=passchanged');
	}
	else
	{
		header('location:changepass.php?action=wrongoldpass');
	}
}
//Fetch admin pwd
	$GetSqlPass2 = "SELECT * FROM ".TABLE_PREFIX."admin_detail WHERE AdminId='1'";
	$GetQueryPass2 = mysql_query($GetSqlPass2) or die(mysql_error());
	$GetFetchPass2 = mysql_fetch_array($GetQueryPass2);
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
				  if($_REQUEST['action'] == 'passchanged')
				  {
				  ?>
				  
				  <div class="alert alert-success">
					<button data-dismiss="alert" class="close"></button>
					Successfully Password changed..... 
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
					   <input type="hidden" name="changepass" value="yes">
                       <div class="control-group">
						  <label class="control-label">Usewr Name</label>
						  <div class="controls">
				 			 <input type="text" class="span6 m-wrap" name="username" id="username" value="<?=$GetFetchPass2['UserName']?>" readonly />
						  </div>
					   </div>
					   <div class="control-group">
						  <label class="control-label">Old Password</label>
						  <div class="controls">
							 <input type="password" class="span6 m-wrap" name="oldpass" id="oldpass" value="<?=base64_decode($GetFetchPass2['UserPassword'])?>"/>
						  </div>
					   </div>
					   <div class="control-group">
						  <label class="control-label">New Password</label>
						  <div class="controls">
							 <input type="password" class="span6 m-wrap"  name="newpass" id="newpass"/>
							 <span class="help-inline" id="newpasserr">Some hint here</span>
						  </div>
					   </div>
					   <div class="control-group">
						  <label class="control-label">Confirm Password</label>
						  <div class="controls">
							 <input type="password" class="span6 m-wrap"  name="conpass" id="conpass"/>
							 <span class="help-inline" id="conpasserr">Some hint here</span>
						  </div>
					   </div>
					   <div class="form-actions">
						  <button type="submit" class="btn blue">Submit</button>
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
	function passval()
		{
			$("#oldpasserr").html('');
			$("#newpasserr").html('');
			$("#conpasserr").html('');
			
			$("#oldpasserr").hide();
			$("#newpasserr").hide();
			$("#conpasserr").hide();
			
			
			var oldpass = $("#oldpass").val();
			var newpass = $("#newpass").val();
			var conpass = $("#conpass").val();
			
					
			if(oldpass == "")
			{
				$("#oldpasserr").show();
				$("#oldpasserr").html('Enter old password');
			}
			if(newpass == "")
			{
				$("#newpasserr").show();
				$("#newpasserr").html('Enter new password');
			}
			if(conpass == "")
			{
				$("#conpasserr").show();
				$("#conpasserr").html('Confirm your password');
			}
			if(conpass != newpass)
			{
				$("#conpasserr").show();
				$("#conpasserr").html('Passwords mismatch');
			}
			if(oldpass != "" && newpass != "" && conpass == newpass && conpass != "")
			{
				document.frmchangepass.submit();
			}
			else
			{
				return false;
			}
		
		}
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