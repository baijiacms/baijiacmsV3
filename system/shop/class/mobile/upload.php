<?php

	if (!empty($_FILES['imgFile']['name'])) {
		if ($_FILES['imgFile']['error'] != 0) {
			$result['message'] = '上传失败，请重试！';
			exit(json_encode($result));
		}
$extention = pathinfo($_FILES['imgFile']['name'], PATHINFO_EXTENSION);
			$extentions=array('gif', 'jpg', 'jpeg', 'png');
	if(!in_array(strtolower($extention), $extentions)) {
				$result['message'] = '不允许上传此类文件！';
			exit(json_encode($result));
	}
		$file = file_upload($_FILES['imgFile'], 'image');
		if (is_error($file)) {
			$result['message'] = $file['message'];
			exit(json_encode($result));
		}
		$result['url'] = $file['url'];
		$result['error'] = 0;
		$result['filename'] = $file['path'];
		$result['url'] = ATTACHMENT_WEBROOT.$result['filename'];
		$filename=basename($result['url']);
		exit(json_encode($result));
	} else {
		$result['message'] = '请选择要上传的图片！';
		exit(json_encode($result));
	}
		