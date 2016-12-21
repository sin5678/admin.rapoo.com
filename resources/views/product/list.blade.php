@extends('layout.adminlte')
@section('content')
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="javascript:void;" id="delaction">删除</a>
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px" href="/product/add">添加产品</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品列表</h3>


  </div>

  <div class="box-body">

    <div class="row" style="border: 1px #cccccc;background: #f5f5f5;padding: 10px;margin: 10px">
      <div class="col-sm-1">
     搜索产品：
        </div>
        <form class="form-horizontal" action="/product/action" method="get"   id="FormView">
        <div class="col-sm-2">
          {!! csrf_field() !!}
            <input type="text" class="form-control" placeholder="产品名称" name="keyword" value="">
             <input type="hidden" name="action" id="actionname" value="search">
             <input type="hidden" name="pids"   id="pids" value="0">
        </div>
      <div class="col-sm-1">
          <button class="btn btn-w-m btn-primary" type="submit">搜索</button>
        </div>

            <div class="col-sm-2">   <a class="btn btn-w-m btn-primary"   style="float: left" href="/product">取消搜索</a>
                </div>

        </form>
    </div>
    <div class="row"></div>

    <div class="row" style="margin-top: 10px">
      <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                  <th><input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" isall="true" type="checkbox"></th>
                  <th>产品型号</th>
                  <th>产品名称</th>
                  <th>产品分类</th>
                  <th>产品描述</th>
                  <th>审核</th>
                  <th>发布</th>

              </tr>
            </thead>
      <tbody>
              @foreach($list as $al)
              <tr role="row" class="even" >
              <td>    <input name="selected" value="{{$al->PID}}" type="checkbox"></td>
              <td> <a href="/product/revise/{{$al->PID}}">{{$al->ProductCode}}</a></td>
              <td><a href="/product/revise/{{$al->PID}}">{{$al->ProductName}}</a></td>
              <td> {{$al->ProductNames}}</td>
              <td  style="max-width: 100px;max-height:15px;overflow: hidden;line-height: 15px"> {{$al->ProductDesc}}</td>
              <td>已审核</td>
              <td>已发布</td>

              </tr>
              @endforeach
              </table>
    </tbody>

        <div class="row">
          <div class="col-sm-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
              共 <?php echo $list->total(); ?> 条
            </div>
          </div>
          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                {!! $list->appends($keyword)->render() !!}
            </div>
          </div>
        </div>
    </div>
  </div><!-- /.box-body -->

      <script language="javascript">
          $(document).ready(function(){
                $("#delaction").click(function(){
                    var ids="";


                    $("input[name=selected]:checked").each(function(){


                              ids+=$(this).val()+',';

                    });

                    if(ids == "")
                    {
                        alert('请选择你操作的产品');
                        return;
                    }
                    $("#pids").val(ids);
                    $("#actionname").val('delete');
                    $("#FormView").submit();
                });
          });
          </script>
@include('message')
@stop