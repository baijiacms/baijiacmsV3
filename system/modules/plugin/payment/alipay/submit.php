<?php 
	if(empty($_GP['alipay_account'])||empty($_GP['alipay_safekey'])||empty($_GP['alipay_safepid']))
	{
	message("请填写完整");	
	}
	


$pay_submit_data=array('alipay_account'=>
$_GP['alipay_account'],'alipay_safekey'=>
$_GP['alipay_safekey'],'alipay_safepid'=>
$_GP['alipay_safepid'],'alipay_paytype'=>
$_GP['alipay_paytype'],'alipay_payfee'=>
0,'pay_order'=>
$_GP['pay_order']);

mysqld_update('payment',array('order' => $_GP['pay_order'],'configs'=> serialize($pay_submit_data)) , array("beid"=>$_CMS['beid'],'code' => 'alipay'));


	mysqld_update('payment', array('enabled' => '1') , array("beid"=>$_CMS['beid'],'code' => 'alipay'));
?>