@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/productcolor/add">添加</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品颜色分布</h3>
  </div><!-- /.box-header -->
  
  <form  class="form-inline" action='' method='get' style="margin-left:20px">
	  <div class="form-group">
		<label for="exampleInputEmail2" class="sr-only">关键字</label>
		<input type="test"  class="form-control" placeholder="关键字" name='keyword' @if(isset($keyword))value={{$keyword}}@endif>
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
							<th>产品型号</th>
							<th>产品颜色</th>
							<th>国家</th>
							<th>语言</th>
							<th>操作</th>
						</tr>
					  </thead>
					  <tbody>
						@foreach($dataList as $al)
						<tr role="row" class="even">
							  <td>{{$al->ProductCode}}</td>
							  <td>{{$baseColor[$al->ColorID]->ColorName}}</td>
							  <td>{{$country[$al->Language]->CountryName}}</td>
							  <td>{{$al->Language}}</td>
							  <td>
								<!-- <a href="/productcolor/edit/{{$al->CID}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;-->
								<a href="/productcolor/del/{{$al->CID}}" onclick="if(!confirm('确定删除？')){ return false; }" ><i class="fa fa-times"></i></a>
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