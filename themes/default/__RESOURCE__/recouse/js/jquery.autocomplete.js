//mod by 2355244921 20130708 前端性能优化
var autoComplete=function(params){
	var $target=$("#"+params.target);
	var $input=$("#"+params.input);
	var $container=$("#"+params.container);
	var currentAjaxs=[];
	$input.attr('autocomplete','off');
	var doAutocomplete=function(){
		var oldv=$input.val();
		var autoAC=function(){
			if(oldv!=$input.val()){
			  var mAjax=$.ajax({type:'post',url:params.url,data:{'key':$input.val()},dataType:"text", 
					success: function(data){
						var json=eval("(" + data + ")");
					    var str_html=[];
						for(i=0;i<json.length;i++){
							str_html.push(params.formatItem(json[i],i));
						}
						$container.html(str_html.join(''));
						var  mLi=$container.find('li');
						mLi.css("cursor","pointer");
						mLi.click(function(mEvent){
							    var i=mEvent.currentTarget.getAttribute("i");
								params.result(json[i]);
							});
						params.callback();
					} 
				});
				currentAjaxs.push(mAjax);
				
				if(currentAjaxs.length>2){
                     var tempA=currentAjaxs.splice(1,currentAjaxs.length-2);
				     for(var j=1;j<tempA.length-2;j++){
                              tempA[j].abort(); 						 
						 }
					
					 
					}
			
			}
			oldv=$input.val();
			
			setTimeout(function(){
				autoAC();
			},params.delay);
		}
		autoAC();
	};
	doAutocomplete();
}
