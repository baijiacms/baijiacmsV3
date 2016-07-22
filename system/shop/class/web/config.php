<?php
		
			$settings=globaSetting();
			if (checksubmit("submit")) {
								
				if(empty($_GP['shop_system_postsale'])&&false)
		{
				message("退换货期限不能空");
	  }
								
										if(!empty($_GP['shop_auto_confirm']))
				{
					if(empty($_GP['shop_auto_confirm_day']))
					{
						message("请输入发货日起第几天后自动收货！");
					}
						if(intval($_GP['shop_auto_confirm_day'])<=0)
					{
						message("请输入发货日起第几天后自动收货，需大于0！");
					}
				}
				
            $cfg = array(
              'shop_system_postsale' => intval($_GP['shop_system_postsale']),
              'shop_auto_confirm_day' => intval($_GP['shop_auto_confirm_day']),
                  'shop_auto_confirm' => intval($_GP['shop_auto_confirm']),
               'shop_auto_comment' => intval($_GP['shop_auto_comment']),
                'shop_openreg' => intval($_GP['shop_openreg']),
                 'shop_regcredit' => intval($_GP['shop_regcredit']),
				   		  'shop_title' => $_GP['shop_title'],
				   		   'shop_description' => $_GP['shop_description'],
				   		    'shop_kf_qq' => $_GP['shop_kf_qq'],
				   		    'shop_kfcode' => htmlspecialchars_decode($_GP['shop_kfcode']),
				   		    'shop_tongjicode' => htmlspecialchars_decode($_GP['shop_tongjicode']),
				   		  'help' =>   htmlspecialchars_decode($_GP['help'])
            );
      
          	if (!empty($_FILES['shop_logo']['tmp_name'])) {
                    $upload = file_upload($_FILES['shop_logo']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $shoplogo = $upload['path'];
                }
                if(!empty($shoplogo))
                {
                	$cfg['shop_logo']=$shoplogo;
                }
                
                
                      	if (!empty($_FILES['fansindex_bg']['tmp_name'])) {
                    $upload = file_upload($_FILES['fansindex_bg']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $fansindex_bg = $upload['path'];
                }
                if(!empty($fansindex_bg))
                {
                	$cfg['fansindex_bg']=$fansindex_bg;
                }
            
                
                	if (!empty($_FILES['admin_logo']['tmp_name'])) {
                    $upload = file_upload($_FILES['admin_logo']);
                    if (is_error($upload)) {
                        message($upload['message'], '', 'error');
                    }
                    $admin_logo = $upload['path'];
                }
                
                
             
                
                if(!empty($admin_logo))
                {
                	$cfg['admin_logo']=$admin_logo;
                }
                
                   if (!empty($_GP['fansindex_bg_del'])) {
                	$cfg['fansindex_bg'] = '';
                }
               if (!empty($_GP['admin_logo_del'])) {
                	$cfg['admin_logo'] = '';
                }
                 if (!empty($_GP['shop_logo_del'])) {
                	$cfg['shop_logo'] = '';
                }
          	refreshSetting($cfg);
          	
            message('保存成功', 'refresh', 'success');
        }
    
		include page('setting');