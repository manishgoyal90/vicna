<?php 
include("../../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE from hr_contact WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}
if($_REQUEST['mode'] == "selected")
{
	$feedids = trim($_REQUEST['feedids'],",");
	$feedids = explode(",",$feedids);
	
	foreach($feedids as $valid)
	{
	
		$delsels = "DELETE from hr_contact WHERE id = '".$valid."'";
		mysql_query($delsels) or die(mysql_error());
	}
}
?>
<table class="table table-striped table-bordered table-hover" id="sample_2">						
                                    <thead>
                                       <tr>
                                            <th class="hidden-480"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>
                                            <th class="hidden-480">Id</th>
                                            <th class="hidden-480">First Name</th>
                                            <th class="hidden-480">Last name</th>
                                            <th class="hidden-480">Email</th>
                                            <th class="hidden-480">Phone</th>
                                            <th class="hidden-480">Qulification</th>
                                            <th class="hidden-480">Extra Qulification</th>
                                           <th class="hidden-480">Delete</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

<?php
$ctn = 1;
$GetUserSql = "SELECT * FROM hr_contact ";
$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
while ($rowdest = mysql_fetch_array($GetQuery)) {
    ?>
    <tr class="odd gradeX">
        <td class="hidden-480"><input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="feed[]"/></td>
        <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['id'] ?></div></td>
        <?
        $menusql = "Select * from hr_contact where id='".$rowdest['menu_id']."' ";
        $menuresult = mysql_query($menusql);
        $menudata = mysql_fetch_array($menuresult);
        ?>
        <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['first_name'] ?></div></td>
           <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['last_name'] ?></div></td>
      <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['email'] ?></div></td>
        <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['ph_no'] ?></div></td>
        <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['qualification'] ?></div></td>
        <td class="hidden-480"><div class="videoWrapper"><?= $rowdest['extraqualification'] ?></div></td>
        
<!--<td class="hidden-480">
<div class="tile image double selected">
<div class="tile-body">
<img src="../images/item-menu/<?= $rowdest['image'] ?>" />
</div>	
</div>
</td>-->
        
       <!-- <td class="hidden-480"><a class="btn mini green" data-toggle="modal" href="edit-item-menu.php?id=<?= $rowdest['id'] ?>">Edit <i class="icon-edit"></i></a></td>-->
    <td class="hidden-480"><a onclick="deleteone(<?=$rowdest['id']?>)" href="#" class="btn mini red"><i class="icon-trash"></i> Delete</a></td>
    </tr>
    <?php $ctn++;
} ?>
                                    </tbody>
                                </table>