<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
function is_in_weixin()
{
	if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!== false)) {
		return true;
	}
	return false;
}
function is_use_weixin()
{
		global $_CMS,$_GP;

		$configs=globaSetting();
		$no_access=intval($configs['weixin_noaccess']);
		if(empty($configs['weixin_appId']))
		{
			return false;
			}
		if(empty($configs['weixin_appSecret']))
		{
			return false;
		}
	if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')!== false)&&empty($no_access)) {
		
		return true;
	}
	return false;
}

function is_weixin_access()
{
		global $_CMS,$_GP;

		$configs=globaSetting();
		$no_access=intval($configs['weixin_noaccess']);
		if(empty($configs['weixin_appId']))
		{
			return false;
			}
		if(empty($configs['weixin_appSecret']))
		{
			return false;
		}
	if (empty($no_access)) {
		
		return true;
	}
	return false;
}
function hidtel($phone){
    $IsWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i',$phone); //固定电话
    if($IsWhat == 1){
        return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i','$1****$2',$phone);
    }else{
        return  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
    }
}
function updateOrderStock($id , $minus = true, $enable = false) {
		global $_CMS;
		if($enable==true)
		{
        $ordergoods = mysqld_selectall("SELECT * FROM " . table('shop_order_goods') . " WHERE orderid='{$id}'");
        foreach ($ordergoods as $item) {
        	$goods = mysqld_select("SELECT * FROM " . table('shop_goods') . "  WHERE id='".$item['goodsid']."' ");
        
       
            if ($minus) {
                //属性
                   $data = array();
                if($goods['totalcnf']!=1)
			        	{
                if (!empty($item['optionid'])) {
                    mysqld_query("update " . table('shop_goods_option') . " set stock=stock-:stock where id=:id", array(":stock" => $item['total'], ":id" => $item['optionid']));
                }
             
               
                $data['total'] = $goods['total'] - $item['total'];
			        	}
                $data['sales'] = $goods['sales'] + $item['total'];
                mysqld_update('shop_goods', $data, array('id' => $item['goodsid']));
            } else {
                //属性
                   $data = array();
                 if($goods['totalcnf']!=1)
			        	{
                if (!empty($item['optionid'])) {
                    mysqld_query("update " . table('shop_goods_option') . " set stock=stock+:stock where id=:id ", array(":stock" => $item['total'], ":id" => $item['optionid']));
                }
             
                $data['total'] = $goods['total'] + $item['total'];
			        	}
                $data['sales'] = $goods['sales'] - $item['total'];
                mysqld_update('shop_goods', $data, array('id' => $item['goodsid']));
            }
        }
      }
    }