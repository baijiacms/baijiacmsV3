<?php
			$this->checkVersion();//版本检查更新
			  $this->checkAddons();//插件检查更新
							 	$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_CMS[WEB_SESSION_ACCOUNT]['id']));
	
								
								
$username=	$_CMS[WEB_SESSION_ACCOUNT]['username'];
	$settings=globaSystemSetting();
	$condition='';
	if(mysqld_fieldexists('modules', 'isdisable')) {
	$condition=' and `isdisable`=0 ';
}
		$modulelist = mysqld_selectall("SELECT *,'' as menus FROM " . table('modules') . " where 1=1 $condition order by displayorder");
		foreach($modulelist as $index => $module)  
							{
		
				
					
					
						$modulelist[$index]['menus']=mysqld_selectall("SELECT * FROM " . table('modules_menu') . " WHERE `module`=:module order by id",array(':module'=>$module['name']));
					
			
					
			//	unset($modulelist[$index]);	


	
		
		}
		
				include page('main');