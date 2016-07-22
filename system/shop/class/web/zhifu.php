<?php
		
			$settings=globaSetting();
			if (checksubmit("submit")) {
            $cfg = array(
                'alipay_account' => $_GP['alipay_account'],
                 'alipay_partner' =>$_GP['alipay_partner'],
						  	'alipay_secret' => $_GP['alipay_secret'],
				   		  'wechat_appId' => $_GP['wechat_appId'],
				   		    'wechat_appSecret' => $_GP['wechat_appSecret'],
				   		      'wechat_mchid' => $_GP['wechat_mchid'],
				   		        'wechat_signkey' => $_GP['wechat_signkey']
            );
          	refreshSetting($cfg);
            message('保存成功', 'refresh', 'success');
        }
        	include page('zhifu');