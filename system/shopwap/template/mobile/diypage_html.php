<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!doctype html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <?php $pageinfo=unserialize($diyshop['pageinfo']); ?>    
        <title><?php echo $pageinfo['title']?></title>
  </head>
<body >
<?php echo $diyshop['datas'];?>
<?php if($pageinfo['diymenu']!=-1){?>


<?php include themePage('footer');?>

 	<?php  if(!empty($cfg['shop_kf_qq'])){ ?>
       
  	
         	
         	<div class="fe-floatico fe-floatico-right" style="position: fixed; width: 60px; top: 300px;min-height: 10px;right: 0px;z-index: 1000;box-sizing: border-box;" ng-style="{'width':pages[0].params.floatwidth,'top':pages[0].params.floattop}" ng-class="{'fe-floatico-right':pages[0].params.floatstyle=='right'}" ng-show="pages[0].params.floatico==1">
            <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $cfg['shop_kf_qq']; ?>&site=qq&menu=yes" target="_parent">
                <img src=" <?php echo RESOURCE_ROOT;?>addons/common/image/qq.png" ng-src="<?php echo RESOURCE_ROOT;?>addons/common/image/qq.png" style="width:100%;">
            </a>
        </div>
         	    	<?php  } ?>


<?php }?><?php  include page('footer');?>	