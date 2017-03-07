<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE staff_available_shift SET status = '".$stat."' WHERE id = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>