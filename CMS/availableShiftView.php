<?php include"lib/header.php";?>
<?php
if(isset($_REQUEST['submit'])) {	                         
	$id = $_REQUEST['id'];
	$registrationNo = $_REQUEST['registrationNo'];
	
	$fet = mysql_fetch_array(mysql_query("SELECT Uid FROM ".TABLE_PREFIX."staff_registration WHERE RegistrationNo = '".$registrationNo."'"));
	$update = mysql_query("UPDATE staff_available_shift SET accept_staffid = '".$fet['Uid']."' WHERE id  = '".$id."'");
	if($update)
	{
		echo '<script>alert("Staff Allocated Successfully.");</script>';
		echo '<script>window.location.href="availableShiftView.php?Uid='.$id.'";</script>';
		exit();
	}
	
		
}
	


	



		$getdestsql = "SELECT * FROM staff_available_shift WHERE id  = '".$_REQUEST['Uid']."'";
		$getdestquery = mysql_query($getdestsql) or die(mysql_error());
		$rowdest7 = mysql_fetch_array($getdestquery);
	
		
			
											
					
		
	?>
		<script type="text/javascript">
			// Show Designation info  from department
		   function desigCheck(desig) 
			{ 		
				var xmlhttp; 
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				 	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 document.getElementById("showdesig").innerHTML=xmlhttp.responseText;
				  }
			  }
				xmlhttp.open("GET","desiginfo.php?desig=" + desig,true);
				xmlhttp.send();
			}
	</script>
	<script type="text/javascript">
			// Show Designation info from department
		   function empreporting(id) 
			{ 	
				var xmlhttp; 
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				 	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 document.getElementById("showempid").innerHTML=xmlhttp.responseText;
				  }
			  }
				xmlhttp.open("GET","showempreportedit.php?id=" + id,true);
				xmlhttp.send();
			}
	</script>
	<script type="text/javascript">
			// Show Designation info  from department
		   function empreportingname(id) 
			{ 
				var xmlhttp; 
				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				 	 xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
					xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {
					 document.getElementById("showempidname").innerHTML=xmlhttp.responseText;
				  }
			  }
				xmlhttp.open("GET","showprivinfonameedit.php?id=" + id,true);
				xmlhttp.send();
			}
	</script>
	<script language="javascript">
	var id2=1;
	function qq2()
	{
	  if(id2<2)
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
	<style type="text/css">
		#tit2 {
			 display: inline-block;
/*			float: left;*/
			font-size: 18px;
			font-weight: 400;
			margin: 0 0 7px;
			padding: 0;
		}
	</style>
	
<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include"lib/leftbar.php";?>	<!-- END SIDEBAR -->
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
							<?=$pagetitle?> <small>Details</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="dashboard.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="availableShiftList.php">View Available Shift</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="">Available Shift Info</a>
							</li>
							<li class="pull-right no-text-shadow"></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
						<?php
						  if($_REQUEST['action'] == 'added')
						  {
						  ?>				  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! User added
						  </div>						  
						  <?php
						  }
						  if($_REQUEST['action'] == 'updated')
						  {
						  ?>						  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! User updated
						  </div>						  
						  <?php
						  }
						   if($_REQUEST['delete'] == 'successfull')
						  {
						  ?>						  
						  <div class="alert alert-success">
							<button data-dismiss="alert" class="close"></button>
							Success! Image Deleted
						  </div>						  
						  <?php
						  }
						  ?>
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="tabbable tabbable-custom tabbable-full-width">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1_1" data-toggle="tab">Available Shift Info</a></li>
								
								
							</ul>
							<div class="tab-content">
								<div class="tab-pane row-fluid active" id="tab_1_1">
									<ul class="unstyled profile-nav span3">
										<li>&nbsp;</li>
                                                                                                              

									</ul>
									<div class="span9">
										<div class="row-fluid"  id="view_profile">
											<div class="span12 profile-info">
                                            <h3>Available Shift Info&nbsp;<button id="" onClick="location.href='availableShift.php?id=<?=$rowdest7['id']?>&mode=edit';" class="btn mini blue">Edit <i class="icon-edit"></i></button>&nbsp;</h3>	
												<table  width="100%" cellpadding="3" rules="none" border="0">
													
													<tr>
														<td><p><i class="icon-star"></i>&nbsp;Location</p></td>
														<td><p>:</p></td>
														<td><p><?=stripslashes($rowdest7['location'])?></p></td>
													</tr>
													
													<tr>
														<td width="20%"><p><i class="icon-star"></i>&nbsp;Role</p></td>
														<td><p>:</p></td>
														<td ><p><?=stripslashes($rowdest7['role'])?></p></td>
													</tr>
                                                    <tr>
														<td><p><i class="icon-star"></i>&nbsp;Date</p></td>
														<td><p>:</p></td>
														<td width=""><p><?=date('d M Y', strtotime($rowdest7['date']))?><br/><?=date('l', strtotime($rowdest7['date']))?></p></td>
													</tr>
                                                    
													
													<tr>
														<td><p><i class="icon-star"></i>&nbsp;Time : 
															</p></td>
														<td><p>:</p></td>
														<td width=""><p>Start Time : <?=$rowdest7['start_time']?></p>
                                                        			<p>Finish Time : <?=$rowdest7['end_time']?></p>
                                                        </td>
													</tr>	
                                                    
													<tr>
														<td><p><i class="icon-star"></i>&nbsp;Penalties</p></td>
														<td><p>:</p></td>
														<td><p><?= stripslashes($rowdest7['penalties']) ;?></p></td>
													</tr>
                                                    
                                                    <tr>
														<td><p><i class="icon-star"></i>&nbsp;More Information</p></td>
														<td><p>:</p></td>
														<td><p><?= stripslashes($rowdest7['more_info']) ;?></p></td>
													</tr>												
													
													
													
                                                    <tr>
														<td><p><i class="icon-star"></i>&nbsp;Accepted By
															</p></td>
														<td><p>:</p></td>
														<td width="">
                                                        <?php 
														if($rowdest7['accept_staffid'] != ""){
														$fetch = mysql_fetch_array(mysql_query("SELECT * FROM ".TABLE_PREFIX."staff_registration WHERE Uid = '".$rowdest7['accept_staffid']."'"));
														
														?>
                                                        	<p style="font-weight:bold;">
                                                            <h4>Name : <?=$fetch['FirstName'].' '.$fetch['LastName'];?></h4>
                                                            <h4> Registration No. : <?=$fetch['RegistrationNo'];?></h4>
                                                            
                                                            </p>
                                                       <?php }else{echo '<p style="color:red; font-weight:bold;">NOT ACCEPTED</p>';}?>
                                                        </td>
													</tr>
                                                    <?php if($rowdest7['accept_staffid'] == ""){?>
                                                    <style type="text/css">.bb{ float:left; margin:3px;}</style>
                                                    <tr>
														<td><p><i class="icon-star"></i>&nbsp;Set Staff
															</p></td>
														<td><p>:</p></td>
														<td ><p> 
                                                        <form action="" method="post">
                                                        <input type="hidden" name="id" value="<?=$_REQUEST['Uid']?>">
                                                        		<input type="text" class="bb" name="registrationNo" id="registrationNo">
                                                                <input type="submit" name="submit" value="Submit" class="btn btn-danger bb">
                                                                
                                                        </form>
                                                        	</p>
                                                        </td>
													</tr>
                                                    <?php }?>
                                                    
									
												</table>												
											</div>
											<!--end span8-->
											
											<!--end span4-->
										</div>
                                        
                                        
										<!--end row-fluid-->
										
									</div>
									
							</div>
							
							
								
								
								</div>
								<!--end tab-pane-->
							</div>
						</div>
						<!--END TABS-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
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
<script type="text/javascript" src="../js/jquery-1.10.1.min.js"></script>
<script type="text/javascript">
function edit_profile()
{
	$('#view_profile').css('display', 'none');
	$('#update_profile').css('display', 'block');
	$('#profile_btn').css('display', 'none');
}
function edit_booking()
{
	$('#edit_booking_info').css('display', 'block');
	$('#booking_info').css('display', 'none');
	$('#update_btn').css('display', 'block');
	$('#edit_btn').css('display', 'none');
}
</script>
<script src="../js/jquery.Jcrop.js"></script>
   <style type="text/css">
   .img_overlay {
  	
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.6);
     border-radius: 6px;
    display: none;
    height: 142px;
    left: 2px;
    position: absolute;
    right: 0;
    text-align: center;
    top: -60px;
    width: 96%;
}
.img_overlay > a {
padding:9px;
color:#fff;
line-height:26px;
}
.thumbs {
position:relative;}
.thumbs:hover .img_overlay {
display:block;}
div#main a:hover:not(.button), a:hover:not(.button), a:focus:not(.button), div#main a:focus:not(.button) {
    color: #0095ff;
}
@media only screen and (max-width:1024px) { 

.tex {
	padding:0 15px !important;
}
.imgtxt2 {
	display:block !important;}
}
</style>
	<!--<script type="text/javascript" src="script.js"></script>-->
<script type="text/javascript">
function showimagepreview(input) {
if (input.files && input.files[0]) {
var filerdr = new FileReader();
filerdr.onload = function(e) {
$('#imgprvw').attr('src', e.target.result);

    $(function(){

    $('#imgprvw').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

}
filerdr.readAsDataURL(input.files[0]);
}
}
  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };
</script>
<link rel="stylesheet" href="../css/jquery.Jcrop.css" type="text/css" />
<script> 
$(document).ready(function(){
    $("#intimg3").click(function(){
        $("#intimg2").slideToggle();
    });
});
</script>
<!--	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript" ></script>
	<script src="assets/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript" ></script>  
	<script src="assets/scripts/ui-modals.js"></script> -->
	<!--<script src="assets/scripts/form-components.js"></script> -->
<!--	<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/plugins/clockface/js/clockface.js"></script>	
	<script type="text/javascript" src="assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
			<script src="assets/scripts/gallery.js"></script> 
		<script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>  -->
		<script type="text/javascript">
		/*jQuery(document).ready(function() {       
		   App.init();
		   Gallery.init();
		   $('.fancybox-video').fancybox({type: 'iframe'});
		   UIModals.init();
		   FormComponents.init();
		});*/
	// Hide Spouse and no.of childreen
	function marriedCheck() {
   			 if (document.getElementById('marital_status').checked) {
        		document.getElementById('marrid').style.display = 'block';
        		document.getElementById('marrid2').style.display = 'block';
    		}
    		else 
    		{ 
    			document.getElementById('marrid').style.display = 'none';  
    			document.getElementById('marrid2').style.display = 'none';
    		}
		}
	</script> 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>