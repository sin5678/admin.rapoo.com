@extends('layout.adminlte')
@section('content')
<div class="box box-primary">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox-title">
        <h5>产品翻译</h5>
        
      </div>
         <div class="row" style="border: 1px #cccccc;background: #f5f5f5;padding: 10px;margin: 10px">
      <div class="col-sm-1">
     搜索产品：
        </div>
        <form class="form-horizontal" action="/producttranslate/action" method="get"   id="FormView">
        <div class="col-sm-2">
          {!! csrf_field() !!}
            <input type="text" class="form-control" placeholder="产品名称" name="keyword" value="">
             <input type="hidden" name="action" id="actionname" value="search">
             <input type="hidden" name="pids"   id="pids" value="0">
        </div>
      <div class="col-sm-1">
          <button class="btn btn-w-m btn-primary" type="submit">搜索</button>
        </div>

            <div class="col-sm-2">   <a class="btn btn-w-m btn-primary"   style="float: left" href="/producttranslate">取消搜索</a>
                </div>

        </form>
    </div>
    </div>
  </div>
</div>
<div class="box box-primary">
 
  <div class="row">
  <div class="col-lg-12">
    <div class="dataTable_wrapper">
      <form action="" method="post" id="FormView">
      <table class="table table-striped table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkall"></th>
            <th>产品型号</th>
            <th>产品名称</th>
            <th>产品分类</th>
            <th>产品分布</th>
            <th>产品描述</th>
            <th>审核</th>
            <th>发布</th>
          </tr>
        </thead>
        <tbody>
        @foreach($list as $ba)
          <tr class="list">
            <td><input type="checkbox" name="id[]" class="checkname" value="{{ $ba->PID }}"></td>
            <td><a href="/producttranslate/edit/{{$ba->PID}}">{{ $ba->ProductCode }}</a></td>
            <td>{{ $ba->ProductName }}</td>
            <td>{{ $ba->ProductNames }}</td>
            <td>{{ $ba->ProductDistributeCountryNames }}</td>
            <td>{{ $ba->ProductDesc }}</td>
            <td>是</td>
            <td><span style="color:green;">已发布</span></td>
          </tr>
        @endforeach
        </tbody>
      </table>

      </form>
    </div>

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
</div>
</div>

@include('message')
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#checkall").click(function(){    
            if(this.checked){    
                $(".list :checkbox").prop("checked", true);   
            }else{    
                $(".list :checkbox").prop("checked", false); 
            }    
        })
        $("#submit").click(function(){
          var valArr = [];
          $(".list :checkbox").each(function(i){
              if($(this).is(':checked')){
                valArr.push($(this).val());
              }
          })
          var vals = valArr.join(',');//转换为逗号隔开的字符串 
          if(vals == ''){
            alert('没有选中文章列表，请重试');return false;
          } 
          if($("#selectOption").val() == 0){
            alert('请选择您要执行的操作');return false;
          }
          $("#FormView").submit();
        })
        $("#selectOption").change(function(){
          $("#FormView").attr("action", $("#selectOption").val());
        })
      });
      
    </script>
@stop