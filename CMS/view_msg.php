<?php include"lib/header.php";

  if($_REQUEST['p']==1)
  {
  $page="noti_list";
  }
  else if($_REQUEST['p']==2)
  {
   $page="msglist";
  }
  else if($_REQUEST['p']==3)
  {
  $page="msg_list";
  }
	
	$user_id=$_REQUEST['Uid'];
	$message_id=$_REQUEST['message_id'];
	$message_sender_id=$_REQUEST['message_sender_id'];
	
	/*--------------------------------------------end---------------------------------------*/

	$updateMsgeStatusSql="update ".TABLE_PREFIX."message set message_read_status='r' where message_id='".$message_id."'";
	$updateMsgeQuery=mysql_query($updateMsgeStatusSql) or mysql_error(); 
	 

	$MessageDetailsSql="select * from ".TABLE_PREFIX."message where message_id='".$message_id."'";
	$MessageDetailsQuery=mysql_query($MessageDetailsSql) or mysql_error();
	$MessageDetailsFetch=mysql_fetch_array($MessageDetailsQuery);
	
	$sendernameSql="select * from ".TABLE_PREFIX."user_registration where Uid='".$message_sender_id."'";
	$sendernameQuery=mysql_query($sendernameSql) or mysql_error();
	$sendernameFetch=mysql_fetch_array($sendernameQuery);

												
	if($sendernameFetch['UserImage'] == "")
	{
		$upic = "images/nopic.jpg";
	}
	else if(!is_file("../profileimage/bigimg/".$sendernameFetch['UserImage']))
	{
		$upic = "images/nopic.jpg";
	}
	else
	{
		$upic = "../profileimage/bigimg/".$sendernameFetch['UserImage'];
	}
 /*-----------------------------End profile Image Show---------------------------------------*/	
	
		
?>	
<style type="text/css">
.adsnal_tbl{
    clear: inherit !important;
    display: block;
    float: left !important;
    margin: 0 2% 0 0;
    padding: 0 2% 0 0;
   
}
.adsnal_tbl:last-child{border-right:none;}
.adsnal_tbl td{
	padding: 2px !important;
	border-top: none;
}
	
</style>
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
							<a href="userlist.php">User List</a> 
							<span class="icon-angle-right"></span>
						 </li>
						  <li>
							<a href="userinfo.php?Uid=<?=$_REQUEST['Uid']?>#tab_1_33">User Info</a> 
							<span class="icon-angle-right"></span>
						 </li>
						<li><a href="#"><?=$pagetitle?></a></li>
					  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
							<?php
					  if($_REQUEST['action'] == 'addcommentsuccessful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Comment Added...
					  </div>
					  <?php
					  }
					  if($_REQUEST['action'] == 'addreplysuccessful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Reply Added...
					  </div>
					  <?php } ?>
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
                               
                                	<table class="table table-striped table-bordered table-hover" id="sample_2">
											<tr bgcolor="<?php echo $bgcolor;?>">
												<td width="15%"   align="left" valign="top">
													  <img src="<?=$upic?>" class="img_thumb" style="width:100px; margin-top:0px; border:2px solid #999999" border="0"/>												  </td>
											  <td width="85%"><p style="margin-bottom:2px;"><a name="<?php echo $sendernameFetch['message_id'];?>" href="" style="color:#0078a5; font-weight:normal; font-size:18px;"><?php echo $sendernameFetch['FirstName'];?>&nbsp;<?php echo $sendernameFetch['LastName'];?><!--&nbsp;(&nbsp;<?php echo $sendernameFetch['UserName'];?>&nbsp;)--></a></p>
											  <!--<p style="margin-bottom:2px;">has received a message from you.</p>-->
											  <p style="margin-bottom:2px;"><strong>Subject : <?=stripslashes($MessageDetailsFetch['message_subject'])?></strong></p>
											  <p style="margin-bottom:2px;">Message : <?=stripslashes($MessageDetailsFetch['message_body'])?></p>
											  <!--<p style="margin-bottom:2px;"><a href="compose.php?view_user_id=<?php echo $_REQUEST['message_sender_id'];?>&parent_id=<?php echo $_REQUEST['parent_id'];?>" style="color:#003399;font-size:12px;"><b>Reply</b></a>&nbsp;&nbsp;-->
											  <?php if($_REQUEST['p']==1){?><a href="userinfo.php?Uid=<?=$_REQUEST['Uid']?>#tab_1_33" style="color:#000;font-size:12px;"><b>Back</b></a><?php } else if($_REQUEST['p']==2) {?><a href="userinfo.php?Uid=<?=$_REQUEST['Uid']?>#tab_1_55" style="color:#000;font-size:12px;"><b>Back</b></a><?php } else if($_REQUEST['p']==3) {?><a href="userinfo.php?Uid=<?=$_REQUEST['Uid']?>#tab_1_66" style="color:#000;font-size:12px;"><strong>Back</strong></a>&nbsp;&nbsp;<a title="Im Chat" href="#"><img style="width:20px;border-radius: 0%;display:inline; vertical-align:text-top;" src="img/chatint.png"></a><?php }?>
											  </p>
											  </td>
											</tr>
										</table>                              
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
			$.post('ajax/delvideo.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/delvideo.php',{ feedids : str , mode : 'selected' },
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