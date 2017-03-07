<style>
@media(max-width:767px){
footer h4:after {
    content: '';
    width: 50px;
    height: 1px;
    background: #fff;
    position: absolute;
    left: 42%;
    bottom: -20px;
    margin: auto;
}
footer h4 {
    text-align:center
}
footer ul li a {
    float: initial;
    color: #fff;
}
}
</style>
<div class="book-now-wrapper" style="bottom:40%;">
  <p class="toggle"><a style="color:#fff; text-decoration:none;" href="apply.php">Apply Now <span style="font-weight:bold; font-size:18px;" aria-hidden="true" class="glyphicon glyphicon-envelope"></span></a></p>
</div>

 <?php
			//Fetch About Us Details
			$phoneslq1 = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '4'";
			$phoneslq1 = mysql_query($phoneslq1);
			$phoneslq1= mysql_fetch_array($phoneslq1);
		?>
<section class="footer-bar">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2><i class="ion-iphone"></i>
          <?=strip_tags(stripslashes($phoneslq1['cms_pagedes']))?>
        </h2>
        <!--<ul>
          <li><a href="<?=$settings['facebook_link'];?>" target="_blank"><i class="ion-social-facebook"></i></a></li>
          <li><a href="<?=$settings['twitter_link'];?>" target="_blank"><i class="ion-social-twitter"></i></a></li>
          <li><a href="<?=$settings['googleplus_link'];?>" target="_blank"><i class="ion-social-googleplus"></i></a></li>
        </ul>-->
        <!-- end ul -->
        <!--<h4>Follow us on social media</h4>-->
      </div>
      <!-- end col-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</section>
<footer>
  <div class="container">
    <div class="row">
	
      <div class="col-md-3 "><img src="<?=$piclogo;?>" alt="Image" class="pull-left" >
        <?php
			//Fetch About Us Details
			$FetchCmsSql = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '7'";
			$FetchCmsQuery = mysql_query($FetchCmsSql);
			$FetchCmsRows= mysql_fetch_array($FetchCmsQuery);
		?>
        <p style="width: 100%; overflow: hidden;">
          <?=stripslashes($FetchCmsRows['cms_pagedes'])?>
        </p>
      </div>
      <!-- end col-2 -->
      <div class="col-md-5 " align="center">
        <?php
			//Fetch About Us Details
			$FetchCmsSql1 = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '2'";
			$FetchCmsQuery1 = mysql_query($FetchCmsSql1);
			$FetchCmsRows1= mysql_fetch_array($FetchCmsQuery1);
		?>
        <h3> <b>
          <?=$FetchCmsRows1['cms_page_heading']?>
          </b> </h3>
        <p>
          <?=stripslashes($FetchCmsRows1['cms_pagedes'])?>
        </p>
      </div>
      <!-- end col-4 -->
      <!-- end col-2 -->
      <div class="col-md-4 ">
        <h4>Social VIC Nursing Agency</h4>
        <ul>
          <li><a href="<?=$settings['facebook_link']?>">Facebook</a></li>
          <li><a href="<?=$settings['twitter_link']?>">Twitter</a></li>
          <!--<li><a href="<?=$settings['googleplus_link']?>">Google Plus</a></li>-->
          <li><a href="<?=$settings['instagram_link']?>">Linkedin</a></li>
        </ul>
      </div>
      <!-- end col-2 -->
    </div>
    <!-- end row -->
  </div>
  <div class="col-lg-6" >
    <div class="copyright" >
      <!--<p> &copy; 2015  Reserved By  VIC Nursing Agency.</p>-->
    </div>
  </div>
  <!--<div class="col-lg-6" >
<div class="copyright1" >
<p>Designed & Developed By <a href="http://www.goigi.com" target="_blank">GOIGI</a></p>
</div>
</div>  -->
  <!-- end container -->
</footer>
<script>
    /*function check(e)
    {
    alert(e.keyCode);
    }*/
    document.onkeydown = function(e) {
           // if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {//Alt+c, Alt+v will also be disabled sadly.
			if (e.ctrlKey && e.keyCode === 85) {//Alt+c, Alt+v will also be disabled sadly.
               return false;
            }
            
    };
    </script>
