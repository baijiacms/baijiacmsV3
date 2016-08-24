<?php
header("Cache-control:no-cache,no-store,must-revalidate");
header("Pragma:no-cache");
header("Expires:0");
	$system_settings=globaSystemSetting();
  $config=globaSetting();
	if(!empty($system_settings['shop_tempuser_buy']))
	{
		if($_GP["follower"]!="nologinby")
		{
				if(is_login_account()==false)
				{
					if(empty($_SESSION["noneedlogin"]))
					{
					tosaveloginfrom();
					header("location:".create_url('mobile',array('name' => 'shopwap','do' => 'login','from'=>'confirm')));	
					exit;
					}
				}
		
		}else
		{
			 $_SESSION["noneedlogin"]=true;
				clearloginfrom();	
		}
	}else
	{
		
				if(is_login_account()==false)
				{
					tosaveloginfrom();
					header("location:".create_url('mobile',array('name' => 'shopwap','do' => 'login','from'=>'confirm')));	
					exit;
				}
	}
			$member=get_member_account();
				$openid =$member['openid'] ;
        $be_goodsprice = 0;
        $zong_goodsprice = 0;
        $zong_allgoods = array();
        $be_allgoods = array();
       
        $id = intval($_GP['id']);
        $optionid = intval($_GP['optionid']);
        $total = intval($_GP['total']);
        if (empty($total)) {
            $total = 1;
        }
        $direct = false; //是否是直接购买
        $returnurl = ""; //当前连接
//	$issendfree=0;
$goodscredit=0;
	$is_system_send_free=false;
	$is_be_send_free=false;
	$has_system_goods=false;
	$has_be_goods=false;
	 $defaultAddress = mysqld_select("SELECT * FROM " . table('shop_address') . " WHERE isdefault = 1 and openid = :openid and deleted=0 and beid=:beid limit 1", array(':openid' => $openid,':beid'=>$_CMS['beid']));
	if(!empty($id))
	{
		require "confirm_one_goods.php";	
	}else
	{
		require "confirm_many_goods.php";
	}
   if($has_system_goods==false&&$has_be_goods==false)
	{
		message("未找到相关商品",mobile_url('myorder'),'error');	
	}
  
        //=====总部配送方式=======
       if($has_system_goods==true)
       {
      	 $zong_dispatch=array();
		     $zong_dispatchcode=array();
		     $addressdispatch1 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.is_system=1 and  dispatch.deleted=0  and ((dispatch_area.provance=:provance and dispatch_area.city=:city and dispatch_area.area=:area)))",array(":provance"=>$defaultAddress['province'],":city"=>$defaultAddress['city'],":area"=>$defaultAddress['area']));
		    $addressdispatch2 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.is_system=1 and dispatch.deleted=0 and ( (dispatch_area.provance=:provance and dispatch_area.city=:city and dispatch_area.area='') ))",array(":provance"=>$defaultAddress['province'],":city"=>$defaultAddress['city']));
		   $addressdispatch3 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.is_system=1 and dispatch.deleted=0 and ((dispatch_area.provance=:provance and dispatch_area.city='' and dispatch_area.area='') ))",array(":provance"=>$defaultAddress['province']));
		   $addressdispatch4 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.is_system=1 and dispatch.deleted=0 and (dispatch_area.provance='' and dispatch_area.city='' and dispatch_area.area='') )");
		
		 	$addressdispatchs=array($addressdispatch1,$addressdispatch2,$addressdispatch3,$addressdispatch4);
		 	$dispatchIndex=0;
		   foreach ($addressdispatchs as $addressdispatch) {
			
		 	 foreach ($addressdispatch as $d) {
		 	 			if(!in_array ($d['express'],$zong_dispatchcode))
		 	 			{
		      	$zong_dispatch[$dispatchIndex]=$d;
		      	$zong_dispatchcode[$dispatchIndex]=$d['express'];
		      	$dispatchIndex=$dispatchIndex+1;
		      	}
		    }	 	
		  }

     
        foreach ($zong_dispatch as &$d) {
            $weight = 0;

            foreach ($zong_allgoods as $g) {
                $weight+=$g['weight'] * $g['total'];
            }
            $price = 0;
           
            if($is_system_send_free!=1)
          	{
	            if ($weight <= $d['firstweight']) {
	                $price = $d['firstprice'];
	            } else {
	                $price = $d['firstprice'];
	                $secondweight = $weight - $d['firstweight'];
	                if ($secondweight % $d['secondweight'] == 0) {
	                    $price+= (int) ( $secondweight / $d['secondweight'] ) * $d['secondprice'];
	                } else {
	                    $price+= (int) ( $secondweight / $d['secondweight'] + 1 ) * $d['secondprice'];
	                }
	            }
         		}
            $d['price'] = $price;
        }
        unset($d);
      }
        //=====总部配送方式 end=======
       
   
        //子商城配送方式
       if($has_be_goods==true)
       {
      	 $be_dispatch=array();
		     $be_dispatchcode=array();
		     $addressdispatch1 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.beid=:beid and dispatch.is_system=0 and  dispatch.deleted=0  and ((dispatch_area.provance=:provance and dispatch_area.city=:city and dispatch_area.area=:area)))",array(":provance"=>$defaultAddress['province'],":city"=>$defaultAddress['city'],":area"=>$defaultAddress['area'] ,':beid'=>$_CMS['beid']));
		    $addressdispatch2 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.beid=:beid and dispatch.is_system=0 and dispatch.deleted=0 and ( (dispatch_area.provance=:provance and dispatch_area.city=:city and dispatch_area.area='') ))",array(":provance"=>$defaultAddress['province'],":city"=>$defaultAddress['city'] ,':beid'=>$_CMS['beid']));
		   $addressdispatch3 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.beid=:beid and dispatch.is_system=0 and dispatch.deleted=0 and ((dispatch_area.provance=:provance and dispatch_area.city='' and dispatch_area.area='') ))",array(":provance"=>$defaultAddress['province'] ,':beid'=>$_CMS['beid']));
		   $addressdispatch4 = mysqld_selectall("select shop_dispatch.*,dispatchitem.name dname from " . table("shop_dispatch") . " shop_dispatch left join ". table('dispatch') . " dispatchitem on shop_dispatch.express=dispatchitem.code  WHERE shop_dispatch.deleted=0 and dispatchitem.enabled=1 and  shop_dispatch.id in (select dispatch.id from " . table("shop_dispatch_area") . " dispatch_area left join  " . table("shop_dispatch") . " dispatch on dispatch.id=dispatch_area.dispatchid WHERE dispatch.beid=:beid and dispatch.is_system=0 and dispatch.deleted=0 and (dispatch_area.provance='' and dispatch_area.city='' and dispatch_area.area='') )",array(':beid'=>$_CMS['beid']));
		
		 	$addressdispatchs=array($addressdispatch1,$addressdispatch2,$addressdispatch3,$addressdispatch4);
		 	$dispatchIndex=0;
		   foreach ($addressdispatchs as $addressdispatch) {
			
		 	 foreach ($addressdispatch as $d) {
		 	 			if(!in_array ($d['express'],$be_dispatchcode))
		 	 			{
		      	$be_dispatch[$dispatchIndex]=$d;
		      	$be_dispatchcode[$dispatchIndex]=$d['express'];
		      	$dispatchIndex=$dispatchIndex+1;
		      	}
		    }	 	
		  }

     
        foreach ($be_dispatch as &$d) {
            $weight = 0;

            foreach ($be_allgoods as $g) {
                $weight+=$g['weight'] * $g['total'];
            }
            $price = 0;
            if($is_be_send_free!=1)
          	{
	            if ($weight <= $d['firstweight']) {
	                $price = $d['firstprice'];
	            } else {
	                $price = $d['firstprice'];
	                $secondweight = $weight - $d['firstweight'];
	                if ($secondweight % $d['secondweight'] == 0) {
	                    $price+= (int) ( $secondweight / $d['secondweight'] ) * $d['secondprice'];
	                } else {
	                    $price+= (int) ( $secondweight / $d['secondweight'] + 1 ) * $d['secondprice'];
	                }
	            }
         		}
            $d['price'] = $price;
        }
        unset($d);
      }
        //=====子商城配送方式 end=======
        
    /** 支付屏蔽    
		$paymentconfig="";
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
			$paymentconfig=" and code!='alipay'";
		}else
		{
			if (is_mobile_request()) {
					$paymentconfig=" and code!='weixin'";
				}	
		}
    $payments = mysqld_selectall("select * from " . table("payment")." where enabled=1 {$paymentconfig} order by `order` desc");
   */
   
   
   
   
   

   
        if (checksubmit('submit')) {

            $address = mysqld_select("SELECT * FROM " . table('shop_address') . " WHERE id = :id and beid=:beid", array(':id' => intval($_GP['address']),':beid'=>$_CMS['beid']));
            if (empty($address)) {
                message('抱歉，请您填写收货地址！');
            }
 
    
    
             if ($has_system_goods==true&&empty($_GP['dispatch'])) {
                message('请选择配送方式！');
            }
               if ($has_be_goods==true&&empty($_GP['be_dispatch'])) {
                message('请选择配送方式！');
            }
           //  if (empty($_GP['payment'])) {
           //     message('请选择支付方式！');
           // }
  
           
        	
        	
            $dispatchid = intval($_GP['dispatch']);
            $dispatchitem = mysqld_select("select sendtype,express,beid from ".table('shop_dispatch')." where id=:id limit 1",array(":id"=>$dispatchid));
            $be_dispatchid = intval($_GP['be_dispatch']);
            $be_dispatchitem = mysqld_select("select sendtype,express,beid from ".table('shop_dispatch')." where id=:id limit 1",array(":id"=>$be_dispatchid));
 $bj_dispatch = mysqld_select("select name from ".table('dispatch')." where code=:code and is_system=1 limit 1",array(":code"=>$dispatchitem['express']));
     $be_bj_dispatch = mysqld_select("select name from ".table('dispatch')." where code=:code and beid=:beid limit 1",array(":code"=>$be_dispatchitem['express'],":beid"=>$be_dispatchitem['beid']));
       
            $zong_dispatchprice = 0;
            if($is_system_send_free==false&&$has_system_goods==true)
          	{
	            foreach ($zong_dispatch as $d) {
	                if ($d['id'] == $dispatchid) {
	                    $zong_dispatchprice = $d['price'];
	                }
	            }
          	}
      
          	   $be_dispatchprice = 0;
            if($is_be_send_free==false&&$has_be_goods==true)
          	{
	            foreach ($be_dispatch as $d) {
	                if ($d['id'] == $be_dispatchid) {
	                    $be_dispatchprice = $d['price'];
	                }
	            }
          	}
          	
					$ordersns= date('YmdHis') . random(6, 1);
						$randomorder = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  ordersn=:ordersn   limit 1", array(':ordersn' =>$ordersns));
          	while(!empty($randomorder['ordersn']))
          	{
          				$ordersns= date('YmdHis') . random(6, 1);
          			$randomorder = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  ordersn=:ordersn   limit 1", array(':ordersn' =>$ordersns));
          
          	}
          	/**
          	$payment = mysqld_select("select * from " . table("payment")." where enabled=1 and code=:payment",array(':payment'=>$_GP['payment']));
   			if(empty($payment['id']))
   			{
   				message("没有获取到付款方式");	
   			}

   				$paytype=$this->getPaytypebycode($payment['code']);**/
   				
   			
            $data = array(
                'openid' => $openid,	
                'ordersn' => $ordersns,
                'price' => $zong_goodsprice+ $be_goodsprice+ $zong_dispatchprice+$be_dispatchprice,
                'be_goodsprice' => $be_goodsprice,
                'zong_goodsprice' => $zong_goodsprice,
                'dispatchprice' => $zong_dispatchprice+$be_dispatchprice,
                'zong_dispatchprice' => $zong_dispatchprice,
                'be_dispatchprice' => $be_dispatchprice,
                'credit'=> $goodscredit,
                'status' => 0,
                'zong_status' => 0,
                 'be_status' => 0,
               // 'paytype'=> $paytype,
               'paytype'=> 0,
                'sendtype' => intval($dispatchitem['sendtype']),
                 'dispatchexpress' => $dispatchitem['express'],
                  'dispatch_name' => $bj_dispatch['name'],
                'dispatch' => $dispatchid,
                'be_dispatchexpress' => $be_dispatchitem['express'],
                'be_dispatch_name' => $be_bj_dispatch['name'],
                'be_dispatch' => $be_dispatchid,
            //    'paytypecode' => $payment['code'],
             //    'paytypename' => $payment['name'],
                 'paytypecode' => 0,
                 'paytypename' => 0,
                'remark' => $_GP['remark'],
                'addressid'=> $address['id'],
                  'address_mobile' => $address['mobile'],
                   'address_realname' => $address['realname'],
                    'address_province' => $address['province'],
                     'address_city' => $address['city'],
                      'address_area' => $address['area'],
                       'address_address' => $address['address'],
                'createtime' => time()		,
                'updatetime' => time()			
            );
       
            
        $system_store = mysqld_select("select compid,saleid from " . table("system_store") . " where id=:beid", array(':beid'=>$_CMS['beid']));
                
          $data['compid']=$system_store['compid'];
            $data['saleid']=$system_store['saleid'];
            if($has_system_goods)
            {
            		$zong_ordersn= 'Z'.date('YmdHis') . random(4, 1);
						$randomorder = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  zong_ordersn=:zong_ordersn limit 1", array(':zong_ordersn' =>$zong_ordersn));
          	while(!empty($randomorder['zong_ordersn']))
          	{
          				$zong_ordersn= 'Z'.date('YmdHis') . random(4, 1);
          			$randomorder = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  zong_ordersn=:zong_ordersn   limit 1", array(':zong_ordersn' =>$zong_ordersn));
          
          	}
            	
            	     $data['zong_ordersn']=$zong_ordersn;
            }
              if($has_be_goods)
            {
            /*		$be_ordersn= 'B'.date('YmdHis') . random(4, 1);
						$randomorder = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  be_ordersn=:be_ordersn   limit 1", array(':be_ordersn' =>$be_ordersn));
          	while(!empty($randomorder['be_ordersn']))
          	{
          				$be_ordersn= 'B'.date('YmdHis') . random(4, 1);
          			$randomorder = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE  be_ordersn=:be_ordersn   limit 1", array(':be_ordersn' =>$be_ordersn));
          
          	}
            	
            	     $data['be_ordersn']=$be_ordersn;*/
            	      $data['be_ordersn']=$ordersns;
            }
            if($has_system_goods==false&&$has_be_goods==false)
            {
            messaeg("没有找到总店或分店的匹配商品");	
            }
          $data['is_system']=$has_system_goods;
           $data['is_be']=$has_be_goods;
         
            $data['beid']=$_CMS['beid'];
            mysqld_insert('shop_order', $data);
            $orderid = mysqld_insertid();
        
            
 
            
            if($has_system_goods==true)
            {
            //插入订单商品
            foreach ($zong_allgoods as $row) {
                if (empty($row)) {
                    continue;
                }
                $d = array(
                		'is_system'=>1,
                		'goodssn'=> $row['goodssn'],
                		'thumb'=> $row['thumb'],
              		  'title' =>  $row['title'],
                    'goodsid' => $row['id'],
                    'orderid' => $orderid,
                    'total' => $row['total'],
                    'price' => $row['marketprice'],
                    'createtime' => time(),
                    'optionid' => $row['optionid']
                );
                $o = mysqld_select("select title from ".table('shop_goods_option')." where id=:id limit 1",array(":id"=>$row['optionid']));
                if(!empty($o)){
                    $d['optionname'] = $o['title'];
                    if(!empty($o['thumb']))
                    {
                    	   $d['thumb'] = $o['thumb'];
                    }
                }
							//获取商品id
							$ccate = $row['ccate'];
							$d['beid']=$_CMS['beid'];
                mysqld_insert('shop_order_goods', $d);
              $ogid = mysqld_insertid();
                    
		
			 				 bj_tbk_create_commission_order($orderid,$ogid,$_CMS['beid']);
            }
          }
              
              
					if($has_be_goods==true)
					{
            $is_fh_order_first=true;
                 //插入分部订单商品
            foreach ($be_allgoods as $row) {
                if (empty($row)) {
                    continue;
                }
                $d = array(
                		'is_system'=>0,
                		'thumb'=> $row['thumb'],
                			'goodssn'=> $row['goodssn'],
              		  'title' =>  $row['title'],
                    'goodsid' => $row['id'],
                    'orderid' => $orderid,
                    'total' => $row['total'],
                    'price' => $row['marketprice'],
                    'createtime' => time(),
                    'optionid' => $row['optionid']
                );
                $o = mysqld_select("select title from ".table('shop_goods_option')." where id=:id limit 1",array(":id"=>$row['optionid']));
                if(!empty($o)){
                    $d['optionname'] = $o['title'];
                }
							//获取商品id
							$ccate = $row['ccate'];
							$d['beid']=$_CMS['beid'];
                mysqld_insert('shop_order_goods', $d);
              $ogid = mysqld_insertid();
                    	  
			      bj_tbk_create_commission_order($orderid,$ogid,$_CMS['beid']);
            }
          }
              
              
           
              
               if($_CMS['addons_bj_message']) {
              bj_message_sendddtjtz($ordersns,($data['price']),$openid,$orderid);
  }
    if($_CMS['addons_bj_tbk'])
			        {
			        	$parentmember=bj_tbk_get_parentmember();
			        	 $weixin_wxfans = mysqld_select('select * from '.table('weixin_wxfans')." where openid=:openid and beid=:beid limit 1",array(":openid"=>$openid,':beid'=>$_CMS['beid']));
			        	bj_tbk_sendgmsptz($ordersns,$goodsprice,$openid,$parentmember['openid']);
			      
			        }
			        
            //清空购物车
            if (!$direct) {
                mysqld_delete("shop_cart", array( "session_id" => $openid,'beid'=>$_CMS['beid']));
            }
            clearloginfrom(); 
            //header("Location:".mobile_url('pay', array('orderid' => $orderid,'topay'=>'0','paytypecode'=>$payment['code'])) );
            
            
            header("Location:".mobile_url('pay', array('orderid' => $orderid,'topay'=>'1')));
            exit;
        }
  

  
       include themePage('confirm');