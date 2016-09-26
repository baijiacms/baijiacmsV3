<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
require(WEB_ROOT.'/system/common/lib/lib_core.php');
if(is_file(WEB_ROOT.'/config/custom.php'))
{
	require WEB_ROOT.'/config/custom.php';
}
require(WEB_ROOT.'/system/common/lib/lib_account.php');

require(WEB_ROOT.'/system/common/lib/lib_weixin.php');
require(WEB_ROOT.'/system/common/lib/lib_sms.php');
require(WEB_ROOT.'/system/common/lib/lib_biz.php');



require(WEB_ROOT.'/system/common/lib/lib_login.php');

