<?php
/**
 * ALIPAY API: alipay.siteprobe.instore.user request
 *
 * @author auto create
 * @since 1.0, 2014-03-20 16:45:41
 */
class AlipaySiteprobeInstoreUserRequest
{
	/** 
	 * 合作商户的分店ID
	 **/
	private $merchantId;
	
	/** 
	 * 是否查询当天生日
	 **/
	private $needBirthday;
	
	/** 
	 * 分配给公众号的ID
	 **/
	private $publicId;
	
	/** 
	 * 支付宝用户的uesrid
	 **/
	private $userId;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setMerchantId($merchantId)
	{
		$this->merchantId = $merchantId;
		$this->apiParas["merchant_id"] = $merchantId;
	}

	public function getMerchantId()
	{
		return $this->merchantId;
	}

	public function setNeedBirthday($needBirthday)
	{
		$this->needBirthday = $needBirthday;
		$this->apiParas["need_birthday"] = $needBirthday;
	}

	public function getNeedBirthday()
	{
		return $this->needBirthday;
	}

	public function setPublicId($publicId)
	{
		$this->publicId = $publicId;
		$this->apiParas["public_id"] = $publicId;
	}

	public function getPublicId()
	{
		return $this->publicId;
	}

	public function setUserId($userId)
	{
		$this->userId = $userId;
		$this->apiParas["user_id"] = $userId;
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function getApiMethodName()
	{
		return "alipay.siteprobe.instore.user";
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
