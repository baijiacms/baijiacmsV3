<?php 
          mysqld_update('thirdlogin', array('enabled' =>1) , array('code' => 'alipay','beid'=>$_CMS['beid']));
?>