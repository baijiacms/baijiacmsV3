<?php 
 $goodtitle=base64_decode(urldecode($_GP['gtitle']));
         $ordersn=base64_decode(urldecode($_GP['osn']));
   $order = mysqld_select("SELECT * FROM " . table('gold_order') . " WHERE ordersn =:ordersn", array(':ordersn' => $ordersn));
  	$system_store = mysqld_select('SELECT id,website FROM '.table('system_store')." where `id`=:id",array(":id"=>$order['beid']));

    if(empty($order['id'])||empty($system_store['id']))
    {
    message('订单错误');	
    }
			$cfg=globaSetting();
				if($_GP['isok'] == '1') {
					message('支付成功！',WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex')),'success');
				}
			$payment = mysqld_select("SELECT * FROM " . table('payment') . " WHERE  enabled=1 and code='weixin' and beid=:beid limit 1",array(":beid"=>$_CMS['beid']));
     $configs=unserialize($payment['configs']);
	
	if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
			$weixin_openid=get_weixin_openid();
				}
			$package = array();
		$package['appid'] = $cfg['weixin_appId'];
		$package['mch_id'] = $configs['weixin_pay_mchId'];
		$package['nonce_str'] = random(8);
		$package['body'] = $goodtitle;
		$package['out_trade_no'] = $order['ordersn'].'-'.$order['id'];
		$package['total_fee'] = $order['price']*100;
		$package['spbill_create_ip'] = $_SERVER['REMOTE_ADDR'];
			if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
		$package['notify_url'] =WEBSITE_ROOT.'notify/weixin_notify.php';
		$package['trade_type'] = 'JSAPI';
		$package['openid'] = $weixin_openid;
				}else
				{
						$package['notify_url'] =WEBSITE_ROOT.'notify/weixin_native_notify.php';
						$package['product_id'] = $order['ordersn'].'-'.$order['id'];
						$package['trade_type'] = 'NATIVE';
				}
		ksort($package, SORT_STRING);
		$string1 = '';
		foreach($package as $key => $v) {
			$string1 .= "{$key}={$v}&";
		}
		$string1 .= "key=".$configs['weixin_pay_paySignKey'];
		$package['sign'] = strtoupper(md5($string1));
		
        $xml = "<xml>";  
        foreach ($package as $key=>$val)
        {
     
        	 if (is_numeric($val))
        	 {
        	 	$xml.="<".$key.">".$val."</".$key.">"; 

        	 }
        	 else
        	 	$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";  
        }
        $xml.="</xml>"; 
	
	   
       	$ch = curl_init();
       	
        curl_setopt($ch,CURLOPT_URL, "https://api.mch.weixin.qq.com/pay/unifiedorder");
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		//post提交方式
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        $data = curl_exec($ch);
			curl_close($ch);
				if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
		
			if(!empty($data))
			{
				$xml = @simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
			
						$prepayid = $xml->prepay_id;
						$jsApiParameters=array();
					$jsApiParameters['appId'] = $cfg['weixin_appId'];
					$jsApiParameters['timeStamp'] = time();
					$jsApiParameters['nonceStr'] = random(8);
					$jsApiParameters['package'] = 'prepay_id='.$prepayid;
					$jsApiParameters['signType'] = 'MD5';
					ksort($jsApiParameters, SORT_STRING);
					foreach($jsApiParameters as $key => $v) {
						$string .= "{$key}={$v}&";
					}
					$string .= "key=".$configs['weixin_pay_paySignKey'];
					$jsApiParameters['paySign'] = strtoupper(md5($string));
					

			}
		}else
		{
 
				$xml = @simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
				$code_url = $xml->code_url;
				if(empty($code_url))
				{
					
				message("无法发起二维码支付，请更换另外一种付款方式，或者联系管理员");	
				}
			?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="telephone=no, address=no" name="format-detection">
<script type="text/javascript" src="<?php echo RESOURCE_ROOT;?>addons/common/js/jquery-1.10.2.min.js"></script>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" /> <!-- apple devices fullscreen -->
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
<title>微信支付</title>
<link href="<?php echo RESOURCE_ROOT;?>addons/modules/payment/weixin/main.css" rel="stylesheet" />
</head>
<body>
	
	
    <div class="p-header">
            <div class="w">
                <div id="logo">
                	<?php if(!empty($cfg['shop_logo'])){ ?>
                    <img width="170" height="28" src="<?php echo ATTACHMENT_WEBROOT;?><?php echo $cfg['shop_logo'] ?>" >
                    <?php } ?>
                </div>
            </div>
    </div>
 <!-- p-header end -->

    
    <div class="main">
        <div class="w">
            <!-- order 订单信息 -->
                         <!-- order 订单信息 -->
<div class="order">
        <div class="o-left">
            <h3 class="o-title">
                			请您及时付款，以便订单尽快处理！    		           	订单号：<?php echo $order['ordersn'];?>

			
            </h3>
            <p class="o-tips">
				
                							        			            	请您在提交订单后尽快完成支付。
																</p>
        </div>
        <div class="o-right">
            <div class="o-price">
                <em>应付金额</em><strong><?php echo $order['price'];?></strong><em>元</em>
            </div>

                           
            
        </div>
        <div class="clr"></div>
        
                                                
            		      
  
</div>
<!-- order 订单信息 end -->            <!-- order 订单信息 end -->

            <!-- payment 支付方式选择 -->
            <div class="payment">
                <!-- 微信支付 -->
                <div class="pay-weixin">
                    <div class="p-w-hd">微信支付</div>
                    <div class="p-w-bd">
                        <div class="p-w-box">
                            <div class="pw-box-hd">
                                <img alt="模式二扫码支付" src="<?php echo WEBSITE_ROOT;?>includes/lib/phpqrcode/qrcode.php?data=<?php echo urlencode($code_url);?>" style="width:298px;height:298px;"/>
                            </div>
                            <div class="pw-box-ft">
                                <p>请使用微信扫一扫</p>
                                <p>扫描二维码支付</p>
                            </div>
                        </div>
                        <div class="p-w-sidebar"></div>
                    </div>
                </div>
                <!-- 微信支付 end -->
                <!-- payment-change 变更支付方式 -->
                <div class="payment-change">
                    <a class="pc-wrap" id="reChooseUrl" href="javascript:history.back();">
                    	<i class="pc-w-arrow-left">&lt;</i>
                        <strong>选择其他支付方式</strong>
                    </a>
                       <a class="pc-wrap" style="float:right" href="<?php echo WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex'));?>">
                        <strong>如完成支付没有跳转请点击</strong>
                        <i class="pc-w-arrow-right">&gt;</i>
                    </a>
                </div>
                <!-- payment-change 变更支付方式 end -->
            </div>
            <!-- payment 支付方式选择 end -->
        </div>
    </div>





    <div class="p-footer">
      <div class="pf-wrap w">
          <div class="pf-line">
              <span class="pf-l-copyright">Copyright © <?php echo $cfg['shop_title'] ?></span>
            
          </div>
      </div>
</div>

  <script type="text/javascript" language="javascript">
      function checkorder()
      {
      	$.getJSON("<?php echo 	create_url('mobile',array('name' => 'shopwap','do' => 'getgoldorder','id'=>$order['id']));?>", { }, function(json){

  if(json.status>0)
  {
  location.href="<?php echo WEBSITE_ROOT.create_url('mobile',array('name' => 'shopwap','do' => 'fansindex'));?>";	
  }
});
      }
         setInterval("checkorder()", 2000);
    
        </script>
</body>
</html>
			
				<?php
		}
		
			if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {
?>


	<script>

document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',{
		'appId' : '<?php echo $jsApiParameters['appId'];?>',
		'timeStamp': '<?php echo $jsApiParameters['timeStamp'];?>',
		'nonceStr' : '<?php echo $jsApiParameters['nonceStr'];?>',
		'package' : '<?php echo $jsApiParameters['package'];?>',
		'signType' : '<?php echo $jsApiParameters['signType'];?>',
		'paySign' : '<?php echo $jsApiParameters['paySign'];?>'
	}, function(res) {
					if(res.err_msg == 'get_brand_wcpay_request:ok') {
						location.search += '&isok=1';
					} else {
							alert('微信支付未完成');
					
						history.go(-1);
					}
				}
			);
		});

	</script>
<?php
}
?>