<?php
		$member = mysqld_select('SELECT * FROM '.table('member').' where openid=:openid and beid=:beid', array(':openid' => $_GP['openid'],":beid"=>$_CMS['beid']));
	 	$weixininfo=mysqld_select('SELECT * FROM '.table('weixin_wxfans').' where openid=:openid  and beid=:beid', array(':openid' => $_GP['openid'],":beid"=>$_CMS['beid']));

	
     if (checksubmit('submit')) {
	     	if(!empty($member['openid']))
	     	{
	     	
	     	}
	     			if($member['mobile']!=$_GP['mobile'])
			{
			
				$checkmember = mysqld_select('SELECT * FROM '.table('member').' where mobile=:mobile and beid=:beid', array(':mobile' => $_GP['mobile'],":beid"=>$_CMS['beid']));
		 		if(!empty($checkmember['openid']))
		 		{
					message($_GP['mobile']."已被注册。");	
				}
			}
	     		$datas=array('realname'=> $_GP['realname'],'mobile'=> $_GP['mobile'],'email'=> $_GP['email']);
	     	if(!empty($_GP['password']))
	     	{
	     			if($_GP['password']==$_GP['repassword'])
			     	{
			     		$datas['pwd']=md5($_GP['password']);
			     	}else
			     	{
			     		
			     		message("两次密码不相同");
			     		}
	     		
	     	}
              mysqld_update('member', $datas, array('openid' => $_GP['openid'],"beid"=>$_CMS['beid']));
	     		   message('操作成功！', 'refresh', 'success');
	     	}
     	
	include page('detail');