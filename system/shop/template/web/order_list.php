<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>

	<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>/addons/common/css/datetimepicker.css" />
		<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/datetimepicker.js"></script>

<script>
	function cleartime()
	{
	document.getElementById("begintime").value='';
	document.getElementById("endtime").value='';
	}
	</script>
	<h3 class="header smaller lighter blue">订单管理</h3>
	
<form action="" target="_blank">
	<input type="hidden" name="name" value="addon16" />
	<input type="hidden" name="do"  value="print" />
	<input type="hidden" name="op"  value="normal_print" />
		<input type="hidden" name="mod"  value="site" />
	<input type="hidden" name="beid"  value="<?php echo $_CMS['beid'];?>" />
	<input type="hidden" name="print_orderid" id="print_orderid" value="" />
		<div id="modal-normalprint" class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">快递单打印</h4>
      </div>
      <div class="modal-body">
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 打印模板：</label>

										<div class="col-sm-9">
														<select name="print_modle_id"  >
																	<?php  foreach($normal_order_list as $item){?>
										<option value="<?php echo $item['id'];?>" data-name=""><?php echo $item['name'];?></option>
										
													<?php } ?>
                                        </select>
										</div>
									</div>
      	
      	
      	  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > </label>

										<div class="col-sm-9">
      								</div>
									</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="do_normal_print" value="yes">打印</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</form>

<form action="" target="_blank">
		<input type="hidden" name="name" value="addon16" />
	<input type="hidden" name="do"  value="print" />
	<input type="hidden" name="op"  value="express_print" />
			<input type="hidden" name="mod"  value="site" />
				<input type="hidden" name="beid"  value="<?php echo $_CMS['beid'];?>" />
	<input type="hidden" name="print_express_orderid" id="print_express_orderid" value="" />
		<div  id="modal-expressprint"  class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">发货单打印</h4>
      </div>
      <div class="modal-body">
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 打印模板：</label>

										<div class="col-sm-9">
														<select name="print_modle_id"  >
																	<?php  foreach($express_order_list as $item){?>
										<option value="<?php echo $item['id'];?>" data-name=""><?php echo $item['name'];?></option>
										
													<?php } ?>
                                        </select>
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > </label>

										<div class="col-sm-9">
      								</div>
									</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="do_normal_print" value="yes">打印</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
</form>
	
<form action="" method="get">
	
	<input type="hidden" name="mod" value="site"/>
	<input type="hidden" name="name" value="shop"/>
	<input type="hidden" name="do" value="order"/>
	<input type="hidden" name="op" value="display"/>
		<input type="hidden" name="beid"  value="<?php echo $_CMS['beid'];?>" />
	<input type="hidden" name="status" value="<?php  echo $_GP['status'];?>"/>
				 <table  class="table" style="width:95%;" align="center">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">订单编号：</td>
			<td  style="width:300px">
<input name="ordersn" type="text" value="<?php  echo $_GP['ordersn'];?>" /> 
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">下单时间：</td>
			<td >
<input name="begintime" id="begintime" type="text" value="<?php  echo $_GP['begintime'];?>" readonly="readonly"  /> - <input id="endtime" name="endtime" type="text" value="<?php  echo $_GP['endtime'];?>" readonly="readonly"  /> <a href="javascript:;" onclick="cleartime()">清空</a>
		
			<script type="text/javascript">
		$("#begintime").datetimepicker({
			format: "yyyy-mm-dd hh:ii",
			minView: "0",
			//pickerPosition: "top-right",
			autoclose: true
		});
	</script> 
	<script type="text/javascript">
		$("#endtime").datetimepicker({
			format: "yyyy-mm-dd hh:ii",
			minView: "0",
			autoclose: true
		});
	</script>
			</td>	
						</tr>
					<tr>
											<td style="vertical-align: middle;font-size: 14px;font-weight: bold;">支付方式：</td>
			<td >
				<select style="margin-right:15px;" id="paytype" name="paytype" > 
					 <option value="" <?php  echo empty($_GP['paytype'])?'selected':'';?>>--未选择--</option>
				<?php  if(is_array($payments)) { foreach($payments as $item) { ?>
                 <option value="<?php  echo $item["code"];?>" <?php  echo $item['code']==$_GP['paytype']?'selected':'';?>><?php  echo $item['name']?></option>
                  	<?php  } } ?>
                   </select>
                   
			</td>	
			
		<td style="vertical-align: middle;font-size: 14px;font-weight: bold;">用户UID:</td>
								<td ><input name="userid" type="text" value="<?php  echo $_GP['userid'];?>" /></td>
									</tr>
						
								
						
						
					<tr>
											<td style="vertical-align: middle;font-size: 14px;font-weight: bold;">收货人姓名/<br>收货人手机：</td>
			<td >
<input name="address_value" type="text" value="<?php  echo $_GP['address_value'];?>" />
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">商品名称：</td>
			<td >
<input name="good_name" type="text" value="<?php  echo $_GP['good_name'];?>" />
			</td>	
						</tr>
						
						<tr>
						<td style="font-size: 14px;font-weight: bold;">微信昵称：</td>
								<td ><input name="weixin_nickname" type="text" value="<?php  echo $_GP['weixin_nickname'];?>" /></td>
								

								
							<td colspan="2"><input type="submit" name="submit" value=" 查 询 " class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="report" value="report" class="btn btn-warning">导出excel</button></td>
						
						</tr>
					</tbody>
				</table>
			</form>
			
			
<h3 class="blue">	<span style="font-size:18px;"><strong>订单总数：<?php echo $total ?></strong></span></h3>
			<ul class="nav nav-tabs" >
	<li style="width:10%" <?php  if($status == -99) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -99))?>">全部</a></li>
	<li style="width:10%" <?php  if($status == 0) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => 0))?>">待付款</a></li>
	<li style="width:10%" <?php  if($status == 1) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => 1))?>">待发货</a></li>
	<li style="width:10%" <?php  if($status == 2) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => 2))?>">待收货</a></li>
	<li style="width:10%" <?php  if($status == 3) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => 3))?>">已完成</a></li>
	<li style="width:10%" <?php  if($status == -1) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -1))?>">已关闭</a></li>
		<li style="width:10%" <?php  if($status == -2) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -2))?>">退款中</a></li>
		<li style="width:10%" <?php  if($status == -6) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -6))?>">已退款</a></li>

</ul>
		

<table class="table table-striped table-bordered table-hover" style="font-size:14px;">
			<thead >
				<tr>
					<th >订单编号</th>
					<th >微信昵称<br/>/用户手机号</th>
					<th>收货人姓名<br>/联系电话</th>
					<th >支付方式</th>
					<th >总价</th>         
					<th >状态</th>
					
					<th >下单时间</th>
					<th >操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
					<?php  if(empty($item['status'])||$item['status']==-1) {?>
				<tr>
					<td><?php  echo $item['ordersn'];?>
<?php  if( $item['isguest']==1){?>
						<br/><span class="label label-success">未注册账户</span><?php  }?>
					
						</td>
					<td><?php  echo $item['uname'];?></td>
					<td>收货人：<?php  echo $item['address_realname'];?><br/>联系电话：<?php  echo $item['address_mobile'];?></td>
				
					<td>
					<?php  if(!empty($item['paytypename'])){?><?php  echo $item['paytypename'];?><?php  } ?>
						</td>
					<td><?php  echo $item['price'];?> 元 
											<?php  if($item['dispatchprice']>0) { ?><br/>(含运费<?php  echo $item['dispatchprice'];?>)<?php  }?>
						</td>
					<td><?php  if($item['status'] == 0) { ?><span class="label label-warning" >待付款</span><?php  } ?>
															<?php  if($item['status'] == -1) { ?><span class="label label-danger" >已关闭</span><?php  } ?>
						</td>
								
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
		
					<td><a class="btn btn-xs btn-info"  href="<?php  echo web_url('order', array('op' => 'detail', 'id' => $item['id'],'isall'=>1))?>"><i class="icon-edit"></i>操作</a>

						</td>
				</tr>
				<?php }else{ ?>
				
						
				<?php  if(!empty($item['is_be'])&&empty($_GP['only_shop'])&&(empty($_GP['good_name'])||!empty($_GP['good_name'])&&empty($_GP['is_good_system']))) {
					
										if($_GP['status']==-99
							||($_GP['status']==1&&$item['be_status']==0)
							||($_GP['status']==2&&$item['be_status']==2)
							||($_GP['status']==3&&$item['be_status']==3)
								||($_GP['status']==-1&&$item['be_status']==-1)
							||($_GP['status']==-2&&$item['be_status']==-2)
								||($_GP['status']==-6&&$item['be_status']==-6))
							 {
					?>
				<tr>
					<td><?php  echo $item['be_ordersn'];?>
<?php  if( $item['isguest']==1){?>
						<br/><span class="label label-success">未注册账户</span><?php  }?>
						
						</td>
											<td><?php  echo $item['uname'];?></td>
					<td>收货人：<?php  echo $item['address_realname'];?><br/>联系电话：<?php  echo $item['address_mobile'];?></td>
					<td>
					<?php  if(!empty($item['paytypename'])){?><?php  echo $item['paytypename'];?><?php  } ?>
						</td>
					<td><?php  echo $item['be_goodsprice']+$item['be_dispatchprice'];?> 元 
											<?php  if($item['be_dispatchprice']>0) { ?><br/>(含运费<?php  echo $item['be_dispatchprice'];?>)<?php  }?>
						</td>
					<td>
								<?php   if($item['be_hasrest']==1) {?><span class="label label-danger" >部分退换货</span>
					<?php  }else{ ?>	
						<?php  if($item['be_status'] == 0) { ?><span class="label label-danger" >待发货</span><?php  } ?>		
						<?php  if($item['be_status'] == 1) { ?><span class="label label-danger" >待发货</span><?php  } ?>
						<?php  if($item['be_status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
						<?php  if($item['be_status'] == 3) { ?><span class="label label-success" >已完成</span><?php  } ?>
						<?php  if($item['be_status'] == -1) { ?><span class="label label-danger">已关闭</span><?php  } ?>
						<?php  if($item['be_status'] == -2) { ?><span class="label label-danger">退款中</span><?php  } ?>
						<?php  if($item['be_status'] == -3) { ?><span class="label label-danger">换货中</span><?php  } ?>
						<?php  if($item['be_status'] == -4) { ?><span class="label label-danger">退货中</span><?php  } ?>
						<?php  if($item['be_status'] == -5) { ?><span class="label label-success">已退货</span><?php  } ?>
						<?php  if($item['be_status'] == -6) { ?><span class="label  label-success">已退款</span><?php  } ?>
			<?php  } ?>
						</td>
							
					<td><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
		
					<td><a class="btn btn-xs btn-info"  href="<?php  echo web_url('order', array('op' => 'detail', 'id' => $item['id'],'isbe'=>1))?>"><i class="icon-edit"></i>操作</a>

						</td>
				</tr>
						<?php  }} ?>
						
						
					<?php } ?>	
						
				<?php  } } ?>
			</tbody>
		</table>
		<?php  echo $pager;?>

<?php  include page('footer');?>
