<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js?v=20150120"></script>
<script type="text/javascript">
var wxData = {
            "imgUrl" : "<?php echo $shopwap_weixin_share['imgUrl'];?>",
            "link" : "<?php echo $shopwap_weixin_share['link'];?>",
            "desc" : "<?php echo $shopwap_weixin_share['description'];?>",
            "title" : "<?php echo $shopwap_weixin_share['title'];?>"
};
wx.config({
    debug: false,
    appId: "<?php echo $shopwap_weixin_share['appId'];?>",
    timestamp: <?php echo $shopwap_weixin_share['timestamp'];?>, 
    nonceStr: "<?php echo $shopwap_weixin_share['nonceStr'];?>", 
    signature: "<?php echo $shopwap_weixin_share['signature'];?>",
     jsApiList: [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareWeibo',
        'onMenuShareQZone'
      ]
});
wx.error(function(res){	
	if('<?php echo $shopwap_weixin_share['signature']?>'!='')
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
});
</script>

