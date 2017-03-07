<?php include"lib/header.php";



//_____________________________________________________________________________________________________________________________



if($_POST["sl1"] and $_POST["acName1"])
{
	$r=mysql_query("UPDATE  account_details SET 
				   
				  
				   acName='".$_POST["acName1"]."', 
				   bankName='".$_POST["bankName1"]."', 
				   BSB='".$_POST["BSB1"]."', 
				   acNo='".$_POST["acNo1"]."'
				   
				   
				   
				   WHERE sl = ".$_POST["sl1"].";") or die(mysql_error());
	
	if($r){echo "<font color='green'>Successfully Updated.</font>";}
else {echo "<font color='red'>Not updated.</font>";}
}
else if($_POST["acName1"])
{

$r=mysql_query("INSERT INTO account_details (sl,Uid, acName,acNo, BSB, bankName, dt,view) VALUES 
(NULL, '".$_POST["Uid1"]."','".$_POST["acName1"]."', '".$_POST["acNo1"]."', '".$_POST["BSB1"]."', '".$_POST["bankName1"]."', now(), '1')");
if($r){echo "<font color='green'>Successfully inserted.</font>";}
else {echo "<font color='red'>Not inserted.</font>";}

}


if($_POST["sl2"] and $_POST["acName2"])
{
	$r=mysql_query("UPDATE  account_details SET 
				   
				  
				   acName='".$_POST["acName2"]."', 
				   bankName='".$_POST["bankName2"]."', 
				   BSB='".$_POST["BSB2"]."', 
				   acNo='".$_POST["acNo2"]."'
				   
				   
				   
				   WHERE sl = ".$_POST["sl2"].";") or die(mysql_error());
	
	if($r){echo "<font color='green'>Successfully Updated.</font>";}
else {echo "<font color='red'>Not updated.</font>";}
}
else if($_POST["acName2"])
{

$r=mysql_query("INSERT INTO account_details (sl,Uid, acName,acNo, BSB, bankName, dt,view) VALUES 
(NULL, '".$_POST["Uid2"]."','".$_POST["acName2"]."', '".$_POST["acNo2"]."', '".$_POST["BSB2"]."', '".$_POST["bankName2"]."', now(), '1')");
if($r){echo "<font color='green'>Successfully inserted.</font>";}
else {echo "<font color='red'>Not inserted.</font>";}

}





?>