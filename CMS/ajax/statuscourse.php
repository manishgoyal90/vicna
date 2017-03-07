<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."course_list SET course_status = '".$stat."' WHERE crid = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>