<?php
				
        	$condition .= " AND istime = 1 and timeend>=:timeend";




       
        $list = mysqld_selectall("SELECT * FROM " . table('shop_goods') . " WHERE  deleted=0  and ((is_system=0 and beid=:beid) or is_system=1) AND status = '1' $condition  ",array(":timeend"=>time(),':beid'=>$_CMS['beid']));
  
       
				
	
        include themePage('time_goodlist');