<?php 
 include"../../config/connect.php";
/*if(isset($_REQUEST['add_payslip'])){ 	*/
	$uid = $_REQUEST['Uid'];
	//echo $pay = $_REQUEST['payPeriodEnding'];
	$session_year = $_REQUEST['session_year'];
	
	$payslip = "";
	
	
	/*********************File Upload Start**********************************/
	if(isset($_FILES['group_payslip']['name']) && $_FILES['group_payslip']['name']!=''){
		  $errors= array();
		  $file_name = $_FILES['group_payslip']['name'];
		  $file_size =$_FILES['group_payslip']['size'];
		  $file_tmp =$_FILES['group_payslip']['tmp_name'];
		  $file_type=$_FILES['group_payslip']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['group_payslip']['name'])));
		  $date_time = date('dmY').'_'.date('His');
		  $file_name = 'GroupCertificate'.$date_time.'.'.$file_ext;
		  $expensions= array("pdf");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a PDF file.";
		  }else{
			if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
			}
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"../../payslip/".$file_name);
			 
		  }
   	}
	
	
	
	/********************* File Upload End ***********************************/
	if(empty($errors)){
		$insert = mysql_query("INSERT INTO group_payslip SET
										Uid = '".$uid."',
										group_payslip = '".$file_name."',
										session_year = '".$session_year."',
										date = NOW()");
		if($insert)
		{
			$msg = "Group Certificate Added Successfully.";
		}else
		{
			$msg = "Group Certificate Not Added.";
		}
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
                                                <td><button type="button" data-toggle="collapse" data-target="#edit_group_slip<?=$n;?>"><i class="icon-edit"></i> Edit</button> &nbsp;<button type="button" onClick="deleteGroupCrtft(<?=$row['id'];?>, <?=$uid;?>);"><i class="icon-trash"></i> Delete</button></td>
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
		$('#payslip_msg').fadeOut(5000);
		</script>                      