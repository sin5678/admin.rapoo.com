@extends('layout.contentlte')
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6" style="font-style:bold;margin-left: 15px"><h2>国家选择</h4></div>
                    <div class="col-sm-6" style="font-style:bold;margin-left: 15px"><h4>地域</h4></div>
                    <div class="col-sm-12" style="margin-left: 15px">
                    <hr style="border-bottom:1px solid #ccc; border-left:none; border-right:none; border-top:none;">
                        </div>
                    <div class="row" style="margin-left: 15px">
                        <div class="col-sm-12" id="areaView">
                                @foreach($areaList as $k=> $al)
                                            <input name="area[]" value="{{$al->AreaID}}" type="radio">  {{$al->AreaName}}</td>
                                @endforeach
                        </div>
                    </div>

                    <div class="col-sm-6" style="font-style:bold;margin-left: 15px"><h4>国家</h4></div>
                    <div class="col-sm-12" style="margin-left: 15px">
                    <hr style="border-bottom:1px solid #ccc; border-left:none; border-right:none; border-top:none;">
                    </div>
                    <div class="row" style="margin-left: 15px">
                        <div class="col-sm-12" >
                             @foreach($countryList as $al)
                                <div class="col-sm-2">
                                             <input   value="{{$al->CountryID}}" countryname="{{$al->CountryName}}" type="checkbox" id="{{$al->CountryID}}">    {{$al->CountryName}}</td>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 15px;text-align: center">
                <button class="btn btn-w-m btn-primary" type="button" id="submit">确认</button>
                    </div>
            </div>
        </div>

        <script src="/js/product.js"></script>
        <script language="javascript">

            var map = <?php echo html_entity_decode($map)?>;

            $(document).ready(function(){
                $(":radio").each(function(){
                            $(this).click(function(){
                                var id =  $(this).val();
                                $(":checkbox").each(function () {
                                    for (var i = 0; i < map.length; i++) {
                                        if ($(this).val() == map[i].CountryID && id == map[i].AreaID) {
                                            this.checked = true;
                                            break;
                                        } else {
                                            this.checked = false;
                                        }
                                    }
                                });

                            });
                });

                $("#submit").click(function(){
                    var o;
                    var ids='';
                    var names='';
                    $(":checkbox:checked").each(function(){
                       ids += $(this).attr("id")+",";
                       names += $(this).attr("countryname")+",";
                    });

                    o={
                        'ids':ids,
                        'names':names
                    };
                    Product.doneArea(o);
                    window.close();

                })
            });




        </script>

@stop