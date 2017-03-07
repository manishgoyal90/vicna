<?php 
 include"../../config/connect.php";
/*if(isset($_REQUEST['add_payslip'])){ 	*/
$uid = $_REQUEST['Uid']; 
	//echo $pay = $_REQUEST['payPeriodEnding'];
	
	
	
	/*********************File Upload Start**********************************/
	
	
	
	/********************* File Upload End ***********************************/
	
		$update = mysql_query("UPDATE hr_staff_registration SET 
									   	offerMeNum = '".$_POST["offerMeNum"]."',
									   	offerMeUnit =  '".$_POST["offerMeUnit"]."',
									   	after10pm =  '".$_POST["after10pm"]."',
										before6am =  '".$_POST["before6am"]."',
										travel =  '".$_POST["travel"]."',
										text_me =  '".$_POST["text_me"]."'
									   	WHERE Uid = '".$uid."'
										   ");
		if($update)
		{
			$msg = "Information Updateed Successfully.";
		}else
		{
			$msg = "Information Not Updated.";
		}
	
//}
 ?>


                               		<div id="pref_msg" style="color:#F60; font-size:16px;">
									<?php if(empty($errors)){echo $msg;}
										else{ 
											foreach($errors as $key=>$val)
											{
												echo '<span style="color:red; font-weight:bold;">'.$val.'</span>';
											}
										}?>
									</div>
                                    <?php 
				$SqlUser = "SELECT offerMeNum,offerMeUnit,after10pm,before6am,travel,text_me FROM hr_staff_registration  WHERE Uid = '".$_REQUEST["Uid"]."'";
				$result = mysql_query($SqlUser) or die(mysql_error());;
				
				while($row = mysql_fetch_array($result))
				{$offerMeNum=$row['offerMeNum'];$offerMeUnit=$row['offerMeUnit'];$after10pm=$row['after10pm'];$before6am=$row['before6am'];
				$travel=$row['travel'];$text_me=$row['text_me'];
				}
				?>		
                <form id="edit_preference" action="ajax/mypreference.php" method="post">
				<input type="hidden" name="Uid" value="<?=$_REQUEST["Uid"]?>" />
                Offer me shifts up to
                <select class="my_pre" name="offerMeNum" style="background-color:#D2FDFF;">
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
                <select class="my_pre" name="offerMeUnit" style="background-color:#D2FDFF;">
                  <option value="<?= $offerMeUnit ?>">
                  <?= $offerMeUnit ?>
                  </option>
                  <option value="km">KM</option>
                  <option value="minute">Minute</option>
                </select>
                from my residence.</b>
                
                <br>
                <br>
                Allocators can call me after 10pm?</b>
                <select class="my_pre" name="after10pm" style="background-color:#D2FDFF">
                  <option value="<?= $after10pm ?>">
                  <?= $after10pm ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
               
                <br>
                <br>
                Allocators can call me before 6am?</b>
                <select name="before6am" class="my_pre" style="background-color:#D2FDFF;">
                  <option value="<?= $before6am ?>">
                  <?= $before6am ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
                
                <br>
                <br>
                Allocators should text me notifications for shift broadcast?</b>
                <select class="my_pre" name="text_me" style="background-color:#D2FDFF;">
                  <option value="<?= $text_me ?>">
                  <?= $text_me ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
               
                <br>
                <br>
                I am willing to travel to regional places if reimbursed for travel & accommodation?</b>
                <select name="travel" class="my_pre"  style="background-color:#D2FDFF;">
                  <option value="<?= $travel ?>">
                  <?= $travel ?>
                  </option>
                  <option value="yes">YES</option>
                  <option value="no">NO</option>
                </select>
				<br/>
                <input class="btn btn-info" name="submit_dtl" id="edit_preferences" type="submit" value="save">
              </form>
                             
                           
        <script type="text/javascript">
		$('#pref_msg').fadeOut(5000);
		</script>                      