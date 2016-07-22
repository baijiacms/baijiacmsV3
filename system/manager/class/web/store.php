<?php

        $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
        	if($operation=='delete')
			{
				$store = mysqld_select("SELECT * FROM " . table('system_store')." where `deleted`=0 and `id`=:id",array(":id"=>intval($_GP['id'])));
    
			   	 	mysqld_update('system_store',array("deleted"=>1),array('id'=>$store['id']));
						message("关闭成功！","refresh","success");
			}
            if($operation=='post')
        {
        	
        	$store = mysqld_select("SELECT * FROM " . table('system_store')." where `deleted`=0 and `id`=:id",array(":id"=>intval($_GP['id'])));
        	if(!empty($store['id']))
        	{
        	$besetting=globaBeSetting($store['id']);
     		  }
        
            
        	   if (checksubmit('submit')) {
        	$website_store = mysqld_select("SELECT * FROM " . table('system_store')." where `deleted`=0 and `website`=:website",array(":website"=>$_GP['website']));
    
        	   		
        					$data=array('sname'=>$_GP['sname'],'is_system'=>0,
				'isclose'=>
				intval($_GP['isclose']));
			
       $data['website']=$_GP['website'];
       		
       
			
                
                if(!empty($website_store['id'])&&$website_store['id']!=$store['id'])
                {
                	
                message("绑定的站点域名已存在！请更换其他域名");	
                }
               
                
                
		
				  if(	empty($store['id']))
					   {
					   	$data['createtime']=time();
        		mysqld_insert('system_store',$data);
        		  $store_id = mysqld_insertid();
        message("添加成功",create_url('site', array('name' => 'manager','do' => 'store','op'=>'display')),"success");
        	}else
        	{
    
        			mysqld_update('system_store',$data,array('id'=>$store['id']));
        message("修改成功",create_url('site', array('name' => 'manager','do' => 'store','op'=>'display')),"success");
        	}
        	

        	
						}
        			include page('store_post');
        }
        if($operation=='display')
        {
        	           $pindex = max(1, intval($_GP['page']));
            $psize = 20;

            	
            	 if (!empty($_GP['sname'])) {
                $selectCondition .= " AND store.sname  LIKE '%{$_GP['sname']}%'";
            }
            
     
            	
            
        		 $selectCondition.=" LIMIT " . ($pindex - 1) * $psize . ',' . $psize;
						    
        	 	$store_list = mysqld_selectall("SELECT store.*FROM " . table('system_store')." store where store.`deleted`=0 ".$selectCondition);
       
       
      
            
            
           $total = mysqld_selectcolumn("SELECT count(*) FROM " . table('system_store')." store  where store.`deleted`=0 ".$selectCondition);
            $pager = pagination($total, $pindex, $psize);
            
        			include page('store_display');
        	
        }
     
        