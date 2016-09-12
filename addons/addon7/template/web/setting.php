<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">参数设置</h3>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
		   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 前台界面:</label>

										<div class="col-sm-9">
												    <a href="http://<?php  echo $system_store['website'].WEBSITE_FOOTER ?>/<?php  echo create_url('mobile',array('name' => 'addon7','do' => 'index'))?>" target="_blank">http://<?php  echo $system_store['website'].WEBSITE_FOOTER ?>/<?php  echo create_url('mobile',array('name' => 'addon7','do' => 'index'))?></a>
                
										</div>
									</div>
	
	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 兑换页面标题：</label>

										<div class="col-sm-9">
												  <input type="text" name="title" class="col-xs-10 col-sm-2" value="<?php  echo $setting['title'];?>" />
										</div>
									</div>
									
										
													
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<br/><input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
		                     </div>
		                     </div>
				
</form>
<?php  include page('footer');?>