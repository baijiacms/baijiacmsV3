<?php
			 mysqld_update('thirdlogin',array('enabled' => 0) , array('code' => 'weixin','beid'=>$_CMS['beid']));
			  mysqld_update('payment',array('enabled' => 0) , array('code' => 'weixin','beid'=>$_CMS['beid']));
?>


