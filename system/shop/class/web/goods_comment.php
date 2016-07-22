<?php
   
        $operation = $_GP['op'];
          if ($operation == 'add') {
          	
          	 $shop_goods = mysqld_select("SELECT * FROM " . table('shop_goods') . " WHERE id = :id  ", array(':id' => $_GP['goodsid']));
             if (empty($shop_goods['id'])) {
                message('未找到相关商品');
            }   
                  if (checksubmit("submit")) {
                 	if(empty($_GP['comment_nickname']))
           	{
           		
           		 message('请输入评论人昵称');
           	}
                	if(empty($_GP['rsreson']))
           	{
           		
           		 message('请输入评论内容');
           	}
           	if(empty($_GP['rate']))
           	{
           		
           		 message('请选择评分');
           	}
           	
           	 mysqld_insert('shop_goods_comment', array('is_system'=>0,'isenable'=>1,'beid'=>$_CMS['beid'],'createtime'=>time(),'comment_nickname'=> $_GP['comment_nickname'],'rate'=> $_GP['rate'],'ordersn' => '','optionname'=>'','goodsid'=>$shop_goods['id'],'comment' => $_GP['rsreson'],'orderid' =>'', 'openid' => ''));
						message('添加评论成功！',web_url('goods_comment', array('goodsid' => $shop_goods['id'], 'op' => 'display')),'success');
          }
          	
          	 include page('goods_comment_add');
          }
        
           if ($operation == 'display') {
        	 $pindex = max(1, intval($_GP['page']));
            $psize = 20;
            $condition = '';

 $shop_goods = mysqld_select("SELECT * FROM " . table('shop_goods') . " WHERE id = :id  ", array(':id' => $_GP['goodsid']));
             if (empty($shop_goods['id'])) {
                message('未找到相关商品');
            }    
            $list = mysqld_selectall("SELECT comment.*,member.nickname,member.mobile,shop_goods.title FROM " . table('shop_goods_comment') . " comment  left join " . table('member') . " member on comment.openid=member.openid   left join " . table('shop_goods') . " shop_goods on shop_goods.id=comment.goodsid where comment.is_system=0 and comment.beid=:beid and comment.goodsid=:goodsid ORDER BY comment.createtime DESC LIMIT " . ($pindex - 1) * $psize . ',' . $psize,array(':beid'=>$_CMS['beid'],':goodsid'=>$_GP['goodsid']));
            $total = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_goods_comment')." where is_system=0 and beid=:beid  and goodsid=:goodsid",array(':beid'=>$_CMS['beid'],':goodsid'=>$_GP['goodsid']) );
         
            $pager = pagination($total, $pindex, $psize);
             include page('goods_list_comment');
        
        } 
        if ($operation == 'check') {

            $list = mysqld_selectall("SELECT comment.*,member.nickname,member.mobile,shop_goods.title FROM " . table('shop_goods_comment') . " comment  left join " . table('member') . " member on comment.openid=member.openid   left join " . table('shop_goods') . " shop_goods on shop_goods.id=comment.goodsid where comment.is_system=0 and comment.beid=:beid and isenable=0 ORDER BY comment.createtime   ",array(':beid'=>$_CMS['beid']));
          
             include page('goods_comment');
        
        } 
        if ($operation == 'delete') {
            $id = intval($_GP['id']);
            $row = mysqld_select("SELECT * FROM " . table('shop_goods_comment') . " WHERE id = :id and beid=:beid", array(':id' => $id,':beid'=>$_CMS['beid']));
            if (empty($row)) {
                message('抱歉，评论不存在或是已经被删除！');
            }
            //修改成不直接删除，而设置deleted=1
            mysqld_delete("shop_goods_comment",  array('id' => $id,'beid'=>$_CMS['beid']));

            message('删除成功！', 'refresh', 'success');
        }
        
        if ($operation == 'enable') {
            $id = intval($_GP['id']);
            $row = mysqld_select("SELECT * FROM " . table('shop_goods_comment') . " WHERE id = :id and beid=:beid", array(':id' => $id,':beid'=>$_CMS['beid']));
            if (empty($row)) {
                message('抱歉，评论不存在或是已经被删除！');
            }
            mysqld_update("shop_goods_comment",array('isenable'=>1),  array('id' => $id,'beid'=>$_CMS['beid']));

            message('审核成功！', 'refresh', 'success');
        }
        
        