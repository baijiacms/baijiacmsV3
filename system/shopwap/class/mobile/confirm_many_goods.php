<?php

            //如果不是直接购买（从购物车购买）
            $list = mysqld_selectall("SELECT * FROM " . table('shop_cart') . " WHERE  session_id = :openid and beid=:beid", array(':openid'=>$openid,':beid'=>$_CMS['beid']));
            if (!empty($list)) {
            	$totalprice=0;
            		$totaltotal=0;
                foreach ($list as &$g) {
                    $item = mysqld_select("select * from " . table("shop_goods") . " where id=:id and ((is_system=0 and beid=:beid) or is_system=1)", array(":id" => $g['goodsid'],':beid'=>$_CMS['beid']));
                  if(!empty($item['id']))
                   {
                   	if(!empty($item['status']))
                   	{
	                   if(!empty($item['is_system']))
	                   {
	                   $has_system_goods=true;
	                  	}else
	                  	{
	                  	$has_be_goods=true;	
	                  	}
	                  		if($item['issendfree']==1)
                    		{
                    			
                    			if(!empty($item['is_system']))
				                   {
				                   $is_system_send_free=true;
				                  	}else
				                  	{
				                  	$is_be_send_free=true;
				                  	}
                    			
                    			
                    		}
	                 if(!empty($g['optionid']))
	                 {
                    //属性
                    $option = mysqld_select("select * from " . table("shop_goods_option") . " where id=:id and goodsid=:goodsid", array(":id" => $g['optionid'],":goodsid"=>$item['id']));
                    if (!empty($option['id'])) {
                        $item['optionid'] = $g['optionid'];
                        $item['title'] = $item['title'];
                        $item['optionname'] = $option['title'];
                        $item['marketprice'] = $option['marketprice'];
                        $item['weight'] = $option['weight'];
                    }
                  }
                        $item['stock'] = $item['total'];
			                    $item['total'] = $g['total'];
			                    $item['totalprice'] = $g['total'] * $item['marketprice'];
			                  $item['credit'] = $g['total'] * $item['credit'];
			                  $goodscredit=$goodscredit+ $item['credit'];
			                     	if(!empty($item['is_system']))
				                   {
				                   $zong_allgoods[]=$item;
				                  	}else
				                  	{
				                  	$be_allgoods[]=$item;
				                  	}
                         if(!empty($item['is_system']))
				                   {
				                   $zong_goodsprice+=$item['totalprice'];
				                  	}else
				                  	{
				                  	$be_goodsprice+=$item['totalprice'];
				                  	}
                        
                
                    if(!empty($g['optionid'])&&empty($option['id']))
                    {
	                	 	mysqld_delete("shop_cart", array( "session_id" => $openid,'goodsid'=>$item['id'],'optionid'=>$g['optionid'],'beid'=>$_CMS['beid']));
                    }
                 
                 		}else
	                 	{
	                 		mysqld_delete("shop_cart", array( "session_id" => $openid,'goodsid'=>$item['id'],'beid'=>$_CMS['beid']));
	                 	}
                 	}
                }
   
          //========end===============
                
                unset($g);
            }
            $returnurl = mobile_url("confirm");
            
          