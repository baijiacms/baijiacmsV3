<?php
			$settings=globaSetting();
			if (checksubmit("submit")) {
            $cfg = array(
                 'allow_qqlogin' => intval($_GP['allow_qqlogin']),
                'qq_appid' => $_GP['qq_appid'],
                 'qq_secret' =>$_GP['qq_secret'],
                 'allow_sinalogin' => intval($_GP['allow_sinalogin']),
						  	'sina_appid' => $_GP['sina_appid'],
				   		  'sina_secret' => $_GP['sina_secret']
            );
          	refreshSetting($cfg);
            message('保存成功', 'refresh', 'success');
        }
		include page('thirdlogin');