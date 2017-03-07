<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."course_topics WHERE tid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM ".TABLE_PREFIX."course_topics WHERE tid = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
										<th class="hidden-480">Course Type</th> 
										<th class="hidden-480">Subject Cat Name</th>
										<th class="hidden-480">Subject Code</th>
										<th class="hidden-480">Topics Name</th>
										<th class="hidden-480">Topics Code</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$i=1;
									$GetUserSql = "SELECT ct.*, ct.tid as topicid, cc.*,cta.* FROM ".TABLE_PREFIX."course_topics as ct
															INNER JOIN ".TABLE_PREFIX."course_category as cc ON cc.subject_code = ct.subject_code
															INNER JOIN ".TABLE_PREFIX."course_type as cta ON cta.tid = cc.course_type
														    ORDER BY cc.course_type ASC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 			
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['topicid']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480"><div class="videoWrapper">

										 &nbsp;<a href="" class="btn mini purple"><?=substr($rowdest['ct_name'],0,20)?></a>
										</div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr($rowdest['course_name'],0,20)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['subject_code'])?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr($rowdest['topics_name'],0,15)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['topics_subject_code'])?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['topicid']?>" onChange="changestatus(this.value,'<?=$rowdest['topicid']?>')">
												<option value="true" <?=$rowdest['topic_status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['topic_status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="topicslistview.php?topicid=<?=$rowdest['topicid']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="topics.php?mode=edit&topicid=<?=$rowdest['topicid']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['topicid']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php } ?>
								</tbody>
							</table>