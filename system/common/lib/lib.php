<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
require(WEB_ROOT.'/system/common/lib/lib_core.php');
if(is_file(WEB_ROOT.'/config/custom.php'))
{
	require WEB_ROOT.'/config/custom.php';
}
require(WEB_ROOT.'/system/common/lib/lib_account.php');

require(WEB_ROOT.'/system/common/lib/lib_weixin.php');
require(WEB_ROOT.'/system/common/lib/lib_alipay.php');
require(WEB_ROOT.'/system/common/lib/lib_sms.php');
require(WEB_ROOT.'/system/common/lib/lib_biz.php');


$_CMS['addons_bj_tbk']=true;

require(WEB_ROOT.'/system/bj_tbk/lib/lib_bj_tbk.php');
require(WEB_ROOT.'/system/bj_tbk/lib/lib_bj_tbk_message.php');
require(WEB_ROOT.'/system/bj_tbk/lib/lib_bj_tbk_qrcode.php');

require(WEB_ROOT.'/system/common/lib/lib_login.php');
