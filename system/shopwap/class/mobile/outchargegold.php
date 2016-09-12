<?php

				
		   $member=get_member_account(true,true);
			$openid = $member['openid'];
       $member=member_get($openid);
       

       	  if(empty( $member['weixinhao'])||empty( $member['realname']))
       {
       message('您的资料不完善，请完善微信号等相关资料。',mobile_url('member'),'error');
       }
       
       	$op = $_GP['op']?$_GP['op']:'display';
       	if($op=='display')
       	{
       				  if (checksubmit('submit')) {
       			
       				  		if(empty($_GP['charge'])||round($_GP['charge'],2)<=0)
		{
		message("请输入要提取的金额");	
		}	  	$fee=round($_GP['charge'],2);
		if($fee>$member['gold'])
		{
			message('账户余额不足,最多能提取'.$member['gold'].'元');
			
		}
				$ordersn= 'rg'.date('Ymd') . random(6, 1);
	 $gold_order = mysqld_select("SELECT * FROM " . table('gold_teller') . " WHERE ordersn = '{$ordersn}' and beid=:beid",array(':beid'=>$_CMS['beid']));
	         if(!empty($gold_order['ordersn']))
	         {
	         		$ordersn= 'rg'.date('Ymd') . random(6, 1);
	         }
       				 	member_gold($openid,$fee,'usegold','余额提取'.$fee.'元');
       				  	mysqld_insert('gold_teller',array('openid'=>$openid,'fee'=>$fee,'status'=>0,'ordersn'=>$ordersn,'createtime'=>time(),'beid'=>$_CMS['beid']));
       				  	
       				   if($_CMS['addons_bj_message']) {
	 	

              bj_message_sendyetxtjtz( $fee,$openid);
  }
  
       		message('余额提取申请成功！','refresh','success');
       	exit;
       	 }
       	$applygold=mysqld_selectcolumn("select sum(fee) from ".table("gold_teller")." where beid=:beid and status=0 and openid=".	$openid,array(':beid'=>$_CMS['beid']));
				if(empty($applygold))
				{
				$applygold='0';	
				}
				include themePage('outchargegold');
				exit;
				}

				if($op=='history')
       	{
       		  
				       $list = mysqld_selectall("select * from ".table("gold_teller")." where openid=:openid and beid=:beid order by createtime desc " ,array(":openid"=>$openid,':beid'=>$_CMS['beid']));

            
       			include themePage('outchargegold_history');
				exit;
       	}
       	
       		if($op=='history2')
       	{
       

          	$list = mysqld_selectall("SELECT * FROM ".table('member_paylog')." where openid=:openid  and (`type`='usegold' or `type`='addgold') order by createtime desc ", array(':openid' => $openid));


				
       			include themePage('outchargegold_history2');
				exit;
       	}