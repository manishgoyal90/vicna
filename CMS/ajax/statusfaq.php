<?php 
include("../../config/connect.php");

$id = $_REQUEST['id'];
$stat = $_REQUEST['stat'] == 'true' ? 'Y' : 'N';	

$updatestat = "UPDATE ".TABLE_PREFIX."faq SET QuestionStatus = '".$stat."' WHERE FaqId = '".$id."'";
mysql_query($updatestat) or die(mysql_error());
?>