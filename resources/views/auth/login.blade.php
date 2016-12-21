<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>雷柏官网后台</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{URL::asset('/')}}bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{URL::asset('/')}}/adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{URL::asset('/')}}adminlte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{URL::asset('/')}}plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <![endif]-->
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Rapoo</b>官网后台</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Welcome...</p>
        @include('message')
        <form action="login" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" placeholder="email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" placeholder="请输入验证码" id="securityCode" name="captcha"  class="form-control" style=" display: inline; width: 70%" datatype="*" nullmsg="请输入验证码！">
                <a href="javascript:re_captcha();" id="c2c98f0de5a04167a9e427d883690ff6"  >
                    <img  src="{{ $captcha }}" alt="" width="90" height="35"  >
                </a>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> 记住我
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{URL::asset('/')}}plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{URL::asset('/')}}bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{URL::asset('/')}}plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
      function re_captcha() {

         $.ajax({
                type: "GET",
                url: "/auth/getcaptcha",
                dataType: "json",
                data : {Math :  Math.random()},
                success: function(data){
                   if (data.code == '1') {
                      $("#c2c98f0de5a04167a9e427d883690ff6").html(data.html);
                   }
                }
            });
     }

</script>
</body>
</html>
