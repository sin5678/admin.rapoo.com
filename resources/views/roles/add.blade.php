
@extends('layout.adminlte')
@section('content')

<div class="">
   <h3 class="">添加角色</h3>
</div>
<div class="box">
<form  class="form-horizontal" id="FormView" action="/roles/save" method="post">

	@include('message')
<div class="ibox-content">
	<div class="form-group">
		<label class="col-sm-1 control-label">角色名：</label>
		<div class="col-sm-10">
			<input type="text" name="name" placeholder="角色名字" nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">角色显示名：</label>
		<div class="col-sm-10">
			<input type="text" name="display_name" placeholder="角色显示名" nullmsg="不可空" datatype="*">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">角色描述：</label>
		<div class="col-sm-10">
			<input type="text" name="description" placeholder="角色描述">
		</div>
	</div>
	<div class="hr-line-dashed"></div>
</div>


  <div class="box-header">
    <h1 class="box-title">请选择角色权限</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
		<table id="example2" class="table table-bordered table-hover dataTable">
			<tr role="row">
				<th style="text-align:center;">
				   <input type="checkbox">
				 </th>
				 <th>
				   权限名
				 </th>
				<th>显示权限名</th>
				<th>权限描述</th>
				<th>创建时间</th>
				<th>修改时间</th>
			</tr>
				@foreach($permissionList as $pl)
					<tr role="row" class="even">
						<td style="text-align:center;">
						<input type="checkbox" name="permission_id[]" value="{{$pl->id}}">
						</td>
						<td>
							{{$pl->name}} 
						</td>
						<td>
						 {{$pl->display_name}} 
						</td>
						<td>
						 {{$pl->description}}
						</td>
						<td>
						 {{$pl->created_at}}
						</td>
						<td>
						 {{$pl->updated_at}}
						</td>
					</tr>
				@endforeach
				<tr><td colspan="2">
				  <input type="hidden" name="_token" value="{{csrf_token()}}">
				  <button class="btn btn-primary" type="submit">提交</button>
				</td></tr>
			</form>
    </table>

  </div><!-- /.box-body -->
</div>
@stop