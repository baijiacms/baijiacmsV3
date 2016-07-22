<?php
require_once 'function.inc.php';
require_once 'aop/request/AlipaySystemOauthTokenRequest.php';
require_once 'aop/request/AlipayUserUserinfoShareRequest.php';
class UserInfo {
	public function getUserInfo($auth_code) {
		$token = $this->requestToken ( $auth_code );
		// echo "token: " .var_export($token);
		// print_r($token);
		if (isset ( $token->alipay_system_oauth_token_response )) {
			// 成功返回
			// 示例：array(
			// 'access_token' => 'publicpBfd7aa055c4c34120949e287f84eee84a',
			// 'expires_in' => 500,
			// 're_expires_in' => 300,
			// 'refresh_token' => 'publicpB343643c1f58b415ab9add66c0ea91fd3',
			// )
			$token_str = $token->alipay_system_oauth_token_response->access_token;
			// echo $token_str;
			$user_info = $this->requestUserInfo ( $token_str );
			// var_dump ( $user_info );
			
			if (isset ( $user_info->alipay_user_userinfo_share_response )) {
				$user_info_resp = $user_info->alipay_user_userinfo_share_response;
				
				// 以下每个字段都需要申请权限，才会返回。
				// 支付宝返回的是GBK编码，所以中文会有乱码
				// 'phone' => '',
				// 'deliver_fullname' => '濞村嘲',
				// 'user_type_value' => '2',
				// 'is_mobile_auth' => 'T',
				// 'user_id' => 'BM7PjM8f8-v6VFqeTlFUqo97w0QKRHRl-OmymTOxsGHnKDWiwQekMHiEi06tEbjgbb',
				// 'gender' => 'm',
				// 'zip' => '',
				// 'cert_type_value' => '0',
				// 'is_licence_auth' => 'F',
				// 'deliver_province' => '瀹?,
				// 'deliver_city' => '钘?,
				// 'is_certified' => 'T',
				// 'deliver_area' => '濮濇笟',
				// 'is_bank_auth' => 'T',
				// 'deliver_mobile' => '1234',
				// 'email' => '213412@vip.qq.com',
				// 'address' => '娑撶痪鐠?99宄般亯鎼存潪娴犺泛D4B鎼?F',
				// 'user_status' => 'T',
				// 'cert_no' => '32142134',
				// 'real_name' => '濞村嘲',
				// 'is_id_auth' => 'T',
				// 'deliver_address_list' =>
				$user_id = $user_info_resp->user_id;
				// $deliver_fullname = iconv("GBK", "UTF-8//IGNORE", $user_info_resp->deliver_fullname);
				$deliver_fullname = characet ( $user_info_resp->deliver_fullname );
				$deliver_mobile = $user_info_resp->deliver_mobile;
				echo $deliver_fullname;
				writeLog ( $deliver_fullname );
				return $user_info_resp;
			}
			// print_r($user_info);
			writeLog ( "user_info" . var_export ( $user_info, true ) );
		} elseif (isset ( $token->error_response )) {
			// 返回了错误信息
			// 如：[code] => 40002
			// [msg] => Invalid Arguments
			// [sub_code] => isv.code-invalid
			// [sub_msg] => 授权码code无效
			
			// 记录错误返回信息
			writeLog ( $token->error_response->sub_msg );
		}
		writeLog ( var_export ( $token, true ) );
	}
	public function requestUserInfo($token) {
		$AlipayUserUserinfoShareRequest = new AlipayUserUserinfoShareRequest ();
		// $AlipayUserUserinfoShareRequest->setProdCode ( $token );
		
		$result = aopclient_request_execute ( $AlipayUserUserinfoShareRequest, $token );
		return $result;
	}
	public function requestToken($auth_code) {
		$AlipaySystemOauthTokenRequest = new AlipaySystemOauthTokenRequest ();
		$AlipaySystemOauthTokenRequest->setCode ( $auth_code );
		$AlipaySystemOauthTokenRequest->setGrantType ( "authorization_code" );
		
		$result = aopclient_request_execute ( $AlipaySystemOauthTokenRequest );
		return $result;
	}
}

?>