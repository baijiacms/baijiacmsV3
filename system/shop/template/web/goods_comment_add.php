<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">添加评论</h3>

        <link href="<?php echo WEBSITE_ROOT.'themes/default/__RESOURCE__';?>/plus/js/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
<script src="<?php echo WEBSITE_ROOT.'themes/default/__RESOURCE__';?>/plus/js/star-rating.js" type="text/javascript"></script>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal"  onsubmit="return subform();" >
	 <input type="hidden" name="goodsid" value="<?php echo $shop_goods['id'];?>" />
	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 昵称：</label>

										<div class="col-sm-9">
												  <input type="text" name="comment_nickname" class="col-xs-10 col-sm-2" value="" />
										</div>
									</div>
									
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > </label>

										<div class="col-sm-9">
											 <input id="level"  value="0" name="rate" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >
										</div>
									</div>
									
										   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 评论信息:</label>

										<div class="col-sm-9">
												  <input type="text" name="rsreson" style="height:60px;line-height:22px;" class="col-xs-10 col-sm-4" value="" placeholder="说点什么吧~~" />
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
						function subform()
						{
						
						  if($("#level").length>0 && $("#level").val()=='0'){
                   alert('请选择评分');
                    return false;
                }
               return true;
						}
						</script>
		

<?php  include page('footer');?>