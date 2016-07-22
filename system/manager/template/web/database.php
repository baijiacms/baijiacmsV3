<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">数据备份与还原</h3>
<ul class="nav nav-tabs">
	<li style="width:10%" <?php   if($operation=='display'){?>class="active"<?php  } ?>><a href="<?php  echo create_url('site', array('name' => 'manager','do' => 'database'))?>">数据备份</a></li>
	<li style="width:10%" <?php  if($operation=='restore'){?>class="active"<?php  } ?>><a href="<?php  echo create_url('site', array('name' => 'manager','do' => 'database','op'=>'restore'))?>">数据还原</a></li>

</ul>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
	
<?php  if($operation=='display')
 {?>			
					
									 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
										</div>
									</div>
									
										 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >日期：</label>

										<div class="col-sm-9">
											<?php  echo date('Ymd', time())?>
										</div>
									</div>
							
										 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 备份商城数据 " class="btn btn-warning"/>
										</div>
									</div>
									
									
									 
										
				<?php }?>	
				
				
				<?php  if($operation=='restore'){?>
 	<div class="help-block"><strong style="color:red">此操作不可还原，请慎重操作。 </strong></div>
 		<table class="table table-striped table-bordered table-hover">
  <tr >
  	 <th class="text-center" >备份名称</th>
 <th class="text-center" >备份时间</th>
    <th class="text-center">分卷数量</th>
	<th class="text-center" >操作</th>
  </tr>
 		<?php if(is_array($ds)) { foreach($ds as $item) { ?>
				<tr>
										<td style="text-align:center;"><?php  echo $item['bakdir'];?></td>
															<td style="text-align:center;"><?php  echo date('Y-m-d H:i:s', $item['time']);?></td>
																				<td style="text-align:center;"><?php  echo $item['volume'];?></td>
																									<td style="text-align:center;">
																										
				<a  class="btn btn-xs btn-info" href="<?php  echo 			create_url('site', array('name' => 'manager','do' => 'database','op'=>'torestore','id'=>base64_encode($item['bakdir'])));?>" onclick="return confirm('确认开始还原，此操作不可恢复？');return false;"><i class="icon-edit"></i>&nbsp;还原此备份&nbsp;</a></a>

				<a  class="btn btn-xs btn-info" href="<?php  echo 			create_url('site', array('name' => 'manager','do' => 'database','op'=>'delete','id'=>base64_encode($item['bakdir'])));?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a></a>
			
																										</td>
				</tr>
			<?php } } ?>
 	
 	
 		<?php } ?>	
</form>
<?php  include page('footer'); ?>