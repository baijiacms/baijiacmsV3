<?php
	define('LOCK_TO_UPDATE', true);	
	 $op = !empty($_GP['op']) ? $_GP['op'] : 'display';

				$op="version";
				//	$versionurl=file_get_contents(UPDATE_GETVERSION_URL);
				//	$version=file_get_contents(UPDATE_GETVERSION);
							if($_GP['act']=="toupdate"&&LOCK_TO_UPDATE==true)
			{
				
				
				
				
				if(is_file(WEB_ROOT.'/system/modules/updatesql.php'))
					{
						require WEB_ROOT.'/system/modules/updatesql.php';
					}
				file_put_contents(WEB_ROOT.'/config/version.php',"<?php define('SYSTEM_VERSION', ".CORE_VERSION.");"); 
				
					
				
					message("系统升级完成!",create_url('site', array('name' => 'manager','do' => 'dev')),"success");
			}
					$localversion=SYSTEM_VERSION;
		   if(is_file(WEB_ROOT.'/config/debug.php'))
				{
					$core_development=1;
				}
					if($_GP['act']=="development")
			{
					if(empty($_GP['status']))
          	{
          		@unlink(WEB_ROOT.'/config/debug.php');
          			message("开发模式关闭成功!","refresh","success");
          	}else
          	{
          		


file_put_contents(WEB_ROOT.'/config/debug.php',"<?php define('DEVELOPMENT',1);define('SQL_DEBUG', 1);?>");
			message("开发模式开启成功!","refresh","success");
          	}
          }
          function sizefix($size) {
	if($size >= 1073741824) {
		$size = round($size / 1073741824 * 100) / 100 . ' GB';
	} elseif($size >= 1048576) {
		$size = round($size / 1048576 * 100) / 100 . ' MB';
	} elseif($size >= 1024) {
		$size = round($size / 1024 * 100) / 100 . ' KB';
	} else {
		$size = $size . ' Bytes';
	}
	return $size;
}
function psize($str) {
	if(strtolower($str[strlen($str) -1]) == 'k') {
		return floatval($str) * 1024;
	}
	if(strtolower($str[strlen($str) -1]) == 'm') {
		return floatval($str) * 1048576;
	}
	if(strtolower($str[strlen($str) -1]) == 'g') {
		return floatval($str) * 1073741824;
	}
}
          $info = array();
			$info['os'] = php_uname();
			$info['php'] = phpversion();
			$info['sapi'] = $_SERVER['SERVER_SOFTWARE'];
			$info['sapi'] = $info['sapi'] ? $info['sapi'] : php_sapi_name();
			          
			$size = 0;
			$size = @ini_get('upload_max_filesize');
			if($size) {
				$size = psize($size);
			}
			if($size > 0) {
				$ts = @ini_get('post_max_size'); 
				if($ts) {
					$ts = psize($size);
				}
				if($ts > 0) {
					$size = min($size, $ts);
				}
				$ts = @ini_get('memory_limit');
				if($ts) {
					$ts = psize($size);
				}
				if($ts > 0) {
					$size = min($size, $ts);
				}
			}
			if(empty($size)) {
				$size = '';
			} else {
	$size = sizefix($size);
}
			$info['limit'] = $size;
			$sql = 'SELECT VERSION();';
$info['mysql']['version'] = mysqld_selectcolumn($sql);
			include page('dev');