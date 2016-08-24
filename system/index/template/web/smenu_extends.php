<?php defined('SYSTEM_IN') or exit('Access Denied');?>
  <?php  if(is_array($modulelist)) { foreach($modulelist as $module) { if(!empty($module['menus'])){
                               
                                   	?>
  <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21"><?php  echo $module['title'] ?></span>
            </dt>        
                       <?php  foreach($module['menus'] as $menu) { ?>
              <dd class="subshop_0 ">
                    <a  href="<?php  echo $menu['href'] ?>&beid=<?php  echo $_CMS['beid'] ?>" target="main">     <?php  echo $menu['title'] ?>  </a>
                                    </dd>  
                       <?php  } ?>  
                   </dl>     
    
                                               
                                     
                                                              </dl>    
                     <?php  } }} ?>    
          	       