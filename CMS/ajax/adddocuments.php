<?php 
 include"../../config/connect.php";
/*if(isset($_REQUEST['add_payslip'])){ 	*/
	$uid = $_REQUEST['Uid'];
	//echo $pay = $_REQUEST['payPeriodEnding'];
	$title = $_REQUEST['title'];
	
	$payslip = "";
	
	
	/*********************File Upload Start**********************************/
	if(isset($_FILES['document']['name']) && $_FILES['document']['name']!=''){
		  $errors= array();
		  $file_name = $_FILES['document']['name'];
		  $file_size =$_FILES['document']['size'];
		  $file_tmp =$_FILES['document']['tmp_name'];
		  $file_type=$_FILES['document']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['document']['name'])));
		  $date_time = date('dmY').'_'.date('His');
		  $file_name = $title.'-'.$date_time.'.'.$file_ext;
		  $expensions= array("pdf", "JPEG", "JPG", "jpeg", "jpg", "doc", "PNG", "png", "docx");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]='extension not allowed, please choose pdf, JPEG, JPG, jpeg, jpg, doc, PNG, png OR docx file.';
		  }else{
			if($file_size > 2097152){
				$errors[]='File size must be excately 2 MB';
			}
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"../../docs/".$file_name);
			 
		  }
   	}
	
	
	
	/********************* File Upload End ***********************************/
	if(empty($errors)){
		$insert = mysql_query("INSERT INTO documents SET
										userId = '".$uid."',
										title = '".$title."',
										path = 'docs/".$file_name."',
										date = NOW()");
		if($insert)
		{
			$msg = "Documents Added Successfully.";
		}else
		{
			$msg = "Documents Not Added.";
		}
	}
//}
 ?>


                               		<div id="docs_msg" style="color:#F60; font-size:16px;">
									<?php if(empty($errors)){echo $msg;}
										else{ 
											foreach($errors as $key=>$val)
											{
												echo '<span style="color:red; font-weight:bold;">'.$val.'</span>';
											}
										}?>
									</div>
                                    <table class="table table-striped table-hover" >
                                    	<tr>
                                        	<th>Nos.</th>
                                            <th>Title</th>
                                            <th>Document</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                        <?PHP $n=0; 
				
											$GetQuery=mysql_query("SELECT * FROM documents WHERE userId='".$_REQUEST["Uid"]."' ORDER BY id DESC");
											$cnt = mysql_num_rows($GetQuery);
											if($cnt > 0){
												while($row = mysql_fetch_array($GetQuery))
												{ $n++;
												$path=$row['path'];
				  								$title=$row['title'];
													
											?>
											 <tr>
												<td><?=$n;?></td>
												<td><?=$title?></td>
												<td><a href='../download.php?link=<?=$path?>'>
												  <img src='../images/doc.png' title='<?=$title?>' style="height:35px;">
												  </a>
												</td>
												<td><button type="button" onClick="deletedocs(<?=$row['id'];?>, <?=$_REQUEST['Uid'];?>);"><i class="icon-trash"></i> Delete</button></td>
											</tr>
                                               
											 
											  <?php
												}
											}else{?>
											<tr><td colspan="4">Documents Not Added.</td></tr>
											<?php }?>
                                   </table>
                             
                           
        <script type="text/javascript">
		$('#docs_msg').fadeOut(5000);
		</script>                      