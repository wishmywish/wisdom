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
        .content .s_left{
            width: 18%;
            float: left;
        }
        .content .s_right{
            width: 18%;
            float: right;
        }
        .content .s_content{
            width: 64%;
            float: left;
        }
        .content .s_list{
            background-image: url(/wisdom/Public/Mobileweb/Default/images/c_02.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 80%;
            /* margin: 0 0 0 0%; */
            padding: 10%;

        }
        .content .s_list p{
            width: 100%;
            text-align: center;
        }
        .content .btns{
            width: 96%;
            /* float: left; */
            margin: 10% 2% 0 2%;
            text-align: center;
            /* border: 1px solid; */
            min-height: 16%;
        }
        .btn0{
            background: url('/wisdom/Public/Mobileweb/Default/images/c_btns01.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 6% 15% 5% 20%;
            letter-spacing: 6px;
            font-weight: bold;
            display: inline-block;
            /* text-align: center; */
            text-shadow: none;
            line-height: 20px;
            /* text-indent: 21px; */
        }
        .btn1{
            background: url('/wisdom/Public/Mobileweb/Default/images/c_btns02.png');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 5% 2% 5% 10%;
            font-weight: bold;
            text-shadow: none;
            border: none;
            margin: 4% 0 0 0;
        }
        .btns1{
            width: 76%;
            padding: 5% 12%;
            height: 5%;
        }
         .btns1  .btn2{
             background: url('/wisdom/Public/Mobileweb/Default/images/c_btns03.png');
             background-size: 100% 100%;
             background-repeat: no-repeat;
             padding: 3% 0% 3% 0%;
             letter-spacing: 6px;
             font-weight: bold;
             display: inline-block;
             text-align: center;
             text-shadow: none;
             line-height: 20px;
             width: 47%;
             margin: 0 1%;
             float: left;
        }
        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
            color: #b40104;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color:    #b40104;
            opacity:  1;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            color:    #b40104;
            opacity:  1;
        }
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
            color:    #b40104;
        }
        .content .choose_box{
            width: 100%;
            text-align: center;
        }
        .content  .tips{
            width: 100%;
            text-align: center;
            float: left;
            line-height: 25px;

        }
        .bg{
            font-weight: bold;
            font-size: 14px;
        }
       .sm{
           font-size: 12px;

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
        <div class="c_head"><img src="/wisdom/Public/Mobileweb/Default/images/c_head.jpg"></div>
        <div class="content">
            <div class="s_left">
                <img style="width: 100%;" src="/wisdom/Public/Mobileweb/Default/images/c_dl1.jpg">
            </div>
            <div class="s_right">
                <img style="width: 100%;" src="/wisdom/Public/Mobileweb/Default/images/c_dl2.jpg">
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
                    <!--<img style="width: 100%;" src="/wisdom/Public/Mobileweb/Default/images/c_btns01.png"> -->
                    <span class="btn0">藏头诗制作</span>
                    <input class="btn1" type="text" placeholder="输入你的祝福（口令）">
                </div>
                <p style="font-size: 12px;  text-align: center;  line-height: 25px;">限8字并选取诗中的字词建立一个口令</p>
            </div>
            <div style="width: 100%;float: left;">
                <div class="choose_box">
                    <label>藏头<input name="choice" type="radio" value="" /> </label>
                    <label>藏尾<input name="choice" type="radio" value="" /> </label>
                    <label>藏中<input name="choice" type="radio" value="" /> </label>
                    <label>递增<input name="choice" type="radio" value="" /> </label>
                    <label>递减<input name="choice" type="radio" value="" /> </label>
                </div>
                <div class="btns1">
                    <span class="btn2">生成</span>
                    <span class="btn2">我要分享</span>
                </div>
                <p class="tips bg">试一试将祝福输入支付宝口令红包中</p>
                <p class="tips bg">请好友来猜口令、拆红包</p>
                <p class="tips sm">进入支付宝→选群红包→发红包→使用红包口令→输入祝福口令</p>
            </div>
            <div class="foot">
                <img style="width: 100%" src="/wisdom/Public/Mobileweb/Default/images/s_foot.jpg" >
            </div>

        </div>

    </div><!-- /content -->
</div>
</body>
</html>