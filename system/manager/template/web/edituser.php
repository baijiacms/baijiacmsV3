<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<script>
	function onchange_system(itemvalue)
	{
			if(itemvalue==1)
			{
				document.getElementById("store_div").style.display="none";
			}
				if(itemvalue==0)
			{
					document.getElementById("store_div").style.display="block";
			}
	}
	</script>
 <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php  echo $account['id'];?>" />
					<h3 class="header smaller lighter blue"><?php   if(empty($account['id'])){ ?>新增<?php  }else{ ?>编辑<?php  } ?>用户</h3>
        <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 用户名：</label>

										<div class="col-sm-9">
											 <input type="text" name="username"  class="col-xs-10 col-sm-2" value="<?php  echo $account['username'];?>" />
										</div>
									</div>
									
									 <div class="form-group">
												<label class="col-sm-2 control-label no-padding-left" > 账户类型：</label>

									<div class="col-sm-9">
             
              		  <input name="is_admin" value="1" id="is_admin" <?php  if(!empty($account['is_admin'])) { ?>checked="true" <?php  } ?>  type="radio" onchange="onchange_system(1)"> 系统管理员
 &nbsp;&nbsp;	      <input name="is_admin" value="0" id="is_admin" <?php  if(empty($account['is_admin'])) { ?>checked="true" <?php  } ?> type="radio" onchange="onchange_system(0)">  店铺管理员
										</div>
									</div>
									
									      <div class="form-group" id="store_div">
										<label class="col-sm-2 control-label no-padding-left" > 店铺：</label>

										<div class="col-sm-9">
											 		 <select  style="margin-right:15px;" id="store" name="store" >
                <option value="0">请选择店铺</option>
         		  <?php  if(is_array($store_list)) { foreach($store_list as $row) { ?>
       
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $account['beid']) { ?> selected="selected"<?php  } ?>><?php  echo $row['sname'];?></option>
            
                <?php  } } ?>
            </select>
										</div>
									</div>
												<?php   if(empty($account['id'])){ ?>
									    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> 新密码：</label>

										<div class="col-sm-9">
											   <input type="password"  name="newpassword"  class="col-xs-10 col-sm-2" />
										</div>
									</div>
									
									  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> 确认密码：</label>

										<div class="col-sm-9">
											<input type="password"  name="confirmpassword" class="col-xs-10 col-sm-2"  />
										</div>
									</div>
										<?php   } ?>
								  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>

    </form>
<script>
	onchange_system(<?php echo intval($account['is_admin']);?>);
	</script>
<?php  include page('footer');?>