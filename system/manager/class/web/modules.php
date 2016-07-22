<?php
$modules_list=mysqld_selectall("SELECT * FROM " . table('modules') . " order by displayorder ");
 $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';

 if($operation=='open_module')
 {
 	
 	
			 mysqld_update('modules',array('isdisable' => 0) , array('name' => $_GP['module_name']));
			 	message('插件启动成功！','refresh','success');
 }
  if($operation=='close_module')
 {
 	
			 mysqld_update('modules',array('isdisable' => 1) , array('name' => $_GP['module_name']));
			 	message('插件关闭成功！','refresh','success');
 	
 }
		include page('modules_list');