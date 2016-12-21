@extends('layout.adminlte')
@section('content')
<div class="box box-primary">
  <div class="row">
    <div class="col-lg-12">
      <div class="ibox-title">
        <h5>轮显广告</h5>
        
      </div>
      <div>
        <form role="form" class="form-inline" action='/sitespell/index' method='get'>
          <div class="col-sm-12 m-b-xs">
            <div class="form-group">
              <label>标题：</label>
              <input type="标题"  class="form-control" placeholder="主题" name='title' @if(isset($input['title']))value={{$input['title']}}@endif>
            </div>
            <div class="form-group">
              <label>国家：</label>
              <select class="input-sm form-control input-s-sm inline" name="country">
                <option value="0">请选择</option>
                @foreach($countrys as $key => $country)
                <option value={{$key}} @if(isset($input['country']) && $input['country']==$key)selected='selected'@endif>{{$country->CountryName}}</option>
                @endforeach
              </select>
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
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="/sitespell/create">添加轮显广告</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">轮显广告列表</h3>
  </div><!-- /.box-header -->

  <div class="row">
  <div class="col-lg-12">
    <div class="dataTable_wrapper">
      <form action="" method="post" id="FormView">
      <table class="table table-striped table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th><input type="checkbox" id="checkall"></th>
            <th>主题</th>
            <th>排序</th>
            <th>国家</th>
            <th>图片Url</th>
            <th>链接地址</th>
            <th>是否禁用</th>
            <th>有效期限</th>
            <!--<th>缩略图</th>-->
            <th>审核</th>
            <th>发布</th>
          </tr>
        </thead>
        <tbody>
        @foreach($siteSpells as $siteSpell)
          <tr class="list">
            <td><input type="checkbox" name="id[]" class="checkname" value="{{ $siteSpell->SiteID }}"></td>
            <td><a href="{{URL::action('SiteSpellController@edit',['id'=>$siteSpell->SiteID])}}">{{ $siteSpell->Title }}</a></td>
            <td>{{ $siteSpell->OrderNo }}</td>
            <td>{{ $countrys[$siteSpell->Language]->CountryName }}</td>
            <td>{{ $siteSpell->ImgUrl }}</td>
            <td>{{ $siteSpell->LinkUrl }}</td>
            <td>{{ $siteSpell->IsDisable }}</td>
            <td>{{ $siteSpell->ExpireTime }}</td>
            <!--<td>{{ $siteSpell->ImgUrl }}</td>-->
            <td>审核</td>
            <td>{{ $siteSpell->IsDisable }}</td>
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
                    <option value="/sitespell/delete">删除</option>
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
      每页{{ $siteSpells->count() }}条,共{{ $siteSpells->lastPage() }}页,总{{ $siteSpells->total() }}条.
    </div>
    <div class="col-sm-5" style="float:right; text-align:right">
      {!! $siteSpells->appends($input)->render() !!}
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