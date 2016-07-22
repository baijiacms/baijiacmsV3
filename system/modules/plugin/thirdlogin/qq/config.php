<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">QQ快捷登录配置</h3>
 
    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
  
     <table class="table table-hover">
            <tr>
                <th style="width:150px">APP ID:</th>
                <td>
                 <input type="text" name="thirdlogin_qq_appid" value="<?php  echo $configs['thirdlogin_qq_appid'];?>" />
               
                </td>
            </tr>
                <tr>
                <th style="width:150px">App Key:</th>
                <td>
                   <input type="text" name="thirdlogin_qq_appkey" value="<?php  echo $configs['thirdlogin_qq_appkey'];?>" />
                </td>
            </tr>
                  <tr>
                <th style="width:150px">申请地址:</th>
                <td>
                
                <a href="http://connect.qq.com/intro/login/"  target="_blank">申请地址</a>
                </td>
            </tr>   
                 <tr>
          <th style="width:150px"></th>
          <td>
              <input type="submit" name="submit" value=" 确定 " class="btn btn-primary" />&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="reset" value=" 重置 " class="btn btn-default" />
          </td>
        </tr>
        </table>
			
		</form>
<?php  include page('footer');?>