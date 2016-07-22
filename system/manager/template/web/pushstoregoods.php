<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue"><?php echo $goods['title'];?>-商品发放管理&nbsp;&nbsp;	<a class="btn btn-xs btn-info"  href="<?php  echo web_url('pushstoregoods', array('goodsid' => $goods['id'], 'op' => 'addselect'))?>" ><i class="icon-edit"></i>添加店铺</a></h3>

				<form action="<?php  echo web_url('pushstoregoods', array('op' => 'delbatshop','goodsid'=>$_GP['goodsid']))?>" method="post" class="form-horizontal" enctype="multipart/form-data" >
		
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
			<th  class="text-center"> <input type="checkbox" class="check_all" />&nbsp;<button type="submit"  name="delpushsgoods" value="delpushsgoods" onclick="return confirm('此操作不可恢复，确认删除？');return false;" class="btn  btn-xs btn-danger">批量删除</button></th>
    <th class="text-center"  width="150px">店铺名称</th>
    <th class="text-center" width="150px" >分公司</th>
    <th class="text-center" width="150px" >销售员</th>
    <th class="text-center">操作</th>
				</tr>
			</thead>
		<?php  if(is_array($goodsstore_list)) { foreach($goodsstore_list as $item) { ?>
				<tr>
	<td class="text-center">  <input type="checkbox" name="check[]" value="<?php  echo $item['id'];?>"></td>
		
          <td class="text-center">
          	<?php echo $item['sname']; ?>
          	</td>
          	   <td class="text-center">
          	<?php echo $item['compName']; ?>
          	</td>
          	   <td class="text-center">
          	<?php echo $item['realname']; ?>
          	</td>

            <td class="text-center">
                    	&nbsp;&nbsp;	<a class="btn btn-xs btn-info" onclick="return confirm('此操作不可恢复，确认删除？');return false;"  href="<?php  echo web_url('pushstoregoods', array('op' => 'deloneshop', 'gsid' => $item['id']))?>"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a> </td>
                             </td>
				</tr>
				<?php  } } ?>
		</table>
		<?php  echo $pager;?>
				<script language="javascript">
		    $(".check_all").click(function(){
            var checked = $(this).get(0).checked;
                    $("input[type=checkbox]").prop("checked", checked);
                    
            });
</script>
<?php  include page('footer');?>
	</form>