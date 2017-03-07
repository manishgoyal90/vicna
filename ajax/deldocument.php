<?php 
include("../config/connect.php");

if($_REQUEST['mode'] == "single")
{
	$feedid = $_REQUEST['feedid'];
	
	$delsingle = "DELETE from documents WHERE id = '".$feedid."'";
	mysql_query($delsingle) or die(mysql_error());
}

?>
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
					<td><a href="" style="text-decoration:none;" onClick="deleteone(<?=$row['id']?>);" ><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				  
		<?php
				  $c++; 
				
			  }
			  
			  if($c==1){echo "<tr><td colspan='4'>No document uploaded till now.</td></tr>";}
			?>
			
			
			
			</table>