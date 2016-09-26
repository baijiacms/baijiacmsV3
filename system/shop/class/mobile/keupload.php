<?php
// +----------------------------------------------------------------------
// | 
// +----------------------------------------------------------------------
// | Copyright (c) 2015 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
	$result = array(
		'url' => '',
		'title' => '',
		'original' => '',
		'state' => 'SUCCESS',
	);
	$upfile=$_FILES['upfile'];
	if(empty($upfile))
	{
		$upfile=$_FILES['imgFile'];
		}
	if (!empty($upfile['name'])) {
		if ($_FILES['upfile']['error'] != 0) {
			$result['state'] = '上传失败，请重试！';
			exit(json_encode($result));
		}
		$file = file_upload($upfile, 'other');
		if (is_error($file)) {
			$result['state'] = $file['message'];
			exit(json_encode($result));
		}
		$result['url'] = $file['path'];
		$result['title'] = '';
		$result['original'] = '';
		exit(json_encode($result));
	} else {
		
		$result['state'] = '请选择要上传的文件，仅支持gif,jpg, jpeg, png,mp3,mp4,doc格式！';
		exit(json_encode($result));
	}