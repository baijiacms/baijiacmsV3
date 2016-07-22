<?php 
$pay_submit_data=array('gold_pay_desc'=>
htmlspecialchars_decode($_GP['gold_pay_desc']));
mysqld_update('payment',array('order' => $_GP['pay_order'],'configs'=> serialize($pay_submit_data)) , array('code' => 'gold',"beid"=>$_CMS['beid']));
	mysqld_update('payment', array('enabled' => '1') , array('code' => 'gold',"beid"=>$_CMS['beid']));
?>