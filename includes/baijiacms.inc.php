<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
(defined('SYSTEM_ACT') or defined('LOCK_TO_INSTALL')) or exit('Access Denied');
define('WEB_ROOT', str_replace("\\",'/', dirname(dirname(__FILE__))));
if(is_file(WEB_ROOT.'/config/version.php'))
{
	require WEB_ROOT.'/config/version.php';
}
if(is_file(WEB_ROOT.'/config/debug.php'))
{
	require WEB_ROOT.'/config/debug.php';
}
define('SAPP_NAME', '微商城');
define('CORE_VERSION', 20160701);
defined('SYSTEM_VERSION') or define('SYSTEM_VERSION', CORE_VERSION);
header('Content-type: text/html; charset=UTF-8');
define('SYSTEM_WEBROOT', WEB_ROOT);
define('TIMESTAMP', time());
define('SYSTEM_IN', true);
defined('DATA_PROTECT') or define('DATA_PROTECT', false);
defined('CUSTOM_VERSION') or define('CUSTOM_VERSION', false);
date_default_timezone_set('PRC');
$document_root = substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
define('SESSION_PREFIX', $_SERVER['HTTP_HOST']);	
define('WEB_WEBSITE', $_SERVER['HTTP_HOST']);	
define('WEBSITE_ROOT', 'http://'.$_SERVER['HTTP_HOST'].$document_root.'/');	
define('LOCAL_ATTACHMENT_WEBROOT', WEBSITE_ROOT.'attachment/');
define('RESOURCE_ROOT', WEBSITE_ROOT.'assets/');
define('SYSTEM_ROOT', WEB_ROOT.'/system/');	
define('CUSTOM_ROOT', WEB_ROOT.'/custom/');	
define('ADDONS_ROOT', WEB_ROOT.'/addons/');
defined('DEVELOPMENT') or define('DEVELOPMENT',0);
defined('SQL_DEBUG') or define('SQL_DEBUG', 0);
define('MAGIC_QUOTES_GPC', (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) || @ini_get('magic_quotes_sybase'));
if(!session_id())
{
session_start();
header("Cache-control:private");
}
if(DEVELOPMENT) {
	ini_set('display_errors','1');
	//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ERROR  | E_PARSE);
} else {
	error_reporting(0);
}
ob_start();
if(MAGIC_QUOTES_GPC) {
	  function stripslashes_deep($value){ 
         $value=is_array($value)?array_map('stripslashes_deep',$value):stripslashes($value); 
         return $value; 
     } 
     $_POST=array_map('stripslashes_deep',$_POST); 
     $_GET=array_map('stripslashes_deep',$_GET); 
     $_COOKIE=array_map('stripslashes_deep',$_COOKIE); 
     $_REQUEST=array_map('stripslashes_deep',$_REQUEST); 
}
$_GP = $_CMS =  array();
$_GP = array_merge($_GET, $_POST, $_GP);
function irequestsplite($var) {
	if (is_array($var)) {
		foreach ($var as $key => $value) {
			$var[htmlspecialchars($key)] = irequestsplite($value);
		}
	} else {
		$var = str_replace('&amp;', '&', htmlspecialchars($var, ENT_QUOTES));
	}
	return $var;
}
$_GP = irequestsplite($_GP);
$modulename = $_GP['name'];
if(empty($modulename))
{
		if(empty($mname))
	{
		if(SYSTEM_ACT=='mobile')
		{
			$modulename='shopwap';	
		}else
		{
			$modulename='public';	
		}
	}else
	{
	$modulename=$mname;	
	}
}

if(empty($_GP['do']))
{
	if(empty($do))
	{
	$_GP['do']='index';	
	}else
	{
		$_GP['do']=$do;
	}
}
$pdo = $_CMS['pdo'] = null;


$_CMS['module']=$modulename;
$_CMS['beid']=$_GP['beid'];
$bjconfigfile = WEB_ROOT."/config/config.php";
if(is_file($bjconfigfile))
{
	require WEB_ROOT.'/includes/baijiacms.mysql.inc.php';
	
}
require WEB_ROOT.'/includes/baijiacms.common.inc.php';
require WEB_ROOT.'/includes/baijiacms.define.inc.php';
require WEB_ROOT.'/includes/baijiacms.init.inc.php';




$system_module = array('common', 'index', 'member', 'modules', 'public', 'shop', 'shopwap', 'user', 'weixin','alipay','manager','bj_tbk');
if(in_array($modulename, $system_module) )
{
	$_CMS['isaddons']=false;
}else
{
$_CMS['isaddons']=true;	
}


$classname = $modulename."Addons";
if($_CMS['isaddons']==true)
	{
				require(WEB_ROOT.'/system/common/addons.php');
			if(SYSTEM_ACT=='mobile')
			{
				$file = ADDONS_ROOT . $modulename."/mobile.php";
			}else
			{
					$file = ADDONS_ROOT . $modulename."/web.php";
			}
	}else
	{
			if(SYSTEM_ACT=='mobile')
			{
				require(WEB_ROOT.'/system/common/mobile.php');
				$file = SYSTEM_ROOT . $modulename."/mobile.php";
			}else
			{
				require(WEB_ROOT.'/system/common/web.php');
					$file = SYSTEM_ROOT . $modulename."/web.php";
			}
	}
if(!is_file($file)) {
				exit('ModuleSite Definition File Not Found '.$file);
}
require $file;

if(!class_exists($classname)) {
			exit('ModuleSite Definition Class Not Found');
}
$class = new $classname();
$class->module = $modulename;
$class->inMobile = SYSTEM_ACT=='mobile';
if($_CMS['isaddons']==true)
	{
		
					if($class instanceof BjModule) {
				if(!empty($class)) {
					if(isset($_GP['do'])) {
						if(SYSTEM_ACT=='mobile')
						{
								$class->inMobile = true;
					
						}else
						{
					
								$class->inMobile = false;
						}
								$method = 'do_'.$_GP['do'];
					}
					$class->module = $modulename;
					if (method_exists($class, $method)) {
									exit($class->$method());
					}else
					{
									exit($method." no this method");
					}
							
					}
			} else {
						exit('BjSystemModule Class Definition Error');
			}
		
		
		
	}else
	{
			if($class instanceof BjSystemModule) {
				if(!empty($class)) {
					if(isset($_GP['do'])) {
						if(SYSTEM_ACT=='mobile')
						{
								$class->inMobile = true;
							if($modulename=="public"&&$_GP['do']=="kernel")
							{
								echo md5_file(__FILE__);
								exit;
							}
						}else
						{
					
								$class->inMobile = false;
						}
								$method = 'do_'.$_GP['do'];
					}
					$class->module = $modulename;
					if (method_exists($class, $method)) {
									exit($class->$method());
					}else
					{
									exit($method." no this method");
					}
							
					}
			} else {
						exit('BjSystemModule Class Definition Error');
			}
}