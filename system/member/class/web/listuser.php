<?php	 
$list = mysqld_selectall("select * from " . table('user')."where beid=:beid",array(":beid"=>$_CMS['beid']));

include page('listuser');