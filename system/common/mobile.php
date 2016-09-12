<?php
defined('SYSTEM_IN') or exit('Access Denied');
abstract class BjSystemModule {
		public function __mobile($f_name){
			global $_CMS,$_GP;
			
				if(empty($_CMS['beid']))
			{
			message("未找到站点ID");	
			}
			$config=globaSetting($_CMS['beid']);
			$cfg=$config;
			$filephp=$_CMS['module'].'/class/mobile/'.strtolower(substr($f_name,3)).'.php';
			
			
		
        if($_CMS['shopwap_member_isagent']==true&&empty($_GP['shareid']))
				{
								$member=get_member_account(false);
							$openid=$member['openid'] ;
						 $url  = WEBSITE_ROOT . '/index.php?' . $_SERVER['QUERY_STRING'].'&shareid='.$openid;
					header("Location:".$url);
					exit;
				}
			include_once  SYSTEM_ROOT.$filephp;
	}
	public function __mobile2($f_name){
			global $_CMS,$_GP;
			$filephp=$_CMS['module'].'/class/mobile/'.strtolower(substr($f_name,3)).'.php';
			include_once  SYSTEM_ROOT.$filephp;
	}
}