<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue"><?php  if(!empty($item['id'])) { ?>编辑<?php  }else{ ?>新增<?php  } ?>商品</h3>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-ui-1.10.3.min.js"></script>

 <form action="" method="post" name="theForm" enctype="multipart/form-data" class="form-horizontal" role="form" onsubmit="return fillform()">
 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商品名称：</label>

										<div class="col-sm-9">
													 <input type="text" name="goodsname" id="goodsname" maxlength="100" class="span7"  value="<?php  echo $item['title'];?>" />
										</div>
		</div>
		


 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 货号：</label>

										<div class="col-sm-9">
												 <input type="text" name="goodssn"  value="<?php  echo $item['goodssn'];?>" /> 
										</div>
		</div>

 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 是否上架销售：</label>

										<div class="col-sm-9">
												 <input type="radio" name="status" value="1" id="isshow1" <?php  if($item['status'] == 1) { ?>checked="true"<?php  } ?> /> 是  &nbsp;&nbsp;
             <input type="radio" name="status" value="0" id="isshow2"  <?php  if($item['status'] == 0) { ?>checked="true"<?php  } ?> /> 否
										</div>
		</div>
		
		




		 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 分类：</label>

										<div class="col-sm-9">
												  <select  style="margin-right:15px;" id="pcate" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off">
                <option value="0">请选择一级分类</option>
                <?php  if(is_array($category)) { foreach($category as $row) { ?>
                <?php  if($row['parentid'] == 0) { ?>
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $item['pcate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['name'];?></option>
                <?php  } ?>
                <?php  } } ?>
            </select>
            <select  id="cate_2" name="ccate" autocomplete="off">
                <option value="0">请选择二级分类</option>
                <?php  if(!empty($item['ccate']) && !empty($children[$item['pcate']])) { ?>
                <?php  if(is_array($children[$item['pcate']])) { foreach($children[$item['pcate']] as $row) { ?>
                <option value="<?php  echo $row['0'];?>" <?php  if($row['0'] == $item['ccate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['1'];?></option>
                <?php  } } ?>
                <?php  } ?>
            </select>
										</div>
		</div>
		
		
		<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 本店售价：</label>

										<div class="col-sm-9">
												  <input type="text" name="marketprice" id="marketprice" value="<?php  echo empty($item['marketprice'])?'0':$item['marketprice'];?>" />元
										</div>
		</div>
		
		
			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 市场售价：</label>

										<div class="col-sm-9">
												  <input type="text" name="productprice" id="productprice"  value="<?php  echo empty($item['productprice'])?'0':$item['productprice'];?>" />元
										</div>
		</div>
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 重量：</label>

										<div class="col-sm-9">
												<input type="text" name="weight" id='weight' value="<?php  echo empty($item['weight'])?'0':$item['weight'];?>" />克
										</div>
		</div>
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 库存：</label>

										<div class="col-sm-9">
												
          	 <input type="text" name="total" id="total" value="<?php  echo empty($item['total'])?'0':$item['total'];?>" /> 
										</div>
		</div>
		
		  	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> 返还金额</label>

										<div class="col-sm-9">
												
          	<input type="radio" name="goodsFHtype" value="1" <?php  if($item['goodsFHtype'] == 1) { ?>checked="true"<?php  } ?>> 商品售价比例(%)
            &nbsp;&nbsp;
          <input type="radio" name="goodsFHtype" value="0" <?php  if(empty($item['goodsFHtype'])) { ?>checked="true"<?php  } ?>> 固定金额(元)
        <input type="text" name="goodsFHprice" value="<?php  echo empty($item['goodsFHprice'])?'0':$item['goodsFHprice'];?>" /> 
										</div>
		</div>
				   	   
				   	   
				   	   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left"> 佣金金额</label>

										<div class="col-sm-9">
												
          	<input type="radio" name="customCommission" value="0" id="customCommission"  onClick="changecommissiondiv(0)" <?php  if($bj_tbk_good_commission['customCommission'] == 0) { ?>checked="true"<?php  } ?>> 店铺佣金
            &nbsp;&nbsp;
          <input type="radio" name="customCommission" value="1" id="customCommission" onClick="changecommissiondiv(1)" <?php  if($bj_tbk_good_commission['customCommission'] == 1) { ?>checked="true"<?php  } ?>> 自定义佣金
       
										</div>
		</div>
		

				   	     <span id="commission_div" style="display:none">
		  <div class="form-group">
	<label class="col-sm-2 control-label no-padding-left" > 分佣方式：</label>
										<div class="col-sm-9">
											
            			<script>
            				var type1=true;
            				var type2=false;
            				</script>
				<input <?php  echo empty($bj_tbk_good_commission['customCommissionType'])?'checked':'';?> type="radio" id="commissionType1" name="customCommissionType" value="0" onchange="type2=false;if(type1==true){type1=false;return;}if(confirm('分佣模式即将改变成【普通模式】，数据变动较大，是否确认更改')){document.getElementById('commissionType2').checked=false;document.getElementById('commissionType1').checked=true;}else{document.getElementById('commissionType1').checked=false;document.getElementById('commissionType2').checked=true;}" > 普通模式 ，
			<input <?php  echo $bj_tbk_good_commission['customCommissionType']==1?'checked':'';?> type="radio" id="commissionType2" name="customCommissionType" value="1" onchange="type1=false;if(type2==true){type2=false;return;}if(confirm('分佣模式即将改变成【省钱模式】，数据变动较大，是否确认更改')){document.getElementById('commissionType1').checked=false;document.getElementById('commissionType2').checked=true;}else{document.getElementById('commissionType2').checked=false;document.getElementById('commissionType1').checked=true;}"> 省钱模式
						
				
									</div>
									</div>
		
		
		
			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 1级佣金：</label>

										<div class="col-sm-9">
												
          	 <input type="text" name="bj_tbk_commission" id="bj_tbk_commission" value="<?php  echo (empty($item['id'])&&empty($bj_tbk_good_commission['commission1']))?$cfg['bj_tbk_globalCommission']:$bj_tbk_good_commission['commission1'];?>" /> %
										</div>
		</div>
		
		
		<?php 
		
			$clevel=3;
				for($tlevel=2;$tlevel<=$clevel;$tlevel++)
				{
					?>
						<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >  <?php echo $tlevel;?>级佣金：</label>

										<div class="col-sm-9">
												
          	 <input type="text" name="bj_tbk_commission<?php echo $tlevel;?>" id="bj_tbk_commission<?php echo $tlevel;?>" value="<?php  echo (empty($item['id'])&&empty($bj_tbk_good_commission['commission'.$tlevel]))?$cfg['bj_tbk_globalCommission'.$tlevel]:$bj_tbk_good_commission['commission'.$tlevel];?>" />  %
										</div>
		</div>	
					
					
					<?php
				}
		
		?>
		</span>
			<script>
							function changecommissiondiv(selects)
							{
										
								if(selects==1)
								{
									document.getElementById('commission_div').style.display="block";
								}else
									{
										document.getElementById('commission_div').style.display="none";
										}
								
								
								
								
							}
				 changecommissiondiv("<?php  echo empty($bj_tbk_good_commission['customCommission'])?0:$bj_tbk_good_commission['customCommission'] ;?>");
						
							</script>
	
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 减库存方式：</label>

										<div class="col-sm-9">
												
          	<input type="radio" name="totalcnf" value="0" id="totalcnf1" <?php  if(empty($item) || $item['totalcnf'] == 0) { ?>checked="true"<?php  } ?> /> 拍下减库存
            &nbsp;&nbsp;
          <input type="radio" name="totalcnf" value="1" id="totalcnf2"  <?php  if(!empty($item) && $item['totalcnf'] == 1) { ?>checked="true"<?php  } ?> /> 永不减库存
       
										</div>
		</div>
		
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 商品属性：</label>

										<div class="col-sm-9">
				 <input type="checkbox" name="isrecommand" value="1" id="isrecommand" <?php  if($item['isrecommand'] == 1) { ?>checked="true"<?php  } ?> /> 首页推荐
				 		 <input type="checkbox" name="isnew" value="1" <?php  if($item['isnew'] == 1) { ?>checked="true"<?php  } ?> /> 新品
				 		 		 <input type="checkbox" name="isfirst" value="1"  <?php  if($item['isfirst'] == 1) { ?>checked="true"<?php  } ?> /> 首发
				 		 		 		 <input type="checkbox" name="ishot" value="1"  <?php  if($item['ishot'] == 1) { ?>checked="true"<?php  } ?> /> 热卖
				 		 		 		  <input type="checkbox" name="isjingping" value="1"<?php  if($item['isjingping'] == 1) { ?>checked="true"<?php  } ?> /> 精品
                    &nbsp;   
										</div>
		</div>
		
					<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 免运费商品：</label>

										<div class="col-sm-9">
				 <input type="checkbox" name="issendfree" value="1" id="isnew" <?php  if($item['issendfree'] == 1) { ?>checked="true"<?php  } ?> /> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。
           &nbsp;   
										</div>
		</div>
		
			<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 限时促销：</label>

										<div class="col-sm-9">
				 
<input type="checkbox" name="istime" id='istime' value="1" id="isnew" <?php  if($item['istime'] == 1) { ?>checked="true"<?php  } ?> /> 开启限时促销
         <input type="text" id="datepicker_timestart" name="timestart" value="<?php if(!empty($item['timestart'])){echo date('Y-m-d H:i',$item['timestart']);}?>" readonly="readonly" />
	<script type="text/javascript">
		$("#datepicker_timestart").datetimepicker({
			format: "yyyy-mm-dd hh:ii",
			minView: "0",
			//pickerPosition: "top-right",
			autoclose: true
		});
	</script> - 
	<input type="text"  id="datepicker_timeend" name="timeend" value="<?php if(!empty($item['timestart'])){echo date('Y-m-d H:i',$item['timeend']);}?>" readonly="readonly" />
	<script type="text/javascript">
		$("#datepicker_timeend").datetimepicker({
			format: "yyyy-mm-dd hh:ii",
			minView: "0",
			//pickerPosition: "top-right",
			autoclose: true
		});
	</script>  
										</div>
		</div>
		
		
					<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >奖励积分：</label>

										<div class="col-sm-9">
				<input type="text" name="credit" id="credit" value="<?php  echo empty($item['credit'])?'0':$item['credit'];?>" />
           
            <p class="help-block">会员购买商品赠送的积分, 如果不填写，则默认为不奖励积分</p>
          
										</div>
		</div>
		
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >商品主图：<br/>（建议640*640）</label>

										<div class="col-sm-9">
				  <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;">
                        	 <?php  if(!empty($item['thumb'])) { ?>
                            <img src="<?php echo WEBSITE_ROOT;?>/attachment/<?php  echo $item['thumb'];?>" alt="" onerror="$(this).remove();">
                              <?php  } ?>
                            </div>
                        <div>
                         <input name="thumb" id="thumb" type="file" />
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">移除图片</a>
                        </div>
                    </div>
										</div>
		</div>
		
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 其他图片：</label>

										<div class="col-sm-9">
				         <span id="selectimage" tabindex="-1" class="btn btn-primary"><i class="icon-plus"></i> 上传照片</span><span style="color:red;">
                    <input name="piclist" type="hidden" value="<?php  echo $item['piclist'];?>" /></span>
                <div id="file_upload-queue" class="uploadify-queue"></div>
                <ul class="ipost-list ui-sortable" id="fileList">
                    <?php  if(is_array($piclist)) { foreach($piclist as $v) { ?> 
                    <li class="imgbox" style="list-style-type:none;display:inline;  float: left;  position: relative;   width: 125px;  height: 130px;">
                        <span class="item_box">
                            <img src="<?php echo WEBSITE_ROOT;?>/attachment/<?php  echo $v['picurl'];?>" style="width:50px;height:50px">    </span>
                       		 <a  href="javascript:;" onclick="deletepic(this);" title="删除">删除</a>
                    
                        <input type="hidden" value="<?php  echo $v['picurl'];?>" name="attachment[]">
                    </li>
                    <?php  } } ?>
                </ul>
										</div>
		</div>
		
		
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >商品分享描述：</label>

										<div class="col-sm-9">
             				 <input type="text" name="description" id="description" maxlength="100" class="col-xs-10 col-sm-4"  value="<?php  echo $item['description'];?>" />
									
										</div>
		</div>
		
		
				<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >商品详细描述：<br/><span style="font-size:12px">(建议图片宽不超过640px)</span></label>

										<div class="col-sm-9">
                  <textarea  id="container" name="content" ><?php  echo $item['content'];?></textarea>
             
										</div>
		</div>
		
<?php  include page('goods_option');?>
      
      	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" ></label>

										<div class="col-sm-9">
				    <button type="submit" class="btn btn-primary span2" name="submit" value="submit"><i class="icon-edit"></i>保存商品信息</button>    
										</div>
		</div>
		
 </form>


		
		
		
         
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/themes/default/default.css" />
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/kindeditor/lang/zh_CN.js"></script>    
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/ueditor.config.js?x=201508021"></script>
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/ueditor/ueditor.all.min.js?x=141"></script>
<script type="text/javascript">var ue = UE.getEditor('container');</script>

    
<script language="javascript">
		var category = <?php  echo json_encode($children)?>;
   function fetchChildCategory(cid) {
	var html = '<option value="0">请选择二级分类</option>';
	if (!category || !category[cid]) {
		$('#cate_2').html(html);
		return false;
	}
	for (i in category[cid]) {
		html += '<option value="'+category[cid][i][0]+'">'+category[cid][i][1]+'</option>';
	}
	$('#cate_2').html(html);
}
fetchChildCategory(document.getElementById("pcate").options[document.getElementById("pcate").selectedIndex].value);
<?php if(!empty( $item['ccate'])){?>
   document.getElementById("cate_2").value="<?php echo $item['ccate']?>";
 <?php }?>
$(function(){
	 
	var i = 0;
	$('#selectimage').click(function() {
		var editor = KindEditor.editor({
			allowFileManager : false,
			imageSizeLimit : '10MB',
			uploadJson : '<?php echo WEBSITE_ROOT.mobile_url('upload',array('name'=>'shop'));?>'
		});
		editor.loadPlugin('multiimage', function() {
			editor.plugin.multiImageDialog({
				clickFn : function(list) {
					if (list && list.length > 0) {
						for (i in list) {
							if (list[i]) {
								html =	'<li class="imgbox" style="list-style-type:none;display:inline;  float: left;  position: relative;  width: 125px;  height: 130px;">'+
								'<span class="item_box"> <img src="'+list[i]['url']+'" style="width:50px;height:50px"></span>'+
								'<a href="javascript:;" onclick="deletepic(this);" title="删除">删除</a>'+
								'<input type="hidden" name="attachment-new[]" value="'+list[i]['filename']+'" />'+
								'</li>';
								$('#fileList').append(html);
								i++;
							}
						}
						editor.hideDialog();
					} else {
						alert('请先选择要上传的图片！');
					}
				}
			});
		});
	});
});
function deletepic(obj){
	if (confirm("确认要删除？")) {
		var $thisob=$(obj);
		var $liobj=$thisob.parent();
		var picurl=$liobj.children('input').val();
		$.post('<?php  echo create_url('site',array('name' => 'manager','do' => 'picdelete'))?>',{ pic:picurl},function(m){
			if(m=='1') {
				$liobj.remove();
			} else {
				alert("删除失败");
			}
		},"html");	
	}
}
function fillform()
{
		if(ue.queryCommandState( 'source' )==1)
		{
			
	document.getElementById("container").value=ue.getContent();	
		}else
			{
			
	document.getElementById("container").value=ue.body.innerHTML;	
			}
	return true;
}
    </script>
<?php  include page('footer');?>
