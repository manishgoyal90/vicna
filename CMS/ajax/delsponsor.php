<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT SponsorsImage FROM ".TABLE_PREFIX."sponsors_partners WHERE SponsorsId = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../sponsor/bigimg/".$row_unlink['SponsorsImage'];
					$thumb = "../../sponsor/smallimg/".$row_unlink['SponsorsImage'];
					$thumb1 = "../../sponsor/fullsize/".$row_unlink['SponsorsImage'];
					$thumb2 = "../../sponsor/medium/".$row_unlink['SponsorsImage'];
					$thumb3 = "../../sponsor/extbig/".$row_unlink['SponsorsImage'];
					
					
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
	
	$delsingle = "DELETE  from ".TABLE_PREFIX."sponsors_partners WHERE SponsorsId = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT SponsorsImage FROM ".TABLE_PREFIX."sponsors_partners WHERE SponsorsId = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../sponsor/bigimg/".$row_unlink['SponsorsImage'];
					$thumb = "../../sponsor/smallimg/".$row_unlink['SponsorsImage'];
					$thumb1 = "../../sponsor/fullsize/".$row_unlink['SponsorsImage'];
					$thumb2 = "../../sponsor/medium/".$row_unlink['SponsorsImage'];
					$thumb3 = "../../sponsor/extbig/".$row_unlink['SponsorsImage'];
					
					
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
	
		$delsels = "DELETE FROM  ".TABLE_PREFIX."sponsors_partners WHERE SponsorsId = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<div id="tablesec">
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Title</th>
                                        <th class="hidden-480">Description</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."sponsors_partners ORDER BY SponsorsId DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['SponsorsImage'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../sponsor/extbig/".$rowdest['SponsorsImage']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../sponsor/extbig/".$rowdest['SponsorsImage'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['SponsorsId']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                            <div class="tile image double selected" style="width:210px !important;">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['SponsorsImage'])?>">
                                                </div>	
                                             </div>					
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['SponsorsName']),0,30)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['SponsorsDescription']),0,50)?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['SponsorsId']?>" onChange="changestatus(this.value,'<?=$rowdest['SponsorsId']?>')">
												<option value="true" <?=$rowdest['SponsorsStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['SponsorsStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="sponsorview.php?SponsorsId=<?=$rowdest['SponsorsId']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="sponsor.php?mode=edit&SponsorsId=<?=$rowdest['SponsorsId']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['SponsorsId']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
                      </div>