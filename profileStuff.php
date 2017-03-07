<?php
session_start();
if($_SESSION["userid"]){}else{header('Location: login1.php');exit();}
	


	include"config/connect.php";
//_____________________________________upload profile start__________________________________
define ("MAX_SIZE","1000000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
if(isset($_POST['submit_profile_pic']) ){
 

 
$errors=0;
$image=$_FILES['image']['name'];
if ($image) 
{
	$filename = stripslashes($_FILES['image']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")  
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")   ) 
	{
		$msg_upload= '<font color = "red">Unknown extension! Not uploaded.</font>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['image']['tmp_name']);
 
		if ($size > MAX_SIZE*1024)
		{
			$msg_upload= '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=time().'.'.$extension;
		//$image_name="prof-".$_SESSION["userid"].'.'.$extension;
		$newname="profileImage/".$image_name;
 
		$copied = copy($_FILES['image']['tmp_name'], $newname);
		if (!$copied) 
		{
			$msg_upload= '<font color="red">Copy unsuccessfull!</font>';
			$errors=1;
		}
		else 
		{
			mysql_query("UPDATE hr_staff_registration SET UserImage = '".$image_name."' WHERE Uid='".$_SESSION["userid"]."'");
			$msg_upload= '<font color="green">uploaded successfull!</font>';
		}

	}
 
	
}
//-------------------------------------------------------


		//mysql_query("UPDATE hr_staff_registration SET UserImage = '".$image_name."' WHERE Uid = ".$_SESSION["userid"].";");
//------------------------------------------------------
}

//_____________________________________upload profile page end____________________________________
	
	
	
//---------------upload doc start------------
if(isset($_POST['submit_doc']) and $_POST["title"]){
 
/*define ("MAX_SIZE","1000000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}*/
 
$errors=0;
$image=$_FILES['image']['name'];
if ($image) 
{
	$filename = stripslashes($_FILES['image']['name']);
	$extension = getExtension($filename);
	$extension = strtolower($extension);
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")  && ($extension != "pdf")  && ($extension != "PDF") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG")  && ($extension != "docx")  && ($extension != "DOCX") 
		&& ($extension != "PNG") && ($extension != "GIF") && ($extension != "doc")  && ($extension != "DOC") ) 
	{
		$msg_upload= '<font color = "red">Unknown extension! Not uploaded.</font>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['image']['tmp_name']);
 
		if ($size > MAX_SIZE*1024)
		{
			$msg_upload= '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		//$image_name=time().'.'.$extension;
		$image_name="doc-".$_POST["title"]."-".$_SESSION["userid"].'.'.$extension;
		$newname="docs/".$image_name;
 
		$copied = copy($_FILES['image']['tmp_name'], $newname);
		if (!$copied) 
		{
			$msg_upload= '<font color="red">Copy unsuccessfull!</font>';
			$errors=1;
		}
		else $msg_upload= '<font color="green">uploaded successfull!</font>';

	}
 
	
}
//-------------------------------------------------------




	$insert = mysql_query("INSERT INTO documents (id, path, title, description, userId, date) VALUES (NULL, '".$newname."', '".mysql_real_escape_string($_POST["title"])."', '".mysql_real_escape_string($_POST["description"])."', '".$_SESSION["userid"]."', now());");
	if($insert)
	{
		echo '<script>alert("Document Added Successfully.");</script>';
		echo '<script>window.location.href="profileStuff.php";</script>';
		exit();
	}

		
		//------------------------------------------------------
}

//---------------upload doc end------------
	
	if (isset($_POST['submit']) and $_POST["FirstName"])
	{
		$msg="<div style='margin:10px;'>updated.</div>";
	$SqlUpdate = "UPDATE hr_staff_registration SET 
						FirstName = '".$_POST["FirstName"]."',
						LastName= '".$_POST["LastName"]."',
						Address='".$_POST["Address"]."',
						homePhone='".$_POST["homePhone"]."',
						mobile='".$_POST["mobile"]."',
						Password='".base64_encode($_POST["Password"])."',
						dob='".$_POST["dob"]."',
						vicnaEmail = '".$_REQUEST['vicnaEmail']."',
						qualification = '".$_REQUEST['Qualification']."',
						AHPRAReg='".$_POST["AHPRAReg"]."',
						AHPRARegExp='".$_POST["AHPRARegExp"]."',
						basicLifeSupport='".$_POST["basicLifeSupport"]."',
						basicLifeSupportExp='".$_POST["basicLifeSupportExp"]."',
						policeCheck='".$_POST["policeCheck"]."',
						policeCheckExp='".$_POST["policeCheckExp"]."',
						WWC='".$_POST["WWC"]."',
						WWCExp='".$_POST["WWCExp"]."'
						WHERE Uid = '".$_SESSION['userid']."'";
	$result = mysql_query($SqlUpdate);
	
	
	
	if($result){$msg="<font color='Green'>Successfully Updated.</font>";}
	else{$msg="<font color='Red'>Not Updated.</font>";}
	}
				
				$SqlUser = "SELECT * FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result = mysql_query($SqlUser);
				
				
				$row = mysql_fetch_array($result);
				
					$FirstName=$row['FirstName'];
					$LastName=$row['LastName'];
				
				
				
				
				//For Cover Image
				if($row['UserImage'] == "")
				{
					$pic = "profileImage/profile_pic.jpg";
				}
				else if(!is_file("profileImage/".$row['UserImage']))
				{
					$pic = "profileImage/profile_pic.jpg";
				}
				else
				{
					$pic = "profileImage/".$row['UserImage'];
				}
	
	$page = "home";

		

?>
        
                             <script type="text/javascript">
  function checkForm(form)
  {
    // validation fails if the input is blank
   

    // regular expression to match only alphanumeric characters and spaces
 
	
  if(form.email.value == "") {
      alert("Error:Insert Your Valid Id!");
      form.email.focus();
      return false;
    }

   if(form.password.value == "") {
      alert("Error:Enter Your valid Password !");
      form.password.focus();
      return false;
    }
   
  

   
    // validation was successful
    return true;
  }

</script>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
<title>VIC Nursing Agency</title>
<meta name="author" content="Themezinho">
<meta name="description" content="">
<meta name="keywords" content="">

<!-- SOCIAL MEDIA META -->
<meta property="og:description" content="">
<meta property="og:image" content="">
<meta property="og:site_name" content="">
<meta property="og:title" content="">
<meta property="og:type" content="website">
<meta property="og:url" content="">

<!-- TWITTER META -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@themezinho">
<meta name="twitter:creator" content="@themezinho">
<meta name="twitter:title" content="Medicina">
<meta name="twitter:description" content="">
<meta name="twitter:image" content="">


<!-- FAVICON FILES -->
<link href="ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
<link href="ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
<link href="ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
<link href="ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon-precomposed">
<link href="ico/favicon.png" rel="shortcut icon">

<!-- CSS FILES -->
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/jquery.fancybox.css" rel="stylesheet">
<link href="css/owl.carousel.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet" type="text/css"  />

<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<noscript>
<link rel="stylesheet" type="text/css" href="css/styleNoJS.css" />
</noscript>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
  $(document).ready(function() {
    $(".date-picker").datepicker({
      dateFormat: 'dd-mm-yy'
	});
	
	
  });
  
</script>
	
</head><body>
<?php include'headerLoginStuff.php';?>



<section class="latest-news">
  <div class="container">
      <div class="row">
      
    
        
   <!-- ************************************************************************************************************************************-->    
        <div class="col-lg-10 col-sm-10 pull-center col-md-offset-1" >
    <div class="card hovercard" style="background:url(images/bg.jpg);">
        <div class="card-background"  style="">
            <img class="card-bkimg" alt="" src="">
            
        </div>
        <div class="useravatar" >
           <img alt="" src="<?=$pic;?>">
           <br>
        </div>
        <div class="card-info"> <span class="card-title" style="padding:20px;"><?php echo $FirstName ." ".$LastName; ?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
	
	
        <div class="btn-group" role="group">
            <button type="button" id="profile" class="btn btn-primary"  onclick="location.href = 'profileStuff.php';" data-toggle="tab">
			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Profile</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'allocationsStuff.php';" data-toggle="tab">
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <div class="hidden-xs">Allocations</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'payrollStuff.php';"data-toggle="tab">
			<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                <div class="hidden-xs">Payroll</div>
            </button>
        </div>
		 <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'vicnaEmailStuff.php';" data-toggle="tab">
			<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                <div class="hidden-xs">My VICNA Email</div>
            </button>
        </div>
		
		
		
    </div>
	<?php
	$SqlUser = "SELECT * FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result = mysql_query($SqlUser) or die(mysql_error());;
				
				
				$row = mysql_fetch_array($result);
			
					$FirstName=$row['FirstName'];
					$LastName=$row['LastName'];
					$UserName=$row['UserName'];
					$EmailId=$row['FirstName'];
					$UserImage=$row['UserImage'];
					$Country=$row['Country'];
					$State=$row['state'];
					$City=$row['City'];
					$Address=$row['Address'];
					$Qualification = $row['qualification'];
					$Phone=$row['Phone'];
					$ZipCode=$row['ZipCode'];
					$RgistDate=$row['RgistDate'];
					$UserStatus=$row['UserStatus'];
					$VisibleStatus=$row['VisibleStatus'];
					$EmailVerification=$row['EmailVerification'];
					$ConfirmCode=$row['ConfirmCode'];
					$BusinessName=$row['BusinessName'];
					$TradingName=$row['TradingName'];
					$BusinessAddress=$row['BusinessAddress'];
					$Address=$row['Address'];
					$homePhone=$row['homePhone'];
					$mobile=$row['mobile'];
					$Fax=$row['Fax'];
					$EmailId=$row['EmailId'];
					$vicnaEmail=$row['vicnaEmail'];
					$Website=$row['Website'];
					$ClientId=$row['ClientId'];
					$Password=base64_decode($row['Password']);
					$dob=$row['dob'];
					$RegistrationNo=$row['RegistrationNo'];
					$AHPRAReg=$row['AHPRAReg'];
					$AHPRARegExp=$row['AHPRARegExp'];
					$basicLifeSupport=$row['basicLifeSupport'];
					$basicLifeSupportExp=$row['basicLifeSupportExp'];
					$policeCheck=$row['policeCheck'];
					$policeCheckExp=$row['policeCheckExp'];
					$WWC=$row['WWC'];
					$WWCExp=$row['WWCExp'];
				
				if($UserImage != "")
				{
					$pic = "profileImage/".$UserImage;
				}else{
					$pic = "profileImage/profile_pic.jpg";
				}
	?>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
          <h3>Profile</h3>
		  <!-- ------------------------------------------------------------------------------------------------------ -->
       <?php  echo $msg; //echo $msg_upload; ?>
    <form name="" action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td><img src="<?=$pic?>" style="width:100px; height:100px"></td><td></td>
			</tr>
			<tr>
			   <td valign="top">
					
				   <input type="file" name="image" id="image" size="40" >
				</td>
				<td><input name="submit_profile_pic" type="submit"  class="btn btn-info" value="Upload" /></td>
			</tr>
		</table>
	</form>
		<?php  
		
		
		echo "<div style='margin:10px'>$msg_upload</div>";
				
				
                ?>
                <form method="post" action="profileStuff.php">
         <table class="table">
         <tr><td>First Name: </td><td><input type="text" name="FirstName" class="form-control" value="<?php echo $FirstName ;?> " required></td></tr>
         <tr><td>Last Name:</td><td><input type="text" name="LastName" class="form-control" value="<?php echo $LastName ;?>"></td></tr>
         <tr><td>Date of Birth:</td><td><input type="text" class="form-control" name="dob" value="<?php echo $dob ;?>" ></td></tr>
         <tr><td>Residential Address:</td><td><input type="text"  class="form-control" name="Address" value="<?php echo $Address ;?>" required></td></tr>
		 <tr><td>Qualification:</td><td><input type="text"  class="form-control" name="Qualification" value="<?php echo $Qualification ;?>" required></td></tr>
         <tr><td>Personal Email:</td><td><input type="tel" name="EmailId"  class="form-control" value="<?php echo $EmailId ;?>"  ></td></tr>
         <tr><td>Mobile Phone:</td><td><input type="tel" name="mobile"  pattern="[0-9]{10}" placeholder="Enter 10 degin number" class="form-control" value="<?php echo $mobile ;?>"></td></tr>
         <tr><td>Home Phone:</td><td><input type="text" name="homePhone"  class="form-control" value="<?php echo $homePhone ;?>" ></td></tr>
         <tr><td>VICNA Username/Email:</td><td><input type="email" name="vicnaEmail"  class="form-control" value="<?php echo $vicnaEmail  ;?>"  ></td></tr>
        
         <tr><td>Employee Id:</td><td><input type="text" name="empid" class="form-control"  value="<?php echo $RegistrationNo ;?>" ></td></tr>
		 
		 <tr ><td>AHPRA Registration Number:</td><td>
         <input type="text" name="AHPRAReg" class="form-control"  value="<?php echo $AHPRAReg ;?>"></td></tr>
         <tr><td>Expiry Date:</td><td><input type="text" name="AHPRARegExp" class="form-control"  value="<?php if($row['AHPRARegExp'] != ""){echo $AHPRARegExp ;}?>">
         </td></tr>
		 <tr ><td>Basic Life Support:</td><td>
         <input type="text" name="basicLifeSupport" class="form-control"  value="<?php echo $basicLifeSupport ;?>"></td></tr>
         <tr><td>Expiry Date:</td><td><input type="text" name="basicLifeSupportExp" class="form-control"  value="<?php if($row['basicLifeSupportExp'] != ""){echo $basicLifeSupportExp ;}?>">
         </td></tr>
		 <tr ><td>Police Check:</td><td>
         <input type="text" name="policeCheck" class="form-control"  value="<?php echo $policeCheck ;?>"></td></tr>
         <tr><td>Expiry Date:</td><td><input type="text" name="policeCheckExp" class="form-control "  value="<?php if($row['policeCheckExp'] != ""){echo $policeCheckExp ;}?>"></td></tr>
         
         
		 <tr ><td>WWC:</td><td><input type="text" name="WWC" class="form-control"  value="<?php echo $WWC ;?>"></td></tr>
         <tr><td>Expiry Date:</td><td><input type="text" name="WWCExp" class="form-control "  value="<?php if($row['WWCExp'] != ""){echo $WWCExp ;}?>"></td></tr>
		 <tr><td>Password:</td><td><input type="password" name="Password" class="form-control"  value="<?php echo $Password ;?>" required></td></tr>

		 
		 
		 <tr><td></td><td><input type="submit" name="submit" class="btn btn-info"  value="Submit"></td></tr>
         </table>
         
         
         </form>
        
         
					
          <!-- ------------------------------------------------------------------------------------------------------ -->
		  
		  
		  <!-- -----------------display uploaded file------------------------------------------------------------- -->
		  <div id="select">&nbsp;</div>
			<button data-toggle="collapse" data-target="#demo" style="200px;" >Upload your document</button>

<div id="demo" class="collapse" style="border-radius:5px;border:1px solid #09F;padding:10px;">
			<h4>My Documents.</h4>
			<div id="tablesec" style="border:2px solid #003366; border-radius:5px; padding:10px;">
			<table bg='#fff' style="width:100%;" cellpadding="0" cellspacing="0" border="0">	
			<tr>
				<th>Nos.</th>
				<th>Title</th>
				<th>Document</th>
				<th>Action</th>
				
			</tr>	 
		 <?php
                     $query = "SELECT * FROM documents where userId = '".$_SESSION["userid"]."'  ;"; 
			  $result = mysql_query($query) or die(mysql_error());
		 $c=1;
		 	 
			  while($row = mysql_fetch_array($result))
			  {
				  $path=$row['path'];
				  $title=$row['title'];
				?>
				<tr>
					<td><?=$c;?></td>
					<td><?=$title?></td>
					<td><a href='download.php?link=<?=$path?>'>
					  <img src='images/doc.png' title='<?=$title?>' style="height:35px;">
					  </a>
					</td>
					<td><a href="" style="text-decoration:none;" onClick="return deleteone(<?=$row['id']?>);" title="delete" ><span style="color:#CC3300;" class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				  
		<?php
				  $c++; 
				
			  }
			  
			  if($c==1){echo "<tr><td colspan='4'>No document uploaded till now.</td></tr>";}
			?>
			
			
			
			</table>
			</div>
			
            
          

            
		<table><tr><td>	
			<form action="" method="post" enctype="multipart/form-data">
 Upload your document:<br>
 <select name="title" class="form-control">
 <option value="AHPRA">AHPRA</option>
 <option value="BLS">BLS</option>
 <option value="Police Check">Police Check</option>
 <option value="WWC">WWC</option>
 <option value="Reference Letter">Reference Letter</option>
 <option value="Drivers License">Drivers License</option>
 <option value="Passport">Passport</option>
 <option value="Visa">Visa</option>
 <option value="Citizenship Certificate">Citizenship Certificate</option>
 <option value="Medicare">Medicare</option>
 <option value="Record of Immunization">Record of Immunization</option>
 <option value="Medical Certificate">Medical Certificate</option>
 <option value="Other">Other</option> 
 </select>
 <br>
 <input type="file" name="image" id="image" size="40" required >
 <br><input name="submit_doc" type="submit" class="btn btn-info" value="upload" />
</form>
			</td>
			</tr>
		</table>
        
        
</div>  
		  <!-- ------------------end display uploaded file------------------------------------------------------ -->
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
		  
          </div>
        
        
      </div>
    </div>
    
    </div>
            
    
    
    </div>
    
  
                     
                        
            
   <!-- ***************************css***********************************-->
   <style>
        /* USER PROFILE PAGE */
 /* USER PROFILE PAGE */
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}



</style>








<!--********************************Js**********************************************-->
<script>
$(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).removeClass("btn-default").addClass("btn-primary");   
});
});
</script>
   <!-- *****************************************************************************************************************************-->    
        
        
      
    </div>
  <!-- end container --> 
</section>
<!-- end section -->

<!-- end footer-bar -->
<?php include'footer.php';?>
<!-- end footer --> 


<!-- form copy***************************************************** -->


<!-- ****************************************************************** end -->
<script type="text/javascript">
function deleteone(id)
    {
        var cnf = confirm("Are you sure to delete?");

        if (cnf)
        {
            //$('.portlet .tools a.reload').click();
            $.post('ajax/deldocument.php', {feedid: id, mode: 'single'},
            function(data)
            {//deletecinematic
                $('#tablesec').html(data);
               
            }
            );
        }
    }
</script>
</body>


</html>