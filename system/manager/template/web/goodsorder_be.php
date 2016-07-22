<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue">订单详情</h3>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
<input type="hidden" name="id" value="<?php  echo $order['id'];?>">
		<table class="table">
			<tr>
			<th style="width:150px"><label for="">订单编号:</label></th>
				<td >
					<?php  echo $order['be_ordersn']?>	
				</td>
			<th style="width:150px"><label for="">订单状态:</label></th>
				<td >
					
							<?php   if($order['be_hasrest']==1) {?><span class="label label-danger" >部分退换货</span>
					<?php  }else{ ?>	
													<?php  if($order['be_status'] == 0) { ?><span class="label label-danger" >待发货</span><?php  } ?>		
						<?php  if($order['be_status'] == 1) { ?><span class="label label-danger" >待发货</span><?php  } ?>
						<?php  if($order['be_status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
						<?php  if($order['be_status'] == 3) { ?><span class="label label-success" >已完成</span><?php  } ?>
						<?php  if($order['be_status'] == -1) { ?><span class="label label-danger">已关闭</span><?php  } ?>
						<?php  if($order['be_status'] == -2) { ?><span class="label label-danger">退款中</span><?php  } ?>
						<?php  if($order['be_status'] == -3) { ?><span class="label label-danger">换货中</span><?php  } ?>
						<?php  if($order['be_status'] == -4) { ?><span class="label label-danger">退货中</span><?php  } ?>
						<?php  if($order['be_status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
						<?php  if($order['be_status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
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
					<?php  echo $order['be_goodsprice']+$order['be_dispatchprice'];?>
				</td>
			</tr>
					<tr>
			<th ><label for="">快递金额:</label></th>
				<td >
							<?php  echo $order['be_dispatchprice']?>
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
						<?php  echo $order['be_dispatch_name']?>
				</td>
			</tr>
			
		<tr>
<th ><label for="">用户UID</label></th>
				<td >
								<?php echo $order['openid']; ?>	
				</td>
					<th ><label for="">微信昵称:</label></th>
				<td >
						<?php   if(!empty($weixin_wxfans)) {?>	<?php foreach($weixin_wxfans as $wxfans) { ?>
						<?php echo $wxfans['nickname']; ?>
						<?php  }?>	<?php  } ?>
				</td>
				</tr>
					<tr>
<th ><label for="">店铺</label></th>
				<td >		<?php $store=getStoreBeid($order['beid']);?>
					<?php echo $store['sname'];?>
				</td>
					<th ><label for="">销售员:</label></th>
				<td >
	<?php echo $store['realname'];?>
				</td>
				</tr>
				
				
							 <?php  if($order['be_status'] >1) { ?>
							 					<tr>
<th ><label for="">发货方式：</label></th>
				<td >		<?php echo $order['be_expresscom'];?>
				</td>
					<th ><label for="">快递单号:</label></th>
				<td >
	<?php echo $order['be_expresssn'];?><?php  if(!empty($order['be_expresssn'])&&!empty($order['be_express'])&&$order['be_express']!="-1"){?>
					<a target="_blank" href="http://m.kuaidi100.com/index_all.html?type=<?php  echo $order['be_express']?>&postid=<?php  echo $order['be_expresssn']?>#input"  >
			[查看物流信息]<?php } ?>
				</td>
				</tr>
							 
							 
							 <?php  } ?>
				
	

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

		</table>
						<?php  if(!empty($goods['rsreson'])){?>
			<table class="table ">
					<tr>
				<th style="width:150px"><label for="">原因:</label></th>
				<td ><textarea readonly="readonly" style='width:300px;border: none;' type="text"><?php  echo $goods['rsreson'];?></textarea></td>
			</tr>
					</table>	<?php  } ?>
		<h3 class="header smaller lighter blue">商品详情</h3>
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th >商品标题</th>
            <th >商品规格</th>
					
          <th style="color:red;">成交价</th>
					<th >数量</th>
					<th >状态</th>
				</tr>
			</thead>
	

			<tr>
				<td><?php  echo $goods['title'];?></td>
        <td> <?php  if(!empty($goods['optionname'])) { ?><?php  echo $goods['optionname'];?><?php  } ?></td>
				 <td ><?php  echo $goods['price'];?></td>
				<td><?php  echo $goods['total'];?></td>
					<td>
	<?php  if($order['be_status'] == 0) { ?><span class="label label-danger" >待发货</span><?php  } ?>		
						<?php  if($order['be_status'] == 1) { ?><span class="label label-danger" >待发货</span><?php  } ?>
				 <?php  if($order['be_status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
					<?php  if($goods['status'] == 1&&$goods['restatus'] ==0) { ?><span class="label label-success" >已收货</span><?php  } ?>
									<?php  if($goods['status'] == -3) { ?><span class="label label-danger" >换货中</span><?php  } ?>
						<?php  if($goods['status'] == -7) { ?><span class="label label-warning">换货商品待收货</span><?php  } ?>
						<?php  if($goods['status'] == -4) { ?><span class="label label-danger" >退货中</span><?php  } ?>
						<?php  if($goods['status'] == -5) { ?><?php  if($goods['be_return_money'] ==2) { ?><span class="label label-success">已退货</span><?php  } ?><?php  } ?>
							<?php  if($goods['status']==-5) { ?>		<?php  if($goods['be_return_money'] ==2) { ?><?php  if(empty($goods['returnmoneytype'])) { ?>退款到余额：<?php  echo $goods['returnmoney']; ?>元<?php  }else{ ?>已退款：<?php  echo $goods['returnmoney']; ?>元<?php  }?><?php  }else{ ?><span class="label label-danger" >已退货待退款</span>	<?php  } ?><?php  } ?>
								<?php  if($goods['status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
									<?php  if($goods['status']==1&&$goods['restatus'] == 1) { ?><span class="label label-success">已换货</span><?php  } ?></td>
					</tr>

		</table>

							<table class="table" >
			<tr>
				<th  style="width:50px"></th>
				<td>
			
						 
			
				
							<?php  if($goods['status'] ==-7) { ?>
					<button type="submit" class="btn btn-success span2" onclick="return confirm('确认收货吗？'); return false;" name="finishgoods" value="finishgoods">确认收货</button>
				<?php  } ?>

								<?php  if($goods['status']==-5) { ?>		<?php  if($goods['be_return_money'] ==1) { ?>
									<button type="button" class="btn span2  btn-danger" name="be_returnmoney_pre" value="be_returnmoney_pre" data-toggle="modal" data-target="#modal-be_returnmoney">商品退款</button>
				
								
									<?php  } ?><?php  } ?>
						
	
					
					
				</td>
			</tr>
		</table>
		
		<div id="modal-be_returnmoney" class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">商品退款</h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 退款到：</label>

									<div class="col-sm-9">
												   <input name="returnmoneytype" value="0" checked="true" type="radio"> 账户余额  &nbsp;&nbsp;
             
              		  <input name="returnmoneytype" value="1" type="radio"> 其他打款
             
										</div>
									</div>
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 退款金额：</label>

										<div class="col-sm-9">
											
												<input type="text" name="returnmoney" class="span5" value="<?php echo ($goods['price']*$goods['total']);?>" />
											</div>
									</div>
      	
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="be_good_returnmoney" value="be_good_returnmoney"  onclick="return confirm('确定退款此订单吗？'); return false;">确认退款</button>
      	
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
		
	</form>