@extends('layout.contentlte')
@section('content')
<link href="/css/pro.css" rel="stylesheet" type="text/css" />
<link href="/css/onlinegm.css" rel="stylesheet" type="text/css" />

<div class="box">
<div class="box-header">

    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px;" href="javascript:window.close()" >返回</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品预览</h3>
</div>
<div style="width: 100%; height: 450px;">

    <div id="slide-content-0" class="slide-content" style="display: block; height:450px;background: url({{$productBackgroundPic}}) repeat scroll center center transparent;
            width: 100%;">
        <div class="btnbuy" style="width: 980px; height: 450px; margin: 0 auto; border: 0px solid #f00;">
            <div id="proDetailImgs" style="width: 565px;  overflow:hidden;height: 450px; float: left; border: 0px solid #f00;">
                <dl>
                    @foreach($product['dvProductProfileColor'] as $key => $colors)
                        <dd @if($key!=0) style="display: none" @endif>
                            <img src="{{$productColorsPic[$key]}}" alt="" width="585"  height="450" /></dd>
                    @endforeach
                </dl>
            </div>
            <div id="buyInfoDesc">
                <h2  style=" font-family:Microsoft yahei;font-weight:normal;color: <?php echo strpos($product['tareaRemark'], "#") === 0?"":"#" ?>{{$product['tareaRemark']}}">{{$product['txtProductCode']}}</h2>
                <h3 style=" font-family:Microsoft yahei;font-weight:normal;color: <?php echo strpos($product['tareaRemark'], "#") === 0?"":"#" ?>{{$product['tareaRemark']}}">{{$product['txtProductName']}}</h3>
                <p style="font-family:Microsoft yahei;color: <?php echo strpos($product['tareaRemark'], "#") === 0?"":"#" ?>{{$product['tareaRemark']}}">

                    {{$product['tareaProductDesc']}}

                <p class="price" >
                    &yen;<span  >{{$product['txtProductPrice']}}</span></p>

                <dl id="switchBox" class="switchBox">
                    <dt class="ys"><!--<b>颜色</b>-->
                        @foreach($product['dvProductProfileColor'] as $key => $colors)
                            <span class="fk1" style="background: {{$colors}}"></span>
                        @endforeach
                    </dt>
                </dl>
            </div>
        </div>
    </div>
</div>



@if(array_key_exists('titlebackground',$maidian) && count($maidian['titlebackground']) >0 )
 @foreach($maidian['titlebackground'] as $i=>$md)

<div style='width: 980px; height: 500px; margin: 0 auto;'>
                <div style="width: 980px; height: 500px;background: #fafafa url({{$maidianfiles[$i]}}) {{$maidian['titlebackground'][$i]}} {{$maidian['titleverposition'][$i]}} {{$maidian['titlehorposition'][$i]}};">
                    <div style="box-sizing: content-box;font-family:Microsoft yahei; font-size:{{$maidian['titlefontsize'][$i]}}pt;color:{{$maidian['titlefontcolor'][$i]}};font-weight:{{$maidian['titlefontstyle'][$i]}};text-align:
               {{$maidian['titlefontalign'][$i]}};width:{{$maidian['titlewidth'][$i]}}px;height:{{$maidian['titleheight'][$i]}}px;padding-left:{{$maidian['titlemarginleft'][$i]}}px;padding-top:{{$maidian['titlemargintop'][$i]}}px;line-height:1.2;">
              {{$maidian['title'][$i]}}</div>

                    <div style="box-sizing: content-box;font-family:Microsoft yahei;font-size:{{$maidian['description_fontsize'][$i]}}pt;color:{{$maidian['description_fontcolor'][$i]}};font-weight:{{$maidian['description_fontstyle'][$i]}};text-align:{{$maidian['description_fontalign'][$i]}};width:
           {{$maidian['description_fontwidth'][$i]}}px;height:{{$maidian['description_fontheight'][$i]}}px;padding-left:{{$maidian['description_left'][$i]}}px;padding-top:
            {{$maidian['description_top'][$i]}}px;line-height:1.8;">
           {{$maidian['description'][$i]}}
                    </div>
                </div>
</div>

        @endforeach

@endif


<div id="slideBox" style="text-align: center;display: none">
    <div id="slide" style="text-align: center">

        <div class="bg1" style="display: block">
            <div class="cont_l" id="sc_1">
                @if(!empty($productStardard))
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr align="center">
                        <td>&nbsp;

                        </td>
                        <td>&nbsp;

                        </td>
                    </tr>
                    <tr align="center">
                        <td class="bc">
                            料号
                        </td>
                        <td class="bc">
                            技术规格
                        </td>
                    </tr>
                    <tr  align="center">
                        <td>
                            @if(!empty($productStardard))
                              {{$productStardard['liaohao']}}
                            @endif
                            <br/>
                            @if(!empty($productStardard))
                                {{$productStardard['Quality']}}
                            @endif
                                <br/><br/>
                                    <b>系统需求</b><br/>
                                @if(!empty($productStardard) && !empty($productStardard['os']))
                                    <?php echo implode(" ",$productStardard['OS']);?>
                                @endif
                                <br/>
                                @if(!empty($productStardard) && !empty($productStardard['connect']))
                                    <?php echo implode(" ",$productStardard['connect']);?>
                                @endif
                                <br/> <br/>
                                    <b> 包装内容</b>
                                <br/>
                                @if(!empty($productStardard) && !empty($productStardard['attachment']))
                                    <?php echo implode(" ",$productStardard['attachment']);?>
                                @endif

                        </td>
                        <td>

                                    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='1')
                                    鼠标<br/>

                                    按键:{{$productStardard['rad']['mousetechid1']}}<br/>
                                    最高追踪速度:{{$productStardard['rad']['mousetechid2']}}<br/>
                                    最大速度:{{$productStardard['rad']['mousetechid3']}}<br/>
                                    最大分辨率:{{$productStardard['rad']['mousetechid4']}}<br/>
                                    工作电压:{{$productStardard['rad']['mousetechid5']}}<br/>
                                    工作电流:{{$productStardard['rad']['mousetechid6']}} <br/>
                                    尺寸:{{$productStardard['rad']['mousetechid7']}} <br/>
                                    重量:{{$productStardard['rad']['mousetechid8']}}<br/>

                                    @elseif(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='2')
                                    键盘<br/>

                                    字键开关 :{{$productStardard['rad']['keyboardtechid1']}}<br/>
                                    字键行程:{{$productStardard['rad']['keyboardtechid2']}}<br/>
                                    工作电压:{{$productStardard['rad']['keyboardtechid3']}}<br/>
                                    工作电流:{{$productStardard['rad']['keyboardtechid4']}} <br/>
                                    尺寸:{{$productStardard['rad']['keyboardtechid5']}}<br/>

                                    @elseif(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='3')
                                    耳机<br/>

                                    驱动单元 :{{$productStardard['rad']['micid1']}}<br/>
                                    频率响应:{{$productStardard['rad']['micid2']}}<br/>
                                    阻抗:{{$productStardard['rad']['micid3']}}<br/>

                                    麦克风拾音模式:{{$productStardard['rad']['micid4']}}<br/>
                                    信噪比:{{$productStardard['rad']['micid5']}}<br/>
                                    失真度:{{$productStardard['rad']['micid6']}}<br/>
                                    类型:{{$productStardard['rad']['micid7']}}<br/>
                                    测试条件:{{$productStardard['rad']['micid8']}}<br/>


                                    @elseif(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='4')
                                    音箱<br/>


                                    模拟信号:{{$productStardard['rad']['soundboxid1']}}<br/>
                                    有源无源:{{$productStardard['rad']['soundboxid2']}}<br/>
                                    额定功率:{{$productStardard['rad']['soundboxid3']}}<br/>
                                    防磁功能:{{$productStardard['rad']['soundboxid4']}} <br/>
                                    频响范围:{{$productStardard['rad']['soundboxid5']}}（KHz）<br/>
                                    信噪比:{{$productStardard['rad']['soundboxid6']}}<br/>
                                    失真度:{{$productStardard['rad']['soundboxid7']}}<br/>
                                    扬声器单元（mm）:{{$productStardard['rad']['soundboxid8']}}<br/>
                                    产品重量:{{$productStardard['rad']['soundboxid9']}}<br/>

                                    @elseif(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='5')
                                    RATV
                                    <br/>

                                    模拟信号:{{$productStardard['rad']['ratv1']}}<br/>
                                    数字信号:{{$productStardard['rad']['ratv2']}}<br/>
                                    输入端口:{{$productStardard['rad']['ratv3']}}<br/>
                                    输出端口:{{$productStardard['rad']['ratv4']}} <br/>
                                    工作电压:{{$productStardard['rad']['ratv5']}}<br/>
                                    工作电流:{{$productStardard['rad']['ratv6']}}<br/>
                                    分辨率:{{$productStardard['rad']['ratv7']}}<br/>
                                    支持TV标准:{{$productStardard['rad']['ratv8']}}<br/>
                                    @endif<br/>

                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;

                        </td>
                        <td>&nbsp;

                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;

                        </td>
                        <td>&nbsp;

                        </td>
                    </tr>
                    </tbody></table>
                    @endif
            </div>
        </div>

    </div>
</div>

</div>

<script language="javascript">
    $(document).ready(function(){
        $("#switchBox span").each(function(){
            $(this).click(function()
            {
                var index = $(this).index();
                $("#proDetailImgs dd").hide();
                $("#proDetailImgs dd").eq(index).show();

            });
        });


    });
</script>

@include('message')
@stop