<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>
     <form method="post" class="form-horizontal" enctype="multipart/form-data" >
		<h3 class="header smaller lighter blue">短信设置</h3>

			
												<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 短信验证手机号</label>

										<div class="col-sm-9">
													   <input type="radio" name="regsiter_usesms" value="0" id="regsiter_usesms" <?php  if($settings['regsiter_usesms'] == 0) { ?>checked="true"<?php  } ?> /> 关闭  &nbsp;&nbsp;
             
              		  <input type="radio" name="regsiter_usesms" value="1" id="regsiter_usesms"  <?php  if($settings['regsiter_usesms'] == 1) { ?>checked="true"<?php  } ?> /> 开启
             <a href="https://market.aliyun.com/products/55530001/cmgj007933.html" target="_blank">申请地址</a>
											</div>
									</div>
		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 短信key：</label>

										<div class="col-sm-9">
										     <input type="text" name="sms_key" class="col-xs-10 col-sm-4" value="<?php  echo $settings['sms_key'];?>" />
										</div>
									</div>
									
									 
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 短信Secret：</label>

										<div class="col-sm-9">
                          <input type="text" name="sms_secret" class="col-xs-10 col-sm-4" value="<?php  echo $settings['sms_secret'];?>"/>
										</div>
									</div>
									<?php if(false){?>
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >验证码过期时间：(秒)</label>

										<div class="col-sm-9">
                          <input type="text" name="sms_secret_sec" class="col-xs-10 col-sm-4" value="<?php  echo $settings['sms_secret_sec'];?>"/>
										</div>
									</div>	<?php }?>
										  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 验证码多久可重发：(秒)</label>

										<div class="col-sm-9">
                          <input type="text" name="sms_secret_resec" class="col-xs-10 col-sm-4" value="<?php  echo $settings['sms_secret_resec'];?>"/>
										</div>
									</div>
									
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 一天同一个业务<br/>最多发送多少条短信：</label>

										<div class="col-sm-9">
                          <input type="text" name="sms_secret_count" class="col-xs-10 col-sm-4" value="<?php  echo $settings['sms_secret_count'];?>"/>
										</div>
									</div>
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 大鱼-用户注册验证码：</label>

										<div class="col-sm-9">
                          模板ID：<input type="text" name="sms_register_user"value="<?php  echo $settings['sms_register_user'];?>"/>，签名：<input type="text" name="sms_register_user_signname"  value="<?php  echo empty($settings['sms_register_user_signname'])?'注册验证':$settings['sms_register_user_signname'];?>"/>(不输入模板ID则该功能不启用)
										</div>
									</div>
									
									 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 大鱼-修改密码验证码<br/>(修改密码)：</label>

										<div class="col-sm-9">
                           模板ID：<input type="text" name="sms_change_pwd1" value="<?php  echo $settings['sms_change_pwd1'];?>"/>，签名：<input type="text" name="sms_change_pwd1_signname"  value="<?php  echo empty($settings['sms_change_pwd1_signname'])?'变更验证':$settings['sms_change_pwd1_signname'];?>"/>(不输入模板ID则该功能不启用)
										</div>
									</div>
									
										 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 大鱼-修改密码验证码<br/>(密码取回)：</label>

										<div class="col-sm-9">
                          模板ID：<input type="text" name="sms_change_pwd2" value="<?php  echo $settings['sms_change_pwd2'];?>"/>，签名：<input type="text" name="sms_change_pwd2_signname"  value="<?php  echo empty($settings['sms_change_pwd2_signname'])?'身份验证':$settings['sms_change_pwd2_signname'];?>"/>(不输入模板ID则该功能不启用)
										</div>
									</div>
									
										 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 大鱼-信息变更验证码</label>

										<div class="col-sm-9">
                          模板ID：<input type="text" name="sms_change_mobile" value="<?php  echo $settings['sms_change_mobile'];?>"/>，签名：<input type="text" name="sms_change_mobile_signname"  value="<?php  echo empty($settings['sms_change_mobile_signname'])?'变更验证':$settings['sms_change_mobile_signname'];?>"/>(不输入模板ID则该功能不启用)
										</div>
									</div>
									
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
                        
									<input name="submit" id="submit" type="submit" value="保存设置" class="btn btn-primary span3" />
										</div>
									</div>
              
				<h3 class="header smaller lighter blue">短信测试</h3>
				 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 大鱼-短信测试：</label>

										<div class="col-sm-9">
                         模板ID： <input type="text" name="sms_mobile_test" value="<?php  echo $settings['sms_mobile_test'];?>"/>，签名：<input type="text" name="sms_mobile_test_signname" value="<?php  echo empty($settings['sms_mobile_test_signname'])?'大鱼测试':$settings['sms_mobile_test_signname'];?>"/>
										</div>
									</div>
		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 测试手机号：</label>

										<div class="col-sm-9">
										     <input type="text" name="sms_test_tell" class="col-xs-10 col-sm-4" value="" />
										</div>
									</div>
									
										  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
                        
									<input name="smstest" id="submit" type="submit" value="发送测试" class="btn btn-primary span3" />
										</div>
									</div>

    </form>
 
<?php  include page('footer');?>