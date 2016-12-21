@extends('layout.adminlte')
@section('content')
<div class="box box-primary">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox-title">
        <h5>@if(isset($input['servicetype']) && $input['servicetype'] == 1) 维修网点 @else 国内代理 @endif</h5>
        
      </div>
      <div>
        <form role="form" class="form-inline" action='/supply/index' method='get'>
          <div class="col-sm-12 m-b-xs">
            <div class="form-group">
              <label>标题：</label>
              <input type="公司名称"  class="form-control" placeholder="公司名称" name='companyname' @if(isset($input['companyname']))value={{$input['companyname']}}@endif>
            </div>
            <input type="hidden" name="action" value="search">
            <input type="hidden" name="servicetype" value="@if(isset($input['servicetype'])) {{$input['servicetype']}} @else 1 @endif)">
            <button class="btn btn-w-m btn-primary" type="submit">搜索</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-primary">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/supply/create?servicetype=1">添加维修网点</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">维修网点列表</h3>
  </div><!-- /.box-header -->

  <div class="row">
  <div class="col-lg-12">
    <div class="dataTable_wrapper">
      <form action="" method="post" id="FormView">
      <table class="table table-striped table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkall"></th>
            <th>省份</th>
            <th>联系人</th>
            <th>电话</th>
            <th>地址</th>
            <th>名称</th>
            <th>是否禁用</th>
          </tr>
        </thead>
        <tbody>
        @foreach($supplies as $supply)
          <tr class="list">
            <td><input type="checkbox" name="id[]" class="checkname" value="{{ $supply->ServiceID }}"></td>
            <td><a href="{{URL::action('SupplyController@edit',['id'=>$supply->ServiceID,'servicetype' => $input['servicetype']])}}">{{ $supply->ProvinceName }}</a></td>
            <td>{{ $supply->Contact }}</td>
            <td>{{ $supply->ContactPhone }}</td>
            <td>{{ $supply->Addr }}</td>
            <td>{{ $supply->CompanyName }}</td>
            <td>@if($supply->IsDisable == 0) 启用 @else 禁用 @endif</td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <table class="table table-striped table-hover" id="dataTables-example">
          <tr>
            <td>
              <div class="row">
                <div class="col-md-2">
                  <select class="form-control m-b"  id="selectOption">
                    <option value="0">请选择...</option>
                    <option value="/supply/delete">删除</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <input type="hidden" name="servicetype" value="@if(isset($input['servicetype'])) {{$input['servicetype']}} @else 1 @endif)">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input name="submit" class="btn btn-w-m btn-primary" type="submit" value="执行" id="submit"/>
                </div>
              </div>
            </td>
          </tr>
      </table>
      </form>
    </div>
    <div class="col-sm-5 pull-left" style="margin-top:30px;">
      每页{{ $supplies->count() }}条,共{{ $supplies->lastPage() }}页,总{{ $supplies->total() }}条.
    </div>
    <div class="col-sm-5" style="float:right; text-align:right">
      {!! $supplies->appends($input)->render() !!}
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