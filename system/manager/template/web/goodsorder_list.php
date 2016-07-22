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
	
<form action="" method="get">
	
	<input type="hidden" name="mod" value="site"/>
	<input type="hidden" name="name" value="manager"/>
	<input type="hidden" name="do" value="goodsorder"/>
	<input type="hidden" name="op" value="display"/>
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
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;">用户UID：</td>
			<td >
<input name="userid" type="text" value="<?php  echo $_GP['userid'];?>" />
			</td>	
						</tr>
						
								
						
						
									<tr>
											<td style="vertical-align: middle;font-size: 14px;font-weight: bold;">收货人姓名/<br>收货人手机：</td>
			<td >
<input name="address_value" type="text" value="<?php  echo $_GP['address_value'];?>" />
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">商品名称：</td>
			<td >
<input name="good_name" type="text" value="<?php  echo $_GP['good_name'];?>" />
<input name="is_good_system" value="0" id="is_good_system" <?php  if(empty($_GP['is_good_system'])) { ?>checked="true"<?php  } ?>  type="radio">分店商品
<input name="is_good_system" value="1" id="is_good_system" <?php  if($_GP['is_good_system'] == 1) { ?>checked="true"<?php  } ?> type="radio">总店商品
			</td>	
						</tr>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">分公司名称：</td>
			<td  style="width:300px">
		 <select  style="margin-right:15px;" id="pcate" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off">
                <option value="0">请选择分公司</option>
         		  <?php  if(is_array($companyli)) { foreach($companyli as $row) { ?>
       
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GP['pcate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['compName'];?></option>
            
                <?php  } } ?>
            </select>
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">销售员：</td>
			<td >
			  <select  id="cate_2" name="ccate" autocomplete="off">
                <option value="0">请选择销售员</option>
            </select>
			</td>	
						</tr>
						<tr>
				<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">店铺</td>
								<td > <select  id="xbeid"   name="xbeid" autocomplete="off">
                <option value="0">请选择店铺</option>
                    <?php   foreach($store_list as $storeitem) { ?>
			 			<option value="<?php echo $storeitem['id'];?>"><?php echo $storeitem['sname'];?></option>
			 					<?php   } ?>
            </select></td>	
							<td colspan="2"><input type="submit" name="submit" value=" 查 询 " class="btn btn-primary">&nbsp;&nbsp;&nbsp;<input name="only_shop" id="only_zong" value="1" type="checkbox" <?php  if(!empty($_GP['only_shop'])) { ?>checked<?php  } ?>>只查总店订单</td>
						
						</tr>
					</tbody>
				</table>
			</form>
			<script language="javascript">
		var category = <?php  echo json_encode($children)?>;
   function fetchChildCategory(cid) {
	var html = '<option value="0">请选择销售员</option>';
	if (!category || !category[cid]) {
		$('#cate_2').html(html);
		return false;
	}
	for (i in category[cid]) {
		html += '<option value="'+category[cid][i][0]+'">'+category[cid][i][1]+'</option>';
	}
	$('#cate_2').html(html);
}

fetchChildCategory(document.getElementById("pcate").options[document.getElementById("pcate").selectedIndex].value);
<?php if(!empty( $_GP['ccate'])){?>
   document.getElementById("cate_2").value="<?php echo $_GP['ccate']?>";
 <?php }?>
<?php if(!empty( $_GP['xbeid'])){?>
   document.getElementById("xbeid").value="<?php echo $_GP['xbeid']?>";
 <?php }?>
	</script>
			
<h3 class="blue">	<span style="font-size:18px;"><strong>订单总数：<?php echo $total ?></strong></span></h3>
			<ul class="nav nav-tabs" >
	<li style="width:10%" <?php  if($status == -99) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'goodsorder','op' => 'display', 'status' => -99))?>">全部</a></li>
		<li style="width:10%" <?php  if($status == -11) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'goodsorder','op' => 'display', 'status' => -11))?>">换货中</a></li>		
		<li style="width:10%" <?php  if($status == -12) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'goodsorder','op' => 'display', 'status' => -12))?>">退货中</a></li>
	<li style="width:10%" <?php  if($status == -13) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'goodsorder','op' => 'display', 'status' => -13))?>">已换货</a></li>		
		<li style="width:10%" <?php  if($status == -14) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'goodsorder','op' => 'display', 'status' => -14))?>">已退货</a></li>

</ul>
		<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
					<th >商品名称</th>  
					<th >订单编号</th> 
					<th >商品单价</th>
					<th >数量</th> 
						<th >店铺</th>
							<th >销售员</th>
					<th>收货人</th>
					<th >联系电话</th>
					<th >支付方式</th>     
					<th >状态</th>
					<th >操作</th>
				</tr>
			</thead>
			<tbody>
							<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
<td>
						<?php  echo $item['title'];?> <?php  if(!empty($item['optionname'])){?><br/>[<?php  echo $item['optionname'];?>]<?php  } ?>
					
						<?php  if( empty($item['is_system'])){?><br/><span class="label label-danger" >分店商品</span><?php  } ?>	
						</td>
<td><?php  if( empty($item['is_system'])){?><?php  echo $item['be_ordersn'];?><?php  } ?> <?php  if(!empty($item['is_system'])){?><?php  echo $item['zong_ordersn'];?><?php  } ?>

					
						</td>
							
								<td>
						<?php  echo $item['price'];?>
						</td>
								<td>
						<?php  echo $item['total'];?>
						</td>
						<?php $store=getStoreBeid($item['beid']);?>
								<td><?php echo $store['sname'];?></td>
									<td><?php echo $store['realname'];?></td>
					<td><?php  echo $item['address_realname'];?></td>
					<td><?php  echo $item['address_mobile'];?></td>
					<td> 	
						<?php  echo $item['paytypename'];?>
						</td>
					
							<td>
					<?php  if($item['status'] == -3) { ?><span class="label label-danger" >换货中</span><?php  } ?>
						<?php  if($item['status'] == -7) { ?><span class="label label-warning">换货商品待收货</span><?php  } ?>
						<?php  if($item['status'] == -4) { ?><span class="label label-danger" >退货中</span><?php  } ?>
						<?php  if($item['status'] == -5) { ?><?php  if( empty($item['is_system'])){?><?php  if($item['be_return_money'] ==2) { ?><span class="label label-success">已退货</span><?php  } ?><?php  if($item['be_return_money'] ==1) { ?><span class="label label-danger">已退货待退款</span><?php  } ?><?php  }else{ ?><span class="label label-success">已退货</span><?php  } ?><?php  } ?>
							<?php  if($item['status'] == -6) { ?><span class="label label-success">已退款</span><?php  } ?>
									<?php  if($item['status']==1&&$item['restatus'] == 1) { ?><span class="label label-success">已换货</span><?php  } ?>
						</td>
						<td><a class="btn btn-xs btn-info"  href="<?php  echo web_url('goodsorder', array('op' => 'detail', 'id' => $item['orderid'], 'ogid' => $item['id']))?>"><i class="icon-edit"></i>操作</a>
				</tr>		<?php  } }?>
					</tbody>
		</table>
	<?php  echo $pager;?>
<?php  include page('footer');?>
