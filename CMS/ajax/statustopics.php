<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."course_topics SET topic_status = '".$stat."' WHERE tid = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>