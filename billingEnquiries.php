<?php 
 include"config/connect.php";
 

 $maxid = mysql_fetch_array(mysql_query("SELECT MAX(sl) as maxid FROM billing_enquires"));
 $receipt_no = 'VIC0'.$maxid['maxid'];
 
  $q=mysql_query("INSERT INTO billing_enquires SET
  							Uid = '".$_SESSION['userid']."',
							title = '".addslashes($_POST["enqTitle"])."',
							detail ='".addslashes($_POST["enquires"])."',
							date = NOW(),
							receipt_no = '".$receipt_no."'");
 
  
  $staff_enquery = mysql_query("INSERT INTO client_enquery SET
  										receipt_no = '".$receipt_no."',
										reply = '".addslashes($_POST["enquires"])."',
										reply_date = NOW(),
										reply_by = 'client'");																										  
		 																							  
																										 
 ?>

<font color="#666666" size="+1">Billing Enquiries</font>
<form name="" action="" method="post">
  New Enquiry:
  <table >
    <tr>
      <td><font color='red'>*</font>Subject:
        <input type="text" name="enqTitle" id="enqTitle" class="form-control" required>
      </td>
    </tr>
    <tr>
      <td><font color='red'>*</font>Enquiry:
        <textarea cols="105" rows="5" name="enquires" id="enquires" class="form-control" required></textarea>
      </td>
    </tr>
    <tr>
      <td><br />
        <input type="button" class="btn btn-info" name="submit_enq" value="Submit"  onclick="saveMe()">
        <?php if($q){echo" <font color='green'> Message Successfully send.</font>";} ?>
      </td>
    </tr>
  </table>
</form>
<font color="#666666" size="+1">Previous Enquiries</font>
<table class="table" style="background:#E8FDFF;">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Recipt no</th>
                      <th>Status</th>
                      <th>&nbsp;</th>
                    </tr>
                  </thead>
                  <?php
		   $q=mysql_query("SELECT * FROM billing_enquires WHERE Uid = '".$_SESSION['userid']."' order by sl desc");
		   while($row = mysql_fetch_array($q) ){
			   $sl = $row[sl];
			   $title = $row[title];
			   $detail = $row[detail];
			   $date = date('d F Y', strtotime($row['date']));
			   $answered = $row['answered'];
			   $receipt_no = $row['receipt_no'];
		   /*$date1=$date;
		   $date=date_create($date);
		   $date=date_format($date,"d F Y");*/
		   if($answered){$ans="Resolved";}else{$ans="In Progress";}
		   if($answered){$rr=" <span class='glyphicon glyphicon-ok'></span>";}else{$rr="<span class='glyphicon glyphicon-random'></span>";}
		   ?>
                  <tr bgcolor="#C1F4FD">
                    <td><?= $date ?></td>
                    <td><?php echo "VIC$sl"; ?></td>
                    <td><?php echo $ans; ?></td>
                   <!-- <td><?php echo $rr; ?></td>-->
                    <td align="right";><button  class="btn btn-info" data-toggle="collapse"  data-target="#demo_detail<?=$sl?>" style=" width:200px; margin:3px;">View details</button>
                      <div id="demo55" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;"></div></td>
                  </tr>
                  <tr>
                    <td colspan="4"><div id="demo_detail<?=$sl?>" class="collapse" > 
					<div id="<?=$receipt_no?>">	
					<table width="100%" ><tr style="font-size:18px;"><td width="10%">Subject : </td><td><b><?= $title ?></b></td></tr>
 <?php 
 $ql = mysql_query("SELECT * FROM client_enquery WHERE receipt_no = '".$receipt_no."'");
 while($enq = mysql_fetch_array($ql))
 		{
		
		if($enq['reply_by'] == 'client'){
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
 </div>
  <?php if($answer == ""){?>
          <form name="" action="" method="post"><b>Reply:</b>
          <table>
        <td valign="top"> 
        <input type="hidden" name="receiptNo" id="receiptNo" class="form-control" value="<?=$receipt_no;?>">
        <br />
		<textarea cols="100" rows="5" name="client_reply" id="client_reply" class="form-control"></textarea>
        </td>
        </tr>
        <tr>
        <td><br />
			<button type="button" class="btn btn-info" name="" onclick="saveClientMe()" >Reply</button>
			
            </td>
            </tr>
            </table>
            </form>

  <?php }?>
				
		 
                        <!--_________________________________________--> 
                      </div></td>
                  </tr>
                  <?php } ?>
                </table>
