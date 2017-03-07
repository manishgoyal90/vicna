<?php 
include("../../config/connect.php");


if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."sendednewsletter WHERE sended_id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM ".TABLE_PREFIX."sendednewsletter WHERE sended_id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">E-Mail Address</th>
										<th class="hidden-480">Newsletter Content</th>
										<th class="hidden-480">Send Date</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$p=1;
									$TestiInfoSql="select * from  ".TABLE_PREFIX."sendednewsletter order by sended_date asc";
									$resultTestiInfo=mysql_query($TestiInfoSql) or mysql_error();
									$TestiInfoNumber=mysql_num_rows($resultTestiInfo);
									while($testimonials=mysql_fetch_array($resultTestiInfo))
									{
										if($p%2==0)
											{
												$bgcolor="#f8f8f8";
											}
										else
											{
												$bgcolor="#ffffff"; 
											}
									 $showDate=date('F d ,  Y',strtotime($testimonials['sended_date']));	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$testimonials['sended_id']?>" name="feed[]"/>                                      </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$testimonials['sended_email']?></div></td>
										<td class="hidden-480">
										<div id="img<?=$p?>" style="display:block;"><?=substr(stripslashes($testimonials['sended_text']), 0, 90)?>...&nbsp;<a href="javascript:void(0)" onclick="javascript:opendiv('<?=$p?>');" style="font:arial; color:#990000; text-decoration:none;">Read More</a></div>
											<div id="nimg<?=$p?>" style="display:none;"><a href="javascript:void(0)" onClick="javascript:closediv('<?=$p?>');" style="font:arial; color:#990000; text-decoration:none;">Close</a></div>
											<div id="div<?=$p?>" style="display:none; padding:10px">
											<?=stripslashes(nl2br($testimonials['sended_text']))?>
											</div>
										</td>
										<td class="hidden-480">
										  <?=$showDate?>
										  </td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$testimonials['sended_id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
									    
                                       <?php $p++; } ?>
									   <input type="hidden" name="nrow" value="<?=$TestiInfoNumber?>" id="nrow"	/>
								</tbody>
							</table>