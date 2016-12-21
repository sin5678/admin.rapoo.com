
function ShowWindow(url, nWidth, nHeight) {
    if (nWidth == null || nWidth == "")
        nWidth = "700px";
    if (nHeight == null || nHeight == "")
        nHeight = "500px";
    return showDialog(url, { a: 1, b: 2 }, { width: nWidth, height: nHeight, dependent: true });
}
function OpenWindow(url, nWidth, nHeight) {
    if (nWidth == null || nWidth == "")
        nWidth = "700px";
    if (nHeight == null || nHeight == "")
        nHeight = "500px";
    var features = "height=" + nHeight + ",width=" + nWidth + ",top=0,left=0,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no";
    window.open(url, "", features);
}
function OpenWindowScroll(url, nWidth, nHeight) {
    if (nWidth == null || nWidth == "")
        nWidth = "700px";
    if (nHeight == null || nHeight == "")
        nHeight = "500px";
    var features = "height=" + nHeight + ",width=" + nWidth + ",top=0,left=0,toolbar=no,menubar=no,scrollbars=yes,resizable=no,location=no,status=no";
    window.open(url, "", features);
}
function ShowWindowScroll(url, nWidth, nHeight) {
    if (nWidth == null || nWidth == "")
        nWidth = "700px";
    if (nHeight == null || nHeight == "")
        nHeight = "500px";
    var features ="height:" + nHeight + ";width:" + nWidth + ";toolbar=no;menubar=no;scrollbars=yes;resizable=no;location=no;status=no";
    return window.showModalDialog(url, "", features);
}
function showDialog(url, args, features) {
    if (!features) features = {};
    if (!args) args = {};
    args.opener = window;
    var dialog;
    if (features.dependent && 'showModelessDialog' in window) {
        if (features.resizable == null) features.resizable = 1;
        if (features.status == null) features.status = 0;
        if (features.scroll == null) features.scroll = 0;
        var f = [];
        if (features.width) f.push('dialogWidth:' + features.width);
        if (features.height) f.push('dialogHeight:' + features.height);
        if (features.top) f.push('dialogTop:' + features.top);
        if (features.left) f.push('dialogLeft:' + features.left);
        for (var key in features) {
            if (features.hasOwnProperty(key))
                f.push(key + ':' + features[key]);
        }
        dialog = window.showModelessDialog(url, args, f.join(';'));
        dialog.moveBy = function (x, y) {
            if (x) this.dialogLeft = parseInt(this.dialogLeft) + x + 'px';
            if (y) this.dialogTop = parseInt(this.dialogTop) + y + 'px';
        }
        dialog.resizeBy = function (x, y) {
            if (x) this.dialogWidth = parseInt(this.dialogWidth) + x + 'px';
            if (y) this.dialogHeight = parseInt(this.dialogHeight) + y + 'px';
        }
        dialog.opener = window;
    } else {
        var f = [];
        for (var key in features) {
            if (features.hasOwnProperty(key))
                f.push(key + '=' + features[key]);
        }
        dialog = window.open(url, 'dialog', f.join(','));
        dialog.dialogArguments = args;
    }
    return dialog;
}
function CPos(x, y) {
    this.x = x;
    this.y = y;
}
//获取控件的位置
function GetObjPos(ATarget) {
    var target = ATarget;
    var pos = new CPos(target.offsetLeft, target.offsetTop);

    var target = target.offsetParent;
    while (target) {
        pos.x += target.offsetLeft;
        pos.y += target.offsetTop;

        target = target.offsetParent
    }

    return pos;
}
//操作页面，用到的方法
function OpenAdd() {
    ShowWindow("Operation.aspx?Code=");
    //OpenWindow("Operation.aspx?Code=");
}
function OpenModify(url) {
    ShowWindow(url);
}
function PageRefresh() {
    window.location.href = "main.aspx";
}
function OnDelete() {
    if (checkDelete()) {
        if (confirm("是否真的要删除？（Y/N）")) {
            var keys = "";
            var chList = $("input[name='chkName']");
            for (var i = 0; i < chList.length; i++) {
                if (chList[i].checked) {
                    if (keys == "")
                        keys = chList[i].value;
                    else
                        keys += "," + chList[i].value;
                }
            }
//            try {
//                getNewsID();
//            }
//            catch (ex) {
//            }
            $.ajax({
                type: "POST",
                url: "main.aspx",
                data: "Action=Delete&Code=" + keys,
                async: false,
                success: function (reValue) {
                    if (reValue == "true") {
                        alert("数据删除成功！");
                        ListRefresh();
                    }
                }
            });
        }
    }
}
function AllSelect(obj) {
    $("input[name='chkName']").attr("checked", obj.checked);
}
function ListRefresh() {
    //window.location.href = self.location.href ;
    PageRefresh();
}
function checkDelete() {
    var chList = $("input[name='chkName']");
    for (var i = 0; i < chList.length; i++) {
        if (chList[i].checked) {
            return true;
        }
    }
    alert("请选择要删除的记录！");
    return false;
}
//通用验证页面
function checkCommonData(theObj, showMsg) {
    if (theObj.value == "") {
        $("span[id='span" + theObj.id + "']").css("color", "red");
        $("span[id='span" + theObj.id + "']").html("请输入" + showMsg);
        return false;
    }
    $("span[id='span" + theObj.id + "']").html("");
    return true;
}
loadXML = function (xmlString) {
    var xmlDoc = null;
    //判断浏览器的类型
    //支持IE浏览器 
    if (!window.DOMParser && window.ActiveXObject) {   //window.DOMParser 判断是否是非ie浏览器
        var xmlDomVersions = ['MSXML.2.DOMDocument.6.0', 'MSXML.2.DOMDocument.3.0', 'Microsoft.XMLDOM'];
        for (var i = 0; i < xmlDomVersions.length; i++) {
            try {
                xmlDoc = new ActiveXObject(xmlDomVersions[i]);
                xmlDoc.async = false;
                xmlDoc.loadXML(xmlString); //loadXML方法载入xml字符串
                break;
            } catch (e) {
            }
        }
    } //支持Mozilla浏览器
    else if (window.DOMParser && document.implementation && document.implementation.createDocument) {
        try {
            domParser = new DOMParser();
            xmlDoc = domParser.parseFromString(xmlString, 'text/xml');
        }
        catch (e) {
        }
    } else {
        return null;
    }
    return xmlDoc;
}
loadXMLFile = function (xmlFile) {
    var xmlDoc = null;
    //判断浏览器的类型
    //支持IE浏览器
    if (!window.DOMParser && window.ActiveXObject) {
        var xmlDomVersions = ['MSXML.2.DOMDocument.6.0', 'MSXML.2.DOMDocument.3.0', 'Microsoft.XMLDOM'];
        for (var i = 0; i < xmlDomVersions.length; i++) {
            try {
                xmlDoc = new ActiveXObject(xmlDomVersions[i]);
                break;
            } catch (e) {
            }
        }
    }
    //支持Mozilla浏览器
    else if (document.implementation && document.implementation.createDocument) {
        try {
            /* document.implementation.createDocument('','',null); 方法的三个参数说明
            * 第一个参数是包含文档所使用的命名空间URI的字符串； 
            * 第二个参数是包含文档根元素名称的字符串； 
            * 第三个参数是要创建的文档类型（也称为doctype）
            */
            xmlDoc = document.implementation.createDocument('', '', null);
        } catch (e) {
        }
    }
    else {
        return null;
    }

    if (xmlDoc != null) {
        xmlDoc.async = false;
        xmlDoc.load(xmlFile);
    }
    return xmlDoc;
}

function setImagePreview(docObj) {
    var imgSrc = "";
    if (docObj.files && docObj.files[0]) {
        //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式 
        imgSrc = window.URL.createObjectURL(docObj.files[0]);
    }
    else {
        //IE下，使用滤镜
        docObj.select();
        imgSrc = document.selection.createRange().text;
        return imgSrc;
    }
    return imgSrc;
}
var Sys = {};
function getNavi() {
    if (navigator.userAgent.indexOf("MSIE") > 0) {
        return "MSIE";
    }
    if (isFirefox = navigator.userAgent.indexOf("Firefox") > 0) {
        return "Firefox";
    }
    if (isSafari = navigator.userAgent.indexOf("Safari") > 0) {
        return "Safari";
    }
    if (isCamino = navigator.userAgent.indexOf("Camino") > 0) {
        return "Camino";
    }
    if (isMozilla = navigator.userAgent.indexOf("Gecko/") > 0) {
        return "Gecko";
    }
}
Sys.browserTP = getNavi();
function getIframeDocument() {
    if (Sys.browserTP == "Firefox")
        return document.getElementById('rapooEditorIF').contentWindow.document;
    else //if (Sys.browserTP == "MSIE")
        return document.frames["rapooEditorIF"].document;
}
function HTMLDecode(text) {
    var temp = document.createElement("div");
    temp.innerHTML = text;
    var output = temp.innerText || temp.textContent;
    temp = null;
    return output;
}
function HTMLEncode(html) {
    var temp = document.createElement("div");
    (temp.textContent != null) ? (temp.textContent = html) : (temp.innerText = html);
    var output = temp.innerHTML;
    temp = null;
    return output;
}
function attachKeydownEvent() {
    $(":text").bind("keydown", function () {
        keydownEvent();
    });
}
function keydownEvent(event) {
    var event = event ? event : (window.event ? window.event : null);
    var key = event.keyCode || event.which;
    if (key == 13) {
        event.keyCode = 9;
    }
}