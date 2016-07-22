<?php
defined('SYSTEM_IN') or exit('Access Denied');

			$menu=$_GP['menudate'];
		$return= $this->menuCreate($menu);
		if($return==true)
		{
		message('修改成功', 'refresh', 'success');	
		}else
		{
						message($return);	
			}
