<?php
define('LOCK_TO_ADDONS_INSTALL', true);	
					$addons = dir(ADDONS_ROOT); 
					while($file = $addons->read())
					{ 
						if(($file!=".") AND ($file!="..")) 
							{
											$item = mysqld_select("SELECT * FROM " . table('modules')." where `name`=:name", array(':name' => $file));
					       			if(empty($item['name']))
					       			{
					       					
					       					require ADDONS_ROOT.$file.'/installsql.php';
					       			}else
					       			{
					       				 $addons_version=file_get_contents(ADDONS_ROOT.$file.'/version.php');
												if($addons_version>$item['version'])
												{
															require ADDONS_ROOT.$file.'/updatesql.php';
												}
					       			}
								
							}
					}
					message("模块更新完成!",create_url('site', array('name' => 'manager','do' => 'main')),"success");
