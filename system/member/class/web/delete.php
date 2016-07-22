<?php
	mysqld_update('member', array('status' => intval($_GP['status'])), array('openid' => $_GP['openid'],"beid"=>$_CMS['beid']));
      message('操作成功！', 'refresh', 'success');
	