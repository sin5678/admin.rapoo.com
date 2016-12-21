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
    <form class="form-horizontal"  action="/articles/update/{{$article->NewID}}" method="post"  enctype="multipart/form-data" id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻概要图</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="title" value="{{$article->title}}" placeholder="标题" nullmsg="请填写标题" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">发布地域</label>
        <div class="col-sm-10">
          <div style=" overflow:scroll; height:200px;" class="col-sm-10">
            @foreach($areas as $area)
            <div class="col-sm-2"><input type="radio" name="txtAreaName" class="areaname-{{$area->AreaID}}"  @if(isset($areaCountrys[$area->AreaID]))) value="{{implode(",",$areaCountrys[$area->AreaID])}}" @endif>{{$area->AreaName}}</div>
            @endforeach
            <br>
            <div class="hr-line-dashed"></div>
            @foreach($countrys as $country)
            <div class="col-sm-2"><input type="checkbox" name="txtCountryName[]" class="txtDistributeName-{{$country->CountryID}}" value="{{$country->CountryID}},{{$country->CountryName}}"  @if(in_array($country->CountryID, $infoDistributes)) checked="checked" @endif>{{$country->CountryName}}</div>
            @endforeach
          </div>

        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻概要图</label>
        <div class="col-sm-10">
          <div id="imgdiv"><img id="imgShow" @if($article->ProfileImg) src="{{$article->ProfileImg}}" @endif/></div>
          <input type="file" class="form-control" name="ProfileImg" id="up_img" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻内容</label>
        <div class="col-sm-10">
          <textarea name="content">{{$article->content}}</textarea>
          <script type="text/javascript">CKEDITOR.replace('content');</script>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">创建人</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CreateUser" value="{{$article->CreateUser}}" disabled="disabled">
        </div>
        <label class="col-sm-1 control-label">创建时间</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CreateTime" value="{{$article->CreateTime}}" disabled="disabled">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group date"  id="data_1">
        <label class="col-sm-1 control-label">过期时间</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name='ExpireTime'  value="{{$article->ExpireTime}}">
          </div>
        </div>
        <label class="col-sm-1 control-label">活动时间</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name='ActiveTime'  value="{{$article->ActiveTime}}">
          </div>
        </div>
      </div>

      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">新闻类型</label>
        <div class="col-sm-8">
          <select name="NewType" id="selNewsType">
            <option selected="selected" value="1">公司新闻</option>
            <option value="2">活动新闻</option>
            <option value="3">产品发布</option>
            <option value="4">行业动态</option>
            <option value="5">媒体测评</option>
            <option value="6">投资者关系</option>
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
@include('message')
@stop