
<style type="text/css">
.demo-2 .bg-img-1 {
	background-image: url(../images/banner.jpg);
}
.demo-2 .bg-img-2 {
	background-image: url(../images/banner2.jpg);
}
.demo-2 .bg-img-3 {
	background-image: url(../images/banner3.jpg);
}
.demo-2 .bg-img-4 {
	background-image: url(../images/banner4.jpg);
}
.slider h2 span {
    font-size: 60px;
    color: #3156A3;
}
</style>

<section class="slider">
<div class="demo-2">
<div id="slider" class="sl-slider-wrapper">
  <div class="sl-slider">
    <?php
  	$GetUserSql = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '24'";
	$GetQuery = mysql_query($GetUserSql) or die(mysql_error());
	$rowdest = mysql_fetch_array($GetQuery);
	
		if($rowdest['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("Banner/extbig/".$rowdest['BannerImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "Banner/extbig/".$rowdest['BannerImage'];
			}	
  ?>
  	<style type="text/css">
		.demo-2 .bg-img-1 {
			background-image: url(<?=$pic?>);
		}
	</style>
    <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
      <div class="sl-slide-inner">
        <div class="bg-img bg-img-1"></div>
        <div class="content">
          <?=$rowdest['BannerText'];?>
          <img src="images/pulse.png" alt="Image"><br>
          <a href="<?=$rowdest['link'];?>" class="btn-turquaz-lg">READ MORE</a> </div>
        <!-- end content -->
      </div>
      <!-- end sl-slide-inner -->
    </div>
    <!-- end sl-slide -->
	<?php
  	$GetUserSql1 = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '23'";
	$GetQuery1 = mysql_query($GetUserSql1) or die(mysql_error());
	$rowdest1 = mysql_fetch_array($GetQuery1);
	
		if($rowdest1['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("Banner/extbig/".$rowdest1['BannerImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "Banner/extbig/".$rowdest1['BannerImage'];
			}	
  ?>
  <style type="text/css">
  .demo-2 .bg-img-2 {
		background-image: url(<?=$pic?>);
	}
  </style>
    <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
      <div class="sl-slide-inner">
        <div class="bg-img bg-img-2"></div>
        <div class="content" align="right">
          <?=$rowdest1['BannerText'];?>
          <img src="images/pulse.png" alt="Image"><br>
          <a href="<?=$rowdest1['link'];?>" class="btn-turquaz-lg">READ MORE</a> </div>
      </div>
      <!-- end sl-slide-inner -->
    </div>
    <!-- end sl-slide -->
	<?php
  	$GetUserSql2 = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '22'";
	$GetQuery2 = mysql_query($GetUserSql2) or die(mysql_error());
	$rowdest2 = mysql_fetch_array($GetQuery2);
	
		if($rowdest1['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("Banner/extbig/".$rowdest2['BannerImage']))
			{
				$pic = "images/nopic.jpg";
			}
			else
			{
				$pic = "Banner/extbig/".$rowdest2['BannerImage'];
			}	
  ?>
	<style type="text/css">
  .demo-2 .bg-img-3 {
		background-image: url(<?=$pic?>);
	}
  </style>
    <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
      <div class="sl-slide-inner">
        <div class="bg-img bg-img-3"></div>
        <div class="content">
          <?=$rowdest2['BannerText'];?>
          <img src="images/pulse.png" alt="Image"><br>
          <a href="<?=$rowdest2['link'];?>" class="btn-turquaz-lg">READ MORE</a></div>
      </div>
      <!-- end sl-slide-inner -->
    </div>
    <!-- end sl-slide -->
    <!--<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
<div class="sl-slide-inner">
<div class="bg-img bg-img-4"></div>
<div class="content">
<h2>30% <u>discount</u> for <br>
Nursing Training</h2>
<img src="images/pulse.png" alt="Image"><br>
<a href="" class="btn-turquaz-lg">READ MORE</a> </div>

</div>

</div>

</div>-->
    <!-- sl-slider -->
    <nav id="nav-arrows" class="nav-arrows"> <span class="nav-arrow-next">Previous</span> <span class="nav-arrow-next">Next</span> </nav>
    <!-- end nav-arrows -->
    <nav id="nav-dots" class="nav-dots"> <span class="nav-dot-current"></span> <span></span> <span></span> <span></span> </nav>
    <!-- end nav-dots -->
  </div>
  <!-- end sl-slider-wrapper -->
</div>
<!-- end demo2 -->
</section>
