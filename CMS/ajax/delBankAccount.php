<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	
	$delsingle = "DELETE FROM account_details WHERE sl = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}

?>
<table class="table table-striped table-hover" style="border-bottom:1px solid #000; border-top:1px solid #000;">	
                                            	
                                                	<tr>
                                                    	<th>Account Holder’s Name</th>
                                                        <th>Bank Name</th>
                                                        <th>BSB</th>
                                                        <th>Account Number</th>
                                                        <th>% of Salary</th>
                                                        <th>User Can Change</th>
                                                        <th>Action</th>
                                                    </tr>
                                               
                                               
                                                 <?php
                                    					$qty = 1;
													$FetchUserSqlp = "SELECT * FROM account_details WHERE Uid  = '".$_REQUEST['Uid']."'";
														$FetchUserQueryp = mysql_query($FetchUserSqlp);
														while($FetchRowsp = mysql_fetch_array($FetchUserQueryp))
														{
														
												   ?>
                                                	<tr>
                                                    	<td><?=$FetchRowsp['acName'];?></td>
                                                        <td><?=$FetchRowsp['bankName'];?></td>
                                                        <td><?=$FetchRowsp['BSB'];?></td>
                                                        <td><?=$FetchRowsp['acNo'];?></td>
                                                        <td><?=$FetchRowsp['percent_salary'];?></td>
                                                        <td><select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['sl']?>" onChange="changePermission(this.value,'<?=$FetchRowsp['sl']?>')">
                                                                <option value="true" <?=$FetchRowsp['view'] == 'Yes' ? 'selected' : ''?>>Active</option>
                                                                <option value="false" <?=$FetchRowsp['view'] == 'No' ? 'selected' : ''?>>InActive</option>
														 </select>
                                                     </td>
                                                     <td>
                                                     	 <button type="button" data-toggle="collapse" data-target="#acc_info<?=$qty;?>" class="btn mini green"><i class="icon-edit"></i> Edit</button>		                                        
                                            			<a onclick="deleteone(<?=$FetchRowsp['sl']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a>			
                                                     </td>
                                                    </tr>
                                                    <tr>
                                                    <td colspan="7">
                                                    <div class="collapse" id="acc_info<?=$qty;?>">
                                                    <form action="<?=$SERVER['PHP_SELF'];?>" method="post" id="form<?=$qty;?>">													
                                                    <input type="hidden" name="Uid" value="<?=$_REQUEST['Uid'];?>">
                                                    <input type="hidden" name="acc_id" value="<?=$FetchRowsp['sl'];?>">
                                                  	<table class="table table-striped table-hover">
                                                    <tr>
                                                    	<td><input type="text" name="acName" value="<?=$FetchRowsp['acName'];?>"></td> 
                                                        <td><input type="text" name="bankName" value="<?=$FetchRowsp['bankName'];?>"></td>
                                                        <td><input type="text" name="BSB" value="<?=$FetchRowsp['BSB'];?>"></td>
                                                        <td><input type="text" name="acNo" value="<?=$FetchRowsp['acNo'];?>"></td>
                                                        <td><input type="text" name="percent_salary" value="<?=$FetchRowsp['percent_salary'];?>"></td>
                                                        <td><input type="submit" name="acc_submit" value="Update"></td><td>&nbsp;</td>
                                                    </tr>
                                                   </table>
                                                   </form>
                                                    </div>
                                                    </td></tr>
                                                 <?php  $qty++;}?> 
                                                 
                                                
                                            </table>