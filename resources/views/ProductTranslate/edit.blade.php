@extends('layout.adminlte')
@section('content')
<script>
  window.onload = function () { 
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
  }
</script>

<div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>产品翻译</h5>
  </div>
  <div class="ibox-content">
 <form class="form-horizontal"  action="/producttranslate/store" method="post"  enctype="multipart/form-data" id="FormView">
     <div class="box-header">
        <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="javascript:{}" id="videoSavaBtn">保存</a>
        <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px;" href="/producttranslate">返回</a>
         <input type="hidden" name="TranslateID" value="@if($ProductTranslate) {{ $ProductTranslate->TranslateID }} @endif">
         <input type="hidden" name="PID" value="@if($PID) {{ $PID }} @endif">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
        <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px"> 产品翻译</h3>
      </div>
      <table  id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <tbody>
        <tr>
          <td style="width: 11%;">
            产品型号
          </td>
          <td style="width: 39%;" >
            <input name="VideoName" id="txtvideoCode" class="InputBox"  class="form-control Validform_error" placeholder="请输入产品翻译名称" nullmsg="请输入产品翻译名称" datatype="*"  disabled="" style="width: 96%" value="{{ $Product->ProductCode }}" type="text"><em>*</em> 
                  
          </td>
          <td style="width: 11%;">
            国家语言
          </td>
          <td style="width: 39%;">
           <select id="selLinkMode" style="width: 100px;" name="VideoType">
             @foreach($dataList as $ba)
              <option value="{{ $ba->EnglishShort }}" @if($Language == $ba->EnglishShort ) selected="selected" @endif >{{ $ba->CountryName }}</option>
             @endforeach
            </select>
          </td>

        </tr>

        <tr id="trUserPwd">
          <td>
            参照语言
          </td>
              <td style="width: 39%;">
           <select id="selLinkMod" style="width: 100px;" >
             <option value="zh-CN">中文</option>
             <option value="en-US">英文</option>
            </select>
          </td>
           <td>
            同语言地区
          </td>
              <td style="width: 39%; ">
                <div class="col-sm-12"  style="overflow:scroll; height:200px;" >
                  @foreach($dataList as $ba)
                   <div class="col-sm-2" ><input type="checkbox" name="txtCountryName[]"   @if(in_array($ba->EnglishShort, $region)) checked="checked" @endif value="{{ $ba->EnglishShort }}"  >{{ $ba->CountryName }}</div>
                  @endforeach
                </div>
              </td>
        </tr>
              <td colspan="4" style="padding:10px 30px;">
                  <table border="0" cellpadding="0" cellspacing="0" width="100%" style="line-height:25px;">
                      <colgroup>
                          <col width="47%"></col>
                          <col width="6%"></col>
                          <col width="47%"></col>
                      </colgroup>
                      <tbody>
                          <tr style="text-align: center;">
                              <td>参考对照</td>
                              <td></td>
                              <td>文种翻译</td>
                          </tr>
                          <tr>
                              <td></td>
                              <td style="font-weight: bold;text-align: center;white-space:nowrap;">
                                  产品名称
                              </td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>
                                  <input name="txtProductName" id="txtProductName" class="InputBox90" readonly="" value="@if($Product) {{ $Product->ProductName }} @endif" type="text" style="width:100%;">
                                  <input name="txtProductName" id="txtProductName2" class="InputBox90" readonly="" value="@if($Producten) {{ $Producten->ProductName }} @endif" type="text" style="width:100%;display:none" >

                              </td>
                              <td></td>
                              <td>
                                  <input name="ProductName" id="txtTransProductName" class="InputBox90" type="text" datatype="*"  value="@if($ProductTranslate) {{ $ProductTranslate->ProductName }} @endif"  style="width:100%;">
                              </td>
                          </tr>
                          <tr>
                              <td></td>
                              <td style="font-weight: bold;text-align: center;">
                                  产品规格
                              </td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>
                              
				     <table style="width:100%;" id="tbMain" class="table table-bordered table-hover dataTable" border="0" cellpadding="2" cellspacing="2">
    <tbody><tr>
      <td class="bc" style="width:100px;">
        料号
      </td>
      <td colspan="2"><input class="InputBox100" type="text"   value="@if(array_key_exists('liaohao',$productStardard)){{$productStardard['liaohao']}}@endif"></td>
    </tr>
    <tr>
      <td>质量保证</td>
      <td colspan="2"><input class="InputBox100" type="text"  value="@if(array_key_exists('Quality',$productStardard)){{$productStardard['Quality']}}@endif"></td>
    </tr>
    <tr>
      <td colspan="3" style="border-bottom:1px solid #b2bac5; border-left:none; border-top:none; border-right:none; padding-top:1px;">
      </td>
    </tr>
    <tr>
      <td rowspan="2">
        系统需求
      </td>
      <td style="width:80px;">操作系统</td>
      <td>
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="Windows XP" @if(array_key_exists('OS',$productStardard)&& isset($productStardard['OS']['xp']))  checked ='checked' @endif id="chb1" onfocus="this.blur();" type="checkbox"     ><label for="chb1">Windows XP</label></td>
            <td><input value="Windows Vista" id="chb2" onfocus="this.blur();"  @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['vista']))  checked ='checked' @endif type="checkbox"    ><label for="chb2">Windows Vista</label></td>
            <td><input value="Windows 7" id="chb3" onfocus="this.blur();"   @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['win7']))  checked ='checked' @endif type="checkbox"   ><label for="chb3">Windows 7</label></td>
            <td><input value="Windows 8" id="chb4" onfocus="this.blur();" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['win8']) ) checked ='checked' @endif type="checkbox"  ><label for="chb4">Windows 8</label></td>

          </tr>
          <tr>
            <td><input value="Windows 2000" id="chb5" onfocus="this.blur();"   @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['win2000']))  checked ='checked' @endif type="checkbox"><label for="chb5">Windows 2000</label></td>
            <td><input value="Mac OS x v10.2.8或更高版本" id="chb6" onfocus="this.blur();"  @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['macos']))  checked ='checked' @endif   type="checkbox"><label for="chb6">Mac OS x v10.2.8或更高版本</label></td>
            <td><input value="Chrome OS" id="chb7" onfocus="this.blur();" type="checkbox" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['cos']))  checked ='checked' @endif  ><label for="chb7">Chrome OS</label></td>
            <td><input value="Apple 系PC" id="chb8" onfocus="this.blur();" type="checkbox" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['apppc']))  checked ='checked' @endif ><label for="chb8">Apple 系PC</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>
    <tr>
      <td style="width:80px;">连接技术</td>
      <td>
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="USB接口" id="chb9" onfocus="this.blur();"   @if(array_key_exists('connect',$productStardard)&&isset($productStardard['connect']['usb']))  checked ='checked' @endif type="checkbox"><label for="chb9">USB接口</label></td>
            <td><input value="PS/2接口" id="chb10" onfocus="this.blur();" type="checkbox"   @if(array_key_exists('connect',$productStardard)&&isset($productStardard['connect']['ps']))  checked ='checked' @endif><label for="chb10">PS/2接口</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>

    <tr>
      <td>
        包装内容
      </td>
      <td colspan="2">
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="USB适配器" id="chb11" onfocus="this.blur();"  @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['usb']))  checked ='checked' @endif   type="checkbox"><label for="chb11">USB适配器</label></td>
            <td><input value="用户文档" id="chb12" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['document']))  checked ='checked' @endif type="checkbox" ><label for="chb12">用户文档</label></td>
            <td><input value="产品说明书" id="chb13" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['book']))  checked ='checked' @endif  type="checkbox" ><label for="chb13">产品说明书</label></td>
            <td><input value="保修服务卡" id="chb14" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['paoxiuka']))  checked ='checked' @endif  type="checkbox" ><label for="chb14">保修服务卡</label></td>
            <td><input value="AAA碱性电池" id="chb15" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['dianchi']))  checked ='checked' @endif  type="checkbox" ><label for="chb15">AAA碱性电池</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>

    <tr>
      <td rowspan="20" id="tdTech">
        技术规格
      </td>
      <td colspan="2">
        <table border="0" cellpadding="2" cellspacing="2">
            <tbody>
			<tr>
			<td><input  value="1" id="radio1"  name='a'  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='1')   @endif  onfocus="this.blur();" type="radio"><label for="radio1">鼠标</label></td>
<td><input   value="2"  id="radio2" name='a'    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='2')   @endif onfocus="this.blur();" type="radio"><label for="radio2">键盘</label></td>
<td><input   value="3"  id="radio3" name='a'  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='3')   @endif  onfocus="this.blur();" type="radio"><label for="radio3">耳机</label></td>
<td><input    value="4" id="radio4" name='a'  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='4')  @endif  onfocus="this.blur();" type="radio"><label for="radio4">音箱</label></td>
<td><input  value="5"  id="radio5"  name='a' @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='5')   @endif onfocus="this.blur();" type="radio"><label for="radio5">RATV</label></td>

			</tr>
            <tr><td colspan="5">


                <table border="0"  id="mousetechid" cellpadding="2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='1')  style="display: block" @else style="display: none"   @endif  cellspacing="2" class="table table-bordered table-hover dataTable">
                  <tbody>
                  <tr>
                    <td> 按键 </td><td><input  value="@if(!empty($productStardard['rad']['mousetechid1'])){{$productStardard['rad']['mousetechid1']}}@endif" id=""/></td>
                    <td>  最高追踪速度</td><td><input  value="@if(!empty($productStardard['rad']['mousetechid2'])){{$productStardard['rad']['mousetechid2']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>  最大速度</td><td><input  value="@if(!empty($productStardard['rad']['mousetechid3'])){{$productStardard['rad']['mousetechid3']}}@endif" id=""/></td>
                    <td>   最大分辨率</td><td><input  value="@if(!empty($productStardard['rad']['mousetechid4'])){{$productStardard['rad']['mousetechid4']}}@endif" id=""/></td>
                  </tr>   <tr>
                    <td>   工作电压</td><td><input  value="@if(!empty($productStardard['rad']['mousetechid5'])){{$productStardard['rad']['mousetechid5']}}@endif" id=""/></td>
                    <td>   工作电流</td><td><input  value="@if(!empty($productStardard['rad']['mousetechid6'])){{$productStardard['rad']['mousetechid6']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>   尺寸</td><td><input  value="@if(!empty($productStardard['rad']['mousetechid7'])){{$productStardard['rad']['mousetechid7']}}@endif" id=""/></td>
                    <td>   重量</td><td> <input  value="@if(!empty($productStardard['rad']['mousetechid8'])){{$productStardard['rad']['mousetechid8']}}@endif" id=""/></td>
                  </tr>
                  </tbody></table>
                <table border="0"  id="keyboardtechid"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='2')  style="display: block" @else style="display: none"   @endif  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                  <tbody>
                  <tr>
                    <td> 字键开关 </td><td><input  value="@if(!empty($productStardard['rad']['keyboardtechid1'])) {{$productStardard['rad']['keyboardtechid1']}}@endif" id=""/></td>
                    <td>  字键行程</td><td><input  value="@if(!empty($productStardard['rad']['keyboardtechid2'])){{$productStardard['rad']['keyboardtechid2']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>  工作电压</td><td><input  value="@if(!empty($productStardard['rad']['keyboardtechid3'])){{$productStardard['rad']['keyboardtechid3']}}@endif" id=""/></td>
                    <td>   工作电流</td><td><input  value="@if(!empty($productStardard['rad']['keyboardtechid4'])){{$productStardard['rad']['keyboardtechid4']}}@endif" id=""/></td>
                  </tr>   <tr>
                    <td>   尺寸</td><td><input  value="@if(!empty($productStardard['rad']['keyboardtechid5'])){{$productStardard['rad']['keyboardtechid5']}}@endif" id=""/></td>

                  </tr>

                  <table border="0"    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='3')  style="display: block" @else style="display: none"   @endif  id="micid" cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                    <tbody>
                    <tr>
                      <td> 驱动单元 </td><td><input  value="@if(!empty($productStardard['rad']['micid1'])){{$productStardard['rad']['micid1']}}@endif" id=""/></td>
                      <td>  频率响应</td><td><input  value="@if(!empty($productStardard['rad']['micid2'])){{$productStardard['rad']['micid2']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>  阻抗</td><td><input  value="@if(!empty($productStardard['rad']['micid3'])){{$productStardard['rad']['micid3']}}@endif" id=""/></td>
                      <td>   麦克风拾音模式</td><td><input  value="@if(!empty($productStardard['rad']['micid4'])){{$productStardard['rad']['micid4']}}@endif" id=""/></td>
                    </tr>   <tr>
                      <td>   类型</td><td><input  value="@if(!empty($productStardard['rad']['micid5'])){{$productStardard['rad']['micid5']}}@endif" id=""/></td>
                      <td>   测试条件</td><td><input  value="@if(!empty($productStardard['rad']['micid6'])){{$productStardard['rad']['micid6']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>   信噪比</td><td><input  value="@if(!empty($productStardard['rad']['micid7'])){{$productStardard['rad']['micid7']}}@endif" id=""/></td>
                      <td>   失真度</td><td> <input  value="@if(!empty($productStardard['rad']['micid8'])){{$productStardard['rad']['micid8']}}@endif" id=""/></td>
                    </tr>
                    </tbody></table>


                  <table border="0"  id="soundboxid"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='4')  style="display: block" @else style="display: none"   @endif  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                    <tbody>
                    <tr>
                      <td> 模拟信号 </td><td><input  value="@if(!empty($productStardard['rad']['soundboxid1'])){{$productStardard['rad']['soundboxid1']}}@endif" id=""/></td>
                      <td>  有源无源</td><td><input  value="@if(!empty($productStardard['rad']['soundboxid2'])){{$productStardard['rad']['soundboxid2']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>  额定功率</td><td><input  value="@if(!empty($productStardard['rad']['soundboxid3'])){{$productStardard['rad']['soundboxid3']}}@endif" id=""/></td>
                      <td>   防磁功能</td><td><input  value="@if(!empty($productStardard['rad']['soundboxid4'])){{$productStardard['rad']['soundboxid4']}}@endif" id=""/></td>
                    </tr>   <tr>
                      <td>   频响范围（KHz）</td><td><input  value="@if(!empty($productStardard['rad']['soundboxid5'])){{$productStardard['rad']['soundboxid5']}}@endif" id=""/></td>
                      <td>   信噪比</td><td><input  value="@if(!empty($productStardard['rad']['soundboxid6'])){{$productStardard['rad']['soundboxid6']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>   失真度</td><td><input  value="@if(!empty($productStardard['rad']['soundboxid7'])){{$productStardard['rad']['soundboxid7']}}@endif" id=""/></td>
                      <td>   扬声器单元（mm）</td><td> <input  value="@if(!empty($productStardard['rad']['soundboxid8'])){{$productStardard['rad']['soundboxid8']}}@endif" id=""/></td>
                      <td>   产品重量</td><td> <input  value="@if(!empty($productStardard['rad']['soundboxid9'])){{$productStardard['rad']['soundboxid9']}}@endif" id=""/></td>
                    </tr>
                    </tbody></table>
                <table border="0"  id="ratvid" cellpadding="2" cellspacing="2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='5')  style="display: block" @else style="display: none"   @endif  class="table table-bordered table-hover dataTable">
                  <tbody>
                  <tr>
                    <td> 模拟信号 </td><td><input  value="@if(!empty($productStardard['rad']['ratv1'])){{$productStardard['rad']['ratv1']}}@endif" id=""/></td>
                    <td>  数字信号</td><td><input  value="@if(!empty($productStardard['rad']['ratv2'])){{$productStardard['rad']['ratv2']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>  输入端口</td><td><input  value="@if(!empty($productStardard['rad']['ratv3'])){{$productStardard['rad']['ratv3']}}@endif" id=""/></td>
                    <td>   输出端口</td><td><input  value="@if(!empty($productStardard['rad']['ratv4'])){{$productStardard['rad']['ratv4']}}@endif" id=""/></td>
                  </tr>   <tr>
                    <td>   工作电压</td><td><input  value="@if(!empty($productStardard['rad']['ratv5'])){{$productStardard['rad']['ratv5']}}@endif" id=""/></td>
                    <td>   工作电流</td><td><input  value="@if(!empty($productStardard['rad']['ratv6'])){{$productStardard['rad']['ratv6']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>   分辨率</td><td><input  value="@if(!empty($productStardard['rad']['ratv7'])){{$productStardard['rad']['ratv7']}}@endif" id=""/></td>
                    <td>   支持TV标准</td><td> <input  value="@if(!empty($productStardard['rad']['ratv8'])){{$productStardard['rad']['ratv8']}}@endif" id=""/></td>
                  </tr>
                  </tbody></table>
</tbody></table>
							 </td>
						  </tr>

						    </tbody></table>
                              </td>
                              <td></td>
                              <td>
							     <table style="width:100%;" id="tbMain" class="table table-bordered table-hover dataTable" border="0" cellpadding="2" cellspacing="2">
    <tbody><tr>
      <td class="bc" style="width:100px;">
        料号
      </td>
      <td colspan="2"><input class="InputBox100" type="text"  name="ProductStandard[liaohao]" value="@if(array_key_exists('liaohao',$productStardard)){{$productStardard['liaohao']}}@endif"></td>
    </tr>
    <tr>
      <td>质量保证</td>
      <td colspan="2"><input class="InputBox100" type="text" name="ProductStandard[Quality]" value="@if(array_key_exists('Quality',$productStardard)){{$productStardard['Quality']}}@endif"></td>
    </tr>
    <tr>
      <td colspan="3" style="border-bottom:1px solid #b2bac5; border-left:none; border-top:none; border-right:none; padding-top:1px;">
      </td>
    </tr>
    <tr>
      <td rowspan="2">
        系统需求
      </td>
      <td style="width:80px;">操作系统</td>
      <td>
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="Windows XP" @if(array_key_exists('OS',$productStardard)&& isset($productStardard['OS']['xp']))  checked ='checked' @endif id="chb1" onfocus="this.blur();" type="checkbox"  name="ProductStandard[OS][xp]"   ><label for="chb1">Windows XP</label></td>
            <td><input value="Windows Vista" id="chb2" onfocus="this.blur();"  @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['vista'])) checked ='checked' @endif type="checkbox" name="ProductStandard[OS][vista]"   ><label for="chb2">Windows Vista</label></td>
            <td><input value="Windows 7" id="chb3" onfocus="this.blur();"   @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['win7'])) checked ='checked' @endif type="checkbox" name="ProductStandard[OS][win7]"  ><label for="chb3">Windows 7</label></td>
            <td><input value="Windows 8" id="chb4" onfocus="this.blur();" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['win8']))checked ='checked' @endif type="checkbox" name="ProductStandard[OS][win8]" ><label for="chb4">Windows 8</label></td>

          </tr>
          <tr>
            <td><input value="Windows 2000" id="chb5" onfocus="this.blur();"  name="ProductStandard[OS][win2000]" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['win2000']))  checked ='checked' @endif type="checkbox"><label for="chb5">Windows 2000</label></td>
            <td><input value="Mac OS x v10.2.8或更高版本" id="chb6" onfocus="this.blur();"  @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['macos']))  checked ='checked' @endif  name="ProductStandard[OS][macos]" type="checkbox"><label for="chb6">Mac OS x v10.2.8或更高版本</label></td>
            <td><input value="Chrome OS" id="chb7" onfocus="this.blur();" type="checkbox" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['cos']))  checked ='checked' @endif  name="ProductStandard[OS][cos]"><label for="chb7">Chrome OS</label></td>
            <td><input value="Apple 系PC" id="chb8" onfocus="this.blur();" type="checkbox" @if(array_key_exists('OS',$productStardard)&&isset($productStardard['OS']['apppc']))  checked ='checked' @endif name="ProductStandard[OS][apppc]"><label for="chb8">Apple 系PC</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>
    <tr>
      <td style="width:80px;">连接技术</td>
      <td>
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="USB接口" id="chb9" onfocus="this.blur();" name="ProductStandard[connect][usb]"  @if(array_key_exists('connect',$productStardard)&&isset($productStardard['connect']['usb']))  checked ='checked' @endif type="checkbox"><label for="chb9">USB接口</label></td>
            <td><input value="PS/2接口" id="chb10" onfocus="this.blur();" type="checkbox" name="ProductStandard[connect][ps]"  @if(array_key_exists('connect',$productStardard)&&isset($productStardard['connect']['ps']))  checked ='checked' @endif><label for="chb10">PS/2接口</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>

    <tr>
      <td>
        包装内容
      </td>
      <td colspan="2">
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="USB适配器" id="chb11" onfocus="this.blur();"  @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['usb']))  checked ='checked' @endif  name="ProductStandard[attachment][usb]" type="checkbox"><label for="chb11">USB适配器</label></td>
            <td><input value="用户文档" id="chb12" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['document']))  checked ='checked' @endif type="checkbox" name="ProductStandard[attachment][document]"><label for="chb12">用户文档</label></td>
            <td><input value="产品说明书" id="chb13" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['book']))  checked ='checked' @endif  type="checkbox" name="ProductStandard[attachment][book]"><label for="chb13">产品说明书</label></td>
            <td><input value="保修服务卡" id="chb14" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['paoxiuka']))  checked ='checked' @endif  type="checkbox" name="ProductStandard[attachment][paoxiuka]"><label for="chb14">保修服务卡</label></td>
            <td><input value="AAA碱性电池" id="chb15" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&isset($productStardard['attachment']['dianchi']))  checked ='checked' @endif  type="checkbox" name="ProductStandard[attachment][dianchi]"><label for="chb15">AAA碱性电池</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>

    <tr>
      <td rowspan="20" id="tdTech">
        技术规格
      </td>
      <td colspan="2">
        <table border="0" cellpadding="2" cellspacing="2">
            <tbody><tr>
            <td><input name="ProductStandard[radtype]" value="1" id="radio6"   onfocus="this.blur();" type="radio"><label for="radio6">鼠标</label></td>
            <td><input name="ProductStandard[radtype]"  value="2"  id="radio7"  onfocus="this.blur();" type="radio"><label for="radio7">键盘</label></td>
            <td><input name="ProductStandard[radtype]"  value="3"  id="radio8"  onfocus="this.blur();" type="radio"><label for="radio8">耳机</label></td>
            <td><input name="ProductStandard[radtype]"   value="4" id="radio9"  onfocus="this.blur();" type="radio"><label for="radio9">音箱</label></td>
            <td><input name="ProductStandard[radtype]" value="5"  id="radio10"  onfocus="this.blur();" type="radio"><label for="radio10">RATV</label></td>
            </tr>
            <tr><td colspan="5">


                <table border="0"  id="mousetechid2" cellpadding="2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='1')  style="display: block" @else style="display: none"   @endif  cellspacing="2" class="table table-bordered table-hover dataTable">
                  <tbody>
                  <tr>
                    <td> 按键 </td><td><input name="ProductStandard[rad][mousetechid1]" value="@if(!empty($productStardard['rad']['mousetechid1'])){{$productStardard['rad']['mousetechid1']}}@endif" id=""/></td>
                    <td>  最高追踪速度</td><td><input name="ProductStandard[rad][mousetechid2]" value="@if(!empty($productStardard['rad']['mousetechid2'])){{$productStardard['rad']['mousetechid2']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>  最大速度</td><td><input name="ProductStandard[rad][mousetechid3]" value="@if(!empty($productStardard['rad']['mousetechid3'])){{$productStardard['rad']['mousetechid3']}}@endif" id=""/></td>
                    <td>   最大分辨率</td><td><input name="ProductStandard[rad][mousetechid4]" value="@if(!empty($productStardard['rad']['mousetechid4'])){{$productStardard['rad']['mousetechid4']}}@endif" id=""/></td>
                  </tr>   <tr>
                    <td>   工作电压</td><td><input name="ProductStandard[rad][mousetechid5]" value="@if(!empty($productStardard['rad']['mousetechid5'])){{$productStardard['rad']['mousetechid5']}}@endif" id=""/></td>
                    <td>   工作电流</td><td><input name="ProductStandard[rad][mousetechid6]" value="@if(!empty($productStardard['rad']['mousetechid6'])){{$productStardard['rad']['mousetechid6']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>   尺寸</td><td><input name="ProductStandard[rad][mousetechid7]" value="@if(!empty($productStardard['rad']['mousetechid7'])){{$productStardard['rad']['mousetechid7']}}@endif" id=""/></td>
                    <td>   重量</td><td> <input name="ProductStandard[rad][mousetechid8]" value="@if(!empty($productStardard['rad']['mousetechid8'])){{$productStardard['rad']['mousetechid8']}}@endif" id=""/></td>
                  </tr>
                  </tbody></table>
                <table border="0"  id="keyboardtechid2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='2')  style="display: block" @else style="display: none"   @endif  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                  <tbody>
                  <tr>
                    <td> 字键开关 </td><td><input name="ProductStandard[rad][keyboardtechid1]" value="@if(!empty($productStardard['rad']['keyboardtechid1'])) {{$productStardard['rad']['keyboardtechid1']}}@endif" id=""/></td>
                    <td>  字键行程</td><td><input name="ProductStandard[rad][keyboardtechid2]" value="@if(!empty($productStardard['rad']['keyboardtechid2'])){{$productStardard['rad']['keyboardtechid2']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>  工作电压</td><td><input name="ProductStandard[rad][keyboardtechid3]" value="@if(!empty($productStardard['rad']['keyboardtechid3'])){{$productStardard['rad']['keyboardtechid3']}}@endif" id=""/></td>
                    <td>   工作电流</td><td><input name="ProductStandard[rad][keyboardtechid4]" value="@if(!empty($productStardard['rad']['keyboardtechid4'])){{$productStardard['rad']['keyboardtechid4']}}@endif" id=""/></td>
                  </tr>   <tr>
                    <td>   尺寸</td><td><input name="ProductStandard[rad][keyboardtechid5]" value="@if(!empty($productStardard['rad']['keyboardtechid5'])){{$productStardard['rad']['keyboardtechid5']}}@endif" id=""/></td>

                  </tr>

                  <table border="0"    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='3')  style="display: block" @else style="display: none"   @endif  id="micid2" cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                    <tbody>
                    <tr>
                      <td> 驱动单元 </td><td><input name="ProductStandard[rad][micid1]" value="@if(!empty($productStardard['rad']['micid1'])){{$productStardard['rad']['micid1']}}@endif" id=""/></td>
                      <td>  频率响应</td><td><input name="ProductStandard[rad][micid2]" value="@if(!empty($productStardard['rad']['micid2'])){{$productStardard['rad']['micid2']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>  阻抗</td><td><input name="ProductStandard[rad][micid3]" value="@if(!empty($productStardard['rad']['micid3'])){{$productStardard['rad']['micid3']}}@endif" id=""/></td>
                      <td>   麦克风拾音模式</td><td><input name="ProductStandard[rad][micid4]" value="@if(!empty($productStardard['rad']['micid4'])){{$productStardard['rad']['micid4']}}@endif" id=""/></td>
                    </tr>   <tr>
                      <td>   类型</td><td><input name="ProductStandard[rad][micid5]" value="@if(!empty($productStardard['rad']['micid5'])){{$productStardard['rad']['micid5']}}@endif" id=""/></td>
                      <td>   测试条件</td><td><input name="ProductStandard[rad][micid6]" value="@if(!empty($productStardard['rad']['micid6'])){{$productStardard['rad']['micid6']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>   信噪比</td><td><input name="ProductStandard[rad][micid7]" value="@if(!empty($productStardard['rad']['micid7'])){{$productStardard['rad']['micid7']}}@endif" id=""/></td>
                      <td>   失真度</td><td> <input name="ProductStandard[rad][micid8]" value="@if(!empty($productStardard['rad']['micid8'])){{$productStardard['rad']['micid8']}}@endif" id=""/></td>
                    </tr>
                    </tbody>
                  </table>


                  <table border="0"  id="soundboxid2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='4')  style="display: block" @else style="display: none"   @endif  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                    <tbody>
                    <tr>
                      <td> 模拟信号 </td><td><input name="ProductStandard[rad][soundboxid1]" value="@if(!empty($productStardard['rad']['soundboxid1'])){{$productStardard['rad']['soundboxid1']}}@endif" id=""/></td>
                      <td>  有源无源</td><td><input name="ProductStandard[rad][soundboxid2]" value="@if(!empty($productStardard['rad']['soundboxid2'])){{$productStardard['rad']['soundboxid2']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>  额定功率</td><td><input name="ProductStandard[rad][soundboxid3]" value="@if(!empty($productStardard['rad']['soundboxid3'])){{$productStardard['rad']['soundboxid3']}}@endif" id=""/></td>
                      <td>   防磁功能</td><td><input name="ProductStandard[rad][soundboxid4]" value="@if(!empty($productStardard['rad']['soundboxid4'])){{$productStardard['rad']['soundboxid4']}}@endif" id=""/></td>
                    </tr>   <tr>
                      <td>   频响范围（KHz）</td><td><input name="ProductStandard[rad][soundboxid5]" value="@if(!empty($productStardard['rad']['soundboxid5'])){{$productStardard['rad']['soundboxid5']}}@endif" id=""/></td>
                      <td>   信噪比</td><td><input name="ProductStandard[rad][soundboxid6]" value="@if(!empty($productStardard['rad']['soundboxid6'])){{$productStardard['rad']['soundboxid6']}}@endif" id=""/></td>
                    </tr>
                    <tr>
                      <td>   失真度</td><td><input name="ProductStandard[rad][soundboxid7]" value="@if(!empty($productStardard['rad']['soundboxid7'])){{$productStardard['rad']['soundboxid7']}}@endif" id=""/></td>
                      <td>   扬声器单元（mm）</td><td> <input name="ProductStandard[rad][soundboxid8]" value="@if(!empty($productStardard['rad']['soundboxid8'])){{$productStardard['rad']['soundboxid8']}}@endif" id=""/></td>
                      <td>   产品重量</td><td> <input name="ProductStandard[rad][soundboxid9]" value="@if(!empty($productStardard['rad']['soundboxid9'])){{$productStardard['rad']['soundboxid9']}}@endif" id=""/></td>
                    </tr>
                    </tbody></table>
                <table border="0"  id="ratvid2" cellpadding="2" cellspacing="2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='5')  style="display: block" @else style="display: none"   @endif  class="table table-bordered table-hover dataTable">
                  <tbody>
                  <tr>
                    <td> 模拟信号 </td><td><input name="ProductStandard[rad][ratv1]" value="@if(!empty($productStardard['rad']['ratv1'])){{$productStardard['rad']['ratv1']}}@endif" id=""/></td>
                    <td>  数字信号</td><td><input name="ProductStandard[rad][ratv2]" value="@if(!empty($productStardard['rad']['ratv2'])){{$productStardard['rad']['ratv2']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>  输入端口</td><td><input name="ProductStandard[rad][ratv3]" value="@if(!empty($productStardard['rad']['ratv3'])){{$productStardard['rad']['ratv3']}}@endif" id=""/></td>
                    <td>   输出端口</td><td><input name="ProductStandard[rad][ratv4]" value="@if(!empty($productStardard['rad']['ratv4'])){{$productStardard['rad']['ratv4']}}@endif" id=""/></td>
                  </tr>   <tr>
                    <td>   工作电压</td><td><input name="ProductStandard[rad][ratv5]" value="@if(!empty($productStardard['rad']['ratv5'])){{$productStardard['rad']['ratv5']}}@endif" id=""/></td>
                    <td>   工作电流</td><td><input name="ProductStandard[rad][ratv6]" value="@if(!empty($productStardard['rad']['ratv6'])){{$productStardard['rad']['ratv6']}}@endif" id=""/></td>
                  </tr>
                  <tr>
                    <td>   分辨率</td><td><input name="ProductStandard[rad][ratv7]" value="@if(!empty($productStardard['rad']['ratv7'])){{$productStardard['rad']['ratv7']}}@endif" id=""/></td>
                    <td>   支持TV标准</td><td> <input name="ProductStandard[rad][ratv8]" value="@if(!empty($productStardard['rad']['ratv8'])){{$productStardard['rad']['ratv8']}}@endif" id=""/></td>
                  </tr>
                  </tbody></table>
                 </tbody></table>
                  </tbody></table>
                            
	
							  </td>
                          </tr>
                          <tr>
                              <td></td>
                              <td style="font-weight: bold;text-align: center;">
                                  卖点概述
                              </td>
                              <td></td>
                          </tr>
                          <tr>
                              <td>
                                  <textarea name="tareaProductDesc" id="tareaProductDesc" rows="2" cols="60" class="InputBox90" readonly="" style="width:100%;"> @if($Product) {{ $Product->ProductDesc }} @endif </textarea>
                                   <textarea name="tareaProductDesc" id="tareaProductDesc2" rows="2" cols="60" class="InputBox90" readonly="" style="width:100%;display:none" >@if($Producten) {{ $Producten->ProductDesc }} @endif</textarea>
                              </td>
                              <td></td>
                              <td>
                                  <textarea name="ProductDesc" id="tareaTransProductDesc" rows="2" cols="60" class="InputBox90" datatype="*"  style="width:100%;">@if($ProductTranslate) {{ $ProductTranslate->ProductDesc }} @endif</textarea>
                              </td>
                          </tr>
                      </tbody>
                  </table>
              </td>
                
                
        </tbody></table>

        
<div class="box">
  <div class="box-header">
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品卖点</h3>
  </div>

  <div class="box-body" >
    <div class="tabContainer">
      <ul class="nav nav-tabs" id="MaiDianTab">
       

          @if(array_key_exists('titlebackground',$maidian) && count($maidian['titlebackground'])>0)
          @foreach($maidian['titlebackground'] as $k=>$md)

              <li   @if($k==0)class="active" @endif id="myTabLi" sort="0" codeid="{{$k}}"><a href="javascript:;" style="cursor:pointer" id="myTabLiA" >卖点{{$k}} <i class="fa fa-times"></i></a></li>

          @endforeach
          @else
          <li   class="active" id="myTabLi" sort="0" codeid="1"><a href="javascript:;" style="cursor:pointer" id="myTabLiA" >卖点0 <i class="fa fa-times"></i></a></li>
          @endif
      </ul>
    </div>


    @if(array_key_exists('titlebackground',$maidian) && count($maidian['titlebackground']) >0 )
    @foreach($maidian['titlebackground'] as $k=>$md)

<table  id="maidianView<?php echo $k;?>" class="table table-bordered table-hover dataTable"   @if($k!=0) style="display: none"  @endif  role="grid" aria-describedby="example2_info">
  <tbody><tr>
    <td>
      卖点图片
    </td>
    <td>
      <input name="maidianfile[]" id="maidianfile" class="InputBox" type="file">{{$maidian['file'][$k]}}
      <input type="hidden" value="{{$maidian['file'][$k]}}"   id="maidianfilehidden" name="maidianfilehidden[]">
    </td>
    <td>
      重复背景
    </td>
    <td>
      <select name="maidian[titlebackground][]">
        <option value="no-repeat" @if($maidian['titlebackground'][$k]=='no-repeat') selected="selected" @endif>no-repeat</option>
        <option value="repeat" @if($maidian['titlebackground'][$k]=='repeat') selected="selected" @endif >repeat</option>
        <option value="repeat-x" @if($maidian['titlebackground'][$k]=='repeat-x') selected="selected" @endif>repeat-x</option>
        <option value="repeat-y" @if($maidian['titlebackground'][$k]=='repeat-y') selected="selected" @endif >repeat-y</option>
      </select>
    </td>
    <td>
      水平位置
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian['titleverposition'][$k]}}" name="maidian[titleverposition][]"     type="text">
    </td>
    <td>
      垂直位置
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian['titlehorposition'][$k]}}" name="maidian[titlehorposition][]"type="text">
    </td>
  </tr>
  <tr>
    <td>
      卖点标题
    </td>
    <td>
      <input class="InputBox90"  id="cn1" type="text" disabled=""  value="{{$maidian['title'][$k]}}">
      <input class="InputBox90" id="en1" style="display:none" type="text" disabled=""  value="@if($Producten) {{ $Producten->ProductName }} @endif">   <br/>
      <input class="InputBox90" type="text" name="maidian[title][]" value="@if(!empty($maidian['title'][$k]))  {{$maidian['title'][$k]}}  @endif" id="maidiantitle">
     </td>
    <td>
      字体大小
    </td>
    <td>

       <select  name="maidian[titlefontsize][]">
        <option value="6" @if($maidian['titlefontsize'][$k] == 6) selected="selected" @endif>6 pt</option>
        <option value="7" @if($maidian['titlefontsize'][$k] == 7) selected="selected" @endif>7 pt</option>
        <option value="8" @if($maidian['titlefontsize'][$k] == 8) selected="selected" @endif>8 pt</option>
        <option value="9" @if($maidian['titlefontsize'][$k] == 9) selected="selected" @endif>9 pt</option>
        <option value="10" @if($maidian['titlefontsize'][$k] == 10) selected="selected" @endif>10 pt</option>
        <option value="12" @if($maidian['titlefontsize'][$k] == 12) selected="selected" @endif>12 pt</option>
        <option value="14" @if($maidian['titlefontsize'][$k] == 14) selected="selected" @endif>14 pt</option>
        <option value="16" @if($maidian['titlefontsize'][$k] == 16) selected="selected" @endif>16 pt</option>
        <option value="18" @if($maidian['titlefontsize'][$k] == 18) selected="selected" @endif>18 pt</option>
        <option value="24" @if($maidian['titlefontsize'][$k] == 24) selected="selected" @endif>24 pt</option>
        <option value="30" @if($maidian['titlefontsize'][$k] == 30) selected="selected" @endif>30 pt</option>
        <option value="36" @if($maidian['titlefontsize'][$k] == 36) selected="selected" @endif>36 pt</option>
        <option value="48" @if($maidian['titlefontsize'][$k] == 48) selected="selected" @endif>48 pt</option>
        <option value="60" @if($maidian['titlefontsize'][$k] == 60) selected="selected" @endif>60 pt</option>
      </select>
    </td>
    <td>
      字体颜色
    </td>
    <td>
      <select name="maidian[titlefontcolor][]">
          <option value="white">默认颜色</option>
        <option value="black"  @if($maidian['titlefontcolor'][$k] == "black") selected="selected" @endif>黑色</option>
        <option value="white"   @if($maidian['titlefontcolor'][$k] == "white") selected="selected" @endif>白色</option>
        <option value="red"   @if($maidian['titlefontcolor'][$k] == "red") selected="selected" @endif>红色</option>
        <option value="blue"   @if($maidian['titlefontcolor'][$k] == "blue") selected="selected" @endif>蓝色</option>
        <option value="green"   @if($maidian['titlefontcolor'][$k] == "green") selected="selected" @endif>绿色</option>
        <option value="yellow"   @if($maidian['titlefontcolor'][$k] == "yellow") selected="selected" @endif>黄色</option>
      </select>
    </td>
    <td>
      字体形式
    </td>
    <td>
      <select name="maidian[titlefontstyle][]">
        <option value="bold"   @if($maidian['titlefontstyle'][$k] == "bold") selected="selected" @endif>加粗</option>
        <option value="italic"   @if($maidian['titlefontstyle'][$k] == "italic") selected="selected" @endif>倾斜</option>
        <option value="normal"   @if($maidian['titlefontstyle'][$k] == "normal") selected="selected" @endif>正常</option>
      </select>
    </td>
  </tr>
  <tr>
    <td>
      对齐方式
    </td>
    <td>
      <select name="maidian[titlefontalign][]">
        <option value="left"  @if($maidian['titlefontalign'][$k]=='left') selected="selected" @endif>靠左</option>
        <option value="right"  @if($maidian['titlefontalign'][$k]=='right') selected="selected" @endif>靠右</option>
        <option value="center"  @if($maidian['titlefontalign'][$k]=='center') selected="selected" @endif>居中</option>
        <option value="justify"  @if($maidian['titlefontalign'][$k]=='justify') selected="selected" @endif>两端对齐</option>
      </select>
    </td>
    <td>
      标题宽度
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian['titlewidth'][$k]}}" name="maidian[titlewidth][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      标题高度
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian['titleheight'][$k]}}"  name="maidian[titleheight][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      标题左边
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian['titlemarginleft'][$k]}}"  name="maidian[titlemarginleft][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
  </tr>
  <tr>
    <td>
      标题顶部
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian['titlemargintop'][$k]}}"  name="maidian[titlemargintop][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
  </tr>
  <tr>
    <td colspan="8">
      <hr style="color: #b2bac5; width: 99.5%; height: 1px; font-size: 1px; margin-top: 1px;">
    </td>
  </tr>
  <tr>
    <td>
      卖点描述
    </td>
    <td>
      <textarea rows="3" cols="50"  id="cn2" disabled="" > {{$maidian['description'][$k]}}</textarea>  <br/>
      <textarea rows="3" cols="50"  id="en2" disabled="" style="display:none" >@if($Producten) {{ $Producten->ProductDesc }} @endif</textarea>  <br/>
      <textarea rows="3" cols="50"  id="maidiandescription" name="maidian[description][]">@if(!empty($maidian['description'][$k]))  {{$maidian['description'][$k]}}  @endif  </textarea>
    </td>
    <td>
      字体大小
    </td>
    <td>
      <select   name="maidian[description_fontsize][]">{{  $maidian['description_fontsize'][$k] }}
        <option value="6"  @if($maidian['description_fontsize'][$k]=='6') selected="selected" @endif>6 pt</option>
        <option value="7" @if($maidian['description_fontsize'][$k]=='7') selected="selected" @endif>7 pt</option>
        <option value="8" @if($maidian['description_fontsize'][$k]=='8') selected="selected" @endif>8 pt</option>
        <option value="9" @if($maidian['description_fontsize'][$k]=='9') selected="selected" @endif>9 pt</option>
        <option value="10"  @if($maidian['description_fontsize'][$k]=='10') selected="selected" @endif>10 pt</option>
        <option value="12"  @if($maidian['description_fontsize'][$k]=='12') selected="selected" @endif>12 pt</option>
        <option value="14"  @if($maidian['description_fontsize'][$k]=='14') selected="selected" @endif>14 pt</option>
        <option value="16"  @if($maidian['description_fontsize'][$k]=='16') selected="selected" @endif>16 pt</option>
        <option value="18"  @if($maidian['description_fontsize'][$k]=='18') selected="selected" @endif>18 pt</option>
        <option value="24"  @if($maidian['description_fontsize'][$k]=='24') selected="selected" @endif>24 pt</option>
        <option value="30"  @if($maidian['description_fontsize'][$k]=='30') selected="selected" @endif>30 pt</option>
        <option value="36"  @if($maidian['description_fontsize'][$k]=='36') selected="selected" @endif >36 pt</option>
        <option value="48"  @if($maidian['description_fontsize'][$k]=='48') selected="selected" @endif>48 pt</option>
        <option value="60" @if($maidian['description_fontsize'][$k]=='60') selected="selected" @endif>60 pt</option>
      </select>
    </td>
    <td>
      字体颜色
    </td>
    <td>
      <select  name="maidian[description_fontcolor][]">
        <option value="#231815"  @if($maidian['description_fontcolor'][$k]=='#231815') selected="selected" @endif >默认颜色</option>
        <option value="black" @if($maidian['description_fontcolor'][$k]=='black') selected="selected" @endif>黑色</option>
        <option value="white" @if($maidian['description_fontcolor'][$k]=='white') selected="selected" @endif>白色</option>
        <option value="red" @if($maidian['description_fontcolor'][$k]=='red') selected="selected" @endif>红色</option>
        <option value="blue" @if($maidian['description_fontcolor'][$k]=='blue') selected="selected" @endif>蓝色</option>
        <option value="green" @if($maidian['description_fontcolor'][$k]=='green') selected="selected" @endif>绿色</option>
        <option value="yellow" @if($maidian['description_fontcolor'][$k]=='yellow') selected="selected" @endif>黄色</option>
      </select>
    </td>
    <td>
      字体形式
    </td>
    <td>
      <select  name="maidian[description_fontstyle][]">
        <option value="bold" @if($maidian['description_fontstyle'][$k]=='bold') selected="selected" @endif>加粗</option>
        <option value="italic" @if($maidian['description_fontstyle'][$k]=='italic') selected="selected" @endif>倾斜</option>
        <option value="normal" @if($maidian['description_fontstyle'][$k]=='normal') selected="selected" @endif>正常</option>
      </select>
    </td>
  </tr>
  <tr>
    <td>
      对齐方式
    </td>
    <td>
      <select  name="maidian[description_fontalign][]">
        <option value="left" @if($maidian['description_fontalign'][$k]=='left') selected="selected" @endif>靠左</option>
        <option value="right" @if($maidian['description_fontalign'][$k]=='right') selected="selected" @endif>靠右</option>
        <option value="center" @if($maidian['description_fontalign'][$k]=='center') selected="selected" @endif>居中</option>
        <option value="justify" @if($maidian['description_fontalign'][$k]=='justify') selected="selected" @endif>两端对齐</option>
      </select>
    </td>
    <td>
      卖点宽度
    </td>
    <td>
      <input class="InputBox" size="4"  name="maidian[description_fontwidth][]" value="{{$maidian['description_fontwidth'][$k]}}" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      卖点高度
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian["description_fontheight"][$k]}}"  name="maidian[description_fontheight][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      卖点左边
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian["description_left"][$k]}}"  name="maidian[description_left][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
  </tr>
  <tr>
    <td>
      卖点顶部
    </td>
    <td>
      <input class="InputBox" size="4" value="{{$maidian["description_top"][$k]}}"   name="maidian[description_top][]"  onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
  </tr>
  </tbody></table>

    @endforeach
    @else
      <table  id="maidianView1" class="table table-bordered table-hover dataTable"   role="grid" aria-describedby="example2_info">
        <tbody><tr>
          <td>
            卖点图片
          </td>
          <td>
            <input name="maidianfile[]" class="InputBox" type="file"  id="maidianfile">
            <input type="hidden" value="" name="maidianfilehidden[]"  id="maidianfilehidden">
          </td>
          <td>
            重复背景
          </td>
          <td>
            <select name="maidian[titlebackground][]">
              <option value="no-repeat" selected="selected">no-repeat</option>
              <option value="repeat">repeat</option>
              <option value="repeat-x">repeat-x</option>
              <option value="repeat-y">repeat-y</option>
            </select>
          </td>
          <td>
            水平位置
          </td>
          <td>
            <input class="InputBox" size="4" value="left" name="maidian[titleverposition][]" type="text">
          </td>
          <td>
            垂直位置
          </td>
          <td>
            <input class="InputBox" size="4" value="center" name="maidian[titlehorposition][]"type="text">
          </td>
        </tr>
        <tr>
          <td>
            卖点标题
          </td>
          <td>
            <input class="InputBox90" type="text" name="maidian[title][]"  id="maidiantitle">
            <input class="InputBox90" type="text"  value="卖点标题">
          </td>
          <td>
            字体大小
          </td>
          <td>
           <select  name="maidian[titlefontsize][]">
        <option value="6" @if($maidian['titlefontsize'][$k] == 6) selected="selected" @endif>6 pt</option>
        <option value="7" @if($maidian['titlefontsize'][$k] == 7) selected="selected" @endif>7 pt</option>
        <option value="8" @if($maidian['titlefontsize'][$k] == 8) selected="selected" @endif>8 pt</option>
        <option value="9" @if($maidian['titlefontsize'][$k] == 9) selected="selected" @endif>9 pt</option>
        <option value="10" @if($maidian['titlefontsize'][$k] == 10) selected="selected" @endif>10 pt</option>
        <option value="12" @if($maidian['titlefontsize'][$k] == 12) selected="selected" @endif>12 pt</option>
        <option value="14" @if($maidian['titlefontsize'][$k] == 14) selected="selected" @endif>14 pt</option>
        <option value="16" @if($maidian['titlefontsize'][$k] == 16) selected="selected" @endif>16 pt</option>
        <option value="18" @if($maidian['titlefontsize'][$k] == 18) selected="selected" @endif>18 pt</option>
        <option value="24" @if($maidian['titlefontsize'][$k] == 24) selected="selected" @endif>24 pt</option>
        <option value="30" @if($maidian['titlefontsize'][$k] == 30) selected="selected" @endif>30 pt</option>
        <option value="36" @if($maidian['titlefontsize'][$k] == 36) selected="selected" @endif>36 pt</option>
        <option value="48" @if($maidian['titlefontsize'][$k] == 48) selected="selected" @endif>48 pt</option>
        <option value="60" @if($maidian['titlefontsize'][$k] == 60) selected="selected" @endif>60 pt</option>
      </select>
          </td>
          <td>
            字体颜色
          </td>
          <td>
            <select name="maidian[titlefontcolor][]">
              <option value="#231815">默认颜色</option>
              <option value="black">黑色</option>
              <option value="white">白色</option>
              <option value="red">红色</option>
              <option value="blue">蓝色</option>
              <option value="green">绿色</option>
              <option value="yellow">黄色</option>
            </select>
          </td>
          <td>
            字体形式
          </td>
          <td>
            <select name="maidian[titlefontstyle][]">
              <option value="bold">加粗</option>
              <option value="italic">倾斜</option>
              <option value="normal">正常</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            对齐方式
          </td>
          <td>
            <select name="maidian[titlefontalign][]">
              <option value="left">靠左</option>
              <option value="right">靠右</option>
              <option value="center">居中</option>
              <option value="justify">两端对齐</option>
            </select>
          </td>
          <td>
            标题宽度
          </td>
          <td>
            <input class="InputBox" size="4" value="0" name="maidian[titlewidth][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
          <td>
            标题高度
          </td>
          <td>
            <input class="InputBox" size="4" value="0"  name="maidian[titleheight][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
          <td>
            标题左边
          </td>
          <td>
            <input class="InputBox" size="4" value="0"  name="maidian[titlemarginleft][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
        </tr>
        <tr>
          <td>
            标题顶部
          </td>
          <td>
            <input class="InputBox" size="4" value="0"  name="maidian[titlemargintop][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
        </tr>
        <tr>
          <td colspan="8">
            <hr style="color: #b2bac5; width: 99.5%; height: 1px; font-size: 1px; margin-top: 1px;">
          </td>
        </tr>
        <tr>
          <td>
            卖点描述
          </td>
          <td>
            <textarea rows="3" cols="50" id="maidiandescription"  name="maidian[description][]"></textarea>
          </td>
          <td>
            字体大小
          </td>
          <td>
          <select  name="maidian[titlefontsize][]">
        <option value="6" @if($maidian['titlefontsize'][$k] == 6) selected="selected" @endif>6 pt</option>
        <option value="7" @if($maidian['titlefontsize'][$k] == 7) selected="selected" @endif>7 pt</option>
        <option value="8" @if($maidian['titlefontsize'][$k] == 8) selected="selected" @endif>8 pt</option>
        <option value="9" @if($maidian['titlefontsize'][$k] == 9) selected="selected" @endif>9 pt</option>
        <option value="10" @if($maidian['titlefontsize'][$k] == 10) selected="selected" @endif>10 pt</option>
        <option value="12" @if($maidian['titlefontsize'][$k] == 12) selected="selected" @endif>12 pt</option>
        <option value="14" @if($maidian['titlefontsize'][$k] == 14) selected="selected" @endif>14 pt</option>
        <option value="16" @if($maidian['titlefontsize'][$k] == 16) selected="selected" @endif>16 pt</option>
        <option value="18" @if($maidian['titlefontsize'][$k] == 18) selected="selected" @endif>18 pt</option>
        <option value="24" @if($maidian['titlefontsize'][$k] == 24) selected="selected" @endif>24 pt</option>
        <option value="30" @if($maidian['titlefontsize'][$k] == 30) selected="selected" @endif>30 pt</option>
        <option value="36" @if($maidian['titlefontsize'][$k] == 36) selected="selected" @endif>36 pt</option>
        <option value="48" @if($maidian['titlefontsize'][$k] == 48) selected="selected" @endif>48 pt</option>
        <option value="60" @if($maidian['titlefontsize'][$k] == 60) selected="selected" @endif>60 pt</option>
      </select>
          </td>
          <td>
            字体颜色
          </td>
          <td>
            <select  name="maidian[description_fontcolor][]">
              <option value="#231815">默认颜色</option>
              <option value="black">黑色</option>
              <option value="white">白色</option>
              <option value="red">红色</option>
              <option value="blue">蓝色</option>
              <option value="green">绿色</option>
              <option value="yellow">黄色</option>
            </select>
          </td>
          <td>
            字体形式
          </td>
          <td>
            <select  name="maidian[description_fontstyle][]">
              <option value="bold">加粗</option>
              <option value="italic">倾斜</option>
              <option value="normal">正常</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>
            对齐方式
          </td>
          <td>
            <select  name="maidian[description_fontalign][]">
              <option value="left">靠左</option>
              <option value="right">靠右</option>
              <option value="center">居中</option>
              <option value="justify">两端对齐</option>
            </select>
          </td>
          <td>
            卖点宽度
          </td>
          <td>
            <input class="InputBox" size="4"  name="maidian[description_fontwidth][]" value="0" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
          <td>
            卖点高度
          </td>
          <td>
            <input class="InputBox" size="4" value="0"  name="maidian[description_fontheight][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
          <td>
            卖点左边
          </td>
          <td>
            <input class="InputBox" size="4" value="0"  name="maidian[description_left][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
        </tr>
        <tr>
          <td>
            卖点顶部
          </td>
          <td>
            <input class="InputBox" size="4" value="0"   name="maidian[description_top][]"  onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
          </td>
        </tr>
        </tbody></table>
    @endif

  </div>
   </form>
  </div>
</div>
<script language="javascript">

  $("#videoSavaBtn").click(function()
  {
      $("#FormView").submit();
  });
  $("#selLinkMode").change(function()
  {
      var Language =  jQuery("#selLinkMode  option:selected").val();
      //location.href = "www.baidu.com";
      location.href = '?Language='+Language;
      //alert('?Language='+Language);
 });
  $("#selLinkMod").change(function()
  {
    var Language =  jQuery("#selLinkMod  option:selected").val();
    if (Language =='zh-CN'){
     
      $("#txtProductName").show();
      $("#txtProductName2").hide();
      $("#tareaProductDesc").show();
      $("#tareaProductDesc2").hide();
      $("#en1").hide();
      $("#cn1").show();
      $("#en2").hide();
      $("#cn2").show();

    } else if(Language =='en-US'){
      
     $("#txtProductName").hide();
      $("#txtProductName2").show();
      $("#tareaProductDesc").hide();
      $("#tareaProductDesc2").show();
      $("#en1").show();
      $("#cn1").hide();
      $("#en2").show();
      $("#cn2").hide();

    }
 });
  
   //切换卖点
            $("#MaiDianTab").delegate("li","click",function(){

                var o = $("#MaiDianTab li.active");
                if(o.length>0) {
                    $("#maidianView"+ o.attr('codeid')).hide();
                     o.removeClass("active");
                }

                $(this).addClass("active");
                $("#maidianView"+ $(this).attr('codeid')).show();

            });

            //切换规格
            $("#radio1").click(function(){
                $("#ratvid").hide();
                $("#micid").hide();
                $("#soundboxid").hide();
                $("#keyboardtechid").hide();
                $("#mousetechid").show();
            });
            $("#radio2").click(function(){
                $("#ratvid").hide();
                $("#micid").hide();
                $("#soundboxid").hide();
                $("#keyboardtechid").show();
                $("#mousetechid").hide();
            });
            $("#radio3").click(function(){
                $("#ratvid").hide();
                $("#micid").show();
                $("#soundboxid").hide();
                $("#keyboardtechid").hide();
                $("#mousetechid").hide();
            });
            $("#radio4").click(function(){
                $("#ratvid").hide();
                $("#micid").hide();
                $("#soundboxid").show();
                $("#keyboardtechid").hide();
                $("#mousetechid").hide();
            });
            $("#radio5").click(function(){
                $("#ratvid").show();
                $("#micid").hide();
                $("#soundboxid").hide();
                $("#keyboardtechid").hide();
                $("#mousetechid").hide();
            });
			$("#radio6").click(function(){
                $("#ratvid2").hide();
                $("#micid2").hide();
                $("#soundboxid2").hide();
                $("#keyboardtechid2").hide();
                $("#mousetechid2").show();
            });
            $("#radio7").click(function(){
                $("#ratvid2").hide();
                $("#micid2").hide();
                $("#soundboxid2").hide();
                $("#keyboardtechid2").show();
                $("#mousetechid2").hide();
            });
            $("#radio8").click(function(){
                $("#ratvid2").hide();
                $("#micid2").show();
                $("#soundboxid2").hide();
                $("#keyboardtechid2").hide();
                $("#mousetechid2").hide();
            });
            $("#radio9").click(function(){
                $("#ratvid2").hide();
                $("#micid2").hide();
                $("#soundboxid2").show();
                $("#keyboardtechid2").hide();
                $("#mousetechid2").hide();
            });
            $("#radio10").click(function(){
                $("#ratvid2").show();
                $("#micid2").hide();
                $("#soundboxid2").hide();
                $("#keyboardtechid2").hide();
                $("#mousetechid2").hide();
            });
</script>
@include('message')
@stop