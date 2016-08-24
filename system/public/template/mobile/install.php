<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>百家CMS安装程序</title>
<link href="<?php echo RESOURCE_ROOT;?>/addons/public/install/install.css?x=20150530_23" rel="stylesheet" />
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-1.10.2.min.js"></script>
</head>
<body>
	<?php if( $op=="display"){?>
	
<div id="container">

<!-- Header -->
<div id="header" class="clearfix">
	<div id="PrestaShopLogo"></div>
</div>


<!-- List of steps -->
<div id="leftpannel">
	<ol id="tabs">
			<li ></li>
												<li class="selected">许可协议</li>
												<li>系统兼容性</li>
												<li>系统配置</li>
												<li>系统安装</li>
						</ol>
			
		</iframe>
	</div>

<!-- Page content -->
<form id="mainForm" action="" method="post">
<div id="sheets" class="sheet shown">
	<div id="sheet_license" class="sheet shown clearfix">
	<div class="contentTitle">
		<h1>安装助手</h1>
		<ul id="stepList_1" class="stepList clearfix">
							<li class="ok">许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
					</ul>
	</div>
	<noscript>
		<h4 class="errorBlock" style="margin-bottom:10px">
			您需要在浏览器中启用 JavaScript 来安装 
		</h4>
	</noscript>
<!-- License agreement -->
<h2 id="licenses-agreement">许可协议</h2>
<p><strong>请阅读下面的许可条款。</strong></p>
<div style="height:200px; border:1px solid #ccc; margin-bottom:8px; padding:5px; background:#fff; overflow: auto; overflow-x:hidden; overflow-y:scroll;">
<p>百家cms微商城遵循Apache2开源协议发布，并提供免费使用。</p>
	<p>百家CMS（微商城） 商标和著作权所有者为福州百家威信信息技术有限责任公司Apache Licence是著名的非盈利开源组织Apache采用的协议</p>
	<p>该协议和BSD类似，鼓励代码共享和尊重原作者的著作权，
允许代码修改，再作为开源或商业软件发布。需要满足
的条件：</p>
	<p>1、需要给代码的用户一份Apache Licence ；</p>
	<p>2、 如果你修改了代码，需要在被修改的文件中说明；</p>
<p>3、在延伸的代码中（修改和有源代码衍生的代码中）需要带有原来代码中的协议，商标，专利声明和其他原来作者规定需要包含的说明；</p>
<p>4、如果再发布的产品中包含一个Notice文件，则在Notice文件中需要带有本协议内容。</p>
<p>5、你可以在Notice中增加自己的许可，但不可以表现为对Apache Licence构成更改。 具体的协议参考：http://www.apache.org/licenses/LICENSE-2.0</p>
<h3>有限担保和免责声明：</h3>
<p>1、本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。</p>
<p>2、用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，我们不承诺对免费用户提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。</p>
<p>3、电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和等同的法律效力。您一旦开始确认本协议并安装本程序，即被视为完全理解并接受本协议的各项条款，在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。</p>
<p>4、本合同最终解释权归福州百家威信信息技术有限责任公司所有。</p>
</div>

<div>
	<input type="checkbox" id="set_license" class="required" name="licence_agrement" value="1" style="vertical-align: middle;float:left"  />
	<div style="float:left;width:600px;margin-left:8px"><label for="set_license"><strong>我同意上述条款和条件。</strong></label></div>
</div>

	</div><!-- div id="sheet_step" -->
</div><!-- div id="sheets" -->

<div id="buttons">
						<input id="btNext" class="button little" type="button" onClick="location.href='<?php echo mobile_url("install",array("name"=>"public","op"=>"setp2"))?>';" name="submitNext" value="下一个" style="float: left" />
			
	</div>
</form>


<script>
	$(document).ready(function()
{
	// Desactivate next button if licence checkbox is not checked
	if (!$('#set_license').prop('checked'))
	{
		$('#btNext').addClass('disabled').attr('disabled', true);
	}
	
	// Activate / desactivate next button when licence checkbox is clicked
	$('#set_license').click(function()
	{
		if ($(this).prop('checked'))
			$('#btNext').removeClass('disabled').attr('disabled', false);
		else
			$('#btNext').addClass('disabled').attr('disabled', true);
	});
	
	if ($('#set_license').prop('checked'))
		$('#btNext').removeClass('disabled').attr('disabled', false);
	else
		$('#btNext').addClass('disabled').attr('disabled', true);
});
	</script>
	
<?php }?>
<?php if( $op=="setp2"){?>


<div id="container">

<!-- Header -->
<div id="header" class="clearfix">
	<div id="PrestaShopLogo"></div>
</div>


<!-- List of steps -->
<div id="leftpannel">
	<ol id="tabs">
			<li ></li>
												<li class="finished"><a href="<?php echo mobile_url("install",array("name"=>"public"))?>">许可协议</a></li>
												<li  class="selected">系统兼容性</li>
												<li>系统配置</li>
												<li>系统安装</li>
						</ol>
			
		</iframe>
	</div>

<!-- Page content -->
<form id="mainForm" action="" method="post">
<div id="sheets" class="sheet shown">
	<div id="sheet_license" class="sheet shown clearfix">
	<div class="contentTitle">
		<h1>安装助手</h1>
		<ul id="stepList_1" class="stepList clearfix">
							<li class="ok">许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
							<li >许可协议</li>
					</ul>
	</div>
	<noscript>
		<h4 class="errorBlock" style="margin-bottom:10px">
			您需要在浏览器中启用 JavaScript 来安装 
		</h4>
	</noscript>
<!-- License agreement -->
<h2>程序依赖环境检查</h2>



<div class="field clearfix">
		<label  class="aligned">PHP版本(最低PHP 5.3)： </label>
		<div class="contentinput">
		<?php echo (version_compare(PHP_VERSION,'5.3.0','ge'))?'<font color=green>检查通过</font>':'<font color=red>PHP '.PHP_VERSION.'不通过</font>'; ?>
		</div>
			</div>

<div class="field clearfix">
		<label  class="aligned">config文件夹读写： </label>
		<div class="contentinput">
		<?php echo $resultfolderarray['config']; ?></div>
			</div>
			<div class="field clearfix">
		<label  class="aligned">themes文件夹读写： </label>
		<div class="contentinput">
		<?php echo $resultfolderarray['themes']; ?></div>
			</div>
			
						<div class="field clearfix">
		<label  class="aligned">cache文件夹读写： </label>
		<div class="contentinput">
		<?php echo $resultfolderarray['cache']; ?></div>
			</div>
		<div class="field clearfix">
		<label  class="aligned">attachment文件夹读写： </label>
		<div class="contentinput">
		<?php echo $resultfolderarray['attachment']; ?></div>
			</div>
			
			<div class="field clearfix">
		<label  class="aligned">pdo_mysql： </label>
		<div class="contentinput">
		<?php echo $resultarray['pdo_mysql']; ?></div>
			</div>
			
					<div class="field clearfix">
		<label  class="aligned">pdo_mysql： </label>
		<div class="contentinput">
		<?php echo $resultarray['pdo_mysql']; ?></div>
			</div>
			
				<div class="field clearfix">
		<label  class="aligned">allow_url_fopen： </label>
		<div class="contentinput">
		<?php echo $resultarray['allow_url_fopen']; ?></div>
			</div>
			
					<div class="field clearfix">
		<label  class="aligned">file_get_contents： </label>
		<div class="contentinput">
		<?php echo $resultarray['file_get_contents']; ?></div>
			</div>
			
				<div class="field clearfix">
		<label  class="aligned">xml_parser_create： </label>
		<div class="contentinput">
		<?php echo $resultarray['xml_parser_create']; ?></div>
			</div>
			
				<div class="field clearfix">
		<label  class="aligned">curl_init： </label>
		<div class="contentinput">
		<?php echo $resultarray['curl_init']; ?></div>
			</div>
    	

	</div><!-- div id="sheet_step" -->
</div><!-- div id="sheets" -->

<div id="buttons">
						
	<?php if( $allcheck){?>
<input id="btNext" class="button little" type="button" onClick="location.href='<?php echo mobile_url("install",array("name"=>"public","op"=>"setp3"))?>';" name="submitNext" value="下一个" style="float:left"  /><?php }else{?><br/>
<strong style="color:red">请解决环境问题后，刷新此页面，进行下一步操作。</strong>
<?php }?>
	</div>
</form>








<?php }?>
	<?php if( $op=="setp3"){?>
	

<div id="container">

<!-- Header -->
<div id="header" class="clearfix">
	<div id="PrestaShopLogo"></div>
</div>


<!-- List of steps -->
<div id="leftpannel">
	<ol id="tabs">
			<li ></li>
												<li class="finished"><a href="<?php echo mobile_url("install",array("name"=>"public"))?>">许可协议</a></li>
												<li  class="finished">系统兼容性</li>
												<li class="selected">系统配置</li>
												<li>系统安装</li>
						</ol>
			
		</iframe>
	</div>

<!-- Page content --><!-- Page content -->
<form id="mainForm" method="post">
<div id="sheets" class="sheet shown">
	<div id="sheet_database" class="sheet shown clearfix">
	<div class="contentTitle">
		<h1>安装助手</h1>
		<ul id="stepList_1" class="stepList clearfix">
							<li class="ok">系统配置</li>
							<li class="ok">系统配置</li>
							<li class="ok">系统配置</li>
							<li class="ok">系统配置</li>
							<li >系统配置</li>
							<li >系统配置</li>
					</ul>
	</div>
	<noscript>
		<h4 class="errorBlock" style="margin-bottom:10px">
			您需要在浏览器中启用 JavaScript 来安装 PrestaShop。			<a href="http://enable-javascript.com/" target="_blank">
				<img src="theme/img/help.png" style="height:16px;width:16px" />
			</a>
		</h4>
	</noscript>
<!-- Database configuration -->
<div id="dbPart">
	<h2>基础配置</h2>	<div id="formCheckSQL">
			<p class="first">
			<label for="adminpwd">授权域名 </label>
			<?php echo WEB_WEBSITE;?>
		</p>
		<p class="first">
			<label for="adminname">商户管理员账户 </label>
			<input name="adminname" type="text" class="text" id="adminname"  value="" />
		</p>
			<p class="first">
			<label for="adminpwd">登录密码 </label>
			<input name="adminpwd" type="text" class="text" id="adminpwd"  value="" />
		</p>
				
	<h2>填写以下字段配置数据库</h2>
		<p class="first" >
			<label for="dbhost">数据库服务器地址 </label>
			<input name="dbhost" type="text" class="text" id="dbhost"  value="" />
		</p>
				<p class="first" >
			<label for="dbport">数据库服务器端口 </label>
		<input size="10" class="text" type="text" id="dbport" name="dbport" value="3306" />
			<span class="userInfos aligned">默认端口为3306。</span>
		</p>
		<p>
			<label for="dbName">数据库名称 </label>
			<input size="10" class="text" type="text" id="dbname" name="dbname" value="baijiacms" />
		</p>
		<p>
			<label for="dbuser">数据库登录名 </label>
			<input class="text" size="10" type="text" id="dbuser" name="dbuser" value="root" />
		</p>
		<p>
			<label for="dbpwd">数据库密码 </label>
			<input class="text" size="10" type="text" id="dbpwd" name="dbpwd" value="" />
		</p>

					<p id="dbResultCheck" style="display: none;"></p>
			</div>
</div>

	</div><!-- div id="sheet_step" -->
</div><!-- div id="sheets" -->

<div id="buttons">  	<input name="doact" type="hidden"  value="install"  />
						<input id="btNext" class="button little" type="submit" name="submitNext" value="下一个" />
			
	</div>
</form>


	<?php }?>
	</div>
	<ul id="footer">
<li>&copy; 福州百家cms信息技术有限责任公司</li>
</ul>

</body>
</html>
