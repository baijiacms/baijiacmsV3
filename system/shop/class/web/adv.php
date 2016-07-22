<?php
	
		 $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
        if ($operation == 'display') {
            $list = mysqld_selectall("SELECT * FROM " . table('shop_adv') . "  where beid=:beid ORDER BY displayorder DESC",array(':beid'=>$_CMS['beid']));
                 include page('adv_list');
        } elseif ($operation == 'post') {

            $id = intval($_GP['id']);
            if (checksubmit('submit')) {
                $data = array(
                    'link' => $_GP['link'],
                    'enabled' => intval($_GP['enabled']),
                    'displayorder' => intval($_GP['displayorder'])
                );
 			  			if (!empty($_FILES['thumb']['tmp_name'])) {
                    $upload = file_upload($_FILES['thumb']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $data['thumb'] = $upload['path'];
                }
                if (!empty($id)) {
                    mysqld_update('shop_adv', $data, array('id' => $id,'beid'=>$_CMS['beid']));
                } else {
                	$data['beid']=$_CMS['beid'];
                    mysqld_insert('shop_adv', $data);
                }
                message('更新幻灯片成功！', web_url('adv', array('op' => 'display')), 'success');
            }
            $adv = mysqld_select("select * from " . table('shop_adv') . " where id=:id and beid=:beid limit 1", array(":id" => $id,':beid'=>$_CMS['beid']));
                 include page('adv');
        } elseif ($operation == 'delete') {
            $id = intval($_GP['id']);
            $adv = mysqld_select("SELECT id  FROM " . table('shop_adv') . " WHERE id = '$id' and beid=:beid ",array(':beid'=>$_CMS['beid']));
            if (empty($adv)) {
                message('抱歉，幻灯片不存在或是已经被删除！', web_url('adv', array('op' => 'display')), 'error');
            }
            mysqld_delete('shop_adv', array('id' => $id,'beid'=>$_CMS['beid']));
            message('幻灯片删除成功！', web_url('adv', array('op' => 'display')), 'success');
        } else {
            message('请求方式不存在');
        }