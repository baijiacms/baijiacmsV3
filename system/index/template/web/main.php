<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=10" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $system_store['sname']?>店铺管理后台</title>
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
        <div class="fl">
        	   	<?php if(!empty($settings['admin_logo'])){ ?>
           <img src="<?php echo ATTACHMENT_WEBROOT;?><?php echo $settings['admin_logo'];?>" style="width:180px;height:53px">
           <?php  }?> 
        </div>
        <!-- end logo -->
		
        <div class="header-nav fl" style="margin-left:3px">
            <ul class="header-nav-list clearfix">
                     	<li class="fl <?php if(empty($_GP['smenu'])||"shop"==$_GP['smenu']){ ?>active<?php   }?>"><a href="<?php  echo create_url('site',array('name' => 'index','do' => 'main','smenu'=>'shop'))?>" >商城</a></li>      
                      	              	              	
                  <?php if(!empty($modulelist)&&count($modulelist)>0){?><li class="fl <?php if("extends"==$_GP['smenu']){ ?>active<?php   }?>"><a href="<?php  echo create_url('site',array('name' => 'index','do' => 'main','smenu'=>'extends'))?>" >扩展</a></li>  <?php   }?>
              	<li class="fl <?php if("setting"==$_GP['smenu']){ ?>active<?php   }?>"><a href="<?php  echo create_url('site',array('name' => 'index','do' => 'main','smenu'=>'setting'))?>" >配置</a></li>                
          
            </ul>
        </div>
        <!-- end header-nav -->

        <div class="fr">
           <ul class="header-nav-list clearfix">
          
             <li class="fl">
    <a   href="<?php  echo WEBSITE_ROOT.'index_pc.php';?>" target="_blank">
        <span>PC端商城</span>
    </a> 
</li>
<li class="fl">
    <a   href="<?php  echo WEBSITE_ROOT.'index.php';?>" target="_blank">
        <span>移动端商城</span>
    </a> 
</li>

             
             
             <?php if (!empty($_CMS[WEB_SESSION_ACCOUNT])&&empty($_CMS[WEB_SESSION_ACCOUNT]['is_system'])&&empty($_CMS[WEB_SESSION_ACCOUNT]['is_compuser'])&&empty($_CMS[WEB_SESSION_ACCOUNT]['is_saler'])) { ?>
               <li class="fl"><a href="<?php  echo create_url('site',array('name' => 'index','do' => 'changepwd'))?>" target="main" >修改密码</a></li>
                      
              <li class="fl"><a href="<?php  echo create_url('mobile',array('name' => 'public','do' => 'logout'))?>"  >退出系统</a></li>
                   <?php }else{ ?> 
                   
                    <?php if (!empty($_CMS[WEB_SESSION_ACCOUNT])&&!empty($_CMS[WEB_SESSION_ACCOUNT]['is_system'])) { ?>
                    
                    <li class="fl"><a href="<?php  echo create_url('site',array('name' => 'manager','do' => 'main'))?>" >返回总店管理</a></li>
              
             <?php } ?>
             
                <?php if (!empty($_CMS[WEB_SESSION_ACCOUNT])&&!empty($_CMS[WEB_SESSION_ACCOUNT]['is_compuser'])) { ?>
                    
                    <li class="fl"><a href="<?php  echo create_url('site',array('name' => 'compmanger','do' => 'main'))?>"  >返回分公司管理</a></li>
              
             <?php } ?>
             
                <?php if (!empty($_CMS[WEB_SESSION_ACCOUNT])&&!empty($_CMS[WEB_SESSION_ACCOUNT]['is_saler'])) { ?>
                    
                    <li class="fl"><a href="<?php  echo create_url('site',array('name' => 'saler','do' => 'main'))?>"  >返回销售员管理</a></li>
              
             <?php } ?>
                     <?php } ?>
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
<div class="content-left fl">
  
   
          	
          	  	<?php if(empty($_GP['smenu'])||"shop"==$_GP['smenu']){ ?>
          	  <?php   require "smenu_shop.php";?> 
          	  <?php   }?> 
          	  
          
          	  
          	  
          	  	<?php if("setting"==$_GP['smenu']){ ?>
          	  <?php   require "smenu_setting.php";?> 
          	  <?php   }?> 
          	  
          	  <?php if("extends"==$_GP['smenu']){ ?>
          	  <?php   require "smenu_extends.php";?> 
          	  <?php   }?> 
          	  
         
          	  </div>
<!-- end content-left -->

 
<!--
<h1 class="content-right-title">标题</h1>-->
<iframe class="content-right fl" scrolling="yes"  frameborder="0" style="min-height:660px;overflow:visible; height:100%;"   name="main" id="iframepage" src="
          	
          	  	<?php if(empty($_GP['smenu'])||"shop"==$_GP['smenu']){ ?><?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -99))?><?php   }?> 
          	  
          	  	
          	       
          	  
          	  	<?php if("setting"==$_GP['smenu']){ ?><?php  echo create_url('site', array('name' => 'shop','do' => 'config'))?><?php   }?> "></iframe>

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