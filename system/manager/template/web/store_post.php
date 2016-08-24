<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">店铺编辑&nbsp;&nbsp;&nbsp;</h3>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
<input type="hidden" name="id" class="col-xs-10 col-sm-2" value="<?php echo $store['id'];?>" />
		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 店铺名称</label>

										<div class="col-sm-9">
													<input type="text" name="sname" class="col-xs-10 col-sm-3" value="<?php echo $store['sname'];?>" />
										</div>
									</div>
						<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 主绑定域名</label>

										<div class="col-sm-9">
													<input type="text" name="website" class="col-xs-10 col-sm-3" value="<?php echo $store['website'];?>" 		 />如：<font style="color:red">***.baijiacms.com</font>，请注意格式（***部分可为你定义的英文）不含二级目录和http。
										</div>
									</div>
												
									  	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 主完整域名(选填)</label>

										<div class="col-sm-9">
													<input type="text" name="fullwebsite" class="col-xs-10 col-sm-3" value="<?php echo $store['fullwebsite'];?>" 		 />在二级目录情况下需填写，如：http://***.baijiacms.com/demo/，请注意格式（***部分可为你定义的英文）。
										</div>
									</div>
									<?php if(false){?>
										  	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 子绑定域名1(选填)</label>

										<div class="col-sm-9">
													<input type="text" name="website2" class="col-xs-10 col-sm-3" value="<?php echo $store['website2'];?>" 		  />如：***.baijiacms.com，请注意格式（***部分可为你定义的英文）不含二级目录和http。
										</div>
									</div>
									 	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 子绑定域名2(选填)</label>

										<div class="col-sm-9">
													<input type="text" name="website3" class="col-xs-10 col-sm-3" value="<?php echo $store['website3'];?>" 		  />如：***.baijiacms.com，请注意格式（***部分可为你定义的英文）不含二级目录和http。
										</div>
									</div>
										<?php }?>
									<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> 是否开启：</label>

										<div class="col-sm-9">
             
              		  <input name="isclose" value="1" id="isclose" type="radio"  <?php  if($store['isclose'] == 1) { ?>checked="true"<?php  } ?>> 关闭
 &nbsp;&nbsp;	      <input name="isclose" value="0" id="isclose" type="radio"  <?php  if($store['isclose'] == 0) { ?>checked="true"<?php  } ?>>  开启
										</div>
									</div>
								
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 前台访问链接</label>

										<div class="col-sm-9">
											<?php if(!empty($store['id'])){?>
													<input readonly="readlony" type="text"  name="mobile_url" class="col-xs-10 col-sm-6" value="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>index.php?beid=<?php echo $store['id'];?><?php  }else{ ?><?php  if(empty($store['fullwebsite'])) { ?>http://<?php echo $store['website'];?>/<?php }else{ ?><?php echo $store['fullwebsite'];?><?php } ?>index.php<?php  }?>	" /> &nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>index.php?beid=<?php echo $store['id'];?><?php  }else{ ?><?php  if(empty($store['fullwebsite'])) { ?>http://<?php echo $store['website'];?>/<?php }else{ ?><?php echo $store['fullwebsite'];?><?php } ?>index.php<?php  }?>">预览</a>
													<?php }else{?>
													提交后生成链接
														<?php }?>
										</div>
									</div>
									
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 后台管理访问链接</label>

										<div class="col-sm-9">
											<?php if(!empty($store['id'])){?>
													<input readonly="readlony" type="text"  name="mobile_url" class="col-xs-10 col-sm-6" value="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>index.php?beid=<?php echo $store['id'];?> <?php  }else{ ?><?php  if(empty($store['fullwebsite'])) { ?>http://<?php echo $store['website'];?>/<?php }else{ ?><?php echo $store['fullwebsite'];?><?php } ?>admin.php<?php  }?>	" /> &nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>admin.php?beid=<?php echo $store['id'];?><?php  }else{ ?><?php  if(empty($store['fullwebsite'])) { ?>http://<?php echo $store['website'];?>/<?php }else{ ?><?php echo $store['fullwebsite'];?><?php } ?>admin.php<?php  }?>">预览</a>
													<?php }else{?>
													提交后生成链接
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


<?php  include page('footer');?>
