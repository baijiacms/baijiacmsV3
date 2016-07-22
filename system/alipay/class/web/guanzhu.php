<?php
defined('SYSTEM_IN') or exit('Access Denied');
			$settings=globaSetting();
			 if (checksubmit()) {
			 	            $cfg = array(
               'alipay_guanzhu' => $_GP['alipay_guanzhu'],
                'alipay_guanzhu_open' => intval($_GP['alipay_guanzhu_open'])
            );
        
         
          refreshSetting($cfg);
			 	    message('保存成功', 'refresh', 'success');
			}
							include page('guanzhu');