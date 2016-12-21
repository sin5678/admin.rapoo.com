@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/permission/add">添加权限</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">权限列表</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
		<div class="col-sm-6"></div></div>
			<div class="row">
				<div class="col-sm-12">
					<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
					  <thead>
						<tr role="row">
						<th>权限</th>
						<th>权限显示名</th>
						<th>权限描述</th>
						<th>类别</th>
						<th>创建时间</th>
						<th>修改时间</th>
						<th>操作</th>
						</tr>
					  </thead>
					  <tbody>
						@foreach($permissionList as $pl)
						<tr role="row" class="even {{$pl->pcat}}">
						  <td>{{$pl->name}}</td>
						  <td>{{$pl->display_name}}</td>
						  <td>{{$pl->description}}</td>
						  <td>{{$pl->showname}}</td>
						  <td><font color="silver">{{$pl->created_at}}</font></td>
						  <td><font color="silver">{{$pl->updated_at}}</font></td>
						  <td>
							<a href="/permission/edit/{{$pl->id}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
							<a href="/permission/delete/{{$pl->id}}" onclick="if(!confirm('确定删除？')){ return false; }" ><i class="fa fa-times"></i></a>
						  </td>
						</tr>
						@endforeach
					  </tbody>
					  <tfoot>
						<tr>
						</tfoot>
					</table>
				</div>
			</div>
    </div>
  </div><!-- /.box-body -->
</div>
@include('message')
@stop