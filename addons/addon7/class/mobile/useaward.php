<?php

   $member=get_member_account(true,true);
			$openid = $member['openid'];
       $member=member_get($openid);

    $award_info = mysqld_select("SELECT * FROM " . table('addon7_award')." where id=:id and beid=:beid",array(":id"=>intval($_GP['award_id']),':beid'=>$_CMS['beid']));
 
 if($member['credit']<$award_info['credit_cost'])
 {
 	message("积分不足无法兑换，您的积分：".$member['credit']."，兑换所需积分".$award_info['credit_cost']);
 }
 if($award_info['amount']<=0)
 {
 	message("该商品已兑换完。");
 }

 
 
	 $setting = mysqld_select("SELECT * FROM " . table('addon7_config')." where beid=:beid ",array(':beid'=>$_CMS['beid']) );
   $request_info = mysqld_select("SELECT * FROM " . table('addon7_request')." where openid=:openid and beid=:beid order by id desc limit 1",array(":openid"=>$openid,':beid'=>$_CMS['beid']));
 
  $address=$request_info['address'];
   $mobile=$request_info['mobile'];
   $realname=$request_info['realname'];
  if(empty($realname))
  {
  $realname=$member['realname'];
	}
	 if(empty($mobile))
  {
  $mobile=$member['mobile'];
	}
	
	 if (checksubmit("submit")) {
	 	 $award_info = mysqld_select("SELECT * FROM " . table('addon7_award')." where id=:id and beid=:beid ",array(":id"=>intval($_GP['award_id']),':beid'=>$_CMS['beid']));
 if(!empty($award_info['id']))
 {
 
	 if($award_info['awardtype']==1)
	 {

	 			member_credit($openid,$award_info['credit_cost'],'usecredit','积分兑换消费积分,兑换id:'.intval($_GP['award_id']));
		member_gold($openid,$award_info['gold'],'addgold',$award_info['credit_cost'].'积分兑换'.$award_info['gold'].'余额,兑换id:'.intval($_GP['award_id']));
	  	 message('提交成功', mobile_url('index'), 'success');
	 }else
		{
					 $insert=array(
	  	 	'openid' => $openid,
	  	 		'realname' => $_GP['realname'],
	  	 		'mobile' => $_GP['mobile'],
	  	 'status' => 0,
	  	  'address' => $_GP['address'],
	  	  		'createtime' => time(),
	  	  		"award_id"=>intval($_GP['award_id']),'beid'=>$_CMS['beid']
	  	 );
	  	 	member_credit($openid,$award_info['credit_cost'],'usecredit','积分兑换消费积分,兑换id:'.intval($_GP['award_id']));
	  	 
	  	   mysqld_insert('addon7_request', $insert);
	  	     message('提交成功', mobile_url('index'), 'success');
	
		}
	
	
  	     
	}
	}
  
 include addons_page('useaward');