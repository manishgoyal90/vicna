<?php 
include("../../config/connect.php");
$uid = $_REQUEST['uid'];
if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	$fet = mysql_fetch_array(mysql_query("SELECT path FROM documents WHERE id = '".$feedid."'"));
	
	unlink($fet['path']);
	
	$delsingle = "DELETE FROM documents WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
	
	if($delsingle)
		{
			$msg = "Document Deleted Successfully.";
		}else
		{
			$msg = "Document Not Deleted.";
		}
}

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
				
											$GetQuery=mysql_query("SELECT * FROM documents WHERE userId='".$_REQUEST["uid"]."' ORDER BY id DESC");
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
												<td><button type="button" onClick="deletedocs(<?=$row['id'];?>, <?=$_REQUEST['uid'];?>);"><i class="icon-trash"></i> Delete</button></td>
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