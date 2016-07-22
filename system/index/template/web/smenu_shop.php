<?php defined('SYSTEM_IN') or exit('Access Denied');?>  

    <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21">会员管理</span>
            </dt>        
            
              <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'member','do' => 'list'))?>" target="main">会员管理 </a>
                                    </dd>  
               
                        <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'member','do' => 'rank'))?>" target="main">会员等级管理 </a>
                                    </dd>      
                                  <?php if(false){ ?>  
                                   <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'member','do' => 'outchargegold'))?>" target="main">余额提现申请 </a>
                                    </dd>            
                                     <?php } ?>
                                              
                   </dl>    


                        <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21">商品管理</span>
            </dt>        
            
              <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shop','do' => 'goods','op'=>'display'))?>" target="main">商品列表 </a>
                                    </dd>  
               
                        <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shop','do' => 'goods','op'=>'post'))?>" target="main">添加新商品 </a>
                                    </dd>      
                                    
                                   <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shop','do' => 'category','op'=>'display'))?>" target="main">管理分类 </a>
                                    </dd>            
                             
					 
                                              
                   </dl>                 
                          
                            <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21">订单管理</span>
            </dt>        
            
              <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'order','op' => 'display', 'status' => -99))?>" target="main">商城订单 </a>
                                    </dd>  
                   <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site',  array('name' => 'shop','do'=>'goodsorder','op' => 'display', 'status' => -99))?>" target="main">商品退换 </a>
                                    </dd>  
                        <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shop','do'=>'orderbat','op' => 'display'))?>" target="main">批量发货 </a>
                                    </dd>      
                                    
                                   <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shop','do'=>'goods_comment','op' => 'check'))?>" target="main">商品评论审核 </a>
                                    </dd>            
                               
                                              
                   </dl>        
                                    
                                   
                             
                                  <dl class="left-menu shop_26 sub_cog">
             <dt>
            <i class="icon-menu membership"></i>
                <span id="shop_21" data-id="21">商城模板</span>
            </dt>        
            
              <dd class="subshop_0 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shopwap','do' => 'themes','op'=>'display'))?>" target="main">模板设置 </a>
                                    </dd>  
               
                   
                                    
                                      <dd class="subshop_1 ">
                    <a  href="<?php  echo create_url('site', array('name' => 'shop','do' => 'adv','op'=>'display'))?>" target="main">首页广告 </a>
                                    </dd>    
                                         
                   </dl>      
                                    