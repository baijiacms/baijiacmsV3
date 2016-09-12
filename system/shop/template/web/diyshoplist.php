<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">自定义页面&nbsp;&nbsp;<a href="<?php  echo create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'edit','showtype'=>1,'t'=>time()));?>" class="btn btn-primary">新建代码页面</a>&nbsp&nbsp;<span style="font-size:14px"><input type="radio" name="shopwap_diyshop_diyshopindex" value="0" onchange="location.href='<?php  echo create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'changestyle','shopwap_diyshop_diyshopindex'=>0))?>';" <?php  echo empty($settings['shopwap_diyshop_diyshopindex'])?'checked':''; ?>>关闭商城首页DIY，<input type="radio" name="shopwap_diyshop_diyshopindex" value="1" onchange="location.href='<?php  echo create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'changestyle','shopwap_diyshop_diyshopindex'=>1))?>';" <?php  echo !empty($settings['shopwap_diyshop_diyshopindex'])?'checked':''; ?>>开启商城首页DIY</span></h3>
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
							<th class="row-hover" style="text-align: center;">序号</th>
		<th class="row-hover" style="text-align: center;">页面名称</th>
									<th class="row-hover" style="text-align: center;">页面类型</th>
									<th class="row-hover" style="text-align: center;">页面访问地址</th>
											<th class="row-hover" style="text-align: center;">操作</th>
				</tr>
			</thead>
		<?php  $index=1;if(is_array($diyshoplist)) { foreach($diyshoplist as $diyshop) { ?>
				<tr>
									<td class="text-center"><?php echo $index++; ?></td>
										<td class="text-center"><?php echo $diyshop['pagename']; ?></td>
											<td class="text-center"><?php echo empty($diyshop['pagetype'])?'商城首页':'自定义页面'; ?>
												
												<?php if(empty($diyshop['pagetype'])){ if($diyshop['active']==1){ ?> <span class="label label-success">优先</span><?php } } ?>
												</td>
										<td class="text-center">
											<input name="xurl"  style="width:300px" value="<?php  echo WEBSITE_ROOT.create_url('mobile', array('name' => 'shopwap','do' => 'diypage','id'=>$diyshop['id']));?>" readonly="readonly" type="text">
											<br/>
											<a href="<?php  echo WEBSITE_ROOT.create_url('mobile', array('name' => 'shopwap','do' => 'diypage','id'=>$diyshop['id']));?>" target="_blank">访问页面</a>
											</td>
               <td class="text-center"> 
           	 
          	<?php if(empty($diyshop['pagetype'])&&empty($diyshop['active'])){ ?>
          	   	<a class="btn btn-xs btn-info"    href="<?php  echo create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'setdefault','id'=>$diyshop['id']));?>"><i class="icon-edit"></i>设置优先</a>
          
          		<?php } ?>  &nbsp;  	<a class="btn btn-xs btn-info"  href="<?php  echo create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'edit','id'=>$diyshop['id']));?>"><i class="icon-edit"></i>编辑</a>
          	&nbsp;
          	   	<a class="btn btn-xs btn-info"   onclick="return confirm('此操作不可恢复，确认删除？');return false;"  href="<?php  echo create_url('site', array('name' => 'shop','do' => 'diyshop','op'=>'delete','id'=>$diyshop['id']));?>"><i class="icon-edit"></i>删除</a>
          
          	</td>
                                </td>
				</tr>
				<?php  } } ?>
		</table>

<?php  include page('footer');?>
