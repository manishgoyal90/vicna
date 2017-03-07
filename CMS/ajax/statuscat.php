<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."course_category SET status = '".$stat."' WHERE cid = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>