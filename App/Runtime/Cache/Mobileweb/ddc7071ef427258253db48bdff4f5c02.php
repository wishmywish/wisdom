<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="telephone=no" name="format-detection" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;

        }
        ul ,li{
            list-style: none;
        }
        body {
          background: #e5e5e5;
            /*opacity: .5;*/
            font-size: 12px;
            color: #000;
        }
        .fl{
            float: left;
        }
        .fr{
            float: right;
        }
        textarea{
            resize: none;
        }
        .content{
            width: 100%;
            background: #fff;
        }
        .content ul{
            width: 100%;
            /*margin-bottom: 5%;*/
        }
        .content ul li{
            /*min-height: 8%;*/
            line-height: 50px;
            padding: 0 5%;
            border-bottom: 1px solid #ccc;
            width: 90%;
            float: left;
        }
        .content ul li .fname{
            display: inline-block;
            width: 25%;
            text-align: left;
            float: left;
        }
        .content ul li input{
            width:73% ;
            /*height: 10%;*/
            border: none;
            line-height: 50px;
            outline: none;
        }
        .content ul li .text{
            float: left;
            margin-top: 6%;
            border: none;
            outline: none;
        }

    </style>

    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
    </script>

</head>

<body>

<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
    <div class="content">
        <div style="background: #fff;float: left;">
            <ul>
                <li style="height: 8%;"><span class="fl" style="color: #868686">取消</span><span class="fr" style="color: #FD6102">保存</span></li>
                <li>
                    <span class="fname">姓名：</span>
                    <input type="text" placeholder="请填写真实姓名">
                </li>
                <li>
                    <span class="fname">手机号码：</span>
                    <input type="text" placeholder="请输入手机号码">
                </li>
                <li>
                    <span class="fname">选择城市：</span>
                    <input type="text" placeholder="请输入省市区">
                </li>
                <li style="margin-bottom: 3%;border: none;">
                    <span class="fname">详细地址：</span>
                    <!--<textarea cols="40" rows="5" wrap="hard" placeholder="特殊要求请备注说明（选填）" style="float: left;  margin-top: 13%;"></textarea>-->
                    <textarea cols="30" rows="5" wrap="hard"  placeholder="请输入详细地址到门牌号" class="text"></textarea>
                </li>
            </ul>
        </div>
        <div style="float: left;margin: 5%;">
            <input type="checkbox">&nbsp;&nbsp;&nbsp;设为默认寄件人地址
        </div>

    </div>

    </div>
</div>
</body>
</html>