@extends('layout.adminlte')
@section('content')
    <div class="box">
        <div class="box-header">

            <a class="btn btn-w-m btn-warning" style="display:inline-block;width:100px;float:right;margin-right: 10px" href="/product/producttype_repair">重建</a>
            <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px" href="/product/producttype_create">添加</a>
            <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品类型</h3>
        </div>

        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div>
                    <div class="col-sm-6"></div></div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th><input onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" type="checkbox"></th>
                                <th> 类型名称</th>
                                <th> 英语名称</th>
                                <th> 繁体名称</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($types as $al)
                                <tr role="row" class="even">
                                    <td>    <input name="selected[]" value="46" type="checkbox"></td>
                                    <td> {{$al->name}}</td>
                                    <td> {{$al->PTypeNaemEn}}</td>
                                    <td> {{$al->PTypeNaemTw}}</td>
                                    <td> {{$al->OrderNo}}</td>
                                    <td>
                                        <a href="/product/producttype_edit/?PTypeID={{$al->PTypeID}}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
                                        <a href="/product/producttype_del/{{$al->PTypeID}}" onclick="if(!confirm('确定删除？')){ return false; }"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <div class="col-sm-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                <?php echo ($pageHtml);?>
                            </div> </div></div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
    @include('message')
@stop