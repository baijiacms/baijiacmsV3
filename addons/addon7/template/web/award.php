<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

	<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/common/css/datetimepicker.css" />
		<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/datetimepicker.js"></script>
 <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php  echo $award['id'];?>" />
					<h3 class="header smaller lighter blue">编辑积分商品</h3>
        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 奖品名称</label>

										<div class="col-sm-9">
											 <input type="text" name="title"  value="<?php  echo $award['title'];?>" class="col-xs-10 col-sm-2" />
										</div>
									</div>
								
					<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 宣传图</label>

										<div class="col-sm-9">
											 				<div class="fileupload fileupload-new" data-provides="fileupload">
			                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
			                        	 <?php  if(!empty($award['logo'])) { ?>
			                            <img style="width:100%" src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $award['logo'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                        <div>
			                         <input name="logo" id="logo" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                        </div>
			                    </div>
										</div>
									</div>
									
									     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 兑换类型</label>

										<div class="col-sm-9">
										<input type="radio" name="awardtype" value="0" <?php  if($award['awardtype'] == 0) { ?>checked="true"<?php  } ?> /> 虚拟商品/实体商品  &nbsp;&nbsp;
             
                <input type="radio" name="awardtype" value="1"  <?php  if($award['awardtype'] == 1) { ?>checked="true"<?php  } ?> /> 积分兑换余额 <input type="text" name="gold"  value="<?php  echo $award['gold'];?>" />
										</div>
									</div>
									
									
									
									        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 剩余可兑换奖品数</label>

										<div class="col-sm-9">
											 <input type="text" name="amount"  value="<?php  echo $award['amount'];?>" class="col-xs-10 col-sm-2" />
										</div>
									</div>
									
									
									     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 兑奖截止日期</label>

										<div class="col-sm-9">
											 <input name="endtime" id="endtime" type="text" value="<?php  echo empty($award['endtime'])?date('Y-m-d H:i',time()):date('Y-m-d H:i',$award['endtime']);?>" readonly="readonly"  /> 
													<script type="text/javascript">
		$("#endtime").datetimepicker({
			format: "yyyy-mm-dd hh:ii",
			minView: "0",
			//pickerPosition: "top-right",
			autoclose: true
		});
	</script> 
										</div>
									</div>
									
									
									     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 奖品实际价格</label>

										<div class="col-sm-9">
											 <input type="text" name="price"  value="<?php  echo $award['price'];?>" class="col-xs-10 col-sm-2" />
										</div>
									</div>
									
									
									    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 兑换消耗积分数</label>

										<div class="col-sm-9">
											 <input type="text" name="credit_cost"  value="<?php  echo $award['credit_cost'];?>" class="col-xs-10 col-sm-2" />
										</div>
									</div>
									
									
										    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 简介</label>

										<div class="col-sm-9">
											 		<textarea name="content" id="content" cols="60" rows="8"><?php  echo $award['content'];?></textarea>
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