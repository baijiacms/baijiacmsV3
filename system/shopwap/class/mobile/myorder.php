<?php
				$member=get_member_account(false);
					$openid =$member['openid'] ;
				$id = $profile['id'];
        $op = $_GP['op'];
        $settings=globaSetting();
       $rebacktime=intval($settings['shop_system_postsale']);
          if ($op == 'orderclose') {//ok
       	   $orderid = intval($_GP['orderid']);
            $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':id' => $orderid, ':openid' => $openid,':beid'=>$_CMS['beid'] )); 	
	         	if (empty($item)) {
                message('抱歉，您的订单不存在或是已经被取消！', mobile_url('myorder'), 'error');
            }
	         	if($item['status']==0)
	         	{
	         		if(!empty($item['is_system']))
	         	{
         		mysqld_update('shop_order', array('zong_status' => -1), array('id' => $orderid, 'openid' => $openid,'beid'=>$_CMS['beid']  ));
 						}
 						
 						 	if(!empty($item['is_be']))
	         	{
         		mysqld_update('shop_order', array('be_status' => -1), array('id' => $orderid, 'openid' => $openid,'beid'=>$_CMS['beid']  ));
 						}
 						
 				
         		mysqld_update('shop_order', array('status' => -1, 'updatetime'=>time()), array('id' => $orderid,'beid'=>$_CMS['beid']  ));
 					
 						   mysqld_update('bj_tbk_order', array('gstatus' => -1, 'updatetime'=>time()), array('orderid' => $orderid,'beid'=>$_CMS['beid']));
             
             
 						message('订单关闭成功！', mobile_url('myorder'), 'success');
           
         		}else
         		{
         			
         		
	         			message('订单不是待付款状态无法关闭');	
         		}
          
       	}
       	
         if ($op == 'zong_confirm') {//ok
            $orderid = intval($_GP['orderid']);
            $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid and zong_status=2 ", array(':beid'=>$_CMS['beid'],':id' => $orderid, ':openid' => $openid ));
            if (empty($order)) {
                message('抱歉，您的订单不存在或是已经被取消！', mobile_url('myorder'), 'error');
            }
             if($order['zong_status']!=2) {
             	 message('订单不是待收货状态无法确认收货。');
            }
            
            	$this->setOrderCredit($openid,$order['id'],true,'订单:'.$order['zong_ordersn'].'收货新增积分');
              
             mysqld_update('shop_order', array('zong_status' => 3,'zong_has_gfinish'=>1, 'updatetime'=>time()), array('id' => $orderid, 'openid' => $openid ,'beid'=>$_CMS['beid']));
             mysqld_update('shop_order_goods', array('status' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>1));
          
           
             
          
              mysqld_update('bj_tbk_order', array('gstatus' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>1));
           
             
                $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':beid'=>$_CMS['beid'],':id' => $orderid, ':openid' => $openid ));
           
							$settings=globaSetting();
							
							if($order['status']==3)
							{
								 if($_CMS['addons_bj_tbk'])
			        {
			        	bj_tbk_sendxjdlshtz($orderid);
			        }
 							if($_CMS['addons_bj_message']) {
	 	

              bj_message_sendddqrshtz( $order['zong_ordersn'],$order['openid'],$orderid);
						  }
						}
  
            message('确认收货完成！', mobile_url('myorder'), 'success');
        }
        
         if ($op == 'be_confirm') {//ok
            $orderid = intval($_GP['orderid']);
            $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid and  be_status=2", array(':beid'=>$_CMS['beid'],':id' => $orderid, ':openid' => $openid ));
            if (empty($order)) {
                message('抱歉，您的订单不存在或是已经被取消！', mobile_url('myorder'), 'error');
            }
                   if($order['be_status']!=2) {
             	 message('订单不是待收货状态无法确认收货。');
            }
            	$this->setOrderCredit($openid,$order['id'],true,'订单:'.$order['be_ordersn'].'收货新增积分');
              
             mysqld_update('shop_order', array('be_status' => 3,'be_has_gfinish'=>1, 'updatetime'=>time()), array('id' => $orderid, 'openid' => $openid ,'beid'=>$_CMS['beid']));
             mysqld_update('shop_order_goods', array('status' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
           
           
            
           
              mysqld_update('bj_tbk_order', array('gstatus' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
          
                $order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':beid'=>$_CMS['beid'],':id' => $orderid, ':openid' => $openid ));
           
							$settings=globaSetting();
							
							if($order['status']==3)
							{
								 if($_CMS['addons_bj_tbk'])
			        {
			        	bj_tbk_sendxjdlshtz($orderid);
			        }
 							if($_CMS['addons_bj_message']) {
	 	

              bj_message_sendddqrshtz( $order['be_ordersn'],$order['openid'],$orderid);
						  }
						}
  
            message('确认收货完成！', mobile_url('myorder'), 'success');
        }
          if ($op == 'zong_returnpay') {//ok
            $orderid = intval($_GP['orderid']);
            $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE status=1 and id = :id AND openid = :openid and beid=:beid  ", array(':beid'=>$_CMS['beid'],':id' => $orderid, ':openid' => $openid ));
           $returnordersn=$item['zong_ordersn'];
         	$returnprice=$item['zong_goodsprice']+$item['zong_dispatchprice'];
         		$dispatchprice=$item['zong_dispatchprice'];
            if (empty($item)) {
                message('抱歉，您的订单不存在或是已经被取消！', mobile_url('myorder'), 'error');
            }
         if($item['zong_status']!=0||$item['status'] != 1) {
            	message("订单不是未发货状态，不能进行退款申请");
            }
              $shop_order_goods_list = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') . " WHERE orderid = :orderid and beid=:beid and is_system=1", array(':orderid' => $orderid,':beid'=>$_CMS['beid'] ));
          
              $ordersn = $item['zong_ordersn'];
             $opname="退款";
        if (checksubmit("submit")) {
           	    if (!empty($item['zong_status'])) {
                message('订单不是未发货状态不能申请退款。', mobile_url('myorder'), 'error');
            }
            mysqld_update('shop_order', array('zong_status' => -2,'rsreson' => $_GP['rsreson'], 'updatetime'=>time()), array('beid'=>$_CMS['beid'],'id' => $orderid, 'openid' => $openid ));
					
								 if($_CMS['addons_bj_message']) {
              bj_message_sendtksqtz( $order['ordersn'],$order['zong_price'],$order['openid'],$orderid);
  }
							   mysqld_update('bj_tbk_order', array('gstatus' => -2, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>1));
             
           
            message('申请退款成功，请等待审核！', mobile_url('myorder',array('status' =>99)), 'success');
          }
             include themePage('order_detail_returnpay');
              exit;
        }
        
              if ($op == 'be_returnpay') {//ok
            $orderid = intval($_GP['orderid']);
            $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE status=1 and id = :id AND openid = :openid and beid=:beid", array(':beid'=>$_CMS['beid'],':id' => $orderid, ':openid' => $openid ));
           $returnordersn=$item['be_ordersn'];
            	$returnprice=$item['be_goodsprice']+$item['be_dispatchprice'];
         		$dispatchprice=$item['be_dispatchprice'];
            if (empty($item)) {
                message('抱歉，您的订单不存在或是已经被取消！', refresh(), 'error');
            }
               if($item['be_status']!=0||$item['status'] != 1) {
            	message("订单不是未发货状态，不能进行退款申请");
            }
              $shop_order_goods_list = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') . " WHERE orderid = :orderid and beid=:beid and is_system=0", array(':orderid' => $orderid,':beid'=>$_CMS['beid'] ));
          
               $ordersn = $item['be_ordersn'];
               if (!empty($item['be_status'])) {
                message('订单不是未发货状态不能申请退款。', refresh(), 'error');
            }
             $opname="退款";
        if (checksubmit("submit")) {
        	    	if($order['paytype']==3)
           	{
           		 message('货到付款订单不能进行退款操作!', refresh(), 'error');
           	}
            mysqld_update('shop_order', array('be_status' => -2,'be_rsreson' => $_GP['rsreson'], 'updatetime'=>time()), array('beid'=>$_CMS['beid'],'id' => $orderid, 'openid' => $openid ));
			
								 if($_CMS['addons_bj_message']) {
              bj_message_sendtksqtz( $order['ordersn'],$order['be_price'],$order['openid'],$orderid);
  }
  				      mysqld_update('bj_tbk_order', array('gstatus' => -2, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
             
           
								
            message('申请退款成功，请等待审核！', mobile_url('myorder',array('status' => 99)), 'success');
          }
             include themePage('order_detail_returnpay');
              exit;
        }
        
        
         if ($op == 'returngood') {
          $orderid = intval($_GP['orderid']);
             $ogsid = intval($_GP['ogsid']); 
             $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':id' => $orderid, ':openid' => $openid,':beid'=>$_CMS['beid'] ));
      
          
            $shop_order_goods = mysqld_select("SELECT * FROM " . table('shop_order_goods') . " WHERE id = :id and beid=:beid", array(':id' => $ogsid,':beid'=>$_CMS['beid'] ));
           
                 if($shop_order_goods['status']!=1) { 
         	message("商品不是支付状态无法进行退货");
        }
            if(!empty($_GP['is_system']))
            {
            $ordersn = $item['zong_ordersn'];
          }
             if(!empty($_GP['is_be']))
            {
            $ordersn = $item['be_ordersn'];
          }
             if(empty($shop_order_goods['id'])||empty($item['id']))
           	{
           		 message('商品不能空', refresh(), 'error');
           	}
 
      			if(($shop_order_goods['updatetime'])<(time()-($rebacktime * 24 * 60 * 60)))
	      		{
	      			message("退货申请时间已过无法退货。");
	      		}
     
             
            if (empty($item)) {
                message('抱歉，您的订单不存在或是已经被取消！', mobile_url('myorder'), 'error');
            }
               
             
                $opname="退货";
              if (checksubmit("submit")) {
              	 if($shop_order_goods['total']<intval($_GP['retotal']))
           	{
           		 message('退货数量不能大于现有商品数量', refresh(), 'error');
           	}
                	if(empty($_GP['rsreson']))
           	{
           		 message('请输入换货原因。');
           	}
            	//'0为无状态,1正常,-3换货中,-7换货后已发货, -4退货中, -5已退货',
            		 if($shop_order_goods['total']==intval($_GP['retotal'])||true)
           	{
            mysqld_update('shop_order_goods', array('status' =>  -4,'rsreson' => $_GP['rsreson']), array('id' => $shop_order_goods['id'] ,'beid'=>$_CMS['beid']));
					  }else
						{
							 if($shop_order_goods['total']>intval($_GP['retotal']))
           		{
           			
           			
           			
           			   mysqld_insert('shop_order_goods',array(
'updatetime'=>time(),'goodsid'=>$shop_order_goods['goodsid'],'iscomment'=>2,'restatus'=>0,'title'=>$shop_order_goods['title'],'content'=>$shop_order_goods['content']
,'price'=>$shop_order_goods['price'],'total'=>0,'optionid'=>$shop_order_goods['optionid'],'createtime'=>time(),'optionname'=>$shop_order_goods['optionname'],'is_system'=>$shop_order_goods['is_system']
           			   ,'orderid'=>$shop_order_goods['orderid'],'beid'=>$_CMS['beid']));
           			          $newogsid = mysqld_insertid();
           mysqld_update('shop_order_goods', array('total' => $shop_order_goods['total']-intval($_GP['retotal'])), array('id' => $shop_order_goods['id'],'beid'=>$_CMS['beid']));
					
					  mysqld_update('shop_order_goods', array('total'=>intval($_GP['retotal']),'rsreson' => $_GP['rsreson'],'status' =>  -4 ),array('id'=>$newogsid,'beid'=>$_CMS['beid']));
					
           		}else
           		{
           			
           		message("参数错误,退货失败");	
           		}
							
						}
							   mysqld_update('bj_tbk_order', array('gstatus' => -3, 'updatetime'=>time()), array('orderid' => $orderid,'ogid'=>$ogsid));
             
            
 					system_check_order_status($orderid);
						
            message('申请退货成功，请等待审核！', mobile_url('myorder',array('status' => intval($_GP['fromstatus']))), 'success');
                  }
          include themePage('order_detail_return');
           exit;
        } 
        
        
        
        if ($op == 'resendgood') {
            $orderid = intval($_GP['orderid']);
             $ogsid = intval($_GP['ogsid']);
             $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':id' => $orderid, ':openid' => $openid,':beid'=>$_CMS['beid'] ));
           
           
        
             $shop_order_goods = mysqld_select("SELECT * FROM " . table('shop_order_goods') . " WHERE id = :id and beid=:beid", array(':id' => $ogsid,':beid'=>$_CMS['beid'] ));
           if($shop_order_goods['status']!=1) { 
         	message("商品不是支付状态无法进行换货");
        }
             if(!empty($_GP['is_system']))
            {
            $ordersn = $item['zong_ordersn'];
          }
             if(!empty($_GP['is_be']))
            {
            $ordersn = $item['be_ordersn'];
          }
            	if(empty($shop_order_goods['id'])||empty($item['id']))
           	{
           		 message('商品不能空', refresh(), 'error');
           	}
        
      			if(($shop_order_goods['updatetime'])<(time()-($rebacktime * 24 * 60 * 60)))
	      		{
	      			message("换货申请时间已过无法换货。");
	      		}
         
            if (empty($item)) {
                message('抱歉，您的订单不存在或是已经被取消！', mobile_url('myorder'), 'error');
            }
             
             
            $opname="换货";
        if (checksubmit("submit")) {
        	   if($shop_order_goods['total']<intval($_GP['retotal']))
           	{
           		 message('换货数量不能大于现有商品数量', refresh(), 'error');
           	}
          	if(empty($_GP['rsreson']))
           	{
           		 message('请输入换货原因。');
           	}
        	//'0为无状态,1正常,-3换货中,-7换货后已发货,, -4退货中, -5已退货',
        	  if(true||$shop_order_goods['total']==intval($_GP['retotal']))
           	{
            mysqld_update('shop_order_goods', array('status' =>  -3,'rsreson' => $_GP['rsreson']), array('id' => $shop_order_goods['id'],'beid'=>$_CMS['beid']));
						}else
						{
							 if($shop_order_goods['total']>intval($_GP['retotal']))
           		{
           			
           			
           			
           			   mysqld_insert('shop_order_goods',array(
'updatetime'=>time(),'goodsid'=>$shop_order_goods['goodsid'],'iscomment'=>2,'restatus'=>0,'title'=>$shop_order_goods['title'],'content'=>$shop_order_goods['content']
,'price'=>$shop_order_goods['price'],'total'=>0,'optionid'=>$shop_order_goods['optionid'],'createtime'=>time(),'optionname'=>$shop_order_goods['optionname'],'is_system'=>$shop_order_goods['is_system']
           			   ,'orderid'=>$shop_order_goods['orderid'],'beid'=>$_CMS['beid']));
           			          $newogsid = mysqld_insertid();
           mysqld_update('shop_order_goods', array('total' => $shop_order_goods['total']-intval($_GP['retotal'])), array('id' => $shop_order_goods['id'],'beid'=>$_CMS['beid']));
					
					  mysqld_update('shop_order_goods', array('total'=>intval($_GP['retotal']),'rsreson' => $_GP['rsreson'],'status' =>  -3 ),array('id'=>$newogsid,'beid'=>$_CMS['beid']));
					
           		}else
           		{
           			
           		message("参数错误,换货失败");	
           		}
							
						}
							system_check_order_status($orderid);
						 mysqld_update('bj_tbk_order', array('updatetime'=>time()), array('orderid' => $orderid,'ogid'=>$ogsid));
             
          	
            message('申请换货成功，请等待审核！', mobile_url('myorder',array('status' => intval($_GP['fromstatus']))), 'success');
             }
          include themePage('order_detail_return');
           exit;
        }
        
        
         if ($op == 'returncomment') {//ok
            $orderid = intval($_GP['orderid']);
             $ogsid = intval($_GP['ogsid']);
             
             $list = mysqld_selectall("SELECT comment.*,member.realname,member.mobile FROM " . table('shop_goods_comment') . " comment  left join " . table('member') . " member on comment.openid=member.openid WHERE comment.orderid=:orderid and comment.openid=:openid and member.beid=:beid ", array(':orderid' => $orderid, 'openid' => $openid,':beid'=>$_CMS['beid'] ));
           
           $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':id' => $orderid, ':openid' => $openid,':beid'=>$_CMS['beid'] ));
         
    
            $shop_order = mysqld_select("SELECT * FROM " . table('shop_order_goods') . " WHERE id = :id and beid=:beid", array(':id' => $ogsid,':beid'=>$_CMS['beid'] ));
           	if(empty($shop_order['id'])||empty($item['id']))
           	{
           		 message('商品不能空', refresh(), 'error');
           	}
           	
           	     if(!empty($shop_order['iscomment'])||$shop_order['status']<0) { 
         	message("商品不是待评论状态无法进行评论");
        }
        if (checksubmit("submit")) {
        	   $optionid = intval($_GP['optionid']);
        	    
           	 $option = mysqld_select("select * from " . table("shop_goods_option") . " where id=:id limit 1", array(":id" => $optionid));
            
        	   
           	if(empty($_GP['rsreson']))
           	{
           		
           		 message('请输入评论内容');
           	}
           	if(empty($_GP['rate']))
           	{
           		
           		 message('请选择评分');
           	}
           	 $shop_order_goods = mysqld_select("select * from " . table("shop_order_goods") . " where id=:id and beid=:beid limit 1", array(":id" => $ogsid,':beid'=>$_CMS['beid']));
            if(!empty($shop_order_goods['iscomment']))
            {
            		 message('订单已评论');
            }
            $isenable=0;
            if(empty($shop_order_goods['is_system'])&&!empty($settings['shop_auto_comment']))
            {
            	$isenable=1;
            }
            
             mysqld_insert('shop_goods_comment', array('is_system'=>$shop_order_goods['is_system'],'comment_nickname'=>'','isenable'=>$isenable,'beid'=>$_CMS['beid'],'createtime'=>time(),'rate'=> $_GP['rate'],'ordersn' => $item['ordersn'],'optionname'=>$option['title'],'goodsid'=> $shop_order['goodsid'],'comment' => $_GP['rsreson'],'orderid' => $orderid, 'openid' => $openid ));
						   mysqld_update('shop_order_goods', array('iscomment'=>1 ),array('id'=>$ogsid,'beid'=>$_CMS['beid']));
						if(empty( $isenable))
						{
							 message('评论成功,请等待审核！', mobile_url('myorder',array('status' => intval($_GP['fromstatus']))), 'success');
        	
						}else
						{
            message('评论成功！', mobile_url('myorder',array('status' => intval($_GP['fromstatus']))), 'success');
        	  }
          }
             include themePage('order_detail_comment');
              exit;
        }
        
       
     
        
      
        
         if ($op == 'returnnewgood') {//ok
            $orderid = intval($_GP['orderid']);
             $ogsid = intval($_GP['ogsid']);
             
             $list = mysqld_selectall("SELECT comment.*,member.realname,member.mobile FROM " . table('shop_goods_comment') . " comment  left join " . table('member') . " member on comment.openid=member.openid WHERE comment.orderid=:orderid and comment.openid=:openid and member.beid=:beid ", array(':orderid' => $orderid, 'openid' => $openid,':beid'=>$_CMS['beid'] ));
       
           $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id AND openid = :openid and beid=:beid", array(':id' => $orderid, ':openid' => $openid,':beid'=>$_CMS['beid'] ));
         
          
         
             $shop_order = mysqld_select("SELECT * FROM " . table('shop_order_goods') . " WHERE id = :id and beid=:beid", array(':id' => $ogsid,':beid'=>$_CMS['beid'] ));
         
            if($shop_order['status'] != -7) { 
           	message("非换货状态不能进行收货确认");
          }
           	if(empty($shop_order['id'])||empty($item['id']))
           	{
           		 message('商品不能空', refresh(), 'error');
           	}
           		//'0为无状态,1正常,-3换货中,-7换货后已发货,, -4退货中, -5已退货',
            mysqld_update('shop_order_goods', array('status' =>  1,'restatus' =>1,'updatetime'=>time()), array('id' => $shop_order['id'],'beid'=>$_CMS['beid']));
						system_check_order_status($orderid);
				  message('确认收货完成！', 'refresh', 'success');
         }
       
        
         if ($op == 'detail') {//ok
        	  $config=globaSetting();

            $orderid = intval($_GP['orderid']);
             system_check_order_status($orderid);
            $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE openid = '".$openid."' and id='{$orderid}' and beid=:beid limit 1",array(':beid'=>$_CMS['beid']));
     
     $has_be_goods=$item['is_be'];
$has_system_goods=$item['is_system'];
            if (empty($item)) {
                message('抱歉，您的订单不存或是已经被取消！', mobile_url('myorder'), 'error');
            }
            if($item['hasbonus'])
        	   {
        	   	$bonuslist = mysqld_selectall("SELECT bonus_user.*,bonus_type.type_name FROM " . table('bonus_user') . " bonus_user left join  " . table('bonus_type') . " bonus_type on bonus_type.type_id=bonus_user.bonus_type_id WHERE bonus_user.order_id=:order_id and bonus_user.beid=:beid",array(":order_id"=>$orderid,':beid'=>$_CMS['beid'],));
        	   
        	   	
        	   }
           
            		if($item['paytype']!=$this->getPaytypebycode($item['paytypecode']))
  					{
  						 mysqld_update('shop_order', array('paytype' => $this->getPaytypebycode($item['paytypecode'])), array('id' => $orderid, 'openid' => $openid  ,'beid'=>$_CMS['beid']));
						 $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE openid = '".$openid."' and id='{$orderid}' and beid=:beid limit 1", array(':beid'=>$_CMS['beid']));
           
  					}
         $zong_allgoods = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') 
                    . " WHERE is_system=1 and orderid='{$orderid}' and beid=:beid", array(':beid'=>$_CMS['beid']));
            foreach ($zong_allgoods as $index => $g) {
                //属性
                $option = mysqld_select("select * from " . table("shop_goods_option") . " where id=:id limit 1", array(":id" => $g['optionid']));
                if ($option) {
                   	$zong_allgoods[$index]['optionname'] = $option['title']  ;
                }
                  $zong_allgoods[$index]['totalprice'] = $g['total'] * $g['price'];
            }


   $be_allgoods = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') 
                    . " WHERE is_system=0 and orderid='{$orderid}' and beid=:beid", array(':beid'=>$_CMS['beid']));
            foreach ($be_allgoods as $index => $g) {
                //属性
                $option = mysqld_select("select * from " . table("shop_goods_option") . " where id=:id limit 1", array(":id" => $g['optionid']));
                if ($option) {
                   	$be_allgoods[$index]['optionname'] = $option['title']  ;
                }
                 $be_allgoods[$index]['totalprice'] = $g['total'] * $g['price'];
            }

            $dispatch = mysqld_select("select name as dispatchname from " . table('dispatch') . " where code=:code limit 1", array(":code" => $item['dispatchexpress']));
            $be_dispatch = mysqld_select("select name as dispatchname from " . table('dispatch') . " where code=:code limit 1", array(":code" => $item['be_dispatchexpress']));
           
            $payments = mysqld_selectall("select * from " . table("payment")." where enabled=1 and beid=:beid order by `order` desc",array(':beid'=> $_CMS['beid']));
  
  			 $shoporder=$item;
  			
  				if($shoporder['status']==1)
  				{
  					if($_GP['is_system']==1)
  					{
  					 include themePage('order_detail_zong');
  					}
  						if($_GP['is_be']==1)
  					{
  					 include themePage('order_detail_be');
  					}
  				}else
  				{
            include themePage('order_detail');
          }
            exit;
        } else {//ok
            $pindex = max(1, intval($_GP['page']));
            $psize = 20;

            $status = intval($_GP['status']);
            $tstatus = intval($_GP['tstatus']);
            $where = "openid = '".$openid."' and (is_be=1 or is_system=1)";
					if($status == 0&&$tstatus==0)
					{
						$status=99;
					}
       		 if ($status == 99) {
            }  else {
            	   		 if ($status == 0) {
                $where.=" and status=$status";
              }
                 		 if ($status == 1) {
                $where.=" and status=1 and ((is_be=1 and be_status=0 ))";
              }
              
                		 if ($status == 2) {
                $where.=" and ((is_be=1 and be_status=2 ) )";
              }
              
                   		 if ($status == -5) {
                $where.=" and  (be_status<=-2 or be_hasrest=1 )";
              }
            }
            $list = mysqld_selectall("SELECT * FROM " . table('shop_order') . " WHERE $where and beid=:beid ORDER BY updatetime DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize, array(':beid'=>$_CMS['beid']), 'id');
            $total = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order') . " WHERE  $where  and beid=:beid ", array(':beid'=>$_CMS['beid']));
            $pager = pagination($total, $pindex, $psize);

            if (!empty($list)) {
                foreach ($list as &$row) {
                    $goods = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') . " o "
                            . " WHERE o.orderid='{$row['id']}' and o.beid=:beid", array(':beid'=>$_CMS['beid']));
                
                
                    $row['goods'] = $goods;
                }
            }
		        include themePage('order');
		         exit;
        }