<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];

$fetch = mysql_fetch_array(mysql_query("SELECT shiftid,shift FROM staff_available_shift WHERE id = '".$id."'"));
if($fetch['shift'] == 'first')
{
	mysql_query("DELETE FROM stuff_booked WHERE booking_sl = '".$fetch['shiftid']."' AND shift = '1'");
}elseif($fetch['shift'] == 'second')
{
	mysql_query("DELETE FROM stuff_booked WHERE booking_sl = '".$fetch['shiftid']."' AND shift = '2'");
}elseif($fetch['shift'] == 'third')
{
	mysql_query("DELETE FROM stuff_booked WHERE booking_sl = '".$fetch['shiftid']."' AND shift = '3'");
}

$updatestat = "UPDATE staff_available_shift SET status = 'Unprocessed', accept_staffid='' WHERE id = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>