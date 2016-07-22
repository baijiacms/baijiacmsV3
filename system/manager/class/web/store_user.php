<?php
defined('SYSTEM_IN') or exit('Access Denied');
	  $operation = !empty($_GP['op']) ? $_GP['op'] : 'listuser';
	  $beid=$_GP['beid'];
	  
	  $store = mysqld_select("SELECT * FROM " . table('system_store')." where `deleted`=0 and `id`=:id",array(":id"=>intval($beid)));
     if(empty($store['id']))
     {
     message("未找到相关店铺");	
     }
	  
	   if ($operation == 'listuser') {
	   	
	   			 $list = mysqld_selectall("select * from " . table('user')." where beid=:beid",array(":beid"=>$beid));

			include page('storeuser_listuser');
	  }
	
	  
	  if ($operation == 'deleteuser') {
	  		mysqld_delete('user', array('id'=>$_GP['id'],"beid"=>$beid));
		message('删除成功',refresh(),'success');	
	  }
	  
	  	
	  
	   	  if ($operation == 'changepwd') {
	   	  			$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id=:id and beid=:beid" , array(':id'=> $_GP['id'],":beid"=>$beid));
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
							 mysqld_update('user', $data,array('id'=> $account['id'],"beid"=>$beid));
							 
									message('密码修改成功！',web_url('store_user',array("beid"=>$beid)),'succes');	
							}
			
			
	   	  			include page('storeuser_changepwd');
	   	  }
	   	  
	  	  if ($operation == 'adduser') {
								 if (checksubmit('submit')) {
							 	if(empty($_GP['username'])||empty($_GP['newpassword']))
							 	{
							 		message('用户名或密码不能为空',refresh(),'error');	
							 	}
						if($username!=$_GP['username'])
						{
							$t_account = mysqld_select('SELECT * FROM '.table('user')." WHERE  username=:username  and beid=:beid limit 1" , array(':username'=> $_GP['username'],":beid"=>$beid));
						if(!empty(	$t_account['id']))
						{
						message("该用户名已存在，不能重复使用");	
						}
							
						}
						$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  username=:username  and beid=:beid" , array(':username'=> $_GP['username'],":beid"=>$beid));
						
						if(empty($account['id']))
						{
							if($_GP['newpassword']!=$_GP['confirmpassword'])
							{
								
									message('两次密码不一致！',refresh(),'error');	
								
							}
							
							$data= array('username'=> $_GP['username'],"beid"=>$beid,'password'=> md5($_GP['newpassword']),'createtime'=>time());
							 mysqld_insert('user', $data);
							 
							 
							 
									message('新增用户成功！',web_url('store_user',array("beid"=>$beid)),'succes');	
						}else
						{
							message($_GP['username'].'用户名已存在',refresh(),'error');	
						}
						
		 	
					}
	
			include page('storeuser_edituser');
	  }