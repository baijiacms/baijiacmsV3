<?php

		 $operation = !empty($_GP['op']) ? $_GP['op'] : 'list';
				$addons = dir(WEB_ROOT.'/system/modules/plugin/dispatch/'); 
				$modules=array();
				$index=0;
				       
			if( $operation=='uninstall')
			{
		
						while($file = $addons->read())
				{ 
					if(($file!=".") AND ($file!="..")) 
					{
			
						$item = mysqld_select("SELECT * FROM " . table('dispatch') . " WHERE enabled=1 and code = :code and beid=:beid", array(':code' => $file,':beid'=>$_CMS['beid']));
						if(empty($item['code']))
						{
       						$modules[$index]['code']=$file;
						require WEB_ROOT.'/system/modules/plugin/dispatch/'.$file.'/lang.php';
						    if (empty($item['id'])) {
       			    	$modules[$index]['enabled']=0;
       			    }else
       			    {
       			    		$modules[$index]['enabled']=1;
       			    }
						$index=$index+1;
						}
					}
				}
		include page('dispatch');
		exit;
				       
				       	
				 }
				        
				       	$modules = mysqld_selectall("SELECT * FROM " . table('dispatch') . " WHERE enabled=1 and beid=:beid",array(':beid'=>$_CMS['beid']));
       		foreach($modules as $module) { 
       			
						require WEB_ROOT.'/system/modules/plugin/dispatch/'.$module['code'].'/lang.php';
       		}
				       
		include page('dispatch');