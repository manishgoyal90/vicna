<?php
	include"config/connect.php";
	

	
	
		

			$email = trim(mysql_real_escape_string(stripslashes($_REQUEST['email'])));
			$password = mysql_real_escape_string(stripslashes($_REQUEST['password']));
			
	
				
					//Checking Email  With Database
					$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."user_registration WHERE EmailId = '".$email."' AND Password = '".base64_encode($password)."' AND UserStatus = 'Yes' AND EmailVerification = 'Yes'";
					$FetchUserQuery = mysql_query($FetchUserSql);
					$NumRows = mysql_num_rows($FetchUserQuery);
					
					if($NumRows>0) {
					
					$FetchRows = mysql_fetch_array($FetchUserQuery);
					
					$_SESSION['username'] = $FetchRows['FirstName'];
					$_SESSION['userid'] = $FetchRows['Uid'];
					
					$cookievalue = $_SESSION['userid']."@@".$_SESSION['username'];
		
					if($_REQUEST['rem'] == 'yes')
					{
						setcookie("UserCookie",$cookievalue,time()+30*24*60*60);
					}

							
						//header("location:account.php?login=successful");
						
						
					if($_REQUEST['product_id']=='')
						{				
							echo '<script language="javascript">';
							echo 'window.location="checkout-address.php?login=successful"';
							echo '</script>';
						}
						
								
					
				} else {
					header("location:checkout.php?login=fail");
				}
			
		
?>