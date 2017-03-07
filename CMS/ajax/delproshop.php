<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
					//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT product_image FROM ".TABLE_PREFIX."product WHERE product_id = '".$feedid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../product/bigimg/".$row_unlink['product_image'];
					$thumb = "../../product/smallimg/".$row_unlink['product_image'];
					$thumb1 = "../../product/fullsize/".$row_unlink['product_image'];
					$thumb2 = "../../product/medium/".$row_unlink['product_image'];
					$thumb3 = "../../product/extsmall/".$row_unlink['product_image'];
					
					
					if(file_exists($photo))
						{
							@unlink($photo);
						}
					if(file_exists($thumb))
						{
							@unlink($thumb);
						}
					if(file_exists($thumb1))
						{
							@unlink($thumb1);
						}
					if(file_exists($thumb2))
						{
							@unlink($thumb2);
						}
					if(file_exists($thumb3))
						{
							@unlink($thumb3);
						}
	
	$delsingle = "DELETE  from ".TABLE_PREFIX."product WHERE product_id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
							//Unlink Old ImageBefore Upload New image
					$unlink_sql = "SELECT product_image FROM ".TABLE_PREFIX."product WHERE product_id = '".$valid."'";
					$unlink_rs = mysql_query($unlink_sql) or mysql_error();
					$row_unlink = mysql_fetch_array($unlink_rs);
					
					$photo = "../../product/bigimg/".$row_unlink['product_image'];
					$thumb = "../../product/smallimg/".$row_unlink['product_image'];
					$thumb1 = "../../product/fullsize/".$row_unlink['product_image'];
					$thumb2 = "../../product/medium/".$row_unlink['product_image'];
					$thumb3 = "../../product/extsmall/".$row_unlink['product_image'];
					
					
					if(file_exists($photo))
						{
							@unlink($photo);
						}
					if(file_exists($thumb))
						{
							@unlink($thumb);
						}
					if(file_exists($thumb1))
						{
							@unlink($thumb1);
						}
					if(file_exists($thumb2))
						{
							@unlink($thumb2);
						}
					if(file_exists($thumb3))
						{
							@unlink($thumb3);
						}
	
		$delsels = "DELETE FROM  ".TABLE_PREFIX."product WHERE product_id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<div id="tablesec">
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">Image</th>
										<th class="hidden-480">Product Name</th>
										<th class="hidden-480">Price($)</th>
                                        <th class="hidden-480">Desc</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">View</th>
                                        <th class="hidden-480">Edit</th>
                                        <th class="hidden-480">Delete</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."product ORDER BY product_id ASC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{ 
										if($rowdest['product_image'] == "")
											{
												$pic = "images/nopic.jpg";
											}
											else if(!is_file("../../product/bigimg/".$rowdest['product_image']))
											{
												$pic = "images/nopic.jpg";
											}
											else
											{
												$pic = "../product/bigimg/".$rowdest['product_image'];
											}	
												
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['product_id']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                            <div class="tile image double selected">
												<div class="tile-body">
                                                <img src="<?=$pic?>" alt="Wait..." width="100px" title="<?=stripslashes($rowdest['product_name'])?>">
                                                </div>	
                                             </div>					
                                        </td>
										<td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['product_name']),0,20)?></div></td>
										<td class="hidden-480"><div class="videoWrapper">$<?=number_format($rowdest['product_price'],2)?></div></td>
                                        <td class="hidden-480"><div class="videoWrapper"><?=substr(stripslashes($rowdest['product_description']),0,20)?></div></td>
                                         <td class="hidden-480">
											<div class="controls">
											 <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['product_id']?>" onChange="changestatus(this.value,'<?=$rowdest['product_id']?>')">
												<option value="true" <?=$rowdest['product_status'] == 'Yes' ? 'selected' : ''?>>Active</option>
												<option value="false" <?=$rowdest['product_status'] == 'No' ? 'selected' : ''?>>InActive</option>
											 </select>
										  </div>
										</td>
										<td class="hidden-480">
										  <a class="btn mini green-stripe" data-toggle="modal" href="proshopview.php?product_id=<?=$rowdest['product_id']?>">View <i class="icon-edit"></i></a>                                           
										</td>
                                        <td class="hidden-480">		
                                            <a class="btn mini green" data-toggle="modal" href="proshop.php?mode=edit&product_id=<?=$rowdest['product_id']?>">Edit <i class="icon-edit"></i></a> 
                            			</td>
                                        <td class="hidden-480">		                                        
                                            <a onclick="deleteone(<?=$rowdest['product_id']?>)" data-toggle="modal" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>
                      </div>