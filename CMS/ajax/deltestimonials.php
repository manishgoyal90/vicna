<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."testimonials WHERE testimonials_id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
		$delsels = "DELETE FROM ".TABLE_PREFIX."testimonials WHERE testimonials_id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Testimonial Posted By</th>
										<th class="hidden-480">Testimonial</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."testimonials ORDER BY testimonials_id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['testimonials_id']?>" name="feed[]"/>                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['testimonials_name']),0,15)?></div></td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['testimonials_description']),0,50)?>...</div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['testimonials_id']?>" onChange="changestatus(this.value,'<?=$rowdest['testimonials_id']?>')">
												<option value="true" <?=$rowdest['testimonials_status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['testimonials_status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="testimonialsview.php?testimonials_id=<?=$rowdest['testimonials_id']?>">View <i class="icon-edit"></i></a>										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="testimonials.php?mode=edit&testimonials_id=<?=$rowdest['testimonials_id']?>">Edit <i class="icon-edit"></i></a>                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['testimonials_id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>