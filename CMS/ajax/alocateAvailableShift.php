<?php 
include("../../config/connect.php");


	$uid = $_REQUEST['uid'];
	$id = $_REQUEST['id'];
	
	
	$update = "UPDATE staff_available_shift SET accept_staffid = '".$uid."' WHERE id = '".$id."'";
	mysql_query($update) or die(mysql_error());
	
	$fetch = mysql_fetch_array(mysql_query("SELECT * FROM staff_available_shift WHERE id = '".$id."'"));
	if($fetch['shiftid'] != "")
	{
		$shift = 0;
		if($fetch['shift'] == 'first')
			$shift = 1;
		if($fetch['shift'] == 'second')
			$shift = 2;
		if($fetch['shift'] == 'third')
			$shift = 3;
		$fromDate = $fetch['date'].' '.$fetch['start_time'];
		$toDate = $fetch['date'].' '.$fetch['end_time'];
		$insert="INSERT INTO stuff_booked SET
						stuffId = '".$fetch['accept_staffid']."',
						clientId = '".$fetch['clientId']."',
						booking_sl = '".$fetch['shiftid']."',
						shift = '".$shift."',
						formDate = '".$fromDate."',
						toDate = '".$toDate."',
						dt = NOW()";
		
		$r=mysql_query($insert)or die("error:".mysql_error());				
	}
	


?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Employee ID</th>
										<th class="hidden-480">Name</th>
										<th class="hidden-480">Qualification</th>
										<th class="hidden-480">Email</th>
										
                                    
										<th class="hidden-480">Advertise Shifts</th>
										
                                        <th class="hidden-480" style="width:15%;">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									if(isset($_REQUEST['search'])){
										$where ="WHERE 1=1 ";
										if($_REQUEST['RegNo'] != "")
										{
											$where .= "AND RegistrationNo = '".trim($_REQUEST['RegNo'])."'";
										}
										if($_REQUEST['fname'] != "")
										{
											$where .= "AND FirstName LIKE '".trim($_REQUEST['fname'])."%'";
										}
										if($_REQUEST['lname'] != "")
										{
											$where .= "AND FirstName = '".trim($_REQUEST['lname'])."'";
										}
										if($_REQUEST['qualification'] != "")
										{
											$where .= "AND qualification = '".trim($_REQUEST['qualification'])."'";
										}
										$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."staff_registration $where ORDER BY Uid DESC";
									
									}else{
										$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."staff_registration ORDER BY Uid DESC";
									}
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											
												//Big Crop Img
												if($rowdest['UserImage'] == "")
												{
													$proset = "images/nopic.jpg";
												}
												else if(!is_file("../../profileImage/".$rowdest['UserImage']))
												{
													$proset = "images/nopic.jpg";
												}
												else
												{
													$proset = "../profileImage/".$rowdest['UserImage'];
												} 	
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['Uid']?>" name="feed[]"/>
                                        </td>
										<td style="width:60px;" >
                                        	
												<div class="tile-body">
                                                <img src="<?=$proset?>" alt="Wait..." title="<?=stripslashes($rowdest['FirstName'])?>">
                                                </div>	
                                            			
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['RegistrationNo']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['FirstName'].' '.$rowdest['LastName'];?></div></td>
                                   	<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['qualification']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['EmailId']?></div></td>
										
								<?php
								$sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = ''");
								
								
								
								?>	
								<td class="hidden-480">
											<div class="controls">
											 <select class="span9" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="alocateShift(this.value,'<?=$rowdest['Uid']?>')">
												 <option value="">Select Shift</option>
											<?php while($fetAdv = mysql_fetch_array($sql))
												 {
												
												?>
												<option value="<?=$fetAdv['id'];?>"><?=$fetAdv['location'].'; '.$fetAdv['role'].'; '.date('d/m/Y', strtotime($fetAdv['date'])).', Shift From: '.$fetAdv['start_time'].', To: '.$fetAdv['end_time'];?></option>
											<?php }?>
											 </select>
										  </div>
										</td>
                                        <!-- <td class="hidden-480">
											<div class="controls">
											 <select class="span9" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="changestatus(this.value,'<?=$rowdest['Uid']?>')">
												<option value="true" <?=$rowdest['UserStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['UserStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
									-->
                                        
                                        <td class="hidden-480">
                                        <a href="staffinfo.php?Uid=<?=$rowdest['Uid']?>" class="btn mini green"><i class="icon-edit"></i> View</a>		                                        
                                            <a onclick="deleteone(<?=$rowdest['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>