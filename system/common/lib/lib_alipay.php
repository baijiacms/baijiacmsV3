<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
$alipaythirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='alipay' and beid=:beid",array(':beid'=>$_CMS['beid']));

if(!empty($alipaythirdlogin)&&!empty($alipaythirdlogin['id']))
{

		require_once WEB_ROOT.'/includes/lib/alipaySDK/config.php';
			require_once WEB_ROOT.'/includes/lib/alipaySDK/AopSdk.php';
		if (! empty ( $_GP["auth_code"] )) {
			$auth_code =  $_GP["auth_code"];
			require_once WEB_ROOT.'/includes/lib/alipaySDK/UserInfo.php';
			
			$userinfo = new UserInfo ();
			$alipay_user=$userinfo->getUserInfo ( $auth_code );
			if(!empty($alipay_user))
			{
		
						$alipay_openid = $alipay_user->user_id;
					if(!empty($alipay_openid)&&(!empty($_SESSION[MOBILE_ALIPAY_OPENID])&&$_SESSION[MOBILE_ALIPAY_OPENID]!=$alipay_openid)||empty($_SESSION[MOBILE_ALIPAY_OPENID]))
					{
								$nickname = characet ( $alipay_user->deliver_fullname );
						$follow=1;
						$avatar = $alipay_user->avatar;
							$gender = $alipay_user->gender;
							$gender=($gender=='F')?2:($gender=='M'?1:0);
					$fans = mysqld_select("SELECT * FROM " . table('alipay_alifans') . " WHERE alipay_openid=:alipay_openid and beid=:beid", array(':alipay_openid' =>$alipay_openid,':beid'=>$_CMS['beid']));
				 
				 if(empty($fans['alipay_openid']))
					{
						  		$row = array(
							'nickname'=> $nickname,
							'follow' => $follow,
							'gender' => intval($gender),
							'alipay_openid' => $alipay_openid,
							'avatar'=>'',
							'createtime' => TIMESTAMP,'beid'=>$_CMS['beid']
						);
							mysqld_insert('alipay_alifans', $row);	
							if(!empty($avatar)){
						mysqld_update('alipay_alifans', array('avatar'=>$avatar), array('alipay_openid' => $alipay_openid,'beid'=>$_CMS['beid']));	
							}
						}else
						{
							
							$row = array(
							'nickname'=> $nickname,
							'follow' => $follow,
							'gender' => intval($gender),
							'avatar'=>''
						);
						
						mysqld_update('alipay_alifans', $row, array('alipay_openid' => $alipay_openid,'beid'=>$_CMS['beid']));	
						
						
								if(!empty($avatar)){
						mysqld_update('alipay_alifans', array('avatar'=>$avatar), array('alipay_openid' => $alipay_openid,'beid'=>$_CMS['beid']));	
							}
							
						}
						
		
						$_SESSION[MOBILE_ALIPAY_OPENID]=$alipay_openid;
						$sessionAccount=array('openid'=>$alipay_openid);
						$_SESSION[MOBILE_SESSION_ACCOUNT]=$sessionAccount;
						member_login_alipay($alipay_openid);
					}
						
			}
		}
}