<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
	$id=	$_CMS[WEB_SESSION_ACCOUNT]['id'];
		 					 $username=	$_CMS[WEB_SESSION_ACCOUNT]['username'];
		 if (checksubmit('submit')) {
		$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id = :id and password=:password and beid=:beid " , array(':id' => $id,':password'=> md5($_GP['oldpassword']),":beid"=>$_CMS['beid']));
	
		if(!empty($account['id']))
		{
			if(empty($_GP['newpassword']))
			{
				
					message('新密码不能为空！','refresh','error');	
			}
			
			if($_GP['newpassword']!=$_GP['confirmpassword'])
			{
				
					message('两次密码不一致！','refresh','error');	
				
			}
			$data= array('password'=> md5($_GP['newpassword']));
			 mysqld_update('user', $data, array('id' => $account['id'],"beid"=>$_CMS['beid']));
					message('密码修改成功！',create_url('site',array('name' => 'index','do' => 'changepwd')),'succes');	
		}else
		{
			message('密码错误！','refresh','error');	
		}
		 	
		}
			include page('changepwd');