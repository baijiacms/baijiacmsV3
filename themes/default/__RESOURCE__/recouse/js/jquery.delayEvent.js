/*
{
	'target'://元素
	'event'://事件
	'timespan'://时间间隔
	'callback'://执行事件
}
*/
var delayEvent=function(param){
	var tmr;var oval='';
	$('#'+param.target).bind(param.event,function(e){
		window.clearInterval(tmr);
		oval=$('#'+param.target).val();
		tmr=window.setInterval(function(){
			var nval=$('#'+param.target).val();
			if(oval==nval){
				window.clearInterval(tmr);
				eval(param.callback());
			}
			oval=nval;
		},param.timespan);
	})
}
