<?php

			$code=$_GP['code'];
			
			 mysqld_update('dispatch',array('enabled' => 0) , array('code' => $code,'is_system'=>1));
			mysqld_update('shop_dispatch',array('deleted' => 1) , array('express' => $code,'is_system'=>1));
			 	message('关闭成功！','refresh','success');