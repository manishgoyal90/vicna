<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE ".TABLE_PREFIX."sponsors_partners SET SponsorsStatus = '".$stat."' WHERE SponsorsId  = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>