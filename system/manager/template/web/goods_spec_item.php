<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<div class="spec_item_item" style="float:left;">
<div class="input-append input-prepend"  style="margin:2px;">

   <input type="hidden" class="span2 spec_item_show" name="spec_item_show_<?php  echo $spec['id'];?>[]" VALUE="<?php  echo $specitem['show'];?>" />
 
   
        <input type="text" class="span2 spec_item_title error" name="spec_item_title_<?php  echo $spec['id'];?>[]" VALUE="<?php  echo $specitem['title'];?>" />
 
    <input type="hidden" class="span2 spec_item_id" name="spec_item_id_<?php  echo $spec['id'];?>[]" VALUE="<?php  echo $specitem['id'];?>" />
    <span class="add-on"><a href="javascript:;" onclick="removeSpecItem(this)" title='删除'>删除</a>
     
    </span>
    
</div>
<div> <div class="fileupload fileupload-new  item-image" tabindex="-1" data-provides="fileupload" style="margin-top:5px;">
<div id="thumb0_span" tabindex="-1" class="fileupload-preview thumbnail" style="float:left;;width: 50px; height: 50px;">
	

	
	
     <img  width="50" height="50" onerror="nofind()"  src="<?php  if(empty($specitem['thumb'])){?><?php echo WEBSITE_ROOT;?>/assets/addons/common/image/module-nopic-small.jpg<?php  }else{?><?php echo WEBSITE_ROOT;?>/attachment/<?php  echo $specitem['thumb']?><?php  }?>"/></div>
     <span class="btn btn-file">
     <span class="fileupload-new">选择图片</span>
     <span class="fileupload-exists">更改</span>
     <input name="spec_item_thumb_<?php  echo $specitem['id'];?>" type="file"  class="shop_img_file"/></span>
     <a href="#" class="btn fileupload-exists" data-dismiss="fileupload" style="margin-top:5px">移除</a>
     <input type="hidden" name="spec_item_oldthumb_<?php  echo $specitem['id'];?>" class="shop_img_old" value='<?php  echo $specitem['thumb'];?>'/>
     </div>
</div>
</div>


