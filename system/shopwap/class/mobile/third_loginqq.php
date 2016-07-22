<?php
			$qqlogin = mysqld_select("SELECT * FROM " . table('thirdlogin') . " WHERE enabled=1 and `code`='qq' and beid=:beid",array(':beid'=>$_CMS['beid']));
					if(!empty($qqlogin)&&!empty($qqlogin['id']))
					{
						$configs = unserialize($qqlogin['configs']);
					$thirdlogin_qq_appid=$configs['thirdlogin_qq_appid'];
					$thirdlogin_qq_appkey=$configs['thirdlogin_qq_appkey'];
					
		
						if(empty($thirdlogin_qq_appid) || empty($thirdlogin_qq_appkey)){
										message('QQ快捷登录没有配置AppId和Appkey!') ;
									}
									 	unset($_SESSION[MOBILE_QQ_OPENID]);
					
									
						
									$scope="get_user_info";
									$callback_url=WEBSITE_ROOT."qqcallback.php";
									$params = array(
					            'client_id' => $thirdlogin_qq_appid,
					            'redirect_uri' => $callback_url,
					            'response_type' => 'code',
					            'scope' => $scope
					        );
					        	$request_url="https://graph.qq.com/oauth2.0/authorize?";
					        
					      $oauth2_code = $request_url . http_build_query($params);
					    	header("location:$oauth2_code");
								exit;
					
					
					}
			
			message("QQ快捷登录未启动");