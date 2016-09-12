<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">积分商品列表</h3>
		<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th style="text-align:center;min-width:100px;">奖品名称</th>
					<th style="text-align:center;min-width:80px;">类型</th>
					<th style="text-align:center;min-width:30px;">剩余数量</th>
					<th style="text-align:center; min-width:30px;">价格</th>
					<th style="text-align:center; min-width:30px;">所需积分</th>
						<th style="text-align:center; min-width:150px;">描述</th>
							<th style="text-align:center; min-width:50px;">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($awardlist)) { foreach($awardlist as $item) { ?>
				<tr>
					<td style="text-align:center;"><?php  echo $item['title'];?></td>
						<td style="text-align:center;"><?php  echo $item['awardtype']==1?'积分兑换余额:'.$item['gold']:'兑换商品';?></td>
								<td style="text-align:center;"><?php  echo $item['amount'];?></td>
											<td style="text-align:center;"><?php  echo $item['price'];?></td>
														<td style="text-align:center;"><?php  echo $item['credit_cost'];?></td>
																	<td style="text-align:center;"><?php  echo $item['content'];?></td>
						<td style="text-align:center;">
						<a class="btn btn-xs btn-info"  href="<?php  echo web_url('editaward', array('id' => $item['id']))?>"><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>
						&nbsp;&nbsp;
						<a class="btn btn-xs btn-danger" href="<?php  echo web_url('deleteaward', array('id' => $item['id']))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>

<?php  include page('footer');?>