$(document).ready(function() {
	var owl = $("#struggle_state_box");
	owl.owlCarousel({
		items : 4, //10 items above 1000px browser width
		itemsDesktop : [1000,4], //5 items between 1000px and 901px
		itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
		itemsTablet: [700,2], //2 items between 600 and 0;
		itemsMobile : true, // itemsMobile disabled - inherit from itemsTablet option
		slideSpeed : 800,
		navigation: false,
		pagination: false,
		autoPlay : true
	});
	$(".struggle_state_next").click(function(){
        owl.trigger('owl.next');
    });
    $(".struggle_state_prev").click(function(){
        owl.trigger('owl.prev');
    });
    var wHeight=$(window).height();
    var boxMinHeight=parseInt(wHeight)-parseInt($(".struggle_top").height())-parseInt($(".footer_box").outerHeight())+"px";
    var boxHeight=$(".struggle_state_container").css('height');
    boxHeight=parseInt(boxMinHeight)>parseInt(boxHeight)?(parseInt(boxMinHeight)+1+"px"):(parseInt(boxHeight)+1+"px");
    console.log(boxHeight);
    $(".struggle_state_container").css({"min-height":boxHeight});
    $('.boxer').boxer({
		requestKey: 'abc123'
	});
	// var _rightheight=parseInt($(".struggle_state_right").css("height"));
	// if(parseInt($(window).width())>993){
	// 	$(".left_img_box").css({"height":(_rightheight-20)+"px"});
	// }
});