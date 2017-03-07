<?php 

	include"config/connect.php";
	if($_SESSION["userid"]){}else{header('Location: login.php');exit();}
	
	$result = mysql_query("UPDATE staff_available_shift SET feedback = '".$_GET["str"]."' WHERE id = '".$_GET["slno"]."';");
	if($result){echo("<font color='green'>Feedback Send Successfully.</font>");}
?>

<!--UPDATE `vicna`.`stuff_booked` SET `clientResponse` = 'good' WHERE `stuff_booked`.`sl` = 1;-->