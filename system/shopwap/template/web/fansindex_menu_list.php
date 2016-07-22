<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">个人中心菜单&nbsp;&nbsp;&nbsp;<a href="<?php  echo create_url('site', array('name' => 'shopwap','do' => 'fansindex_menu','op'=>'post'));?>" class="btn btn-primary">添加菜单</a></h3>
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
		 <th class="text-center" >图标</th>
    <th class="text-center"  >名称</th>
    <th class="text-center">链接</th>
    <th class="text-center">排序</th>
    <th class="text-center">操作</th>
				</tr>
			</thead>
		<?php  if(is_array($fansindex_menu_list)) { foreach($fansindex_menu_list as $item) { ?>
				<tr>
					<td class="text-center"><?php if(!empty($item['icon'])){ ?><i class="<?php echo $item['icon']; ?>"></i><?php } ?></td>
          <td class="text-center"><?php echo $item['tname']; ?></td>
           <td class="text-center"><?php echo $item['url']; ?></td>
          <td class="text-center"><?php echo $item['torder']; ?></td>
         <td class="text-center">
                                                    	<a class="btn btn-xs btn-info"  href="<?php  echo web_url('fansindex_menu', array('op' => 'post', 'id' => $item['id']))?>"><i class="icon-edit"></i>&nbsp;修&nbsp;改&nbsp;</a> 
                    	&nbsp;&nbsp;	<a class="btn btn-xs btn-info" onclick="return confirm('此操作不可恢复，确认删除？');return false;"  href="<?php  echo web_url('fansindex_menu', array('op' => 'delete', 'id' => $item['id']))?>"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a> </td>
                                </td>
				</tr>
				<?php  } } ?>
		</table>

<?php  include page('footer');?>
