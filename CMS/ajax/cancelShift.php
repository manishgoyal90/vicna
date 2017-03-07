<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];

$fetch = mysql_fetch_array(mysql_query("SELECT shiftid,shift FROM staff_available_shift WHERE id = '".$id."'"));
if($fetch['shift'] == 'first')
{
	mysql_query("UPDATE book_nurse SET firstShift = 'Cancel' WHERE sl = '".$fetch['shiftid']."'");
}elseif($fetch['shift'] == 'second')
{
	mysql_query("UPDATE book_nurse SET secondShift = 'Cancel' WHERE sl = '".$fetch['shiftid']."'");
}elseif($fetch['shift'] == 'third')
{
	mysql_query("UPDATE book_nurse SET thirdShift = 'Cancel' WHERE sl = '".$fetch['shiftid']."'");
}

$updatestat = "UPDATE staff_available_shift SET status = 'Cancelled', accept_staffid='' WHERE id = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>