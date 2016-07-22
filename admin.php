<?php
if((empty($_REQUEST['name'])||!empty($_REQUEST['name'])&&$_REQUEST['name']!='modules')&&!file_exists(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
			header("location:install.php");
			
	  exit;
}
	$mod='mobile';
	$mname="public";
	defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');
if(empty($_REQUEST['do']))
{
	$do='index';
}else
{
	
$do=$_REQUEST['do'];
}
if(!empty($do))
{
				ob_start();
				$CLASS_LOADER="driver";
				require 'includes/baijiacms.inc.php';
				ob_end_flush();
				exit;
}

