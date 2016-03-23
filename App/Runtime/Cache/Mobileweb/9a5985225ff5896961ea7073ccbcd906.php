<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <head>
        <title><?php echo ($webtitle); ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/MODULE_NAME/DEFAULT_THEME/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/MODULE_NAME/DEFAULT_THEME";
        </script>

        <link rel="stylesheet" type="text/css" href="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/um/themes/default/css/umeditor.css" />
    </head>

</head>
 <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/js/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/base64.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/md5.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/sha1.js"></script>
<script type="text/javascript" src="/wisdom/Public/static/js/config.min.js"></script>
<script type="text/javascript" src="/wisdom/Public/MODULE_NAME/DEFAULT_THEME/js/fun.js"></script>


<!--ueditor编译器源码文件-->
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.config.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/umeditor.min.js"></script>
    <script type="text/javascript" src="/wisdom/Public/static/um/lang/zh-cn/zh-cn.js"></script>

 <body>
    <?php if(($re) != ""): ?><div style="position: fixed; top: 0;">
            <?php if(is_array($re)): $k = 0; $__LIST__ = $re;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div>
                    <p style="font-size: 14px">第<?php echo ($k); ?>题：正确答案是第<?php echo ($vo["f_userchange"]); ?>个，您选择的是第<?php echo ($vo["f_answer"]); ?>个。</p>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
             <div>
                <p style="font-size: 16px">正确答题<?php echo ($trueCount); ?>题，错误答题<?php echo ($falseCount); ?>题，您获得<?php echo ($goldCount); ?>个金币。</p>
             </div>
         </div><?php endif; ?>
</body>
</html>