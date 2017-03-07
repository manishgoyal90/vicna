<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE FROM ".TABLE_PREFIX."orderdetails WHERE OrderID = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
		$delsingle = "DELETE FROM ".TABLE_PREFIX."orderdetails WHERE OrderID = '".$valid."'";
		mysql_query($delsingle) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
								<thead>
									<tr>
									 	<th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th> 
										<th class="hidden-480">OrderNumber</th>
										<th class="hidden-480">OrderDate</th>
										<th class="hidden-480">Status</th>
										<th class="hidden-480">Order&nbsp;Value</th>
										<th class="hidden-480">Amount</th>
										<th class="hidden-480">Action</th>
									</tr>
								</thead>
								<tbody>
									
								<?php
									$ctn = 1;
									//Fetch Order
									$orderdetailsql = "select * from ".TABLE_PREFIX."orderdetails ORDER BY OrderDate ASC";
									$orderdetailsqlquery = mysql_query($orderdetailsql) or mysql_error();
									$orderdetailsqlnumber = mysql_num_rows($orderdetailsqlquery);
									while($rowdest = mysql_fetch_array($orderdetailsqlquery))
									{
									 if($rowdest['OrderStatus']=='3')
									   $st="Unpaid";
									 if($rowdest['OrderStatus']=='4')
									   $st="Cancelled";
									 if($rowdest['OrderStatus']=='2')
									   $st="Paid & Order Dispatched";
									 if($rowdest['OrderStatus']=='1')
									   $st="Paid & Awaiting Shipping";   	
									?>
									<tr class="odd gradeX">
                                    	<td class="hidden-480">
                                    	<input type="checkbox" class="checkboxes" value="<?=$rowdest['OrderID']?>" name="feed[]"/>
                                        </td>
										<td class="hidden-480">
                                        	<a href="javascript:void()" onclick="javascript:orderdetail('orderdetail.php?OrderID=<?=$rowdest['OrderID']?>')" style="text-decoration:none;"><?=$rowdest['OrderNumber']?>	</a>		
                                        </td>
										<td class="hidden-480"><?=date("dS M Y", strtotime($rowdest['OrderDate']))?></td>
										<td class="hidden-480"><?=$st?></div></td>
										<td class="hidden-480">$<?=number_format($rowdest['SubAmount'],2)?></td>
										<td class="hidden-480">$<?=number_format($rowdest['TotalAmount'],2)?></td>
                                        
										<td class="hidden-480">
										  <a href="javascript:void()" onclick="javascript:orderdetail('orderdetail.php?OrderID=<?=$rowdest['OrderID']?>')" style="text-decoration:none;"  class="btn mini green-stripe">View <i class="icon-edit"></i></a> &nbsp;<a onclick="deleteone(<?=$rowdest['OrderID']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>

										</td>
                                       </tr>
                                       <?php $ctn++; } ?>
								</tbody>
							</table>