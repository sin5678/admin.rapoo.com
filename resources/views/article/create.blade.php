@extends('layout.adminlte')
@section('content')
<script>
  window.onload = function () { 
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
  }
</script>
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>添加文章</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="store" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻标题</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="title" placeholder="标题" nullmsg="请填写标题" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">发布地域</label>
        <div class="col-sm-10">
          <div style=" overflow:scroll; height:200px;" class="col-sm-12">
            @foreach($areas as $area)
            <div class="col-sm-2"><input type="radio" name="txtAreaName" class="areaname-{{$area->AreaID}}" @if(isset($areaCountrys[$area->AreaID]))) value="{{implode(",",$areaCountrys[$area->AreaID])}}" @endif>{{$area->AreaName}}</div>
            @endforeach
            <br>
            <div class="hr-line-dashed"></div>
            @foreach($countrys as $country)
            <div class="col-sm-2"><input type="checkbox" name="txtCountryName[]" class="txtDistributeName-{{$country->CountryID}}" value="{{$country->CountryID}},{{$country->CountryName}}"><!--<img src="/images/flag/{{$country->EnglishName}}.gif">-->{{$country->CountryName}}</div>
            @endforeach
          </div>

        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻概要图</label>
        <div class="col-sm-10">
          <div id="imgdiv"><img id="imgShow"/></div>
          <input type="file" class="form-control" name="ProfileImg" id="up_img" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻内容</label>
        <div class="col-sm-10">
          <textarea name="content"></textarea>
          <script type="text/javascript">CKEDITOR.replace('content');</script>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">创建人</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" readonly="readonly" value="<?php echo Auth::user()->account;?>">
          <input type="hidden" class="form-control" name="CreateUser" value="<?php echo Auth::user()->id;?>">
        </div>
        <label class="col-sm-1 control-label">创建时间</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" readonly="readonly" value="<?php echo date("Y-m-d H:i:s");?>">
          <input type="hidden" class="form-control" name="CreateTime" value="<?php echo date("Y-m-d H:i:s");?>">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group date"  id="data_1">
        <label class="col-sm-1 control-label">过期时间</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name='ExpireTime'>
          </div>
        </div>
        <label class="col-sm-1 control-label">活动时间</label>
        <div class="col-sm-5">
          <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name='ActiveTime'>
          </div>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻类型</label>
        <div class="col-sm-9">
          <select name="NewType" id="selNewsType">
            @foreach($newTypes as $newType)
            <option value="{{$newType->NewTypeID}}">{{$newType->NewTypeName}}</option>
            @endforeach
          </select>
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
    $("input[name='txtAreaName']").click(function(){
      value = $(this).val();
      var arr1 = value.split(",");
      $("input[name^='txtCountryName']").attr("checked",false);
      $.each(arr1, function(i,val){
        $(".txtDistributeName-"+val).prop("checked", true);
      });
      
    })
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