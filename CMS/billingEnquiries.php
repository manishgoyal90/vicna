 <?php 
 include"../config/connect.php";
 
         
 $GetUserSql = "SELECT * FROM billing_enquires where sl=".$_GET["sl"]." ";
$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
$row = mysql_fetch_array($GetQuery);
									
$title=$row['title'];
$detail=$row['detail'];
$Uid=$row['Uid'];
$sl=$row['sl'];
$answer = $row['answered'];


$receipt_no =  $row['receipt_no'];
 
 if($_POST["enquires"]){
 /*$q=mysql_query("INSERT INTO pay_enquires (sl,Uid,`to`, title, detail, date,answered) VALUES (NULL, 'Admin','".$Uid."','".$_POST["enqTitle"]."', '".$_POST["enquires"]."', now(), '".$sl."');");
 $q=mysql_query("UPDATE pay_enquires SET answered = 't',answered_date=now() WHERE sl = ".$sl.";");*/
 //$q=mysql_query("UPDATE pay_enquires SET answered = 't', answer_details = '".$_POST["enquires"]."',answered_date=now() WHERE sl = '".$sl."'");
 $admin_enquery = mysql_query("INSERT INTO client_enquery SET
  										receipt_no = '".$receipt_no."',
										reply = '".addslashes($_POST["enquires"])."',
										reply_date = NOW(),
										reply_by = 'admin'");
 	if($admin_enquery){
		header("location:billingEnquiries.php?msg=ans&sl=".$sl);
	}
 }
																										  

																										 
 ?>
 
 <div style="background-color:#EFEFEF;"><font color="#666666" size="+1">Billing Enquiries:[ <b>Receipt No.-<?=$receipt_no;?></b>]</font></div>
 <?php if(isset($_REQUEST['msg'])){echo '<div style="color:green; font-weight:bold; text-align:center;">Answered Successfully.</div>';}?>
 <br/>
 <table ><tr style="font-size:24px;"><td width="15%">Subject : </td><td><b><?= $title ?></b></td></tr>
 <?php 
 $ql = mysql_query("SELECT * FROM client_enquery WHERE receipt_no = '".$receipt_no."'");
 while($enq = mysql_fetch_array($ql))
 		{
		
		if($enq['reply_by'] == 'client'){
?>
	 <tr><td>Client : </td><td rowspan="2"><?= $enq['reply'] ?><br/><?=date('d F Y H:i:s', strtotime($enq['reply_date']));?></td></tr>
	 <tr><td>&nbsp;</td></tr>
<?php }else{?>
	<tr><td>Admin : </td><td rowspan="2"><?= $enq['reply'] ?><br/><?=date('d F Y H:i:s', strtotime($enq['reply_date']));?></td></tr>
	<tr><td>&nbsp;</td></tr>

<?php 
	}
}?>

 </table>
 <br />
 <?php if($answer == ""){?>
          <form name="" action="" method="post"><b>Reply:</b>
          <table>
        <td valign="top"> 
        <input type="hidden" name="enqTitle" id="enqTitle" class="form-control" value="ANS:<?= $title ?>">
        <br />
		<textarea cols="100" rows="5" name="enquires" id="enquires" class="form-control"></textarea>
        </td>
        </tr>
        <tr>
        <td><br />
			<input type="submit" class="btn btn-info" name="submit_enq" value="Submit"  >
			<?php if($q){echo" <font color='green'> Message Successfully send.</font>";} ?>
            </td>
            </tr>
            </table>
            </form>

  <?php }?>
          
          
          
            
    
            
            
            
            
            
                     
            
    
            
            
            
            
            
            