<?php 
include("../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE FROM sent_mailing WHERE mail_id = '".$feedid."'";
	mysql_query($delsingle);
}


$SqlUser1 = "SELECT vicnaEmail FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result1 = mysql_query($SqlUser1);
				$fetch = mysql_fetch_array($result1);
?>
<table id="myTable" class="display table" width="100%" >
							<thead>
								<tr>
									<th>Subject</th>
									<th>To</th>
									<th>Date</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
						<?php 
						$sql = "SELECT * FROM sent_mailing WHERE mail_from = '".$fetch['vicnaEmail']."'";
							$result = mysql_query($sql);
							while($fetch = mysql_fetch_array($result))
							{
						?>
								
								<tr>
									<td><a style="text-decoration:none; color:#000;" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=sent"><?=$fetch['mail_subject'];?></a></td>
									<td><a style="text-decoration:none; color:#000;" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=sent"><?=$fetch['mail_to'];?></a></td>
									<td><a style="text-decoration:none; color:#000;" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=sent"><?=date('D H:i:s', strtotime($fetch['mail_date']));?></a></td>
									<td align="center"><a style="text-decoration:none;" onClick="return deleteone(<?=$fetch['mail_id']?>);" ><span class="glyphicon glyphicon-trash"></span></a></td>
								
								</tr>
								
						<?php
							}
						?>	
							<tbody>
						</table>