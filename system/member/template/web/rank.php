<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">编辑会员等级&nbsp;&nbsp;&nbsp;</h3>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
		<input type="hidden" name="id" class="col-xs-10 col-sm-2" value="<?php echo $rank['id'];?>" />

  
		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 等级</label>

										<div class="col-sm-9">
											<select id="rank_level" name="rank_level"> 
												<?php for($t_i=1;$t_i<100;$t_i++){
													if(($t_i>0&&empty($rank_level_all[$t_i]))||($t_i==0&&empty($rank_level_all[$t_i]))||$rank['rank_level']=="$t_i")
													{
													?>
					 <option value="<?php echo $t_i;?>" <?php echo intval($rank['rank_level'])==$t_i?'selected':'';?>><?php echo $t_i;?></option>
					<?php } } ?>
                  	                   </select>
										</div>
									</div>
									
									
											 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >等级名称<?php echo $rank['rank_level']=='1'?></label>

										<div class="col-sm-9">
													<input type="text" name="rank_name" class="col-xs-10 col-sm-3" value="<?php echo $rank['rank_name'];?>" />
													</div>
									</div>	
																								
								 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 所需积分</label>

										<div class="col-sm-9">
													<input type="text" name="experience" class="col-xs-10 col-sm-3" value="<?php echo $rank['experience'];?>" />
													<div class="help-block"> 只能是数字，整数</div>
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
