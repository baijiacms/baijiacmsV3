<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue">订单详情</h3>

<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
<input type="hidden" name="id" value="<?php  echo $order['id'];?>">
		<table class="table">
			<tr>
			<th style="width:150px"><label for="">订单编号:</label></th>
				<td >
					<?php  echo $order['ordersn']?>	
				</td>
			<th style="width:150px"><label for="">订单状态:</label></th>
				<td >
					
					
										<?php  if($order['status'] == 0) { ?><span class="label label-warning" >待付款</span><?php  } ?>
															<?php  if($order['status'] == -1) { ?><span class="label label-danger" >已关闭</span><?php  } ?>
									
													<?php  if($order['status'] == 1) { ?><span class="label label-success" >已支付</span><?php  } ?>
			
				</td>
			</tr>
			<tr>
			<th ><label for="">下单时间:</label></th>
				<td >
									<?php  echo date('Y-m-d H:i:s', $order['createtime'])?>
				</td>
				<th ><label for="">订单金额:</label></th>
				<td >
						<?php  echo $order['price']?>
				</td>
			</tr>
					<tr>
			<th ><label for="">快递金额:</label></th>
				<td >
							<?php  echo $order['dispatchprice']?>
				</td>
				<th ><label for="">支付总金额:</label></th>
				<td >
						<?php  echo $order['price']?>		
						
				</td>
			</tr>
			<tr>
				<th ><label for="">支付方式:</label></th>
				<td >
					<?php  if(!empty($order['paytypename'])) { ?>	<?php  echo $order['paytypename'];?><?php  }else{ ?>未选择<?php  } ?>
				</td>
				<th ><label for="">配送方式:</label></th>
				<td >
								
								<?php  if(!empty($order['is_system'])) { ?>总店：<?php  echo $order['dispatch_name']?><br/><?php  } ?>
								<?php  if(!empty($order['is_be'])) { ?><?php  echo $order['be_dispatch_name']?><?php  } ?>
			
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
				<th ></th>
				<td >
				</td>
			</tr>
				<tr>
								<th colspan="1"><label for="">订单备注:</label></th>
				<td colspan="3" >
				  <input type='text' readonly="readonly"  class='input span3' value="<?php  echo $order['remark'];?>" />
				</td>
			</tr>

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
				</tr>
			</thead>
			<?php  $i=1;?>
			<?php  if(is_array($order['goods'])) { foreach($order['goods'] as $goods) {?> 
			<tr>
				<td><?php  echo $i;$i++?></td>
				<td><?php  echo $goods['title'];?><?php if(!empty($goods['is_system'])){?>【总店商品】<?php }?><?php if(empty($goods['is_system'])){?>【分店商品】<?php }?>
		
					
                                </td>
                                <td> <?php  if(!empty($goods['optionname'])) { ?><?php  echo $goods['optionname'];?><?php  } ?></td>
				<td><?php  echo $goods['goodssn'];?></td>

         <td style='color:red;font-weight:bold;'><?php  echo $goods['price'];?></td>
				<td><?php  echo $goods['total'];?></td>
			
			</tr> 
			<?php  } } ?>
		</table>
		
	<table class="table" >
			<tr>
				<th  style="width:50px"></th>
				<td>
					
					
					
							<?php  if(empty($order['status'])) { ?>
					<button type="button" class="btn span2  btn-danger" name="confrimpay_pre"  value="confrimpay_pre" data-toggle="modal" data-target="#modal-confrimpay_pre">确认付款</button>
				
		
					<button type="submit" class="btn span2" name="close" onclick="return confirm('永久关闭此订单吗？'); return false;" value="close">关闭订单</button>
					<?php  } ?>
					
					
				</td>
			</tr>
		</table>
					
					
					
					
					<div id="modal-confrimpay_pre" class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">付款方式</h4>
      </div>
      <div class="modal-body">
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 付款方式：</label>

										<div class="col-sm-9">
													<select name="visual_paycode" id='visual_paycode'>
					                  <?php   foreach($payments as $payitems) { ?>
			 			<option value="<?php echo $payitems['code'];?>" data-name="<?php echo $payitems['name'];?>"><?php echo $payitems['name'];?></option>
			 					<?php   } ?>
													</select>
										</div>
									</div>
      	
      	
      	
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="confrimpay" onclick="return confirm('该订单确认已付款吗？'); return false;"  value="yes">确认退款</button>
      	
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
					
			</form>
		