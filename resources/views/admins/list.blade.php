@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/admins/add">添加管理员</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">管理员列表</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
		<div class="col-sm-6"></div></div>
			<div class="row">
				<div class="col-sm-12">
					<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
					  <thead>
						<tr role="row">
						<th>用户名</th>
						<th>真实名</th>
						<th>角色</th>
						<th>邮箱</th>
						<th>IP</th>
						<th>创建时间</th>
						<th>修改时间</th>
						<th>操作</th>
						</tr>
					  </thead>
					  <tbody>
						@foreach($user_list as $al)
						<tr role="row" class="even">
						  <td class="sorting_1"> {{$al->account}} </td>
						  <td>{{$al->real_name}}</td>
						  <td>{{$al->rdisplay_name}}</td>
						  <td>{{$al->email}}</td>
						  <td>{{$al->client_ip}}</td>
						  <td><font color="silver">{{$al->created_at}} </font></td>
						  <td><font color="silver">{{$al->updated_at}} </font></td>
						  <td>
							<a href="/admins/edit/{{$al->id}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
							<a href="/admins/del/{{$al->id}}" onclick="if(!confirm('确定删除？')){ return false; }" ><i class="fa fa-times"></i></a>
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
		<div class="row">
			<div class="col-sm-5">
				<div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
					共 <?php echo $user_list->total(); ?> 条
				</div>
			</div>
			<div class="col-sm-7">
			<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
				<?php echo $user_list->render(); ?>
			</div>
			</div>
		</div>
    </div>
  </div><!-- /.box-body -->
</div>
@include('message')
@stop