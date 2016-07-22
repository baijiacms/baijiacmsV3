<?php
		   $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
		 if ($operation == 'display') {
		 			
		 	  $condition .= " AND status = 1 and be_status=0 and is_be=1";
		 	    $list = mysqld_selectall("SELECT * FROM " . table('shop_order') . " WHERE 1=1 $condition and beid=:beid ORDER BY  createtime DESC",array(':beid'=>$_CMS['beid']));
          $total = mysqld_selectcolumn("SELECT count(*) FROM " . table('shop_order') . " WHERE 1=1 $condition and beid=:beid  ",array(':beid'=>$_CMS['beid']));
          
          $dispatchs = mysqld_selectall("SELECT * FROM " . table('shop_dispatch')." where deleted=0 and beid=:beid  ",array(':beid'=>$_CMS['beid']) );
						$dispatchdata=array();
					  if(is_array($dispatchs)) { foreach($dispatchs as $disitem) { 
					  	$dispatchdata[$disitem['id']]=$disitem;
							 } }
							 
           if (checksubmit('sendbatexpress')) {
           	 	$index=0;
           	if(!empty($_GP['check']))
           	{
           		
						 	 foreach ($_GP['check'] as $k ) {
						 	 	$item = mysqld_select("SELECT status,be_status,ordersn FROM " . table('shop_order') . " WHERE id = :id and beid=:beid  and is_be=1", array(':id' => $k,':beid'=>$_CMS['beid']));
						     
						$isexpress=$_GP['express'.$k];
						 	 	if ($isexpress!='-1' && empty($_GP['expressno'.$k])) {
						                    message('订单'.$item['ordersn'].'没有快递单号，请填写完整！');
						                }
						 	 	      if($item['status']!=1&&empty($item['be_status']))
						          {
						          	
						          	 message('订单'.$item['ordersn'].'状态不是待发货状态，请重新点击”批量发货“后进行操作。');
						          }     
						 	}
						
						 foreach ($_GP['check'] as $k ) {
						                $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id and beid=:beid and be_status=0 and is_be=1", array(':id' => $k,':beid'=>$_CMS['beid']));
						                if(!empty($item['id']))
						                {
						                	
						            
						                
						             $express=$_GP['express'.$k];
						                if($express=='-1')
						                {
						                	$express=='';
						                	}
						                     
                 		updateOrderStock($item['id']);
						                mysqld_update('shop_order', array(
						                    'be_status' => 2,'be_updatetime'=>time(),
						                    'be_express' => $express,
						                    'be_expresscom' => $_GP['expresscom'.$k],
						                    'be_expresssn' => $_GP['expressno'.$k],
						                        ), array('id' => $item['id'],'beid'=>$_CMS['beid'],'is_be'=>1));
						                        
				
						    }
						    		 	$index= 	$index+1;
						
						}
						 	}
						                message('批量发货操作完成,成功处理'.$index.'条订单', refresh(), 'success');
						
						}
        $dispatchlist = mysqld_selectall("SELECT * FROM " . table('dispatch')." where sendtype=0 and enabled = 1 and is_system=0 and beid=:beid ",array(':beid'=>$_CMS['beid']) );
					
		 	  include page('orderbat');
		}