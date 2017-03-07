<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM staff_available_shift WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM ".TABLE_PREFIX."staff_available_shift WHERE id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Location</th>
										<th class="hidden-480">Role</th>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Time</th>
                                        <th class="hidden-480">Penalties</th>
                                        <th class="hidden-480">More Info</th>
										<th class="hidden-480">Status</th>
										
                                        <th class="hidden-480">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM staff_available_shift WHERE accept_staffid = '' ORDER BY id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/>
                                        </td>
										
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['location']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['role']);?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=date('d M Y', strtotime($rowdest['date']))?><br/><?=date('l', strtotime($rowdest['date']))?></div></td>
                                   
										<td class="hidden-480"><div class="videoWrapper">Start : <?php echo $rowdest['start_time'];?><br/>Finish : <?php echo $rowdest['end_time'];?></div></td>
                                        <td class="hidden-480"><div class="videoWrapper"><?php echo stripslashes($rowdest['penalties']);?></div></td>
                                        <td class="hidden-480"><div class="videoWrapper"><?php echo stripslashes($rowdest['more_info']);?></div></td>
                                         <td class="hidden-480" style="width:100px;">
											<div class="controls">
												<?=$rowdest['status'];?>
											<!-- <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>-->
										  </div>
										</td>
									
                                        
                                        <td class="hidden-480">		                                        
                                            <a href="advertiseShiftView.php?Uid=<?=$rowdest['id']?>" class="btn mini green"><i class="icon-edit"></i> View</a>			
                                            <a onclick="deleteone(<?=$rowdest['id']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>