<?php
/**
 * ALIPAY API: alipay.user.test request
 *
 * @author auto create
 * @since 1.0, 2014-10-09 11:22:36
 */
class AlipayUserTestRequest
{
	/** 
	 * 顶顶顶
	 **/
	private $userinfo;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setUserinfo($userinfo)
	{
		$this->userinfo = $userinfo;
		$this->apiParas["userinfo"] = $userinfo;
	}

	public function getUserinfo()
	{
		return $this->userinfo;
	}

	public function getApiMethodName()
	{
		return "alipay.user.test";
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
