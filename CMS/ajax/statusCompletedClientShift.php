<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'];	

$updatestat = "UPDATE staff_available_shift SET clientStatus = '".$stat."' WHERE id = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>