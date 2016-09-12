<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<link rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/themes/default/default.css" />
		<script charset="utf-8" src="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/kindeditor-min.js"></script>
		<script charset="utf-8" src="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/lang/zh_CN.js"></script>
		
		
		 <form method="post" class="form-horizontal" enctype="multipart/form-data" >
		 		<input name="showtype" type="hidden" value="1"/>
		<h3 class="header smaller lighter blue">编辑代码页面</h3>

			   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 页面名称：</label>

										<div class="col-sm-9">
												  <input type="text" name="page_name" class="col-xs-10 col-sm-2" value="<?php  echo $diyshop['pageinfo']['name'];?>" />
										</div>
									</div>
									
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 页面类型：</label>

										<div class="col-sm-9">
												  			   <input type="radio" name="page_pagetype" value="0" <?php  if($diyshop['pageinfo']['pagetype'] == 0) { ?>checked="true"<?php  } ?> /> 商城首页  &nbsp;&nbsp;
             
              		  <input type="radio" name="page_pagetype" value="1"  <?php  if($diyshop['pageinfo']['pagetype'] == 1) { ?>checked="true"<?php  } ?> /> 自定义页面 
             
										</div>
									</div>
									
									
									   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 页面标题：</label>

										<div class="col-sm-9">
												  <input type="text" name="page_title" class="col-xs-10 col-sm-2" value="<?php  echo $diyshop['pageinfo']['title'];?>" />
										</div>
									</div>
									
										    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 底部菜单</label>

										<div class="col-sm-9">
												   <input type="radio" name="page_diymenu" value="-1" id="page_diymenu" <?php  if($diyshop['pageinfo']['diymenu'] == -1) { ?>checked="true"<?php  } ?> /> 不显示  &nbsp;&nbsp;
             
              		  <input type="radio" name="page_diymenu" value="0" id="page_diymenu"  <?php  if(empty($diyshop['pageinfo']['diymenu'])) { ?>checked="true"<?php  } ?> /> 显示 
             
										</div>
									</div>
									
												<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 定制化代码</label>

										<div class="col-sm-9">
													  	<textarea id="htmlcode" style="height:550px;" name="htmlcode" class="span7" cols="60"><?php echo $diyshop['datas']?></textarea>
						<div class="help-block">单页面首页和首页自定义区域显示的内容，支持HTML代码！</div>
											</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
                        
									<input name="submit" id="submit" type="submit" value="保存设置" class="btn btn-primary span3" />
										</div>
									</div>
              

<script>


			KindEditor.ready(function(K) {
				var editor;
			
					if (editor) {
						editor.remove();
						editor = null;
					}
					editor = K.create('textarea[name="htmlcode"]', {
						allowFileManager : false,
						 filterMode: false,
						 urlType:'domain',
						uploadJson : "<?php echo WEBSITE_ROOT.mobile_url('upload',array('name'=>'shop'));?>",
						newlineTag : 'br'
					});
			
				
			});







</script>
	
    </form>
<?php  include page('footer');?>