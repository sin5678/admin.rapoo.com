@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/countryarea/add">添加区域</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">区域列表</h3>
  </div><!-- /.box-header -->
  
  <form  class="form-inline hidden" action='' method='get' style="margin-left:20px">
	  <div class="form-group">
		<label for="exampleInputEmail2" class="sr-only">关键字</label>
		<input type="test"  class="form-control" placeholder="语言名称" name='keyword' @if(isset($keyword))value={{$keyword}}@endif>
	  </div>
	  <button class="btn btn-w-m btn-primary" type="submit">搜索</button>
</form>

  <div class="box-body">
    <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
		<div class="col-sm-6"></div></div>
			<div class="row">
				<div class="col-sm-12">
					<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
					  <thead>
						<tr role="row">
							<th>ID</th>
							<th>地区名</th>
							<th>地区描述</th>
							<th>操作</th>
						</tr>
					  </thead>
					  <tbody>
						@foreach($dataList as $al)
						<tr role="row" class="even">
							  <td>{{$al->AreaID}}</td>
							  <td>{{$al->AreaName}}</td>
							  <td>{{$al->AreaDesc}}</td>
							  <td>
								<a href="/countryarea/edit/{{$al->AreaID}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
								<a href="/countryarea/del/{{$al->AreaID}}" onclick="if(!confirm('确定删除？')){ return false; }" >
								<i class="fa fa-times"></i></a>
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
					共 <?php echo $dataList->total(); ?> 条
				</div>
			</div>
			<div class="col-sm-7">
			<div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
				<?php echo $dataList->render(); ?>
			</div>
			</div>
		</div>
    </div>
  </div><!-- /.box-body -->
</div>
@include('message')
@stop