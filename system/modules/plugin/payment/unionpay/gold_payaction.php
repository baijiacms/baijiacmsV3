
<?php 

defined('SYSTEM_IN') or exit('Access Denied');
	
		$payment = mysqld_select("SELECT * FROM " . table('payment') . " WHERE  enabled=1 and code='unionpay' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
     $configs=unserialize($payment['configs']);
	
		require_once("lib.php");
	/*	
			$unionpay = new UnionPay();
$unionpay->config = ['frontUrl' => 'https://101.231.204.80:5000/gateway/api/frontTransReq.do', 
'signCertPath' => WEB_ROOT .$configs['shsy'], 
'signCertPwd' => $configs['bank_pwd'], 
'verifyCertPath' => WEB_ROOT .$configs['ylgy'],
'merId' => $configs['merId']]; //上面给出的配置参数
*/


$params = array(
	'version' => '5.0.0',
	'encoding' => 'utf-8',
	'certId' => getSignCertId(),
	'txnType' => '01',
	'txnSubType' => '01',
	'bizType' => '000201',
     'frontUrl' => WEBSITE_ROOT.'notify/unionpay_front_url.php?tfans=true', //后台通知地址
    'backUrl' => WEBSITE_ROOT.'notify/unionpay_return_url.php', //后台通知地址
	'signMethod' => '01',
	'channelType' => '08',
	'accessType' => '0',
	'merId' =>  $configs['merId'],
	'orderId' => $order['ordersn'],
	'txnTime' => date('YmdHis'),
	'txnAmt' => $order['price'] * 100,
	'currencyCode' => '156',
	'defaultPayType' => '0001',
	'reqReserved' => $order['id'],
);
sign($params);
$html_form = create_html($params, SDK_FRONT_TRANS_URL);
echo $html_form;

?>