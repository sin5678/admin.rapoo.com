$(function(){
	footerP();
	$(window).resize(function(){
		footerP();
	})
	//选择机型
	$(".type-box a").click(function(){
		$(".type-box li").removeClass("active");
		$(this).parent("li").addClass("active");
	})
	//筛选类型
	$(".normal-choice a").click(function(){
		$(".normal-choice li").removeClass("active");
		$(this).parent("li").addClass("active");
		var index=$(this).parents(".normal-choice").index();
		var newIndex=index-1;
		$(".download-result>div").hide();
		$(".download-result>div").eq(newIndex).show();
	})
	
	$(".question-box").on("click",".question-types",function(){
		$(this).parent(".question-list").siblings(".question-list").children("ul").slideUp(200);
		$(this).parent(".question-list").children("ul").slideToggle(400);
	})
	$(".tabcontrol").hide();
	$(".question-box").on("click",".agent_menu",function(){
		$(this).next(".tabcontrol").siblings(".tabcontrol").slideUp(50);
		$(this).next(".tabcontrol").slideToggle(50);
	})
	$(".question-box").on("click",".question-title",function(){
		var thisLi=$(this).parent("li");
		if(thisLi.hasClass("active")){
			thisLi.removeClass("active");
			thisLi.children(".question-answer").slideUp(200);
		}else{
			thisLi.addClass("active");
			thisLi.siblings("li").removeClass("active").children(".question-answer").slideUp(200);
			thisLi.children(".question-answer").slideDown(200);
		}
	})
	
	//登录注册
	regH();
	$(".third-login a").hover(
		function(){
			$(this).children("i").animate({top:"-100%"});
			$(this).children("b").animate({top:"50%"});
		},
		function(){
			$(this).children("i").animate({top:"50%"});
			$(this).children("b").animate({top:"100px"});
		}
	);
	$("#to-register").click(function(){
		$(".login").hide();
		$(".register").show();
		regH();
	});
	$("#get-email").click(function(){
		$(".getnew").hide();
		$(".share-box").show();
		regH();
	});
	$("#back-login1").click(function(){
		$(".register").hide();
		$(".login").show();
		regH();
	});
	$("#back-login2").click(function(){
		$(".getnew").hide();
		$(".login").show();
		regH();
	});
	$(window).resize(function(){
		regH();
	});
	//点击刷地图
	$(".right-box li").eq(3).children("a").click(function(){
		$("#search-map a").trigger("click");
	});
	//个人中心
	//个人中心模块切换
	// $(".center-left-box div").eq(0).show().siblings().hide();
	$(".center-right-box li").eq(0).addClass("active");
	$(".change-password").click(function(){
		$(".my-info-box").show().siblings().hide();
	});
	$(".personal-info").click(function(){
		$(".my-info-box").show().siblings().hide();
	});
	$(".change-password").click(function(){
		$(".change-password-box").show().siblings().hide();
	});
	//个人中心弹窗
	$(".tanc-box").hide();
	$(".share-file-box").hide();
	$(".center-save").parent().hide();
	$(".first-file input").click(function(){
		$(".input-cancel").parent().hide();
		$(".center-save").parent().show();	
		$(".input-btn").removeClass("btn-hightlight").addClass("btn-dark");
	});
	$(".tanc-close-btn").click(function(){
		$(".tanc-box").hide();
	});
	$(".file-content").hide();
	$(".my-avatar-box").hover(
		function(){
			$(".edit-my-avatar").show();
		},
		function(){
			$(".edit-my-avatar").hide();
		}
	);
	$(".edit-my-avatar").click(function(){
		$(".tanc-box").show();
		$(".file-content").show();
	});
	$(".center-right-box li").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
	});
	$(".first-file-box .input-btn").on("click",function(){
		$("#avatarInput").click();
	})
	// 个人中心的全屏显示
	centerSize();
	$(window).resize(function(){
		centerSize();
	})
	
	// 产品中心
})
function footerP(){
	var wH=$(window).height();
	var bH=$("body").height();
	if(wH<bH){
		$("#im-footer").removeClass("im-fix-footer");
	}else{
		$("#im-footer").addClass("im-fix-footer");
	}
}
function regH(){
	var conH=$(".reg-content").height();
	var winH=$(window).height();
	if(conH>=winH&&conH>=(winH-100)){
		$(".register-box").removeClass("table-box");
		$(".register-box .container").removeClass("dis-table");
		$(".register-box .reg-box").removeClass("dis-tablecell");
		$(".register-box .reg-content").addClass("resmar");
	}else if(conH>=winH&&conH<(winH-100)){
		$(".register-box").removeClass("table-box");
		$(".register-box .container").removeClass("dis-table");
		$(".register-box .reg-box").removeClass("dis-tablecell");
	}else{
		$(".register-box").addClass("table-box");
		$(".register-box .container").addClass("dis-table");
		$(".register-box .reg-box").addClass("dis-tablecell");
		$(".reg-content").removeClass("resmar");
	}
}
function centerSize(){
	var cenBoxH=$(".fullpage_container").outerHeight();
	var centBanner=$(".center-banner").outerHeight();
	$(".center-box").height(cenBoxH-centBanner);
}


