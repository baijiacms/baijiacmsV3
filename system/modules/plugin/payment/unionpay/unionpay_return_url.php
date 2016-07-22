<?php
defined('SYSTEM_IN') or exit('Access Denied');
$payment = mysqld_select("SELECT * FROM " . table('payment') . " WHERE  enabled=1 and code='unionpay' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
     $configs=unserialize($payment['configs']);
    		require_once("lib.php");
     		
     		$post_data = serialize($_POST);
     		
if (!empty($_POST) && verify($_POST) && $_POST['respCode'] == '00') {
		$txnTime=$_POST['txnTime'];
			$txnAmt=$_POST['txnAmt'];
			$queryid=$_POST['queryid'];
	$currencyCode=$_POST['currencyCode'];
	$reqReserved=$_POST['reqReserved'];
			$settleAmt=$_POST['settleAmt'];
			$settleCurrencyCode=$_POST['settleCurrencyCode'];
			$traceTime=$_POST['traceTime'];
			$traceNo=$_POST['traceNo'];
			$merId=$_POST['merId'];
		
	$ordersn=$_POST['orderId'];
		$orderid=$_POST['reqReserved'];
		
						$index=strpos($ordersn,"g");
			$paylog_unionpay=array('createtime'=>time(),'txnTime'=>$_POST['txnTime'],
			'txnTime'=>$_POST['txnTime'],
			'txnAmt'=>$_POST['txnAmt'],
			'queryid'=>$_POST['queryId'],
			'currencyCode'=>$_POST['currencyCode'],
			'reqReserved'=>$_POST['reqReserved'],
			'settleAmt'=>$_POST['settleAmt'],
			'settleCurrencyCode'=>$_POST['settleCurrencyCode'],
			'traceTime'=>$_POST['traceTime'],
			'traceNo'=>$_POST['traceNo'],
			'merId'=>$_POST['merId'],
			'orderid'=>$orderid ,'ordersn'=>$ordersn,'presult'=>'error','order_table'=>'','reason'=>'');
			
		
		
			if(empty($index))
				{	$paylog_unionpay['order_table']='shop_order';
			    $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id=:id and ordersn=:ordersn limit 1", array(':id'=>$orderid,':ordersn'=>$ordersn));
									if(!empty($order['id']))
									{
										require_once WEB_ROOT.'/system/shopwap/class/mobile/order_notice_mail.php';  
					             mailnotice( $order['id']);
										if($order['status']==1)
										{
							  		  	$paylog_unionpay['presult']='error';
						$paylog_unionpay['reason']='该订单不是支付状态无法支付';
	      	mysqld_insert('paylog_unionpay', $paylog_unionpay);
										mysqld_insert('paylog', array('typename'=>'支付成功1','pdate'=>$post_data,'ptype'=>'success','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
										}else
										{
											
										mysqld_update('shop_order', array('status'=>1,'updatetime'=>time(),'paytime'=>time()), array('id' =>  $order['id']));
					      	updateOrderStock($order['id']);
					      	
																$paylog_unionpay['presult']='success';
						$paylog_unionpay['reason']='支付成功';
	      	mysqld_insert('paylog_unionpay', $paylog_unionpay);
										mysqld_insert('paylog', array('typename'=>'支付成功','pdate'=>$post_data,'ptype'=>'success','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
							
										}
											  		echo 'success';
									    exit;
								
									}else
									{
															$paylog_unionpay['presult']='error';
						$paylog_unionpay['reason']='未找到相关订单';
	      	mysqld_insert('paylog_unionpay', $paylog_unionpay);
	      	
										mysqld_insert('paylog', array('typename'=>'未找到相关订单','pdate'=>$post_data,'ptype'=>'error','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
					    echo 'fail';
			    exit;
									}
						
					}else
					{
						
						$paylog_unionpay['order_table']='gold_order';
						  $order = mysqld_select("SELECT * FROM " . table('gold_order') . " WHERE id=:id and ordersn=:ordersn limit 1", array(':id'=>$orderid,':ordersn'=>$ordersn));
									if(!empty($order['id']))
									{
										if($order['status']==1)
										{
							  	$paylog_unionpay['presult']='error';
						$paylog_unionpay['reason']='该订单不是支付状态无法支付';
	      	mysqld_insert('paylog_unionpay', $paylog_unionpay);
										mysqld_insert('paylog', array('typename'=>'支付成功1','pdate'=>$post_data,'ptype'=>'success','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
										}else
										{
											
										mysqld_update('gold_order', array('status'=>1,'paytime'=>time()), array('id' =>  $order['id']));
								member_gold($order['openid'],$order['price'],'addgold','余额在线充值-支付宝支付');
								
																$paylog_unionpay['presult']='success';
						$paylog_unionpay['reason']='支付成功';
	      	mysqld_insert('paylog_unionpay', $paylog_unionpay);
					  
								mysqld_insert('paylog', array('typename'=>'余额充值成功','pdate'=>$post_data,'ptype'=>'success','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
						
     				  	 if($_CMS['addons_bj_message']) {
              bj_message_sendyeczcg( $order['price'],$order['openid']);
  								}
							
										}
											  		echo 'success';
									    exit;
								
									}else
									{
										
										$paylog_unionpay['presult']='error';
						$paylog_unionpay['reason']='余额充值未找到订单';
	      	mysqld_insert('paylog_unionpay', $paylog_unionpay);
										
										mysqld_insert('paylog', array('typename'=>'余额充值未找到订单','pdate'=>$post_data,'ptype'=>'error','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
					    echo 'fail';
			    exit;
									}
						
						
					}
				
}else
{
							mysqld_insert('paylog', array('typename'=>'支付失败','pdate'=>$post_data,'ptype'=>'error','paytype'=>'unionpay',"beid"=>$_CMS['beid']));
}
echo 'fail';
    exit;