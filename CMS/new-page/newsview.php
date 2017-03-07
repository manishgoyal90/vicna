<?php include"lib/header.php";

			$NewsId = $_REQUEST['NewsId'];
			//Fetch User Details
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."news_details WHERE NewsId = '".$NewsId."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			 
		if($rowdest['ImagePath'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../News/bigimg/".$rowdest['ImagePath']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../News/bigimg/".$rowdest['ImagePath'];
			}
		
		//For Coment Posting
		if($_REQUEST['submit']=="Submit Comment") {
			
			if($_REQUEST['comment']!='') {
			
			$InserSql = "INSERT INTO ".TABLE_PREFIX."comment_details SET
														ArticleId = '".$_REQUEST['NewsId']."',
														CommentFor = 'News',
														UserType = 'Admin',
														Email = '".$_REQUEST['mailid']."',
														Message = '".addslashes($_REQUEST['comment'])."',
														ComDate = NOW(),
														ComStatus = 'Yes'
															";
			mysql_query($InserSql)or mysql_error();
			
			}
			
			echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
			echo "window.top.location.href='newsview.php?NewsId=".$_REQUEST['NewsId']."&action=addcommentsuccessful';\n";
			echo "</script>";
			exit();	
	}
		
		//For Reply Posting  
		if($_REQUEST['submit']=="Submit Reply") {
			
			if($_REQUEST['reply']!='') {
			
			$InserSql = "INSERT INTO ".TABLE_PREFIX."reply_details SET
														ComId = '".$_REQUEST['comentid']."',
														ArticleId = '".$_REQUEST['NewsId']."',
														ReplyFor = 'News',
														Email = '".$_REQUEST['mailid']."',
														UserType = 'Admin',
														Message = '".addslashes($_REQUEST['reply'])."',
														ReplyDate = NOW(),
														ReplyStatus = 'Yes'
															";
			mysql_query($InserSql)or mysql_error();
			
			}
			
			echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
			echo "window.top.location.href='newsview.php?NewsId=".$_REQUEST['NewsId']."&action=addreplysuccessful&cmid=".$_REQUEST['comentid']."';\n";
			echo "</script>";
			exit();	
		}
			
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
							<a href="newslist.php">News List</a> 
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
                   <input type="hidden" name="NewsId" value="<?=$_REQUEST['NewsId']?>" /> 
				   <input type="hidden" name="comentid" value="<?=$_REQUEST['comentid']?>" />
                   <input type="hidden" name="mailid" value="<?=$BidFetch['MailAddress']?>" />
							<div class="row-fluid">
                               <div class="span12 ">
                               
                               <!--<div class="control-group">
                                     <label class="control-label">User Name : </label>
									  <div class="controls">
										 <label class="control-label" style="width:400px; text-align:justify; padding-left:100px;"><?=$rowdest['FirstName']?>	 <?=$rowdest['FirstName']?>	</label>
									  </div>
                                  </div>-->
                               
                               <div class="control-group">
                                      <label class="control-label">Image : </label>
                                      <div class="controls">
                                                 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><div class="fileupload-new thumbnail" style="width: 200px;">
                                                 <img src="<?=$pic?>" alt="" />
                                                 </div></label>
                                      </div>
                                   </div>
                                   
                                 <!-- <div class="control-group">
                                     <label class="control-label">Category : </label>
                                     <div class="controls">
									 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['catname']?>	</label>
                                     </div>
                                  </div>-->
                                  
                                  <div class="control-group">
                                     <label class="control-label">Title : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['NewsTitle']?>	</label>
                                      </div>
                                  </div>
                                   <!--<div class="control-group">
                                     <label class="control-label">City : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['City']?>	</label>
                                      </div>
                                  </div>-->
                                   <div class="control-group">
                                     <label class="control-label">Author : </label>
                                     <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=$rowdest['Author']?>	</label>
                                      </div>
                                  </div>
                                  
                                   <!--<div class="control-group">
                                     <label class="control-label">Published Date : </label>
									  <div class="controls" style="padding-left:100px;">
										 <label class="control-label" style="width: 161px;"><?=date("jS M Y h:i a",strtotime($rowdest['PublishedDate']))?></label>
									  </div>
                                  </div>-->
                                  
                                   <div class="control-group">
                                     <label class="control-label">Date : </label>
									  <div class="controls" style="padding-left:97px;width:17%;">
										 <label class="control-label" style="width:87%;"><?=date("jS M Y h:i a",strtotime($rowdest['NewsDate']))?></label>
									  </div>
                                  </div>
                                  
                                   <div class="control-group">
                                     <label class="control-label">Status : </label>
									  <div class="controls">
										 <label class="control-label" style="width:87%; text-align:left; padding-left:100px;"><?php if($rowdest['NewsStatus']=="Yes") {echo "Active";} else { echo"InActive";}?></label>
									  </div>
                                  </div>
								  
								  <div class="control-group">
                                     <label class="control-label">Meta Keywords : </label>
									  <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=stripslashes($rowdest['MetaKeywords'])?></label>
									  </div>
                                  </div>
								  
								   <div class="control-group">
                                     <label class="control-label">Meta Descriptions : </label>
									  <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=stripslashes($rowdest['MetaDescription'])?></label>
									  </div>
                                  </div>
                                  
                                  <div class="control-group">
                                     <label class="control-label">Descriptions : </label>
									  <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;"><?=stripslashes($rowdest['NewsDescriptions'])?></label>
									  </div>
                                  </div> 
                                 <?php
								  	//For Display Comment Info
									$SqlCommentDetal = "SELECT * FROM ".TABLE_PREFIX."comment_details WHERE ArticleId = '".$_REQUEST['NewsId']."' AND CommentFor = 'News'";
									$ResSqlComment = mysql_query($SqlCommentDetal);
									$NumRowsCom = mysql_num_rows($ResSqlComment);
								  ?> 
                                  <!--<div class="control-group" style="padding-top:20px;">
                                     <label class="control-label"><?=$NumRowsCom?> Comments : </label>
                                     <div style="padding-top:27px;"> <hr /> </div>
									  <div class="controls">
										 <label class="control-label" style="width:87%; text-align:justify; padding-left:100px;">
                                         <table border="0"  class="adsnal_tbl table" style=" width: 400px;">
                                         <?php
													while($ArrFetchUCom = mysql_fetch_array($ResSqlComment)) {
													// For User Image.
													if($ArrFetchUCom['UserType']=="Admin") {
														$SqlUserDetal2 = "SELECT * FROM ".TABLE_PREFIX."admin_mail WHERE MailId  = '1'";
													} else {
														$SqlUserDetal2 = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$ArrFetchUCom['Email']."'";
													}
													
													$ResSqlUser2 = mysql_query($SqlUserDetal2);
													$ArrFetchUser2 = mysql_fetch_array($ResSqlUser2);
											?>
                                            <tr class="odd gradeX">
                                                <td rowspan="4" style="width:50px;">
                                                    <label class=""><img alt="avatar" src="../profileimage/smallimg/<?=$ArrFetchUser2['UserImage']?>" width="44px" /></label>
                                                </td>
                                                <td>
												<?php if($ArrFetchUCom['UserType']=="Admin") { echo "Admin"; } else { ?>
												<?=ucfirst($ArrFetchUser2['FirstName'])?>&nbsp; <?=ucfirst($ArrFetchUser2['LastName'])?>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                            <tr class="odd gradeX">
                                              <td><div style="text-align:left;"><?=stripslashes($ArrFetchUCom['Message'])?></div></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                              <td><a class="replay" href="newsview.php?NewsId=<?=$_REQUEST['NewsId']?>&comentid=<?=$ArrFetchUCom['ComId']?>">replay</a> | <?=$showDate=date('jS M Y  h : i a',strtotime($ArrFetchUCom['ComDate']));?></td>
                                            </tr>
                                             <tr class="odd gradeX">
                                              <td>&nbsp;</td>
                                            </tr>
                                            <?php
													//For Display Reply Info
													$SqlReplyDetal = "SELECT * FROM ".TABLE_PREFIX."reply_details WHERE ComId = '".$ArrFetchUCom['ComId']."' AND ReplyFor ='News'";
													$ResSqlReply = mysql_query($SqlReplyDetal);
													$NumRowsRep = mysql_num_rows($ResSqlReply); 
													if($NumRowsRep>0) {		
											?>
                                            <tr class="odd gradeX">
                                              <td colspan="2"><?=$NumRowsRep?>&nbsp; Reply</td>
                                            </tr>
                                            <tr class="odd gradeX">
                                              <td colspan="2"><hr style="width:100%;" /></td>
                                            </tr>
                                            <?php } ?>
                                            <tr class="odd gradeX">
                                              <td>&nbsp;</td>
                                              <td>
                                              	<table border="0"  class="adsnal_tbl table" style=" width:300px;">
                                                <?php
													while($ArrRep=mysql_fetch_array($ResSqlReply)) {
														// For User Image.
														if($ArrRep['UserType']=="Admin") {
															$SqlUserDetal23 = "SELECT * FROM ".TABLE_PREFIX."admin_mail WHERE MailId  = '1'";
														} else {
															$SqlUserDetal23 = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$ArrRep['Email']."'";
														}
														
														$ResSqlUser23 = mysql_query($SqlUserDetal23);
														$ArrFetchUser23 = mysql_fetch_array($ResSqlUser23);
														if($NumRowsRep>0) {		
												?>
                                                    <tr class="odd gradeX">
                                                        <td rowspan="4" style="width:50px;">
                                                            <label class=""><img alt="avatar" src="../profileimage/smallimg/<?=$ArrFetchUser23['UserImage']?>" width="44px" /></label>
                                                        </td>
                                                        <td>
														<?php 
                                                        if($ArrRep['UserType']=="Admin") { echo "Admin"; } else {
                                                        ?>	
														<?=ucfirst($ArrFetchUser23['FirstName'])?>&nbsp;<?=ucfirst($ArrFetchUser23['LastName'])?>
                                                        <?php } ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                      <td><div style="text-align:left;"><?=stripslashes($ArrRep['Message'])?></div></td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                      <td><?=$showDate=date('jS M Y  h : i a',strtotime($ArrRep['ReplyDate']));?></td>
                                                    </tr>
                                                     <tr class="odd gradeX">
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <?php } } ?>
                                                    <tr class="odd gradeX">
                                                    </tr>
                                                    <?php if($_REQUEST['comentid']==$ArrFetchUCom['ComId']) { ?>
                                                     <tr class="odd gradeX">
                                                     <td>&nbsp;</td>
                                                      <td><div style="padding-bottom:15px;">Reply Message : </div>
                                                 		<textarea class="m-wrap" name="reply" rows="6" id="reply" style="width:300px;" /></textarea></td>
                                                    </tr>
                                                    <tr class="odd gradeX">
                                                    	<td>&nbsp;</td>
                                                         <td>
                                                         <div style="padding-left:0px; padding-top:10px;">
                                                         <input type="submit" class="btn blue" name="submit" value="Submit Reply">
                                                         </div>
                                                         </td>
                                                    </tr>
                                                    <?php } ?>			
                                                </table>	
                                              </td>
                                            </tr>
                                            <?php } ?>				
											</table>
                                         
                                         </label>
									  </div>
                                      <div class="control-group">
                                     <label class="control-label" style="width:100%; text-align:justify; padding-left:50px;">Leave a Comment  : </label> 
									  <div class="controls">
										<label class="control-label" style="width:400px; text-align:justify; padding-left:100px;">
                                         <table border="0"  class="adsnal_tbl table" style=" width: 400px;">
                                             <tr class="odd gradeX">
                                                 <td colspan="2"><div style="padding-bottom:15px;">Comment Message : </div>
                                                 <textarea class="m-wrap" name="comment" rows="6" id="comment" style="width:350px;" /></textarea>
                                                 </td>
                                            </tr>
                                              <tr class="odd gradeX">
                                                 <td colspan="2">
                                                 <div style="padding-left:0px; padding-top:10px;">
                                                 <input type="submit" class="btn blue" name="submit" value="Submit Comment">
                                                 </div>
                                                 </td>
                                            </tr>
											</table>
                                         </label>
									  </div>
                                  </div>
                                  </div>-->
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