@extends('layout.adminlte')
@section('content')
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">添加管理员</h3>
  </div>
  <form action="save" method="post" id="FormView">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="box-body">
      <div class="row col-md-4"></div>
      <div class="row col-md-4">
        <div class="form-group has-feedback">
          <!-- <label for="exampleInputEmail1">帐号</label> -->
          <input type="text" class="form-control" name="account" placeholder="帐号" datatype="*6-15" errormsg="请输入6~15位的帐号名称！" nullmsg="请填写帐号">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <!-- <label for="exampleInputEmail1">邮箱</label> -->
          <input type="email" class="form-control" name="email" placeholder="邮箱" datatype="e" errormsg="请输入正确的邮箱地址！" nullmsg="请填写邮箱">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <!-- <label for="exampleInputEmail1">密码</label> -->
          <input type="password" class="form-control" name="password" placeholder="密码" datatype="*6-15" errormsg="密码范围在6~15位之间！" nullmsg="请填写密码">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <!-- <label for="exampleInputEmail1">密码重复</label> -->
          <input type="password" class="form-control" name="repassword" placeholder="密码重复" datatype="*" recheck="password" errormsg="您两次输入的账号密码不一致！">
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <!-- <label for="exampleInputEmail1">真实姓名</label> -->
          <input type="text" class="form-control" name="real_name" placeholder="真实姓名" datatype="s4-15" errormsg="请输入4~15位的真实姓名！" nullmsg="请填写真实姓名">
          <span class="glyphicon glyphicon-flag form-control-feedback"></span>
        </div>
        <div class="form-group">
          <!-- <label>角色</label> -->
          <select class="form-control" name="role_id">
            @forelse($roles as $role)
              <option value="{{$role->id}}">{{$role->display_name}}</option>
            @empty
              <option value="0">请先添加角色</option>
            @endforelse
          </select>
        </div>
        <div class="row">
          <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> <span id="ajaxTips">正在提交数据，请耐心等待......</span></h4>
          </div>
          <div class="col-md-3 col-md-offset-3">                       
            <button type="submit" class="btn btn-success btn-block btn-flat">提交</button>
          </div>
          <div class="col-md-3">
            <button type="reset" class="btn btn-warning btn-block btn-flat">重置</button>
          </div>
        </div>
        </div>
        <div class="row col-md-4"></div>
    </div>
  </form>
</div>
@stop