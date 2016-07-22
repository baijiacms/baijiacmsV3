<?php
if(file_exists(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
			header("location:index.php");
			
	  exit;
}
		define('LOCK_TO_INSTALL', true);	
$mod='mobile';
defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');
$do="install";
$_GET['name']="public";
ob_start();
$CLASS_LOADER="driver";
require 'includes/baijiacms.inc.php';
ob_end_flush();
exit;

