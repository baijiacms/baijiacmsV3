<?php

 $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
 	  										
   	 	  	$hasaddon16=false;
   	 	  	$normal_order_list = array();
   	 	  	$express_order_list = array();
                  	$addon16=mysqld_select("SELECT * FROM " . table('modules') . " WHERE name = 'addon16' limit 1");
                  	if(!empty($addon16['name']))
                  	{
                  			if(is_file(ADDONS_ROOT.'addon16/key.php'))
												{
													 $normal_order_list = mysqld_selectall("SELECT * FROM " . table('addon16_printer') . " WHERE  printertype=0 and beid=:beid order by isdefault desc",array(':beid'=>$_CMS['beid']));
		  										 $express_order_list = mysqld_selectall("SELECT * FROM " . table('addon16_printer') . " WHERE  printertype=1 and beid=:beid order by isdefault desc",array(':beid'=>$_CMS['beid']));
												 	$hasaddon16=true;
												}
                  		
                  	}
		 if ($operation == 'display') {
            $pindex = max(1, intval($_GP['page']));
            $psize = 20;
            $status = !isset($_GP['status']) ? 1 : $_GP['status'];
            $sendtype = !isset($_GP['sendtype']) ? 0 : $_GP['sendtype'];
            $condition = '';
            $param_ordersn=$_GP['ordersn'];
 						if (!empty($_GP['ordersn'])) {
                $condition .= " AND (ordersn LIKE '%{$_GP['ordersn']}%' or  be_ordersn LIKE '%{$_GP['ordersn']}%' )";
           }
                if (!empty($_GP['userid'])) {
                $condition .= " AND openid='".$_GP['userid']."'";
            }
						if (!empty($_GP['only_shop'])) {
                $condition .= " AND is_be=1";
            }
            	if (!empty($_GP['paytype'])) {
                $condition .= " AND paytypecode ='".$_GP['paytype']."'";
            }
            	if (!empty($_GP['dispatch'])) {
                $condition .= " AND dispatch =".intval($_GP['dispatch']);
            }
              if (!empty($_GP['endtime'])) {
                $condition .= " AND createtime  <= ". strtotime($_GP['endtime']);
            }
               if (!empty($_GP['begintime'])) {
                $condition .= " AND createtime  >= ". strtotime($_GP['begintime']);
            }
            
            
            
            if (!empty($_GP['member_mobile'])) {
            	$tx_member = mysqld_select("SELECT openid FROM " . table('member')." where mobile='".$_GP['member_mobile']."'" );
              if(!empty($tx_member['openid']))
               { 
               
                $condition .= " AND openid ='".$tx_member['openid']."' ";
              }
            }
              if (!empty($_GP['weixin_nickname'])) {
            	$weixin_wxfanss = mysqld_selectall("SELECT openid FROM " . table('weixin_wxfans')." where nickname like '%".$_GP['weixin_nickname']."%'" );
              if(!empty($weixin_wxfanss))
               {
               	$wxopenstr='';
               	foreach($weixin_wxfanss as $wxfanss) { 
					  		 	$wxopenstr=$wxopenstr."'".$wxfanss['openid']."',";
								 } 		$wxopenstr=$wxopenstr."'-1'";
                $condition .= " AND openid  in (".$wxopenstr.") ";
              }else
              {
              	 $condition .= " AND openid  in (-1) ";
              }
            }
           if (!empty($_GP['address_value'])) {
                $condition .= " AND (address_realname  LIKE '%{$_GP['address_value']}%' or address_mobile  LIKE '%{$_GP['address_value']}%')";
            }
            if (!empty($_GP['good_name'])) {
                	$shop_order_goods = mysqld_selectall("SELECT orderid FROM " . table('shop_order_goods')." where title LIKE '%{$_GP['good_name']}%' and is_system=".intval($_GP['is_good_system'])." "  );
                if(!empty($shop_order_goods))
               {
               	$system_store_str='';
               	foreach($shop_order_goods as $goods) { 
					  		 	$goods_str=$goods_str."'".$goods['orderid']."',";
								 } 		$goods_str=$goods_str."'-1'";
                $condition .= " AND id  in (".$goods_str.") ";
               
              } else
              {
              	    $condition .= " AND id  in (-1) ";
              }
                  $condition .= " AND is_system=".intval($_GP['is_good_system'])." " ;
            }
           
           if ($status != -99) {
          	if($status==0)
            	{
            		       $condition .= " AND status = 0";
            	}
            		if($status==-1)
            	{
            		       $condition .= " AND (status = -1 or (be_status=-1 ))";
            	}
            	
            	if($status==1)
            	{
            		       $condition .= " AND (status =1 and (be_status=0))";
            	}
            	if($status==2)
            	{
            		       $condition .= " AND (be_status=2 )";
            	}
            	
            	if($status==3)
            	{
            		       $condition .= " AND (be_status=3)";
            	}
            	 	if($status==-2)
            	{
            		       $condition .= " AND ( be_status=-2)";
            	}
            	
            		 	if($status==-6)
            	{
            		       $condition .= " AND (be_status=-6 )";
            	}
            	
            }
						$dispatchs = mysqld_selectall("SELECT * FROM " . table('dispatch') );
						$dispatchdata=array();
					  if(is_array($dispatchs)) {
					  		foreach($dispatchs as $disitem) { 
					  		$dispatchdata[$disitem['code']]=$disitem;
								 } 
							 }
							 $selectCondition=" LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
						  if (!empty($_GP['report'])) {
						  	$selectCondition="";
						  }
					
            $list = mysqld_selectall("SELECT * FROM " . table('shop_order') . " WHERE 1=1 $condition and beid=:beid ORDER BY  createtime DESC ".$selectCondition,array(':beid'=>$_CMS['beid']));
            $total = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order') . " WHERE 1=1  $condition and beid=:beid",array(':beid'=>$_CMS['beid']));
     
            $pager = pagination($total, $pindex, $psize);
				
				 	 foreach ( $list as $id => $item) {
				 	 	$to_member=mysqld_select("SELECT istemplate,nickname,mobile from " . table('member') . " where  openid=:openid and beid=:beid ",array(':openid' => $item['openid'],':beid'=>$_CMS['beid']));
			             	  	$list[$id]['isguest']=$to_member['istemplate'];
               				 $list[$id]['uname']=empty($to_member['nickname'])?$to_member['mobile']:$to_member['nickname'];
                
                }
				 if (!empty($_GP['report'])) {
				
				 	 foreach ( $list as $id => $item) {
			             	 	$list[$id]['ordergoods']=mysqld_selectall("SELECT (select category.name	from" . table('shop_category') . " category where (0=goods.ccate and category.id=goods.pcate) or (0!=goods.ccate and category.id=goods.ccate) ) as categoryname,goods.thumb,ordersgoods.price,ordersgoods.total,goods.title,ordersgoods.optionname from " . table('shop_order_goods') . " ordersgoods left join " . table('shop_goods') . " goods on goods.id=ordersgoods.goodsid  where  ordersgoods.orderid=:oid and goods.is_system=0 order by ordersgoods.createtime  desc ",array(':oid' => $item['id']));;
                  	
                }
                	 $report='orderreport';
                	require_once 'report.php';
             					exit;
					}
                  	$payments = mysqld_selectall("SELECT * FROM " . table('payment') . " WHERE enabled = 1");
                  	
                  	$hasaddon11=false;
                  	$addon11=mysqld_select("SELECT * FROM " . table('modules') . " WHERE name = 'addon11' limit 1");
                  	if(!empty($addon11['name']))
                  	{
                  			if(is_file(ADDONS_ROOT.'addon11/key.php'))
												{
												 	$hasaddon11=true;
												}
                  		
                  	}
                  	
                  	
                  	  
             include page('order_list');
        }
        if ($operation == 'detail') {
        	$orderid=intval($_GP['id']);
        	 system_check_order_status($orderid);
        	   $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id=:id and beid=:beid",array(":id"=>$orderid,':beid'=>$_CMS['beid']));
        	   
        	       	  	if(empty($order['id']))
           	{
           		 message('未找到相关订单!', refresh(), 'error');
           	}
          
        	   
        $dispatchlist = mysqld_selectall("SELECT * FROM " . table('dispatch')." where sendtype=0 and enabled = 1 and is_system=0 and beid=:beid ",array(':beid'=>$_CMS['beid']));
        
         	$payments = mysqld_selectall("SELECT * FROM " . table('payment') . " WHERE enabled = 1");
							$dispatchs = mysqld_selectall("SELECT * FROM " . table('dispatch')." where is_system=0 and beid=:beid ",array(':beid'=>$_CMS['beid']));
					$dispatchdata=array();
					  if(is_array($dispatchs)) {
					  		foreach($dispatchs as $disitem) { 
					  		$dispatchdata[$disitem['code']]=$disitem;
								 } 
							 }
			 $goods = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') 
                    . " WHERE orderid='{$orderid}' and beid=:beid",array(':beid'=>$_CMS['beid']));
            $order['goods'] = $goods;
            
            if (checksubmit('confirmsend')) {//ok
            		if(empty($order['is_be'])){
               		message("总部订单不能操作");
               	}
                if ($_GP['express']!="-1" && empty($_GP['expresssn'])) {
                    message('请输入快递单号！');
                }        
                $express=$_GP['express'];
                 if ($express=="-1")
                 {
                 	$express="";
                 	}
              
                 		updateOrderStock($orderid,true,true);
                 	
                mysqld_update('shop_order', array(
                    'be_status' => 2,'be_updatetime'=>time(),
                    'be_express' => $express,
                    'be_expresscom' => $_GP['expresscom'],
                    'be_expresssn' => $_GP['expresssn']), array('id' => $orderid,'beid'=>$_CMS['beid']));
    				
               	 	 if($_CMS['addons_bj_message']) {
	 	           $order = mysqld_select("select * from " . table('shop_order') . " where id='".$orderid."' and beid=:beid",array(':beid'=>$_CMS['beid']));
     
 $express_dispatch = mysqld_select("select * from " . table('dispatch') . " where code='".$order['express']."'  and is_system=0 and beid=:beid  limit 1",array(':beid'=>$_CMS['beid']));
 

              bj_message_sendddfhtz( $order['ordersn'],$express_dispatch['name'],$order['expresssn'],$order['openid'],$orderid);
  }
  
                    
                message('发货操作成功！', refresh(), 'success');
            }
            
            
            if (checksubmit('be_cancelsend')) {
            		if(empty($order['is_be'])){
               		message("总部订单不能操作");
               	}
            
                 		updateOrderStock($orderid,false,true);
                mysqld_update('shop_order', array(
                    'be_status' => 0
                        ), array('id' => $orderid,'beid'=>$_CMS['beid']));
         
                        
                message('取消发货操作成功！', refresh(), 'success');
            }     
          
              
                 if (checksubmit('save_be_remark')) {
               		
                mysqld_update('shop_order', array('be_remark' => $_GP['be_remark']), array('id' => $orderid,'beid'=>$_CMS['beid']));
              
                message('订单备注保存成功！', refresh(), 'success');
            }
            
            
              if (checksubmit('be_close')) {
           
                mysqld_update('shop_order', array('be_status' => -1,'updatetime'=>time()), array('id' => $orderid));
                
                		   mysqld_update('bj_tbk_order', array('gstatus' => -1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
             
        
                
                message('分店订单关闭操作成功！', refresh(), 'success');
            }
              if (checksubmit('be_finish')) {
            
            	        if (empty($order['isrest'])) {
           		 $this->setOrderCredit($order['openid'],$orderid,true,'订单:'.$order['be_ordersn'].'完成新增积分');
           		}
                mysqld_update('shop_order', array('be_status' => 3,'be_has_gfinish'=>1,'updatetime'=>time()), array('id' => $orderid));
                 mysqld_update('shop_order_goods', array('status' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
          
               
              
              
            mysqld_update('bj_tbk_order', array('gstatus' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
          
                   
                 	 if($_CMS['addons_bj_message']) {
	 	
 $order = mysqld_select("select * from " . table('shop_order') . " where id='".$orderid."' ");
 
	 	
              bj_message_sendddqrshtz( $order['be_ordersn'],$order['openid'],$orderid);
  }
    	 if($_CMS['addons_bj_tbk'])
			        {
			        	bj_tbk_sendxjdlshtz($orderid);
			        }
                message('订单操作成功！', refresh(), 'success');
            }
            
                   if (checksubmit('be_returnmoney')) {//ok
           	
           	if($order['paytype']==3)
           	{
           		 message('货到付款订单不能进行退款操作!', refresh(), 'error');
           	}
           	
           	  	if(($order['status']==1&&($order['be_status']==0||$order['be_status']==-2))==false)
           	{
           		 message('订单状态不符不能进行退款操作!', refresh(), 'error');
           	}
           	
           		$returnmoney=$_GP['returnmoney'];
									$returnmoney=sprintf("%.2f",$returnmoney);
									$returnmoney=round($returnmoney,2); 
								if($returnmoney<=0)
								{
									
								message('请输入退款金额');	
								}
									$returnmoney=$_GP['returnmoney'];
								
                  mysqld_update('shop_order', array('be_status' => -6,'be_returnmoney' => $returnmoney,'be_returnmoneytype' =>intval($_GP['returnmoneytype'])), array('id' => $orderid));
        		      mysqld_update('bj_tbk_order', array('gstatus' => -6, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
             
              
        		    mysqld_update('shop_order_goods', array('status' =>  -6, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
           
                	 if($_CMS['addons_bj_message']) {
	 	
								 $order = mysqld_select("select * from " . table('shop_order') . " where id='".$orderid."'");
								 
									 	
								              bj_message_sendtkcgtz( $order['be_ordersn'],$returnmoney,$order['openid'],$orderid);
					
								  }
									if(empty($_GP['returnmoneytype']))
							{
					
								member_gold($order['openid'],$returnmoney,'addgold','分店订单:'.$order['be_ordersn'].'退款返还余额');
										 message('退款操作成功，已退款到用户余额！', refresh(), 'success');
          
								}
								 
					 message('退款操作成功！', refresh(), 'success');
          			
								
                 }
              
              
            
        
           
             $order_member = mysqld_select("SELECT * FROM " . table('member') . " WHERE openid = :openid ", array(':openid' => $order['openid']));
         
            $weixin_wxfans = mysqld_selectall("SELECT * FROM " . table('weixin_wxfans') . " WHERE openid = :openid ", array(':openid' => $order['openid']));
            $alipay_alifans = mysqld_selectall("SELECT * FROM " . table('alipay_alifans') . " WHERE openid = :openid", array(':openid' => $order['openid']));
      
       
        if(!empty($_GP['isall']))
           {
          	 include page('order');
          	
          	
          	}else{
           if(!empty($_GP['isbe']))
           {
        	  include page('order_be');
        	}else
        	{
        		include page('order_zong');
        	}
        }
        
        }
        
        
      