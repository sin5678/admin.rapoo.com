@extends('layout.contentlte')
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6" style="font-style:bold;margin-left: 15px"><h4>请选择分类</h4></div>

                     <div class="row" style="margin-left: 15px">
                         <div class="col-sm-12">

                                @foreach($types as $k=>$al)

                                    @if($k%10==0)
                                 <table id="table{{count($types)}}"   @if($k>0)  style="display: none" @endif class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                                     <tbody>
                                     @endif
                                    <tr role="row" class="even" style="cursor: pointer" value="{{$al->PTypeID}}" categroyname="{{$al->name}}">
                                        <td>
                                            <input name="selected[]"  value="{{$al->PTypeID}}" categroyname="{{$al->name}}" type="checkbox">
                                        </td>
                                        <td> {{$al->name}}</td>
                                    </tr>

                                     @if(($k+1)%10==0 ||   ((count($types)-1 - $k)<10  &&((count($types) -1- $k)%10)==0))
                                        </tbody>
                                        </table>
                                    @endif
                                @endforeach
                    </div>

                </div>
            </div>

                <div class="row" style="margin-left: 15px">
                    <div class="col-sm-12">
                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                    <ul class="pagination">
                        <?php $page = count($types)%10> 0? count($types)/10+1: count($types)/10;   ?>
                        @for($i=1;$i<=$page ;$i++)
                        <li><a href="javascript:void(0);">{{$i}}</a></li>
                            @endfor

                    </ul>
                </div>
                <div class="row" style="margin-left: 15px;text-align: center">
                    <button class="btn btn-w-m btn-primary" type="button" id="submit">确认</button>
                </div>
                    </div>
                </div>

        </div>
    </div>

    <script src="/js/product.js"></script>
    <script language="javascript">


        var callback ="{{$callback}}";


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

        $(".pagination li").each(function(){
            $(this).click(function(){
                $(".table").hide();
                $(".table").eq($(this).index()).show();
            });
        });



    </script>

@stop