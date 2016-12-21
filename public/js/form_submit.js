$(function(){
    var $timeline_block = $('.cd-timeline-block');
    //hide timeline blocks which are outside the viewport
    $timeline_block.each(function(){
        if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
            $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
        }else{
            $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('bounce-in');
        }
    });
    //on scolling, show/animate timeline blocks when enter the viewport
    $(window).on('scroll', function(){
        $timeline_block.each(function(){
            if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
                $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
            }
        });
    });

    addressInit('loc_province', 'loc_city', 'loc_town', '北京', '市辖区', '东城区');
    //判断当前屏--时间轴效果
    var $timeline_block = $('.cd-timeline-block');
    //hide timeline blocks which are outside the viewport
    $timeline_block.each(function(){
        if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
            $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
        }else{
            $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('bounce-in');
        }
    });
    //on scolling, show/animate timeline blocks when enter the viewport
    $(window).on('scroll', function(){
        $timeline_block.each(function(){
            if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
                $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
            }
        });
    });
    //结束
    //报名入口效果
    $(".entry_box").hover(function(){
        $(this).css("background","url(http://www.xirodrone.com/components/com_form/assets/images/register_active.png)");
    },function(){
        $(this).css("background","url(http://www.xirodrone.com/components/com_form/assets/images/register.png)");
    });
    $(".entry_box").click(function(){
        $(".act_container").css("display","block");
        $(".act_form_register").fadeIn("slow");
    })
    $(".form_close").click(function(){
        $(".act_container").css("display","none");
        $(".tip_yellowsimple").each(function(){
            $(this).css("opacity","0");
        })
        $(".act_form_register").fadeOut();
        $(".act_mzsm_box").fadeOut();
    })
    $(".act_mzsm").click(function(){
        $(".act_container").css("display","block");
        $(".act_mzsm_box").fadeIn("slow");
    })

        var system = {
            win: false,
            mac: false,
            xll: false,
            ipad:false
        };
        //检测平台
        var p = navigator.platform;
        system.win = p.indexOf("Win") == 0;
        system.mac = p.indexOf("Mac") == 0;
        system.x11 = (p == "X11") || (p.indexOf("Linux") == 0);
        system.ipad = (navigator.userAgent.match(/iPad/i) != null)?true:false;
        //跳转语句，如果是手机访问就自动跳转到wap.baidu.com页面
        if (system.win || system.mac || system.xll||system.ipad) {
            $(".bdshare_popup_box").css({opacity:0});
        }
    //表单提交
    // $("#submit").click(function() {
    //     //$("#request-process-patent").html("正在提交数据，请勿关闭当前窗口...");
        
    // });
    // $(".act_container").on("scroll",function(e){
    //     e.preventDefault();
    // })
    
})
function countChar(textareaID, spanID, maxNum) {
    //得到输入的字符的长度
    var NowNum = document.getElementById(textareaID).value.length;
    //判断输入的长度是否超过规定的长度
    if (NowNum > maxNum) {
        //如果超过就截取规定长度的内容
        document.getElementById(textareaID).value = document.getElementById(textareaID).value.substring(0, maxNum);
    } else {
        //得到当前的输入长度并且显示在页面上
        document.getElementById(spanID).innerHTML = NowNum;
    }
}
//得到当前的输入长度并且显示在页面上
function SetLength(textareaID, spanID) {
    var NowNum = document.getElementById(textareaID).value.length;

    document.getElementById(spanID).innerHTML = NowNum;
}

function PageInit() {
    SetLength('txtF_Content', 'counter');
}