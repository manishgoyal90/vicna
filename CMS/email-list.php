<?php 
	
	include"lib/header.php";

	   /*------------------------------------------For delete laser---------------------------------------------------------------*/

	if(isset($_REQUEST['chk']))
	{
		if(($_REQUEST['chk']!=""))
			{
				$mail_id=implode(",",$_REQUEST['chk']);
				
				$TestiDelet="delete from ".TABLE_PREFIX."newslettermail where mail_id in ($mail_id) or mail_id='".$mail_id."' ";
				mysql_query($TestiDelet) or mysql_error();
				
				echo '<script language="javascript">';
				echo 'window.location="email-list.php?email=delsucc"';
				echo '</script>';
			}
	}
	
  /*------------------------------------------------End of delete laser---------------------------------------------------------------------------*/
  
  /*---------------------------------------------For pagination---------------------------------------------------------------------------*/
        
		$rows_per_page=30;
		if(isset($_REQUEST['page']))
			{
				$pagenumber=$_REQUEST['page'];
			}
		else
			{
				$pagenumber=1;
			}
		$offset=($pagenumber-1)*$rows_per_page;
		
		$sqlPage="select * from  ".TABLE_PREFIX."newslettermail order by mail_date asc ";
		$result=mysql_query($sqlPage) or mysql_error();
		$totnumrow=mysql_num_rows($result);
		$totrow=ceil($totnumrow/$rows_per_page);

 /*--------------------------------------------------End of pagination-----------------------------------------------------------------------*/
 
 /*--------------------------For laser info List------------------------------------------------------*/
  
/*	$TestiInfoSql="select * from  ".TABLE_PREFIX."newslettermail order by mail_date asc limit $offset,$rows_per_page ";*/
	$TestiInfoSql="select * from  ".TABLE_PREFIX."newslettermail order by mail_date asc";
	$resultTestiInfo=mysql_query($TestiInfoSql) or mysql_error();
	$TestiInfoNumber=mysql_num_rows($resultTestiInfo);
	
  /*---------------------------End of laser Info List---------------------------------------------------*/
  
  /*------------------For message---------------------------------------------------------------------*/
  
	if($_REQUEST['email']=="delsucc")
		{
			$MsgDel="Delete operation Successful !";
		}
  /*---------------End of message-----------------------------------------------------------------------*/	
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
						Successfully Tips Advice Added...
					  </div>
                      <?php }  
					  if($_REQUEST['mess'] == 'updatesuccessful')
					  {
					  ?>
					  <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Tips Advice Updated...
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
								<div class="table-toolbar">
									 <div class="btn-group">
										<!--<a class="btn blue" href="tipsadvice.php?mode=add">Add New <i class="icon-plus"></i></a>-->
									</div>
                                    <div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>
									</button>
									<ul class="dropdown-menu">
										<li><a onclick="delselected()" style="cursor:pointer">Delete Selected</a></li>
									</ul>
								    </div>
								</div>
						<div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">E-Mail Address</th>
										<th class="hidden-480">date</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$p=1;
									while($testimonials=mysql_fetch_array($resultTestiInfo))
									{
										if($p%2==0)
											{
												$bgcolor="#f8f8f8";
											}
										else
											{
												$bgcolor="#ffffff"; 
											}
									 $showDate=date('F d ,  Y',strtotime($testimonials['mail_date']));	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$testimonials['mail_id']?>" name="feed[]"/>                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$testimonials['mail_address']?></div></td>
										<td class="hidden-480">
										  <?=$showDate?>
										  </td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$testimonials['mail_id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $p++; } ?>
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
<!--	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>  
	<script src="assets/scripts/ui-modals.js"></script> -->
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
		  // UIModals.init();
		   TableManaged.init();
		});
	
	/********************Delete****************/
	function deleteone(id)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
			$('.portlet .tools a.reload').click();
			$.post('ajax/delnewsletter.php',{ feedid : id, mode : 'single' },
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
				$.post('ajax/delnewsletter.php',{ feedids : str , mode : 'selected' },
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
		$.post('ajax/statustips.php',{ stat : stat , id : id });
	}
</script>
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>