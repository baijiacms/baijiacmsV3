<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">配送方式<?php  	if( $operation!='uninstall'){ ?>&nbsp;&nbsp;<a class="btn btn-xs btn-info" href="<?php  echo create_url('site', array('name' => 'modules','do' => 'dispatch','op'=>'uninstall'))?>" >
                                   <i class="icon-edit"></i>安装配送方式                          
                                </a><?php  	}else{ ?>&nbsp;&nbsp;<a class="btn btn-xs btn-info" href="<?php  echo create_url('site', array('name' => 'modules','do' => 'dispatch','op'=>'display'))?>" >
                                   <i class="icon-edit"></i>已配送方式管理                          
                                </a>
                                <?php  	} ?></h3>
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					  <th class="text-center" >快递代码</th>
				   <th class="text-center" >快递代码名称</th>
    <th class="text-center" style="width:500px" >快递代码描述</th>
    <th class="text-center">操作</th>
				</tr>
			</thead>
		<?php  if(is_array($modules)) { foreach($modules as $item) { ?>
				<tr>
						<td class="text-center"><?php  echo $item['code']?></td>
					<td class="text-center"><?php  echo $_LANG['dispatch_'.$item['code'].'_name']?></td>
          <td class="text-center"><?php  echo $_LANG['dispatch_'.$item['code'].'_desc']?></td>
         <td class="text-center"><?php if(empty($item['enabled'])||$item['enabled']==0){?>
         	<a class="btn btn-xs btn-info"  href="<?php  echo create_url('site', array('name' => 'modules','do' => 'dispatch_install','code'=>$item['code']))?>" >
                                   <i class="icon-edit"></i>启&nbsp;动                               
                                </a><?php }else{ ?>
                                	&nbsp;&nbsp;&nbsp;<a class="btn btn-xs btn-danger" href="<?php  echo create_url('site', array('name' => 'shop','do' => 'dispatch','op'=>'display','code'=>$item['code']))?>" >
                                   <i class="icon-edit"></i>配送区域                          
                                </a>
                                 &nbsp;&nbsp;&nbsp;	<a class="btn btn-xs btn-info" href="<?php  echo create_url('site', array('name' => 'modules','do' => 'dispatch_uninstall','code'=>$item['code']))?>" >
                                  <i class="icon-edit"></i>卸&nbsp;载                       
                                </a>
                                 <?php }?>  </td>
				</tr>
				<?php  } } ?>
		</table>
		<?php  echo $pager;?>




<?php  include page('footer');?>
