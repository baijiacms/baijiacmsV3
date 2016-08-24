<?php defined('SYSTEM_IN') or exit('Access Denied');?><!DOCTYPE html><!DOCTYPE html>
<html class="no-focus">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
	<title><?php  echo empty($settings['shop_title'])?'':$settings['shop_title'];?></title>
<meta name="description" content="<?php  echo empty($settings['shop_description'])?'':$settings['shop_description'];?>" />
<meta name="keywords" content="<?php  echo empty($settings['shop_keyword'])?'':$settings['shop_keyword'];?>">
	<link href="<?php echo RESOURCE_ROOT;?>/addons/common/fontawesome3/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/common/bootstrap3/css/bootstrap.min.css">
		<script src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-1.10.2.min.js"></script>
		
			<!--[if lt IE 9]>
		<script src="<?php echo RESOURCE_ROOT;?>/addons/common/js/html5shiv.min.js"></script>
		<script src="<?php echo RESOURCE_ROOT;?>/addons/common/js/respond.min.js"></script>
	<![endif]-->
	
    <link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/public/login/cvs.css">
	<link href="<?php echo RESOURCE_ROOT;?>/addons/public/login/lost.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/public/login/jcommonp.min.css">



	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	</script>

</head>
<body>
<style>
	body{
		background: url('<?php echo RESOURCE_ROOT;?>/addons/public/login/001.jpg');
		background-repeat:no-repeat; 
		background-size:cover;
	}
	.bg-white{
		  background-color: rgba(255, 255, 255, 0.81);
	}
	.text-muted {
  color: #565656;
}
</style>
<div class="bg-white pulldown">
	<div class="content content-boxed overflow-hidden">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				<div class="push-10-t push-10 animated fadeIn">

					<div class="text-center">
&nbsp;
					</div>


					<form class="form-horizontal push-5-t" target="_parent" action="<?php  echo mobile_url('login',array('name'=>'public'))?>" method="post" role="form" >
						<div class="form-group">
							<label class="col-xs-12" for="login1-username">请输入用户名登录</label>
							<div class="col-xs-12">
								<input class="form-control" type="text" id="login1-username" name="username"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<label class="col-xs-12" for="login1-password">请输入登录密码</label>
							<div class="col-xs-12">
								<input class="form-control" type="password" id="login1-password" name="password"  autocomplete="off">
							</div>
						</div>
								<div class="form-group">
							<label class="col-xs-12" for="login1-password">验证码</label>
							<div class="col-xs-12">
								<input class="form-control" type="text" id="login1-password" name="verify"  autocomplete="off">
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<label class="css-input switch switch-sm switch-primary">
											<img id="verifyimg" onClick="fleshVerify()"  alt="点击切换" src="<?php  echo mobile_url('verify',array('name'=>'public'))?>" style="cursor:pointer;width:220px;height:50px"/>
		
								</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12" style="text-align: right;">
								<input class="btn btn-sm btn-primary" type="submit" name="submit" value="登 录" >
								</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>



<script>
	function fleshVerify(){
	var verifyimg = $("#verifyimg").attr("src");
	if( verifyimg.indexOf('?')>0){
                    $("#verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $("#verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
	}
</script>


</body>
</html>