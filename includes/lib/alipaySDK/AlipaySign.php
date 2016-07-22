<?php
class AlipaySign {
	public function rsa_sign($data, $rsaPrivateKeyFilePath) {
		$priKey = file_get_contents ( $rsaPrivateKeyFilePath );
		$res = openssl_get_privatekey ( $priKey );
		openssl_sign ( $data, $sign, $res );
		openssl_free_key ( $res );
		$sign = base64_encode ( $sign );
		return $sign;
	}
	public function sign_request($params, $rsaPrivateKeyFilePath) {
		return $this->rsa_sign ( $this->getSignContent ( $params ), $rsaPrivateKeyFilePath );
	}
	public function sign_response($bizContent, $charset, $rsaPrivateKeyFilePath) {
		$sign = $this->rsa_sign ( $bizContent, $rsaPrivateKeyFilePath );
		$response = "<?xml version=\"1.0\" encoding=\"$charset\"?><alipay><response>$bizContent</response><sign>$sign</sign><sign_type>RSA</sign_type></alipay>";
		return $response;
	}
	public function rsa_verify($data, $sign, $rsaPublicKeyFilePath) {
		// 读取公钥文件
		$pubKey = file_get_contents ( $rsaPublicKeyFilePath );
		
		// 转换为openssl格式密钥
		$res = openssl_get_publickey ( $pubKey );
		
		// 调用openssl内置方法验签，返回bool值
		$result = ( bool ) openssl_verify ( $data, base64_decode ( $sign ), $res );
		
		// 释放资源
		openssl_free_key ( $res );
		
		return $result;
	}
	public function rsaCheckV2($params, $rsaPublicKeyFilePath) {
		$sign = $params ['sign'];
		$params ['sign'] = null;
		
		return $this->rsa_verify ( $this->getSignContent ( $params ), $sign, $rsaPublicKeyFilePath );
	}
	protected function getSignContent($params) {
		ksort ( $params );
		
		$stringToBeSigned = "";
		$i = 0;
		foreach ( $params as $k => $v ) {
			if (false === $this->checkEmpty ( $v ) && "@" != substr ( $v, 0, 1 )) {
				if ($i == 0) {
					$stringToBeSigned .= "$k" . "=" . "$v";
				} else {
					$stringToBeSigned .= "&" . "$k" . "=" . "$v";
				}
				$i ++;
			}
		}
		unset ( $k, $v );
		return $stringToBeSigned;
	}
	
	/**
	 * 校验$value是否非空
	 * if not set ,return true;
	 * if is null , return true;
	 */
	protected function checkEmpty($value) {
		if (! isset ( $value ))
			return true;
		if ($value === null)
			return true;
		if (trim ( $value ) === "")
			return true;
		
		return false;
	}
	public function getPublicKeyStr($pub_pem_path) {
		$content = file_get_contents ( $pub_pem_path );
		$content = str_replace ( "-----BEGIN PUBLIC KEY-----", "", $content );
		$content = str_replace ( "-----END PUBLIC KEY-----", "", $content );
		$content = str_replace ( "\r", "", $content );
		$content = str_replace ( "\n", "", $content );
		return $content;
	}
}