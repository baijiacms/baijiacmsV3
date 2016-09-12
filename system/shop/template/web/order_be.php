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
						
				</td>
			</tr>
			<tr>
				<th ><label for="">支付方式:</label></th>
				<td >
					<?php  if(!empty($order['paytypename'])) { ?>	<?php  echo $order['paytypename'];?><?php  }else{ ?>未选择<?php  } ?><?php  if(!empty($order['weixin_transaction_openid'])) { ?>	微支付用户ID:<?php  echo $order['weixin_transaction_openid'];?><?php  } ?>
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
					<th ><label for="">微信昵称/用户手机号:</label></th>
				<td >
						<?php echo empty($order_member['nickname'])?$order_member['mobile']:$order_member['nickname']; ?>
				</td>
				</tr>
			
							 <?php  if($order['be_status'] >1&&!empty($order['be_expresscom'])) { ?>
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
				
				
					
	<tr>
			<th style="width:150px"><label for="">支付单号:</label></th>
				<td >
					<?php  echo $order['ordersn'].'-'.$order['id'];?>	
				</td>
				<th style="width:150px"><label for=""><?php  if($order['be_status'] == -6) { ?>退款金额:<?php  } ?></label></th>
				<td >
					
						<?php  if($order['be_status'] == -6) { ?><?php  echo $order['be_returnmoney']?><?php  } ?>
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
				<td  colspan="3">
				  <input type='text' readonly="readonly"  class='input span3' value="<?php  echo $order['remark'];?>" />
				</td>
			</tr>
			
							
			<?php  if(($order['be_status'] ==-2||$order['be_status'] ==-6)&&!empty($order['be_rsreson'])) { ?>
			<tr>
				<th ><label for="">	退款原因</label></th>
				<td >
					<textarea readonly="readonly" style='width:300px;border: none;' type="text"><?php  echo $order['be_rsreson'];?></textarea>		
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
			<?php  if(is_array($order['goods'])) { foreach($order['goods'] as $goods) {?>  <?php if(empty($goods['is_system'])){?> 
			<tr>
				<td><?php  echo $i;$i++?></td>
				<td><?php  echo $goods['title'];?><?php if(!empty($goods['is_system'])){?>【总店商品】<?php }?><?php if(empty($goods['is_system'])){?>【分店商品】<?php }?>
		
					
                                </td>
                                <td> <?php  if(!empty($goods['optionname'])) { ?><?php  echo $goods['optionname'];?><?php  } ?></td>
				<td><?php  echo $goods['goodssn'];?></td>

         <td style='color:red;font-weight:bold;'><?php  echo $goods['price'];?></td>
				<td><?php  echo $goods['total'];?></td>
				<td>
							<?php  if($order['be_status'] == 0) { ?><span class="label label-danger" >待发货</span><?php  } ?>		
						<?php  if($order['be_status'] == 1) { ?><span class="label label-danger" >待发货</span><?php  } ?>
				 <?php  if($order['be_status'] == 2) { ?><span class="label label-warning">待收货</span><?php  } ?>
				 
				 
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
		
			<table class="table table-hover">
		<tr>
				<td style="width:130px">订单备注：</td>
				<td>
					<textarea style="height:50px;" class="span7" name="be_remark" cols="70" ><?php  echo $order['be_remark']?></textarea>		<button type="submit" class="btn-success" name="save_be_remark"  value="save_be_remark">保存备注</button>
				</td>	
					</table>
						 
				<table class="table" >
			<tr>
				<th  style="width:50px"></th>
				<td>
					
				
						<?php if($order['status'] == 1&&!empty($order['isverify'])) { ?>
								<button type="submit" class="btn btn-success span2" onclick="return confirm('确认完成此订单吗？'); return false;" name="be_finish" value="be_finish">完成订单</button>
								<?php  } ?>
						 
							
					
					<?php  if($order['be_status'] ==2) { ?>
					<button type="submit" class="btn btn-success span2" onclick="return confirm('确认完成此订单吗？'); return false;" name="be_finish" value="be_finish">完成订单</button>
				<?php  } ?>
					
						<?php  if($order['status']==1&&($order['be_status']==0||$order['be_status']==-2)) { ?>
					<button type="button" class="btn span2" name="be_returnmoney_pre" value="be_returnmoney_pre" data-toggle="modal" data-target="#modal-be_returnmoney">订单退款</button>
					<?php  } ?>
					
					
		
					
					<?php  if(empty($order['status'])&&$order['be_status']==0) { ?>
					<button type="submit" class="btn span2" name="be_close" onclick="return confirm('永久关闭此订单吗？'); return false;" value="be_close">关闭订单</button>
					<?php  } ?>
					<?php  if(empty($order['be_status'])) { ?>
						<button type="button" class="btn btn-primary span2" name="be_confirmsend" data-toggle="modal" data-target="#modal-confirmsend" value="confirmsend">确认发货</button>
				<?php  } ?>

						 
					<?php  if($order['be_status'] == 2) { ?>
						<button type="submit" class="btn btn-danger span2" name="be_cancelsend" onclick="return confirm('取消发货此订单吗？'); return false;" value="be_cancelsend">取消发货</button>
         <?php  } ?>
					
					
				</td>
			</tr>
		</table>
					
		
			<div id="modal-be_returnmoney" class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">订单退款</h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 退款到：</label>

									<div class="col-sm-9">
             
              		  <input name="returnmoneytype" value="1" type="radio" checked="true"> 其他打款
             
										</div>
									</div>
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 退款金额：</label>

										<div class="col-sm-9">
											
												<input type="text" name="returnmoney" class="span5" value="<?php echo ($order['be_goodsprice']+$order['dispatchprice']);?>" />
											</div>
									</div>
      	
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="be_returnmoney" value="be_returnmoney"  onclick="return confirm('确定退款此订单吗？'); return false;">确认退款</button>
      	
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
		
		
		
		<div id="modal-confirmsend" class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">快递信息</h4>
      </div>
      <div class="modal-body">
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 快递公司：</label>

										<div class="col-sm-9">
													<select name="express" id='express'>
															<option value="-1" data-name="">无需快递</option>
					                  <?php   foreach($dispatchlist as $dispatchitem) { ?>
			 			<option value="<?php echo $dispatchitem['code'];?>" data-name="<?php echo $dispatchitem['name'];?>"><?php echo $dispatchitem['name'];?></option>
			 					<?php   } ?>
													</select>
                                       <input type='hidden' class='input span3' name='expresscom' id='expresscom'  />
										</div>
									</div>
      	
      		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 快递单号：</label>

										<div class="col-sm-9">
											
												<input type="text" name="expresssn" class="span5"  autocomplete="off" />
											</div>
									</div>
      	
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary" name="confirmsend" value="yes">确认发货</button>
      	
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
	</form>
<script language='javascript'>
	function jsSelectIsExitItem(objSelect,objItemValue)   
{   
     var isExit = false ;   
     for ( var i=0;objSelect.length>i;i++)   
     {   
         if (objSelect.options[i].value == objItemValue)   
         {   
             isExit = true ;   
             break ;   
         }   
     }        
     return isExit;   
}
				if(jsSelectIsExitItem(document.getElementById("express"),"<?php  echo $order['be_dispatchexpress'];?>"))
				{
			document.getElementById("express").value='<?php  echo $order['be_dispatchexpress'];?>';	
			
			 var obj = document.getElementById("express");  
        for ( var i=0;obj.length>i;i++)   
     {   
         if (obj.options[i].value == '<?php  echo $order['be_dispatchexpress'];?>')   
         { 
         	var voptions=obj.options[i];
         	
                   $("#expresscom").val(  voptions.getAttribute("data-name") ); 
             break ;   
         }   
     }    
			
				}
     $(function(){
      
             
        $("#express").change(function(){
          
            var obj = $(this);  
            var sel =obj.find("option:selected").attr("data-name");
            $("#expresscom").val(  sel );
        });
      
    })
    
</script>
		
		