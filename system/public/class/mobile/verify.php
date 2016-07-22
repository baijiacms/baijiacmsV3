<?php
	$num = 4;$size = 35; $width = 265;$height = 70;
	   !$width && $width = $num * 5*$size*1.5 + 5*$size/25;
	    !$height && $height = $size * 2.5; 
	    // 去掉了 0 1 O l 等
	    $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVW";
	    $code = '';
	    for ($i = 0; $i < $num; $i++) {
	        $code .= $str[mt_rand(0, strlen($str)-1)];
	    } 
	    // 画图像
	    $im = imagecreate($width, $height); 
	    // 定义要用到的颜色
	    $back_color = imagecolorallocate($im, 235, 236, 237);
	    $boer_color = imagecolorallocate($im, 118, 151, 199);
	    $text_color = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120)); 
	    // 画背景
	    imagefilledrectangle($im, 0, 0, $width, $height, $back_color); 
	    // 画边框
	    imagerectangle($im, 0, 0, $width-1, $height-1, $boer_color); 
	    // 画干扰线
	    for($i = 0;$i < 5;$i++) {
	        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	        imagearc($im, mt_rand(- $width, $width), mt_rand(- $height, $height), mt_rand(30, $width * 2), mt_rand(20, $height * 2), mt_rand(0, 360), mt_rand(0, 360), $font_color);
	    } 
	    // 画干扰点
	    for($i = 0;$i < 50;$i++) {
	        $font_color = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
	        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $font_color);
	    } 
	    // 画验证码
	    imagettftext($im, 60, 0, 20,60, $text_color, WEB_ROOT.'/includes/lib/font.ttf',  $code);
			
	    $_SESSION["VerifyCode"]=$code; 
			header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
			header('Cache-Control: post-check=0, pre-check=0', false);		
			header('Pragma: no-cache');
			header("content-type: image/png");
	    imagepng($im);
	    imagedestroy($im);