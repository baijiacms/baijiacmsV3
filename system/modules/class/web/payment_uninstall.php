<?php
			$code=$_GP['code'];
			require WEB_ROOT.'/system/modules/plugin/payment/'.$code.'/uninstall.php';
			 	message('关闭成功！','refresh','success');