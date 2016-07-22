/**
 * 获取焦点时，进行手机格式转换：规定格式转成正常格式
 */
 $(function() {
 $('#submitRegister').on('tap', function() {
		submitRegister();
	});});
function focusPhone(){	
		var phoneNumber = $('input[name="mobile"]').val();
		var phone = phoneNumber;
		$('input[name="phone"]').val(phone);		
}
/**
 * 手机格式转换
 */
function blurPhone(){

	
}


/**
 * 提交注册
 * 
 * @param obj
 * @returns {Boolean}
 */
function submitRegister(obj) {
	var phoneNumber = $('input[name="mobile"]').val();
	var phone = phoneNumber;
	
	if (!/^1\d{10}$/.test(phone)) {
		alert('请填写正确的手机号码');		
		$("#myphone").css("border","1px solid red");
		//手机号码错误时下一次点击输入框时清除数据
			$('#phone').click(function() { 
				$('input[name="mobile"]').val("")
				$("#myphone").css("border","1px solid #d7d7d7 ");	
			})
		return false;
	}
	var password = $('input[name=password]').val().trim();
	if (!/^.{6,16}/.test(password)) {
		alert('请正确输入登录密码');
		return false;
	}
		$('#submit').click();
	
}