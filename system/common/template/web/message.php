<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="telephone=no, address=no" name="format-detection">
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding:0 0 48px;margin:150px auto;width:90%;}
.system-message h3{ font-size: 50px; font-weight: normal; line-height: 120px; margin-bottom: 12px;border:1px solid #ccc}
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 23px ;text-align: center;}
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
	<div style="padding:24px;">
				
		<div class="error"><img style="margin-right: 9px;padding-top:10px;" src="<?php echo RESOURCE_ROOT;?>/addons/common/image/<?php  if($type=='success') { ?>success.png<?php  } else if($type=='error') { ?>error.png<?php  } else if($type=='tips') { ?>success.png<?php  } else if($type=='sql') { ?>error.png<?php  } ?>" style="cursor:pointer;"><span style="padding-top:0px;"><?php  echo $msg;?></div>	
	</div>
<p class="detail"></p>
<div class="jump" style="float:right;padding-right:5px;">
	<?php  if($redirect) { ?>
		<?php  if($successAutoNext) { ?>
页面自动 <a id="href" href="<?php  echo $redirect;?>">跳转</a> 等待时间： <b id="wait">2</b>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
<?php  } else { ?>
 <p>[<strong><a id="href" href="<?php  echo $redirect;?>">点击进入下一页</b>]</strong></p>
		<?php  } ?>
<?php  } else { ?>
<p>[<a href="javascript:history.go(-1);">点击这里返回上一页</a>] </p>
	<?php  } 
	?>
</div>
</div>

</body>
</html>
