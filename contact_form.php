<?php
 //include 'config/connect.php'; 


if($_POST)
{
	$firstname = trim($_POST['fname']);
	$lastname = trim($_POST['lname']);
	$email = trim($_POST['mail']);
	$phone = trim($_POST['phone']);
	
	$qualification = trim($_POST['quali']); 
	if($qualification != 'Other')
	{
		$qualification = $qualification;
	}else{
		$qualification = trim($_POST['extra-quali']); 
	}
	
	if($firstname=='')
	{
		echo "<script> alert('Please Enter your First Name!')</script>";
		
	}
	elseif($lastname=='')
	{
		echo "<script> alert('Please Enter your Last Name!')</script>";
		
	}
	else if($email=='')
	{
		echo "<script> alert('Please give valid email!')</script>";
		
	}
	
	else if($phone=='')
	{
		echo "<script> alert('Phone number is required!')</script>";
		
	}
	
	else
	{
		$que = "insert into hr_contact SET
					first_name = '".$firstname."',
					last_name = '".$lastname."',
					email = '".$email."',
					ph_no = '".$phone."',
					qualification = '".strtoupper($qualification)."',
					contact_date = NOW()"; 
		//	$que="INSERT INTO ".TABLE_PREFIX."contact SET 
																							//first_name = '".$firstname."' ,
																							//last_name ='" . $lastname . "',
																							//email = '".$email."' ,
																							//ph_no = '".$phone."' , 
																							///qualification='".$qualification."',
																							//extra_qulification='".$extraqualification."'	
																																
																							 
																							//";
		if(mysql_query($que))
		
		{
			echo "<script>alert('Your Request Sunmitted. Thank You!!')</script>";
			echo "<script>window.location.href='index.php';</script>";
			exit();
		
		}
		else{
			echo "<script>alert('Not Register. Try Again!!')</script>";
		}
	}
}
?>