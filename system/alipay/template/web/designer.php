<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>



<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript">$(function(){
$('tbody.mlist').sortable({handle: '.icon-move'});$('.smlist').sortable({handle: '.icon-move'});});
function addMenu(){if(!($(".mlist .hover").length>=4)){var t='<tr class="hover" data-url=""><td><div class="menu"><input type="text" class="span4" value=""> &nbsp; &nbsp; <a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="功能设置">功能设置</a> &nbsp; <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除">删除</a> &nbsp; <a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单">添加子菜单</a> </div><div class="smlist submenu"></div></td></tr>';$("tbody.mlist").append(t)}}function addSubMenu(t){if(!(t.find("div").length>=5)){var a='<div style="margin-top:20px;padding-left:80px;" data-url=""><input type="text" class="span3" value=""> &nbsp; &nbsp; <a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="功能设置">功能设置</a> &nbsp; <a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除">删除</a> </div>';t.append(a)}}function deleteMenu(t){$(t).parent().parent().hasClass("smlist")?$(t).parent().remove():$(t).parent().parent().parent().remove()}function setMenuAction(t){if(null!=t){if(t.find(".smlist div").length>0)return void alert("该菜单含有子菜单,不能设置动作");currentEntity=t,"click"==$(t).data("do")?document.getElementById("ipt_radio_forward").checked=!0:"view"==$(t).data("do")&&(document.getElementById("ipt_radio_url").checked=!0);var a=$(t).data("url");$("#ipt-url").val(""===a||void 0===a?"http://":$(t).data("url")),$(":radio:checked").trigger("click"),$("#dialog").modal("show")}if(document.getElementById("ipt_radio_forward").checked){$("#ipt-forward").val($(t).data("forward"));};}function saveMenuAction(t){var a=currentEntity,e=$(":radio:checked").val();if("forward"==e?e="click":"url"==e&&(e="view"),null!=a){if("view"==e)if(/^(http|https)(.*)/.test($("#ipt-url").val()))$(a).data("url",$("#ipt-url").val());else{if("save"==t)return alert("由于公众平台限制，URL必须以http或是https开头。"),!1;$(a).data("url","http://")}$(a).data("do",e),$(a).data("forward",$("#ipt-forward").val())}}function saveMenu(t){if($("#menutype").val(t),"history"==t&&$("#form")[0].submit(),$(".span4:text").length>4)return void alert("不能输入超过 4 个主菜单才能保存.");if($(".span4:text,.span3:text").filter(function(){return""==$.trim($(this).val())}).length>0)return void alert("存在未输入名称的菜单.");var a="[",e=!1;return $(".mlist .hover").each(function(){var t=$.trim($(this).find(".span4:text").val()).replace(/"/g,'"');if("forward"==$(this).data("do"))var i="click";else if("url"==$(this).data("do"))var i="view";else var i=$(this).data("do");var r=$(this).data("url");r||(r="");var n=$.trim($(this).data("forward"));if(n||(n=""),a+='{"name": "'+t+'"',$(this).find(".smlist div").length>0){if(a+=',"sub_button": [',$(this).find(".smlist div").each(function(){var t=$.trim($(this).find(".span3:text").val()).replace(/"/g,'"');if("forward"==$(this).data("do"))var i="click";else if("url"==$(this).data("do"))var i="view";else var i=$(this).data("do");var r=$(this).data("url");r||(r="");var n=$.trim($(this).data("forward"));return n||(n=""),a+='{"name": "'+t+'"',"view"!=i&&""==n||"view"==i&&!r?(alert("子菜单项 “"+t+"”未设置对应规则."),e=!0,!1):(a+="click"==i?',"type": "click","key": "'+(n)+'"':"view"==i?',"type": "view","url": "'+r+'"':',"type": "'+i+'","key": "'+(n)+'"',void(a+="},"))}),e)return!1;a=a.slice(0,-1),a+="]"}else{if("view"!=i&&""==n||"view"==i&&!r)return alert("菜单 “"+t+"”不存在子菜单项, 且未设置对应规则."),e=!0,!1;a+="click"==i?',"type": "click","key": "'+(n)+'"':"view"==i?',"type": "view","url": "'+r+'"':',"type": "'+i+'","key": "'+(n)+'"'}a+="},"}),e?!1:(a=a.slice(0,-1),a+="]",$("#menudate").val(a),$("#do").val("menumodify"),void $("#form")[0].submit())}function actionurl(t){$("#ipt-url").val(t)}var pIndex=1,currentEntity=null;$(function(){$(".mlist .hover").each(function(){$(this).data("do",$(this).attr("data-do")),$(this).data("url",$(this).attr("data-url")),$(this).data("forward",$(this).attr("data-forward"))}),$(".mlist .hover .smlist div").each(function(){$(this).data("do",$(this).attr("data-do")),$(this).data("url",$(this).attr("data-url")),$(this).data("forward",$(this).attr("data-forward"))}),$(':radio[name="ipt"]').click(function(){this.checked&&("url"==$(this).val()?($("#url-container").show(),$("#forward-container").hide()):($("#url-container").hide(),$("#forward-container").show()))}),$("#dialog").modal({backdrop:"static",keyboard:!1,show:!1}),$("#ipt-forward").keydown(function(t){13==t.keyCode&&$("#search").click()}),$("#dialog").click(function(t){var a=$(t.target).attr("id")})});

</script>
<style type="text/css">
	.table-striped td{padding-top: 10px;padding-bottom: 10px}
	a{font-size:14px;}
	a:hover, a:active{text-decoration:none; color:red;}
	.hover td{padding-left:10px;}
</style>

<h3 class="header smaller lighter blue">菜单设计器</h3>

<div class="main">
	<div class="form form-horizontal">
		<table class="table">
			<tbody class="mlist ui-sortable">
			<input type="hidden" id="menu-index" value="" data-subindex="" />
 			<?php  if(!empty($menus)) { ?>
			<?php  if(is_array($menus)) { foreach($menus as $row) { ?>
			<tr class="hover" data-do="<?php  echo $row['type'];?>" data-url="<?php  echo $row['url'];?>" data-forward="<?php  echo $row['forward'];?>">
					<td>
						<div class="menu">
							<input type="text" class="span4" value="<?php  echo $row['title'];?>"> &nbsp; &nbsp;
							<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
							<a href="javascript:;" onclick="setMenuAction($(this).parent().parent().parent());" class="icon-edit" title="功能设置">功能设置</a> &nbsp;
							<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除">删除</a> &nbsp;
							<a href="javascript:;" onclick="addSubMenu($(this).parent().next());" title="添加子菜单" class="icon-plus-sign" title="添加菜单">添加子菜单</a>
						</div>
						<div class="smlist submenu ui-sortable">
							<?php  if(!empty($row['subMenus'])) { ?>
							<?php  if(is_array($row['subMenus'])) { foreach($row['subMenus'] as $btn) { ?>
							<div style="margin-top:20px;padding-left:80px;" data-do="<?php  echo $btn['type'];?>" data-url="<?php  echo $btn['url'];?>" data-forward="<?php  echo $btn['forward'];?>">
								<input type="text" class="span3" value="<?php  echo $btn['title'];?>"> &nbsp; &nbsp;
								<a href="javascript:;" class="icon-move" title="拖动调整此菜单位置"></a> &nbsp;
								<a href="javascript:;" onclick="setMenuAction($(this).parent());" class="icon-edit" title="功能设置">功能设置</a> &nbsp;
								<a href="javascript:;" onclick="deleteMenu(this)" class="icon-remove-sign" title="删除">删除</a>
							</div>
							<?php  } } ?>
							<?php  } ?>
						</div>
					</td>
				</tr>
			<?php  } } ?>
			<?php  } ?>
			</tbody>
		</table>
		
	
		
		<table class="table">
			<tbody>
				<tr>
					<td>
						<input type="button" value="+添加菜单" class="btn btn-warning span3" onclick="addMenu();"/>&nbsp;&nbsp;&nbsp;&nbsp;	<input type="button" value="保存菜单结构" class="btn btn-primary span3" onclick="return saveMenu();"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="清除自定义菜单" class="btn btn-primary span3" onclick="$('#do').val('remove');$('#form')[0].submit();" />
						<span class="help-block">由于缓存原因可能需要在24小时内生效</span>
					</td>
				</tr>
	
		
			</tbody>
		</table>
	</div>
</div>
<form action="" method="post" id="form">
	<textarea id="menudate"  name="menudate" style="display:none"></textarea>
	<input id="do" name="do" type="hidden" />
	<input id="menutype" name="menutype" type="hidden" /> 
</form>

<div id="dialog" class="modal  fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">选择要执行的操作</h4>
      </div>
      <div class="modal-body" style="height:150px">
      	

      	
      		  <div class="form-group">
										<label class="col-sm-1 control-label no-padding-left" > </label>

										<div class="col-sm-9">
											
														
						<table>
								<tr>
										<td>	
							类型(<span style="color:red">*</span>)：	<input type="radio" name="ipt"  id="ipt_radio_url" value="url"  checked="checked"> 链接，
				<input type="radio" name="ipt"  id="ipt_radio_forward"  value="forward"> 模拟关键字
							
								</td>
		</tr>	
		
			<tr>
										<td>		&nbsp;		</td>
		</tr>	
		
		<tr id="url-container">
										<td>	
											
											
											
													<table width="100%">
									<tr >
										<td>	
				<input class="col-xs-10 col-sm-2" id="ipt-url" style="width:250px" type="text" value="http://" />
			</td>
		</tr>	<tr>
			
				<tr>
										<td>		&nbsp;		</td>
		</tr>	
				<tr>
										<td>	
					<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'shopindex'));?>');"><i class="icon-home"></i>商城首页</a>&nbsp;
							<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex'));?>');"><i class="icon-home"></i>个人中心</a>&nbsp;
						<a href="javascript:;" onclick="actionurl('http://<?php echo $system_store['website'].'/'.create_url('mobile',array('name' => 'shopwap','do' => 'help'));?>');"><i class="icon-home"></i>帮助说明</a>&nbsp;
				</td>
		</tr>
	</table>
											
				
			</td>
		</tr>	<tr>
		

		
					
					
						<tr id="forward-container" style="display:none;">
									<td>	
		  		  <input class="col-xs-10 col-sm-2" style="width:250px"  id="ipt-forward" type="text">
								</td>
					</tr>
			</table>
					
					
							
					
											</div>
									</div>
      	
      </div>
      

      
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" onClick="saveMenuAction('save')"   data-dismiss="modal" name="confirmsend" value="yes"><i class="icon-edit"></i>&nbsp;保&nbsp;存&nbsp;</button>
      	
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>







</body>
</html>