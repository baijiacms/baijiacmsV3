<?php
	define('LOCK_TO_UPDATE', true);	
	 $op = !empty($_GP['op']) ? $_GP['op'] : 'display';
			if($_GP['act']=="toupdate"&&LOCK_TO_UPDATE==true)
			{
				if(is_file(WEB_ROOT.'/system/manager/class/web/updatesql.php'))
					{
						require WEB_ROOT.'/system/manager/class/web/updatesql.php';
					}
				file_put_contents(WEB_ROOT.'/config/version.php',"<?php define('SYSTEM_VERSION', ".CORE_VERSION.");"); 
				//	file_put_contents(WEB_ROOT.'/system/modules/updatesql.php',"<?php defined('SYSTEM_IN') or exit('Access Denied');defined('LOCK_TO_UPDATE') or exit('Access Denied');"); 		
				
					
				
			}
		
		
					message("系统升级完成!",create_url('site', array('name' => 'manager','do' => 'main')),"success");