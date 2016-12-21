$(function(){
	//全屏显示
	containerHeight("fullpage_container");

	$(window).resize(function(){
		containerHeight("fullpage_container");
	});
	$(".right-box li").click(function(){
        containerHeight("fullpage_container");
    });
    $(".choice-box li").click(function(){
        setTimeout(function(){
             containerHeight("fullpage_container");//兼容支持中心
        },10)
    });
    $(".question a").click(function(){
         setTimeout(function(){
             containerHeight("fullpage_container");//兼容支持中心
        },5)
    });
    $(".question-types,.question-title").click(function(){
        setTimeout(function(){
             containerHeight("fullpage_container");//兼容支持中心
        },400)
    });
    var SupportsTouches = ("createTouch" in document),
        StartEvent = SupportsTouches ? "touchstart" : "mousedown"
    var wWidth=$(window).width();
    var contentHeight=parseInt(wWidth*408/(454*4))+"px";
    $(".struggle_content_box a").css({"height":contentHeight});
    /*
    $(".struggle_content_box .struggle_text").css({"lineHeight":contentHeight});
    $(".struggle_menu").hover(function(){
        $(this).children(".struggle_top_menuSlide").slideDown("slow");
    },function(){
        $(this).children(".struggle_top_menuSlide").slideUp("slow");
    });
    */
	//$("#search").focus();
    $(".navbar-right li").click(function(){
        $(this).addClass("active");
    },function(){ 
        $(this).removeClass("active");
    });
    /*$(".navbar-right li a.search_box").hover(function(){
        $(this).children("#search").filter(':not(:animated)').delay(100).animate({"width":"100px"},"slow");
    },function(){
        $(this).children("#search").filter(':not(:animated)').delay(100).animate({"width":"0px"},"slow");
    })*/
    $(".navbar-right li.active .country_box ul li").hover(function(){
        $(this).addClass("active");
    },function(){
        $(this).removeClass("active");
    })
    $(".country_slide").hover(function(){
        $(".country_box").filter(':not(:animated)').delay(100).slideDown("slow");
    },function(){
        $(".country_box").filter(':not(:animated)').delay(100).slideUp("slow");
    });
    //头部多语言切换
    $(".navbar-right li.active .country_box ul li").click(function(){
    	$(".country_select").find("img").remove();
        $(".country_slide").css({"background":"#292b2d"});
        $(this).find("img").clone().appendTo($(".country_select"));
        $(".navbar-right li.active .country_box").css({"display":"none"});
    });
    //底部多语言切换
    $('.language ul li a').click(function(){
		$('.language button').text($(this).text()).append(' <span class="caret"></span>');
	});

    // 产品介绍所有页面的副导航
    var lookFlag=true;
    $(".lookmore").click(function(){
        if(lookFlag){
            $(".product-nav-list").slideDown();
            $(".fnav").addClass("active");
            lookFlag=false;
        }else{
            $(".product-nav-list").slideUp();
            $(".fnav").removeClass("active");
            lookFlag=true;
        }

    });
    var window_width=$(window).width();
    var minheight,change_height;
    $(".change_img_height").each(function(){
        minheight=$(this).height();
        change_height=window_width/1920*minheight;
        $(this).css("height",change_height);
    })
});
(function($){
    var SupportsTouches = ("createTouch" in document),
        StartEvent = SupportsTouches ? "touchstart" : "mousedown"
    $.fn.hoverForIE6=function(option){
        var s=$.extend({current:"hover",delay:10},option||{});
        $.each(this,function(){
            var timer1=null,timer2=null,flag=false;
            $(this).bind("mouseover StartEvent",function(){
                if (flag){
                    clearTimeout(timer2);
                }else{
                    var _this=$(this);
                    timer1=setTimeout(function(){
                        _this.children(".struggle_top_menuSlide").filter(':not(:animated)').delay(100).slideDown();
                        flag=true;
                    },s.delay);
                }
            }).bind("mouseout",function(){
                if (flag){
                    var _this=$(this);
                    timer2=setTimeout(function(){
                        _this.children(".struggle_top_menuSlide").filter(':not(:animated)').delay(100).slideUp();
                        flag=false;
                    },s.delay);
                }else{
                    clearTimeout(timer1);
                }
            })
        })
    }
})(jQuery);
$(".struggle_menu").hoverForIE6({delay:200});

//全屏显示
function containerHeight(i){
    $("."+i).height("auto");
    $(".content-box.im-bg-ef").height("auto");
	var wwidth=$(window).width();
	var wheight=$(window).height();
	var showHeight=wheight-$(".footer_box").outerHeight();
	var sonheight=$("."+i).outerHeight();

    var supportBH=$(".support-banner").outerHeight();
	if(wwidth>1000){
		if(showHeight>sonheight){
			$("."+i).css({"height":parseInt(showHeight)+"px"});
			$(".about-content").css({"height":parseInt(showHeight)+"px"});
            $(".content-box.im-bg-ef").css({"height":parseInt(showHeight-supportBH-50)+"px"});//支持中心兼容
		}
	};
    
}

