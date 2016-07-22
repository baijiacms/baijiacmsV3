<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">会员等级管理&nbsp&nbsp&nbsp;<a href="<?php  echo web_url('rank',array('op'=>'detail'));?>" class="btn btn-primary">新建等级</a></h3>

		
					<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th style="text-align:center;">等级(数字)</th>
					<th style="text-align:center;">等级名称</th>
					<th style="text-align:center;">所需积分</th>
					<th style="text-align:center;">操作</th>
				</tr>
			</thead>
			<tbody>
 <?php  if(is_array($list)) { foreach($list as $v) { ?>
								<tr>
										<td class="text-center">
										<?php  echo $v['rank_level'];?>
									</td>
									<td class="text-center">
										<?php  echo $v['rank_name'];?>
									</td>
							<td class="text-center">
										<?php  echo $v['experience'];?>
									</td>
									<td class="text-center">
										&nbsp;&nbsp;<a  class="btn btn-xs btn-info" href="<?php  echo web_url('rank',array('op'=>'detail','rank_level' => $v['rank_level']));?>"><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>&nbsp;&nbsp;
										
										&nbsp;&nbsp;<a  class="btn btn-xs btn-info" href="<?php  echo web_url('rank',array('op'=>'del','rank_level' => $v['rank_level']));?>"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a>&nbsp;&nbsp;
										</td>
								</tr>
								<?php  } } ?>
  </tbody>
    </table>
		<?php  echo $pager;?>
<?php  include page('footer');?>