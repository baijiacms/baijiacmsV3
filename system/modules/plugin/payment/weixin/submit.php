<?php 
	if(empty($_GP['weixin_pay_mchId'])||empty($_GP['weixin_pay_paySignKey']))
	{
	message("请填写完整");	
	}
	


$pay_submit_data=array('weixin_pay_mchId'=>
trim($_GP['weixin_pay_mchId']),'weixin_pay_paySignKey'=>
trim($_GP['weixin_pay_paySignKey']));

mysqld_update('payment',array('order' => $_GP['pay_order'],'configs'=> serialize($pay_submit_data)) , array('code' => 'weixin',"beid"=>$_CMS['beid']));

	mysqld_update('payment', array('enabled' => '1') , array('code' => 'weixin',"beid"=>$_CMS['beid']));
	
	
?>