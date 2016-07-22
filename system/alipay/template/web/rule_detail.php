<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>

<h3 class="header smaller lighter blue">自定义回复管理</h3>
<form method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return formcheck(this)" >
	<input type="hidden" name="id" value="<?php  echo $rule['id'];?>">
	
			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 规则标题：</label>

										<div class="col-sm-9">
										    <input type="text" id="rule-title" class="col-xs-10 col-sm-4" placeholder="" name="title" value="<?php  echo $rule['title'];?>" /> &nbsp;
				</div>
			</div>
			
			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 回复类型：</label>

										<div class="col-sm-9">
										    
										    <select name="ruletype" id="rule-type" class="span2" onchange="ruletypeAction()" >
						<option value="1" >文本回复</option>
						<option value="2">图文回复</option>
					</select>
					<script>
						function ruletypeAction()
						{
						if(document.getElementById('rule-type').value==1)
						{
					
							document.getElementById('pictr1').style.display="none";
								document.getElementById('pictr2').style.display="none";
						document.getElementById('urltr1').style.display="none";
							document.getElementById('urltr2').style.display="none";
						}
								if(document.getElementById('rule-type').value==2)
						{
							
									document.getElementById('pictr1').style.display="block";
									document.getElementById('pictr2').style.display="block";
						document.getElementById('urltr1').style.display="block";
							document.getElementById('urltr2').style.display="block";
						}
							
						}
						document.getElementById('rule-type').value='<?php  echo empty($rule['ruletype'])==1?1:$rule['ruletype'];?>';
						
					function keywordstypeAction(rule_type_keywords,init)
					{
						if(rule_type_keywords==0)
						{
									document.getElementById('rule-keywords').style.display="block";
									if(init!=1)
									{
									document.getElementById('rule-keywords').value="";
									}
						}
						if(rule_type_keywords==1)
						{
									document.getElementById('rule-keywords').value="<?php  echo default_key;?>";
									document.getElementById('rule-keywords').style.display="none";
						}
						if(rule_type_keywords==2)
						{
									document.getElementById('rule-keywords').value="<?php  echo subscribe_key;?>";
									document.getElementById('rule-keywords').style.display="none";
						}
								
						
							
					}
						</script>
										    
				</div>
			</div>
									

			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 触发类型：</label>

										<div class="col-sm-9">
										   			<input type="text" class="span2" placeholder="" id="rule-keywords"  name="keywords" value="<?php  echo $rule['keywords'];?>" /><input type="radio" name="ruletypekeywords" value="0" onchange="keywordstypeAction(this.value,0)" <?php if($rule['keywords']==default_key){ }else{ if($rule['keywords']==subscribe_key){ }else{echo 'checked';}} ?>>自定义关键字<input type="radio" name="ruletypekeywords" value="1" onchange="keywordstypeAction(this.value,0)" <?php if($rule['keywords']==default_key){ echo 'checked';}else{ if($rule['keywords']==subscribe_key){ }else{}} ?>>默认回复<input type="radio" name="ruletypekeywords" value="2" onchange="keywordstypeAction(this.value,0)" <?php if($rule['keywords']==default_key){ }else{ if($rule['keywords']==subscribe_key){ echo 'checked'; }else{}} ?>>关注自动回复
										   			
				</div> 
			</div>
			
						<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > <span  id="pictr1" >图片：</span></label>

										<div class="col-sm-9">
										   <span  id="pictr2">
									<div class="fileupload fileupload-new" data-provides="fileupload">
			                       		 <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
			                        	 <?php  if(!empty($rule['thumb'])) { ?>
			                            <img style="width:100%" src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $rule['thumb'];?>" alt="" onerror="$(this).remove();">
			                              <?php  } ?>
			                            </div>
			                         <input name="thumb" id="thumb" type="file"  />
			                            <a href="#" class="fileupload-exists" data-dismiss="fileupload">移除图片</a>
			                        </div>
									
								<span class="help-block">只支持JPG图片</span>  </span>
				</div>
			</div>
			
			
					<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 描述：</label>

										<div class="col-sm-9">
			<textarea name="description" cols="60" rows="8" id="rule-description" ><?php  echo $rule['description'];?></textarea>
	</div>
			</div>
	
	
	
			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > <span id="urltr1" >url：</span></label>

										<div class="col-sm-9">
										   		<span id="urltr2" >
					<input type="text"  style="width:400px" placeholder="" id="rule-url"  name="url" value="<?php  echo $rule['url'];?>" /> &nbsp;
					<br>
								<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'shopindex'));?>');"><i class="icon-home"></i>商城首页</a>&nbsp;
							<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex'));?>');"><i class="icon-home"></i>个人中心</a>&nbsp;
						<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'help'));?>');"><i class="icon-home"></i>帮助说明</a>&nbsp;
					
						<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'time_goodlist'));?>');"><i class="icon-home"></i>限时秒杀</a>&nbsp;
						</span>
				</div>
			</div>
			
			
					<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > </label>

										<div class="col-sm-9">
										  
					<button type="submit" class="btn btn-primary " name="submit" value="提交">提交</button>
				</div>
			</div>
			
</form>



<script>

	keywordstypeAction(<?php if($rule['keywords']==default_key){ echo 1;}else{ if($rule['keywords']==subscribe_key){ echo 2;}else{echo 0;}} ?>,1);
		function actionurl(vurl)
	{
		$("#rule-url").val(vurl);
	}
	
	function formcheck()
	{

				if(document.getElementById('rule-title').value=='')
				{
					alert("标题不能为空");	
					return false;
				}
				
					if(document.getElementById('rule-keywords').value=='')
				{
					alert("触发关键字不能为空");	
					return false;
				}
	
			
			return true;	
		
	}
		ruletypeAction();
	</script>
<?php  include page('footer');?>
