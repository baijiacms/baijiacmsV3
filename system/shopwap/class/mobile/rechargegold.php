<?php
		   $member=get_member_account(true,true);
			$openid = $member['openid'];
       $member=member_get($openid);
       
       $paymentconfig="";
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
			$paymentconfig=" and code!='alipay'";
		}else
		{
			if (is_mobile_request()) {
					$paymentconfig=" and code!='weixin'";
				}	
		}
       
      $paymentlist = mysqld_selectall("select * from " . table("payment")." where `enabled`=1  and `code`!='gold' and `online`=1 and beid=:beid {$paymentconfig} ",array(':beid'=>$_CMS['beid']));
  		$paymentscount = mysqld_selectcolumn("select count(id) from " . table("payment")." where `enabled`=1  and `code`!='gold' and `online`=1 and beid=:beid {$paymentconfig} ",array(':beid'=>$_CMS['beid']));
  		
  			if(empty($paymentscount))
         {
         message("未找到可用的在线支付方式，暂时不支持余额充值。");	
         }
  		
		 if (checksubmit("submit")) {
 		if(empty($_GP['charge'])||round($_GP['charge'],2)<=0)
		{
		message("请输入要充值的金额");	
		}
		    $paytypecode=$_GP['paymentcode'];
		    	if(empty($paytypecode))
         {
         message("请选择充值方式。");	
         }
  		
                 $payment = mysqld_select("select * from " . table("payment")." where `enabled`=1 and `code`=:code and `code`!='gold' and `online`=1  and beid=:beid ",array('code'=>$paytypecode,':beid'=>$_CMS['beid']));
  		if(empty($payment['id']))
         {
         message("未找到付款方式，付款失败");	
         }
	$goodtitle="余额充值".$_GP['charge']."元";
		
		$ordersn= 'bg'.date('Ymd') . random(6, 1);
	 $gold_order = mysqld_select("SELECT * FROM " . table('gold_order') . " WHERE ordersn = '{$ordersn}' and beid=:beid",array(':beid'=>$_CMS['beid']));
	         if(!empty($gold_order['ordersn']))
	         {
	         		$ordersn= 'bg'.date('Ymd') . random(6, 1);
	         }
		     $insert = array(
                'openid' => $openid,	
                'ordersn' => $ordersn,
                'price' => $_GP['charge'],
                'status' => 0,
                'createtime' => TIMESTAMP,'beid'=>$_CMS['beid']
            );
         
            
            mysqld_insert('gold_order', $insert);
            
             $order = mysqld_select("SELECT * FROM " . table('gold_order') . " WHERE ordersn = '{$ordersn}' and openid='{$openid}' and beid=:beid",array(':beid'=>$_CMS['beid']));
	
            
          
 	  	
 	  	
    	require(WEB_ROOT.'/system/modules/plugin/payment/'.$paytypecode.'/gold_payaction.php'); 
    exit;
	
	}
		
			include themePage('rechargegold');