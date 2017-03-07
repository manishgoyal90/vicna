<?php include"lib/header.php";

		if($_REQUEST['action']=="add" && $_REQUEST['Id']=='') {   
			
			$regNo = $_REQUEST['regNo'];
			$year = date('Y');
			$sql = mysql_query("SELECT * FROM ".TABLE_PREFIX."staff_registration WHERE RegistrationNo = '".$regNo."'");
			$row = mysql_num_rows($sql);
			if($row > 0){
				$fetch = mysql_fetch_array($sql);
			
				
		 	
				$Insert = "INSERT INTO ".TABLE_PREFIX."superstar SET 
														name = '".addslashes($fetch['FirstName'].' '.$fetch['LastName'])."',
														regNo = '".addslashes($_REQUEST['regNo'])."',
														images= '".addslashes($fetch['UserImage'])."',
														description = '".addslashes($_REQUEST['description'])."',
														month_of_superstar = '".addslashes($_REQUEST['month_of_superstar'])."', 
														year = '".$year."',
														";
				$Res = mysql_query($Insert)or mysql_error();
				
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='superstar.php?mess=successful';\n";
				echo "</script>";
				exit();
			
			}else{
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo 'alert(Please check Registration Number);';
				echo "window.top.location.href='superstaraddedit.php';\n";
				echo "</script>";
				exit();
			}	
			
		}
		
		if($_REQUEST['action']=="edit" && $_REQUEST['BannerId']!='') {  
					
			$Id = $_REQUEST['Id'];    
			$year = date('Y');
			$sql = mysql_query("SELECT * FROM ".TABLE_PREFIX."staff_registration WHERE RegistrationNo = '".$regNo."'");
			$row = mysql_num_rows($sql);
			if($row > 0){
				$fetch = mysql_fetch_array($sql);
			
				$UpdateSql = "UPDATE ".TABLE_PREFIX."superstar SET
														name = '".addslashes($fetch['FirstName'].' '.$fetch['LastName'])."',
														regNo = '".addslashes($_REQUEST['regNo'])."',
														images= '".addslashes($fetch['UserImage'])."',
														description = '".addslashes($_REQUEST['description'])."',
														month_of_superstar = '".addslashes($_REQUEST['month_of_superstar'])."' 
														";
				$Res = mysql_query($UpdateSql)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='BannerList.php?mess=Updatesuccessful';\n";
				echo "</script>";
				exit();
			}else{
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo 'alert(Please check Registration Number);';
				echo "window.top.location.href='superstaraddedit.php';\n";
				echo "</script>";
				exit();
			}	
		}
			
			//Fetch User Details
			$Id = $_REQUEST['Id'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."superstar WHERE id = '".$Id."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			if($rowdest['images'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../profileImage/".$rowdest['images']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../profileImage/".$rowdest['images'];
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
						 <li>
							
							<a href="superstar.php">Superstar List</a> 
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
						<div class="portlet-body">
                        <div>&nbsp;</div>
					<!-- BEGIN FORM-->
					<form name="videoform" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="margin:0; padding:0" enctype="multipart/form-data" onSubmit="return check();">
							<input type="hidden" name="action" value="<?=$_REQUEST['mode']?>">
							<input type="hidden" name="Id" id="Id" value="<?=$_REQUEST['Id']?>">
                            
							<div class="row-fluid">
                               <div class="span12 ">
                               
                             
                               
                               <div class="control-group">
                                      <label class="control-label">Superstar Image <span style="color:#ff0000;">*</span> </label>
                                      <div class="controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; max-height: 150px; line-height: 20px;">
                                               <img src="<?=$pic?>" alt="" />
											   
                                            </div>
                                            
                                         </div>
                                         <span style="color:#CC0000; font-size:14px;">[ Image automatically inserted from profile image. ]</span>
                                      </div>
                                   </div>
                                   <div class="control-group">
                                     <label class="control-label">Registration No. <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
									  	<input type="text" class="span8 m-wrap" name="regNo" id="BannerNmae" value="<?=$rowdest['regNo']?>" />
									  </div>
								 </div>
								  
								 <!-- 
								  <div class="control-group">
                                     <label class="control-label">Name <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="link" id="link" value="<?=$rowdest['link']?>" />
									  </div>
                                  </div>-->
                                  <div class="control-group">
                                     <label class="control-label">About Superstar <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
									  	<textarea class="span12 ckeditor m-wrap" name="description" rows="6" id="BannerText"><?=stripslashes($rowdest['description'])?></textarea>
									  </div>
								 </div>
								 
								
                                  <div class="control-group">
                                     <label class="control-label">Month of Superstar<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
									  	<select class="span8 m-wrap" name="month_of_superstar" id="BannerNmae">
											<?php
											for($mnth = 1; $mnth <=12 ; $mnth++){ 
											$date = date('Y').'-'.$mnth.'-01';
											$month = date('F', strtotime($date));
											
											?>
											<option value="<?=$month?>" <?php if($month == $rowdest['month_of_superstar']){echo 'selected';}?>><?=$month?></option>
											<?php }?>
										</select>
									  	
									  </div>
								 </div>
								  
                                  
                               </div>
                            </div>
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='superstar.php'">Cancel</button>
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
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
    <script  language="javascript" src="../js/frm_validator.js"></script>
<script type="text/javascript" language="javascript1.2"> 
function check()    
{
	var BannerId = document.getElementById('BannerId').value;
	
	if(frmValidate('videoform','Uid',' User Name','YES','')==false)
		{
			return false;
		}
	if(BannerId.length=='') {
		if(frmValidate('videoform','cimage',' Image','YES','')==false)
			{
				return false;
			}
	}
	if(frmValidate('videoform','cat',' Category Name','YES','')==false)
		{
			return false;
		}
	if(frmValidate('videoform','BannerNmae',' Image Title','YES','')==false)
		{
			return false;
		}
	if(frmValidate('videoform','Author',' Author','YES','')==false)
		{
			return false;
		}
		//Checkin Image	
		var fieldObj = document.videoform.cimage;
		var FileName  = fieldObj.value;
		var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
		var FileSize = fieldObj.files[0].size;
		var FileSizeMB = (FileSize/2097152).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
		//Calculate File size.
		var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);

		if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>2097152)
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
				var FileSizeMB = (FileSize/2097152).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
				//Calculate File size.
				var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
		
				if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>2097152)
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
		  // UIModals.init();
		   //TableManaged.init();
		   tinymce.init({
			selector: "textarea",
			plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   toolbar: "insertfile undo redo | styleselect | bold italic | fontselect | fontsizeselect | sizeselect |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
		   style_formats: [
				{title: 'Bold text', inline: 'b'},
				{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
				{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
				{title: 'Example 1', inline: 'span', classes: 'example1'},
				{title: 'Example 2', inline: 'span', classes: 'example2'},
				{title: 'Table styles'},
				{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			]

		});
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