<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">店铺管理</h3>

<form action="" method="get">
	
	<input type="hidden" name="mod" value="site"/>
	<input type="hidden" name="name" value="manager"/>
	<input type="hidden" name="do" value="store"/>
	<input type="hidden" name="op" value="display"/>
				 <table  class="table" style="width:95%;" align="center">
					<tbody>
						
											<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">店铺名称：</td>
			<td >
				<input name="sname" type="text" value="<?php  echo $_GP['sname'];?>" /> 
			</td>	
										
			
					
						</tr>
						
						
									<tr>
							<td ></td>
							<td colspan="3"><input type="submit" name="submit" value=" 查 询 " class="btn btn-primary"></td>
						
						</tr>
						
					</tbody>
				</table>
				
			</form>
			
			
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
    <th class="text-center" >店铺名称</th>
    <th class="text-center" >绑定域名</th>
    <th class="text-center" >状态</th>
    <th class="text-center">操作</th>
				</tr>
			</thead>
		<?php  if(is_array($store_list)) { foreach($store_list as $item) { ?>
				<tr>
	
          <td class="text-center">
          	<?php echo $item['sname']; ?>
          	</td>
           <td class="text-center"><?php echo $item['website']; ?><?php if(!empty($item['website2'])){ ?><br/><?php echo $item['website2']; ?><?php }?><?php if(!empty($item['website3'])){ ?><br/><?php echo $item['website3']; ?><?php }?></td>
          <td class="text-center"><?php  if(!empty($item['is_system'])){ ?><span class="label label-info" style="cursor:pointer;">系统</span>	<?php  } ?> <?php if(empty($item['isclose'])){ ?> <label data="1" class="label label-success">正常</label><?php   } ?>
          	<?php if(!empty($item['isclose'])){ ?> <label data="1" class="label label-danger">关闭</label><?php   } ?></td>
            <td class="text-center">
            	<?php //create_url('site',array('name' => 'public','do' => 'index','beid'=> $item['id'])) 
            	?>
						<a class="btn btn-xs btn-info"  href="<?php  echo create_url('site',array('name' => 'manager','do' => 'loginstore','beid'=> $item['id']))?>" target="_blank"><i class="icon-edit"></i>店铺管理</a>
             <br/>   <br/> <a class="btn btn-xs btn-info"  href="<?php  echo web_url('store', array('op' => 'post', 'id' => $item['id']))?>"><i class="icon-edit"></i>&nbsp;修&nbsp;改&nbsp;</a> 
             		
                    	&nbsp;&nbsp;	<a class="btn btn-xs btn-info" onclick="return confirm('此操作不可恢复，确认删除？');return false;"  href="<?php  echo web_url('store', array('op' => 'delete', 'id' => $item['id']))?>"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a> </td>
                             </td>
				</tr>
				<?php  } } ?>
		</table>
		<?php  echo $pager;?>
<?php  include page('footer');?>
