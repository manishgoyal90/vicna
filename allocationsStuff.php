<?php
session_start();
if($_SESSION["userid"]){}else{header('Location: login1.php');exit();}
	


	include"config/connect.php";
//-------------------------------------------------------
if(isset($_POST["permanant_availablity"])){
	/*mysql_query("UPDATE staff_availablity SET 
		permanant = 'p'
		WHERE sl = ".$sl.";");
	*/
}
//-------------------------------------------------------
if(isset($_POST["staff_availablity1"])){
	
	for($i=1;$i<=7;$i++)
	{
		$sl='';
		
		$date = date('Y-m-d', strtotime($_POST['dt'.$i]));
		
		$SqlUser = "SELECT sl FROM staff_availablity WHERE dt = '".$date."'";
					$result = mysql_query($SqlUser);				
					while($row = mysql_fetch_array($result))
					{$sl=$row['sl'];}
		if($sl){
			mysql_query("UPDATE staff_availablity SET 
			am = '".$_POST["am".$i]."' ,
			pm = '".$_POST["pm".$i]."' ,
			nd = '".$_POST["nd".$i]."' ,
			note = '".$_POST["stuffNotes".$i]."' 
			WHERE sl = ".$sl.";");
		}
		else
		{
			mysql_query("INSERT INTO staff_availablity SET
										stuffId = '".$_SESSION["userid"]."',
										dt = '".$date."',
										am = '".$_POST["am".$i]."',
										pm = '".$_POST["pm".$i]."',
										nd = '".$_POST["nd".$i]."',
										note = '".$_POST["stuffNotes".$i]."',
										uploadDT = NOW()");
	
		}
	}
		
}

if(isset($_POST["staff_availablity2"])){
	
	for($i=1;$i<=7;$i++)
	{
		$sl='';
		
		$day = $_POST['day'.$i];
		
		$SqlUser = "SELECT sl FROM staff_permanent_availablity WHERE day = '".$day."'";
					$result = mysql_query($SqlUser);				
					while($row = mysql_fetch_array($result))
					{$sl=$row['sl'];}
		if($sl){
			mysql_query("UPDATE staff_permanent_availablity SET
			am = '".$_POST["am".$i]."' ,
			pm = '".$_POST["pm".$i]."' ,
			nd = '".$_POST["nd".$i]."' ,
			note = '".$_POST["stuffNotes".$i]."', 
			permanent = '".$_POST['permanant']."'
			WHERE sl = ".$sl.";");
		}
		else
		{
			mysql_query("INSERT INTO staff_permanent_availablity SET
										stuffId = '".$_SESSION["userid"]."',
										day = '".$day."',
										am = '".$_POST["am".$i]."',
										pm = '".$_POST["pm".$i]."',
										nd = '".$_POST["nd".$i]."',
										note = '".$_POST["stuffNotes".$i]."',
										permanent = '".$_POST['permanant']."',
										uploadDT = NOW()");
	
		}
	}
		
}


if(isset($_POST["staff_availablity"])){
	$sl='';
	$date = date('Y-m-d', strtotime($_POST['dt']));
	
	$SqlUser = "SELECT sl FROM staff_availablity WHERE dt = '".$date."'";
				$result = mysql_query($SqlUser);				
				while($row = mysql_fetch_array($result))
				{$sl=$row['sl'];}
	if($sl){
		mysql_query("UPDATE staff_availablity SET 
		am = '".$_POST["am"]."' ,
		pm = '".$_POST["pm"]."' ,
		nd = '".$_POST["nd"]."' ,
		note = '".$_POST["stuffNotes"]."' 
		WHERE sl = ".$sl.";");
	}
	else
	{
		mysql_query("INSERT INTO staff_availablity SET
									stuffId = '".$_SESSION["userid"]."',
									dt = '".$date."',
									am = '".$_POST["am"]."',
									pm = '".$_POST["pm"]."',
									nd = '".$_POST["nd"]."',
									note = '".$_POST["stuffNotes"]."',
									uploadDT = NOW()");

	}
		
}
	
//------------------------------------------------------


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
										AHPRAReg='".$_POST["AHPRAReg"]."',
										AHPRARegExp='".$_POST["AHPRARegExp"]."',
										basicLifeSupport='".$_POST["basicLifeSupport"]."',
										basicLifeSupportExp='".$_POST["basicLifeSupportExp"]."',
										policeCheck='".$_POST["policeCheck"]."',
										policeCheckExp='".$_POST["policeCheckExp"]."',
										WWC='".$_POST["WWC"]."',
										WWCExp='".$_POST["WWCExp"]."'	
										WHERE Uid = '".$_SESSION['userid']."';";
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
    $("#selected_date").datepicker({
      dateFormat: 'dd-mm-yy'
	});
	
	
  });
  
</script>
</head>
<body>
<?php include'headerLoginStuff.php';?>
<section class="latest-news">
  <div class="container">
  <div class="row"> 
    
    <!-- ************************************************************************************************************************************-->
    <div class="col-lg-10 col-sm-10 pull-center col-md-offset-1" >
      <div class="card hovercard" style="background:url(images/bg.jpg);">
        <div class="card-background"> <img class="card-bkimg" alt="" src=""> 
          <!-- http://lorempixel.com/850/280/people/9/ --> 
        </div>
        <div class="useravatar"> <img alt="" src="<?=$pic;?>"> </div>
        <div class="card-info"> <span class="card-title"><?php echo $FirstName ." ".$LastName; ?></span> </div>
      </div>
      <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
          <button type="button" id="profile" class="btn btn-default"  onclick="location.href = 'profileStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
          <div class="hidden-xs">Profile</div>
          </button>
        </div>
        <div class="btn-group" role="group">
          <button type="button"  class="btn btn-primary"  onclick="location.href = 'allocationsStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
          <div class="hidden-xs">Allocations</div>
          </button>
        </div>
        <div class="btn-group" role="group">
          <button type="button"  class="btn btn-default"  onclick="location.href = 'payrollStuff.php';"data-toggle="tab"> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
          <div class="hidden-xs">Payroll</div>
          </button>
        </div>
        <div class="btn-group" role="group">
          <button type="button"  class="btn btn-default"  onclick="location.href = 'vicnaEmailStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
          <div class="hidden-xs">My VICNA Email</div>
          </button>
        </div>
      </div>
      <div class="well">
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab1">
            <h3>Allocation</h3>
            <!-- ------------------------------------------------------------------------------------------------------ --> 
            
            <b>Available Shifts</b>
            <?php  
		
		//echo "IIIIIII".$_SESSION['userid'];
		echo "<div style='margin:10px'>$msg_upload</div>";
				$SqlUser = "SELECT * FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result = mysql_query($SqlUser) or die(mysql_error());;
				
				
				while($row = mysql_fetch_array($result))
				{
					$FirstName=$row['FirstName'];$LastName=$row['LastName'];$UserName=$row['UserName'];$EmailId=$row['FirstName'];
					
				}
				
                ?>
			
            <table class="table" style="border-bottom:1px solid #000; border-top:1px solid #000;">
              <thead>
                <tr>
                  <th>#</th>
				  <th>Client Name</th>
                  <th>Location</th>
                  <th>Role</th>
                  <th>date</th>
                  <th>time</th>
                  <th>Penalties</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
           <?php 
		   $qty = 1;
		  // $sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '' AND status = 'Unprocessed'");
		   $sql = mysql_query("SELECT sas.*, ur.FirstName, ur.LastName FROM staff_available_shift as sas INNER JOIN hr_user_registration as ur ON sas.clientId=ur.Uid AND sas.accept_staffid = '' AND sas.status = 'Unprocessed' ORDER BY sas.date DESC");
		   
		   
		  // $sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '' AND status = 'Yes' AND reject_staffid NOT IN (SELECT reject_staffid FROM staff_available_shift WHERE reject_staffid LIKE '%|".$_SESSION['userid']."|,%')");
		   $sqlcnt = mysql_num_rows($sql);
		   if($sqlcnt > 0){
		   while($rowdest = mysql_fetch_array($sql))
		   {
		   ?>
              <tr class="odd gradeX">
                  <td><?=$qty;?></td>
				    <td class="hidden-480"><div class="videoWrapper">
                      <?=$rowdest['FirstName'].' '.$rowdest['LastName']?>
                    </div></td>
                  <td class="hidden-480"><div class="videoWrapper">
                      <?=$rowdest['location']?>
                    </div></td>
                  <td class="hidden-480"><div class="videoWrapper">
                      <?=stripslashes($rowdest['role']);?>
                    </div></td>
                  <td class="hidden-480"><div class="videoWrapper">
                      <?=date('d M Y', strtotime($rowdest['date']))?>
                      <br/>
                      <?=date('l', strtotime($rowdest['date']))?>
                    </div></td>
                  <td class="hidden-480"><div class="videoWrapper">Start : <?php echo $rowdest['start_time'];?><br/>
                      Finish : <?php echo $rowdest['end_time'];?></div></td>
                  <td class="hidden-480"><div class="videoWrapper"><?php echo stripslashes($rowdest['penalties']);?></div></td>
                  <!--<td class="hidden-480"><div class="videoWrapper"><?php echo stripslashes($rowdest['more_info']);?></div></td>-->
                  
                 <td>
                 
                        <div class="controls">
                         <select class="span9 chosen" tabindex="1" id="stat<?=$rowdest['id']?>" onChange="staffresponse(this.value,'<?=$rowdest['id']?>', <?=$_SESSION['userid'];?>)">
                         	<option value="">Your Response</option>
                          <?php
						  $cnt = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '".$_SESSION['userid']."' AND id = '".$rowdest['id']."'"));
						  ?>
                            <option <?php if($cnt == 1){echo 'selected';}?> value="Accept">Accept</option>
                           <?php
						  $cntt = mysql_num_rows(mysql_query("SELECT * FROM staff_available_shift WHERE reject_staffid LIKE '%|".$_SESSION['userid']."|,%' AND id = '".$rowdest['id']."'"));
						  ?>
                            <option <?php if($cntt == 1){echo 'selected';}?> value="Reject">Reject</option>
                         </select>
                      </div>
                   
                 
                  <button class="glyphicon glyphicon-hand-right" aria-hidden="true" data-toggle="collapse" data-target="#moreinfo<?=$qty;?>" title="More Info"  style="color:blue;"></button></td>
                 
                </tr>
                <tr>
                	<td colspan="8">
                    <div class="row collapse" id="moreinfo<?=$qty;?>" style="padding-left:10px;">
                    <p style="color:#000; font-size:18px; font-weight:bold;">More Information</p>
                    <?php echo stripslashes($rowdest['more_info']);?>
                    </div>
                    </td>
                </tr>
                <?php $qty++; } 
		   }else{?>
               <tr>
                	<td colspan="7">No. Shift Are Available</td>
               </tr>
           <?php }?>
              </tbody>
              
            </table>
          
            
            
            
            <button data-toggle="collapse" data-target="#demo1" style="width:200px; margin-top:3px;">My Availability</button>
            <div id="demo1" class="collapse"  style="border-radius:5px;border:1px solid #09F;padding:10px;"> <b>My Availability</b> <br>
              <?php
				$monday = strtotime("last monday");
				
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				 $tue = date("d M Y",strtotime(date("Y-m-d",$monday)." +1 days"));
				 $wed = date("d M Y",strtotime(date("Y-m-d",$monday)." +2 days"));
				 $thu = date("d M Y",strtotime(date("Y-m-d",$monday)." +3 days"));
				 $fri = date("d M Y",strtotime(date("Y-m-d",$monday)." +4 days"));
				 $sat = date("d M Y",strtotime(date("Y-m-d",$monday)." +5 days")); 
				$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
				 
				$this_week_sd = date("d M Y",$monday);
				$this_week_ed = date("d M Y",$sunday);
				 
				echo "Week Starting from $this_week_sd abd end on $this_week_ed ";
				?>
              <table class="table" width="100%">
                <thead>
                  <tr>
                    <th>Day and Date</th>
                    <th>AM</th>
                    <th>PM</th>
                    <th>ND</th>
                    <th>Notes</th>
                  </tr>
                </thead>
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_sd))."'";
				  		
						$fetchmon = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='mon'")); //This is for permanent
						
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <tr>
                    <td>MON <?= $this_week_sd; ?>
                      <input type="hidden" name="dt1" value="<?= $this_week_sd; ?>">
                      <input type="hidden" name="day1" value="mon">
					  
                      </td>
                    <td><select name="am1">
                        <option value="<?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm1">
                        <option value="<?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd1">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{} ?>">
                        <?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes1" value="<?php if($note != ""){echo $note;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
                <!--</form>
                <form name="" action="" method="post">-->
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($tue))."'";
				  
				  	$fetchtue = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='tue'")); //This is for permanent
					
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <tr>
                    <td>TUES <?= $tue ?>
                     <input type="hidden" name="dt2" value="<?= $tue ?>">
                      <input type="hidden" name="day2" value="tue">
					  
                      </td>
                    <td><select name="am2">
                        <option value="<?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm2">
                        <option value="<?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd2">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{} ?>">
                       
						 <?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes2" value="<?php if($note != ""){echo $note;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
               <!-- </form>
                <form name="" action="" method="post">-->
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($wed))."'";
				  
				  $fetchwed = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='wed'")); //This is for permanent
				  
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <tr>
                    <td>WED <?= $wed ?>
                      <input type="hidden" name="dt3" value="<?= $wed; ?>">
                      <input type="hidden" name="day3" value="wed">
					  <input type="hidden" name="week" value="1">
                      </td>
                    <td><select name="am3">
                        <option value="<?php if($pm){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm3">
                        <option value="<?php if($am){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd3">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{} ?>">
                        <?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes3" value="<?php if($note != ""){echo $note;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
                <!--</form>
				<form name="" action="" method="post">-->
                <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($thu))."'";
				
				$fetchthu = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='thu'")); //This is for permanent
				
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                
                  <tr>
                    <td>THUR <?= $thu ?>
                      <input type="hidden" name="dt4" value="<?= $thu; ?>">
                      <input type="hidden" name="day4" value="thu">
					  <input type="hidden" name="week" value="1">
                      </td>
                    <td><select name="am4">
                        <option value="<?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm4">
                        <option value="<?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd4">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{} ?>">
                        <?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes4" value="<?php if($note != ""){echo $note;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
               <!-- </form>
                <form name="" action="" method="post">-->
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($fri))."'";
				  
				  $fetchfri = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='fri'")); //This is for permanent
				  
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <tr>
                    <td>FRI <?= $fri ?>
                      <input type="hidden" name="dt5" value="<?= $fri ?>">
                      <input type="hidden" name="day5" value="fri">
					  <input type="hidden" name="week" value="1">
                      </td>
                    <td><select name="am5">
                        <option value="<?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm5">
                        <option value="<?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd5">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['nd'];}else{} ?>">
                        <?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes5" value="<?php if($note != ""){echo $note;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
               <!-- </form>
                <form name="" action="" method="post">-->
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($sat))."'";
				  
				  $fetchsat = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='sat'")); //This is for permanent
				  
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <tr>
                    <td>SAT <?= $sat ?>
                    <input type="hidden" name="dt6" value="<?= $sat ?>">
                      <input type="hidden" name="day6" value="sat">
					  <input type="hidden" name="week" value="1">
                      </td>
                    <td><select name="am6">
                        <option value="<?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm6">
                        <option value="<?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd6">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{} ?>">
                        <?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes6" value="<?php if($note != ""){echo $note;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
               <!-- </form>
                <form name="" action="" method="post">-->
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_ed))."'";
				  
				  $fetchsun = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='sun'")); //This is for permanent
				  
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <tr>
                    <td>SUN <?= $this_week_ed ?>
                      <input type="hidden" name="dt7" value="<?= $this_week_ed ?>">
                      <input type="hidden" name="day7" value="sun">
					  <input type="hidden" name="week" value="1">
                      </td>
                    <td><select name="am7">
                        <option value="<?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{} ?>">
                        <?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">&nbsp;YES</option>
                        <option value="NO">&nbsp;&nbsp;NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="pm7">
                        <option value="<?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['pm'];}else{} ?>">
                        <?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['pm'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><select name="nd7">
                        <option value="<?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['nd'];}else{} ?>">
                        <?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['nd'];}else{echo "select";} ?>
                        </option>
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        <option value="MAYBE">MAYBE</option>
                      </select></td>
                    <td><input type="text" name="stuffNotes7" value="<?php if($note != ""){echo $note;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['note'];} ?>"></td>
                    <td><input type="submit" name="staff_availablity1" value="Save" class="btn btn-info"></td>
                  </tr>
				  <tr><td colspan="6" style="text-align:center;"><input type="submit" name="staff_availablity1" value="Save All" class="btn btn-primary"></td></tr>
               
              </table>
              <font color="blue">Do you want to save this as your permanent availability? </font>
              <select name="permanant" onChange="">
                <option value="">Select</option>
                <option <?php if($fetchsun['permanent'] == 'YES'){echo 'selected';}?> value="YES">YES</option>
                <option <?php if($fetchsun['permanent'] == 'NO'){echo 'selected';}?> value="NO">NO</option>
              </select>
              <input type="submit" name="staff_availablity2" value="Save for Permanent" class="btn btn-info">
			  
		</form>
              <br>
              <br>
              <?php $mon = date("Y-m-d",strtotime(date("Y-m-d",$monday)." +7 days")); ?>
              <button type="button"  data-toggle="collapse" data-target="#demo2">Week started on
              <?= $mon; ?>
              </button>
              <div id="demo2" class="collapse"> 
                <!--  ----------------------------------------------------------------------------------------------------         -->
                <?php 
   			/*$givenDate="2016-06-06";
		   	echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime($givenDate)));
		   	echo "last Monday:". date('Y-m-d', strtotime('last monday', strtotime($givenDate)));
			echo "Previous Monday:". date('Y-m-d', strtotime('previous monday', strtotime($givenDate)));*/
		
		?>
						
						<?php
		$monday = strtotime("last monday");
		
		$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
		
		 $mon = date("d M Y",strtotime(date("Y-m-d",$monday)." +7 days"));
		 $tue = date("d M Y",strtotime(date("Y-m-d",$monday)." +8 days"));
		 $wed = date("d M Y",strtotime(date("Y-m-d",$monday)." +9 days"));
		 $thu = date("Y m d",strtotime(date("Y-m-d",$monday)." +10 days"));
		 $fri = date("d M Y",strtotime(date("Y-m-d",$monday)." +11 days"));
		 $sat = date("d M Y",strtotime(date("Y-m-d",$monday)." +12 days"));
		 $sun = date("d M Y",strtotime(date("Y-m-d",$monday)." +13 days"));
		
		$this_week_sd=$mon;
		$this_week_ed=$sun;
		 
		echo "Week Starting from $mon abd end on $sun ";
		?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Day and Date</th>
                      <th>AM</th>
                      <th>PM</th>
                      <th>ND</th>
                      <th>Notes</th>
                    </tr>
                  </thead>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_sd))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>MON <?= $this_week_sd; ?>
                        <input type="hidden" name="dt" value="<?= $this_week_sd; ?>">
                        <input type="hidden" name="day" value="mon">
						<input type="hidden" name="week" value="2">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($tue))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>TUES <?= $tue ?>
                        <input type="hidden" name="dt" value="<?= $tue ?>">
                        <input type="hidden" name="day" value="tue">
						<input type="hidden" name="week" value="2">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($wed))."'";
						$result = mysql_query($SqlUser);
						$am=$pm=$nd=$note='';
						while($row = mysql_fetch_array($result))
						{
						    $am=$row['am'];
							$pm=$row['pm'];
							$nd=$row['nd'];
							$note=$row['note'];}
					?>
                    <tr>
                      <td>WED <?= $wed ?>
                       <input type="hidden" name="dt" value="<?= $wed ?>">
                        <input type="hidden" name="day" value="wed">
						<input type="hidden" name="week" value="2">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($pm){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($am){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($thu))."'";
					$result = mysql_query($SqlUser);
					$am=$pm=$nd=$note='';
					while($row = mysql_fetch_array($result))
					{
						$am=$row['am'];
						$pm=$row['pm'];
						$nd=$row['nd'];
						$note=$row['note'];}
				?>
                  <form name="" action="" method="post">
                    <tr>
                      <td>THUR <?= $thu ?>
					  <input type="hidden" name="dt" value="<?= $thu ?>">
                        <input type="hidden" name="week" value="2">
                        <input type="hidden" name="day" value="thu">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($fri))."'";
						$result = mysql_query($SqlUser);
						$am=$pm=$nd=$note='';
						while($row = mysql_fetch_array($result))
						{
							$am=$row['am'];
							$pm=$row['pm'];
							$nd=$row['nd'];
							$note=$row['note'];}
					?>
                    <tr>
                      <td>FRI <?= $fri ?>
					  <input type="hidden" name="dt" value="<?= $fri ?>">
                        <input type="hidden" name="week" value="2">
                        <input type="hidden" name="day" value="fri">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($sat))."'";
						$result = mysql_query($SqlUser);
						$am=$pm=$nd=$note='';
						while($row = mysql_fetch_array($result))
						{
							$am=$row['am'];
							$pm=$row['pm'];
							$nd=$row['nd'];
							$note=$row['note'];}
					?>
                    <tr>
                      <td>SAT <?= $sat ?>
					  <input type="hidden" name="dt" value="<?= $sat ?>">
                       <input type="hidden" name="week" value="2">
                        <input type="hidden" name="day" value="sat">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_ed))."'";
					$result = mysql_query($SqlUser);
					$am=$pm=$nd=$note='';
					while($row = mysql_fetch_array($result))
					{
						$am=$row['am'];
						$pm=$row['pm'];
						$nd=$row['nd'];
						$note=$row['note'];}
			?>
                    <tr>
                      <td>SUN <?= $this_week_ed ?>
					  <input type="hidden" name="dt" value="<?= $this_week_ed ?>">
                       <input type="hidden" name="week" value="2">
                        <input type="hidden" name="day" value="sun">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                </table>
                
                <!--  ----------------------------------------------------------------------------------------------------         --> 
                
              </div>
              <br>
              <br>
              <?php $mon = date("Y-m-d",strtotime(date("Y-m-d",$monday)." +14 days")); ?>
              <button type="button"  data-toggle="collapse" data-target="#demo3">Week started on
              <?= $mon ?>
              </button>
              <div id="demo3" class="collapse"   style="border-radius:5px;border:1px solid #09F;padding:10px;"> 
                <!--  ----------------------------------------------------------------------------------------------------         -->
                <?php 
				   /*$givenDate="2016-06-06";
				   echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime($givenDate)));
				   echo "last Monday:". date('Y-m-d', strtotime('last monday', strtotime($givenDate)));
					echo "Previous Monday:". date('Y-m-d', strtotime('previous monday', strtotime($givenDate)));*/
				
				?>
                
				<?php
				$monday = strtotime("last monday");
				
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				
				 $mon = date("d M Y",strtotime(date("Y-m-d",$monday)." +14 days"));
				 $tue = date("d M Y",strtotime(date("Y-m-d",$monday)." +15 days"));
				 $wed = date("d M Y",strtotime(date("Y-m-d",$monday)." +16 days"));
				 $thu = date("d M Y",strtotime(date("Y-m-d",$monday)." +17 days"));
				 $fri = date("d M Y",strtotime(date("Y-m-d",$monday)." +18 days"));
				 $sat = date("d M Y",strtotime(date("Y-m-d",$monday)." +19 days"));
				 $sun = date("d M Y",strtotime(date("Y-m-d",$monday)." +20 days"));
				
				$this_week_sd=$mon;
				$this_week_ed=$sun;
				 
				echo "Week Starting from $mon and end on $sun ";
				?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Day and Date</th>
                      <th>AM</th>
                      <th>PM</th>
                      <th>ND</th>
                      <th>Notes</th>
                    </tr>
                  </thead>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_sd))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>MON <?= $this_week_sd; ?>
					  <input type="hidden" name="dt" value="<?= $this_week_sd ?>">
                        <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="mon">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($tue))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>TUES <?= $tue ?>
					  	<input type="hidden" name="dt" value="<?= $tue ?>">
                         <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="tue">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($wed))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>WED <?= $wed ?>
					  <input type="hidden" name="dt" value="<?= $wed ?>">
                        <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="wed">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($pm){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($am){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($thu))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <form name="" action="" method="post">
                    <tr>
                      <td>THUR <?= $thu ?>
					  	<input type="hidden" name="dt" value="<?= $thu ?>">
                         <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="thu">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($fri))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>FRI <?= $fri ?>
					  <input type="hidden" name="dt" value="<?= $fri ?>">
                         <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="fri">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($sat))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>SAT <?= $sat ?>
					  <input type="hidden" name="dt" value="<?= $sat ?>">
                        <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="sat">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_ed))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>SUN <?= $this_week_ed ?>
					  	<input type="hidden" name="dt" value="<?= $this_week_ed ?>">
                         <input type="hidden" name="week" value="3">
                        <input type="hidden" name="day" value="sun">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsun['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                </table>
                
                <!--  ----------------------------------------------------------------------------------------------------         --> 
                
              </div>
			  
			  <br/>
			  <br/>
			   <?php $mon = date("Y-m-d",strtotime(date("Y-m-d",$monday)." +21 days")); ?>
              <button type="button"  data-toggle="collapse" data-target="#demo33">Week started on
              <?= $mon ?>
              </button>
              <div id="demo33" class="collapse"   style="border-radius:5px;border:1px solid #09F;padding:10px;"> 
                <!--  ----------------------------------------------------------------------------------------------------         -->
                <?php 
				   /*$givenDate="2016-06-06";
				   echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime($givenDate)));
				   echo "last Monday:". date('Y-m-d', strtotime('last monday', strtotime($givenDate)));
					echo "Previous Monday:". date('Y-m-d', strtotime('previous monday', strtotime($givenDate)));*/
				
				?>
                
				<?php
				$monday = strtotime("last monday");
				
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				
				 $mon = date("d M Y",strtotime(date("Y-m-d",$monday)." +21 days"));
				 $tue = date("d M Y",strtotime(date("Y-m-d",$monday)." +22 days"));
				 $wed = date("d M Y",strtotime(date("Y-m-d",$monday)." +23 days"));
				 $thu = date("d M Y",strtotime(date("Y-m-d",$monday)." +24 days"));
				 $fri = date("d M Y",strtotime(date("Y-m-d",$monday)." +25 days"));
				 $sat = date("d M Y",strtotime(date("Y-m-d",$monday)." +26 days"));
				 $sun = date("d M Y",strtotime(date("Y-m-d",$monday)." +27 days"));
				
				$this_week_sd=$mon;
				$this_week_nd=$sun;
				 
				echo "Week Starting from $mon and end on $sun ";
				?>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Day and Date</th>
                      <th>AM</th>
                      <th>PM</th>
                      <th>ND</th>
                      <th>Notes</th>
                    </tr>
                  </thead>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_sd))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>MON <?= $this_week_sd; ?>
					  	<input type="hidden" name="dt" value="<?= $this_week_sd ?>">
                        <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="mon">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchmon['permanent']=='YES'){echo $fetchmon['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($tue))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>TUES <?= $tue ?>
					  	<input type="hidden" name="dt" value="<?= $tue ?>">
                         <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="tue">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchtue['permanent']=='YES'){echo $fetchtue['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($wed))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>WED <?= $wed ?>
					  	<input type="hidden" name="dt" value="<?= $wed ?>">
                        <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="wed">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($pm){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($am){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchwed['permanent']=='YES'){echo $fetchwed['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($thu))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                  <form name="" action="" method="post">
                    <tr>
                      <td>THUR <?= $thu ?>
					  	<input type="hidden" name="dt" value="<?= $thu ?>">
                         <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="thu">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchthu['permanent']=='YES'){echo $fetchthu['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($fri))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>FRI <?= $fri ?>
					  	<input type="hidden" name="dt" value="<?= $fri ?>">
                         <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="fri">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchfri['permanent']=='YES'){echo $fetchfri['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($sat))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>SAT <?= $sat ?>
					  	<input type="hidden" name="dt" value="<?= $sat ?>">
                        <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="sat">
                         </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchsat['permanent']=='YES'){echo $fetchsat['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                  <form name="" action="" method="post">
                    <?php $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".date('Y-m-d', strtotime($this_week_ed))."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
                    <tr>
                      <td>SUN <?= $this_week_ed ?>
					  	<input type="hidden" name="dt" value="<?= $this_week_ed ?>">
                         <input type="hidden" name="week" value="4">
                        <input type="hidden" name="day" value="sun">
                        </td>
                      <td><select name="am">
                          <option value="<?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{} ?>">
                          <?php if($am){echo $am ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['am'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">&nbsp;YES</option>
                          <option value="NO">&nbsp;&nbsp;NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="pm">
                          <option value="<?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['pm'];}else{} ?>">
                          <?php if($pm){echo $pm ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['pm'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><select name="nd">
                          <option value="<?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['nd'];}else{} ?>">
                          <?php if($nd){echo $nd ;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['nd'];}else{echo "select";} ?>
                          </option>
                          <option value="YES">YES</option>
                          <option value="NO">NO</option>
                          <option value="MAYBE">MAYBE</option>
                        </select></td>
                      <td><input type="text" name="stuffNotes" value="<?php if($note != ""){echo $note;}elseif($fetchsun['permanent']=='YES'){echo $fetchsun['note'];} ?>"></td>
                      <td><input type="submit" name="staff_availablity" value="Save" class="btn btn-info"></td>
                    </tr>
                  </form>
                </table>
                
                <!--  ----------------------------------------------------------------------------------------------------         --> 
                
              </div>
<script>
	function show_dates() {
		str=document.getElementById("selected_date").value;
		if (str.length == 0) { 
			document.getElementById("txtHint").innerHTML = "";
			return;
		} else {
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("ajaxDiv").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "getdates.php?q=" + str, true);
			xmlhttp.send();
		}
	}
</script> 
              <br>
              <br>
              Go to the week with date
              <input type="text" name="" id="selected_date" style="height:30px; line-height:30px; background-color:#999966; color:#FFF; padding-left:7px;">
              <input type="button" value="Show" class="btn btn-info" onClick="show_dates()">
              <div id="ajaxDiv"> </div>
              <br>
            </div>
			<br/>
			 <button type="button"  data-toggle="collapse" data-target="#demo44"  style="width:200px; margin-top:3px;">Allocated shifts</button>
            <div id="demo44" class="collapse"   style="border-radius:5px;border:1px solid #09F;padding:10px;"> <b>Allocated shifts</b> <br>
            <table class="table" style="border-bottom:1px solid #000; border-top:1px solid #000;">
              <thead>
                <tr>
                  <th>#</th>
				  <th>Client Name</th>
                  <th>Location</th>
                  <th>Role</th>
                  <th style="width:15%;">Date/Time</th>
                  <th>Penalties</th>
                  <th style="width:7%;">For More</th>
                 <!-- <th style="width:22%;">Upload Timesheet</th>-->
                </tr>
              </thead>
              <tbody>
           <?php 
		   $qty = 1;
		   
		   //$sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '".$_SESSION['userid']."'");
		    $sql = mysql_query("SELECT sas.*, ur.FirstName, ur.LastName FROM staff_available_shift as sas INNER JOIN hr_user_registration as ur ON sas.clientId=ur.Uid AND sas.accept_staffid = '".$_SESSION['userid']."' AND sas.shiftEndTime > NOW() AND sas.status = 'Unprocessed' ORDER BY sas.date DESC");
		   while($rowdest = mysql_fetch_array($sql))
		   {
		   ?>
              <tr >
                  <td><?=$qty;?></td>
				  <td ><div class="videoWrapper">
                      <?=$rowdest['FirstName'].' '.$rowdest['LastName']?>
                    </div></td>
                  <td ><div class="videoWrapper">
                      <?=$rowdest['location']?>
                    </div></td>
                  <td><div class="videoWrapper">
                      <?=stripslashes($rowdest['role']);?>
                    </div></td>
                  <td ><div class="videoWrapper">
                      <?=date('d M Y', strtotime($rowdest['date']))?>
                      <br/>
                      <?=date('l', strtotime($rowdest['date']))?><br/>
                    Shift<br/> Start : <?php echo $rowdest['start_time'];?><br/>
                      Finish : <?php echo $rowdest['end_time'];?>
                    </div></td>
                  
                  <td ><div class="videoWrapper"><?php echo stripslashes($rowdest['penalties']);?></div></td>
                  
                  
                 <td>
                 
                  <button class="glyphicon glyphicon-hand-right" aria-hidden="true" data-toggle="collapse" data-target="#moreinf<?=$qty;?>" title="More Info"  style="color:blue;"></button></td>
                <!-- <td style="width:20%; text-align:right;">
				 <?php if($rowdest['timeSheets'] != ""){?>
				 	<a href="download.php?path=Timesheet&file=<?=$rowdest['timeSheets'];?>" title="Download Timesheet"><img src="img/time_sheet.png" height="50px;"></a>
				 <?php }else{?>
				 <form action="ajax/addTimesheet.php" method="post" id="upload-timesheet<?=$qty;?>" enctype="multipart/form-data">
				 	<input type="hidden" name="id" value="<?=$rowdest['id'];?>">
                 	<input type="file" name="sheet" value="upload">
                    <button type="button" name="upload" id="timesheet<?=$qty;?>" class="btn btn-info">Submit</button>
				</form>
				<?php }?>
                 </td>-->
                 
                </tr>
                <tr>
                	<td colspan="7">
                    <div class="row collapse" id="moreinf<?=$qty;?>" style="padding-left:10px;">
                    <p style="color:#000; font-size:18px; font-weight:bold;">More Information</p>
					
                    <?php echo stripslashes($rowdest['more_info']);?>
                    </div>
                    </td>
                </tr>
                
                
				<!--<script type="text/javascript">
					$('#timesheet<?=$qty?>').click(function(){
						$('#upload-timesheet<?=$qty?>').ajaxForm({
							target:'#demo4',
							beforeSubmit:function(e){
								//$('.uploading').show();
							},
							success:function(e){
								//$('.uploading').hide();
								//break 1;
							},
							error:function(e){
							}
						}).submit();
					});
				  </script>-->
				
				<?php
					$qty++;
				 } ?>
              
              </tbody>
              
            </table>
              
            </div>
            <br>
            <button type="button"  data-toggle="collapse" data-target="#demo4"  style="width:200px; margin-top:3px;">Completed shifts</button>
            <div id="demo4" class="collapse"   style="border-radius:5px;border:1px solid #09F;padding:10px;"> <b>Completed shifts</b> <br>
            <table class="table" style="border-bottom:1px solid #000; border-top:1px solid #000;">
              <thead>
                <tr>
                  <th>#</th>
				  <th>Client Name</th>
                  <th>Location</th>
                  <th>Role</th>
                  <th style="width:15%;">Date/Time</th>
                  <th>Penalties</th>
                  <th style="width:7%;">For More</th>
                  <th style="width:22%;">Upload Timesheet</th>
                </tr>
              </thead>
              <tbody>
           <?php 
		   $qty = 1;
		   
		   //$sql = mysql_query("SELECT * FROM staff_available_shift WHERE accept_staffid = '".$_SESSION['userid']."'");
		    $sql = mysql_query("SELECT sas.*, ur.FirstName, ur.LastName FROM staff_available_shift as sas INNER JOIN hr_user_registration as ur ON sas.clientId=ur.Uid AND sas.accept_staffid = '".$_SESSION['userid']."' AND sas.shiftEndTime < NOW() AND sas.status = 'Unprocessed' ORDER BY sas.date DESC");
		   while($rowdest = mysql_fetch_array($sql))
		   {
		   ?>
              <tr >
                  <td><?=$qty;?></td>
				  <td ><div class="videoWrapper">
                      <?=$rowdest['FirstName'].' '.$rowdest['LastName']?>
                    </div></td>
                  <td ><div class="videoWrapper">
                      <?=$rowdest['location']?>
                    </div></td>
                  <td><div class="videoWrapper">
                      <?=stripslashes($rowdest['role']);?>
                    </div></td>
                  <td ><div class="videoWrapper">
                      <?=date('d M Y', strtotime($rowdest['date']))?>
                      <br/>
                      <?=date('l', strtotime($rowdest['date']))?><br/>
                    Shift<br/> Start : <?php echo $rowdest['start_time'];?><br/>
                      Finish : <?php echo $rowdest['end_time'];?>
                    </div></td>
                  
                  <td ><div class="videoWrapper"><?php echo stripslashes($rowdest['penalties']);?></div></td>
                  
                  
                 <td>
                 
                  <button class="glyphicon glyphicon-hand-right" aria-hidden="true" data-toggle="collapse" data-target="#mreinf<?=$qty;?>" title="More Info"  style="color:blue;"></button></td>
                 <td style="width:20%; text-align:right;">
				 <?php if($rowdest['timeSheets'] != ""){?>
				 	<a href="download.php?path=Timesheet&file=<?=$rowdest['timeSheets'];?>" title="Download Timesheet"><img src="img/time_sheet.png" height="50px;"></a>
				 <?php }else{?>
				 <form action="ajax/addTimesheet.php" method="post" id="upload-timesheet<?=$qty;?>" enctype="multipart/form-data">
				 	<input type="hidden" name="id" value="<?=$rowdest['id'];?>">
                 	<input type="file" name="sheet" value="upload">
                    <button type="button" name="upload" id="timesheet<?=$qty;?>" class="btn btn-info">Submit</button>
				</form>
				<?php }?>
                 </td>
                 
                </tr>
                <tr>
                	<td colspan="8">
                    <div class="row collapse" id="mreinf<?=$qty;?>" style="padding-left:10px;">
                    <p style="color:#000; font-size:18px; font-weight:bold;">More Information</p>
					
                    <?php echo stripslashes($rowdest['more_info']);?>
                    </div>
                    </td>
                </tr>
                
                
				<script type="text/javascript">
					$('#timesheet<?=$qty?>').click(function(){
						$('#upload-timesheet<?=$qty?>').ajaxForm({
							target:'#demo4',
							beforeSubmit:function(e){
								//$('.uploading').show();
							},
							success:function(e){
								//$('.uploading').hide();
								//break 1;
							},
							error:function(e){
							}
						}).submit();
					});
				  </script>
				
				<?php
					$qty++;
				 } ?>
              
              </tbody>
              
            </table>
              
            </div>
            <br>
            <button type="button"  data-toggle="collapse" data-target="#demo5" style="width:200px; margin-top:3px;"> My Preferences</button>
            <div id="demo5" class="collapse"   style="border-radius:5px;border:1px solid #09F;padding:10px;"> <b> My Preferences </b><br>
              <br>
              <?php if(isset($_POST["submit_dtl"]))
				   {
					   mysql_query("UPDATE hr_staff_registration SET 
									   	offerMeNum = '".$_POST["offerMeNum"]."',
									   	offerMeUnit =  '".$_POST["offerMeUnit"]."',
									   	after10pm =  '".$_POST["after10pm"]."',
										before6am =  '".$_POST["before6am"]."',
										travel =  '".$_POST["travel"]."',
										text_me =  '".$_POST["text_me"]."'
									   	WHERE Uid = '".$_SESSION["userid"]."'
										   ");
					   
				   }
	    		$SqlUser = "SELECT offerMeNum,offerMeUnit,after10pm,before6am,travel,text_me FROM hr_staff_registration  WHERE Uid = '".$_SESSION["userid"]."'";
				$result = mysql_query($SqlUser) or die(mysql_error());;
				
				while($row = mysql_fetch_array($result))
				{$offerMeNum=$row['offerMeNum'];$offerMeUnit=$row['offerMeUnit'];$after10pm=$row['after10pm'];$before6am=$row['before6am'];
				$travel=$row['travel'];$text_me=$row['text_me'];
				}
		
	   ?>
              <form action="" method="post">
                Offer me shifts up to
                <select name="offerMeNum" style="background-color:#D2FDFF;">
                  <option value="<?= $offerMeNum; ?>">
                  <?= $offerMeNum; ?>
                  </option>
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="70">70</option>
                  <option value="90">90</option>
                </select>
                <select name="offerMeUnit" style="background-color:#D2FDFF;">
                  <option value="<?= $offerMeUnit ?>">
                  <?= $offerMeUnit ?>
                  </option>
                  <option value="km">KM</option>
                  <option value="minute">Minute</option>
                </select>
                from my residence.</b>
                <input type="submit" class="btn btn-info" name="submit_dtl" value="save">
                <br>
                <br>
                Allocators can call me after 10pm?</b>
                <select name="after10pm" style="background-color:#D2FDFF">
                  <option value="<?= $after10pm ?>">
                  <?= $after10pm ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
                <input type="submit" class="btn btn-info" name="submit_dtl"  value="save">
                <br>
                <br>
                Allocators can call me before 6am?</b>
                <select name="before6am" style="background-color:#D2FDFF;">
                  <option value="<?= $before6am ?>">
                  <?= $before6am ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
                <input type="submit" class="btn btn-info" name="submit_dtl"  value="save">
                <br>
                <br>
                Allocators should text me notifications for shift broadcast?</b>
                <select name="text_me" style="background-color:#D2FDFF;">
                  <option value="<?= $text_me ?>">
                  <?= $text_me ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
                <input type="submit"  class="btn btn-info" name="submit_dtl"  value="save">
                <br>
                <br>
                I am willing to travel to regional places if reimbursed for travel & accommodation?</b>
                <select name="travel"  style="background-color:#D2FDFF;">
                  <option value="<?= $travel ?>">
                  <?= $travel ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
                <input class="btn btn-info" name="submit_dtl" type="submit" value="save">
              </form>
              <br>
              <br>
              <b> Do not offer me shifts from: </b>
              <table class="table">
                <tr>
                  <td><b>Facility/Ward/Specialty</b></td>
                  <td><b>Requested by:</b></td>
                </tr>
                <tr>
                  <td>[Click here to add]</td>
                  <td> N/A</td>
                </tr>
              </table>
              
              <!-- ------------------------------------------------------------------------------------------------------ --> 
              
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
		/********************Staff Response****************/
	function staffresponse(stat,id,staffid)
	{
		window.location.href="ajax/staffresponse.php?stat="+stat+"&id="+id+"&staffid="+staffid;
		//$.post('ajax/staffresponse.php',{ stat : stat , id : id , staffid : staffid});
	}
</script>
</body>
</html>