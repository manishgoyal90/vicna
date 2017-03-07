<?php 
include("../../config/connect.php");

$gallery_id = $_REQUEST['gallery_id'];

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['picid'];
	
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
	
	$delsingle = "DELETE  from ".TABLE_PREFIX."gallery WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['picids'],",");
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
										<th style="width:8px;">SlNo.<!--<input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />--></th>
										<th class="hidden-480" style="width:100px;">Picture</th>
										<th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
								$getdest = "SELECT * FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$gallery_id."' ORDER BY id DESC";
								$getdest = mysql_query($getdest) or die(mysql_error());
								while($rowdest = mysql_fetch_array($getdest))
								{
									// Get picture
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
									<td><?=$c?><!--<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="pics[]"/>--></td>
									<td class="hidden-480">
									
									<div class="tile image double selected">
										<div class="tile-body">
											<img src="<?=$pic?>" alt="">
										</div>
									</div>
									
									</td>
									<td ><a class="btn mini red" style="cursor:pointer" onclick="deleteone(<?=$rowdest['id']?>)"><i class="icon-trash"></i> Delete</a></td>
								</tr>
								
								<?php
								$c++;
								}
								?>
									
								</tbody>
							</table>