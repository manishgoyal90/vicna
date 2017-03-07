<?php 
include("../../config/connect.php");
$uid = $_REQUEST['uid'];
if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	$fet = mysql_fetch_array(mysql_query("SELECT group_payslip FROM group_payslip WHERE id = '".$feedid."'"));
	
	unlink("../../payslip/".$fet['group_payslip']);
	
	$delsingle = "DELETE FROM group_payslip WHERE id = '".$feedid."'";
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
                                    <table class="table table-striped table-hover"  id="sample_211">
                                    	<tr>
                                        	<th>Nos.</th>
                                            <th width="20%">Session Yesr</th>
                                            <th width="30%">View/Save Group Certificate</th>
                                           <th>Action</th>
                                           
                                        </tr>
                                        <?PHP $n=0; 
				
											$GetQuery=mysql_query("SELECT * FROM group_payslip WHERE Uid='".$uid."' ORDER BY id DESC");
											$cnt = mysql_num_rows($GetQuery);
											if($cnt > 0){
												while($row = mysql_fetch_array($GetQuery))
												{ $n++;
													$g=$row['gross'];$t=$row['tax'];
											?>
											  <tr>
												<td><?=$n?></td>
												<td><?=$row['session_year'];?></td>
												<td><a href="../download.php?path=payslip&file=<?=$row['group_payslip']?>" ><img style="height:40px;" src="../images/pdf.png"></a></td>
                                                <td><button type="button" data-toggle="collapse" data-target="#edit_group_slip<?=$n;?>"><i class="icon-edit"></i> Edit</button> &nbsp <button type="button" onClick="deleteGroupCrtft(<?=$row['id'];?>, <?=$uid;?>);"><i class="icon-trash"></i> Delete</button></td>
												</tr>
                                                <tr>
                                                <td colspan="8">
                                              <div  class="collapse" id="edit_group_slip<?=$n;?>">
                                              	<form action="ajax/editGroupPaysilp.php" id="edit_group_payslip<?=$n;?>"  method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                <input type="hidden" name="Uid" value="<?=$uid?>">
                                                <table class="table table-striped table-hover">
                                               <tr>
                                              	<td></td>
												<td><select class="dp" name="session_year">
													<?php 
													$curnt_year = date('Y');
													$prev_year = $curnt_year - 1;
													
													$x = 1;
													while($x <= 20)
													{
														$session = $prev_year.'-'.$curnt_year;
													?>
														<option value="<?=$session;?>"><?=$session;?></option>
													<?php 
														$curnt_year = $curnt_year - 1;
														$prev_year = $prev_year - 1;
														$x++;
													}?>
												
												</select></td>
												<td><input style="width:200px" type="file" name="payslip">
													<input type="hidden" name="old_payslip" value="<?=$row['group_payslip'];?>">
												</td>
                                                <td><input type="button" value="OK"  id="group_payslip<?=$n?>" name=""></td>
                                                
                                              </tr>
                                              </table>
                                              </form>
                                              </div>
                                              </td></tr>
											  <script type="text/javascript">
											  	$('#group_payslip<?=$n?>').click(function(){
													$('#edit_group_payslip<?=$n?>').ajaxForm({
														target:'#group_payslip_table',
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
											}else{?>
											<tr><td colspan="4" style=" text-align:center;"><span style="color:#CC0000; font-size:18px;">No Group Certificate</span></td></tr>
											<?php }?>
                                   </table>
                             
                           
        <script type="text/javascript">
		$('#payslip_msg').fadeOut(10000);
		</script>                      