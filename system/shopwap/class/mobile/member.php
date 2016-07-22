<?php

							$member=get_member_account(true,true);
					$openid =$member['openid'] ;
					$memberinfo=member_get($openid);
					if ( is_use_weixin() ) {
$weixinthirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='weixin' and beid=:beid",array(':beid'=>$_CMS['beid']));

if(!empty($weixinthirdlogin)&&!empty($weixinthirdlogin['id']))
{
	$isweixin=true;
					$weixin_openid=get_weixin_openid();
				}
			}
			if (checksubmit("submit")) {
				$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and beid=:beid ", array(':openid' => $openid,':beid'=>$_CMS['beid']));
		
					$member1 = mysqld_select("SELECT * FROM ".table('member')." where mobile=:mobile and beid=:beid ", array(':mobile' => $_GP['mobile'],':beid'=>$_CMS['beid']));
			if(!empty($member1['openid'])&&$member1['openid']!=$member['openid'])
			{
					message($_GP['mobile']."已被注册。");	
			}
					
			if(empty($_GP['realname']))
			{
			message("用户名不能空");	
				
			}
				if(empty($_GP['weixinhao']))
			{
			message("微信号不能空");	
				
			}
				if(empty($_GP['nickname']))
			{
			message("昵称不能空");	
				
			}
					if(empty($_GP['mobile']))
			{
			message("手机号不能空");	
				
			}
			$doaction=true;
			$settings=globaSetting();
			if(!empty($settings['regsiter_usesms'])&&$member['mobile']!=$_GP['mobile']&&!empty($settings['regsiter_usesms'])&&!empty($settings['sms_change_mobile'])&&!empty($settings['sms_change_mobile_signname']))
			{
			$doaction=false;
					if(empty($_GP['fromsmspage']))
				{
						  system_sms_send($_GP['mobile'],'change_mobile',$settings['sms_change_mobile'],$settings['sms_change_mobile_signname']);
							  	include themePage('member_smscheck');
							  	exit;
				}
					if(!empty($_GP['fromsmspage']))
				{
							  $vcode_check=system_sms_validate($_GP['mobile'],'change_mobile',$_GP['mobilecode']);
							  if( $vcode_check)
							  {
							  		$doaction=true;
							  
							  }else
							  {
							 	 message("验证码错误");		
							  }
				}
	}
				if($doaction)
					{
							$data = array('realname' => $_GP['realname'],'nickname'=> $_GP['nickname'],'mobile' => $_GP['mobile'],'weixinhao'=> $_GP['weixinhao']
                   , 'email' => '','outgoldinfo'=>'');
     
				mysqld_update('member', $data,array('openid'=>$openid,'beid'=>$_CMS['beid']));
				refresh_account($openid);
			  message('资料修改成功！', mobile_url('fansindex'), 'success');
				}
							}
		  include themePage('member');