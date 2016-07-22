<?php
defined('SYSTEM_IN') or exit('Access Denied');

			$ret = $this->menuDelete();
		if(is_error($ret)) {
			message($ret['message'], 'refresh');
		} else {
			message('已经成功删除菜单，请重新创建。', 'refresh');
		}