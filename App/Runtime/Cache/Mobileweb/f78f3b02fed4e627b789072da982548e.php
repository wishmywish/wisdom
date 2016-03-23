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
            min-height: 8%;
            padding: 5%;
            border-top: 1px solid #ccc;
            width: 90%;
            float: left;
        }
        .content ul li .add_info{
            width: 60%;
            text-align: left;
        }
        .add_info p{
            line-height: 25px;
            width: 100%;
            float: left;
        }
        .content ul li .edit_btn{
            width: 30%;
            text-align: right;
            margin: 10% 0;
            color: #FD6102;
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
                <li style="line-height: 50px;padding: 0 5%;border: none;"><span class="fl" style="color: #868686">取消</span><span class="fr" style="color: #FD6102">完成</span></li>
                <li>
                   <div class="add_info fl">
                       <p><span style="  padding-right: 25%;">泡芙先生</span><span>18525662255</span></p>
                       <p  style="line-height: 20px;color: #777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                       <p  style="line-height: 20px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                   </div>
                   <div class="edit_btn fr">
                       <span class="fa fa-edit fa-2x fa-fw"></span>
                   </div>
                </li>
                <li>
                    <div class="add_info fl">
                        <p><span style="  padding-right: 25%;">红豆小姐</span><span>18525662255</span></p>
                        <p  style="line-height:20px;color: #777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                        <p  style="line-height:20px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                    </div>
                    <div class="edit_btn fr">
                        <span class="fa fa-edit fa-2x fa-fw"></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    </div>
</div>
</body>
</html>