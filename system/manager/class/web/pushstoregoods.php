<?php
        $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
              if ($operation == 'display') {

      $good_id=$_GP['goodsid'];
      if(empty($good_id))
      {
      message("商品id不能空");
      }
     	$goods = mysqld_select('SELECT * FROM '.table('shop_goods')." WHERE  id=:id  and `deleted`=0" , array(':id'=> $good_id));
	    if(empty($goods['id']))
      {
      message("商品不能空");
      }
      $goodsstore_list = mysqld_selectall("SELECT goodsstore.id,store.sname FROM " . table('shop_goods_goodsstore')." goodsstore left join   " . table('system_store')." store on goodsstore.beid=store.id  where store.`deleted`=0 and goodsstore.good_id=:good_id",array(":good_id"=>$good_id));
        		include page('pushstoregoods');
        		exit;
      }
         if ($operation == 'addselect') {
         	     $good_id=$_GP['goodsid'];
      if(empty($good_id))
      {
      message("商品id不能空");
      }
         	 $pindex = max(1, intval($_GP['page']));
            $psize = 20;

            	
            	 if (!empty($_GP['sname'])) {
                $selectCondition .= " AND store.sname  LIKE '%{$_GP['sname']}%'";
            }
            
            		 if (!empty($_GP['pcate'])) {
                $selectCondition .= " AND store.compid =".intval($_GP['pcate']);
            }
            
            	 if (!empty($_GP['ccate'])) {
                $selectCondition .= " AND store.saleid =".intval($_GP['ccate']);
            }
            
          $selectCondition.=' and store.id not in (SELECT gst.beid FROM '.table('shop_goods_goodsstore')." gst WHERE  gst.good_id=:good_id) ";
						 
        	
						    
						    $store_list = mysqld_selectall("SELECT store.* FROM " . table('system_store')." store where store.`deleted`=0 ".$selectCondition." LIMIT " . ($pindex - 1) * $psize . ',' . $psize,array(":good_id"=> $good_id));
       
						    
        
            
            $total = mysqld_selectcolumn("SELECT count(store.id) FROM " . table('system_store')." store where store.`deleted`=0 ".$selectCondition,array(":good_id"=> $good_id));
            $pager = pagination($total, $pindex, $psize);
          
            
         	
         		include page('pushstoregoods_addselect');
        		exit;
        }
        
               if ($operation == 'addbatshop') {
               	
               	     $good_id=$_GP['goodsid'];
      if(empty($good_id))
      {
      message("商品id不能空");
      }
     	$goods = mysqld_select('SELECT * FROM '.table('shop_goods')." WHERE  id=:id and `deleted`=0" , array(':id'=> $good_id));
	    if(empty($goods['id']))
      {
      message("商品不能空");
      }
      if(!empty($_GP['check']))
      {
      					 foreach ($_GP['check'] as $k ) {
						                
					$shop_goods_goodsstore = mysqld_select('SELECT * FROM '.table('shop_goods_goodsstore')." WHERE  good_id=:good_id  and beid=:beid" , array(':good_id'=> $good_id,':beid'=> $k));
	  if(empty($shop_goods_goodsstore['id'])&&!empty($k))
	  {
        mysqld_insert('shop_goods_goodsstore',array('good_id'=>$good_id,'pcate'=>$goods['pcate'],'ccate'=>$goods['ccate'],'beid'=>$k));
     }  
						}
      }
        message('店铺批量添加成功',web_url('pushstoregoods',array('goodsid'=>$good_id,'op'=>'display')),'success');
     
      exit;
              }
              
                   if ($operation == 'delbatshop') {
               	
               	     $good_id=$_GP['goodsid'];
      if(empty($good_id))
      {
      message("商品id不能空");
      }
     	$goods = mysqld_select('SELECT * FROM '.table('shop_goods')." WHERE  id=:id and `deleted`=0" , array(':id'=> $good_id));
	    if(empty($goods['id']))
      {
      message("商品不能空");
      }
      if(!empty($_GP['check']))
      {
      	foreach ($_GP['check'] as $k ) {
      	  mysqld_delete('shop_goods_goodsstore',array('good_id'=>$good_id,'id'=>$k));
						}
      }
        message('店铺批量删除成功',web_url('pushstoregoods',array('goodsid'=>$good_id,'op'=>'display')),'success');
     
      exit;
              }
              
           if ($operation == 'addoneshop') {
        
        
          $good_id=$_GP['goodsid'];
      if(empty($good_id))
      {
      message("商品id不能空");
      }
     	$goods = mysqld_select('SELECT * FROM '.table('shop_goods')." WHERE  id=:id and `deleted`=0" , array(':id'=> $good_id));
	    if(empty($goods['id']))
      {
      message("商品不能空");
      }
      
           $storeid=$_GP['storeid'];
        	$store = mysqld_select('SELECT * FROM '.table('system_store')." WHERE  id=:id and `deleted`=0 " , array(':id'=> $storeid));
	    if(empty($store['id']))
      {
      message("店铺未找到");
      }
      
      
         	$shop_goods_goodsstore = mysqld_select('SELECT * FROM '.table('shop_goods_goodsstore')." WHERE  good_id=:good_id  and beid=:beid" , array(':good_id'=> $good_id,':beid'=> $storeid));
	  if(empty($shop_goods_goodsstore['id']))
	  {
        mysqld_insert('shop_goods_goodsstore',array('good_id'=>$good_id,'pcate'=>$goods['pcate'],'ccate'=>$goods['ccate'],'beid'=>$storeid));
     }   
       message('店铺添加成功',web_url('pushstoregoods',array('goodsid'=>$good_id,'op'=>'display')),'success');
        		exit;
        }
              if ($operation == 'deloneshop') {
              	
              	 mysqld_delete('shop_goods_goodsstore',array('id'=>$_GP['gsid']));
              	 message('店铺删除成功','refresh','success');
      
              }
        