<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
		//Unlink Old ImageBefore Upload New image
		$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."vip_member WHERE Uid = '".$feedid."'";
		$unlink_rs = mysql_query($unlink_sql) or mysql_error();
		$row_unlink = mysql_fetch_array($unlink_rs);
		
		$photo = "../../profileimage/fullsize/".$row_unlink['UserImage'];
		$thumb = "../../profileimage/bigimg/".$row_unlink['UserImage'];
		$thumb1 = "../../profileimage/smallimg/".$row_unlink['UserImage'];
		$thumb2 = "../../profileimage/medium/".$row_unlink['UserImage'];
		$thumb3 = "../../profileimage/extbig/".$row_unlink['UserImage'];
		
		if(file_exists($photo))
			{
				@unlink($photo);
			}
		if(file_exists($thumb))
			{
				@unlink($thumb);
			}
		if(file_exists($thumb1))
			{
				@unlink($thumb1);
			}
		if(file_exists($thumb2))
			{
				@unlink($thumb2);
			}
		if(file_exists($thumb3))
			{
				@unlink($thumb3);
			}
			

	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."vip_member WHERE Uid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
	
		//Unlink Old ImageBefore Upload New image
		$unlink_sql = "SELECT UserImage FROM ".TABLE_PREFIX."vip_member WHERE Uid = '".$valid."'";
		$unlink_rs = mysql_query($unlink_sql) or mysql_error();
		$row_unlink = mysql_fetch_array($unlink_rs);
		
		$photo = "../../profileimage/fullsize/".$row_unlink['UserImage'];
		$thumb = "../../profileimage/bigimg/".$row_unlink['UserImage'];
		$thumb1 = "../../profileimage/smallimg/".$row_unlink['UserImage'];
		$thumb2 = "../../profileimage/medium/".$row_unlink['UserImage'];
		$thumb3 = "../../profileimage/extbig/".$row_unlink['UserImage'];
		
		if(file_exists($photo))
			{
				@unlink($photo);
			}
		if(file_exists($thumb))
			{
				@unlink($thumb);
			}
		if(file_exists($thumb1))
			{
				@unlink($thumb1);
			}
		if(file_exists($thumb2))
			{
				@unlink($thumb2);
			}
		if(file_exists($thumb3))
			{
				@unlink($thumb3);
			}
			
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."vip_member WHERE Uid = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Reg No</th>
										<th class="hidden-480">Email</th>
										<th class="hidden-480">Password</th>
										<th class="hidden-480">Phone</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Action</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."vip_member ORDER BY Uid DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
										
											
												//Big Crop Img
												if($rowdest['UserImage'] == "")
												{
													$proset = "images/nopic.jpg";
												}
												else if(!is_file("../../profileimage/medium/".$rowdest['UserImage']))
												{
													$proset = "images/nopic.jpg";
												}
												else
												{
													$proset = "../profileimage/medium/".$rowdest['UserImage'];
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
										<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['EmailId']?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=base64_decode($rowdest['Password'])?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?php if($rowdest['Phone']!='') { ?><?=$rowdest['Phone']?><?php } else { echo"N/A"; } ?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="changestatus(this.value,'<?=$rowdest['Uid']?>')">
												<option value="true" <?=$rowdest['UserStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['UserStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										 <!-- <a class="btn mini green-stripe" data-toggle="modal" href="userinfo.php?Uid=<?=$rowdest['Uid']?>">View <i class="icon-edit"></i></a> -->
										 <!-- <a class="btn mini green-stripe" data-toggle="modal" href="#">View <i class="icon-edit"></i></a> -->
										  <a class="btn mini green" data-toggle="modal" href="#responssend<?=$ctn?>">Reply <i class="icon-edit"></i></a> 
										    <!------------------------Edit in lightbox Start--------------->
											 <div id="responssend<?php echo $ctn; ?>" class="modal hide fade dip" tabindex="-1" data-width="650">		 	
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
													<h3>Reply To <?=stripslashes($rowdest['FirstName'])?></h3>
												</div>
												<form name="frmpageedt" id="frmpageedt" class="form-horizontal" action="<?=$_SERVER['PHP_SELF']?>" method="post" style="margin:0; padding:0" enctype="multipart/form-data">	
													<input type="hidden" name="Uid" value="<?=$rowdest['Uid']?>">			
													<div class="modal-body">
														
														<div class="scroller" style="height:350px" data-always-visible="1" data-rail-visible1="1">
															<div class="row-fluid">
																<div class="span10">
																	   <div class="control-group">
																		  <label class="control-label">To</label>
																		  <div class="controls">
																			 <input type="text" class="span m-wrap" name="email" id="email" value="<?=$rowdest['EmailId']?>"/>
																		  </div>
																	   </div>
                                                                       
                                                                       <div class="control-group">
																		  <label class="control-label">Subject</label>
																		  <div class="controls">
																			 <input type="text" class="span m-wrap" name="subject" id="subject" value="" />
																		  </div>
																	   </div>
                                                                       
                                                                       <div class="control-group">
																		  <label class="control-label">Message</label>
																		  <div class="controls">
																			 <textarea name="message" class="span m-wrap" rows="7" cols="10"></textarea>
																		  </div>
																	   </div>
																 </div>																
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" data-dismiss="modal" class="btn">Close</button>
														<input type="submit" class="btn blue" name="submit" value="Send" />
													</div>
												</form>
											</div>
										<!------------------------Edit in lightbox End--------------->

										</td>
                                        
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>