<?php defined('SYSTEM_IN') or exit('Access Denied');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="<?php  echo WEBSITE_ROOT;?>addons/addon7/credit/main.css?2014-05-21" media="all" />

<title><?php echo empty($setting['title'])?"积分兑换":$setting['title']; ?></title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />

</head>
<body onselectstart="return true;" ondragstart="return false;">

		<style>
			.list_exchange{
				padding-top:10px;
			}
			.list_exchange li[data-card]:first-of-type{
				margin-top:0;
			}
		</style>
		
<div class="WX_search" id="mallHead">
   <div style="text-align:center; font-size:18px; padding-top:10px;">您当前可以用积分：<?php  echo $member['credit'];?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php  echo create_url('mobile', array('name' => 'addon7','do' => 'awardhistory'))?>" style="color: #56c6d6;font-weight:bold">兑换历史</a></div>
	
</div>
		
		
		<div class="container exchange ">
			<div class="body">
				<ul class="list_exchange" >
				
										<?php  if(is_array($award_list)) { foreach($award_list as $item) { ?>
										<li data-card onclick="this.classList.toggle('on');" >
						<header>
							<ul class="tbox">
								<li>
									<h5><?php  echo $item['title'];?></h5>
									<p>有效期至<?php  echo date('Y-m-d H:i',$item['endtime']);?>  </p>
								</li>
							</ul>
						</header>
						<section>
							<div>
								<figure>
								    									<img src="<?php echo ATTACHMENT_WEBROOT;?><?php  echo $item['logo']?>" />
								</figure>
								<article class="p" >价值：<?php  echo $item['price'];?>元<br>剩余数量：<?php  echo $item['amount'];?> <br>
									<span style="font-size:14px"><?php  echo htmlspecialchars_decode($item['content'])?></span></article>
							</div>
						</section>
						<footer>
							<dl class="box">
								<dd><label><big><?php  echo $item['credit_cost'];?></big>积分</label></dd>
								<dd><a href="<?php  echo create_url('mobile', array('name' => 'addon7','do' => 'useaward','award_id' => $item['id']))?>">立即兑换</a></dd>
							</dl>
						</footer>
					</li>
						<?php  } } ?>
								  					
										
					
								  					
									
					
								  	
					
								  		
				 
				  			  				</ul>
			</div>
			
			
			
			
			
			
			
			
</div>


<?php  include themePage('footer');?>
<?php include themePage('weixinshare');?>
<?php include page('footer');?>	