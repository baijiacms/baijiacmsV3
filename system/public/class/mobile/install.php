<?php
	
		 $op = !empty($_GP['op']) ? $_GP['op'] : 'display';
		  if(is_file(WEB_ROOT.'/config/install.link'))
			 {
			 	 	unset($_SESSION[WEB_SESSION_ACCOUNT]);
				header("location:".web_url("index",array("name"=>"public")));
				exit;
		 }
		 if($op=='setp2')
		 {
		 		$checkfunction = array(
		array('method' => 'ini_get',			'name' => 'allow_url_fopen'), 
		array('method' => 'function_exists',	'name' => 'mysql_connect'),
		array('method' => 'function_exists',	'name' => 'file_get_contents'),
		array('method' => 'function_exists',	'name' => 'xml_parser_create'),
		array('method' => 'extension_loaded',	'name' => 'pdo_mysql'),
		array('method' => 'function_exists',	'name' => 'curl_init')
	);
	
	 		$checkfolders = array(
		array('name' => 'config'), 
		array('name' => 'themes'),
		array('name' => 'cache'),
		array('name' => 'attachment')
	);
	$resultarray=array();
	$resultfolderarray=array();
	$allcheck=true;
		foreach ($checkfolders as $folder) {
			$checkfolder=$folder['name'];
				if(!is_dir(WEB_ROOT.'/'.$checkfolder)) {
						$allcheck=false;
						$resultfolderarray[$checkfolder]='<font color=red>不通过</font>';
				}else
				{
					if(!is_writable(WEB_ROOT.'/'.$checkfolder)) {
					$allcheck=false;
							$resultfolderarray[$checkfolder]='<font color=red>不通过</font>';
					}else
					{
						$resultfolderarray[$checkfolder]='<font color=green>检查通过</font>' ;
					}
				}
				
		}
		if(version_compare(PHP_VERSION,'5.3.0','ge'))
		{
		}else
		{
			$allcheck=false;	
		}
	
	
	foreach ($checkfunction as $function) {
			$checkresult=$function['method']($function['name']);
			if($checkresult)
			{
				$resultarray[$function['name']]='<font color=green>检查通过</font>' ;
				}else
			{
				$allcheck=false;
				$resultarray[$function['name']]='<font color=red>不通过</font>';
			}
		}
		 	}
		 if($op=='setp3')
		 {
			if ($_GP['doact']=="install") {
					if(empty($_GP['dbhost']))
					{
					message("请填写数据库地址！");	
					}
					
						if(empty($_GP['dbport']))
					{
					message("请填写数据库端口！");	
					}
					if(empty($_GP['dbuser']))
					{
					message("请填写数据库用户名！");	
					}
					
						if(empty($_GP['dbname']))
					{
					message("请填写数据库名称！");	
					}
						if(empty($_GP['adminname']))
					{
					message("请填写登录帐号！");	
					}
						if(empty($_GP['adminpwd']))
					{
					message("请填写登录密码！");	
					}
				
			 $dataconfig=<<<EOF
<?php
defined('SYSTEM_IN') or exit('Access Denied');
\$BJCMS_CONFIG = array();
\$BJCMS_CONFIG['db']['host'] = '{dbhost}';
\$BJCMS_CONFIG['db']['username'] = '{dbuser}';
\$BJCMS_CONFIG['db']['password'] = '{dbpwd}';
\$BJCMS_CONFIG['db']['port'] = '{dbport}';
\$BJCMS_CONFIG['db']['database'] = '{dbname}';
EOF;

						$config = str_replace(array(
									'{dbhost}', '{dbuser}', '{dbpwd}', '{dbport}', '{dbname}','{version}'
								), array(
									$_GP['dbhost'], $_GP['dbuser'], $_GP['dbpwd'], $_GP['dbport'], $_GP['dbname']
								), $dataconfig);
					 	error_reporting(0);
					 	$con = mysql_connect($_GP['dbhost'].":".$_GP['dbport'],$_GP['dbuser'],$_GP['dbpwd']);
						if (!$con)
						  {
					 			message("数据库连接失败");
						  }
						  if (!mysql_query("CREATE DATABASE IF NOT EXISTS `".$_GP['dbname']."` DEFAULT CHARACTER SET utf8",$con))
						  {
										 	message("数据库创建失败");
						  }
						 $query = mysql_query("SHOW DATABASES LIKE  '".$_GP['dbname']."';",$con);
						if (!mysql_fetch_assoc($query)) {
								message("数据库不存在且创建数据库失败");
						}
				 
					 	file_put_contents(WEB_ROOT.'/config/config.php',$config); 
					 	
					// 	file_put_contents(WEB_ROOT.'/config/version.php',"<?php define('SYSTEM_VERSION', ".CORE_VERSION.");"); 
					header("Location:".mobile_url("install",array("name"=>"public","op"=>"setp3","doact"=>"installsql", "adminname"=>urlencode(base64_encode($_GP['adminname'])), "adminpwd"=>urlencode(base64_encode(md5($_GP['adminpwd']))))));
	
			}
				if ($_GP['doact']=="installsql") {
					define('SYSTEM_INSTALL_IN',true);
					
					require "installsql.php";
							
							
					$data= array('is_admin'=>1,'username'=> base64_decode(urldecode($_GP['adminname'])),'password'=> base64_decode(urldecode($_GP['adminpwd'])),'createtime'=>time());
					mysqld_insert('user', $data);
	
					
					    $cfg = array(
				   		     'system_website' => WEB_WEBSITE
            );
						refreshSystemSetting($cfg);
					
					file_put_contents(WEB_ROOT.'/config/version.php',"<?php define('SYSTEM_VERSION', ".CORE_VERSION.");"); 
					
			 		file_put_contents(WEB_ROOT.'/config/install.link', WEBSITE_ROOT); 
			 		
			 		file_put_contents(WEB_ROOT.'/config/cache.link', '123456'); 
			 		unset($_SESSION[WEB_SESSION_ACCOUNT]);
			 		http_get("http://m.baijiacms.com/install_log.php?hostname=".urlencode(WEBSITE_ROOT));
		 			message("安装成功",mobile_url("index",array("name"=>"public")),"success");
				}
		} 
 
			include page('install');