<?php

			$code=$_GP['code'];
			 mysqld_update('dispatch',array('enabled' => 0) , array('code' => $code,'beid'=>$_CMS['beid']));
			 
			mysqld_update('shop_dispatch',array('deleted' => 1) , array('express' => $code,'beid'=>$_CMS['beid']));
			 	message('关闭成功！','refresh','success');