<?php defined('SYSTEM_IN') or exit('Access Denied');?>
     <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21">店铺管理</span>
            </dt>        
            
              <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'store','op'=>'post'))?>" target="main">添加店铺 </a>
                                    </dd>  
               
                        <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'store','op'=>'display'))?>" target="main">管理店铺 </a>
                                    </dd>      
                                     <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'user'))?>" target="main">用户管理 </a>
                                    </dd>  
                                                
                   </dl>       
                   


	   <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21">基础维护</span>
            </dt>        
                       <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'database'))?>" target="main">备份与还原</a>
                                    </dd>  
              <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'dev'))?>" target="main">开发工具 </a>
                                    </dd>  
                 
                                                      
               <?php if(false){?>
                        <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'modules'))?>" target="main">插件扩展 </a>
                                    </dd>      
                                    
                                 <?php }?>   
                                    
                                              
                   </dl>     