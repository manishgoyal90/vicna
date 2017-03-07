<?php 
 include"../config/connect.php";
/*if(isset($_REQUEST['add_payslip'])){ 	*/

	$id = $_REQUEST['id'];
	
	/*********************File Upload Start**********************************/
	if(isset($_FILES['sheet']['name']) && $_FILES['sheet']['name']!=''){
		  $errors= array();
		  $file_name = $_FILES['sheet']['name'];
		  $file_size =$_FILES['sheet']['size'];
		  $file_tmp =$_FILES['sheet']['tmp_name'];
		  $file_type=$_FILES['sheet']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['sheet']['name'])));
		  $date_time = date('dmY').'_'.date('His');
		  $file_name = 'sheet'.$date_time.'.'.$file_ext;
		  //$expensions= array("pdf");
		  
		 /* if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a PDF file.";
		  }else{*/
			if($file_size > 2097152){
				$errors[]='File size must be less than 2 MB';
			}
		 // }
		  
		  if(empty($errors)==true){
		  	//unlink("../Timesheet/".$_REQUEST['old_payslip']);
			 move_uploaded_file($file_tmp,"../Timesheet/".$file_name);
			 
		  }
   	}
	/*else
	{
		 $file_name = $_REQUEST['old_payslip'];
	}*/
	
	
	
	/********************* File Upload End ***********************************/
	if(empty($errors)){
		$update = mysql_query("UPDATE staff_available_shift SET 
												timeSheets = '".$file_name."',
												clientStatus = 'Unprocessed'
												WHERE id = '".$id."'");
		if($update)
		{
			$msg = "Time Sheet Uploaded Successfully.";
		}else
		{
			$msg = "Time Sheet Not Update.";
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
                                    <table class="table" style="border-bottom:1px solid #000; border-top:1px solid #000;">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Location</th>
                  <th>Role</th>
                  <th style="width:15%;">Date/Time</th>
                  <th>Penalties</th>
                  <th style="width:7%;">For More</th>
                  <th style="width:22%;">Upload Timesheet</th>
                </tr>
              </thead>
              <tbody>
           <?php 
		   $qty = 1;
		   $sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '".$_SESSION['userid']."'");
		   while($rowdest = mysql_fetch_array($sql))
		   {
		   ?>
              <tr >
                  <td><?=$qty;?></td>
                  <td ><div class="videoWrapper">
                      <?=$rowdest['location']?>
                    </div></td>
                  <td><div class="videoWrapper">
                      <?=stripslashes($rowdest['role']);?>
                    </div></td>
                  <td ><div class="videoWrapper">
                      <?=date('d M Y', strtotime($rowdest['date']))?>
                      <br/>
                      <?=date('l', strtotime($rowdest['date']))?><br/>
                    Shift<br/> Start : <?php echo $rowdest['start_time'];?><br/>
                      Finish : <?php echo $rowdest['end_time'];?>
                    </div></td>
                  
                  <td ><div class="videoWrapper"><?php echo stripslashes($rowdest['penalties']);?></div></td>
                  
                  
                 <td>
                 
                  <button class="glyphicon glyphicon-hand-right" aria-hidden="true" data-toggle="collapse" data-target="#moreinf<?=$qty;?>" title="More Info"  style="color:blue;"></button></td>
                 <td>
				 <form action="ajax/uploadTimesheet.php" method="post" id="upload-timesheet<?=$qty;?>" enctype="multipart/form-data">
				 	<input type="hidden" name="id" value="<?=$rowdest['id'];?>">
                 	<input type="file" name="sheet" value="upload">
                    <button type="button" name="upload" id="timesheet<?=$qty;?>" class="btn btn-info">Submit</button>
				</form>
                 </td>
                 
                </tr>
                <tr>
                	<td colspan="7">
                    <div class="row collapse" id="moreinf<?=$qty;?>" style="padding-left:10px;">
                    <p style="color:#000; font-size:18px; font-weight:bold;">More Information</p>
					
                    <?php echo stripslashes($rowdest['more_info']);?>
                    </div>
                    </td>
                </tr>
                
                <?php $qty++; ?>
				<script type="text/javascript">
					$('#timesheet<?=$qty?>').click(function(){
						$('#upload-timesheet<?=$qty?>').ajaxForm({
							target:'#demo4',
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
				
				<?php } ?>
              
              </tbody>
              
            </table>
                             
                           
        <script type="text/javascript">
		$('#payslip_msg').fadeOut(10000);
		</script>                      