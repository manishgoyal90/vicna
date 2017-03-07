<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
						//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT gallery_image FROM ".TABLE_PREFIX."gallery WHERE id = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../gallery/bigimg/".$row_unlink['gallery_image'];
					$thumb = "../../gallery/smallimg/".$row_unlink['gallery_image'];
					$thumb1 = "../../gallery/fullsize/".$row_unlink['gallery_image'];
					$thumb2 = "../../gallery/medium/".$row_unlink['gallery_image'];
					$thumb3 = "../../gallery/extsmall/".$row_unlink['gallery_image'];
					
					
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
	
	$delsingle = "DELETE FROM  ".TABLE_PREFIX."gallery WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT gallery_image FROM ".TABLE_PREFIX."gallery WHERE id = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../gallery/bigimg/".$row_unlink['gallery_image'];
					$thumb = "../../gallery/smallimg/".$row_unlink['gallery_image'];
					$thumb1 = "../../gallery/fullsize/".$row_unlink['gallery_image'];
					$thumb2 = "../../gallery/medium/".$row_unlink['gallery_image'];
					$thumb3 = "../../gallery/extsmall/".$row_unlink['gallery_image'];
					
					
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
	
		$delsels = "DELETE FROM  ".TABLE_PREFIX."gallery WHERE id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Title</th>
										<th class="hidden-480">Description</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$_REQUEST['id']."' ORDER BY id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['gallery_image'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../gallery/bigimg/".$rowdest['gallery_image']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../gallery/bigimg/".$rowdest['gallery_image'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/>                                        </td>
										<td class="hidden-480">
                                             <div class="tile image double selected">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['image_title'])?>">                                                </div>	
                                             </div>                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['image_title']),0,30)?>...</div></td>
                                         <td class="hidden-480"><div class="videoWrapper">
                                           <?=substr(stripslashes($rowdest['image_description']),0,70)?>
                                         ...</div></td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="MusicView.php?MusicId=<?=$rowdest['MusicId']?>">View <i class="icon-edit"></i></a>										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="editimage.php?mode=edit&id=<?=$rowdest['id']?>&gallery_id=<?=$rowdest['gallery_id']?>">Edit <i class="icon-edit"></i></a>                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                  </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>