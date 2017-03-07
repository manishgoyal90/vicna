<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."post_details SET PostStatus = '".$stat."' WHERE PostId = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>