var len;
var showerObj;
var listObj;
var showerWidth = 800;
var showerHeight = 400;
var r;
var cR = 0;
var ccR = 0;
var timer = 0;
window.onload = function() {
	showerObj = document.getElementById("show");
	if (showerObj) {
		listObj = showerObj.getElementsByTagName("li");
		len = listObj.length;
		r = Math.PI / 180 * 360 / len;
		for (var i = 0; i < len; i++) {
			var item = listObj[i];
			// item.style.top=showerHeight/2+Math.sin(r*i)*showerWidth/2-20+"px";
			// item.style.left=showerWidth/2+Math.cos(r*i)*showerWidth/2-30+"px";
			item.rotate = (r * i + 2 * Math.PI) % (2 * Math.PI);
			item.onclick = function() {
				console.log($(this).attr("dataslide")==="true")
				if($(this).attr("dataslide")==="false"){
					cR = Math.PI / 2 - this.rotate;
					timer || (timer = setInterval(rotate, 10));
					$(this).attr("dataslide","true").siblings().attr("dataslide","false");
				}
			}
		}
		var rX = showerObj.offsetLeft + showerWidth / 2;
		var ry = showerObj.offsetTop + showerHeight / 2;

		var rotate = function() {
			ccR = (ccR + 2 * Math.PI) % (2 * Math.PI);
			if (cR - ccR < 0) cR = cR + 2 * Math.PI;
			if (cR - ccR < Math.PI) {
				ccR = ccR + (cR - ccR) / 19;
			} else {
				ccR = ccR - (2 * Math.PI + ccR - cR) / 19;

			}

			if (Math.abs((cR + 2 * Math.PI) % (2 * Math.PI) - (ccR + 2 * Math.PI) % (2 * Math.PI)) < Math.PI / 720) {
				ccR = cR;
				clearInterval(timer);
				timer = 0;
			}

			for (var i = 0; i < len; i++) {
				var item = listObj[i];
				var w, h;
				var sinR = Math.sin(r * i + ccR);
				var cosR = Math.cos(r * i + ccR);
				w = 350 + 0.6 * 350 * sinR;
				h = (200 + 0.6 * 200 * sinR);
				item.style.cssText += ";width:" + w + "px;height:" + h + "px;top:" + parseInt(showerHeight / 2 + sinR * showerWidth / 1 / 3 - w / 2) + "px;left:" + parseInt(showerWidth / 2 + cosR * showerWidth / 2 - h / 2) + "px;z-index:" + parseInt(showerHeight / 2 + sinR * showerWidth / 2 / 3 - w / 2) + ";";
			}
		}
	};
	//rotate();
	// cR = Math.PI / 2;
	// timer || (timer = setInterval(rotate, 10));
}
var wwidth=$(window).width();
var wheight=$(window).height();
var array=new Array();
var showHeight=wheight-$(".footer_box").outerHeight();
$(function(){
	if(wwidth>900){
		$(".struggle_buy_container").css({"height":parseInt(showHeight)+"px"});
	};
	if (wwidth<900) {
		$(".struggle_show").attr("id","hide");
		if(array.length=="0"){
			$(".struggle_show li").each(function(){
				array.push($(this).attr("style"));
			})
		}
		$(".struggle_show li").removeAttr("style");
	};
});

$(window).resize(function(){
	console.log(array)
	wwidth=$(window).width();
	wheight=$(window).height();
	showHeight=wheight-$(".footer_box").outerHeight();
	if(wwidth>900){
		$(".struggle_buy_container").css({"height":parseInt(showHeight)+"px"})
		$(".struggle_show").attr("id","show");
		if(array.length!="0"){
			$(".struggle_show li").each(function(){
				$(this).attr("style",array.pop());
			});
		}
	};
	if(wwidth<900) {
		$(".struggle_show").attr("id","hide");
		// $(".struggle_show li").removeAttr("style");
		// $(".struggle_buy_container").removeAttr("style");
		if(array.length=="0"){
			$(".struggle_show li").each(function(){
				array.push($(this).attr("style"));
			});
		}
		$(".struggle_show li").removeAttr("style");
	};
})