<?php
		   $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
		 if ($operation == 'display') {
		 			
		 	  $condition .= " AND status = 1 and zong_status=0 and is_system=1";
		 	    $list = mysqld_selectall("SELECT * FROM " . table('shop_order') . " WHERE 1=1 $condition ORDER BY  createtime DESC");
          $total = mysqld_selectcolumn("SELECT count(*) FROM " . table('shop_order') . " WHERE 1=1 $condition  ");
          
          $dispatchs = mysqld_selectall("SELECT * FROM " . table('shop_dispatch')." where deleted=0 and is_system=1 " );
						$dispatchdata=array();
					  if(is_array($dispatchs)) { foreach($dispatchs as $disitem) { 
					  	$dispatchdata[$disitem['id']]=$disitem;
							 } }
							 
           if (checksubmit('sendbatexpress')) {
           	 	$index=0;  
           	if(!empty($_GP['check']))
           	{
          
						 	 foreach ($_GP['check'] as $k ) {
						 	 	$item = mysqld_select("SELECT status,zong_status,ordersn FROM " . table('shop_order') . " WHERE id = :id and is_system=1", array(':id' => $k));
						     
						$isexpress=$_GP['express'.$k];
						 	 	if ($isexpress!='-1' && empty($_GP['expressno'.$k])) {
						                    message('订单'.$item['ordersn'].'没有快递单号，请填写完整！');
						                }
						 	 	      if($item['status']!=1&&empty($item['zong_status']))
						          {
						          	
						          	 message('订单'.$item['ordersn'].'状态不是待发货状态，请重新点击”批量发货“后进行操作。');
						          }     
						 	}
						  	
						 foreach ($_GP['check'] as $k ) {
						                $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id = :id and zong_status=0 and is_system=1", array(':id' => $k));
						          if(!empty($item['id']))
						                {
						                	
						            
						                
						             $express=$_GP['express'.$k];
						                if($express=='-1')
						                {
						                	$express=='';
						                	}
						                     
                 		updateOrderStock($item['id']);
						                mysqld_update('shop_order', array(
						                    'zong_status' => 2,'zong_updatetime'=>time(),
						                    'express' => $express,
						                    'expresscom' => $_GP['expresscom'.$k],
						                    'expresssn' => $_GP['expressno'.$k],
						                        ), array('id' => $item['id'],'is_system'=>1));
						                     
				
						    }
						    		 	$index= 	$index+1;
						
						}
						 	}
						                message('批量发货操作完成,成功处理'.$index.'条订单', refresh(), 'success');
						
						}
        $dispatchlist = mysqld_selectall("SELECT * FROM " . table('dispatch')." where sendtype=0 and is_system=1" );
					
		 	  include page('orderbat');
		}