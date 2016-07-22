<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Comments: mysql数据库操作
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
$BJCMS_ISINSTALL=false;
if(is_file(WEB_ROOT."/config/install.link"))
{
$BJCMS_ISINSTALL=true;
}
if($BJCMS_ISINSTALL==true)
{
	$_CMS['beid']=getDomainBeid();
}
if($BJCMS_ISINSTALL==true)
{
	if(!empty($_CMS['beid']))
	{
			$_CMS['store_globa_setting']=globaPriveteSetting();
	}
	$_CMS['system_globa_setting']=globaPriveteSystemSetting();

	define('ATTACHMENT_WEBROOT', WEBSITE_ROOT.'attachment/');

}


if(is_file(WEB_ROOT.'/config/config.php')&&is_file(WEB_ROOT.'/config/install.link'))
{
require(WEB_ROOT.'/system/common/lib/lib.php');
}
$_CMS[WEB_SESSION_ACCOUNT]=$_SESSION[WEB_SESSION_ACCOUNT];