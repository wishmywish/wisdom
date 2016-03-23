<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>导入员工</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/Index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
        var IMG = "/wisdom/Public/Admin/Default/images";
        var STATIC = "/wisdom/Public/static";
        var UPFILE = "/wisdom/Public/upfile";
        var THEME = "/wisdom/Public/Admin/Default";
        var bigMenuIndex = 0; //大类LI下标
        var smallMenuIndex = 0;//小类LI下标
    </script>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <!--cookie插件-->
    <script type="text/javascript" src="/wisdom/Public/static/cookie.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fun.js"></script>
    <script type="text/javascript" src="/wisdom/Public/Admin/Default/js/fg.menu.js"></script>
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/layer/skin/layer.css" />
    <script type="text/javascript" src="/wisdom/Public/static/layer/layer.js"></script>
    <style>

    </style>
</head>
<body>
<div style="padding:20px;">
    <a href="/wisdom/Public/upfile/download/userList.xls" style="font-size: 12px;">下载导入样例</a>
    <br>
    <br>
    <form method="post" action="<?php echo U('Group/import_do');?>" enctype="multipart/form-data" name="frm1">
        <input type="file" style="font-size: 12px;" value="上传文件" name="filename">
        <input type="submit" value="导入" name="submit" style="font-size: 12px;">
    </form>
</div>
</body>

</html>