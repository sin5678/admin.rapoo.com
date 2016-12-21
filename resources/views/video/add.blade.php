@extends('layout.adminlte')
@section('content')

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>添加视频</h5>
  </div>
  <div class="ibox-content">
 
    <form class="form-horizontal"  action="/video/save" method="post"  enctype="multipart/form-data"  id="FormView">
        <div class="box-header">
        <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="javascript:{}" id="videoSavaBtn">保存</a>
        <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px;" href="/video">返回</a>
         <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px"> 添加视频信息</h3>
      </div>
      <table  id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <tbody><tr>
          <td style="width: 11%;">
            视频名称
          </td>
          <td style="width: 39%;" >
            <input name="VideoName" id="txtvideoCode" class="InputBox"  class="form-control Validform_error" placeholder="请输入视频名称" nullmsg="请输入视频名称" datatype="*"  style="width: 96%" value="" type="text"><em>*</em> 
                  
          </td>
          <td style="width: 11%;">
            视频类型
          </td>
          <td style="width: 39%;">
           <select id="selLinkMode" style="width: 100px;" name="VideoType">
              <option value="1" >产品视频</option>
              <option value="2">活动宣传视频</option>
            </select>
          </td>
        </tr>
        <tr id="trUserPwd">
          <td>
            视频ID:
          </td>
          <td>
            <input name="VideoPath" id="VideoPath"  style="cursor: pointer; width: 96%"  type="text" placeholder="请输入视频ID" nullmsg="请输入视频ID" datatype="*" value="" >
            <em>*</em>
          </td>
          <td>
              视频缩略图：
          </td>
          <td >
           <table border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td style="width: 130px;">
                  <input name="ThumbImg" id="fileSpecialtyImg" class="InputBox"  type="file">

                </td>

              </tr>
              </tbody></table>
          </td>
        </tr>

        <tr>

          <td>
            视频描述
          </td>
          <td>

            <textarea name="VideoDesc" id="tareavideoDesc" rows="2" cols="40"  class="form-control Validform_error" placeholder="请输入视频描述" nullmsg="请输入视频描述"  style="width: 100%"></textarea>
          </td>
        </tr>
        <tr>
          <td>
            视频作者
          </td>
             <td style="width: 39%;">
            <input name="VideoAthor" id="txtvideoCode" class="InputBox"  class="form-control Validform_error" placeholder="请输入视频作者" nullmsg="请输入视频作者"   type="text" style="width: 100%" value="">
          </td>
          <td>
            过期时间
          </td>
          <td id="data_1">
      <div class="col-sm-5">
        <div class="input-group date">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="text" class="form-control" name='ExpireTime'>
        </div>
      </div>
          </td>

        </tr>
        <tr>
          <td>
            国家地区：
          </td>
          <td>
             <div style=" overflow:scroll; height:200px;" class="col-sm-12">
            @foreach($areas as $area)
            <div class="col-sm-2"><input type="radio" name="txtAreaName" class="areaname-{{ isset($area->AreaID) }}" value="{{implode(",",$areaCountrys[isset($area->AreaID)])}}">{{$area->AreaName}}</div>
            @endforeach
            <br>
            <div class="hr-line-dashed"></div>
            @foreach($countrys as $country)
            <div class="col-sm-2"><input type="checkbox" name="txtCountryName[]" class="txtDistributeName-{{$country->CountryID}}" value="{{$country->CountryID}},{{$country->CountryName}}"><!--<img src="/images/flag/{{$country->EnglishName}}.gif">-->{{$country->CountryName}}</div>
            @endforeach
          </div>
          </td>
          <td>
            备注：
          </td>
          <td>
            <textarea name="Remark" id="tareavideoDesc" rows="2" cols="40"  class="form-control Validform_error" placeholder="请输入备注" nullmsg="请输入备注" style="width: 100%" ></textarea>
          </td>
        </tr>
        </tbody>
      </table>
    </form>
  </div>
  </div>
</div>

<script language="javascript">

  $("#videoSavaBtn").click(function()
  {
      $("#FormView").submit();
  });
</script>

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