<?php
	
		if (!empty($_CMS[WEB_SESSION_ACCOUNT])) {
			
			$system_settings=globaSetting();
					if(!empty($system_settings['shop_auto_confirm']))
					{
						if(!empty($system_settings['shop_auto_confirm_day']))
						{
							if(intval($system_settings['shop_auto_confirm_day'])>0)
							{
					
							 $shop_auto_confirm_day=intval($system_settings['shop_auto_confirm_day'])* 24 * 60 * 60;
							 
							 
							 $be_shop_order = mysqld_selectall("SELECT * FROM " . table('shop_order') . " WHERE be_status=2 and be_updatetime>0 and be_updatetime<:be_updatetime and beid=:beid", array(':be_updatetime' => time()-$shop_auto_confirm_day,':beid'=> $_CMS['beid']));
         
          	 foreach ( $be_shop_order as   $order) {
 
          	 		$orderid=$order['id'];
            	        if (empty($order['isrest'])) {
           		 $this->setOrderCredit($order['openid'],$orderid,true,'订单:'.$order['be_ordersn'].'完成新增积分');
           		}
                mysqld_update('shop_order', array('be_status' => 3,'be_has_gfinish'=>1,'updatetime'=>time()), array('id' => $orderid));
                 mysqld_update('shop_order_goods', array('status' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
          
               
                 if(empty($order['be_has_gfinish']))
              {
              	system_create_sp_order($orderid);	
              }
              
            mysqld_update('bj_tbk_order', array('gstatus' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'is_system'=>0));
          
                   
                 	 if($_CMS['addons_bj_message']) {
	 	
 $order = mysqld_select("select * from " . table('shop_order') . " where id='".$orderid."' ");
 
	 	
              bj_message_sendddqrshtz( $order['be_ordersn'],$order['openid'],$orderid);
  }
    	 if($_CMS['addons_bj_tbk'])
			        {
			        	bj_tbk_sendxjdlshtz($orderid);
			        }
          	 	
          	 	
          	}
          	
          	
          		 $shop_order_goods = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') . " WHERE status=-7 and updatetime>0 and updatetime<:updatetime and beid=:beid", array(':updatetime' => time()-$shop_auto_confirm_day,':beid'=> $_CMS['beid']));
         
          	 foreach ( $shop_order_goods as   $goods) {
          	 	$orderid=$goods['orderid'];
          	 	$ogid=$goods['id'];
          	 	 mysqld_update('shop_order_goods', array('status' =>  1,'restatus' =>1), array('id' =>$goods['id']));
                  mysqld_update('bj_tbk_order', array('gstatus' => 1, 'updatetime'=>time()), array('orderid' => $orderid,'ogid'=>$ogid));
              
                	system_check_order_status($orderid);
        		  		
        		  		
          	 	
          	}
          	
          	
          	
          	
						
							}
						}
					}
			
			
			
			header("location:".create_url('site', array('name' => 'index','do' => 'main')));
			}
