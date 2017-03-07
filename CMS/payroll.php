<?php include"lib/header.php";?>
<?php
?>

	<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<?php include"lib/leftbar.php";?>	
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<?php include"lib/themecolor.php";?>
						<!-- END BEGIN STYLE CUSTOMIZER -->    
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							 <?=$pagetitle?> <small></small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
							<li class="pull-right no-text-shadow">
								<!-- <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">
									<i class="icon-calendar"></i>
									<span></span>
									<i class="icon-angle-down"></i>
								</div> -->
							</li>
						</ul>
				
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- Statr Page body-->
				<div class="portlet box grey">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i><?=$pagetitle?></div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>
					</div>
				<div class="portlet-body form"> 
					<!-- BEGIN FORM-->
                    
                  
                     <h3>Payroll</h3>
		  <!-- ------------------------------------------------------------------------------------------------------ -->
       <br><br>
	   
	   <b>Payroll Details </b>
	   <br><br>
		ATO Tax File Number (TFN): 000 000 000<br>
        Nominated Bank Account(s) for Salary Deposit:<br>
                
                
                		<?php echo $msg;  ?>		
         <table class="table">
		 <thead>
		 <tr><th>sl</th><th>Account Holder’s Name</th><th>Bank Name</th><th>BSB</th><th>Account Number</th><th>Edit</th></tr>
		 </thead>
		 
         <?php	
         //--------------show bank details-------------------
		 ?>
         
         
		 <script type="text/javascript">
function saveAcDetails1() {
	//alert ("yyuyu" + document.getElementById("SPIN").value);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("bankDtls1").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "saveBankDtls.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  /*xhttp.send("fname=Henry&lname=Ford");*/
  /*xhttp.send("SPIN=" + document.getElementById("SPIN").value + "&memberNumber=p"++"&fundABN=p"++"&fundName=p"++"&fundAddress=p"++"&fundPhoneNumber=p"++"");*/
	xhttp.send("acName1=" + document.getElementById("acName1").value+"&bankName1="+document.getElementById("bankName1").value+"&BSB1="+document.getElementById("BSB1").value+"&acNo1="+document.getElementById("acNo1").value+"&sl1="+document.getElementById("slBank1").value
																																																															  +"&Uid1="+document.getElementById("Uid1").value
																																																													 );
}
	
	
function saveAcDetails2() {
	//alert ("yyuyu" + document.getElementById("SPIN").value);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("bankDtls2").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "saveBankDtls.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  /*xhttp.send("fname=Henry&lname=Ford");*/
  /*xhttp.send("SPIN=" + document.getElementById("SPIN").value + "&memberNumber=p"++"&fundABN=p"++"&fundName=p"++"&fundAddress=p"++"&fundPhoneNumber=p"++"");*/
	xhttp.send("acName2=" + document.getElementById("acName2").value+"&bankName2="+document.getElementById("bankName2").value+"&BSB2="+document.getElementById("BSB1").value+"&acNo2="+document.getElementById("acNo2").value+"&sl2="+document.getElementById("slBank2").value
																																																															  +"&Uid2="+document.getElementById("Uid2").value
																																																													 );
}
</script>


<?php
	$r=mysql_query("Select * from account_details where view=1 and  Uid=".$_GET["Uid"]."");
	if($r){$msg="<font color='green'>Successfully inserted.</font>";}
	else{$msg="<font color='red'>Successfully inserted.</font>";}
	$c=0;
	
				while($row = mysql_fetch_array($r))
				{
					$c++;$acName=$row['acName'];$acNo=$row['acNo'];$BSB=$row['BSB'];
					$bankName=$row['bankName'];$dt=$row['dt'];$sl=$row['sl'];
				
		echo("<tr><td>$c.</td>
		<td><input type='text' id='acName$c' value ='$acName'></td>
		 <td><input type='text' id='bankName$c' value ='$bankName'></td>
		 <td><input type='text' id='BSB$c' value ='$BSB'></td>
		 <td><input type='text' id='acNo$c' value ='$acNo'>
		 <div id='bankDtls$c'></div>
		 </td>
		 
		 <td>
		 <input type='hidden' id='slBank$c' value ='$sl'>
		 <input type='hidden' id='Uid$c' value =".$_GET["Uid"].">
		 <input type='button' value='save' onclick='saveAcDetails$c()'>
		 <div id='bankDtls$c'></div>
		 </td>
        
		 </tr>");
				}
				
	//-------------end show bank details--------------------
	?>
         </table>
         <br<br>
         
        <?php 
		if($c==2){}else
         {?>
         <a href="#">Enter Another bank account number</a>
         <form action="" method="post">
         <table class="table">
		 <thead>
		 <tr><th>Account Holder’s Name</th><th>Bank Name</th><th>BSB</th><th>Account Number</th></tr>
		 </thead>
		 <tr>
		 <td><input type="text" name="acName"></td></td>
         <td><input type="text" name="bankName"></td><td><input type="text" name="BSB"></td><td><input type="text" name="acNo"></td>
         </tr></table>
         <input type="submit" name="submit" value="submit">
         </form>
       <?php   }
	   ?>
         <br><br>
      
        
                    
                    
                    <br>
                    <b>Nominated Superannuation Fund: </b>
                    <br><br>
 <script type="text/javascript">
function loadDoc() {
	//alert ("yyuyu" + document.getElementById("SPIN").value);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("demoppp").innerHTML = xhttp.responseText;
    }
  };
  xhttp.open("POST", "saveSPIN.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  /*xhttp.send("fname=Henry&lname=Ford");*/
  /*xhttp.send("SPIN=" + document.getElementById("SPIN").value + "&memberNumber=p"++"&fundABN=p"++"&fundName=p"++"&fundAddress=p"++"&fundPhoneNumber=p"++"");*/
	xhttp.send("SPIN=" + document.getElementById("SPIN").value+"&memberNumber="+document.getElementById("memberNumber").value+"&fundABN="+document.getElementById("fundABN").value+"&fundName="+document.getElementById("fundName").value+"&fundAddress="+document.getElementById("fundAddress").value+"&fundPhoneNumber="+document.getElementById("fundPhoneNumber").value+"&sl="+document.getElementById("sl").value+"");
}
</script>

<?PHP 
$GetQuery=mysql_query("select * from nsf where Uid=".$_GET["Uid"]."") or die("Error : ".mysql_error());;
while($row = mysql_fetch_array($GetQuery))
{
	$spin=$row['SPIN'];									

?>
        
         <table class="table">		 
		 <tr>			
		 <td>Superannuation Product Identification Number (SPIN)</td>
		 <td><input type="text" name="" id="SPIN" value="<?php echo $row['SPIN'] ?>"></td>
		 </tr>
		 <tr>			
		 <td>Member Number</td>
		 <td><input type="text" name="" id="memberNumber" value="<?=$row['memberNumber'] ?>"></td>
		 </tr>
		 <tr>			
		 <td>Fund ABN</td>
		 <td><input type="text" name="" id="fundABN" value="<?=$row['fundABN'] ?>"></td>
		 </tr>
		 <tr>			
		 <td>Fund Name</td>
		 <td><input type="text" name="" id="fundName" value="<?=$row['fundName'] ?>"></td>
		 </tr>
		 <tr>			
		 <td>Fund Address</td>
		 <td><input type="text" name="" id="fundAddress" value="<?=$row['fundAddress'] ?>"></td>
		 </tr>
		 <tr>			
		 <td>Fund Phone Number</td>
		 <td><input type="text" name="" id="fundPhoneNumber" value="<?=$row['fundPhoneNumber'] ?>"></td>
		 </tr>
		 </table>
         <div id="demoppp"></div>
         <input type="hidden" name="" id="sl" value="<?=$row['sl'] ?>">
		 <input type="button" name="submit" value="save" onClick="loadDoc();">
		 
    <?php
	}
										

	?>
                                 
                    
                    
                    <!-- END FORM-->
					      
				 </div>
                 
                 
               <!-- ---------------------------------------------------Weekly PAYG Summaries--------------------------------------------------------------------> 
                 
                 <div class="portlet box grey">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i><?=$pagetitle?></div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>
					</div>
                 <div class="portlet-body form"> 
					<!-- BEGIN FORM-->
                   <h3>Weekly PAYG Summaries</h3>
                    <?php 


if(isset($_POST['submit'])){
 
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
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")&& ($extension != "PDF") && ($extension != "pdf")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['image']['tmp_name']);
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=time().'.'.$extension;
		//$image_name="profile_".$_SESSION["user_id"].'.'.$extension;
		$newname="payslip/".$image_name;
 
		$copied = copy($_FILES['image']['tmp_name'], $newname);
		if (!$copied) 
		{
			echo '<h3>Copy unsuccessfull!</h3>';
			$errors=1;
		}
		else echo '<h3>uploaded successfull!</h3>';

	}
 
	
}
//-------------------------------------------------------
//-------------
                    /* $query = "SELECT * FROM pay_slip where user_id = '".$_SESSION["userid"]."'  ;"; 
			  $result = mysql_query($query) or die(mysql_error());
		 $c=0;
		 	 
			  while($row = mysql_fetch_array($result))
			  {
				  $path=$row['path'];
			  echo "+++".$path;
			  $c++;  }*/
//-------------



		$r=mysql_query("INSERT INTO pay_slip (id, path, payPeriodEnding, datePaid, Uid, gross, tax,dt) VALUES (NULL, '".$newname."', '".$_POST["payPeriodEnding"]."', '".$_POST["datePaid"]."', '".$_GET["Uid"]."', '".$_POST["gross"]."', '".$_POST["tax"]."',now());");
		
		if($r){$upload_msg="<font color='green'>Successfully upload</font>";}
		else{$upload_msg="<font color='red'>Not upload</font>";}
		//------------------------------------------------------
}
?>
<?php echo"$upload_msg"; ?>
 <form action="" method="post" enctype="multipart/form-data">
 <table width="80%" class="table">
 <tr width="30%"><td width="26%"><input type="file" name="image" id="image" size="40" ></td><td width="72%">&nbsp;</td><td width="2%">&nbsp;</td></tr>

 <tr><td>Uid:</td><td><input type="text" name="Uid"  class="form-control" value="<?php echo $_GET["Uid"]; ?>"></td><td>&nbsp;</td></tr>
 <tr><td> Pay Period Ending:</td><td><input type="date"name="payPeriodEnding" class="form-control" value="<?php echo $payPeriodEnding; ?>"></td><td>&nbsp;</td></tr>
 <tr><td> Date Paid:</td><td><input type="date" name="datePaid" class="form-control" value="<?php echo $datePaid; ?>"></td><td>&nbsp;</td></tr>
 <tr><td> Gross:</td><td><input type="number" name="gross"  class="form-control" value="<?php echo $_GET["gross"]; ?>"></td><td>&nbsp;</td></tr>
 <tr><td> Tax:</td><td><input type="number" name="tax"  class="form-control" value="<?php echo $_GET["tax"]; ?>"></td><td>&nbsp;</td></tr>
 
 
 <tr><td> <input name="submit" type="submit" class="btn btn-info" value="upload" /></td><td>&nbsp;</td><td>&nbsp;</td></tr>
 </table>
</form>








                    <!-- END FORM-->
					      
				 </div>
                 </div>
                 
                 <!-- -----------------------------------------end-Weekly PAYG Summaries---------------------------------------->
                 <!-- ----------------------------------------------------------------------------> 
                 
                 <div class="portlet box grey">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i><?=$pagetitle?></div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>
					</div>
                 <div class="portlet-body form"> 
					<!-- BEGIN FORM-->
                   <h3>Group Certificates </h3>
                    
                    Here are your last five EOFY PAYG Summaries from VICNA. Financial Year	2015-2016	2014-2015	2013-2014	2012-2013	2011-2012
                    <?php 


if(isset($_POST['submit1'])){
 
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
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") 
		&& ($extension != "gif")&& ($extension != "JPG") && ($extension != "JPEG") 
		&& ($extension != "PNG") && ($extension != "GIF")&& ($extension != "PDF") && ($extension != "pdf")) 
	{
		echo '<h3>Unknown extension!</h3>';
		$errors=1;
	}
	else
	{
		$size=filesize($_FILES['image']['tmp_name']);
 
		if ($size > MAX_SIZE*1024)
		{
			echo '<h4>You have exceeded the size limit!</h4>';
			$errors=1;
		}
 
		$image_name=time().'.'.$extension;
		//$image_name="profile_".$_SESSION["user_id"].'.'.$extension;
		$newname="groupCertificate/".$image_name;
 
		$copied = copy($_FILES['image']['tmp_name'], $newname);
		if (!$copied) 
		{
			echo '<h3>Copy unsuccessfull!</h3>';
			$errors=1;
		}
		else echo '<h3>uploaded successfull!</h3>';
		
		
		
		$r=mysql_query("INSERT INTO groupCertificates (sl, Uid,`year`,path,dt) VALUES (NULL, '".$_GET["Uid"]."','".$_POST["year"]."','".$newname."',now());");
		
		if($r){$upload_msg="<font color='green'>Successfully upload</font>";}
		else{$upload_msg="<font color='red'>Not upload</font>";}

	}
 
	
}

		
		
}
?>
                    
                     <form action="" method="post" enctype="multipart/form-data">
 <table width="80%" class="table">
 <tr width="30%"><td width="26%"><input type="file" name="image" id="image" size="40" ></td><td width="72%">&nbsp;</td><td width="2%">&nbsp;</td></tr>

 <tr><td>Uid:</td><td><input type="text" name="Uid"  class="form-control" value="<?php echo $_GET["Uid"]; ?>"></td><td>&nbsp;</td></tr>
 <tr><td> year:</td><td><input type="text" name="year" class="form-control" value="<?php echo $year; ?>"></td><td>&nbsp;</td></tr>
 
 
 <tr><td> <input name="submit1" type="submit" class="btn btn-info" value="upload" /></td><td>&nbsp;</td><td>&nbsp;</td></tr>
 </table>
</form>
                    
                    
                    
                    
                    For older group certificates, email payroll at payroll@vicna.com.au or use Pay Enquiries feature. 
                    
                    
                    
                    <!-- END FORM-->
					      
				 </div>
                 </div>
                 <!-- ---------------------------------------------------------------------------------->
                 <!-- ----------------------------------------------------------------------------> 
                 
                 <div class="portlet box grey">
					<div class="portlet-title">
						<div class="caption"><i class="icon-reorder"></i><?=$pagetitle?></div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>
					</div>
                 <div class="portlet-body form"> 
					<!-- BEGIN FORM-->
                  
                    <b>Enquiries:</b>
          <?php
          $query = "SELECT * FROM payenquiries where Uid = '".$_SESSION["userid"]."' order by sl desc  ;"; 
			  $result = mysql_query($query) or die(mysql_error());
		 ?>
         <table class="table">
        <tr><td>Date</td><td>Receipt Number</td><td>Status</td><td>Options</td><td>More</td></tr>
         
         <?php
		 	 $c=1;
			  while($row = mysql_fetch_array($result))
			  {
				$subject=$row['subject'];$sl=$row['sl'];
			  $inquery=$row['inquery'];$dt=$row['dt'];$status=$row['status'];
			 echo "<tr><td>$dt</td><td>VIC0000$sl</td><td>In Progress</td><td><span class='glyphicon glyphicon-random' style='color:blue;'></span></td><td><button data-toggle='collapse' data-target='#demo_mail$c' class='btn'>More</button></td></tr>";
			 echo("<tr><td colspan='6'><div id='demo_mail$c' class='collapse'>Subject:<b>$subject</b><br>$inquery");
			 //-------------------------------------------------
			 
			 $query11 = "SELECT * FROM payenquiries  where  Uid = '".$_SESSION["userid"]."' and ansSl = '".$sl."' order by sl   ;"; 
			  $result11 = mysql_query($query11) or die(mysql_error());
			  while($row11 = mysql_fetch_array($result11))
			  {
				  $subject=$row['subject'];$sl=$row['sl'];
			  $inquery=$row['inquery'];$dt=$row['dt'];
				  echo "Date:$dt<br>Subject:<b>$subject</b><br>$inquery";
			  }
			 ?>
             
             
             <form action="" method="post">
        <table class="table" >
        <tr><td colspan="6" bgcolor="#F5F5F5"><h5>Send Answar</h5></td></tr>
        <tr><td align="center">
        Subject: 
        </td>
        <td align="right"><input type="text" name="subject"  style="width:100%;"></td></tr>
<tr><td  align="center">Enquiry: </td><td><textarea name="enquery" style="width:100%;"></textarea></td></tr>
<tr><td  align="right"><input type="button" value="save" class="btn btn-primary" ></td></tr>
</table>		
</form>
             
             
             <?php
			 
			 echo "</div></td></tr>";
			 //----------------------------------------------------
			  $c++;  }
			  
			  ?>
         


          
         
        </table>
		  
                    
                   
                    <!-- END FORM-->
					      
				 </div>
                 </div>
                 
                 <!-- ---------------------------------------------------------------------------------->
                 
			  </div>
			  
			  <!-- END SAMPLE FORM PORTLET-->
				<!-- End Page Body-->
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<?php include"lib/footer.php";?>
	</div>   
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->   
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		});
	</script> 
	<script>
	function passval()
		{
			$("#oldpasserr").html('');
			$("#newpasserr").html('');
			$("#conpasserr").html('');
			
			$("#oldpasserr").hide();
			$("#newpasserr").hide();
			$("#conpasserr").hide();
			
			
			var oldpass = $("#oldpass").val();
			var newpass = $("#newpass").val();
			var conpass = $("#conpass").val();
			
					
			if(oldpass == "")
			{
				$("#oldpasserr").show();
				$("#oldpasserr").html('Enter old password');
			}
			if(newpass == "")
			{
				$("#newpasserr").show();
				$("#newpasserr").html('Enter new password');
			}
			if(conpass == "")
			{
				$("#conpasserr").show();
				$("#conpasserr").html('Confirm your password');
			}
			if(conpass != newpass)
			{
				$("#conpasserr").show();
				$("#conpasserr").html('Passwords mismatch');
			}
			if(oldpass != "" && newpass != "" && conpass == newpass && conpass != "")
			{
				document.frmchangepass.submit();
			}
			else
			{
				return false;
			}
		
		}
</script>

<script>
$('#cancel').click(function(){
	location.href = 'dashboard.php';
});
</script> 
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>