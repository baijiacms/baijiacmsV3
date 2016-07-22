<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<?php  include page('header');?>
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
       	<h3 class="header smaller lighter blue">修改密码</h3>
       	      <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 用户名：</label>

										<div class="col-sm-9">
										 <?php echo $username ?>
										</div>
									</div>
									     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 原密码：</label>

										<div class="col-sm-9">
										 
                    <input type="password" name="oldpassword" class="span2"  />
										</div>
									</div>
									
												     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 新密码：</label>

										<div class="col-sm-9">
										 
                    <input type="password"  name="newpassword" class="span2"  />
										</div>
									</div>
        
            
            				     <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 确认密码：</label>

										<div class="col-sm-9">
										 
                    <input type="password"  name="confirmpassword" class="span2"  />
										</div>
									</div>
        
            
            	  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>
            
         
    </form>
<?php  include page('footer');?>