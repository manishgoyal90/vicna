<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."event_details SET EventStatus = '".$stat."' WHERE EventId = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>