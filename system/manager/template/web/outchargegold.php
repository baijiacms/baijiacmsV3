<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue">余额提现申请</h3>

			<ul class="nav nav-tabs" >
	<li style="width:10%" <?php  if($status == 0) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'outchargegold','op' => 'display', 'status' => 0))?>">待审核</a></li>
	<li style="width:10%" <?php  if($status == 1) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'outchargegold','op' => 'display', 'status' => 1))?>">已审核</a></li>
	<li style="width:10%" <?php  if($status == -1) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'outchargegold','op' => 'display', 'status' => -1))?>">审核失败</a></li>
</ul>
		

<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th style="width:50px;">序号</th>
					<th >用户UID</th>
						<th >店铺</th>
					<th style="width:100px;">用户名/手机号</th>
					<th >打款账户</th>
					<th >提现金额</th>
					<th style="width:80px;">申请时间</th>
					<th >操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  $index=0; if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					<td><?php  $index=$index+1;echo $index;?></td>
					<td><?php  echo $item['openid'];?></td>
					<td><?php  $store=getStoreBeid($item['beid']);echo $store['sname'];?></td>
					<td><?php  echo empty($item['realname'])?$item['mobile']:$item['realname'];?></td>
				  <td><?php  if(!empty($item['outgoldinfo'])){$outgoldinfo=unserialize($item['outgoldinfo']); ?> 
				  	<?php if($outgoldinfo['outgold_paytype']==1){ ?>
				  	收款银行：<?php  echo $outgoldinfo['outgold_bankname'];?>
				  	收款人姓名：<?php  echo $outgoldinfo['outgold_bankcardname'];?>
				  	收款人账号：<?php  echo $outgoldinfo['outgold_bankcardcode'];?>
				  	<?php }?>
				  	
				  	  	<?php if($outgoldinfo['outgold_paytype']==2){ ?>
				  	支付宝：<?php  echo $outgoldinfo['outgold_alipay'];?>
				  	<?php }?>
				  	  	<?php if($outgoldinfo['outgold_paytype']==3){ ?>
				  	微支付：<?php  echo $outgoldinfo['outgold_weixin'];?>
				  	<?php }?>
				  	
				  	<?php }?></td>
           <td><?php  echo $item['fee'];?></td>
			
					
					<td><?php  echo date('Y-m-d H:i', $item['createtime'])?></td>
		
					<td>
<?php  if($status == 0) { ?>
				
				<a  class="btn btn-xs btn-info" onclick="return confirm('此操作不可恢复，确认审核通过？');return false;" href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'outchargegold','op' => 'post', 'tostatus' => 1,'id'=>$item['id']))?>"><i class="icon-edit"></i>&nbsp;审核通过&nbsp;</a>&nbsp;&nbsp;
				
					<a  class="btn btn-danger  btn-xs btn-info" onclick="return confirm('此操作不可恢复，确认拒绝审核？');return false;" href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'outchargegold','op' => 'post', 'tostatus' => -1,'id'=>$item['id']))?>"><i class="icon-edit"></i>&nbsp;拒绝审核&nbsp;</a>&nbsp;&nbsp;
					<?php  } ?>
						</td>
				</tr>
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>

<?php  include page('footer');?>
