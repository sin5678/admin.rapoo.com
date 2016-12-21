<?php
// 设置此页面的过期时间(用格林威治时间表示)，只要是已经过去的日期即可。 
header("Expires: Mon, 26 Jul 1970 05:00:00 GMT");
// 设置此页面的最后更新日期(用格林威治时间表示)为当天，可以强制浏览器获取最新资料
header("Last-Modified:" . gmdate ("D, d M Y H:i:s"). "GMT");
// 告诉客户端浏览器不使用缓存，HTTP 1.1 协议
header("Cache-Control: no-cache, must-revalidate");
// 告诉客户端浏览器不使用缓存，兼容HTTP 1.0 协议
header("Pragma: no-cache");

$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
// var_dump(strpos($agent, 'iphone'));exit;
if (strpos($agent, 'micromessenger') !== FALSE) {
	// 屏蔽安卓手机微信
    echo '<html><head><meta charset="UTF-8"><title>请点击右上角在浏览器中打开</title><head><body style="border:0;padding:0;margin:0;position:fixed;left:0;top:0;background:rgba(0,0,0,0.8);filter:alpha(opacity=80);opacity: 0.9;width:100%;height:100%;z-index:100;"><img src="guide.png" style="font-size:40px;position:fixed;top:0px;right:0px;"/></body></html>';
} else if (strpos($agent, 'iphone') !== FALSE || strpos($agent, 'ipad') !== FALSE) {
    header('Location:https://itunes.apple.com/app/xiro/id967861858?mt=8');
} else if (strpos($agent, 'android') !== FALSE) {
    header('Location:http://www.xirodrone.com/downloadcenters/V1.1.1_20150527_Release.apk');
} else {
    header('Location:http://www.xirodrone.com/downloadcenter');
}
exit;
