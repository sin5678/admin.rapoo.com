@extends('layout.adminlte')
@section('content')
    <div class="box">
        <div class="box-header">
            <a class="btn btn-w-m btn-warning" style="display:inline-block;width:100px;float:right;margin-right: 10px" href="/product/producttype_list">取消</a>
            <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px" id="btnSubmit" href="javascript:void;">保存</a>
            <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">编辑产品类型</h3>
        </div>

        <div class="box-body">
            <form class="form-horizontal" action="/product/producttype_editsave" method="post"   id="FormView">
                {!! csrf_field() !!}
                <input type="hidden" name="PTypeID" value="{{$type->PTypeID}}">
            <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
                    <div class="col-sm-6"></div></div>
                <div class="row">
                    <div class="col-sm-12">
                        <table border="0" cellpadding="2" cellspacing="2" id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <tbody><tr>
                                <td>分类名称：</td>
                                <td>
                                    <input name="PTypeName" id="PTypeName" class="InputBox" value="{{$type->PTypeName}}"   class="form-control Validform_error" placeholder="请输入分类名称" nullmsg="请输入分类名称" datatype="*" type="text"><em>*</em>
                                    <span id="spantxtPTypeName"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>分类英文名：</td>
                                <td>
                                    <input name="PTypeNaemEn" id="PTypeNaemEn" class="InputBox"  value="{{$type->PTypeNaemEn}}"  class="form-control Validform_error" placeholder="请输入分类英文名" nullmsg="请输入分类英文名" datatype="*" type="text"><em>*</em>

                                </td>
                            </tr>
                            <tr>
                                <td>分类繁体：</td>
                                <td>
                                    <input name="PTypeNaemTw" id="PTypeNaemTw" class="InputBox"   value="{{$type->PTypeNaemTw}}"    class="form-control Validform_error" placeholder="请输入分类繁体" nullmsg="请输入分类繁体" datatype="*" type="text"><em>*</em>
                                    <span id="spantxtPTypeTwName"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>上级分类：</td>
                                <td>
                                    <input value="{{$type->ParentPTypeID}}" name="parent_id" id="parent_id" type="hidden">
                                    <input name="txtParentPTypeName" id="txtParentPTypeName" class="InputBox" readonly="" type="text"  value="{{$type->ParentPTypeName}}">
                                    <img src="../../images/jia.png" style="cursor:pointer;" title="选择上级分类" id="chooseParentType"  alt="选择">
                                </td>
                            </tr>
                            <tr>
                                <td>排序：</td>
                                <td>
                                    <input name="OrderNo" id="OrderNo" class="inputbox"  value="{{$type->OrderNo}}" onkeyup="this.value=this.value.replace(/[^\d]/g,'');" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td>备注：</td>
                                <td><textarea name="Remark" id="Remark" rows="3" cols="80"> {{$type->Remark}}</textarea></td>
                            </tr>

                            </tbody></table>
                    </div>
                </div>
            </div>
                </form>
        </div><!-- /.box-body -->
    </div>

    <script src="/js/product.js"></script>
    <script language="javascript">

        $("#chooseParentType").click(function(){
            Product.openProductTypeWindow(300,2,"Product.doneProductTypeWindowOnCategoryPage");
        });
        $("#btnSubmit").click(function()
        {
            $("#FormView").submit();
        });


    </script>
    @include('message')
@stop