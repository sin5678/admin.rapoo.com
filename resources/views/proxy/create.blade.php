@extends('layout.adminlte')
@section('content')
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>代理商新增</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="store" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      
      
      <div class="form-group">
        <label class="col-sm-1 control-label">网站类型</label>
        <div class="col-sm-4">
          <select name="WebsiteType" id="WebsiteType" class="form-control">
            @foreach($webSiteTypeArr as  $key=>$val)
            <option value="{{$key}}">{{$val}}</option>
            @endforeach
          </select>
        </div>
        <label class="col-sm-1 control-label">所在区域</label>
        <div class="col-sm-5">
          <select name="Area" id="Area" class="form-control">
            @foreach($areaArr as  $key=>$val)
            <option value="{{$key}}">{{$val}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">公司名称</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CompanyName" nullmsg="请填写公司名称" datatype="*"/>
        </div>
        <label class="col-sm-1 control-label">网站地址</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="CompanyUrl">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">公司地址</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CompanyAddr">
        </div>
        <label class="col-sm-1 control-label">公司简址</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="CompanyShortAddr">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">公司电话</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Phone">
        </div>
        <label class="col-sm-1 control-label">传真</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="Fax">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">Email：</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Email">
        </div>
        <label class="col-sm-1 control-label">国家：</label>
        <div class="col-sm-5">
       	 <select name="Language" id="Area" class="form-control">
            @foreach($countryList as  $key=>$val)
            <option value="{{$val->EnglishShort}}">{{$val->CountryName}}</option>
            @endforeach
          </select>
          
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
      <div class="form-group">
        <label class="col-sm-1 control-label">logo</label>
        <div class="col-sm-10">
          <div id="imgdiv"><img id="imgShow"/></div>
          <input type="file" class="form-control" name="Icon" id="up_img" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">图片展示</label>
        <div class="col-sm-10">
          <div id="imgdiv"><img id="imgShow"/></div>
          <input type="file" class="form-control" name="ShowImg" id="up_img" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">公司详情</label>
        <div class="col-sm-10">
          <textarea name="CompanyDetail" ></textarea>
          <script type="text/javascript">CKEDITOR.replace('CompanyDetail');</script>
        </div>
      </div>
      
      
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