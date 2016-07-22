<?php
defined('SYSTEM_IN') or exit('Access Denied');
 $operation = !empty($_GP['op']) ? $_GP['op'] : 'display';
 
 if($operation=='display')
 {
 	function dump_escape_mimic($inp) { 
	return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
}
 	
function dump_export($continue = array()) {
	global $_GP;

	$sql = "SHOW TABLE STATUS LIKE 'baijiacms_%'";
	$tables = mysqld_selectall($sql);
	if(empty($tables)) {
		return false;
	}
	if(empty($continue)) {
		do {
			$bakdir = WEB_ROOT . '/config/data_backup/' . time() . '_' . random(8);
		} while(is_dir($bakdir));
		mkdirs($bakdir);
	} else {
		$bakdir = $continue['bakdir'];
	}

	$size = 300;
	$volumn = 1024 * 1024 * 2;

	$series = 1;
	if(!empty($continue)) {
		$series = $continue['series'];
	}
	$dump = '';
	$catch = false;
	if(empty($continue)) {
		$catch = true;
	}
	foreach($tables as $t) {
		$t = array_shift($t);
		if(!empty($continue) && $t == $continue['table']) {
			$catch = true;
		}
		if(!$catch ) {
			continue;
		}
		if(!empty($dump)) {
			$dump .= "\n\n";
		}
		if($t != $continue['table']) {
			$dump .= "DROP TABLE IF EXISTS {$t};\n";
			$sql = "SHOW CREATE TABLE {$t}";
			$row = mysqld_select($sql);
			$dump .= $row['Create Table'];
			$dump .= ";\n\n";
		}

		$fields = mysqld_selectall("SHOW FULL COLUMNS FROM {$t}", array(), 'Field');
		if(empty($fields)) {
			continue;
		}
		$index = 0;
		if(!empty($continue)) {
			$index = $continue['index'];
			$continue = array();
		}
		while(true) {
			$start = $index * $size;
			$sql = "SELECT * FROM {$t} LIMIT {$start}, {$size}";
			$rs = mysqld_selectall($sql);
			if(!empty($rs)) {
				$tmp = '';
				foreach($rs as $row) {
					$tmp .= '(';
					foreach($row as $k => $v) {
						$tmp .= "'" . dump_escape_mimic($v) . "',";
					}
					$tmp = rtrim($tmp, ',');
					$tmp .= "),\n";
				}
				$tmp = rtrim($tmp, ",\n");
				$dump .= "INSERT INTO {$t} VALUES \n{$tmp};\n";
				if(strlen($dump) > $volumn) {
					$bakfile = $bakdir . "/baijiacms-{$series}.sql";
					$dump .= "\n\n";
					file_put_contents($bakfile, $dump);
					$series++;
					$ctu = array();
					$ctu['table'] = $t;
					$ctu['index'] = $index + 1;
					$ctu['series'] = $series;
					$ctu['bakdir'] = $bakdir;
					return $ctu;
				}
			}
			if(empty($rs) || count($rs) < $size) {
				break;
			}
			$index++;
		}
	}

	$bakfile = $bakdir . "/baijiacms-{$series}.sql";
	$dump .= "\n\n----Baijiacms MySQL Dump End";
	file_put_contents($bakfile, $dump);
	return false;
}



 if (checksubmit("submit")) {
		$continue = dump_export();
		if(!empty($continue)) {
			$postctu=base64_encode(json_encode($continue));
			message('正在导出数据, 请不要关闭浏览器, 当前第 1 卷.', create_url('site', array('name' => 'manager','do' => 'database','op'=>'display','ctu'=>$postctu)),'success');
		} else {
				message('数据已经备份完成', create_url('site', array('name' => 'manager','do' => 'database','op'=>'display')),'success');
		}
	}
	if($_GP['ctu']) {
		$ctu = json_decode(base64_decode($_GP['ctu']), true);
		$continue = dump_export($ctu);
		if(!empty($continue)) {
			$postctu=base64_encode(json_encode($continue));
			message('正在导出数据, 请不要关闭浏览器, 当前第 ' . $ctu['series'] . ' 卷.', create_url('site', array('name' => 'manager','do' => 'database','op'=>'display','ctu'=>$postctu)),'success');
		} else {
			message('数据已经备份完成', create_url('site', array('name' => 'manager','do' => 'database','op'=>'display')),'success');
		}
	}


 		 	
 		 	
 					include page('database');
}
 if($operation=='restore')
 {
	   	$ds = array();
	$path = WEB_ROOT . '/config/data_backup/';
	if (is_dir($path)) {
		if ($handle = opendir($path)) {
			while (false !== ($bakdir = readdir($handle))) {
				if($bakdir == '.' || $bakdir == '..') {
					continue;
				}
				if(preg_match('/^(?P<time>\d{10})_[a-z\d]{8}$/i', $bakdir, $match)) {
					$time = $match['time'];
					for($i = 1;;) {
						$last = $path . $bakdir . "/baijiacms-{$i}.sql";
						$i++;
						$next = $path . $bakdir . "/baijiacms-{$i}.sql";
						if(!is_file($next)) {
							break;
						}
					}
					if(is_file($last)) {
						$fp = fopen($last, 'r');
						fseek($fp, -27, SEEK_END);
						$end = fgets($fp);
						fclose($fp);
						if($end == '----Baijiacms MySQL Dump End'||$end == '---Baijiacms MySQL Dump End') {
							$row = array();
							$row['bakdir'] = $bakdir;
							$row['time'] = $time;
							$row['volume'] = $i - 1;
							
							$ds[$bakdir] = $row;
							continue;
						}
					}
				}
			}
		}
	}
					include page('database');
				}
				
							 if($operation=='torestore')
 {
 	
 	
 	
 	  	$ds = array();
	$path = WEB_ROOT . '/config/data_backup/';
	if (is_dir($path)) {
		if ($handle = opendir($path)) {
			while (false !== ($bakdir = readdir($handle))) {
				if($bakdir == '.' || $bakdir == '..') {
					continue;
				}
				if(preg_match('/^(?P<time>\d{10})_[a-z\d]{8}$/i', $bakdir, $match)) {
					$time = $match['time'];
					for($i = 1;;) {
						$last = $path . $bakdir . "/baijiacms-{$i}.sql";
						$i++;
						$next = $path . $bakdir . "/baijiacms-{$i}.sql";
						if(!is_file($next)) {
							break;
						}
					}
					if(is_file($last)) {
						$fp = fopen($last, 'r');
						fseek($fp, -27, SEEK_END);
						$end = fgets($fp);
						fclose($fp);
						if($end == '----Baijiacms MySQL Dump End'||$end == '---Baijiacms MySQL Dump End') {
							$row = array();
							$row['bakdir'] = $bakdir;
							$row['time'] = $time;
							$row['volume'] = $i - 1;
							
							$ds[$bakdir] = $row;
							continue;
						}
					}
				}
			}
		}
	}
 	
 	
 			$r = base64_decode($_GP['id']);
 				$path = WEB_ROOT . '/config/data_backup/';
		if(is_dir($path . $r)) {
		
		$row = $ds[$r];
			for($i = 1; $i <= $row['volume']; $i++) {
				$sql = file_get_contents($path . $row['bakdir'] . "/baijiacms-{$i}.sql");
				if(!empty($sql))
				{
				mysqld_batch($sql);
				}
			}
		message('还原成功！', create_url('site', array('name' => 'manager','do' => 'database','op'=>'restore')),'success');
		}
 			
 	
}
				
				
				 if($operation=='delete')
 {
 		$d = base64_decode($_GP['id']);

 			$path = WEB_ROOT . '/config/data_backup/';
		if(is_dir($path . $d)) {
			rmdirs($path . $d);
			message('备份删除成功！', create_url('site', array('name' => 'manager','do' => 'database','op'=>'restore')),'success');
		}
}