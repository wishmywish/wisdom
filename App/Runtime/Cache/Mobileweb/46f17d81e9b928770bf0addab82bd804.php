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
            padding: 5%;
            border-top: 1px solid #ccc;
            width: 90%;
            float: left;
        }
        .content ul li .add_info{
            /*width: 60%;*/
            text-align: left;
        }
        .add_info p{
            line-height: 25px;
            width: 80%;
            float: left;
            margin-left: 10%;
        }
        .content .con1{
            width: 100%;
            float: left;
            background: #fff;
            margin-top: 2%;
        }
        .content .con1  li{
            /* min-height: 8%; */
            padding: 0 6%;
            border-top: 1px solid #ccc;
            width: 88%;
            float: left;
            line-height: 4em;
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
                <li style="line-height: 50px;padding: 0 5%;border: none;"><span class="fl" style="color: #FD6102">待取件</span><span class="fr" style="color: #868686">取消订单</span></li>
                <li>
                   <div class="add_info fl">
                       <i class="fa fa-circle fa-fw" style="color: green;float: left;line-height: 7em;"></i>
                       <p><span style="  padding-right: 25%;">泡芙先生</span><span>18525662255</span></p>
                       <p  style="line-height: 20px;color: #777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                       <p  style="line-height: 20px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                   </div>
                </li>
                <li>
                    <div class="add_info fl">
                        <i class="fa fa-circle fa-fw" style="color: red;float: left;line-height: 7em;"></i>
                        <p><span style="  padding-right: 25%;">红豆小姐</span><span>18525662255</span></p>
                        <p  style="line-height:20px;color: #777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                        <p  style="line-height:20px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="con1">
            <li>物品名称：美食</li>
            <li>物品重量：5kg</li>
            <li>备注事项：易碎轻放</li>
            <li>取件时间：立即</li>
        </ul>
        <ul class="con1">
            <li>订单编号：000000000000000000000</li>
            <li>创建时间：2015-03-12</li>
        </ul>
    </div>

    </div>
</div>
</body>
</html>