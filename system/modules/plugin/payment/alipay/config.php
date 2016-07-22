<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">支付宝配置</h3>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 支付宝名称：</label>

										<div class="col-sm-9">
													支付宝&nbsp;&nbsp;<a href="http://bbs.baijiacms.com/forum-36-1.html" target="_blank" style="font-size:18px"><strong>配置帮助</strong></a>
										</div>
									</div>
		
		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 支付宝描述：</label>

										<div class="col-sm-9">
													  <?php  echo $item['desc'];?>
										</div>
									</div>
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 支付宝帐户：</label>

										<div class="col-sm-9">
											 <input type="text" name="alipay_account" class="col-xs-10 col-sm-2" value="<?php  echo $configs['alipay_account'];?>" />
										</div>
									</div>
									
												 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 安全校验码(Key)：</label>

										<div class="col-sm-9">
											  <input type="text" name="alipay_safekey" class="col-xs-10 col-sm-2" value="<?php  echo $configs['alipay_safekey'];?>" />
										</div>
									</div>
		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 合作者身份(Pid)：</label>

										<div class="col-sm-9">
											  <input type="text" name="alipay_safepid" class="col-xs-10 col-sm-2" value="<?php  echo $configs['alipay_safepid'];?>" />
										</div>
									</div>

				 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 选择接口类型：</label>

										<div class="col-sm-9">
											<select name="alipay_paytype" id="alipay_paytype"><option value="0" selected="">使用标准双接口</option><option value="1">使用担保交易接口</option><option value="2">使用即时到帐交易接口</option></select>
									<script>
										
										document.getElementById("alipay_paytype").value="<?php  echo empty($configs['alipay_paytype'])?0:$configs['alipay_paytype'];?>";
										</script>
									
										</div>
									</div>
									
									
								

		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 申请地址：</label>

										<div class="col-sm-9">
											 <a href="https://b.alipay.com/" target="_blank" style="color:red">支付宝申请地址</a>
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
