<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

echo $updatestat = "UPDATE ".TABLE_PREFIX."gallerylist SET status = '".$stat."' WHERE id = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>