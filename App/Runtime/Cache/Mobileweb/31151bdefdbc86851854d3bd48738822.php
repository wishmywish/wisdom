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
    <!-- Mobiscroll JS and CSS Includes -->
    <link href="/wisdom/Public/Mobileweb/Default/css/mobiscroll.custom-2.16.1.min.css" rel="stylesheet" type="text/css" />
    <script src="/wisdom/Public/static/mobiscroll.custom-2.16.1.min.js" type="text/javascript"></script>
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
        textarea{
            resize: none;
        }
        .content{
            width: 100%;
            margin-bottom: 20%;
            position:relative;
            z-index:1;
        }
        .content .head{
            background: #fff;
            width: 100%;
            border-bottom: 1px solid #ccc;
        }
        .head .part1{
            border-bottom: 1px solid #CCCCCC;
            height: 7em;
            margin-left: 5%;
            /*width: 100%;*/
            /*height: 100px;*/
            /*border-bottom: 1px solid #ccc;*/
            /*margin: 0 0 0 20px;*/
        }
        .part1 .addr{
            width: 85%;
            line-height:7em;
            float: left;
            /* padding: 13% 0; */
        }
        .part1 .btn{
            width: 10%;
            padding-top:3em;
            float: right;
            text-align: center;
            /*border: 1px solid;*/
        }
        .content .c_body{
            width: 100%;
            background: #fff;
            margin-top: 3%;
        }
        .c_body .col_01{
            /*border-bottom: 1px solid #CCCCCC;*/
            min-height: 5em;
            margin-left: 5%;
        }
        .c_body .col_02{
            border-top: 1px solid #CCCCCC;
            min-height: 8em;
            /* margin-left: 5%; */
        }
        .c_body .col_03{
            border-top: 1px solid #CCCCCC;
            min-height: 13em;
            border-bottom: 1px solid #CCCCCC;

        }
        .col_01 .pro-name{
            width: 60%;
            line-height: 5em;
            float: left;
        }
        .col_02 .pro-name{
            width: 80%;
            line-height: 7em;
            float: left;
            text-align: center;
        }
        .col_03 .pro-name{
            line-height: 7em;
            float: left;
            margin-left: 5%;
        }
        .col_01 .btn{
            width: 20%;
            padding-top: 2em;
            float: right;
            text-align: center;
        }
        .btnin{
            width: 31%;
            padding-top: 2em;
            float: left;
            text-align: center;
            display: inline-block;
            border: none;
            background: #fff;
        }
        .col_02 .col_02-left{
            width: 49%;
            line-height: 4em;
            float: left;
            border-right: 1px solid #ccc;
            text-align: center;
        }
        .col_02 .col_02-right{
            width: 50%;
            float: right;
            text-align: center;
            line-height: 4em;
        }
        .col_02-right .btn input{
            border: none;
            text-align: center;
        }

        .foot{
            width: 100%;
            height: 60px;
            position: fixed;
            bottom: 0;
            z-index: 2;
        }
        .foot .c1{
            width: 80%;
            float: left;
            background: #515151;
            color: #fff;
            line-height: 30px;
        }
       .foot  .btn{
           width: 20%;
           float: right;
           text-align: center;
           background: #F96E0B;
           line-height: 60px;
           color: #fff;
        }
        .part1 .addr_info{
            float: left;
            line-height: 2em;
            width: 85%;
        }
        .addr_info p{
            line-height: 25px;
            width: 90%;
            float: left;
            /* margin: 2%; */
            margin-left: 2%;
            margin-top: 2%;

        }
        .foot1 .addr1_info{
            float: left;
            line-height: 2em;
            width: 85%;
        }
        .addr1_info p{
            line-height: 25px;
            width: 90%;
            float: left;
            /* margin: 2%; */
            margin-left: 2%;
            margin-top: 2%;

        }
        .foot1{
            width: 100%;
            position: fixed;
            bottom: 0;
            z-index: 2;
            background: #fff;
            /*height: 200px;*/
            border-top: 1px solid #ccc;
        }
        .foot1 ul li{
            min-height: 8%;
            padding: 3% 5%;
            border-top: 1px solid #ccc;
            width: 90%;
            float: left;
        }
        .fl{
            float: left;
        }
        .fr{
            float: right;
        }
        /*物件选择css*/
        .dwb-s{
            float: right !important;
            text-align: right !important;
            position: absolute;
            top:5%;
            right: 2%;
        }
        .dwb-c{
            float: left !important;
            text-align: left !important;
            position: absolute;
            top:5%;
            left: 2%;
        }
        .mbsc-android-holo-light .dwv {
            color: #868686;
            border-bottom: 2px solid #868686;
            opacity: 0;
        }
        .set-btn{
            color: #FD6102;
        }
        .cancel-btn{
            color: #868686;
        }
        .mbsc-mobiscroll .dwwol {
            /*border-top: 1px solid #ccc;*/
            /*border-bottom: 1px solid #ccc;*/
            border:1px solid #fda035;
            border-radius:20px;
            height: 40px;
            width: 40px;
            background: #fda035;
            color: #fff;
            margin-left:30%;
            text-align: center;
        }
        /*.dw-i {*/
            /*color: #fff;*/
        /*}*/
        /*.mbsc-mobiscroll .dwwol {*/
            /*border-top: 1px solid #ccc;*/
            /*border-bottom: 1px solid #ccc;*/
            /*height: 30px;*/
        /*}*/


        .dwwr{
            position: absolute;
            width: 100%;
            bottom: 0;
            height: 200px;

        }
        .mbsc-mobiscroll .dwwr {
            background: #fff;
        }
        .mbsc-mobiscroll .dw-li{
            font-size: 12px;
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
        <div class="head">
            <div class="part1">
                <!--没有地址显示视图-->
                <div class="addr" style="display: none">
                    <i class="fa fa-circle fa-fw" style="color: green"></i>
                    <span>请选择寄件人详细地址</span>
                </div>
                <!--地址详情视图-->
                <div class="addr_info">
                    <i class="fa fa-circle fa-fw" style="color: green;float: left;line-height: 7em"></i>
                    <p><span style="  padding-right: 25%;">泡芙先生</span><span>18525662255</span></p>
                    <p style="line-height: 15px;color:#777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                    <p style="line-height: 15px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                </div>
                <div class="btn"> <i class="fa fa-angle-right fa-fw fa-lg" style=" "></i></div>
            </div>
            <div class="part1" style="border: none;">
                <!--没有地址显示视图-->
                <div class="addr" style="display: none">
                    <i class="fa fa-circle fa-fw" style="color: red"></i>
                    <span>请选择收件人详细地址</span>
                </div>
                <!--地址详情视图-->
                <div class="addr_info">
                    <i class="fa fa-circle fa-fw" style="color: red;float: left;line-height: 7em"></i>
                    <p><span style="  padding-right: 25%;">红豆小姐</span><span>18525662255</span></p>
                    <p style="line-height: 15px;color:#777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                    <p style="line-height: 15px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                </div>
                <div class="btn"> <i class="fa fa-angle-right fa-fw fa-lg" style=" "></i></div>
            </div>
        </div>
        <div class="c_body">
            <div class="col_01">
                <div class="pro-name">
                    <span style="padding-right: 10px;" >物品名称</span>
                </div>
                <input  class="btnin" type="text"  id="scroller" placeholder="文件"> <i class="fa fa-angle-right fa-fw fa-lg"  style="line-height: 60px;float: left;"></i>
            </div>
            <div class="col_02">
                <div class="col_02-left">
                    <div class="addr">
                        <span style="padding-right: 10px;">物品重量</span>
                    </div>
                    <div class="btn">
                        <sapn style="padding: 10px;"><i class="fa fa-plus-circle fa-fw"></i></sapn>
                        <span>5</span>公斤以下
                        <sapn style="padding: 10px;"><i class="fa fa-minus-circle fa-fw"></i></sapn>
                    </div>
                </div>
                <div class="col_02-right">
                    <div class="addr">
                        <span style="padding-right: 10px;">预约取件</span>
                    </div>
                    <div class="btn">
                        <input id="orderTime" style="background: #fff" type="text" placeholder="选择取件时间" readonly>
                        <sapn style="padding: 3%;"><i class="fa fa-angle-right fa-fw fa-lg" style=" "></i></sapn>
                    </div>
                </div>
            </div>
            <div class="col_03">
                <div class="pro-name">
                    <span style="padding-right: 10px;float: left;">备注</span>
                    <textarea cols="40" rows="5" wrap="hard" placeholder="特殊要求请备注说明（选填）" style="float: left;  margin-top: 13%;"></textarea>
                </div>
            </div>
        </div>

    </div>
    <div class="foot" >
        <div class="c1">
            <p style="margin-left: 10px;">合计：</p>
            <p>
                <input type="checkbox" style="margin: 0 10px;">
                <span>我已阅读并同意<a>《用户协议》</a></span>
            </p>

        </div>
        <div class="btn">提交</div>
    </div>

    </div>


</div>
<div  id="show" style="display: none">
    <div style="width: 100%;height: 100%;top:0;left:0; bottom:0; right:0;z-index: 2; background: red;position: absolute;background: #000;opacity: 0.3"></div>
    <div   class="foot1"  style="">
        <div style="height: 100px ;z-index: 3; ">
            <ul>
                <li style="line-height: 35px;padding: 0 5%;border: none;text-align: center;">
                    <span class="fl" style="color: #868686">取消</span>
                    <span  style="color: #FD6102">编辑</span>
                    <span class="fr" style="color: #FD6102">新建</span>
                </li>
                <li>
                    <div class="addr1_info fl">
                        <p><span style="  padding-right: 40%;">泡芙先生</span><span>18525662255</span></p>
                        <p  style="line-height: 20px;color: #777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                        <p  style="line-height: 20px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                    </div>
                </li>
                <li>
                    <div class="addr1_info fl">
                        <p><span style="  padding-right: 40%;">红豆小姐</span><span>18525662255</span></p>
                        <p  style="line-height:20px;color: #777777;">浙江省&nbsp;杭州市&nbsp;滨江区</p>
                        <p  style="line-height:20px;color: #777777;">银泰·海威国际&nbsp;1幢1单元102</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

</body>
<script>

</script>
<script>
    $("#page").click(function(){
                $("#show").show();

    });
</script>
<script>

    $(function(){
        // create scroller
        $("#scroller").mobiscroll().scroller({
            theme: 'mobiscroll',
            display: 'bottom',
            showLabel: false,
            height:30,
            buttons: [

                {
                    text: '取消',
                    handler: 'cancel',
                    icon: 'close',
                    cssClass: 'cancel-btn'
                },
                {
                    text: '确定',
                    handler: 'set',
                    icon: 'close',
                    cssClass: 'set-btn'
                }
            ],
            wheels: [
                [
                    {   label: '',
                        values: ['鲜花', '美食', '文件', '冷冻', '其他'],

                    },
                ]
            ],
        });
    });
    $(function(){
        // create scroller

        $("#orderTime").mobiscroll().scroller({
            theme: 'mobiscroll',
            display: 'bottom',
            showLabel: false,
            height:40,
            buttons: [

                {
                    text: '取消',
                    handler: 'cancel',
                    icon: 'close',
                    cssClass: 'cancel-btn'
                },
                {
                    text: '确定',
                    handler: 'set',
                    icon: 'close',
                    cssClass: 'set-btn'
                }
            ],
            wheels: [
                [
                    {   label: '',
                        values: ['今天', '明天', '后天'],
                    },
                    {
                        label: '',
                        values: ['现在','19:00','20:00','21:00','22:00']
                    },
                    {
                        label: 'second wheel',
                        values: ['0','10','20','30','40','50']
                    }
                ]
            ],


        });
    });
</script>
</html>