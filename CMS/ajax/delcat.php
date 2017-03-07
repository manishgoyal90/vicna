<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."course_category WHERE cid = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM ".TABLE_PREFIX."course_category WHERE cid = '".$valid."'";
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
										<th class="hidden-480">Heading</th>
										<th class="hidden-480">Subject Code</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <!--<th class="hidden-480">Delete</th>-->
									</tr>
								</thead>
								<tbody>
									
								<?php
									$i=1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."course_category  ORDER BY course_type ASC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['cid']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480"><div class="videoWrapper">
										<?php
										 		$ext = explode(",",$rowdest['course_type']);
												$rt = implode("','",$ext);

										 		//Fetch Cat Type Name 
												$i=1;
												$FetchUserSql2 = "SELECT ct_name FROM ".TABLE_PREFIX."course_type WHERE tid IN('$rt')"; 
												$FetchUserQuery2 = mysql_query($FetchUserSql2);
												while($rowdest2 = mysql_fetch_array($FetchUserQuery2)) { 
										 ?>
										 &nbsp;<a href="" class="btn mini purple"><?=substr($rowdest2['ct_name'],0,20)?></a><br /><?php $i++;} ?>	
										</div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr($rowdest['course_name'],0,20)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr($rowdest['heading'],0,15)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=stripslashes($rowdest['subject_code'])?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['cid']?>" onChange="changestatus(this.value,'<?=$rowdest['cid']?>')">
												<option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="coursecatview.php?cid=<?=$rowdest['cid']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="course-cat.php?mode=edit&cid=<?=$rowdest['cid']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <!--<td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['cid']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>-->
                                       </tr>
                                       <?php } ?>
								</tbody>
							</table>