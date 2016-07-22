<?php
defined('SYSTEM_IN') or exit('Access Denied');
	  $operation = !empty($_GP['op']) ? $_GP['op'] : 'listuser';
	   if ($operation == 'listuser') {
	   	
	   			 $list = mysqld_selectall("select * from " . table('user')." order by is_admin desc ");
	 	 foreach ( $list as $id => $item) {
					 	 	if(!empty($item['beid'])&&empty($item['is_admin']))
					 	 	{
			             	 	$list[$id]['store']=mysqld_select("SELECT *	from" . table('system_store') . " system_store where system_store.id=:beid  ",array(':beid' => $item['beid']));;
       				}           	
                }
			include page('listuser');
	  }
	
	  
	  if ($operation == 'deleteuser') {
	  		mysqld_delete('user', array('id'=>$_GP['id']));
		message('删除成功',refresh(),'success');	
	  }
	  
	  	 
	  
	   	  if ($operation == 'changepwd') {
	   	  			$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_GP['id']));
	   	  	
	   	  				 if (checksubmit('submit')) {
			 	if(empty($_GP['newpassword']))
							 	{
							 		message('密码不能为空',refresh(),'error');	
							 	}
							if($_GP['newpassword']!=$_GP['confirmpassword'])
							{
								
									message('两次密码不一致！',refresh(),'error');	
								
							}
							
							
							$data= array('password'=> md5($_GP['newpassword']),'createtime'=>time());
							 mysqld_update('user', $data,array('id'=> $account['id']));
							 
									message('密码修改成功！',web_url('user'),'succes');	
							}
			
			
	   	  			include page('changepwd');
	   	  }
	   	  
	  	  if ($operation == 'edituser') {
	  	  	
	  	  		 	$store_list = mysqld_selectall("SELECT store.*FROM " . table('system_store')." store where store.`deleted`=0 ");
       
	  	  		$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_GP['id']));
				
	  	  	
	  	  		
	  						 if (checksubmit('submit')) {
							 	if(empty($_GP['username']))
							 	{
							 		message('用户名不能为空');	
							 	}
							 	
						
							
						if(empty($account['id'])||$account['username']!=$_GP['username'])
						{
							$t_account = mysqld_select('SELECT * FROM '.table('user')." WHERE  username=:username  limit 1" , array(':username'=> $_GP['username']));
							if(!empty(	$t_account['id']))
							{
							message("该用户名已存在，不能重复使用");	
							}
							
						}
						if(empty($_GP['is_admin']))
						{
							$store = mysqld_select("SELECT id FROM " . table('system_store')." store where store.id=:beid ",array(":beid"=>$_GP['store']));
	       			if(empty($store['id']))
	       			{
	       					message("请选择店铺");	
	       			}
       			}
						
						if(empty($account['id']))
						{
							if(empty($_GP['newpassword']))
							{
										message('登录密码不能空');	
							}
							if($_GP['newpassword']!=$_GP['confirmpassword'])
							{
								
									message('两次密码不一致！');	
								
							}
							
							
							$data= array('beid'=>$_GP['store'],'is_admin'=>$_GP['is_admin'],'username'=> $_GP['username'],'password'=> md5($_GP['newpassword']),'createtime'=>time());
							 mysqld_insert('user', $data);
							 
							 
					
						
							 
							 
									message('新增用户成功！',web_url('user'),'succes');	
						}else
						{
				
				if(!empty($_GP['is_admin']))
				{
					$_GP['store']=0;
				}
				
				
					$data= array('beid'=>$_GP['store'],'is_admin'=>$_GP['is_admin'],'username'=> $_GP['username']);
							 mysqld_update('user', $data,array('id'=>$account['id']));
							 
							 
					
						
							 
							 
									message('新增用户成功！',web_url('user'),'succes');	
				
				
						}
						
		 	
					}
	
			include page('edituser');
	  }
