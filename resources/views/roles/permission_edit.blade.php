@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">角色权限编辑 -({{$roleinfo->id}}-{{$roleinfo->display_name}})</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
    <div class="col-sm-6"></div></div>
    <div class="row"><div class="col-sm-12">

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
			<form action="/roles/rolePermissionStore" method="post">
				@foreach($permissionList as $pl)
					<tr role="row" class="even" @if($pl->checked ) style="background:#ECECEC;" @endif >
						<td style="text-align:center;">
						<input type="checkbox" name="permission_id[]" value="{{$pl->id}}" {{$pl->checked}} >
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
						 <font color="silver">{{$pl->created_at}}</font>
						</td>
						<td>
						 <font color="silver">{{$pl->updated_at}}</font>
						</td>
					</tr>
				@endforeach
				<tr><td colspan="2">
				  <input type="hidden" name="role_id" value="{{$role_id}}">
				  <input type="hidden" name="_token" value="{{csrf_token()}}">
				  <button class="btn btn-primary" type="submit">提交</button>
				</td></tr>
			</form>

    </table>
    </div>
    </div>
    </div>
  </div><!-- /.box-body -->
</div>
@include('message')
@stop