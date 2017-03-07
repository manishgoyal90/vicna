<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$galleryid = $_REQUEST['feedid'];
	
						//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT gallery_image FROM ".TABLE_PREFIX."vgallerylist WHERE id = '".$galleryid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../gallery3/bigimg/".$row_unlink['gallery_image'];
					$thumb = "../../gallery3/smallimg/".$row_unlink['gallery_image'];
					$thumb1 = "../../gallery3/fullsize/".$row_unlink['gallery_image'];
					$thumb2 = "../../gallery3/medium/".$row_unlink['gallery_image'];
					$thumb3 = "../../gallery3/extsmall/".$row_unlink['gallery_image'];
					
					
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
	
/*	$delpics = "DELETE FROM ".TABLE_PREFIX."gallery2 WHERE gallery_id = '".$galleryid."'";
	mysql_query($delpics) or die(mysql_error());*/
		
	$delsingle = "DELETE FROM ".TABLE_PREFIX."vgallery WHERE id = '".$galleryid."'";
	mysql_query($delsingle) or die(mysql_error());
}

if($_REQUEST['mode'] == "selected")
{
	$galleryids = trim($_REQUEST['feedid'],",");
	$galleryids = explode(",",$galleryids);
	
	foreach($galleryids as $valid)
	{
						//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT gallery_image FROM ".TABLE_PREFIX."vgallery WHERE id = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../gallery3/bigimg/".$row_unlink['gallery_image'];
					$thumb = "../../gallery3/smallimg/".$row_unlink['gallery_image'];
					$thumb1 = "../../gallery3/fullsize/".$row_unlink['gallery_image'];
					$thumb2 = "../../gallery3/medium/".$row_unlink['gallery_image'];
					$thumb3 = "../../gallery3/extsmall/".$row_unlink['gallery_image'];
					
					
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
		
		
		$delsels = "DELETE FROM ".TABLE_PREFIX."vgallery WHERE id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}

?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
										<th class="hidden-480">Video</th>
										<th class="hidden-480">Title</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."vgallery ORDER BY id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 			
									?>
									<tr class="odd gradeX">
										<td class="hidden-480" style="width:120px;">
											 <div class="fileupload-new thumbnail" style="width:100%">
																			<?php 
																			// Ectension detection
																				$videopage = explode("/",$rowdest['video_path']);
																				
																				$videopage = explode(".",end($videopage));
																				$videopage = $videopage[1];
																				
																				if($videopage=="" && $rowdest['video_type']=="1") {
																			?>
																			
																			   <?php $vid = explode("=",$rowdest['video_path']);
																				//echo "kkk".$vid[1];
																			   ?>
																			   <iframe width="300" height="250" src="//www.youtube.com/embed/<?=$vid[1]?>" frameborder="0" allowfullscreen></iframe>
																			   <?php /*} else if($videopage=="" && $rowdest['VideoType']=="3") {
																					$vid = end(explode("/",$rowdest['VideoPath']));  */
																				?>
																				<!--<iframe src="http://player.vimeo.com/video/<?=$vid?>" width="400" height="350" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>-->
																			   <?php }  else if($videopage!="" && $rowdest['video_type']=="2") { ?>
																				<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
																				<script type="text/javascript" src="http://www.stephenbelanger.com/wp-content/uploads/2010/01/jquery.flash.min_.js"></script>
																						<div id="myplayer">
																						<script type="text/javascript">
																							$(document).ready(function(){
																								$('#myplayer').flash({
																									'src':'<?=$siteurl?>gddflvplayer.swf',
																									'width':'100%',
																									'height':'250',
																									'allowfullscreen':'true',
																									'allowscriptaccess':'always',
																									'wmode':'transparent',
																									'flashvars': {
																										'vdo':'<?=$siteurl?>gallery3/videofile/<?=$rowdest['video_path']?>',
																										'sound':'50',
																										'splashscreen':'<?=$siteurl?>gallery3/medium/<?=$rowdest['gallery_image']?>',
																										'autoplay':'false',
																										'clickTAG':'#',
																										'endclipaction':'javascript:endclip();'
																									}
																								});
																							});
																						</script>
																						</div>
																						
																						<script>
																						// endclip function called when clip ends
																						function endclip(){
																									$('#myplayer').flash({
																									'src':'<?=$siteurl?>gddflvplayer.swf',
																									'width':'300',
																									'height':'250',
																									'wmode':'transparent',
																									'flashvars': {
																										'vdo':'<?=$siteurl?>gallery3/videofile/<?=$rowdest['video_path']?>',
																										'autoplay':'true',
																									}
																									});	
																							}
																						</script>
																				   <?php } ?>
																		  </div>                                      </td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['image_title']),0,20)?>...</div></td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>						</td>
                                  </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
