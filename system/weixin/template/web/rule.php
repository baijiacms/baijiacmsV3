<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<form method="post" class="form-horizontal" enctype="multipart/form-data" >
		<h3 class="header smaller lighter blue">微信自定义回复&nbsp;&nbsp;&nbsp;<a href="<?php  echo create_url('site',  array('name' => 'weixin','do' => 'rule','op'=>'detail'))?>" class="btn btn-primary">添加规则</a></h3>
		
		
	<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th class="text-center" >标题</th>
					<th class="text-center" >关键词</th>
					<th class="text-center" >类型</th>
					<th class="text-center" >图片</th>
					<th class="text-center" >操作</th>
				</tr>
			</thead>
				<?php   foreach($list as $item) { ?>
				<tr style="text-align:center;">
					<td><?php  echo $item['title'];?></td>
					<td><?php  if($item['keywords']==subscribe_key){ echo '系统：关注回复';}if($item['keywords']==default_key){ echo '系统：默认回复';}if($item['keywords']!=subscribe_key&&$item['keywords']!=default_key){ echo $item['keywords'];}?></td>
						<td><?php   if($item['ruletype']==1){ echo "文本回复";}if($item['ruletype']==2){ echo "图文回复";}?></td>
					<td><?php  echo $item['thumb'];?></td>
					<td><a class="btn btn-xs btn-info"  href="<?php  echo create_url('site',  array('name' => 'weixin','do' => 'rule','op'=>'detail','id'=>$item['id']))?>"><i class="icon-edit"></i>&nbsp;编&nbsp;辑&nbsp;</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-info"  href="<?php  echo create_url('site',  array('name' => 'weixin','do' => 'rule','op'=>'delete','id'=>$item['id']))?>"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a></td>
				</tr>
				<?php  } ?>
		</table>
    </form>
<?php  include page('footer');?>
