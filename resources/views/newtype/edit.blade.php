@extends('layout.adminlte')
@section('content')
<script>
  window.onload = function () { 
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
  }
</script>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>编辑文章</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="/newtype/update/{{$newType->NewTypeID}}" method="post"  enctype="multipart/form-data" id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻类型编码</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="NewTypeCode"  value="{{$newType->NewTypeCode}}" placeholder="编码" nullmsg="请填写编码" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻类型名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="NewTypeName"  value="{{$newType->NewTypeName}}" placeholder="类型名称" nullmsg="请填写新闻类型名称" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻类型英文名</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="NewTypeEnName"  value="{{$newType->NewTypeEnName}}" placeholder="类型英文名" nullmsg="请填写新闻类型英文名" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻类型繁体</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="NewTypeTwName"  value="{{$newType->NewTypeTwName}}" placeholder="类型繁体名" nullmsg="请填写新闻类型繁体" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">备注</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="remark"  value="{{$newType->remark}}">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <div class="col-sm-4 col-sm-offset-1">
          <button class="btn btn-primary" type="submit">提交</button>
          <button class="btn btn-white" type="submit">重置</button>
        </div>
      </div>
    </form>
  </div>
</div>
@include('message')
@stop