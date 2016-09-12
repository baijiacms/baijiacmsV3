<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
if ( is_in_weixin()) {
if ( is_use_weixin()) {
$weixinthirdlogin = mysqld_select("SELECT id FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='weixin' and beid=:beid",array(':beid'=>$_CMS['beid']));

if(!empty($weixinthirdlogin)&&!empty($weixinthirdlogin['id']))
{
	$weixin_openid=get_weixin_openid();

	if(!empty($weixin_openid))
	{
		member_login_weixin($weixin_openid);
	}
}
}
}


