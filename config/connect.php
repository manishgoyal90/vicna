<?php
error_reporting(0);
session_start();
ob_start();
define('PROJECT_NAME', 'Vic Nursing Agency');
define('ALIAS', 'Vic Nursing Agency');
define('FAVICON', 'images/favicon.png');
define('TABLE_PREFIX', 'hr_');

define('REELPAGES_SEO_PREFIX','Vic Nursing Agency');

//date_default_timezone_set('Asia/Kolkata');

if($_SERVER['HTTP_HOST']=='192.168.1.102' || $_SERVER['HTTP_HOST']=='127.0.0.1' || $_SERVER['HTTP_HOST']=='localhost')
{
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASS', '');
define('DB_NAME', 'vicna');
define("BASE_URL", "http://192.168.1.102/vicna/admin/");
define("DIR_PATH", str_replace("\\","/",$_SERVER['DOCUMENT_ROOT'])."/vicna/admin/");

$title = "Vic Nursing Agency";
$siteurl = "http://localhost/vicna";
$site_login_url = "http://localhost/vicna/login.php";
$siteurladmin = "http://localhost/vicna/admin/";
$siteimg = "http://localhost/vicna/img";
$activationlink = "http://localhost/vicna/memberactivation.php";
}
else
{//die('samiran');
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'jimnacom_vicna');
define('DB_PASS', 'Info@2016');
define('DB_NAME', 'jimnacom_vicna');
define("BASE_URL", 'http://vicna.com.au/CMS/');
define("DIR_PATH", str_replace("\\","/",$_SERVER['DOCUMENT_ROOT'])."/CMS/");

$title = "Vic Nursing Agency";
$siteimg = "http://vicna.com.au/img";
$siteurl = "http://vicna.com.au";
$siteurladmin = "http://vicna.com.au/";
$activationlink = "http://vicna.com.au/memberactivation.php";
//Change the max upload size
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
}

$con = mysql_connect(DB_HOST,DB_USERNAME,DB_PASS) or die("Database connection error");
$db = mysql_select_db(DB_NAME,$con) or die("Database connection error");

//For Settings
$getsettings = "SELECT * FROM ".TABLE_PREFIX."settings";
$getsettings = mysql_query($getsettings) or die(mysql_error());

while($rowsettings = mysql_fetch_assoc($getsettings))
{
   $settings[$rowsettings['config_type']] = $rowsettings['config_val'];
}

?>