<?php
defined('SYSTEM_IN') or exit('Access Denied');
class modulesAddons  extends BjSystemModule {
		public function do_manager_shop_dispatch()
	{
		$this->__managerweb(__FUNCTION__);
	}
	function do_thirdlogin_config()
	{
					$this->__web(__FUNCTION__);
	}
	function do_thirdlogin_uninstall()
	{
				$this->__web(__FUNCTION__);
	}
	function do_thirdlogin_install()
	{
		$this->__web(__FUNCTION__);
	}
	function do_thirdlogin()
	{
		$this->__web(__FUNCTION__);
	}

		function do_dispatch()
	{
		$this->__web(__FUNCTION__);
	}
		function do_dispatch_install()
	{
				$this->__web(__FUNCTION__);
	}
		function do_dispatch_uninstall()
	{
				$this->__web(__FUNCTION__);
	}
	
	
			function do_manager_dispatch()
	{
		$this->__managerweb(__FUNCTION__);
	}
		function do_manager_dispatch_install()
	{
				$this->__managerweb(__FUNCTION__);
	}
		function do_manager_dispatch_uninstall()
	{
				$this->__managerweb(__FUNCTION__);
	}
	function do_payment_config()
	{
				$this->__web(__FUNCTION__);
	}
	function do_payment_uninstall()
	{
		$this->__web(__FUNCTION__);
	}
	function do_payment_install()
	{
			$this->__web(__FUNCTION__);
	}
	function do_payment()
	{
		$this->__web(__FUNCTION__);
	}
}


