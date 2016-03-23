<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <meta  name="viewport"  content="width=device-width,minimum-scale=1,user-scalable=no,maximum-scale=1,initial-scale=1">
    <script>
        var ROOT = "/wisdom";//网站根目录地址,例:/根目录
        var APP = "/wisdom/index.php";//当前应用（入口文件）地址,例:/根目录/index.php
        var APP_NAME = "__APP_NAME__";//网站应用根目录,例:/根目录/应用目录
        var IMG = "/wisdom/Public/Mobileweb/Default/images";
        var STATIC = "/wisdom/Public/static";
        var UPFILE = "/wisdom/Public/upfile";
        var THEME = "/wisdom/Public/Mobileweb/Default";
    </script>
    <!-- Link Swiper's CSS -->
    <script src="/wisdom/Public/static/jquery-1.11.2.min.js"></script>
    <link rel="stylesheet" href="/wisdom/Public/Mobileweb/Default/css/swiper-3.2.7.min.css">
    <style>
        *{margin:0px;padding:0px;}
        .swiper-wrapper{
            width: 100%;
            height: 100%;
            text-align: center;
        }
        .swiper-slide img{
            width: 100%;

        }
    </style>
</head>
<body>
<!-- Swiper -->
<div class="swiper-container">
    <div class="swiper-wrapper">
                <div class="swiper-slide" >
                    <img src="/wisdom/Public/Mobileweb/Default/images/guide-01.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="/wisdom/Public/Mobileweb/Default/images/guide-02.jpg">
                </div>
                <div class="swiper-slide" >
                    <img src="/wisdom/Public/Mobileweb/Default/images/guide-03.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="/wisdom/Public/Mobileweb/Default/images/guide-04.jpg">
                </div>
                <div class="swiper-slide">
                    <img src="/wisdom/Public/Mobileweb/Default/images/guide-05.jpg">
                </div>
    </div>
    <div class="swiper-pagination"></div>
</div>

<!-- Swiper JS -->
<script src="/wisdom/Public/Mobileweb/Default/js/swiper-3.2.7.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container',{
        pagination : '.swiper-pagination',
        autoplay :2000,
        speed:800,
        loop : true,
//pagination : '#swiper-pagination1',
    });
//    $(document).ready(function(){
//       $(".swiper-slide img").css("width","100%");
//        var h=document.documentElement.clientHeight;
//        $(".swiper-slide img").css("height",h);
//    });
</script>
</body>
</html>