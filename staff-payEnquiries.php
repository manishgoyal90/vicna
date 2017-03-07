<?php 
 include"config/connect.php";
 $receipt_no = $_REQUEST['receipt_no'];
  $staff_enquery = mysql_query("INSERT INTO staff_enquery SET
  										receipt_no = '".$receipt_no."',
										reply = '".addslashes($_POST["enquires"])."',
										reply_date = NOW(),
										reply_by = 'staff'");
																										  
		 																							  
																										 
 ?>

<table width="100%" ><tr style="font-size:18px;"><td width="10%">Subject : </td><td><b><?= $title ?></b></td></tr>
 <?php 
 $ql = mysql_query("SELECT * FROM staff_enquery WHERE receipt_no = '".$receipt_no."'");
 while($enq = mysql_fetch_array($ql))
 		{
		
		if($enq['reply_by'] == 'staff'){
?>
	 <tr><td>Me : </td><td rowspan="2"><?= $enq['reply'] ?><br/><?=date('d F Y H:i:s', strtotime($enq['reply_date']));?></td></tr>
	 <tr><td>&nbsp;</td></tr>
<?php }else{?>
	<tr><td>Admin : </td><td rowspan="2"><?= $enq['reply'] ?><br/><?=date('d F Y H:i:s', strtotime($enq['reply_date']));?></td></tr>
	<tr><td>&nbsp;</td></tr>

<?php 
	}
}?>

 </table>