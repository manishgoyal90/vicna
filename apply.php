<?php  include"config/connect.php";

if(isset($_POST['submit']))
{	


/*********************File Upload Start**********************************/
	if(isset($_FILES['cv_file']['name']) && $_FILES['cv_file']['name']!=''){
		  $errors= array();
		  $file_name = $_FILES['cv_file']['name'];
		  $file_size =$_FILES['cv_file']['size'];
		  $file_tmp =$_FILES['cv_file']['tmp_name'];
		  $file_type=$_FILES['cv_file']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['cv_file']['name'])));
		  $date_time = date('dmY').'_'.date('His');
		  $file_name = $title.'-'.$date_time.'.'.$file_ext;
		  $expensions= array("pdf", "JPEG", "JPG", "jpeg", "jpg", "doc", "PNG", "png", "docx");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]='extension not allowed, please choose pdf, JPEG, JPG, jpeg, jpg, doc, PNG, png OR docx file.';
		  }else{
			if($file_size > 20971520){
				$errors[]='File size must be excately 2 MB';
			}
		  }
		  
		  if(empty($errors)==true){
			 move_uploaded_file($file_tmp,"apply/".$file_name);
			 
		  }
   	}
	
	
	
	/********************* File Upload End ***********************************/
//---------------------end upload file-----------------
$_POST["dob"]=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
$q="INSERT INTO hr_apply (id, first_name, last_name, dob,email, phone, street_address, country, city, post_code, qualification, work_eligibility, experience, register_ahpra,cv, comments, apply_date, status) VALUES 
(NULL, 
 '".mysql_real_escape_string($_POST["name"])."',
 '".mysql_real_escape_string($_POST["surname"])."',
 '".mysql_real_escape_string($_POST["dob"])."',
 '".mysql_real_escape_string($_POST["email"])."',
 '".mysql_real_escape_string($_POST["phone"])."',
 '".mysql_real_escape_string($_POST["address"])."',
 '".mysql_real_escape_string($_POST["countries"])."',
 '".mysql_real_escape_string($_POST["city"])."',
 '".mysql_real_escape_string($_POST["pin"])."',
 '".mysql_real_escape_string($_POST["qualification"])."',
 '".mysql_real_escape_string($_POST["work_eligibility"])."',
 '".mysql_real_escape_string($_POST["expn"])."',
 '".mysql_real_escape_string($_POST["register_ahpra"])."',
 '".$file_name."',
 '".mysql_real_escape_string($_POST["message"])."',
 now(),'1');";
		
		$result = mysql_query($q) or die("errorp: ".mysql_error()) ;
	if($result){$r=1;}
	else{$r=0;}


//	echo 'x';
header('location:thank.php?r='.$r);

}

?>
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
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/modernizr.custom.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="dist/jquery.date-dropdowns.js"></script>
<link href="demo/styles.css" rel="stylesheet">
<noscript>
<link rel="stylesheet" type="text/css" href="css/styleNoJS.css" />
</noscript>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
	   .jv {
    background: #fff none repeat scroll 0 0;
    border: 2px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
}
.jv select {
    border: medium none !important;
    margin: 0 !important;
	background-position:110% !important;
}
#contact-form select {
    background-position: 100% 50% !important;
}
@media(max-width:767px){
.jv .row{
border-bottom: 1px solid #CCD6E8;
}
.jv {
    margin-bottom: 20px;
}
.container.form-div{
padding:0
}
.form-div .col-sm-8.col-sm-push-2 {
padding:0
}
}
	</style>
</head><body>
<?php include'header.php';?>
<!-- end header -->

<!-- end inner header -->
<?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '25'";
	$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
	$rowdest = mysql_fetch_array($GetQuery);
	
		if($rowdest['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("Banner/fullsize/".$rowdest['BannerImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "Banner/fullsize/".$rowdest['BannerImage'];
			}	
  ?>
<section class="inner-content" style="padding:0px;">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 margin-bottom">
        <h1 class="title-bottom-line"><strong><?=$rowdest['BannerName'];?></strong> </h1>
      </div>
    </div>
  </div>
</section>
<section class="header_banner"> <img src="<?=$pic?>">
  <section class="inner-header" style="/*background-image:url(images/banner/apply.jpg);padding:130px; margin-top:-80px*/">
    <div class="container" >
      <div class="row" >
        <div class="col-xs-6 col-xs-push-6 text-right" >
          <p><i style="    font-size: 24px;
    text-shadow: 0 1px 2px #000;
"></i></p>
        </div>
      </div>
    </div>
  </section>
</section>
<script>
    function myFunction1() {
		
        var name = document.getElementById("name").value;
		var surname = document.getElementById("surname").value;
	   
	   //var day = document.getElementById("day").value; //alert ("OK");
	   //var month = document.getElementById("month").value; //alert ("OK");
	   //var year = document.getElementById("year").value; //alert ("OK");
	   
	   
        var email = document.getElementById("email").value;
         var phone = document.getElementById("phone").value;
      var address = document.getElementById("address").value;
      var countries = document.getElementById("countries").value;
	  var city = document.getElementById("city").value;
	   var pin = document.getElementById("pin").value;
	    var inlineCheckbox = document.getElementById("work_eligibility").value;
		 var expn = document.getElementById("expn").value;
		  var city = document.getElementById("city").value;
		  /*var exampleInputFile = document.getElementById("exampleInputFile").value;*/
		  var exampleInputFile = "kkjjjjh";
		 
        if (name=="")
            {
               
			document.getElementById('name').style="border:solid 2px red";
			document.getElementById('nameerror').innerHTML="Enter your First Name";
			
               return false;
            }
		else{
				
				document.getElementById('name').style="";
			document.getElementById('nameerror').innerHTML="";
				
				}
            
        if (surname=='')
            {
				//alert("please enter  Name"); 
             document.getElementById('surname').style="border:solid 2px red";
			document.getElementById('surnameerror').innerHTML="Enter your Last Name ";
               return false;
            }      
		else
			{
			document.getElementById('surname').style="";
			document.getElementById('surnameerror').innerHTML="";	
				
				
			}
		/*if (dob=='')
            {
             document.getElementById('dob').style="border:solid 2px red";
			document.getElementById('doberror').innerHTML="Enter your Date Of Birth ";
               return false;
            }      
		else
			{
			document.getElementById('dob').style="";
			document.getElementById('doberror').innerHTML="";	
				return false;
				
				}
				
				*/
				
				
				
				/*------------------------------*/
				/*if (day=='' || month=='' || year=='')
            {
             //document.getElementById('dob').style="border:solid 2px red";
			document.getElementById('doberror').innerHTML="Enter your Date Of Birth";
               return false;
            }      
		else
			{
			//document.getElementById('dob').style="";
			document.getElementById('doberror').innerHTML="";	
				return false;
				
				}*/
				
				
				/*------------------------------*/
		if (email=='')
            {
             document.getElementById('email').style="border:solid 2px red";
			document.getElementById('emailerror').innerHTML="Enter your Email Id ";
			return false;
            }      
			else
			{
			document.getElementById('email').style="";
			document.getElementById('emailerror').innerHTML="";	
				
				
				}
          if (phone=='')
           {
             document.getElementById('phone').style="border:solid 2px red";
			document.getElementById('phoneerror').innerHTML="Enter your Phone No";
              return false;
           }
		   else
		   {
			   
			document.getElementById('phone').style="";
			document.getElementById('phoneerror').innerHTML="";   
			   
			   
		   }
           
		             if (address=='')
           {
             document.getElementById('address').style="border:solid 2px red";
			document.getElementById('addresseerror').innerHTML="Enter your address";
              return false;
           }
		   else
		   {
			   
			document.getElementById('address').style="";
			document.getElementById('addresserror').innerHTML="";   
			   
			   
		   }

          if (countries=='')
           {
             document.getElementById('countries').style="border:solid 2px red";
			document.getElementById('countrieserror').innerHTML="Enter your countries";
              return false;
           }
		   else
		   {
			   
			document.getElementById('countries').style="";
			document.getElementById('countrieserror').innerHTML="";   
			   
			   
		   }
		   if (pin=='')
           {
             document.getElementById('pin').style="border:solid 2px red";
			document.getElementById('pinerror').innerHTML="Enter your Post Code";
              return false;
           }
		   else
		   {
			   
			document.getElementById('pin').style="";
			document.getElementById('pincountrieserror').innerHTML="";   
			   
			   
		   }
		      if (inlineCheckbox=='')
           {
             document.getElementById('inlineCheckbox').style="border:solid 2px red";
			document.getElementById('inlineCheckboxcountrieserror').innerHTML="Selecte eligible or not";
              return false;
           }
		   else
		   {
			   
			document.getElementById('inlineCheckbox').style="";
			document.getElementById('inlineCheckboxerror').innerHTML="";   
			   
			   
		   }
		   if (city=='')
           {
             document.getElementById('city').style="border:solid 2px red";
			document.getElementById('cityserror').innerHTML="Enter your City";
              return false;
           }
		   else
		   {
			   
			document.getElementById('city').style="";
			document.getElementById('cityerror').innerHTML="";   
			   
			   
		   }

           if (exampleInputFile=='')
           {
             document.getElementById('exampleInputFile').style="border:solid 2px red";
			document.getElementById('phoneerror').innerHTML="upload File";
              return false;
           }
		   else
		   {
			   
			document.getElementById('exampleInputFile').style="";
			document.getElementById('fileerror').innerHTML="";   
			   
			   
		   }
          
      
    }
	</script>

<section>
  <div class="container form-div">
    <div class="col-sm-8 col-sm-push-2">
      <div class="lst">
        <form id="contact-form" method="post" enctype="multipart/form-data" style="padding:0;" class="frm emp_frm" onSubmit="return myFunction1()" >
          <h2 style="color:rgb(28, 127, 195); margin-bottom:1em; margin-top:0;"> Application Form </h2>
          <div class="col-md-6">
            <input type="text" name="name" id="name" placeholder="First name">
            <label id="nameerror"></label>
          </div>
          <div class="col-md-6">
            <input type="text" name="surname" id="surname" placeholder="Last Name">
            <label id="surnameerror"></label>
          </div>
		  
		  
          <label class="col-md-12">Date of Birth</label>
          <div class="col-md-6">
            <div class="jv">
              <div class="col-md-4 col-xs-12">
                <div class="row">
                  <select name="day" id="day" onChange="" >
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-xs-12">
                <div class="row">
                  <select name="month" id="month" onChange="">
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-xs-12">
                <div class="row">
                  <select name="year" id="year" onChange="" >
                    <?php for($i = 1947; $i<=date('Y'); $i++)
						{
						?>
                    <option value="<?=$i?>">
                    <?=$i;?>
                    </option>
                    <?php }?>
                  </select>
				  
                </div>
              </div>
            </div>
            <!--<input type="text" name="email" id="email" placeholder="Email address*">-->
          </div>
		
          <div class="col-md-6">
            <input type="text" name="email" id="email" placeholder="Email address">
            <label id="emailerror"></label>
          </div>
          <div class="col-md-6">
            <input type="text" name="phone" id="phone" placeholder="Contact phone number">
            <label id="phoneerror"></label>
          </div>
          <div class="col-md-6">
            <input type="text" name="address" id="address" placeholder="Street address">
            <label id="addresserror"></label>
          </div>
          <div class="col-md-6">
            <select id="countries" name="countries">
              <option value="">Country</option>
			  <?php
			  $q="select fld_name from hr_country";
			  $r=mysql_query($q);
			  while($row=mysql_fetch_array($r))
			  {
				echo "<option value='".$row["fld_name"]."'>".$row["fld_name"]."</option>";  
			 
			  }
			  
			  
			  
			 
			  ?>
			  
              
            </select>
            <label id="countrieserror"></label>
          </div>
          <div class="col-md-6">
            <input type="text" name="city" id="city" placeholder="Suburb / City">
            <label id="cityerror"></label>
          </div>
          <div class="col-md-6">
            <input type="text" name="pin" id="pin" placeholder="Postcode">
            <label id="pinerror"></label>
          </div>
          <div class="col-md-6">
		  
            <select name="qualification" onChange="return hideshow(this.value)" onselect="return hideshow(this.value)">
              <option value="RN/Div">RN/Div 1</option>
              <option value="EN/EEN">EN/EEN</option>
              <option value="AIN/PCA">AIN/PCA</option>
              <option value="Dental Assistan">Dental Assistant</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="col-md-12" style="overflow:hidden;">
            <label style="width:auto; padding:0;" class="checkbox-inline">Are you eligible to work in Australia?</label>
            <label style="width:auto;" class="checkbox-inline">
            <input type="checkbox" id="work_eligibility1" value="option1" name="work_eligibility1" 
			onclick="document.getElementById('work_eligibility').value = 'yes';
			document.getElementById('work_eligibility2').checked  = false;">
            Yes </label>
            <label style="width:auto;" class="checkbox-inline">
            <input type="checkbox" id="work_eligibility2" value="option2"  name="work_eligibility2"
			onclick="document.getElementById('work_eligibility').value = 'no';
			document.getElementById('work_eligibility1').checked  = false;">
            No </label>
            <label id="inlineCheckboxerror"></label>
			<input type="hidden" id="work_eligibility"  name="work_eligibility">
            <br>
            <br>
          </div>
          <div class="col-md-12">
            <p style="font-size: 18px;color: #000;padding-bottom: 7px; margin-top:1em; display:block;" class="text-center"> <a href="http://www.dhs.vic.gov.au/about-the-department/our-organisation/careers/applying-for-a-job/eligibility-and-right-to-work-in-australia"
        target="_blank">Find out your Eligibility & Right to Work in Australia here</a></p>
          </div>
          <br>
          <div class="col-md-6">
            <input type="number" name="expn" id="expn" placeholder="Years of experience" style="border-radius: 8px !important;border: 2px solid #cacaca !important;width: 100%;height: 40px;padding: 0 10px;">
            <label id="expnerror"></label>
          </div>
          <div class="col-md-12" >
            <div class="form-group"> <br>
              <label style="width:auto; padding:0;" class="checkbox-inline">Are you registered with AHPRA to practice in Australia?</label>
              <label style="width:auto;" class="checkbox-inline">
              <input type="checkbox" id="inlineCheckbox1" value="option1"
			  onclick="document.getElementById('register_ahpra').value = 'yes';
			document.getElementById('inlineCheckbox2').checked  = false;"
			  >
              Yes </label>
              <label style="width:auto;" class="checkbox-inline">
              <input type="checkbox" id="inlineCheckbox2" value="option2"
			  onclick="document.getElementById('register_ahpra').value = 'no';
			document.getElementById('inlineCheckbox1').checked  = false;"
			  >
              No </label>
			  <input type="hidden" id="register_ahpra"  name="register_ahpra">
			  
            </div>
          </div>
          <br>
          <br>
          <div class="col-md-12" style="margin-top: 12px;">
            <label for="exampleInputFile">Upload CV</label>
            <input type="file" name="cv_file" id="exampleInputFile" accept="application/msword,application/pdf">
            <label id="fileerror"></label>
            <br>
          </div>
          <div class="col-md-12">
            <textarea name="message" id="message" placeholder="Comments / details"></textarea>
          </div>
          <div class="col-md-12">
            <input style="font-size:13px;" type="submit" name="submit" value="Submit " >
          </div>
          <!--   <button style="font-size:13px;" type="submit" name="submit" value="submit">APPLY NOW</button>
           -->
          <!--  <p style="color:#1C7FC3;font-size:18px; margin-top:1.5em;">Once applied, we will get back to you shortly.</p>-->
        </form>
      </div>
    </div>
  </div>
</section>

<!-- end footer-bar -->
<?php include'footer1.php';?>
<!-- end footer -->
<script type='text/javascript' src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/wow.js"></script>
<script src="js/jquery.stellar.js"></script>
<script src="js/smooth-scroll.js"></script>
<script src="js/queryloader2.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/jquery.maskedinput.js"></script>
<script src="js/jquery.ba-cond.min.js" type="text/javascript" ></script>
<script src="js/jquery.slitslider.js" type="text/javascript" ></script>
<script src="js/slider-settings.js"></script>
<script src="js/medicina.js"></script>
<!-- form copy***************************************************** -->
<script>
			$(function() {
				$("#example1").dateDropdowns();

				$("#example2").dateDropdowns({
					submitFieldName: 'example2',
					submitFormat: "dd/mm/yyyy"
				});

				$("#example3").dateDropdowns({
					submitFieldName: 'example3',
					defaultDate: '2010-02-17'
				});

				$("#example4").dateDropdowns({
					submitFieldName: 'example4',
					minAge: 18
				});

				$("#example5").dateDropdowns({
					submitFieldName: 'example5',
					displayFormat: 'mdy'
				});

				$("#example6").dateDropdowns({
					submitFieldName: 'example6',
					monthFormat: 'short'
				});

				$("#example7").dateDropdowns({
					submitFieldName: 'example7',
					submitFormat: 'unix',
					defaultDateFormat: 'unix'
				});

				$("#example8").dateDropdowns({
					submitFieldName: 'example8',
					submitFormat: 'unix',
					defaultDateFormat: 'unix',
					defaultDate: 456692066
				});

				$("#example9").dateDropdowns({
                    submitFieldName: 'example9',
					submitFormat: 'unix',
					defaultDateFormat: 'unix'
				});

                $("#example10").dateDropdowns({
                    submitFieldName: 'example10',
                    required: true
                });

				// Set all hidden fields to type text for the demo
				$('input[type="hidden"]').attr('type', 'text').attr('readonly', 'readonly');
			});
		</script>
<!-- ****************************************************************** end -->
</body>
</html>
