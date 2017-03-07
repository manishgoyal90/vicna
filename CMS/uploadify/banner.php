<?php
include("../config/connect.php");
include("../image-magician/php_image_magician.php");

if (!empty($_FILES)) {

	$file_name = rand(0,999999).time().$_FILES['Filedata']['name'];
	$file_name = str_replace(" ","",$file_name);
	
	$temppath = $_FILES['Filedata']['tmp_name'];
	
	$getbannersize = getimagesize($temppath);
	
	/*print "<pre>";
	print_r($getbannersize);*/
	
	if($getbannersize[0] == $settings['banner_width'] && $getbannersize[1] == $settings['banner_height'])
	{
		$filepath = "banners/".$file_name;
		$thmb_path = "banners/thmb_".$file_name;
		
		move_uploaded_file($temppath,'../'.$filepath);
		
		$magicianObj = new imageLib('../'.$filepath);
		$magicianObj -> resizeImage(320,150);
		$magicianObj -> saveImage('../'.$thmb_path, 100);
		
		$insertbanner = "INSERT INTO ".TABLE_PREFIX."banners SET 
						 banner_image = '".$filepath."',
						 banner_thmb = '".$thmb_path."'";
					  
		mysql_query($insertbanner) or die(mysql_error());
		
		echo 1;
	}
	else
	{
		echo 0;
	}
}
?>