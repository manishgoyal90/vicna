<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$galleryid = $_REQUEST['galleryid'];
	
						//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT gallery_image FROM ".TABLE_PREFIX."gallery WHERE id = '".$galleryid."'";
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
	
	$delpics = "DELETE FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$galleryid."'";
	mysql_query($delpics) or die(mysql_error());
		
	$delsingle = "DELETE FROM ".TABLE_PREFIX."gallerylist WHERE id = '".$galleryid."'";
	mysql_query($delsingle) or die(mysql_error());
}

if($_REQUEST['mode'] == "selected")
{
	$galleryids = trim($_REQUEST['galleryids'],",");
	$galleryids = explode(",",$galleryids);
	
	foreach($galleryids as $valid)
	{
		$getyacht = "SELECT * FROM ".TABLE_PREFIX."gallerylist WHERE id = '".$valid."'";
		$getyacht = mysql_query($getyacht) or die(mysql_error());
		$rowyacht = mysql_fetch_array($getyacht);
		
		$dirname = str_replace(" ","",$rowyacht['gallery_name']);
			
		$delpics = "DELETE FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$valid."'";
		mysql_query($delpics) or die(mysql_error());
		
		$arr = scandir(realpath("../photo_gallery/".$dirname));
		
		foreach($arr as $val)
		{
									//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT gallery_image FROM ".TABLE_PREFIX."gallery WHERE id = '".$val."'";
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
		}
	
		
		
		$delsels = "DELETE FROM ".TABLE_PREFIX."gallerylist WHERE id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}

?>
<table class="table table-striped table-bordered table-hover" id="sample_2">
								<thead>
									<tr>
										<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
										<th class="hidden-480">Gallery</th>
										<th class="hidden-480" style="width:100px;">Name</th>
										<th class="hidden-480">Date</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Edit</th>
										<th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
										$getdest = "SELECT *  FROM ".TABLE_PREFIX."gallerylist";
											   
									$getdest = mysql_query($getdest) or die(mysql_error());
									while($rowdest = mysql_fetch_array($getdest))
									{
										$getgalpic = "SELECT gallery_image FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$rowdest['id']."' ORDER BY id DESC LIMIT 1";
										$getgalpic = mysql_query($getgalpic) or die(mysql_error());
										$getgalpic = mysql_fetch_array($getgalpic);
										
										$getcnt = "SELECT COUNT(*) AS cnt FROM ".TABLE_PREFIX."gallery WHERE gallery_id = '".$rowdest['id']."'";
										$getcnt = mysql_query($getcnt) or die(mysql_error());
										$getcnt = mysql_fetch_array($getcnt);
										
										// Get picture
										if($getgalpic['gallery_image'] == "")
										{
											$pic = "images/nopic.jpg";
										}
										else if(!is_file("../../gallery/bigimg/".$getgalpic['gallery_image']))
										{
											$pic = "images/nopic.jpg";
										}
										else
										{
											$pic = "../gallery/bigimg/".$getgalpic['gallery_image'];
										}
									?>
									
									<tr class="odd gradeX">
										<td><input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="gallery[]"/></td>
										<td class="hidden-480">
											<div class="tile image double selected" onclick="location.href='galleryimage.php?id=<?=$rowdest['id']?>'">
												<div class="tile-body">
													<img src="<?=$pic?>" alt="Wait...">												
                                                 </div>
												<div class="tile-object">
													<div class="name">
														Gallery	
                                                    </div>
													<div class="number">
														<?=$getcnt['cnt']?>
													</div>
												</div>
											</div>	
								</td>
										<td class="hidden-480"><?=stripslashes($rowdest['gallery_name'])?></td>
										<td class="hidden-480"><?=date("M jS, Y",strtotime($rowdest['gallery_date']))?></td>
										<td class="hidden-480">
										
											<div class="controls">
											 <select class="span6 chosen" tabindex="1" style="width:64px;" id="stat<?=$rowdest['id']?>" onChange="changestatus(this.value,'<?=$rowdest['id']?>')">
												<option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>On</option>
												<option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>Off</option>
											 </select>
										  </div>										</td>
										<td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="managegallerylist.php?mode=edit&id=<?=$rowdest['id']?>"><i class="icon-edit"></i> Edit</a></td>
										<td ><a class="btn mini red" href="#" onclick="deleteone(<?=$rowdest['id']?>)"><i class="icon-trash"></i> Delete</a></td>
									</tr>
									
									<?php
									}
									?>
								</tbody>
							</table>
