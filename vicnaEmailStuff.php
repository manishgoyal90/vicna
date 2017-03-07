<?php
session_start();
if($_SESSION["userid"]){}else{header('Location: login1.php');exit();}
	


	include"config/connect.php";
//---------------upload doc start------------
if(isset($_POST['submit_doc']) and $_POST["title"]){
 
define ("MAX_SIZE","1000000"); 
function getExtension($str)
{
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $l = strlen($str) - $i;
	 $ext = substr($str,$i+1,$l);
	 return $ext;
}
 
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

		mysql_query("INSERT INTO documents (id, path, title, description, userId, date) VALUES (NULL, '".$newname."', '".mysql_real_escape_string($_POST["title"])."', '".mysql_real_escape_string($_POST["description"])."', '".$_SESSION["userid"]."', now());");
	
//------------------------------------------------------
}

//---------------upload doc end------------
	
	if (isset($_POST['submit']) and $_POST["FirstName"])
	{
		$msg="<div style='margin:10px;'>updated.</div>";
	$SqlUpdate = "UPDATE hr_staff_registration SET FirstName = '".$_POST["FirstName"]."',LastName= '".$_POST["LastName"]."',
	Address='".$_POST["Address"]."',homePhone='".$_POST["homePhone"]."',
	mobile='".$_POST["mobile"]."',Password='".base64_encode($_POST["Password"])."'
	,dob='".$_POST["dob"]."',
	AHPRAReg='".$_POST["AHPRAReg"]."',AHPRARegExp='".$_POST["AHPRARegExp"]."',
	basicLifeSupport='".$_POST["basicLifeSupport"]."',basicLifeSupportExp='".$_POST["basicLifeSupportExp"]."',
	policeCheck='".$_POST["policeCheck"]."',policeCheckExp='".$_POST["policeCheckExp"]."',
	WWC='".$_POST["WWC"]."',WWCExp='".$_POST["WWCExp"]."'	
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
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('#myTable').dataTable();
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
          <div class="card-background"> <img class="card-bkimg" alt="" src=""> </div>
          <div class="useravatar"> <img alt="" src="<?=$pic?>"> </div>
          <div class="card-info"> <span class="card-title"><?php echo $FirstName ." ".$LastName; ?></span> </div>
        </div>
        <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" id="profile" class="btn btn-default"  onclick="location.href = 'profileStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <div class="hidden-xs">Profile</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'allocationsStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <div class="hidden-xs">Allocations</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button"  class="btn btn-default"  onclick="location.href = 'payrollStuff.php';"data-toggle="tab"> <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
            <div class="hidden-xs">Payroll</div>
            </button>
          </div>
          <div class="btn-group" role="group">
            <button type="button"  class="btn btn-primary"  onclick="location.href = 'vicnaEmailStuff.php';" data-toggle="tab"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
            <div class="hidden-xs">My VICNA Email</div>
            </button>
          </div>
        </div>
        <div class="well">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
              <h3>VicnaMails</h3>
              <!-- ------------------------------------------------------------------------------------------------------ -->
              
              <?php  
		
		//echo "IIIIIII".$_SESSION['userid'];
		echo "<div style='margin:10px'>$msg_upload</div>";
				/* $SqlUser = "SELECT * FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result = mysql_query($SqlUser) or die(mysql_error());
				while($row = mysql_fetch_array($result))
				{
					$FirstName=$row['FirstName'];$LastName=$row['LastName'];$UserName=$row['UserName'];$EmailId=$row['FirstName'];
					
				}*/
				
                ?>
             <div class="row" style="background-color:#D2FCFF; height:50px; padding:15px; border-bottom:1px solid #00F; border-top:1px solid #00F;" align="center">
                <div class="col-sm-1"><a href="<?=basename($_SERVER["PHP_SELF"]);?>" title="Refresh" style="text-decoration:nome; color:#000;"><span class="glyphicon glyphicon-refresh"></span></a></div>
                <div class="col-sm-1"><a href="vicnaSentMail.php" title="Sent" style="text-decoration:nome; color:#000;"><span class="glyphicon glyphicon-export"></span></a></div>
                <div class="col-sm-1"><span class="glyphicon glyphicon-arrow-left"></span></div>
                <div class="col-sm-1"><a href="vicnaComposeMail.php" title="Compose" style="text-decoration:nome; color:#000;"><span class="glyphicon glyphicon-pencil"></span></a></div>
                <div class="col-sm-1"><span class="glyphicon glyphicon-user"></span></div>
                <div class="col-sm-1"><span class="glyphicon glyphicon-send"></span></div>
                <div class="col-sm-1"><span class="glyphicon glyphicon-remove"></span></div>
              </div>
              <div class="row">
			  <?php
			  $sql1 = "SELECT * FROM mailing WHERE mail_to = '".$row['vicnaEmail']."' AND mail_status = 'ur' AND del_status = '0'";
				$result1 = mysql_query($sql1);
				$unread = mysql_num_rows($result1);
			  ?>
                <div class="col-sm-2" style="background-color:#D2FCFF; min-height:500px;"><br>
                  <!-------------------------------------------------------------------------------->
                  <a style="text-decoration:none;" href="vicnaComposeMail.php"> <div class="row" style="padding:5px;"><span class="glyphicon glyphicon-pencil"></span>Compose</div></a>
                  <a style="text-decoration:none;" href="vicnaEmailStuff.php"> <div class="row" style="padding:5px;  background-color:#CCC;"><span class="glyphicon glyphicon-inbox"></span>Inbox (<?=$unread;?>)</div></a>
                  <a style="text-decoration:none;" href="vicnaDraftMail.php"><div class="row" style="padding:5px;"><span class="glyphicon glyphicon-briefcase"></span> Drafts</div></a>
                  <a style="text-decoration:none;" href="vicnaSentMail.php"><div class="row" style="padding:5px;"><span class="glyphicon glyphicon-export"></span> Sent</div></a>
                  <a style="text-decoration:none;" href="vicnaDeleteMail.php"><div class="row" style="padding:5px;"><span class="glyphicon glyphicon-trash"></span> Trash</div></a>
                  <!--------------------------------------------------------------------------------> 
                </div>
                <div class="col-sm-10" style="padding:10px;"> 
					<div class="table-responsive" id="tablesec">
						<table id="myTable" class="display table" width="100%" >
							<thead>
								<tr>
									
									<th>Subject</th>
									<th>From</th>
									<th>Date</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
						<?php 
							$sql = "SELECT * FROM mailing WHERE mail_to = '".$row['vicnaEmail']."' AND del_status = '0'";
							$result = mysql_query($sql);
							while($fetch = mysql_fetch_array($result))
							{
						?>
								
								<tr>
									
									<td><a style="text-decoration:none; <?php if($fetch['mail_status'] == 'ur'){echo 'color:#000; font-weight:bold;';}else{echo 'color:#000;';}?>" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=inbox"><?=$fetch['mail_subject'];?></a></td>
									<td><a style="text-decoration:none; <?php if($fetch['mail_status'] == 'ur'){echo 'color:#000; font-weight:bold;';}else{echo 'color:#000;';}?>" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=inbox"><?=$fetch['mail_from'];?></a></td>
									<td><a style="text-decoration:none; <?php if($fetch['mail_status'] == 'ur'){echo 'color:#000; font-weight:bold;';}else{echo 'color:#000;';}?>" href="vicnaMailText.php?mail_id=<?=base64_encode($fetch['mail_id']);?>&mail=inbox"><?=date('D H:i:s', strtotime($fetch['mail_date']));?></a></td>
									<td align="center"><a href="" style="text-decoration:none;" onClick="deleteone(<?=$fetch['mail_id']?>);" ><span class="glyphicon glyphicon-trash"></span></a></td>
								
								</tr>
								
						<?php
							}
						?>	
							<tbody>
						</table>
					</div>
				
				</div>
              </div>
              
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
<script>

    jQuery(document).ready(function() {
        // initiate layout and plugins
        App.init();
        UIModals.init();
        //TableManaged.init();
    });

    /********************Delete****************/
    function deleteone(id)
    {
        var cnf = confirm("Are you sure to delete?");

        if (cnf)
        {
            $('.portlet .tools a.reload').click();
            $.post('ajax/delmail.php', {feedid: id, mode: 'single'},
            function(data)
            {//deletecinematic
                $('#tablesec').html(data);
                /************************************ Table JS ************************************/
                $('#myTable').dataTable({
                    "aLengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "All"]
                    ],
                    // set the initial value
                    "iDisplayLength": 15,
                    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ records per page",
                        "oPaginate": {
                            "sPrevious": "Prev",
                            "sNext": "Next"
                        }
                    },
                    "aoColumnDefs": [{
                            'bSortable': false,
                            'aTargets': [0]
                        }]
                });

                jQuery('#myTable .group-checkable').change(function() {
                    var set = jQuery(this).attr("data-set");
                    var checked = jQuery(this).is(":checked");
                    jQuery(set).each(function() {
                        if (checked) {
                            $(this).attr("checked", true);
                        } else {
                            $(this).attr("checked", false);
                        }
                    });
                    jQuery.uniform.update(set);
                });

                var test = $("input[type=checkbox]:not(.toggle), input[type=radio]:not(.toggle, .star)");
                if (test) {
                    test.uniform();
                }

                $(".chosen").chosen();

                /************************************ Table JS ************************************/
            }
            );
        }
    }
    
    
</script>
</body>
</html>