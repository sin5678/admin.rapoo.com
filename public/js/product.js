/**
 * Created by zhangxiaoqiu on 2015/11/23.
 */

var NumberToCnNumberMap = ["一","二","三","四","五","六","七","八","九","十"];
var RapWindow = {
    open:function(url,achor)
    {
        window.open(url, "new", " height=800,width=1050,  Left=300px,Top="+achor+"px,alwaysRaised=yes, menubar=no,titlebar=no,scrollbar=YES,toolbar=no, status=no,location=no");
    }
}

var Product =
{
    createProductInit:function()
    {
        var self = this;
        $(document).ready(function(){
            var mydate = new Date(),
                year=mydate.getFullYear(), //获取完整的年份(4位,1970-????)
                mouth=mydate.getMonth(), //获取当前月份(0-11,0代表1月)
                day=mydate.getDate();//获取当前日(1-31)
                today=year+"-"+(mouth+1)+"-"+day;

            $('.input-group.date').datepicker({
                format: "yyyy-mm-dd 00:00:00",
                language: "zh-CN"
            });

            $("#tareaRemark").spectrum({
                preferredFormat: "hex",
                color:  $("#tareaRemark").val(), hideAfterPaletteSelect:true,
                showAlpha: true,showInput:true
            });

            $("#txtProductTypeName").click(function()
            {
                self.openProductTypeMultiWindow(300,'2','Product.doneSelectProductType');
            });

            $("#txtDistributeName").click(function(){
                self.openAreaWindow(300);
            });

            if( $(".dvProductProfileColor").length>1){
                $(".dvProductProfileColor").each(function(){
                    $(this).spectrum({
                        preferredFormat: "hex",
                        color: $(this).val(), hideAfterPaletteSelect:true,
                        showInput: true ,
                        showAlpha: true,clickoutFiresChange: true
                    });
                });
            }else {
                $(".dvProductProfileColor").spectrum({
                    preferredFormat: "hex",
                    color: $(".dvProductProfileColor").val(), hideAfterPaletteSelect: true,
                    showInput: false,
                    showAlpha: true, showInput: true,clickoutFiresChange: true
                });
            }

            //产品概要图
            $("#addProfileId").click(function(){

                var o =  $("#ProfileInsertAfterID").next().clone().insertAfter($("#ProfileInsertAfterID"));
                o.find("#colorTempID").html("<input type='text' name='dvProductProfileColor[]' value='#FFFFFF'  id='dvProductProfileColor'  class='dvProductProfileColor' />");

                //del file
                var file =o.find("#fileID");
                file.next().html("");
                file.after(file.clone().val(""));
                file.remove();



                $(".dvProductProfileColor").each(function(){
                    $(this).spectrum({
                        preferredFormat: "hex",
                        color: $(this).val(), hideAfterPaletteSelect:true,
                        showInput: true ,
                        showAlpha: true,clickoutFiresChange: true

                    });
                });
            });

            $("#dvProductProfile").delegate(".delProfileRowId","click",function(){
                     var lenght=$(".delProfileRowId").length;

                    if(lenght>1)
                    {
                        $(this).parent().parent().remove();
                    }else
                    {
                        alert("只有一个了别删了");
                    }
            });


            //新增卖点
            $("#myTabAddActionID").click(function(){
                var length=$("#MaiDianTab li").length;
                if(length>10)
                {
                    alert("最多能有十个，不要加了");
                    return;
                }

                $("#maidianView"+$("#MaiDianTab li.active").attr("codeid")).hide();
                $("#MaiDianTab li.active").removeClass("active");

                var o = $("#MaiDianTab li:last").clone().insertBefore($("#myTabLi"));

                length=$("#MaiDianTab li").length;

                o.find("#myTabLiA").html("卖点"+NumberToCnNumberMap[length-2]+" <i   class=\"fa fa-times\"></i>");
                o.addClass("active");
                o.attr('codeid',length-1);

                var b= $(".tabContainer").next().clone().insertAfter( $(".tabContainer").next());

                //del file
                var file =b.find("#maidianfile");
                file.next().html("");
                file.after(file.clone().val(""));
                file.remove();

                b.find("#maidianfilehidden").val("");
                b.find("#idmaidiandescription").val("");
                b.find("#maidiantitle").val("");

                b.show(1000,function(){
                    b.attr("id","maidianView"+(length-1));
                });

            });

            //删除卖点
            $("#MaiDianTab").delegate('.fa-times','click',function(){

                var length=$("#MaiDianTab li").length;
                if(length<=2)
                {
                    alert("不要删除了，再删除没有了");
                    return;
                }
                var codeid = $(this).parent().parent().attr('codeid');
                $("#maidianView"+codeid).remove();
                $(this).parent().parent().remove();

                length=$("#MaiDianTab li").length;

                //更新整个绑定关系
                $("#MaiDianTab li").each(function(){

                    if( $(this).attr('sort')!="undefined")
                    {
                        $(this).find("#myTabLiA").html("卖点"+NumberToCnNumberMap[length-1]+" <i   class=\"fa fa-times\"></i>");
                        $("#maidianView"+ $(this).attr('codeid')).attr("id","maidianView"+length);
                        $(this).attr('codeid',length);
                        length--;
                    }
                });
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
        });
    },
    openAreaWindow:function(achor)
    {
        RapWindow.open('/countryarea/list',achor);
    },
    openProductTypeWindow:function(achor,type,callback)
    {
        RapWindow.open('/product/producttype_select/?id='+type+"&callback="+callback,achor);
    },
    openProductTypeMultiWindow:function(achor,type,callback)
    {
        RapWindow.open('/product/producttype_multi/?id='+type+"&callback="+callback,achor);
    },
    doneProductTypeWindowOnCategoryPage:function(val)
    {
        var name = "" ;

        if(val.names!="undefined" && val.names.lastIndexOf(">")>=0)
        {
            name =  val.names.substring(val.names.lastIndexOf(">")+1);
        }else
        {
            name =  val.names;
        };
        window.opener.$("#txtParentPTypeName").val(name);
        window.opener.$("#parent_id").val(val.ids);
    },
    doneSelectProductType:function(val)
    {
        var name = "" ;

        if(val.names!="undefined")
        {
            var names= val.names.split(",");

            for(var i=0;i<names.length;i++)
            {
                if(names[i].length>0 && names[i].lastIndexOf(">")>=0)
                {
                    names[i] =  names[i].substring(names[i].lastIndexOf(">")+1);
                }
            }

            name = names.join(",");

        }
        window.opener.$("#txtProductTypeName").val(name);
        window.opener.$("#hidProductTypeID").val(val.ids);
    },
    doneArea:function(val)
    {
        window.opener.$("#txtDistributeName").val(val.names);
        window.opener.$("#txtDistributeId").val(val.ids);
    }

}
