<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<?php 
include("config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE FROM do_not_send WHERE sl = '".$feedid."'";
	mysql_query($delsingle);
}

?>
<font color="#666666" size="+1">Do Not Send</font>
          <?php
		  if(isset($_POST["donotsend"])){
		  $q="INSERT INTO do_not_send (sl, stuffName, reason,clientId, dt) VALUES (NULL , '".$_POST["stuffName"]."', '".addslashes($_POST["reason"])."','".$_SESSION['userid']."', CURRENT_TIMESTAMP);";
		  $r=mysql_query($q) or die("error: ".mysql_error());
		  }
		  ?>
		  
          <form action="" method="post">
          <table class="table" style="background:#FFEFE6;">  
		  	<tr>
				<th width="30%">Enter stuff name:</th>
				<th width="40%">For What</th>
				<th>&nbsp;</th>
			</tr>         
           <tr>
		   <td><input type="text" name="stuffName" value="" placeholder="Do not send" style="background:#FFE6E1;" required> </td>
		   <td rowspan="2"><textarea name="reason" rows="3" ></textarea></td>
           <td><input type="submit" name="donotsend" value="Do not send" class="btn btn-info" ></td></tr>
		</table>
             </form>
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
<script type="text/javascript">
/************************************Delete Group Certificate Delete*************************************/
function delDonot(id, uid)
	{	
		var cnf = confirm("Are you sure to delete?");
		
		if(cnf)
		{
		
			window.location.href="ajax/delDonot.php?feedid="+id+"&mode=single";
			
			/*$.post('ajax/delDonot.php',{ feedid : id, mode : 'single'},
				function(data)
				{//deletecinematic
					$('#donotSend').html(data);
					
				}
			);*/
		}
	}
/************************************Delete Group Certificate*************************************/

</script>