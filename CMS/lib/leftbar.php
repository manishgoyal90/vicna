<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onLoad="MM_preloadImages('../../../foodandgo/images/1.png')"><div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- <form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />
							<input type="button" class="submit" value=" " />
						</div>
					</form> -->
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
					&nbsp;
				</li>
				<li class="start <?=$group['dashboard']?>">
					<a href="dashboard.php">
					<i class="icon-home"></i> 
					<span class="title">Dashboard</span>
					<span class="<?=$selected['dashboard']?>"></span>
					</a>
				</li>
				<li class="has-sub <?=$group['banner']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Banner Mgmt</span>
					<span class="<?=$selected['banner']?>"></span>
					<span class="arrow <?=$arrowopen['banner']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['BannerList']?>><a href="BannerList.php">Manage  Banner</a></li>
                     
					</ul>
				</li>
				   <li class="has-sub <?=$group['cms']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">CMS Mgmt</span>
					<span class="<?=$selected['cms']?>"></span>
					<span class="arrow <?=$arrowopen['cms']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['cms']?>><a href="cms.php">Manage CMS Page</a></li>
					</ul>
				</li> 
				
				</li>
				   <li class="has-sub <?=$group['star']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Superstar Mgmt</span>
					<span class="<?=$selected['star']?>"></span>
					<span class="arrow <?=$arrowopen['star']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['superstar']?>><a href="superstar.php">Manage Superstars</a></li>
					</ul>
				</li> 
				
				<li class="has-sub <?=$group['allocation']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Shift Allocation Mgmt</span>
					<span class="<?=$selected['allocation']?>"></span>
					<span class="arrow <?=$arrowopen['allocation']?>"></span>
					</a>
					<ul class="sub-menu">
						 <li <?=$activepage['processClientBooking']?>><a href="processClientBooking.php">New Shift Request</a></li>
						 <li <?=$activepage['advertiseShift']?>><a href="advertiseShift.php?mode=add">Advertise New Shift</a></li>
						 <li <?=$activepage['advertiseShiftList']?>><a href="advertiseShiftList.php">Advertise Shifts</a></li>
						 <li <?=$activepage['allocatedShifts']?>><a href="allocatedShifts.php">Allocated Shifts</a></li>
						 <li <?=$activepage['completedShifts']?>><a href="completedShifts.php">Completed Shifts</a></li>
                       
					</ul>
				</li> 
				
				<li class="has-sub <?=$group['payroll']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Payroll Mgmt</span>
					<span class="<?=$selected['payroll']?>"></span>
					<span class="arrow <?=$arrowopen['payroll']?>"></span>
					</a>
					<ul class="sub-menu">
						 <li <?=$activepage['unprocessedShifts']?>><a href="unprocessedShifts.php">Unprocessed Shifts</a></li>
						 <li <?=$activepage['processedShifts']?>><a href="processedShifts.php">Processed Shifts</a></li>
						 <li <?=$activepage['pay-enquiries']?>><a href="pay-enquiries.php">Pay Enquiries</a></li>
						
                       
					</ul>
				</li> 
				  
				<li class="has-sub <?=$group['accountbill']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Accounts & Billing</span>
					<span class="<?=$selected['accountbill']?>"></span>
					<span class="arrow <?=$arrowopen['accountbill']?>"></span>
					</a>
					<ul class="sub-menu">
						 <li <?=$activepage['unprocessedClientShifts']?>><a href="unprocessedClientShifts.php">Unprocessed Shifts</a></li>
						 <li <?=$activepage['processedClientShifts']?>><a href="processedClientShifts.php">Processed Shifts</a></li>           	 
                       <li <?=$activepage['processClientBillingEnquire']?>><a href="processClientBillingEnquire.php">Billing Enquiries</a></li>
                       
					</ul>
				</li>    
				
                <!-- <li class="has-sub <?=$group['availstaff']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Staff Allocation Mgmt</span>
					<span class="<?=$selected['availstaff']?>"></span>
					<span class="arrow <?=$arrowopen['availstaff']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['availableShiftList']?>><a href="availableShiftList.php">Available Shifts List</a></li>
                      
                       
					</ul>
				</li> -->
				  
                 <li class="has-sub <?=$group['staff']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Staff Management</span>
					<span class="<?=$selected['staff']?>"></span>
					<span class="arrow <?=$arrowopen['staff']?>"></span>
					</a>
					<ul class="sub-menu">
                  
						<li <?=$activepage['staff']?>><a href="staff.php"> Manage Staffs </a></li>
					</ul>
				</li>
                
                
                 <!--<li class="has-sub <?=$group['processStaffPaymentEnquire']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Staff Requests</span>
					<span class="<?=$selected['processStaffPaymentEnquire']?>"></span>
					<span class="arrow <?=$arrowopen['processStaffPaymentEnquire']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['processStaffPaymentEnquire']?>><a href="processStaffPaymentEnquire.php">Payment Enquire</a></li>
					</ul>
				</li> -->
                
                <!-- <li class="has-sub <?=$group['process']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Staff Payroll</span>
					<span class="<?=$selected['process']?>"></span>
					<span class="arrow <?=$arrowopen['process']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['payroll']?>><a href="payroll.php">Payroll</a></li>
                       
					</ul>
				</li>  -->
                
                 <li class="has-sub <?=$group['usr']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Client Management</span>
					<span class="<?=$selected['usr']?>"></span>
					<span class="arrow <?=$arrowopen['usr']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['userlist']?>><a href="userlist.php">Manage Clients </a></li>
						
					</ul>
				</li>  
                
               <!-- <li class="has-sub <?=$group['processClientBooking']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Client Request</span>
					<span class="<?=$selected['processClientBooking']?>"></span>
					<span class="arrow <?=$arrowopen['processClientBooking']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['processClientBooking']?>><a href="processClientBooking.php">Book Nurse</a></li>                       	 
                      
					</ul>
				</li>   -->
				
				                       
				
				<li class="has-sub <?=$group['doNotSendList']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Donot Send Mgmt</span>
					<span class="<?=$selected['doNotSendList']?>"></span>
					<span class="arrow <?=$arrowopen['doNotSendList']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['doNotSendList']?>><a href="doNotSendList.php">View All</a></li>                       	 
                      
					</ul>
				</li>                           

				
                	<!--<li class="has-sub <?=$group['gallery']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Query Form</span>
					<span class="<?=$selected['gallery']?>"></span>
					<span class="arrow <?=$arrowopen['gallery']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['gallerylist']?>><a href="item-menu.php">View Queries</a></li>
					</ul>
				</li> -->
		<li class="has-sub <?=$group['apply']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Application Mgmt</span>
					<span class="<?=$selected['apply']?>"></span>
					<span class="arrow <?=$arrowopen['apply']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['applicationlist']?>><a href="applicationlist.php">Manage Application</a></li>
					</ul>
				</li>  
		<li class="has-sub <?= $group['item-menu'] ?>">
            <a href="javascript:;">
                <i class="icon-bookmark-empty"></i> 
                <span class="title">Work with Vicna</span>
                <span class="<?= $selected['item-menu'] ?>"></span>
                <span class="arrow <?= $arrowopen['item-menu'] ?>"></span>
            </a>
            <ul class="sub-menu">
                
                <li <?= $activepage['item-menu'] ?>><a href="item-menu.php">View Request</a></li>
            </ul>
        </li>
		
		<!--<li class="has-sub <?= $group['enquery'] ?>">
            <a href="javascript:;">
                <i class="icon-bookmark-empty"></i> 
                <span class="title">Enquery Mgmt</span>
                <span class="<?= $selected['enquery'] ?>"></span>
                <span class="arrow <?= $arrowopen['enquery'] ?>"></span>
            </a>
            <ul class="sub-menu">
                
                <li <?= $activepage['enquery'] ?>><a href="enquery.php">View Enqueries</a></li>
            </ul>
        </li>-->
		
        <li class="has-sub <?= $group['refer'] ?>">
            <a href="javascript:;">
                <i class="icon-bookmark-empty"></i> 
                <span class="title">Refer Form</span>
                <span class="<?= $selected['refer'] ?>"></span>
                <span class="arrow <?= $arrowopen['refer'] ?>"></span>
            </a>
            <ul class="sub-menu">
                
                <li <?= $activepage['refer'] ?>><a href="refer.php">View Refer Form</a></li>
            </ul>
        </li>
		<li class="has-sub <?= $group['feedback'] ?>">
            <a href="javascript:;">
                <i class="icon-bookmark-empty"></i> 
                <span class="title">Feedback Mgmt</span>
                <span class="<?= $selected['feedback'] ?>"></span>
                <span class="arrow <?= $arrowopen['feedback'] ?>"></span>
            </a>
            <ul class="sub-menu">
                
                <li <?= $activepage['feedback'] ?>><a href="feedback.php">View Feedbacks</a></li>
            </ul>
        </li>
               
                <li class="has-sub <?=$group['training']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Training Mgmt</span>
					<span class="<?=$selected['training']?>"></span>
					<span class="arrow <?=$arrowopen['training']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['training']?>><a href="training.php">Manage Training</a></li>
					</ul>
				</li> 
				
				
				
			<!--	<li class="has-sub <?=$group['gallery']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Gallery Mgmt</span>
					<span class="<?=$selected['gallery']?>"></span>
					<span class="arrow <?=$arrowopen['gallery']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['gallerylist']?>><a href="gallerylist.php">Manage Gallery</a></li>
					</ul>
				</li> 
				
			<li class="has-sub <?=$group['video']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Video Gallery Mgmt</span>
					<span class="<?=$selected['video']?>"></span>
					<span class="arrow <?=$arrowopen['video']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['videogallerylist']?>><a href="videogallerylist.php">Manage Video Gallery</a></li>
					</ul>
				</li> -->
				
				<!--<li class="has-sub <?=$group['cat']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">News/Blog Cat Mgmt</span>
					<span class="<?=$selected['cat']?>"></span>
					<span class="arrow <?=$arrowopen['cat']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['category']?>><a href="category.php">Manage News & Blog Cat</a></li>
					</ul>
				</li>-->
				
				<!--<li class="has-sub <?=$group['school']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Schools & clubs Mgmt</span>
					<span class="<?=$selected['school']?>"></span>
					<span class="arrow <?=$arrowopen['school']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['schoolandclublist']?>><a href="schoolandclublist.php">Manage Schools & clubs </a></li>
					</ul>
				</li>-->
				<!--
				<li class="has-sub <?=$group['cool']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Donation Links Mgmt</span>
					<span class="<?=$selected['cool']?>"></span>
					<span class="arrow <?=$arrowopen['cool']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['coollinkslist']?>><a href="coollinkslist.php">Manage Donation Links</a></li>
					</ul>
				</li>
				
				<li class="has-sub <?=$group['blog']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Blog Mgmt</span>
					<span class="<?=$selected['blog']?>"></span>
					<span class="arrow <?=$arrowopen['blog']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['bloglist']?>><a href="bloglist.php">Manage Blog</a></li>
					</ul>
				</li>
				
				<!--<li class="has-sub <?=$group['news']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">News Mgmt</span>
					<span class="<?=$selected['news']?>"></span>
					<span class="arrow <?=$arrowopen['news']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['newslist']?>><a href="newslist.php">Manage Fund raisers/News</a></li>
					</ul>
				</li> 	
				
				<li class="has-sub <?=$group['event']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Event Mgmt</span>
					<span class="<?=$selected['event']?>"></span>
					<span class="arrow <?=$arrowopen['event']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['EventList']?>><a href="EventList.php">Manage Event</a></li>
					</ul>
				</li> 
				-->
			  <!--<li class="has-sub <?=$group['sponsor']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Sponsors Mgmt</span>
					<span class="<?=$selected['sponsor']?>"></span>
					<span class="arrow <?=$arrowopen['sponsor']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['sponsorlist']?>><a href="sponsorlist.php">Manage Sponsors</a></li>
					</ul>
				</li> -->
				
				
				<!--<li class="has-sub <?=$group['proshop']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Proshop Mgmt</span>
					<span class="<?=$selected['proshop']?>"></span>
					<span class="arrow <?=$arrowopen['proshop']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['proshoplist']?>><a href="proshoplist.php">Manage Proshop</a></li>
					</ul>
				</li> -->
				
<!--
				<li class="has-sub <?=$group['newsletter']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Newsletter Mgmt</span>
					<span class="<?=$selected['newsletter']?>"></span>
					<span class="arrow <?=$arrowopen['newsletter']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['email-list']?>><a href="email-list.php">Manage E-Mail Address</a></li>
						<li <?=$activepage['send-newsletter']?>><a href="send-newsletter.php">Manage Send Newsletter</a></li>
						<li <?=$activepage['newsletter-list']?>><a href="newsletter-list.php">Manage Sent Newsletter List</a></li>
					</ul>
				</li> -->
				
                
                <li class="has-sub <?=$group['contact']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Contact Mgmt</span>
					<span class="<?=$selected['contact']?>"></span>
					<span class="arrow <?=$arrowopen['contact']?>"></span>
					</a>
					<ul class="sub-menu">
						<li <?=$activepage['contactlist']?>><a href="contactlist.php">Manage Contact</a></li>
					</ul>
				</li>  
                    
                                                       
                <li class="has-sub <?=$group['tools']?>">
					<a href="javascript:;">
					<i class="icon-bookmark-empty"></i> 
					<span class="title">Tools</span>
					<span class="<?=$selected['tools']?>"></span>
					<span class="arrow <?=$arrowopen['tools']?>"></span>
					</a>
					<ul class="sub-menu">
                    	<li <?=$activepage['settings']?>><a href="settings.php">Social link</a></li>
                    	<li <?=$activepage['adminprofile']?>><a href="adminprofile.php">Admin Mail/Image</a></li>
						<li <?=$activepage['changepass']?>><a href="changepass.php">Change Password</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>
                
                
                
                
                
                
                
                
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
