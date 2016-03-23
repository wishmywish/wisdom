<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>我的金币</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
    <style>
        html,body{
            background-color:#FFFFFF;
            margin: 0;
            padding: 0;
        }
        /*.header{*/
            /*color: #fff;*/
            /*text-align: left;*/
            /*width: 100%;*/
            /*height: 400px;*/
            /*margin: auto;*/
        /*}*/
        /*.header .pre{*/
            /*background: #ff6600;*/
            /*height: 190px;*/
        /*}*/
        /*.header .all{*/
            /*background: #fff;*/
            /*height: 209px;*/
            /*border-bottom:1px solid #ccc ;*/
        /*}*/
        /*.header .pre .a0{*/
            /*font-size: 20pt;*/
            /*padding: 30px 0 10px 30px;*/
        /*}*/
        /*.header .pre .a1{*/
            /*font-size: 70pt;*/
            /*padding: 0 0 30px 30px;*/
        /*}*/
        /*.header .all .a0{*/
            /*font-size: 20pt;*/
            /*padding: 40px 0 10px 40px;*/
            /*color: #333333;*/
        /*}*/
        /*.header .all .a1{*/
            /*font-size: 70pt;*/
            /*padding: 0 0 40px 40px;*/
            /*color: #ff6600;*/
        /*}*/
        /*section{*/
            /*width: 100%;*/
            /*background: #fbfbfb;*/
            /*min-height: 200px;*/
        /*}*/

        header{
        background: #ff6600;
        height: 160px;
        color: #fff;
        }
        header .a0{
        font-size: 20px;
        font-weight: bold;
        padding: 30px 0 7px 30px;
        }
        header .a1{
        font-size: 70px;
        padding: 0 0 30px 30px;
        }
        header .a1 span{
            font-size: 80%;
        }
        aside{
        background: #fff;
        height: 150px;
        border-bottom:1px solid #ccc ;
        }
        aside .a0{
        font-size: 20px;
        font-weight: bold;
        padding: 30px 0 0px 30px;
        color: #333333;
        }
        aside .a1{
        font-size: 70px;
        padding: 0 0 30px 30px;
        color: #ff6600;
        }
        aside .a1 span{
            font-size: 80%;
        }
    </style>
</head>
<body>

<!--<div class="header">-->
    <!--<div class="pre">-->
        <!--<div class="a0"><i class="fa fa-calendar fa-lg" style="padding-right: 10px;"></i>今日收益（金币）</div>-->
        <!--<div class="a1">9000</div>-->
    <!--</div>-->
    <!--<div class="all">-->
        <!--<div class="a0">累计收益（元）</div>-->
        <!--<div class="a1">900000.22</div>-->
    <!--</div>-->
<!--</div>-->

<section id="container">
    <header>
        <div class="a0"><i class="fa fa-calendar fa-lg" style="padding-right: 10px;"></i>今日收益（金币）</div>
        <div class="a1"><span>9000</span></div>
    </header>
    <aside>
        <div class="a0">累计收益（元）</div>
        <div class="a1"><span>9000000.22</span></div>
    </aside>
    <section></section>
</section>
</body>
</html>