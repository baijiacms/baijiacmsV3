<?php

// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Comments: ftp工具类操作
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');

if(!defined('FTP_ERR_SERVER_DISABLED')) {
	define('FTP_ERR_SERVER_DISABLED', -100);
	define('FTP_ERR_CONFIG_OFF', -101);
	define('FTP_ERR_CONNECT_TO_SERVER', -102);
	define('FTP_ERR_USER_NO_LOGGIN', -103);
	define('FTP_ERR_CHDIR', -104);
	define('FTP_ERR_MKDIR', -105);
	define('FTP_ERR_SOURCE_READ', -106);
	define('FTP_ERR_TARGET_WRITE', -107);
}



class baijiacms_ftp
{

	var $enabled = false;
	var $config = array();

	var $func;
	var $connectid;
	var $_error;

	function &instance($config = array()) {
		static $object;
		if(empty($object)) {
			$object = new baijiacms_ftp($config);
		}
		return $object;
	}

	function __construct($config = array()) {
		$this->set_error(0);
		$this->config = globaSystemSetting();
		$this->enabled = false;
		if(empty($this->config['system_isnetattach']) || empty($this->config['system_ftp_ip'])) {
			$this->set_error(FTP_ERR_CONFIG_OFF);
		} else {
			$this->func = $this->config['ssl'] && function_exists('ftp_ssl_connect') ? 'ftp_ssl_connect' : 'ftp_connect';
			if($this->func == 'ftp_connect' && !function_exists('ftp_connect')) {
				$this->set_error(FTP_ERR_SERVER_DISABLED);
			} else {
				$this->config['host'] = baijiacms_ftp::clear($this->config['system_ftp_ip']);
				$this->config['port'] = intval($this->config['system_ftp_port']);
				$this->config['ssl'] = intval($this->config['system_ftp_ssl']);
				$this->config['username'] = baijiacms_ftp::clear($this->config['system_ftp_username']);
				$this->config['password'] = $this->config['system_ftp_passwd'];
				$this->config['timeout'] = intval($this->config['system_ftp_timeout']);
				$this->config['pasv'] = intval($this->config['system_ftp_pasv']);
				$this->config['attachdir'] = $this->config['system_ftp_ftproot'];
				
				$this->enabled = true;
			}
		}
	}

	function upload($source, $target) {
		if($this->error()) {
			return 0;
		}
		$old_dir = $this->ftp_pwd();
		$dirname = dirname($target);
		$filename = basename($target);					
		if(!$this->ftp_chdir($dirname)) {
			if($this->ftp_mkdir($dirname)) {
				$this->ftp_chmod($dirname);
				if(!$this->ftp_chdir($dirname)) {
					$this->set_error(FTP_ERR_CHDIR);
				}
				$this->ftp_put('index.htm', WEB_ROOT.'/includes/index.htm', FTP_BINARY);
			} else {
				$this->set_error(FTP_ERR_MKDIR);
			}
		}

		$res = 0;
		if(!$this->error()) {
			if($fp = @fopen($source, 'rb')) {
				$res = $this->ftp_fput($filename, $fp, FTP_BINARY);
				@fclose($fp);
				!$res && $this->set_error(FTP_ERR_TARGET_WRITE);
			} else {
				$this->set_error(FTP_ERR_SOURCE_READ);
			}
		}

		$this->ftp_chdir($old_dir);

		return $res ? 1 : 0;
	}

	function connect() {
		if(!$this->enabled || empty($this->config)) {
			return 0;
		} else {
			return $this->ftp_connect(
				$this->config['host'],
				$this->config['username'],
				$this->config['password'],
				$this->config['attachdir'],
				$this->config['port'],
				$this->config['timeout'],
				$this->config['ssl'],
				$this->config['pasv']
				);
		}

	}

	function ftp_connect($ftphost, $username, $password, $ftppath, $ftpport = 21, $timeout = 30, $ftpssl = 0, $ftppasv = 0) {
		$res = 0;
		$fun = $this->func;
		if($this->connectid = $fun($ftphost, $ftpport, 20)) {

			$timeout && $this->set_option(FTP_TIMEOUT_SEC, $timeout);
	
			if($this->ftp_login($username, $password)) {
				$this->ftp_pasv($ftppasv);
				
				if($this->ftp_chdir($ftppath)) {
					$res =  $this->connectid;
				} else {
					$this->set_error(FTP_ERR_CHDIR);
				}
			} else {
				$this->set_error(FTP_ERR_USER_NO_LOGGIN);
			}

		} else {
			$this->set_error(FTP_ERR_CONNECT_TO_SERVER);
		}

		if($res > 0) {
			$this->set_error();
			$this->enabled = 1;
		} else {
			$this->enabled = 0;
			$this->ftp_close();
		}

		return $res;

	}

	function set_error($code = 0) {
		$this->_error = $code;
	}

	function error() {
		return $this->_error;
	}

	function clear($str) {
		return str_replace(array( "\n", "\r", '..'), '', $str);
	}


	function set_option($cmd, $value) {
		if(function_exists('ftp_set_option')) {
			return @ftp_set_option($this->connectid, $cmd, $value);
		}
	}

	function ftp_mkdir($directory) {
		$directory = baijiacms_ftp::clear($directory);
		$epath = explode('/', $directory);
		$dir = '';$comma = '';
		foreach($epath as $path) {
			$dir .= $comma.$path;
			$comma = '/';
			$return = @ftp_mkdir($this->connectid, $dir);
			$this->ftp_chmod($dir);
		}
		return $return;
	}

	function ftp_rmdir($directory) {
		$directory = baijiacms_ftp::clear($directory);
		return @ftp_rmdir($this->connectid, $directory);
	}

	function ftp_put($remote_file, $local_file, $mode = FTP_BINARY) {
		$remote_file = baijiacms_ftp::clear($remote_file);
		$local_file = baijiacms_ftp::clear($local_file);
		$mode = intval($mode);
		return @ftp_put($this->connectid, $remote_file, $local_file, $mode);
	}

	function ftp_fput($remote_file, $sourcefp, $mode = FTP_BINARY) {
		$remote_file = baijiacms_ftp::clear($remote_file);
		$mode = intval($mode);
		return @ftp_fput($this->connectid, $remote_file, $sourcefp, $mode);
	}

	function ftp_size($remote_file) {
		$remote_file = baijiacms_ftp::clear($remote_file);
		return @ftp_size($this->connectid, $remote_file);
	}

	function ftp_close() {
		return @ftp_close($this->connectid);
	}

	function ftp_delete($path) {
		$path = baijiacms_ftp::clear($path);
		return @ftp_delete($this->connectid, $path);
	}

	function ftp_get($local_file, $remote_file, $mode, $resumepos = 0) {
		$remote_file = baijiacms_ftp::clear($remote_file);
		$local_file = baijiacms_ftp::clear($local_file);
		$mode = intval($mode);
		$resumepos = intval($resumepos);
		return @ftp_get($this->connectid, $local_file, $remote_file, $mode, $resumepos);
	}

	function ftp_login($username, $password) {
		$username = $this->clear($username);
		$password = str_replace(array("\n", "\r"), array('', ''), $password);
		return @ftp_login($this->connectid, $username, $password);
	}

	function ftp_pasv($pasv) {
		return @ftp_pasv($this->connectid, $pasv ? true : false);
	}

	function ftp_chdir($directory) {
		$directory = baijiacms_ftp::clear($directory);
		return @ftp_chdir($this->connectid, $directory);
	}

	function ftp_site($cmd) {
		$cmd = baijiacms_ftp::clear($cmd);
		return @ftp_site($this->connectid, $cmd);
	}

	function ftp_chmod($filename, $mod = 0777) {
		$filename = baijiacms_ftp::clear($filename);
		if(function_exists('ftp_chmod')) {
			return @ftp_chmod($this->connectid, $mod, $filename);
		} else {
			return @ftp_site($this->connectid, 'CHMOD '.$mod.' '.$filename);
		}
	}

	function ftp_pwd() {
		return @ftp_pwd($this->connectid);
	}

}