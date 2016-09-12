$(function(){
	//foucus blur
	$("input.txt").focus(function(){
		if($(this).val() == this.defaultValue){
			$(this).val("");
		}
	});
	$("input.txt").blur(function(){
		if($(this).val()==""){
			$(this).val(this.defaultValue);
		}	
	});
	
});