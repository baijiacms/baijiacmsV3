<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-ui-1.10.3.min.js"></script>
<h3 class="header smaller lighter blue">商品评论审核</h3>

	<table class="table table-striped table-bordered table-hover">
  <tr >
 <th class="text-center" >序号</th>
      <th class="text-center">评论人昵称/手机号</th>
     <th class="text-center">订单编号</th>
          <th class="text-center">商品名称</th>
  <th class="text-center">评级</th>
    <th class="text-center" style="width:350px">评论</th>
          <th class="text-center">创建时间</th>
    <th class="text-center" >操作</th>
  </tr>

		<?php $index=0; if(is_array($list)) { foreach($list as $item) { $index=$index+1; ?>
				<tr>
				 <td style="text-align:center;"><?php echo  $index ?></td>

                                     
											
											      	<td style="text-align:center;"><?php  if(empty($item['comment_nickname'])){echo empty($item['nickname'])?$item['mobile']:$item['nickname'];}else{ echo $item['comment_nickname'];}?></td>
										                 	<td style="text-align:center;"><?php  echo $item['ordersn'];?></td>
											      	   	<td style="text-align:center;"><?php  echo $item['title'].(empty($item['optionname'])?'':'['.$item['optionname'].']'); ?></td>
												<td style="text-align:center;color: #ff6600">
													 <?php if($item['rate']>=1){?><i class="icon-star"></i><?php }?>
                            <?php if($item['rate']>=2){?><i class="icon-star"></i><?php }?>
                            <?php if($item['rate']>=3){?><i class="icon-star"></i><?php }?>
                            <?php if($item['rate']>=4){?><i class="icon-star"></i><?php }?>
                            <?php if($item['rate']>=5){?><i class="icon-star"></i><?php }?></td>
                                       	<td style="text-align:center;"><?php  echo $item['comment'];?></td>
                                        	 	<td style="text-align:center;"><?php  echo date('Y-m-d H:i:s', $item['createtime'])?></td>
										<td style="text-align:center;">
					<a  class="btn btn-xs btn-info" href="<?php  echo web_url('goods_comment', array('id' => $item['id'], 'op' => 'enable'))?>" ><i class="icon-edit"></i>&nbsp;审核通过&nbsp;</a><br/><a  class="btn btn-xs btn-danger" style="margin-top:3px" href="<?php  echo web_url('goods_comment', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('此操作不可恢复，确认删除？');return false;"><i class="icon-edit"></i>&nbsp;删除评论&nbsp;</a></a>
				
					
					</td>
				</tr>
				<?php  } } ?>
 	
		</table>
		<?php  echo $pager;?>

<?php  include page('footer');?>
