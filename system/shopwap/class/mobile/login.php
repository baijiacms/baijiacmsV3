<?php
	
		$system_settings=globaSystemSetting();
				if (checksubmit("submit")) {
								$mobile=$_GP['mobile'];
	
				$pwd=$_GP['password'];
					if(empty($mobile))
					{
					message("请输入手机号");	
					}
					if(empty($pwd))
					{
					message("请输入密码");	
					}
		
					
						$member=get_session_account();
						$oldsessionid=$member['openid'];
					$loginid=member_login($mobile,$pwd);
					if($loginid==-1)
					{
							message("账户已被禁用！");	
					}
					if(empty($loginid))
					{
					message("用户名或密码错误");	
					}else
					{
						integration_session_account($loginid,$oldsessionid);
						header("location:".to_member_loginfromurl());		
					}
		}
			$qqlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='qq'  and beid=:beid",array(':beid'=>$_CMS['beid']));
				if(!empty($qqlogin)&&!empty($qqlogin['id']))
				{
					$showqqlogin=true;
				}
			include themePage('login');