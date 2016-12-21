var page = 1;
var page1 = 1;
var startTime = '2014-12-01';
var endTime = '2014-12-01';
var id;
$(function(){
	//回到顶部
	$(window).scroll(function(){
		if($(window).scrollTop()>200){
			$("#topback").fadeIn(1000);
		}else{
			$("#topback").fadeOut(500);
		}
	});
	$("#topback").click(function(){
		$("html,body").animate({scrollTop:"0"},500);
		return false;
	});
	
    //2015加载更多-pc端
    $("#getNewsMore2015Pc").click(function(){
        page++;
        getNewsMorePc(startTime, endTime, page, '2015_news_pc');
    });
    //2015加载更多-移动端
    $("#getNewsMore2015Mobile").click(function(){
        page++;
        getNewsMoreMobile(startTime, endTime, page, '2015_news_mobile');
    });
    //2014加载更多-pc端
    $("#getNewsMore2014Pc").click(function(){
        page1++;
        getNewsMorePc(startTime, endTime, page1, '2014_news_pc');
    });
    //2014加载更多-移动端
    $("#getNewsMore2014Mobile").click(function(){
        page1++;
        getNewsMoreMobile(startTime, endTime, page1, '2014_news_mobile');
    });
    
    //加载左侧列表-PC
    $.ajax({
        type: "GET",
        //url: "http://127.0.0.1:8080/newZero/testNew.json",
        url: "/article/index?cat_id=1&start_date=2014-01-01&end_date=2014-12-31&page=1&lang=cn",
        dataType: "json",
        success: function(data){
            $('.divtest').empty();   //清空resText里面的所有内容
            var html = ''; 
            $.each(data, function(contentIndex, content){
                html += '<a href="javascript:getNewsDetailPc('+content['id']+');" class="new_list_article"><div class="title">'+content['title']
                +'</div><div class="detail"><div class="left_img"><img src="'+content['imgUrl']
                +'" width="100%" /></div><div class="right_content"><div class="time">'+content['time']
                +' </div><div class="describle">'+content['description']+' </div></div></div></a>';
                //console.log(html);
            });
            $('#2015_news_pc,#2014_news_pc').append(html);
            $(".new_list_content a").click(function(){
		    	$(".new_list_content a").removeClass("active");
		    	$(this).addClass("active");
		    });
        }
    });
    //加载左侧列表-Mobile
    $.ajax({
        type: "GET",
        url: "/article/index?cat_id=1&start_date=2014-01-01&end_date=2014-12-31&page=1&lang=cn",
        dataType: "json",
        success: function(data){
            $('.divtest').empty();   //清空resText里面的所有内容
            var html = ''; 
            $.each(data, function(contentIndex, content){
                html += '<a href="/article/info/'+content['id']+'" class="new_list_article"><div class="title">'+content['title']
                +'</div><div class="detail"><div class="left_img"><img src="'+content['imgUrl']
                +'" width="100%" /></div><div class="right_content"><div class="time">'+content['time']
                +' </div><div class="describle">'+content['description']+' </div></div></div></a>';
            });
            $('#2015_news_mobile,#2014_news_mobile').append(html);
        }
    });
    //新闻详情页面
    $.ajax({
        type: "GET",
        url: "/article/first",
        dataType: "json",
        success: function(data){
            $('#newsDetail').empty();
            var html = '';
            //$.each(data, function(contentIndex, content){
                html += '<h2>'+data['title']+'</h2>' +
                        '<span class="description">'+data['time']+' 关注'+data['times']+'</span>' +
                        data['contents'];
            //});
            $('#newsDetail').append(html);
        }
    }); 
});

//2014,2015加载更多-PC
function getNewsMorePc(startTime, endTime, page, id){
    $.ajax({
        type: "GET",
        url: "/article/index?cat_id=1&start_date="+startTime+"&end_date="+endTime+"&page="+page+"&lang=cn",
        dataType: "json",
        beforeSend: function(){
        	$(".btn-loading").append("<img src='/images/news/loading2.gif'>");
        },
        success: function(data,e){
            if(data==null||data==""){
                $("#"+id).next().hide();
            }
            $('.divtest').empty();   //清空resText里面的所有内容
            var html = ''; 
            $.each(data, function(contentIndex, content){
                html += '<a href="javascript:getNewsDetailPc('+content['id']+');" class="new_list_article"><div class="title">'+content['title']
                +'</div><div class="detail"><div class="left_img"><img src="'+content['imgUrl']
                +'" width="100%" /></div><div class="right_content"><div class="time">'+content['time']
                +' </div><div class="describle">'+content['description']+' </div></div></div></a>';
            });
            $('#'+id).append(html);
            $(".new_list_content a").click(function(){
		    	$(".new_list_content a").removeClass("active");
		    	$(this).addClass("active");
		    });
        },
        complete: function(){
        	$(".btn-loading").html("加载更多");
        }
    });
}
//2014,2015加载更多-Mobile
function getNewsMoreMobile(startTime, endTime, page, id){
    $.ajax({
        type: "GET",
        url: "/article/index?cat_id=1&start_date="+startTime+"&end_date="+endTime+"&page="+page+"&lang=cn",
        dataType: "json",
        beforeSend: function(){
        	$(".btn-loading").append("<img src='/images/news/loading2.gif'>");
        },
        success: function(data){
            if(data==null||data==""){
                $("#"+id).next().hide();
            }
            $('.divtest').empty();   //清空resText里面的所有内容
            var html = ''; 
            $.each(data, function(contentIndex, content){
                html += '<a href="/article/info/'+content['id']+'" class="new_list_article"><div class="title">'+content['title']
                +'</div><div class="detail"><div class="left_img"><img src="'+content['imgUrl']
                +'" width="100%" /></div><div class="right_content"><div class="time">'+content['time']
                +' </div><div class="describle">'+content['description']+' </div></div></div></a>';
            });
            $('#'+id).append(html);
        },
        complete: function(){
        	$(".btn-loading").html("加载更多");
        }
    });
}
/*
//2014加载更多-PC
function getNewsMore2014Pc(startTime, endTime, page, id){
    $.ajax({
        type: "GET",
        url: "/article/index?cat_id=1&start_date="+startTime+"&end_date="+endTime+"&page="+page+"&lang=en",
        dataType: "json",
        success: function(data){
            $('.divtest').empty();   //清空resText里面的所有内容
            var html = ''; 
            $.each(data, function(contentIndex, content){
                html += '<a href="javascript:getNewsDetailPc();" class="new_list_article"><div class="title">'+content['title']
                +'</div><div class="detail"><div class="left_img"><img src="'+content['imgUrl']
                +'" width="100%" /></div><div class="right_content"><div class="time">'+content['time']
                +' </div><div class="describle">'+content['description']+' </div></div></div><div id="article2014">'+content['id']+'</div></a>';
            });
            $('#'+id).append(html);
        }
    });
}
//2014加载更多-Mobile
function getNewsMore2014Mobile(startTime, endTime, page, id){
    $.ajax({
        type: "GET",
        url: "/article/index?cat_id=1&start_date="+startTime+"&end_date="+endTime+"&page="+page+"&lang=en",
        dataType: "json",
        success: function(data){
            $('.divtest').empty();   //清空resText里面的所有内容
            var html = ''; 
            $.each(data, function(contentIndex, content){
                html += '<a href="http://127.0.0.1/project/newZero-newsList/newsdetail.html" class="new_list_article"><div class="title">'+content['title']
                +'</div><div class="detail"><div class="left_img"><img src="'+content['imgUrl']
                +'" width="100%" /></div><div class="right_content"><div class="time">'+content['time']
                +' </div><div class="describle">'+content['description']+' </div></div></div><div id="article2014">'+content['id']+'</div></a>';
            });
            $('#'+id).append(html);
        }
    });
}*/
//左侧列表点击查看详情-PC
function getNewsDetailPc(id){
    $.ajax({
        type: "GET",
        url: "/article/"+id,
        dataType: "json",
        beforeSend: function(XMLHttpRequest){
            $(".loading").show();
        },
        success: function(data){
            //console.log(data);
            $('#newsDetail').empty();
            var html = '';
            //$.each(data, function(contentIndex, content){
                html += '<h2>'+data['title']+'</h2>' +
                        '<span class="description">'+data['time']+' 关注'+data['times']+'</span>' +
                        data['contents'];
            //});
            $('#newsDetail').append(html);
        }
    }); 
}
