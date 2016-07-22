<?php
defined('SYSTEM_IN') or exit('Access Denied');
abstract class BjSystemModule {
		public function __web($f_name){
			global $_CMS,$_GP;
					if(empty($_CMS['beid']))
			{
			message("未找到站点ID");	
			}
			$this->checklogin();
			$config=globaSetting();
			$cfg=$config;
				
			$filephp=$_CMS['module'].'/class/web/'.strtolower(substr($f_name,3)).'.php';

					include_once  SYSTEM_ROOT.$filephp;
		}
		
		
		
		public function __managerweb($f_name){
			global $_CMS,$_GP;
						$this->checkmanagerlogin();
			$filephp=$_CMS['module'].'/class/web/'.strtolower(substr($f_name,3)).'.php';

					include_once  SYSTEM_ROOT.$filephp;
		}
		function checkmanagerlogin()
		{
			global $_CMS;
				if (empty($_SESSION[WEB_SESSION_ACCOUNT])||empty($_SESSION[WEB_SESSION_ACCOUNT]['is_admin'])) {
				message('会话已过期，请先登录！',create_url('mobile',array('name' => 'public','do' => 'logout')), 'error');
			}
			return true;
			
		}
		function checklogin()
		{
			global $_CMS;
							if (empty($_SESSION[WEB_SESSION_ACCOUNT])) {
				message('会话已过期，请先登录！',create_url('mobile',array('name' => 'public','do' => 'logout')), 'error');
			}
		
		
				if (!empty($_SESSION[WEB_SESSION_ACCOUNT])) {
					if(!empty($_SESSION[WEB_SESSION_ACCOUNT]['is_admin']))
					{
						 $system_user = mysqld_select('SELECT id FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_SESSION[WEB_SESSION_ACCOUNT]['id']));
	 $store = mysqld_select("SELECT id FROM " . table('system_store')." where `deleted`=0 and `id`=:id ",array(":id"=>$_CMS['beid']));
     if(empty($system_user['id'])||empty($store['id']))
     {
				message('会话已过期，请先登录！',create_url('mobile',array('name' => 'public','do' => 'logout')), 'error');
			}
		}else
		{
					 $system_user = mysqld_select('SELECT id,beid FROM '.table('user')." WHERE  id=:id" , array(':id'=> $_SESSION[WEB_SESSION_ACCOUNT]['id']));
	 $store = mysqld_select("SELECT id FROM " . table('system_store')." where `deleted`=0 and `id`=:id ",array(":id"=>$_CMS['beid']));
     if($system_user['beid']!=$_CMS['beid']||empty($system_user['id'])||empty($store['id']))
     {
				message('会话已过期，请先登录！',create_url('mobile',array('name' => 'public','do' => 'logout')), 'error');
			}
			
		}
		}
		
		
			
			return true;
			
		}
}