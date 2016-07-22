<?php
							$member=get_member_account(true,true);
					$openid =$member['openid'] ;
					$memberinfo=member_get($openid);
					if(empty($memberinfo['pwd']))
					{
						$hiddenoldpwd=true;
					}
				if (checksubmit("submit")) {
		

					if(!empty($memberinfo['pwd']))
					{
						if(empty($_GP['pwd']))
						{
								message("请输入密码！");	
						}
						if($memberinfo['pwd']!=md5($_GP['oldpwd']))
						{
								message("原始密码错误！");	
						}
				}
				
				
				$doaction=true;
					$settings=globaSetting();
		if(!empty($memberinfo['mobile'])&&!empty($settings['regsiter_usesms'])&&!empty($settings['sms_change_pwd1'])&&!empty($settings['sms_change_pwd1_signname']))
		{
			$mobile=$memberinfo['mobile'];
			$doaction=false;
				if(!empty($_GP['fromsmspage']))
			{
					if(empty($_GP['mobilecode']))
					{
						message("验证码不能空");	
					}
					
						  $vcode_check=system_sms_validate($mobile,'change_pwd1',$_GP['mobilecode']);
						  if( $vcode_check)
						  {
						
						    $doaction=true;	
						  }else
						  {
						
						  	  message("验证码错误");	
						  	  
						  }
			}else
			{
				
							system_sms_send($mobile,'change_pwd1',$settings['sms_change_pwd1'],$settings['sms_change_pwd1_signname']);
					  	include themePage('member_pwd_smscheck');
					  	exit;
			}
		}
					if($doaction)
		{
								$data = array('pwd' => md5($_GP['pwd']));

				mysqld_update('member', $data,array('openid'=>$openid,'beid'=>$_CMS['beid']));
					refresh_account($openid);
			  message('密码修改成功！', mobile_url('fansindex'), 'success');
			}
				}
					   include themePage('member_pwd');