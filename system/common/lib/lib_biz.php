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
		function bz_bj_tbk_get_shareid($openid,$level=1,$beid)
	{
			global $_CMS;
		$settings=globaBeSetting($beid);
			if(empty($settings["bj_tbk_protimes"]))
			{
				return "";
			}
			$bj_tbk_globalCommissionLevel=intval($settings['bj_tbk_globalCommissionLevel']);
			
			if($bj_tbk_globalCommissionLevel<$level)
			{
				return "";
			}
			if($level>=1)
			{
				$share_member1 = mysqld_select('select * from '.table('bj_tbk_member_relect')." where openid=:openid and beid=:beid ",array(":openid"=>$openid,':beid'=> $beid));
			}
			if($level>=2)
			{
				$share_member2 = mysqld_select('select * from '.table('bj_tbk_member_relect')." where openid=:openid and beid=:beid",array(":openid"=>$share_member1['parentid'],':beid'=> $beid));
			}
				if($level>=3)
			{
				$share_member3 = mysqld_select('select * from '.table('bj_tbk_member_relect')." where openid=:openid and beid=:beid",array(":openid"=>$share_member2['parentid'],':beid'=> $beid));
			}

			if($level==1)
			{
				$shareid=$share_member1['parentid'];
				if(empty($share_member1['parentid']))
				{
					return 0;
				}
					$share_member_agent = mysqld_select('select isagent from '.table('bj_tbk_member_relect')." where openid=:openid and beid=:beid ",array(":openid"=>$share_member1['parentid'],':beid'=> $beid));
				if(empty($share_member_agent['isagent']))
				{
					return 0;
				}else
				{
				return $share_member1['parentid'];
				}
			}
			if($level==2)
			{
				if(empty($share_member2['parentid']))
				{
					return 0;
				}
					$share_member_agent = mysqld_select('select isagent from '.table('bj_tbk_member_relect')." where openid=:openid and beid=:beid ",array(":openid"=>$share_member2['parentid'],':beid'=> $beid));
				if(empty($share_member_agent['isagent']))
				{
					return 0;
				}else
				{
				return $share_member2['parentid'];
				}
			}
			if($level==3)
			{
					if(empty($share_member3['parentid']))
				{
					return 0;
				}
							$share_member_agent = mysqld_select('select isagent from '.table('bj_tbk_member_relect')." where openid=:openid and beid=:beid ",array(":openid"=>$share_member3['parentid'],':beid'=> $beid));
				if(empty($share_member_agent['isagent']))
				{
					return 0;
				}else
				{
				return $share_member3['parentid'];
				}
			
			}
	}

	 function bj_tbk_create_commission_order($orderid,$ogid,$beid)
	{
			global $_CMS;
		$settings=globaBeSetting($beid);
	
			 if(!empty($settings['bj_tbk_protimes']))
			{
			 $member=get_member_account(false);
			 $openid =$member['openid'];
			 $bj_tbk_order = mysqld_select('select * from '.table('bj_tbk_order')." where ogid=:ogid  ",array(":ogid"=>$ogid));
	
				if(empty($bj_tbk_order['id']))
				{
					$shop_order=mysqld_select('SELECT * FROM '.table('shop_order_goods'). " WHERE id = :ogid and orderid=:orderid   ", array(':ogid' => $ogid,':orderid'=>$orderid));
				 				if(!empty($shop_order['id'])&&(empty($shop_order['is_system'])||(!empty($shop_order['is_system'])&&!empty($settings['bj_tbk_zong_fenyong']))))
				 			{
						$bj_tbk_globalCommissionLevel=intval($settings['bj_tbk_globalCommissionLevel']);
							$commission=0;
				 			$commission2=0;
				 			$commission3=0;
						
				 			$commission=$settings['bj_tbk_globalCommission'];
				 			$commission2=$settings['bj_tbk_globalCommission2'];
				 			$commission3=$settings['bj_tbk_globalCommission3'];
				 			
				 			$bj_tbk_good_commission = mysqld_select("SELECT * FROM " . table('bj_tbk_good_commission') . " WHERE goodid = :id ", array(':id' => $shop_order['goodsid']));
               
               if(!empty($bj_tbk_good_commission['customCommission']))
               {
               	$commission=$bj_tbk_good_commission['commission1'];
               	$commission2=$bj_tbk_good_commission['commission2'];
               	$commission3=$bj_tbk_good_commission['commission3'];
               	$settings['bj_tbk_commissionType']=$bj_tbk_good_commission['customCommissionType'];
              }
               
    
              
               
				 			$bj_tbk_order_commission1=0;
				 			$bj_tbk_order_commission2=0;
				 			$bj_tbk_order_commission3=0;
				 			$share=bz_bj_tbk_get_shareid($openid,1,$beid);
	
				 			if(!empty($share))
				 			{
								if($settings['bj_tbk_commissionType']==1)
								{
									$bj_tbk_order_commission1 = ($shop_order['price']*$shop_order['total'])  * $commission /100;
									$bj_tbk_order_commission2 =  $bj_tbk_order_commission1  * $commission2 /100;
									$bj_tbk_order_commission3 = $bj_tbk_order_commission2  * $commission3 /100;
								}else
								{
											$bj_tbk_order_commission1= ($shop_order['price']*$shop_order['total'])  * $commission /100;
											$bj_tbk_order_commission2 = ( $shop_order['price']*$shop_order['total'])   * $commission2 /100;
											$bj_tbk_order_commission3 = ($shop_order['price']*$shop_order['total'])  * $commission3 /100;
								}
								if($bj_tbk_globalCommissionLevel>=1&&!empty($share)&&!empty($bj_tbk_order_commission1))
								{
					 		mysqld_insert('bj_tbk_order',
								 array('gstatus'=>0,'fhstatus'=>1,'clevel'=>1,'commission'=>$bj_tbk_order_commission1,'shareid'=>$share,'status'=>0,
								 'ogid'=>$ogid,'orderid'=>$orderid,'openid'=>$openid,
								 'createtime'=>time(),'beid'=> $beid,'is_system'=>$shop_order['is_system']));
								}
								$share2=bz_bj_tbk_get_shareid($openid,2,$beid);
										if($bj_tbk_globalCommissionLevel>=2&&!empty($share2)&&!empty($bj_tbk_order_commission2))
								{
								 mysqld_insert('bj_tbk_order',
								 array('gstatus'=>0,'fhstatus'=>1,'clevel'=>2,'commission'=>$bj_tbk_order_commission2,'shareid'=>$share2,'status'=>0,
								 'ogid'=>$ogid,'orderid'=>$orderid,'openid'=>$openid,
								 'createtime'=>time(),'beid'=> $beid,'is_system'=>$shop_order['is_system']));
								 	}
								 	
								 		$share3=bz_bj_tbk_get_shareid($openid,3,$beid);
										if($bj_tbk_globalCommissionLevel>=3&&!empty($share3)&&!empty($bj_tbk_order_commission3))
								{
								 mysqld_insert('bj_tbk_order',
								 array('gstatus'=>0,'fhstatus'=>1,'clevel'=>3,'commission'=>$bj_tbk_order_commission3,'shareid'=>$share3,'status'=>0,
								 'ogid'=>$ogid,'orderid'=>$orderid,'openid'=>$openid,
								 'createtime'=>time(),'beid'=> $beid,'is_system'=>$shop_order['is_system']));
								 	}
								 	
								 
							}
						}
				}
			}
	}
	
	