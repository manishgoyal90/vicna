<?php include"lib/header.php";
		
		if($_REQUEST['submit']=="Submit") {  
					
					$pageid = $_REQUEST['pageid']; 
					
				
		$UpdateSql = "UPDATE ".TABLE_PREFIX."cms2 SET
														cms_pagetitle = '".addslashes($_REQUEST['cms_pagetitle'])."',
														text1 = '".addslashes($_REQUEST['cms_pagedes1'])."',
														text2 = '".addslashes($_REQUEST['cms_pagedes2'])."',
														text3 = '".addslashes($_REQUEST['cms_pagedes3'])."',
														text4 = '".addslashes($_REQUEST['cms_pagedes4'])."',
														text5 = '".addslashes($_REQUEST['cms_pagedes5'])."',
														text6 = '".addslashes($_REQUEST['cms_pagedes6'])."',
														text7 = '".addslashes($_REQUEST['cms_pagedes7'])."',
														text8 = '".addslashes($_REQUEST['cms_pagedes8'])."'
														WHERE id = '".$_REQUEST['pageid']."'";
				$Res = mysql_query($UpdateSql)or mysql_error();
					
	
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='cms.php?mess=updatesuccessful';\n";
				echo "</script>";
				exit();
				
			} 
			
			//Fetch User Details
			$pageid = $_REQUEST['pageid'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."cms2 WHERE id = '".$pageid."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			
			
			
			
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
							<a href="cms.php">CMS Page List</a> 
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
					<form name="cmspageform" id="cmspageform" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="POST" style="margin:0; padding:0" enctype="multipart/form-data" onSubmit="return check();">
							<input type="hidden" name="action" value="<?=$_REQUEST['mode']?>">
							<input type="hidden" name="pageid" id="pageid" value="<?=$_REQUEST['pageid']?>">
							
							
							<div class="row-fluid">
                               <div class="span12 ">
                               
                                  <div class="control-group">
                                     <label class="control-label">Page Title</label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="cms_pagetitle" id="cms_pagetitle" value="<?=$rowdest['cms_pagetitle']?>" />
									  </div>
                                  </div>
								  
								 <!--
								  <div class="control-group">
                                     <label class="control-label">Title 1<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title1"  value="<?=$rowdest['title1']?>" />
										 
									  </div>
                                  </div>-->
								
                                  <div class="control-group">
                                     <label class="control-label">Description 1</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes1" rows="6" id="cms_pagedes1"><?=stripslashes($rowdest['text1'])?></textarea>
										 <p id="remain1"></p>
									  </div>
									   
                                  </div>
								  <!--<div class="control-group">
                                     <label class="control-label">Title 2<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title2"  value="<?=$rowdest['title2']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 2</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes2" rows="6" id="cms_pagedes2"><?=stripslashes($rowdest['text2'])?></textarea>
										  <p id="remain2"></p>
									  </div>
									  
                                  </div>
								  <!--<div class="control-group">
                                     <label class="control-label">Title 3<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title3"  value="<?=$rowdest['title3']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 3</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes3" rows="6" id="cms_pagedes3"><?=stripslashes($rowdest['text3'])?></textarea>
										 <p id="remain3"></p>
									  </div>
									   
                                  </div>
								  <!-- <div class="control-group">
                                     <label class="control-label">Title 4<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title4"  value="<?=$rowdest['title4']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 4</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes4" rows="6" id="cms_pagedes4"><?=stripslashes($rowdest['text4'])?></textarea>
										 <p id="remain4"></p>
									  </div>
									   
                                  </div>
								   <!--<div class="control-group">
                                     <label class="control-label">Title 5<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title5"  value="<?=$rowdest['title5']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 5</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes5" rows="6" id="cms_pagedes5"><?=stripslashes($rowdest['text5'])?></textarea>
										  <p id="remain5"></p>
									  </div>
									  
                                  </div>
								   <!--<div class="control-group">
                                     <label class="control-label">Title 6<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title6"  value="<?=$rowdest['title6']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 6</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes6" rows="6" id="cms_pagedes6"><?=stripslashes($rowdest['text6'])?></textarea>
										 <p id="remain6"></p>
									  </div>
									   
                                  </div>
								   <!--<div class="control-group">
                                     <label class="control-label">Title 7<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title7"  value="<?=$rowdest['title7']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 7</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes7" rows="6" id="cms_pagedes7"><?=stripslashes($rowdest['text7'])?></textarea>
										  <p id="remain7"></p>
									  </div>
									  
                                  </div>
								  <!-- <div class="control-group">
                                     <label class="control-label">Title 8<span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <input type="text" class="span8 m-wrap" name="title8"  value="<?=$rowdest['title8']?>" />
										 
									  </div>
                                  </div>-->
								   <div class="control-group">
                                     <label class="control-label">Description 8</label>
									  <div class="controls">
										 <textarea class="span12 ckeditor m-wrap" name="cms_pagedes8" rows="6" id="cms_pagedes8"><?=stripslashes($rowdest['text8'])?></textarea>
										 <p id="remain8"></p>
									  </div>
									   
                                  </div>
								
								  
								  
                                 
                               </div>
                            </div>
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='cms.php'">Cancel</button>
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
	<script>
	
	var charLmt = "100";//max charterer 
	 $('#cms_pagedes1').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain1').css('color', 'red');
            $('#remain1').text('Character remain '+remain+' of '+charLmt);
         });
		 
	var charLmt2 = "100";//max charterer 
	 $('#cms_pagedes2').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt2));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt2) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain2').css('color', 'red');
            $('#remain2').text('Character remain '+remain+' of '+charLmt2);
         });
		 
	var charLmt3 = "100";//max charterer 
	 $('#cms_pagedes3').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt3));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt3) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain3').css('color', 'red');
            $('#remain3').text('Character remain '+remain+' of '+charLmt3);
         });
		 
	var charLmt4 = "100";//max charterer 
	 $('#cms_pagedes4').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt4));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt4) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain4').css('color', 'red');
            $('#remain4').text('Character remain '+remain+' of '+charLmt4);
         });
	var charLmt5 = "100";//max charterer 
	 $('#cms_pagedes5').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt5));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt5) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain5').css('color', 'red');
            $('#remain5').text('Character remain '+remain+' of '+charLmt5);
         });
		 
	var charLmt6 = "100";//max charterer 
	 $('#cms_pagedes6').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt6));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt6) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain6').css('color', 'red');
            $('#remain6').text('Character remain '+remain+' of '+charLmt6);
         });
		 
	var charLmt7 = "100";//max charterer 
	 $('#cms_pagedes7').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt7));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt7) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain7').css('color', 'red');
            $('#remain7').text('Character remain '+remain+' of '+charLmt7);
         });
		 
	var charLmt8 = "100";//max charterer 
	 $('#cms_pagedes8').keydown(function() {
	 	
            var tlength = $(this).val().length;
			
            $(this).val($(this).val().substring(0,charLmt8));
            var tlength = $(this).val().length;
            remain = parseInt(charLmt6) - parseInt(tlength);
			//remain = parseInt(tlength);
			$('#remain8').css('color', 'red');
            $('#remain8').text('Character remain '+remain+' of '+charLmt8);
         });
	
	
			
	</script>
	
	
<script type="text/javascript" language="javascript1.2"> 
function check()    
{
	if(frmValidate('cmspageform','cms_page_heading','Heading','YES','')==false)
		{
			return false;
		}
/*	if(frmValidate('cmspageform','cms_page_subheading','Sub Heading','YES','')==false)
		{
			return false;
		}*/
}

</script>  
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		  // UIModals.init();
		   //TableManaged.init();
		   
			
		   tinymce.init({
			selector: "ckeditor",
			/*height:500,*/
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