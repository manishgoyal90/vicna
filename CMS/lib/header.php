<?php
include("../config/connect.php");
include("../config/manager_shared.php");

// Page detection
$page = explode("/",$_SERVER['PHP_SELF']);
$pagetitle = "";

$page = explode(".",end($page));
$page = $page[0];

switch($page)
{
	case "dashboard":
		$group['dashboard'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['dashboard'] = 'selected';
		$arrowopen['dashboard'] = 'open';
		$pagetitle = "Dashboard";
		break;
		
	case "BannerList": 
		$group['banner'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['banner'] = 'selected';
		$arrowopen['banner'] = 'open';
		$pagetitle = "Banner List";
		break;
		
	case "BannerView": 
		$group['banner'] = 'active';
		$activepage['BannerList'] = 'class="active"';
		$selected['banner'] = 'selected';
		$arrowopen['banner'] = 'open';
		$pagetitle = "Banner Info";
		break;
		
	case "Banner": 
		$group['banner'] = 'active';
		$activepage['BannerList'] = 'class="active"';
		$selected['banner'] = 'selected';
		$arrowopen['banner'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Banner";
		break;
		
		
/**************Superstar Add Start ********************************************/
	case "superstar": 
		$group['star'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['star'] = 'selected';
		$arrowopen['star'] = 'open';
		$pagetitle = "Superstar List";
		break;
		
	case "viewsuperstar": 
		$group['star'] = 'active';
		$activepage['superstar'] = 'class="active"';
		$selected['star'] = 'selected';
		$arrowopen['star'] = 'open';
		$pagetitle = "Superstar Info";
		break;
		
	case "superstaraddedit": 
		$group['star'] = 'active';
		$activepage['superstar'] = 'class="active"';
		$selected['star'] = 'selected';
		$arrowopen['star'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Superstar";
		break;
		

/************************************Superstar End ****************************/
	case "staff": 
		$group['staff'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['staff'] = 'selected';
		$arrowopen['staff'] = 'open';
		$pagetitle = "Staff List";
		break;
		
	case "staffinfo": 
		$group['staff'] = 'active';
		$activepage['staff'] = 'class="active"';
		$selected['staff'] = 'selected';
		$arrowopen['staff'] = 'open';
		$pagetitle = "Staff Info";
		break;
		
	case "addstaff": 
		$group['staff'] = 'active';
		$activepage['staff'] = 'class="active"';
		$selected['staff'] = 'selected';
		$arrowopen['staff'] = 'open';
		$pagetitle = "Add Staff";
		break;
		
/************************************Allocation Start ****************************/
	case "processClientBooking": 
		$group['allocation'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "New Shift Request";
		break;
	case "processBooking": 
		$group['allocation'] = 'active';
		$activepage['processClientBooking'] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Shift Allocation";
		break;
		
	case "advertiseShift1": 
		$group['allocation'] = 'active';
		$activepage['processClientBooking'] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Advertise New Shift";
		break;
		
	case "advertiseShift": 
		$group['allocation'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Advertise New Shift";
		break;
		
			
	case "advertiseShiftList": 
		$group['allocation'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Advertise Shifts";
		break;
		
	case "advertiseShiftView": 
		$group['allocation'] = 'active';
		$activepage['advertiseShiftList'] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "View Advertise Shifts";
		break;
	
	case "advertiseShiftView1": 
		$group['allocation'] = 'active';
		$activepage['allocatedShifts'] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "View Allocated Shift";
		break;
		
	case "allocatedShifts": 
		$group['allocation'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Allocated Shifts";
		break;
		
	case "completedShifts": 
		$group['allocation'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Completed Shifts";
		break;
		
	case "completedShiftView": 
		$group['allocation'] = 'active';
		$activepage['completedShifts'] = 'class="active"';
		$selected['allocation'] = 'selected';
		$arrowopen['allocation'] = 'open';
		$pagetitle = "Completed Shift Info";
		break;
		
	
/*********************************Allocation Ent***********************************/
/*****************Payroll Mgmt Start************************************/
	case "unprocessedShifts": 
		$group['payroll'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['payroll'] = 'selected';
		$arrowopen['payroll'] = 'open';
		$pagetitle = "Unprocessed Shifts";
		break;
		
	case "processedShifts": 
		$group['payroll'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['payroll'] = 'selected';
		$arrowopen['payroll'] = 'open';
		$pagetitle = "Processed Shifts";
		break;
		
	case "pay-enquiries": 
		$group['payroll'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['payroll'] = 'selected';
		$arrowopen['payroll'] = 'open';
		$pagetitle = "Pay Enquiries";
		break;

/*****************Payroll Mgmt End************************************/
		
/*****************Account & Billing Start************************************/

	case "unprocessedClientShifts": 
		$group['accountbill'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['accountbill'] = 'selected';
		$arrowopen['accountbill'] = 'open';
		$pagetitle = "Unprocessed Shifts";
		break;
		
	case "processedClientShifts": 
		$group['accountbill'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['accountbill'] = 'selected';
		$arrowopen['accountbill'] = 'open';
		$pagetitle = "Processed Shifts";
		break;

	case "processClientBillingEnquire": 
		$group['accountbill'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['accountbill'] = 'selected';
		$arrowopen['accountbill'] = 'open';
		$pagetitle = "Billing Enquiries";
		break;
		
	

/********************Account & Billing End *********************************/
		
	
		
	case "availableShiftList": 
		$group['availstaff'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['availstaff'] = 'selected';
		$arrowopen['availstaff'] = 'open';
		$pagetitle = "Available Shift List";
		break;
		
	case "availableShiftView": 
		$group['availstaff'] = 'active';
		$activepage['availableShiftList'] = 'class="active"';
		$selected['availstaff'] = 'selected';
		$arrowopen['availstaff'] = 'open';
		$pagetitle = "Available Shift Info";
		break;
		
	case "availableShift": 
		$group['availstaff'] = 'active';
		$activepage['availableShiftList'] = 'class="active"';
		$selected['availstaff'] = 'selected';
		$arrowopen['availstaff'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Available Shift";
		break;
		
	case "sponsorlist": 
		$group['sponsor'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['sponsor'] = 'selected';
		$arrowopen['sponsor'] = 'open';
		$pagetitle = "Sponsor & Partners List";
		break;
		
	case "sponsorview": 
		$group['sponsor'] = 'active';
		$activepage['sponsorlist'] = 'class="active"';
		$selected['sponsor'] = 'selected';
		$arrowopen['sponsor'] = 'open';
		$pagetitle = "Sponsor & Partners Info";
		break;
		
	case "sponsor": 
		$group['sponsor'] = 'active';
		$activepage['sponsorlist'] = 'class="active"';
		$selected['sponsor'] = 'selected';
		$arrowopen['sponsor'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Sponsor & Partners";
		break;
		
		
	case "gallerylist": 
		$group['gallery'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['gallery'] = 'selected';
		$arrowopen['gallery'] = 'open';
		$pagetitle = "Gallery List";
		break;
		
	case "galleryimage": 
		$group['gallery'] = 'active';
		$activepage['gallerylist'] = 'class="active"';
		$selected['gallery'] = 'selected';
		$arrowopen['gallery'] = 'open';
		$pagetitle = "Gallery Image Add";
		break;
		
	case "addimage": 
		$group['gallery'] = 'active';
		$activepage['gallerylist'] = 'class="active"';
		$selected['gallery'] = 'selected';
		$arrowopen['gallery'] = 'open';
		$pagetitle = "Gallery Image Add";
		break;
		
  case "editimage": 
		$group['gallery'] = 'active';
		$activepage['gallerylist'] = 'class="active"';
		$selected['gallery'] = 'selected';
		$arrowopen['gallery'] = 'open';
		$pagetitle = "Gallery Image Edit";
		break;
/********************************* User Mgmt Start *****************************/		
	case "userlist":
		$group['usr'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['usr'] = 'selected';
		$arrowopen['usr'] = 'open';
		$pagetitle = "User List";
		break;
		
	case "userinfo":
		$group['usr'] = 'active';
		$activepage['userlist'] = 'class="active"';
		$selected['usr'] = 'selected';
		$arrowopen['usr'] = 'open';
		$pagetitle = "User Info";
		break;
		
/********************************* User Mgmt End ************************/
		
			
	case "email-list":
		$group['newsletter'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['newsletter'] = 'selected';
		$arrowopen['newsletter'] = 'open';
		$pagetitle = "E-Mail Address List";
		break;
	case "send-newsletter":
		$group['newsletter'] = 'active';
		$activepage['send-newsletter'] = 'class="active"';
		$selected['newsletter'] = 'selected';
		$arrowopen['newsletter'] = 'open';
		$pagetitle = "Newsletter Send";
		break;
	case "newsletter-list":
		$group['newsletter'] = 'active';
		$activepage['newsletter-list'] = 'class="active"';
		$selected['newsletter'] = 'selected';
		$arrowopen['newsletter'] = 'open';
		$pagetitle = "Newsletter List";
		break;
		
	
	case "bloglist":
		$group['blog'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['blog'] = 'selected';
		$arrowopen['blog'] = 'open';
		$pagetitle = "Blog List";
		break;
		
	case "blog":
		$group['blog'] = 'active';
		$activepage['bloglist'] = 'class="active"';
		$selected['blog'] = 'selected';
		$arrowopen['blog'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Blog";
		break;
		
	case "blogview": 
		$group['blog'] = 'active';
		$activepage['bloglist'] = 'class="active"';
		$selected['blog'] = 'selected';
		$arrowopen['blog'] = 'open';
		$pagetitle = "Blog View";
		break;
		
	case "schoolandclublist":
		$group['school'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['school'] = 'selected';
		$arrowopen['school'] = 'open';
		$pagetitle = "Schools & clubs List";
		break;
		
	case "schoolandclub":
		$group['school'] = 'active';
		$activepage['schoolandclublist'] = 'class="active"';
		$selected['school'] = 'selected';
		$arrowopen['school'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Schools & clubs";
		break;
		
	case "schoolandclubview": 
		$group['school'] = 'active';
		$activepage['schoolandclublist'] = 'class="active"';
		$selected['school'] = 'selected';
		$arrowopen['school'] = 'open';
		$pagetitle = "Schools & clubs View";
		break;
		
	case "coollinkslist":
		$group['cool'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['cool'] = 'selected';
		$arrowopen['cool'] = 'open';
		$pagetitle = "Cool Links List";
		break;
		
	case "coollinks":
		$group['cool'] = 'active';
		$activepage['coollinkslist'] = 'class="active"';
		$selected['cool'] = 'selected';
		$arrowopen['cool'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Cool Links";
		break;
		
	case "coollinksview": 
		$group['cool'] = 'active';
		$activepage['coollinkslist'] = 'class="active"';
		$selected['cool'] = 'selected';
		$arrowopen['cool'] = 'open';
		$pagetitle = "Cool Links View";
		break;
		
	case "cms":
		$group['cms'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['cms'] = 'selected';
		$arrowopen['cms'] = 'open';
		$pagetitle = "CMS Page List";
		break;
		
	case "editcms":
		$group['cms'] = 'active';
		$activepage['cms'] = 'class="active"';
		$selected['cms'] = 'selected';
		$arrowopen['cms'] = 'open';
		$pagetitle = "CMS Page Edit";
		break;
		
	case "editcms1":
		$group['cms'] = 'active';
		$activepage['cms'] = 'class="active"';
		$selected['cms'] = 'selected';
		$arrowopen['cms'] = 'open';
		$pagetitle = "CMS Page Edit";
		break;
	case "editcms2":
		$group['cms'] = 'active';
		$activepage['cms'] = 'class="active"';
		$selected['cms'] = 'selected';
		$arrowopen['cms'] = 'open';
		$pagetitle = "CMS Page Edit";
		break;
/**************tranning start*******************/		
	case "training":
		$group['training'] = 'active';
		$activepage['training'] = 'class="active"';
		$selected['training'] = 'selected';
		$arrowopen['training'] = 'open';
		$pagetitle = "Training & Development";
		break;
		
	case "edittraining":
		$group['training'] = 'active';
		$activepage['training'] = 'class="active"';
		$selected['training'] = 'selected';
		$arrowopen['training'] = 'open';
		$pagetitle = "Training & Development Edit";
		break;
/**************tranning end*******************/				
	case "processClientBooking":
		$group['processClientBooking'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['processClientBooking'] = 'selected';
		$arrowopen['processClientBooking'] = 'open';
		$pagetitle = "Process Client";
		break;
		
	case "processBooking":
		$group['processClientBooking'] = 'active';
		$activepage['processClientBooking'] = 'class="active"';
		$selected['processClientBooking'] = 'selected';
		$arrowopen['processClientBooking'] = 'open';
		$pagetitle = "Process Booking";
		break;
		
	/*case "processClientBillingEnquire":
		$group['processClientBooking'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['processClientBillingEnquire'] = 'selected';
		$arrowopen['processClientBillingEnquire'] = 'open';
		$pagetitle = "Process Client Billing Enquire";
		break;*/
			
	case "processStaffPaymentEnquire":
		$group['processStaffPaymentEnquire'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['processStaffPaymentEnquire'] = 'selected';
		$arrowopen['processStaffPaymentEnquire'] = 'open';
		$pagetitle = "Process Staff Payment Enquire";
		break;	
/**********************Dont Send Menu class Start****************************/		
	case "doNotSendList":
		$group['doNotSendList'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['doNotSendList'] = 'selected';
		$arrowopen['doNotSendList'] = 'open';
		$pagetitle = "View All";
		break;
		
	
/**********************Dont Send Menu class End****************************/

/**********************Request for Work with Vicna Start****************************/		
	case "item-menu":
		$group['item-menu'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['item-menu'] = 'selected';
		$arrowopen['item-menu'] = 'open';
		$pagetitle = "All Request";
		break;
		
	
/**********************Request for Work with Vicna End****************************/		

/**********************Request for Reffered Start****************************/		
	case "refer":
		$group['refer'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['refer'] = 'selected';
		$arrowopen['refer'] = 'open';
		$pagetitle = "All Reffered";
		break;
		
	case "referview":
		$group['refer'] = 'active';
		$activepage['refer'] = 'class="active"';
		$selected['refer'] = 'selected';
		$arrowopen['refer'] = 'open';
		$pagetitle = "refer Details";
		break;
/**********************Request for Reffered End****************************/	


/**********************User Enquery Start****************************/		
	case "enquery":
		$group['enquery'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['enquery'] = 'selected';
		$arrowopen['enquery'] = 'open';
		$pagetitle = "All Enqueries";
		break;
		
	case "viewEnquery":
		$group['enquery'] = 'active';
		$activepage['enquery'] = 'class="active"';
		$selected['enquery'] = 'selected';
		$arrowopen['enquery'] = 'open';
		$pagetitle = "Enquery Details";
		break;
/**********************User Enquery End****************************/	

/**********************User Feedback Start****************************/		
	case "feedback":
		$group['feedback'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['feedback'] = 'selected';
		$arrowopen['feedback'] = 'open';
		$pagetitle = "All Feedbacks";
		break;
		
	case "viewFeedbck":
		$group['feedback'] = 'active';
		$activepage['feedback'] = 'class="active"';
		$selected['feedback'] = 'selected';
		$arrowopen['feedback'] = 'open';
		$pagetitle = "Feedback Details";
		break;
/**********************User Feedback End****************************/	
		
	
		
	case "orderlist":
		$group['order'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['order'] = 'selected';
		$arrowopen['order'] = 'open';
		$pagetitle = "Order List";
		break;
/************************Contact Start*********************/	
	case "contactlist": 
		$group['contact'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['contact'] = 'selected';
		$arrowopen['contact'] = 'open';
		$pagetitle = "Contact List";
		break;
	
	case "contactview": 
		$group['contact'] = 'active';
		$activepage['contactlist'] = 'class="active"';
		$selected['contact'] = 'selected';
		$arrowopen['contact'] = 'open';
		$pagetitle = "Contact View";
		break;
/*************Contact End**********************************/	
/************************Application Start*********************/	
	case "applicationlist": 
		$group['apply'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['apply'] = 'selected';
		$arrowopen['apply'] = 'open';
		$pagetitle = "Application List";
		break;
	
	case "viewapplication": 
		$group['apply'] = 'active';
		$activepage['applicationlist'] = 'class="active"';
		$selected['apply'] = 'selected';
		$arrowopen['apply'] = 'open';
		$pagetitle = "Application View";
		break;
/*************Application End**********************************/	
	case "newslist": 
		$group['news'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['news'] = 'selected';
		$arrowopen['news'] = 'open';
		$pagetitle = "Fund raisers/News List";
		break;
		
	case "newsview": 
		$group['news'] = 'active';
		$activepage['newslist'] = 'class="active"';
		$selected['news'] = 'selected';
		$arrowopen['news'] = 'open';
		$pagetitle = "Fund raisers/News Info";
		break;
		
	case "news": 
		$group['news'] = 'active';
		$activepage['newslist'] = 'class="active"';
		$selected['news'] = 'selected';
		$arrowopen['news'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Fund raisers/News";
		break;
		
	case "EventList": 
		$group['event'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['event'] = 'selected';
		$arrowopen['event'] = 'open';
		$pagetitle = "Event List";
		break;
		
	case "Event": 
		$group['event'] = 'active';
		$activepage['EventList'] = 'class="active"';
		$selected['event'] = 'selected';
		$arrowopen['event'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Event";
		break;
		
	case "EventView": 
		$group['event'] = 'active';
		$activepage['EventList'] = 'class="active"';
		$selected['event'] = 'selected';
		$arrowopen['event'] = 'open';
		$pagetitle = "Event View";
		break;
		
	case "proshoplist": 
		$group['proshop'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['proshop'] = 'selected';
		$arrowopen['proshop'] = 'open';
		$pagetitle = "Proshop List";
		break;
		
	case "proshop": 
		$group['proshop'] = 'active';
		$activepage['proshoplist'] = 'class="active"';
		$selected['proshop'] = 'selected';
		$arrowopen['proshop'] = 'open';
		$pagetitle = ucfirst($_REQUEST['mode'])."&nbsp;Proshop";
		break;
		
	case "proshopview": 
		$group['proshop'] = 'active';
		$activepage['proshoplist'] = 'class="active"';
		$selected['proshop'] = 'selected';
		$arrowopen['proshop'] = 'open';
		$pagetitle = "Proshop View";
		break;
		
	case "category":
		$group['cat'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['cat'] = 'selected';
		$arrowopen['cat'] = 'open';
		$pagetitle = "Category List";
		break;
		
	case "contactview": 
		$group['contact'] = 'active';
		$activepage['contactlist'] = 'class="active"';
		$selected['contact'] = 'selected';
		$arrowopen['contact'] = 'open';
		$pagetitle = "Contact View";
		break;
		
	case "videogallerylist": 
		$group['video'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['video'] = 'selected';
		$arrowopen['video'] = 'open';
		$pagetitle = "Video List";
		break;
		
	case "galleryimage3": 
		$group['video'] = 'active';
		$activepage['gallerylist3'] = 'class="active"';
		$selected['video'] = 'selected';
		$arrowopen['video'] = 'open';
		$pagetitle = "Video Add";
		break;
		
	case "addvideo": 
		$group['video'] = 'active';
		$activepage['videogallerylist'] = 'class="active"';
		$selected['video'] = 'selected';
		$arrowopen['video'] = 'open';
		$pagetitle = "Video Add";
		break;

	case "tools":
		$group['tools'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['tools'] = 'selected';
		$arrowopen['tools'] = 'open';
		$pagetitle = "Tools Pages";
		break;
		
	case "settings":
		$group['tools'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['tools'] = 'selected';
		$arrowopen['tools'] = 'open';
		$pagetitle = "Change Settings";
		break;	
		
	case "changepass":
		$group['tools'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['tools'] = 'selected';
		$arrowopen['tools'] = 'open';
		$pagetitle = "Change Password";
		break;
		
	case "adminprofile":
		$group['tools'] = 'active';
		$activepage[$page] = 'class="active"';
		$selected['tools'] = 'selected';
		$arrowopen['tools'] = 'open';
		$pagetitle = "Admin Profile";
		break;
		
	case "default":
		$activepage[$page] = '';
		break;
}
// Load cookie
if(isset($_COOKIE['AdminCookie']))
{
	$getcookie = $_COOKIE['AdminCookie'];
	$getcookie = explode("@@",$getcookie);
	
	$_SESSION['admin_id'] = $getcookie[0];
	$_SESSION['admin_username'] = $getcookie[1];
}

// Session check
if($_SESSION['admin_id'] == "")	header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title><?=ALIAS?> Admin :: <?=$pagetitle?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/gritter/css/jquery.gritter.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/chosen-bootstrap/chosen/chosen.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/select2/select2_metro.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/clockface/css/clockface.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-timepicker/compiled/timepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-colorpicker/css/colorpicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
	<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-multi-select/css/multi-select-metro.css" />
	<!-- <link href="assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/> -->
	<link href="assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-tags-input/jquery.tagsinput.css" />
	<link rel="stylesheet" href="assets/plugins/data-tables/DT_bootstrap.css" />
	<link href="assets/css/pages/profile.css" rel="stylesheet" type="text/css" />
	<link rel="shortcut icon" href="<?=FAVICON?>" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="index.php">
				<h3 style="color:#FFFFFF; margin:-10px; font-size:20px; width:500px; padding-left: 20px;"><?php echo PROJECT_NAME?><!--<img src="images/logo.png" style="width:100px;" />--></h3>
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
				<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->   
					<!-- <li class="dropdown" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-warning-sign"></i>
						<span class="badge">6</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>You have 14 new notifications</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height:250px">
									<li>
										<a href="#">
										<span class="label label-success"><i class="icon-plus"></i></span>
										New user registered. 
										<span class="time">Just now</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-important"><i class="icon-bolt"></i></span>
										Server #12 overloaded. 
										<span class="time">15 mins</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-warning"><i class="icon-bell"></i></span>
										Server #2 not responding.
										<span class="time">22 mins</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-info"><i class="icon-bullhorn"></i></span>
										Application error.
										<span class="time">40 mins</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-important"><i class="icon-bolt"></i></span>
										Database overloaded 68%. 
										<span class="time">2 hrs</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-important"><i class="icon-bolt"></i></span>
										2 user IP blocked.
										<span class="time">5 hrs</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-warning"><i class="icon-bell"></i></span>
										Storage Server #4 not responding.
										<span class="time">45 mins</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-info"><i class="icon-bullhorn"></i></span>
										System Error.
										<span class="time">55 mins</span>
										</a>
									</li>
									<li>
										<a href="#">
										<span class="label label-important"><i class="icon-bolt"></i></span>
										Database overloaded 68%. 
										<span class="time">2 hrs</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="#">See all notifications <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li> -->
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- <li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-envelope"></i>
						<span class="badge">5</span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>You have 12 new messages</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height:250px">
									<li>
										<a href="inbox.html?a=view">
										<span class="photo"><img src="./assets/img/avatar2.jpg" alt="" /></span>
										<span class="subject">
										<span class="from">Lisa Wong</span>
										<span class="time">Just Now</span>
										</span>
										<span class="message">
										Vivamus sed auctor nibh congue nibh. auctor nibh
										auctor nibh...
										</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo"><img src="./assets/img/avatar3.jpg" alt="" /></span>
										<span class="subject">
										<span class="from">Richard Doe</span>
										<span class="time">16 mins</span>
										</span>
										<span class="message">
										Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
										auctor nibh...
										</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo"><img src="./assets/img/avatar1.jpg" alt="" /></span>
										<span class="subject">
										<span class="from">Bob Nilson</span>
										<span class="time">2 hrs</span>
										</span>
										<span class="message">
										Vivamus sed nibh auctor nibh congue nibh. auctor nibh
										auctor nibh...
										</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo"><img src="./assets/img/avatar2.jpg" alt="" /></span>
										<span class="subject">
										<span class="from">Lisa Wong</span>
										<span class="time">40 mins</span>
										</span>
										<span class="message">
										Vivamus sed auctor 40% nibh congue nibh...
										</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
										<span class="photo"><img src="./assets/img/avatar3.jpg" alt="" /></span>
										<span class="subject">
										<span class="from">Richard Doe</span>
										<span class="time">46 mins</span>
										</span>
										<span class="message">
										Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
										auctor nibh...
										</span>  
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li> -->
					<!-- END INBOX DROPDOWN -->
					        
					<!-- BEGIN USER LOGIN DROPDOWN -->
                    <?php
						$FetchUserSql = "SELECT * FROM ".TABLE_PREFIX."admin_mail WHERE MailId = '1'"; 
						$FetchUserQuery = mysql_query($FetchUserSql);
						$NumRows =mysql_num_rows($FetchUserQuery);
						$rowdest = mysql_fetch_array($FetchUserQuery);
						
						if($rowdest['UserImage'] == "")
						{
							$pic = "images/nopic.jpg";
						}
						else if(!is_file("../profileimage/smallimg/".$rowdest['UserImage']))
						{
							$pic = "images/nopic.jpg";
						}
						else
						{
							$pic = "../profileimage/smallimg/".$rowdest['UserImage'];
						}
					?>
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="Wait..." src="<?=$pic?>" width="29px" border="0" />
						<span class="username"><?=$_SESSION['admin_username']?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="dashboard.php"><i class="icon-dashboard"></i> Dashboard</a></li>
							<!--<li><a href="inbox.html"><i class="icon-envelope"></i> My Inbox <span class="badge badge-important">3</span></a></li>-->
                            <li><a href="adminprofile.php"><i class="icon-user"></i> Admin Mail/Image</a></li>
							<li><a href="changepass.php"><i class="icon-calendar"></i> Change Password</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->