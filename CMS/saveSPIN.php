<?php include"lib/header.php";

if($_POST["sl"] and $_POST["SPIN"])
{
	$r=mysql_query("UPDATE nsf SET 
				   
				  
				   SPIN='".$_POST["SPIN"]."', 
				   memberNumber='".$_POST["memberNumber"]."', 
				   fundABN='".$_POST["fundABN"]."', 
				   fundName='".$_POST["fundName"]."', 
				   fundAddress='".$_POST["fundAddress"]."', 
				   fundPhoneNumber='".$_POST["fundPhoneNumber"]."'
				   
				   
				   WHERE sl = ".$_POST["sl"].";");
	
	if($r){echo "<font color='green'>Successfully Updated.</font>";}
else {echo "<font color='red'>Not updated.</font>";}
}
else if($_POST["sl"] and $_POST["SPIN"])
{

$r=mysql_query("INSERT INTO nsf (sl, Uid,SPIN, memberNumber, fundABN, fundName, fundAddress, fundPhoneNumber, dt) VALUES 
(NULL, '".$_SESSION["userid"]."', '".$_POST["SPIN"]."', '".$_POST["memberNumber"]."', '".$_POST["fundABN"]."', '".$_POST["fundName"]."', '".$_POST["fundAddress"]."', '".$_POST["fundPhoneNumber"]."', now());");
if($r){echo "<font color='green'>Successfully inserted.</font>";}
else {echo "<font color='red'>Not inserted.</font>";}

}
else{}



?>