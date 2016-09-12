<?php
defined('SYSTEM_IN') or exit('Access Denied');
define('subscribe_key', '系统_关注事件');
define('default_key', '系统_默认回复');
$_QMXK=array();
class weixinAddons  extends BjSystemModule {
	public function do_getopenid()
	{
		$weixinopenid=get_session_account(false);
		
	}
	
public function verifyorder($openid,$ordersn)
	{
			global $_CMS;
		if($_CMS['addons_bj_hx'])
				    {
				 $item = mysqld_select("SELECT * FROM " . table('shop_order') . " WHERE ordersn = :ordersn and beid=:beid	", array(':ordersn' => $ordersn,':beid'=>$_CMS['beid'] )); 	
	           	if (empty($item)) {
                return '抱歉，您的订单不存在或是已经被取消！';
            }
             
         $bj_hx_verify_saler = mysqld_select("SELECT * FROM " . table('bj_hx_verify_saler') . " WHERE openid = :openid and beid=:beid", array( ':openid' => $openid,':beid'=>$_CMS['beid'] )); 	
	       if(empty($bj_hx_verify_saler['verifyid']))
	       {
	       	   return '您不是核销员不能进行核销！';
	       }
          
            if($item['status']>0&&!empty($item['isverify']))
            {
            	 $shop_order_goods = mysqld_select("SELECT * FROM " . table('shop_order_goods') . " WHERE orderid = :orderid and beid=:beid", array(':orderid' => $item['id'] ,':beid'=>$_CMS['beid'])); 	
					     $bj_hx_verify_goods = mysqld_select("SELECT * FROM " . table('bj_hx_verify_goods') . " WHERE goodsid = :goodsid  and verifyid=:verifyid and beid=:beid", array(':goodsid' => $shop_order_goods['goodsid'],':verifyid' =>$bj_hx_verify_saler['verifyid'],':beid'=>$_CMS['beid'])); 	
					     if(!empty($bj_hx_verify_goods['goodsid']))
					     {
					     	
					    	return '<a href="'.WEBSITE_ROOT.create_url('mobile',array('name' => 'bj_hx','do' => 'verifycheck','ordersn' => $ordersn)).'">点击进入订单核销页面</a>';
					   }else
					     {
					     	
					     	return "未适用门店无法进行产品核销";	
					     }
            }else
            {
            	return '订单状态不符无法进行线下核销！';
            }
            
 	return '订单状态不符无法进行线下核销！';
			
		}
		return '';
		
	}
	public function do_process()
	{
		global $_GP,$_CMS;
		$settings=globaSetting();
	$configdata = $settings['weixintoken'];
	$token=$configdata;
    if(!$this->checkSign($token))
      	{
     	exit('Access Denied2');
      	}
      	
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'get') {
			ob_clean();
			ob_start();
			exit($_GET['echostr']);
		}
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		$message=$this->requestParse($postStr);
		if (empty($message)) {
				exit('Request Failed');
			}
			if($message['type']=='text'||$message['type']=='CLICK')
			{
				
				$key=$message['content'];
				
				if($message['type']=='CLICK')
				{
					
									$key=$message['eventkey'];
				}
				
				if(!empty($key))
				{
				$reply = mysqld_select('SELECT * FROM '.table('weixin_rule')."   WHERE  keywords = :keywords and beid=:beid  limit 1" , array(':keywords' =>$key,':beid'=>$_CMS['beid']));
				}
			
		
					
		
				
			}
					
					
					
				if($message['type']=='subscribe')
			{
					$reply = mysqld_select('SELECT * FROM '.table('weixin_rule')."   WHERE  keywords = :keywords and beid=:beid  limit 1" , array(':keywords' =>subscribe_key,':beid'=>$_CMS['beid']));
				
					if(	!empty($message['eventkey'])&&strlen($message['eventkey'])> 8)
					{
						$eventkey=	substr($message['eventkey'],8);
					}else
					{
							$eventkey=	$message['eventkey'];
					}
			
					
				$weixin_wxfans = mysqld_select('SELECT * FROM '.table('weixin_wxfans')."   WHERE  weixin_openid = :weixin_openid and beid=:beid limit 1" , array(':weixin_openid' =>$message['from'],':beid'=>$_CMS['beid']));
				if(empty($weixin_wxfans['weixin_openid'])&&!empty($message['from']))
				{
					$userinfo=get_weixin_follow_userinfo($message['from']);
				
					if(!empty($userinfo))
					{
						 $gender=$userinfo["sex"];
						$nickname=$userinfo["nickname"];
						$nickname=filter_weixinname_emoji($nickname);
						$row = array(
						'nickname'=> $nickname,
						'follow' => 1,
						'gender' => intval($gender),
						'weixin_openid' =>  $message['from'],
						'avatar'=>'',
						'beid'=>$_CMS['beid'],
						'createtime' => TIMESTAMP
					);
						mysqld_insert('weixin_wxfans', $row);	
						if(!empty($userinfo["headimgurl"])){
					mysqld_update('weixin_wxfans', array('avatar'=>$userinfo["headimgurl"]), array('weixin_openid' => $message['from'],'beid'=>$_CMS['beid']));	
						}
					//	if(!empty($nickname))
					//	{
						//	$newopenid=member_create_new_sample($nickname);
						//	mysqld_update('weixin_wxfans',array('openid'=>$newopenid),array('weixin_openid'=>$message['from'],'beid'=>$_CMS['beid']));	
					//	}
						
						
					}
					
				}else
				{
						mysqld_update('weixin_wxfans',array('follow'=>1),array('weixin_openid'=>$message['from'],'beid'=>$_CMS['beid']));	
			
					$userinfo=get_weixin_follow_userinfo($message['from']);
				if(!empty($userinfo))
					{
							 $gender=$userinfo["sex"];
						$nickname=$userinfo["nickname"];
							$nickname=filter_weixinname_emoji($nickname);
						mysqld_update('weixin_wxfans', array('nickname'=> $nickname,	'gender' => intval($gender)), array('weixin_openid' => $message['from'],'beid'=>$_CMS['beid']));	
					
							if(!empty($userinfo["headimgurl"])){
					mysqld_update('weixin_wxfans', array('avatar'=>$userinfo["headimgurl"]), array('weixin_openid' => $message['from'],'beid'=>$_CMS['beid']));	
						}
					}
					
					
				}
				
				
					
					
					
								$newaccount=false;
					if(!empty($message['from']))
					{
						$weixin_wxfans = mysqld_select('SELECT nickname,openid,weixin_openid FROM '.table('weixin_wxfans')."   WHERE  weixin_openid = :weixin_openid and beid=:beid limit 1" , array(':weixin_openid' =>$message['from'],':beid'=>$_CMS['beid']));
				if(!empty($weixin_wxfans['weixin_openid']))
				{
					if(empty($weixin_wxfans['openid']))
					{
					$newopenid=member_create_new("","",$weixin_wxfans['nickname']);
									
						mysqld_update('weixin_wxfans',array('openid'=>$newopenid),array('weixin_openid'=>$weixin_wxfans['weixin_openid'],'beid'=>$_CMS['beid']));	
				
							$newaccount=true;
					}else
					{
						
					}
				}
				
			}
					
			
				
			}
	

			
			if($message['type']=='LOCATION')
			{
				$longitude=$message['longitude'];
				$latitude=$message['latitude'];
				$precision=$message['precision'];
					mysqld_update('weixin_wxfans',array('longitude'=>$longitude,'latitude'=>$latitude,'precision'=>$precision),array('weixin_openid'=>$message['from'],'beid'=>$_CMS['beid']));
		  	//	weixin_send_custom_message($message['from'],"您所在的经度：".$longitude.",维度".$latitude);
				exit('');
			}
				if($message['type']=='unsubscribe')
			{
							mysqld_update('weixin_wxfans',array('follow'=>0),array('weixin_openid'=>$message['from'],'beid'=>$_CMS['beid']));
				exit('');
			}
			if(empty($reply['id']))
			{
					$reply = mysqld_select('SELECT * FROM '.table('weixin_rule')."   WHERE  keywords = :keywords and beid=:beid limit 1" , array(':keywords' =>default_key,':beid'=>$_CMS['beid']));
			}
				if($reply['ruletype']==1)
				{
						$reply['content'] = htmlspecialchars_decode($reply['description']);
		$reply['content'] = str_replace(array('<br>', '&nbsp;'), array("\n", ' '), $reply['content']);
		$reply['content'] = strip_tags($reply['content'], '<a>');
		return $this->respText($reply['content'],$message);
					
				}
				if($reply['ruletype']==2)
				{
					
						$news = array();
			$news = array(
				'title' => $reply['title'],
				'description' => $reply['description'],
				'picurl' => $reply['thumb'],
				'url' =>  $reply['url'],
			);	
			return $this->respNews($news,$message);
					
				}

				
			return $this->respService($message);
		
		}
		
	}
			private function respService($message) {
		$response = array();
		$response['FromUserName'] = $message['to'];
		$response['ToUserName'] = $message['from'];
		$response['MsgType'] = 'transfer_customer_service';
		return $this->response($response);
	}
	
	
	   public function sendcustomIMG($from_user,$msg) {
    	$access_token=get_weixin_token();
    	 $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$access_token}";
 
  $post='{"touser":"'.$from_user.'","msgtype":"image","image":{"media_id":"'.$msg.'"}}';

    http_post($url,$post);
    	
  }
	
		private function respImage($mid,$message) {
		if (empty($mid)) {
			return $this->respText('media_id为空错误', $message);
		}
		$response = array();
		$response['FromUserName'] = $message['to'];
		$response['ToUserName'] = $message['from'];
		$response['MsgType'] = 'image';
		$response['Image']['MediaId'] = $mid;
		return $this->response($response);
	}
		private function respText($content,$message) {
		$content = str_replace("\r\n", "\n", $content);
		$response = array();
		$response['FromUserName'] = $message['to'];
		$response['ToUserName'] = $message['from'];
		$response['MsgType'] = 'text';
		$response['Content'] = htmlspecialchars_decode($content);
		return $this->response($response);
	}
	
		private function respNews($row,$message) {
		if (empty($row)) {
			return exit( 'Invaild value');
		}
		$response = array();
		$response['FromUserName'] = $message['to'];
		$response['ToUserName'] = $message['from'];
		$response['MsgType'] = 'news';
		$response['ArticleCount'] = 1;
		$response['Articles'] = array();
			$response['Articles'][] = array(
				'Title' => $row['title'],
				'Description' => $row['description'],
				'PicUrl' => ATTACHMENT_WEBROOT.$row['picurl'],
				'Url' => $row['url'],
				'TagName' => 'item',
			);
		return $this->response($response);
	}

	private function response($packet) {
	
		if (!is_array($packet)) {
			return $packet;
		}
		if(empty($packet['CreateTime'])) {
			$packet['CreateTime'] = time();
		}
		if(empty($packet['MsgType'])) {
			$packet['MsgType'] = 'text';
		}
		if(empty($packet['FuncFlag'])) {
			$packet['FuncFlag'] = 0;
		} else {
			$packet['FuncFlag'] = 1;
		}
		return $this->array2xml($packet);
	}
		private function array2xml($arr, $level = 1, $ptagname = '') {
		$s = $level == 1 ? "<xml>" : '';
		foreach($arr as $tagname => $value) {
			if (is_numeric($tagname)) {
				$tagname = $value['TagName'];
				unset($value['TagName']);
			}
			if(!is_array($value)) {
				$s .= "<{$tagname}>".(!is_numeric($value) ? '<![CDATA[' : '').$value.(!is_numeric($value) ? ']]>' : '')."</{$tagname}>";
			} else {
				$s .= "<{$tagname}>".self::array2xml($value, $level + 1)."</{$tagname}>";
			}
		}
		$s = preg_replace("/([\x01-\x08\x0b-\x0c\x0e-\x1f])+/", ' ', $s);
		return $level == 1 ? $s."</xml>" : $s;
	}
	private function requestParse($message) {
		$packet = array();
		if (!empty($message)){
			$obj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
			if($obj instanceof SimpleXMLElement) {
				$obj = json_decode(json_encode($obj),true);
				
				$packet['from'] = strval($obj['FromUserName']);
				$packet['to'] = strval($obj['ToUserName']);
				$packet['time'] = strval($obj['CreateTime']);
				$packet['type'] = strval($obj['MsgType']);
				$packet['event'] = strval($obj['Event']);
				$packet['eventkey'] = strval($obj['EventKey']);
				foreach ($obj as $variable => $property) {
					if (is_array($property)) {
						$property = array_change_key_case($property);
					}
					$packet[strtolower($variable)] = $property;
				}
				if($packet['type'] == 'event') {
					$packet['type'] = $packet['event'];
				}
			}
		}
		return $packet;
	}
	private function checkSign($token) {
		global $_GP;
	 $signature = $_GET["signature"];
   $timestamp = $_GET["timestamp"];
   $nonce = $_GET["nonce"];
        		
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	

	
}


