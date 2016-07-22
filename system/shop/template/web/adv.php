<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>

<h3 class="header smaller lighter blue">幻灯片设置</h3>


<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 排序：</label>

										<div class="col-sm-9">
													   <input type="text" name="displayorder" class="span6" value="<?php  echo $adv['displayorder'];?>" />(越大越前)
										</div>
									</div>

  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 幻灯片图片：<br/>(图片宽640px)</label>

										<div class="col-sm-9">
											 <div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
			                        	 <?php  if(!empty($adv['thumb'])) { ?>
			                            <img style="width:100%" src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $adv['thumb'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="thumb" id="thumb" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                        </div>
			                    </div>
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 幻灯片链接：</label>

										<div class="col-sm-9">
													  <input type="text" name="link" id='link' class="span6" value="<?php  echo $adv['link'];?>" />
										</div>
									</div>


									
  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否显示：</label>

										<div class="col-sm-9">
											
											<input type="radio" name="enabled" value="1" id="enabled1" <?php  if( $adv['enabled'] == 1) { ?>checked="true"<?php  } ?> /> 是
                    &nbsp;&nbsp;&nbsp;
<input type="radio" name="enabled" value="0" id="enabled2"  <?php  if(empty($adv['enabled'])) { ?>checked="true"<?php  } ?> /> 否
                   
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