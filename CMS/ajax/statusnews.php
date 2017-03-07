<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."news_details SET NewsStatus = '".$stat."' WHERE NewsId = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>