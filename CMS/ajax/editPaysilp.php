<?php 
 include"../../config/connect.php";
/*if(isset($_REQUEST['add_payslip'])){ 	*/
	$id = $_REQUEST['id'];
	$uid = $_REQUEST['Uid'];
	$payPeriodEnding = date('Y-m-d', strtotime($_REQUEST['payPeriodEnding']));
	$datePaid = date('Y-m-d', strtotime($_REQUEST['datePaid']));
	$gross = $_REQUEST['gross'];
	$tax = $_REQUEST['tax'];
	$nett = $gross - $tax;
	
	
	/*********************File Upload Start**********************************/
	if(isset($_FILES['payslip']['name']) && $_FILES['payslip']['name']!=''){
		  $errors= array();
		  $file_name = $_FILES['payslip']['name'];
		  $file_size =$_FILES['payslip']['size'];
		  $file_tmp =$_FILES['payslip']['tmp_name'];
		  $file_type=$_FILES['payslip']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['payslip']['name'])));
		  $date_time = date('dmY').'_'.date('His');
		  $file_name = 'Payslip'.$date_time.'.'.$file_ext;
		  $expensions= array("pdf");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a PDF file.";
		  }else{
			if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
			}
		  }
		  
		  if(empty($errors)==true){
		  	unlink("../../payslip/".$_REQUEST['old_payslip']);
			 move_uploaded_file($file_tmp,"../../payslip/".$file_name);
			 
		  }
   	}else
	{
		 $file_name = $_REQUEST['old_payslip'];
	}
	
	
	
	/********************* File Upload End ***********************************/
	if(empty($errors)){
		$update = mysql_query("UPDATE pay_slip SET 
												payslip = '".$file_name."',
												payPeriodEnding = '".$payPeriodEnding."',
												datepaid = '".$datePaid."',
												gross = '".$gross."',
												tax = '".$tax."'
												WHERE id = '".$id."'");
		if($update)
		{
			$msg = "Payslip Update Successfully.";
		}else
		{
			$msg = "Payslip Not Update.";
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
				
											$GetQuery=mysql_query("SELECT * FROM pay_slip WHERE Uid='".$_REQUEST["Uid"]."' ORDER BY id DESC");
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
                                                <td><button type="button" data-toggle="collapse" data-target="#edit_slip<?=$n;?>"><i class="icon-edit"></i> Edit</button> &nbsp;<button type="button" onClick="deletepayslip(<?=$row['id'];?>, <?=$_REQUEST['Uid'];?>);"><i class="icon-trash"></i> Delete</button></td>
												</tr>
                                                <tr>
                                                <td colspan="8">
                                              <div  class="collapse" id="edit_slip<?=$n;?>">
                                              	<form action="ajax/editPaysilp.php" id="edit_upload_payslip<?=$n;?>"  method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?=$row['id']?>">
                                                <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid']?>">
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
													<input type="hidden" name="old_payslip" value="<?=$row['payslip'];?>" >
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