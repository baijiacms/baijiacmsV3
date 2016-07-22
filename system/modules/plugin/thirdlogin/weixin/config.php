<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">微信登录配置</h3>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 触发方式：</label>

										<div class="col-sm-9">
													微信端访问
										</div>
									</div>
 
 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 微信公众号AppId：</label>

										<div class="col-sm-9">
											<?php  echo $settings['weixin_appId'];?> &nbsp&nbsp;&nbsp;<a href="<?php  echo create_url('site', array('name' => 'weixin','do' => 'setting'))?>" style="font-size:16px"><strong>修改</strong></a>
										</div>
									</div>

 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 微信公众号AppSecret：</label>

										<div class="col-sm-9">
													<?php  echo $settings['weixin_appSecret'];?>
										</div>
									</div>


		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 启 动  " class="btn btn-info"/>
										
										</div>
									</div> 

		</form>

<?php  include page('footer');?>