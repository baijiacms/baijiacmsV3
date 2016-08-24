<?php

					
			if(empty($cfg['shop_openreg']))
			{
					message("商城已关闭注册");	
			}
				

		if (checksubmit("submit")) {
			$mobile=$_GP['mobile'];
	
				$pwd=$_GP['password'];
				if(empty($mobile))
			{
					message("请输入手机号！");	
			}
			
			member_create_check($mobile);
			if(empty($_GP['third_login']))
			{
					if(empty($pwd))
				{
						message("请输入密码！");	
				}
		}else
		{
			$pwd='';
		}
	
		$doaction=true;
					$settings=globaSetting();

		if(!empty($settings['regsiter_usesms'])&&!empty($settings['sms_register_user'])&&!empty($settings['sms_register_user_signname']))
		{
			$doaction=false;
				if(!empty($_GP['fromsmspage']))
			{		
					if(empty($_GP['mobilecode']))
					{
						message("验证码不能空");	
					}
					
						  $vcode_check=system_sms_validate($mobile,'register_user',$_GP['mobilecode']);
						  if( $vcode_check)
						  {
						
						    $doaction=true;	
						  }else
						  {
						
						  	  message("验证码错误");	
						  	  
						  }
			}else
			{
			
							system_sms_send($mobile,'register_user',$settings['sms_register_user'],$settings['sms_register_user_signname']);
					  	include themePage('regedit_smscheck');
					  	exit;
			}
		}

		if($doaction)
		{
		$shop_regcredit=intval($cfg['shop_regcredit']);
		


				$openid=member_create_new($mobile,$pwd);
		
				
		
				if(!empty($shop_regcredit))
				{
				member_credit($openid,$shop_regcredit,"addcredit","注册系统赠送积分");
				}
				
	
					
				save_member_login($openid);
			
					integration_session_account($openid,$oldsessionid);
			  message('注册成功！', to_member_loginfromurl(), 'success');
			}
		}
			$qqlogin = mysqld_select("SELECT id FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='qq'");
				if(!empty($qqlogin)&&!empty($qqlogin['id']))
				{
					$showqqlogin=true;
				}
	include themePage('regedit');
