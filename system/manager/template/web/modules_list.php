<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue">插件管理&nbsp;&nbsp;&nbsp;&nbsp;</h3>
	
<table class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
				  
    <th class="text-center"  >插件名称</th>
				</tr>
			</thead>
		<?php  if(is_array($modules_list)) { foreach($modules_list as $item) { ?>
				<tr>
				  <td class="text-center"><?php  echo $item['title'];?></td>
       <?php  if(false){ ?>  <td class="text-center"><?php if($item['isdisable']==1){?>
         	<a class="btn btn-xs btn-info"  href="<?php  echo web_url('manager', array('op'=>'open_module','module_name'=>$item['name']))?>" >
                                   <i class="icon-edit"></i>&nbsp;启&nbsp;动&nbsp;                               
                                </a><?php }else{ ?>
                                 <a class="btn btn-xs btn-danger" href="<?php  echo web_url('manager', array('op'=>'close_module','module_name'=>$item['name']))?>" >
                                  <i class="icon-edit"></i>&nbsp;关&nbsp;闭&nbsp;                          
                                </a>
                                 <?php }?>  </td>			<?php   } ?>
				</tr>
				<?php  } } ?>
				
					
		</table>



<?php  include page('footer');?>
