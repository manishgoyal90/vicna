<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT BannerImage FROM ".TABLE_PREFIX."banner WHERE BannerId = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../Banner/bigimg/".$row_unlink['BannerImage'];
					$thumb = "../../Banner/smallimg/".$row_unlink['BannerImage'];
					$thumb1 = "../../Banner/fullsize/".$row_unlink['BannerImage'];
					$thumb2 = "../../Banner/medium/".$row_unlink['BannerImage'];
					$thumb3 = "../../Banner/extbig/".$row_unlink['BannerImage'];
					
					
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
	
	$delsingle = "DELETE  from ".TABLE_PREFIX."banner WHERE BannerId = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT BannerImage FROM ".TABLE_PREFIX."banner WHERE BannerId = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../Banner/bigimg/".$row_unlink['BannerImage'];
					$thumb = "../../Banner/smallimg/".$row_unlink['BannerImage'];
					$thumb1 = "../../Banner/fullsize/".$row_unlink['BannerImage'];
					$thumb2 = "../../Banner/medium/".$row_unlink['BannerImage'];
					$thumb3 = "../../Banner/extbig/".$row_unlink['BannerImage'];
					
					
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
	
		$delsels = "DELETE FROM  ".TABLE_PREFIX."banner WHERE BannerId = '".$valid."'";
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
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner ORDER BY BannerId DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['BannerImage'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../Banner/extbig/".$rowdest['BannerImage']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../Banner/extbig/".$rowdest['BannerImage'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['BannerId']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                            <div class="tile image double selected" style="width:210px !important;">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['BannerNmae'])?>">
                                                </div>	
                                             </div>					
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['BannerNmae']),0,30)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['BannerDescription']),0,50)?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['BannerId']?>" onChange="changestatus(this.value,'<?=$rowdest['BannerId']?>')">
												<option value="true" <?=$rowdest['BannerStatus'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['BannerStatus'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<!--<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="BannerView.php?BannerId=<?=$rowdest['BannerId']?>">View <i class="icon-edit"></i></a>                                           
										</td>-->
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="Banner.php?mode=edit&BannerId=<?=$rowdest['BannerId']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['BannerId']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
                      </div>