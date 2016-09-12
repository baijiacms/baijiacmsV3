<?php
  $awardlist = mysqld_selectall("select award.awardtype,award.gold,request.id,request.realname,request.mobile,request.address,award.title,award.credit_cost,award.price,request.createtime FROM " . table('addon7_request')." request left join " . table('addon7_award')." award on award.id=request.award_id where request.beid=:beid and status=0",array(':beid'=>$_CMS['beid']));


 include addons_page('applyed');