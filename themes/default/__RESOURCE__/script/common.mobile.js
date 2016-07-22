var _env = (function() {
	var f = navigator.userAgent,
	b = null,
	c = function(h, i) {
		var g = h.split(i);
		g = g.shift() + "." + g.join("");
		return g * 1
	},
	d = {
		ua: f,
		version: null,
		ios: false,
		android: false,
		windows: false,
		blackberry: false,
		meizu: false,
		weixin: false,
		wVersion: null,
		touchSupport: ("createTouch" in document),
		hashSupport: !!("onhashchange" in window)
	};
	b = f.match(/MicroMessenger\/([\.0-9]+)/);
	if (b != null) {
		d.weixin = true;
		d.wVersion = c(b[1], ".")
	}
	b = f.match(/Android\s([\.0-9]+)/);
	if (b != null) {
		d.android = true;
		d.version = c(b[1], ".");
		d.meizu = /M030|M031|M032|MEIZU/.test(f);
		return d
	}
	b = f.match(/i(Pod|Pad|Phone)\;.*\sOS\s([\_0-9]+)/);
	if (b != null) {
		d.ios = true;
		d.version = c(b[2], "_");
		return d
	}
	b = f.match(/Windows\sPhone\sOS\s([\.0-9]+)/);
	if (b != null) {
		d.windows = true;
		d.version = c(b[1], ".");
		return d
	}
	var e = {
		a: f.match(/\(BB1\d+\;\s.*\sVersion\/([\.0-9]+)\s/),
		b: f.match(/\(BlackBerry\;\s.*\sVersion\/([\.0-9]+)\s/),
		c: f.match(/^BlackBerry\d+\/([\.0-9]+)\s/),
		d: f.match(/\(PlayBook\;\s.*\sVersion\/([\.0-9]+)\s/)
	};
	for (var a in e) {
		if (e[a] != null) {
			b = e[a];
			d.blackberry = true;
			d.version = c(b[1], ".");
			return d
		}
	}
	return d
} ()),
_ua = _env.ua,
_touchSupport = _env.touchSupport,
_hashSupport = _env.hashSupport,
_isIOS = _env.ios,
_isOldIOS = _env.ios && (_env.version < 4.5),
_isAndroid = _env.android,
_isMeizu = _env.meizu,
_isOldAndroid22 = _env.android && (_env.version < 2.3),
_isOldAndroid23 = _env.android && (_env.version < 2.4),
_clkEvtType = _touchSupport ? "touchstart": "click",
_movestartEvt = _touchSupport ? "touchstart": "mousedown",
_moveEvt = _touchSupport ? "touchmove": "mousemove",
_moveendEvt = _touchSupport ? "touchend": "mouseup";

//跳转
function viewSource(url){
	location.href = url;
}
//幻灯片
function slidePic(a){
	var img = new Image();
	img.src = $(a).find("img").attr("src");
	var percent = ($(document).width()-img.width)/img.width;
	$(a).find("img").each(function() {
		$(this).css({"width": $(document).width(), "height":img.height+img.height*percent});
	});
	var sWidth = $(document).width(); //获取焦点图的宽度（显示面积）
	var sHeight = $(a).find("img").eq(0).height(); //获取焦点图的宽度（显示面积）
	var len = $(a).find("ul li").length; //获取焦点图个数
	var index = 0;
	var picTimer;
	$(a).css({"width": sWidth, "height": sHeight});
	//以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
	var btn = "<div class='btnBg'></div><div class='btn'>";
	for(var i=0; i < len; i++) {
		btn += "<span></span>";
	}
	btn += "</div><!--div class='preNext pre'></div><div class='preNext next'></div-->";
	$(a).append(btn);
	$(a).find(".btnBg").css("opacity",0.5);

	//为小按钮添加鼠标滑入事件，以显示相应的内容
	$(a).find(".btn span").css("opacity",0.4).mouseover(function() {
		index = $(a).find(".btn span").index(this);
		showPics(index);
	}).eq(0).trigger("mouseover");

	//上一页、下一页按钮透明度处理
	$(a).find(".preNext").css("opacity",0.2).hover(function() {
		$(this).stop(true,false).animate({"opacity":"0.5"},300);
	},function() {
		$(this).stop(true,false).animate({"opacity":"0.2"},300);
	});

	//上一页按钮
	$(a).find(".pre").click(function() {
		index -= 1;
		if(index == -1) {index = len - 1;}
		showPics(index);
	});

	//下一页按钮
	$(a).find(".next").click(function() {
		index += 1;
		if(index == len) {index = 0;}
		showPics(index);
	});

	//触摸
	$(a).bind('swiperight', function() {
		index -= 1;
		if(index == -1) {index = len - 1;}
		showPics(index);
	}).bind('swipeleft', function() {
		index += 1;
		if(index == len) {index = 0;}
		showPics(index);
	});

	//本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
	$(a).find("ul").css("width",sWidth * (len));

	//鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
	$(a).hover(function() {
		clearInterval(picTimer);
	},function() {
		picTimer = setInterval(function() {
			showPics(index);
			index++;
			if(index == len) {index = 0;}
		},4000); //此4000代表自动播放的间隔，单位：毫秒
	}).trigger("mouseleave");

	//显示图片函数，根据接收的index值显示相应的内容
	function showPics(index) { //普通切换
		var nowLeft = -index*sWidth; //根据index值计算ul元素的left值
		$(a).find("ul").stop(true,false).animate({"left":nowLeft},300); //通过animate()调整ul元素滚动到计算出的position
		//$("#focus .btn span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
		$(a).find(".btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"1"},300); //为当前的按钮切换到选中的效果
	}
}

$(function() {
	$(window).load(function(){slidePic("#focus")});
	$("#nav a:eq(4)").before("<a href='#' class='more'>更多&nbsp;&nbsp;<i class='icon_more icon_more_down'></i></a>");
	$("#nav .more").click(function() {
		if($("#nav").css("height") != "29px") {
			$(this).html("更多&nbsp;&nbsp;<i class='icon_more icon_more_down'></i>");
			$("#nav").css("height", "29px");
		} else {
			$(this).html("收起&nbsp;&nbsp;<i class='icon_more icon_more_up'></i>");
			$("#nav").css("height", "auto");
		}
	});
});