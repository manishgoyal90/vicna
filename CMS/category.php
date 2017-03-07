<?php include"lib/header.php";


	//Add Photo
	if($_REQUEST['photosubmit']=="Submit") {
			
			$InserSql = "INSERT INTO ".TABLE_PREFIX."news_category SET 
																		CategoryName ='".$_REQUEST['CategoryName']."', 
																		CategoryStatus ='Yes'
																		";
			mysql_query($InserSql)or die(mysql_error());
			
			header('location:category.php?action=added'.'#tab_1_1');
			
	}
	
	//Add Post
	if($_REQUEST['postsubmit']=="Submit") {
			
			$InserSql = "INSERT INTO ".TABLE_PREFIX."post_category SET 
																		CategoryName ='".$_REQUEST['CategoryName']."', 
																		CategoryStatus ='Yes'
																		";
			mysql_query($InserSql)or die(mysql_error());
			
			header('location:category.php?action=added'.'#tab_1_2');
			
	}
	

	// Update page details
if($_REQUEST['editsubmit2']== "Update")
{
		$pageidold = $_REQUEST['photoid'];
		
		$update = "UPDATE ".TABLE_PREFIX."news_category SET 
													CategoryName = '".$_REQUEST['CategoryName']."'
													WHERE CatId = '".$pageidold."'";   
		mysql_query($update) or die(mysql_error());
	
	  	header("location:category.php?action=update".'#tab_1_1');
}

	// Update page details
if($_REQUEST['editpostsubmit']== "Update")
{
		$pageidold = $_REQUEST['postid'];
		
		$update = "UPDATE ".TABLE_PREFIX."post_category SET 
													CategoryName = '".$_REQUEST['CategoryName']."'
													WHERE PostCatId = '".$pageidold."'";	   
		mysql_query($update) or die(mysql_error());
		
	  	header("location:category.php?action=update".'#tab_1_2');
}


if(isset($_REQUEST['delid2'])!='') {
	
		$delsingle = "DELETE FROM ".TABLE_PREFIX."news_category WHERE CatId = '".$_REQUEST['delid2']."'";
		mysql_query($delsingle) or die(mysql_error());
	
		header('location:category.php?action=deleted'.'#tab_1_1');
}
if(isset($_REQUEST['delpostid'])!='') {
	
		$delsingle = "DELETE FROM ".TABLE_PREFIX."post_category WHERE PostCatId = '".$_REQUEST['delpostid']."'";
		mysql_query($delsingle) or die(mysql_error());
	
		header('location:category.php?action=deleted'.'#tab_1_2');
}
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
					  if($_REQUEST['action'] == 'added')
					  {
					  ?>
					 <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Category Added...
					  </div>
					  <?php
					  }
					  ?>
                      
                      <?php
					  if($_REQUEST['action'] == 'update')
					  {
					  ?>
					 <div class="alert alert-success">
						<button data-dismiss="alert" class="close"></button>
						Successfully Category Update...
					  </div>
					  <?php
					  }
					  ?>
                      
                      <?php
					  if($_REQUEST['action'] == 'notupdate')
					  {
					  ?>
					 <div class="alert alert-error">
						<button data-dismiss="alert" class="close"></button>
						Comedy Category Not Update...
					  </div>
					  <?php
					  }
					  ?>
                      
                       <?php
					  if($_REQUEST['action'] == 'deleted')
					  {
					  ?>
					 <div class="alert alert-error">
						<button data-dismiss="alert" class="close"></button>
						Successfully Category Deleted...
					  </div>
					  <?php
					  }
					  ?>
                      <?php
					  if($_REQUEST['action'] == 'notdeleted')
					  {
					  ?>
					 <div class="alert alert-error">
						<button data-dismiss="alert" class="close"></button>
						Comedy Category Not Deleted...
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
				<div class="row-fluid profile">
					<div class="span12">
                        <!-- BEGIN Tab-->
                        <div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1_1" data-toggle="tab">News Category</a></li>
                                <li><a href="#tab_1_2" data-toggle="tab">Blog Category</a></li>
							</ul>
							<div class="tab-content">
								
								<!--tab_1_2-->
								<div class="tab-pane profile-classic row-fluid active" id="tab_1_1">
										<div class="row-fluid">
											<div class="span profile-info">
												<table  class="table table-striped table-bordered table-advance table-hover" id="sample_2">
													<tr>
                                                     <td colspan="4"><h1>News Category List &nbsp;<a class="btn blue" data-toggle="modal" href="#responsive2">Add New <i class="icon-plus"></i></a></h1></td>
													</tr>
													<tr>
														<td style="font-size:18px;width:70px;">Sl No.</td>
														<td style="font-size:18px; width:200px;">Category Name</td>
														<td style="font-size:18px;">Status</td>
                                                        <td style="font-size:18px;">Action</td>
													</tr>
												<?php
													$c12 = 1;
                                                    $CatSql12 = "SELECT * FROM ".TABLE_PREFIX."news_category ORDER BY CategoryName ASC";
                                                    $CatQuery12 = mysql_query($CatSql12) or die(mysql_error());
                                                    $NumRows12 = mysql_num_rows($CatQuery12);
													if($NumRows12>0) {
													while($ArrFetch12 = mysql_fetch_array($CatQuery12)) {
											   ?>
													<tr>
														<td style="padding-left:15px;"><?=$c12?></td>
														<td style="padding-left:15px;"><?=$ArrFetch12['CategoryName']?></td>
														<td style="padding-left:15px;"><?php if($ArrFetch12['CategoryStatus']=="Yes"){ echo"Active";} else { echo "InActive"; }?></td>
                                                        <td style="padding-left:15px;">
                                                        <a class="btn green mini" data-toggle="modal" href="#responsedit2<?=$c12?>">Edit <i class="icon-edit"></i></a>
                                                         <!------------------------Edit in lightbox Start--------------->
											 <div id="responsedit2<?php echo $c12; ?>" class="modal hide fade dip" tabindex="-1" data-width="500">		 	
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h3>Edit Category</h3>
												</div>
												<form name="frmpageedt12" id="frmpageedt12" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data">	
													<input type="hidden" name="photoid" value="<?=$ArrFetch12['CatId']?>">			
													<div class="modal-body">
														
														<div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
															<div class="row-fluid">
																<div class="span10">
																	   <div class="control-group">
																		  <label class="control-label">Category Name</label>
																		  <div class="controls">
																			 <input type="text" class="span m-wrap" name="CategoryName" id="CategoryName" value="<?=$ArrFetch12['CategoryName']?>"/>
																		  </div>
																	   </div>
																 </div>																
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" data-dismiss="modal" class="btn">Close</button>
														<input type="submit" class="btn blue" name="editsubmit2" value="Update" />
													</div>
												</form>
											</div>
										<!------------------------Edit in lightbox End--------------->
                                                        <a class="btn red mini" data-toggle="modal" href="category.php?delid2=<?=$ArrFetch12['CatId']?>"  onClick="return confirm('Are you sure');">Delete <i class="icon-trash"></i></a>
                                                        </td>
                                                        
													</tr>
                                                    <?php $c12++;} } else { ?>	
                                                    <tr>
														<td colspan="3"><h1 style="color:#ff0000;">No Record Available!</h1></td>
													</tr>
                                                    <?php } ?>								
												</table>												
											</div>
										</div>
								</div>
                                
                                <div class="tab-pane profile-classic row-fluid" id="tab_1_2">
										<div class="row-fluid">
											<div class="span profile-info">
												<table  class="table table-striped table-bordered table-advance table-hover" id="sample_2">
													<tr>
                                                     <td colspan="4"><h1>Blog Category List &nbsp;<a class="btn blue" data-toggle="modal" href="#responsivepost">Add New <i class="icon-plus"></i></a></h1></td>
													</tr>
													<tr>
														<td style="font-size:18px;width:70px;">Sl No.</td>
														<td style="font-size:18px; width:200px;">Category Name</td>
														<td style="font-size:18px;">Status</td>
                                                        <td style="font-size:18px;">Action</td>
													</tr>
												<?php
													$p = 1;
                                                    $CatSqlPost = "SELECT * FROM ".TABLE_PREFIX."post_category ORDER BY CategoryName ASC";
                                                    $CatQueryPost = mysql_query($CatSqlPost) or die(mysql_error());
                                                    $NumRowsPost = mysql_num_rows($CatQueryPost);
													if($NumRowsPost>0) {
													while($ArrFetchPost = mysql_fetch_array($CatQueryPost)) {
											   ?>
													<tr>
														<td style="padding-left:15px;"><?=$p?></td>
														<td style="padding-left:15px;"><?=$ArrFetchPost['CategoryName']?></td>
														<td style="padding-left:15px;"><?php if($ArrFetchPost['CategoryStatus']=="Yes"){ echo"Active";} else { echo "InActive"; }?></td>
                                                        <td style="padding-left:15px;">
                                                        <a class="btn green mini" data-toggle="modal" href="#responsedtpost<?=$p?>">Edit <i class="icon-edit"></i></a>
                                                         <!------------------------Edit in lightbox Start--------------->
											 <div id="responsedtpost<?php echo $p; ?>" class="modal hide fade dip" tabindex="-1" data-width="500">		 	
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h3>Edit Category</h3>
												</div>
												<form name="frmpageedt123" id="frmpageedt123" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data">	
													<input type="hidden" name="postid" value="<?=$ArrFetchPost['PostCatId']?>">			
													<div class="modal-body">
														
														<div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
															<div class="row-fluid">
																<div class="span10">
																	   <div class="control-group">
																		  <label class="control-label">Category Name</label>
																		  <div class="controls">
																			 <input type="text" class="span m-wrap" name="CategoryName" id="CategoryName" value="<?=$ArrFetchPost['CategoryName']?>"/>
																		  </div>
																	   </div>
																 </div>																
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" data-dismiss="modal" class="btn">Close</button>
														<input type="submit" class="btn blue" name="editpostsubmit" value="Update" />
													</div>
												</form>
											</div>
										<!------------------------Edit in lightbox End--------------->
                                                        <a class="btn red mini" data-toggle="modal" href="category.php?delpostid=<?=$ArrFetchPost['PostCatId']?>"  onClick="return confirm('Are you sure');">Delete <i class="icon-trash"></i></a>
                                                        </td>
                                                        
													</tr>
                                                    <?php $p++;} } else { ?>	
                                                    <tr>
														<td colspan="3"><h1 style="color:#ff0000;">No Record Available!</h1></td>
													</tr>
                                                    <?php } ?>								
												</table>												
											</div>
										</div>
								</div>

								</div>
								<!--end tab-pane-->
								
								</div>
                        <!-- END Tab-->           
				 		</div>
							</div>
							
							<div id="responsive2" class="modal hide fade dip" tabindex="-1" data-width="500">		 	
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Add News Category</h3>
                                </div>
                                  <form name="form3" id="form3" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return check3();">				
                                        <div class="modal-body">
                                            
                                            <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
                                                <div class="row-fluid">
                                                    <div class="span10">
                                                           <div class="control-group">
                                                              <label class="control-label">Category Name <span style="color:#ff0000;">*</span></label>
                                                              <div class="controls">
                                                                 <input type="text" class="span m-wrap" name="CategoryName" id="CategoryName3" />
                                                              </div>
                                                           </div>
                                                     </div>																
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn">Close</button>
                                            <input type="submit" class="btn blue" name="photosubmit" value="Submit" />
                                        </div>
                                </form>
                            </div>

                            <!-- Light Box 2 Start-->
							<div id="responsivepost" class="modal hide fade dip" tabindex="-1" data-width="500">		 	
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h3>Add Blog Category</h3>
                                </div>
                                  <form name="form4" id="form4" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data" onsubmit="return checkpost();">				
                                        <div class="modal-body">
                                            
                                            <div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">
                                                <div class="row-fluid">
                                                    <div class="span10">
                                                           <div class="control-group">
                                                              <label class="control-label">Category Name <span style="color:#ff0000;">*</span></label>
                                                              <div class="controls">
                                                                 <input type="text" class="span m-wrap" name="CategoryName" id="CategoryName4" />
                                                              </div>
                                                           </div>
                                                     </div>																
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn">Close</button>
                                            <input type="submit" class="btn blue" name="postsubmit" value="Submit" />
                                        </div>
                                </form>
                            </div>
                           <!--Light2 Box End-->
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
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script  language="javascript" src="../js/frm_validator.js"></script>
<script type="text/javascript" language="javascript1.2"> 
function check()    
{
	var catname = document.getElementById('CategoryName1').value;
	if(catname.length=="") {
		alert("Please Enter Category Name");
		document.getElementById('CategoryName1').focus();
		return false;	
	}

}
function check1()    
{
	var catname = document.getElementById('CategoryName2').value;
	if(catname.length=="") {
		alert("Please Enter Category Name");
		document.getElementById('CategoryName2').focus();
		return false;	
	}

}
function check2()    
{
	var catname = document.getElementById('CategoryName3').value;
	if(catname.length=="") {
		alert("Please Enter Category Name");
		document.getElementById('CategoryName3').focus();
		return false;	
	}

}
function checkpost()    
{
	var catname = document.getElementById('CategoryName4').value;
	if(catname.length=="") {
		alert("Please Enter Category Name");
		document.getElementById('CategoryName4').focus();
		return false;	
   }

}
function checkpost2()    
	{
		var catname = document.getElementById('CategoryName5').value;
		if(catname.length=="") {
			alert("Please Enter Category Name");
			document.getElementById('CategoryName5').focus();
			return false;	
	}
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
			$.post('ajax/delmusiccat.php',{ feedid : id, mode : 'single' },
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