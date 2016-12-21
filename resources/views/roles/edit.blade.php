@extends('layout.adminlte')
@section('content')
<div class="">
   <h3 class="">编辑角色信息</h3>
</div>
@include('message')
<div class="box" ><br>
	<form  class="form-horizontal" id="FormView" action="/roles/store" method="post">
			<div class="form-group">
				<label class="col-sm-1 control-label">名字：</label>
				<div class="col-sm-10">
					<input type="text" name="name" value="{{$role_info->name}}" placeholder="角色名字" nullmsg="不可空" datatype="*">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			
			<div class="form-group">
				<label class="col-sm-1 control-label">显示名字</label>
				<div class="col-sm-10">
					<input type="text" name="display_name" value="{{$role_info->display_name}}" placeholder="角色名字" nullmsg="不可空" datatype="*">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			
			<div class="form-group">
				<label class="col-sm-1 control-label">描述：</label>
				<div class="col-sm-10">
					<input type="text" name="description" value="{{$role_info->description}}" placeholder="角色名字" nullmsg="不可空" datatype="*">
				</div>
			</div>
			<div class="hr-line-dashed"></div>
			
			<div class="form-group">
				<label class="col-sm-1 control-label"></label>
				<div class="col-sm-10">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="id" value="{{$role_info->id}}">
					<button class="btn btn-primary" type="submit">提交</button>
				</div>
			</div>
			<div class="hr-line-dashed"></div>
	</form>
	
	<div class="box-body">
	<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
		<tr role="row">
			<th>显示权限名</th>
			<th>权限描述</th>
		</tr>
		@foreach($permissionList as $pl)
			<tr role="row" class="even">
				<td><a href="/roles/rolePermissionEdit/{{ $role_info->id }}">{{$pl->display_name}}</a></td>
				<td>{{$pl->description}}</td>
			</tr>
		@endforeach
	</table>
	</div><!-- /.box-body -->
</div>
@include('message')
@stop