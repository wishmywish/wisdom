<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo ($taskinfo["info"]["f_title"]); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
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
<div class="mui-content" style="">

    <?php if($taskinfo["type_label"] == 'business'): ?><div id="segmentedControl" class="mui-segmented-control" style=" border: 1px solid #C8C7CC;">

            <a class="mui-control-item mui-active" href="#item1mobile" style="border-left:1px solid #C7C7CC">产品详情</a>
            <!--<a class="mui-control-item" href="#item3mobile" style="border-left:1px solid #C7C7CC">产品详情</a>-->
            <a class="mui-control-item" href="#item2mobile" style="  border-left:1px solid #C7C7CC;">招商政策</a>
        </div><?php endif; ?>

        <div id="item1mobile" class="mui-control-content mui-active" style="margin: 10px;">
            <?php if($taskinfo["type_label"] == 'business'): ?><div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_note"]); ?></div>
                <?php elseif($taskinfo["type_label"] == 'widely'): ?>
                <div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_taskrequirements"]); ?></div>
                <?php elseif($taskinfo["type_label"] == 'push'): ?>
                <div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_taskrequirements"]); ?></div><?php endif; ?>
        </div>

        <div id="item2mobile" class="mui-control-content" style="margin: 10px;">
        <?php if($taskinfo["type_label"] == 'business'): ?><div style="margin-left: 0px;margin-right:0px;"><?php echo ($taskinfo["info"]["f_product"]); ?></div><?php endif; ?>
        </div>

        <!--<div id="item3mobile" class="mui-control-content" >-->

        <!--</div>-->

</div>


<script src="/wisdom/Public/Mobileweb/Default/js/mui.min.js"></script>
<script src="/wisdom/Public/Mobileweb/Default/js/mui.zoom.js"></script>
<script src="/wisdom/Public/Mobileweb/Default/js/mui.previewimage.js"></script>
<script>
    mui.previewImage();

</script>
</body>

</html>