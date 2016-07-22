<?php
defined('SYSTEM_IN') or exit('Access Denied');

		$system_store = mysqld_select('SELECT website FROM '.table('system_store')." where `id`=:id",array(":id"=>$_CMS['beid']));
			
		
		$menus = $this->menuQuery();
		
		
		
			include page('designer');