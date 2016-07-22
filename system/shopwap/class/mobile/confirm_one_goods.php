<?php

        $item = mysqld_select("select * from " . table("shop_goods") . " where status=1 and id=:id and ((is_system=0 and beid=:beid) or is_system=1)", array(":id" => $id,':beid'=>$_CMS['beid']));
			  if(empty($item['id']))
			  {
			  message("未找到相关商品，商品已经下架");
			  }
			  
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
       
            if ($item['istime'] == 1) {
                if (time() > $item['timeend']) {
                    message('抱歉，商品限购时间已到，无法购买了！', refresh(), "error");
                }
            }

            if (!empty($optionid)) {
                $option = mysqld_select("select title,marketprice,weight,stock from " . table("shop_goods_option") . " where id=:id", array(":id" => $optionid));
                if ($option) {
                    $item['optionid'] = $optionid;
                    $item['title'] = $item['title'];
                    $item['optionname'] = $option['title'];
                    $item['marketprice'] = $option['marketprice'];
                    $item['weight'] = $option['weight'];
                }
            }
            $item['stock'] = $item['total'];
            $item['total'] = $total;
            $item['totalprice'] = $total * $item['marketprice'];
            $item['credit'] = $total* $item['credit'];
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
				                   $zong_goodsprice=$item['totalprice'];
				                  	}else
				                  	{
				                  	$be_goodsprice=$item['totalprice'];
				                  	}
				                  	
                		//========促销活动===============
  
       $direct=true;
      $returnurl = mobile_url("confirm", array("id" => $id, "optionid" => $optionid, "total" => $total));