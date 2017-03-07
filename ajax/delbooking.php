<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php 
include("../config/connect.php");


	$feedid = $_REQUEST['feedid'];
	$shifting = $_REQUEST['mode'];
	if($shifting == 'firstShift')
	{
		$updateShift = "UPDATE book_nurse SET firstShift = 'Cancel' WHERE sl = '".$feedid."'";
		mysql_query($updateShift);
		
		$updateStuffAlcation = "UPDATE stuff_booked SET cancel = 'Cancel', cancelDate=NOW() WHERE booking_sl = '".$feedid."' AND shift='1'";
		mysql_query($updateStuffAlcation);
		
		
	}elseif($shifting == 'secondShift')
	{
		$updateShift = "UPDATE book_nurse SET secondShift = 'Cancel' WHERE sl = '".$feedid."'";
		mysql_query($updateShift);
		
		$updateStuffAlcation = "UPDATE stuff_booked SET cancel = 'Cancel', cancelDate=NOW() WHERE booking_sl = '".$feedid."' AND shift='2'";
		mysql_query($updateStuffAlcation);
	}elseif($shifting == 'thirdShift')
	{
		$updateShift = "UPDATE book_nurse SET thirdShift = 'Cancel' WHERE sl = '".$feedid."'";
		mysql_query($updateShift);
		
		$updateStuffAlcation = "UPDATE stuff_booked SET cancel = 'Cancel', cancelDate=NOW() WHERE booking_sl = '".$feedid."' AND shift='3'";
		mysql_query($updateStuffAlcation);
	}
	
	
	
	
?>

        <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead>
                  <tr>
                    <th class="hidden-480">Qualification</th>
                    <th class="hidden-480">Location</th>
                    <th class="hidden-480">Speciality</th>
                    <th class="hidden-480">Date & Day</th>
                    <th class="hidden-480">Time of Shift</th>
                    <th class="hidden-480">VICNA Staff</th>
                    <th class="hidden-480">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM book_nurse WHERE clientId = '".$_SESSION['userid']."' AND (firstShiftDate > NOW() OR secondShiftDate > NOW() OR thirdShiftDate > NOW()) ORDER BY sl DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
									
									$today = date('Y-m-d');
											
									
				if($rowdest['firstShiftDate'] != "" && $rowdest['firstShiftDate'] > $today && $rowdest['firstShift'] == 'Request'){
				?>
                  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                       <?=$rowdest['speciality1']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['firstShiftDate'])).'<br/>'.date('l',strtotime($rowdest['firstShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime1'];?><br/>
					   Finish : <?=$rowdest['finishTime1'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?php if($rowdest['staffReqstd1'] != ""){echo $rowdest['staffReqstd1'];}else{echo 'N/A';}?>
					</div></td><td><button type="button" class="glyphicon glyphicon-trash" title="CANCEL" onClick="return bookingCancel(<?=$rowdest['sl']?>, 'firstShift');" style="color:#CC0000;"></button> </td>
                  </tr>
			<?php
			}
			 if($rowdest['secondShiftDate'] != "" && $rowdest['secondShiftDate'] > $today && $rowdest['secondShift'] == 'Request'){?>
				  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['speciality2']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['secondShiftDate'])).'<br/>'.date('l',strtotime($rowdest['secondShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime2'];?><br/>
					   Finish : <?=$rowdest['finishTime2'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?php if($rowdest['staffReqstd2'] != ""){echo $rowdest['staffReqstd2'];}else{echo 'N/A';}?>
					</div></td><td><button type="button" class="glyphicon glyphicon-trash" title="CANCEL" onClick="return bookingCancel(<?=$rowdest['sl']?>, 'secondShift');" style="color:#CC0000;"></button></td>
                  </tr>
			<?php }
			if($rowdest['thirdShiftDate'] != "" && $rowdest['thirdShiftDate'] > $today && $rowdest['thirdShift'] == 'Request'){
			?>
			
				  <tr class="odd gradeX">
                   
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['class3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['word3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=$rowdest['speciality3']?>
                      </div></td>
                    <td class="hidden-480"><div class="videoWrapper">
                        <?=date('d M Y', strtotime($rowdest['thirdShiftDate'])).'<br/>'.date('l',strtotime($rowdest['thirdShiftDate']));?>
                      </div></td>
                    <td class="hidden-480"><div class="controls">
                       Start : <?=$rowdest['startTime3'];?><br/>
					   Finish : <?=$rowdest['finishTime3'];?>
                      </div></td>
                    <td class="hidden-480"><div class="controls"> 
						<?php if($rowdest['staffReqstd3'] != ""){echo $rowdest['staffReqstd3'];}else{echo 'N/A';}?>
					</div></td>
					<td><button type="button" class="glyphicon glyphicon-trash" title="CANCEL" onClick="return bookingCancel(<?=$rowdest['sl']?>, 'thirdShift');" style="color:#CC0000;"></button></td>
                  </tr>
                  <?php 
				  }
				  $ctn++; } ?>
                </tbody>
              </table>  
	
