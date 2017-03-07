<?php 
 include"../config/connect.php";
 																									 
 ?>

                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Pay Period Ending</th>
                      <th>Date Paid</th>
                      <th>Gross</th>
                      <th>Tax</th>
                      <th>Nett</th>
                      <th>View/Save<br>
                        Payslips</th>
                    </tr>
                  </thead>
                  <?PHP $c=0; 
				
					$GetQuery=mysql_query("SELECT * FROM pay_slip WHERE Uid='".$_SESSION["userid"]."' AND datePaid BETWEEN '".date('Y-m-d', strtotime($_REQUEST['dt_from']))."' AND '".date('Y-m-d', strtotime($_REQUEST['dt_to']))."'");
					$cnt = mysql_num_rows($GetQuery);
					if($cnt > 0){
						while($row = mysql_fetch_array($GetQuery))
						{ $c++;
							$g=$row['gross'];$t=$row['tax'];
					?>
					  <tr>
						<td><?=$c?></td>
						<td><?=$row['payPeriodEnding'];?></td>
						<td><?=$row['datePaid'];?></td>
						<td>$
						  <?=$row['gross'];?></td>
						<td>$
						  <?=$row['tax'];?></td>
						<td>$<?php echo ($g - $t) ?></td>
						<td><a href="download.php?path=payslip&file=<?=$row['payslip']?>" ><img style="height:40px;" src="images/pdf.png"></a></td>
					  </tr>
					  <?php
						}
					}else{
						?>
                        <tr>
						<td colspan="7" style="text-align:center; color:#C30; font-size:14px; font-weight:bold;"><b>Sorry!</b> Pay Slip Not Generated.</td>
                        </tr> 
                     <?php }?>
                </table>
                
                
  