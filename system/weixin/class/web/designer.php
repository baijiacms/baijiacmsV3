<?php
defined('SYSTEM_IN') or exit('Access Denied');
	
		
		$menus = $this->menuQuery();
		
		if(is_array($menus['menu']['button'])) {
	foreach($menus['menu']['button'] as &$m) {
		if(isset($m['url'])) {
			$m['url'] = urldecode($m['url']);
		}
		if(isset($m['key'])) {
			$m['forward'] = $m['key'];
		}
		if(is_array($m['sub_button'])) {
			foreach($m['sub_button'] as &$s) {
				if(isset($s['url'])){
					$s['url']=urldecode($s['url']);
				}
				$s['forward'] = $s['key'];
			}
		}
	}
}
		
			include page('designer');