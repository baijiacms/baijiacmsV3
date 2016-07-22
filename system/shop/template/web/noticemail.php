<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">邮件提醒设置</h3>
<style>
	.good_line_table{
		
		width:100%;
		}
	</style>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
	   
																		   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 邮件提醒：</label>

										<div class="col-sm-9">
											<input type="radio" name="smtp_openmail" value="1" <?php  echo $settings['smtp_openmail']==1?'checked':'';?>>开启，
											<input type="radio" name="smtp_openmail"  value="0" <?php  echo $settings['smtp_openmail']==1?'':'checked';?>>关闭
											</div>
									</div>
													
																   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 订单收件邮箱地址：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_to_mail" class="span6" value="<?php  echo $settings['smtp_to_mail'];?>">
											<div class="help-block">订单收件邮箱地址</div>
											</div>
									</div>
									<h3 class="header smaller lighter blue"></h3>
											   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 发送方式：</label>

										<div class="col-sm-9">
											<input type="radio" name="smtp_sendtype" value="0" <?php  echo $settings['smtp_sendtype']==0?'checked':'';?>>通过 phpmailer 发送(推荐此方式)，
											<input type="radio" name="smtp_sendtype"  value="1" <?php echo $settings['smtp_sendtype']==1?'checked':'';?>>通过 SOCKET 连接 SMTP 服务器发送
											</div>
									</div>
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 发送用户邮箱：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_mail" class="span6" value="<?php  echo $settings['smtp_mail'];?>">
											</div>
									</div>
									
															   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > SMTP服务器地址：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_server" class="span6" value="<?php  echo $settings['smtp_server'];?>">
											<div class="help-block">指定SMTP服务器的地址</div>
											</div>
									</div>
									
															   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > SMTP服务器端口：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_port" class="span6" value="<?php  echo $settings['smtp_port'];?>">
											<div class="help-block">指定SMTP服务器的端口</div>
											</div>
									</div>
									
												   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 使用SSL加密：</label>

										<div class="col-sm-9">
											<input type="radio" name="smtp_authmode" value="1" <?php  echo $settings['smtp_authmode']==1?'checked':'';?>>是，
											<input type="radio" name="smtp_authmode" value="0" <?php  echo $settings['smtp_authmode']==1?'':'checked';?>>否
											
											</div>
									</div>
									
												
									
																	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 发送帐号用户名：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_username" class="span6" value="<?php  echo $settings['smtp_username'];?>">
											</div>
									</div>
															   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 发送帐号密码：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_passwd" class="span6" value="<?php  echo $settings['smtp_passwd'];?>">
											</div>
									</div>
													
														   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 邮件标题：</label>

										<div class="col-sm-9">
											<input type="text" name="smtp_title" class="span6" value="<?php  echo $settings['smtp_title'];?>">
											</div>
									</div>
											
											<table width="95%" align="center">
												<tr> 
													<td width="44%"  ><span style="font-size: 14px;">邮件模板：&nbsp;&nbsp;<a href="javascript:;" style="font-size:21px" onclick="settmpcontent()"><strong>预设模板</strong></a></span>
											<textarea name="mailtemplate" id="mailtemplate" cols="60" rows="8"><?php  echo $settings['mailtemplate'];?></textarea>
											<br/>订单编号：{order_sn}，下单时间：{time}，订单产品列表(多行)：{good_line}
											<br/>商品总金额：{good_price}，运费：{dispatch_price},订单总金额：{order_price}
											<br/>收件人：{dispatch_realname}，收件人电话：{dispatch_tell}，收件地址：{dispatch_address}
										<br/>	
																								</td>
														<td style="width:3px">
													</td>
													<td style="text-align:left;width:50%" id="mailtemplatespan">
													</td>
												</td>
											</table>
									
													
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<br/><input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>&nbsp;&nbsp;&nbsp;<input name="sendmail" type="submit" value="邮件测试" class="btn btn-warning"/>
										
		                     </div>
		                     </div>
					<div id="template_line" style="display:none">
						
				<p>
    <span style="font-size: 20px;"><strong>购买商品清单</strong></span>
</p>
<p>
    <span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);">{good_line}&nbsp;</span>
</p>
<p>
    商品总金额：<span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);"><span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);">{good_price}</span> 元</span>
</p>
<p>
    运费：<span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);">{dispatch_price}元</span>
</p>
<p>
    订单总金额：<span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);"><span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);">{order_price}<span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);">元</span></span></span>
</p>
<p>
    <span style="font-size: 20px;"><strong>购买用户详情</strong></span>
</p>
<p>
    <span style="font-size: 14px;">真实姓名：<span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; line-height: 19.5px; background-color: rgb(255, 255, 255);">{dispatch_realname}</span></span>
</p>
<p>
    <span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 14px; line-height: 19.5px; background-color: rgb(255, 255, 255);">详细地址：<span style="color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; font-size: 13px; line-height: 19.5px; background-color: rgb(255, 255, 255);">{dispatch_address}</span></span>
</p>
<p>
    <span style="font-size: 14px;">手机：<span style="font-size: 13px; color: rgb(57, 57, 57); font-family: &#39;Open Sans&#39;; line-height: 19.5px; background-color: rgb(255, 255, 255);">{dispatch_tell}</span></span>
</p>
					</div>		
									
	<div id="good_line" style="display:none">
		<table class="good_line_table" >
			<tr>
				<th style="text-align:left;">名称
				</th>
				<th  style="text-align:center;width:50px">数量
				</th>
				<th  style="text-align:center;width:50px">单价
				</th>
			</tr>
					<tr>
				<td  style="text-align:left">[珍珠白+20]珍珠白BB霜晶彩焕颜修容霜50ml遮瑕强裸妆补水保湿持久防水
				</td>
				<td  style="text-align:center">2
				</td>
				<td  style="text-align:center">200
				</td>
			</tr>
					<tr>
				<td  style="text-align:left">[珍珠白+10]珍珠白BB霜晶彩焕颜修容霜50ml遮瑕强裸妆补水保湿持久防水
				</td>
				<td  style="text-align:center">1
				</td>
				<td  style="text-align:center">100
				</td>
			</tr>
		</table>
		                     </div>
</form>

			<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/ueditor.config.js?x=1211"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/ueditor.all.min.js?x=141"></script>
<script type="text/javascript">
	　　String.prototype.replaceAll = function(reallyDo, replaceWith, ignoreCase) { 
　 if (!RegExp.prototype.isPrototypeOf(reallyDo)) { 
return this.replace(new RegExp(reallyDo, (ignoreCase ? "gi": "g")), replaceWith); 
} else { 
return this.replace(reallyDo, replaceWith); 
} 
} 

	
	var mailtemplate = UE.getEditor('mailtemplate');
	mailtemplate.addListener("contentChange",function(){
		var tcontent=this.getContent();
		tcontent=tcontent.replaceAll('{order_sn}','SN032144',false).replaceAll('{dispatch_realname}','小王',false).replaceAll('{dispatch_tell}','13500000001',false).replaceAll('{dispatch_address}','上海市xxxx',false).replaceAll('{good_price}','300',false).replaceAll('{dispatch_price}','10',false).replaceAll('{order_price}','310',false).replaceAll('{time}','2015-01-01 21:51:32',false).replaceAll('{good_line}',document.getElementById('good_line').innerHTML,false);

  document.getElementById('mailtemplatespan').innerHTML=tcontent;
});
function settmpcontent()
{
	
mailtemplate.setContent(document.getElementById('template_line').innerHTML);	
}

</script>
<?php  include page('footer');?>