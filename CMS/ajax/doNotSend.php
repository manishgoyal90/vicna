<?php 
 include"../../config/connect.php";
/*if(isset($_REQUEST['add_payslip'])){ 	*/
	
	$stuffName = $_REQUEST['stuffName'];
	$qualification = $_REQUEST['qualification'];
	$clientRegNo = $_REQUEST['clientRegNo'];
	$reason = $_REQUEST['reason'];
	
	/*********************File Upload Start**********************************/
	//echo "SELECT Uid FROM hr_user_registration WHERE RegistrationNo = '".$clientRegNo."'";exit();
	 $fetClient = mysql_fetch_array(mysql_query("SELECT Uid FROM hr_user_registration WHERE RegistrationNo = '".$clientRegNo."'"));
	$uid = $fetClient['Uid'];
	/********************* File Upload End ***********************************/
	
		$insert = mysql_query("INSERT INTO do_not_send SET
										stuffName = '".$stuffName."',
										qualification = '".$qualification."',
										reason = '".$reason."',
										clientId = '".$uid."',
										dt = NOW()");
		if($insert)
		{
			$msg = "Do Not Send  Added Successfully.";
		}else
		{
			$msg = "Do Not Send Not Added.";
		}
	
//}
 ?>


                               		<div id="payslip_msg" style="color:#F60; font-size:16px;">
									<?php if(empty($errors)){echo $msg;}
										else{ 
											foreach($errors as $key=>$val)
											{
												echo '<span style="color:red; font-weight:bold;">'.$val.'</span>';
											}
										}?>
									</div>
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
                             
                           
        <script type="text/javascript">
		$('#payslip_msg').fadeOut(10000);
		</script>                      