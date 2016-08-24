<?php
defined('SYSTEM_IN') or exit('Access Denied');
	
$settings=globaSetting();

				$thirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE code = :code and beid=:beid", array(':code' => 'alipay',':beid'=>$_CMS['beid']));
				   		
 if (checksubmit()) {
            $cfg = array(
               'alipay_name' => $_GP['alipay_name'],
                'alipay_appId' => $_GP['alipay_appId'],
						  	'thirdlogin_alipay' => $_GP['thirdlogin_alipay']
            );
        
          if (!empty($_FILES['alipay_gy']['tmp_name'])) {
                    $upload = system_config_file_upload($_FILES['alipay_gy'],'rsa_public_key.pem','alipay_key');
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $cfg['alipay_gy'] = $upload['path'];
                }else
                {
                	    $cfg['alipay_gy'] = $settings['alipay_gy'];
                	}
                	
                	
                	   if (!empty($_FILES['alipay_sy']['tmp_name'])) {
                    $upload = system_config_file_upload($_FILES['alipay_sy'],'rsa_private_key.pem','alipay_key');
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $cfg['alipay_sy'] = $upload['path'];
                }else
                {
                	    $cfg['alipay_sy'] = $settings['alipay_sy'];
                	}
                	 $cfg['alipay_access_token']="";
          refreshSetting($cfg);
         
        $settings=globaSetting();
				   		  
				   		  
				   		      $thirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE code = :code and beid=:beid", array(':code' => 'alipay',':beid'=>$_CMS['beid']));
              	require WEB_ROOT.'/system/modules/plugin/thirdlogin/alipay/lang.php';
              
                 if (empty($thirdlogin['id'])) {
                 		 $data = array(
                 		 'beid'=>$_CMS['beid'],
                    'code' => 'alipay',
                     'enabled' => intval($_GP['thirdlogin_alipay']),
                    'name' => $_LANG['thirdlogin_alipay_name']
                  );
									 mysqld_insert('thirdlogin', $data);
                } else {
	                		 $data = array(
	                		  'enabled' => intval($_GP['thirdlogin_alipay']),
	                    'name' => $_LANG['thirdlogin_alipay_name'],
	                  );
                    mysqld_update('thirdlogin',$data , array('code' =>'alipay','beid'=>$_CMS['beid']));
                }
				   		  
				   		  
            
            message('保存成功', 'refresh', 'success');
         
        }

					include page('setting');