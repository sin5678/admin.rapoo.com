@extends('layout.adminlte')
@section('content')


<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">添加管理员</h3>
  </div>
  <br>
  <form class="form-horizontal" id="FormView" action="/admins/save" method="post">

	<div class="form-group">
		<label class="col-sm-1 control-label">名字：</label>
		<div class="col-sm-10">
			<input type="text" name="account" placeholder="管理员名子" nullmsg="不可空 6~15 字符" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">E-Mail:</label>
		<div class="col-sm-10">
			<input type="text" name="email" placeholder="E-Mail" nullmsg="不可空 请填写E-Mail格式" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">密码1：</label>
		<div class="col-sm-10">
			<input type="password" name="password" placeholder="" nullmsg="不可空 6~15 字符" datatype="*" id="exampleInputPassword1">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">密码2：</label>
		<div class="col-sm-10">
			<input type="password" name="repassword" placeholder="" nullmsg="不可空 两次密码需要一致" datatype="*" id="exampleInputPassword2">
		</div>
	</div>
	<div class="hr-line-dashed"></div>

	<div class="form-group">
		<label class="col-sm-1 control-label">真名：</label>
		<div class="col-sm-10">
			<input type="text" name="real_name" >
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">请选择角色：</label>
		<div class="col-sm-10">
			<select class="" name="role_id"><br />
			@forelse($roles as $role)
			  <option value="{{$role->id}}">{{$role->display_name}}</option>
			@empty
			  <option value="0">请先添加角色</option>
			@endforelse
	 </select>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label"></label>
		<div class="col-sm-10">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<button class="btn btn-primary" type="submit">提交</button>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
  </form>
</div>
@include('message')
@stop