<?php 
include("../../config/connect.php");
$uid = $_REQUEST['uid'];
if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$fet = mysql_fetch_array(mysql_query("SELECT payslip FROM pay_slip WHERE id = '".$feedid."'"));
	
	unlink("../../payslip/".$fet['payslip']);
	
	$delsingle = "DELETE FROM pay_slip WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
	if($delsingle)
		{
			$msg = "Group Certificate Deleted Successfully.";
		}else
		{
			$msg = "Group Certificate Not Deleted.";
		}
}

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
                                    <table class="table table-striped table-hover"  id="sample_2">
                                    	<tr>
                                        	<th>Nos.</th>
                                            <th>Pay Period Ending</th>
                                            <th>Date Paid</th>
                                            <th>Gross</th>
                                            <th>Tax</th>
                                            <th>Nett</th>
                                            <th>View/Save Payslips</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                        <?PHP $n=0; 
				
											$GetQuery=mysql_query("SELECT * FROM pay_slip WHERE Uid='".$uid."' ORDER BY id DESC");
											$cnt = mysql_num_rows($GetQuery);
											if($cnt > 0){
												while($row = mysql_fetch_array($GetQuery))
												{ $n++;
													$g=$row['gross'];$t=$row['tax'];
											?>
											  <tr>
												<td><?=$n?></td>
												<td><?=$row['payPeriodEnding'];?></td>
												<td><?=$row['datePaid'];?></td>
												<td>$
												  <?=$row['gross'];?></td>
												<td>$
												  <?=$row['tax'];?></td>
												<td>$<?php echo ($g - $t) ?></td>
												<td><a href="../download.php?path=payslip&file=<?=$row['payslip']?>" ><img style="height:40px;" src="../images/pdf.png"></a></td>
                                                <td><button type="button" data-toggle="collapse" data-target="#edit_slip<?=$n;?>"><i class="icon-edit"></i> Edit</button> &nbsp;<button type="button" onClick="deletepayslip(<?=$row['id'];?>, <?=$uid;?>);"><i class="icon-trash"></i> Delete</button></td>
												</tr>
                                                <tr>
                                                <td colspan="8">
                                              <div  class="collapse" id="edit_slip<?=$n;?>">
                                              	<form action="ajax/editPaysilp.php" id="edit_upload_payslip<?=$n;?>"  method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                <input type="hidden" name="Uid" value="<?=$uid?>">
                                                <table class="table table-striped table-hover">
                                               <tr>
                                              	<td></td>
												<td><input class="dp dt_pic" type="text" name="payPeriodEnding" value="<?=$row['payPeriodEnding'];?>"></td>
												<td><input class="dp dt_pic" type="text" name="datePaid" value="<?=$row['datePaid'];?>"></td>
												<td>
												  <input class="dp" type="text" name="gross" value="<?=$row['gross'];?>"></td>
												<td>
												  <input class="dp" type="text" name="tax" value="<?=$row['tax'];?>"></td>
												<td></td>
												<td><input style="width:200px" type="file" name="payslip">
													<input type="hidden" name="old_payslip" value="<?=$row['payslip'];?>" />
												</td>
                                                <td><input type="button" value="OK"  id="edit_payslip<?=$n?>" name="edit_payslip"></td>
                                                
                                              </tr>
                                              </table>
                                              </form>
                                              </div>
                                              </td></tr>
											  <script type="text/javascript">
											  	$('#edit_payslip<?=$n?>').click(function(){
													$('#edit_upload_payslip<?=$n?>').ajaxForm({
														target:'#payslip_table',
														beforeSubmit:function(e){
															//$('.uploading').show();
														},
														success:function(e){
															//$('.uploading').hide();
															//break 1;
														},
														error:function(e){
														}
													}).submit();
												});
											  </script>
											  <?php
												}
											}?>
                                   </table>
                             
                           
        <script type="text/javascript">
		$('#payslip_msg').fadeOut(10000);
		</script>                      