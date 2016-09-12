<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Comments: mysql数据库操作
// +----------------------------------------------------------------------
// | Author: 百家cms <QQ:1987884799> <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');

function message($msg, $redirect = '', $type = '',$successAutoNext=true) {
	global $_CMS;
	if($redirect == 'refresh') {
		$redirect = refresh();
	}
	if($redirect == '') {
		$type = in_array($type, array('success', 'error', 'ajax')) ? $type : 'error';
	} else {
		$type = in_array($type, array('success', 'error', 'ajax')) ? $type : 'success';
	}
	if((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || $type == 'ajax') {
		$vars = array();
		$vars['message'] = $msg;
		$vars['redirect'] = $redirect;
		$vars['type'] = $type;
		exit(json_encode($vars));
	}
	if (empty($msg) && !empty($redirect)) {
		header('Location: '.$redirect);
	}
	include page('message');
	exit();
}


function page($filename) {
			global $_CMS;
			if(SYSTEM_ACT=='mobile') {
				
		
			$source=SYSTEM_ROOT . $_CMS['module']."/template/mobile/{$filename}.php";
			
			
					if (!is_file($source)) {
					$source=SYSTEM_ROOT ."common/template/mobile/{$filename}.php";
			
					}
		}else
		{
		
				$source=SYSTEM_ROOT . $_CMS['module']."/template/web/{$filename}.php";
					if (!is_file($source)) {
					$source=SYSTEM_ROOT ."common/template/web/{$filename}.php";
			
			}
		}
		return $source;
}
function getDomainBeid()
{
		global $_GP;
		if(CORE_VERSION<=20160705)
		{
				$system_store = mysqld_select('SELECT id,isclose FROM '.table('system_store')." where `website`=:website1 and `deleted`=0",array(":website1"=>WEB_WEBSITE));
	
		}else
		{
				$system_store = mysqld_select('SELECT id,isclose FROM '.table('system_store')." where (`website`=:website1 or `website2`=:website2 or `website3`=:website3 ) and `deleted`=0",array(":website1"=>WEB_WEBSITE,":website2"=>WEB_WEBSITE,":website3"=>WEB_WEBSITE));
	
		}

	if(empty($system_store['id']))
	{
		if(!empty($_GP['beid']))
		{
			$system_store = mysqld_select('SELECT id,isclose FROM '.table('system_store')." where `id`=:id",array(":id"=>$_GP['beid']));
			if(empty($system_store['id']))
			{
				message("未找到相关店铺");
			}

			if(!empty($system_store['isclose'])&&$_GP['name']!='manager')
			{
			message("店铺已关闭无法访问");	
			}
		
			return $system_store['id'];	
		}else
		{
		return "";	
		}
	}else
	{			
			if(!empty($system_store['isclose'])&&$_GP['name']!='manager')
			{
			message("店铺已关闭无法访问");	
			}
		
		return $system_store['id'];
	}
}


function checksubmit($action = 'submit') {
	global $_CMS, $_GP;
	if (empty($_GP[$action])) {
		return FALSE;
	}
	if ( (($_SERVER['REQUEST_METHOD'] == 'POST') && (empty($_SERVER['HTTP_REFERER']) || preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST'])))) {
		return TRUE;
	}
	return FALSE;
}

function create_url($module, $params = array()) {
		global $_CMS,$_GP;
		if(empty($params['name']))
			{
		$params['name'] = strtolower($_CMS['module']);
			}
					if(empty($params['beid'])&&!empty($_CMS['beid']))
			{
		$params['beid'] = $_CMS['beid'];
			}
		
				if($_CMS['shopwap_member_isagent']==true&&empty($params['noauto']))
				{
							$member=get_member_account(false);
							$openid=$member['openid'] ;
        			$params['shareid'] = $openid;
        }else
        {
        unset($params['noauto']);	
        }
			
	$queryString = http_build_query($params, '', '&');
	return 'index.php?mod='.$module. (empty($do) ? '' : '&do='.$do) . '&'. $queryString;
	
}

function web_url($do, $querystring = array()) {
			global $_CMS;
			if(empty($querystring['name']))
			{
		$querystring['name'] = strtolower($_CMS['module']);
			}
		$querystring['do'] = $do;
		return create_url('site', $querystring);
}
function mobile_url($do, $querystring = array()) {
		global $_CMS;
			if(empty($querystring['name']))
			{
		$querystring['name'] = strtolower($_CMS['module']);
			}
		$querystring['do'] = $do;
		return create_url('mobile', $querystring);
}
function refresh() {
	global $_GP, $_CMS;
	$_CMS['refresh'] =   $_SERVER['HTTP_REFERER'];
	$_CMS['refresh'] = substr($_CMS['refresh'], -1) == '?' ? substr($_CMS['refresh'], 0, -1) : $_CMS['refresh'];
	$_CMS['refresh'] = str_replace('&amp;', '&', $_CMS['refresh']);
	$reurl = parse_url($_CMS['refresh']);

	if(!empty($reurl['host']) && !in_array($reurl['host'], array($_SERVER['HTTP_HOST'], 'www.'.$_SERVER['HTTP_HOST'])) && !in_array($_SERVER['HTTP_HOST'], array($reurl['host'], 'www.'.$reurl['host']))) {
		$_CMS['refresh'] = WEBSITE_ROOT;
	} elseif(empty($reurl['host'])) {
		$_CMS['refresh'] = WEBSITE_ROOT.'./'.$_CMS['referer'];
	}
	return strip_tags($_CMS['refresh']);
}

function globaPriveteSetting()
{
	global $_CMS;
	
		$beid=	$_CMS['beid'];
		if(empty($beid))
		{
		message('未找到站点id');	
		}
			$config=array();
			$system_config_cache = mysqld_select('SELECT * FROM '.table('config')." where `name`='system_config_cache' and `beid`=:beid",array(":beid"=>$beid));
			if(empty($system_config_cache['value']))
			{
			$configdata = mysqld_selectall('SELECT * FROM '.table('config')." where `beid`=:beid",array(":beid"=>$beid));
			foreach ($configdata as $item) {
				$config[$item['name']]=$item['value'];
			}
				if(!empty($system_config_cache['name']))
				{
					mysqld_update('config', array('value'=>serialize($config)), array('name'=>'system_config_cache','beid'=>$beid));
				}else
				{
		      mysqld_insert('config', array('name'=>'system_config_cache','value'=>serialize($config),'beid'=>$beid));
		    }
				return $config;
			}else
			{
				return unserialize($system_config_cache['value']);
			}	
}
function globaPriveteSystemSetting()
{
	
		$config=array();
		$system_config_cache = mysqld_select('SELECT * FROM '.table('system_config')." where `name`='system_config_cache'");
		if(empty($system_config_cache['value']))
		{
		$configdata = mysqld_selectall('SELECT * FROM '.table('system_config'));
		foreach ($configdata as $item) {
			$config[$item['name']]=$item['value'];
		}
			if(!empty($system_config_cache['name']))
			{
				mysqld_update('system_config', array('value'=>serialize($config)), array('name'=>'system_config_cache'));
			}else
			{
	      mysqld_insert('system_config', array('name'=>'system_config_cache','value'=>serialize($config)));
	    }
			return $config;
		}else
		{
			return unserialize($system_config_cache['value']);
		}
}


function themePage($filename) {
	global $_CMS;
	$settings=globaSetting();
	$theme=$settings['shop_current_themes'];
	$cachefile=WEB_ROOT.'/cache/'.SESSION_PREFIX.'/'.$theme.'/'.$filename.'.php';
	$template=SYSTEM_WEBROOT.'/themes/'.$theme.'/'.$filename.'.html';	
			if(!is_file($template))
			{
					$template=SYSTEM_WEBROOT.'/themes/default/'.$filename.'.html';
					$cachefile=WEB_ROOT.'/cache/'.SESSION_PREFIX.'/default/'.$filename.'.php';
					$theme='default';
			}
	
		if (!is_file($cachefile)||DEVELOPMENT) {
		$str=	file_get_contents($template);
		
		$path = dirname($cachefile);
		if (!is_dir($path))
		{
			mkdirs($path);
		}
		$content = preg_replace('/__RESOURCE__/', WEBSITE_ROOT.'themes/default/__RESOURCE__', $str);
		
			file_put_contents($cachefile, $content);
			return $cachefile;
		}else
		{
			
		return $cachefile;	
		}


}
function clear_theme_cache($path='',$isdir=false)
{
	if($isdir==false)
	{
	$path=WEB_ROOT.'/cache/'.$path;
	}
	    if(is_dir($path))
	    {
	            $file_list= scandir($path);
	            foreach ($file_list as $file)
	            {
	                if( $file!='.' && $file!='..')
	                {
	               		if($file!='qrcode')
	               		{
	                    clear_theme_cache($path.'/'.$file,true);
	                  }
	                }
	            }
	            
	    	if($path!=WEB_ROOT.'/cache/')
	    	{
	            @rmdir($path);   
	               
	      }    
	    }
	    else
	    {
	        @unlink($path); 
	    }
	 
}
function refreshSetting($arrays)
{
	global $_CMS;
	$beid=	$_CMS['beid'];
	if(empty($beid))
	{
	message('未找到站点id');	
	}
	
	if(is_array($arrays)) {
		   foreach ($arrays as $cid => $cate) {
		   	$config_data = mysqld_selectcolumn('SELECT `name` FROM '.table('config')." where `name`=:name and `beid`=:beid",array(":name"=>$cid,":beid"=>$beid));
					if(empty($config_data))
					{
 					  mysqld_delete('config', array('name'=>$cid,'beid'=>$beid));
          	$data=array('name'=>$cid,'value'=>$cate,'beid'=>$beid);
          	 mysqld_insert('config', $data);
          }else
          {
 						 mysqld_update('config', array('value'=>$cate), array('name'=>$cid,'beid'=>$beid));
          }
       }
 			 mysqld_update('config', array('value'=>''), array('name'=>'system_config_cache','beid'=>$beid));
 			 $_CMS['store_globa_setting']=globaPriveteSetting();
 			 
	}
}


function globaBeSetting($beid)
{
	
	global $_CMS;
	
		if(empty($beid))
		{
		message('未找到站点id');	
		}
			$config=array();
			$system_config_cache = mysqld_select('SELECT * FROM '.table('config')." where `name`='system_config_cache' and `beid`=:beid",array(":beid"=>$beid));
			if(empty($system_config_cache['value']))
			{
			$configdata = mysqld_selectall('SELECT * FROM '.table('config')." where `beid`=:beid",array(":beid"=>$beid));
			foreach ($configdata as $item) {
				$config[$item['name']]=$item['value'];
			}
				if(!empty($system_config_cache['name']))
				{
					mysqld_update('config', array('value'=>serialize($config)), array('name'=>'system_config_cache','beid'=>$beid));
				}else
				{
		      mysqld_insert('config', array('name'=>'system_config_cache','value'=>serialize($config),'beid'=>$beid));
		    }
				return $config;
			}else
			{
				return unserialize($system_config_cache['value']);
			}	
}


function refreshBeSetting($beid,$arrays)
{
	global $_CMS;
	if(empty($beid))
	{
	message('未找到站点id');	
	}
	
	if(is_array($arrays)) {
		   foreach ($arrays as $cid => $cate) {
		   	$config_data = mysqld_selectcolumn('SELECT `name` FROM '.table('config')." where `name`=:name and `beid`=:beid",array(":name"=>$cid,":beid"=>$beid));
					if(empty($config_data))
					{
 					  mysqld_delete('config', array('name'=>$cid,'beid'=>$beid));
          	$data=array('name'=>$cid,'value'=>$cate,'beid'=>$beid);
          	 mysqld_insert('config', $data);
          }else
          {
 						 mysqld_update('config', array('value'=>$cate), array('name'=>$cid,'beid'=>$beid));
          }
       }
 			 mysqld_update('config', array('value'=>''), array('name'=>'system_config_cache','beid'=>$beid));
 			 
	}
}

function refreshSystemSetting($arrays)
{
		global $_CMS;
	if(is_array($arrays)) {
		   foreach ($arrays as $cid => $cate) {
		   	$config_data = mysqld_selectcolumn('SELECT `name` FROM '.table('system_config')." where `name`=:name",array(":name"=>$cid));
					if(empty($config_data))
					{
 					  mysqld_delete('system_config', array('name'=>$cid));
          	$data=array('name'=>$cid,'value'=>$cate);
          	 mysqld_insert('system_config', $data);
          }else
          {
 						 mysqld_update('system_config', array('value'=>$cate), array('name'=>$cid));
          }
       }
 			 mysqld_update('system_config', array('value'=>''), array('name'=>'system_config_cache'));
 			 $_CMS['system_globa_setting']=globaPriveteSystemSetting();
	}
}


function getClientIP() {
	static $ip = '';
	$ip = $_SERVER['REMOTE_ADDR'];
	if(isset($_SERVER['HTTP_CDN_SRC_IP'])) {
		$ip = $_SERVER['HTTP_CDN_SRC_IP'];
	} elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
		foreach ($matches[0] AS $xip) {
			if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
				$ip = $xip;
				break;
			}
		}
	}
	return $ip;
}

function is_mobile_request()   
{
  $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';   
  $mobile_browser = '0';   
  if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))   
    $mobile_browser++;   
  if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))   
    $mobile_browser++;   
  if(isset($_SERVER['HTTP_X_WAP_PROFILE']))   
    $mobile_browser++;   
  if(isset($_SERVER['HTTP_PROFILE']))   
    $mobile_browser++;   
  $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));   
  $mobile_agents = array(   
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',   
        'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',   
        'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',   
        'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',   
        'newt','noki','oper','palm','pana','pant','phil','play','port','prox',   
        'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',   
        'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',   
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',   
        'wapr','webc','winw','winw','xda','xda-'  
        );   
  if(in_array($mobile_ua, $mobile_agents))   
    $mobile_browser++;   
  if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)   
    $mobile_browser++;   
  // Pre-final check to reset everything if the user is on Windows   
  if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)   
    $mobile_browser=0;   
  // But WP7 is also Windows, with a slightly different characteristic   
  if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)   
    $mobile_browser++;   
  if($mobile_browser>0)   
    return true;   
  else 
    return false;   
}

function globaSystemSetting()
{
	global $_CMS;
	return $_CMS['system_globa_setting'];
}
function globaSetting($arrays="")
{
	global $_CMS;
	return $_CMS['store_globa_setting'];
}


function random($length, $nc = 0) {
    $random= rand(1, 9);
    for($index=1;$index<$length;$index++)
    {
    	$random=$random.rand(1, 9);
    }
    return $random;
}
function error($code, $msg = '') {
	return array(
		'errno' => $code,
		'message' => $msg,
	);
}
function is_error($data) {
	if (empty($data) || !is_array($data) || !array_key_exists('errno', $data) || (array_key_exists('errno', $data) && $data['errno'] == 0)) {
		return false;
	} else {
		return true;
	}
}
function pagination($total, $pindex, $psize = 15) {
	global $_CMS;
	$tpage = ceil($total / $psize);
	if($tpage <= 1) {
		return '';
	}
	$findex = 1;
	$lindex = $tpage;
	$cindex = $pindex;
	$cindex = min($cindex, $tpage);
	$cindex = max($cindex, 1);
	$cindex = $cindex;
	$pindex = $cindex > 1 ? $cindex - 1 : 1;
	$nindex = $cindex < $tpage ? $cindex + 1 : $tpage;
	$_GET['page'] = $findex;
	$furl = 'href="' . 'index.php?' . http_build_query($_GET) . '"';
	$_GET['page'] = $pindex;
	$purl = 'href="' . 'index.php?'. http_build_query($_GET) . '"';
	$_GET['page'] = $nindex;
	$nurl = 'href="' . 'index.php?'. http_build_query($_GET) . '"';
	$_GET['page'] = $lindex; 
	$lurl = 'href="' . 'index.php?' . http_build_query($_GET) . '"';
	$beforesize = 5;
	$aftersize = 4;
	
	

	$html = '<div class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
	if($cindex > 1) {
		$html .= "<li><a {$furl} class=\"paginate_button previous\">首页</a></li>";
		$html .= "<li><a {$purl} class=\"paginate_button previous\">&laquo;上一页</a></li>";
	}
		$rastart = max(1, $cindex - $beforesize);
		$raend = min($tpage, $cindex + $aftersize);
		if ($raend  - $rastart < $beforesize + $aftersize) {
			$raend = min($tpage, $rastart + $beforesize + $aftersize);
			$rastart= max(1, $raend - $beforesize - $aftersize);
		}
		for ($i = $rastart; $i <= $raend; $i++) {
			$_GET['page'] = $i;
			$aurl = 'href="index.php?' . http_build_query($_GET) . '"';
			$html .= ($i == $cindex ? '<li class="paginate_button active"><a href="javascript:;">' . $i . '</a></li>' : "<li><a {$aurl}>" . $i . '</a></li>');
		}
	if($cindex < $tpage) {
		$html .= "<li><a {$nurl} class=\"paginate_button next\">下一页&raquo;</a></li>";
		$html .= "<li><a {$lurl} class=\"paginate_button next\">尾页</a></li>";
	}
	$html .= '</ul></div>';
	return $html;
}
function file_delete($file) {
	$system_setting=globaSystemSetting();
	if(!empty($system_setting['system_isnetattach']))
		{
			return true;
			
		}
	if (empty($file)) {
		return FALSE;	
	}	
	if (is_file(SYSTEM_WEBROOT . '/attachment/' . $file)) {
		unlink(SYSTEM_WEBROOT . '/attachment/' . $file);
	}
	return TRUE;
}
function file_move($filename, $dest) {
	mkdirs(dirname($dest));
	if(is_uploaded_file($filename)) {
		move_uploaded_file($filename, $dest);
	} else {
		rename($filename, $dest);
	}
	return is_file($dest);
}

function mkdirs($path) {
	if(!is_dir($path)) {
		mkdirs(dirname($path));
		mkdir($path);
	}
	return is_dir($path);
}

function rmdirs($path='',$isdir=false)
{
	    if(is_dir($path))
	    {
	            $file_list= scandir($path);
	            foreach ($file_list as $file)
	            {
	                if( $file!='.' && $file!='..')
	                {
	               		if($file!='qrcode')
	               		{
	                    rmdirs($path.'/'.$file,true);
	                  }
	                }
	            }
	            
	    	if($path!=WEB_ROOT.'/cache/')
	    	{
	            @rmdir($path);   
	               
	      }    
	    }
	    else
	    {
	        @unlink($path); 
	    }
	 
}
function system_config_file_upload($file, $newname, $folder) {
	if(empty($file)) {
		return error(-1, '没有上传内容');
	}
		if(empty($folder)) {
		return error(-1, '上传文件夹不能空');
	}
		mkdirs(WEB_ROOT .'/config/'. $folder );
			$result['path'] ='/config/'. $folder  .'/'. $newname;
	$filename = WEB_ROOT .	$result['path'];
	if(!file_move($file['tmp_name'], $filename)) {
		return error(-1, '保存上传文件失败');
	}
	$result['success'] = true;
	
	return $result; 
}
function file_upload($file, $type = 'image',$uloadlocal=false) {
	if(empty($file)) {
		return error(-1, '没有上传内容');
	}
	$limit=5000;
	$extention = pathinfo($file['name'], PATHINFO_EXTENSION);
	$extention=strtolower($extention);
	if(empty($type)||$type=='image')
	{
	$extentions=array('gif', 'jpg', 'jpeg', 'png');
	}
	if($type=='music')
	{
	$extentions=array('mp3','mp4');
	}
		if($type=='other')
	{
	$extentions=array('gif', 'jpg', 'jpeg', 'png','mp3','mp4','doc');
	}
	if(!in_array(strtolower($extention), $extentions)) {
		return error(-1, '不允许上传此类文件');
	}
	if($limit * 1024 < filesize($file['tmp_name'])) {
		return error(-1, "上传的文件超过大小限制，请上传小于 ".$limit."k 的文件");
	}
	$result = array();
	$path = '/attachment/';
		$result['path'] = "{$extention}/" . date('Y/m/');
		$fullpath=$result['path'];
		mkdirs(WEB_ROOT . $path . $result['path']);
		do {
			$filename = random(15) . ".{$extention}";
		} while(is_file(SYSTEM_WEBROOT . $path . $filename));
		$realfilename=$filename;
		$result['path'] .= $filename;
	$filename = WEB_ROOT . $path . $result['path'];

$system_setting=globaSystemSetting();
	if(!empty($system_setting['system_isnetattach'])&&$uloadlocal==false)
		{
				$settings=globaSystemSetting();
				$filesource=$file['tmp_name'];
	
		if($system_setting['system_isnetattach']==1)
		{
	require_once(WEB_ROOT.'/system/common/lib/lib_ftp.php');
			$ftp=new baijiacms_ftp();
			$ftp->connect();
				$ftp->upload($filesource,$system_setting['system_ftp_ftproot']. $result['path']);
			if($ftp->error()) {
			message('文件上传失败，错误号:'.$ftp->error());
			}
		}
			if($system_setting['system_isnetattach']==2)
		{
			
		require_once(WEB_ROOT.'/system/common/lib/lib_oss.php');
			$oss=new baijiacms_oss();

					$oss->upload($filesource,$realfilename,$fullpath);
								if($oss->error()) {
			message('文件上传失败，错误号:'.$oss->error());
			}
		}	
		
		}else
		{
			
		

	if(!file_move($file['tmp_name'], $filename)) {
		return error(-1, '保存上传文件失败');
	}
	
	
	}
	$result['success'] = true;
	return $result; 
}
function http_get($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
}
function http_post($url,$post_data){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1');
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}