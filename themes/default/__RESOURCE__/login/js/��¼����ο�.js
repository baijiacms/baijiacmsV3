$(function() {
	$('input,.check-message').click(function() {
		$('.check-message').fadeOut(500);
	});
	$('#sendAuthCodeBtn').click(function() {
		if (!$(this).hasClass('disable')) {
			sendAuthCode($(this));
		}
	});
	if (isWeixin()) {
		$('.weixin').show();
	}
	refer = $('#loginRefer').val();
	if (!refer) {
		refer = ""
	}
	var bool = refer.indexOf("login/register");
	if(bool>0){
		refer = _webApp;
	}
	var bool2 = refer.indexOf("login/reset");
	if(bool2>0){
		refer = _webApp;
	}
	$("#codeImge").click(
	 function() {
	 $("#codeImge").attr('src',_webApp + '/captcha?' + new Date().getTime());
	});
});

var refer = "";

/**
 * 手机登陆
 */
function phonelogin() {
	$('.login-box-item').hide();
	$('#boxPhone').show();
}
/**
 * 密码登陆
 */
function passwordlogin() {
	$('.login-box-item').hide();
	$('#boxPassword').show();
}

/**
 * qq登陆
 */
function qqlogin() {
	var redirectUrl = encodeURIComponent(window.location.protocol + '//' + window.location.host + '/login/qqlogin');
	var url = 'https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=101055422&redirect_uri=' + redirectUrl + '&scope=get_user_info&display=mobile&state='
			+ encodeURIComponent(refer);
	window.location.href = url;
}
/**
 * 新浪微博登陆
 */
function weibologin() {
	var redirectUrl = encodeURIComponent(window.location.protocol + '//' + window.location.host + '/login/weibologin');
	var url = 'https://api.weibo.com/oauth2/authorize?client_id=3234385244&redirect_uri=' + redirectUrl + '&response_type=code&scope=email&state=' + encodeURIComponent(refer);
	window.location.href = url;
}
/**
 * 微信登陆
 */
function weixinlogin() {
	// var redirectUrl = encodeURIComponent(window.location.protocol + '//'+
	// window.location.host + '/login/weixinlogin');
	// var url =
	// 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa980a33d032de014&redirect_uri='
	// + redirectUrl
	// + '&response_type=code&scope=snsapi_login&state='
	// + encodeURIComponent(refer) + '#wechat_redirect';
	var redirectUrl = encodeURIComponent(window.location.protocol + '//m.homeking365.com/login/weixinAutologin');
	var url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb6e48ba2bbc98abf&redirect_uri=' + redirectUrl + '&response_type=code&scope=snsapi_base&state='
			+ encodeURIComponent(refer) + '#wechat_redirect';
	window.location.href = url;
}
/**
 * 支付宝登陆
 */
function alipaylogin() {
	var redirectUrl = encodeURIComponent(window.location.protocol + '//' + window.location.host + '/login/alilogin');
	var url = '"https://openauth.alipay.com/oauth2/publicAppAuthorize.htm?app_id=2015010400023070&redirect_uri=' + redirectUrl + '&auth_skip=false&scope=auth_userinfo&state='
			+ encodeURIComponent(refer);
	window.location.href = url;
}

/**
 * 密码登陆提交
 */
function passwordLoginSubmit() {
	var account = $.trim($('#passwordLoginForm input[name="account"]').val());
	if (!account) {
		errorPrompt('请输入 手机/邮箱/用户名');
		return false;
	}
	var password = $.trim($('#passwordLoginForm input[name="password"]').val());
	if (!password) {
		errorPrompt('密码不能为空');
		return false;
	}
	$.post(_webApp + "/login/passwordLogin", {
		account : account,
		password : password
	}, function(data) {
		if (data.result == "success") {
			window.location.href = refer;
		} else {
			errorPrompt(data.message);
		}
	}, 'json');
}

/**
 * 手机动态登陆提交
 */
function phoneLoginSubmit() {
	var phoneNumber = $('input[name="phone"]').val();
	var phone = phoneNumber.substr(0,3)+phoneNumber.substr(4,4)+phoneNumber.substr(9);
	if (!/^1\d{10}$/.test(phone)) {
		errorPrompt('请填写正确的手机号码');
		//手机号码错误时下一次点击输入框时清除数据
			$('#phone').click(function() { 
				$('input[name="phone"]').val("")	
				$("#myphone").css("border","1px solid #d7d7d7 ");
			})
			$("#myphone").css("border","1px solid red");
		return false;
	}
	var captcha = $('#captcha').val().trim();
	if (!captcha) {
		errorPrompt('请输入验证码');
		//验证码错误时下一次点击输入框时清除数据
		$('#captcha').click(function() { 
			$('input[name="captcha"]').val("")	
			$("#yzcode").css("border","1px solid #d7d7d7 ");
		})
		$("#yzcode").css("border","1px solid red");
		return false;
	}
	if (!/^\d{4}$/.test(captcha)) {
		errorPrompt('请输入4位数字验证码');
		//验证码错误时下一次点击输入框时清除数据
		$('#captcha').click(function() { 
			$('input[name="captcha"]').val("")	
			$("#yzcode").css("border","1px solid #d7d7d7 ");
		})
		$("#yzcode").css("border","1px solid red");
		return false;
	}
	var code = $.trim($('#phoneLoginForm input[name="code"]').val());
	if (!/^\d{4}$/.test(code)) {
		errorPrompt('请输入4位数字短信验证码');
		return false;
	}
	var url = _webApp + '/login/phoneDynamicLogin'
	$.post(url, {
		phone : phone,
		code : code,
		captcha : captcha
	}, function(data) {
		if (data.result == 'success') {
			window.location.href = refer;
		} else {
			errorPrompt(data.message);
		}
	}, 'json');
}
/**
 * 监听校验手机号码
 */
function checkValidatePhone(){
	var captcha = $("#captcha").val().trim();
	$("#myphone").css("border","1px 1px 0px solid #d7d7d7 ");
	var phone = $('input[name="phone"]').val();
	if(phone.length!=11){	
		$('#phone').click(function() { 
			$('input[name="phone"]').val(phone)			
		})
		$("#lagbelRandomCode").hide();
	}
	if(phone.length==11){		
		$('#phone').click(function() { 
			$('input[name="phone"]').val(phone)			
		})
	}
	if(phone.length==11&&captcha.length==4){		
		$("#lagbelRandomCode").show();
	   
	}
}
/**
 * 监听校验验证码
 */
function checkValidateCaptcha(){
	    //获取焦点隐藏清空按钮
		var captcha = $("#captcha").val().trim();
		//手机格式转换：规定格式转成正常格式
		var phoneNumber = $('input[name="phone"]').val();
		var phone = phoneNumber.substr(0,3)+phoneNumber.substr(4,4)+phoneNumber.substr(9);
		if(captcha.length>=0&&captcha.length<4){
			$('#captcha').click(function() { 
				$('input[name="captcha"]').val(captcha)			
			})
			$("#yzcode").css("border","1px solid #d7d7d7 ");
		}
		if(captcha.length>=4){
		
			$.post(_webApp + "/login/validateCaptcha", {
				code : captcha
			}, function(result) {
				if (result.result == "success") {
					$('#captcha').click(function() { 
						$('input[name="captcha"]').val(captcha)			
					})
					$("#yzcode").css("border","1px solid #d7d7d7 ");
					if (phone.length == 11) {
					$("#lagbelRandomCode").show();
					}
				}else{
					$("#lagbelRandomCode").hide();
					//验证码错误时下一次点击输入框时清除数据
					$('#captcha').click(function() { 
						$('input[name="captcha"]').val("")	
						$("#yzcode").css("border","1px solid #d7d7d7 ");
					})
					$("#yzcode").css("border","1px solid red");
				}
			}, "json");
		}else {
			$("#lagbelRandomCode").hide();
		}
	}
/**
 * 获取焦点时，进行手机格式转换：规定格式转成正常格式
 */
function focusPhone(){	
		var phoneNumber = $('input[name="phone"]').val();
		var phone = phoneNumber.substr(0,3)+phoneNumber.substr(4,4)+phoneNumber.substr(9);
		$('input[name="phone"]').val(phone);		
}
/**
 * 手机格式转换
 */
function blurPhone(){
	var phoneNumber = $('input[name="phone"]').val();
	if (phoneNumber.length==0) {
		var str2 = phoneNumber;
		$('input[name="phone"]').val(str2)
	}
	if (phoneNumber.length>0&&phoneNumber.length<=3) {
		var str2 = phoneNumber;
		$('input[name="phone"]').val(str2)
		//手机号码错误时下一次点击输入框时清除数据
			$('#phone').click(function() { 
				$('input[name="phone"]').val("")	
				$("#myphone").css("border","1px solid #d7d7d7 ");
			})
			$("#myphone").css("border","1px solid red");
	}
	if (phoneNumber.length>3&&phoneNumber.length<=7) {
		var str2 = phoneNumber.substr(0,3)+"-"+phoneNumber.substr(3);
		$('input[name="phone"]').val(str2)
			$('#phone').click(function() { 
				$('input[name="phone"]').val("")
				$("#myphone").css("border","1px solid #d7d7d7 ");
			})
			$("#myphone").css("border","1px solid red");
	}
	if (phoneNumber.length>=8) {
		var str2 = phoneNumber.substr(0,3)+"-"+phoneNumber.substr(3,4)+"-"+phoneNumber.substr(7);
		$('input[name="phone"]').val(str2)
		if (str2.length !=13) {	
			$('#phone').click(function() { 
				$('input[name="phone"]').val("")
				$("#myphone").css("border","1px solid #d7d7d7 ");
			})
			$("#myphone").css("border","1px solid red");
		}
		
	}
	
}

/**
 * 语音验证码
 */
function voiceVerificationCode(){
	var phoneNumber = $('input[name="phone"]').val();
	var phone = phoneNumber.substr(0,3)+phoneNumber.substr(4,4)+phoneNumber.substr(9);
	errorPrompt("语言电话正在拨打，请注意接听！");
	var captcha = $('#captcha').val().trim();
	$.post(_webApp + "/login/sendVoiceCode", {
		phone : phone,
		captcha : captcha
	}, 'json');
	$("#voiceVerificationCode").hide();
	$("#noVoiceVerificationCode").show();

}

/**
 * 发送登陆动态验证码
 */
function sendAuthCode(obj) {
	//手机格式转换：规定格式转成正常格式
	var phoneNumber = $('input[name="phone"]').val();
	var phone = phoneNumber.substr(0,3)+phoneNumber.substr(4,4)+phoneNumber.substr(9);
	if (!/^1\d{10}$/.test(phone)) {
		errorPrompt('请填写正确的手机号码');
		//手机号码错误时下一次点击输入框时清除数据
			$('#phone').click(function() { 
				$('input[name="phone"]').val("")	
				$("#myphone").css("border","1px solid #d7d7d7 ");
			})
			$("#myphone").css("border","1px solid red");
		return false;
	}
	var captcha = $('#captcha').val().trim();
	obj.addClass('disable').text('发送中···');
	$.post(_webApp + "/login/sendAuthCode", {
		phone : phone,
		captcha : captcha
	}, function(data) {
		if (data.result == "success") {
			countdown();
			//成功后给提醒信息
			errorPrompt("短信验证码已发送成功，请注意查收！");
		} else {
			errorPrompt(data.message);
			$('#sendAuthCodeBtn').html('发送验证码').removeClass('disable');
		}
	}, 'json');
}
/**
 * 倒计时
 */
var timer = 0;
function countdown() {
	clearInterval(timer);
	var count = 60;
	$('#sendAuthCodeBtn').html('<span class="corange">' + count + 's</span>');
	timer = setInterval(function() {
		count--;
		$('#sendAuthCodeBtn').html('<span class="corange">' + count + 's</span>');
		if (count == 0) {
			clearInterval(timer);
			$('#sendAuthCodeBtn').html('发送验证码').removeClass('disable');
			$("#noVoiceVerificationCode").hide();
			$("#voiceVerificationCode").show();
		}
		if(count == 45){
			$("#noVoiceVerificationCode").show();
			$("#voiceVerificationCode").hide();
		}
	}, 1000);
}
/**
 * 错误提示
 * 
 * @param text
 */
function errorPrompt(text) {
	$('#errorMsg').text(text).parent().show();
	//关闭提示框
	window.setTimeout("closeWin()",1500);
}
function closeWin(){
	$('#closeWin').hide();
}
/**
 * 返回动作
 */
function back() {
	var refer = $('#loginRefer').val();
	if (refer) {
		history.go(-1);
	} else {
		window.location.href = _webApp;
	}
}