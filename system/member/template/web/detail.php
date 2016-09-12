<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">会员信息</h3>


 <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
		<input type="hidden" name="openid" value="<?php  echo $member['openid'];?>">
		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 用户UID：</label>

										<div class="col-sm-9">
											<?php  echo $member['openid'];?>
										</div>
									</div>
										<?php if(!empty($color)){ ?>
									     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >彩之云端用户ID：</label>

										<div class="col-sm-9">
												<?php  echo $color['userid'];?>
										</div>
									</div>
									<?php } ?>
										  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 微信OPENID:</label>

										<div class="col-sm-9">
											<?php  echo $weixininfo['weixin_openid'];?>
										</div>
									</div>
		       <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 用户名：</label>

										<div class="col-sm-9">
												<input type="text" name="realname" id="realname"  class="col-xs-10 col-sm-2"  value="<?php  echo $member['realname'];?>" />
										</div>
									</div>
								
				       <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 联系电话：</label>

										<div class="col-sm-9">
												<input type="text" name="mobile" id="mobile" maxlength="100" class="col-xs-10 col-sm-2"  value="<?php  echo $member['mobile'];?>" />
										</div>
									</div>
									
										       <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 邮箱:</label>

										<div class="col-sm-9">
												<input type="text" name="email" id="email" maxlength="100" class="col-xs-10 col-sm-2"  value="<?php  echo $member['email'];?>" />
										</div>
									</div>
									
										       <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 注册时间:</label>

										<div class="col-sm-9">
												<?php  echo date('Y-m-d H:i:s', $member['createtime'])?>
										</div>
									</div>
									
									      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 新密码:</label>

										<div class="col-sm-9">
												<input type="password" name="password" id="password" maxlength="100" class="col-xs-10 col-sm-2"  value="" />
										</div>
									</div>
									
											      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 确认密码:</label>

										<div class="col-sm-9">
													<input type="password" name="repassword" id="repassword" maxlength="100" class="col-xs-10 col-sm-2"  value="" />
										</div>
									</div>
									
										      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 积分:</label>

										<div class="col-sm-9">
													<?php  echo $member['credit'];?>
										</div>
									</div>
									
									      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 余额:</label>

										<div class="col-sm-9">
														<?php  echo $member['gold'];?>
										</div>
									</div>
									
									  
				<?php  if(!empty($weixininfo['weixin_openid']))
								{?>
									      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 微信头像:</label>

										<div class="col-sm-9">
												<img class="img-rounded" src="<?php  echo $weixininfo['avatar'];?>" width="45px" height="45px" />
										</div>
									</div>
									
											    
									
										      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 微信昵称:</label>

										<div class="col-sm-9">
												<?php  echo $weixininfo['nickname'];?>
										</div>
									</div>
											<?php		}?>
									
		
					  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>
		
			
			
		
	</form>
<?php  include page('footer');?>