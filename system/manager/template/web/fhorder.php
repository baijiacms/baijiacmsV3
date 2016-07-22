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
	<h3 class="header smaller lighter blue">订单返还</h3>
	
<form action="" method="get">
	
	<input type="hidden" name="mod" value="site"/>
	<input type="hidden" name="name" value="manager"/>
	<input type="hidden" name="do" value="fhorder"/>
	<input type="hidden" name="op" value="display"/>
	<input type="hidden" name="status" value="<?php  echo $_GP['status'];?>"/>
				 <table  class="table" style="width:95%;" align="center">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">订单编号：</td>
			<td  >
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
											<td style="vertical-align: middle;font-size: 14px;font-weight: bold;">分公司：</td>
			<td >
	 <select  style="margin-right:15px;" id="pcate" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off">
                <option value="0">请选择分公司</option>
         		  <?php  if(is_array($companyli)) { foreach($companyli as $row) { ?>
       
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GP['pcate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['compName'];?></option>
            
                <?php  } } ?>
            </select>
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:100px">销售员：</td>
			<td >
	  <select  id="cate_2" name="ccate" autocomplete="off">
                <option value="0">请选择销售员</option>
            </select>&nbsp;&nbsp;&nbsp;<input name="only_zong" id="only_zong" value="1" type="checkbox" <?php  if(!empty($_GP['only_zong'])) { ?>checked<?php  } ?>>只查总部商品&nbsp;&nbsp;<input type="submit" name="submit" value=" 查 询 " class="btn btn-primary">
			</td>	
						</tr>
						
						
						
						
					</tbody>
				</table>
				
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

	</script>
			</form>
			
			
			<ul class="nav nav-tabs" >
	<li style="width:10%" <?php  if($status == 0) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'fhorder','op' => 'display', 'status' => 0))?>">可返还</a></li>
	<li style="width:10%" <?php  if($status == 1) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'fhorder','op' => 'display', 'status' => 1))?>">待返还</a></li>
	<li style="width:10%" <?php  if($status == 2) { ?> class="active"<?php  } ?>><a href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'fhorder','op' => 'display', 'status' => 2))?>">已返还</a></li>
</ul>
		

<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
						<th >订单编号</th>
					<th >商品名称</th>
					<th >商品数量</th>
					<th>商品价格</th>
					<th >总金额</th>     
				
					<th >店铺</th>
					<th >销售员</th> 
					<th >返还金额</th>
					<th >操作</th>
				</tr>
			</thead>
			<tbody>
				<?php  if(is_array($list)) { foreach($list as $item) { ?>
				<tr style="background:#efefef;">
					<td>
										<?php  if(!empty($item['is_system'])){ ?><?php  echo $item['zong_ordersn'];?><?php } ?>
						<?php  if(empty($item['is_system'])){ ?><?php  echo $item['be_ordersn'];?><?php } ?>
						<br/>支付单号：<?php  echo $item['ordersn'];?><br/>下单时间：<?php  echo date('Y-m-d H:i:s', $item['createtime'])?>
						</td>
						  <td><?php  if(empty($item['fhtype'])){ ?><?php  echo $item['title'];?><?php  if(!empty($item['optionname'])){ ?><br/>[<?php  echo $item['optionname'];?>]<?php } ?>
						  	
						  	<?php } ?><?php  if($item['fhtype']==1){ ?>快递费<?php } ?>
						  	</td>
						   <td><?php  if(empty($item['fhtype'])){ ?><?php  echo $item['total'];?><?php } ?></td>
						  <td><?php  if(empty($item['fhtype'])){ ?><?php  echo $item['price'];?>	<?php } ?></td>

						 <td><?php  if(empty($item['fhtype'])){ ?><?php  echo $item['price']*$item['total'];?><?php } ?><?php  if($item['fhtype']==1){ ?><?php  echo $item['fhprice'];?><?php } ?></td>
		
							<?php $store=getStoreBeid($item['beid']);?>
								<td><?php echo $store['sname'];?></td>
									<td><?php echo $store['realname'];?></td>
        	  <td><?php  echo $item['fhprice'];?></td>
			
						<td><?php  if($item['status']!=2){ ?>
							 <?php  if($status == 0) { ?> 
						<a class="btn btn-xs btn-info"  href="<?php  echo create_url('site',  array('name' => 'manager','do'=>'fhorder','op' => 'dotag', 'fid' => $item['id']))?>"><i class="icon-edit"></i>标记打款</a>
<?php  } ?>
<?php  } ?>
					
						</td>
				</tr>
				
						
					
				
				<?php  } } ?>
				
				    			
		</tr>
			</tbody>
		</table>
		<?php  echo $pager;?>

<?php  include page('footer');?>
