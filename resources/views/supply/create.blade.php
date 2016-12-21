@extends('layout.adminlte')
@section('content')
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>维修网站新增</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="store" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">省份</label>
        <div class="col-sm-4">
          <select name="ProvinceID" id="ProvinceID">
            @foreach($provinces as $province)
            <option value="{{$province->ProvinceID}}">{{$province->ProvinceName}}</option>
            @endforeach
          </select>
        </div>
        <label class="col-sm-1 control-label">联系人</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="Contact">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">名称</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CompanyName">
        </div>
        <label class="col-sm-1 control-label">简称</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="ShortName">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">电话</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ContactPhone">
        </div>
        <label class="col-sm-1 control-label">禁用</label>
        <div class="col-sm-5">
          <input type="radio" name="IsDisable" value=0>禁用
          <input type="radio" name="IsDisable" value=1>启用
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">地址</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="Addr">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">纬度</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="lng">
        </div>
        <label class="col-sm-1 control-label">经度</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="lat">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <input type="hidden" name="ServiceType" value="{{$input['servicetype']}}">
      <div class="form-group">
        <div class="col-sm-4 col-sm-offset-1">
          <button class="btn btn-primary" type="submit">提交</button>
          <button class="btn btn-white" type="submit">重置</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(function(){
    // $('.date').datepicker({
    //             todayBtn: "linked",
    //             keyboardNavigation: false,
    //             forceParse: false,
    //             calendarWeeks: true,
    //             autoclose: true
    //         });
  })
</script>
@stop