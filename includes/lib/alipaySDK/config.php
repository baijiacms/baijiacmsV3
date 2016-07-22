<?php

$alipay_setting=globaSetting(array(
               'alipay_name',
                'alipay_appId' ,
						  	'thirdlogin_alipay' ));

$_GP['alipay_config'] = array (
		'alipay_public_key_file' => WEB_ROOT . "/includes/lib/alipaySDK/alipay_public_key_file.pem",
		'merchant_private_key_file' => WEB_ROOT . "/config/alipay_key/".SESSION_PREFIX."_"."rsa_private_key.pem",
		'merchant_public_key_file' => WEB_ROOT. "/config/alipay_key/".SESSION_PREFIX."_"."rsa_public_key.pem",		
		'charset' => "UTF-8",
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
		'app_id' => $alipay_setting['alipay_appId']
);
$config=$_GP['alipay_config'];