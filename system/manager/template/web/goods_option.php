<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<style>
	.spectable {
max-width: 100%;
background-color: transparent;
border-collapse: collapse;
border-spacing: 0;
line-height: 20px;
text-align: left;
border-spacing: 2px;
border-collapse: collapse;
border-spacing: 0;
}

.spectable thead {
display: table-header-group;
vertical-align: middle;
border-color: inherit;
}

.spectable tr {
display: table-row;
vertical-align: inherit;
border-color: inherit;
}
.spectable  thead th {
vertical-align: bottom;
}

.spectable th {
border: 1px solid #ccc;
vertical-align: middle;
text-align: center;
font-weight: bold;
}


.spectable th, .spectable td {
padding: 8px;
line-height: 20px;
text-align: left;
vertical-align: top;
border: 1px solid #ccc;
}
.option_stock_all,.option_weight_all,.option_productprice_all,.option_marketprice_all{
	width:60px
	}
	.option_stock,.option_marketprice,.option_productprice,.option_weight{
		width:72px
		} 
	</style>
	<div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" >启用商品规格：</label>
										<div class="col-sm-9">
    	 <input type="checkbox" id="hasoption" value="1" name="hasoption" <?php if($item['hasoption']==1){?>checked<?php } ?> />

										</div>
		</div>
		
  <div class="alert alert-info" style="margin-left:10px">
       添加或更改规格后，后请点击下方的【刷新规格参数表】来更新数据设置参数。<br/>
    </div>
<div id='tboption' class="form-group" style='<?php if( $item['hasoption']!=1){?>display:none<?php } ?>'>
	
	<div class="form-group">
  	<label class="col-sm-2 control-label no-padding-left" >&nbsp;</label>
										<div class="col-sm-9">
 <a href="javascript:;" class='btn btn-primary' id='add-spec' onclick="addSpec()" style="margin-top:10px;margin-bottom:10px;"  title="添加规格"><i class="icon-plus"></i>添加规格</a> 
        </div>
</div>

	<div class="form-group">
  	<label class="col-sm-2 control-label no-padding-left" >&nbsp;</label>
										<div class="col-sm-9">
    <div id='specs'>
       <?php  if(is_array($allspecs)) { foreach($allspecs as $spec) { ?>
        <?php  include page('goods_spec')?>
        <?php  } } ?>
    </div>
    </div>
</div>

	<div class="form-group">
  	<label class="col-sm-2 control-label no-padding-left" >&nbsp;</label>
										<div class="col-sm-9">
<h5 class="header smaller lighter blue">规格项参数设置  <a href="javascript:;" onclick="calc()" title="刷新规格参数表" class="btn btn-primary"><i class="icon-refresh"></i>刷新规格参数表</a> </h5>
        </div>
</div>
	<div class="form-group">
		  	<label class="col-sm-2 control-label no-padding-left" >&nbsp;</label>
			<div class="col-sm-9" id="options">
		 
		        <?php echo $html;?>
		</div>
</div>

</div>
<script>
	var rsource_url="<?php echo RESOURCE_ROOT;?>";
	var shop_spec_url="<?php echo create_url('site',array('do'=>'spec','name'=>'manager')) ?>";
	var shop_specitem_url="<?php echo create_url('site',array('do'=>'specitem','name'=>'manager')) ?>";
	</script>
<script language="javascript">
function addSpec(){$("#add-spec").html("正在处理...").attr("disabled","true").toggleClass("btn-primary");var t=shop_spec_url;$.ajax({url:t,success:function(t){$("#add-spec").html('<i class="icon-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary"),$("#specs").append(t);var e=$(".add-specitem").length-1;$(".add-specitem:eq("+e+")").focus(),window.optionchanged=!0}})}function removeSpec(t){confirm("确认要删除此规格?")&&($("#spec_"+t).remove(),window.optionchanged=!0)}function addSpecItem(t){$("#add-specitem-"+t).html("正在处理...").attr("disabled","true");var e=shop_specitem_url+"&specid="+t;$.ajax({url:e,success:function(e){$("#add-specitem-"+t).html("添加规格项").removeAttr("disabled"),$("#spec_item_"+t).append(e);var i=$("#spec_"+t+" .spec_item_title").length-1;$("#spec_"+t+" .spec_item_title:eq("+i+")").focus(),window.optionchanged=!0}})}function removeSpecItem(t){$(t).parent().parent().parent().remove()}function calc(){window.optionchanged=!1;var t='<table  class="spectable"><thead><tr>',e=[];$(".spec_item").each(function(t){var i=$(this),n={id:i.find(".spec_id").val(),title:i.find(".spec_title").val()},o=[];i.find(".spec_item_item").each(function(){var t=$(this),e={id:t.find(".spec_item_id").val(),title:t.find(".spec_item_title").val(),show:t.find(".spec_item_show").get(0).checked?"1":"0"};o.push(e)}),n.items=o,e.push(n)}),e.sort(function(t,e){return t.items.length>e.items.length?1:t.items.length<e.items.length?-1:void 0});for(var i=e.length,n=1,o=new Array(i),p=new Array(i),s=0;i>s;s++){t+="<th>"+e[s].title+"</th>";var a=e[s].items.length;0>=a&&(a=1),n*=a,o[s]=new Array(n);for(var c=0;n>c;c++)o[s][c]=new Array;{e[s].items.length}for(p[s]=1,c=s+1;i>c;c++)p[s]*=e[c].items.length}t+='<th>库存：<br/><input type="text" class="span1 option_stock_all"  VALUE=""/><span class="add-on">&nbsp;<a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></th>',t+='<th>销售价格：<br/><input type="text" class="span1 option_marketprice_all"  VALUE=""/><span class="add-on">&nbsp;<a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></th>',t+='<th>市场价格：<br/><input type="text" class="span1 option_productprice_all"  VALUE=""/><span class="add-on">&nbsp;<a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></th>',t+='<th>重量(克)：<br/><input type="text" class="span1 option_weight_all"  VALUE=""/><span class="add-on">&nbsp;<a href="javascript:;" class="icon-hand-down" title="批量设置" onclick="setCol(\'option_weight\');"></a></span></th>',t+="</tr>";for(var d=0;i>d;d++)for(var l=0,r=0,c=0;n>c;c++){var _=p[d];c%_==0?o[d][c]={title:e[d].items[l].title,html:"<td rowspan='"+_+"'>"+e[d].items[l].title+"</td>\r\n",id:e[d].items[l].id}:o[d][c]={title:e[d].items[l].title,html:"",id:e[d].items[l].id},r++,r==_&&(l++,l>e[d].items.length-1&&(l=0),r=0)}for(var h="",s=0;n>s;s++){h+="<tr>";for(var m=[],u=[],c=0;i>c;c++)h+=o[c][s].html,m.push(o[c][s].id),u.push(o[c][s].title);m=m.join("_"),u=u.join("+");var v={id:"",title:u,stock:"",costprice:"",productprice:"",marketprice:"",weight:""};$(".option_id_"+m).length>0&&(v={id:$(".option_id_"+m+":eq(0)").val(),title:u,stock:$(".option_stock_"+m+":eq(0)").val(),costprice:$(".option_costprice_"+m+":eq(0)").val(),productprice:$(".option_productprice_"+m+":eq(0)").val(),marketprice:$(".option_marketprice_"+m+":eq(0)").val(),weight:$(".option_weight_"+m+":eq(0)").val()}),h+="<td>",h+='<input name="option_stock_'+m+'[]"  type="text" class="span1 option_stock option_stock_'+m+'" value="'+("undefined"==v.stock?"":v.stock)+'"/></td>',h+='<input name="option_id_'+m+'[]"  type="hidden" class="span1 option_id option_id_'+m+'" value="'+("undefined"==v.id?"":v.id)+'"/>',h+='<input name="option_ids[]"  type="hidden" class="span1 option_ids option_ids_'+m+'" value="'+m+'"/>',h+='<input name="option_title_'+m+'[]"  type="hidden" class="span1 option_title option_title_'+m+'" value="'+("undefined"==v.title?"":v.title)+'"/></td>',h+="</td>",h+='<td><input name="option_marketprice_'+m+'[]" type="text" class="span1 option_marketprice option_marketprice_'+m+'" value="'+("undefined"==v.marketprice?"":v.marketprice)+'"/></td>',h+='<td><input name="option_productprice_'+m+'[]" type="text" class="span1 option_productprice option_productprice_'+m+'" " value="'+("undefined"==v.productprice?"":v.productprice)+'"/></td>',h+='<td><input name="option_weight_'+m+'[]" type="text" class="span1 option_weight option_weight_'+m+'" " value="'+("undefined"==v.weight?"":v.weight)+'"/></td>',h+="</tr>"}t+=h,t+="</table>",$("#options").html(t)}function setCol(t){$("."+t).val($("."+t+"_all").val())}function showItem(t){var e=$(t).get(0).checked?"1":"0";$(t).next().val(e)}function nofind(){var t=event.srcElement;t.src=rsource_url+"/addons/common/image/module-nopic-small.jpg",t.onerror=null}$(function(){$("#specs").sortable({stop:function(){window.optionchanged=!0}}),$(".spec_item_items").sortable({handle:".icon-move",stop:function(){window.optionchanged=!0}}),$("#hasoption").click(function(){var t=$(this);t.get(0).checked?$("#tboption").show():$("#tboption").hide()})});
</script>