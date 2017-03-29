<?php include"lib/header.php";
				//Insert User Registration			  
if($_REQUEST['submit']=="Save"){	                         
				//echo "<pre>";print_r($_REQUEST);  die;
function randomPrefix($length){ 
	$random= "";
	srand((double)microtime()*1000000);
	$data = "AbcDE123IJKLMN67QRSTUVWXYZ"; 
	$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz"; 
	$data .= "0FGH45OP89";
	for($i = 0; $i < $length; $i++){ 
		$random .= substr($data, (rand()%(strlen($data))), 1); 
	}
		return $random; 
}
function random_username($string) {
$pattern = " ";
$firstPart = strstr(strtolower($string), $pattern, true);
$secondPart = substr(strstr(strtolower($string), $pattern, false), 0,3);
$nrRand = rand(0, 100);

$username = trim($firstPart).trim($secondPart).trim($nrRand);
return $username;
}
$client_name = $_REQUEST['client_name'];     
$abn = $_REQUEST['abn']; 
$trading_as = $_REQUEST['trading_as'];
$website = $_REQUEST['website'];
$street_address = $_REQUEST['street_address'];
$postal_address = $_REQUEST['postal_address'];
$username = random_username($client_name);
$temp_pwd = randomPrefix(13);
for($i=0;$i<count($_REQUEST['email']);$i++){
	if($_REQUEST['email'][$i]['address'] !=''){
		if($_REQUEST['email'][$i]['pos'] == 'other'){
			$other = $_REQUEST['email'][$i]['pos'];
			$email[] = $_REQUEST['email'][$i]['pos']."%%".$_REQUEST[$other]."@@".$_REQUEST['email'][$i]['address'];
		}else{
			$email[] = $_REQUEST['email'][$i]['pos']."@@".$_REQUEST['email'][$i]['address'];
		}
	}
}
for($i=0;$i<count($_REQUEST['fax']);$i++){
	if($_REQUEST['fax'][$i]['address'] !=''){
		if($_REQUEST['fax'][$i]['pos'] == 'other'){
			$other = $_REQUEST['fax'][$i]['pos'];
			$fax[] = $_REQUEST['fax'][$i]['pos']."%%".$_REQUEST[$other]."@@".$_REQUEST['fax'][$i]['address'];
		}else{
			$fax[] = $_REQUEST['fax'][$i]['pos']."@@".$_REQUEST['fax'][$i]['address'];
		}
	}
}
for($i=0;$i<count($_REQUEST['cp']);$i++){
	if($_REQUEST['cp'][$i]['address'] !=''){
		if($_REQUEST['cp'][$i]['pos'] == 'other'){
			$other = $_REQUEST['cp'][$i]['pos'];
			$cp[] = $_REQUEST['cp'][$i]['pos']."%%".$_REQUEST[$other]."@@".$_REQUEST['cp'][$i]['address'];
		}else{
			$cp[] = $_REQUEST['cp'][$i]['pos']."@@".$_REQUEST['cp'][$i]['address'];
		}
	}
}
for($i=0;$i<count($_REQUEST['phone']);$i++){
	if($_REQUEST['phone'][$i]['address'] !=''){
		if($_REQUEST['phone'][$i]['pos'] == 'other'){
			$other = $_REQUEST['phone'][$i]['pos'];
			$phone[] = $_REQUEST['phone'][$i]['pos']."%%".$_REQUEST[$other]."@@".$_REQUEST['phone'][$i]['address'];
		}else{
			$phone[] = $_REQUEST['phone'][$i]['pos']."@@".$_REQUEST['phone'][$i]['address'];
		}
	}
}

$upload_image  = $_FILES['client_file']['name'];
if($upload_image <> ''){
	$upload_image = time()."_".$_FILES['client_file']['name'];
	move_uploaded_file($_FILES['client_file']['tmp_name'],"upload/".$upload_image);
}else{
	$upload_image = '';
}

mysql_query("insert into hr_user_registration(RegistrationNo,client_name,BusinessName,TradingName,EmailId,Phone,Website,Address,BusinessAddress,Fax,contact_person,UserImage,UserName,Password) VALUES('','".$client_name."','".$abn."','".$trading_as."','".serialize($email)."','".serialize($phone)."','".$website."','".$street_address."','".$postal_address."','".serialize($fax)."','".serialize($cp)."','".$upload_image."','".$username."','".$temp_pwd."') ") or die(mysql_error());
$_SESSION['username'] = $username;
$_SESSION['temp_pwd'] = $temp_pwd;
header("location:email_verification.php"); die;	
}
					
?>
<style>
.r-btnAdd {
	background-color: transparent;
	border: none;
	color: #0d638f;
	outline: none;
	position: absolute;
	top: -25px;
}
#fax_number_div, #email_div, #phone_number_div {
	position: relative;
}
#fax_number_div button {
	left: 100px
}
#email_div button {
	left: 50px
}
#phone_number_div button {
	left: 110px
}
.control-group {
	/* float: left; */
	margin-top: 21px;
}
.new-input {
	margin-left: 2%;
	width: 45%
}
</style>
<!-- END LightBox View -->

<div class="page-container row-fluid">
<!-- BEGIN SIDEBAR -->
<?php include"lib/leftbar.php";?>
<!-- END SIDEBAR --> 
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
          <li> <i class="icon-home"></i> <a href="dashboard.php">Home</a> <span class="icon-angle-right"></span> </li>
          <li> <a href="userlist.php">User List</a> <span class="icon-angle-right"></span> </li>
          <li><a href="#">
            <?=$pagetitle?>
            </a></li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <?php
					  if($mess!='')
					  {
					  ?>
        <div class="alert alert-success">
          <button data-dismiss="alert" class="close"></button>
          <?=$mess?>
        </div>
        <?php
					  }
					   if($_REQUEST['mess'] == 'successful')
					  {
					  ?>
        <div class="alert alert-success">
          <button data-dismiss="alert" class="close"></button>
          Successfully User Added... </div>
        <?php
					  }
					  if($_REQUEST['mess'] == 'successfulupdate')
					  {
					  ?>
        <div class="alert alert-success">
          <button data-dismiss="alert" class="close"></button>
          Successfully User Info Updated... </div>
        <?php
					  }
					  if($_REQUEST['mess'] == 'unsuccessful')
					  {
					  ?>
        <div class="alert alert-error">
          <button data-dismiss="alert" class="close"></button>
          E-Mail Address already exists.Please try another one! </div>
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
            <div class="caption"><i class="icon-reorder"></i>
              <?=$pagetitle?>
            </div>
            <div class="tools"> 
              <!--<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>--> 
              <a href="javascript:;" class="remove"></a> </div>
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
          <form class="fm_bottom" name="userdetailinfo2" id="userdetailinfo2" action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" onsubmit="return check();">
            <div class="row-fluid">
              <div class="span6">
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Company/Trust/Client Name <span style="color:#ff0000;">*</span></label>
                  <div class="controls">
                    <input type="text" class="span m-wrap"  name="client_name" id="client_name" value="" />
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">ABN <span style="color:#ff0000;">*</span></label>
                  <div class="controls">
                    <input type="text" class="span m-wrap" name="abn"  id="abn" value="" />
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Street Address <span style="color:#ff0000;">*</span></label>
                  <div class="controls">
                    <textarea class="span m-wrap" name="street_address"  id="street_address" rows="4" ></textarea>
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Phone Number <span style="color:#ff0000;">*</span></label>
                  <div id="phone_number_div">
                    <button type="button" class="r-btnAdd">Add New</button>
                    <div class="r-group">
                      <select name="phone[0][pos]" id="phone_0_pos" data-pattern-name="phone[++][pos]" data-pattern-id="phone_++_pos"    onChange="check_contact_person(this.value);" style="width:50%"  >
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                        <option value="Payroll">Payroll</option>
                        <option value="Nurse In-Charge">Nurse In-Charge</option>
                        <option value="Other">Other</option>
                      </select>
                      <!--<input type="text" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" />-->
                      <div>
                        <input type="text" type="text" name="phone[0][address]" id="phone_0_address" data-pattern-name="phone[++][address]" data-pattern-id="phone_++_address" />
                      </div>
                      <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                      <button type="button" class="r-btnRemove">Remove -</button>
                    </div>
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label" >Email(s) <span style="color:#ff0000;">* </span> </label>
                  <div id="email_div">
                    <button type="button" class="r-btnAdd">Add New</button>
                    <div class="r-group">
                      <select name="email[0][pos]" id="email_0_pos" data-pattern-name="email[++][pos]" data-pattern-id="email_++_pos" onChange="check_contact_person(this.value);" style="width:50%"  >
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                        <option value="Payroll">Payroll</option>
                        <option value="Nurse In-Charge">Nurse In-Charge</option>
                        <option value="Other">Other</option>
                      </select>
                      <div>
                        <input type="text" name="email[0][address]" id="email_0_address" data-pattern-name="email[++][address]" data-pattern-id="email_++_address" />
                      </div>
                      
                      <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                      <button type="button" class="r-btnRemove">Remove -</button>
                    </div>
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Upload Photo / Logo</label>
                  <div class="controls">
                    <input type="file" class="span m-wrap" name="client_file"  id="client_file" />
                  </div>
                </div>
                
                
              </div>
              <div class="span6">
              	<div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Trading as</label>
                  <div class="controls">
                    <input type="text" class="span m-wrap"  name="trading_as" id="trading_as" value="" />
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label" >Contact Person(s)</label>
                  <div id="cp_div">
                    <button type="button" class="r-btnAdd">Add New</button>
                    <div class="r-group">
                      <select name="cp[0][pos]" id="cp_0_pos" data-pattern-name="cp[++][pos]" data-pattern-id="cp_++_pos"   onChange="check_contact_person(this.value);" style="width:50%"  >
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                        <option value="Payroll">Payroll</option>
                        <option value="Nurse In-Charge">Nurse In-Charge</option>
                        <option value="Other">Other</option>
                      </select>
                      <!--<input type="text" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" />-->
                      <div>
                        <input type="text" type="text" name="cp[0][address]" id="cp_0_address" data-pattern-name="cp[++][address]" data-pattern-id="cp_++_address" />
                      </div>
                      
                      <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                      <button type="button" class="r-btnRemove">Remove -</button>
                    </div>
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Postal Address <span style="color:#ff0000;">*</span>
                    <input type="checkbox" name="postal_address_chk" id="postal_address_chk" value=""/>
                    Same as Street Address</label>
                  <div class="controls">
                    <textarea class="span m-wrap" name="postal_address"  id="postal_address" rows="4" ></textarea>
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label" >Fax Number(s)</label>
                  <div id="fax_number_div">
                    <button type="button" class="r-btnAdd">Add New</button>
                    <div class="r-group">
                      <select name="fax[0][pos]" id="fax_0_pos" data-pattern-name="fax[++][pos]" data-pattern-id="fax_++_pos"  onChange="check_contact_person(this.value);" style="width:50%"  >
                        <option value="Manager">Manager</option>
                        <option value="Admin">Admin</option>
                        <option value="Payroll">Payroll</option>
                        <option value="Nurse In-Charge">Nurse In-Charge</option>
                        <option value="Other">Other</option>
                      </select>
                      <!--<input type="text" name="vehicle[0][name]" id="vehicle_0_name" data-pattern-name="vehicle[++][name]" data-pattern-id="vehicle_++_name" />-->
                      <div>
                        <input type="text" name="fax[0][address]" id="fax_0_address" data-pattern-name="fax[++][address]" data-pattern-id="fax_++_address" />
                      </div>
                      
                      <!-- Add a remove button for the item. If one didn't exist, it would be added to overall group -->
                      <button type="button" class="r-btnRemove">Remove -</button>
                    </div>
                  </div>
                </div>
                <div class="control-group" style="margin-bottom:0px;">
                  <label class="control-label">Website</label>
                  <div class="controls">
                    <input type class="span m-wrap" name="website"  id="website" rows="4" />
                  </div>
                </div>
                
                
                
              </div>
            </div>
            </div>
            </div>
            <div class="modal-footer" style="text-align:left;">
              <input type="submit" class="btn blue" name="submit" value="Submit" />
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
<script type="text/javascript" src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> 
<script  language="javascript" src="../js/frm_validator.js"></script> 
<script>
$('select').change(function(){
var value=$(this).val();
var select_name  = this.id;
if(value=="Other"){
$(this).addClass("abc")
$(this).after( "<input type='text' name='"+select_name+"_other' class='new-input'>" );
}
else{
$(this).next('input').remove();
}
});

$("#postal_address_chk").change(function() {
    if(this.checked) {
       var street_add = $("#street_address").val();
	   $("#postal_address").val(street_add);
    }else{
		$("#postal_address").val("");
	}
});
</script> 
<script type="text/javascript" language="javascript1.2">
    function check()
    { 
		if(frmValidate('userdetailinfo2','firstname','First Name','YES','')==false)
            {
                return false;
            }
		if(frmValidate('userdetailinfo2','lastname','Last Name','YES','')==false)
            {
                return false;
            }
        if(frmValidate('userdetailinfo2','email','Email','YES','')==false)
            {
                return false;
            }
        if(ChkEmail('userdetailinfo2','email')==false)
            {
                return false;
            }
			
		if(frmValidate('userdetailinfo2','password','Password','YES','')==false)
            {
                return false;
            }
		if(frmValidate('userdetailinfo2','cpassword','Confirm Password','YES','')==false)
            {
                return false;
            }
			
		if(document.userdetailinfo2.password.value!=document.userdetailinfo2.cpassword.value)
		{
			alert('Please Check Your Confirm Password');
			document.userdetailinfo2.cpassword.value="";
			document.userdetailinfo2.cpassword.focus();
			focus(document.userdetailinfo2.cpassword.value);
			return false;
		}
	    if(frmValidate('userdetailinfo2','image',' Image','YES','')==false)
            {
                return false;
            }
		//Checkin Image	
		var fieldObj = document.userdetailinfo2.image;
		var FileName  = fieldObj.value;
        var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
        var FileSize = fieldObj.files[0].size;
        var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
		//Calculate File size.
		var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);

        if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
        {
           var error = "File type : "+ FileExt+"\n\n";
            error += "Size: " + iConvert2 + " MB \n\n";
            error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
            alert(error);
			/*var error = "Please make sure your file is in jpg or jpeg or png format and less than 2 MB.\n\n";
            alert(error);*/
            return false;
        }
        return true;
		//End Checkin image
			
    }
	    function check1()
			{ 
				if(frmValidate('userdetailinfo21','firstname','First Name','YES','')==false)
					{
						return false;
					}
				if(frmValidate('userdetailinfo21','lastname','Last Name','YES','')==false)
					{
						return false;
					}
					
					//Checkin Image	
					var fieldObj = document.userdetailinfo2.image;
					var FileName  = fieldObj.value;
					var FileExt = FileName.substr(FileName.lastIndexOf('.')+1);
					var FileSize = fieldObj.files[0].size;
					var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
					//Calculate File size.
					var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
			
					if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
					{
					    var error = "File type : "+ FileExt+"\n\n";
						error += "Size: " + iConvert2 + " MB \n\n";
						error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
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
				var FileSizeMB = (FileSize/10485760).toFixed(2);<!-- 2 Mb = 2097152--> <!--10 mb = 10485760-->
				//Calculate File size.
				var iConvert2 = (fieldObj.files[0].size / (1024*1024)).toFixed(2);
		
				if ( (FileExt != "jpg" && FileExt != "jpeg" && FileExt != "png" && FileExt != "gif") || FileSize>10485760)
				{
				   var error = "File type : "+ FileExt+"\n\n";
					error += "Size: " + iConvert2 + " MB \n\n";
					error += "Please make sure your file is in jpg or jpeg or png format and less than 10 MB.\n\n";
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
			selector: "#textarea",
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
		FormComponents.init();
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
<script type="text/javascript" src="js/jquery.form-repeater.js"></script> 
<script type="text/javascript">
 $(document).removeClass(function() {
  $('#phone_number_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
   $('#fax_number_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
   $('#email_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
  $('#cp_div').repeater({
      btnAddClass: 'r-btnAdd',
      btnRemoveClass: 'r-btnRemove',
      groupClass: 'r-group',
      minItems: 1,
      maxItems: 0,
      startingIndex: 0,
      reindexOnDelete: true,
      repeatMode: 'append',
      animation: null,
      animationSpeed: 400,
      animationEasing: 'swing',
      clearValues: true
  });
  
  });
  
  
// confirm to clear form 

$( ".remove" ).click(function( event ) {
  var confirm_val = confirm("Are you sure?");
  if(confirm_val == false){
  	event.preventDefault();
	return false;
  }
});  
  </script> 

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>