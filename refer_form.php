<?php
 include 'config/connect.php'; 
function isValidEmail($email){ 
     $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 

     if (eregi($pattern, $email)){ 
        return true; 
     } 
     else { 
        return false; 
     }    
} 

if($_POST)
{
	$msg = "";
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$refer_firstname = $_POST['refer_fname'];
	$refer_lastname = $_POST['refer_lname'];
	$refer_email = $_POST['refer_email'];
	$refer_phone = $_POST['refer_phone'];
	
	
	$qualification = $_POST['quali']; 
	 
	
	if($firstname=='')
	{
		$msg = "Error";
		echo "<script> alert('Please Enter your First Name!')</script>";
	
	}
	elseif($lastname=='')
	{
		$msg = "Error";
		echo "<script> alert('Please Enter your Last Name!')</script>";
	
	}
	else if($email=='')
	{
		$msg = "Error";
		echo "<script> alert('Please give valid email!')</script>";
	
	}
	
	else if($phone=='')
	{
		$msg = "Error";
		echo "<script> alert('Phone number is required!')</script>";
	
	}
	elseif($refer_firstname=='')
	{
		$msg = "Error";
		echo "<script> alert('Please Enter Applicant First Name!')</script>";
	
	}
	elseif($refer_lastname=='')
	{
		$msg = "Error";
		echo "<script> alert('Please Enter Applicant Last Name!')</script>";
	
	}
	else if($refer_email=='')
	{
		$msg = "Error";
		echo "<script> alert('Please give Applicant valid email!')</script>";
	
	}
	
	else if($refer_phone=='')
	{
		$msg = "Error";
		echo "<script> alert('Applicant Phone number is required!')</script>";
	
	}
	else if($qualification=='')
	{
		$msg = "Error";
		echo "<script> alert(' Give A qualification!')</script>";
	}
	
	if(!isValidEmail($email))
	{
		$msg = "Error";
		echo "<script> alert('Please Enter a valid Employee Email')</script>";	
	}
	if(!isValidEmail($refer_email))
	{
		$msg = "Error";
		echo "<script> alert('Please Enter a valid Applicant Email')</script>";
	}

	if($msg == ""){
		$que = "insert into hr_refer(first_name,last_name,email,ph_no,qualification,refer_firstname,refer_lastname,refer_email,refer_phone,date)values('$firstname','$lastname','$email','$phone','$qualification','$refer_firstname','$refer_lastname','$refer_email','$refer_phone',NOW())"; 
		
		if(mysql_query($que))
		{
			echo "<script>alert('Your Request Sunmitted. Thank You!!')</script>";
			echo "<script>window.location.href='refer.php';</script>";
			exit();
		
		}
		else{
			echo "<script>alert('Your Request not Sunmitted. Try Again!!')</script>";
		}
	}
}
?>