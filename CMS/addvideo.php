<?php include"lib/header.php";

		if($_REQUEST['submit']=="Submit") {   
			
							
						$Videofolder = "../video/";//folder path

						$video = $_FILES['VideoPath']['name'];
						$temp = $_FILES['VideoPath']['tmp_name'];
						if($_FILES['VideoPath']['name']!='') {
							$videopath = uniqid()."_".$video;
							$upload  = $Videofolder.$videopath; 
							@copy($temp,$upload);
						}
						if($_FILES['VideoPath']['name']!=''){
							$videopath = $videopath;
						} else {
							$videopath =  $_REQUEST['VideoPath277'];
						}  
						$ImageSql = "INSERT INTO ".TABLE_PREFIX."vgallery SET       
																	video_title = '".addslashes($_REQUEST['video_title'])."',
																	video_type = '".$_REQUEST['vtype']."',
																	video_path = '".$videopath."'
																	";
						  mysql_query($ImageSql)or mysql_error();
					
				echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
				echo "window.top.location.href='videogallerylist.php?mess=successful';\n";
				echo "</script>";
				exit();
		}	
			//Fetch User Details
			$id = $_REQUEST['id'];
			
			$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."vgallery WHERE id = '".$id."'"; 
			$FetchUserQuery = mysql_query($FetchUserSql);
			$NumRows =mysql_num_rows($FetchUserQuery);
			$rowdest = mysql_fetch_array($FetchUserQuery);
			
			if($rowdest['gallery_image'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../gallery2/bigimg/".$rowdest['gallery_image']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../gallery2/bigimg/".$rowdest['gallery_image'];
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
						  <li><a href="videogallerylist.php">Video List</a>
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
                            <input type="hidden" name="oldvideo" value="<?=$rowdest['VideoPath']?>">
							<input type="hidden" name="videoid" id="videoid" value="<?=$_REQUEST['videoid']?>">
							
							<div class="row-fluid">
                               <div class="span12 ">
                               <!--<div class="control-group">
                                      <label class="control-label">Image <span style="color:#ff0000;">*</span></label>
                                      <div class="controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; max-height: 150px; line-height: 20px;">
                                               <img src="<?=$pic?>" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select Picture</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="cimage" accept="image/jpeg" onchange="checkFile(this)" /></span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                         </div>
                                         <span style="font-size:12px; margin-bottom:10px;">Format : jpg, jpeg, png</span>
                                      </div>
                                   </div>-->
								   
								   <div class="control-group"> 
                                     <label class="control-label">Title <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										  <input type="text" name="video_title" id="video_title" class="span8 m-wrap" />	
									  </div>
                                  </div>
								   
								   <div class="control-group">
                                     <label class="control-label">Video Type <span style="color:#ff0000;">*</span></label>
									  <div class="controls">
										 <select name="vtype" id="vtype" class="span5 chosen" onchange="showvideo(this.value);">
                                            <option value="">Choose Type</option>
                                            <option value="1" <?php if($rowdest['VideoType']=="1"){echo"selected";}?>>You Tub Video</option>
                                            <option value="2" <?php if($rowdest['VideoType']=="2"){echo"selected";} else {?>selected<?php } ?>>Video File</option>
                                         </select>	
									  </div>
                                  </div>
								  
								  <div class="control-group">
                                      <label class="control-label">Video <span style="color:#ff0000;">*</span><?=$rowdest['VideoType']?></label>
                                      <div class="controls"  id="videopath21">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px;">
                                            <?php if($rowdest['VideoPath']=="") { ?>
                                               <img src="<?=$pic?>" alt="" /> <?php }  else { ?>
                                               <?=$pic1?>
                                               <?php } ?>
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select Video</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" class="default" name="VideoPath" id="VideoPath"  onchange="checkFile1(this)" /></span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                         </div>
                                         <span style="font-size:12px; margin-bottom:10px;">Format : flv, mp4, mov</span>
                                      </div>
                                      <div class="controls" id="videopath22" style="display:none;">
										 <input type="text" class="span8 m-wrap" name="VideoPath277" id="VideoPath277" value="<?=$rowdest['VideoPath']?>" placeholder="https://www.youtube.com/watch?v=F4808vSuAmw" />
									  </div>
                                   </div>
      
						   <div class="form-actions" style="padding-left:10px">
							  <input type="submit" class="btn blue" name="submit" value="Submit">
							  <button type="button" class="btn" id="cancel" onClick="location.href='videogallerylist.php'">Cancel</button>
						   </div>
						   
						   </form>
					<!-- END FORM-->           
				 </div>
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
    <!--<script type="text/javascript" src="tinymce/tinymce.min.js"></script>-->
    <script  language="javascript" src="../js/frm_validator.js"></script>
<script type="text/javascript" language="javascript1.2"> 
function check()    
{
	var vtype = document.getElementById("vtype").value;
	var videoid = document.getElementById("videoid").value;

	if(frmValidate('videoform','video_title','Video Title','YES','')==false)
		{
			return false;
		}

	if(vtype=="2") {
		if(videoid.length=='') {
		if(frmValidate('videoform','VideoPath',' Video','YES','')==false)
			{
				return false;
			}
		}
	} else {
	if(frmValidate('videoform','VideoPath277',' You Tub Video','YES','')==false)
		{
			return false;
		}
	}
					//Checkin video	
					var fieldObj = document.videoform.VideoPath;
					var FileName  = fieldObj.value;
					var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
					var FileSize = fieldObj.files[0].size;
					var FileSizeMB = (FileSize/41943040).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760 40  mb = 41943040-->
					//Calculate File size.
					var iConvert2 = (FileSize/ (1024*1024)).toFixed(2);
			
					if ( (FileExt != "flv" && FileExt != "mp4" && FileExt != "mov") || FileSize>41943040)
					{
					    var error = "File type : "+ FileExt+"\n\n";
						error += "Size: " + iConvert2 + " MB \n\n";
						error += "Please make sure your file is in Flv or Mp4 or Mov format and less than 40 MB.\n\n";
						alert(error);
						/*var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
						alert(error);*/
						return false;
						document.videoform.VideoPath.value="";
					} else {
					return true;
					}
					//End Checkin image	
					

}

function checkFile1(fieldObj) {
						//Checkin video	
					var fieldObj = document.videoform.VideoPath;
					var FileName  = fieldObj.value;
					var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
					var FileSize = fieldObj.files[0].size;
					var FileSizeMB = (FileSize/41943040).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760 40  mb = 41943040-->
					//Calculate File size.
					var iConvert2 = (FileSize/ (1024*1024)).toFixed(2);
			
					if ( (FileExt != "flv" && FileExt != "mp4" && FileExt != "mov") || FileSize>41943040)
					{
					    var error = "File type : "+ FileExt+"\n\n";
						error += "Size: " + iConvert2 + " MB \n\n";
						error += "Please make sure your file is in Flv or Mp4 or Mov format and less than 40 MB.\n\n";
						alert(error);
						/*var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
						alert(error);*/
						return false;
						document.videoform.VideoPath.value="";
					} else {
					return true;
					}
}

			function showvideo(type) {
				if(type=="1"){
					document.getElementById("videopath21").style.display="none";
					document.getElementById("videopath22").style.display="block";
				} else {
					document.getElementById("videopath21").style.display="block";
					document.getElementById("videopath22").style.display="none";
				}
			}
</script> 
<script language="javascript">
var id2=1;
function qq2()
{
  if(id2<5)
  {
    id2=id2+1;
    document.getElementById("qwerty"+id2).style.display="block";
    document.getElementById("ar1").style.display="inline";
  }	
}
function removedd2()
{
   document.getElementById("qwerty"+id2).style.display="none";
   id2=id2-1;
   if(id2==1 || id2==document.getElementById("previdno").value)
	   {
		 document.getElementById("ar1").style.display="none";
	   }
}
</script> 
	<script>
		jQuery(document).ready(function() {       
		   // initiate layout and plugins
		   App.init();
		  // UIModals.init();
		   //TableManaged.init();
		   tinymce.init({
			selector: "#MusicDescriptions",    
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
		 tinymce.init({
			selector: "#LyricsDescriptions",
			plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
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