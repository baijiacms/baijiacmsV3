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
<title>兑奖信息</title>

</head>
<body>
	<section class="reserve">
    	<!--content-->
        <section class="reserve_content">
        	<!--title-->
            <p class="reserve_title"><span style="color:#000">请认真填写以下信息</span></p>
            <!--tielt end-->
            <!--details-->
            <section class="reserve_details">
			<?php   echo "<p>" . $award_info['title'] . "</p>"; ?>
            </section>
            <!--details end-->
			<!--data-->
			<section class="reserve_data">

			<form action="" method="post" data-ajax="false" onsubmit="return check(this)">
				<section class="data_box">
				<label class="data_box_l">真实姓名</label>
				<span class="data_box_r"><input type="text" name="realname" value="<?php  echo $realname;?>" placeholder="请输入您的真实姓名" class="txt" /></span>
				</section>
                <section class="data_box">
                    	<label class="data_box_l">联系电话</label>
						<span class="data_box_r"><input name="mobile" type="text" value="<?php  echo $mobile;?>" placeholder="请输入您的手机" class="txt" /></span>
				</section>
                 <section class="data_box">
                    	<label class="data_box_l">邮寄地址</label>
						<span class="data_box_r"><input name="address" type="text" value="<?php  echo $address;?>" placeholder="请输入您的邮寄地址" class="txt" /></span>
				</section>
              
                    <!--btn-->
                    <section class="reserve_btn_box">
                        <input type="submit" value="提交登记" name="submit" class="reserve_btn" />
                    </section>
                    <!--btn end-->
                </form>
            </section>
            <!--data end-->
        </section>
        <!--content end-->
		</section>
		
		
		
		<script type="text/javascript">
			function check(form) {
				if (!form['realname'].value) {
					alert('请输入您的真实姓名！');
					return false;
				}
				if (!form['mobile'].value) {
					alert('请输入您的手机号码！');
					return false;
				}
				if (!/^1[0-9]{10}/.test(form['mobile'].value)) {
					alert('请输入正确的手机号码！');
					return false;
				}
				if (!form['address'].value) {
					alert('请输入您的邮寄地址！');
					return false;
				}
				return true;
			}
		</script>
<?php  include themePage('footer');?>
<?php include themePage('weixinshare');?>
<?php include page('footer');?>	