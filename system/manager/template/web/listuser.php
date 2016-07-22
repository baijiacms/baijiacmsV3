<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">管理员用户列表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php  echo web_url('user', array('op'=>'edituser'))?>" class="btn btn-primary">新建用户</a></h3>
		<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th style="text-align:center;min-width:150px;">用户名</th>
						<th style="text-align:center; min-width:60px;">店铺</th>
					<th style="text-align:center; min-width:60px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td style="text-align:center;"><?php  echo $item['username'];?></td>
			
										<td style="text-align:center;">
									<?php  if(empty($item['is_admin'])){?>	<?php  echo $item['store']['sname'];?><?php  }else{?>全店铺<?php  }?></td>
						<td style="text-align:center;">
				
						<a class="btn btn-xs btn-info"  href="<?php  echo web_url('user', array('op'=>'changepwd','id' => $item['id']))?>"><i class="icon-edit"></i>修改密码</a>&nbsp;&nbsp;
					
						<a class="btn btn-xs btn-info" href="<?php  echo web_url('user', array('op'=>'edituser','id' => $item['id']))?>" ><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>
						<a class="btn btn-xs btn-danger" href="<?php  echo web_url('user', array('op'=>'deleteuser','id' => $item['id']))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>

<?php  include page('footer');?>
