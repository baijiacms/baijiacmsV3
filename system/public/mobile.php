<?php
defined('SYSTEM_IN') or exit('Access Denied');
class publicAddons  extends BjSystemModule {

		function do_install()
	{		
			global $_CMS,$_GP;
			$filephp=$_CMS['module'].'/class/mobile/install.php';
			include_once  SYSTEM_ROOT.$filephp;
	}
		public function do_verify()
	{
		$this->__mobile2(__FUNCTION__);
	}
	public function do_index()
	{
		
	$this->__mobile2(__FUNCTION__);	
	}
	public function do_logout()
	{
		$this->__mobile2(__FUNCTION__);
	}
		public function do_login()
	{
			$this->__mobile2(__FUNCTION__);
	}
	
	public function check_verify($verify)
	{
		
		if(strtolower($_SESSION["VerifyCode"])==strtolower($verify))
		{
			unset($_SESSION["VerifyCode"]);
			return true;
		}
		return false;
	}
}


