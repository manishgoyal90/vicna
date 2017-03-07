<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT ImagePath FROM ".TABLE_PREFIX."news_details WHERE NewsId = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../News/bigimg/".$row_unlink['ImagePath'];
					$thumb = "../../News/smallimg/".$row_unlink['ImagePath'];
					$thumb1 = "../../News/fullsize/".$row_unlink['ImagePath'];
					$thumb2 = "../../News/medium/".$row_unlink['ImagePath'];
					$thumb3 = "../../News/extbig/" . $row_unlink['ImagePath'];
					$thumb4 = "../../News/extbig2/" . $row_unlink['ImagePath'];
					
					
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
				   if(file_exists($thumb4))
						{
							@unlink($thumb4);
						}
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."news_details WHERE NewsId = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT ImagePath FROM ".TABLE_PREFIX."news_details WHERE NewsId = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../News/bigimg/".$row_unlink['ImagePath'];
					$thumb = "../../News/smallimg/".$row_unlink['ImagePath'];
					$thumb1 = "../../News/fullsize/".$row_unlink['ImagePath'];
					$thumb2 = "../../News/medium/".$row_unlink['ImagePath'];
					$thumb3 = "../../News/extbig/" . $row_unlink['ImagePath'];
					$thumb4 = "../../News/extbig2/" . $row_unlink['ImagePath'];
					
					
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
				   if(file_exists($thumb4))
						{
							@unlink($thumb4);
						}
	
		$delsels = "DELETE FROM ".TABLE_PREFIX."news_details WHERE NewsId = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<!--<th class="hidden-480">Category</th>-->
										<th class="hidden-480">Title</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."news_details ORDER BY NewsId DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['ImagePath'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../News/bigimg/".$rowdest['ImagePath']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../News/bigimg/".$rowdest['ImagePath'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['NewsId']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                            <div class="tile image double selected">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['NewsTitle'])?>">
                                                </div>	
                                             </div>					
                                        </td>
										<!--<td class="hidden-480"><div class="videoWrapper"><?=$rowdest['CategoryName']?></div></td>-->
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['NewsTitle']),0,30)?>...</div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['NewsId']?>" onChange="changestatus(this.value,'<?=$rowdest['NewsId']?>')">
												<option value="true" <?=$rowdest['NewsStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['NewsStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="newsview.php?NewsId=<?=$rowdest['NewsId']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="news.php?mode=edit&NewsId=<?=$rowdest['NewsId']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['NewsId']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>