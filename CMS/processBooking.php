<?php include"lib/header.php";


if((isset($_POST["1st"])) or (isset($_POST["2nd"])) or (isset($_POST["3rd"]))){

	$count = mysql_num_rows(mysql_query("SELECT sl FROM stuff_booked WHERE booking_sl = '".$_POST["booking_sl"]."' AND shift = '".$_POST["shift"]."'"));
	if($count == 0){
		$q="INSERT INTO stuff_booked (sl, stuffId,clientId, booking_sl, shift, formDate, toDate, dt) VALUES 
	(NULL, '".$_POST["stuffId"]."', '".$_POST["clientId"]."', '".$_POST["booking_sl"]."', '".$_POST["shift"]."', '".$_POST["fromDate"]."', '".$_POST["toDate"]."', now());";
		$r=mysql_query($q)or die("error:".mysql_error());
	}
	
	
		$date = $_REQUEST['date'];
		$word = $_REQUEST['word'];
		$class = $_REQUEST['class'];
		$speciality = $_REQUEST['speciality'];
		$role = $speciality;
		$start_time = date('H:i:s', strtotime($_POST["fromDate"]));
		$end_time = date('H:i:s', strtotime($_POST['toDate']));
		
		$date = date('Y-m-d', strtotime($_REQUEST['date']));
		$date = $date.' '.$end_time;
		$shiftEndTime = date('Y-m-d H:i:s', strtotime($date));
		
		if($_POST["shift"] == 1){$shift = 'first';}elseif($_POST["shift"] == 2){$shift = 'second';}elseif($_POST["shift"] == 3){$shift = 'third';}
	$ftnum = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE shift = '".$shift."' AND shiftid = '".$_POST["booking_sl"]."'"));
	if($ftnum == 0){
		
		$insert = mysql_query("INSERT INTO staff_available_shift SET 
										location = '".$word."',
										qualification = '".$class."',
										role = '".$role."',
										date = '".$date."',
										start_time = '".$start_time."',
										end_time = '".$end_time."',
										shiftEndTime = '".$shiftEndTime."',
										accept_staffId = '".$_POST["stuffId"]."',
										status = 'Unprocessed',
										shift = '".$shift."',
										shiftid = '".$_POST["booking_sl"]."',
										clientId = '".$_POST["clientId"]."'
										");
										
	}else{
		$update = mysql_query("UPDATE staff_available_shift SET accept_staffId = '".$_POST["stuffId"]."' WHERE shift = '".$shift."' AND shiftid = '".$_POST["booking_sl"]."'");
	}
	
	
	
	
	
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
							<a href="processClientBooking.php">New Shift Request</a> 
							<span class="icon-angle-right"></span>
						 </li>
						<li><a href="#"><?=$pagetitle?></a></li>
					  </ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					
					  
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
					
							<div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
										<th class="hidden-480">Client name and address</th>
										<th class="hidden-480">Shift date and time</th>
										
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;$clientId=$booking_sl=$shift='';
									$GetUserSql = "SELECT * FROM book_nurse where sl='".$_GET["sl"]."'";
									$GetQuery = mysql_query($GetUserSql) or die("Error2: ".mysql_error());
									while($row = mysql_fetch_array($GetQuery))
									{ 	
									
										$clientId=$row['clientId'];
										$booking_sl=$row['sl'];
										$firstShiftDate = $row['firstShiftDate'];
										$secondShiftDate = $row['secondShiftDate'];
										$thirdShiftDate = $row['thirdShiftDate'];
										$firstShift = $row['firstShift'];
										$secondShift = $row['secondShift'];
										$thirdShift = $row['thirdShift'];
										$word1 = $row['word1'];
										$word2 = $row['word2'];
										$word3 = $row['word3'];
										$class1 = $row['class1'];
										$class2 = $row['class2'];
										$class3 = $row['class3'];
										$speciality1 = $row['speciality1'];
										$speciality2 = $row['speciality2'];
										$speciality3 = $row['speciality3'];
									
									
									//---------------------------
										
				$sql_cn = "SELECT FirstName,LastName,EmailId,Address,Phone,BusinessName,BusinessAddress,Website FROM hr_user_registration where Uid='".$clientId."'";
										$q_cn = mysql_query($sql_cn) or die("Error2: ".mysql_error());
										while($r = mysql_fetch_array($q_cn))
										{										
											$clientFirstName=$r['FirstName'];
											$LastName=$r['LastName'];
											$EmailId=$r['EmailId'];
											$Phone=$r['Phone'];
											$BusinessAddress=$r['BusinessAddress'];
											$Website=$r['Website'];
										
										}	
										//---------------------------
										//---------------------------
										$stuffId11=$shift11='';$c=0;
										$sql11 = "SELECT * FROM stuff_booked where booking_sl='".$booking_sl."'";
										$query11 = mysql_query($sql11) or die("Error2: ".mysql_error());
										while($row11 = mysql_fetch_array($query11))
										{										
											if($row11['shift']==1){$stuffId11=$row11['stuffId'];$shift11=$row11['shift'];}
											if($row11['shift']==2){$stuffId22=$row11['stuffId'];$shift22=$row11['shift'];}
											if($row11['shift']==3){$stuffId33=$row11['stuffId'];$shift33=$row11['shift'];}
										}
										//---------------------------
									?>
									<tr class="odd gradeX">
										<td class="hidden-480">
											<?= $row['clientId']; ?>
                                            <br /> Name: <?= $clientFirstName ;?> <?= $LastName;?>
											
											<br /> Email: <?= $EmailId;?>
											<br /> Phone: <?= $Phone;?>
											<br /> BusinessAddress:  <?= $BusinessAddress; ?>
											<br /> Website: <?= $Website;?>										                                            
										</td>
										<td class="hidden-480">
											<?php 
											
											if($row['firstShiftDate']){
											echo "<b>First Shift:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> 											
											<font color='blue'>Date:".$row['firstShiftDate']."</font> 
											<font color='green'>Time(".$row['startTime1']."-".$row['finishTime1'].")</font> 
											Word/area:".$row['word1']." 
											Class:".$row['class1']." "; 
											if($row['staffReqstd1'])echo "<br><b>Client's Request:</b>".$row['staffReqstd1'].""; 
																				
											 if($shift11==1){
												 //-----------
										$sql_name = "SELECT FirstName,LastName,EmailId,Address,mobile
										FROM hr_staff_registration where Uid='".$stuffId11."'";
										$q_name = mysql_query($sql_name) or die("Error2: ".mysql_error());
										while($r_name = mysql_fetch_array($q_name)){$stuffFirstName=$r_name['FirstName'];$stuffLastName=$r_name['LastName'];}
												 //------------												 
												 echo ("<b><font color='green'>Booked Stuff Name: $stuffFirstName $stuffLastName (".$stuffId11.") </font></b><br> ");}
											else{echo "<br>";}
										echo "<b>Status : ".$row['firstShift']."ed</b><br/>";		
											}
										
										else{echo "<b>First Shift:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><font color='#666'>Not required. </font><br>" ;}
											
											
											$shift1Start=$row['firstShiftDate']." ".$row['startTime1'].":00";
											$shift1Finish=$row['firstShiftDate']." ".$row['finishTime1'].":00";
											
											
											
											
											if($row['secondShiftDate']){
											echo "<b>Second Shift:</b> 											
											<font color='blue'>Date:".$row['secondShiftDate']."</font> 
											<font color='green'>Time(".$row['startTime2']."-".$row['finishTime2'].")</font> 
											Word/area:".$row['word2']." 
											Class:".$row['class2']."";
											if($row['staffReqstd2'])echo "<br><b>Client's Request:</b>".$row['staffReqstd2']."											
											";
											
											
											
											if($shift22==2){
												//-----------
										$sql_name = "SELECT FirstName,LastName,EmailId,Address,mobile
										FROM hr_staff_registration where Uid='".$stuffId22."'";
										$q_name = mysql_query($sql_name) or die("Error2: ".mysql_error());
										while($r_name = mysql_fetch_array($q_name)){$stuffFirstName=$r_name['FirstName'];$stuffLastName=$r_name['LastName'];}
												 //------------	
												
												echo ("<font color='green'><b> Booked Stuff Name: $stuffFirstName $stuffLastName (".$stuffId22.")</b></font><br>");}
											 else{echo "<br>";}
											echo "<b>Status : ".$row['secondShift']."ed</b></br>";
											}
											else
											{												
											echo "<b>Second Shift:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><font color='#666'>Not required.</font><br>" ;}
											
											$shift2Start=$row['secondShiftDate']." ".$row['startTime2'].":00";
											$shift2Finish=$row['secondShiftDate']." ".$row['finishTime2'].":00";
											
											
											
											
											if($row['thirdShiftDate']){
											echo "<b>Third Shift:&nbsp;&nbsp;&nbsp;</b> 											
											<font color='blue'>Date:".$row['thirdShiftDate']."</font> 
											<font color='green'>Time(".$row['startTime3']."-".$row['finishTime3'].")</font> 
											Word/area:".$row['word3']." 
											Class:".$row['class3'].""; 
											if($row['staffReqstd3'])echo "<br><b>Client's Reqest:</b>".$row['staffReqstd3']."";
											
											if($shift33==3){
												//-----------
										$sql_name = "SELECT FirstName,LastName,EmailId,Address,mobile
										FROM hr_staff_registration where Uid='".$stuffId33."'";
										$q_name = mysql_query($sql_name) or die("Error2: ".mysql_error());
										while($r_name = mysql_fetch_array($q_name)){$stuffFirstName=$r_name['FirstName'];$stuffLastName=$r_name['LastName'];}
												 //------------	
												echo ("<font color='green'><b>Booked Stuff Name: $stuffFirstName $stuffLastName (".$stuffId33.")</b></font><br>");	
											}
											else{echo "<br>";}
											echo "<b>Status : ".$row['thirdShift']."ed</b></br>"; 
											}
										else{echo "<b>Third Shift:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><font color='#666'>Not required.</font><br>" ;}
											
											$shift3Start=$row['thirdShiftDate']." ".$row['startTime3'].":00";
											$shift3Finish=$row['thirdShiftDate']." ".$row['finishTime3'].":00";
											
											?>
										</td>
										
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
							</div>
                            
                            
                            <div id="tablesec">
							<table class="table table-striped table-bordered table-hover" id="sample_2">	
                            <thead><tr>
                            <th>Name</th><th>Gender</th><th>Offer&nbsp;Me</th><th>Confirmation</th><th>Booking Details</th><th style="width:15%;">Reserve</th></tr></thead>
                            
                            
                            <?php
                            $ctn = 1;$booked1=$booked2=$booked3='';
									$q = "SELECT * FROM hr_staff_registration";
									$r = mysql_query($q) or die(mysql_error());
									while($row = mysql_fetch_array($r))
									{
										//-----------------------------------------
										$uid=$row['Uid'];
								
										//++++++++++
										//$booked1=$booked2=$booked3='';
								$q2 = "SELECT * FROM stuff_booked where stuffId='".$uid."' AND  booking_sl = '".$_REQUEST['sl']."'";
									$r2 = mysql_query($q2) ;
									$booked1='';
									$booked2='';
									$booked3='';
									while($row2 = mysql_fetch_array($r2))
									{
										$shift=$row2['shift'];
									//@@@@@@@@@@@@@@
									
									if(  strtotime($shift1Start) <= strtotime($row2['formDate']) and $row2['toDate'] >= strtotime($shift1finish) and $shift==1 )
										{
											$booked1=" <b>Booked(1st Shift):</b> <br>from ".$row2['formDate']."  <br> to ".$row2['toDate']."<br/>";
										//$dates="(if)required date ".$shift2Start." - ".$shift2Finish;
										//$booked2="Booked from UID:".$uid." <font color='red'>".$row2['formDate']." - ".$row2['toDate']."</font><br>";
										//break;
										}
									
									if(  strtotime($shift2Start) <= strtotime($row2['formDate']) and $row2['toDate'] >= strtotime($shift2finish)  and $shift==2)
										{
											$booked2=" <b>Booked(2nd Shift):</b> <br>from ".$row2['formDate']."  <br> to ".$row2['toDate']."<br/>";
										//$dates="(if)required date ".$shift2Start." - ".$shift2Finish;
										//$booked2="Booked from UID:".$uid." <font color='red'>".$row2['formDate']." - ".$row2['toDate']."</font><br>";
										//break;
										}
								
									if(  strtotime($shift3Start) <= strtotime($row2['formDate']) and $row2['toDate'] >= strtotime($shift3finish)  and $shift==3)
										{
											$booked3="<b>Booked(3rd Shift):</b> <br>from ".$row2['formDate']."  <br> to ".$row2['toDate']."";
										//$dates="(if)required date ".$shift2Start." - ".$shift2Finish;
										//$booked2="Booked from UID:".$uid." <font color='red'>".$row2['formDate']." - ".$row2['toDate']."</font><br>";
										//break;
										}
									
									}
									//+++++++++++
									
										//---------------------------------------------
							?> 
                                    
                                    	
							<tr>
                            <td><?= $row['FirstName']; ?> <?= $row['LastName']; ?> (<?= $row['Uid']; ?>)
                             <br />Email: <?= $row['EmailId']; ?>
                             <br />Mobile: <?= $row['mobile']; ?>
                             <br />Address: <?= $row['Address']; ?>
                             </td>
                             <td><?= $row['Gender']; ?></td>
                             
                             <td>
							 Offer me shifts up to <?= $row['offerMeNum']; ?> <?= $row['offerMeUnit']; ?> from my residence.</td>
                             <td>Allocators can call me after 10pm? <?= $row['after10pm']; ?>
                             <br />Allocators can call me before 6am? <?= $row['before6am']; ?>
                             <br />I am willing to travel to regional places if reimbursed for travel & accommodation? <?= $row['travel'] ?>
                             <br />Allocators should text me notifications for shift broadcast? <?= $row['travel'] ?>
                             </td>
                             
                             <td>
                             <?php echo $booked1; echo $booked2; echo $booked3; 
							 
							 ?>
                             </td>
                             <td style="text-align:center;">
                             
							 <?php if($booked1 != "" || $shift11 != "" || $firstShiftDate == "" || $firstShift == 'Cancel'){ $d="disabled='disabled'";}else{$d="";} ?>
							 <?php $ftnum = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE shiftid = '".$booking_sl."' AND shift = 'first'"));
							 	if($ftnum > 0){$disable = "disabled='disabled'";}else{$disable = "";}
							 ?>
							 <a href="advertiseShift1.php?id=<?=$booking_sl?>&shift=first&mode=add"> <input type="button" name="1st" value="Advertise 1st Shift" <?=$disable;?> <?= $d ?> style=" background-color:#996600;"/></a>
                             <form action="" method="post">
							 <input type="hidden" name="date" value="<?=$firstShiftDate?>" />
                             <input type="hidden" name="fromDate" value="<?php echo $shift1Start; ?>" />
                             <input type="hidden" name="toDate" value="<?php echo $shift1Finish; ?>" />
                             <input type="hidden" name="stuffId" value="<?php echo $row['Uid']; ?>" />
                             <input type="hidden" name="booking_sl" value="<?php echo $_GET["sl"]; ?>" />
                             <input type="hidden" name="clientId" value="<?= $clientId ?>" />
                             <input type="hidden" name="shift" value="1" />  
							 <input type="hidden" name="word" value="<?=$word1?>" />
							 <input type="hidden" name="class" value="<?=$class1?>" />
							 <input type="hidden" name="speciality" value="<?=$speciality1?>" />                           
                             <input type="submit" name="1st" value="1st Shift" <?= $d ?> style="width:100px; background-color:#0CF;"/>
                             </form>
                             
							 
							 <?php if($booked2 != "" || $shift22 != "" || $secondShiftDate == "" || $secondShift == 'Cancel'){ $d="disabled='disabled'";}else{$d="";} ?>
							 <?php $ftnum = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE shiftid = '".$booking_sl."' AND shift = 'second'"));
							 	if($ftnum > 0){$disable = "disabled='disabled'";}else{$disable = "";}
							 ?>
							  <a href="advertiseShift1.php?id=<?=$booking_sl?>&shift=second&mode=add">  <input type="button" name="1st" value="Advertise 2nd Shift" <?=$disable;?> <?= $d ?> style=" background-color:#996600;"/></a>
                             <form action="" method="post">
							  <input type="hidden" name="date" value="<?=$secondShiftDate?>" />
                             <input type="hidden" name="fromDate" value="<?php echo $shift2Start; ?>" />
                             <input type="hidden" name="toDate" value="<?php echo $shift2Finish; ?>" />
                             <input type="hidden" name="stuffId" value="<?php echo $row['Uid']; ?>" />
                             <input type="hidden" name="clientId" value="<?= $clientId ?>" />
                             <input type="hidden" name="booking_sl" value="<?php echo $_GET["sl"]; ?>" />
                             <input type="hidden" name="shift" value="2" />
							 <input type="hidden" name="word" value="<?=$word2?>" />
							 <input type="hidden" name="class" value="<?=$class2?>" />
							 <input type="hidden" name="speciality" value="<?=$speciality2?>" />  
                             <input type="submit" name="2nd"  value="2nd Shift" <?= $d ?> style="width:100px; background-color:#0CF;"/>
                             </form>
                             
							 <?php if($booked3 != "" || $shift33 != "" || $thirdShiftDate == "" || $thirdShift == 'Cancel'){ $d="disabled='disabled'";}else{$d="";} ?>
							 <?php $ftnum = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE shiftid = '".$booking_sl."' AND shift = 'third'"));
							 	if($ftnum > 0){$disable = "disabled='disabled'";}else{$disable = "";}
							 ?>
							  <a href="advertiseShift1.php?id=<?=$booking_sl?>&shift=third&mode=add">  <input type="button" name="1st" value="Advertise 3rd Shift" <?= $d ?> <?=$disable;?> style=" background-color:#996600;"/></a>
                             <form action="" method="post">
							  <input type="hidden" name="date" value="<?=$thirdShiftDate?>" />
                             <input type="hidden" name="fromDate" value="<?php echo $shift3Start; ?>" />
                             <input type="hidden" name="toDate" value="<?php echo $shift3Finish; ?>" />
                             <input type="hidden" name="stuffId" value="<?php echo $row['Uid']; ?>" />
                             <input type="hidden" name="clientId" value="<?= $clientId ?>" />
                             <input type="hidden" name="booking_sl" value="<?php echo $_GET["sl"]; ?>" />
                             <input type="hidden" name="shift" value="3" />
							 <input type="hidden" name="word" value="<?=$word3?>" />
							 <input type="hidden" name="class" value="<?=$class3?>" />
							 <input type="hidden" name="speciality" value="<?=$speciality3?>" />  
                             <input type="submit" name="3rd"  value="3rd Shift" <?= $d ?>  style="width:100px; background-color:#0CF;"/>
                             </form>
                             </td>
                             
                            </tr>
									<?php }
                            
                            ?>
                            </table>
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
			selector: "#cms_pagedes",
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