<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM do_not_send WHERE sl = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
		$delsels = "DELETE FROM do_not_send WHERE sl = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
                      <th class="hidden-480">Nos.</th>
                      <th class="hidden-480">Staff Name</th>
					  <th class="hidden-480">Qualification</th>
                      <th class="hidden-480">Client Name</th>
                      <th class="hidden-480">Reason</th>
                      <th class="hidden-480">Date Request</th>
                      <th class="hidden-480">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					
					$ctn = 1;
					
					
											
					$GetUserSql = "SELECT * FROM do_not_send ORDER BY sl DESC";
					$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
					while ($rowdest = mysql_fetch_array($GetQuery)) {
    ?>
                    <tr class="odd gradeX">
                      <td class="hidden-480"><input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $ctn; ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['stuffName'] ?>
                        </div></td>
						<td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['qualification'] ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
					  <?php	$fetClient = mysql_fetch_array(mysql_query("SELECT FirstName, LastName FROM hr_user_registration WHERE Uid = '".$rowdest['clientId']."'"));?>
                          <a target="_blank" href="userinfo.php?Uid=<?=$rowdest['clientId']?>"><?=strtoupper($fetClient['FirstName']." ".$fetClient['LastName']); ?></a>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= stripslashes($rowdest['reason']); ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= date('d/m/Y H:i:s', strtotime($rowdest['dt'])); ?>
                        </div></td>
                     
                      <td class="hidden-480"><a onclick="deleteone(<?=$rowdest['sl']?>);" class="btn mini red"><i class="icon-trash"></i> Delete</a></td>
                    </tr>
                    <?php $ctn++;
} ?>
                  </tbody>
                </table>