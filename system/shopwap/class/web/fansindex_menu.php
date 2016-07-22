<?php
			$operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
			if($operation=='delete')
			{
					mysqld_delete('shop_diymenu',array("id"=>intval($_GP['id']),"beid"=>$_CMS['beid']));
						message("删除成功！","refresh","success");
			}
			if($operation=='post')
			{
					$fansindex_menu = mysqld_select("SELECT * FROM " . table('shop_diymenu')." where id='".intval($_GP['id'])."' and menu_type='fansindex' and beid=:beid",array(":beid"=>$_CMS['beid']) );
  	   if (checksubmit('submit')) {
					  if(	empty($_GP['id']))
					   {
				$data=array('tname'=>
				$_GP['tname'],'url'=>
				$_GP['url'],'icon'=>
				$_GP['icon'],'menu_type'=>
				'fansindex','torder'=>
				intval($_GP['torder']),"beid"=>$_CMS['beid']);
				mysqld_insert('shop_diymenu',$data);
				message("添加成功",create_url('site', array('name' => 'shopwap','do' => 'fansindex_menu','op'=>'display')),"success");
					}else
					{
							$data=array('tname'=>
				$_GP['tname'],'url'=>
				$_GP['url'],'icon'=>
				$_GP['icon'],'menu_type'=>
				'fansindex','torder'=>
				intval($_GP['torder']));
				mysqld_update('shop_diymenu',$data,array('id'=>
				$_GP['id'],"beid"=>$_CMS['beid']));
				
				message("修改成功","refresh","success");
					}
				}
				   
				    	include page('fansindex_menu');
				    	exit;
			}
		$fansindex_menu_list = mysqld_selectall("SELECT * FROM " . table('shop_diymenu')." where menu_type='fansindex' and beid=:beid order by torder desc",array(":beid"=>$_CMS['beid']) );
       	
        	include page('fansindex_menu_list');