<?php
defined('SYSTEM_IN') or exit('Access Denied');
class modulesAddons  extends BjSystemModule {
			public function do_gold_bridgepay()
	{
				global $_CMS,$_GP;
					include_once("plugin/payment/weixin/gold_bridgepay.php");
					exit;		
	}
		public function do_bridgepay()
	{
				global $_CMS,$_GP;
					include_once("plugin/payment/weixin/bridgepay.php");
					exit;		
	}
	public function do_unionpay_front_url()
	{		
			   		global $_GP;
			   		if(!empty($_GP['tfans']))
			   		{
			   			   	message('支付成功！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex')),'success');
			   		}else
			   		{
			   	message('支付成功！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'myorder','status'=>1)),'success');
			  }
	}
		public function do_unionpay_return_url()
	{		
		global $_CMS;
					include_once("plugin/payment/unionpay/unionpay_return_url.php");
					exit;
	}
	public function do_weixin_notify()
	{		
		global $_CMS;
					include_once("plugin/payment/weixin/notify_url.php");
					exit;
	}
		public function do_weixin_native_notify()
	{		
		global $_CMS;
					include_once("plugin/payment/weixin/weixin_native_notify.php");
					exit;
	}
		public function do_alipay_notify()
	{		
		global $_CMS;
					include_once("plugin/payment/alipay/alipay_notify.php");
					exit;
	}
		public function do_alipay_return_url()
	{		
		global $_CMS;
					include_once("plugin/payment/alipay/alipay_return_url.php");
					exit;
	}
		public function do_color_notify()
	{		
		global $_CMS;
					include_once("plugin/payment/color/notify_url.php");
					exit;
	}
}


