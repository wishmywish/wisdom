<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta content="telephone=no" name="format-detection" />
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
            background-image:url(/wisdom/Public/Mobileweb/Default/images/bg.jpg);
            background-repeat:no-repeat;
            background-size: 100% 100%;
        }
        .g_head img{
            width: 100%;
        }
        .content{
            width: 100%;
        }
        .content .btn01{
            background-image:url(/wisdom/Public/Mobileweb/Default/images/jf_btn1.png);
            background-repeat:no-repeat;
            background-size: 100% 100%;
            float: right;
            margin-right: 5%;
            font-size: 14px;
            padding: 2%;
        }
        .content .btn02{
            background-image:url(/wisdom/Public/Mobileweb/Default/images/jf_btn2.png);
            background-repeat:no-repeat;
            background-size: 100% 100%;
            font-size: 16px;
            color: #fff;
            padding: 3% 10%;
        }
        .content .hf{
            background-image:url(/wisdom/Public/Mobileweb/Default/images/jf_hf.png);
            background-repeat:no-repeat;
            background-size: 100% 100%;
            font-size: 24px;
            width: 100%;
            text-align: center;
            color: #fff;
            margin: 8% 0;
        }
        .content .title{
            width: 100%;
            /* height: 8%; */
            /* line-height: 50px; */
            font-size: 20px;
            padding: 6% 0;
            color: #FAF8D8;
        }
        .title .sp{
            margin: 0 5%;
        }
        .content .des1{
            width: 85%;
            font-size: 14px;
            color: #F7EB0D;
            /* text-align: center; */
            padding-left: 5%;
            line-height: 20px;
        }
        .content .des2{
            width: 87%;
            font-size: 14px;
            color: #FAF8D8;
            margin: 0 7%;
            line-height: 20px;
        }
        .content .proList{
            width: 100%;
        }
        .proList .left{
            width: 25%;
            float: left;
            border: 1px dashed #fff;
            border-radius: 5px;
            text-align: center;
            margin: 0 5%;
            /*background: #fff;*/
        }
        .proList .prolists .right{
            width: 64%;
            float: right;
        }
        .right .pro_title{
            font-size: 16px;
            font-weight: bold;
            color: #FAF8D8;
            height: 17%;
        }
        .proList .pro_price{
            font-size: 20px;
            color: #F7EB0D;
            width: 100%;
            height: 24%;
        }
        .proList .pro_buy{
            font-size: 14px;
            color: #FAF8D8;
            height: 28%;
            width: 90%;
            line-height: 30px;

        }
        .pro_buy input{
            width: 20%;
            border: 1px solid #EAEACC;
            display: inline-block;
            color: #F7EB0D;
            outline: none;
            background: #3B7463;
            margin: 0 3%;
        }
        .proList .pro_btn{
            width: 100%;
            height: 5%;
            margin: 5% 0;
        }
        .content .prolists{
            width: 100%;
            height: 20%;
            margin-bottom: 10%;
        }
        .content .cm{
            width: 80%;
            margin: 10% 10% 1% 10%;
            float: left;
            border-top: 1px solid;
            border-bottom: 1px solid;
            color: #FAF8D8;
        }
        .cm .my{
            width: 30%;
            /* line-height: 70px; */
            float: left;
            margin: 5% 0;
        }
        .cm .myCms{
            width: 60%;
            float: left;
            /* padding: 10% 0; */
            text-align: center;
            margin: 5% 0;
        }
        .content .pro_foot{
            width: 80%;
            float: left;
            margin: 3% 10%;
        }
        .pro_foot .logo1{
            width: 30%;
            float: left;
            height: 5%;
            margin: 0 0 0 4%;
            border-right: 1px solid #FAF8D8;
            padding-right: 17%;
        }
        .pro_foot .logo2{
            width: 30%;
            height: 6%;
            float: right;
            margin-right: 4%;
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
        <div class="g_head"><img src="/wisdom/Public/Mobileweb/Default/images/jf_head.png"></div>
        <div class="content">
            <div class="box">
                <p class="title">
                    <span class="sp">我的红包</span>
                    <span class="sp">2000元</span>
                    <span class="btn01">金币兑换</span>
                </p>
                <p class="des1">1元=10金币，300金币即可提现到支付宝</p>
                <p class="des1" style=" color: #FAF8D8;">活动时间：2月7日至2月14日；</p>
                <p class="des1" style=" color: #FAF8D8;">参与方式：微信关注小宝招商（xbzs0571）公众号>>>点击底部菜单栏“抢红包”>>>进入游戏</p>
                <!--<img src="/wisdom/Public/Mobileweb/Default/images/jf_hf.png"  style="width: 100%;">-->
                <p class="hf">红包兑换</p>
                <p class="des2">每件商品平均分成固定份数，每份对应一个专属“众筹码”，份数售完，开出唯一中奖码。同一件商品每次可兑换一份，可购买多次，份数越多，获得商品机率越大。</p>
                <p style="width: 100%;height: 5%;font-size: 12px;line-height: 20px;"><a style=" color: #F7EB0D;float: right">查看玩法<span style="letter-spacing: 3px;">>>></span></a></p>

                <div class="proList">
                    <div class="prolists">
                        <div class="left"><img style="width: 90%;" src="/wisdom/Public/Mobileweb/Default/images/jf_pro.png"></div>
                        <div class="right">
                            <p class="pro_title">全新苹果6S(64G)火热兑换</p>
                            <p class="pro_price">￥5.00</p>
                            <p class="pro_buy">兑换<input type="text">份&nbsp;&nbsp;&nbsp; 剩余XXXX份</p>
                            <p class="pro_btn"><span class="btn02">立即兑换</span></p>
                        </div>
                    </div>
                    <div class="prolists">
                        <div class="left"><img style="width: 90%;" src="/wisdom/Public/Mobileweb/Default/images/jf_pro.png"></div>
                        <div class="right">
                            <p class="pro_title">全新苹果6S(64G)火热兑换</p>
                            <p class="pro_price">￥5.00</p>
                            <p class="pro_buy">兑换<input type="text">份&nbsp;&nbsp;&nbsp; 剩余XXXX份</p>
                            <p class="pro_btn"><span class="btn02">立即兑换</span></p>
                        </div>
                    </div>
                    <div class="prolists">
                        <div class="left"><img style="width: 90%;" src="/wisdom/Public/Mobileweb/Default/images/jf_pro.png"></div>
                        <div class="right">
                            <p class="pro_title">全新苹果6S(64G)火热兑换</p>
                            <p class="pro_price">￥5.00</p>
                            <p class="pro_buy">兑换<input type="text">份&nbsp;&nbsp;&nbsp; 剩余XXXX份</p>
                            <p class="pro_btn"><span class="btn02">立即兑换</span></p>
                        </div>
                    </div>

                </div>
                <div class="cm">
                    <div class="my">我的筹码</div>
                    <div class="myCms">
                        <p>XXXXXXXXXXXXX</p>
                        <p>XXXXXXXXXXXXX</p>
                        <p>XXXXXXXXXXXXX</p>

                    </div>
                </div>
                <div class="pro_foot">
                    <img class="logo1" src="/wisdom/Public/Mobileweb/Default/images/jf_logo1.png" alt="">
                    <img class="logo2" src="/wisdom/Public/Mobileweb/Default/images/jf_logo2.png" alt="">
                </div>
            </div>

        </div>

    </div><!-- /content -->
</div>
</body>
</html>