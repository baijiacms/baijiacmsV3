<?php
/**
 * ALIPAY API: alipay.siteprobe.wifi.connect request
 *
 * @author auto create
 * @since 1.0, 2014-03-20 16:52:28
 */
class AlipaySiteprobeWifiConnectRequest
{
	/** 
	 * 是否已认证
	 **/
	private $auth;
	
	/** 
	 * wifi对应设备的编号
	 **/
	private $deviceId;
	
	/** 
	 * wifi设备的mac地址
	 **/
	private $deviceMac;
	
	/** 
	 * 合作商户的分店ID
	 **/
	private $merchantId;
	
	/** 
	 * 分配和合作方的id
	 **/
	private $partnerId;
	
	/** 
	 * 上网的令牌，和用户设备mac有一对一的关系
	 **/
	private $token;
	
	/** 
	 * 连接wifi的设备的mac地址
	 **/
	private $userMac;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setAuth($auth)
	{
		$this->auth = $auth;
		$this->apiParas["auth"] = $auth;
	}

	public function getAuth()
	{
		return $this->auth;
	}

	public function setDeviceId($deviceId)
	{
		$this->deviceId = $deviceId;
		$this->apiParas["device_id"] = $deviceId;
	}

	public function getDeviceId()
	{
		return $this->deviceId;
	}

	public function setDeviceMac($deviceMac)
	{
		$this->deviceMac = $deviceMac;
		$this->apiParas["device_mac"] = $deviceMac;
	}

	public function getDeviceMac()
	{
		return $this->deviceMac;
	}

	public function setMerchantId($merchantId)
	{
		$this->merchantId = $merchantId;
		$this->apiParas["merchant_id"] = $merchantId;
	}

	public function getMerchantId()
	{
		return $this->merchantId;
	}

	public function setPartnerId($partnerId)
	{
		$this->partnerId = $partnerId;
		$this->apiParas["partner_id"] = $partnerId;
	}

	public function getPartnerId()
	{
		return $this->partnerId;
	}

	public function setToken($token)
	{
		$this->token = $token;
		$this->apiParas["token"] = $token;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function setUserMac($userMac)
	{
		$this->userMac = $userMac;
		$this->apiParas["user_mac"] = $userMac;
	}

	public function getUserMac()
	{
		return $this->userMac;
	}

	public function getApiMethodName()
	{
		return "alipay.siteprobe.wifi.connect";
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
