<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;

        }
        body {
         background: #E7121D;
        }
        .c_head img{
            width: 100%;
        }
        .content{
            width: 100%;
        }
        .content .s_up{
            background-image: url(/wisdom/Public/Mobileweb/Default/images/c_head2.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .content .s_content{
            width: 100%;
            float: left;
        }
        .content .s_list{
            background-image: url(/wisdom/Public/Mobileweb/Default/images/c_02.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 40%;
            margin: 15% 15% 0;
            padding: 15%;

        }
        .content .s_list p{
            width: 100%;
            text-align: center;
        }
        .content .btns{
            width: 96%;
            margin: 10% 2% 0 2%;
            text-align: center;
        }
        .btn0{
            background: url('/wisdom/Public/Mobileweb/Default/images/c_btns01.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 6% 10% 5% 15%;
            letter-spacing: 20px;
            font-weight: bold;
            display: inline-block;
            text-shadow: none;
            line-height: 20px;
        }
        .content .c_title{
            position: relative;
            text-align: center;
        }
        .content .c_title .c_msg{
            position: absolute;
            top: 75%;
            width: 70%;
            margin: 0 16%;
        }
        .content .foot{
            width: 100%;
            float: left;
        }
    </style>
    <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
    </script>

</head>

<body>
<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
        <div class="c_head">
            <img src="/wisdom/Public/Mobileweb/Default/images/c_head.jpg">
        </div>
        <div class="content">
            <div class="c_title">
                <img style="width: 100%;" src="/wisdom/Public/Mobileweb/Default/images/c_head2.jpg">
                <p class="c_msg">XXXXXXX送你一个专属祝福藏头诗，猜中其中口令还可以拿红包，快来猜猜看吧！</p>
            </div>
            <div class="s_content">
                <div class="s_list">
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                    <p>哈哈哈哈哈哈好</p>
                </div>

                <div class="btns">
                    <span class="btn0">我也要制作</span>
                </div>
            </div>

            <div class="foot">
                <img style="width: 100%" src="/wisdom/Public/Mobileweb/Default/images/s_foot.jpg" >
            </div>

        </div>

    </div><!-- /content -->
</div>
</body>
</html>