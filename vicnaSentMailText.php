<?php
include"config/connect.php";
if($_SESSION["userid"]){}else{header('Location: login1.php');exit();}
	


	
	
	if (isset($_REQUEST['mail_id']) && $_REQUEST['mail'] == 'inbox')
	{
		
		$update = "UPDATE mailing SET mail_status='r' 
										  WHERE mail_id = '".base64_decode($_REQUEST['mail_id'])."'";

		$result = mysql_query($update);
		
	}
				
				$SqlUser = "SELECT * FROM hr_staff_registration WHERE Uid = ".$_SESSION['userid']."";
				$result = mysql_query($SqlUser);
				
				
				$row = mysql_fetch_array($result);
				
					$FirstName=$row['FirstName'];
					$LastName=$row['LastName'];
					$vicnaMail = $row['vicnaEmail'];
				
				
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
<link rel="stylesheet" type="text/css" href="admin/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<noscript>
<link rel="stylesheet" type="text/css" href="css/styleNoJS.css" />
</noscript>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
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
                  <a style="text-decoration:none;" href="vicnaComposeMail.php"><div class="row" style="padding:5px;"><span class="glyphicon glyphicon-pencil"></span> Compose</div></a>
                  <a style="text-decoration:none;" href="vicnaEmailStuff.php"> <div class="row" style="padding:5px;<?php if($_REQUEST['mail'] == 'inbox'){echo ' background-color:#CCC;';} ?>"><span class="glyphicon glyphicon-inbox"></span>Inbox (<?=$unread;?>)</div></a>
                  <a style="text-decoration:none;" href="vicnaDraftMail.php"><div class="row" style="padding:5px;"><span class="glyphicon glyphicon-briefcase"></span> Drafts</div></a>
                  <a style="text-decoration:none;" href="vicnaSentMail.php"> <div class="row" style="padding:5px;<?php if($_REQUEST['mail'] == 'sent'){echo ' background-color:#CCC;';} ?>"><span class="glyphicon glyphicon-export"></span>Sent</div></a>
                  <a style="text-decoration:none;" href="vicnaDeleteMail.php"><div class="row" style="padding:5px;"><span class="glyphicon glyphicon-trash"></span> Trash</div></a>
                  <!--------------------------------------------------------------------------------> 
                </div>
				<?php 
					
					$fetch = mysql_fetch_array(mysql_query("SELECT * FROM sent_mailing WHERE mail_id = '".base64_decode($_REQUEST['mail_id'])."'"));
				?>
                <div class="col-sm-10" style="padding-left:0px; padding-right:0px;"> 
                	<form action="" method="post" enctype="multipart/form-data">
					<div style="padding:10px; background-color:#ddd; border-bottom:1px solid #666;">
						<div class="row" style="margin-bottom:3px;">
                        	<div class="col-sm-12" style="font-size:20px; font-weight:bold;"><?=$fetch['mail_subject'];?></div>
                        </div>
                    	<div class="row" style="margin-bottom:3px;">
                        	<div class="col-sm-2">From </div>
                            <div class="col-sm-10"><?=$fetch['mail_from'];?></div>
                        </div>
                        <div class="row" style="margin-bottom:3px;">
                        	<div class="col-sm-2">To </div>
                            <div class="col-sm-10"><?=$fetch['mail_to'];?></div>
                        </div>
						<div class="row" style="margin-bottom:3px;">
                        	<div class="col-sm-2">Date </div>
                            <div class="col-sm-10"><?=date('D H:i:s', strtotime($fetch['mail_date']));?></div>
                        </div>
                     </div>   
                        <div class="row" style="margin-top:20px; margin-left:1px; margin-right:1px;">
                        	 <div class="col-sm-12" style="min-height:250px;"><?=stripslashes($fetch['mail_body']);?></div>
                        </div>
                         
                    
                    </form>
                
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
		  // UIModals.init();
		   //TableManaged.init();
		   tinymce.init({
			selector: "#mail_body",
			/*height:500,*/
			plugins: [
				 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor"
		   ],
		   toolbar: "insertfile undo redo | styleselect | bold italic | fontselect | fontsizeselect | sizeselect |  alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
		   style_formats: [
				{title: 'Bold text', inline: 'b'},
				{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
				{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
				{title: 'Example 1', inline: 'span', classes: 'example1'},
				{title: 'Example 2', inline: 'span', classes: 'example2'},
				{title: 'Table styles'},
				{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			]

		});
		});
</script>
</body>
</html>