<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');


function getOrderStatusStr($type,$status,$is_system=0)
{
	if($type==1)
	{//未支付类型判断
		
		if(empty($status))
		{
		return "待付款";	
		}
		if($status==-1)
		{
		return "已关闭";	
		}
	}
		if($type==2)
	{//未支付类型判断
		
		if(empty($status))
		{
		return "待发货";	
		}
		if($status==1)
		{
		return "待发货";	
		}
			if($status==2)
		{
		return "待收货";	
		}
			if($status==3)
		{
		return "已完成";	
		}
			if($status==-1)
		{
		return "已关闭";	
		}
			if($status==-2)
		{
		return "退款中";	
		}
			if($status==-3)
		{
		return "换货中";	
		}
			if($status==-4)
		{
		return "退货中";	
		}
			if($status==-5)
		{
		return "已退货";	
		}
			if($status==-6)
		{
		return "已退款";	
		}
		
		
		
	}
}
function getStoreBeid($beid)
{
	$system_store = mysqld_select('SELECT * FROM '.table('system_store')." store  where store.id=:id",array(":id"=>$beid));
	return $system_store;
}
function system_check_order_status($orderid)
	{
        	global $_CMS;
			 $shop_order=mysqld_select('SELECT * FROM '.table('shop_order'). " WHERE id = :orderid ", array(':orderid'=>$orderid));
				if(false&&!empty($shop_order['is_system'])&&!empty($shop_order['zong_has_gfinish']))
				{
				 		  mysqld_update('shop_order', array(
                    'zong_hasrest' => 0
                        ), array('id' => $orderid));
					$shop_order_goods_all=mysqld_selectall('SELECT * FROM '.table('shop_order_goods'). " WHERE  orderid=:orderid and is_system=1 and (status=-3 or status=-4 or status=-5 or status=1)", array(':orderid'=>$orderid));
					
					$total = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order_goods') . " WHERE  orderid=:orderid and is_system=1  ", array(':orderid'=>$orderid));
            if($total==1)
            {
            	$shop_order_goods=mysqld_select('SELECT * FROM '.table('shop_order_goods'). " WHERE  orderid=:orderid and is_system=1 and (status=-3 or status=-4 or status=-5 or status=1)", array(':orderid'=>$orderid));
			
				  if(!empty($shop_order_goods['id']))
				  {
				  
				  				if($shop_order_goods['status']==-3)
								{
											  mysqld_update('shop_order', array(
                    'zong_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
									}else
									{
								
										if($shop_order_goods['status']==1)
										{
										   mysqld_update('shop_order', array(
                    'zong_status' => 3,'updatetime'=>time()
                        ), array('id' => $orderid));
                      }else
                      {
													    mysqld_update('shop_order', array(
                    'zong_status' => $shop_order_goods['status'],'updatetime'=>time()
                        ), array('id' => $orderid));
                      }
                  
				  	
		
                      }
                    }
            }else
            {
           
          			$xstatus=0;
          				 foreach ($shop_order_goods_all as $item) {
          				 	if($item['status']==-4)
          				 	{
          				 		$xstatus=0;
          				 		  mysqld_update('shop_order', array(
                    'zong_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
          				 	break;	
          				 	}else
          				 	{
          				 		if(empty($xstatus))
          				 		{
          				 		$xstatus=	$item['status'];
          				 		}else
          				 		{
          				 			if($item['status']!=$xstatus)
          				 			{
          				 					$xstatus=0;
          				 				 		  mysqld_update('shop_order', array(
                    'zong_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
                        	 	break;	
          				 			}
          				 			
          				 		}
          				 	}
          				 	
          				 	
          				 	
								}
								if($xstatus!=0)
								{
										if($xstatus==-3)
									{
											  mysqld_update('shop_order', array(
                    'zong_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
									}else
									{
                        
                        	if($xstatus==1)
										{
										   mysqld_update('shop_order', array(
                    'zong_status' => 3,'updatetime'=>time()
                        ), array('id' => $orderid));
                      }else
                      {
                      	   mysqld_update('shop_order', array(
                    'zong_status' => $xstatus,'updatetime'=>time()
                        ), array('id' => $orderid));
                      }
										
                  
                        
                      }
								}
          			
          
            	
            }
				
				}
				
					if(!empty($shop_order['is_be'])&&!empty($shop_order['be_has_gfinish']))
				{
				
				 		  mysqld_update('shop_order', array(
                    'be_hasrest' => 0
                        ), array('id' => $orderid));
					$shop_order_goods_all=mysqld_selectall('SELECT * FROM '.table('shop_order_goods'). " WHERE  orderid=:orderid and is_system=0  and (status=-3 or status=-4 or status=-5 or status=1)", array(':orderid'=>$orderid));
					
					$total = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order_goods') . " WHERE  orderid=:orderid and is_system=0", array(':orderid'=>$orderid));
        if($total==1)
            {
            	$shop_order_goods=mysqld_select('SELECT * FROM '.table('shop_order_goods'). " WHERE  orderid=:orderid and is_system=0 and (status=-3 or status=-4 or status=-5 or status=1)", array(':orderid'=>$orderid));
				    	  if(!empty($shop_order_goods['id']))
				  {
				  		if($shop_order_goods['status']==-3)
									{
                        	  mysqld_update('shop_order', array(
                    'be_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
                       	}else
									{
										if($shop_order_goods['status']==1)
										{
										   mysqld_update('shop_order', array(
                    'be_status' => 3,'updatetime'=>time()
                        ), array('id' => $orderid));
                      }else
                      {
                      	   mysqld_update('shop_order', array(
                    'be_status' => $shop_order_goods['status'],'updatetime'=>time()
                        ), array('id' => $orderid));
                      }
                       }  
                      }
            }else
            {
            	
          			$xstatus=0;
          				 foreach ($shop_order_goods_all as $item) {
          				 	if($item['status']==-4)
          				 	{
          				 		$xstatus=0;
          				 		  mysqld_update('shop_order', array(
                    'be_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
          				 	break;	
          				 	}else
          				 	{
          				 		if(empty($xstatus))
          				 		{
          				 		$xstatus=	$item['status'];
          				 		}else
          				 		{
          				 			
							
          				 			if($item['status']!=$xstatus)
          				 			{
          				 					$xstatus=0;
          				 				 		  mysqld_update('shop_order', array(
                    'be_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
                        	 	break;	
          				 			}
          				 			
          				 		}
          				 	}
          				 	
          				 	
          				 	
								}
							
								if($xstatus!=0)
								{
									if($xstatus==-3)
									{
										  mysqld_update('shop_order', array(
                    'be_hasrest' => 1,'updatetime'=>time()
                        ), array('id' => $orderid));
									}else
									{
										
											if($xstatus==1)
										{
										   mysqld_update('shop_order', array(
                    'be_status' => 3,'updatetime'=>time()
                        ), array('id' => $orderid));
                      }else
                      {
                   
                      	   mysqld_update('shop_order', array(
                    'be_status' => $xstatus,'updatetime'=>time()
                        ), array('id' => $orderid));
                      }
										
                      }
                        
								}
          			
          		}
            	
            }
			
	}