<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html>
<head>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<link type="text/css" rel="stylesheet" href="<?php  echo WEBSITE_ROOT;?>addons/addon7/credit/base.css" />
<link type="text/css" rel="stylesheet" href="<?php  echo WEBSITE_ROOT;?>addons/addon7/credit/style.css" />
         <script type="text/javascript" src="<?php  echo WEBSITE_ROOT;?>addons/addon7/credit/script.js"></script>
         
	<link rel="stylesheet" type="text/css" href="<?php  echo WEBSITE_ROOT;?>addons/addon7/credit/main.css?2014-05-21" media="all" />
<title>我兑换的奖品</title>
</head>
<body>
	<section class="order">
        <section class="order_content">
            <section class="order_item">
		<aside>我的积分：<?php  echo $member['credit'];?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php  echo create_url('mobile', array('name' => 'addon7','do' => 'index'))?>" style="color: #56c6d6;font-weight:bold">兑换列表</a></aside>
            </section>
        </section>

    	<!--content-->
        <section class="order_content">
			<?php  if(is_array($award_list)) { foreach($award_list as $item) { ?>
        	<!--item-->
            <section class="order_item">
				<aside><?php  echo $item['title'];?></aside>
                <article>
				<section class="order_item_l"><img src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $item['logo']?>" /></section>
                	<section class="order_item_r">
					<p>消耗积分：<?php  echo $item['credit_cost'];?></p>
					<p>兑换日期： <?php  echo date('Y-m-d H:i:s', $item['createtime'])?></p> 
						<p>兑换状态： <?php  echo $item['status']==0?"未兑换":"已兑换";?></p> 
                </section>
                </article>
            </section>
            <!--item end-->
			<?php  } } ?>
        </section>
        <!--content end-->
	</section>
	
<?php  include themePage('footer');?>
<?php include themePage('weixinshare');?>
<?php include page('footer');?>	