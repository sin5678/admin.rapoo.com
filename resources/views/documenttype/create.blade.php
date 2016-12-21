@extends('layout.adminlte')
@section('content')
<script>
  window.onload = function () { 
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
  }
</script>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>添加资料类型信息</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="store" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">资料类型编码</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="DocumentTypeCode" placeholder="编码" nullmsg="请填写编码" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">资料类型名称</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="DocumentTypeName" placeholder="类型名称" nullmsg="请填写资料类型名称" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">资料类型英文名</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="DocumentTypeEnName" placeholder="类型英文名" nullmsg="请填写资料类型英文名" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">资料类型繁体</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="DocumentTypeTwName" placeholder="类型繁体名" nullmsg="请填写资料类型繁体" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">备注</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="Remark" >
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
@stop