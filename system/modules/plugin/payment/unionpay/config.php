<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">银行汇款/转帐</h3>
 <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 支付方式名称：</label>

										<div class="col-sm-9">
													<?php  echo $item['name'];?>
										</div>
									</div>
		
		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 申请地址：</label>

										<div class="col-sm-9">
													<a href="https://online.unionpay.com" target="_blank">https://online.unionpay.com</a>
										</div>
									</div>
									
												 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >  商户私钥证书：</label>

										<div class="col-sm-9">
													     <input name="shsy" id="shsy" type="file" /><?php  if(!empty($configs['shsy'])){ ?><a href="<?php  echo WEBSITE_ROOT.$configs['shsy'] ?>" target="_blank">下载文件</a> <?php } ?>
										</div> 
									</div>
<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >  前台交易请求地址：</label>

										<div class="col-sm-9">
													  <input type="text" class="col-xs-10 col-sm-6" name="qtjyqqdz"  id="qtjyqqdz" value="<?php  echo empty($configs['qtjyqqdz'])?"https://gateway.95516.com/gateway/api/frontTransReq.do":$configs['qtjyqqdz'];?>" /><a onclick="document.getElementById('qtjyqqdz').value='https://gateway.95516.com/gateway/api/frontTransReq.do';">切换到运营地址</a>&nbsp;&nbsp;<a onclick="document.getElementById('qtjyqqdz').value='https://101.231.204.80:5000/gateway/api/frontTransReq.do';">切换到测试地址</a>
										</div>
									</div>

	 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >  银联公钥证书：</label>

										<div class="col-sm-9">
													     <input name="ylgy" id="ylgy" type="file" /><?php  if(!empty($configs['ylgy'])){ ?><a href="<?php  echo WEBSITE_ROOT.$configs['ylgy'] ?>" target="_blank">下载文件</a> <?php } ?>
										</div>
									</div>

 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 测试商户号：</label>

										<div class="col-sm-9">
													  <input type="text" class="col-xs-10 col-sm-2" name="merId" value="<?php  echo $configs['merId'];?>" />
										</div>
									</div>

 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 签名证书密码：</label>

										<div class="col-sm-9">
													  <input type="text" class="col-xs-10 col-sm-2" name="bank_pwd" value="<?php  echo $configs['bank_pwd'];?>" />
										</div>
									</div>



												 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 排序优先级：</label>

										<div class="col-sm-9">
													  <input type="text" class="col-xs-10 col-sm-2" name="pay_order" value="<?php  echo $item['order'];?>" />
                   <p class="help-block">越大支付时候显示越前</p>
										</div>
									</div>
									
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否货到付款：</label>

										<div class="col-sm-9">
													    <?php if(empty($item['iscod'])||$item['iscod']==0){?>
         										否<?php }else{ ?>
                                是
                                 <?php }?> 
										</div>
									</div>
									
										 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否在线支付：</label>

										<div class="col-sm-9">
													     <?php if(empty($item['online'])||$item['online']==0){?>
         	否<?php }else{ ?>
                                是
                                 <?php }?> 
										</div>
									</div>
									
									
												  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>
		</form>

			
		<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/ueditor.config.js?x=1211"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/ueditor.all.min.js?x=141"></script>
<script type="text/javascript">var ue = UE.getEditor('bank_pay_desc');</script>