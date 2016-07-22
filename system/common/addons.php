<?php
defined('SYSTEM_IN') or exit('Access Denied');
abstract class BjModule {
	
		public function __web($f_name){
			global $_CMS,$_GP,$modulename;
						if(empty($_CMS['beid']))
			{
			message("未找到站点ID");	
			}
			$this->checklogin();
			$config=globaSetting($_CMS['beid']);
			$cfg=$config;
			include_once  ADDONS_ROOT.$modulename.'/class/web/'.strtolower(substr($f_name,3)).'.php';
		}
		public function __mobile($f_name){
			global $_CMS,$_GP,$modulename;
			
				if(empty($_CMS['beid']))
			{
			message("未找到站点ID");	
			}
			$config=globaSetting($_CMS['beid']);
			$cfg=$config;
		include_once  ADDONS_ROOT.$modulename.'/class/mobile/'.strtolower(substr($f_name,3)).'.php';
	}
			function checklogin()
		{
			global $_CMS;
							if (empty($_SESSION[WEB_SESSION_ACCOUNT])) {
				message('会话已过期，请先登录！',create_url('mobile',array('name' => 'public','do' => 'logout')), 'error');
			}
		
		
				if (!empty($_SESSION[WEB_SESSION_ACCOUNT])&&!empty($_SESSION[WEB_SESSION_ACCOUNT]['is_admin'])) {
						 $system_user = mysqld_select('SELECT id FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_SESSION[WEB_SESSION_ACCOUNT]['id']));
	 $store = mysqld_select("SELECT id FROM " . table('system_store')." where `deleted`=0 and `id`=:id ",array(":id"=>$_CMS['beid']));
     if(empty($system_user['id'])||empty($store['id']))
     {
				message('会话已过期，请先登录！',create_url('mobile',array('name' => 'public','do' => 'logout','toname'=>'manager')), 'error');
			}
		}
		
		
			
			return true;
			
		}
}

	function addons_page($filename) {
			global $modulename;
			if(SYSTEM_ACT=='mobile') {
				$source=ADDONS_ROOT .$modulename."/template/mobile/{$filename}.php";
			}else
			{
					$source=ADDONS_ROOT . $modulename."/template/web/{$filename}.php";
			}
			return $source;
		}