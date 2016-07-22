<?php
	$settings=globaSetting();
			
			$operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
			if($operation=='post')
			{
				if(!empty($_GP['theme']))
				{
					$cfg=array("shop_current_themes"=>$_GP['theme']);
          refreshSetting($cfg);
				}
				
			
				
				clear_theme_cache();
				  message('保存成功', 'refresh', 'success');
			}
			
			$items=$settings['shop_current_themes'];
		if(empty($items))
		{
		$items='default';
		
		}
			$mydir = dir(WEB_ROOT . "/themes/");
			$themes=array();
			$index=0;
			while($file = $mydir->read())
			{
				if((is_dir(WEB_ROOT . "/themes/$file")) AND ($file!=".") AND ($file!=".."))
				{
					$themes[$index++]=$file;
				}
			}
        	include page('themes');