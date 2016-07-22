<?php

							$settings=globaSetting();
		if(empty($settings['regsiter_usesms'])||empty($settings['sms_change_pwd2'])||empty($settings['sms_change_pwd2_signname']))
		{
			
			message("未开启短信接口无法进行密码取回");	
		}
				
		if (checksubmit("submit")) {
				if(empty($_GP['mobile']))
			{
					message("请输入手机号！");	
			}
			$member = mysqld_select("SELECT * FROM ".table('member')." where mobile=:mobile and beid=:beid", array(':mobile' => $_GP['mobile'],':beid'=>$_CMS['beid']));
			if(empty($member['openid']))
			{
					message("未找到相关账户！");	
			}
	
	
		if(empty($_GP['fromsmspage']))
		{
			  system_sms_send($_GP['mobile'],'change_pwd2',$settings['sms_change_pwd2'],$settings['sms_change_pwd2_signname']);
					  	include themePage('repwd_newpwd');
					  	exit;
		}
			if(!empty($_GP['fromsmspage']))
		{
		
		if(empty($_GP['mobilecode']))
		{
				  message("请输入手机验证码。");
				  exit;
		}
			if(empty($_GP['renewpwd']))
		{
				  message("请输入密码。");
				  exit;
		}
						if($_GP['renewpwd']!=$_GP['recheckpwd'])
			{
				  message("两次密码不相同！");
				  exit;
			}
					 $vcode_check=system_sms_validate($_GP['mobile'],'change_pwd2',$_GP['mobilecode']);
				
					  if( $vcode_check)
					  {
					 		$pwd=md5($_GP['recheckpwd']);
							mysqld_update('member',array('pwd'=>$pwd),array('openid'=>$member['openid']));
								  message('密码修改成功！', mobile_url('login'), 'success');
					  }else
					  {
					  	
					  		  message("验证码错误");		
					  	
					  }
		}
		
		
		
		
		
		}
	
		include themePage('repwd');