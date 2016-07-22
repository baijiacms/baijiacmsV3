$(function(){
	
			var $label1_i = $('.label1 i');
			var $label2_i = $('.label2 i');
			var $label1 = $('.label1');
			var $label2 = $('.label2');
			var $category = $('.category');
			var $brand = $('.brand');
			$label1.click(function(){
				$(this).children().addClass("on");
				$category.removeClass('hide');
				$brand.addClass('hide');
				$label2_i.removeClass('on');
			});
			$label2.click(function(){
				$(this).children().addClass("on");
				$category.addClass('hide');
				$brand.removeClass('hide');
				$label1_i.removeClass('on');
			});

			$(window).scroll(function(){
				$('.aDiv').each(function(){
					$(this).removeClass('scroll');
					if( navigator.userAgent.indexOf("AppleWebKit") >-1 || navigator.userAgent.indexOf("Gecko") >-1 || navigator.userAgent.indexOf("Android") >-1 || navigator.userAgent.indexOf("Linux")>-1){
							var st =document.body.scrollTop;//滚去的高度 $(document).scrollTop();
					}else{
							var st =  document.documentElement.scrollTop;//滚去的高度 $(document).scrollTop();
					}
					var ot = $(this).offset().top-160;
					var atop = ot-st;
					if(atop<=0){
						$(this).addClass('scroll');
						$(this).siblings().removeClass('scroll');
					}
				})
				
			})
			$('#order li a').click(function(){
				$(this).addClass('on');
				$(this).parent().siblings().children().removeClass('on');
				var let=$(this).html();
			    $target=$(".target"+let);
				$(document).scrollTop(0);
				setTimeout(function(){
					$(document).scrollTop($target.offset().top-155);		
				},1);
			});
			
		});