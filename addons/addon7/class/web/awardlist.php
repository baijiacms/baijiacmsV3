<?php
  $awardlist = mysqld_selectall("select * FROM " . table('addon7_award')." where deleted=0 and beid=:beid ",array(':beid'=>$_CMS['beid']));


 include addons_page('awardlist');