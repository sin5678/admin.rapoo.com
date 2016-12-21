@extends('layout.adminlte')
@section('content')
<div class="box box-primary">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox-title">
        <h5>代理商管理</h5>
        
      </div>
      <div>
        <form role="form" class="form-inline" action='index' method='get'>
          <div class="col-sm-12 m-b-xs">
            <div class="form-group">
              <label>标题：</label>
              <input type="公司名称"  class="form-control" placeholder="公司名称" name='companyname' @if(isset($input['companyname']))value={{$input['companyname']}}@endif>
            </div>
            <input type="hidden" name="action" value="search">
            <button class="btn btn-w-m btn-primary" type="submit">搜索</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="box box-primary">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/proxy/create">添加代理商</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">代理商列表</h3>
  </div><!-- /.box-header -->

  <div class="row">
  <div class="col-lg-12">
    <div class="dataTable_wrapper">
      <form action="" method="post" id="FormView">
      <table class="table table-striped table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkall"></th>
            <th>网点类型</th>
            <th>所属区域</th>
            <th>公司名称</th>
            <th width='20%' >网站地址</th>
            <th>经度</th>
            <th>纬度</th>
          </tr>
        </thead>
        <tbody>
        @foreach($list as $val)
          <tr class="list">
            <td><input type="checkbox" name="id[]" class="checkname" value="{{ $val->ProxyID }}"></td>
            <td><a href='{{URL::action('ProxyController@edit', ['id'=>$val->ProxyID])}}'>{{ $webSiteTypeArr[$val->WebsiteType] }}</a></td>
            <td>{{ $areaArr[$val->Area] }}</td>
            <td>{{ $val->CompanyName }}</td>
            <td width='20%' style="display: block;word-break: break-all;">{{ $val->CompanyUrl }}</td>
            <td>{{ $val->lat }}</td>
            <td>{{ $val->lng }}</td>
           
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
                    <option value="delete">删除</option>
                  </select>
                </div>
                <div class="col-md-4">
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
      每页{{ $list->count() }}条,共{{ $list->lastPage() }}页,总{{ $list->total() }}条.
    </div>
    <div class="col-sm-5" style="float:right; text-align:right">
      {!! $list->appends($input)->render() !!}
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