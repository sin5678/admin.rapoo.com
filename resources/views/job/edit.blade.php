@extends('layout.adminlte')
@section('content')
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>添加招聘</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="/job/update/{{$job->JoinID}}" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">招聘职位</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Position" placeholder="职位名称" nullmsg="请填写职位" datatype="*" value="{{$job->Position}}">
        </div>
        <label class="col-sm-1 control-label">部门</label>
        <div class="col-sm-4">
          <select name="DeptName" id="ddlDepartMent">
          <option @if($job->DeptName=='总经办')selected="selected"@endif value="总经办">总经办</option>
          <option @if($job->DeptName=='研发中心')selected="selected"@endif value="研发中心">　研发中心</option>
          <option @if($job->DeptName=='方案开发部')selected="selected"@endif value="方案开发部">　　方案开发部</option>
          <option @if($job->DeptName=='项目管理部')selected="selected"@endif value="项目管理部">　　项目管理部</option>
          <option @if($job->DeptName=='工业设计部')selected="selected"@endif value="工业设计部">　　工业设计部</option>
          <option @if($job->DeptName=='平面设计部')selected="selected"@endif value="平面设计部">　　平面设计部</option>
          <option @if($job->DeptName=='产品开发部')selected="selected"@endif value="产品开发部">　　产品开发部</option>
          <option @if($job->DeptName=='研发平台部')selected="selected"@endif value="研发平台部">　　研发平台部</option>
          <option @if($job->DeptName=='智能终端产品部')selected="selected"@endif value="智能终端产品部">　　智能终端产品部</option>
          <option @if($job->DeptName=='制造中心')selected="selected"@endif value="制造中心">　制造中心</option>
          <option @if($job->DeptName=='资材部')selected="selected"@endif value="资材部">　　资材部</option>
          <option @if($job->DeptName=='工模部')selected="selected"@endif value="工模部">　　工模部</option>
          <option @if($job->DeptName=='塑胶部')selected="selected"@endif value="塑胶部">　　塑胶部</option>
          <option @if($job->DeptName=='电子部')selected="selected"@endif value="电子部">　　电子部</option>
          <option @if($job->DeptName=='一体化装配部')selected="selected"@endif value="一体化装配部">　　一体化装配部</option>
          <option @if($job->DeptName=='自动化开发部')selected="selected"@endif value="自动化开发部">　　自动化开发部</option>
          <option @if($job->DeptName=='工程部')selected="selected"@endif value="工程部">　　工程部</option>
          <option @if($job->DeptName=='品管部')selected="selected"@endif value="品管部">　　品管部</option>
          <option @if($job->DeptName=='产品技术部')selected="selected"@endif value="产品技术部">　　产品技术部</option>
          <option @if($job->DeptName=='营销中心')selected="selected"@endif value="营销中心">　营销中心</option>
          <option @if($job->DeptName=='市场部')selected="selected"@endif value="市场部">　　市场部</option>
          <option @if($job->DeptName=='国内销售部')selected="selected"@endif value="国内销售部">　　国内销售部</option>
          <option @if($job->DeptName=='电子商务部')selected="selected"@endif value="电子商务部">　　　电子商务部</option>
          <option @if($job->DeptName=='IT销售部')selected="selected"@endif value="IT销售部">　　　IT销售部</option>
          <option @if($job->DeptName=='KA销售部')selected="selected"@endif value="KA销售部">　　　KA销售部</option>
          <option @if($job->DeptName=='海外销售部')selected="selected"@endif value="海外销售部">　　海外销售部</option>
          <option @if($job->DeptName=='亚太销售部')selected="selected"@endif value="亚太销售部">　　　亚太销售部</option>
          <option @if($job->DeptName=='欧美销售部')selected="selected"@endif value="欧美销售部">　　　欧美销售部</option>
          <option @if($job->DeptName=='销售平台部')selected="selected"@endif value="销售平台部">　　销售平台部</option>
          <option @if($job->DeptName=='销售支持部')selected="selected"@endif value="销售支持部">　　　销售支持部</option>
          <option @if($job->DeptName=='客服部')selected="selected"@endif value="客服部">　　　客服部</option>
          <option @if($job->DeptName=='商务部')selected="selected"@endif value="商务部">　　　商务部</option>
          <option @if($job->DeptName=='信息技术部')selected="selected"@endif value="信息技术部">　信息技术部</option>
          <option @if($job->DeptName=='财务部')selected="selected"@endif value="财务部">　财务部</option>
          <option @if($job->DeptName=='总部')selected="selected"@endif value="总部">　　总部</option>
          <option @if($job->DeptName=='子（分）公司')selected="selected"@endif value="子（分）公司">　　子（分）公司</option>
          <option @if($job->DeptName=='人力资源部')selected="selected"@endif value="人力资源部">　人力资源部</option>
          <option @if($job->DeptName=='行政部')selected="selected"@endif value="行政部">　行政部</option>
          <option @if($job->DeptName=='采购部')selected="selected"@endif value="采购部">　采购部</option>
          <option @if($job->DeptName=='外联')selected="selected"@endif value="外联">　外联</option>

        </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">职位要求</label>
        <div class="col-sm-9">
          <textarea name="Content">{{$job->Content}}</textarea>
          <script type="text/javascript">CKEDITOR.replace('Content');</script>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">招聘人数</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Number" value="{{$job->Number}}">
        </div>
        <label class="col-sm-1 control-label">工作经验</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="WorkExperience" value="{{$job->WorkExperience}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">薪酬</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Salary" value="{{$job->Salary}}">
        </div>
        <label class="col-sm-1 control-label">工作地址</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="WorkPlace" value="{{$job->WorkPlace}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">联系人</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ContactUser"  value="{{$job->ContactUser}}">
        </div>
        <label class="col-sm-1 control-label">联系电话</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ContactPhone"  value="{{$job->ContactPhone}}">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">联系地址</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Addr"  value="{{$job->Addr}}">
        </div>
        <label class="col-sm-1 control-label">联系邮箱</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Email"  value="{{$job->Email}}">
        </div>
      </div>
      <div class="form-group" id="data_1">
        <label class="col-sm-1 control-label">过期时间</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name='Expire' value="{{$job->Expire}}">
          </div>
        </div>
        <label class="col-sm-1 control-label">创建人</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CreateUser" value="{{$job->CreateUser}}">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">备注</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="remark"  value="{{$job->remark}}">
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