$(function(){
	//拦截form,在form提交前进行验证
    $('form').bind('submit',beforeSubmit);
	$.each($("[valType]"),function(i, n) {
		$(n).bind('blur',validateBefore);
	});
	
	//定义一个验证器
	$.Validator=function(para) {
		
	
	}

	$.Validator.ajaxValidate=function() {
		beforeSubmit();
		// if(flag==true){
  //           $.ajax({
  //               type: "POST",
  //               url: "http://index.php?option=com_form&task=get_activity_data",
  //               contentType: "application/json; charset=utf-8",
  //               data: JSON.stringify(GetJsonData()),
  //               dataType: "json",
  //               success: function (message) {
  //                    $(".tip_yellowsimple").each(function(){
  //                       $(this).css("opacity","0");
  //                   })
  //                   if (message > 0) {
  //                       alert("请求已提交！我们会尽快与您取得联系");
  //                   }
  //               },
  //               error: function (message) {
  //                   $("#request-process-patent").html("提交数据失败！");
  //               }
  //           });
  //       }
  //       function GetJsonData() {
	 //        var json = {
	 //            "order_id": $("#orderId").val(),
	 //            "team_name": $("#team_name").val(),
	 //            "telphone": $("#cellphone").val(),
	 //            "post_url": $("#post_url").val(),
	 //            "video_url": $("#video_url").val(),
	 //            "email": $("#t_mall").val(),
	 //            "address":$('#loc_province').select2('data').text+"_"+$('#loc_city').select2('data').text+"_"+$('#loc_town').select2('data').text+"_"+$("#address").val(),
	 //            "work_explain": $("#txtF_Content").html()
	 //        };
	 //        return json;
	 //    }
	}
	
	//验证的方法
	$.Validator.match=function(para) {
		//定义默认的验证规则
		var defaultVal = {
			NUMBER : "^[0-9]*$",
			TEL : "^0(10|2[0-5789]|\\d{3})-\\d{7,8}$",
			IP : "^((\\d|[1-9]\\d|1\\d\\d|2[0-4]\\d|25[0-5]|[*])\\.){3}(\\d|[1-9]\\d|1\\d\\d|2[0-4]\\d|25[0-5]|[*])$",
			MOBILE : "^1(3[0-9]|5[0-35-9]|8[0235-9])\\d{8}$",
			MAIL : "^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9-_]+\.[a-zA-Z]{2,3}$",
			IDENTITY : "((11|12|13|14|15|21|22|23|31|32|33|34|35|36|37|41|42|43|44|45|46|50|51|52|53|54|61|62|63|64|65|71|81|82|91)\\d{4})((((19|20)(([02468][048])|([13579][26]))0229))|((20[0-9][0-9])|(19[0-9][0-9]))((((0[1-9])|(1[0-2]))((0[1-9])|(1\\d)|(2[0-8])))|((((0[1,3-9])|(1[0-2]))(29|30))|(((0[13578])|(1[02]))31))))((\\d{3}(x|X))|(\\d{4}))",
			CHINESE : "^([\u4E00-\uFA29]|[\uE7C7-\uE7F3])*$",
			URL : "((http|ftp|https)://)(([a-zA-Z0-9\._-]+\.[a-zA-Z]{2,6})|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,4})*(/[a-zA-Z0-9\&%_\./-~-]*)?"
		};
		var flag=false;
		if(para.rule=='OTHER') {//自定义的验证规则匹配
			flag=new RegExp(para.regString).test(para.data);
		}
		else {
			if(para.rule in defaultVal) {//默认的验证规则匹配
			flag=new RegExp(defaultVal[para.rule]).test(para.data);
			}
		}
		
		return flag;
	}

	
	
	//为jquery扩展一个doValidate方法，对所有带有valType的元素进行表单验证，可用于ajax提交前自动对表单进行验证
	$.extend({
		doValidate: function() {
			return $.Validator.ajaxValidate();
		}
	});

   });
String.prototype.trim=function() {
    return this.replace(/(^\s*)|(\s*$)/g,'');
}
//输入框焦点离开后对文本框的内容进行格式验证
function validateBefore() {
	//验证通过标识
	var flag=true;
	//获取验证类型
	var valType=$(this).attr('valType');
	//获取验证不通过时的提示信息
	var msg=$(this).attr('msg');
	//自定义的验证字符串
	var regString;
	if(valType=='OTHER') {//如果类型是自定义，则获取自定义的验证字符串
		regString=$(this).attr('regString');
		flag=$(this).val()!=''&&$.Validator.match({data:$(this).val(), rule:$(this).attr('valType'), regString:$(this).attr('regString')});
	}
	else {//如果类型不是自定义，则匹配默认的验证规则进行验证
		if($(this).attr('valType')=='required') {//不能为空的判断
			if($(this).val().trim()=='') {
				flag=false;

			}
		}else if($(this).attr('valType')=='province') {//不能为空的判断
			if($(this).val().trim()=='') {
				flag=false;
			}
		}else if($(this).attr('valType')=='city') {//不能为空的判断
			if($(this).val().trim()=='') {
				flag=false;
			}
		}else if($(this).attr('valType')=='town') {//不能为空的判断
			if($(this).val().trim()=='') {
				flag=false;
			}
		}
		else {//已定义规则的判断
			flag=$(this).val()!=''&&$.Validator.match({data:$(this).val(), rule:$(this).attr('valType')});
		}
	}
	//先清除原来的tips
	//$(this).poshytip('hide');
	$(this).siblings(".tip_yellowsimple").animate({opacity:"0",left:"77%",filter:"alpha(opacity=0)"}, 200);
	//$(".vail_text").animate({opacity:"0",left:"980px"},200);
	//如果验证没有通过，显示tips
	if(!flag) {
			$(this).siblings(".tip_yellowsimple").animate({opacity:"1",left:"75%",filter:"alpha(opacity=100)"}, 200);
			//$(".vail_text").css({top:"175px",left:"980px"}).animate({opacity:"1",left:"960px"}, 200);
	}
}

//submit之前对所有表单进行验证
function beforeSubmit() {
	var flag=true;
	//alert($("[valType]").length);
	 $.each($("[valType]"),function(i, n) {
		 //清除可能已有的提示信息
		 $(n).siblings(".tip_yellowsimple").animate({opacity:"0",left:"77%",filter:"alpha(opacity=0)"}, 200);
		if($(n).attr("valType")=='town'){//对不能为空的城镇下拉框进行验证
			if($(n).val().trim()=='') {
				$(".vail_text").css({top:"175px",left:"980px"}).animate({opacity:"1",left:"960px",filter:"alpha(opacity=100)"}, 200);
				$(".select_box").html("请选择你所在的城镇");
				flag=false;
			}
		}else if($(n).attr("valType")=='city'){//对不能为空的市下拉框进行验证
			if($(n).val().trim()=='') {
				$(".vail_text").css({top:"175px",left:"980px"}).animate({opacity:"1",left:"960px",filter:"alpha(opacity=100)"}, 200);
				$(".select_box").html("请选择你所在的城市");
				flag=false;
			}
		}else if($(n).attr("valType")=='province') {//对不能为空的省份下拉框进行验证
			if($(n).val().trim()=='') {
				$(".vail_text").css({top:"175px",left:"980px"}).animate({opacity:"1",left:"960px",filter:"alpha(opacity=100)"}, 200);
				$(".select_box").html("请选择你所在的省份");
				flag=false;
			}
		}else if($(n).attr("valType")=='required') {//对不能为空的文本框进行验证
			if($(n).val().trim()=='') {
			//显示tips
			$(n).siblings(".tip_yellowsimple").animate({opacity:"1",left:"75%",filter:"alpha(opacity=100)"}, 200);;
			flag=false;
			}
		}
		else if($(n).attr("valType")=='OTHER') {//对自定义的文本框进行验证
			if(!($(this).val().trim()!=''&&$.Validator.match({data:$(this).val(), rule:$(this).attr('valType'), regString:$(this).attr('regString')}))) {
				$(n).siblings(".tip_yellowsimple").animate({opacity:"1",left:"75%",filter:"alpha(opacity=100)"}, 200);;
				flag=false;
			}
		}
		else {//对使用已定义规则的文本框进行验证
			if(!($(this).val().trim()!=''&&$.Validator.match({data:$(this).val(), rule:$(this).attr('valType')}))) {
				$(n).siblings(".tip_yellowsimple").animate({opacity:"1",left:"75%",filter:"alpha(opacity=100)"}, 200);;
				flag=false;
			}
		}
	 });
     return flag;
}
