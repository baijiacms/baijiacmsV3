<?php
defined('SYSTEM_IN') or exit('Access Denied');
	require_once("common.php");
$payment = mysqld_select("SELECT * FROM " . table('payment') . " WHERE  enabled=1 and code='alipay' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
$configs=unserialize($payment['configs']);
$verify_result = verifyNotify($configs['alipay_safepid'],$configs['alipay_safekey']);

$post_data = serialize($_GET);
mysqld_insert('paylog', array('typename'=>'支付宝返回数据记录','pdate'=>$post_data,'ptype'=>'success','paytype'=>'alipay',"beid"=>$_CMS['beid']));
     
if($verify_result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号

	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];


    	if ($_POST['trade_status'] == 'TRADE_SUCCESS'||$_POST['trade_status'] == 'TRADE_FINISHED') {
				$out_trade_no=explode('-',$out_trade_no);
				$ordersn = $out_trade_no[0];
					$orderid = $out_trade_no[1];
				$index=strpos($ordersn,"g");
				
				$paylog_alipay=array('createtime'=>time(),'alipay_safepid'=>$configs['alipay_safepid'],'buyer_email'=>$_POST['buyer_email']
	,'buyer_id'=>$_POST['buyer_id'],'out_trade_no'=>$_POST['out_trade_no'],'seller_email'=>$_POST['seller_email'],'seller_id'=>$_POST['seller_id'],'total_fee'=>$_POST['total_fee'],'trade_no'=>$_POST['trade_no'],'body'=>$_POST['body']
	,'orderid'=>$orderid ,'ordersn'=>$ordersn,'presult'=>'error','order_table'=>'','reason'=>'');
				
				if(empty($index))
				{
						$paylog_alipay['order_table']='shop_order';
					 $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id and ordersn=:ordersn", array(':id' => $orderid,':ordersn'=>$ordersn));
					if(!empty($order['id']))
					{
						if($order['status']==0)
						{
		
	      	
						mysqld_update('shop_order', array('status'=>1,'updatetime'=>time(),'paytime'=>time()), array('id' =>  $order['id']));
	      
	      						$paylog_alipay['presult']='success';
						$paylog_alipay['reason']='支付成功';
	      	mysqld_insert('paylog_alipay', $paylog_alipay);
	      
	      
						mysqld_insert('paylog', array('typename'=>'支付成功','pdate'=>$post_data,'ptype'=>'success','paytype'=>'alipay',"beid"=>$_CMS['beid']));
						
						  require_once WEB_ROOT.'/system/shopwap/class/mobile/order_notice_mail.php';  
	             mailnotice($orderid);
	      //	message('支付成功！',WEBSITE_ROOT.'index.php?mod=mobile&name=shopwap&do=myorder','success');
						}else
						{
					   //				message('该订单不是支付状态无法支付',WEBSITE_ROOT.'index.php?mod=mobile&name=shopwap&do=myorder','error');
		
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
			{//余额支付
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
						exit;
					}else
					{
							$paylog_alipay['presult']='error';
						$paylog_alipay['reason']='未找到相关订单';
	      	mysqld_insert('paylog_alipay', $paylog_alipay);
	      	
						mysqld_insert('paylog', array('typename'=>'余额充值未找到订单','pdate'=>$post_data,'ptype'=>'error','paytype'=>'alipay',"beid"=>$_CMS['beid']));
	      exit;
					}
				
			}
    }

        
	echo "success";		
	
}
else {
	
	mysqld_insert('paylog', array('typename'=>'通信出错','pdate'=>$post_data,'ptype'=>'error','paytype'=>'alipay',"beid"=>$_CMS['beid']));
    echo "fail";

}