<?php

   $member=get_member_account(true,true);
			$openid = $member['openid'];
       $member=member_get($openid);

	 $setting = mysqld_select("SELECT * FROM " . table('addon7_config')." where beid=:beid ",array(':beid'=>$_CMS['beid']) );
 $award_list = mysqld_selectall("SELECT * FROM " . table("addon7_award") . "  where `deleted`=0 and amount>0 and beid=:beid ",array(':beid'=>$_CMS['beid']) );
   

 include addons_page('index');