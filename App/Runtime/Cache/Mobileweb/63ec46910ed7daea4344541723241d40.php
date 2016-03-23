<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
    <head>
        <title><?php echo ($webtitle); ?></title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script>
            var ROOT = "/wisdom";//网站根目录地址,例:/根目录
            var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
            var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
            var IMG = "/wisdom/Public/Mobileweb/Default/images";
            var STATIC = "/wisdom/Public/static";
            var UPFILE = "/wisdom/Public/upfile";
            var THEME = "/wisdom/Public/Mobileweb/Default";
        </script>

        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/jquery.mobile-1.4.5.min.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/Mobileweb/Default/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/wisdom/Public/static/css/font-awesome.min.css" />
        <script type="text/javascript" src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="/wisdom/Public/Mobileweb/Default/js/jquery.mobile-1.4.5.min.js"></script>
    </head>

<body>
<div data-role="page" id="pageone">


    <div data-role="content">
       <div class="head_top">
           <p>吸烟有害健康</p>
       </div>
        <div class="head_nav">
            <div class="ui-grid-b">
                <div class="ui-block-a">
                    <a href="#" class="ui-btns a4" data-icon="arrow-l" data-role="button"> </a>
                </div>
                <div class="ui-block-b nav_cent">
                    <span class="sp5">1</span>
                    <span>/3</span>
                </div>
                <div class="ui-block-c">
                    <a href="#pagetwo" class="ui-btns a5" data-icon="arrow-r" data-role="button"> </a>
                </div>
            </div>
        </div>
        <div class="head_con">
            <p>皇冠大酒店地理位置的优越性</p>
        </div>
        <div class="head_con2">
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
        </div>
    </div>
</div>

<div data-role="page" id="pagetwo">
    <div data-role="content">
        <div class="head_top">
            <p>吸烟有害健康</p>
        </div>
        <div class="head_nav">
            <div class="ui-grid-b">
                <div class="ui-block-a">
                    <a href="#pageone" class="ui-btns a4" data-icon="arrow-l" data-role="button"> </a>
                </div>
                <div class="ui-block-b nav_cent">
                    <span class="sp5">2</span>
                    <span>/3</span>
                </div>
                <div class="ui-block-c">
                    <a href="#pagethree" class="ui-btns a5" data-icon="arrow-r" data-role="button"> </a>
                </div>
            </div>
        </div>
        <div class="head_con">
            <p>皇冠大酒店地理位置的优越性</p>
        </div>
        <div class="head_con2">
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
        </div>

    </div>
</div>
<div data-role="page" id="pagethree">
    <div data-role="content">
        <div class="head_top">
            <p>吸烟有害健康</p>
        </div>
        <div class="head_nav">
            <div class="ui-grid-b">
                <div class="ui-block-a">
                    <a href="#pagetwo" class="ui-btns a4" data-icon="arrow-l" data-role="button"> </a>
                </div>
                <div class="ui-block-b nav_cent">
                    <span class="sp5">3</span>
                    <span>/3</span>
                </div>
                <div class="ui-block-c">
                    <!--<a href="#pagetwo" data-icon="arrow-r" data-role="button"> </a>-->
                </div>
            </div>
        </div>
        <div class="head_con">
            <p>皇冠大酒店地理位置的优越性</p>
        </div>
        <div class="head_con2">
            <p>
                <input class="inps" type="radio"/>
                <span>优</span>
            </p>
            <p>
                <input  class="inps" type="radio"/>
                <span>优</span>
            </p>
            <p>
                <input   class="inps" type="radio"/>
                <span>优</span>
            </p>
        </div>

    </div>
</div>
</body>
</html>