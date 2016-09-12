<?php

   $member=get_member_account(true,true);
			$openid = $member['openid'];
       $member=member_get($openid);

   
   
 $award_list = mysqld_selectall("select request.status,award.logo,request.realname,request.mobile,request.address,award.title,award.credit_cost,award.price,request.createtime FROM " . table('addon7_request')." request left join " . table('addon7_award')." award on award.id=request.award_id where openid=:openid and request.beid=:beid order by request.id desc",array(":openid"=>$openid,':beid'=>$_CMS['beid']));

  
 include addons_page('awardhistory');