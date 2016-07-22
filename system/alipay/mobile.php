<?php
defined('SYSTEM_IN') or exit('Access Denied');
define('subscribe_key', '系统_关注事件');
define('default_key', '系统_默认回复');
require_once WEB_ROOT.'/includes/lib/alipaySDK/config.php';
require_once WEB_ROOT.'/includes/lib/alipaySDK/AlipaySign.php';
require_once WEB_ROOT.'/includes/lib/alipaySDK/PushMsg.php';

class alipayAddons  extends BjSystemModule {

	public function do_process()
	{
		global $_CMS,$_GP;
		$settings=globaSetting();	
		
		
$sign = $_REQUEST["sign"];
$sign_type = $_REQUEST["sign_type"];
$biz_content =stripslashes($_REQUEST[ "biz_content" ]);
$service = $_REQUEST["service"];
$charset = $_REQUEST["charset"];


	

if (empty($sign)||empty($sign_type)||empty($biz_content)||empty($service)||empty($charset)){
	echo "some parameter is empty.";
	exit();
}

		$as = new AlipaySign ();
		
$sign_verify= $as->rsaCheckV2 ( 	$_REQUEST, $_GP['alipay_config'] ['alipay_public_key_file']);
if (!$sign_verify){
	
		if ($service=="alipay.service.check"){


		$EventType = $this->getNode2 ( $biz_content, "EventType" );
		
		
		if ($EventType == "verifygw") {
			$as = new AlipaySign ();
			$response_xml = "<success>true</success><biz_content>" . $as->getPublicKeyStr($_GP['alipay_config'] ['merchant_public_key_file']) . "</biz_content>";
			$return_xml = $as->sign_response ( $response_xml, $_GP['alipay_config'] ['charset'], $_GP['alipay_config'] ['merchant_private_key_file'] );
			
			echo $return_xml;
			exit ;
		}
	}else
	{
		
		echo "sign verfiy fail.";
		exit;
	}
}
	if ($service=="alipay.service.check"){
		


		$EventType = $this->getNode2 ( $biz_content, "EventType" );
		
		if ($EventType == "verifygw") {
			$as = new AlipaySign ();
			$response_xml = "<success>true</success><biz_content>" . $as->getPublicKeyStr($_GP['alipay_config'] ['merchant_public_key_file']) . "</biz_content>";
			$return_xml = $as->sign_response ( $response_xml, 'GBK', $_GP['alipay_config'] ['merchant_private_key_file'] );
		
					file_put_contents ( WEB_ROOT . "/cache/1.log",$return_xml , FILE_APPEND );
			echo $return_xml;
			exit;
		}
	}
	
	
	if ($service=="alipay.mobile.public.message.notify"){
		$UserInfo = $this->getNode ( $biz_content, "UserInfo" );
		$FromUserId = $this->getNode ( $biz_content, "FromUserId" );
		$AppId = $this->getNode ( $biz_content, "AppId" );
		$CreateTime = $this->getNode ( $biz_content, "CreateTime" );
		$MsgType = $this->getNode ( $biz_content, "MsgType" );
		$EventType = $this->getNode ( $biz_content, "EventType" );
		$AgreementId = $this->getNode ( $biz_content, "AgreementId" );
		$ActionParam = $this->getNode ( $biz_content, "ActionParam" );
		$AccountNo = $this->getNode ( $biz_content, "AccountNo" );

			$text =  $this->getNode ( $biz_content, "Text" ); 
			$push = new PushMsg ();
		if ($MsgType == "text"||$MsgType == "text"||$EventType=='click') {
				
				$key=$text;
				
				if($EventType=='click')
				{
					
									$key=$ActionParam;
				}
				
				if(!empty($key))
				{
				$reply = mysqld_select('SELECT * FROM '.table('alipay_rule')."   WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>$key,':beid'=>$_CMS['beid']));
				}
				
				
				
			}
				if($EventType=='follow')
			{
					$reply = mysqld_select('SELECT * FROM '.table('alipay_rule')."   WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>subscribe_key,':beid'=>$_CMS['beid']));
			}
			if(empty($reply['id']))
			{
					$reply = mysqld_select('SELECT * FROM '.table('alipay_rule')."   WHERE  keywords = :keywords and beid=:beid" , array(':keywords' =>default_key,':beid'=>$_CMS['beid']));
			}
			
				if($reply['ruletype']==1)
				{
						$reply['content'] = htmlspecialchars_decode($reply['description']);
		$reply['content'] = str_replace(array('<br>', '&nbsp;'), array("\n", ' '), $reply['content']);
		$reply['content'] = strip_tags($reply['content'], '<a>');
		
		
			$text_msg = $push->mkTextMsg ( $reply['content']);
			$biz_content = $push->mkTextBizContent ( $FromUserId,$text_msg);
		
	
			$return_msg = $push->sendRequest ( $biz_content );
						
			//		file_put_contents ( WEB_ROOT . "/cache/2.log",$biz_content.'|'.$return_msg  , FILE_APPEND );
				}
				if($reply['ruletype']==2)
				{
								
					$reply['content'] = htmlspecialchars_decode($reply['description']);
		$reply['content'] = str_replace(array('<br>', '&nbsp;'), array("\n", ' '), $reply['content']);
		$reply['content'] = strip_tags($reply['content'], '<a>');
	$image_text_msg1 =$push->mkImageTextMsg ( $reply['title'], $reply['content'], $reply['url'],ATTACHMENT_WEBROOT.$reply['thumb'], "loginAuth" );
		$image_text_msg = array (
					$image_text_msg1
			);  
			
		
		$biz_content = $push->mkImageTextBizContent ( $FromUserId, $image_text_msg );
			$return_msg = $push->sendRequest ( $biz_content );
			
				//	file_put_contents ( WEB_ROOT . "/cache/1.log",$biz_content , FILE_APPEND );
				}
		
		
		echo  $this->mkAckMsg ($FromUserId );
		exit;
		
	//	file_put_contents ( WEB_ROOT . "/cache/1.log",$x , FILE_APPEND );
	}
	}
	
		public function mkAckMsg($toUserId) {
		global $_GP;
		$as = new AlipaySign ();
		$response_xml = "<XML><ToUserId><![CDATA[" . $toUserId . "]]></ToUserId><AppId><![CDATA[" . $_GP['alipay_config']['app_id'] . "]]></AppId><CreateTime>" . time () . "</CreateTime><MsgType><![CDATA[ack]]></MsgType></XML>";
		
		$return_xml = $as->sign_response ( $response_xml, $_GP['alipay_config']['charset'], $_GP['alipay_config']['merchant_private_key_file'] );

		return $return_xml;
	}
	
		public function getNode($xml, $node) {
		$xml = "<?xml version=\"1.0\" encoding=\"GBK\"?>" . $xml;
		$dom = new DOMDocument ( "1.0", "GBK" );
		$dom->loadXML ( $xml );
		$event_type = $dom->getElementsByTagName ( $node );
		return $event_type->item ( 0 )->nodeValue;
	}
		public function getNode2($xml, $node) {
		$dom = new DOMDocument ( "1.0", "GBK" );
		$dom->loadXML ( $xml );
		$event_type = $dom->getElementsByTagName ( $node );
		return $event_type->item ( 0 )->nodeValue;
	}
}


