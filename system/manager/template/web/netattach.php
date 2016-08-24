<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">远程附件</h3>
<script>
	function changeattach(attdiv)
	{

		document.getElementById("div_ftp").style.display="none";
				document.getElementById("div_ftp2").style.display="none";
			document.getElementById("div_oss").style.display="none";
		if(attdiv==1)
		{
			document.getElementById("div_ftp").style.display="block";
			document.getElementById("div_ftp2").style.display="block";
			document.getElementById("div_oss").style.display="none";
		}
			if(attdiv==2)
		{
				document.getElementById("div_ftp").style.display="none";
				document.getElementById("div_ftp2").style.display="none";
			document.getElementById("div_oss").style.display="block";
		}
	}
	</script>
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
	  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left">远程附件：</label>

										<div class="col-sm-9">
												
          	
          <input type="radio" name="system_isnetattach" value="0" <?php  if(empty($settings['system_isnetattach'])) { ?>checked="true"<?php  } ?>> 关闭
         &nbsp;&nbsp; <input type="radio" name="system_isnetattach" onchange="changeattach(1)" value="1" <?php  if($settings['system_isnetattach'] == 1) { ?>checked="true"<?php  } ?>> FTP
        &nbsp;&nbsp; <input type="radio" name="system_isnetattach" onchange="changeattach(2)" value="2" <?php  if($settings['system_isnetattach'] == 2) { ?>checked="true"<?php  } ?>> 阿里云OSS
            
										</div>
		</div>
									</div>
									
									<div id="div_ftp">
			  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >远程附件服务器域名地址:</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_attachurl" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_attachurl'];?>" />域名格式如：http://www.baijiacms.com/
										</div>
												</div>		
									
	  		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >FTP&nbsp;&nbsp;IP:</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_ip" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_ip'];?>" />
										</div>
												</div>			
												  		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >FTP&nbsp;&nbsp;端口:</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_port" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_port'];?>" />
										</div>
												</div>			
												
													  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left">FTP&nbsp;&nbsp;SSL:</label>

										<div class="col-sm-9">
												
          	
          <input type="radio" name="system_ftp_ssl" value="0" <?php  if(empty($settings['system_ftp_ssl'])) { ?>checked="true"<?php  } ?>> 关闭
         &nbsp;&nbsp; <input type="radio" name="system_ftp_ssl" value="1" <?php  if($settings['system_ftp_ssl'] == 1) { ?>checked="true"<?php  } ?>> 开启
            
										</div>
		</div>				
		
				  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left">FTP&nbsp;&nbsp;PASV模式:</label>

										<div class="col-sm-9">
												
          	
          <input type="radio" name="system_ftp_pasv" value="0" <?php  if(empty($settings['system_ftp_pasv'])) { ?>checked="true"<?php  } ?>> 关闭
         &nbsp;&nbsp; <input type="radio" name="system_ftp_pasv" value="1" <?php  if($settings['system_ftp_pasv'] == 1) { ?>checked="true"<?php  } ?>> 开启
            
										</div>
		</div>				
	  		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >FTP&nbsp;&nbsp;用户名：</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_username" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_username'];?>" />
										</div>
														</div>							
	  		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >FTP&nbsp;&nbsp;密码：</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_passwd" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_passwd'];?>" />
										</div>
											</div>
											
											
											
											 		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >FTP&nbsp;&nbsp;超时时间：</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_timeout" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_timeout'];?>" />
										</div>
											</div>
											
										 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >FTP&nbsp;&nbsp;文件夹路径：</label>

										<div class="col-sm-9">
													<input type="text" name="system_ftp_ftproot" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_ftp_ftproot'];?>" />
										</div>
									 		</div>
									 		
									 			</div>
									 			
									 			
									 											<div id="div_oss">
									 												
									 												<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >OSS所属地域:</label>

										<div class="col-sm-9">
													<select style="margin-right:15px;" name="system_oss_endpoint"> 
				                 <option value="oss-cn-hangzhou.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-hangzhou.aliyuncs.com'){echo "selected";} ?> >华东 1 (杭州)</option>
                  	                 <option value="oss-cn-shanghai.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-shanghai.aliyuncs.com'){echo "selected";} ?>>华东 2 (上海)</option>
                  	                      <option value="oss-cn-qingdao.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-qingdao.aliyuncs.com'){echo "selected";} ?>>华北 1 (青岛)</option>
                  	                 <option value="oss-cn-beijing.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-beijing.aliyuncs.com'){echo "selected";} ?>>华北 2 (北京)</option>
                  	                      <option value="oss-cn-shenzhen.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-shenzhen.aliyuncs.com'){echo "selected";} ?>>华南 1 (深圳)</option>
                  	                 <option value="oss-cn-hongkong.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-cn-hongkong.aliyuncs.com'){echo "selected";} ?>>香港数据中心</option>
                  	                        <option value="oss-us-west-1.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-us-west-1.aliyuncs.com'){echo "selected";} ?>>美国硅谷数据中心</option>
                  	                       <option value="oss-us-east-1.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-us-east-1.aliyuncs.com'){echo "selected";} ?>>美国弗吉尼亚数据中心</option>
                  	                         <option value="oss-ap-southeast-1.aliyuncs.com" <?php if($settings['system_oss_endpoint']=='oss-ap-southeast-1.aliyuncs.com'){echo "selected";} ?>>亚太（新加坡）数据中心</option>
                  	                   </select>
										</div>
												</div>		
													
									 												
			  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >OSS外网域名:</label>

										<div class="col-sm-9">
													<input type="text" name="system_oss_attachurl" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_oss_attachurl'];?>" />域名格式如：http://www.baijiacms.com/
										</div>
												</div>		
													
													
														  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >Access Key ID:</label>

										<div class="col-sm-9">
													<input type="text" name="system_oss_access_id" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_oss_access_id'];?>" />
										</div>
												</div>		
												
														  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >Access Key Secret:</label>

										<div class="col-sm-9">
													<input type="text" name="system_oss_access_key" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_oss_access_key'];?>" />
										</div>
												</div>		
													 		
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >Bucket名称:</label>

										<div class="col-sm-9">
													<input type="text" name="system_oss_bucket" class="col-xs-10 col-sm-3" value="<?php echo $settings['system_oss_bucket'];?>" />
										</div>
												</div>		
													 		
													
									 										</div>
									 							
									 			
									 			
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
								<input name="submit" type="submit" value=" 提 交 " style="float:left" class="btn btn-info"/><input name="testsubmit"  style="float:left;margin-left:30px"  id="div_ftp2" type="submit" value=" 连接测试 " class="btn btn-info"/>
												
		                     </div>
		                     </div>
				
</form>
<script>
	changeattach(<?php echo intval($settings['system_isnetattach']);?>);
	</script>
		

<?php  include page('footer');?>