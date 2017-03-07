<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
		//Unlink Old ImageBefore Upload New image
		$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."staff_registration WHERE Uid = '".$feedid."'";
		$unlink_rs = mysql_query($unlink_sql) or mysql_error();
		$row_unlink = mysql_fetch_array($unlink_rs);
		
		$photo = "../../profileImage/".$row_unlink['UserImage'];
		if(file_exists($photo))
			{
				@unlink($photo);
			}
		
			

	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."staff_registration WHERE Uid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
	
		//Unlink Old ImageBefore Upload New image
		$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."staff_registration WHERE Uid = '".$valid."'";
		$unlink_rs = mysql_query($unlink_sql) or mysql_error();
		$row_unlink = mysql_fetch_array($unlink_rs);
		
		$photo = "../../profileImage/".$row_unlink['UserImage'];
		
		if(file_exists($photo))
			{
				@unlink($photo);
			}
		
			
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."staff_registration WHERE Uid = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Employee ID</th>
										<th class="hidden-480">Name</th>
										
										<th class="hidden-480">Email</th>
										
                                    
										<th class="hidden-480">Status</th>
										
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."staff_registration ORDER BY Uid DESC";
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
                                   
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['EmailId']?></div></td>
										
										
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="changestatus(this.value,'<?=$rowdest['Uid']?>')">
												<option value="true" <?=$rowdest['UserStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['UserStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
									
                                        
                                        <td class="hidden-480">
                                        <a href="staffinfo.php?Uid=<?=$rowdest['Uid']?>" class="btn mini green"><i class="icon-edit"></i> View</a>		                                        
                                            <a onclick="deleteone(<?=$rowdest['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>