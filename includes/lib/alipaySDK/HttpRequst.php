<?php
class HttpRequest {
	public static function sendPostRequst($url, $data) {
		$postdata = http_build_query ( $data );
// 		print_r($postdata);
		$opts = array (
				'http' => array (
						'method' => 'POST',
						'header' => 'Content-type: application/x-www-form-urlencoded',
						'content' => $postdata 
				) 
		);
		
		
		$context = stream_context_create ( $opts );
		
		$result = file_get_contents ( $url, false, $context );
		return $result;
	}
	
	public static function getRequest($key) {
		$request = null;
		if (isset ( $_GET [$key] ) && ! empty ( $_GET [$key] )) {
			$request = $_GET [$key];
		} elseif (isset ( $_POST [$key] ) && ! empty ( $_POST [$key] )) {
			$request = $_POST [$key];
		}
		return $request;
	}
}