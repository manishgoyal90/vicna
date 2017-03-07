<?php
include("../../config/connect.php");
include("../image-magician/php_image_magician.php");

if (!empty($_FILES)) {
	
				
		
			//Image uploadin start.
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size = 2000 * 1024; #200kb
			//$nw = $nh = 300; # image with # height
			$imgwidth = 200;
			$imgheight =  200;
			
			$imgwidth2 = 100;
			$imgheight2 =  100;
			
			$imgwidth3 = 182;
			$imgheight3 =  89;
			
			$imgwidth4 = 650;
			$imgheight4 =  747;
			
					//if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
						$ext = strtolower(pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION));
								//Upload image path...
								$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
								$path = '../../biographyimages/bigimg/' . $imagename;
								$path1 = '../../biographyimages/smallimg/' . $imagename;
								$pathfull = '../../biographyimages/fullsize/' . $imagename;
								$pathmdm = '../../biographyimages/medium/' . $imagename;
								$pathmdm2 = '../../biographyimages/extbig/' . $imagename;
								
								$tmp = $_FILES['Filedata']['tmp_name'];
								$size = getimagesize($tmp);
			
								$x = (int) $_POST['x'];
								$y = (int) $_POST['y'];
								$w = (int) $_POST['w'] ? $_POST['w'] : $size[0];
								$h = (int) $_POST['h'] ? $_POST['h'] : $size[1];
			
								$data = file_get_contents($tmp);
								$vImg = imagecreatefromstring($data);
								
								//Crop code...
								$dstImg = imagecreatetruecolor($imgwidth, $imgheight);
								imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $imgwidth, $imgheight, $w, $h);
								imagejpeg($dstImg, $path);
								
								$dstImg1 = imagecreatetruecolor($imgwidth2, $imgheight2);
								imagecopyresampled($dstImg1, $vImg, 0, 0, $x, $y, $imgwidth2, $imgheight2, $w, $h);
								imagejpeg($dstImg1, $path1);
								
								$dstImg2 = imagecreatetruecolor($imgwidth3, $imgheight3);
								imagecopyresampled($dstImg2, $vImg, 0, 0, $x, $y, $imgwidth3, $imgheight3, $w, $h);
								imagejpeg($dstImg2, $pathmdm);
								
								$dstImg3 = imagecreatetruecolor($imgwidth4, $imgheight4);
								imagecopyresampled($dstImg3, $vImg, 0, 0, $x, $y, $imgwidth4, $imgheight4, $w, $h);
								imagejpeg($dstImg3, $pathmdm2);
								
								//Upload image full size...
								@copy($tmp,$pathfull);
								
								imagedestroy($dstImg);
								imagedestroy($dstImg1);
								imagedestroy($dstImg2);
								imagedestroy($dstImg3);
								//echo "<img src='$pathfull' />";
				
				$Insert = "INSERT INTO ".TABLE_PREFIX."biography SET
														gallery_image = '".$imagename."'
														";
				$Res = mysql_query($Insert)or mysql_error();

	
	//$file_name = rand(0,999999).time().$_FILES['Filedata']['name'];


	
	echo 1;
}
?>