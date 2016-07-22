<?php
defined('SYSTEM_IN') or exit('Access Denied');

require_once("common.php");
$payment = mysqld_select("SELECT * FROM " . table('payment') . " WHERE  enabled=1 and code='alipay' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
$configs=unserialize($payment['configs']);
$verify_result = verifyReturn($configs['alipay_safepid'],$configs['alipay_safekey']);

$post_data = serialize($_GET);

mysqld_insert('paylog', array('typename'=>'支付宝返回数据记录','pdate'=>$post_data,'ptype'=>'success','paytype'=>'alipay',"beid"=>$_CMS['beid']));
$response_msg="";
if($verify_result) {

	
	$out_trade_no = $_GET['out_trade_no'];
	$trade_no = $_GET['trade_no'];
	$trade_status = $_GET['trade_status'];
    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
    	
    	$out_trade_no=explode('-',$out_trade_no);
				$ordersn = $out_trade_no[0];
					$orderid = $out_trade_no[1];
						$index=strpos($ordersn,"g");
						
							
	$paylog_alipay=array('createtime'=>time(),'alipay_safepid'=>$configs['alipay_safepid'],'buyer_email'=>$_GET['buyer_email']
	,'buyer_id'=>$_GET['buyer_id'],'out_trade_no'=>$_GET['out_trade_no'],'seller_email'=>$_GET['seller_email'],'seller_id'=>$_GET['seller_id'],'total_fee'=>$_GET['total_fee'],'trade_no'=>$_GET['trade_no'],'body'=>$_GET['body']
	,'orderid'=>$orderid ,'ordersn'=>$ordersn,'presult'=>'error','order_table'=>'','reason'=>'');
							
							
				if(empty($index))
				{
						$paylog_alipay['order_table']='shop_order';
						 $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id and ordersn=:ordersn", array(':id' => $orderid,':ordersn'=>$ordersn));
						if(!empty($order['id']))
						{
							require_once WEB_ROOT.'/system/shopwap/class/mobile/order_notice_mail.php';  
		             mailnotice($orderid);
							if($order['status']==1)
							{
				  
							mysqld_insert('paylog', array('typename'=>'支付成功','pdate'=>$post_data,'ptype'=>'success','paytype'=>'alipay',"beid"=>$_CMS['beid']));
		      	message('支付成功！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'myorder')),'success');
							}else
							{
								
							
								
							mysqld_update('shop_order', array('status'=>1,'updatetime'=>time(),'paytime'=>time()), array('id' =>  $order['id']));
		      	updateOrderStock($order['id']);
		      	
		      		$paylog_alipay['presult']='success';
						$paylog_alipay['reason']='支付成功';
	      	mysqld_insert('paylog_alipay', $paylog_alipay);
		      	
		      	
							mysqld_insert('paylog', array('typename'=>'支付成功','pdate'=>$post_data,'ptype'=>'success','paytype'=>'alipay',"beid"=>$_CMS['beid']));
		     message('支付成功！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'myorder')),'success');
				
							}
								  
							exit;
						}else
						{
							
									$paylog_alipay['presult']='error';
						$paylog_alipay['reason']='未找到相关订单';
	      	mysqld_insert('paylog_alipay', $paylog_alipay);
							
							mysqld_insert('paylog', array('typename'=>'未找到相关订单','pdate'=>$post_data,'ptype'=>'error','paytype'=>'alipay',"beid"=>$_CMS['beid']));
		      exit;
						}
			}else
			{//余额充值
					$paylog_alipay['order_table']='gold_order';
					$order = mysqld_select("SELECT * FROM " . table('gold_order') . " WHERE id = :id and ordersn=:ordersn", array(':id' => $orderid,':ordersn'=>$ordersn));
					if(!empty($order['id']))
					{
						if($order['status']==0)
						{
						
	      	
						mysqld_update('gold_order', array('status'=>1,'paytime'=>time()), array('id' =>  $order['id']));
	      
     				member_gold($order['openid'],$order['price'],'addgold','余额在线充值-支付宝支付');
     				
	      			$paylog_alipay['presult']='success';
						$paylog_alipay['reason']='支付成功';
	      	mysqld_insert('paylog_alipay', $paylog_alipay);
	      
						mysqld_insert('paylog', array('typename'=>'余额充值成功','pdate'=>$post_data,'ptype'=>'success','paytype'=>'alipay',"beid"=>$_CMS['beid']));
						
     				  	 if($_CMS['addons_bj_message']) {
              bj_message_sendyeczcg( $order['price'],$order['openid']);
  }
						}
				 message('余额充值成功！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'myorder')),'success');
					}else
					{
								$paylog_alipay['presult']='error';
						$paylog_alipay['reason']='未找到相关订单';
	      	mysqld_insert('paylog_alipay', $paylog_alipay);
	      	
						mysqld_insert('paylog', array('typename'=>'余额充值未找到订单','pdate'=>$post_data,'ptype'=>'error','paytype'=>'alipay',"beid"=>$_CMS['beid']));
	  	 message('余额充值未找到订单！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex')),'error');
	      exit;
					}
			
				
			}
    	
   } 
      $response_msg= "trade_status=".$_GET['trade_status'];

	
}
else {
	
	mysqld_insert('paylog', array('typename'=>'验证失败','pdate'=>$post_data,'ptype'=>'error','paytype'=>'alipay',"beid"=>$_CMS['beid']));
      $response_msg= $response_msg. "验证失败";
}
?>
<!DOCTYPE HTML>
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <title>支付宝手机网站支付接口</title>
	</head>
    <body>
    	<?php echo  $response_msg;?>
    </body>
</html>