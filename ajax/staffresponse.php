<?php 
include("../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'];
$staffid = $_REQUEST['staffid'];
$sql = mysql_query("SELECT * FROM staff_available_shift WHERE id = '".$id."'");
$fetch = mysql_fetch_array($sql);

if($fetch['shift'] == 'first'){$shift = 1;}elseif($fetch['shift'] == 'second'){$shift = 2;}else{$shift = 3;}

$count = mysql_num_rows(mysql_query("SELECT accept_staffid FROM staff_available_shift WHERE (accept_staffid = '".$staffid."' OR reject_staffid LIKE '%|".$staffid."|,%') AND id = '".$id."'"));

if($count < 2)
{
	if($stat == 'Accept')
	{
		$cnt = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE reject_staffid LIKE '%|".$staffid."|,%' AND id = '".$id."'"));
		if($cnt == 1){		
			$updatestat = "UPDATE staff_available_shift SET reject_staffid = REPLACE(reject_staffid, '|".$staffid."|,', ''), accept_staffid = '".$staffid."' WHERE id = '".$id."'";
			$insert = mysql_query("INSERT INTO stuff_booked SET stuffId = '".$staffid."', booking_sl = '".$fetch['shiftid']."', shift = '".$shift."', 	formDate = '".$fetch['date']."', toDate = '".$fetch['date']."', dt = NOW()");
		}else{
			$updatestat = "UPDATE staff_available_shift SET accept_staffid = '".$staffid."' WHERE id = '".$id."'";
		
			$insert = mysql_query("INSERT INTO stuff_booked SET stuffId = '".$staffid."', booking_sl = '".$fetch['shiftid']."', shift = '".$shift."', 	formDate = '".$fetch['date']."', toDate = '".$fetch['date']."', dt = NOW()");	
		}
		mysql_query($updatestat) or die(mysql_error());
	}else{
		$cnt1 = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '".$staffid."' AND id = '".$id."'"));
		if($cnt1 == 1){
			$updatestat = "UPDATE staff_available_shift SET accept_staffid = '', reject_staffid = CONCAT(reject_staffid, '|".$staffid."|,') WHERE id = '".$id."'";
		}else{
			$updatestat = "UPDATE staff_available_shift SET reject_staffid = CONCAT(reject_staffid, '|".$staffid."|,') WHERE id = '".$id."'";
		}
		mysql_query($updatestat) or die(mysql_error());	
	}
}

header("location:../allocationsStuff.php");
?>