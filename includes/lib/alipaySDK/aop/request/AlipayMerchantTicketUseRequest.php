<?php
/**
 * ALIPAY API: alipay.merchant.ticket.use request
 *
 * @author auto create
 * @since 1.0, 2015-03-19 16:09:39
 */
class AlipayMerchantTicketUseRequest
{
	/** 
	 * 业务请求的标识信息
	 **/
	private $bizInfo;
	
	/** 
	 * 红包发放者商户信息，json格式。商户可以传自己的PID，平台商可以传其它商户的PID用于查询指定商户的信息
目前仅支持如下key：
unique：商户唯一标识
unique_type：支持以下1种取值。
  PID：商户所在平台商的partner id[唯一]
	 **/
	private $merchantInfo;
	
	/** 
	 * 商户券的券码，用于标识一张券
	 **/
	private $ticketCode;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	private $apiVersion="1.0";
	private $notifyUrl;

	
	public function setBizInfo($bizInfo)
	{
		$this->bizInfo = $bizInfo;
		$this->apiParas["biz_info"] = $bizInfo;
	}

	public function getBizInfo()
	{
		return $this->bizInfo;
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

	public function setTicketCode($ticketCode)
	{
		$this->ticketCode = $ticketCode;
		$this->apiParas["ticket_code"] = $ticketCode;
	}

	public function getTicketCode()
	{
		return $this->ticketCode;
	}

	public function getApiMethodName()
	{
		return "alipay.merchant.ticket.use";
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
