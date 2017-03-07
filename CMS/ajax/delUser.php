<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];	
			
		$DeletePicSql="select * from ".TABLE_PREFIX."user_uploads where uploads_uid='".$feedid."'";
		$DeletePicQuery=mysql_query($DeletePicSql) or mysql_error();
		$DeletePicFetch=mysql_fetch_array($DeletePicQuery);
	
		
		$photo="../../profileimage/bigimg/".$DeletePicFetch['uploads_filename'];
		$thumb="../../profileimage/extbig/".$DeletePicFetch['uploads_filename'];
		$thumb2="../../profileimage/fullsize/".$DeletePicFetch['uploads_filename'];
		$thumb3="../../profileimage/medium/".$DeletePicFetch['uploads_filename'];
		$thumb4="../../profileimage/smallimg/".$DeletePicFetch['uploads_filename'];
		
		if(file_exists($photo)) { @unlink($photo); } // unlink 1st image
		if(file_exists($thumb)) { @unlink($thumb); }// unlink 1st image
		if(file_exists($thumb2)) { @unlink($thumb2); }// unlink 1st image
		if(file_exists($thumb3)) { @unlink($thumb3); }// unlink 1st image
		if(file_exists($thumb4)) { @unlink($thumb4); }// unlink 1st image
		
		$delSql="delete from ".TABLE_PREFIX."user_uploads where uploads_uid = '".$feedid."'";
		
		mysql_query($delSql);
			
			
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."student_registration WHERE Uid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
		$DeletePicSql="select * from ".TABLE_PREFIX."user_uploads where uploads_uid='".$valid."'";
		$DeletePicQuery=mysql_query($DeletePicSql) or mysql_error();
		$DeletePicFetch=mysql_fetch_array($DeletePicQuery);
	
		
		$photo="../../profileimage/bigimg/".$DeletePicFetch['uploads_filename'];
		$thumb="../../profileimage/extbig/".$DeletePicFetch['uploads_filename'];
		$thumb2="../../profileimage/fullsize/".$DeletePicFetch['uploads_filename'];
		$thumb3="../../profileimage/medium/".$DeletePicFetch['uploads_filename'];
		$thumb4="../../profileimage/smallimg/".$DeletePicFetch['uploads_filename'];
		
		if(file_exists($photo)) { @unlink($photo); } // unlink 1st image
		if(file_exists($thumb)) { @unlink($thumb); }// unlink 1st image
		if(file_exists($thumb2)) { @unlink($thumb2); }// unlink 1st image
		if(file_exists($thumb3)) { @unlink($thumb3); }// unlink 1st image
		if(file_exists($thumb4)) { @unlink($thumb4); }// unlink 1st image
		
		$delSql="delete from ".TABLE_PREFIX."user_uploads where uploads_uid = '".$valid."'";
		
		mysql_query($delSql);
	
		$delsels = "DELETE FROM ".TABLE_PREFIX."student_registration WHERE Uid = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Reg No</th>
										<th class="hidden-480">UserName</th>
										<th class="hidden-480">Email</th>
										<th class="hidden-480">Password</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Action</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."user_registration ORDER BY Uid DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											$prop_image = "select * from ".TABLE_PREFIX."user_uploads  where uploads_uid = '".$rowdest['Uid']."' and status = '1'";
											$prop_image_query = mysql_query($prop_image) or mysql_error();
											$prop_image_rows_set = mysql_fetch_array($prop_image_query);
											
												//Big Crop Img
												if($prop_image_rows_set['uploads_filename'] == "")
												{
													$proset = "images/nopic.jpg";
												}
												else if(!is_file("../../profileimage/smallimg/".$prop_image_rows_set['uploads_filename']))
												{
													$proset = "images/nopic.jpg";
												}
												else
												{
													$proset = "../profileimage/smallimg/".$prop_image_rows_set['uploads_filename'];
												} 	
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['Uid']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                        	<div class="tile image double selected">
												<div class="tile-body">
                                                <img src="<?=$proset?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['FirstName'])?>">
                                                </div>	
                                             </div>					
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['RegistrationNo']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['UserName']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['EmailId']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=base64_decode($rowdest['Password'])?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="changestatus(this.value,'<?=$rowdest['Uid']?>')">
												<option value="true" <?=$rowdest['UserStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['UserStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="userinfo.php?Uid=<?=$rowdest['Uid']?>">View <i class="icon-edit"></i></a> 

										</td>
                                        
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>