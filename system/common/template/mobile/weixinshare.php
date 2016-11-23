<?php  if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false&&is_use_weixin()) {
		$settings=globaSetting();
	
	      		
        					$dzddes=	$settings['shop_description'];
        				
        				
        					$dzdtitle=	$settings['shop_title'];
        				$dzdpic=	ATTACHMENT_WEBROOT.$settings['weixin_logo'];
        					
       if(empty($weixin_share_arraydate))
       {
				$weixin_share_arraydate=array('name'=>'shopwap','do'=>'shopindex');
			}else
			{
					if(!empty($detail_dzdtitle))
						{
								$dzdtitle=$detail_dzdtitle;
						}
							if(!empty($detail_dzddes))
						{
							$dzddes=$detail_dzddes;
						}
							if(!empty($detail_dzdpic))
						{
								$dzdpic=$detail_dzdpic;
						}	
				
			}
		$wx_weixin_share=	weixin_share_2($weixin_share_arraydate,$dzdtitle,$dzdpic,$dzddes,$settings);
	
	 ?>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.1.0.js"></script>
<script type="text/javascript">
var wxData = {
            "imgUrl" : "<?php echo $wx_weixin_share['imgUrl'];?>",
            "link" : "<?php echo $wx_weixin_share['link'];?>",
            "desc" : "<?php echo $wx_weixin_share['description'];?>",
            "title" : "<?php echo $wx_weixin_share['title'];?>"
};
wx.config({
    debug: false,
    appId: "<?php echo $wx_weixin_share['appId'];?>",
    timestamp: <?php echo $wx_weixin_share['timestamp'];?>, 
    nonceStr: "<?php echo $wx_weixin_share['nonceStr'];?>", 
    signature: "<?php echo $wx_weixin_share['signature'];?>",
     jsApiList: [
        'checkJsApi',
     		'openAddress',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone'
      ]
});
wx.error(function(res){	
	if('<?php echo $wx_weixin_share['signature'];?>'!='')
	{
		if(res.errMsg='config:invalid signature')
		{
	//alert(res.errMsg);
			//alert("转发接口失效，请联系管理员");
		}
	}
});	
var shareData = {
      title: wxData.title,
      link: wxData.link,
    	desc: wxData.desc,
      imgUrl:  wxData.imgUrl
    };

wx.ready(function () {
    wx.onMenuShareAppMessage(shareData);
    wx.onMenuShareTimeline(shareData);
    wx.onMenuShareAppMessage(shareData);
		wx.onMenuShareQQ(shareData);
		wx.onMenuShareWeibo(shareData);
		wx.onMenuShareQZone(shareData);
		<?php if($useWeixinAddr){ ?>
getaddress();
<?php } ?>
});
</script><?php } ?>
<?php $footer_config=globaSetting();?>
<?php  echo $footer_config['shop_tongjicode'];?>
<?php  echo $footer_config['shop_kfcode'];?>