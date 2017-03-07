<?php include"lib/header.php";

			//Delete Sale Ticket
			if($_REQUEST['delid']!='' && $_REQUEST['EventId']) {
			
				$DelSqlTicket = "DELETE FROM ".TABLE_PREFIX."event_ticket WHERE id = '".$_REQUEST['delid']."'";
				mysql_query($DelSqlTicket);
				
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='EventView.php?EventId=".$_REQUEST['EventId']."&action=deleted';\n";
				echo "</script>";
				exit();	
			}
		
			$EventId = $_REQUEST['EventId'];
			//Fetch User Details
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."event_details WHERE EventId = '".$EventId."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			 
		if($rowdest['ImagePath'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../Event/bigimg/".$rowdest['ImagePath']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../Event/bigimg/".$rowdest['ImagePath'];
			}
			
					//For Coment Posting
		if($_REQUEST['submit']=="Submit Comment") {
			
			if($_REQUEST['comment']!='') {
			
			$InserSql = "INSERT INTO ".TABLE_PREFIX."comment_details SET
														ArticleId = '".$_REQUEST['EventId']."',
														CommentFor = 'Event',
														UserType = 'Admin',
														Email = '".$_REQUEST['mailid']."',
														Message = '".addslashes($_REQUEST['comment'])."',
														ComDate = NOW(),
														ComStatus = 'Yes'
															";
			mysql_query($InserSql)or mysql_error();
			
			}
			
			echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
			echo "window.top.location.href='EventView.php?EventId=".$_REQUEST['EventId']."&action=addcommentsuccessful';\n";
			echo "</script>";
			exit();	
	}
		
		//For Reply Posting  
		if($_REQUEST['submit']=="Submit Reply") {
			
			if($_REQUEST['reply']!='') {
			
			$InserSql = "INSERT INTO ".TABLE_PREFIX."reply_details SET
														ComId = '".$_REQUEST['comentid']."',
														ArticleId = '".$_REQUEST['videoid']."',
														ReplyFor = 'Event',
														Email = '".$_REQUEST['mailid']."',
														UserType = 'Admin',
														Message = '".addslashes($_REQUEST['reply'])."',
														ReplyDate = NOW(),
														ReplyStatus = 'Yes'
															";
			mysql_query($InserSql)or mysql_error();
			
			}
			
			echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
			echo "window.top.location.href='EventView.php?EventId=".$_REQUEST['EventId']."&action=addreplysuccessful&cmid=".$_REQUEST['comentid']."';\n";
			echo "</script>";
			exit();	
		}
		
		//Fetch Admin mailid
				$BidSql = "SELECT * FROM ".TABLE_PREFIX."admin_mail WHERE MailId = '1'";
				$BidSqlQuery = mysql_query($BidSql) or mysql_error();
				$BidFetch = mysql_fetch_array($BidSqlQuery);
				
				$BidFetch['MailAddress'];
			
			
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
					<input type="hidden" name="type" value="Photo" />
                    <input type="hidden" name="EventId" value="<?=$_REQUEST['EventId']?>" /> 
				   <input type="hidden" name="comentid" value="<?=$_REQUEST['comentid']?>" />
                   <input type="hidden" name="mailid" value="<?=$BidFetch['MailAddress']?>" />
							<div class="row-fluid">
                               <div class="span12 ">
                               
                               <div class="control-group">
                                      <label class="control-label">Image : </label>
                                      <div class="controls">
                                                 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><div class="fileupload-new thumbnail" style="width: 200px;">
                                                 <img src="<?=$pic?>" alt="" />
                                                 </div></label>
                                      </div>
                                   </div>
                                   
                                   <div class="control-group">
                                     <label class="control-label">Event Number : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><?=$rowdest['OrderNumber']?>	</label>
                                      </div>
                                  </div>

                                  <div class="control-group">
                                     <label class="control-label">Event Name : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><?=$rowdest['EventTitle']?>	</label>
                                      </div>
                                  </div>
								  
								  <div class="control-group">
                                     <label class="control-label">Event Country : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><?=$rowdest['EventCountry']?>	</label>
                                      </div>
                                  </div>
                                  
                                   <div class="control-group">
                                     <label class="control-label">Event Location : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><?=$rowdest['EventLocation']?>	</label>
                                      </div>
                                  </div>
                                  
                                 <div class="control-group">
                                     <label class="control-label">Event Start Date : </label>
									  <div class="controls" style="padding-left:100px;">
										 <label class="control-label"><?=date("jS M Y h:i a",strtotime($rowdest['EventStartDate']))?></label>
									  </div>
                                  </div>
                                  
                                  <div class="control-group">
                                     <label class="control-label">Event End Date : </label>
									  <div class="controls" style="padding-left:100px;">
										 <label class="control-label"><?=date("jS M Y h:i a",strtotime($rowdest['EventEndDate']))?></label>
									  </div>
                                  </div>
                                  
                                  <div class="control-group">
                                     <label class="control-label">Event Create Date : </label>
									  <div class="controls" style="padding-left:100px;">
										 <label class="control-label"><?=date("jS M Y h:i a",strtotime($rowdest['EventDate']))?></label>
									  </div>
                                  </div>
                                  
                                   <div class="control-group">
                                     <label class="control-label">Status : </label>
									  <div class="controls">
										 <label class="control-label" style="width:400px; text-align:left; padding-left:100px;"><?php if($rowdest['EventStatus']=="Yes") {echo "Active";} else { echo"InActive";}?></label>
									  </div>
                                  </div>
                                  
                                  <div class="control-group">
                                     <label class="control-label">Payment Status : </label>
									  <div class="controls">
										 <label class="control-label" style="width:400px; text-align:left; padding-left:100px;">
										 <?php /* if($rowdest['OrderStatus']=="3") {echo "Unpaid";} 
										 else if($rowdest['OrderStatus']=="1") {echo "Paid & Awaiting Shipping";}
										 else if($rowdest['OrderStatus']=="2") {echo "Paid & Order Dispatched";}
										 else if($rowdest['OrderStatus']=="4") {echo "Cancelled";}*/
										 ?>Free</label>
									  </div>
                                  </div>
                                  <div class="control-group">
                                     <label class="control-label">Descriptions : </label>
									  <div class="controls">
										 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><?=strip_tags(stripslashes($rowdest['EventDescriptions']))?></label>
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