<?php
				$member=get_member_account();
					$openid =$member['openid'] ;
        $orderid = intval($_GP['orderid']);
              $topage = intval($_GP['topay']);
        $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id and openid =:openid and beid=:beid", array(':id' => $orderid,':openid'=>$openid,':beid'=>$_CMS['beid']));
        $goodsstr="";
     	if(empty($order['id']))
     	{
     		message("未找到相关订单");
     	}	
     	
     	
     	   	if(!empty($topage))
     	{
     		      		$paymentconfig="";
							if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
								$paymentconfig=" and code!='alipay'";
							}else
							{
								if (is_mobile_request()) {
										$paymentconfig=" and code!='weixin'";
									}	
							}
					    $payments = mysqld_selectall("select * from " . table("payment")." where enabled=1 and beid=:beid {$paymentconfig} order by `order` desc",array(':beid'=>$_CMS['beid']));
  		
     		      include themePage('order_pay');
     		      exit;
     	}	
     		if($_GP['isok'] == '1'&&$order['paytypecode']=='weixin') {
					message('支付成功！',WEBSITE_ROOT.mobile_url('myorder'),'success');
				}
        if (!empty($order['status'])) {
            message('抱歉，您的订单已经付款或是被关闭，请重新进入付款！', mobile_url('myorder'), 'error');
        }
        
          if(empty($_GP['paymentcode']))
         {
         message("请选择付款方式");	
         }
                 $payment = mysqld_select("select * from " . table("payment")." where enabled=1 and `code`=:code and beid=:beid ",array('code'=>$_GP['paymentcode'],':beid'=>$_CMS['beid']));
  		if(empty($payment['id']))
         {
         message("未找到付款方式，付款失败");	
         }
        
            $ordergoods = mysqld_selectall("SELECT goodsid,optionid,total FROM " . table('shop_order_goods') . " WHERE orderid = '{$orderid}' and beid=:beid",array(':beid'=>$_CMS['beid']));
            if (!empty($ordergoods)) {
            	$goodsids=array();
              foreach ($ordergoods as $gooditem) {
              	$goodsids[]=$gooditem['goodsid'];
              }
                $goods = mysqld_selectall("SELECT id, title, thumb, marketprice, total,credit FROM " . table('shop_goods') . " WHERE  ((is_system=0 and beid=:beid) or is_system=1) and id IN ('" . implode("','", $goodsids) . "')",array(':beid'=>$_CMS['beid']));
            }
            $goodtitle='';
            		if (!empty($goods)) {
                    foreach ($goods as $row) {
                    	if(empty($goodtitle))
                    	{
                    		 $goodtitle=$row['title'];
                    	}
                    	$_optionid=$ordergoods[$row['id']]['optionid'];
                    	$optionidtitle ='';
                    	if(!empty($_optionid))
                    	{
                    	 $optionidtitle = mysqld_select("select title from " . table("shop_goods_option")." where id=:id",array('id'=>$_optionid));
                    	 $optionidtitle=$optionidtitle['title'];
  										}
												$goodsstr .="{$row['title']} {$optionidtitle} X{$ordergoods[$row['id']]['total']}\n";
                      }
                }
       
         
         $paytypecode=$payment['code'];
         
 
         	$paytype=$this->getPaytypebycode($paytypecode);
         	$status=$order['status'];
        
       
         	mysqld_update('shop_order', array('paytypecode'=>$payment['code'],'status'=>0,'paytypename'=>$payment['name'],'paytype'=>$paytype),array('id'=>$orderid,'beid'=>$_CMS['beid']));

         
    	require(WEB_ROOT.'/system/modules/plugin/payment/'.$paytypecode.'/payaction.php'); 
    	exit;