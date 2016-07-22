<?php
			$code=$_GP['code'];
			$settings=globaSetting();
			
			   if (checksubmit('submit')) {
			   	 require WEB_ROOT.'/system/modules/plugin/thirdlogin/'.$code.'/submit.php';
				message('保存成功！',create_url('site', array('name' => 'modules','do' => 'thirdlogin')),'success');
			  }
			$item = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE code = :code and beid=:beid", array(':code' => $code,':beid'=>$_CMS['beid']));
			$configs = unserialize($item['configs']);
     include WEB_ROOT.'/system/modules/plugin/thirdlogin/'.$code.'/config.php';