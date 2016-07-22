<?php defined('SYSTEM_IN') or exit('Access Denied');?><?php  include page('header');?>
<h3 class="header smaller lighter blue">配送区域管理</h3>
  <form action="" method="post" name="theForm"  enctype="multipart/form-data" class="form-horizontal" role="form">
  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 配送区域名称：</label>

										<div class="col-sm-9">
                   	 <input type="text" name="dispatchname" value="<?php  echo $item['dispatchname'];?>" />
										</div>
									</div>
 	<input type="hidden" name="express" value="<?php  echo $dispatch['code'];?>" />
  <input type="hidden" name="sendtype" value="<?php  echo $dispatch['sendtype'];?>" />
  <input type="hidden" name="displayorder" value="0" />
								      
   <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 重量设置：</label>

										<div class="col-sm-9">
                   	   <strong>首重重量</strong>
                        <select name="firstweight" id="firstweight" class="span1">
                            <option value="500">0.5</option>
                            <option value="1000" selected="">1</option>
                            <option value="1200">1.2</option>
                            <option value="2000">2</option>
                            <option value="5000">5</option>
                            <option value="10000">10</option>
                            <option value="20000">20</option>
                            <option value="50000">50</option>

                        </select> KG
，
                     <strong>续重重量</strong>
                        <select name="secondweight" id="secondweight" class="span1">
                              <option value="500">0.5</option>
                            <option value="1000" selected="">1</option>
                            <option value="1200">1.2</option>
                            <option value="2000">2</option>
                            <option value="5000">5</option>
                            <option value="10000">10</option>
                            <option value="20000">20</option>
                            <option value="50000">50</option>

                        </select> KG
										</div>
									</div>
 
  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > 价格设置：</label>

										<div class="col-sm-9">
                   	      <strong>首重价格</strong>
                        <input type="text" name="firstprice" id="firstprice" class="span1" value="<?php  echo $item['firstprice'];?>"> 元
，
                     <strong>续重价格</strong>
                        <input type="text" name="secondprice" id="secondprice" class="span1" value="<?php  echo $item['secondprice'];?>"> 元

										</div>
									</div>
									
								
									
										 <div class="form-group">

										<label class="col-sm-2 control-label no-padding-left" > 区域:</label>



										<div class="col-sm-9">

	 <select name="country" id="country" class="pull-left form-control" style="width:70px; margin-right:1%;">



												<option value="中国" selected="true">中国</option>

						

											</select>

                   	 <select name="sel-provance" id="sel-provance" onChange="selectCity();" class="pull-left form-control" style="width:15%; margin-right:1%;">



												<option value="" selected="true">省/直辖市</option>

						

											</select>

						

											<select name="sel-city" id="sel-city" onChange="selectcounty()" class="pull-left form-control" style="width:20%; margin-right:1%;">

						

												<option value="" selected="true">请选择</option>

						

											</select>

						

											<select name="sel-area" id="sel-area" class="pull-left form-control" style="width:20%;">

						

												<option value="" selected="true">请选择</option>

						

											</select>

										&nbsp;&nbsp;&nbsp;<input name="addbtn" type="button" value="+" class="btn btn-info" onclick="addRegion()"/>
										</div>

									</div> 

												 <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" > </label>

										<div class="col-sm-9" id="regionCell">
											
		<?php  if(is_array($dispatch_areas)) { foreach($dispatch_areas as $area) {
			$regionName=$area['country'];
			if(!empty($area['provance']))
			{
				$regionName=$regionName."-".$area['provance'];
			}
				if(!empty($area['city']))
			{
				$regionName=$regionName."-".$area['city'];
			}
				if(!empty($area['area']))
			{
					$regionName=$regionName."-".$area['area'];
			}
			 ?>
		
		<input type='checkbox' name='regions[]' value='<?php echo $regionName;?>' checked='true' /> <?php echo $regionName;?>
			<?php  } } ?>
												</div>
									</div>
									
											  <div class="form-group">
										<label class="col-sm-2 control-label no-padding-left" for="form-field-1"> </label>

										<div class="col-sm-9">
										<input name="submit" type="submit" value=" 提 交 " class="btn btn-info"/>
										
										</div>
									</div>
  	</form>

	
		<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>/addons/common/js/cascade2.js?x=20150806"></script>

		<script>
			<?php  if($item['firstweight']){?> 
				document.getElementById('firstweight').value='<?php echo $item['firstweight'];?>';
				 <?php }?>
			
			<?php  if($item['secondweight']){?> 		document.getElementById('secondweight').value='<?php echo $item['secondweight'];?>'; <?php }?>
			cascdeInit('<?php echo RESOURCE_ROOT;?>/addons/common/js/','','','');


/**
 * 添加一个区域
 */
function addRegion()
{
    var selProvince = document.getElementById('sel-provance').value;
    var selCity     =  document.getElementById('sel-city').value;
    var selArea =  document.getElementById('sel-area').value;
    var regionCell  = document.getElementById("regionCell");

  var regionName="中国";
  if(selProvince!="请选择")
  {
  	regionName=regionName+"-"+selProvince;
  }
    if(selCity!="请选择")
  {
  	regionName=regionName+"-"+selCity;
  }
    if(selArea!="请选择")
  {
  	regionName=regionName+"-"+selArea;
  }

    // 检查该地区是否已经存在
    exists = false;
    for (i = 0; i < document.forms['theForm'].elements.length; i++)
    {
      if (document.forms['theForm'].elements[i].type=="checkbox")
      {
        if (document.forms['theForm'].elements[i].value == regionName)
        {
          exists = true;
          alert('选择的区域已经存在');
        }
      }
    }
    // 创建checkbox
    if (!exists)
    {
      regionCell.innerHTML += "<input type='checkbox' name='regions[]' value='" + regionName + "' checked='true' /> " + regionName + "&nbsp;&nbsp;";
    }
}


function jsSelectIsExitItem(objSelect,objItemValue)   
{   
     var isExit = false ;   
     for ( var i=0;objSelect.length>i;i++)   
     {   
         if (objSelect.options[i].value == objItemValue)   
         {   
             isExit = true ;   
             break ;   
         }   
     }        
     return isExit;   
}

			var express='<?php  echo empty($item['express'])?'':'sunfeng';?>';
			
			<?php  if(!empty($item['express'])){?> 
				if(jsSelectIsExitItem(document.getElementById('expresscompy'),'<?php  echo $item['express'];?>'))
				{
				document.getElementById('expresscompy').value='<?php  echo $item['express'];?>';	
				}else
					{
							//document.getElementById('expresscompy').value='';
					}<?php }?>
			function selectexpress()
			{
						document.getElementById('express').value=document.getElementById('expresscompy').value;
	/*if(	document.getElementById('expresscompy').value==''||document.getElementById('expresscompy').value==null)
	{
	
			express='';
		document.getElementById('expressdiv1').style.display='block';
			document.getElementById('expressdiv2').style.display='block';
	}else
		{
			
				document.getElementById('expressdiv1').style.display='none';
					document.getElementById('expressdiv2').style.display='none';
		document.getElementById('express').value=document.getElementById('expresscompy').value;
		}*/
				
			}
		<?php  if($item['sendtype'] == 1) { ?>			document.getElementById('expressdiv3').style.display='none';<?php  } ?> 
			selectexpress();
			</script>
<?php  include page('footer');?>