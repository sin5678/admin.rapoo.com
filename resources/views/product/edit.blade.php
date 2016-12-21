@extends('layout.adminlte')
@section('content')
  <form class="form-horizontal" action="/product/modify" method="post"    enctype="multipart/form-data"  id="FormView">
    <input type="hidden" value="{{$pid}}" name="pid" />
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="javascript:{}" id="productSavaBtn">保存</a>
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px" href="javascript:{}" id="productReviewBtn">预览</a>
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px;" href="/product">返回</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">编辑产品</h3>
  </div>

  <div class="box-body">
    <div   class="col-sm-12">
      <table  id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <tbody><tr>
          <td style="width: 11%;">
            产品型号
          </td>
          <td style="width: 39%;">
            <input name="txtProductCode" id="txtProductCode" value="{{$product->ProductCode}}" class="InputBox"  class="form-control Validform_error" placeholder="请输入产品型号" nullmsg="请输入产品型号" datatype="*"  type="text"><em>*</em> <span id="spantxtProductCode">
                        </span>
          </td>
          <td style="width: 11%;">
            产品名称
          </td>
          <td style="width: 39%;">
            <input name="txtProductName" id="txtProductName" class="InputBox" value="{{$product->ProductName}}"   type="text" class="form-control Validform_error" placeholder="请输入产品名称" nullmsg="请输入产品名称" datatype="*" ><em>*</em> <span id="spantxtProductName">
                        </span>
          </td>
        </tr>
        <tr id="trUserPwd">
          <td>
            产品分类
          </td>
          <td>
            <input name="txtProductTypeName" id="txtProductTypeName" readonly=""  class="InputBox70"
                   value="{{$product->ProductNames}}"
                   style="cursor: pointer"  type="text"class="form-control Validform_error" placeholder="请输入产品分类" nullmsg="请输入产品分类" datatype="*"><em>*</em><span id="spantxtProductTypeName"></span>
            <input name="hidProductTypeID" id="hidProductTypeID" type="hidden" value="{{$product->ProductType}}">

          </td>
          <td>
            产品周期
          </td>
          <td >
            <div class="span5 col-md-5" id="sandbox-container">
              <div class="input-group date">
                <input class="span2 col-md-2 form-control" type="text"  name="txtProductLifeCycle" value="{{$product->ProductLifeCycle}}" id="txtProductLifeCycle" readonly /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>
          </td>
        </tr>

        <tr>

          <td>
            上市时间
          </td>
          <td>

            <div class="span5 col-md-5" id="sandbox-container">
              <div class="input-group date">
                <input class=" form-control InputBox" type="text" name="txtMarketTime" id="txtMarketTime" readonly value="{{$product->MarketTime}}"  /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
              </div>
            </div>

          </td>
        </tr>
        <tr>
          <td>
            产品展现图
          </td>
          <td>
            <input name="fileProductImg" id="fileProductImg" class="InputBox"   type="file">
            <input name="fileProductImgHidden" id="fileProductImgHidden"  value="{{$product->ProductImg}}"   type="hidden">
          </td>
          <td>
            产品背景图
          </td>
          <td>
            <table border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td style="width: 130px;">
                  <input name="fileSpecialtyImg" id="fileSpecialtyImg" class="InputBox"  type="file">
                  <input name="fileSpecialtyImgHidden" id="fileSpecialtyImgHidden"  value="{{$product->ProductBigImg}}"   type="hidden">
                </td>

              </tr>
              </tbody></table>
          </td>
        </tr>
        <tr>
          <td>
            标题颜色：
          </td>
          <td>

            <input type='text' name="tareaRemark"  id="tareaRemark" value="{{$product->Remark}}" />
          </td>
          <td>
            卖点概述
          </td>
          <td>
            <textarea name="tareaProductDesc" id="tareaProductDesc" rows="2" cols="40"  class="form-control Validform_error"  placeholder="请输入卖点概述" nullmsg="请输入卖点概述" datatype="*" >
              {{$product->ProductDesc}}
            </textarea><em>*</em> <span id="spantareaProductDesc"></span>
          </td>
        </tr>
        <tr>
          <td>
            产品分布
          </td>
          <td>
            <input name="txtDistributeName" id="txtDistributeName" readonly="readonly" class="InputBox90" style="width: 100%"  value="{{$countryName}}" type="text">
            <input name="txtDistributeId" id="txtDistributeId"  value="{{$countryIds}}" type="hidden">
          </td>
          <td>
            <input name="chbNewPro" id="chbNewPro" hidefocus="true"
                   onclick="if(this.checked) document.getElementById('tbNewPro').style.display='block'; else document.getElementById('tbNewPro').style.display='none';" type="checkbox"><label for="chbNewPro">新品</label>
          </td>
          <td style="text-align: left;">
            <table id="tbNewPro" style="width: 335px; border: none;
                            display: none;" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td>
                  有效期限
                </td>
                <td>
                  <div class="input-group date">
                    <input class="span2 col-md-2 form-control"   type="text" name="txtProductExpire" id="txtProductExpire"  readonly /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                  </div>

                </td>
                <td>
                  <em>*</em><span id="spantxtProductExpire"></span>
                </td>
              </tr>
              </tbody></table>

          </td>
        </tr>
        <tr>
          <td>
            连接方式
          </td>
          <td>
            <select name="selLinkMode" id="selLinkMode" style="width: 80px;">
              <option value="1" @if($product->LinkMode == 1) selected="selected" @endif>有线</option>
              <option value="2" @if($product->LinkMode == 2) selected="selected" @endif>2.4G</option>
              <option value="3" @if($product->LinkMode == 3) selected="selected" @endif>5G</option>
              <option value="4" @if($product->LinkMode == 4) selected="selected" @endif>蓝牙</option>
              <option value="5" @if($product->LinkMode == 5) selected="selected" @endif>双模</option>
              <option value="6" @if($product->LinkMode == 6) selected="selected" @endif>wifi</option>
              <option value="7"  @if($product->LinkMode == 7) selected="selected" @endif>其它</option>
            </select>
          </td>
          <td colspan="2" style="border: none;">
            <table style="border: none;" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td>
                  产品价格
                </td>
                <td>
                  <input name="txtProductPrice" id="txtProductPrice" onkeyup="this.value=this.value.replace(/[^(\d|.)]/g,'');" value="{{$product->ProductPrice}}" class="InputBox70" type="text">
                </td>
                <td>
                  产品优惠价格
                </td>
                <td>
                  <input name="txtFavorablePrice" id="txtFavorablePrice" onkeyup="this.value=this.value.replace(/[^(\d|.)]/g,'');"  value="{{$product->FavorablePrice}}" class="InputBox70" type="text">
                </td>
              </tr>
              </tbody></table>
          </td>
        </tr>
        </tbody></table>
    </div>
    </div>
  </div><!-- /.box-body -->

<div class="box">
  <div class="box-header">
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品规格</h3>
  </div>
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
            <td><input value="Windows XP" @if(array_key_exists('OS',$productStardard)&& array_key_exists('xp',$productStardard['OS']))  checked ='checked' @endif id="chb1" onfocus="this.blur();" type="checkbox"  name="ProductStandard[OS][xp]"   ><label for="chb1">Windows XP</label></td>
            <td><input value="Windows Vista" id="chb2" onfocus="this.blur();"  @if(array_key_exists('OS',$productStardard)&&array_key_exists('vista',$productStardard['OS']))  checked ='checked' @endif type="checkbox" name="ProductStandard[OS][vista]"   ><label for="chb2">Windows Vista</label></td>
            <td><input value="Windows 7" id="chb3" onfocus="this.blur();"   @if(array_key_exists('OS',$productStardard)&&array_key_exists('win7',$productStardard['OS']))  checked ='checked' @endif type="checkbox" name="ProductStandard[OS][win7]"  ><label for="chb3">Windows 7</label></td>
            <td><input value="Windows 8" id="chb4" onfocus="this.blur();" @if(array_key_exists('OS',$productStardard)&&array_key_exists('win8',$productStardard['OS']))  checked ='checked' @endif type="checkbox" name="ProductStandard[OS][win8]" ><label for="chb4">Windows 8</label></td>

          </tr>
          <tr>
            <td><input value="Windows 2000" id="chb5" onfocus="this.blur();"  name="ProductStandard[OS][win2000]" @if(array_key_exists('OS',$productStardard)&&array_key_exists('win2000',$productStardard['OS']))  checked ='checked' @endif type="checkbox"><label for="chb5">Windows 2000</label></td>
            <td><input value="Mac OS x v10.2.8或更高版本" id="chb6" onfocus="this.blur();"  @if(array_key_exists('OS',$productStardard)&&array_key_exists('macos',$productStardard['OS']))  checked ='checked' @endif  name="ProductStandard[OS][macos]" type="checkbox"><label for="chb6">Mac OS x v10.2.8或更高版本</label></td>
            <td><input value="Chrome OS" id="chb7" onfocus="this.blur();" type="checkbox" @if(array_key_exists('OS',$productStardard)&&array_key_exists('cos',$productStardard['OS']))  checked ='checked' @endif  name="ProductStandard[OS][cos]"><label for="chb7">Chrome OS</label></td>
            <td><input value="Apple 系PC" id="chb8" onfocus="this.blur();" type="checkbox" @if(array_key_exists('OS',$productStardard)&&array_key_exists('apppc',$productStardard['OS']))  checked ='checked' @endif name="ProductStandard[OS][apppc]"><label for="chb8">Apple 系PC</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>
    <tr>
      <td style="width:80px;">连接技术</td>
      <td>
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="USB接口" id="chb9" onfocus="this.blur();" name="ProductStandard[connect][usb]"  @if(array_key_exists('connect',$productStardard)&& array_key_exists('usb',$productStardard['connect']))  checked ='checked' @endif type="checkbox"><label for="chb9">USB接口</label></td>
            <td><input value="PS/2接口" id="chb10" onfocus="this.blur();" type="checkbox" name="ProductStandard[connect][ps]"  @if(array_key_exists('connect',$productStardard)&& array_key_exists('ps',$productStardard['connect']))  checked ='checked' @endif><label for="chb10">PS/2接口</label></td>
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
            <td><input value="USB适配器" id="chb11" onfocus="this.blur();"  @if(array_key_exists('attachment',$productStardard)&&array_key_exists('usb',$productStardard['attachment']))  checked ='checked' @endif  name="ProductStandard[attachment][usb]" type="checkbox"><label for="chb11">USB适配器</label></td>
            <td><input value="用户文档" id="chb12" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&& array_key_exists('document',$productStardard['attachment']))  checked ='checked' @endif type="checkbox" name="ProductStandard[attachment][document]"><label for="chb12">用户文档</label></td>
            <td><input value="产品说明书" id="chb13" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&& array_key_exists('book',$productStardard['attachment']))  checked ='checked' @endif  type="checkbox" name="ProductStandard[attachment][book]"><label for="chb13">产品说明书</label></td>
            <td><input value="保修服务卡" id="chb14" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&array_key_exists('paoxiuka',$productStardard['attachment']))  checked ='checked' @endif  type="checkbox" name="ProductStandard[attachment][paoxiuka]"><label for="chb14">保修服务卡</label></td>
            <td><input value="AAA碱性电池" id="chb15" onfocus="this.blur();" @if(array_key_exists('attachment',$productStardard)&&array_key_exists('dianchi',$productStardard['attachment']))  checked ='checked' @endif  type="checkbox" name="ProductStandard[attachment][dianchi]"><label for="chb15">AAA碱性电池</label></td>
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
            <td><input name="ProductStandard[radtype]" value="1" id="radio1"    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='1')  checked ='checked' @endif  onfocus="this.blur();" type="radio"><label for="radio1">鼠标</label></td>
            <td><input name="ProductStandard[radtype]"  value="2"  id="radio2"    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='2')  checked ='checked' @endif onfocus="this.blur();" type="radio"><label for="radio2">键盘</label></td>
            <td><input name="ProductStandard[radtype]"  value="3"  id="radio3"   @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='3')  checked ='checked' @endif  onfocus="this.blur();" type="radio"><label for="radio3">耳机</label></td>
            <td><input name="ProductStandard[radtype]"   value="4" id="radio4"   @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='4')  checked ='checked' @endif  onfocus="this.blur();" type="radio"><label for="radio4">音箱</label></td>
            <td><input name="ProductStandard[radtype]" value="5"  id="radio5"   @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='5')  checked ='checked' @endif onfocus="this.blur();" type="radio"><label for="radio5">RATV</label></td>
            </tr>
            <tr><td colspan="5">

                <table border="0"  id="mousetechid" cellpadding="2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='1')  style="display: block" @else style="display: none"   @endif  cellspacing="2" class="table table-bordered table-hover dataTable">
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

                <table border="0"  id="keyboardtechid"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='2')  style="display: block" @else style="display: none"   @endif  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
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

                  <table border="0"    @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='3')  style="display: block" @else style="display: none"   @endif  id="micid" cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
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
                    </tbody></table>


                  <table border="0"  id="soundboxid"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='4')  style="display: block" @else style="display: none"   @endif  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
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
                <table border="0"  id="ratvid" cellpadding="2" cellspacing="2"  @if(array_key_exists('radtype',$productStardard)&&$productStardard['radtype']=='5')  style="display: block" @else style="display: none"   @endif  class="table table-bordered table-hover dataTable">
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
              </td></tr>
          </tbody></table>
      </td>
    </tr>

    </tbody></table>
</div>
<div class="box">
<div class="box-header">
<h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品概要图及颜色</h3>
</div>
  <div class="box-body">
    <div id="dvProductProfile" style="margin: 2px;">
       <table id="d"   class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <tbody>
          <tr id="ProfileInsertAfterID">
            <td>
              产品概要图
            </td>
            <td>
              产品颜色
            </td>
            <td>
              <img src="../../images/jia.png" alt="新增" isadd="1" title="新增" style="cursor: pointer;"  id="addProfileId">
            </td>
          </tr>
          @if((count($productFiles)==0))
            <tr id="ProfileId">
              <td>
                <input name="gaiyaoFile[]" class="InputBox" id="fileID"type="file"><i></i>

                <input type="hidden" name="gaiyaoFileHidden[]" value="">

              </td>
              <td id="colorTempID">
                <input type='text' name="dvProductProfileColor[]"  id="dvProductProfileColor"  value="#FFFFFF" class="dvProductProfileColor" />
              </td>
              <td>
                <a href="javascript:{}"  id="delProfileRowId" class="delProfileRowId"><i class="fa fa-times"></i></a>
              </td>
            </tr>
          @else
            @foreach($productFiles as $files)
              <tr id="ProfileId">
                <td>
                  <input name="gaiyaoFile[]" class="InputBox" id="fileID"type="file"> <i>{{$files->ProductProfileImg}}</i>
                  <input type="hidden" name="gaiyaoFileHidden[]" value="{{$files->ProductProfileImg}}">
                </td>
                <td id="colorTempID">
                  <input type='text' name="dvProductProfileColor[]"  id="dvProductProfileColor"  value="{{$files->ColorValue}}" class="dvProductProfileColor" />
                </td>
                <td>
                  <a href="javascript:{}"  id="delProfileRowId" class="delProfileRowId"><i class="fa fa-times"></i></a>
                </td>
              </tr>
            @endforeach
          @endif
          </tbody>
       </table>
        </div>
    </div>
</div>
<div class="box">
  <div class="box-header">
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">产品卖点</h3>
  </div>

  <div class="box-body" >
    <div class="tabContainer">
      <ul class="nav nav-tabs" id="MaiDianTab">
        <li><a href="javascript:;" id="myTabAddActionID" style="cursor:pointer"><img src="../../images/jia.png" alt="" title="添加"></a></li>

          @if(array_key_exists('titlebackground',$maidian) && count($maidian['titlebackground'])>0)
          @foreach($maidian['titlebackground'] as $k=>$md)

              <li   @if($k==0)class="active" @endif id="myTabLi" sort="0" codeid="{{$k}}"><a href="javascript:;" style="cursor:pointer" id="myTabLiA" >卖点{{$k}} <i class="fa fa-times"></i></a></li>

          @endforeach
          @else
          <li   class="active" id="myTabLi" sort="0" codeid="1"><a href="javascript:;" style="cursor:pointer" id="myTabLiA" >卖点1 <i class="fa fa-times"></i></a></li>
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
      <input name="maidianfile[]" id="maidianfile" class="InputBox" type="file"><i>{{$maidian['file'][$k]}}</i>
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
      <input class="InputBox90" type="text" name="maidian[title][]" id="maidiantitle"  value="{{$maidian['title'][$k]}}">
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
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian['titlewidth'][$k])}}" name="maidian[titlewidth][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      标题高度
    </td>
    <td>
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian['titleheight'][$k])}}"  name="maidian[titleheight][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      标题左边
    </td>
    <td>
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian['titlemarginleft'][$k])}}"  name="maidian[titlemarginleft][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
  </tr>
  <tr>
    <td>
      标题顶部
    </td>
    <td>
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian['titlemargintop'][$k])}}"  name="maidian[titlemargintop][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
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
      <textarea rows="3" cols="50"  id="maidiandescription" name="maidian[description][]">{{$maidian['description'][$k]}}</textarea>
    </td>
    <td>
      字体大小
    </td>
    <td>
      <select   name="maidian[description_fontsize][]">
        <option value="6"  @if(intval($maidian['description_fontsize'][$k])=='6') selected="selected" @endif>6 pt</option>
        <option value="7" @if(intval($maidian['description_fontsize'][$k])=='7') selected="selected" @endif>7 pt</option>
        <option value="8" @if(intval($maidian['description_fontsize'][$k])=='8') selected="selected" @endif>8 pt</option>
        <option value="9" @if(intval($maidian['description_fontsize'][$k])=='9') selected="selected" @endif>9 pt</option>
        <option value="10"  @if(intval($maidian['description_fontsize'][$k])=='10') selected="selected" @endif>10 pt</option>
        <option value="12"  @if(intval($maidian['description_fontsize'][$k])=='12') selected="selected" @endif>12 pt</option>
        <option value="14"  @if(intval($maidian['description_fontsize'][$k])=='14') selected="selected" @endif>14 pt</option>
        <option value="16"  @if(intval($maidian['description_fontsize'][$k])=='16') selected="selected" @endif>16 pt</option>
        <option value="18"  @if(intval($maidian['description_fontsize'][$k])=='18') selected="selected" @endif>18 pt</option>
        <option value="24"  @if(intval($maidian['description_fontsize'][$k])=='24') selected="selected" @endif>24 pt</option>
        <option value="30"  @if(intval($maidian['description_fontsize'][$k])=='30') selected="selected" @endif>30 pt</option>
        <option value="36"  @if(intval($maidian['description_fontsize'][$k])=='36') selected="selected" @endif >36 pt</option>
        <option value="48"  @if(intval($maidian['description_fontsize'][$k])=='48') selected="selected" @endif>48 pt</option>
        <option value="60" @if(intval($maidian['description_fontsize'][$k])=='60') selected="selected" @endif>60 pt</option>
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
      <input class="InputBox" size="4"  name="maidian[description_fontwidth][]" value="{{str_replace("px","",$maidian['description_fontwidth'][$k])}}" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      卖点高度
    </td>
    <td>
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian["description_fontheight"][$k])}}"  name="maidian[description_fontheight][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
    <td>
      卖点左边
    </td>
    <td>
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian["description_left"][$k])}}"  name="maidian[description_left][]" onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
    </td>
  </tr>
  <tr>
    <td>
      卖点顶部
    </td>
    <td>
      <input class="InputBox" size="4" value="{{str_replace("px","",$maidian["description_top"][$k])}}"   name="maidian[description_top][]"  onkeyup="value=value.replace(/[^\d]/g,'')" type="text">
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
            <input name="maidianfile[]" class="InputBox" type="file"  id="maidianfile"><i></i>
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
          </td>
          <td>
            字体大小
          </td>
          <td>
            <select  name="maidian[titlefontsize][]">
              <option value="6">6 pt</option>
              <option value="7">7 pt</option>
              <option value="8">8 pt</option>
              <option value="9" selected="selected">9 pt</option>
              <option value="10">10 pt</option>
              <option value="12">12 pt</option>
              <option value="14">14 pt</option>
              <option value="16">16 pt</option>
              <option value="18">18 pt</option>
              <option value="24">24 pt</option>
              <option value="30">30 pt</option>
              <option value="36">36 pt</option>
              <option value="48">48 pt</option>
              <option value="60">60 pt</option>
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
            <select   name="maidian[description_fontsize][]">
              <option value="6">6 pt</option>
              <option value="7">7 pt</option>
              <option value="8">8 pt</option>
              <option value="9" selected="selected">9 pt</option>
              <option value="10">10 pt</option>
              <option value="12">12 pt</option>
              <option value="14">14 pt</option>
              <option value="16">16 pt</option>
              <option value="18">18 pt</option>
              <option value="24">24 pt</option>
              <option value="30">30 pt</option>
              <option value="36">36 pt</option>
              <option value="48">48 pt</option>
              <option value="60">60 pt</option>
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

</div>
    {!! csrf_field() !!}
    <input type="hidden" name="isReview" id="isReview"  value="0">
</form>
<script src="/js/product.js"></script>
<script language="javascript">
  Product.createProductInit($);
  $("#productSavaBtn").click(function()
  {
      $("#FormView").attr("target","_self");
      $("#isReview").val(0);
      $("#FormView").submit();
  });

  $("#productReviewBtn").click(function()
  {
     $("#FormView").attr("target","_blank");
    $("#isReview").val(1);
    $("#FormView").submit();
  });
</script>
@include('message')
@stop