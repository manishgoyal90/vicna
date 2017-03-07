   <?php  
		
include"config/connect.php";

 
 /*<!--  ----------------------------------------------------------------------------------------------------         -->
*/
  /* $givenDate="2016-06-06";
   echo "Next Monday:". date('Y-m-d', strtotime('next monday', strtotime($givenDate)));
   echo "last Monday:". date('Y-m-d', strtotime('last monday', strtotime($givenDate)));
echo "Previous Monday:". date('Y-m-d', strtotime('previous monday', strtotime($givenDate)));*/


   
	 $givenDate=$_REQUEST["q"];
$monday =  strtotime('last monday', strtotime($givenDate));

//$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

 $mon = date("d M Y",strtotime(date("Y-m-d",$monday)." +0 days"));
 $tue = date("d M Y",strtotime(date("Y-m-d",$monday)." +1 days"));
 $wed = date("d M Y",strtotime(date("Y-m-d",$monday)." +2 days"));
 $thu = date("d M Y",strtotime(date("Y-m-d",$monday)." +3 days"));
 $fri = date("d M Y",strtotime(date("Y-m-d",$monday)." +4 days"));
 $sat = date("d M Y",strtotime(date("Y-m-d",$monday)." +5 days"));
 $sun = date("d M Y",strtotime(date("Y-m-d",$monday)." +6 days"));

$this_week_sd=$mon;
$this_week_ed=$sun;
 
echo "Week Starting from $mon and end on $sun ";
?>
		
		<table class="table"  width="100%">
		 <thead>
		 <tr>
		 	<th>Day and Date</th>
			<th>AM</th>
			<th>PM</th>
			<th>ND</th>
			<th>Notes</th>
		</tr>
		 </thead>
        
         
         <form name="" action="allocationsStuff.php" method="post">
          <?php 
		  $fetchmon = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='mon'")); //This is for permanent
		  $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$this_week_sd."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
        
		 <tr>			
		 <td width="30%">MON <?= $this_week_sd; ?><input type="hidden" name="dt" value="<?= $this_week_sd; ?>">
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
         
		 
         <?php 
		 $fetchtue = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='tue'")); //This is for permanent
		 $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$tue."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
        <form name="" action="allocationsStuff.php" method="post">
       
		 <tr>			
		 <td width="30%">TUES <?= $tue ?><input type="hidden" name="dt" value="<?= $tue ?>">
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
        
          
		  <?php 
		  $fetchwed = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='wed'")); //This is for permanent
		  $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$wed."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?><form name="" action="allocationsStuff.php" method="post">
		
         <tr>			
		 <td width="30%">WED <?= $wed ?><input type="hidden" name="dt" value="<?= $wed; ?>">
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
         <?php 
		 $fetchthu = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='thu'")); //This is for permanent
		 $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$thu."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
         <form name="" action="allocationsStuff.php" method="post">
		 	
		 <td width="30%">THU <?= $thu ?><input type="hidden" name="dt" value="<?= $thu; ?>">
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
        
          <form name="" action="allocationsStuff.php" method="post">
           <?php 
		   $fetchfri = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='fri'")); //This is for permanent
		   $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$fri."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?> 
		 <tr>			
		 <td width="30%">FRI <?= $fri ?><input type="hidden" name="dt" value="<?= $fri ?>">
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
       
          <form name="" action="allocationsStuff.php" method="post">
          <?php 
		  $fetchsat = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='sat'")); //This is for permanent
		  $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$sat."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?> 
		 <tr >			
		 <td width="30%">SAT <?= $sat ?><input type="hidden" name="dt" value="<?= $sat ?>">
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
         
          <form name="" action="allocationsStuff.php" method="post">
          <?php 
		  $fetchsun = mysql_fetch_array(mysql_query("SELECT * FROM staff_permanent_availablity WHERE day='sun'")); //This is for permanent
		  $SqlUser = "SELECT * FROM staff_availablity WHERE dt = '".$this_week_ed."'";
				$result = mysql_query($SqlUser);
				$am=$pm=$nd=$note='';
				while($row = mysql_fetch_array($result))
				{$am=$row['am'];$pm=$row['pm'];$nd=$row['nd'];$note=$row['note'];}
		?>
		 <tr>			
		 <td width="30%">SUN <?= $this_week_ed ?><input type="hidden" name="dt" value="<?= $this_week_ed ?>">
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