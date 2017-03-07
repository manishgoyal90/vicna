<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE from hr_enquery WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
		$delsels = "DELETE from hr_enquery WHERE id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">
                  <thead>
                    <tr>
                      <th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
                      <th class="hidden-480">Nos.</th>
                      <th class="hidden-480">Name</th>
                      <th class="hidden-480">Email</th>
                      <th class="hidden-480">Phone</th>
					  <th class="hidden-480">Position</th>
					  <th class="hidden-480">Organization</th>
                     <th class="hidden-480">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					/*if($_REQUEST[page]=='' || $_REQUEST[page]==1){
							   $st=0;
							   $ed=10;
							   }
							   else
							   {
								   $st=($_REQUEST[page]-1)*10;
								   $ed=10;
							   }*/
					$ctn = 1;
					
					
											
					$GetUserSql = "SELECT * FROM hr_enquery ORDER BY id DESC";
					$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
					while ($rowdest = mysql_fetch_array($GetQuery)) {
						?>
                    <tr class="odd gradeX">
                      <td class="hidden-480"><input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $ctn ?>
                        </div></td>
                     
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['name'].' '.$rowdest['surname']; ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['email'] ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['phone'] ?>
                        </div></td>
                      <td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['position'] ?>
                        </div></td>
						<td class="hidden-480"><div class="videoWrapper">
                          <?= $rowdest['organization'] ?>
                        </div></td>
                    
                      <td class="hidden-480"><a class="btn mini green-stripe" href="viewEnquery.php?id=<?=$rowdest['id'];?>">View <i class="icon-edit"></i></a> &nbsp;<a onclick="deleteone(<?=$rowdest['id']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a></td>
                    </tr>
					
                    <?php $ctn++;
} ?>
                  </tbody>
                </table>