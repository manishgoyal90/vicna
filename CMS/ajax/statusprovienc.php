<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."proviance SET pstatus = '".$stat."' WHERE pid = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>