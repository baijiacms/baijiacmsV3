<?php 
	$settings=globaSetting();
		    	$member=get_member_account(false);
				$member=member_get($member['openid']);
			if(empty($member['openid']))
				{
				$member=get_member_account(false);	
				$member['createtime']=time();
				}
			$is_login=is_login_account();
			$weixinid=$_SESSION[MOBILE_WEIXIN_OPENID];
			$weixinfans=get_weixin_fans_byopenid($member['openid'],$weixinid);
			if(!empty($weixinfans)&&!empty($weixinfans['avatar']))
			{
				$avatar=$weixinfans['avatar'];
			}
		
			if($is_login)
			{
					$fansindex_menu_list = mysqld_selectall("SELECT * FROM " . table('shop_diymenu')." where menu_type='fansindex' and beid=:beid order by torder desc",array(':beid'=>$_CMS['beid']) );	
					if(!empty($avatar)&&empty($member['avatar']))
					{
						mysqld_update('member',array('avatar'=>$avatar),array('openid'=>$member['openid'],'beid'=>$_CMS['beid']));
						
					}
					
					
			}
		
		$nologout=false;	
			if ( is_use_weixin() ) {
$weixinthirdlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='weixin' and beid=:beid",array(':beid'=>$_CMS['beid']) );

if(!empty($weixinthirdlogin)&&!empty($weixinthirdlogin['id']))
{
$nologout=true;
}
}
		
			
			
				$hasqrcode=false;

	  
           $where = "openid = '".$member['openid']."' and (is_be=1 or is_system=1)";

			    	
                $where1=$where." and status=0";
                 $total1 = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order') . " WHERE  $where1  and beid=:beid ", array(':beid'=>$_CMS['beid']));
       
       
             
                $where2=$where." and status=1 and ((is_be=1 and be_status=0 ) or (is_system=1 and zong_status=0))";
                  $total2 = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order') . " WHERE  $where2  and beid=:beid ", array(':beid'=>$_CMS['beid']));

              
                		
                 $where3=$where." and ((is_be=1 and be_status=2 ) or (is_system=1 and zong_status=2))";
                 $total3 = mysqld_selectcolumn('SELECT COUNT(*) FROM ' . table('shop_order') . " WHERE  $where3  and beid=:beid ", array(':beid'=>$_CMS['beid']));
       
          
              
             
                  $total4 =0;
       
             
			include themePage('fansindex');
			
		