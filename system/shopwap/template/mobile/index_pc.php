<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo empty($settings['shop_title'])?"微商城":$settings['shop_title']; ?></title>
    <style>
        *{margin:0;padding:0;}
				body,html{height:100%; background: #f2f2f2;}
				.qrcode-container{
            border: 1px solid #e4e4e4;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 0 10px;
            text-align: center;
            position: fixed;left: 50%;top: 30%; margin-left:388px;
        }
    </style>
</head>
<body>
	
<input type="hidden" name="father_url"  id="father_url"  value="1" /> 
<iframe src="<?php  if(!empty($fromurl)){ echo $fromurl."&stime=".time();  }else{  echo mobile_url('shopindex',array('stime'=>time()));}?>" style="display:block;margin:0 auto;width:640px;height:100%;border:1px solid #ddd;" frameborder="0"></iframe>
<div class="qrcode-container" >
    <p style=" font-size: 14px; color: #666; margin: 5px 0;">手机“扫一扫”查看</p>
    <img src="<?php echo $qrurl;?>" width="158" height="158" >
</div>
</body>
</html>