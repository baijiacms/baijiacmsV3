<?php
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.baijiacms.com All rights reserved.
// +----------------------------------------------------------------------
// | Comments: mysql数据库操作
// +----------------------------------------------------------------------
// | Author: baijiacms <http://www.baijiacms.com>
// +----------------------------------------------------------------------
defined('SYSTEM_IN') or exit('Access Denied');
$BJCMS_CONFIG=array();
require WEB_ROOT."/config/config.php";
$bjconfig=$BJCMS_CONFIG;
if(empty($bjconfig['db']['host']))
{
	$bjconfig['db']['host'] = '';
}
if(empty($bjconfig['db']['username']))
{
	$bjconfig['db']['username'] = '';
}
if(empty($bjconfig['db']['password']))
{
	$bjconfig['db']['password'] = '';	
}
if(empty($bjconfig['db']['port']))
{
	$bjconfig['db']['port'] = '';
}
if(empty($bjconfig['db']['database']))
{
	$bjconfig['db']['database'] = '';
}
$bjconfig['db']['charset'] = 'utf8';
$_CMS['dbconfig'] = $bjconfig;
	
function mysqldb() {
	global $_CMS;
	static $db;
	if(empty($db)) {
		$db = new PdoUtil($_CMS['dbconfig']['db']);
	}
	$_CMS['dbconfig']['db']="";
	return $db;
}

function mysqld_query($sql, $params = array()) {
	return mysqldb()->query($sql, $params);
}


function mysqld_select($sql, $params = array()) {
	return mysqldb()->fetch($sql, $params);
}

function mysqld_selectcolumn($sql, $params = array(), $column = 0) {
	return mysqldb()->fetchcolumn($sql, $params, $column);
}

function mysqld_selectall($sql, $params = array(), $keyfield = '') {
	return mysqldb()->fetchall($sql, $params, $keyfield);
}

function mysqld_update($table, $data = array(), $params = array(), $orwith = 'AND') {
	if(DATA_PROTECT&&empty($params))
	{
	message('数据保护，请联系管理员');
	}
	if($params=='empty')
	{
	$params=array();	
	}
	return mysqldb()->update($table, $data, $params, $orwith);
}

function mysqld_insert($table, $data = array(), $es = FALSE) {
	
	return mysqldb()->insert($table, $data, $es);
}


function mysqld_delete($table, $params = array(), $orwith = 'AND') {
		if(DATA_PROTECT&&empty($params))
	{
	message('数据保护，请联系管理员');
	}
		if($params=='empty')
	{
	$params=array();	
	}
	return mysqldb()->delete($table, $params, $orwith);
}

function mysqld_insertid() {
	return mysqldb()->insertid();
}


function mysqld_batch($sql) {
	return mysqldb()->excute($sql);
}

function mysqld_fieldexists($tablename, $fieldname = '') {
	return mysqldb()->fieldexists($tablename, $fieldname);
}

function mysqld_indexexists($tablename, $indexname = '') {
	return mysqldb()->indexexists($tablename, $indexname);
}

class PdoUtil {
	private $dbo;
	private $cfg;
	public function __construct($cfg) {
		global $_CMS;
		if(empty($cfg)) {
			exit("无法读取/config/config.php数据库配置项.");
		}
		$mysqlurl = "mysql:dbname={$cfg['database']};host={$cfg['host']};port={$cfg['port']}";
		try { 
		$this->dbo = new PDO($mysqlurl, $cfg['username'], $cfg['password']);
		} catch (PDOException $e) { 
		message("数据库连接失败，请检查数据库配置:/config/config.php");
		} 
		
		$sql = "SET NAMES '{$cfg['charset']}';";
		$this->dbo->exec($sql);
		$this->dbo->exec("SET sql_mode='';");
		$this->cfg = $cfg;
		if(SQL_DEBUG) {
			$this->debug($this->dbo->errorInfo());
		}
	}

	public function query($sql, $params = array()) {
		if (empty($params)) {
			$result = $this->dbo->exec($sql);
			if(SQL_DEBUG) {
				$this->debug($this->dbo->errorInfo());
			}
			return $result;
		}
		$statement = $this->dbo->prepare($sql);

		$result = $statement->execute($params);
		if(SQL_DEBUG) {
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			return $statement->rowCount();
		}
	}

	public function fetchcolumn($sql, $params = array(), $column = 0) {
		$statement = $this->dbo->prepare($sql);
		$result = $statement->execute($params);
		if(SQL_DEBUG) {
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			return $statement->fetchColumn($column);
		}
	}

	public function fetch($sql, $params = array()) {
		$statement = $this->dbo->prepare($sql);
		$result = $statement->execute($params);
		if(SQL_DEBUG) {	
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			return $statement->fetch(pdo::FETCH_ASSOC);
		}
	}

	public function fetchall($sql, $params = array(), $keyfield = '') {
		$statement = $this->dbo->prepare($sql);
		$result = $statement->execute($params);
		if(SQL_DEBUG) {
			$this->debug($statement->errorInfo());
		}
		if (!$result) {
			return false;
		} else {
			if (empty($keyfield)) {
				return $statement->fetchAll(pdo::FETCH_ASSOC);
			} else {
				$temp = $statement->fetchAll(pdo::FETCH_ASSOC);
				$rs = array();
				if (!empty($temp)) {
					foreach ($temp as $key => &$row) {
						if (isset($row[$keyfield])) {
							$rs[$row[$keyfield]] = $row;
						} else {
							$rs[] = $row;
						}
					}
				}
				return $rs;
			}
		}
	}
	public function update($table, $data = array(), $params = array(), $orwith = 'AND') {
		$fields = $this->splitForSQL($data, ',');
		$condition = $this->splitForSQL($params, $orwith);
		$params = array_merge($fields['params'], $condition['params']);
		$sql = "UPDATE " . $this->table($table) . " SET {$fields['fields']}";
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return $this->query($sql, $params);
	}

	public function insert($table, $data = array(), $es = FALSE) {
		$condition = $this->splitForSQL($data, ',');
		return $this->query("INSERT INTO " . $this->table($table) . " SET {$condition['fields']}", $condition['params']);
	}

	public function insertid() {
		return $this->dbo->lastInsertId();
	}

	public function delete($table, $params = array(), $orwith = 'AND') {
		$condition = $this->splitForSQL($params, $orwith);
		$sql = "DELETE FROM " . $this->table($table);
		$sql .= $condition['fields'] ? ' WHERE '.$condition['fields'] : '';
		return $this->query($sql, $condition['params']);
	}
	private function splitForSQL($params, $orwith = ',') {
		$result = array('fields' => ' 1 ', 'params' => array());
		$split = '';
		$suffix = '';
		if (in_array(strtolower($orwith), array('and', 'or'))) {
			$suffix = '__';
		}
		if (!is_array($params)) {
			$result['fields'] = $params;
			return $result;
		}
		if (is_array($params)) {
			$result['fields'] = '';
			foreach ($params as $fields => $value) {
				$result['fields'] .= $split . "`$fields` =  :{$suffix}$fields";
				$split = ' ' . $orwith . ' ';
				$result['params'][":{$suffix}$fields"] = is_null($value) ? '' : $value;
			}
		}
		return $result;
	}

	public function excute($sql, $stuff = 'baijiacms_') {
		if(!isset($sql) || empty($sql)) return;

		$sql = str_replace("\r", "\n", str_replace(' ' . $stuff, ' baijiacms_', $sql));
		$sql = str_replace("\r", "\n", str_replace(' `' . $stuff, ' `baijiacms_' , $sql));
		$ret = array();
		$num = 0;
		foreach(explode(";\n", trim($sql)) as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			foreach($queries as $query) {
				$ret[$num] .= (isset($query[0]) && $query[0] == '#') || (isset($query[1]) && isset($query[1]) && $query[0].$query[1] == '--') ? '' : $query;
			}
			$num++;
		}
		unset($sql);
		foreach($ret as $query) {
			$query = trim($query);
			if($query) {
				$this->query($query);
			}
		}
	}

	public function fieldexists($tablename, $fieldname) {
		$isexists = $this->fetch("DESCRIBE " . $this->table($tablename) . " `{$fieldname}`");
		return !empty($isexists) ? true : false;
	}

	public function indexexists($tablename, $indexname) {
		if (!empty($indexname)) {
			$indexs = mysqld_selectall("SHOW INDEX FROM " . $this->table($tablename));
			if (!empty($indexs) && is_array($indexs)) {
				foreach ($indexs as $row) {
					if ($row['Key_name'] == $indexname) {
						return true;
					}
				}
			}
		}
		return false;
	}

	public function table($table) {
		return "`baijiacms_{$table}`";
	}

	public function debug($errors ) {
		if (!empty($errors[1])&&!empty($errors[1])&&$errors[1]!='00000') {
		//	print_r($errors);
		message($errors[2]);
		}
		return $errors;
	}
}

function table($table) {
	return "`baijiacms_{$table}`";
}