@extends('layout.adminlte')
@section('content')
  <form class="form-horizontal" action="/product/store" method="post"    enctype="multipart/form-data"  id="FormView">
<div class="box">
  <div class="box-header">
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;" href="javascript:{}" id="productSavaBtn">保存</a>
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px" href="javascript:{}" id="productReviewBtn">预览</a>
    <a class="btn btn-w-m btn-primary" style="display:inline-block;width:100px;float:right;margin-right: 10px;" href="/product">返回</a>
    <h3 class="box-title" style="display:inline-block; width:300px;text-align:left;line-height:33px">新建产品</h3>
  </div>

  <div class="box-body">
    <div   class="col-sm-12">
      <table  id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <tbody><tr>
          <td style="width: 11%;">
            产品型号
          </td>
          <td style="width: 39%;">
            <input name="txtProductCode" id="txtProductCode" class="InputBox"  class="form-control Validform_error" placeholder="请输入产品型号" nullmsg="请输入产品型号" datatype="*"  type="text"><em>*</em> <span id="spantxtProductCode">
                        </span>
          </td>
          <td style="width: 11%;">
            产品名称
          </td>
          <td style="width: 39%;">
            <input name="txtProductName" id="txtProductName" class="InputBox"   type="text" class="form-control Validform_error" placeholder="请输入产品名称" nullmsg="请输入产品名称" datatype="*" ><em>*</em> <span id="spantxtProductName">
                        </span>
          </td>
        </tr>
        <tr id="trUserPwd">
          <td>
            产品分类
          </td>
          <td>
            <input name="txtProductTypeName" id="txtProductTypeName" readonly=""  class="InputBox70"  style="cursor: pointer"  type="text"class="form-control Validform_error" placeholder="请输入产品分类" nullmsg="请输入产品分类" datatype="*"><em>*</em><span id="spantxtProductTypeName"></span>
            <input name="hidProductTypeID" id="hidProductTypeID" type="hidden">

          </td>
          <td>
            产品周期
          </td>
          <td >
            <div class="span5 col-md-5" id="sandbox-container">
              <div class="input-group date">
                <input class="span2 col-md-2 form-control" type="text"  name="txtProductLifeCycle" id="txtProductLifeCycle" readonly /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
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
                <input class=" form-control InputBox" type="text" name="txtMarketTime" id="txtMarketTime" readonly /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
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
          </td>
          <td>
            产品背景图
          </td>
          <td>
            <table border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td style="width: 130px;">
                  <input name="fileSpecialtyImg" id="fileSpecialtyImg" class="InputBox"  type="file">

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

            <input type='text' name="tareaRemark"  id="tareaRemark" />
          </td>
          <td>
            卖点概述
          </td>
          <td>
            <textarea name="tareaProductDesc" id="tareaProductDesc" rows="2" cols="40"  class="form-control Validform_error" placeholder="请输入卖点概述" nullmsg="请输入卖点概述" datatype="*" ></textarea><em>*</em> <span id="spantareaProductDesc">
                            </span>
          </td>
        </tr>
        <tr>
          <td>
            产品分布
          </td>
          <td>
            <input name="txtDistributeName" id="txtDistributeName" readonly="readonly" class="InputBox90" style="width: 100%"  type="text">
            <input name="txtDistributeId" id="txtDistributeId" type="hidden">
          </td>
          <td>
            <input name="chbNewPro" id="chbNewPro" hidefocus="true" onclick="if(this.checked) document.getElementById('tbNewPro').style.display='block'; else document.getElementById('tbNewPro').style.display='none';" type="checkbox"><label for="chbNewPro">新品</label>
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
                    <input class="span2 col-md-2 form-control" type="text" name="txtProductExpire" id="txtProductExpire"  readonly /><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
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
              <option value="1">有线</option>
              <option value="2">2.4G</option>
              <option value="3">5G</option>
              <option value="4">蓝牙</option>
              <option value="5">双模</option>
              <option value="6">wifi</option>
              <option value="7">其它</option>
            </select>
          </td>
          <td colspan="2" style="border: none;">
            <table style="border: none;" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td>
                  产品价格
                </td>
                <td>
                  <input name="txtProductPrice" id="txtProductPrice" onkeyup="this.value=this.value.replace(/[^(\d|.)]/g,'');" class="InputBox70" type="text">
                </td>
                <td>
                  产品优惠价格
                </td>
                <td>
                  <input name="txtFavorablePrice" id="txtFavorablePrice" onkeyup="this.value=this.value.replace(/[^(\d|.)]/g,'');" class="InputBox70" type="text">
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
      <td colspan="2"><input class="InputBox100" type="text"  name="ProductStandard[liaohao]"></td>
    </tr>
    <tr>
      <td>质量保证</td>
      <td colspan="2"><input class="InputBox100" type="text" name="ProductStandard[Quality]"></td>
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
            <td><input value="Windows XP" id="chb1" onfocus="this.blur();" type="checkbox"  name="ProductStandard[os][xp]"   ><label for="chb1">Windows XP</label></td>
            <td><input value="Windows Vista" id="chb2" onfocus="this.blur();" type="checkbox" name="ProductStandard[os][vista]"   ><label for="chb2">Windows Vista</label></td>
            <td><input value="Windows 7" id="chb3" onfocus="this.blur();" type="checkbox" name="ProductStandard[os][win7]"  ><label for="chb3">Windows 7</label></td>
            <td><input value="Windows 8" id="chb4" onfocus="this.blur();" type="checkbox" name="ProductStandard[os][win8]" ><label for="chb4">Windows 8</label></td>

          </tr>
          <tr>
            <td><input value="Windows 2000" id="chb5" onfocus="this.blur();"  name="ProductStandard[os][win2000]" type="checkbox"><label for="chb5">Windows 2000</label></td>
            <td><input value="Mac OS x v10.2.8或更高版本" id="chb6" onfocus="this.blur();"   name="ProductStandard[os][macos]" type="checkbox"><label for="chb6">Mac OS x v10.2.8或更高版本</label></td>
            <td><input value="Chrome OS" id="chb7" onfocus="this.blur();" type="checkbox" name="ProductStandard[os][cos]"><label for="chb7">Chrome OS</label></td>
            <td><input value="Apple 系PC" id="chb8" onfocus="this.blur();" type="checkbox" name="ProductStandard[os][apppc]"><label for="chb8">Apple 系PC</label></td>
          </tr>
          </tbody></table>
      </td>
    </tr>
    <tr>
      <td style="width:80px;">连接技术</td>
      <td>
        <table border="0" cellpadding="1" cellspacing="1">
          <tbody><tr>
            <td><input value="USB接口" id="chb9" onfocus="this.blur();" name="ProductStandard[connect][usb]" type="checkbox"><label for="chb9">USB接口</label></td>
            <td><input value="PS/2接口" id="chb10" onfocus="this.blur();" type="checkbox" name="ProductStandard[connect][ps]"><label for="chb10">PS/2接口</label></td>
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
            <td><input value="USB适配器" id="chb11" onfocus="this.blur();" name="ProductStandard[attachment][usb]" type="checkbox"><label for="chb11">USB适配器</label></td>
            <td><input value="用户文档" id="chb12" onfocus="this.blur();" type="checkbox" name="ProductStandard[attachment][document]"><label for="chb12">用户文档</label></td>
            <td><input value="产品说明书" id="chb13" onfocus="this.blur();" type="checkbox" name="ProductStandard[attachment][book]"><label for="chb13">产品说明书</label></td>
            <td><input value="保修服务卡" id="chb14" onfocus="this.blur();" type="checkbox" name="ProductStandard[attachment][paoxiuka]"><label for="chb14">保修服务卡</label></td>
            <td><input value="AAA碱性电池" id="chb15" onfocus="this.blur();" type="checkbox" name="ProductStandard[attachment][dianchi]"><label for="chb15">AAA碱性电池</label></td>
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
            <td><input name="ProductStandard[radtype]" value="1" id="radio1"       checked="checked" onfocus="this.blur();" type="radio"><label for="radio1">鼠标</label></td>
            <td><input name="ProductStandard[radtype]"  value="2"  id="radio2"      onfocus="this.blur();" type="radio"><label for="radio2">键盘</label></td>
            <td><input name="ProductStandard[radtype]"  value="3"  id="radio3"     onfocus="this.blur();" type="radio"><label for="radio3">耳机</label></td>
            <td><input name="ProductStandard[radtype]"   value="4" id="radio4"     onfocus="this.blur();" type="radio"><label for="radio4">音箱</label></td>
            <td><input name="ProductStandard[radtype]" value="5"  id="radio5"     onfocus="this.blur();" type="radio"><label for="radio5">RATV</label></td>
          </tr>
          <tr><td colspan="5">
              <table border="0"  id="ratvid" cellpadding="2" cellspacing="2"   style="display: none;"    class="table table-bordered table-hover dataTable">
                <tbody>
                <tr>
                  <td> 模拟信号 </td><td><input name="ProductStandard[rad][ratv1]"   id=""/></td>
                  <td>  数字信号</td><td><input name="ProductStandard[rad][ratv2]"   id=""/></td>
                </tr>
                <tr>
                  <td>  输入端口</td><td><input name="ProductStandard[rad][ratv3]"   id=""/></td>
                  <td>   输出端口</td><td><input name="ProductStandard[rad][ratv4]"  id=""/></td>
                </tr>   <tr>
                  <td>   工作电压</td><td><input name="ProductStandard[rad][ratv5]"  id=""/></td>
                  <td>   工作电流</td><td><input name="ProductStandard[rad][ratv6]"  id=""/></td>
                </tr>
                <tr>
                  <td>   分辨率</td><td><input name="ProductStandard[rad][ratv7]"   id=""/></td>
                  <td>   支持TV标准</td><td> <input name="ProductStandard[rad][ratv8]"   id=""/></td>
                </tr>
                </tbody></table>

              <table border="0"    id="micid" cellpadding="2" style="display: none;"   cellspacing="2" class="table table-bordered table-hover dataTable">
                <tbody>
                <tr>
                  <td> 驱动单元 </td><td><input name="ProductStandard[rad][micid1]"  id=""/></td>
                  <td>  频率响应</td><td><input name="ProductStandard[rad][micid2]"   id=""/></td>
                </tr>
                <tr>
                  <td>  阻抗</td><td><input name="ProductStandard[rad][micid3]"  id=""/></td>
                  <td>   麦克风拾音模式</td><td><input name="ProductStandard[rad][micid4]"   id=""/></td>
                </tr>   <tr>
                  <td>   类型</td><td><input name="ProductStandard[rad][micid5]"   id=""/></td>
                  <td>   测试条件</td><td><input name="ProductStandard[rad][micid6]"   id=""/></td>
                </tr>
                <tr>
                  <td>   信噪比</td><td><input name="ProductStandard[rad][micid7]"   id=""/></td>
                  <td>   失真度</td><td> <input name="ProductStandard[rad][micid8]"   id=""/></td>
                </tr>
                </tbody></table>


              <table border="0"  id="soundboxid"  style="display: none;"    cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                <tbody>
                <tr>
                  <td> 模拟信号 </td><td><input name="ProductStandard[rad][soundboxid1]"   id=""/></td>
                  <td>  有源无源</td><td><input name="ProductStandard[rad][soundboxid2]"   id=""/></td>
                </tr>
                <tr>
                  <td>  额定功率</td><td><input name="ProductStandard[rad][soundboxid3]"  id=""/></td>
                  <td>   防磁功能</td><td><input name="ProductStandard[rad][soundboxid4]"  id=""/></td>
                </tr>   <tr>
                  <td>   频响范围（KHz）</td><td><input name="ProductStandard[rad][soundboxid5]"   id=""/></td>
                  <td>   信噪比</td><td><input name="ProductStandard[rad][soundboxid6]"   id=""/></td>
                </tr>
                <tr>
                  <td>   失真度</td><td><input name="ProductStandard[rad][soundboxid7]" id=""/></td>
                  <td>   扬声器单元（mm）</td><td> <input name="ProductStandard[rad][soundboxid8]"   id=""/></td>
                  <td>   产品重量</td><td> <input name="ProductStandard[rad][soundboxid9]"   id=""/></td>
                </tr>
                </tbody></table>



              <table border="0"  id="keyboardtechid"   style="display: none;"  cellpadding="2" cellspacing="2" class="table table-bordered table-hover dataTable">
                <tbody>
                <tr>
                  <td> 字键开关 </td><td><input name="ProductStandard[rad][keyboardtechid1]"   id=""/></td>
                  <td>  字键行程</td><td><input name="ProductStandard[rad][keyboardtechid2]"  id=""/></td>
                </tr>
                <tr>
                  <td>  工作电压</td><td><input name="ProductStandard[rad][keyboardtechid3]"   id=""/></td>
                  <td>   工作电流</td><td><input name="ProductStandard[rad][keyboardtechid4]"  id=""/></td>
                </tr>   <tr>
                  <td>   尺寸</td><td><input name="ProductStandard[rad][keyboardtechid5]"   id=""/></td>

                </tr>

                </tbody></table>


              <table border="0"  id="mousetechid"   style="display: inline;" cellpadding="2"   cellspacing="2" class="table table-bordered table-hover dataTable">
                <tbody>
                <tr>
                  <td> 按键 </td><td><input name="ProductStandard[rad][mousetechid1]"   id=""/></td>
                  <td>  最高追踪速度</td><td><input name="ProductStandard[rad][mousetechid2]"  id=""/></td>
                </tr>
                <tr>
                  <td>  最大速度</td><td><input name="ProductStandard[rad][mousetechid3]"   id=""/></td>
                  <td>   最大分辨率</td><td><input name="ProductStandard[rad][mousetechid4]"   id=""/></td>
                </tr>   <tr>
                  <td>   工作电压</td><td><input name="ProductStandard[rad][mousetechid5]"  id=""/></td>
                  <td>   工作电流</td><td><input name="ProductStandard[rad][mousetechid6]"  id=""/></td>
                </tr>
                <tr>
                  <td>   尺寸</td><td><input name="ProductStandard[rad][mousetechid7]" id=""/></td>
                  <td>   重量</td><td> <input name="ProductStandard[rad][mousetechid8]"  id=""/></td>
                </tr>
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
          <tr id="ProfileId">
            <td>
                <input name="gaiyaoFile[]" class="InputBox" id="fileID"type="file"> <i></i>
                <input type="hidden" name="gaiyaoFileHidden[]" >
            </td>
            <td id="colorTempID">
              <input type='text' name="dvProductProfileColor[]"  id="dvProductProfileColor"   value="#FFFFFF" class="dvProductProfileColor" />
            </td>
            <td>
              <a href="javascript:{}"  id="delProfileRowId" class="delProfileRowId"><i class="fa fa-times"></i></a>
            </td>
          </tr>
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
        <li   class="active" id="myTabLi" sort="0" codeid="1"><a href="javascript:;" style="cursor:pointer" id="myTabLiA" >卖点一   <i class="fa fa-times"></i></a></li>

      </ul>
    </div>

    <table  id="maidianView1" class="table table-bordered table-hover dataTable"   role="grid" aria-describedby="example2_info">
      <tbody><tr>
        <td>
          卖点图片
        </td>
        <td>
          <input name="maidianfile[]" class="InputBox" type="file" id="maidianfile"><i></i><input type="hidden" id="maidianfilehidden" name="maidianfilehidden">
        </td>
        <td>
          重复背景
        </td>
        <td>
          <select name="maidian[titlebackground][]">
            <option value="no-repeat" selected="">no-repeat</option>
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
          <input class="InputBox90" type="text" name="maidian[title][]" id="maidiantitle">
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
          <textarea rows="3" cols="50"  id="maidiandescription" name="maidian[description][]"></textarea>
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