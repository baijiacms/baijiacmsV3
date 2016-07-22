<?php
		$op=$_GP['op'];
		if($op=='credit')
					{
						$condition="  (`type`='usecredit' or `type`='addcredit')";
					}
			if($op=='gold')
					{
							$condition=" (`type`='usegold' or `type`='addgold')";
					}
			$member = mysqld_select("SELECT * FROM ".table('member')." where openid=:openid and beid=:beid ", array(':openid' => $_GP['openid'],":beid"=>$_CMS['beid']));
				$list = mysqld_selectall("SELECT * FROM ".table('member_paylog')." where openid=:openid  and $condition  order by createtime desc", array(':openid' => $_GP['openid']));

		
			if (checksubmit('submit')) {
				if(!is_numeric($_GP['fee'])||$_GP['fee']<0)
				{
					message("输入的数字非法请重新输入");
				}
				
				if(!empty($member['openid']))
				{
					if($op=='credit')
					{
						
						if(empty($_GP['op_type']))
						{
						member_credit($_GP['openid'],$_GP['fee'],'addcredit',$_GP['remark']);
						message('积分充值成功','refresh','success');	
						}else
						{
										member_credit($_GP['openid'],$_GP['fee'],'usecredit',$_GP['remark']);
						message('积分消费成功','refresh','success');	
						}
					}
					if($op=='gold')
					{
						if(empty($_GP['op_type']))
						{
     				member_gold($_GP['openid'],$_GP['fee'],'addgold',$_GP['remark']);
						message('余额充值成功','refresh','success');	
						}else
						{
										member_gold($_GP['openid'],$_GP['fee'],'usegold',$_GP['remark']);
						message('余额消费成功','refresh','success');	
							
						}
					}
				}
			}
		include page($op);