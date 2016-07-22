<?php

		 $operation = !empty($_GP['op']) ? $_GP['op'] : 'list';
				$addons = dir(WEB_ROOT.'/system/modules/plugin/payment/'); 
				$modules=array();
				$index=0;
				        
				while($file = $addons->read())
				{ 
					if(($file!=".") AND ($file!="..")) 
					{
						$modules[$index]['code']=$file;
						$item = mysqld_select("SELECT * FROM " . table('payment') . " WHERE enabled=1 and code = :code and beid=:beid", array(':code' => $file,":beid"=>$_CMS['beid']));
       			
						require WEB_ROOT.'/system/modules/plugin/payment/'.$file.'/lang.php';
						    if (empty($item['id'])) {
       			    	$modules[$index]['enable']=0;
       			    }else
       			    {
       			    		$modules[$index]['enable']=1;
       			    }
						$index=$index+1;
					}
				}
		include page('payment');