<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">会员管理</h3>
<form action="" method="get" class="form-horizontal" enctype="multipart/form-data" >
				<input type="hidden" name="act" value="module" />
				<input type="hidden" name="name" value="member" />
				<input type="hidden" name="do" value="list" />
				<input type="hidden" name="mod" value="site"/>					
				<input type="hidden" name="beid" value="<?php echo $_CMS['beid'];?>"/>	
				<table class="table" style="width:95%;" align="center">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">用户名：</td>
			<td style="width:300px">

												<input name="realname"  type="text" value="<?php  echo $_GP['realname'];?>" />
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">手机号码：</td>
			<td>
				
												<input name="mobile" type="text"   value="<?php  echo $_GP['mobile'];?>" />
				
			</td>	
						</tr>
				
					<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">状态：</td>
							<td style="width:300px">
								<select style="margin-right:15px;" name="showstatus">
		 <option value="1" <?php if(empty($_GP['showstatus'])||$_GP['showstatus']==1){?>selected=""<?php }?>>正常</option>
				                 <option value="-1" <?php if($_GP['showstatus']==-1){?>selected=""<?php }?>>禁用</option>
                  	                   </select>
								</td>
						
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">会员等级</td>
			<td>
								<select name="rank_level"  style="margin-right:10px;margin-top:10px;width: 150px; height:34px; line-height:28px; padding:2px 0">
     				<option value="0">选择会员等级</option>   
     				<?php foreach($rank_model_list as $rank_model){?>
     				  				<option value="<?php echo $rank_model['rank_level']?>" <?php if($rank_model['rank_level']==$_GP['rank_level']){?>selected=""<?php }?>><?php echo $rank_model['rank_name']?></option> 
     							<?php }?>
     				</select>
			</td>	
						</tr>
		
						
						
								<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">微信昵称</td>
							<td style="width:300px">
						<input name="weixinname"  type="text" value="<?php  echo $_GP['weixinname'];?>" />
								</td>
						
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">用户UID</td>
			<td><input name="userid"  type="text" value="<?php  echo $_GP['userid'];?>" />
			</td>	
						</tr>
				
							
						<tr>
							<td></td>
							<td colspan="3">
										<input name="submit" type="submit" value=" 查 找 " class="btn btn-info"/>
										<?php if($showWXsynBtn){ ?>
										&nbsp;&nbsp;<input name="updateweixinsubmit" type="button" onclick="location.href='<?php  echo create_url('site', array('name' => 'member','do' => 'list','op'=>'updateweixinsubmit'))?>';" value="同步微信关注用户信息" class="btn btn-warning"/></td>
							<?php } ?>
	
						</tr>
					</tbody>
				</table>
				
				     
									
				
			</form>
<h3 class="blue">	<span style="font-size:18px;"><strong>会员总数：<?php echo $total ?></strong></span></h3>
		
					<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
						<th style="text-align:center;">用户UID</th>
					<th style="text-align:center;">手机号码</th>
					
						<th style="text-align:center;">微信昵称</th>
					<th style="text-align:center;">用户名</th>
					<th style="text-align:center;">注册时间</th>
					<th style="text-align:center;">会员等级</th>
					<th style="text-align:center;">状态</th>
					<th style="text-align:center;">积分</th>
					<th style="text-align:center;">余额</th>
					<th style="text-align:center;">操作</th>
				</tr>
			</thead>
			<tbody>
 <?php  if(is_array($list)) { foreach($list as $v) { ?>
								<tr><td class="text-center">
										<?php  echo $v['openid'];?>
									</td>
										<td class="text-center">
										<?php  echo $v['mobile'];?>
									</td>
											<td class="text-center">
											<?php if(!empty($v['weixin'])) { ?>
						<?php echo $v['weixin']['nickname']; ?><br/>
						<?php  }?>
									</td>
										
									<td class="text-center">
										<?php  echo $v['realname'];?>
									</td>
									<td class="text-center">
										<?php  echo date('Y-m-d',$v['createtime'])?>
									</td>
									
											<td class="text-center">
												<?php   $member_rank_model=member_rank_model($v['experience']);if(empty($member_rank_model)){ echo '无';}else{echo $member_rank_model['rank_name'];}?>
									</td>
									<td class="text-center">
									<?php  if($v['status']==0) { ?>
										<span class="label label-important">已禁用</span>
									<?php  } else { ?>
										<span class="label label-success">正常</span>
									<?php  } ?>
									</td>
										<td class="text-center">
												<?php  echo $v['credit'];?>
									</td>
									<td class="text-center">
										<?php  echo $v['gold'];?>
									</td>
									<td class="text-center">
											<?php  if($v['status']==1) { ?>
									<a class="btn btn-xs btn-danger" href="<?php  echo web_url('delete',array('name'=>'member','openid' => $v['openid'],'status' => 0));?>" onclick="return confirm('确定要禁用该账户吗？');"><i class="icon-edit"></i>禁用账户</a>
										
											<?php  } else { ?>
										<a class="btn btn-xs btn-success" href="<?php  echo web_url('delete',array('name'=>'member','openid' => $v['openid'],'status' => 1));?>" onclick="return confirm('确定要恢复该账户吗？');"><i class="icon-edit"></i>恢复账户</a>
										
									<?php  } ?>
										&nbsp;<a  class="btn btn-xs btn-info" href="<?php  echo web_url('detail',array('name'=>'member','openid' => $v['openid']));?>"><i class="icon-edit"></i>账户编辑</a>&nbsp;<br/><br/>
					
										<a class="btn btn-xs btn-info" href="<?php  echo web_url('recharge',array('name'=>'member','openid' => $v['openid'],'op'=>'credit'));?>"><i class="icon-edit"></i>积分管理</a>&nbsp;
										<a class="btn btn-xs btn-info" href="<?php  echo web_url('recharge',array('name'=>'member','openid' => $v['openid'],'op'=>'gold'));?>"><i class="icon-edit"></i>余额管理</a>	
								</td>
								</tr>
								<?php  } } ?>
  </tbody>
    </table>
		<?php  echo $pager;?>
<?php  include page('footer');?>