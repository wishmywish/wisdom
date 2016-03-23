<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Taobao</title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
        var IMG = "/wisdom/Public/Mobileweb/Default/images";
        var STATIC = "/wisdom/Public/static";
        var UPFILE = "/wisdom/Public/upfile";
        var THEME = "/wisdom/Public/Mobileweb/Default";
    </script>
    <!--标准mui.css-->
    <script type="text/javascript" src="http://wisdom.51lick.com//Public/static/jquery-1.11.2.min.js"></script>

    <link rel="stylesheet" href="/wisdom/Public/Mobileweb/Default/css/mui.min.css">
    <!--App自定义的css-->
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/app.css"/>
    <!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">-->
    <link href="/wisdom/Public/Mobileweb/Default/css/css.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="mui-content" style="padding-bottom: 45px;">
    <div id="segmentedControl" class="mui-segmented-control" style="margin-top: 20px; border: 1px solid #C8C7CC;">
        <a class="mui-control-item mui-active" href="#item1mobile" style="  border-left:1px solid #C7C7CC;">产品参数</a>
        <a class="mui-control-item" href="#item2mobile" style="border-left:1px solid #C7C7CC">图文详情</a>

    </div>
    <div>
        <div id="item1mobile" class="mui-control-content mui-active" >
            <img src="/wisdom/Public/Mobileweb/Default/images/3.jpg"  style="width: 100%;"/>
        </div>
        <div id="item2mobile" class="mui-control-content">
            <div>
                <p>
                    <img src="/wisdom/Public/Mobileweb/Default/images/2.jpg" data-preview-src="" data-preview-group="1" />
                </p>
                <p>
                    <img src="/wisdom/Public/Mobileweb/Default/images/6.jpg" data-preview-src="" data-preview-group="1" />
                </p>
                <p>
                    <img src="/wisdom/Public/Mobileweb/Default/images/4.jpg" data-preview-src="" data-preview-group="1" />
                </p>
            </div>
        </div>
    </div>
</div>
<footer style="position: fixed; bottom: 0;  width: 90%;margin-left: 5%;">
    <button style="width: 100%; height: 40px; margin-bottom: 5px; margin-top: 5px;  color: orange; border: 1px solid orange; font-size: 16px;">立即参与</button>
</footer>


<script src="/wisdom/Public/Mobileweb/Default/js/mui.min.js"></script>
<script src="/wisdom/Public/Mobileweb/Default/js/mui.zoom.js"></script>
<script src="/wisdom/Public/Mobileweb/Default/js/mui.previewimage.js"></script>
<script>
    mui.previewImage();

</script>
</body>

</html>