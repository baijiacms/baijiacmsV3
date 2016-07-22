//self jq
$(function(){
	var clicknumber_store=0;

	//menu downtoggle 4.0
	$("#disstroe").click(
	function(){    
	$("#disstroe-sub").slideToggle("fast");
	if(clicknumber_store==1){
		$("#disstroe .arrow").removeClass("arrow-rotate");
		clicknumber_store=0;
		}
	else{
		$("#disstroe .arrow").addClass("arrow-rotate");		
		clicknumber_store=1;
		}
		}
	)
	//menu accordian
	$("#menu-accordian01,#menu-accordian02").click(function(){
		$(this).parents(".member-nav").siblings(".member-nav").find("a").siblings("div").slideUp();
		$(this).parents(".member-nav").siblings(".member-nav").find("a").children(".arrow").removeClass("arrow-rotate");
		if($(this).siblings("div").css('display')=='block'){
		     $(this).siblings("div").slideUp();
		     $(this).children(".arrow").removeClass("arrow-rotate");
			}
		else{
			$(this).siblings("div").slideDown();
			$(this).children(".arrow").addClass("arrow-rotate");
			}
		
		})
	
	$(".mask").click(function(){footHide();})	
	//alert box 2btn
	//alert frame
	function box_frame(txt){
		$('body').prepend("<div class='alert-box-2btn' id='alert-box-2btn'><div class='content-box'><p>"+txt+"</p><div class='btn-div clear'><a class='btn-verify' href=''>确定</a><a class='btn-cancle' id='alert-2btm-close' href=''>取消</a></div></div></div>")		
		};
		
	//alert content text
    $("#order-receive").on("click",function(event){
		event.preventDefault();
		box_frame('亲，点击确认收货后不可再退货！如果您需要申请退款，切勿点击“确认收货”');
		$(".btn-div").delegate("#alert-2btm-close","click",function(event){
			event.preventDefault();
		    $("#alert-box-2btn").detach();
		})
		});
	//add account
	$("#acount-select").children("div").on("click",function(){
		if(($(this).children("input").prop("checked")==true)&&($(this).children("input").val()=="alipay")){
			$("#acount-content").find("input:first").attr("placeholder","真实姓名");
			$("#acount-content").find("input:last").attr("placeholder","账号");
			}
		if(($(this).children("input").prop("checked")==true)&&($(this).children("input").val()=="blank")){
			$("#acount-content").find("input:first").attr("placeholder","持卡人");
			$("#acount-content").find("input:last").attr("placeholder","卡号");
			}
		});    
	})
//share toggle
function share_foot(){
	$(".mask").fadeToggle();
	$(".shareList").fadeToggle();
	}
function footHide(){
	$(".mask").fadeOut();
	$(".shareList").fadeOut();
	}
	
//distribute store list
  function disstore_show_hide(obj){
    if($(obj).next('.disstore-count').css('display')=='block'){
	  $(".disstore-count").slideUp();
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	   }
   else{
	   $(".disstore-count").slideUp();
	   $(".a-personal").find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	  $(obj).find(".arrow").removeClass("arrow-rotate");	
	  $(obj).next(".disstore-count").slideDown("fast");
 	  $(obj).find(".arrow").addClass("arrow-rotate");
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(90deg)",
		"-moz-transform":"rotate(90deg)",
			"-o-transform":"rotate(90deg)",
				"transform":"rotate(90deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });
	   }
	  }
(function(){	
//member count
function member_infor(obj){	
		$(".member-browse-detail").slideUp();
		if($(obj).parents().next(".member-browse-detail").css("display")=="block")
		{		
		$($(obj).parents().next(".member-browse-detail")).slideUp();
		}
	else{
		$($(obj).parents().next(".member-browse-detail")).slideDown();
		}				
	}
	window.member_infor=member_infor;
function member_pro(obj){
		$(".member-browser-pro-list").slideUp();	
		if($(obj).next(".member-browser-pro-list").css("display")=="block")
		{
		$($(obj).next(".member-browser-pro-list")).slideUp();
		$(obj).find(".arrow").css({
		   "-webkit-transform":"rotate(0deg)",
		  "-moz-transform":"rotate(0deg)",
			  "-o-transform":"rotate(0deg)",
				  "transform":"rotate(0deg)",
	  "-webkit-transition":"all .3s",
		  "-moz-transition":"all .3s",
			  "-o-transition":"all .3s",
				  "transition":"all .3s"
			});	
		}
	else{
		$($(obj).next(".member-browser-pro-list")).slideDown();
		$(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(90deg)",
		"-moz-transform":"rotate(90deg)",
			"-o-transform":"rotate(90deg)",
				"transform":"rotate(90deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });
		}				
	}
	window.member_pro=member_pro;
//member list
function member_info(obj){
    if($(obj).next('.member-list-count').css('display')=='block'){
		$(".member-list-count").slideUp();
		$(obj).find(".arrow").css({
		   "-webkit-transform":"rotate(0deg)",
		  "-moz-transform":"rotate(0deg)",
			  "-o-transform":"rotate(0deg)",
				  "transform":"rotate(0deg)",
	  "-webkit-transition":"all .3s",
		  "-moz-transition":"all .3s",
			  "-o-transition":"all .3s",
				  "transition":"all .3s"
			});	
	   }
   else{
	   $(".member-list-count").slideUp();
	   $(".a-personal").find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	  $(obj).find(".arrow").removeClass("arrow-rotate");	
	  $(obj).next(".member-list-count").slideDown("fast");
 	  $(obj).find(".arrow").addClass("arrow-rotate");
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(90deg)",
		"-moz-transform":"rotate(90deg)",
			"-o-transform":"rotate(90deg)",
				"transform":"rotate(90deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });
	   }
	  }
	  window.member_info=member_info;
//tip means close
function tip_means_close(obj){
	$(obj).parents(".tip-means").slideUp();	
	}
	window.tip_means_close=tip_means_close;
})();		

//brokerage list 
  function brokerage_show_hide(obj){
    if($(obj).next('.money-source').css('display')=='block'){
	  $(".money-source").slideUp();
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	   }
   else{
	   $(".money-source").slideUp();
	   $(".a-personal").find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	  $(obj).find(".arrow").removeClass("arrow-rotate");	
	  $(obj).next(".money-source").slideDown("fast");
 	  $(obj).find(".arrow").addClass("arrow-rotate");
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(90deg)",
		"-moz-transform":"rotate(90deg)",
			"-o-transform":"rotate(90deg)",
				"transform":"rotate(90deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });
	   }
	  }
	  
//disstore2 list 
  function disstore2_show_hide(obj){
    if($(obj).next('.amount').css('display')=='block'){
	  $(".amount").slideUp();
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	   }
   else{
	   $(".amount").slideUp();
	   $(".a-personal").find(".arrow").css({
		 "-webkit-transform":"rotate(0deg)",
		"-moz-transform":"rotate(0deg)",
			"-o-transform":"rotate(0deg)",
				"transform":"rotate(0deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });	
	  $(obj).find(".arrow").removeClass("arrow-rotate");	
	  $(obj).next(".amount").slideDown("fast");
 	  $(obj).find(".arrow").addClass("arrow-rotate");
	  $(obj).find(".arrow").css({
		 "-webkit-transform":"rotate(90deg)",
		"-moz-transform":"rotate(90deg)",
			"-o-transform":"rotate(90deg)",
				"transform":"rotate(90deg)",
	"-webkit-transition":"all .3s",
		"-moz-transition":"all .3s",
			"-o-transition":"all .3s",
				"transition":"all .3s"
		  });
	   };
	  };