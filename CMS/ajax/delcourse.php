<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT course_image FROM ".TABLE_PREFIX."course_list WHERE crid = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../../courseimage/bigimg/".$row_unlink['course_image'];
					$thumb = "../../courseimage/smallimg/".$row_unlink['course_image'];
					$thumb1 = "../../courseimage/fullsize/".$row_unlink['course_image'];
					$thumb2 = "../../courseimage/medium/".$row_unlink['course_image'];
					$thumb3 = "../../courseimage/large/".$row_unlink['course_image'];
					
					
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
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."course_list WHERE crid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
	
	$delsingle2 = "DELETE FROM ".TABLE_PREFIX."course_date_time WHERE course_id = '".$feedid."'";
	mysql_query($delsingle2) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT course_image FROM ".TABLE_PREFIX."course_list WHERE crid = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs); 
					
					$photo = "../../courseimage/bigimg/".$row_unlink['course_image'];
					$thumb = "../../courseimage/smallimg/".$row_unlink['course_image'];
					$thumb1 = "../../courseimage/fullsize/".$row_unlink['course_image'];
					$thumb2 = "../../courseimage/medium/".$row_unlink['course_image'];
					$thumb3 = "../../courseimage/large/".$row_unlink['course_image'];
					
					
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
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."course_list WHERE crid = '".$valid."'";
	mysql_query($delsingle) or die(mysql_error());
	
	$delsingle2 = "DELETE FROM ".TABLE_PREFIX."course_date_time WHERE course_id = '".$valid."'";
	mysql_query($delsingle2) or die(mysql_error());
	}
}
?>
<div id="tablesec">
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
										<th class="hidden-480">Course Type</th> 
										<th class="hidden-480">Subject Area</th>
										<th class="hidden-480">Subject Topics</th>
										<th class="hidden-480">Course Title</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
						<?php
							$FetchCourseSql = "SELECT cl.*,ct.ct_name, cc.*, col.cl_name as level_name, costop.* FROM ".TABLE_PREFIX."course_list as cl 
															INNER JOIN ".TABLE_PREFIX."course_type as ct ON ct.tid = cl.course_type 
															INNER JOIN ".TABLE_PREFIX."course_category as cc ON cc.subject_code = cl.subject_area 
															LEFT JOIN ".TABLE_PREFIX."course_level as col ON col.id = cl.course_level 
															INNER JOIN ".TABLE_PREFIX."course_topics as costop ON costop.topics_subject_code = cl.course_topics  
															ORDER BY cl.course_title ASC";
							$CourseQuery = mysql_query($FetchCourseSql);
							$NumRows = mysql_num_rows($CourseQuery);
							while($rowdest = mysql_fetch_array($CourseQuery)) {
							
								if($FetchCourseRows['course_image'] == "")
								{
									$pict = "img/nocourseimg.png";
								}
								else if(!is_file("courseimage/medium/".$FetchCourseRows['course_image']))
								{
									$pict = "img/nocourseimg.png";
								}
								else
								{
									$pict = "courseimage/medium/".$FetchCourseRows['course_image'];
								}
								
								$rate_id = $FetchCourseRows['crid'];
								$rate_type = "Course";
								
								//Course Date Time Fetch
								
									$CourseDateSql = "SELECT * FROM ".TABLE_PREFIX."course_date_time WHERE course_id = '".$FetchCourseRows['crid']."'";
									$ResDate = mysql_query($CourseDateSql);
									$num = mysql_num_rows($ResDate);
									$ArrDate = mysql_fetch_array($ResDate);
									
									$how_long_course = explode("`",$FetchCourseRows['how_long_course']);
								    $start = strtotime($ArrDate['start_date']);
									$end = strtotime($ArrDate['end_date']);
									$days_between = ceil(abs($end - $start) / 86400);			
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['topicid']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480"><div class="videoWrapper">

										 &nbsp;<a href="" class="btn mini purple"><?=substr(stripslashes($rowdest['ct_name']),0,20)?></a>
										</div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['course_name']),0,20)?> (<?=stripslashes($rowdest['subject_code'])?>)</div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['topics_name']),0,15)?> (<?=stripslashes($rowdest['topics_subject_code'])?>)</div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['course_title']),0,15)?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['crid']?>" onChange="changestatus(this.value,'<?=$rowdest['crid']?>')">
												<option value="true" <?=$rowdest['course_status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['course_status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										 <a class="btn mini green-stripe" data-toggle="modal" href="#">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="#">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['crid']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php } ?>
								</tbody>
							</table>
                      </div>