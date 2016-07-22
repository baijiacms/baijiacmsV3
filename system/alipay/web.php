<?php
defined('SYSTEM_IN') or exit('Access Denied');
define('subscribe_key', '系统_关注事件');
define('default_key', '系统_默认回复');
class alipayAddons  extends BjSystemModule {

		public function do_rule()
	{
		$this->__web(__FUNCTION__);
	}
	
	public function do_menumodify() {
		$this->__web(__FUNCTION__);
	}
	
	public function do_designer()
	{
		$this->__web(__FUNCTION__);
	}
	
	public function do_remove()
	{
		$this->__web(__FUNCTION__);
	}
	
	public function do_refresh()
	{
		message('', 'refresh');
	}
	
	public function do_setting()
	{
		$this->__web(__FUNCTION__);
	}
	
	public function do_guanzhu()
	{
		$this->__web(__FUNCTION__);
	}
	
	
	
	
	
	private function error_code($code) {
		$errors = array(
			'-1' => '系统繁忙',
			'0' => '请求成功',
			'40001' => '获取access_token时AppSecret错误，或者access_token无效',
			'40002' => '不合法的凭证类型',
			'40003' => '不合法的OpenID',
			'40004' => '不合法的媒体文件类型',
			'40005' => '不合法的文件类型',
			'40006' => '不合法的文件大小',
			'40007' => '不合法的媒体文件id',
			'40008' => '不合法的消息类型',
			'40009' => '不合法的图片文件大小',
			'40010' => '不合法的语音文件大小',
			'40011' => '不合法的视频文件大小',
			'40012' => '不合法的缩略图文件大小',
			'40013' => '不合法的APPID',
			'40014' => '不合法的access_token',
			'40015' => '不合法的菜单类型',
			'40016' => '不合法的按钮个数',
			'40017' => '不合法的按钮个数',
			'40018' => '不合法的按钮名字长度',
			'40019' => '不合法的按钮KEY长度',
			'40020' => '不合法的按钮URL长度',
			'40021' => '不合法的菜单版本号',
			'40022' => '不合法的子菜单级数',
			'40023' => '不合法的子菜单按钮个数',
			'40024' => '不合法的子菜单按钮类型',
			'40025' => '不合法的子菜单按钮名字长度',
			'40026' => '不合法的子菜单按钮KEY长度',
			'40027' => '不合法的子菜单按钮URL长度',
			'40028' => '不合法的自定义菜单使用用户',
			'40029' => '不合法的oauth_code',
			'40030' => '不合法的refresh_token',
			'40031' => '不合法的openid列表',
			'40032' => '不合法的openid列表长度',
			'40033' => '不合法的请求字符，不能包含\uxxxx格式的字符',
			'40035' => '不合法的参数',
			'40038' => '不合法的请求格式',
			'40039' => '不合法的URL长度',
			'40050' => '不合法的分组id',
			'40051' => '分组名字不合法',
			'41001' => '缺少access_token参数',
			'41002' => '缺少appid参数',
			'41003' => '缺少refresh_token参数',
			'41004' => '缺少secret参数',
			'41005' => '缺少多媒体文件数据',
			'41006' => '缺少medSYSTEM_id参数',
			'41007' => '缺少子菜单数据',
			'41008' => '缺少oauth code',
			'41009' => '缺少openid',
			'42001' => 'access_token超时',
			'42002' => 'refresh_token超时',
			'42003' => 'oauth_code超时',
			'43001' => '需要GET请求',
			'43002' => '需要POST请求',
			'43003' => '需要HTTPS请求',
			'43004' => '需要接收者关注',
			'43005' => '需要好友关系',
			'44001' => '多媒体文件为空',
			'44002' => 'POST的数据包为空',
			'44003' => '图文消息内容为空',
			'44004' => '文本消息内容为空',
			'45001' => '多媒体文件大小超过限制',
			'45002' => '消息内容超过限制',
			'45003' => '标题字段超过限制',
			'45004' => '描述字段超过限制',
			'45005' => '链接字段超过限制',
			'45006' => '图片链接字段超过限制',
			'45007' => '语音播放时间超过限制',
			'45008' => '图文消息超过限制',
			'45009' => '接口调用超过限制',
			'45010' => '创建菜单个数超过限制',
			'45015' => '回复时间超过限制',
			'45016' => '系统分组，不允许修改',
			'45017' => '分组名字过长',
			'45018' => '分组数量超过上限',
			'46001' => '不存在媒体数据',
			'46002' => '不存在的菜单版本',
			'46003' => '不存在的菜单数据',
			'46004' => '不存在的用户',
			'47001' => '解析JSON/XML内容错误',
			'48001' => 'api功能未授权',
			'50001' => '用户未授权该api',
		);
		$code = strval($code);
	if($code == '40001') {
					$rec = array();
					$rec['access_token'] = '';
         refreshSetting($rec);
			
			return '微信公众平台授权异常, 系统已修复这个错误, 请刷新页面重试.';
		}
		if($errors[$code]) {
			return $errors[$code];
		} else {
			return '未知错误';
		}
	}
	
	


	private function menuResponseParse($content,$method='get') {
		$datas = @json_decode(mb_convert_encoding($content,"UTF-8","GBK"),true);
		if(!is_array($datas)) {
			return error(-1, '接口调用失败，请重试！' . (is_string($content) ? "支付宝公众平台返回元数据: {$content}" : ''));
		}

		$dat=$datas["alipay_mobile_public_menu_{$method}_response"];
		if(is_array($dat) && $dat['code'] == '200') {
			return true;
		} else {
			if(is_array($dat)) {
				return error(-1, "支付宝公众平台返回接口错误. \n错误代码为: {$dat['code']} \n错误信息为: {$dat['msg']}");
			} else {
				return error(-1, '微信公众平台未知错误');
			}
		}
		return true;
	}
	
	private function menuBuildMenuSet($menu) {
		$set = array();
		$set['button'] = array();
		
				if($menu==']')
		{
			return $this->menuDelete();
		}
		$menu = htmlspecialchars_decode($menu);
		//message($menu );
		$menu=str_replace("\\\"","\"",$menu);
		$menu = json_decode($menu, true);
				if(empty($menu)) {
		message('自定义菜单结构错误！:<br/><textarea style="width:300px;height:100px">'.$mDat.'</textarea>');
	}
			$set = array();
		$set['button'] = array();
				foreach($menu as &$m) {
				$entry = array();
			//$m['name'] = preg_replace_callback('/\:\:([0-9a-zA-Z_-]+)\:\:/', create_function('$matches', 'return utf8_bytes(hexdec($matches[1]));'), $m['name']);
			
			//$entry['name'] = urlencode($m['name']);
			
				$m['name'] = urlencode(mb_convert_encoding($m['name'],"GBK","UTF-8"));
					$entry['name'] = $m['name'];
			if(isset($m['url']) && !empty($m['url'])){
				$m['url'] = $this->smartUrlEncode($m['url']);
			}
				if($m['actionType'] == 'view') {
					$entry['actionParam'] = urlencode(mb_convert_encoding($m['url'],"GBK","UTF-8"));
				} else {
					$entry['actionParam'] =  urlencode(mb_convert_encoding($m['key'],"GBK","UTF-8"));
				}
					$entry['actionType'] = $m['type'] == 'view' ? 'link' : 'out';
			
			
			if(is_array($m['sub_button'])) {
				$entry['subButton'] = array();
				foreach($m['sub_button'] as &$s) {
					$e = array();
				//	$s['name'] = preg_replace_callback('/\:\:([0-9a-zA-Z_-]+)\:\:/', create_function('$matches', 'return utf8_bytes(hexdec($matches[1]));'), $s['name']);
				//	$s['name'] = urlencode($s['name']);
				$s['name'] = urlencode(mb_convert_encoding($s['name'],"GBK","UTF-8"));
					$e['name'] = $s['name'];
					if(!empty($s['url'])){
						$s['url'] = $this->smartUrlEncode($s['url']);
					}
					if($s['type'] == 'view') {
						$e['actionParam'] = urlencode(mb_convert_encoding($s['url'],"GBK","UTF-8"));
					} else {
						$e['actionParam'] =  urlencode(mb_convert_encoding($s['key'],"GBK","UTF-8"));
					}
					$e['actionType'] = $s['type'] == 'view' ? 'link' : 'out';
					$entry['subButton'][] = $e;
				}
			}
					$set['button'][] = $entry;
		}
			
			if(!is_array($menu)) {
		message('操作非法，自定义菜单结构错误！');
	}
		
		
		$dat = json_encode($set);
		$dat = urldecode($dat);
		return $dat;
	}
function smartUrlEncode($url){
	if (strpos($url, '=') === false) {
		return $url;
	} else {
		$urls = parse_url($url);
		parse_str($urls['query'], $queries);
		if (!empty($queries)) {
			foreach ($queries as $variable => $value) {
				$params[$variable] = urlencode($value);
			}
		}
		$queryString = http_build_query($params, '', '&');
		return $urls['scheme'] . '://' . $urls['host'] . $urls['path'] . '?' . $queryString . '#' . $urls['fragment'];
	}
}
	private function bulidMenuPostData($method,$bizcontent=""){
				global $_GP;
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/config.php';
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/AlipaySign.php';
		$paramsArray = array (
				'method' => $method,
				'sign_type' => 'RSA',
				'app_id' => $_GP['alipay_config']  ['app_id'],
				'timestamp' => date ( 'Y-m-d H:i:s', time () ) 
		);
		if($bizcontent){
			$paramsArray['biz_content']=$bizcontent;
		}
		$as = new AlipaySign();
		$sign = $as->sign_request( $paramsArray, $_GP['alipay_config']  ['merchant_private_key_file'] );
		$paramsArray['sign'] = $sign;
		return $paramsArray;
	}

	public function menuCreate($menu) {
		global $_GP;
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/config.php';
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/HttpRequst.php';
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/AopSdk.php';
		$dat = $this->menuBuildMenuSet($menu);
		
		$menuquery=$this->menuQuery();
		if(empty($menuquery))
		{
			
		$menus_upt=new AlipayMobilePublicMenuAddRequest();
		}else
		{
		$menus_upt=new AlipayMobilePublicMenuUpdateRequest();
	}
		$parDatas=$this->bulidMenuPostData($menus_upt->getApiMethodName(),$dat);
		
		//message($dat );
		$content=HttpRequest::sendPostRequst($_GP['alipay_config']['gatewayUrl'],$parDatas);
		
		return $this->menuResponseParse($content,'update');
	}


	public function menuModify($menu) {
		return $this->menuCreate($menu);
	}
	
	public function menuDelete() {
		return error(-1, '支付宝公众号不支持删除自定义菜单接口！' );
	}

	public function menuQuery() {
				global $_GP;
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/config.php';
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/HttpRequst.php';
		require_once  WEB_ROOT.'/includes/lib/alipaySDK/AopSdk.php';
		$menus_get=new AlipayMobilePublicMenuGetRequest();
		$parDatas=$this->bulidMenuPostData($menus_get->getApiMethodName());
		$content=HttpRequest::sendPostRequst($_GP['alipay_config'] ['gatewayUrl'],$parDatas);
		
		$datas = @json_decode(mb_convert_encoding($content,"UTF-8","GBK"),true);
		$menu_content=$datas['alipay_mobile_public_menu_get_response']["menu_content"];
		$menusArr=@json_decode($menu_content,true);
		if(is_array($menusArr)) {
			$menus = array();
			foreach($menusArr['button'] as $val) {
				$m = array();
				$m['type'] = $val['actionType'] == 'link' ? 'url' : 'click';
				$m['title'] = $val['name'];
				if($m['type'] == 'click') {
					$m['forward'] = $val['actionParam'];
				} else {
					$m['url'] = $val['actionParam'];
				}
				$m['subMenus'] = array();
				if(!empty($val['subButton'])) {
					foreach($val['subButton'] as $v) {
						$s = array();
						$s['type'] = $v['actionType'] == 'link' ? 'url' : 'click';
						$s['title'] = $v['name'];
						if($s['type'] == 'click') {
							$s['forward'] = $v['actionParam'];
						} else {
							$s['url'] = $v['actionParam'];
						}
						$m['subMenus'][] = $s;
					}
				}
				$menus[] = $m;
			}			
			return $menus;
		}
	}
	function error($code, $msg = '') {
	return array(
		'errno' => $code,
		'message' => $msg,
	);
	}
}


