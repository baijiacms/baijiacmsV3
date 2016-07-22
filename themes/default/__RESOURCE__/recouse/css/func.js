//self jq
$(function(){
	var clicknumber_store=0;

	//menu downtoggle
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
	
	$(".mask").click(function(){footHide();})	
	})
	
$(function(){
	var clicknumber_store=0;

	//menu downtoggle
	$("#disstroe1").click(
	function(){    
	$("#disstroe-sub1").slideToggle("fast");
	if(clicknumber_store==1){
		$("#disstroe1 .arrow").removeClass("arrow-rotate");
		clicknumber_store=0;
		}
	else{
		$("#disstroe1 .arrow").addClass("arrow-rotate");		
		clicknumber_store=1;
		}
		}
	)	
	
	$(".mask").click(function(){footHide();})	
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