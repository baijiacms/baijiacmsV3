<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>
     <form method="post" class="form-horizontal" enctype="multipart/form-data" >
		<h3 class="header smaller lighter blue">快速关注设置</h3>
				  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 关注提醒：</label>

										<div class="col-sm-9 row">
										 <input type="radio" name="alipay_guanzhu_open" value="1" <?php  echo empty($settings['alipay_guanzhu_open'])?"":"checked";?>> 开启,
										  <input type="radio" name="alipay_guanzhu_open" value="0" <?php  echo empty($settings['alipay_guanzhu_open'])?"checked":"";?>> 关闭
										 </div>
									</div>
		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 关注地址：</label>

										<div class="col-sm-9">
										     <input type="text" name="alipay_guanzhu"  class="col-xs-10 col-sm-4" placeholder="请输入支付宝服务窗的图文素材地址"  value="<?php  echo $settings['alipay_guanzhu'];?>" />
										
										</div>
									</div>
									
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
                        
									<input name="submit" id="submit" type="submit" value="提交" class="btn btn-primary span3" />
										</div>
									</div>
   
		 

    </form>
 
<?php  include page('footer');?>