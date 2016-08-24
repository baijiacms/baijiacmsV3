<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>
     <form method="post" class="form-horizontal" enctype="multipart/form-data" >
		<h3 class="header smaller lighter blue">服务窗设置</h3>
		
		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 服务窗名称：</label>

										<div class="col-sm-9">
										     <input type="text" name="alipay_name" class="col-xs-10 col-sm-4" value="<?php  echo $settings['alipay_name'];?>" />&nbsp&nbsp;
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 开发者关网：</label>

										<div class="col-sm-9">
										    
                         <input type="text" name="interface" class="col-xs-10 col-sm-4" value="<?php echo WEBSITE_ROOT.'alipay.php'?>"  readonly="readonly"/>
										</div>
									</div>
									
													  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >APPID：</label>

										<div class="col-sm-9">
                        
                         <input type="text" name="alipay_appId" class="col-xs-10 col-sm-4" value="<?php  echo $settings['alipay_appId'];?>" />
										</div>
									</div>
									
									
															 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >  支付宝公钥：</label>

										<div class="col-sm-9">
													     <input name="alipay_gy" id="alipay_gy" type="file" /><?php  if(!empty( $settings['alipay_gy'])){ ?><a href="<?php  echo WEBSITE_ROOT.$settings['alipay_gy'] ?>" target="_blank">下载文件</a> <?php } ?>
										</div> 
									</div>


<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >  支付宝私钥：</label>

										<div class="col-sm-9">
													     <input name="alipay_sy" id="alipay_sy" type="file" /><?php  if(!empty( $settings['alipay_sy'])){ ?><a href="<?php  echo WEBSITE_ROOT.$settings['alipay_sy'] ?>" target="_blank">下载文件</a> <?php } ?>
										</div> 
									</div>

									
										<!--	  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >服务窗快捷登陆：</label>

									<div class="col-sm-9">
												   <input type="radio" name="thirdlogin_alipay" value="0" <?php  echo empty($thirdlogin['enabled'])?"checked=\"true\"":"";?>> 关闭  &nbsp;&nbsp;
             
              		  <input type="radio" name="thirdlogin_alipay" value="1" <?php  echo $thirdlogin['enabled']==1?"checked=\"true\"":"";?>> 开启
             
										</div>
									</div>-->
									
											
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
                        
									<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary span3" />
										</div>
									</div>
              
			<?php if($isfirst){ ?>
			<div class="alert alert-info" style="margin-left:10px">

					系统检测到你是第一次访问，请先提交后再登录fuwu.alipay.com进行配置
    </div>
			
		
			<?php } ?>
		 

    </form>

<?php  include page('footer');?>