<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">兑换申请列表</h3>
		<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th style="text-align:center;min-width:100px;">奖品名称</th>
					<th style="text-align:center;min-width:30px;">类型</th>
					<th style="text-align:center;min-width:30px;">消耗积分</th>
						<th style="text-align:center; min-width:60px;">申请人</th>
							<th style="text-align:center; min-width:80px;">申请电话</th>
					<th style="text-align:center; min-width:180px;">申请地址</th>
								<th style="text-align:center; min-width:50px;">操作</th>
				</tr>
			</thead>
			
			<tbody>
				<?php  if(is_array($awardlist)) { foreach($awardlist as $item) { ?>
				<tr>
					<td style="text-align:center;"><?php  echo $item['title'];?></td>
						<td style="text-align:center;"><?php  echo $item['awardtype']==1?'积分兑换余额:'.$item['gold']:'兑换商品';?></td>
								<td style="text-align:center;"><?php  echo $item['credit_cost'];?></td>
														<td style="text-align:center;"><?php  echo $item['realname'];?></td>
																	<td style="text-align:center;"><?php  echo $item['mobile'];?></td>
											<td style="text-align:center;"><?php  echo $item['address'];?></td>
						<td style="text-align:center;">
						<a class="btn btn-xs btn-danger" href="<?php  echo web_url('submitapplyed', array('id' => $item['id']))?>" onclick="return confirm('此操作不可恢复，确认兑换此申请？');return false;"><i class="icon-edit"></i>&nbsp;兑&nbsp;换&nbsp;</a>
					</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>

<?php  include page('footer');?>