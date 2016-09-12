<?php	
			$settings=globaSetting();
			if(!empty($settings['shopwap_diyshop_diyshopindex']))
			{
			$this->do_diypage();
			exit;
		}
			
			$advs = mysqld_selectall("select * from " . table('shop_adv') . " where enabled=1 and beid=:beid order by displayorder desc",array(':beid'=>$_CMS['beid']));
     
	 	 $children_category=array();
	 $category = mysqld_selectall("SELECT *,'' as list FROM " . table('shop_category') . " WHERE isrecommand=1 and enabled=1 and deleted=0 and ((is_system=0 and beid=:beid) or ((id in (SELECT gst.pcate FROM ".table('shop_goods_goodsstore')." gst WHERE gst.beid=:beid) or id in (SELECT gst.ccate FROM ".table('shop_goods_goodsstore')." gst WHERE gst.beid=:beid)) and is_system=1) ) ORDER BY parentid ASC, displayorder DESC", array(':beid'=>$_CMS['beid']), 'id');
        foreach ($category as $index => $row) {
            if (!empty($row['parentid'])) {
                $children_category[$row['parentid']][$row['id']] = $row;
                unset($category[$index]);
            }
        }
 			$first_good_list=array();
        $recommandcategory = array();
        $showhot=false;
        foreach ($category as &$c) {
            if ($c['isrecommand'] == 1) {
                $c['list'] = mysqld_selectall("SELECT * FROM " . table('shop_goods') . " WHERE  isrecommand=1 and deleted=0 AND status = 1  and pcate='{$c['id']}' and ((is_system=0 and beid=:beid) or ((id in (SELECT gst.good_id FROM ".table('shop_goods_goodsstore')." gst WHERE gst.beid=:beid) ) and is_system=1))  ORDER BY displayorder DESC",array(':beid'=>$_CMS['beid']) );
               
               foreach ($c['list'] as &$c1goods) {
                    if ($c1goods['isrecommand'] == 1&&$c1goods['isfirst'] == 1) {
                       $first_good_list[] = $c1goods;
                    }
                     if ($c1goods['ishot'] == 1) {
                      $showhot=true;
                    }
                }
                $recommandcategory[] = $c;
            }
            if (!empty($children_category[$c['id']])) {
                foreach ($children_category[$c['id']] as &$child) {
                    if ($child['isrecommand'] == 1) {
                        $child['list'] = mysqld_selectall("SELECT * FROM " . table('shop_goods') . " WHERE  isrecommand=1 and deleted=0 AND status = 1  and pcate='{$c['id']}' and ccate='{$child['id']}' and ((is_system=0 and beid=:beid) or ((id in (SELECT gst.good_id FROM ".table('shop_goods_goodsstore')." gst WHERE gst.beid=:beid) ) and is_system=1))  ORDER BY displayorder DESC ",array(':beid'=>$_CMS['beid']) );
                       	  foreach ($child['list'] as &$c2goods) {
				                    if ($c2goods['isrecommand'] == 1&&$c2goods['isfirst'] == 1) {
				                       $first_good_list[] = $c2goods;
				                    }
				                }
                       
                        $recommandcategory[] = $child;
                    }
                }
                unset($child);
            }
        }
     
     
     
     
      
              

			$isfollow=true;
			if(!empty($settings['weixin_guanzhu_open']))
			{
			if(is_in_weixin())
			{
				$fans = mysqld_select("SELECT follow,avatar,nickname FROM " . table('weixin_wxfans') . " WHERE weixin_openid=:weixin_openid and beid=:beid ", array(':weixin_openid' =>$_SESSION[MOBILE_WEIXIN_OPENID],":beid"=>$_CMS['beid']));
			 $isfollow=!empty($fans['follow']);
			}
		} 
        include themePage('shopindex');	