<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">支付方式</h3>
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
				   <th class="text-center" >支付方式名称</th>
    <th class="text-center" style="width:500px" >支付方式描述</th>
    <th class="text-center">操作</th>
				</tr>
			</thead>
		<?php  if(is_array($modules)) { foreach($modules as $item) { ?>
				<tr>
					<td class="text-center"><?php  echo $_LANG['payment_'.$item['code'].'_name']?></td>
          <td class="text-center"><?php  echo $_LANG['payment_'.$item['code'].'_desc']?></td>
         <td class="text-center"><?php if(empty($item['enable'])||$item['enable']==0){?>
         	<a class="btn btn-xs btn-info"  href="<?php  echo create_url('site', array('name' => 'modules','do' => 'payment_install','code'=>$item['code']))?>" >
                                   <i class="icon-edit"></i>&nbsp;启&nbsp;动&nbsp;                               
                                </a><?php }else{ ?>
                                	&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-info" href="<?php  echo create_url('site', array('name' => 'modules','do' => 'payment_config','code'=>$item['code']))?>" >
                                   <i class="icon-edit"></i>&nbsp;编&nbsp;辑  &nbsp;                           
                                </a>
                                 &nbsp;&nbsp;&nbsp;	<a class="btn btn-xs btn-info" href="<?php  echo create_url('site', array('name' => 'modules','do' => 'payment_uninstall','code'=>$item['code']))?>" >
                                  <i class="icon-edit"></i>&nbsp;关&nbsp;闭&nbsp;                          
                                </a>
                                 <?php }?>  </td>
				</tr>
				<?php  } } ?>
		</table>
		<?php  echo $pager;?>




<?php  include page('footer');?>
