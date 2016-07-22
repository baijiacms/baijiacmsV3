<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-ui-1.10.3.min.js"></script>
<h3 class="header smaller lighter blue">商品列表</h3>
		<form action=""  class="form-horizontal" >
				<input type="hidden" name="mod" value="site"/>
	<input type="hidden" name="name" value="manager"/>
	<input type="hidden" name="do" value="goods"/>
	<input type="hidden" name="op" value="display"/>
	<table class="table table-striped table-bordered table-hover">
			<tbody >
				<tr>
				<td>
				<li style="float:left;list-style-type:none;">
						<select  style="margin-right:10px;margin-top:10px;width: 150px; height:34px; line-height:28px; padding:2px 0" name="cate_1" onchange="fetchChildCategory(this.options[this.selectedIndex].value)">
							<option value="0">请选择一级分类</option>
							<?php  if(is_array($category)) { foreach($category as $row) { ?>
							<?php  if($row['parentid'] == 0) { ?>
							<option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GP['cate_1']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
							<?php  } ?>
							<?php  } } ?>
						</select>
						<select style="margin-right:10px;margin-top:10px;width: 150px; height:34px; line-height:28px; padding:2px 0" id="cate_2" name="cate_2">
							<option value="0">请选择二级分类</option>
							<?php  if(!empty($_GP['cate_1']) && !empty($children[$_GP['cate_1']])) { ?>
							<?php  if(is_array($children[$_GP['cate_1']])) { foreach($children[$_GP['cate_1']] as $row) { ?>
							<option value="<?php  echo $row['0'];?>" <?php  if($row['0'] == $_GP['cate_2']) { ?> selected="selected"<?php  } ?>><?php  echo $row['1'];?></option>
							<?php  } } ?>
							<?php  } ?>
						</select>
						
						</li>
					
						
						<li style="float:left;list-style-type:none;">
											<span>关键字</span>	<input style="margin-right:10px;margin-top:10px;width: 300px; height:34px; line-height:28px; padding:2px 0" name="keyword" id="" type="text" value="<?php  echo $_GP['keyword'];?>">
						</li>
						<li style="list-style-type:none;">
						<button class="btn btn-primary" style="margin-right:10px;margin-top:10px;"><i class="icon-search icon-large"></i> 搜索</button>
						</li>
					</td>
				</tr>
			</tbody>
		</table>
		</form>
		
	<table class="table table-striped table-bordered table-hover">
  <tr >
  	 <th class="text-center" >商品ID</th>
 <th class="text-center" >首图</th>
    <th class="text-center">商品名称</th>
	<th class="text-center" >货号</th>
	<th class="text-center" >价格</th>
	<th class="text-center" >库存</th>
    <th class="text-center" >商品属性</th>
    
    <th class="text-center" >状态</th>
    <th class="text-center" >操作</th>
  </tr>

		<?php if(is_array($list)) { foreach($list as $item) { ?>
				<tr>
					   	<td style="text-align:center;"><?php  echo $item['id'];?></td>
				 <td><p style="text-align:center"> <img src="<?php echo WEBSITE_ROOT;?>/attachment/<?php  echo $item['thumb'];?>" height="60" width="60"></p></td>

                                     
                                        	<td style="text-align:center;"><?php  echo $item['title'];?></td>
											
											<td style="text-align:center;"><?php  echo $item['goodssn'];?></td>
											
											<td style="text-align:center;"><?php  echo $item['marketprice'];?></td>
											
											<td style="text-align:center;"><?php  echo $item['total'];?></td>
											
                                        <td style="text-align:center;">
                                     <?php  if($item['istime']==1) { ?>  <label data='<?php  echo $item['istime'];?>' class='label label-info' >促销</label><?php  } ?>
                                        <?php  if($item['issendfree']==1) { ?> <label data='<?php  echo $item['issendfree'];?>' class='label label-info'>包邮</label><?php  } ?>
                                       <?php  if($item['isrecommand']==1) { ?> <label data='<?php  echo $item['isrecommand'];?>' class='label label-info'>首页推荐</label><?php  } ?>
					                                        <?php  if($item['isnew']==1) { ?> <label data='<?php  echo $item['isnew'];?>' class='label label-info'>新品</label><?php  } ?>
                                       <?php  if($item['isfirst']==1) { ?> <label data='<?php  echo $item['isfirst'];?>' class='label label-info'>首发</label><?php  } ?>
                                         <?php  if($item['ishot']==1) { ?> <label data='<?php  echo $item['ishot'];?>' class='label label-info'>热卖</label><?php  } ?>
                                      <?php  if($item['isjingping']==1) { ?> <label data='<?php  echo $item['isjingping'];?>' class='label label-info'>精品</label><?php  } ?>
                                     
                                   </td>
					
					
					
					<td style="text-align:center;"><?php  if($item['status']) { ?><span data='<?php  echo $item['status'];?>' onclick="setProperty1(this,<?php  echo $item['id'];?>,'status')" class="label label-success" style="cursor:pointer;">上架中</span><?php  } else { ?><span data='<?php  echo $item['status'];?>' onclick="setProperty1(this,<?php  echo $item['id'];?>,'status')" class="label label-danger" style="cursor:pointer;">已下架</span><?php  } ?><!--&nbsp;<span class="label label-info"><?php  if($item['type'] == 1) { ?>实体商品<?php  } else { ?>虚拟商品<?php  } ?></span>--></td>
					<td style="text-align:center;">
						<p ><a  class="btn btn-xs btn-info" href="<?php  echo web_url('pushstoregoods', array('goodsid' => $item['id'], 'op' => 'display'))?>"><i class="icon-edit"></i>&nbsp;发放管理&nbsp;</a>&nbsp;&nbsp;
					
						<a  class="btn btn-xs btn-info" href="<?php  echo web_url('goods', array('id' => $item['id'], 'op' => 'post'))?>"><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>&nbsp;&nbsp;
						<a  class="btn btn-xs btn-info" href="<?php  echo web_url('goods', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a></a>
			</p>
							<p >
					
						<a class="btn btn-xs btn-info"  href="<?php  echo web_url('goods_comment', array('goodsid' => $item['id'], 'op' => 'display'))?>"><i class="icon-edit"></i>&nbsp;评论管理&nbsp;</a>&nbsp;&nbsp;
				
						</p>
					</td>
				</tr>
				<?php  } } ?>
 	
		</table>
		<?php  echo $pager;?>
<script language="javascript">
		var category = <?php  echo json_encode($children)?>;
   function fetchChildCategory(cid) {
	var html = '<option value="0">请选择二级分类</option>';
	if (!category || !category[cid]) {
		$('#cate_2').html(html);
		return false;
	}
	for (i in category[cid]) {
		html += '<option value="'+category[cid][i][0]+'">'+category[cid][i][1]+'</option>';
	}
	$('#cate_2').html(html);
}
</script>
<?php  include page('footer');?>
