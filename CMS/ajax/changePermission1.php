<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Yes' : 'No';	

$updatestat = "UPDATE nsf SET view = '".$stat."' WHERE sl = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>