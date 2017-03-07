<?php 
include("../../config/connect.php");

$gallery_id = $_REQUEST['gallery_id'];
?>

<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>
	<tr>
		<th style="width:8px;">SlNo<!--<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />--></th>
		<th class="hidden-480" style="width:100px;">Picture</th>
		<th class="hidden-480">Delete</th>
	</tr>
</thead>
<tbody>
	
<?php
$c=1;
$getdest = "SELECT * FROM ".TABLE_PREFIX."biography ORDER BY id DESC";
$getdest = mysql_query($getdest) or die(mysql_error());
while($rowdest = mysql_fetch_array($getdest))
{
	// Get picture
			if($rowdest['gallery_image'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("../../biographyimages/bigimg/".$rowdest['gallery_image']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "../biographyimages/bigimg/".$rowdest['gallery_image'];
			}
?>

<tr class="odd gradeX">
	<td><?=$c?><!--<input type="checkbox" class="checkboxes" value="<?=$rowdest['id']?>" name="pics[]"/>--></td>
	<td class="hidden-480">
	
	<div class="tile image double selected">
		<div class="tile-body">
			<img src="<?=$pic?>" alt="">
		</div>
	</div>
	
	</td>
	<td ><a class="btn mini red" href="#" onclick="deleteone(<?=$rowdest['id']?>)"><i class="icon-trash"></i> Delete</a></td>
</tr>

<?php
$c++;
}
?>
	
</tbody>
</table>