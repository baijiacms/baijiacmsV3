<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue"><?php  if(!empty($category['id'])) { ?>编辑<?php  }else{ ?>新增<?php  } ?>分类</h3>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
	
	<input type="hidden" name="parentid" value="<?php  echo $parent['id'];?>" />
	  		<?php  if(!empty($parentid)) { ?>
	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 上级分类</label>

										<div class="col-sm-9">
														<?php  echo $parent['name'];?>
										</div>
									</div>
		<?php  } ?>
		
		   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 排序</label>

										<div class="col-sm-9">
														<input type="text" name="displayorder" class="col-xs-10 col-sm-2" value="<?php  echo $category['displayorder'];?>" />
										</div>
									</div>
	
			   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 分类名称</label>

										<div class="col-sm-9">
												
									<input type="text" name="catename" class="col-xs-10 col-sm-2" value="<?php  echo $category['name'];?>" />
										</div>
									</div>
									
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 分类图片<br/>(建议尺寸: 100*100或正方型图片)</label>

										<div class="col-sm-9">
												
															 <div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
			                        	 <?php  if(!empty($category['thumb'])) { ?>
			                            <img style="width:100%" src="<?php echo WEBSITE_ROOT;?>/attachment/<?php  echo $category['thumb'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="thumb" id="thumb" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                            	 <?php  if(!empty($category['thumb'])) { ?>
			                              <input name="thumb_del" id="thumb_del" type="checkbox" value="1" />删除已上传图片
			                                 <?php  } ?>
			                        </div>
			                    </div>
												
											
										</div>
									</div>
									
									  <?php  if(empty($parentid)) { ?>
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 分类广告<br/>(建议尺寸: 640*320)</label>

										<div class="col-sm-9">
												
															 <div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
			                        	 <?php  if(!empty($category['thumbadv'])) { ?>
			                            <img style="width:100%" src="<?php echo WEBSITE_ROOT;?>/attachment/<?php  echo $category['thumbadv'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="thumbadv" id="thumbadv" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                             	 <?php  if(!empty($category['thumbadv'])) { ?>
			                              <input name="thumbadv_del" id="thumbadv_del" type="checkbox" value="1" />删除已上传图片
			                                 <?php  } ?>
			                        </div>
			                    </div>
												
											
										</div>
									</div>
									
									 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 分类广告url</label>

										<div class="col-sm-9">
												
									<input type="text" name="thumbadvurl" class="col-xs-10 col-sm-6" value="<?php  echo $category['thumbadvurl'];?>" />
										</div>
									</div>
									
										<?php  } ?>
	
	  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 分类描述</label>

										<div class="col-sm-9">
											
						<input type="text" name="description" class="col-xs-10 col-sm-5" value="<?php  echo $category['description'];?>" />
												</div>
									</div>
									
									 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 首页推荐</label>

										<div class="col-sm-9">
					
                        <input type='radio' name='isrecommand' value=1' <?php  if($category['isrecommand']==1) { ?>checked<?php  } ?> /> 是&nbsp;
                        <input type='radio' name='isrecommand' value=0' <?php  if($category['isrecommand']==0) { ?>checked<?php  } ?> /> 否
												</div>
									</div>
	
	
			 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否显示</label>

										<div class="col-sm-9">
                        <input type='radio' name='enabled' value=1' <?php  if($category['enabled']==1) { ?>checked<?php  } ?> /> 是&nbsp;
                        <input type='radio' name='enabled' value=0' <?php  if($category['enabled']==0) { ?>checked<?php  } ?> /> 否
												</div>
									</div>
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > </label>

										<div class="col-sm-9">
                       
					<input name="submit" type="submit" value="提交" class="btn btn-primary span3">
												</div>
									</div>
</form>
<?php  include page('footer');?>
