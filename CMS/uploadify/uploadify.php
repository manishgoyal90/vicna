<?php
include("../../config/connect.php");
include("../image-magician/php_image_magician.php");

if (!empty($_FILES)) {

	$gallery_id = $_REQUEST['gallery_id'];
	
			//Image uploadin start.
			$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
			$max_file_size = 2000 * 1024; #200kb
			//$nw = $nh = 300; # image with # height
			$imgwidth = 200;
			$imgheight =  200;
			
			$imgwidth2 = 100;
			$imgheight2 =  100;
			
			$imgwidth3 = 600;
			$imgheight3 =  450;
			
			$imgwidth4 = 850;
			$imgheight4 =  567;
			
					//if (! $_FILES['image']['error'] && $_FILES['image']['size'] < $max_file_size) {
						$ext = strtolower(pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION));
								//Upload image path...
								$imagename = uniqid() . '.' . $ext; //Concate with Uniqid id and extension.
								
											$path = '../../gallery/bigimg/' . $imagename;
											$path1 = '../../gallery/smallimg/' . $imagename;
											$pathfull = '../../gallery/fullsize/' . $imagename;
											$pathmdm = '../../gallery/medium/' . $imagename;
											$pathsml = '../../gallery/extsmall/' . $imagename;
											
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
											imagejpeg($dstImg3, $pathsml);
											
											//Upload image full size...
											@copy($tmp,$pathfull);
											
											imagedestroy($dstImg);
											imagedestroy($dstImg1);
											imagedestroy($dstImg2);
											imagedestroy($dstImg3);
								
								//Upload image full size...
								@copy($tmp,$pathfull);
								
								imagedestroy($dstImg);
								imagedestroy($dstImg1);
								imagedestroy($dstImg2);
								imagedestroy($dstImg3);
								//echo "<img src='$pathfull' />";
				
									$ImageSql = "INSERT INTO ".TABLE_PREFIX."gallery SET    
															gallery_id = '".$gallery_id."' , 
															gallery_image = '".$imagename."' 
															";
									  mysql_query($ImageSql)or mysql_error();
	
	echo 1;
}
?>