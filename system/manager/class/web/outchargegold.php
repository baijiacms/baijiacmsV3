<?php
			$op = $_GP['op']?$_GP['op']:'display';
			$status = intval($_GP['status']);
 	if($op=='display')
       	{
				$list = mysqld_selectall("SELECT teller.*,member.realname,member.mobile,member.outgoldinfo FROM ".table('gold_teller')." teller  left join " . table('member') . " member on teller.openid=member.openid where teller.status=:status order by teller.createtime desc",array('status'=>$status));

		
		include page('outchargegold');
		exit;
	}
	 	if($op=='post')
       	{
       		$id=intval($_GP['id']);
       		$gold_teller = mysqld_select("SELECT teller.* FROM ".table('gold_teller')." teller where teller.status=0 and id=:id ",array(':id'=>$id));
					
       		if(intval($_GP['tostatus'])==-1)
       		{
       				if(!empty($gold_teller['openid']))
						{
							 	member_gold($gold_teller['openid'],$gold_teller['fee'],'addgold','余额审核拒绝后返回账户'.$gold_teller['fee'].'元');
							
						}
       		 	 if($_CMS['addons_bj_message']) {
              bj_message_sendyetxsbtz( $gold_teller['fee'],$gold_teller['openid']);
 						 }
       		}else
       		{
       			 		 if($_CMS['addons_bj_message']) {
              bj_message_sendsyetxcgtz( $gold_teller['fee'],$gold_teller['openid']);
  						}
       			
       		}
       		
       		mysqld_update('gold_teller',array('status'=>intval($_GP['tostatus'])),array('id'=>$id));
       		
       		message("审核完成！",'refresh','success');
       
       	}