<?php
	$system_store = mysqld_select('SELECT * FROM '.table('system_store')." WHERE  id=:beid" , array(':beid'=> $_CMS['beid']));

	 $setting = mysqld_select("SELECT * FROM " . table('addon7_config')." where beid=:beid",array(':beid'=>$_CMS['beid']) );
 
  if (checksubmit("submit")) {
  	      $cfg = array(
                'title' => $_GP['title'],'beid'=>$_CMS['beid']
            );
           mysqld_delete('addon7_config',array('beid'=>$_CMS['beid']));
          	   mysqld_insert('addon7_config', $cfg);
             
            message('保存成功', 'refresh', 'success');
	}
 
 include addons_page('setting');