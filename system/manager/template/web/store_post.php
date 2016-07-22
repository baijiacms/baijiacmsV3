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
										<label class="col-sm-2 control-label no-padding-left" > 绑定域名</label>

										<div class="col-sm-9">
													<input type="text" name="website" class="col-xs-10 col-sm-3" value="<?php echo $store['website'];?>" 		<?php  if(!empty($store['is_system'])){ ?>	readonly="readlony"	<?php  } ?>  />如：***.baijiacms.com，（***部分可为你定义的英文）
										</div>
									</div>
												
									  
									
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
													<input readonly="readlony" type="text"  name="mobile_url" class="col-xs-10 col-sm-6" value="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>index.php?beid=<?php echo $store['id'];?><?php  }else{ ?>http://<?php echo $store['website'];?>/index.php<?php  }?>	" /> &nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>index.php?beid=<?php echo $store['id'];?><?php  }else{ ?>http://<?php echo $store['website'];?>/index.php<?php  }?>">预览</a>
													<?php }else{?>
													提交后生成链接
														<?php }?>
										</div>
									</div>
									
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 后台管理访问链接</label>

										<div class="col-sm-9">
											<?php if(!empty($store['id'])){?>
													<input readonly="readlony" type="text"  name="mobile_url" class="col-xs-10 col-sm-6" value="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>index.php?beid=<?php echo $store['id'];?> <?php  }else{ ?>http://<?php echo $store['website'];?>/admin.php<?php  }?>	" /> &nbsp;&nbsp;&nbsp;<a target="_blank" href="<?php  if(empty($store['website'])) { ?><?php echo WEBSITE_ROOT;?>admin.php?beid=<?php echo $store['id'];?><?php  }else{ ?>http://<?php echo $store['website'];?>/admin.php<?php  }?>">预览</a>
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
