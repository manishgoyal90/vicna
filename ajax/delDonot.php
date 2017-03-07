<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php 
include("../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE FROM do_not_send WHERE sl = '".$feedid."'";
	mysql_query($delsingle);
}

?>

        <div id="donotSend">    
          <table class="table" style="background:#FFF;">
            <thead>
			<tr>
			<th>Sl.</th>
			<th>VICNA Staff</th>
			<th>Reason</th>
			<th>Date Requested </th>
			<th>Action</th>
			</tr>
			</thead>
          <?php
		  $SqlUser = "SELECT * FROM do_not_send WHERE clientId = '".$_SESSION['userid']."' order by sl desc ";
				$result = mysql_query($SqlUser);
							$c=0;
				while($row = mysql_fetch_array($result))
				{
					$stuffName=$row['stuffName'];
					$dt=$row['dt'];
					$c++;
					?>
					<tr>
					<td><?=$c;?>.</td>
					<td><?=$stuffName?></td>
					<td><?=stripslashes($row['reason']);?></td>
					<td><?=date('d/m/Y', strtotime($dt));?></td>
					<td><button type="button" onClick="delDonot(<?=$row['sl'];?>, <?=$row['clientId'];?>);" title="Delete"><i class="glyphicon glyphicon-trash"></i></button></td>
					</tr>
					
					
				
					<?php					
					
				}
			?>           
            </table>
         </div>  
			<?php if($c){}else{echo "No data found.";} ?>
		</div>
