<?php	
		include"config/connect.php";
		
		header("Cache-control: private"); //----------------Define Cach-control as private for security-------------//
		if(isset($_SESSION['userid']) || isset($_SESSION['username']))
		{
			$offlineSql="delete from ".TABLE_PREFIX."online_status where onlinestatus_user_id='".$_SESSION['userid']."'";
			mysql_query($offlineSql) or mysql_error();
			
			unset($_SESSION['username']);
			unset($_SESSION['userid']);
			setcookie("UserCookie",'',time());
			setcookie("freichat_user",'',time());
			//session_destroy();
			
		}
		header("Location: index.php");
?>