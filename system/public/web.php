<?php
defined('SYSTEM_IN') or exit('Access Denied');

class publicAddons  extends BjSystemModule {


	public function do_index()
	{
		$this->__web(__FUNCTION__);
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

}


