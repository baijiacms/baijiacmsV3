<?php
			$config=globaSetting();
			$cfg=$config;
			$showWXsynBtn=false;
			if ( is_weixin_access()) {
				$showWXsynBtn=true;
			}
			  if ($_GP['op']=='updateweixinsubmit') {
			  	
			  		if ( is_weixin_access()) {
	$weixin_wxfans_list = mysqld_selectall('SELECT * FROM '.table('weixin_wxfans')." where beid=:beid and follow=1",array(":beid"=>$_CMS['beid']));
	$batch_weixin_id_list=array();
			foreach($weixin_wxfans_list as $weixin_item){
				
				 
				if(empty($weixin_item['nickname'])||empty($weixin_item['avatar']))
				{
					if(!empty($weixin_item['weixin_openid']))
					{
					$batch_weixin_id_list[]=array('openid'=>$weixin_item['weixin_openid'],'lang'=>'zh-CN');
					}
				}
				
			
      		}
      		
      		if(count($batch_weixin_id_list)>0)
      		{
      			$batch_userinfo_list=get_weixin_batch_userinfo($batch_weixin_id_list);
      			if(!empty($batch_userinfo_list))
      			{
      					foreach($batch_userinfo_list as $weixin_item){
									if($weixin_item['subscribe']==1&&!empty($weixin_item['openid'])&&(!empty($weixin_item['nickname'])||!empty($weixin_item['headimgurl'])))
									{
										 $gender=$weixin_item["sex"];
											$nickname=$weixin_item["nickname"];
					$nickname=filter_weixinname_emoji($nickname);
							
												$avatar=$weixin_item["headimgurl"];
											$row = array(
											'gender' => intval($gender)
										);
										if(!empty($nickname))
										{
											$row['nickname']=$nickname;
										}
											if(!empty($weixin_item['headimgurl']))
										{
											$row['avatar']=$avatar;
										}
										
										
											mysqld_update('weixin_wxfans',$row,array('weixin_openid'=>$weixin_item['openid'],'beid'=>$_CMS['beid']));	
									}
				
								}
      				
      			}
      		}
      		
      		$weixin_wxfans_list = mysqld_selectall('SELECT * FROM '.table('weixin_wxfans')." where beid=:beid and follow=1",array(":beid"=>$_CMS['beid']));
							foreach($weixin_wxfans_list as $weixin_item){
									if(!empty($weixin_item['nickname'])&&!empty($weixin_item['avatar'])&&!empty($weixin_item['openid']))
									{
								
							      			$it_member = mysqld_select('SELECT nickname,realname,openid,avatar FROM '.table('member')." where openid=:openid and beid=:beid ",array(":openid"=>$weixin_item['openid'],":beid"=>$_CMS['beid']));
												if(!empty($it_member['openid']))
												{
												
													mysqld_update('member',array('nickname'=>$weixin_item['nickname']),array('openid'=>$it_member['openid'],'beid'=>$_CMS['beid']));	
												
														
													mysqld_update('member',array('avatar'=>$weixin_item['avatar']),array('openid'=>$it_member['openid'],'beid'=>$_CMS['beid']));	
												
													
													if((empty($it_member['realname'])))
													{
													mysqld_update('member',array('realname'=>$weixin_item['nickname']),array('openid'=>$it_member['openid'],'beid'=>$_CMS['beid']));	
													}
												}
													
									}
							}
      		}
      		
			  	message("同步完成",'refresh','success');
			  }
		  $pindex = max(1, intval($_GP['page']));
      $psize = 30;
      $condition='';
      $conditiondata=array();
      if(!empty($_GP['realname']))
      {
      	
      	 $condition=$condition.' and realname like :realname';
      	 $conditiondata[':realname']='%'.$_GP['realname'].'%';
      }
      
         if(!empty($_GP['userid']))
      {
      	
      	 $condition=$condition.' and openid = :userid';
      	 $conditiondata[':userid']=$_GP['userid'];
      }
      

      
      
      $allow_usercredit=false;
$allow_usergold=false;
$allow_edituser=false;
	if (!empty($_CMS[WEB_SESSION_ACCOUNT])&&!empty($_CMS[WEB_SESSION_ACCOUNT]['is_system'])) {
		$allow_usercredit=true;
$allow_usergold=true;
$allow_edituser=true;
	}

	

      
         if(!empty($_GP['mobile']))
      {
      	
      	 $condition=$condition.' and mobile like :mobile';
      	 $conditiondata[':mobile']='%'.$_GP['mobile'].'%';
      }

      $status=1;
          if(empty($_GP['showstatus'])||$_GP['showstatus']==1)
      {
      	
      	 $status=1;
      }
     
         if($_GP['showstatus']==-1)
      {
      	
      	 $status=0;
      }
      if(!empty($_GP['rank_level']))
      {
      $rank_model = mysqld_select("SELECT * FROM " . table('rank_model')."where beid=:beid and rank_level=".intval($_GP['rank_level']),array(":beid"=>$_CMS['beid']) );
      if(!empty($rank_model['rank_level']))
      {
      			$condition=$condition." and experience>=".$rank_model['experience'];
      	 		 	$rank_model2 = mysqld_select("SELECT * FROM " . table('rank_model')."where rank_level>".$rank_model['rank_level'].' and beid=:beid order  by rank_level limit 1',array(":beid"=>$_CMS['beid']) );
  								if(!empty($rank_model2['rank_level']))
  								{
  									if(intval($rank_model['experience'])<intval($rank_model2['experience']))
  									{
  									$condition=$condition." and experience<".$rank_model2['experience'];
  									}
  								}
  							}
      }
      
      $rank_model_list = mysqld_selectall("SELECT * FROM " . table('rank_model')." where beid=:beid order by rank_level",array(":beid"=>$_CMS['beid'])  );
  	$condition=$condition." and beid=:beid ";
  	$conditiondata['beid']=$_CMS['beid'];
			$list = mysqld_selectall('SELECT * FROM '.table('member')." where 1=1 and `istemplate`=0  and `status`=$status $condition order by createtime desc "." LIMIT " . ($pindex - 1) * $psize . ',' . $psize,$conditiondata);
	 		$total = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('member')." where 1=1 and `istemplate`=0 $condition ",$conditiondata);
      $pager = pagination($total, $pindex, $psize);
      
      		foreach($list as  $index=>$item){
      			
      				 $list[$index]['weixin']= mysqld_select("SELECT * FROM " . table('weixin_wxfans') . " WHERE openid = :openid and beid=:beid limit 1", array(':openid' => $item['openid'],":beid"=>$_CMS['beid']));
		        	$list[$index]['alipay'] = mysqld_selectall("SELECT * FROM " . table('alipay_alifans') . " WHERE openid = :openid and beid=:beid", array(':openid' => $item['openid'],":beid"=>$_CMS['beid']));
		   
      		}
			include page('list'); 