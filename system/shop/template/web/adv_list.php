<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>
<h3 class="header smaller lighter blue">幻灯片列表&nbsp;&nbsp;&nbsp;<a href="<?php  echo web_url('adv',array('op' =>'post'))?>" class="btn btn-primary">添加幻灯片</a></h3>

<table class="table table-striped table-bordered table-hover">
			     <thead >
                <tr>
                    <th  style="text-align:center;width:30px">ID</th>
                    <th  style="text-align:center;">显示顺序</th>					
                    <th  style="text-align:center;">幻灯</th>
                    <th  style="text-align:center;">链接</th>
                    <th  style="text-align:center;">操作</th>
                </tr>
            </thead>
		      <tbody>
                <?php $index=1; if(is_array($list)) { foreach($list as $adv) { ?>
                <tr style="text-align:center;">
                    <td><?php  echo $index++;?></td>
                    <td><?php  echo $adv['displayorder'];?></td>
                    <td> <img src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $adv['thumb'];?>" style="width:150px;height:100px"></td>
                    <td><?php  echo $adv['link'];?></td>
                    <td style="text-align:center;">
                    	<a class="btn btn-xs btn-info"  href="<?php  echo web_url('adv', array('op' => 'post', 'id' => $adv['id']))?>"><i class="icon-edit"></i>&nbsp;修&nbsp;改&nbsp;</a> 
                    	&nbsp;&nbsp;	<a class="btn btn-xs btn-info"  href="<?php  echo web_url('adv', array('op' => 'delete', 'id' => $adv['id']))?>"  onclick="return confirm('确认删除此项吗？');return false;"><i class="icon-edit"></i>&nbsp;删&nbsp;除&nbsp;</a> </td>
                </tr>
                <?php  } } ?>
            </tbody>
		</table>
		  <?php  echo $pager;?>
<?php  include page('footer');?>