<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
<meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" id="viewport" name="viewport">
<meta name="format-detection" content="telephone=no" />

<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <title><?php echo empty($settings['shop_title'])?"微商城":$settings['shop_title']; ?></title>
         <meta name="Description" content="<?php  echo $settings['shop_description'];?>"/> 
    <style>
        *{margin:0;padding:0;}
	    .iframe-holder {  
      position: fixed;   
      right: 0;   
      bottom: 0;   
      left: 0;  
      top: 0;  
      -webkit-overflow-scrolling: touch;  
      overflow-y: scroll;  
    }  
      
    .iframe-holder iframe {  
      height: 100%;  
      width: 100%;  
    }  
    </style>

</head>
<body>
	<div id='wx_pic' style='margin:0 auto;display:none;'>
 <img src="<?php echo ATTACHMENT_WEBROOT.$settings['weixin_logo'];?>" style="width:300px;height:300px" >
</div>
<input type="hidden" name="father_url"  id="father_url"  value="<?php  echo $isfather;?>" /> 
<div class="iframe-holder">
	<iframe  src="<?php  if(!empty($fromurl)){ echo $fromurl."&stime=".time();  }else{  echo mobile_url('shopindex',array('stime'=>time()));}?>" width="100%" height="100%" scrolling="yes" frameborder="0"></iframe>

</div>
</body>
</html>