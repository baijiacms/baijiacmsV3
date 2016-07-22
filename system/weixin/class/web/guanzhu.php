<?php
defined('SYSTEM_IN') or exit('Access Denied');
			$settings=globaSetting();
			 if (checksubmit()) {
			 	            $cfg = array(
               'weixin_guanzhu' => $_GP['weixin_guanzhu'],
                'weixin_guanzhu_open' => intval($_GP['weixin_guanzhu_open'])
            );
        
         
          refreshSetting($cfg);
			 	    message('保存成功', 'refresh', 'success');
			}
							include page('guanzhu');