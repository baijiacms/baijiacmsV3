<?php 
	$payment = mysqld_select("SELECT id FROM " . table('payment') . " WHERE  enabled=1 and code='gold' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
     if(empty($payment['id']))
     {
     	message("未开启余额支付");
     }
			$member=get_member_account();
				$openid = $member['openid'];
				
				$order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  id=:id limit 1", array(':id' =>$orderid));
          
				$getmember=member_get($openid);
				if($getmember['gold']>=$order['price'])
				{
					
					$usegold=member_gold($openid,$order['price'],'usegold',"消费金额:".$order['price'].",订单编号：".$order['ordersn']);
					if($usegold)
					{
						$orderid=$order['id'];
					   mysqld_update('shop_order', array('status' => '1','updatetime'=>time(),'paytype' => '1','paytime'=>time()), array('id' => $orderid));
					   updateOrderStock($orderid);
					     require_once WEB_ROOT.'/system/shopwap/class/mobile/order_notice_mail.php';  
             mailnotice($orderid);
            message('订单提交成功，收货后请验货！',WEBSITE_ROOT.mobile_url('myorder'), 'success');
          }else
          {
          	 message('付款失败！', WEBSITE_ROOT.mobile_url('myorder'), 'error');
          }
				}else
				{
					 message('余额不足，无法完成付款！', WEBSITE_ROOT.mobile_url('myorder'), 'error');
				}
         
			
?>