<?php if (!defined('THINK_PATH')) exit();?><html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/iconfont.css" />
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
            font-family: "Helvetica Neue", Helvetica, STHeiTi, Arial, sans-serif;

        }
        ul,li{list-style: none;margin:0;padding:0;}
        body {
            background-image:url(/wisdom/Public/Mobileweb/Default/images/bg.jpg);
            background-repeat:no-repeat;
            background-size: 100% 100%;
        }
        .g_head{
            width: 100%;
        }
        .g_head img{
            width: 100%;
        }
        .content{
            width: 85%;
            border: 2px solid #000;
            margin: 1% 5% 8%;
            min-height: 200px;
            background: #fde7c0;
            padding: 2%;
        }
        .content .box{
            /*background-image:url(/wisdom/Public/Mobileweb/Default/images/bb.jpg);*/
            /*!*padding: 20px;*!*/
            /*background-repeat: no-repeat;*/
            width: 99%;
            border: 2px dotted #000;
            min-height: 200px;

        }
        .box .title{
            text-align: center;
            width: 100%;
            height: 5%;
            position: relative;
        }
        .title span{
            display: block;
            /* margin-top: -23px; */
            width: 100%;
            position: absolute;
            top: 60%;
            color: #fff;
        }
        .box .djs{
            text-align: center;
            margin: 8% 0 3% 0;
            width: 100%;
            height: 5%;
            position: relative;
        }
        .box .sort{
            text-align: center;
            margin: 8% 5% 5%;
            width: 90%;
            height: 5%;
            position: relative;
            font-weight: bold;
            border-bottom: 2px solid #000;
        }
        .box .sortList{
            width: 100%;
            font-size: 14px;
        }
        .box .sortList li{
            width: 90%;
            margin: 2% 5% 4%;
            border-bottom: 1px solid #000;
        }

        .sort span{
            color: red;
        }
        .box .kl{
            text-align: center;
            margin: 8% 0 3% 0;
            width: 100%;
            height: 5%;
            position: relative;
        }
        .djs span{
            display: block;
            /* margin-top: -23px; */
            width: 100%;
            position: absolute;
            top: 22%;
        }
        .content .box .hb{
            width: 90%;
            margin: 5% 7%;
            height: 25%;
        }
        .content .box .hb li{
            width: 20%;
            background: #C30D23;
            float: left;
            margin: 0 2% 5%;
            text-align: center;
        }
        .box .btn{
            width: 100%;
            position: relative;
            margin-bottom: 5%;
        }
        .btn span{
            display: block;
            width: 100%;
            position: absolute;
        }
        .kl span{
            display: inline-block;
            font-size: 24px;
            font-weight: bold;
            color: #f49c00;
            float: left;
            margin-left: 8%;
        }
        .btn0{
            font-size: 20px;
            margin-left: 39%;
            bottom: 26%;
        }
        .btn1 {
            margin-left: 60%;
            /* float: right; */
            font-size: 12px;
            bottom: 40%;
        }
        .btn2{
            font-size: 16px;
            margin-left: 7%;
            bottom: 10%;
            color: #fff;
        }
        .btn3{
            font-size: 16px;
            margin-left: 60%;
            bottom: 10%;
            color: #fff;
        }
        .yq{
            margin-left: 27%;
            bottom: 28%;
        }
        .yq1{
            font-size: 12px;
            color: #fff;

        }
        .rules{
            width: 100%;
            height: 6%;
            line-height: 35px;
            font-size: 14px;
        }
        .rules a{
            float: right;
            /* padding: 10px 0; */
            text-decoration: underline;
        }
        .br_line{
            width: 106%;
            height: 2%;
            background: #3B7463;
            margin: 2% -3%;
            border: 2px solid;
            border-left:none;
            border-right: none;
        }
        .kl  .hb_kl{
            right: 5%;
            /* float: right; */
            position: absolute;
            font-size: 16px;
            font-weight: normal;
            color: #000;
            top: 23%;
            width: 50%;
            text-align: center;
        }
        .iconfont{
            color: #6C0505;
            font-size: 45px;
        }
        .active{
            font-size: 45px;
            color: red;
            background: yellow;
            width: 100%;
            display: inline-block;
        }

    </style>

</head>

<body>
<div data-role="page">
    <div role="main" class="ui-content" style="padding: 0">
        <div class="g_head"><img src="/wisdom/Public/Mobileweb/Default/images/g_head.jpg"></div>
        <div class="content">
            <div class="box">
                <p class="title">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_01.png" style=" width: 106%;  margin: 0 -3%;">
                    <span>有红包才叫过年</span>
                </p>

                <p class="djs">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_02.png" style=" width: 30%;">
                    <span>30秒</span>
                </p>
                <ul class="hb">
                    <li><i  class="iconfont active">&#xe600;</i></li>
                    <li><i  class="iconfont active">&#xe600;</i></li>
                    <li><i  class="iconfont">&#xe600;</i></li>
                    <li><i  class="iconfont">&#xe600;</i></li>
                    <li><i  class="iconfont">&#xe600;</i></li>
                    <li><i  class="iconfont">&#xe600;</i></li>
                    <li><i  class="iconfont active">&#xe600;</i></li>
                    <li><i  class="iconfont active">&#xe600;</i></li>
                </ul>
                <p class="btn">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn.png" style="width: 90%;margin: 0 5%">
                    <span class="btn0">开始</span><span class="btn1">（剩余3次）</span>
                </p>
                <p class="btn">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn1.png" style="width: 90%;margin: 0 5%">
                    <span class="btn0 yq" id="">请好友帮忙</span>
                </p>

                <p class="btn">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn2.png" style="width: 90%;margin: 0 5%">
                    <span class="btn2">我的红包</span><span class="btn3">7452元</span>
                </p>
                <p style="font-size: 12px;">注：邀请6个好友帮你抢红包即可增加一次游戏机会</p>
                <p class="rules"><a>？游戏规则</a></p>
            </div>
            <div class="br_line" ></div>
            <div class="box" >
                <p class="title">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_blue.png" style=" width: 106%;  margin: 0 -3%;">
                    <span>支付宝红包口令</span>
                </p>
                <p class="djs">
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn3.png" style=" width: 80%;">
                    <span class="yq1" style=" top: 30%;">邀请6名好友帮忙，100%解开红包口令</span>
                </p>
                <p style="  padding: 1% 3%;">每天9点、15点、21点可在支付宝红包输入红包口令抢红包，每6小时更新一次。</p>
                <p class="kl">
                  <span>红包口令</span>
                    <img src="/wisdom/Public/Mobileweb/Default/images/game_btn4.png" style="width: 50%">
                    <span class="hb_kl">12121212222</span>
                </p>
            </div>
            <div class="br_line" ></div>
            <div class="box" >
                <p class="title">
                    <img src="/wisdom/Public/Mobileweb/Default/images/g_sort.png" style=" width: 106%;  margin: 0 -3%;">
                    <span>福气排行榜</span>
                </p>
                <p class="sort">
                      有<span>5</span>位好友帮我抢到了<span>150</span>元红包
                 </p>
                <ul class="sortList">
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                    <li>好友A帮我抢了5个红包 <span style="float: right;">150元</span></li>
                </ul>
            </div>
        </div>

    </div><!-- /content -->
</div>

</body>
<script>

</script>
</html>