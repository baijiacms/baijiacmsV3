<?php
defined('SYSTEM_IN') or exit('Access Denied');
class shopAddons  extends BjSystemModule {
	public function do_diyshop_uploadpic()
	{
		$this->__web(__FUNCTION__);
	}
		public function do_diyshop_searchgoods()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_diyshop()
	{
				$this->__web(__FUNCTION__);
	}
		public function do_goodsorder()
	{
		$this->__web(__FUNCTION__);
	}
		public function do_sms()
	{
    $this->__web(__FUNCTION__);
	}
		public function do_noticemail()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_adv()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_thirdlogin()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_zhifu()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_dispatch()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_config()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_orderbat()
	{	
		$this->__web(__FUNCTION__);
	}
	public function do_order()
	{
    $this->__web(__FUNCTION__);
	}
	public function do_goods()
	{
		$this->__web(__FUNCTION__);
	}
		public function do_goods_comment()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_upload()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_category()
	{
		$this->__web(__FUNCTION__);
	}
	public function do_spec() {
		$this->__web(__FUNCTION__);
 	}
  public function do_picdelete() {
    $this->__web(__FUNCTION__);
  }
  public function do_specitem() {
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
    public function setOrderStock($id , $minus = true) {
    	updateOrderStock($id,$minus);
    }
       	public function getPaytypebycode($code)
	{
				$paytype=2;
   			if($code=='delivery')
   			{
   					$paytype=3;
   			}
   				if($code=='gold')
   			{
   					$paytype=1;
   			}
   			return $paytype;
	}
}


