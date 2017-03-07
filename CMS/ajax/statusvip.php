<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."vip_member SET UserStatus = '".$stat."' , VisibleStatus = 'Yes', EmailVerification = 'Yes' WHERE Uid = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>