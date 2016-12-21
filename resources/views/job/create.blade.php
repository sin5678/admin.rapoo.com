@extends('layout.adminlte')
@section('content')
<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>添加招聘</h5>
  </div>
  <div class="ibox-content">
    <form class="form-horizontal"  action="store" method="post"  enctype="multipart/form-data"  id="FormView">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="form-group">
        <label class="col-sm-1 control-label">招聘职位</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Position" placeholder="职位名称" nullmsg="请填写职位" datatype="*" >
        </div>
        <label class="col-sm-1 control-label">部门</label>
        <div class="col-sm-4">
          <select name="DeptName" id="ddlDepartMent">
          <option selected="selected" value="总经办">总经办</option>
          <option value="研发中心">　研发中心</option>
          <option value="方案开发部">　　方案开发部</option>
          <option value="项目管理部">　　项目管理部</option>
          <option value="工业设计部">　　工业设计部</option>
          <option value="平面设计部">　　平面设计部</option>
          <option value="产品开发部">　　产品开发部</option>
          <option value="研发平台部">　　研发平台部</option>
          <option value="智能终端产品部">　　智能终端产品部</option>
          <option value="制造中心">　制造中心</option>
          <option value="资材部">　　资材部</option>
          <option value="工模部">　　工模部</option>
          <option value="塑胶部">　　塑胶部</option>
          <option value="电子部">　　电子部</option>
          <option value="一体化装配部">　　一体化装配部</option>
          <option value="自动化开发部">　　自动化开发部</option>
          <option value="工程部">　　工程部</option>
          <option value="品管部">　　品管部</option>
          <option value="产品技术部">　　产品技术部</option>
          <option value="营销中心">　营销中心</option>
          <option value="市场部">　　市场部</option>
          <option value="国内销售部">　　国内销售部</option>
          <option value="电子商务部">　　　电子商务部</option>
          <option value="IT销售部">　　　IT销售部</option>
          <option value="KA销售部">　　　KA销售部</option>
          <option value="海外销售部">　　海外销售部</option>
          <option value="亚太销售部">　　　亚太销售部</option>
          <option value="欧美销售部">　　　欧美销售部</option>
          <option value="销售平台部">　　销售平台部</option>
          <option value="销售支持部">　　　销售支持部</option>
          <option value="客服部">　　　客服部</option>
          <option value="商务部">　　　商务部</option>
          <option value="信息技术部">　信息技术部</option>
          <option value="财务部">　财务部</option>
          <option value="总部">　　总部</option>
          <option value="子（分）公司">　　子（分）公司</option>
          <option value="人力资源部">　人力资源部</option>
          <option value="行政部">　行政部</option>
          <option value="采购部">　采购部</option>
          <option value="外联">　外联</option>

        </select>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">职位要求</label>
        <div class="col-sm-9">
          <textarea name="Content"></textarea>
          <script type="text/javascript">CKEDITOR.replace('Content');</script>
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">招聘人数</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Number">
        </div>
        <label class="col-sm-1 control-label">工作经验</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="WorkExperience">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">薪酬</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Salary">
        </div>
        <label class="col-sm-1 control-label">工作地址</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="WorkPlace">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">联系人</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ContactUser" value="袁小姐">
        </div>
        <label class="col-sm-1 control-label">联系电话</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="ContactPhone" value="0755-88379966">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label">联系地址</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Addr" value="深圳市福田区福华三路卓越世纪中心4号楼3301-3305">
        </div>
        <label class="col-sm-1 control-label">联系邮箱</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="Email" value="yuanfang@rapoo.com">
        </div>
      </div>
      <div class="form-group date"  id="data_1">
        <label class="col-sm-1 control-label">过期时间</label>
        <div class="col-sm-4">
          <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name='Expire'>
          </div>
        </div>
        <label class="col-sm-1 control-label">创建人</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="CreateUser">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="form-group">
        <label class="col-sm-1 control-label">备注</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="remark" >
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