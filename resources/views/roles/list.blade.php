@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/roles/add">添加角色</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">角色列表</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
    <div class="col-sm-6"></div></div>
    <div class="row"><div class="col-sm-12">
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
      <thead>
        <tr role="row">
			
			<th>角色名</th>
			<th>显示角色名</th>
			<th>描述</th>
			<th>创建时间</th>
			<th>修改时间</th>
			<th>编辑权限</th>
			<th>操作</th>
        </tr>
      </thead>
      <tbody>
			@foreach($roles_list as $rl)
				<tr role="row" class="even">
				  <td class="sorting_1"> {{$rl->name}} </td>
				  <td>{{$rl->display_name}}</td>
				  <td>{{$rl->description}}</td>
				  <td><font color="silver">{{$rl->created_at}}</font></td>
				  <td><font color="silver">{{$rl->updated_at}}</font></td>
				  <td class="sorting_1"><a href="/roles/rolePermissionEdit/{{$rl->id}}">编辑权限</a></td>
				  <td>
					<a href="/roles/edit/{{$rl->id}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
				    <a href="/roles/delete/{{$rl->id}}" onclick="if(!confirm('确定删除？')){ return false; }" ><i class="fa fa-times"></i></a>
				  </td>
				</tr>
			@endforeach
      </tbody>
      <tfoot>
        <tr>
        </tfoot>
    </table>
    </div>
    </div><div class="row"><div class="col-sm-5">
    <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
		共 <?php echo $roles_list->total(); ?> 条
	</div>
    </div>
    <div class="col-sm-7">
    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
		<?php echo $roles_list->render(); ?>
    </div>
    </div>
    </div>
    </div>
  </div><!-- /.box-body -->
</div>
@include('message')
@stop