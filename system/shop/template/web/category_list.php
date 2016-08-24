<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">分类列表&nbsp;&nbsp&nbsp;&nbsp&nbsp;<span style="font-size:14px">前台页面效果：<input type="radio" name="shop_category_style" value="0" onchange="location.href='<?php  echo create_url('site', array('name' => 'shop','do' => 'category','op'=>'changestyle','shop_category_style'=>0))?>';" <?php  echo empty($settings['shop_category_style'])?'checked':''; ?>>文字分类，<input type="radio" name="shop_category_style" value="1" onchange="location.href='<?php  echo create_url('site', array('name' => 'shop','do' => 'category','op'=>'changestyle','shop_category_style'=>1))?>';" <?php  echo !empty($settings['shop_category_style'])?'checked':''; ?>>图文分类</span></h3>


		<form action="" class="form-horizontal" method="post" onsubmit="return formcheck(this)">
				<table class="table table-striped table-bordered table-hover">
  <tr>
				<tr>
					<th style="width:10px;"></th>
					<th style="width:50px;">显示顺序</th>
					<th style="width:80px;">分类名称</th>
						<th style="width:80px;">状态</th>
					<th style="width:80px;">操作</th>
				</tr>
			<tbody>
			<?php  if(is_array($category)) { foreach($category as $row) { ?>
				<tr>
					<td style="width:10px;"><?php  if(count($children[$row['id']]) > 0) { ?><a href="javascript:;"><i class="icon-chevron-down"></i></a><?php  } ?></td>
					<td style="width:50px;"><input type="text"  style="width:50px"  name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
            <td>
              <?php  echo $row['name'];?>&nbsp;&nbsp;   	<img src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $row['thumb'];?>" width='50' height="50" onerror="$(this).remove()" style='padding:1px;border: 1px solid #ccc;float:left;' />
            
            	</td>
           <td>          <?php  if(!empty($row['is_system'])) { ?>
                                        		<span  class="label label-danger" style="cursor:pointer;">总部分类</span><?php  } ?>   <?php  if($row['isrecommand']==1) { ?>
                                                <span class='label label-success'>首页推荐</span>
                                                 <?php  } ?><?php  if($row['enabled']==1) { ?>
                                                <span class='label label-success'>显示</span>
                                                <?php  } else { ?>
                                                <span class='label label-danger'>隐藏</span>
                                                <?php  } ?></td>
					<td>
						 <?php  if(empty($row['is_system'])) { ?>
						<?php  if(empty($row['parentid'])) { ?>
          <a class="btn btn-xs btn-info" href="<?php  echo web_url('category', array('parentid' => $row['id'], 'op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加子分类</a><?php  } ?>&nbsp;&nbsp;
					     <?php  } ?><a class="btn btn-xs btn-info" href="<?php  echo create_url('mobile',array('name' => 'shopwap','do' => 'goodlist','pcate' =>  $row['id']))?>" target="_blank"><i class="icon-eye-open"></i>&nbsp;查&nbsp;看&nbsp;</a>&nbsp;&nbsp;
						 <?php  if(empty($row['is_system'])) { ?>	<a class="btn btn-xs btn-info" href="<?php  echo web_url('category', array('op' => 'post', 'id' => $row['id']))?>"><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>&nbsp;&nbsp;
					<a class="btn btn-xs btn-info" href="<?php  echo web_url('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a></td>
			 <?php  } ?>	</tr>
				<?php  if(is_array($children[$row['id']])) { foreach($children[$row['id']] as $row) { ?>
				<tr>
					<td style="width:10px;"></td>
					<td style="width:50px;">&nbsp;&nbsp;&nbsp;<input type="text" style="width:50px" name="displayorder[<?php  echo $row['id'];?>]" value="<?php  echo $row['displayorder'];?>"></td>
					
					 <td>&nbsp;&nbsp;&nbsp;<?php  echo $row['name'];?>&nbsp;&nbsp; <img src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $row['thumb'];?>" width='50' height="50" onerror="$(this).remove()" style='padding:1px;border: 1px solid #ccc;float:left;' /></td>
					<td>
					  <?php  if(!empty($row['is_system'])) { ?>
                                        		<span  class="label label-danger" style="cursor:pointer;">总部分类</span><?php  } ?>	 <?php  if($row['isrecommand']==1) { ?>
                                                <span class='label label-success'>首页推荐</span>
                                                 <?php  } ?>
						  <?php  if($row['enabled']==1) { ?>
                                                <span class='label label-success'>显示</span>
                                                <?php  } else { ?>
                                                <span class='label label-danger'>隐藏</span>
                                                <?php  } ?></td>
					<td>
					<a class="btn btn-xs btn-info" href="<?php  echo WEBSITE_ROOT;?><?php  echo create_url('mobile',array('name' => 'shopwap','do' => 'goodlist','ccate' =>  $row['id']))?>" target="_blank"><i class="icon-eye-open"></i>&nbsp;查&nbsp;看&nbsp;</a>&nbsp;&nbsp;
							 <?php  if(empty($row['is_system'])) { ?>	<a class="btn btn-xs btn-info" href="<?php  echo web_url('category', array('op' => 'post', 'id' => $row['id'], 'parentid'=>$row['parentid']))?>"><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>
					&nbsp;&nbsp;<a class="btn btn-xs btn-info" href="<?php  echo web_url('category', array('op' => 'delete', 'id' => $row['id']))?>" onclick="return confirm('确认删除此分类吗？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a>	 <?php  } ?></td>
				</tr>
				<?php  } } ?>
			<?php  } } ?>
				<tr>
					<td style="width:10px;"></td>
					<td colspan="4">
						<a href="<?php  echo web_url('category', array('op' => 'post'))?>"><i class="icon-plus-sign-alt"></i> 添加新分类</a>
					</td>
				</tr>
				<tr>
					<td style="width:10px;"></td>
					<td colspan="4">
						<input name="submit" type="submit" class="btn btn-primary" value=" 提 交 ">
					</td>
				</tr>
			</tbody>
		</table>
		</form>
<?php  include page('footer');?>
