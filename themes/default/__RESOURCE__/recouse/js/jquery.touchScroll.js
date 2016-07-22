var touchScroll=function(target){
	var $this=target;
	var addEvent=function(t,n,e,b){
		t.get(0).addEventListener(n,e,b);
	};
	var startX=0,startY=0,scrollTop=0,scrollLeft=0;
	var flag=false;
	var tstart=function(e){
		//e.preventDefault;
		startX=e.targetTouches[0].pageX;
		startY=e.targetTouches[0].pageY;
		scrollTop=$this.scrollTop();
		scrollLeft=$this.scrollLeft();
		flag=true;
	};
	var tmove=function(e){
		e.preventDefault();
		if(flag){
			var currX=e.targetTouches[0].pageX,currY=e.targetTouches[0].pageY;
			var currLeft=scrollLeft-(currX-startX);
			var currTop=scrollTop-(currY-startY);
			$this.scrollLeft(currLeft);
			$this.scrollTop(currTop);
		}
	};
	var tend=function(e){
		//e.preventDefault();
		flag=false;
	}
	addEvent($this,'touchstart',tstart,false);
	addEvent($this,'touchmove',tmove,false);
	addEvent($this,'touchend',tend,false);
}
$(function(){
	$(".touchScroll").each(function(){
		touchScroll($(this));
	})
})