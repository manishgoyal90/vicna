<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT ScImage FROM ".TABLE_PREFIX."schoolsandclubs WHERE Scid = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../../schoolimage/bigimg/".$row_unlink['ScImage'];
					$thumb = "../../schoolimage/smallimg/".$row_unlink['ScImage'];
					$thumb1 = "../../schoolimage/fullsize/".$row_unlink['ScImage'];
					$thumb2 = "../../schoolimage/medium/".$row_unlink['ScImage'];
					$thumb3 = "../../schoolimage/large/".$row_unlink['ScImage'];
					
					
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
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."schoolsandclubs WHERE Scid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
									//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT ScImage FROM ".TABLE_PREFIX."schoolsandclubs WHERE Scid = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../../schoolimage/bigimg/".$row_unlink['ScImage'];
					$thumb = "../../schoolimage/smallimg/".$row_unlink['ScImage'];
					$thumb1 = "../../schoolimage/fullsize/".$row_unlink['ScImage'];
					$thumb2 = "../../schoolimage/medium/".$row_unlink['ScImage'];
					$thumb3 = "../../schoolimage/large/".$row_unlink['ScImage'];
					
					
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
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."schoolsandclubs WHERE Scid = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<div id="tablesec">
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<!--<th class="hidden-480">Category</th>-->
										<th class="hidden-480">Title</th>
										<th class="hidden-480">Links</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."schoolsandclubs ORDER BY Scid DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['ScImage'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../schoolimage/bigimg/".$rowdest['ScImage']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../schoolimage/bigimg/".$rowdest['ScImage'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['Scid']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                            <div class="tile image double selected">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['ScName'])?>">
                                                </div>	
                                             </div>						
                                        </td>
										<!--<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['CategoryName']?></div></td>-->
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['ScName']),0,30)?>...</div></td>
										<td class="hidden-480"><?=stripslashes($rowdest['ScLinks'])?></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['Scid']?>" onChange="changestatus(this.value,'<?=$rowdest['Scid']?>')">
												<option value="true" <?=$rowdest['ScStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['ScStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="schoolandclubview.php?Scid=<?=$rowdest['Scid']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="schoolandclub.php?mode=edit&Scid=<?=$rowdest['Scid']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['Scid']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
                      </div>