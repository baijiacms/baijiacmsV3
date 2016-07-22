<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
    <form method="post" class="form-horizontal" enctype="multipart/form-data" >
		<h3 class="header smaller lighter blue">开发工具</h3>
        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 开发模式：</label>

										<div class="col-sm-9">
										  <?php  if($core_development== 1) { ?>开启&nbsp;&nbsp;&nbsp; <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'dev','act'=>'development','status'=>0))?>"  >                              
                                        点此关闭</a>【<font style="color:red">非开发调试是建议关闭</font>】<?php  } ?> <?php  if($core_development== 0) { ?>关闭&nbsp;&nbsp;&nbsp; <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'dev','act'=>'development','status'=>1))?>"  >                              
                                        点此开启</a><?php  } ?>
										</div>
									</div>
																		  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 本地版本：</label>

										<div class="col-sm-9">
											    开源版-<?php echo SYSTEM_VERSION;?>
										</div>
									</div>
									       <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 数据库检修：</label>

										<div class="col-sm-9">
										<strong>  <a  href="<?php  echo create_url('site', array('name' => 'manager','do' => 'dev','act'=>'toupdate'))?>" >                              
                                        数据库检修</a></strong><br/>仅在数据库还原后使用
										</div>
									</div>
								
								        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 程序版本：</label>

										<div class="col-sm-9">
										百家cms分销系统多商户版&nbsp;&nbsp;V<?php echo SYSTEM_VERSION;?>
										</div>
									</div>
								
								  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 服务器系统：</label>

										<div class="col-sm-9">
											<?php  echo $info['os'];?>
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > PHP版本：</label>

										<div class="col-sm-9">
										PHP Version <?php  echo $info['php'];?>
										</div>
									</div>
							 
							 
							 
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 运行环境软件：</label>

										<div class="col-sm-9">
									<?php  echo $info['sapi'];?>
										</div>
									</div>
									
									
										  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > MySQL 版本：</label>

										<div class="col-sm-9">
									<?php  echo $info['mysql']['version'];?>
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 单个附件最大尺寸：</label>

										<div class="col-sm-9">
										<?php  echo $info['limit'];?>
										</div>
									</div>
						 </form>			
								
<?php  include page('footer');?>