@extends('layout.contentlte')
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6" style="font-style:bold;margin-left: 15px"><h4>请选择分类</h4></div>

                     <div class="row" style="margin-left: 15px">
                         <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                                <tbody>
                                @foreach($types as $al)
                                    <tr role="row" class="even" style="cursor: pointer" value="{{$al->PTypeID}}" categroyname="{{$al->name}}">

                                        @if($displayid == 1)
                                        <td>    <input name="selected[]"  value="{{$al->PTypeID}}" categroyname="{{$al->name}}" type="checkbox"></td>
                                        @endif
                                        <td> {{$al->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                        </table>
                    </div>
                         <div class="row">
                             <div class="col-sm-5">
                             <div class="col-sm-7">
                             <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                             <?php echo ($pageHtml);?>
                             </div> </div></div>
                         </div>
                </div>
            </div>
                @if($displayid == 1)
                <div class="row" style="margin-left: 15px;text-align: center">
                    <button class="btn btn-w-m btn-primary" type="button" id="submit">确认</button>
                </div>
                @endif
        </div>
    </div>

    <script src="/js/product.js"></script>
    <script language="javascript">
        var multi=2;

        var callback ="{{$callback}}";
        @if($displayid == 1)
            multi=1;
        @endif
        //多选
        if(multi==1)
        {
            $("#submit").click(function(){
                var json="",ids="\"",names="\"";

                $("input:checked").each(function(){

                    ids +=$(this).val()+",";
                    names +=$(this).attr("categroyname")+",";

                });
                ids += "\"";
                names+= "\"";
                json="{'ids':"+ids+",'names':"+names+"}";

                eval(callback+"("+json+')');
                window.close();
            });
        }else {
            //单选
            $(".even").each(function () {
                $(this).click(function () {
                    var  json="{'ids':"+$(this).attr("value")+",'names':\""+$(this).attr("categroyname")+"\"}";
                    eval(callback+"("+json+')');
                    window.close();
                });
            });
        }


    </script>

@stop