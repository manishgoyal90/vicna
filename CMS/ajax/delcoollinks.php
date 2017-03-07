<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
						//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT ClImage FROM ".TABLE_PREFIX."coollinks WHERE Clid = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../../coollinks/bigimg/".$row_unlink['ClImage'];
					$thumb = "../../coollinks/smallimg/".$row_unlink['ClImage'];
					$thumb1 = "../../coollinks/fullsize/".$row_unlink['ClImage'];
					$thumb2 = "../../coollinks/medium/".$row_unlink['ClImage'];
					$thumb3 = "../../coollinks/large/".$row_unlink['ClImage'];
					
					
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
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."coollinks WHERE Clid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
						//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT ClImage FROM ".TABLE_PREFIX."coollinks WHERE Clid = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../../coollinks/bigimg/".$row_unlink['ClImage'];
					$thumb = "../../coollinks/smallimg/".$row_unlink['ClImage'];
					$thumb1 = "../../coollinks/fullsize/".$row_unlink['ClImage'];
					$thumb2 = "../../coollinks/medium/".$row_unlink['ClImage'];
					$thumb3 = "../../coollinks/large/".$row_unlink['ClImage'];
					
					
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
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."coollinks WHERE Clid = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<div id="tablesec">
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
									<!--	<th class="hidden-480">Image</th>-->
										<!--<th class="hidden-480">Category</th>-->
<!--										<th class="hidden-480">Title</th>
-->										<th class="hidden-480">Links</th>
										<!--<th class="hidden-480">Status</th>-->
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."coollinks ORDER BY Clid DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['ClImage'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../coollinks/bigimg/".$rowdest['ClImage']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../coollinks/bigimg/".$rowdest['ClImage'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['Clid']?>" name="feed[]"/>
                                        </td>
										<!--<td class="hidden-480">
                                            <div class="tile image double selected">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['ClName'])?>">
                                                </div>	
                                             </div>						
                                        </td>-->
										<!--<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['CategoryName']?></div></td>-->
									<!--	<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['ClName']),0,30)?>...</div></td>-->
										<td class="hidden-480"><?=stripslashes($rowdest['ClLinks'])?></td>
                                        <!-- <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['Clid']?>" onChange="changestatus(this.value,'<?=$rowdest['Clid']?>')">
												<option value="true" <?=$rowdest['ClStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['ClStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>-->
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="coollinksview.php?Clid=<?=$rowdest['Clid']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="coollinks.php?mode=edit&Clid=<?=$rowdest['Clid']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['Clid']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
                      </div>