<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">请选择店铺</h3>
<form action="" method="get" class="form-horizontal" enctype="multipart/form-data" >
				<input type="hidden" name="op" value="addselect" />
				<input type="hidden" name="name" value="manager" />
				<input type="hidden" name="do" value="pushstoregoods" />
				<input type="hidden" name="mod" value="site"/>					
						<input type="hidden" name="goodsid" value="<?php echo $_GP['goodsid'];?>"/>	
				<table class="table" style="width:95%;" align="center">
					<tbody>
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">店铺名称：</td>
			<td style="width:300px">

												<input name="sname"  type="text" value="<?php  echo $_GP['sname'];?>" />
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px"></td>
			<td>
				
						
				
			</td>	
						</tr>
				
		
				
						<tr>
							<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:120px">分公司名称：</td>
			<td  style="width:300px">
		 <select  style="margin-right:15px;" id="pcate" name="pcate" onchange="fetchChildCategory(this.options[this.selectedIndex].value)"  autocomplete="off">
                <option value="0">请选择分公司</option>
         		  <?php  if(is_array($companyli)) { foreach($companyli as $row) { ?>
       
                <option value="<?php  echo $row['id'];?>" <?php  if($row['id'] == $_GP['pcate']) { ?> selected="selected"<?php  } ?>><?php  echo $row['compName'];?></option>
            
                <?php  } } ?>
            </select>
			</td>	
			
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px">销售员：</td>
			<td >
			  <select  id="cate_2" name="ccate" autocomplete="off">
                <option value="0">请选择销售员</option>
            </select>
			</td>	
						</tr>

						
						<tr>
							<td></td>
							<td colspan="3">	
										<input name="submit2" type="submit"  onclick="document.getElementById('isselect').value='0';document.getElementById('selectmember').click();" value=" 查 找 " class="btn btn-info"/></td>
						<input name="submit" type="submit" id="selectmember"  value=" 查 找 " style="display:none"/></td>
						
					<td style="vertical-align: middle;font-size: 14px;font-weight: bold;width:130px"></td>
			<td>
				
				
			</td>	
						</tr>
					</tbody>
				</table>
				</form>
				     
									
				<form action="<?php  echo web_url('pushstoregoods', array('op' => 'addbatshop','goodsid'=>$_GP['goodsid']))?>" method="post" class="form-horizontal" enctype="multipart/form-data" >
		
					<table class="table table-striped table-bordered table-hover">
			<thead >
				<tr>
			<th  class="text-center" > <input type="checkbox" class="check_all" />&nbsp;<button type="submit"  name="sendbatexpress" value="sendbatexpress" class="btn  btn-xs btn-warning">批量添加</button></th>
    <th class="text-center"  width="150px">店铺名称</th>
    <th class="text-center" width="150px" >分公司</th>
    <th class="text-center" width="150px" >销售员</th>
    <th class="text-center" width="150px">绑定域名</th>
    <th class="text-center">操作</th>
				</tr>
			</thead>
			<tbody>
		<?php  if(is_array($store_list)) { foreach($store_list as $item) { ?>
				<tr>
		<td class="text-center"><input type="checkbox"  name="check[]" value="<?php  echo $item['id'];?>"></td>
						
          <td class="text-center">
          	<?php echo $item['sname']; ?>
          	</td>
          	   <td class="text-center">
          	<?php echo $item['compName']; ?>
          	</td>
          	   <td class="text-center">
          	<?php echo $item['realname']; ?>
          	</td>
           <td class="text-center"><?php echo $item['website']; ?></td>
            <td class="text-center">
            	<a class="btn btn-xs btn-info"  href="<?php  echo web_url('pushstoregoods', array('storeid' => $item['id'], 'op' => 'addoneshop','goodsid'=>$_GP['goodsid']))?>"><i class="icon-edit"></i>&nbsp;选择店铺&nbsp;</a> 
             		
                             </td>
				</tr>
				<?php  } } ?>
  </tbody>
    </table>		</form>
    
    
				<script language="javascript">

					     $(".check_all").click(function(){
            var checked = $(this).get(0).checked;
                    $("input[type=checkbox]").prop("checked", checked);
                    
            });
            
            
		var category = <?php  echo json_encode($children)?>;
   function fetchChildCategory(cid) {
	var html = '<option value="0">请选择销售员</option>';
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
<?php if(!empty( $_GP['ccate'])){?>
   document.getElementById("cate_2").value="<?php echo $_GP['ccate']?>";
 <?php }?>

	</script>
	
		<?php  echo $pager;?>
<?php  include page('footer');?>