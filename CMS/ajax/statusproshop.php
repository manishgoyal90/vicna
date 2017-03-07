<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."product SET product_status = '".$stat."' WHERE product_id  = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>