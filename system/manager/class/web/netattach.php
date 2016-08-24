<?php
		
			$settings=globaSystemSetting();
				if (checksubmit("testsubmit")) {
						require_once(WEB_ROOT.'/system/common/lib/lib_ftp.php');
							$ftp=new baijiacms_ftp();
			$ftp->connect();
			$ftp->ftp_pwd();
					if($ftp->error()) {
			message('链接失败，错误号:'.$ftp->error());
			}
			    message('测试成功', 'refresh', 'success');
				}
			if (checksubmit("submit")) {
				if(!empty($_GP['system_isnetattach'])&&$_GP['system_isnetattach']==1)
				{
						if(empty($_GP['system_ftp_ip'])||empty($_GP['system_ftp_attachurl'])||empty($_GP['system_ftp_username'])||empty($_GP['system_ftp_passwd']))
				{
					
					message("请填写完整");
				}
					
				}
				
					if(!empty($_GP['system_isnetattach'])&&$_GP['system_isnetattach']==2)
				{
						if(empty($_GP['system_oss_attachurl'])||empty($_GP['system_oss_access_id'])||empty($_GP['system_oss_access_key']))
					{
						message("请填写完整");
					}
					
				}
				
				$cfg=array('system_isnetattach'=> intval($_GP['system_isnetattach']),
				'system_ftp_ip'=>$_GP['system_ftp_ip'],
						'system_ftp_port'=>$_GP['system_ftp_port'],
								'system_ftp_ssl'=>$_GP['system_ftp_ssl'],
								'system_ftp_timeout'=> intval($_GP['system_ftp_timeout']),
						'system_ftp_pasv'=> intval($_GP['system_ftp_pasv']),
						'system_ftp_attachurl'=>$_GP['system_ftp_attachurl'],
				'system_ftp_username'=>$_GP['system_ftp_username'],
				'system_ftp_passwd'=>$_GP['system_ftp_passwd'],
				'system_ftp_ftproot'=>$_GP['system_ftp_ftproot'],
						'system_oss_attachurl'=>$_GP['system_oss_attachurl'],
								'system_oss_access_id'=>$_GP['system_oss_access_id'],
										'system_oss_access_key'=>$_GP['system_oss_access_key'],
											'system_oss_bucket'=>$_GP['system_oss_bucket'],
															'system_oss_endpoint'=>$_GP['system_oss_endpoint']
				
				);
          	refreshSystemSetting($cfg);
          	
            message('保存成功', 'refresh', 'success');
        }
    
		include page('netattach');