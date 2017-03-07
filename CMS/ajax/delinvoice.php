<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
		//Unlink Old ImageBefore Upload New image
		$unlink_sql = "SELECT pdf FROM ".TABLE_PREFIX."user_invoice WHERE id = '".$feedid."'";
		$unlink_rs = mysql_query($unlink_sql) or mysql_error();
		$row_unlink = mysql_fetch_array($unlink_rs);
		
		$photo = "../../upload_invoice/".$row_unlink['UserImage'];
		
		if(file_exists($photo))
			{
				@unlink($photo);
			}
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."user_invoice WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}

?>
<table class="table table-striped table-bordered table-hover" id="sample_2">
                          <thead>
                            <tr>
                              <th class="hidden-480">Nos.</th>
                              <th class="hidden-480">Invoice No</th>
                              <th class="hidden-480">Invoice Date</th>
                              <th class="hidden-480">Amount</th>
                              <th class="hidden-480">Due Date</th>
                              <th class="hidden-480">Payment Status</th>
                              <th class="hidden-480">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
									$ctn = 1;
									$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."user_invoice ORDER BY id DESC";
									$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
									while($rowdest = mysql_fetch_array($GetQuery))
									{
											
									?>
                            <tr class="odd gradeX">
                              <td class="hidden-480"><?=$ctn;?></td>
                              
                              <td class="hidden-480"><div class="videoWrapper">
                                  <?=$rowdest['invoiceNo']?>
                                </div></td>
                                 <td class="hidden-480"><div class="videoWrapper">
                                  <?=$rowdest['invoiceDate']?>
                                </div></td>
                              <td class="hidden-480"><div class="videoWrapper">
                                  <?=$rowdest['amount']?>
                                </div></td>
                              <td class="hidden-480"><div class="videoWrapper">
                                  <?=$rowdest['dueDate']?>
                                </div></td>
                              
                              <td class="hidden-480"><div class="controls">
                                  <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['Uid']?>" onChange="changestatus(this.value,'<?=$rowdest['Uid']?>')">
                                    <option value="true" <?=$rowdest['status'] == 'Yes' ? 'selected' : ''?>>Paid</option>
                                    <option value="false" <?=$rowdest['status'] == 'No' ? 'selected' : ''?>>Payment Due</option>
                                  </select>
                                </div></td>
                             <td class="hidden-480"><div class="controls">
                               <a onclick="deleteone(<?=$rowdest['Uid']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a></div></td>
                            </tr>
                            <?php $ctn++; } ?>
                          </tbody>
                        </table>