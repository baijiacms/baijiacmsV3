<?php

 $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
 	  										
   	 
		 if ($operation == 'display') {
            $pindex = max(1, intval($_GP['page']));
            $psize = 20;
             $status = !isset($_GP['status']) ? 1 : $_GP['status'];
          
  
            $sendtype = !isset($_GP['sendtype']) ? 0 : $_GP['sendtype'];
            $condition = ' and shop_order.beid='.$_CMS['beid'];
            $param_ordersn=$_GP['ordersn'];
 						if (!empty($_GP['ordersn'])) {
                $condition .= " AND shop_order.ordersn LIKE '%{$_GP['ordersn']}%'";
            }
             if (!empty($_GP['userid'])) {
                $condition .= " AND shop_order.openid='".$_GP['userid']."'";
            }
						if (!empty($_GP['only_shop'])) {
                $condition .= " AND shop_order_goods.is_system=1";
            }
            	if (!empty($_GP['paytype'])) {
                $condition .= " AND shop_order.paytypecode ='".$_GP['paytype']."'";
            }
            	if (!empty($_GP['dispatch'])) {
                $condition .= " AND shop_order.dispatch =".intval($_GP['dispatch']);
            }
              if (!empty($_GP['endtime'])) {
                $condition .= " AND shop_order.createtime  <= ". strtotime($_GP['endtime']);
            }
               if (!empty($_GP['begintime'])) {
                $condition .= " AND shop_order.createtime  >= ". strtotime($_GP['begintime']);
            }
           
            if (!empty($_GP['address_value'])) {
                $condition .= " AND (shop_order.address_realname  LIKE '%{$_GP['address_value']}%' or shop_order.address_mobile  LIKE '%{$_GP['address_value']}%')";
            }
            
                if (!empty($_GP['good_name'])) {
                	$shop_order_goods = mysqld_selectall("SELECT orderid FROM " . table('shop_order_goods')." where title LIKE '%{$_GP['good_name']}%' and is_system=".intval($_GP['is_good_system'])." "  );
                if(!empty($shop_order_goods))
               {
               	$system_store_str='';
               	foreach($shop_order_goods as $goods) { 
					  		 	$goods_str=$goods_str."'".$goods['orderid']."',";
								 } 		$goods_str=$goods_str."'-1'";
                $condition .= " AND shop_order.id  in (".$goods_str.") ";
               
              } else
              {
              	    $condition .= " AND shop_order.id  in (-1) ";
              }
                  $condition .= " AND shop_order_goods.is_system=".intval($_GP['is_good_system'])." " ;
            }
            
                if (!empty($_GP['address_mobile'])) {
                $condition .= " ";
            }
            
            	  	  if($status==-99)
            	{
            		       $condition .= " AND (shop_order_goods.status <0 or shop_order_goods.restatus=1  )	";
            	}
            	  if($status==-11)
            	{
            		       $condition .= " AND (shop_order_goods.status = -3 or  shop_order_goods.status = -7)	";
            	}
            	if($status==-12)
            	{
            		       $condition .= " AND shop_order_goods.status = -4";
            	}
            		  if($status==-13)
            	{
            		       $condition .= " AND shop_order_goods.status = 1 AND shop_order_goods.restatus = 1	";
            	}
            		if($status==-14)
            	{
            		       $condition .= " AND shop_order_goods.status = -5";
            	}
            $list = mysqld_selectall("SELECT shop_order.zong_ordersn,shop_order.be_ordersn,shop_order.ordersn,shop_order.address_realname,shop_order.address_mobile,shop_order.paytypename,shop_order_goods.* FROM " . table('shop_order_goods') . " shop_order_goods left join " . table('shop_order') . " shop_order on shop_order_goods.orderid=shop_order.id WHERE 1=1 $condition  ORDER BY shop_order_goods.updatetime DESC ".$selectCondition);
           $total = mysqld_selectcolumn("SELECT COUNT(*)  FROM " . table('shop_order_goods') . " shop_order_goods left join " . table('shop_order') . " shop_order on shop_order_goods.orderid=shop_order.id WHERE 1=1 $condition   ".$selectCondition);
           	$payments = mysqld_selectall("SELECT * FROM " . table('payment') . " WHERE enabled = 1");
                  		$dispatchs = mysqld_selectall("SELECT * FROM " . table('shop_dispatch')."where beid=:beid" , array(':beid'=> $_CMS['beid']));
						$dispatchdata=array();
					  if(is_array($dispatchs)) {
					  		foreach($dispatchs as $disitem) { 
					  		$dispatchdata[$disitem['code']]=$disitem;
								 } 
							 }
            $pager = pagination($total, $pindex, $psize);
            	
     
                   include page('goodsorder_list');
        }
        
        
           
            
            
        if ($operation == 'detail') {
        	$orderid=intval($_GP['id']);
        	$ogid=intval($_GP['ogid']);
        	   $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id=:id and beid=:beid",array(":id"=>$orderid,':beid'=> $_CMS['beid']));
        	
        	  	if(empty($order['id']))
           	{
           		 message('未找到相关订单!', refresh(), 'error');
           	}
           	        
        	    $dispatchlist = mysqld_selectall("SELECT * FROM " . table('dispatch')." where sendtype=0 and enabled = 1 and is_system=0 and beid=:beid ",array(':beid'=>$_CMS['beid']));
     
         	$payments = mysqld_selectall("SELECT * FROM " . table('payment') . " WHERE enabled = 1");
							$dispatchs = mysqld_selectall("SELECT * FROM " . table('dispatch'));
					$dispatchdata=array();
					  if(is_array($dispatchs)) {
					  		foreach($dispatchs as $disitem) { 
					  		$dispatchdata[$disitem['code']]=$disitem;
								 } 
							 }
		
      $goods = mysqld_select("SELECT * FROM " . table('shop_order_goods') . " shop_order_goods where id='{$ogid}'  and beid=:beid ",array(':beid'=> $_CMS['beid']));
          
            
            	  	if(empty($goods['id']))
           	{
           		 message('未找到相关商品!', refresh(), 'error');
           	}
           
             
              if (checksubmit('all_returnmoney')) {//ok
           	
           
           	
           	  	if($goods ['status']!=-4)
           	{
           		 message('商品状态不符不能进行退货操作!', refresh(), 'error');
           	}
           
               // $this->setOrderStock($orderid, false);
						
								
							
						     mysqld_update('shop_order_goods', array('status' => -5,'updatetime'=>time(),'be_return_money'=>1), array('id' => $goods['id'],'is_system'=>0));
        		    
        		   
               
        		    system_check_order_status($orderid);
        		  
									
								message('退货操作成功！请进行退款操作！', refresh(), 'success');
								
                
            }
               if (checksubmit('finishgoods')) {
            	
            	   
                mysqld_update('shop_order_goods', array('status' =>  1,'restatus' =>1), array('id' =>$goods['id']));
                
              		system_check_order_status($orderid);
                  
                message('确认收货成功！', refresh(), 'success');
            }
                if (checksubmit('be_good_returnmoney')) {//ok
           	//分店退款
           
       
           	  	if($goods ['status']!=-5&&$goods ['be_return_money']!=1)
           	{
           		 message('商品状态不符不是退货状态!', refresh(), 'error');
           	}
           
						
								
									$returnmoney=$_GP['returnmoney'];
									$returnmoney=sprintf("%.2f",$returnmoney);
									$returnmoney=round($returnmoney,2); 
								if($returnmoney<=0)
								{
									
								message('请输入退款金额');	
								}
									$returnmoney=$_GP['returnmoney'];
						     mysqld_update('shop_order_goods', array('be_return_money' =>2,'updatetime'=>time(),'returnmoney' => $returnmoney,'returnmoneytype' =>intval($_GP['returnmoneytype'])), array('id' => $goods['id']));
        			
							
									if(empty($_GP['returnmoneytype']))
							{
					
								member_gold($order['openid'],$returnmoney,'addgold','订单:'.$order['be_ordersn'].',商品：'.$goods['title'].(empty($goods['optionname'])?'':'['.$goods['optionname'].']').'退款返还余额');
								message('退款操作成功，已退款到用户余额！', refresh(), 'success');
								}
						
								message('退款操作成功！', refresh(), 'success');
								
                
            }
            
            
              if (checksubmit('all_returngoods')) {//ok
           	
           	
           	  	if($goods ['status']!=-3)
           	{
           		 message('商品状态不符不能进行换货操作!', refresh(), 'error');
           	}
           
               // $this->setOrderStock($orderid, false);
					    $express=$_GP['express'];
					    
									$expresssn=$_GP['expresssn'];
								 if ($express=="-1")
                 {
                 	$express="";
                 	}else
                 	{
                 				if(empty($expresssn))
							{
								message('请输入快递单号');
								}
                 	}
											$expresscom=$_GP['expresscom'];
										
						     mysqld_update('shop_order_goods', array('status' =>-7,'updatetime'=>time(),'return_express' => $express,'return_expresssn' => $expresssn,'return_expresscom' => $expresscom), array('id' => $goods['id'],'is_system'=>0));
        		  
        		   
                
        		    
        		  
        		  
								system_check_order_status($orderid);
								
								message('换货操作成功！', refresh(), 'success');
								
                
            }
            
            
              if (checksubmit('cancelsend')) {//ok
           	
           	
           	  	if($goods['status'] != -3&&$goods['status'] != -4)
           	{
           		 message('商品状态不符不能进行此操作!', refresh(), 'error');
           	}
           
              
						     mysqld_update('shop_order_goods', array('status' =>1), array('id' => $goods['id'],'is_system'=>0));
        		 
						  
            
										system_check_order_status($orderid);
								message('取消发货操作成功！', refresh(), 'success');
								
                
            }
            
               $order_member = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid ", array(':openid' => $order['openid']));
         
            $weixin_wxfans = mysqld_selectall("SELECT * FROM " . table('weixin_wxfans') . " WHERE openid = :openid ", array(':openid' => $order['openid']));
            $alipay_alifans = mysqld_selectall("SELECT * FROM " . table('alipay_alifans') . " WHERE openid = :openid ", array(':openid' => $order['openid']));
        
           if(!empty($goods['is_system']))
           {
        	  include page('goodsorder_zong');
        	}else
        	{
        		include page('goodsorder');
        	}
        }