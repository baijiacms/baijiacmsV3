<?php
/**
 * ALIPAY API: alipay.member.coupon.querydetail request
 *
 * @author auto create
 * @since 1.0, 2014-11-19 15:53:06
 */
class AlipayMemberCouponQuerydetailRequest
{
	/** 
	 * 红包编号
	 **/
	private $couponNo;
	
	/** 
	 * 红包发放者商户信息，json格式。商户可以传自己的PID，平台商可以传其它商户的PID用于查询指定商户的信息
目前仅支持如下key：
	unique：商户唯一标识
	unique_type：支持以下1种取值。
PID：商户所在平台商的partner id[唯一]
	 **/
	private $merchantInfo;
	
	/** 
	 * 劵所有者买家用户信息，必须是支付宝的用户，json格式。
目前仅支持如下key：
	unique：用户唯一标识
	unique_type：支持以下1种取值。
UID：用户支付宝账户的唯一ID
OPENID：用户支付宝账户在某商户下的唯一ID
	 **/
	private $userInfo;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setCouponNo($couponNo)
	{
		$this->couponNo = $couponNo;
		$this->apiParas["coupon_no"] = $couponNo;
	}

	public function getCouponNo()
	{
		return $this->couponNo;
	}

	public function setMerchantInfo($merchantInfo)
	{
		$this->merchantInfo = $merchantInfo;
		$this->apiParas["merchant_info"] = $merchantInfo;
	}

	public function getMerchantInfo()
	{
		return $this->merchantInfo;
	}

	public function setUserInfo($userInfo)
	{
		$this->userInfo = $userInfo;
		$this->apiParas["user_info"] = $userInfo;
	}

	public function getUserInfo()
	{
		return $this->userInfo;
	}

	public function getApiMethodName()
	{
		return "alipay.member.coupon.querydetail";
	}

	public function setNotifyUrl($notifyUrl)
	{
		$this->notifyUrl=$notifyUrl;
	}

	public function getNotifyUrl()
	{
		return $this->notifyUrl;
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function getTerminalType()
	{
		return $this->terminalType;
	}

	public function setTerminalType($terminalType)
	{
		$this->terminalType = $terminalType;
	}

	public function getTerminalInfo()
	{
		return $this->terminalInfo;
	}

	public function setTerminalInfo($terminalInfo)
	{
		$this->terminalInfo = $terminalInfo;
	}

	public function getProdCode()
	{
		return $this->prodCode;
	}

	public function setProdCode($prodCode)
	{
		$this->prodCode = $prodCode;
	}

	public function setApiVersion($apiVersion)
	{
		$this->apiVersion=$apiVersion;
	}

	public function getApiVersion()
	{
		return $this->apiVersion;
	}

}
