<?php
	$account = mysqld_select('SELECT * FROM '.table('user')." WHERE  id=:id and beid=:beid" , array(':id'=> $_CMS[WEB_SESSION_ACCOUNT]['id'],':beid'=> $_CMS['beid']));
	
	$system_store = mysqld_select('SELECT * FROM '.table('system_store')." WHERE  id=:beid" , array(':beid'=> $_CMS['beid']));
		$system_settings=globaSystemSetting();		
								
$username=	$_CMS[WEB_SESSION_ACCOUNT]['username'];
	$settings=globaSetting($_CMS['beid']);
		

	$condition='';
	if(mysqld_fieldexists('modules', 'isdisable')) {
	$condition=' and `isdisable`=0 ';
}
		$modulelist = mysqld_selectall("SELECT *,'' as menus FROM " . table('modules') . " where 1=1 $condition and icon!='hidden' order by displayorder");
		foreach($modulelist as $index => $module)  
							{
		
	
					
					
						$modulelist[$index]['menus']=mysqld_selectall("SELECT * FROM " . table('modules_menu') . " WHERE `module`=:module order by id",array(':module'=>$module['name']));
					
		

	
		
		}
		
				include page('main');