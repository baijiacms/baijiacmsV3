<?php
/**
 * ALIPAY API: alipay.wap.user.alipayinside.authapi request
 *
 * @author auto create
 * @since 1.0, 2015-07-08 11:59:26
 */
class AlipayWapUserAlipayinsideAuthapiRequest
{
	/** 
	 * {client_id:'222122',realName='加密',certNo='3310231111111111'}，json直接加密。
	 **/
	private $contextParams;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setContextParams($contextParams)
	{
		$this->contextParams = $contextParams;
		$this->apiParas["context_params"] = $contextParams;
	}

	public function getContextParams()
	{
		return $this->contextParams;
	}

	public function getApiMethodName()
	{
		return "alipay.wap.user.alipayinside.authapi";
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
