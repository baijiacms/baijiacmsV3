<?php
defined('SYSTEM_IN') or exit('Access Denied');
	
$settings=globaSetting();
	$system_store = mysqld_select('SELECT website FROM '.table('system_store')." where `id`=:id",array(":id"=>$_CMS['beid']));
			

				$thirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE code = :code and beid=:beid", array(':code' => 'weixin',':beid'=>$_CMS['beid']));
				   		
 if (checksubmit()) {
            $cfg = array(
               'weixinname' => $_GP['weixinname'],
                'weixintoken' => $_GP['weixintoken'],
                'EncodingAESKey' => $_GP['EncodingAESKey'],
						  	'weixin_appId' => $_GP['weixin_appId'],
				   		  'weixin_appSecret' => $_GP['weixin_appSecret'],
				   		  'weixin_autoreg'=> $_GP['weixin_autoreg'],
				   		  'weixin_autoaddress'=> $_GP['weixin_autoaddress'],
				   		  'weixin_noaccess'=> intval($_GP['weixin_noaccess'])
            );
        
         $cfg['weixin_access_token']="";
         
               	if (!empty($_FILES['weixin_logo']['tmp_name'])) {
                    $upload = file_upload($_FILES['weixin_logo']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $weixin_logo = $upload['path'];
                }
                if(!empty($weixin_logo))
                {
                	$cfg['weixin_logo']=$weixin_logo;
                }
                    if (!empty($_GP['weixin_logo_del'])) {
                	$cfg['weixin_logo'] = '';
                }
         
          refreshSetting($cfg);
         
         $settings=globaSetting();
				   		  
				  
				   		  
				   		      $thirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE `code` = :code and beid=:beid ", array(':code' => 'weixin',':beid'=>$_CMS['beid']));
              	require WEB_ROOT.'/system/modules/plugin/thirdlogin/weixin/lang.php';
             
                 if (empty($thirdlogin['id'])) {
                 		 $data = array(
                    'code' => 'weixin',
                     'enabled' => intval($_GP['thirdlogin_weixin']),
                    'name' => $_LANG['thirdlogin_weixin_name'],'beid'=>$_CMS['beid']
                  ); 
									 mysqld_insert('thirdlogin', $data);
                } else {
	                		 $data = array(
	                		  'enabled' => intval($_GP['thirdlogin_weixin']),
	                    'name' => $_LANG['thirdlogin_weixin_name'],
	                  ); 
                    mysqld_update('thirdlogin',$data , array('code' =>'weixin','beid'=>$_CMS['beid']));
                }
				   		   	
				   		  
            if(empty($settings['weixintoken'])&&!empty($_GP['weixintoken']))
	        {
	        	header("location:". create_url('site', array('name' => 'weixin','do' => 'setting')));
	        }else
	        {
            message('保存成功', 'refresh', 'success');
          }
        }
        if(empty($settings['weixintoken']))
        {
        $isfirst=true;	
        }

					include page('setting');