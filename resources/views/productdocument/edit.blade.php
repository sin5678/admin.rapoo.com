@extends('layout.adminlte')
@section('content')
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>编辑资料类型信息</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="/productdocument/update/{{$productDocument->DocumentID}}" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">资料名称</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="DocumentName" placeholder="资料名称" nullmsg="请填写资料名称" datatype="*" value="{{$productDocument->DocumentName}}">
        </div>
        <label class="col-sm-1 control-label">资料类型</label>
        <div class="col-sm-5">
          <select class="input-sm form-control input-s-sm inline" name="DocumentType">
          @foreach($documentTypes as $documentType)
            <option value="{{$documentType->DocumentTypeID}}" @if($productDocument->DocumentType == $documentType->DocumentTypeID) selected="selected" @endif>{{$documentType->DocumentTypeName}}</option>
          @endforeach
        </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">产品型号</label>
        <div class="col-sm-5" style=" overflow:scroll; height:200px;">
          @foreach($products as $product)
            <div class="col-sm-2"><input type="checkbox" name="PIDs[]" value="{{$product->PID}}" @if(in_array($product->PID, $productDocument->PIDs)) checked="checked" @endif>{{$product->ProductCode}}</div>
          @endforeach
        </div>
        <label class="col-sm-1 control-label">选择国家</label>
        <div class="col-sm-5">
          <div style=" overflow:scroll; height:200px;" class="col-sm-12">
            @foreach($areas as $area)
            <div class="col-sm-2"><input type="radio" name="txtAreaName" class="areaname-{{$area->AreaID}}"  @if(isset($areaCountrys[$area->AreaID]))) value="{{implode(",",$areaCountrys[$area->AreaID])}}" @endif>{{$area->AreaName}}</div>
            @endforeach
            <br>
            <div class="hr-line-dashed"></div>
            @foreach($countrys as $country)
            <div class="col-sm-2"><input type="checkbox" name="txtCountryName[]" class="txtDistributeName-{{$country->CountryID}}" value="{{$country->EnglishShort}}" @if(in_array($country->EnglishShort, $productDocument->Language)) checked="checked" @endif>{{$country->CountryName}}</div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">资料描述</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="DocumentDesc" placeholder="资料描述" nullmsg="请填写资料描述" datatype="*"  value="{{$productDocument->DocumentDesc}}">
        </div>
        <label class="col-sm-1 control-label">资料文件</label>
        <div class="col-sm-5">
          <input type="file" class="form-control" name="DocumentAttachment" value="{{$productDocument->DocumentAttachment}}">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">备注</label>
        <div class="col-sm-11">
          <input type="text" class="form-control" name="Remark"  value="{{$productDocument->Remark}}">
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