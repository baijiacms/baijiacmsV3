<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">商城基础设置</h3>
<style>
	.good_line_table{
		
		width:100%;
		}
	</style>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商店名称：</label>

										<div class="col-sm-9">
												  <input type="text" name="shop_title" class="col-xs-10 col-sm-2" value="<?php  echo $settings['shop_title'];?>" />
										</div>
									</div>
									
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商店描述：</label>

										<div class="col-sm-9">
												  <input type="text" name="shop_description" class="col-xs-10 col-sm-4" value="<?php  echo $settings['shop_description'];?>" />
										</div>
									</div>
									
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 客服QQ:</label>

										<div class="col-sm-9">
												  <input type="text" name="shop_kf_qq" class="col-xs-10 col-sm-2" value="<?php  echo $settings['shop_kf_qq'];?>" />需先开通，进入<a href="http://shang.qq.com/index.php" target="_blank">http://shang.qq.com/index.php</a>，点击“推广工具“进行开通
										</div>
									</div>
				
												    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 自动确认收货</label>

										<div class="col-sm-9">
												   <input type="radio" name="shop_auto_confirm" value="0" id="shop_auto_confirm" <?php  if($settings['shop_auto_confirm'] == 0) { ?>checked="true"<?php  } ?> /> 关闭  &nbsp;&nbsp;
             
              		  <input type="radio" name="shop_auto_confirm" value="1" id="shop_auto_confirm"  <?php  if($settings['shop_auto_confirm'] == 1) { ?>checked="true"<?php  } ?> /> 开启 ，发货日起<input type="text" name="shop_auto_confirm_day" style="width:50px" value="<?php  echo $settings['shop_auto_confirm_day'];?>" />天后自动收货（最小1天）
             
										</div>
									</div>
									
											   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 退换货期限：</label>

										<div class="col-sm-9">
												  <input type="text" name="shop_system_postsale" class="col-xs-10 col-sm-2" value="<?php  echo $settings['shop_system_postsale'];?>" />
										</div>
									</div>
									
											   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 后台 Logo：<br/>(尺寸: 180*53)</label>

										<div class="col-sm-9">
												
															 <div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 180px; height: 53px;">
			                        	 <?php  if(!empty($settings['admin_logo'])) { ?>
			                            <img style="width:100%" src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $settings['admin_logo'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="admin_logo" id="admin_logo" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                            	 <?php  if(!empty($settings['admin_logo'])) { ?>
			                              <input name="admin_logo_del" id="admin_logo_del" type="checkbox" value="1" />删除已上传图片
			                                 <?php  } ?>
			                        </div>
			                    </div>
												
											
										</div>
									</div>
									
									
									 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 个人中心 背景图：<br/>(尺寸: 640*140)</label>

										<div class="col-sm-9">
												
															 <div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 320px; height: 70px;">
			                        	 <?php  if(!empty($settings['fansindex_bg'])) { ?>
			                            <img style="width:100%" src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $settings['fansindex_bg'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="fansindex_bg" id="fansindex_bg" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                            	 <?php  if(!empty($settings['fansindex_bg'])) { ?>
			                              <input name="fansindex_bg_del" id="fansindex_bg_del" type="checkbox" value="1" />删除已上传图片
			                                 <?php  } ?>
			                        </div>
			                    </div>
												
											
										</div>
									</div>
									
									
										
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 前台商店 Logo：<br/>(建议170*28)</label>

										<div class="col-sm-9">
											
											<div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 160px; height: 30px;">
			                        	 <?php  if(!empty($settings['shop_logo'])) { ?>
			                            <img style="width:100%" src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $settings['shop_logo'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="shop_logo" id="shop_logo" type="file"  />
			                              <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                            	 <?php  if(!empty($settings['shop_logo'])) { ?>
			                              <input name="shop_logo_del" id="shop_logo_del" type="checkbox" value="1" />删除已上传图片
			                                 <?php  } ?>
			                        </div>
			                    </div>
											
										</div>
									</div>
									  
									
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否开启注册：</label>

										<div class="col-sm-9">
												   <input type="radio" name="shop_openreg" value="0"  <?php  if($settings['shop_openreg'] == 0) { ?>checked="true"<?php  } ?> /> 关闭  &nbsp;&nbsp;
             
              		  <input type="radio" name="shop_openreg" value="1"  <?php  if($settings['shop_openreg'] == 1) { ?>checked="true"<?php  } ?> /> 开启
             
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 店铺商品评论：</label>

										<div class="col-sm-9">
												   <input type="radio" name="shop_auto_comment" value="0" id="shop_auto_comment" <?php  if($settings['shop_auto_comment'] == 0) { ?>checked="true"<?php  } ?> /> 审核发布  &nbsp;&nbsp;
             
              		  <input type="radio" name="shop_auto_comment" value="1" id="shop_auto_comment"  <?php  if($settings['shop_auto_comment'] == 1) { ?>checked="true"<?php  } ?> /> 无需审核立即发布
             
										</div>
									</div>
					
							 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 调用第三方统计代码</label>

										<div class="col-sm-9">
											<textarea name="shop_tongjicode"  cols="60" rows="8"><?php  echo $settings['shop_tongjicode'];?></textarea>
											</div>
									</div>
					
									 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 调用第三方客服代码</label>

										<div class="col-sm-9">
											<textarea name="shop_kfcode"  cols="60" rows="8"><?php  echo $settings['shop_kfcode'];?></textarea>
											</div>
									</div>
									
							
									
									
									 
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<br/><input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
		                     </div>
		                     </div>
				
</form>

		
<script>


			KindEditor.ready(function(K) {
				var editor;
			
					if (editor) {
						editor.remove();
						editor = null;
					}
					editor = K.create('textarea[name="help"]', {
						allowFileManager : false,
						height:'400px',
						 filterMode: false,
						 
						 formatUploadUrl:false,
		uploadJson : "<?php echo WEBSITE_ROOT.mobile_url('keupload');?>",
						newlineTag : 'br',
					items : [
						'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image',  'multiimage','insertfile','link']
					});
			
				
			});


</script>

<?php  include page('footer');?>