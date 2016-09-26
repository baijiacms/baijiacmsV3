<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');

			     
if(SYSTEM_THIRDLOGIN=='qq')
{   
$qqlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='qq' and beid=:beid",array('beid'=>$_CMS['beid']));
if(!empty($qqlogin)&&!empty($qqlogin['id']))
{
			
function member_create_qq($qq_openid,$avatar='',$nickname='',$gender=0)
{
	if(!empty($qq_openid))
	{
		$qq_fans = mysqld_select("SELECT * FROM " . table('qq_qqfans') . " WHERE qq_openid=:qq_openid and beid=:beid ", array(':qq_openid' =>$qq_openid,':beid'=>$_CMS['beid']));
		if(empty($qq_fans['qq_openid']))
			{
					$row = array(
					'nickname'=> $nickname,
					'gender' => intval($gender),
					'qq_openid' => $qq_openid,
					'avatar'=> $avatar,
					'createtime' => TIMESTAMP
				);
				$row['beid']=$_CMS['beid'];
				
				mysqld_insert('qq_qqfans', $row);	
			}else
			{
					$row = array(
					'nickname'=> $nickname,
					'gender' => intval($gender),
					'avatar'=> $avatar
				);
				mysqld_update('qq_qqfans', $row,array('qq_openid' => $qq_openid,'beid'=>$_CMS['beid']));	
				
			}
	}
}
			
			
				if(isset($_GP['code']) && trim($_GP['code'])!=''){
					
						$configs = unserialize($qqlogin['configs']);
					$thirdlogin_qq_appid=$configs['thirdlogin_qq_appid'];
					$thirdlogin_qq_appkey=$configs['thirdlogin_qq_appkey'];
					$callback_url=WEBSITE_ROOT."qqcallback.php";
					$code=$_GP['code'];
						$params=array(
						'grant_type'=>'authorization_code',
						'client_id'=>$thirdlogin_qq_appid,
						'client_secret'=>$thirdlogin_qq_appkey,
						'code'=>$code,
						'state'=>'',
						'redirect_uri'=>$callback_url
					);
				
				
					        	$request_url="https://graph.qq.com/oauth2.0/token?";
					
					$url=$request_url.http_build_query($params);
					$result=http_get($url);
					$json_r=array();
					if(!empty($result))parse_str($result, $json_r);
				 $json_r;
		
					$result = $json_r;
				}
				if(isset($result['access_token']) && $result['access_token']!=''){
						$params=array(
						'access_token'=>$result['access_token']
					);
					
					        	$request_url="https://graph.qq.com/oauth2.0/me?";
					$url=$request_url.http_build_query($params);
					$result_str=http_get($url);
					$json_r=array();
					if(!empty($result_str)){
						preg_match('/callback\(\s+(.*?)\s+\)/i', $result_str, $result_a);
						
						$json_r=json_decode($result_a[1], true);
						$openid=$json_r['openid']; 
					
						if(!empty($openid))
						{
							$sessionAccount=array('openid'=>$openid);
							member_create_qq($openid);
							member_login_qq($openid);
							$_SESSION[MOBILE_QQ_OPENID]=$openid;
							$_SESSION[MOBILE_SESSION_ACCOUNT]=$sessionAccount;
						}
						
					}
					
				}
									
									
					
					
		}
}