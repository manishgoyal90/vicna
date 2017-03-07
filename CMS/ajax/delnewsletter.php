<?php 
include("../../config/connect.php");

  
	if($_REQUEST['email']=="delsucc")
		{
			$MsgDel="Delete operation Successful !";
		}
  /*---------------End of message-----------------------------------------------------------------------*/	

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."newslettermail WHERE mail_id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM ".TABLE_PREFIX."newslettermail WHERE mail_id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">E-Mail Address</th>
										<th class="hidden-480">date</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$TestiInfoSql="select * from  ".TABLE_PREFIX."newslettermail order by mail_date asc";
									$resultTestiInfo=mysql_query($TestiInfoSql) or mysql_error();
									$p=1;
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
									 $showDate=date('F d ,  Y',strtotime($testimonials['mail_date']));	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$testimonials['mail_id']?>" name="feed[]"/>                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=$testimonials['mail_address']?></div></td>
										<td class="hidden-480">
										  <?=$showDate?>
										  </td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$testimonials['mail_id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $p++; }  ?>
								</tbody>
							</table>