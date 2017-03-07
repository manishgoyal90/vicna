<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'];	

$updatestat = "UPDATE billing_enquires SET answered = '".$stat."' WHERE sl = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>