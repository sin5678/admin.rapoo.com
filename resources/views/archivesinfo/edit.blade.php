@extends('layout.adminlte')
@section('content')
<script>
  window.onload = function () { 
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
  }
</script>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>新闻归档查看</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="/archivesinfo/update/{{$archivesInfo->ArchivesID}}" method="post"  enctype="multipart/form-data" id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">归档编码</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ArchivesCode"  value="{{$archivesInfo->ArchivesCode}}" placeholder="编码" nullmsg="请填写编码" datatype="*" >
        </div>
         <label class="col-sm-1 control-label">归档名称</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ArchivesName"  value="{{$archivesInfo->ArchivesName}}" placeholder="名称" nullmsg="请填写称" datatype="*" >
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">归档描述</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ArchivesDesc"  value="{{$archivesInfo->ArchivesDesc}}" >
        </div>
        <label class="col-sm-1 control-label">归档备注</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Remark"  value="{{$archivesInfo->Remark}}" >
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

<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">新闻归档</h3>
  </div>

  <div class="row">
  <div class="col-lg-12">
    <div class="dataTable_wrapper">
      <table class="table table-striped table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>新闻标题</th>
          </tr>
        </thead>
        <tbody>
        @foreach($newsArchives as $newArchives)
          <tr class="list">
            <td>{{ $newArchives->title }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-sm-5 pull-left" style="margin-top:30px;">
      每页{{ $newsArchives->count() }}条,共{{ $newsArchives->lastPage() }}页,总{{ $newsArchives->total() }}条.
    </div>
    <div class="col-sm-5" style="float:right; text-align:right">
      {!! $newsArchives->render() !!}
    </div>
  </div>
</div>
</div>
@include('message')
@stop