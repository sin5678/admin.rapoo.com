@extends('layout.adminlte')
@section('content')
<script>
  window.onload = function () { 
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
  }
</script>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>轮显广告增加</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="store" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">主标题</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Title" placeholder="主标题" nullmsg="请填写主标题" datatype="*" >
        </div>
        <label class="col-sm-1 control-label">国家</label>
        <div class="col-sm-4">
          <select name="Language" id="selNewsType">
            @foreach($countrys as $country)
            <option value="{{$country->EnglishShort}}">{{$country->CountryName}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">副标题</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="NewTypeName">
        </div>
        <label class="col-sm-1 control-label">链接地址</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="LinkUrl">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">概要描述</label>
        <div class="col-sm-4">
          <textarea name="ProfileDesc"  class="col-sm-12"></textarea>
        </div>
        <label class="col-sm-1 control-label">轮显图片</label>
        <div class="col-sm-5">
          <input type="file" class="form-control" name="ImgUrl" id="up_img" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">备注</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Remark">
        </div>
        <label class="col-sm-1 control-label">禁用</label>
        <div class="col-sm-5">
          <input type="radio" name="IsDisable" value="0" checked="checked"> 启用
          <input type="radio" name="IsDisable" value="1" > 禁用
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">排序</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="OrderNo">
        </div>
        <!-- <label class="col-sm-1 control-label">有限期限</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="ExpireTime">
        </div> -->
        <div class="form-group date"  id="data_1">
          <label class="col-sm-1 control-label">有限期限</label>
          <div class="col-sm-4">
            <div class="input-group date">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" class="form-control" name='ExpireTime'>
            </div>
          </div>
        </div>

      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">打开方式</label>
        <div class="col-sm-10">
          <select name="Target" id="selTarget" class="InputBox">
            <option value="_self">本窗口</option>
            <option value="_blank">新窗口</option>
          </select>
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
<script>
  $(function(){
    $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
  })
</script>
@stop