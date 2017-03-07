		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<?php //session_start();

	include"config/connect.php";
	if($_SESSION["userid"]){}else{header('Location: login.php');exit();}
?>
        

        
         <!-- <button id="donot" onClick="return showDonot();" style="margin:3px;">Click Here to Add More </button>-->
          <?php
		  if(isset($_POST["donotsend"])){
		  $q="INSERT INTO do_not_send (sl, stuffName, qualification, reason,clientId, dt) VALUES (NULL , '".$_POST["stuffName"]."', '".$_POST["qualification"]."', '".addslashes($_POST["reason"])."','".$_SESSION['userid']."', CURRENT_TIMESTAMP);";
		  $r=mysql_query($q) or die("error: ".mysql_error());
		  }
		  
		  if(isset($_REQUEST['delDonot']))
		  {
		  		$id = $_REQUEST['donot_id'];
				$delsingle = "DELETE FROM do_not_send WHERE sl = '".$id."'";
				mysql_query($delsingle);
		  }
		  ?>
		<div id="add_donot_send" style="display:block;"> 
          <form action="" method="post">
          <table class="table" style="background:#FFEFE6;">  
		  	<tr>
				<th width="30%">Staff name:</th>
				<th width="30%">Staff Qualification:</th>
				<th width="40%">For What</th>
				<th>&nbsp;</th>
			</tr>         
           <tr>
		   <td><input type="text" name="stuffName" value="" placeholder="Enter Staff Name" style="background:#FFE6E1;" required> </td>
		   <td><input type="text" name="qualification" value="" placeholder="Enter Qualification" style="background:#FFE6E1;" > </td>
		   <td rowspan="2"><textarea name="reason" rows="3" ></textarea></td>
           <td><input type="submit" name="donotsend" value="Do not send" class="btn btn-info" ></td></tr>
		</table>
             </form>
		</div>
        <div id="donotSend">    
          <table class="table" style="background:#FFF;">
            <thead>
			<tr>
			<th>Sl.</th>
			<th>VICNA Staff</th>
			<th>Qualification</th>
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
					<td><?=$row['qualification']?></td>
					<td><?=stripslashes($row['reason']);?></td>
					<td><?=date('d/m/Y', strtotime($dt));?></td>
					<td><form action="" method="post">
						<input type="hidden" name="donot_id" value="<?=$row['sl'];?>" />
						<button type="submit" name="delDonot" onClick="return confirm('Are you sure to delete?');" title="Delete" class="glyphicon glyphicon-trash" ></button>
						<!--<button type="submit" name="delDonot" onClick="return confirm('Are you sure to delete?');" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>--></form>
						</td>
					</tr>
					
					
					<!--<tr>
					<td colspan="5">
					<div class="collapse" id="edit_do_not<?=$c;?>">
					<form action="" method="post" enctype="multipart/form-data">
					<table class="table">
					<tr>
					<td></td>
					<td><input style="width:120px;" type="text" name="staff_name" value="<?=$stuffName?>" /></td>
					<td><textarea style="width:120px;" name="reason_for" ><?=stripslashes($row['reason']);?></textarea></td>
					<td><button type="button" id="edit_donot">Edit</button></td>
					<td>&nbsp;</td>
					</tr>
					</table>
					</form>
					</div>
					</td></tr>-->
					<?php					
					
				}
			?>           
            </table>
         
			<?php if($c){}else{echo "No data found.";} ?>
		</div>  
		</div>
<script type="text/javascript">
 function showDonot()
 {
 	
 	$('#add_donot_send').css('visibility', 'visible');
 }
	
</script>    