<?php 
include("../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "UPDATE mailing SET del_status = '1' WHERE mail_id = '".$feedid."'";
	mysql_query($delsingle);
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
		$delsels = "UPDATE mailing SET del_status = '1' WHERE mail_id = '".$valid."'";
		mysql_query($delsels);
	}
}
?>
<table id="myTable" class="display table" width="100%">						
                                    <thead>
								<tr>
									<th>Subject</th>
									<th>From</th>
									<th>Date</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
						<?php 
							$sql = "SELECT * FROM mailing WHERE mail_to = '".$row['vicnaEmail']."' AND del_status = '0'";
							$result = mysql_query($sql);
							while($fetch = mysql_fetch_array($result))
							{
						?>
								
								<tr>
									<td><a style="text-decoration:none; <?php if($fetch['mail_status'] == 'ur'){echo 'color:#000; font-weight:bold;';}else{echo 'color:#000;';}?>" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=inbox"><?=$fetch['mail_subject'];?></a></td>
									<td><a style="text-decoration:none; <?php if($fetch['mail_status'] == 'ur'){echo 'color:#000; font-weight:bold;';}else{echo 'color:#000;';}?>" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=inbox"><?=$fetch['mail_from'];?></a></td>
									<td><a style="text-decoration:none; <?php if($fetch['mail_status'] == 'ur'){echo 'color:#000; font-weight:bold;';}else{echo 'color:#000;';}?>" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=inbox"><?=date('D H:i:s', strtotime($fetch['mail_date']));?></a></td>
									<td align="center"><a href="" style="text-decoration:none;" onclick="deleteone(<?=$fetch['mail_id']?>);" ><span class="glyphicon glyphicon-trash"></span></a></td>
								
								</tr>
								
						<?php
							}
						?>	
							<tbody>
                 </table>