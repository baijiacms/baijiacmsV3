<?php
if(!file_exists(str_replace("\\",'/', dirname(__FILE__)).'/config/install.link'))
{
	if((empty($_REQUEST['name'])||!empty($_REQUEST['name'])&&$_REQUEST['name']!='public'))
	{
			header("location:install.php");
		  exit;
	}
}
if(defined('SYSTEM_ACT')&&SYSTEM_ACT=='mobile')
{
	$mod='mobile';
}else
{
	$mod=empty($_REQUEST['mod'])?'mobile':$_REQUEST['mod'];	
}
if($mod=='mobile')
{
	defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'mobile');
}else
{
	defined('SYSTEM_ACT') or define('SYSTEM_ACT', 'index');	
}
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

