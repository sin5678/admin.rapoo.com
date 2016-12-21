	$(function(){
		$("#login").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				password:{
					required:true,
					minlength:6
				},
				captcha:{
					required:true,
					minlength:4
				}
			},
			messages: {
				email: {
					required: "请输入邮箱",
					email: "输入的邮箱格式不对"
				},
				password:{
					required: "请输入密码",
					minlength: "密码输入格式不对"
				},
				captcha:{
					required: "请输入验证码",
					minlength: "验证码输入格式不对"
				}
			},
			errorPlacement: function(error, element) {    
			    error.appendTo(element.parent());
			},
			errorContainer: "#login div.warning-box p",  
			errorLabelContainer: $("#login div.warning-box p"),  
			wrapper: "span" 
		});
		$("#register").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				password:{
					required:true,
					minlength:6
				},
				repassword:{
					required:true,
					minlength:6,
					equalTo: "#password"
				},
				captcha:{
					required:true,
					minlength:4
				}
			},
			messages: {
				email: {
					required: "请输入邮箱",
					email: "输入的邮箱格式不对"
				},
				password:{
					required: "请输入密码",
					minlength: "密码输入格式不对"
				},
				repassword:{
					required: "请输入密码",
					minlength: "密码输入格式不对",
					equalTo: "请输入相同的密码"
				},
				captcha:{
					required: "请输入验证码",
					minlength: "验证码输入格式不对",
				}
			},
			errorPlacement: function(error, element) {    
			    error.appendTo(element.parent());
			},
			errorContainer: "#register div.warning-box p",  
			errorLabelContainer: $("#register div.warning-box p"),  
			wrapper: "span" 
		});
		$("#get_new").validate({
			rules: {
				email: {
					required: true,
					email: true
				},
				captcha:{
					required:true,
					minlength:4
				}
			},
			messages: {
				email: {
					required: "请输入邮箱",
					email: "输入的邮箱格式不对"
				},
				captcha:{
					required: "请输入密码",
					minlength: "验证码输入格式不对"
				}
			},
			errorPlacement: function(error, element) {    
			    error.appendTo(element.parent());
			},
			errorContainer: "#get_new div.warning-box p",  
			errorLabelContainer: $("#get_new div.warning-box p"),  
			wrapper: "span" 
		});
		$("#new_pass").validate({
			rules: {
				password: {
					required: true,
					minlength: 6
				},
				password_confirmation:{
					required:true,
					minlength:6,
					equalTo: "#password"
				}
			},
			messages: {
				password: {
					required: "请输入密码",
					minlength: "输入的密码格式不对"
				},
				password_confirmation:{
					required: "请输入密码",
					minlength: "密码输入格式不对",
					equalTo: "请输入相同的密码"
				}
			},
			errorPlacement: function(error, element) {    
			    error.appendTo(element.parent());
			},
			errorContainer: "#new_pass div.warning-box p",  
			errorLabelContainer: $("#new_pass div.warning-box p"),  
			wrapper: "span" 
		});
	})