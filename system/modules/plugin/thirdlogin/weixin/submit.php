<?php 
//	if(empty($_GP['weixin_appId'])||empty($_GP['weixin_appSecret']))
//	{
//	message("微信公众号appid或者appsecret不能空！");	
//	}
  //   $cfg = array(
		//				  	'weixin_appId' => $_GP['weixin_appId'],
		//		   		  'weixin_appSecret' => $_GP['weixin_appSecret']
   //         );
   //       refreshSetting($cfg);
          mysqld_update('thirdlogin', array('enabled' =>1) , array('code' => 'weixin','beid'=>$_CMS['beid']));
?>