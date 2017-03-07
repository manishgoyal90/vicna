 <?php
			//Fetch About Us Details
			$contact = "SELECT * FROM ".TABLE_PREFIX."cms WHERE id= '4'";
			$contact = mysql_query($contact);
			$contact= mysql_fetch_array($contact);
		?>
<style>
@media(max-width:992px){
.right-menu-inner-div{
float:right
}
}
</style>
<header class="abc">
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-5"> <span class="phone"><i class="ion-iphone"></i><?=strip_tags(stripslashes($contact['cms_pagedes']));?></span> </div>
        <!-- end col-3 -->
     <!--   <div class="col-md-6 col-sm-5 hidden-xs">
          
        </div>-->
        <!-- end col-6 -->
        <div class="col-md-4 col-sm-7 hiden-xs">
        </div>
       <div class="col-lg-4 col-md-5 col-sm-6 col-xs-7 right-menu-inner-div" style="margin-top: 9px;">
          <div class="language">
              <div class="col-sm-4 hidden">
           <!--a href="register.php" class="btn-ghost-md" >Register</a---> 
              </div>
          <?php if(isset($_SESSION['userid'])){?>
          	   <div class="col-sm-6 col-xs-6" align="right">
	<a href="logout.php" class="btn-ghost-md">Log Out</a>
              </div>
         
              <div class="col-sm-6 col-xs-6" align="right">
               <?php if($_SESSION['usertype'] == 'Client'){?>
					<a href="clientProfile.php" class="btn-ghost-md">My Home</a>
               <?php }else{?>
               		<a href="profileStuff.php" class="btn-ghost-md">My Home</a>
               <?php }?>
              </div>
           <?php }else{?>
          
              <div class="col-sm-6 col-xs-6">
	<a href="login.php" class="btn-ghost-md">  Clients Login</a>
              </div>
               <div class="col-sm-6 col-xs-6">
	<a href="login1.php"  class="btn-ghost-md">  Staff Login</a>
              </div>
           <?php } ?>
          </div>
          <!-- end language --> 
        </div>
        <!-- end col-3 --> 
      </div>
      <!-- end row --> 
    </div>
    <!-- end container --> 
  </div>
  <!-- end top-bar -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container">
      <div class="navbar-header">
	  <?php
  	$Getlogo = "SELECT * FROM ".TABLE_PREFIX."banner WHERE BannerId = '36'";
	$Getlogo = mysql_query($Getlogo) or die(mysql_error());
	$Getlogo = mysql_fetch_array($Getlogo);
	
		if($Getlogo['BannerImage'] == "")
			{
				$pic = "images/nopic.jpg";
			}
			else if(!is_file("Banner/fullsize/".$Getlogo['BannerImage']))
			{
				$piclogo = "images/nopic.jpg";
			}
			else
			{
				$piclogo = "Banner/fullsize/".$Getlogo['BannerImage'];
			}	
  ?>
        <button type="button" class="navbar-toggle toggle-menu menu-left push-body" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a class="navbar-brand" href="index.php"><img src="<?=$piclogo;?>" alt="Image" style="height: 83px; margin-top: -18px;"></a> </div>
      <!-- end navbar-header -->
      <div class="collapse navbar-collapse cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="bs-example-navbar-collapse-1">
      <!--  <form class="visible-xs">
          <input type="text" placeholder="Type a word to find">
          <input type="submit" value="SEARCH">
        </form>-->
        <!-- end form -->
<!--        <ul class="social-media hidden-sm">
          <li><a href="#"><i class="ion-social-facebook"></i></a></li>
          <li><a href="#"><i class="ion-social-twitter"></i></a></li>
          <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
        </ul>-->
        <!-- end social-media -->
        
        <ul class="nav navbar-nav">
          <li><a href="index.php">HOME</a></li>
           <li><a href="#">NURSES</a>
             <ul>
              <li><a href="training.php">Training & Development</a></li>
              <li><a href="rewards.php">Rewards & Support</a></li>
              <li><a href="refer.php">Refer-a-Pal</a></li>
              <li><a href="event.php">News & Events</a></li>
                <!--<li><a href="testimonial.php">Testimonials</a></li>-->
              <li><a href="app.php">Superstar of the Month</a></li>
                  </ul>
                  </li>
          <li><a href="#">CLIENTS</a>
            <ul>
            <li><a href="client.php">Partner with VICNA</a></li>
              <li><a href="request.php">Request a Nurse</a></li>
              <li><a href="feedback.php">Your Feedback</a></li>
              <!--<li><a href="call.php">Request a Call Back</a></li>-->
            </ul>
            <!-- end dropdown --> 
          </li>
          <li><a href="#">JOIN US </a>
           <ul>
      <li><a href="work.php">Working with VICNA</a></li>
              <li><a href="apply.php">Apply Now</a></li>
             </ul></li>
          <li><a href="contact-us.php">CONTACT US</a></li>
        </ul>
        <!-- end nav --> 
      </div>
      <!-- end navbar-collapse --> 
    </div>
    <!-- end container --> 
  </nav>
  <!-- end navbar --> 
</header>

<div class="top">
</div>