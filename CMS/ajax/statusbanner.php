<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."banner SET BannerStatus = '".$stat."' WHERE BannerId  = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>