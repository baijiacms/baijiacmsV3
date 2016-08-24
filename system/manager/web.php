<?php
defined('SYSTEM_IN') or exit('Access Denied');
class managerAddons  extends BjSystemModule {

	
			public function do_update()
	{
    $this->__managerweb(__FUNCTION__);
	}
			public function do_loginstore()
	{
    $this->__managerweb(__FUNCTION__);
	}
			public function do_database()
	{
    $this->__managerweb(__FUNCTION__);
	}

	

  public function do_picdelete() {
    $this->__managerweb(__FUNCTION__);
  }
  	public function setOrderCredit($openid,$id , $minus = true,$remark='') {
  	 			$order = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE id=:id",array(":id"=>$id));
  	 		
       		if(!empty($order['credit']))
       		{
            if ($minus) {
           
            	member_credit($openid,$order['credit'],'addcredit',$remark);
                
            } else {
               member_credit($openid,$order['credit'],'usecredit',$remark);
            }
          }
    }
    public function setOrderStock($id , $minus = true) {
    	updateOrderStock($id,$minus);
    }
	
	public function do_center()
	{
		$this->__managerweb(__FUNCTION__);
	}
		public function do_user()
	{
	$this->__managerweb(__FUNCTION__);
	}
	function do_changepwd()
	{
				$this->__managerweb(__FUNCTION__);
	}
		function checkVersion()
	{
		
		if(intval(CORE_VERSION)>intval(SYSTEM_VERSION))
		{
			message("发现最新版本，系统将进行更新！",create_url('site', array('name' => 'manager','do' => 'update','act'=>'toupdate')),"success");
		}
	}
 function checkAddons()
{
		$addons = dir(ADDONS_ROOT); 
		while($file = $addons->read())
		{
							if(($file!=".") AND ($file!="..")) 
								{
									
									
										if(is_file(ADDONS_ROOT.$file.'/key.php'))
										{
										 $addons_key=file_get_contents(ADDONS_ROOT.$file.'/key.php');
												if($file==$addons_key||md5($file)==$addons_key)
												{
													$item = mysqld_select("SELECT * FROM " . table('modules')." where `name`=:name", array(':name' => $file));
							       			if(empty($item['name']))
							       			{
							       					message("发现可用插件，系统将进行安装！",create_url('site', array('name' => 'manager','do' => 'addons_update')),"success");
							       			}else
							       			{
														 $addons_version=file_get_contents(ADDONS_ROOT.$file.'/version.php');
														if($addons_version>$item['version'])
														{
																message("发现插件更新，系统将进行更新！",create_url('site', array('name' => 'manager','do' => 'addons_update')),"success");
						
														}
							       			}
						      	 		}
						    	  }
						}
		}
}
		public function do_main()
	{
		$this->__managerweb(__FUNCTION__);
	}
	
		public function do_store_user()
	{
		$this->__managerweb(__FUNCTION__);
	}
	
		public function do_store()
	{
		$this->__managerweb(__FUNCTION__);
	}

			public function do_modules()
	{
	$this->__managerweb(__FUNCTION__);
	}
		function do_addons_update()
	{
	$this->__managerweb(__FUNCTION__);
	}
		function do_checkupdate()
	{
			$this->__managerweb(__FUNCTION__);
	}
		function do_netattach()
	{
			$this->__managerweb(__FUNCTION__);
	}
	function do_dev()
	{
			$this->__managerweb(__FUNCTION__);
	}

}


