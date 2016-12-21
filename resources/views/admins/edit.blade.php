@extends('layout.adminlte')
@section('content')

  <div class="">
    <h3 class="">编辑管理员</h3>
  </div>
  
<div class="ibox-content">		
	<form class="form-horizontal" id="FormView" action="/admins/store" method="post">
		<div class="form-group">
			<label class="col-sm-1 control-label">名字：</label>
			<div class="col-sm-10">
				<input type="text" name="account" value="{{$userInfo->account}}" placeholder="管理员名子" nullmsg="不可空" datatype="*">
			</div>
		</div>
		<div class="hr-line-dashed"></div>
		
		<div class="form-group">
			<label class="col-sm-1 control-label">E-Mail:</label>
			<div class="col-sm-10">
				<input type="text" name="email" value="{{$userInfo->email}}" placeholder="管理员名子" nullmsg="不可空" datatype="*">
			</div>
		</div>
		<div class="hr-line-dashed"></div>
		
		<div class="form-group">
			<label class="col-sm-1 control-label">密码1：</label>
			<div class="col-sm-10">
				<input type="password" name="password">
			</div>
		</div>
		<div class="hr-line-dashed"></div>
		
		<div class="form-group">
			<label class="col-sm-1 control-label">密码2：</label>
			<div class="col-sm-10">
				<input type="password" name="repassword">
			</div>
		</div>
		<div class="hr-line-dashed"></div>
		
		<div class="form-group">
			<label class="col-sm-1 control-label">真名：</label>
			<div class="col-sm-10">
				<input type="text" name="real_name" value="{{$userInfo->real_name}}" placeholder="管理员名子" nullmsg="不可空" datatype="*">
			</div>
		</div>
		<div class="hr-line-dashed"></div>
		
		<div class="form-group">
			<label class="col-sm-1 control-label">请选择角色：</label>
			<div class="col-sm-10">
				<select class="" name="role_id"><br />
					@forelse($data['roles'] as $role)
					  <option value="{{$role->id}}" @if ($userInfo->role_id === $role->id) selected @endif >{{$role->display_name}}</option>
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
				<input type="hidden" name="admin_id" value="{{$admin_id}}">
				<button class="btn btn-primary" type="submit">提交</button>
			</div>
		</div>
		<div class="hr-line-dashed"></div>
	</form>
</div>
@include('message')
@stop