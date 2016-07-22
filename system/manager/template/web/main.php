<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=10" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>开源版多商户管理系统</title>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
   
  <link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/main/main.css">
<script src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-1.10.2.min.js"></script>

</head>
<body class="cp-bodybox">
<!--[if lt IE 9]>
<div class="alert alert-danger disable-del txtCenter" id="tipLowIEVer">
    <h4>系统检测到您使用的浏览器版本过低，为达到更好的体验效果请升级您的浏览器，我们为您推荐：</h4>
    <p>
        <a href="https://www.google.com.hk/chrome/" target="_blank">Chrome浏览器</a>
        <a href="http://www.firefox.com.cn/download/" target="_blank">Firefox浏览器</a>
    </p>
</div>
<![endif]-->

<div class="header">
    <div class="inner clearfix">
        <div class="fl">	<?php if(!empty($settings['admin_logo'])){ ?>
            <a  class="header-logo"><img src="<?php echo ATTACHMENT_WEBROOT;?><?php echo $settings['admin_logo'];?>" style="width:180px;height:53px"></a>
           <?php  }?>
        </div>
        <!-- end logo -->
		
        <div class="header-nav fl">
            <ul class="header-nav-list clearfix"> 	<li class="fl active"><a href="<?php  echo create_url('site',array('name' => 'manager','do' => 'main','smenu'=>'manager_setting'))?>" >系统配置</a></li>                
          
            </ul>
        </div>
        <!-- end header-nav -->

        <div class="fr">
           <ul class="header-nav-list clearfix">
             
               <li class="fl"><a href="<?php  echo create_url('site',array('name' => 'manager','do' => 'changepwd'))?>" target="main" >修改密码</a></li>
              <li class="fl"><a href="<?php  echo create_url('mobile',array('name' => 'public','do' => 'logout'))?>"  >退出系统</a></li>
             
              
            </ul>
        </div>
        <span class="header-welcome fr ">
            <a >欢迎，<?php echo $_CMS[WEB_SESSION_ACCOUNT]['username']; ?>&nbsp;</a>
                    </span>
        <!-- end list -->
	
        <!-- end header-welcome -->
    </div>
</div>
<!-- end header -->

<div class="container" style="padding-top: 3px;">
<div class="inner clearfix" style="min-width: 1200px;width:99%;">
<div class="content-left fl" >

          	  <?php   require "smenu_manager_setting.php";?> 
          	  
          	  
         
          	  </div>
<!-- end content-left -->

<!--
<h1 class="content-right-title">标题</h1>-->
<iframe class="content-right fl" scrolling="yes"  frameborder="0" style="min-height:660px;overflow:visible; height:100%;"   name="main" id="iframepage" src="<?php  echo create_url('site', array('name' => 'manager','do' => 'store','op'=>'display'))?>"></iframe>

<!-- end content-right -->
</div>
</div>
<!-- end container -->

<!--gonggao-->
<div class="footer"><?php echo SAPP_NAME ?>(<?php echo SYSTEM_VERSION ?>)</div>
<!-- end footer -->

<script language="javascript">
  
     $(function(){
            // 首页竖线到底
            var height1=$(".content-right").height();
            var height2=$(".content-left").height();
            if(parseInt(height1) < parseInt(height2)){
                $(".content-right").css({'min-height': height2});
                 $('#iframepage').css('height', height2 + 'px');
            };
            
          });
</script>

</body>