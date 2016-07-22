<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue">订单详情</h3>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
<input type="hidden" name="id" value="<?php  echo $order['id'];?>">
		<table class="table">
			<tr>
			<th style="width:150px"><label for="">订单编号:</label></th>
				<td >
					<?php  echo $order['zong_ordersn']?>	
				</td>
			<th style="width:150px"><label for="">订单状态:</label></th>
				<td >
					
								<?php   if($order['zong_hasrest']==1) {?><span class="label label-danger" >部分退换货</span>
					<?php  }else{ ?>	
													<?php  if($order['zong_status'] == 0) { ?><span class="label label-danger" >待发货</span><?php  } ?>		
						<?php  if($order['zong_status'] == 1) { ?><span class="label label-danger" >待发货</span><?php  } ?>
						<?php  if($order['zong_status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
						<?php  if($order['zong_status'] == 3) { ?><span class="label label-success" >已完成</span><?php  } ?>
						<?php  if($order['zong_status'] == -1) { ?><span class="label label-danger">已关闭</span><?php  } ?>
						<?php  if($order['zong_status'] == -2) { ?><span class="label label-danger">退款中</span><?php  } ?>
						<?php  if($order['zong_status'] == -3) { ?><span class="label label-danger">换货中</span><?php  } ?>
						<?php  if($order['zong_status'] == -4) { ?><span class="label label-danger">退货中</span><?php  } ?>
						<?php  if($order['zong_status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
						<?php  if($order['zong_status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
			<?php  } ?>
				</td>
			</tr>
			<tr>
			<th ><label for="">下单时间:</label></th>
				<td >
									<?php  echo date('Y-m-d H:i:s', $order['createtime'])?>
				</td>
				<th ><label for="">订单金额:</label></th>
				<td >
					<?php  echo $order['zong_goodsprice']+$order['zong_dispatchprice'];?>
				</td>
			</tr>
					<tr>
			<th ><label for="">快递金额:</label></th>
				<td >
							<?php  echo $order['zong_dispatchprice']?>
				</td>
				<th ><label for="">支付总金额:</label></th>
				<td >
						<?php  echo $order['price']?>		
						
								<?php  if(!empty($order['is_be'])) { ?>(含分店订单<?php  echo $order['be_goodsprice']+$order['be_dispatchprice']?>元)<?php  } ?>
				</td>
			</tr>
			<tr>
				<th ><label for="">支付方式:</label></th>
				<td >
					<?php  if(!empty($order['paytypename'])) { ?>	<?php  echo $order['paytypename'];?><?php  }else{ ?>未选择<?php  } ?>
				</td>
				<th ><label for="">配送方式:</label></th>
				<td >
						<?php  echo $order['dispatch_name']?>
				</td>
			</tr>
			
		<tr>
<th ><label for="">用户UID</label></th>
				<td >
								<?php echo $order['openid']; ?>	
				</td>
					<th ><label for="">微信昵称/用户手机号:</label></th>
				<td >
						<?php echo empty($order_member['nickname'])?$order_member['mobile']:$order_member['nickname']; ?>
				</td>
				</tr>
				
								 <?php  if($order['zong_status'] >1&&!empty($order['expresscom'])) { ?>
							 					<tr>
<th ><label for="">发货方式：</label></th>
				<td >		<?php echo $order['expresscom'];?>
				</td>
					<th ><label for="">快递单号:</label></th>
				<td >
	<?php echo $order['expresssn'];?><?php  if(!empty($order['expresssn'])&&!empty($order['express'])&&$order['express']!="-1"){?>
					<a target="_blank" href="http://m.kuaidi100.com/index_all.html?type=<?php  echo $order['express']?>&postid=<?php  echo $order['expresssn']?>#input"  >
			[查看物流信息]<?php } ?>
				</td>
				</tr>
							 
							 
							 <?php  } ?>
				
	
	<tr>
			<th style="width:150px"><label for="">支付订单:</label></th>
				<td >
					<?php  echo $order['ordersn'].'-'.$order['id'];?>	
				</td>
		<th style="width:150px"><label for=""><?php  if($order['zong_status'] == -6) { ?>退款金额:<?php  } ?></label></th>
				<td >
					
						<?php  if($order['zong_status'] == -6) { ?><?php  echo $order['zong_returnmoney']?><?php  } ?>
				</td>
			</tr>
			
		
			</table>

			<h3 class="header smaller lighter blue">收货人信息</h3>
		
			<table class="table ">
					<tr>
				<th style="width:150px"><label for="">收货人姓名:</label></th>
				<td >
					<?php  echo $order['address_realname']?>
				</td>
				<th style="width:150px"><label for="">收货地址:</label></th>
				<td >
		<?php  echo $order['address_province'];?><?php  echo $order['address_city'];?><?php  echo $order['address_area'];?><?php  echo $order['address_address'];?>
				</td>
			</tr>
				<tr>
								<th ><label for="">联系电话:</label></th>
				<td >
						<?php  echo $order['address_mobile']?>
				</td>
				<th ><label for="">订单备注:</label></th>
				<td >
					   <input type='text' readonly="readonly"  class='input span3' value="<?php  echo $order['remark'];?>" />
				</td>
			</tr>
		<?php  if(($order['zong_status'] ==-2||$order['zong_status'] ==-6)&&!empty($order['rsreson'])) { ?>
			<tr>
				<th ><label for="">	退款原因</label></th>
				<td >
					<textarea readonly="readonly" style='width:300px;border: none;' type="text"><?php  echo $order['rsreson'];?></textarea>		
				</td>
				<th ></th>
				<td>
		
				</td>
			</tr>
			<?php  } ?>
		</table>
		
		
		
		<h3 class="header smaller lighter blue">订单详情</h3>
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="width:50px;">序号</th>
					<th >商品标题</th>
            <th >商品规格</th>
					<th >货号</th>
					
          <th style="color:red;">成交价</th>
					<th >数量</th>
					<th >状态</th>
				</tr>
			</thead>
			<?php  $i=1;?>
			<?php  if(is_array($order['goods'])) { foreach($order['goods'] as $goods) {?>  <?php if(!empty($goods['is_system'])){?> 
			<tr>
				<td><?php  echo $i;$i++?></td>
				<td><?php  echo $goods['title'];?><?php if(!empty($goods['is_system'])){?>【总店商品】<?php }?><?php if(empty($goods['is_system'])){?>【分店商品】<?php }?>
		
					
                                </td>
                                <td> <?php  if(!empty($goods['optionname'])) { ?><?php  echo $goods['optionname'];?><?php  } ?></td>
				<td><?php  echo $goods['goodssn'];?></td>

         <td style='color:red;font-weight:bold;'><?php  echo $goods['price'];?></td>
				<td><?php  echo $goods['total'];?></td>
				<td>
			<?php  if($order['zong_status'] == 0) { ?><span class="label label-danger" >待发货</span><?php  } ?>		
						<?php  if($order['zong_status'] == 1) { ?><span class="label label-danger" >待发货</span><?php  } ?>
				 <?php  if($order['zong_status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
					<?php  if($goods['status'] == 1&&$goods['restatus'] ==0) { ?><span class="label label-success" >已收货</span><?php  } ?>
									<?php  if($goods['status'] == -3) { ?><span class="label label-danger" >换货中</span><?php  } ?>
						<?php  if($goods['status'] == -7) { ?><span class="label label-warning">换货商品待收货</span><?php  } ?>
						<?php  if($goods['status'] == -4) { ?><span class="label label-danger" >退货中</span><?php  } ?>
						<?php  if($goods['status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
							<?php  if($goods['status']==-5) { ?>	<?php  if(empty($goods['returnmoneytype'])) { ?>退款到余额：<?php  echo $goods['returnmoney']; ?>元<?php  }else{ ?>已退款：<?php  echo $goods['returnmoney']; ?>元<?php  }?>	<?php  } ?>
								<?php  if($goods['status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
									<?php  if($goods['status']==1&&$goods['restatus'] == 1) { ?><span class="label label-success">已换货</span><?php  } ?></td>
			</tr>  <?php }?>
			<?php  } } ?>
		</table>
		
			<?php if(!empty($order['zong_remark'])) { ?>
			<table class="table table-hover">
		<tr>
				<td style="width:130px">总店订单备注：</td>
				<td>
					<textarea style="height:50px;" disabled="disabled" class="span7" name="zong_remark" cols="70" ><?php  echo $order['zong_remark']?></textarea>		
				</td>	
					</table>
								<?php  } ?>
	</form>